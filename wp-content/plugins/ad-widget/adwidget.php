<?php
/*
Plugin Name: Wordpress Ad Widget
Plugin URI: https://github.com/broadstreetads/wordpress-ad-widget
Description: The easiest way to place ads in your Wordpress sidebar. Go to Settings -> Ad Widget
Version: 2.4.0
Author: Broadstreet Ads
Author URI: http://broadstreetads.com
*/

require_once 'lib/Utility.php';

add_action('admin_init', array('AdWidget_Core', 'registerScripts'));
add_action('widgets_init', array('AdWidget_Core', 'registerWidgets'));
add_action('admin_menu', array('AdWidget_Core', 'registerAdmin'));

/**
 * This class is the core of Ad Widget
 */
class AdWidget_Core
{
    CONST KEY_INSTALL_REPORT = 'AdWidget_Installed';
    CONST VERSION = '2.4.0';

    /**
     * The callback used to register the scripts
     */
    static function registerScripts()
    {
        # Include thickbox on widgets page
        if($GLOBALS['pagenow'] == 'widgets.php')
        {
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
            wp_enqueue_script('adwidget-main',  self::getBaseURL().'assets/widgets.js');
        }
    }

    /**
     * The callback used to register the widget
     */
    static function registerWidgets()
    {
        register_widget('AdWidget_HTMLWidget');
        register_widget('AdWidget_ImageWidget');
    }

    /**
     * Get the base URL of the plugin installation
     * @return string the base URL
     */
    public static function getBaseURL()
    {
        return (get_bloginfo('url') . '/wp-content/plugins/ad-widget/');
    }

    /**
     * Register the admin settings page
     */
    static function registerAdmin()
    {
        add_options_page('Ad Widget', 'Ad Widget', 'edit_pages', 'adwidget.php', array(__CLASS__, 'adminMenuCallback'));
    }

    /**
     * The function used by WP to print the admin settings page
     */
    static function adminMenuCallback()
    {
        self::sendInstallReportIfNew();

        if(isset($_POST['cancel']))
            Broadstreet_Mini_Utility::hasAdserving(false);

        if(isset($_POST['subscribe']))
            Broadstreet_Mini_Utility::hasAdserving(true);

        include dirname(__FILE__) . '/views/admin.php';
    }

    /**
     * Makes a call to the Broadstreet service to collect information information
     *  on the blog in case of errors and other needs.
     */
    public static function sendReport($message = 'General')
    {

        $report = "$message\n";
        $report .= get_bloginfo('name'). "\n";
        $report .= get_bloginfo('url'). "\n";
        $report .= get_bloginfo('admin_email'). "\n";
        $report .= 'WP Version: ' . get_bloginfo('version'). "\n";
        $report .= 'Plugin Version: ' . self::VERSION . "\n";
        $report .= "$message\n";

        @wp_mail('plugin@broadstreetads.com', "Report: $message", $report);
    }

    /**
     * If this is a new installation and we've never sent a report to the
     * Broadstreet server, send a packet of basic info about this blog in case
     * issues should arise in the future.
     */
    public static function sendInstallReportIfNew()
    {
        $install_key = self::KEY_INSTALL_REPORT;
        $upgrade_key = self::KEY_INSTALL_REPORT .'_'. self::VERSION;

        $installed = self::getOption($install_key);
        $upgraded  = self::getOption($upgrade_key);

        $sent = ($installed && $upgraded);

        if($sent === FALSE)
        {
            if(!$installed)
            {
                self::sendReport("Installation");
                self::setOption($install_key, 'true');
                self::setOption($upgrade_key, 'true');
            }
            else
            {
                self::sendReport("Upgrade");
                self::setOption($upgrade_key, 'true');
            }
        }
    }

    /**
     * Sets a Wordpress option
     * @param string $name The name of the option to set
     * @param string $value The value of the option to set
     */
    public static function setOption($name, $value)
    {
        if (get_option($name) !== FALSE)
        {
            update_option($name, $value);
        }
        else
        {
            $deprecated = ' ';
            $autoload   = 'yes';
            add_option($name, $value, $deprecated, $autoload);
        }
    }

    /**
     * Gets a Wordpress option
     * @param string    $name The name of the option
     * @param mixed     $default The default value to return if one doesn't exist
     * @return string   The value if the option does exist
     */
    public static function getOption($name, $default = FALSE)
    {
        $value = get_option($name);
        if( $value !== FALSE ) return $value;
        return $default;
    }
}


/**
 * The HTML Widget
 */
class AdWidget_HTMLWidget extends WP_Widget
{
    /**
     * Set the widget options
     */
     function AdWidget_HTMLWidget()
     {
        $widget_ops = array('classname' => 'AdWidget_HTMLWidget', 'description' => 'Place an ad code like Google ads or other ad provider');
        $this->WP_Widget('AdWidget_HTMLWidget', 'Ad: HTML/Javascript Ad', $widget_ops);
     }

     /**
      * Display the widget on the sidebar
      * @param array $args
      * @param array $instance
      */
     function widget($args, $instance)
     {
         extract($args);

         if (isset($instance['w_before_html']) && !empty($instance['w_before_html'])) {
            echo $instance['w_before_html'];
        }
        else
            echo $before_widget;

        if (isset($instance['w_adv']) && !empty($instance['w_adv'])) {
            echo '<h1 class="sideTtl">'.$instance['w_adv'].'</h1>';
        }

         echo "<div class='recommendwrap'>{$instance['w_adcode']}</div>";

         if (isset($instance['w_end_html']) && !empty($instance['w_end_html'])) {
            echo $instance['w_end_html'];
        }
        else
        echo $after_widget;
     }

     /**
      * Update the widget info from the admin panel
      * @param array $new_instance
      * @param array $old_instance
      * @return array
      */
     function update($new_instance, $old_instance)
     {
        $instance = $old_instance;

        $instance['w_adcode'] = $new_instance['w_adcode'];
        $instance['w_adv']    = $new_instance['w_adv'];
        $instance['w_before_html']     = $new_instance['w_before_html'];
        $instance['w_end_html']     = $new_instance['w_end_html'];
        /* New ad? Upload it to Broadstreet */
        // if($instance['w_adcode'] && Broadstreet_Mini_Utility::hasAdserving()) {

        //     $advertisement_id = false;
        //     # New ad?
        //     if(is_numeric(@$instance['bs_ad_id'])) $advertisement_id = $instance['bs_ad_id'];

        //     # New advertiser?
        //     if(!$advertisement_id) {
        //         $api = Broadstreet_Mini_Utility::getClient();
        //         $adv = $api->createAdvertiser(Broadstreet_Mini_Utility::getNetworkID(), $instance['w_adv']);
        //         $instance['bs_adv_id'] = $adv->id;
        //     }

        //     $ad = Broadstreet_Mini_Utility::importHTMLAd(Broadstreet_Mini_Utility::getNetworkID(),
        //             $instance['bs_adv_id'],
        //             $instance['w_adcode'],
        //             $advertisement_id);

        //     if(!$advertisement_id) {
        //         $instance['bs_ad_html'] = $ad->html;
        //         $instance['bs_ad_id']   = $ad->id;
        //         $instance['bs_adv_id']  = $adv->id;
        //     }
        // }

        return $instance;
     }

     /**
      * Display the widget update form
      * @param array $instance
      */
     function form($instance)
     {

        $defaults = array('w_adcode' => '', 'w_adv' => 'New Advertiser');
        $instance = wp_parse_args((array) $instance, $defaults);
       ?>
       <div class="widget-content">
       <p>Paste your Google ad tag, or any other ad tag in this widget below.</p>
       <p>
            <label for="<?php echo $this->get_field_id('w_adcode'); ?>">Ad Code</label>
            <textarea style="height: 100px;" class="widefat" id="<?php echo $this->get_field_id( 'w_adcode' ); ?>" name="<?php echo $this->get_field_name('w_adcode'); ?>"><?php echo $instance['w_adcode']; ?></textarea>
       </p>
       <p>
            <label for="<?php echo $this->get_field_id('w_adv'); ?>">Advertiser Name</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_adv'); ?>" name="<?php echo $this->get_field_name('w_adv'); ?>" value="<?php echo $instance['w_adv']; ?>" />
       </p>
       <p>
            <label for="<?php echo $this->get_field_id('w_before_html'); ?>">Before HTML:</label><br/>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_before_html'); ?>" name="<?php echo $this->get_field_name('w_before_html'); ?>" value="<?php echo esc_attr($instance['w_before_html']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('w_end_html'); ?>">End HTML:</label><br/>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_end_html'); ?>" name="<?php echo $this->get_field_name('w_end_html'); ?>" value="<?php echo $instance['w_end_html']; ?>" />
        </p>
        </div>
       <?php
     }
}

/**
 * This is an optional widget to display GitHub projects
 */
class AdWidget_ImageWidget extends WP_Widget
{
    /**
     * Set the widget options
     */
     function AdWidget_ImageWidget()
     {
        $widget_ops = array('classname' => 'AdWidget_ImageWidget', 'description' => 'Place an image ad with a link');
        $this->WP_Widget('AdWidget_ImageWidget', 'Ad: Image/Banner Ad', $widget_ops);
     }

     /**
      * Display the widget on the sidebar
      * @param array $args
      * @param array $instance
      */
     function widget($args, $instance)
     {
        extract($args);

        $link   = @$instance['w_link'];
        $img    = @$instance['w_img'];
        $resize = @$instance['w_resize'];
        $tag = @$instance['w_adv'];
        if (empty($tag)) {
            $tag = $link;
        }
        $id     = rand(1, 100000);

        if($resize == 'yes')
        {
            $resize_s = "style='width: 100%;'";
        }
        else
        {
            $resize_s = '';
        }
        if (isset($instance['w_before_html']) && !empty($instance['w_before_html'])) {
            echo $instance['w_before_html'];
        }
        else
            echo $before_widget;

        if(!$img)
        {
            $img  = AdWidget_Core::getBaseURL() . 'assets/sample-ad.png';
            $link = 'http://adsofthefuture.com';
        }

        // if(Broadstreet_Mini_Utility::hasAdserving() && is_numeric($instance['bs_ad_id']))
        // {
        //     if($resize == 'yes') echo '<style type="text/css">.adwidget-id'.$id.' img { width: 100% !important; height: auto !important; }</style>';
        //     echo "<span class='adwidget-id$id'>{$instance['bs_ad_html']}</span>";
        // }
        // else
        // {
            echo "<a target='_blank' href='$link' alt='".$tag."'><img $resize_s src='$img' alt='".$tag."' /></a>";
        // }
        if (isset($instance['w_end_html']) && !empty($instance['w_end_html'])) {
            echo $instance['w_end_html'];
        }
        else
        echo $after_widget;
     }

     /**
      * Update the widget info from the admin panel
      * @param array $new_instance
      * @param array $old_instance
      * @return array
      */
     function update($new_instance, $old_instance)
     {
        $instance = $old_instance;

        $changed = ($instance['w_img'] != $new_instance['w_img']
                    || $instance['w_link'] !== $new_instance['w_link']);

        $instance['w_link']    = $new_instance['w_link'];
        $instance['w_img']     = $new_instance['w_img'];
        $instance['w_resize']  = @$new_instance['w_resize'];
        $instance['w_adv']     = $new_instance['w_adv'];
        $instance['w_before_html']     = $new_instance['w_before_html'];
        $instance['w_end_html']     = $new_instance['w_end_html'];

        /* New ad? Upload it to Broadstreet */
        // if($instance['w_img'] && $changed && Broadstreet_Mini_Utility::hasAdserving()) {

        //     $advertisement_id = false;
        //     # New ad?
        //     if(is_numeric(@$instance['bs_ad_id'])) $advertisement_id = $instance['bs_ad_id'];

        //     # New advertiser?
        //     if(!$advertisement_id) {
        //         $api = Broadstreet_Mini_Utility::getClient();
        //         $adv = $api->createAdvertiser(Broadstreet_Mini_Utility::getNetworkID(), $instance['w_adv']);
        //         $instance['bs_adv_id'] = $adv->id;
        //     }

        //     $ad = Broadstreet_Mini_Utility::importImageAd(Broadstreet_Mini_Utility::getNetworkID(),
        //             $instance['bs_adv_id'],
        //             $instance['w_img'],
        //             $instance['w_link'],
        //             $advertisement_id);

        //     if(!$advertisement_id) {
        //         $instance['bs_ad_html'] = $ad->html;
        //         $instance['bs_ad_id']   = $ad->id;
        //         $instance['bs_adv_id']  = $adv->id;
        //     }
        // }

        return $instance;
     }

     /**
      * Display the widget update form
      * @param array $instance
      */
     function form($instance)
     {
        $link_id = $this->get_field_id('w_link');
        $img_id = $this->get_field_id('w_img');
        // dunghd add some html for before and after class
        // $before_html = $this->get_field_id('w_before_html');
        // $end_html = $this->get_field_id('w_end_html');

        $defaults = array('w_link' => get_bloginfo('url'), 'w_img' => '', 'w_adv' => 'New Advertiser', 'w_resize' => 'no');

		$instance = wp_parse_args((array) $instance, $defaults);

        $img  = $instance['w_img'];
        $link = $instance['w_link'];
        $adv  = $instance['w_adv'];

       ?>
        <div class="widget-content">
       <p style="text-align: center;" class="bs-proof">
           <?php if($instance['w_img']): ?>
                Your ad is ready.
                <br/><br/><strong>Scaled Visual:</strong><br/>
                <div class="bs-proof"><img style="width:100%;" src="<?php echo $instance['w_img'] ?>" alt="<?php echo $link; ?>" /></div><br/>
           <?php endif; ?>
           <a href="#" class="upload-button" rel="<?php echo $img_id ?>">Click here to upload a new image.</a> You can also paste in an image URL below.

       </p>
       <input class="widefat tag" placeholder="Image URL" type="text" id="<?php echo $img_id; ?>" name="<?php echo $this->get_field_name('w_img'); ?>" value="<?php echo htmlentities($instance['w_img']); ?>" />
       <br/><br/>
       <p>
            <label for="<?php echo $this->get_field_id('w_before_html'); ?>">Before HTML:</label><br/>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_before_html'); ?>" name="<?php echo $this->get_field_name('w_before_html'); ?>" value="<?php echo esc_attr($instance['w_before_html']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('w_end_html'); ?>">End HTML:</label><br/>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_end_html'); ?>" name="<?php echo $this->get_field_name('w_end_html'); ?>" value="<?php echo $instance['w_end_html']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('w_link'); ?>">Ad Click Destination:</label><br/>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_link'); ?>" name="<?php echo $this->get_field_name('w_link'); ?>" value="<?php echo $instance['w_link']; ?>" />
        </p>
       <p>
            <label for="<?php echo $this->get_field_id('w_adv'); ?>">Advertiser Name:</label><br/>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('w_adv'); ?>" name="<?php echo $this->get_field_name('w_adv'); ?>" value="<?php echo $instance['w_adv']; ?>" />
        </p>
       <p>
           <label for="<?php echo $this->get_field_id('w_resize'); ?>">Auto Resize to Max Width? </label>
           <input type="checkbox" name="<?php echo $this->get_field_name('w_resize'); ?>" value="yes"  <?php if($instance['w_resize'] == 'yes') echo 'checked'; ?> />
       </p>

        </div>
       <?php
     }
}

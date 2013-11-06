<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'beauty');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^(T!7P,;u*P-unS-Z^]&!$oIw*I^MGC@Ddp<Vp&NE2 A88)PKY#nR|8_;D-?|}-Q');
define('SECURE_AUTH_KEY',  'dN#4$3lg+SLj#`KGSV;dg4PXI`D-3H;j)M-)qP/HE=-uOZ6#H|_4s*G-5$a`WaD.');
define('LOGGED_IN_KEY',    '-&*Opqh&GV4@+~UY].i}AkZZeQR`|VpF^!e5dOmkU;}}8qkF &SUJ#-)[#}Zpn-w');
define('NONCE_KEY',        'h}>BL/k0%]}4Duz$ilWXFn/_NX2BjYaG$N|vn*+Q![B+d!(vJ|gO>|)uY%86^sc&');
define('AUTH_SALT',        '8dDX:asxjIJ{49s|O8C2=kAbOd!0Rw(yl_fVrW-^])J}8Xxx/y`OmYJ>W,$h73dw');
define('SECURE_AUTH_SALT', '!K@t*Tm|;wbanVt-ATlFs<8Isr9^{}IeVh5L,yXi88HF18mDw-p9:du.BxV#CK h');
define('LOGGED_IN_SALT',   '+%heWJ_$/.,GQ<7` v_9t_Ie1BYR-y,39L%=o*N31Rq T>L-uy3kInd:<xwu)-^4');
define('NONCE_SALT',       '(?y/AxF|i-F+`<oirrvBt1;w9#tj(|D_::kZ}5(C@i2<yHK,5W,t{gLj6M|%#1v+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

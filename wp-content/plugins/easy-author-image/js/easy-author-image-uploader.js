jQuery(document).ready(function($){
	$('#author_profile_picture_button').click(function() {
		//type = image,audio,video,file. If we write it wrong, nothing will appear. type = file by default
			
		//tb_show(caption, url, imageGroup)
		// Google: 'ImageGroup tb_show thickbox':
		//The optional imageGroup parameter can also be used to pass in an array of images for a single or multiple image slide show gallery.
		// The problem is that inserting a gallery needs an associated post to work
		tb_show('Upload an author profile picture! (Easy Author Image Plugin v1.3)', 'media-upload.php?referer=profile&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
		return false;
	});
	
	window.send_to_editor = function(html) {
		// html returns a link like this:
		// <a href="{server_uploaded_image_url}"><img src="{server_uploaded_image_url}" alt="" title="" width="" height"" class="alignzone size-full wp-image-125" /></a>
		// var image_url = $('img',html).attr('src');
		var image_url =  html.match(/(https?:\/\/[^\s]+)/g)[0];
		image_url = image_url.replace('"','');
		// alert(html);
		// alert(image_url);
		$('#author_profile_picture_url').val(image_url); // updates our hidden field that will update our author's meta when the form is saved
		tb_remove();
		$('#author_profile_picture_preview img').attr('src',image_url);
		
		$('#submit_options_form').trigger('click');
		$('#upload_success').text('Here is a preview of the profile picture you chose. To save it as your profile picture, scroll to the bottom of this page and click Update Profile.');
		
	}
	
	
	
});
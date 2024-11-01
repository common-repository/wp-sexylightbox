<?php
/*
Plugin Name: WP SexyLightbox 
Plugin URI: http://frozzer.com/wp-sexylightbox/
Description: Modificación del plugin SexyLightbox for Wordpress por <a href="http://www.digibox.com.ar/">Nahuel Giovagnoli</a> para soportar SexyLightBox2 por <a href="http://www.coders.me/lang/es/web-html-js-css/javascript/sexy-lightbox-2">Eduardo Sada</a>
Version: 0.5.3
Author: Mario Aguiar
Author URI: http://frozzer.com

Copyright 2009  Mario Aguiar  (email : info@marioaguiar.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Default options
function sexylightbox_js(){
	if (!get_option('sexy_theme'))
	{
	update_option('sexy_theme','negro');
	update_option('sexy_background','#000');
	update_option('sexy_opacity','0.6');
	update_option('sexy_show_duration','200');
	update_option('sexy_close_duration','400');
	update_option('sexy_hex_color','#000');
	update_option('sexy_caption_color','#fff');
	update_option('sexy_library', 'jquery');
	update_option('sexy_direction', 'top');
	update_option('sexy_compressed', 'ys');
	}
	
// Decide wether use compressed or full script
if(!is_admin()){	
		if ( get_option('sexy_compressed') != true)	{
			$sexyfile = 'sexylightbox';
		} else {
			$sexyfile = 'sexylightbox.min';
}

// Actual code to be printed on the header
// Mootools
    if ( get_option('sexy_library') != 'jquery')
    {
	   echo '
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/mootools/1.2.3/mootools-yui-compressed.js"></script>
<script type="text/javascript" src="'.plugins_url('wp-sexylightbox/mootools/'.$sexyfile.'.js').'"></script>
<link rel="stylesheet" href="'.plugins_url('wp-sexylightbox/sexylightbox.css').'" type="text/css" media="all" />
<script type="text/javascript">
window.addEvent(\'domready\', function(){
	SexyLightbox = new SexyLightBox({
		\'background-color\':\''.get_option('sexy_background').'\',
		\'opacity\': '.get_option('sexy_opacity').',
		showDuration:'.get_option('sexy_show_duration').',
		closeDuration:'.get_option('sexy_close_duration').',
		captionColor:\''.get_option('sexy_caption_color').'\',
		hexcolor:\''.get_option('sexy_hex_color').'\',
		imagesdir:\''.plugins_url('wp-sexylightbox/sexyimages').'\',
		color:\''.get_option('sexy_theme').'\',
		emergefrom:\''.get_option('sexy_direction').'\'});
			});
</script> '; 
			 
	} else {
// jQuery
	   echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="'.plugins_url('wp-sexylightbox/jquery/jquery.easing.1.3.js').'"></script>
<script type="text/javascript" src="'.plugins_url('wp-sexylightbox/jquery/'.$sexyfile.'.js').'"></script>
<link rel="stylesheet" href="'.plugins_url('wp-sexylightbox/sexylightbox.css').'" type="text/css" media="all" />
<script type="text/javascript">
$(document).ready(function(){
	SexyLightbox.initialize({
		\'background-color\':\''.get_option('sexy_background').'\',
		\'opacity\': \''.get_option('sexy_opacity').'\',
		showDuration:'.get_option('sexy_show_duration').',
		closeDuration:'.get_option('sexy_close_duration').',
		captionColor:\''.get_option('sexy_caption_color').'\',
		hexcolor:\''.get_option('sexy_hex_color').'\',
		imagesdir:\''.plugins_url('wp-sexylightbox/sexyimages').'\',
		color:\''.get_option('sexy_theme').'\',
		emergefrom:\''.get_option('sexy_direction').'\'});
		});
</script> ';		
	}		  
}
}
// Filter to print the codes
add_action('wp_print_scripts','sexylightbox_js');

// Adds rel=sexylightbox to our single images
function direct_image($link, $id) {

	$mimetypes = array('image/jpeg', 'image/png', 'image/gif');

	$post = get_post($id);

	if (in_array($post->post_mime_type, $mimetypes))
		{
			global $post;
			$thePostID = $post->ID;
			$link=wp_get_attachment_url($id);
			$link.='\' rel=\'sexylightbox['.$thePostID.']';
			return $link;
		}
	else
		{
			return $link;
		}
}
add_filter('attachment_link','direct_image',10,2);


// Adds rel="sexylightbox" to the WordPress built-in gallery
function sexylightbox($content){
	global $post;
	$thePostID = $post->ID;
	return preg_replace('/<a(.*?)href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"(.*?)><img/U', '<a$1href="$2.$3" $4 rel="sexylightbox['.$thePostID.']"><img', $content);
}
add_filter('the_content', 'sexylightbox',12);

// Lets create the CPanel
function configuracion_panel(){  
	//echo WP_CONTENT_DIR;    
	//echo get_option('sexy_theme');
	
if (isset($_POST['save_sexy_settings'])) {
	$theme = $_POST['theme'];
	$background = $_POST['background'];
	$opacity = $_POST['opacity'];
	$show_duration = $_POST['show_duration'];
	$close_duration = $_POST['close_duration'];
	$hex = $_POST['hex_color'];
	$caption = $_POST['caption_color'];
	$library = $_POST['library'];
	$direction = $_POST['direction'];
	$compressed = $_POST['compressed'];
	update_option('sexy_theme', $theme);
	update_option('sexy_background', $background);
	update_option('sexy_opacity', $opacity);
	update_option('sexy_show_duration',$show_duration);
	update_option('sexy_close_duration',$close_duration);
	update_option('sexy_hex_color',$hex);
	update_option('sexy_caption_color',$caption);
	update_option('sexy_library',$library);
	update_option('sexy_direction',$direction);
	update_option('sexy_compressed', $compressed);  
       
       
       ?> <div class="updated"><p>Opciones Sexy Guardadas</p></div> <?php
     }

include('panel.php');
       
   }
   
// Adds a link to our Options tab
function configuracion_add_menu(){   
      if (function_exists('add_options_page')) {
         //add_menu_page
         add_options_page('SexyLightBox', 'SexyLightBox', 8, basename(__FILE__), 'configuracion_panel');
      }
   }
   
   if (function_exists('add_action')) {
      add_action('admin_menu', 'configuracion_add_menu'); 
   }

// That's all, enjoy!
?>

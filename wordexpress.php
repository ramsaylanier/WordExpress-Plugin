<?php
/*
Plugin Name: WordExpress
Plugin URI: http://www.advancedcustomfields.com/
Description: WordExpress companion plugin
Version: 1.0.0
Author: Ramsay Lanier
Author URI: http://www.ramsaylanier.com/
License: MIT
Copyright: Ramsay Lanier
*/


add_action( 'admin_menu', 'wordexpress_plugin_menu' );

function wordexpress_plugin_menu() {
	add_options_page( 'WordExpress Options', 'WordExpress', 'manage_options', 'wordexpress-options', 'wordexpress_plugin_options' );
}


function wordexpress_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<p>Here is where the form would go if I actually had options.</p>';
	echo '</div>';
}

require dirname( __FILE__ ) . '/wordexpress_page_fields.php';

?>

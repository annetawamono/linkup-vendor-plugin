<?php

/*
Plugin Name: Link Up Vendors
Plugin URI: https://github.com/annetawamono/linkup-vendor-plugin
Description: A plugin to manage and display vendors on the Link Up website
Author: Anneta Wamono
Version: 1.0.0
Author URI: https://annetawamono.github.io/portfolio/
*/

/**
  * Enqueue css
  */

function luv_Vendor_scripts() {
  wp_enqueue_style( 'luv-vendors',  plugin_dir_url( __FILE__ ) . 'css/luv-master.css' );
  wp_enqueue_script('luv-divider',  plugin_dir_url( __FILE__ ) . 'js/luv-divider.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'luv_Vendor_scripts' );

// Include luv-functions.php
require_once plugin_dir_path(__FILE__) . 'includes/luv-functions.php';

?>

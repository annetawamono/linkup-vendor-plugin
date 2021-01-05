<?php

/*
Plugin Name: Link Up Vendors
Plugin URI: https://themefoundation.com/
Description: A plugin to manage and display vendors on the Link Up website
Author: Anneta Wamono
Version: 1.0
Author URI: https://annetawamono.github.io/portfolio/
*/

/**
  * Enqueue css
  */

function tutsplus_movie_styles() {
  wp_enqueue_style( 'luv-vendors',  plugin_dir_url( __FILE__ ) . 'css/luv-master.css' );
}
add_action( 'wp_enqueue_scripts', 'tutsplus_movie_styles' );

// Include luv-functions.php
require_once plugin_dir_path(__FILE__) . 'includes/luv-functions.php';

?>

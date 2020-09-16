<?php

/*
 * Adds top level menu link to the ACP
 */

function luv_Add_Admin_Link() {
  add_menu_page(
    'My First Page', //Title
    'My First Plugin', //Text to show on menu link
    'manage_options', //User capability requirement
    'link-up-vendors/includes/luv-acp-page.php' //Slug for file to display when clicking link
  );
}
add_action( 'admin_menu', 'luv_Add_Admin_Link' );

/*
 * Create vendor post type
 */

function luv_Create_Vendor_Posttype() {
  register_post_type( 'movies',
    array(
      'labels' => array(
        'name' => __( 'Vendors' ),
        'singular_name' => __( 'Movie' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'vendors'),
    )
  );
}
add_action( 'init', 'luv_Create_Vendor_Posttype' );

/*
 * Create shortcode for displaying vendor details in alphabetized list
 */
function luv_Display_Vendor_Details() {
  return 'This is an example of a shortcode';
}
add_shortcode( 'vendors', 'luv_Display_Vendor_Details' );

?>

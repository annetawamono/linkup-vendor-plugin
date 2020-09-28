<?php

/*
 * Adds top level menu link to the ACP
 */

function luv_Add_Admin_Link() {
//todo: change labels
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
  register_post_type( 'vendors',
    array(
      'labels' => array(
        'name' => __( 'Vendors' ),
        'singular_name' => __( 'Vendor' ),
        'add_new' => __( 'Add New Vendor'),
        'edit_item' => __( 'Edit Vendor' ),
        'new_item' => __( 'Add New Vendor' ),
        'view_item' => __( 'View Vendor' ),
        'search_item' => __( 'Search Vendor' ),
        'not_found' => __( 'No vendors found' ),
        'not_found_in_trash' => __( 'No vendors found in trash' )
      ),
      'supports' => array(
        'title',
        'editor',
        'thumbnail',
        'revisions'
      ),
      'public' => true,
      'show_in_rest' => true,
      'has_archive' => true,
      'rewrite' => array( 'slug' => 'vendors' ),
      'taxonomies' => array( 'category' ),
      'register_meta_box_cb' => 'luv_Create_Meta_Boxes',
    )
  );
}
add_action( 'init', 'luv_Create_Vendor_Posttype' );

/*
 * Create meta boxes for vendors
 */

function luv_Create_Meta_Boxes() {
//todo: create a metabox called preview information to put on marketplace page
	add_meta_box(
		'luv_metabox', // metabox ID
		'Meta Box', // title
		'luv_metabox_callback', // callback function
		'vendors', // post type or post types in array
		'normal', // position (normal, side, advanced)
		'default' // priority (default, low, high, core)
	);

}
//can add this to add_meta_boxes hook too
add_action( 'admin_menu', 'luv_Create_Meta_Boxes' );

/*
 * Meta box callbacks
 */

 function luv_metabox_callback( $post ) {
//todo: add inputs for preview info

	$seo_title = get_post_meta( $post->ID, 'seo_title', true );

	// nonce, actually I think it is not necessary here
	wp_nonce_field( basename(__FILE__), 'luv_nonce' );

	echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="seo_title">SEO title</label></th>
				<td><input type="text" id="seo_title" name="seo_title" value="' . esc_attr( $seo_title ) . '" class="regular-text"></td>
			</tr>
		</tbody>
	</table>';

}

/*
 * Save meta boxes
 */

function luv_save_meta( $post_id, $post ) {

	// nonce check
	if ( ! isset( $_POST[ 'luv_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'luv_nonce' ], basename(__FILE__) ) ) {
		return $post_id;
	}

	// check current use permissions
	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	// Do not save the data if autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// define your own post type here
	if( $post->post_type != 'vendors' ) {
		return $post_id;
	}

  //update and delete should happen for every input field
  //there are different sanitize functions e.g. sanitize_textarea()
	if( isset( $_POST[ 'seo_title' ] ) ) {
		update_post_meta( $post_id, 'seo_title', sanitize_text_field( $_POST[ 'seo_title' ] ) );
	} else {
		delete_post_meta( $post_id, 'seo_title' );
	}

	return $post_id;
}
//don't know why but parameters 10 and 2 allow you to pass $post to the save function
 add_action( 'save_post', 'luv_save_meta', 10, 2 );

/*
 * Create shortcode for displaying vendor details in alphabetized list
 */
function luv_Display_Vendor_Details() {
  //todo: output a loop of all the vendors here
  return 'This is an example of a shortcode';
}
add_shortcode( 'vendors', 'luv_Display_Vendor_Details' );

?>

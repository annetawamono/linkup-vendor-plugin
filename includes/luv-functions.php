<?php

/*
 * Adds top level menu link to the ACP
 */

function luv_Add_Admin_Link() {
//todo: make plugin page
  add_menu_page(
    'Link Up Vendors', //Title
    'Link Up Vendors Settings', //Text to show on menu link
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
		'Preview Information', // title
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
  $phone_number = get_post_meta( $post->ID, 'phone_number', true );
  $email = get_post_meta( $post->ID, 'email', true );
  $address = get_post_meta( $post->ID, 'address', true );
  $website = get_post_meta( $post->ID, 'website', true );

	// nonce, actually I think it is not necessary here
	wp_nonce_field( plugin_basename(__FILE__), 'luv_nonce' );

	echo '<table class="luv-meta">
		<tbody>
			<tr class="luv-metabox">
				<th><label for="seo_title" class="luv-metabox__label">SEO title</label></th>
				<td><input type="text" id="seo_title" name="seo_title" value="' . esc_attr( $seo_title ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="phone_number" class="luv-metabox__label">Phone number</label></th>
				<td><input type="tel" id="phone_number" name="phone_number" value="' . esc_attr( $phone_number ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="email" class="luv-metabox__label">Email</label></th>
				<td><input type="email" id="email" name="email" value="' . esc_attr( $email ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="address" class="luv-metabox__label">Address</label></th>
				<td><input type="text" id="address" name="address" value="' . esc_attr( $address ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="website" class="luv-metabox__label">Website</label></th>
				<td><input type="text" id="website" name="website" value="' . esc_attr( $website ) . '" class="luv-metabox__input"></td>
			</tr>
		</tbody>
	</table>';

}

/*
 * Meta box error handling
 */

 function luv_handle_meta_errors() {
   // if theres no errors, then exit function
   if (!($errors = get_transient('settings_errors'))) {
     return;
   }

   // otherwise build the list of errors that exist in the settings errors
   $message = '<div class="luv-error-message error below-h2"><ul>';
   foreach ($errors as $error) {
     $message .= '<li>' . $error['message'] . '</li>';
   }
   $message .= '</ul></div><!- #error ->';

   echo $message;

   // unhooking so that duplicate messages don't show up
   remove_action('admin_notices', 'luv_handle_meta_errors');

 }

 add_action('admin_notices', 'luv_handle_meta_errors');

 function luv_meta_error($slug, $err) {
   add_settings_error($slug, $slug, $err, 'error');
   set_transient('settings_errors', get_settings_errors(), 0);
 }

/*
 * Save meta boxes
 */

function luv_save_meta( $post_id, $post ) {

	// nonce check
	if ( ! isset( $_POST[ 'luv_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'luv_nonce' ], plugin_basename(__FILE__) ) ) {
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

  // check if post is vendor type
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

  if( isset( $_POST[ 'phone_number' ] ) ) {
		update_post_meta( $post_id, 'phone_number', sanitize_text_field( $_POST[ 'phone_number' ] ) );
	} else {
		delete_post_meta( $post_id, 'phone_number' );
	}

  // form validation for email address
  if( isset( $_POST[ 'email' ] ) && $_POST[ 'email' ] != '' ) {
    if (!(is_email( $_POST[ 'email' ] ))) {
      luv_meta_error('invalid_email', "Error in Vendor: " . $post->post_title . ". Your email address isn't valid. Please enter a valid email.");
      delete_post_meta( $post_id, 'email' );
    } else {
      update_post_meta( $post_id, 'email', sanitize_email( $_POST[ 'email' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'email' );
    delete_transient('settings_errors');
	}

  if( isset( $_POST[ 'address' ] ) ) {
		update_post_meta( $post_id, 'address', sanitize_text_field( $_POST[ 'address' ] ) );
	} else {
		delete_post_meta( $post_id, 'address' );
	}

  // form validation for website URL
  if( isset( $_POST[ 'website' ] ) && $_POST[ 'website' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'website' ] ))) {
      luv_meta_error('invalid_website', "Error in Vendor: " . $post->post_title . ". Your website URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'website' );
    } else {
      update_post_meta( $post_id, 'website', sanitize_text_field( $_POST[ 'website' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'website' );
    delete_transient('settings_errors');
	}

	return $post_id;
}
//don't know why but parameters 10 and 2 allow you to pass $post to the save function
 add_action( 'save_post', 'luv_save_meta', 10, 2 );

/*
 * Create shortcode for displaying vendor details in alphabetized list and in their categories
 */
function luv_Display_Vendor_Details() {
  //todo: output a loop of all the vendors here
  //todo: use tax_query arg to group vendors
  //todo: use order & orderby parameters for alphabetization
  //todo: use esc_url_raw() to output website url
  //return 'This is an example of a shortcode';
  $args = array( 'post_type' => 'vendors' );
  $the_query = new WP_QUery( $args );

  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <h2 class="vendors-sc-title"><?php the_title() ?></h2>
    <div class="vendors-sc-meta"><?php the_meta() ?></div>
  <?php
  endwhile;
  endif;
  wp_reset_postdata();
}
add_shortcode( 'vendors', 'luv_Display_Vendor_Details' );

?>

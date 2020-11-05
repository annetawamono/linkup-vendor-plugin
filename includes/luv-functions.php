<?php

/**
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

/**
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
      // 'taxonomies' => array( 'vendor categories' ),
      'register_meta_box_cb' => 'luv_Create_Meta_Boxes',
    )
  );
}
add_action( 'init', 'luv_Create_Vendor_Posttype' );

/**
 * Create meta boxes for vendors
 */

function luv_Create_Meta_Boxes() {
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

/**
 * Meta box callbacks
 */

 function luv_metabox_callback( $post ) {
   //doing: add additional links metaboxes

  $phone_number = get_post_meta( $post->ID, 'phone_number', true );
  $email = get_post_meta( $post->ID, 'email', true );
  $address = get_post_meta( $post->ID, 'address', true );
  $website = get_post_meta( $post->ID, 'website', true );

  $addlink1 = get_post_meta( $post->ID, 'addlink1', true );
  $addlink1text = get_post_meta( $post->ID, 'addlink1text', true );
  $addlink2 = get_post_meta( $post->ID, 'addlink2', true );
  $addlink2text = get_post_meta( $post->ID, 'addlink2text', true );
  $addlink3 = get_post_meta( $post->ID, 'addlink3', true );
  $addlink3text = get_post_meta( $post->ID, 'addlink3text', true );
  $facebook = get_post_meta( $post->ID, 'facebook', true );
  $twitter = get_post_meta( $post->ID, 'twitter', true );
  $instagram = get_post_meta( $post->ID, 'instagram', true );
  $youtube = get_post_meta( $post->ID, 'youtube', true );

  $notes = get_post_meta( $post->ID, 'notes', true );
  $see_more = get_post_meta( $post->ID, 'see_more', true );

	// nonce, actually I think it is not necessary here
	wp_nonce_field( plugin_basename(__FILE__), 'luv_nonce' );

	echo '<table class="luv-meta">
		<tbody>
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
				<th><label for="website" class="luv-metabox__label">Website URL</label></th>
				<td><input type="text" id="website" name="website" value="' . esc_attr( $website ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="addlink1text" class="luv-metabox__label">Additional link 1 text</label></th>
				<td><input type="text" id="addlink1text" name="addlink1text" value="' . esc_attr( $addlink1text ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="addlink1" class="luv-metabox__label">Additional link 1 URL</label></th>
				<td><input type="text" id="addlink1" name="addlink1" value="' . esc_attr( $addlink1 ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="addlink2text" class="luv-metabox__label">Additional link 2 text</label></th>
				<td><input type="text" id="addlink2text" name="addlink2text" value="' . esc_attr( $addlink2text ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="addlink2" class="luv-metabox__label">Additional link 2 URL</label></th>
				<td><input type="text" id="addlink2" name="addlink2" value="' . esc_attr( $addlink2 ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="addlink3text" class="luv-metabox__label">Additional link 3 text</label></th>
				<td><input type="text" id="addlink3text" name="addlink3text" value="' . esc_attr( $addlink3text ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="addlink3" class="luv-metabox__label">Additional link 3 URL</label></th>
				<td><input type="text" id="addlink3" name="addlink3" value="' . esc_attr( $addlink3 ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="website" class="luv-metabox__label">Notes</label></th>
				<td><textarea id="notes" name="notes" class="luv-metabox__input">' . esc_textarea( $notes ) . '</textarea></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="facebook" class="luv-metabox__label">Facebook</label></th>
				<td><input type="text" id="facebook" name="facebook" value="' . esc_attr( $facebook ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="twitter" class="luv-metabox__label">Twitter</label></th>
				<td><input type="text" id="twitter" name="twitter" value="' . esc_attr( $twitter ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="instagram" class="luv-metabox__label">Instagram</label></th>
				<td><input type="text" id="instagram" name="instagram" value="' . esc_attr( $instagram ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th><label for="youtube" class="luv-metabox__label">Youtube</label></th>
				<td><input type="text" id="youtube" name="youtube" value="' . esc_attr( $youtube ) . '" class="luv-metabox__input"></td>
			</tr>
      <tr class="luv-metabox">
				<th>Include a link to vendor page?</th>
			</tr>
      <tr class="luv-metabox">
        <td><input type="radio" id="see_more_yes" name="see_more" value="Yes" class="luv-metabox__input" ' . checked( $see_more, 'Yes', false ) . '><label for="see_more_yes">Yes</label></td>
        <td><input type="radio" id="see_more_no" name="see_more" value="No" class="luv-metabox__input" ' . checked( $see_more, 'No', false ) . '><label for="see_more_no">No</label></td>
      </tr>
		</tbody>
	</table>';

}

/**
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

/**
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


  if( isset( $_POST[ 'addlink1text' ] ) ) {
		update_post_meta( $post_id, 'addlink1text', sanitize_text_field( $_POST[ 'addlink1text' ] ) );
	} else {
		delete_post_meta( $post_id, 'addlink1text' );
	}

  // form validation for additional link 1 URL
  if( isset( $_POST[ 'addlink1' ] ) && $_POST[ 'addlink1' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'addlink1' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your additional link URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'addlink1' );
    } else {
      update_post_meta( $post_id, 'addlink1', sanitize_text_field( $_POST[ 'addlink1' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'addlink1' );
    delete_transient('settings_errors');
	}

  if( isset( $_POST[ 'addlink2text' ] ) ) {
		update_post_meta( $post_id, 'addlink2text', sanitize_text_field( $_POST[ 'addlink2text' ] ) );
	} else {
		delete_post_meta( $post_id, 'addlink2text' );
	}

  // form validation for additional link 2 URL
  if( isset( $_POST[ 'addlink2' ] ) && $_POST[ 'addlink2' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'addlink2' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your additional link URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'addlink2' );
    } else {
      update_post_meta( $post_id, 'addlink2', sanitize_text_field( $_POST[ 'addlink2' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'addlink2' );
    delete_transient('settings_errors');
	}

  if( isset( $_POST[ 'addlink3text' ] ) ) {
		update_post_meta( $post_id, 'addlink3text', sanitize_text_field( $_POST[ 'addlink3text' ] ) );
	} else {
		delete_post_meta( $post_id, 'addlink3text' );
	}

  // form validation for additional link 3 URL
  if( isset( $_POST[ 'addlink3' ] ) && $_POST[ 'addlink3' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'addlink3' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your additional link URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'addlink3' );
    } else {
      update_post_meta( $post_id, 'addlink3', sanitize_text_field( $_POST[ 'addlink3' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'addlink3' );
    delete_transient('settings_errors');
	}

  // form validation for facebook URL
  if( isset( $_POST[ 'facebook' ] ) && $_POST[ 'facebook' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'facebook' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your facebook URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'facebook' );
    } else {
      update_post_meta( $post_id, 'facebook', sanitize_text_field( $_POST[ 'facebook' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'facebook' );
    delete_transient('settings_errors');
	}

  // form validation for twitter URL
  if( isset( $_POST[ 'twitter' ] ) && $_POST[ 'twitter' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'twitter' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your twitter URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'twitter' );
    } else {
      update_post_meta( $post_id, 'twitter', sanitize_text_field( $_POST[ 'twitter' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'twitter' );
    delete_transient('settings_errors');
	}

  // form validation for instagram URL
  if( isset( $_POST[ 'instagram' ] ) && $_POST[ 'instagram' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'instagram' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your instagram URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'instagram' );
    } else {
      update_post_meta( $post_id, 'instagram', sanitize_text_field( $_POST[ 'instagram' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'instagram' );
    delete_transient('settings_errors');
	}

  // form validation for youtube URL
  if( isset( $_POST[ 'youtube' ] ) && $_POST[ 'youtube' ] != '' ) {
    if(!(wp_http_validate_url( $_POST[ 'youtube' ] ))) {
      luv_meta_error('invalid_url', "Error in Vendor: " . $post->post_title . ". Your youtube URL isn't valid. Please enter a valid URL.");
      delete_post_meta( $post_id, 'youtube' );
    } else {
      update_post_meta( $post_id, 'youtube', sanitize_text_field( $_POST[ 'youtube' ] ) );
      delete_transient('settings_errors');
    }
	} else {
		delete_post_meta( $post_id, 'youtube' );
    delete_transient('settings_errors');
	}

  if( isset( $_POST[ 'notes' ] ) ) {
		update_post_meta( $post_id, 'notes', sanitize_textarea_field( $_POST[ 'notes' ] ) );
	} else {
		delete_post_meta( $post_id, 'notes' );
	}

  if( isset( $_POST[ 'see_more' ] ) ) {
		update_post_meta( $post_id, 'see_more', sanitize_html_class( $_POST[ 'see_more' ] ) );
	} else {
		delete_post_meta( $post_id, 'see_more' );
	}

	return $post_id;
}
//don't know why but parameters 10 and 2 allow you to pass $post to the save function
 add_action( 'save_post', 'luv_save_meta', 10, 2 );


 /**
  * Custom Vendor Taxonomy
  */

  // Register Custom Taxonomy
  function luv_Create_Vendor_Taxonomy() {

  	$labels = array(
  		'name'                       => 'Vendor Categories',
  		'singular_name'              => 'Vendor Category',
  		'menu_name'                  => 'Vendor Categories',
  		'all_items'                  => 'All Vendor Categories',
  		'parent_item'                => 'Parent Vendor Category',
  		'parent_item_colon'          => 'Parent Vendor Category:',
  		'new_item_name'              => 'New Vendor Category Name',
  		'add_new_item'               => 'Add New Vendor Category',
  		'edit_item'                  => 'Edit Vendor Category',
  		'update_item'                => 'Update Vendor Category',
  		'view_item'                  => 'View Vendor Category',
  		'separate_items_with_commas' => 'Separate Vendor Categories with commas',
  		'add_or_remove_items'        => 'Add or remove Vendor Categories',
  		'choose_from_most_used'      => 'Choose from the most used',
  		'popular_items'              => 'Popular Vendor Categories',
  		'search_items'               => 'Search Vendor Categories',
  		'not_found'                  => 'Not Found',
  		'no_terms'                   => 'No Vendor Categories',
  		'items_list'                 => 'Vendor Categories list',
  		'items_list_navigation'      => 'Vendor Categories list navigation',
  	);
  	$args = array(
  		'labels'                     => $labels,
  		'hierarchical'               => true,
  		'public'                     => true,
  		'show_ui'                    => true,
  		'show_admin_column'          => true,
  		'show_in_nav_menus'          => true,
  		'show_tagcloud'              => true,
  		'show_in_rest'               => true,
  	);
  	register_taxonomy( 'vendors-vendor-categories', array( 'vendors' ), $args );

  }
  add_action( 'init', 'luv_Create_Vendor_Taxonomy', 0 );

/**
 * Create shortcode for displaying vendor details in alphabetized list and in their categories
 */

function luv_Display_Vendor_Details() {
  //doing: vendor page styling
  //todo: use esc_url_raw() to output website url
  //todo: see more link for vendors with that option checked

  // testing category separation

  $args2 = array(
    'taxonomy' => 'vendors-vendor-categories',
    'orderby' => 'name',
    'order' => 'ASC',
  );

  $cats = get_categories($args2);

  foreach ($cats as $cat) {
    ?>
      <div class="luv-container">
        <div class="luv-category-title">
          <h2><?php echo $cat->name; ?></h2>
        </div>
        <div class="luv-vendors">
        <?php
          luv_Display_Vendor_By_Category($cat->term_id);
        ?>
        </div>
      </div>
    <?php
  }

  // echo count($cats) . "testing cats. the slug " . $cats[0]->term_id;
}
add_shortcode( 'vendors', 'luv_Display_Vendor_Details' );

 /**
  * Create shortcode for displaying vendor details in alphabetized list and in their categories
  *
  * @param integer $term_id Taxonomy term ID
  * @return void
  */

function luv_Display_Vendor_By_Category($term_id) {
  $args = array(
    'post_type' => 'vendors',
    'tax_query' => array(
      array(
        'taxonomy' => 'vendors-vendor-categories',
        'terms' => $term_id,
      ),
    ),
    'orderby' => 'title',
    'order' => 'ASC',
  );
  $the_query = new WP_QUery( $args );

  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <div class="luv-vendor">
      <div class="luv-vendor__image">
        <?php echo get_the_post_thumbnail( get_the_ID() ); ?>
      </div>
      <div class="luv-vendor__details">
        <h3 class="luv-vendor__details__title"><?php the_title() ?></h3>
        <?php
          // getting individual post meta
          echo wpautop( esc_html( get_post_meta( get_the_ID(), 'notes', true ) ) );
        ?>
        <address>

          <?php if($pn = get_post_meta( get_the_ID(), 'phone_number', true )): ?>
            <p class="luv-vendor__details__phone">Phone:</p>
            <p><a href="tel:<?php echo esc_html( $pn ); ?>">
              <?php
                echo esc_html( $pn );
              ?>
            </a></p>
          <?php endif ?>

          <?php if($email = get_post_meta( get_the_ID(), 'email', true )): ?>
            <p class="luv-vendor__details__email">Email:</p>
            <p><a href="mailto:<?php echo antispambot( $email ); ?>">
              <?php
                echo antispambot( $email );
              ?>
            </a></p>
          <?php endif ?>

          <?php if($address = get_post_meta( get_the_ID(), 'address', true )): ?>
            <p class="luv-vendor__details__address">Address:</p>
            <?php
              // getting individual post meta
              echo wpautop( $address );
            ?>
          <?php endif ?>

          <?php
            $website = get_post_meta( get_the_ID(), 'website', true );
            $addlink1 = get_post_meta( get_the_ID(), 'addlink1', true );
            $addlink2 = get_post_meta( get_the_ID(), 'addlink2', true );
            $addlink3 = get_post_meta( get_the_ID(), 'addlink3', true );
            $facebook = get_post_meta( get_the_ID(), 'facebook', true ) ;
            $twitter = get_post_meta( get_the_ID(), 'twitter', true );
            $instagram = get_post_meta( get_the_ID(), 'instagram', true );
            $youtube = get_post_meta( get_the_ID(), 'youtube', true );
           ?>

          <?php if(
            $website || $addlink1 || $addlink2 || $addlink3 || $facebook || $twitter || $instagram || $youtube
            ): ?>

            <p class="luv-vendor__details__email">Our Links:</p>
            <?php if($website): ?>
              <p><a href="<?php echo esc_url( $website ); ?>">
                Website
              </a></p>
            <?php endif ?>

            <?php if($addlink1): ?>
              <p><a href="<?php echo esc_url( $addlink1 ); ?>">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'addlink1text', true ) ); ?>
              </a></p>
            <?php endif ?>

            <?php if($addlink2): ?>
              <p><a href="<?php echo esc_url( $addlink2 ); ?>">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'addlink2text', true ) ); ?>
              </a></p>
            <?php endif ?>

            <?php if($addlink3): ?>
              <p><a href="<?php echo esc_url( $addlink3 ); ?>">
                <?php echo esc_html( get_post_meta( get_the_ID(), 'addlink3text', true ) ); ?>
              </a></p>
            <?php endif ?>

            <?php if($facebook): ?>
              <p><a href="<?php echo esc_url( $facebook ); ?>">
                Facebook
              </a></p>
            <?php endif ?>

            <?php if($twitter): ?>
              <p><a href="<?php echo esc_url( $twitter ); ?>">
                Twitter
              </a></p>
            <?php endif ?>

            <?php if($instagram): ?>
              <p><a href="<?php echo esc_url( $instagram ); ?>">
                Instagram
              </a></p>
            <?php endif ?>

            <?php if($youtube): ?>
              <p><a href="<?php echo esc_url( $youtube ); ?>">
                Youtube
              </a></p>
            <?php endif ?>

          <?php endif ?>

          <?php if( get_post_meta( get_the_ID(), 'see_more', true ) == 'Yes' ): ?>
            <p><a href="<?php echo esc_url( get_permalink(get_the_ID()) ); ?>">
              See more
            </a></p>
          <?php endif ?>

      </address>
      </div>
    </div>
  <?php
  endwhile;
  endif;
  wp_reset_postdata();
}

?>

<?php
/**
 * The Work Custom Post Type
 *
 * Sets up the custom post type
 */

//Hook into the init action and call create_work_cpt when it fires
add_action( 'init', 'create_work_cpt' );

/**
 * Create the Work Custom Post Type
 *
 */
 function create_work_cpt(){
     $labels = array(
         'name' => _x( 'Work', 'works','custom' ),
         'singular_name' => _x( 'Work', 'works', 'custom' ),
         'add_new' => _x( 'Add New Work', 'works', 'custom' ),
         'add_new_item' => _x( 'Add New Work', 'works', 'custom' ),
         'edit_item' => _x( 'Edit Work', 'works', 'custom' ),
         'new_item' => _x( 'New Work', 'works', 'custom' ),
         'view_item' => _x( 'View Work', 'works', 'custom' ),
         'search_items' => _x( 'Search Works', 'works', 'custom' ),
         'not_found' => _x( 'No Works found', 'works', 'custom' ),
         'not_found_in_trash' => _x( 'No Works found in Trash', 'works', 'custom' ),
         'parent_item_colon' => _x( 'Parent Work:', 'works', 'custom' ),
         'menu_name' => _x( 'Work', 'works', 'custom' ),
     );

     $args = array(
         'labels' => $labels,
         'hierarchical' => false,
         'description' => 'Creative Why Work',
         'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields','revisions', 'page-attributes' ),
         'show_ui' => true,
         'show_in_menu' => true,
         'menu_position' => 2,
         'show_in_nav_menus' => true,
         'publicly_queryable' => false,
         'exclude_from_search' => true,
         'query_var' => true,
         'can_export' => true,
         'rewrite' => false,
         'public' => false,
         'has_archive' => false,
         'capability_type' => 'post'
     );
     register_post_type( 'cw_work', $args );//max 20 charachter cannot contain capital letters and spaces
 }

  //Initialize Meta Boxes
  add_action( 'admin_init', 'cw_work_metabox_setup' );
  add_action('save_post', 'cw_save_data_work');


  /**
   * Setup Fields and Add The Metabox
   *
   * @since    1.0.0
   */
  function cw_work_metabox_setup(){
      global $prefix, $meta_box_work;

      $prefix = 'cw_';

      $meta_box_work = array(
  		'id' => 'cw-meta-box-work-settings',
  		'title' =>  __('Work Settings', 'creativewhy'),
  		'page' => 'cw_work',
  		'context' => 'normal',
  		'priority' => 'high',
  		'fields' => array(
            array(
                     'name' => __('Display Size', 'creativewhy'),
                     'desc' => __('Set the display size of the case study', 'creativewhy'),
                     'id' => $prefix . 'work_display_size',
                     'type' => 'select',
                     'std' => 'Normal',
                     'options' => array('Normal','Large'),
                 ),
            array(
          			'name' => __('Subtitle', 'creativewhy'),
          			'desc' => __('Add a complementary subtitle to this work', 'creativewhy'),
          			'id' => $prefix . 'work_subtitle',
          			'type' => 'text',
          			'std' => ''
          		 ),
            array(
                    'name' => __('Disable Additional Content', 'creativewhy'),
                    'desc' => __('Check to hide the additional Work content. This setting removes the clickable link and will only display the featured image', 'creativewhy'),
                    'id' => $prefix . 'disable_work_content',
                    'type' => 'checkbox',
                    'std' => 'no',
                ),


  		)
  	); //end Meta Box Array

     //Add the Meta Box
 	add_meta_box($meta_box_work['id'], $meta_box_work['title'], 'cw_show_work_info_box', $meta_box_work['page'], $meta_box_work['context'], $meta_box_work['priority']);

  }

  /**
   * Add Work settings metabox to work cpt page
   *
   * @since    1.0.0
   */
  function cw_show_work_info_box() {
      global $meta_box_work, $post;

  	echo '<p style="padding:10px 0 0 0;">'.__('Fill in additional information about your Work', 'creativewhy').'</p>';
  	// Use nonce for verification
  	echo '<input type="hidden" name="work_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  	echo '<table class="form-table">';

  	foreach ($meta_box_work['fields'] as $field) {
  		// get current post meta data
  		$meta = get_post_meta($post->ID, $field['id'], true);
  		switch ($field['type']) {


  			//If Text
  			case 'text':

  			echo '<tr style="border-top:1px solid #eeeeee;">',
  				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
  				'<td>';
  			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';

  			break;

  			//If textarea
  			case 'textarea':

  			echo '<tr style="border-top:1px solid #eeeeee;">',
  				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
  				'<td>';
  			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';

  			break;

            case 'checkbox':
                echo '<tr>',
                 	'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
                    '<td>'; ?>
                <input type="checkbox" name="<?php echo $field['id'];?>" id="<?php echo $field['id'];?>" value="yes" <?php if ( isset ( $meta ) ) checked( $meta, 'yes' ); ?> />
                <?php echo '</td>';
            break;

  			//If Select
  			case 'select':

  				echo '<tr>',
  				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
  				'<td>';

  				echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';

  				foreach ($field['options'] as $option) {

  					echo'<option';
  					if ($meta == $option ) {
  						echo ' selected="selected"';
  					}
  					echo'>'. $option .'</option>';

  				}

  				echo'</select>';

  			break;

  		}

  	}

  	echo '</table>';
  }

 /**
 * Saves Data When Post is Edited
 *
 * @since    1.0.0
 */
 function cw_save_data_work($post_id) {
  global $meta_box_work, $post_type;

  //Return if we're not on the custom work page
  if($post_type != 'cw_work')
      return;

  //Return if we're on the custom work page but the post hasn't been saved yet
  if($post_type == 'cw_work' && !isset($_POST['work_meta_box_nonce']) )
      return;

  // verify nonce
  if (isset($_POST['work_meta_box_nonce']) && !wp_verify_nonce($_POST['work_meta_box_nonce'], basename(__FILE__))) {
      return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $post_id;
  }

  // check permissions
  if ( $_POST && 'page' == $_POST['post_type']) {
      if (!current_user_can('edit_page', $post_id)) {
          return $post_id;
      }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  foreach ($meta_box_work['fields'] as $field) {
      $old = get_post_meta($post_id, $field['id'], true);
      $new = $_POST[$field['id']];

      if ($new && $new != $old) {
          update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
      } elseif ('' == $new && $old) {
          delete_post_meta($post_id, $field['id'], $old);
      }
  }



 }

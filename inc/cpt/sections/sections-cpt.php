<?php
/**
 * The Sections Custom Post Type
 *
 * Sets up the custom post type
 */

//Hook into the init action and call create_section_cpt when it fires
add_action( 'init', 'create_section_cpt' );

/**
 * Create the Sections Custom Post Type
 *
 * @since    1.0.0
 */
 function create_section_cpt(){
     $labels = array(
         'name' => _x( 'Sections', 'sections','custom' ),
         'singular_name' => _x( 'Section', 'sections', 'custom' ),
         'add_new' => _x( 'Add New Section', 'sections', 'custom' ),
         'add_new_item' => _x( 'Add New Section', 'sections', 'custom' ),
         'edit_item' => _x( 'Edit Section', 'sections', 'custom' ),
         'new_item' => _x( 'New Section', 'sections', 'custom' ),
         'view_item' => _x( 'View Section', 'sections', 'custom' ),
         'search_items' => _x( 'Search Sections', 'sections', 'custom' ),
         'not_found' => _x( 'No Sections found', 'sections', 'custom' ),
         'not_found_in_trash' => _x( 'No Sections found in Trash', 'sections', 'custom' ),
         'parent_item_colon' => _x( 'Parent Section:', 'sections', 'custom' ),
         'menu_name' => _x( 'Sections', 'sections', 'custom' ),
     );

     $args = array(
         'labels' => $labels,
         'hierarchical' => false,
         'description' => 'Website Sections',
         'supports' => array( 'title', 'editor', 'thumbnail','revisions', 'custom-fields', 'page-attributes' ),
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
     register_post_type( 'cw_sections', $args );//max 20 charachter cannot contain capital letters and spaces

 }

 //Initialize Meta Boxes
 add_action( 'admin_init', 'cw_sections_metabox_setup' );
 add_action('save_post', 'cw_save_data_sections');


 /**
  * Setup Fields and Add The Metabox
  *
  * @since    1.0.0
  */
 function cw_sections_metabox_setup(){
     global $prefix, $meta_box_sections;

     $prefix = 'cw_';

     $meta_box_sections = array(
 		'id' => 'cw-meta-box-sections-settings',
 		'title' =>  __('Section Settings', 'creativewhy'),
 		'page' => 'cw_sections',
 		'context' => 'normal',
 		'priority' => 'high',
 		'fields' => array(
            array(
                    'name' => __('Hide Section Title', 'creativewhy'),
                    'desc' => __('Check to hide the section title from view. Useful when you want to add a simple text section and add your own heading', 'creativewhy'),
                    'id' => $prefix . 'hide_section_title',
                    'type' => 'checkbox',
                    'std' => 'yes',
                ),
            array(
                    'name' => __('Image Orientation', 'creativewhy'),
                    'desc' => __('Select the orientation of the section for the section image. Use "None" when a featured image is not used.', 'creativewhy'),
                    'id' => $prefix . 'section_img_orientation',
                    'type' => 'select',
                    'std' => 'Left',
                    'options' => array('Left','Right', 'None'),
                ),
            array(
                    'name' => __('Hide Image on Mobile Devices', 'creativewhy'),
                    'desc' => __('Check to hide the section image on mobile. Recommended for images orientated to the right side', 'creativewhy'),
                    'id' => $prefix . 'hide_section_image',
                    'type' => 'checkbox',
                    'std' => 'no',
                ),
             array(
         			'name' => __('Image Heading', 'creativewhy'),
         			'desc' => __('Set the Heading for the image', 'creativewhy'),
         			'id' => $prefix . 'sections_img_heading',
         			'type' => 'text',
         			'std' => ''
         		),
             array(
         			'name' => __('Image Sub-Heading', 'creativewhy'),
         			'desc' => __('Set the sub-heading for the image', 'creativewhy'),
         			'id' => $prefix . 'sections_img_sub_heading',
         			'type' => 'text',
         			'std' => ''
         		)

 		)
 	); //end Meta Box Array

    //Add the Meta Box
	add_meta_box($meta_box_sections['id'], $meta_box_sections['title'], 'cw_show_sections_info_box', $meta_box_sections['page'], $meta_box_sections['context'], $meta_box_sections['priority']);

 }

 /**
  * Add image settings information metabox to sections cpt page
  *
  * @since    1.0.0
  */
 function cw_show_sections_info_box() {
     global $meta_box_sections, $post;

 	echo '<p style="padding:10px 0 0 0;">'.__('Customize the display of your Section', 'creativewhy').'</p>';
 	// Use nonce for verification
 	echo '<input type="hidden" name="section_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

 	echo '<table class="form-table">';

 	foreach ($meta_box_sections['fields'] as $field) {
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
function cw_save_data_sections($post_id) {
 global $meta_box_sections, $post_type;

 //Return if we're not on the custom sections page
 if($post_type != 'cw_sections')
     return;

 //Return if we're on the custom sections page but the post hasn't been saved yet
 if($post_type == 'cw_sections' && !isset($_POST['section_meta_box_nonce']) )
     return;

 // verify nonce
 if (isset($_POST['section_meta_box_nonce']) && !wp_verify_nonce($_POST['section_meta_box_nonce'], basename(__FILE__))) {
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

 foreach ($meta_box_sections['fields'] as $field) {
     $old = get_post_meta($post_id, $field['id'], true);
     $new = $_POST[$field['id']];

     if ($new && $new != $old) {
         update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
     } elseif ('' == $new && $old) {
         delete_post_meta($post_id, $field['id'], $old);
     }
 }



}

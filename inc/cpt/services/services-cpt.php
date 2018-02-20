<?php
/**
 * The Services Custom Post Type
 *
 * Sets up the custom post type
 */

//Hook into the init action and call create_services_cpt when it fires
add_action( 'init', 'create_services_cpt' );

/**
 * Create the Services Custom Post Type
 *
 */
 function create_services_cpt(){
     $labels = array(
         'name' => _x( 'Services', 'services','custom' ),
         'singular_name' => _x( 'Service', 'services', 'custom' ),
         'add_new' => _x( 'Add New Service', 'services', 'custom' ),
         'add_new_item' => _x( 'Add New Service', 'services', 'custom' ),
         'edit_item' => _x( 'Edit Service', 'services', 'custom' ),
         'new_item' => _x( 'New Service', 'services', 'custom' ),
         'view_item' => _x( 'View Service', 'services', 'custom' ),
         'search_items' => _x( 'Search Service', 'services', 'custom' ),
         'not_found' => _x( 'No Services found', 'services', 'custom' ),
         'not_found_in_trash' => _x( 'No Services found in Trash', 'services', 'custom' ),
         'parent_item_colon' => _x( 'Parent Service:', 'services', 'custom' ),
         'menu_name' => _x( 'Services', 'services', 'custom' ),
     );

     $args = array(
         'labels' => $labels,
         'hierarchical' => false,
         'description' => 'Creative Why Services',
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
     register_post_type( 'cw_services', $args );//max 20 charachter cannot contain capital letters and spaces
 }

 //Initialize Meta Boxes
 add_action( 'admin_init', 'cw_services_metabox_setup' );
 add_action('save_post', 'cw_save_data_services');


 /**
  * Setup Fields and Add The Metabox
  *
  * @since    1.0.0
  */
 function cw_services_metabox_setup(){
     global $prefix, $meta_box_services;

     $prefix = 'cw_';

     $meta_box_services = array(
       'id' => 'cw-meta-box-services-settings',
       'title' =>  __('services Settings', 'creativewhy'),
       'page' => 'cw_services',
       'context' => 'normal',
       'priority' => 'high',
       'fields' => array(
           array(
                   'name' => __('Service Icon', 'creativewhy'),
                   'desc' => __('Enter the URL for your icon', 'creativewhy'),
                   'id' => $prefix . 'services_icon',
                   'type' => 'text',
                   'std' => ''
                )
       )
   ); //end Meta Box Array

    //Add the Meta Box
   add_meta_box($meta_box_services['id'], $meta_box_services['title'], 'cw_show_services_info_box', $meta_box_services['page'], $meta_box_services['context'], $meta_box_services['priority']);

 }

 /**
  * Add services settings metabox to services cpt page
  *
  * @since    1.0.0
  */
 function cw_show_services_info_box() {
     global $meta_box_services, $post;

   echo '<p style="padding:10px 0 0 0;">'.__('Fill in additional information about your services', 'creativewhy').'</p>';
   // Use nonce for verification
   echo '<input type="hidden" name="services_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

   echo '<table class="form-table">';

   foreach ($meta_box_services['fields'] as $field) {
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
function cw_save_data_services($post_id) {
 global $meta_box_services, $post_type;

 //Return if we're not on the custom services page
 if($post_type != 'cw_services')
     return;

 //Return if we're on the custom services page but the post hasn't been saved yet
 if($post_type == 'cw_services' && !isset($_POST['services_meta_box_nonce']) )
     return;

 // verify nonce
 if (isset($_POST['services_meta_box_nonce']) && !wp_verify_nonce($_POST['services_meta_box_nonce'], basename(__FILE__))) {
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

 foreach ($meta_box_services['fields'] as $field) {
     $old = get_post_meta($post_id, $field['id'], true);
     $new = $_POST[$field['id']];

     if ($new && $new != $old) {
         update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
     } elseif ('' == $new && $old) {
         delete_post_meta($post_id, $field['id'], $old);
     }
 }



}

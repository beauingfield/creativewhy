<?php
/**
 * The Team Custom Post Type
 *
 * Sets up the custom post type
 */

//Hook into the init action and call create_team_cpt when it fires
add_action( 'init', 'create_team_cpt' );

/**
 * Create the Team Custom Post Type
 *
 */
 function create_team_cpt(){
     $labels = array(
         'name' => _x( 'Team Members', 'teams','custom' ),
         'singular_name' => _x( 'Team Member', 'teams', 'custom' ),
         'add_new' => _x( 'Add New Team Member', 'teams', 'custom' ),
         'add_new_item' => _x( 'Add New Team Member', 'teams', 'custom' ),
         'edit_item' => _x( 'Edit Team Member', 'teams', 'custom' ),
         'new_item' => _x( 'New Team Member', 'teams', 'custom' ),
         'view_item' => _x( 'View Team Member', 'teams', 'custom' ),
         'search_items' => _x( 'Search Team Members', 'teams', 'custom' ),
         'not_found' => _x( 'No Team Members found', 'teams', 'custom' ),
         'not_found_in_trash' => _x( 'No Team Members found in Trash', 'teams', 'custom' ),
         'parent_item_colon' => _x( 'Parent Team Member:', 'teams', 'custom' ),
         'menu_name' => _x( 'Team', 'teams', 'custom' ),
     );

     $args = array(
         'labels' => $labels,
         'hierarchical' => false,
         'description' => 'Creative Why Team Members',
         'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ),
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
     register_post_type( 'cw_team', $args );//max 20 charachter cannot contain capital letters and spaces
 }

 //Initialize Meta Boxes
 add_action( 'admin_init', 'cw_team_metabox_setup' );
 add_action('save_post', 'cw_save_data_team');

 /**
  * Setup Fields and Add The Metabox
  *
  * @since    1.0.0
  */
 function cw_team_metabox_setup(){
     global $prefix, $meta_box_team, $meta_box_team_social;

     $prefix = 'cw_';

     $meta_box_team = array(
 		'id' => 'cw-meta-box-team-settings',
 		'title' =>  __('Team Member Info', 'creativewhy'),
 		'page' => 'cw_team',
 		'context' => 'normal',
 		'priority' => 'high',
 		'fields' => array(
             array(
         			'name' => __('Job title', 'creativewhy'),
         			'desc' => __('Set Job Title for this team member', 'creativewhy'),
         			'id' => $prefix . 'team_job_title',
         			'type' => 'text',
         			'std' => ''
         		)

 		)
 	); //end Meta Box Array

    $meta_box_team_social = array(
       'id' => 'cw-meta-box-team-social-settings',
       'title' =>  __('Team Member Social Media', 'creativewhy'),
       'page' => 'cw_team',
       'context' => 'normal',
       'priority' => 'high',
       'fields' => array(
            array(
                   'name' => __('Facebook Username', 'creativewhy'),
                   'desc' => __('Enter in the team members Facebook Username', 'creativewhy'),
                   'id' => $prefix . 'team_facebook',
                   'type' => 'text',
                   'std' => ''
               ),
            array(
                   'name' => __('Instagram Username', 'creativewhy'),
                   'desc' => __('Enter in the team members Instagram Username', 'creativewhy'),
                   'id' => $prefix . 'team_instagram',
                   'type' => 'text',
                   'std' => ''
               ),
            array(
                   'name' => __('LinkedIn Profile ID', 'creativewhy'),
                   'desc' => __('LinkedIn profile URLs are a little funky but we just need your profile ID. i.e www.linkedin.com/in/PROFILE_ID', 'creativewhy'),
                   'id' => $prefix . 'team_linkedin',
                   'type' => 'text',
                   'std' => ''
               ),
            array(
                   'name' => __('Medium Username', 'creativewhy'),
                   'desc' => __('Enter in the team members medium username', 'creativewhy'),
                   'id' => $prefix . 'team_medium',
                   'type' => 'text',
                   'std' => ''
               ),
            array(
                   'name' => __('Twitter Username', 'creativewhy'),
                   'desc' => __('Enter in the team members twitter username', 'creativewhy'),
                   'id' => $prefix . 'team_twitter',
                   'type' => 'text',
                   'std' => ''
               )

       )
   ); //end Meta Box Array

    //Add the Meta Box
	add_meta_box($meta_box_team['id'], $meta_box_team['title'], 'cw_show_team_info_box', $meta_box_team['page'], $meta_box_team['context'], $meta_box_team['priority']);
	add_meta_box($meta_box_team_social['id'], $meta_box_team_social['title'], 'cw_show_team_social_box', $meta_box_team_social['page'], $meta_box_team_social['context'], $meta_box_team_social['priority']);

 }

 /**
  * Add team member information metabox to team cpt page
  *
  * @since    1.0.0
  */
 function cw_show_team_info_box() {
     global $meta_box_team, $post;

 	echo '<p style="padding:10px 0 0 0;">'.__('Team Member Information', 'creativewhy').'</p>';
 	// Use nonce for verification
 	echo '<input type="hidden" name="section_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

 	echo '<table class="form-table">';

 	foreach ($meta_box_team['fields'] as $field) {
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
 * Add team member social media metabox to team cpt page
 *
 * @since    1.0.0
 */
function cw_show_team_social_box() {
    global $meta_box_team_social, $post;

   echo '<p style="padding:10px 0 0 0;">'.__('Fill in the areas below with just the social media Username/ID/Handle. We will take care of populating the URL automagically', 'creativewhy').'</p>';
   // Use nonce for verification
   echo '<input type="hidden" name="section_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

   echo '<table class="form-table">';

   foreach ($meta_box_team_social['fields'] as $field) {
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
function cw_save_data_team($post_id) {
 global $meta_box_team, $meta_box_team_social, $post_type;

 //Return if we're not on the custom team page
 if($post_type != 'cw_team')
     return;

 //Return if we're on the custom team page but the post hasn't been saved yet
 if($post_type == 'cw_team' && !isset($_POST['section_meta_box_nonce']) )
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

 foreach ($meta_box_team['fields'] as $field) {
     $old = get_post_meta($post_id, $field['id'], true);
     $new = $_POST[$field['id']];

     if ($new && $new != $old) {
         update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
     } elseif ('' == $new && $old) {
         delete_post_meta($post_id, $field['id'], $old);
     }
 }

 foreach ($meta_box_team_social['fields'] as $field) {
     $old = get_post_meta($post_id, $field['id'], true);
     $new = $_POST[$field['id']];

     if ($new && $new != $old) {
         update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
     } elseif ('' == $new && $old) {
         delete_post_meta($post_id, $field['id'], $old);
     }
 }



}

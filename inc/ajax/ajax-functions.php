<?php
/**
  * Creative Why AJAX Functions. Includes AJAX functions to assist with the front end
  *
  * @package CreativeWhy
  * @subpackage Includes/Ajax/Ajax Functions
  * @copyright Copyright (c) 2016, Creative Why
  * @since 0.0.1
  */


/**
 * Adds the AJAX script to the footer for checking the username
 *
 * @since 0.0.1
 */
 function cw_get_work_js(){
   ?>

     <script>
        jQuery( document ).ready(function($) {
            //The Work Modal

            jQuery('.work-anchor').on('click', function() {
            var workID = jQuery(this).attr('data-work-id');

            //check if the modal exists already
            if (jQuery("#modal-"+workID).length){
                //get the element
                var modal = jQuery("#modal-"+workID);
                //- Now, try to open it
                modal.foundation('open');
            }
            else{
                var modal = jQuery('<div id="modal-'+workID+'" class="large reveal" data-reveal data-reset-on-close="true" data-animation-in="fade-in" data-animation-out="fade-out"><button class="close-button" data-close aria-label="Close reveal" type="button"><span aria-hidden="true">&times;</span></button></div>');
                //- append it to [body] ahead of time
                jQuery('body').append(modal);

                //- re-invoke foundation
                jQuery(document).foundation();

                //- re-bind events
                //bindRevealEvents();

                //- Now, try to open it
                modal.foundation('open');

                jQuery.ajax({
                    url : '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                    type: "POST",
                    data: {'action': 'get_work', work_id: workID},
                    dataType: "json",
                    success: function(response) {
                        var cw_work_title = response.title;
                        var cw_work_content = response.content;

                      //  modal.open();
                        jQuery("#modal-"+workID).append( "<div class='modal-"+workID+"-content-wrapper'></div>" );
                        jQuery(".modal-"+workID+"-content-wrapper").append('<div class="work-title"><h4>'+cw_work_title+'</h4></div>');
                        jQuery(".modal-"+workID+"-content-wrapper").append('<div class="work-content">'+cw_work_content+'</div>');


                      }
                });
            }


            return false;
        });


          });
    </script>
<?php
 }

 add_action( 'wp_footer', 'cw_get_work_js' ); //hook iquue_check_username_js to the footer


/**
 * Queries the Case Study content to display in the modal
 *
 * @since 0.0.1
 */
 function cw_get_work(){
     $response = array();
     $work_id = sanitize_text_field($_POST['work_id']);
     //The Work loop
     $single_work = array(
                 'post_type' => 'cw_work',
                 'p'   => $work_id,
             );

     $single_work_query = new WP_Query( $single_work ); //pass the args into the query

     if ( $single_work_query->have_posts() ) {
         while ( $single_work_query->have_posts() ) {
             $single_work_query->the_post(); //setup post and retrieve the next post
             $single_work_ID = get_the_ID();
             $single_work_title = get_the_title();
             $response['title'] = $single_work_title;

             //Store the_content() and pass through to the front end. We do this because we want the content to pass through the filtering
             // to maintain the embedded videos and HTML formatting
             ob_start();
             the_content();
             $single_work_content = ob_get_clean();
             $response['content'] = $single_work_content;
         }
     }

     wp_reset_postdata(); //clean up after ourselves

     echo json_encode($response);

     die();
 }

   add_action('wp_ajax_nopriv_get_work', 'cw_get_work');
   add_action('wp_ajax_get_work', 'cw_get_work');

<?php
/**
 * The Shortcode to display the work area.
 *
 *
 * @package creativewhy
 */


/**
 * Setup the work shortcode
 *
 */
function cw_work_shortcode(){

  ob_start();
  cw_work();
  return ob_get_clean();

}

/**
 * Displays the work section when the shortcode is called
 *
 */
function cw_work(){

    //The Work loop
    $work_args = array(
                'post_type' => 'cw_work',
                'orderby'   => 'date title',
                'order'   => 'DESC',
                'posts_per_page' => 20
            );

    $work_query = new WP_Query( $work_args ); //pass the args into the query

    //begin the work section
    echo '<div id="work-grid" class="grid-container">';
    echo '<div class="grid-item work-tile grid-sizer" style="position: absolute; left: 0%; top: 0px;"></div>';
    if ( $work_query->have_posts() ) {
        while ( $work_query->have_posts() ) {
            $work_query->the_post(); //setup post and retrieve the next post

            $workID = get_the_ID();
            $work_name = get_the_title();
            $work_slug = sanitize_title($work_name);
            $work_img_id = 0; //let's clear this out at first
            $work_img_url = '';
            $work_img_alt = '';

            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                $work_img_id = get_post_thumbnail_id( $workID );
                $work_img_alt = get_post_meta($work_img_id, '_wp_attachment_image_alt', true);
                $work_img_url = get_the_post_thumbnail_url( $workID ); //store the url for use
            }

            //get the work metadata
            $work_display_size_key = 'cw_work_display_size';
            $work_subtitle_key = 'cw_work_subtitle';
            $disable_work_content_key = 'cw_disable_work_content';

            $work_display_size = get_post_meta( $workID, $work_display_size_key, true );
            $work_subtitle = get_post_meta( $workID, $work_subtitle_key, true );
            $disable_work_content = get_post_meta ( $workID, $disable_work_content_key, true );


            if($work_display_size == 'Large'){
                $work_display_class = 'grid-item-lg';
            }
            else{
                $work_display_class = 'grid-item-basic';
            }

        if( $disable_work_content ){  //if the work content is disabled we only want to display the featured image
            // work item
            echo '  <div id="work-disabled" class="grid-item '.$work_display_class.' work-tile" style="position: absolute; left: 0%; top: 0px;">
                        <img src="/wp-content/uploads/2016/09/creative-why-spacer.gif" class="spacer">
                        <div class="grid-item-inner"><img src="'.$work_img_url.'" class="work-photo"></div>
                        <span id="work-'.$work_slug.' " class="grid-item-overlay cw-overlay-team nav-ctrl work-hover">
                            <div class="work-tile-content">
                                <p class="work-title">'.$work_name.'</p>
                                <p class="work-subtitle">'.$work_subtitle.'</p>
                            </div>
                        </span>
                    </div> <!-- end #work-ID -->';
        }
        else{
            // work item
            echo '  <div id="work-'.$workID.'" class="grid-item '.$work_display_class.' work-tile" style="position: absolute; left: 0%; top: 0px;">
                        <img src="/wp-content/uploads/2016/09/creative-why-spacer.gif" class="spacer">
                        <div class="grid-item-inner"><img src="'.$work_img_url.'" class="work-photo"></div>
                        <a id="work-'.$work_slug.' " class="grid-item-overlay cw-overlay-team nav-ctrl work-hover work-anchor" data-work-id ="'.$workID.'">
                            <div class="work-tile-content">
                                <p class="work-title">'.$work_name.'</p>
                                <p class="work-subtitle">'.$work_subtitle.'</p>
                                <p class="button button-purple">Read More</p>
                            </div>
                        </a>
                    </div> <!-- end #work-ID -->';
        }



        }

    }

    echo '</div> <!-- end #work-grid -->'; //end #work-grid


    wp_reset_postdata();


}

add_shortcode( 'work', 'cw_work_shortcode' );

<?php
/**
 * The Shortcode to display team members.
 *
 *
 * @package creativewhy
 */


/**
 * Setup the team Shortcode
 *
 */
function cw_team_shortcode(){

  ob_start();
  cw_team();
  return ob_get_clean();

}

/**
 * Displays the team when the shortcode is called
 *
 */
function cw_team(){

    //The Team loop
    $team_args = array(
                'post_type' => 'cw_team',
                'orderby'   => 'menu_order title',
                'order'   => 'ASC',
                'posts_per_page' => 20
            );

    $team_query = new WP_Query( $team_args); //pass the args into the query

    echo '  <div class="row cw-team">
                <div class="small-11 small-centered columns">
                    <div class="row">';

    if ( $team_query->have_posts() ) {
        while ( $team_query->have_posts() ) {
        $team_query->the_post(); //setup post and retrieve the next post

        $teamID = get_the_ID();
        $team_mbr_name = get_the_title();

        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
            $team_img_id = get_post_thumbnail_id( $teamID );
            $team_img_alt = get_post_meta($team_img_id, '_wp_attachment_image_alt', true);
            $team_img_url = get_the_post_thumbnail_url(); //store the url for use
        }

        //get the team member metadata
        $job_title_key = 'cw_team_job_title';
        $team_mbr_facebook_key = 'cw_team_facebook';
        $team_mbr_instagram_key = 'cw_team_instagram';
        $team_mbr_linkedin_key = 'cw_team_linkedin';
        $team_mbr_medium_key = 'cw_team_medium';
        $team_mbr_twitter_key = 'cw_team_twitter';


        $job_title = get_post_meta( $teamID, $job_title_key, true );
        $team_mbr_facebook = get_post_meta( $teamID, $team_mbr_facebook_key, true );
        $team_mbr_instagram = get_post_meta( $teamID, $team_mbr_instagram_key, true );
        $team_mbr_linkedin = get_post_meta( $teamID, $team_mbr_linkedin_key, true );
        $team_mbr_medium = get_post_meta( $teamID, $team_mbr_medium_key, true );
        $team_mbr_twitter = get_post_meta( $teamID, $team_mbr_twitter_key, true );






        //get the team members bio
        $team_mbr_bio = get_the_content();

                echo '  <div class="small-12 medium-4 columns team-member">
                            <div class="team-member-wrapper">
                                <div class="team-member-inner">
                                    <img src="' .$team_img_url. '" class="" alt="' .$team_img_alt. '">
                                    <div class="team-member-info">
                                        <h5>' .$team_mbr_name. '</h5>
                                        <span>' .$job_title. '</span>
                                    </div>
                                </div>
                                <div id="1" class="team-member-overlay cw-overlay-team">
                                    <div class="team-content">
                                        <p></p>
                                        <p>' .$team_mbr_bio. '</p>
                                        <p></p>
                                    </div>
                                    <div class="team-social">
                                        <ul class="team-social-list">';
                                    if ($team_mbr_facebook != ''){
                                        echo '<li><a href="https://www.facebook.com/'.$team_mbr_facebook.'" class="team-facebook hide-text" title="'.$team_mbr_name.' Facebook" target="_blank"></a></li>';
                                    }

                                    if ($team_mbr_instagram != ''){
                                        echo '<li><a href="https://www.instagram.com/'.$team_mbr_instagram.'" class="team-instagram hide-text" title="'.$team_mbr_name.' Instagram" target="_blank"></a></li>';
                                    }

                                    if ($team_mbr_twitter != ''){
                                        echo '<li><a href="https://www.twitter.com/'.$team_mbr_twitter.'" class="team-twitter hide-text" title="'.$team_mbr_name.' Twitter" target="_blank"></a></li>';
                                    }

                                    if ($team_mbr_linkedin != ''){
                                        echo '<li><a href="https://www.linkedin.com/in/'.$team_mbr_linkedin.'" class="team-linkedin hide-text" title="'.$team_mbr_name.' LinkedIn" target="_blank"></a></li>';
                                    }

                                    if ($team_mbr_medium != ''){
                                        echo '<li><a href="https://www.medium.com/@'.$team_mbr_medium.'" class="team-medium hide-text" title="'.$team_mbr_name.' Medium Blog" target="_blank"></a></li>';
                                    }
                                  echo '</ul>
                                    </div>
                                </div>
                            </div>
                        </div>';

    } //end while

    echo '          </div> <!-- end .row -->
                </div> <!-- end .small-11 small-centered columns -->
            </div> <!-- end .row .cw-team -->';
    } //end if
    wp_reset_postdata();


}

add_shortcode( 'team', 'cw_team_shortcode' );

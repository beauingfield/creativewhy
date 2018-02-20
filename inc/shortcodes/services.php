<?php
/**
 * The Shortcode to display the services list.
 *
 *
 * @package creativewhy
 */


/**
 * Setup the services shortcode
 *
 */
function cw_services_shortcode(){

  ob_start();
  cw_services();
  return ob_get_clean();

}

/**
 * Displays the services when the shortcode is called
 *
 */
function cw_services(){
    global $cwServices; //the global $cwServices array where all the services info we need is stored

    $cwServices = array();


    //The Services loop
    $services_args = array(
                'post_type' => 'cw_services',
                'orderby'   => 'menu_order title',
                'order'   => 'ASC',
                'posts_per_page' => 20
            );

    $services_query = new WP_Query( $services_args); //pass the args into the query

    echo '<div class="services-list-wrapper">';

    if ( $services_query->have_posts() ) {
        while ( $services_query->have_posts() ) {
        $services_query->the_post(); //setup post and retrieve the next post

        $serviceID = get_the_ID();
        $service_name = get_the_title();
        $service_img_id = 0; //let's clear this out at first
        $service_img_url = '';
        $service_img_alt = '';

        if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
            $service_img_id = get_post_thumbnail_id( $serviceID );
            $service_img_alt = get_post_meta($service_img_id, '_wp_attachment_image_alt', true);
            $service_img_url = get_the_post_thumbnail_url( $serviceID ); //store the url for use
        }


        //Store the Service data for use in the services content area
        $service_data = array("service_id" => $serviceID, "service_title" => $service_name, "service_content" => get_the_content());
        $cwServices[$serviceID] = $service_data;


        echo '<a href="javascript:void(0)" id="service-'.$serviceID.'-trigger" class="service-link" data-service-id='.$serviceID.'><div class="services-media-object media-object">
               <div class="media-object-section middle">
                    <div class="services-media-object-thumbnail thumbnail">
                    <img src="'.$service_img_url.'" alt="' .$service_img_alt. '"/>
                    </div>
               </div>
               <div class="media-object-section">
                <div class="medi-object-section-title">
                    <h5>' .$service_name. ' <small><span class="services-expand"><i class="fa fa-chevron-down" aria-hidden="true"></i></span></small></h5>
                </div>
               </div> <!-- end .media-object-section -->

              </div> <!-- end .media-object --></a>';

    } //end while
    } //end if

    echo '</div> <!-- end services-list-wrapper -->';

    wp_reset_postdata();


}

add_shortcode( 'services', 'cw_services_shortcode' );

/**
 * Displays the services copy in it's own container
 *
 */
function get_services_content(){
    global $cwServices;

    //var_dump($cwServices);

    foreach ($cwServices as $cwService){
        echo '<div id="service-'.$cwService["service_id"].'" class="service-wrapper columns" data-closable>';
        echo '<div class="row">';
        echo '<div class="medium-12 medium-centered columns">';
        echo '<a class="close-service" href="#service-'.$cwService["service_id"].'-trigger" aria-label="Dismiss alert" type="button">
                <span aria-hidden="true">&times;</span>
              </a>';
        echo '<h3>'.$cwService["service_title"].'</h3>';
        echo '<div class="service-copy">';
        echo $cwService["service_content"];
        echo '</div> <!-- end service-copy -->';
        echo '</div> <!-- end small-12 -->';
        echo '</div> <!-- end row -->';
        echo '</div> <!-- end service-wrapper -->';
    }
}

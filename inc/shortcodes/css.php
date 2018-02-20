<?php
/**
 * CSS Shortcodes
 *
 *
 * @package creativewhy
 */

/**
 * Displays Section Heading when the shortcode is used
 *
 */
function cw_section_heading( $atts, $content = null ){

    $arr = shortcode_atts( array(
        'section-heading' => 'Section Heading'
    ), $atts );

    ob_start();

    echo '<div class="page-section-heading">';
    echo '<h3>' .  $content . '</h3>';
    echo '</div>';

    return ob_get_clean();
}

add_shortcode( 'section_heading', 'cw_section_heading' );

/**
 * Displays Section Heading when the shortcode is used
 *
 */
function cw_clearfix( $atts, $content = null ){

    ob_start();

    echo '<div class="clearfix">';
    echo $content;
    echo '</div>';

    return ob_get_clean();
}

add_shortcode( 'clearfix', 'cw_clearfix' );

/**
 * Displays a responive embed
 *
 */
function cw_responsive_embed( $atts, $content = null ){

    ob_start();

    $arr = shortcode_atts( array(
        'url' => 'missingUrl',
        'aspect_ratio' => 'widescreen'
    ), $atts );

    echo '<div class="flex-video '.$atts['aspect_ratio'].'">
            <iframe width="560" height="315" src="'.$atts['url'].'" frameborder="0" allowfullscreen></iframe>
          </div>';
    return ob_get_clean();

}

add_shortcode( 'responsive_embed', 'cw_responsive_embed' );


/**
 * Displays a Gallery of images using block grids from foundation
 *
 */
 function cw_gallery( $atts, $content = null ){
     ob_start();

     $arr = shortcode_atts( array(
        'img_ids' => '',
     ), $atts);

     $img_id_descriptions = explode(",", $atts['img_ids']);


     //begin the work section
     echo '<div class="case-study-gallery">';
     echo '<div class="row small-up-1 medium-up-2 large-up-2">';


     foreach($img_id_descriptions as $img_id_description){
         echo '<div class="case-study-gallery-item column column-block">';
         $the_img = explode(";", $img_id_description);

             $img_url = wp_get_attachment_image_src( $the_img[0], $size = 'full');

         echo '<img src="'.$img_url[0].'" class="work-photo">';

         if($the_img[1] != ''){
             echo '<div class="gallery-item-caption">'.$the_img[1].'</div>';
         }

         echo '</div>'; //end .case-study-gallery-item

     }
     echo '</div>'; //end
     echo '</div> <!-- end .case-study-gallery -->'; //end #work-grid

     return ob_get_clean();
 }

 add_shortcode( 'cw_gallery', 'cw_gallery' );

 /**
  * Displays a Block Grid for the results using block grids from foundation
  *
  */
function cw_results_grid( $atts, $content = null ){

      $arr = shortcode_atts( array(
         'small' => '1',
         'medium' => '1',
         'large' => '1'
      ), $atts);

     // echo '<div class="row small-up-'.$atts['small'].' medium-up-'.$atts['medium'].' large-up-'.$atts['large'].'">';

     // echo '</div> <!-- end row -->';



      return '<div class="row small-up-'.$atts['small'].' medium-up-'.$atts['medium'].' large-up-'.$atts['large'].' results-grid">'.
                do_shortcode($content).'
              </div> <!-- end row -->';
}

 add_shortcode( 'results_grid', 'cw_results_grid' );

/**
 * Displays a result
 *
 */
function cw_result( $atts, $content = null ){

      $arr = shortcode_atts( array(
         'icon'     => '',
         'icon_color' => '',
         'padding_top' => '0',
         'number'   => '',
         'source'   => ''
      ), $atts);

      if($atts['icon'] != ''){
          return '<div class="column column-block small-centered">
                  <div class="media-object result">
                              <div class="media-object-section">
                                <div class="result-icon">
                                  <i class="fa '.$atts['icon'].' fa-fw" style="color:'.$atts['icon_color'].'" aria-hidden="true"></i>
                                </div>
                              </div>
                              <div class="media-object-section result-source">
                                <h4>'.$atts['number'].'</h4>
                                <p>'.$atts['source'].'</p>
                              </div>
                   </div>
                </div>';

      }
      else{
          //no icon
          return '<div class="column column-block">
                    <div class="result-no-icon result-source" style="padding-top:'.$atts['padding_top'].';">
                     <h4>'.$atts['number'].'<br><small>'.$atts['source'].'</small></h4>

                    </div>
                   </div>';
      }

}

 add_shortcode( 'result', 'cw_result' );

/**
 * Displays a result hero text
 *
 */
function cw_result_hero( $atts, $content = null ){

    return '<div class="result-hero">
            <p class="text-center">'.$content.' </p>
            </div>
    ';
}

add_shortcode('result_hero', 'cw_result_hero');

/**
 * Displays a success checkmark
 *
 */
function cw_success( $atts, $content = null ){
    $arr = shortcode_atts( array(
       'color' => '',

    ), $atts);

    return '<div class="column column-block">
            <div class="result-success">
                <i class="fa fa-check-square-o" aria-hidden="true" style="color:'.$atts['color'].'"></i>
            </div>
            </div>
    ';
}

add_shortcode('success', 'cw_success');

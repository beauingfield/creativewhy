<?php
/**
 * The Shortcode to display the onboarding area.
 *
 *
 * @package creativewhy
 */


/**
 * Setup the onboarding shortcode
 *
 */
function cw_onboarding_shortcode(){

  ob_start();
  cw_onboarding();
  return ob_get_clean();

}

/**
 * Displays the onboarding section when the shortcode is called
 *
 */
function cw_onboarding(){

    $cw_step_one_heading = 'Fill Me In';
    $cw_step_one_copy = "Go to the customizer and change my copy";
    $cw_step_two_heading = "Fill Me In Too";
    $cw_step_two_copy = "Go to the customizer and change the copy for me too";
    $cw_step_three_heading = "Fill Me In Three";
    $cw_step_three_copy = "Go to the customizer and change the copy for me three";

    if( get_theme_mod('cw_onboarding_step_one_heading') ){
        $cw_step_one_heading = get_theme_mod("cw_onboarding_step_one_heading");
    }

    if( get_theme_mod('cw_onboarding_step_one_copy')){
        $cw_step_one_copy = get_theme_mod('cw_onboarding_step_one_copy');
    }

    if( get_theme_mod('cw_onboarding_step_two_heading') ){
        $cw_step_two_heading = get_theme_mod("cw_onboarding_step_two_heading");
    }

    if( get_theme_mod('cw_onboarding_step_two_copy')){
        $cw_step_two_copy = get_theme_mod('cw_onboarding_step_two_copy');
    }

    if( get_theme_mod('cw_onboarding_step_three_heading') ){
        $cw_step_three_heading = get_theme_mod("cw_onboarding_step_three_heading");
    }

    if( get_theme_mod('cw_onboarding_step_three_copy')){
        $cw_step_three_copy = get_theme_mod('cw_onboarding_step_three_copy');
    }

    echo '<div class="onboarding-wrapper">
            <div class="row">
                <div class="small-12 medium-12 large-4 columns">
                    <div class="onboarding-content">
                        <h4><span class="onboarding-number">1</span> <span id="cw-onboarding-step-one-heading">'.$cw_step_one_heading.'</span></h4>
                        <p style="text-align:center;" id="cw-onboarding-step-one-copy">'.$cw_step_one_copy.'</p>
                    </div>
                </div>
                <div class="small-12 medium-12 large-4 columns">
                    <div class="onboarding-content">
                        <h4><span class="onboarding-number">2</span> <span id="cw-onboarding-step-two-heading">'.$cw_step_two_heading.'</span></h4>
                        <p style="text-align:center;" id="cw-onboarding-step-two-copy">'.$cw_step_two_copy.'</p>
                    </div>
                </div>
                <div class="small-12 medium-12 large-4 columns">
                    <div class="onboarding-content">
                        <h4><span class="onboarding-number">3</span> <span id="cw-onboarding-step-three-heading">'.$cw_step_three_heading.'</span></h4>
                        <p style="text-align:center;" id="cw-onboarding-step-three-copy">'.$cw_step_three_copy.'</p>
                    </div>
                </div>
            </div>
          </div>';

    echo '<div class="onboarding-cta-wrapper"><a href="#contact" class="button button-purple">Get Started</a></div>';
}


add_shortcode( 'onboarding', 'cw_onboarding_shortcode' );

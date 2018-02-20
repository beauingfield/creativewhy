<?php
/**
 * Creative Why Theme Customizer
 *
 *
 * @package creativewhy
 */


/**
* Register the Customizer for Creative Why
* @since 1.0.0
*/
function cw_customize_register( $wp_customize ) {

    /**
     * Site Styling Panel
     */
    /*$wp_customize->add_panel( 'site_styling', array(
        'title' => __( 'Style your website' ),
        'description' => 'Style the site here', // Include html tags such as <p>.
        'priority' => 160, // Mixed with top-level-section hierarchy.
    ) ); */

    /**
     * Content Panel
     */
    $wp_customize->add_panel( 'onboarding_content', array(
        'title' => __( 'Onboarding' ),
        'description' => 'Edit the onboarding section', // Include html tags such as <p>.
        'priority' => 160, // Mixed with top-level-section hierarchy.
    ) );

    /**
     * Footer
     */
    $wp_customize->add_panel( 'site_footer', array(
        'title' => __( 'Footer' ),
        'description' => 'Edit the website Footer content here', // Include html tags such as <p>.
        'priority' => 160, // Mixed with top-level-section hierarchy.
    ) );


    //Setup the Global Styling Section and Settings
    cw_global_styling( $wp_customize );

    //Setup the Header Styling Section and Settings
    cw_header_styling( $wp_customize );


    //Setup the Content Section and Settings
    cw_onboarding_step_one( $wp_customize );
    cw_onboarding_step_two( $wp_customize );
    cw_onboarding_step_three( $wp_customize );
    cw_footer( $wp_customize );

}

add_action( 'customize_register', 'cw_customize_register' );

/**
* Enqueue the preview script to real time previewing
* @since 1.0.0
*/
function cw_customizer_preview_js() {
  wp_enqueue_script( 'cw_customizer_preview', get_template_directory_uri().'/inc/customizer/cw-customizer-script.js', array( 'customize-preview', 'jquery' ), '1.0.63' );
}
add_action( 'customize_preview_init', 'cw_customizer_preview_js' );

/**
* Sets up Step One of the Onboarding process
* @param object $wp_customize
* @since 1.0.0
*/
function cw_onboarding_step_one( $wp_customize ){

    //Step One section
    $wp_customize->add_section( 'onboarding_step_one' , array(
        'title' => __( 'Step 1', 'creativewhy' ),
        'description' => __( 'Customize Step 1 of the onboarding process' ),
        'panel' => 'onboarding_content',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    //Step One Heading
    $wp_customize->add_setting( 'cw_onboarding_step_one_heading', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'Schedule a Meeting',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Step One Heading Control
    $wp_customize->add_control( 'cw_onboarding_step_one_heading', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'onboarding_step_one', // Required, core or custom.
        'label' => __( 'Step 1 Heading' ),
        'description' => __( 'Change the heading for step one of the onboarding process' ),
        'input_attrs' => array(
        'class' => 'cw-onboarding-heading',
        'style' => 'border: 1px solid #8BC53F',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Step One Paragraph
    $wp_customize->add_setting( 'cw_onboarding_step_one_copy', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'Schedule a meeting to understand and determine marketing objectives',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Step One Paragraph Control
    $wp_customize->add_control( 'cw_onboarding_step_one_copy', array(
        'type' => 'textarea',
        'priority' => 10, // Within the section.
        'section' => 'onboarding_step_one', // Required, core or custom.
        'label' => __( 'Step 1 Copy' ),
        'description' => __( 'Set the copy for step one of the onbarding process' ),
        'input_attrs' => array(
        'class' => 'cw-onboarding-paragraph',
        'style' => 'border: 1px solid #8BC53F',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );


}

/**
* Sets up Step Two of the Onboarding process
* @param object $wp_customize
* @since 1.0.0
*/
function cw_onboarding_step_two( $wp_customize ){

    //Step Two section
    $wp_customize->add_section( 'onboarding_step_two' , array(
        'title' => __( 'Step 2', 'creativewhy' ),
        'description' => __( 'Customize Step 2 of the onboarding process' ),
        'panel' => 'onboarding_content',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    //Step Two Heading
    $wp_customize->add_setting( 'cw_onboarding_step_two_heading', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'Customized Proposal',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Step Two Heading Control
    $wp_customize->add_control( 'cw_onboarding_step_two_heading', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'onboarding_step_two', // Required, core or custom.
        'label' => __( 'Step 3 Heading' ),
        'description' => __( 'Change the heading for step three of the onboarding process' ),
        'input_attrs' => array(
        'class' => 'cw-onboarding-heading',
        'style' => 'border: 1px solid #8BC53F',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Step Two Paragraph
    $wp_customize->add_setting( 'cw_onboarding_step_two_copy', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'We develop a customized proposal that outlines a plan based on your specific marketing goals',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Step Two Paragraph Control
    $wp_customize->add_control( 'cw_onboarding_step_two_copy', array(
        'type' => 'textarea',
        'priority' => 10, // Within the section.
        'section' => 'onboarding_step_two', // Required, core or custom.
        'label' => __( 'Step 2 Copy' ),
        'description' => __( 'Set the copy for step two of the onbarding process' ),
        'input_attrs' => array(
        'class' => 'cw-onboarding-paragraph',
        'style' => 'border: 1px solid #8BC53F',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );


}

/**
* Sets up Step Three of the Onboarding process
* @param object $wp_customize
* @since 1.0.0
*/
function cw_onboarding_step_three( $wp_customize ){

    //Step Three section
    $wp_customize->add_section( 'onboarding_step_three' , array(
        'title' => __( 'Step 3', 'creativewhy' ),
        'description' => __( 'Customize Step 3 of the onboarding process' ),
        'panel' => 'onboarding_content',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    //Step Three Heading
    $wp_customize->add_setting( 'cw_onboarding_step_three_heading', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'Execute the Strategy',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Step Three Heading Control
    $wp_customize->add_control( 'cw_onboarding_step_three_heading', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'onboarding_step_three', // Required, core or custom.
        'label' => __( 'Step 3 Heading' ),
        'description' => __( 'Change the heading for step three of the onboarding process' ),
        'input_attrs' => array(
        'class' => 'cw-onboarding-heading',
        'style' => 'border: 1px solid #8BC53F',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Step Three Paragraph
    $wp_customize->add_setting( 'cw_onboarding_step_three_copy', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'Once we’ve agreed on the proposal we establish a partnership and begin to execute on your marketing strategy.',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Step Three  Paragraph Control
    $wp_customize->add_control( 'cw_onboarding_step_three_copy', array(
        'type' => 'textarea',
        'priority' => 10, // Within the section.
        'section' => 'onboarding_step_three', // Required, core or custom.
        'label' => __( 'Step 3 Copy' ),
        'description' => __( 'Set the copy for step three of the onbarding process' ),
        'input_attrs' => array(
        'class' => 'cw-onboarding-paragraph',
        'style' => 'border: 1px solid #8BC53F',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );


}


/**
* Sets up the Footer Section, Settings and Controls
* @param object $wp_customize
* @since 1.0.0
*/
function cw_footer( $wp_customize ){

    //Inquiry Section
    $wp_customize->add_section( 'footer_social' , array(
        'title' => __( 'Social Media', 'creativewhy' ),
        'description' => __( 'Configure the social media icons in the footer of your site' ),
        'panel' => 'site_footer',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    //Facebook Username
    $wp_customize->add_setting( 'cw_footer_social_fb_username', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'myUsername',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Facebook Username Control
    $wp_customize->add_control( 'cw_footer_social_fb_username', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_social', // Required, core or custom.
        'label' => __( 'Facebook Username' ),
        'description' => __( 'Enter your Facebook Page Username.' ),
        'input_attrs' => array(
        'class' => 'cw-footer-social-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Instagram Username
    $wp_customize->add_setting( 'cw_footer_social_ig_username', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'myUsername',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Instagram Username Control
    $wp_customize->add_control( 'cw_footer_social_ig_username', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_social', // Required, core or custom.
        'label' => __( 'Instagram Username' ),
        'description' => __( 'Enter your Instagram Username.' ),
        'input_attrs' => array(
        'class' => 'cw-footer-social-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Twitter Username
    $wp_customize->add_setting( 'cw_footer_social_tw_username', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'myUsername',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Twitter Username Control
    $wp_customize->add_control( 'cw_footer_social_tw_username', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_social', // Required, core or custom.
        'label' => __( 'Twitter Username' ),
        'description' => __( 'Enter your Twitter Username.' ),
        'input_attrs' => array(
        'class' => 'cw-footer-social-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Vimeo Username
    $wp_customize->add_setting( 'cw_footer_social_vi_username', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'myVimeoUsername',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Vimeo Username Control
    $wp_customize->add_control( 'cw_footer_social_vi_username', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_social', // Required, core or custom.
        'label' => __( 'Vimeo Username' ),
        'description' => __( 'Enter your Vimeo Username.' ),
        'input_attrs' => array(
        'class' => 'cw-footer-social-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Medium Username
    $wp_customize->add_setting( 'cw_footer_social_md_username', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'myUsername',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Medium Username Control
    $wp_customize->add_control( 'cw_footer_social_md_username', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_social', // Required, core or custom.
        'label' => __( 'Medium Username' ),
        'description' => __( 'Enter your Medium Username.' ),
        'input_attrs' => array(
        'class' => 'cw-footer-social-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //LinkedIn Username
    $wp_customize->add_setting( 'cw_footer_social_in_username', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'myUsername',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //LinkedIn Username Control
    $wp_customize->add_control( 'cw_footer_social_in_username', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_social', // Required, core or custom.
        'label' => __( 'LinkedIn Username' ),
        'description' => __( 'Enter your LinkedIn Username.' ),
        'input_attrs' => array(
        'class' => 'cw-footer-social-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );




    //Contact Section
    $wp_customize->add_section( 'footer_contact' , array(
        'title' => __( 'Contact Info', 'creativewhy' ),
        'description' => __( 'Set the Contact Area here' ),
        'panel' => 'site_footer',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );


    //Contact - Company Address
    $wp_customize->add_setting( 'cw_footer_contact_address', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '12345 Test Park Rd. Orlando, FL 32825',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Contact - Company Address Control
    $wp_customize->add_control( 'cw_footer_contact_address', array(
        'type' => 'textarea',
        'priority' => 10, // Within the section.
        'section' => 'footer_contact', // Required, core or custom.
        'label' => __( 'Company Address' ),
        'description' => __( 'Type your address here' ),
        'input_attrs' => array(
        'class' => 'cw-contact-address',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( '' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Contact - Company Phone Number
    $wp_customize->add_setting( 'cw_footer_contact_phone', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '855-555-5555',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Contact - Company Phone Control
    $wp_customize->add_control( 'cw_footer_contact_phone', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'footer_contact', // Required, core or custom.
        'label' => __( 'Company Phone Number' ),
        'description' => __( 'Add your Phone Number' ),
        'input_attrs' => array(
        'class' => 'cw-footer-inquiry-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

    //Disclaimer Section
    $wp_customize->add_section( 'cw_footer_disclaimer' , array(
        'title' => __( 'Disclaimer', 'creativewhy' ),
        'description' => __( 'Set your website disclaimer' ),
        'panel' => 'site_footer',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    //Contact - Company Phone Number
    $wp_customize->add_setting( 'cw_footer_disclaimer', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => 'Company Name. All Rights Reserved',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Contact - Company Phone Control
    $wp_customize->add_control( 'cw_footer_disclaimer', array(
        'type' => 'text',
        'priority' => 10, // Within the section.
        'section' => 'cw_footer_disclaimer', // Required, core or custom.
        'label' => __( 'Website Disclaimer' ),
        'description' => __( 'Enter the website disclaimer you want to display' ),
        'input_attrs' => array(
        'class' => 'cw-footer-inquiry-heading',
        'style' => 'border: 1px solid #900',
        'placeholder' => __( 'HTML is acceptable' ),
        ),
        'active_callback' => 'is_front_page',
    ) );

}



/**
* Sets up the Global Styling Section, Settings and Controls
* @param object $wp_customize
* @since 1.0.0
*/
function cw_global_styling( $wp_customize ){

    //Global Styles section
    $wp_customize->add_section( 'global_styles' , array(
        'title' => __( 'Global Styles', 'creativewhy' ),
        'description' => __( 'Set Global Styles here' ),
        'panel' => 'site_styling',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    //Main Theme Color
    $wp_customize->add_setting( 'main_theme_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#d50000',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Main Theme color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_theme_color_control', array(
        'label' => __( 'Main Theme Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'global_styles',
        'settings' => 'main_theme_color',
        'description' => __( 'Change the Main theme color of the website' ),
        'input_attrs' => array(
            'class' => 'cw-main-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#d50000' ),
        )
    ) ) );

    //Secondary Theme Color
    $wp_customize->add_setting( 'secondary_theme_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#2199e8',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Secondary Theme color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_theme_color_control', array(
        'label' => __( 'Secondary Theme Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'global_styles',
        'settings' => 'secondary_theme_color',
        'description' => __( 'Change the Secondary theme color of the website' ),
        'input_attrs' => array(
            'class' => 'cw-secondary-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#2199e8' ),
        )
    ) ) );

    //Headings Color
    $wp_customize->add_setting( 'headings_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#292e31',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Headings color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headings_color_control', array(
        'label' => __( 'Headings Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'global_styles',
        'settings' => 'headings_color',
        'description' => __( 'Change the color of the headings on the site' ),
        'input_attrs' => array(
            'class' => 'cw-headings-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#292e31' ),
        )
    ) ) );

    //Base Text Color
    $wp_customize->add_setting( 'body_text_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#5E6569',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Base Text color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_text_color_control', array(
        'label' => __( 'Base Text Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'global_styles',
        'settings' => 'body_text_color',
        'description' => __( 'Change the color of the base text on the site' ),
        'input_attrs' => array(
            'class' => 'cw-body-text-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#5E6569' ),
        )
    ) ) );

    //Checkmark icon color
    $wp_customize->add_setting( 'checkmark_icon_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#59BF71',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Checkmark icon color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'checkmark_icon_color_control', array(
        'label' => __( 'Checkmark Icon Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'global_styles',
        'settings' => 'checkmark_icon_color',
        'description' => __( 'Change the color of the checkmark icons on the site' ),
        'input_attrs' => array(
            'class' => 'cw-checkmark-icon-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#59BF71' ),
        )
    ) ) );

}

/**
* Sets up the Header Styling Section, Settings and Controls
* @param object $wp_customize
* @since 1.0.0
*/

function cw_header_styling( $wp_customize ){

    //Header Styles section
    $wp_customize->add_section( 'header_styles' , array(
        'title' => __( 'Header Styles', 'creativewhy' ),
        'description' => __( 'Style the site header' ),
        'panel' => 'site_styling',
        'priority' => 160,
        'capability' => 'edit_theme_options',
        'theme_supports' => '', // Rarely needed.
    ) );

    // Header background color
    $wp_customize->add_setting( 'header_bg_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#FFFFFF',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Header background color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_bg_color_control', array(
        'label' => __( 'Header Background Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'header_styles',
        'settings' => 'header_bg_color',
        'description' => __( 'Change the background color of the header' ),
        'input_attrs' => array(
            'class' => 'cw-header-bg-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#FFFFFF' ),
        )
    ) ) );

    // Login Button Background Color Setting
    $wp_customize->add_setting( 'login_button_bg', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#1DB2F7',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Login button background color picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'login_button_color_control', array(
        'label' => __( 'Login Button Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'header_styles',
        'settings' => 'login_button_bg',
        'description' => __( 'Change login button color' ),
        'input_attrs' => array(
            'class' => 'cw-login-button-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#1DB2F7' ),
        )
    ) ) );

    // Menu Link Color Setting
    $wp_customize->add_setting( 'menu_link_color', array(
        'type' => 'theme_mod', // or 'option'
        'capability' => 'edit_theme_options',
        'default' => '#3C3C3C',
        'transport' => 'postMessage', //
        'sanitize_callback' => '',
        'sanitize_js_callback' => '', // Basically to_json.
    ) );

    //Menu Link colol picker control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_link_color_control', array(
        'label' => __( 'Menu Link Color', 'creativewhy' ),
        'priority' => 10, // Within the section.
        'section' => 'header_styles',
        'settings' => 'menu_link_color',
        'description' => __( 'Change the color of the links in the menu' ),
        'input_attrs' => array(
            'class' => 'cw-login-button-color',
            'style' => 'border: 1px solid #900',
            'placeholder' => __( '#3C3C3C' ),
        )
    ) ) );

}


?>

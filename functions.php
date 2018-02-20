<?php
/**
 * CreativeWhy functions and definitions
 *
 * @package creativewhy
 */

if ( ! function_exists( 'creativewhy_theme_setup' ) ) :

 /**
  * Sets up theme defaults and registers support for various WordPress features.
  *
  * Note that this function is hooked into the after_setup_theme hook, which
  * runs before the init hook. The init hook is too late for some features, such
  * as indicating support for post thumbnails.
  */
 function creativewhy_theme_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on celebrationhealth, use a find and replace
     * to change 'celebrationhealth' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'creativewhy', get_template_directory() . '/languages' );


    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );

    // Image size for single posts
    add_image_size( 'single-post-thumbnail', 590, 180 );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'achilles' ),
        'pages' => esc_html__( 'Regular Page Menu', 'achilles'),
        'pages-mobile' => esc_html__( 'Regular Page Mobile Menu', 'achilles'),
        'mobile' => esc_html__( 'Mobile Menu', 'achilles' )
    ) );


    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    /*
     * Enable support for Post Formats.
     * See http://codex.wordpress.org/Post_Formats
     */
    add_theme_support( 'post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
    ) );

}
endif; // creativewhy_theme_setup

 add_action( 'after_setup_theme', 'creativewhy_theme_setup' );


//Queue up the scripts
function enqueue_scripts() {



// Localize the script with new data
$service_id_array = get_all_services_ids();

    wp_enqueue_style( 'foundationCSS', get_template_directory_uri() . '/assets/css/foundation.min.css', array(), '6.2.3' );
    wp_enqueue_script( 'foundationJS', get_template_directory_uri() . '/assets/js/vendor/foundation.min.js', array('jquery'), '', true);
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/assets/js/vendor/what-input.js', array('jquery'), '', true);
    wp_enqueue_script( 'jquery-ui-core', array('jquery') , '', true);
    wp_enqueue_script( 'jquery-effects-core', array('jquery'), '', true );
    wp_enqueue_script( 'jquery-effects-drop', array('jquery-effects-core'), '', true );
    wp_enqueue_script( 'jquery-effects-fade', array('jquery-effects-core'), '', true );



    wp_enqueue_script( 'masonry', get_template_directory_uri() . '/assets/js/vendor/masonry.pkgd.min.js', array('jquery'), '4.1.0', false);
    // wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js', array('masonry'), '4.1.0', false);
    // wp_enqueue_script( 'mainJS', get_template_directory_uri() . '/assets/js/app.js', array('foundationJS','masonry'), '0.0.1', true);

    wp_localize_script( 'mainJS', 'object_name', $service_id_array );

}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

//Add Font Awesome
function FontAwesome_icons() {
    echo '<link href="'.get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css"  rel="stylesheet">';
}

add_action('admin_head', 'FontAwesome_icons');
add_action('wp_head', 'FontAwesome_icons');

//Add the admin stylesheet
function cw_admin_styles() {
    echo '<link href="'.get_template_directory_uri().'/admin/admin-style.css"  rel="stylesheet">';
}

add_action('admin_head', 'cw_admin_styles');


function get_all_services_ids(){
    $args = array( 'post_type' => 'cw_services');

$services_query = new WP_Query( $args );
while ( $services_query->have_posts() ) : $services_query->the_post();

    $serviceID = get_the_ID();
    //Store the Service data for use in the services content area
    $service_data = array("service_id" => $serviceID, "service_title" => $service_name);
    $services_array[$serviceID] = $service_data;

endwhile;
    wp_reset_postdata();

return  $services_array;
}

//Gravity Forms Enable option for hiding labels
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Add capabilities to roles
function add_theme_caps() {
    // gets the author role
    $role = get_role( 'editor' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    $role->add_cap( 'edit_theme_options' );
}
add_action( 'admin_init', 'add_theme_caps');



//Required Files
require get_template_directory() . '/inc/customizer/cw-customizer.php';
require get_template_directory() . '/inc/nav/cw-nav-walker.php';
// require get_template_directory() . '/inc/cpt/sections/sections-cpt.php';
// require get_template_directory() . '/inc/cpt/services/services-cpt.php';
// require get_template_directory() . '/inc/cpt/team/team-cpt.php';
// require get_template_directory() . '/inc/cpt/work/work-cpt.php';
// require get_template_directory() . '/inc/shortcodes/team.php';
// require get_template_directory() . '/inc/shortcodes/services.php';
// require get_template_directory() . '/inc/shortcodes/onboarding.php';
// require get_template_directory() . '/inc/shortcodes/work.php';
require get_template_directory() . '/inc/shortcodes/css.php';
// require get_template_directory() . '/inc/ajax/ajax-functions.php';

<?php

/**
 * A class for adding inline styles.
 *
 * @package WordPress
 * @subpackage CSS_Tricks_Theme_Mod_Demo
 * @since CSS_Tricks_Theme_Mod_Demo 1.0
 */

function cw_inline_styles_init() {
	new Creative_Why_Inline_Styles();
}
add_action( 'init' , 'cw_inline_styles_init' );

class Creative_Why_Inline_Styles {

	public function __construct( ) {

		// Add our styles to the front end of the blog.
		add_action( 'wp_enqueue_scripts', array( $this, 'cw_front_end_styles' ) );

	}

	/**
	 * Append our customizer styles to the <head> whenever our main stylesheet is called.
	 */
	public function cw_front_end_styles() {

		// Grab the styles that pertain to the front end, but don't wrap them in a style tag.
		$styles = $this->get_inline_styles();

		// Attach our customizer styles to our stylesheet.  When it gets called, so do our customizer styles.
		wp_add_inline_style( 'cw-main-style', $styles );

	}

	/**
	 * Loop through our theme mods and build a string of CSS rules.
	 *
	 * @param  string $wrapped    Whether or not to wrap the styles in a style tag. Expects 'wrapped' or 'unwrapped'.
	 * @param  string $output_for The context for these styles. Expects 'front_end' or 'tinymce'.
	 * @return string CSS, either wrapped in a style tag, or not.
	 */
	public function get_inline_styles() {

		// This will hold all of our customizer styles.
		$custom_css = '';

        $main_theme_color = get_theme_mod( 'main_theme_color' ); //The main theme color
        $secondary_theme_color = get_theme_mod( 'secondary_theme_color' ); // The secondary theme color
        $headings_color = get_theme_mod( 'headings_color' ); //The color of the site headings
        $body_color = get_theme_mod( 'body_text_color' ); //The color of the body text
        $checkmark_icon_color = get_theme_mod( 'checkmark_icon_color' );
        $header_bg_color = get_theme_mod( 'header_bg_color' );
        $menu_link_color = get_theme_mod( 'menu_link_color' );

        $custom_css = "
                body,
                p{
                    color: {$body_color};
                }
                h1, h2, h3, h4, h5, h6{
                    color: {$headings_color};
                }
                .button:focus, .button:hover{
                    background-color: {$main_theme_color};
                }
                .cw-intro-wrapper strong,
                .cw-widget-fa{
                    color: {$main_theme_color};
                }
                .cw-button:hover{
                    background-color: {$main_theme_color};
                }
                [type=text]:focus,
                [type=password]:focus,
                [type=date]:focus,
                [type=datetime]:focus,
                [type=datetime-local]:focus,
                [type=month]:focus,
                [type=week]:focus,
                [type=email]:focus,
                [type=number]:focus,
                [type=search]:focus,
                [type=tel]:focus,
                [type=time]:focus,
                [type=url]:focus,
                [type=color]:focus,
                textarea:focus{
                    border-color: {$main_theme_color};
                }
                .button{
                    background-color: {$secondary_theme_color};
                }
                .home-feature-fa{
                    color: {$checkmark_icon_color};
                }
                .top-bar,
                .top-bar ul{
                    background-color: {$header_bg_color};
                }
                .top-bar a{
                    color: {$menu_link_color};
                }
                .menu-icon::after {
                    background: {$secondary_theme_color};
                    box-shadow: 0 7px 0 {$secondary_theme_color},0 14px 0 {$secondary_theme_color};
                }
                .main-page-content h3 {
                    color: {$main_theme_color};
                }
                .button:active, .button.is-checked {
                    background-color: {$main_theme_color};
                }
                .leasing-promotion{
                    border-top: 5px solid {$main_theme_color};
                }
                .not-found{
                    color: {$secondary_theme_color};
                }
                ";


        return $custom_css;
	}

}

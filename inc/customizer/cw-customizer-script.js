( function( $ ) {

    /** Onboarding **/

    //Step One Heading
    wp.customize( 'cw_onboarding_step_one_heading', function( value ) {
        value.bind( function( to ) {
          $( '#cw-onboarding-step-one-heading' ).html( to );
        } );
    } );

    //Step One Copy
    wp.customize( 'cw_onboarding_step_one_copy', function( value ) {
        value.bind( function( to ) {
          $( '#cw-onboarding-step-one-copy' ).html( to );
        } );
    } );

    //Step Two Heading
    wp.customize( 'cw_onboarding_step_two_heading', function( value ) {
        value.bind( function( to ) {
          $( '#cw-onboarding-step-two-heading' ).html( to );
        } );
    } );

    //Step Two Copy
    wp.customize( 'cw_onboarding_step_two_copy', function( value ) {
        value.bind( function( to ) {
          $( '#cw-onboarding-step-two-copy' ).html( to );
        } );
    } );

    //Step Three Heading
    wp.customize( 'cw_onboarding_step_three_heading', function( value ) {
        value.bind( function( to ) {
          $( '#cw-onboarding-step-three-heading' ).html( to );
        } );
    } );

    //Step Three Copy
    wp.customize( 'cw_onboarding_step_three_copy', function( value ) {
        value.bind( function( to ) {
          $( '#cw-onboarding-step-three-copy' ).html( to );
        } );
    } );

    //Address
    wp.customize( 'cw_footer_contact_address', function( value ) {
        value.bind( function( to ) {
          $( '#cw-footer-contact-address' ).html( to );
        } );
    } );

    //Phone
    wp.customize( 'cw_footer_contact_phone', function( value ) {
        value.bind( function( to ) {
          $( '#cw-footer-contact-phone' ).html( to );
        } );
    } );

    //Disclaimer
    wp.customize( 'cw_footer_disclaimer', function( value ) {
        value.bind( function( to ) {
          $( '#cw-footer-disclaimer' ).html( to );
        } );
    } );



} )( jQuery );

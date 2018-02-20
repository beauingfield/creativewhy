<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package creativewhy
 */

//Set Social Media URL prefixes
$cw_facebook_url = 'https://www.facebook.com/';
$cw_twitter_url = 'https://www.twitter.com/';
$cw_instagram_url = 'https://www.instagram.com/';
$cw_linkedin_url = 'https://www.linkedin.com/company/';

//Declare Variables
$cw_facebook_username = '';
$cw_facebook_check  = false;

$cw_twitter_username = '';
$cw_twitter_check  = false;

$cw_instagram_username = '';
$cw_instagram_check = false;

$cw_linkedin_username = '';
$cw_linkedin_check = false;

//Get the Social Media Usernames and set the display boolean for each to true if they're set
if( get_theme_mod('cw_footer_social_fb_username') ){
    $cw_facebook_username = get_theme_mod("cw_footer_social_fb_username");
    $cw_facebook_check = true;
}

if( get_theme_mod('cw_footer_social_tw_username') ){
    $cw_twitter_username = get_theme_mod("cw_footer_social_tw_username");
    $cw_twitter_check  = true;
}

if( get_theme_mod('cw_footer_social_ig_username') ){
    $cw_instagram_username = get_theme_mod("cw_footer_social_ig_username");
    $cw_instagram_check = true;
}

if( get_theme_mod('cw_footer_social_in_username') ){
    $cw_linkedin_username = get_theme_mod("cw_footer_social_in_username");
    $cw_linkedin_check = true;
}

else{

?>

<div class="cw-footer-wrapper">
    <footer>
      <div class="grid-x">
        <div class="small-12 medium-3 cell">
          <div class="cw-footer-logo">
            <a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cw-logo-light.svg"/></a>
          </div>
          <p class="large"><a href="https://www.google.com/maps/place/4767+New+Broad+St,+Orlando,+FL+32814/@28.5661281,-81.3309262,17z/data=!3m1!4b1!4m5!3m4!1s0x88e76545f48acc79:0xddcb324db534ef9f!8m2!3d28.5661234!4d-81.3287375" target="_blank" rel="noopener"><span>4767 New Broad Street</span></br><span>Orlando, FL 32814</span></a></p>
          <p class="large"><a href="tel:407-601-3358" target="_blank" rel="noopener">407-601-3358</a></p>
        </div>
        <div class="small-12 medium-3 cell">
          <h6 class="light">LEGAL</h6>
          <ul class="cw-footer-links">
            <li><a href="/privacy-policy">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="small-12 medium-3 cell">
          <h6 class="light">FOLLOW US</h6>
          <ul class="cw-social-media-list">
            <li>
              <a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cw-social-icon-facebook.svg" alt="Facebook Icon Footer"/></a>
            </li>
            <li>
              <a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cw-social-icon-instagram.svg" alt="Instagram Icon Footer"/></a>
            </li>
            <li>
              <a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cw-social-icon-twitter.svg" alt="Twitter Icon Footer"/></a>
            </li>
            <li>
              <a href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/cw-social-icon-linkedin.svg" alt="LinkedIn Icon Footer"/></a>
            </li>
          </ul>
        </div>
        <div class="small-12 medium-3 cell">
          <h6 class="light">SUBSCRIBE</h6>
          <a class="button primary round" href="/newsletter">SIGN UP FOR OUR NEWSLETTER</a>
          <p class="small light">&copy; <?php echo date("Y"); ?> Creative Why. All Rights Reserved.</p>
        </div>
      </div>

    </footer>
  </div>

<?php
} //end the else for all pages
?>

<?php wp_footer(); // this is necessary for the theme to function ?>
                </div> <!-- end off-canvas-content -->
            </div> <!-- end off-canvas-wrapper-inner -->
        </div> <!-- end off-canvas-wrapper -->
    </body>

  <script type="text/javascript">
    $(document).ready(function(){
      $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 320) {
          $(".cw-header-wrapper").css("background" , "#00A1AF");
        }

        else{
          $(".cw-header-wrapper").css("background" , "transparent");
        }
      })
    })
  </script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>

  <!-- LinkedIn Insight Tag -->
	<script type="text/javascript"> _linkedin_data_partner_id = "150330"; </script>
  <script type="text/javascript"> (function()
	{var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type =
	"text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
	s.parentNode.insertBefore(b, s);})(); </script>
  <noscript> <img height="1" width="1" style="display:none;" alt=""
	src="https://dc.ads.linkedin.com/collect/?pid=150330&fmt=gif" /> </noscript>

  <!-- Facebook Pixel Code -->
  <script>
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
  n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
  document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '960313227380426'); // Insert your pixel ID here.
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=960313227380426&ev=PageView&noscript=1"
  /></noscript>
  <!-- DO NOT MODIFY -->
  <!-- End Facebook Pixel Code -->
</html>

<?php
/**
 * Template Name: Monthly Newsletter
 *
 *
 * @package creativewhy
 */

get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

         <div class="outer-wrapper">
           <!-- <div class="grid-x">
             <div class="small-6 small-centered cell">
               <div class="newsletter-logo">
                 <img class="wide-logo" src="/wp-content/themes/creativewhy/assets/img/cw-logo-light.svg">
               </div>
             </div>
           </div> -->
           <div class="grid-x">
             <div class="small-12 medium-6 medium-offset-3 cell">
               <div class="newsletter-copy">
                 <?php echo the_content();?>
               </div>
             </div>
           </div>
           <div class="grid-x">
             <div class="small-12 medium-6 medium-offset-3 cell">
               <form accept-charset="UTF-8" action="https://ty367.infusionsoft.com/app/form/process/bf70c09a0eeefcc36ee429d0de2b0d10" class="infusion-form" method="POST">
                  <input name="inf_form_xid" type="hidden" value="bf70c09a0eeefcc36ee429d0de2b0d10" />
                  <input name="inf_form_name" type="hidden" value="Web Form submitted" />
                  <input name="infusionsoft_version" type="hidden" value="1.66.0.49" />
                  <div class="infusion-field">
                      <label class="hide" for="inf_field_FirstName">First Name *</label>
                      <input class="infusion-field-input-container" id="inf_field_FirstName" name="inf_field_FirstName" type="text" placeholder="Full Name" />
                  </div>
                  <div class="infusion-field">
                      <label class="hide" for="inf_field_Email">Email *</label>
                      <input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="text" placeholder="Email Address" />
                  </div>
                  <div class="infusion-submit">
                      <input class="button primary" type="submit" value="SIGN UP" />
                  </div>
              </form>
             </div>
           </div>
         </div>

    <?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<script type="text/javascript" src="https://ty367.infusionsoft.com/app/webTracking/getTrackingCode"></script>

<?php get_footer(); ?>

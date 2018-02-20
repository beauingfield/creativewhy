<?php
/**
 * The template for displaying the BSB Landing Page Copy and Form
 *
 * @package creativewhy
 */

?>


<div class="cw-hero-wrapper">
    <?php echo do_shortcode('[rev_slider alias="bootstrategy"]'); ?>
</div>

<div class="cw-landing-content-wrapper">
    <div class="row">
      <div class="small-12 large-6 columns"><?php the_content(); ?></div>
      <div class="small-12 large-6 columns">
          <div id="landing-page-form" class="cw-inquiry-form_wrapper">
            <form accept-charset="UTF-8" action="https://ty367.infusionsoft.com/app/form/process/bf9d39b9fe6ba38fd8360b8ded0803ea" id="inf_form_bf9d39b9fe6ba38fd8360b8ded0803ea" class="infusion-form" name="Web Form submitted" method="POST">
              <input name="inf_form_xid" type="hidden" value="bf9d39b9fe6ba38fd8360b8ded0803ea" />
              <input name="inf_form_name" type="hidden" value="Web Form submitted" />
              <input name="infusionsoft_version" type="hidden" value="1.68.0.117" />

              <div class="infusion-field">
                  <label for="inf_field_FirstName">First Name *</label>
                  <input class="infusion-field-input-container" id="inf_field_FirstName" name="inf_field_FirstName" type="text" />
              </div>
              <div class="infusion-field">
                  <label for="inf_field_LastName">Last Name *</label>
                  <input class="infusion-field-input-container" id="inf_field_LastName" name="inf_field_LastName" type="text" />
              </div>
              <div class="infusion-field">
                  <label for="inf_field_Email">Email *</label>
                  <input class="infusion-field-input-container" id="inf_field_Email" name="inf_field_Email" type="text" />
              </div>
              <div class="infusion-submit">
                  <input class="button button-purple expanded" type="submit" value="SIGN UP" />
              </div>
            </form>
            <script type="text/javascript" src="https://ty367.infusionsoft.com/app/webTracking/getTrackingCode"></script>
          </div>
      </div>
    </div>
</div>

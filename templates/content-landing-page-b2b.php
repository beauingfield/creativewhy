<?php
/**
 * The template for displaying the BSB Landing Page Copy and Form
 *
 * @package creativewhy
 */

?>


<div class="cw-hero-wrapper">
    <?php echo do_shortcode('[rev_slider alias="b2b-guide"]'); ?>
</div>

<div class="cw-landing-content-wrapper">
    <div class="row">
      <div class="small-12 large-6 columns"><?php the_content(); ?></div>
      <div class="small-12 large-6 columns">
          <div id="landing-page-form" class="cw-inquiry-form_wrapper">
            <form accept-charset="UTF-8" action="https://ty367.infusionsoft.com/app/form/process/af7fb8d620e69bc5d538d24e04226d76" class="infusion-form" method="POST">
              <input name="inf_form_xid" type="hidden" value="af7fb8d620e69bc5d538d24e04226d76" />
              <input name="inf_form_name" type="hidden" value="Blogging Web Form submitted" />

              <input name="infusionsoft_version" type="hidden" value="1.66.0.52" />
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

<?php
/**
 * The template for displaying the Landing Page Copy and Form
 *
 * @package creativewhy
 */

?>

<div class="cw-landing-content-wrapper">
    <div class="row">
      <div class="large-6 large-6 columns float-left">
        <?php the_content(); ?>
        <div id="landing-page-form" class="cw-inquiry-form_wrapper">
          <form accept-charset="UTF-8" action="https://ty367.infusionsoft.com/app/form/process/7d78b0d1849969e88b0eb0b88c334529" class="infusion-form" method="POST">
            <input name="inf_form_xid" type="hidden" value="7d78b0d1849969e88b0eb0b88c334529" />
            <input name="inf_form_name" type="hidden" value="Storytelling Web Form submitted" />
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
                <input class="button primary round" type="submit" value="GET THE GUIDE" />
            </div>
          </form>
          <script type="text/javascript" src="https://ty367.infusionsoft.com/app/webTracking/getTrackingCode"></script>
        </div>
      </div>
      <!-- <div class="large-6 large-6 columns float-right">
        <?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
      </div> -->
    </div>
</div>

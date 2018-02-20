<?php
/**
 * The template for displaying the sections.
 *
 *
 * @package creativewhy
 */



// The Sections Query
$args = array(
	'post_type' => 'cw_sections',
	'orderby'   => 'menu_order title',
	'order'     => 'ASC',
);

$section_query = new WP_Query( $args );

if ( $section_query->have_posts() ) {
	// The Loop
	while ( $section_query->have_posts() ) {
        //store the section variables
        $section_query->the_post();
        $sectionID = get_the_ID();
        $section_title = get_the_title();
        $section_slug = sanitize_title($section_title);

        //get the section metadata
        $hide_section_title_key = 'cw_hide_section_title';
        $hide_section_title = get_post_meta( $sectionID, $hide_section_title_key, true);

        //get the section metadata
        $hide_section_img_key = 'cw_hide_section_image';
        $hide_section_img = get_post_meta( $sectionID, $hide_section_img_key, true);

        $image_orientation_key = 'cw_section_img_orientation';
        $image_orientation = get_post_meta( $sectionID, $image_orientation_key, true );

        $image_caption_heading_key = 'cw_sections_img_heading';
        $image_caption_heading = get_post_meta( $sectionID, $image_caption_heading_key, true);

        $image_caption_subheading_key = 'cw_sections_img_sub_heading';
        $image_caption_subheading = get_post_meta( $sectionID, $image_caption_subheading_key, true);

        //css classes
        $medium_class = "medium-6";
        $large_class = "large-6";

        //Check if the image should be displayed on mobile
        if( $hide_section_img == 'yes'){
            $main_medium_class = 'medium-12';
            $img_visibility_class = 'medium-6 show-for-large';
        }
        else{
            $main_medium_class = "medium-6";
            $img_visibility_class = 'medium-6';
        }

        ?>
        <section id="<?php echo $section_slug;?>" class="<?php echo $section_slug; ?>-wrapper main-section">
            <div class="expanded row">
            <?php
                if( $image_orientation == 'Left'){ ?>
                    <div class="large-6 <?php echo $img_visibility_class;?> columns">
                        <div class="cw-section-img-wrapper">
                        <div class="cw-overlay-purple">
                            <div class="cw-section-img-caption-wrapper">
                                <?php echo $image_caption_heading; ?><br> <span class="cw-img-caption-sub-heading"><?php echo $image_caption_subheading; ?></span>
                            </div> <!-- end .cw-section-img-caption-wrapper -->
                        </div> <!-- end . cw-overlay-purple -->
                        <?php
                            if ( has_post_thumbnail( $sectionID ) ) {
                                $section_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $sectionID ), 'large' );
                                if ( ! empty( $section_image_url[0] ) ) {
                                    echo '<img src="'.$section_image_url[0].'"/>';
                                }
                            }
                        ?>
                        </div> <!-- end .cw-section-img-wrapper -->
                    </div> <!-- end .large-6 medium-6 columns -->
                    <div class="large-6 <?php echo $main_medium_class;?> columns">
                        <div class="section-content-half">
                            <?php if ($hide_section_title != 'yes' ){ ?>
                                    <h1 class="section-title"><?php echo $section_title;?></h1>
                            <?php } ?>
                            <?php the_content(); ?>
                        </div> <!-- end .section-content-half -->
                    </div> <!-- end .large-6 medium-6 columns -->
                <?php
                }
                elseif( $image_orientation == 'Right'){ ?>
                    <div class="large-6 <?php echo $main_medium_class;?> columns">
                        <div class="section-content-half">
                            <?php if ($hide_section_title != 'yes' ){ ?>
                                    <h1 class="section-title"><?php echo $section_title;?></h1>
                            <?php } ?>
                            <?php the_content(); ?>
                        </div> <!-- end .section-content-half -->
                    </div> <!-- end large-6 medium-6 columns -->
                    <div class="large-6 <?php echo $img_visibility_class;?> columns">
                        <div class="cw-section-img-wrapper">
                        <div class="cw-overlay-purple">
                            <div class="cw-section-img-caption-wrapper">
                                <?php echo $image_caption_heading; ?><br> <span class="cw-img-caption-sub-heading"><?php echo $image_caption_subheading; ?></span>
                            </div> <!-- end .cw-section-img-caption-wrapper -->
                        </div> <!-- end .cw-overlay-purple -->
                        <?php
                            if ( has_post_thumbnail( $sectionID ) ) {
                                $section_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $sectionID ), 'large' );
                                if ( ! empty( $section_image_url[0] ) ) {
                                    echo '<img src="'.$section_image_url[0].'"/>';
                                }
                            }
                        ?>
                        </div> <!-- end .cw-section-img-wrapper -->
                    </div> <!-- end .large-6 .medium-6 .columns -->
            <?php   if($sectionID == 10){
                        get_services_content();
                    } ?>

                <?php
                }
                else{ ?>
                    <div class="large-12 medium-12">
                        <div class="section-title-full">
                            <?php if ($hide_section_title != 'yes' ){ ?>
                                    <h1><?php echo $section_title;?></h1>
                            <?php } ?>
                        </div>
                        <div class="section-content-full small-11 small-centered medium-10 medium-centered large-11 large-centered">
                            <?php the_content(); ?>
                        </div> <!-- end .section-content-full -->
                    </div> <!-- end .large-12 medium-12 -->
                <?php
                }
            ?>
            </div> <!-- end .expanded .row -->
        </section> <!-- end section -->
<?php
	}


}
	/* Restore original Post Data
	 * NB: Because we are using new WP_Query we aren't stomping on the
	 * original $wp_query and it does not need to be reset with
	 * wp_reset_query(). We just need to set the post data back up with
	 * wp_reset_postdata().
	 */
	wp_reset_postdata();
?>

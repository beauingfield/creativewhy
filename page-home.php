<?php
/**
 * Template Name: Homepage
 *
 *
 * @package creativewhy
 */

get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

         <div class="cw-content-wrapper">
             <?php the_content(); ?>
         </div>

    <?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php endif; ?>

<?php get_footer(); ?>
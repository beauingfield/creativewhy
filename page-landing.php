<?php
/**
 * Template Name: Storytelling
 *
 *
 * @package creativewhy
 */

get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

         <div class="cw-content-wrapper">
             <?php get_template_part( 'templates/content', 'landing-page' ); ?>
         </div>

    <?php endwhile; else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>

<?php get_footer(); ?>

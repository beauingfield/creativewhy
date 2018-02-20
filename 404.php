<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package creativewhy
 */

get_header(); ?>

	<div id="primary" class="content-area error-page-outer-wrapper error-page-content-container">
		<main id="main" class="error-page-content site-main" role="main">

			<div class="grid-x">
				<div class="small-10 medium-8 small-offset-1 medium-offset-2 cell">

					<h1 class="light">Nothing to see here…</h1>


					<div class="grid-x">
						<div class="medium-6 large-8 cell">
							<ul class="action-buttons">
								<p class="large light">It looks like the page you’re trying to view has been moved or never existed…</p>
								<li><a class="button button-custom primary" href="/">RETURN HOME</a></li>
								<li><a class="button button-custom primary" href="/resources">CHECK OUT OUR eBOOKS</a></li>
							</ul>
						</div>
					</div>

				</div><!-- grid -->
			</div><!-- .grid-x -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

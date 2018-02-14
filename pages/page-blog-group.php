<?php
/**
 * Template Name: Blog Group 
 */

global $bella_pt;
$bella_pt = 'post';

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'group' );

			endif; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

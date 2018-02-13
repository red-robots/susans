<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<section class="error-404 not-found template-page">
				<div class="wrapper cap">
					<div class="wrapper">
						<header class="row-1">
							<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'acstarter' ); ?></h1>
						</header><!--.row-1-->
						<div class="row-2 clear-bottom">
							<div class="col-1 copy">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'acstarter' ); ?></p>
								<?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?>
							</div><!--.col-1-->
						</div><!--.row-2-->
					</div><!--.wrapper-->
				</div><!--.wrapper-->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

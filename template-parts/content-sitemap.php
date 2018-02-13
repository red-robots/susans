<?php
/**
 * Template part for displaying page content in page-sitemap.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("template-page"); ?>>
    <div class="wrapper cap">
        <div class="wrapper">
            <header class="row-1">
                <h1><?php the_title();?></h1>
            </header><!--.row-1-->
            <div class="row-2 clear-bottom">
                <div class="col-1 copy">
                    <?php the_content();?>
                    <?php wp_nav_menu( array( 'theme_location' => 'sitemap' ) ); ?>
                </div><!--.col-1-->
            </div><!--.row-2-->
        </div><!--.wrapper-->
    </div><!--.wrapper-->
</article><!-- #post-## -->

<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("template-page-group"); ?>>
    <div class="wrapper cap">
        <div class="wrapper">
            <header class="row-1">
                <h1><?php the_title();?></h1>
            </header><!--.row-1-->
            <?php $tax = get_field("category");
            if($tax):
                $args = array(
                    'post_type'=>'project',
                    'posts_per_page'=>-1,
                    'order'=>'ASC',
                    'orderby'=>'menu_order',
                    'tax_query'=>array(array(
                        'taxonomy'=>'project_type',
                        'field'=>'term_id',
                        'terms'=>$tax
                    ))
                );
                $query = new WP_Query($args);
                if($query->have_posts()):?>
                    <div class="row-2 clear-bottom">
                        <?php while($query->have_posts()):$query->the_post();
                            $image = get_field("featured_image");?>
                            <div class="col js-blocks">
                                <a href="<?php the_permalink();?>">
                                    <header>
                                        <h2><?php the_title();?></h2>
                                    </header>
                                    <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>">
                                </a>
                            </div><!--.col-2-->
                        <?php endwhile;?>
                    </div><!--.row-2-->
                    <?php wp_reset_postdata();
                endif;
            endif;?>
        </div><!--.wrapper-->
    </div><!--.wrapper-->
</article><!-- #post-## -->

<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

global $bella_pt;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("template-page-group"); ?>>
    <div class="wrapper cap">
        <div class="wrapper">
            <header class="row-1">
                <h1><?php the_title();?></h1>
            </header><!--.row-1-->
            <?php if(!empty($bella_pt)):
                $args = array(
                    'post_type'=>$bella_pt,
                    'posts_per_page'=>4,
                    'order'=>'DESC',
                    'orderby'=>'date',
                );
                $tax = get_field("category");
                if($tax):
                    $args['tax_query']=array(array(
                        'taxonomy'=>'project_type',
                        'field'=>'term_id',
                        'terms'=>$tax
                    ));
                endif;
                $query = new WP_Query($args);
                if($query->have_posts()):?>
                    <div id="offset"><?php echo $query->post_count;?></div>
                    <div class="row-2 clear-bottom tracking">
                        <?php while($query->have_posts()):$query->the_post();
                            $image = get_field("featured_image");?>
                            <div class="col js-blocks">
                                <a href="<?php the_permalink();?>">
                                    <header>
                                        <h2><?php the_title();?></h2>
                                    </header>
                                    <img src="<?php echo $image['url'];?>" alt="<?php echo $image['alt'];?>">
                                </a>
                            </div><!--.col-->
                        <?php endwhile;?>
                    </div><!--.row-2-->
                    <?php wp_reset_postdata();
                endif;
            endif;?>
        </div><!--.wrapper-->
    </div><!--.wrapper-->
</article><!-- #post-## -->

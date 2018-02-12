<?php
/**
 * Template part for displaying page content in index.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("template-index"); ?>>
    <div class="row-1 clear-bottom">
        <?php for($i=1;$i<5;$i++):
            $image = get_field("banner_image_{$i}");
            if($image):?>
                <img src="<?php echo $image['sizes']['large'];?>" alt="<?php echo $image['alt'];?>">
            <?php endif;
        endfor;?>
    </div><!--.row-1-->
    <?php $tagline = get_field("tagline");
    if($tagline):?>
        <div class="row-2">
            <div class="wrapper cap">
                <?php echo $tagline;?>
            </div><!--.wrapper.cap-->
        </div><!--.row-2-->
    <?php endif;?>
    <?php $left_link = get_field("left_link");
    $left_image = get_field("left_image");
    $right_link = get_field("right_link");
    $right_image = get_field("right_image");
    if(($left_image && $left_link)||($right_image&&$right_link)):?>
        <div class="row-3">
            <div class="wrapper cap">
                <div class="wrapper clear-bottom">
                    <?php if($left_image && $left_link):?>
                        <div class="col-1 js-blocks">
                            <a href="<?php echo get_permalink($left_link->ID);?>">
                                <header>
                                    <h2><?php echo get_the_title($left_link->ID);?></h2>
                                </header>
                                <img src="<?php echo $left_image['url'];?>" alt="<?php echo $left_image['alt'];?>">
                            </a>
                        </div><!--.col-1-->
                    <?php endif;
                    if($right_image&&$right_link):?>
                        <div class="col-2 js-blocks">
                            <a href="<?php echo get_permalink($right_link->ID);?>">
                                <header>
                                    <h2><?php echo get_the_title($right_link->ID);?></h2>
                                </header>
                                <img src="<?php echo $right_image['url'];?>" alt="<?php echo $right_image['alt'];?>">
                            </a>
                        </div><!--.col-2-->
                    <?php endif;?>
                </div><!--.wrapper-->
            </div><!--.wrapper.cap-->
        </div><!--.row-3-->
    <?php endif;?>
</article><!-- #post-## -->

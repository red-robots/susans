<?php
/**
 * Template part for displaying page content in single-project.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("template-single-project"); ?>>
    <div class="wrapper cap">
        <div class="wrapper">
            <header class="row-1">
                <h1><?php the_title();?></h1>
            </header><!--.row-1-->
            <div class="row-2 clear-bottom">
                <div class="copy">
                    <?php the_content();?>
                </div><!--.copy-->
                <?php $gallery = get_field("gallery");
                if($gallery):?>
                    <div class="gallery tracking-images clear-bottom">
                        <?php $i=0;
                        $display_count = 0;
                        $display_limit = 2;
                        $first_vertical = true;
                        while($i<count($gallery)&&$display_count<$display_limit):?>
                            <?php if($gallery[$i]&&$gallery[$i]['image']&&$gallery[$i]['orientation']):?>
                                <div class="image-container <?php if($gallery[$i]['orientation']=="vertical"): 
                                    echo "vertical ";
                                    if($first_vertical): 
                                        echo "first ";
                                        $first_vertical = ! $first_vertical; 
                                    else: 
                                        echo "last "; 
                                        $first_vertical = ! $first_vertical;
                                    endif;
                                endif;?>">
                                        <img src="<?php echo $gallery[$i]['image']['url'];?>">
                                </div><!--.image-container-->
                                <?php if($gallery[$i]['orientation']=="vertical"&&!$first_vertical):
                                    $display_limit++;
                                endif;
                                $display_count++;
                            endif;
                            $i++;?>
                        <?php endwhile;?>
                    </div><!--.gallery-->
                    <div id="offset"><?php echo $display_count;?></div><!--#offset-->
                <?php endif;?>
            </div><!--.row-2-->
        </div><!--.wrapper-->
    </div><!--.wrapper-->
</article><!-- #post-## -->

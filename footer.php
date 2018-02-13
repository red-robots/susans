<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper" style="background-image: url(<?php echo get_template_directory_uri()."/images/footer-background.png";?>);">
			<div class="wrapper cap">
				<?php $facebook_link = get_field("facebook_link","option");
				$linkedin_link = get_field("linkedin_link","option");
				$instagram_link = get_field("instagram_link","option");
				if($facebook_link||$instagram_link||$linkedin_link):?>
					<div class="row-1 social">
						<?php if($instagram_link):?>
							<a href="<?php echo $instagram_link;?>" target="_blank"><i class="fa fa-instagram"></i></a>
						<?php endif;?>
						<?php if($linkedin_link):?>
							<a href="<?php echo $linkedin_link;?>" target="_blank"><i class="fa fa-linkedin"></i></a>
						<?php endif;?>
						<?php if($facebook_link):?>
							<a href="<?php echo $facebook_link;?>" target="_blank"><i class="fa fa-facebook"></i></a>
						<?php endif;?>
					</div><!--.row-1-->
				<?php endif;?>
				<div class="row-2">
					<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
				</div><!--.row-2-->
			</div><!--.wrapper.cap-->
		</div><!--.wrapper-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

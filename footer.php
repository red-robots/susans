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
		<div class="wrapper cap">
			<?php $facebook_link = get_field("facebook_link");
			$linkedin_link = get_field("linkedin_link");
			$instagram_link = get_field("instagram_link");
			if($facebook_link||$instagram_link||$linkedin_link):?>
				<div class="row-1 social">
					<?php if($instagram_link):?>
						<a href="<?php echo $instagram_link;?>"><i class="fa fa-instagram"></i></a>
					<?php endif;?>
					<?php if($linkedin_link):?>
						<a href="<?php echo $linkedin_link;?>"><i class="fa fa-linkedin"></i></a>
					<?php endif;?>
					<?php if($facebook_link):?>
						<a href="<?php echo $facebook_link;?>"><i class="fa fa-facebook"></i></a>
					<?php endif;?>
				</div><!--.row-1-->
			<?php endif;?>
			<div class="row-2">
				<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
			</div><!--.row-2-->
		</div><!--.wrapper.cap-->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

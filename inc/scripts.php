<?php
/**
 * Enqueue scripts and styles.
 */
function acstarter_scripts() {
	wp_enqueue_style( 'acstarter-style', get_stylesheet_uri() );

	wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2', true);
		wp_enqueue_script('jquery');

	

	wp_enqueue_script( 
			'acstarter-blocks', 
			get_template_directory_uri() . '/assets/js/vendors.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-custom', 
			get_template_directory_uri() . '/assets/js/custom.js', 
			array(), '20120206', 
			true 
		);
	$vars = array(
		'url' => admin_url( 'admin-ajax.php' ),
	);
	$cpt = get_field("cpt");
	if($cpt){
		$vars['posttype']=$cpt;
	} else {
		$vars['posttype']=get_post_type();
	}
	$tax = get_field("category");
	if($tax){
		$vars['taxtype']='project_type';
		$vars['taxtypevalue']=$tax;	
	}
	wp_localize_script( 'acstarter-custom', 'bellaajaxurl', $vars);

	wp_enqueue_script('font-awesome','https://use.fontawesome.com/8f931eabc1.js');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'acstarter_scripts' );
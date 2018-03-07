<?php
/**
 * Custom theme functions.
 *
 * 
 *
 * @package ACStarter
 */

/*-------------------------------------
	Custom client login, link and title.
---------------------------------------*/
function my_login_logo() { ?>
<style type="text/css">
  body.login div#login h1 a {
  	background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png);
  	background-size: 327px 127px;
  	width: 327px;
  	height: 127px;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Link
function loginpage_custom_link() {
	return the_permalink();
}
add_filter('login_headerurl','loginpage_custom_link');

/*-------------------------------------
	Favicon.
---------------------------------------*/
function mytheme_favicon() { 
 echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/images/favicon.ico" >'; 
} 
add_action('wp_head', 'mytheme_favicon');

/*-------------------------------------
	Adds Options page for ACF.
---------------------------------------*/
if( function_exists('acf_add_options_page') ) {acf_add_options_page();}

/*-------------------------------------
  Hide Front End Admin Menu Bar
---------------------------------------*/
if ( ! current_user_can( 'manage_options' ) ) {
    show_admin_bar( false );
}
 /*-------------------------------------
  Move Yoast to the Bottom
---------------------------------------*/
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
/*-------------------------------------
  Custom WYSIWYG Styles

  If you are using the Plugin: MRW Web Design Simple TinyMCE

  Keep this commented out to keep from getting duplicate "Format" dropdowns

---------------------------------------*/
// function acc_custom_styles($buttons) {
//   array_unshift($buttons, 'styleselect');
//   return $buttons;
// }
// add_filter('mce_buttons_2', 'acc_custom_styles');


/*
* Callback function to filter the MCE settings


  But always use this to get the custom formats

*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
 
  $style_formats = array(  
    // Each array child is a format with it's own settings
    
    // A block element
    array(  
      'title' => 'Block Color',  
      'block' => 'span',  
      'classes' => 'custom-color-block',
      'wrapper' => true,
      
    ),
    // inline color
    array(  
      'title' => 'Custom Color',  
      'inline' => 'span',  
      'classes' => 'custom-color',
      'wrapper' => true,
      
    ),
     array(
        'title' => 'Header 2',
        'format' => 'h2',
        //'icon' => 'bold'
    ),
    array(
        'title' => 'Header 3',
        'format' => 'h3'
    ),
    array(
        'title' => 'Paragraph',
        'format' => 'p'
    )
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
// Add styles to WYSIWYG in your theme's editor-style.css file
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
/*-------------------------------------
  Change Admin Labels
---------------------------------------*/
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News Item';
    //$submenu['edit.php'][15][0] = 'Status'; // Change name for categories
    //$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News';
        $labels->singular_name = 'News Item';
        $labels->add_new = 'Add News Item';
        $labels->add_new_item = 'Add News Item';
        $labels->edit_item = 'Edit News Item';
        $labels->new_item = 'News Item';
        $labels->view_item = 'View News Item';
        $labels->search_items = 'Search News';
        $labels->not_found = 'No News found';
        $labels->not_found_in_trash = 'No News found in Trash';
    }
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/*-------------------------------------
  Add a last and first menu class option
---------------------------------------*/

function ac_first_and_last_menu_class($items) {
  foreach($items as $k => $v){
    $parent[$v->menu_item_parent][] = $v;
  }
  foreach($parent as $k => $v){
    $v[0]->classes[] = 'first';
    $v[count($v)-1]->classes[] = 'last';
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'ac_first_and_last_menu_class');

//More posts - first for logged in users, other for not logged in
add_action('wp_ajax_bella_ajax_next_posts', 'bella_ajax_next_posts');
add_action('wp_ajax_nopriv_bella_ajax_next_posts', 'bella_ajax_next_posts');

function bella_ajax_next_posts() {

    //Build query
    $args = array(
      'order'=>'ASC',
      'orderby'=>'date'
    );

    if(!empty($_GET['post_type'])){
      $args['post_type']=$_GET['post_type'];
    }

    if(!empty( $_GET['tax_type'])&&!empty( $_GET['tax_type_value'])){
      $args['tax_query']= array(array(
        'taxonomy'=>$_GET['tax_type'],
        'field'=>'term_id',
        'terms'=>$_GET['tax_type_value']
      ));
    }
    //Get offset
    if( ! empty( $_GET['post_offset'] ) ) {

        $args['offset'] = $_GET['post_offset'];

        //Also have to set posts_per_page, otherwise offset is ignored
        $args['posts_per_page'] = 4;
    }

    $count_results = '0';

    $query_results = new WP_Query( $args );

    //Results found
    if ( $query_results->have_posts() ) {

        $count_results = $query_results->post_count;

        //Start "saving" results' HTML
        $results_html = '';
        ob_start();

        while ( $query_results->have_posts() ) { 

            $query_results->the_post();

            $image = get_field("featured_image");
            echo '<div class="col js-blocks">';
            echo '<a href="'.get_permalink().'">';
            echo '<header>';
            echo '<h2>'.get_the_title().'</h2>';
            echo '</header>';
            echo '<img src="'.$image['url'].'" alt="'.$image['alt'].'">';
            echo '</a>';
            echo '</div><!--.col-->';
        }    

        //"Save" results' HTML as variable
        $results_html = ob_get_clean();  
    }

    //Build ajax response
    $response = array();

    //1. value is HTML of new posts and 2. is total count of posts
    array_push ( $response, $results_html, $count_results );
    echo json_encode( $response );

    //Always use die() in the end of ajax functions
    die();  
}

//More posts - first for logged in users, other for not logged in
add_action('wp_ajax_bella_ajax_next_image', 'bella_ajax_next_image');
add_action('wp_ajax_nopriv_bella_ajax_next_image', 'bella_ajax_next_image');

function bella_ajax_next_image() {

    $results_html = '';
    $i=0;
    $display_count = 0;
    $display_limit = 2;
    $first_vertical = true;

    //Get offset
    if( ! empty( $_GET['post_offset'] ) ) {
      $i = $_GET['post_offset'];
    }

    if(!empty($_GET['post_id'])){
      $gallery = get_field("gallery", intval($_GET['post_id']));
      if($gallery){
        ob_start();
        while($i<count($gallery)&&$display_count<$display_limit){
            if($gallery[$i]&&$gallery[$i]['image']&&$gallery[$i]['orientation']){
                $classes = '';
                if($gallery[$i]['orientation']=="vertical"){ 
                    $classes .= "vertical ";
                    if($first_vertical) {
                        $classes .= "first ";
                        $first_vertical = ! $first_vertical; 
                    } else {
                        $classes .= "last "; 
                        $first_vertical = ! $first_vertical;
                    }
                }
                echo '<div class="image-container '.$classes.'">'; 
                echo '<img src="'.$gallery[$i]['image']['url'].'">';
                echo '</div><!--.image-container-->';
                if($gallery[$i]['orientation']=="vertical"&&!$first_vertical){
                    $display_limit++;
                }
                $display_count++;
            }
            $i++;
        }
        //"Save" results' HTML as variable
        $results_html = ob_get_clean();  
      }
    }

    $count_results = $display_count;

    //Build ajax response
    $response = array();

    //1. value is HTML of new posts and 2. is total count of posts
    array_push ( $response, $results_html, $count_results );
    echo json_encode( $response );

    //Always use die() in the end of ajax functions
    die();  
}

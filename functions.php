<?php
/**
 * MyLCCC Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ncreview_theme
 */

if ( ! function_exists( 'ncreview_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ncreview_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MyLCCC Theme, use a find and replace
	 * to change 'mylccc-theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ncreview-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mylccc-theme' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'mylccc-theme' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ncreview_theme_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ncreview_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ncreview_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ncreview_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'ncreview_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ncreview_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mylccc-theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	 	register_sidebar( array(
		'name'          => esc_html__( 'LCCC Search Sidebar', 'lorainccc' ),
		'id'            => 'lccc-search-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'lorainccc' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ncreview_theme_widgets_init' );

/**
 * Enqueue google fonts.
 */
function add_google_fonts() {
wp_enqueue_style( 'pt-sans-google-fonts', 'https://fonts.googleapis.com/css?family=PT+Sans:400,700', false );
	
wp_enqueue_style( 'lato-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700,400italic', false ); 	
	
}

add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

/**
 * Enqueue scripts and styles.
 */
function ncreview_theme_scripts() {

/* Foudnation Init JS */
 wp_enqueue_script( 'foundation-init-js', get_template_directory_uri() . '/foundation.js', array( 'jquery', 'foundation-js' ), '1', true );
	
	 wp_enqueue_style( 'foundation-app',  get_template_directory_uri() . '/foundation/css/app.css' );
		wp_enqueue_style( 'foundation-normalize', get_template_directory_uri() . '/foundation/css/normalize.css' );
		wp_enqueue_style( 'foundation',  get_template_directory_uri() . '/foundation/css/foundation.css' );

		wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/foundation/js/vendor/foundation.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'foundation-whatinput', get_template_directory_uri() . '/foundation/js/vendor/what-input.js', array( 'jquery' ), '1', true);
	
		wp_enqueue_style( 'mylccc-theme-style', get_stylesheet_uri() );
	//wp_enqueue_script( 'mylccc-theme-navigation', get_stylesheet() . '/js/navigation.js', array(), '20151215', true );

	//wp_enqueue_script( 'mylccc-theme-skip-link-focus-fix', get_stylesheet() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ncreview_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_stylesheet_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
*/ 
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
*/
require get_stylesheet_directory() . '/inc/extras.php';
 
/**
 * Customizer additions.
*/ 
require get_stylesheet_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_stylesheet_directory() . '/inc/jetpack.php';

function add_my_day_var($public_query_vars) {
    $public_query_vars[] = 'd';
    return $public_query_vars;
}

add_filter('query_vars', 'add_my_day_var');

function do_rewrite() {
    add_rewrite_rule('day/([^/]+)/?$', 'index.php?pagename=day&d=$matches[1]','top');
}

add_action('init', 'do_rewrite');


function wpbeginner_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}



$defaults = array(
	'default-color' => '#959595',
	'default-image' => get_stylesheet_directory_uri() . '/images/NCR_background.jpg',
	'default-repeat'         => 'no-repeat',
	'default-position-x'     => 'center',
	'default-attachment'     => 'fixed',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	
);
add_theme_support( 'custom-background', $defaults );


$chdefaults = array(
	'default-image' => get_stylesheet_directory_uri() . '/images/NCR_logo.png',
	'width'                  => '',
	'height'                 => '',
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $chdefaults );

add_action( 'customize_register', 'themename_customize_register' );
function themename_customize_register($wp_customize) {

    $wp_customize->add_section( 'ignite_custom_logo', array(
        'title'          => 'Footer Header Image',
        'description'    => 'This is the Footer Header Image to be used',
        'priority'       => 40,
    ) );

    $wp_customize->add_setting( 'custom_logo', array(
        'default'        => '',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_logo', array(
        'label'   => 'Custom Header Mobile Header',
        'section' => 'ignite_custom_logo',
        'settings'   => 'custom_logo',
    ) ) );
}
// CHANGE EXCERPT LENGTH FOR DIFFERENT POST TYPES
 
function custom_excerpt_length($length) {
    global $post;
    if ($post->post_type == 'post')
    return 46;
    else
    return 40;
}
add_filter('excerpt_length', 'custom_excerpt_length');

// Changing excerpt more
   function new_excerpt_more($more) {
   global $post;
   return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
   }
   add_filter('excerpt_more', 'new_excerpt_more');

//Removes the word Category and Tag from caegory title
add_filter( 'get_the_archive_title', function ( $title ) {

    if( is_category() ) {

        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
				}
    return $title;

});

function pu_remove_script_version( $src ){
    return remove_query_arg( 'ver', $src );
}

add_filter( 'script_loader_src', 'pu_remove_script_version' );
add_filter( 'style_loader_src', 'pu_remove_script_version' );

/* Menu Functions */

class lc_top_bar_menu_walker extends Walker_Nav_Menu
{
	/*
	 * Add vertical menu class and submenu data attribute to sub menus
	 */

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\" data-submenu>\n";
	}
}

//Optional fallback
function lc_topbar_menu_fallback($args)
{
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */

	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("<ul class='children'>", '<ul class="children submenu menu vertical" data-submenu>', $fallback);

	echo '<ul class="dropdown menu" data-dropdown-menu">'.$fallback.'</ul>';
}

class lc_drill_menu_walker extends Walker_Nav_Menu
{
	/*
	 * Add vertical menu class
	 */

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

function lc_drill_menu_fallback($args)
{
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */

	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("children", "children vertical menu", $fallback);
	echo '<ul class="vertical menu" data-drilldown="">'.$fallback.'</ul>';
}

/* End Menu Functions */

function empty_content($str) {
    return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
}

// Register Custom Taxonomy
function ncr_issue_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Issues', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Issue', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Issues', 'text_domain' ),
		'all_items'                  => __( 'All Issues', 'text_domain' ),
		'parent_item'                => __( 'Parent Issue', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Issue:', 'text_domain' ),
		'new_item_name'              => __( 'New Issue', 'text_domain' ),
		'add_new_item'               => __( 'Add New Issue', 'text_domain' ),
		'edit_item'                  => __( 'Edit Issue', 'text_domain' ),
		'update_item'                => __( 'Update Issue', 'text_domain' ),
		'view_item'                  => __( 'View Issue', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Issues', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Issues', 'text_domain' ),
		'search_items'               => __( 'Search Issues', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Issues', 'text_domain' ),
		'items_list'                 => __( 'Issues list', 'text_domain' ),
		'items_list_navigation'      => __( 'Issues list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'               => true,
		'rest_base'                  => 'issue',
	);
	register_taxonomy( 'issue', array( 'post' ), $args );

}
add_action( 'init', 'ncr_issue_taxonomy', 0 );

function ncr_add_taxonomy_filters() {
	global $typenow;
 
	// an array of all the taxonomyies you want to display. Use the taxonomy name or slug
	$taxonomies = array('issue');
 
	// must set this to the post type you want the filter(s) displayed on
	if( $typenow == 'post' ){
 
		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>Show All $tax_name</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'ncr_add_taxonomy_filters' );

// CHANGE PAGINATION
function paginate() {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('page','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'show_all' => true,
        'type' => 'plain'
    );
    if ( $wp_rewrite->using_permalinks() ) $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
    if ( !empty($wp_query->query_vars['s']) ) $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
    echo paginate_links( $pagination );
}

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }	elseif ( is_tax( 'issue' ) ){
						
												$title = single_tag_title( '', false );
					
								} 
    return $title;

});
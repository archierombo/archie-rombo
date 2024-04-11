<?php
/**
 * 
 *
 * 
 */

/**
 * Archie-Rombo only works in WordPress 5.8 or later.
 */

if ( version_compare( $GLOBALS['wp_version'], '5.8', '<' ) ) {
	
	return;
}

if ( ! function_exists( 'setup' ) ) :
	function setup() {
//Theme Options
//adding custom logo support
add_theme_support('custom-logo',array(
	'height'      => 100,
	'width'       => 400,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( 'site-title', 'site-description' ),
	'unlink-homepage-logo' => true, 
)
);
//add dynamic title tag support
//add_theme_support( 'title-tag' );
//menu support
//add_theme_support('menus');
add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only
add_theme_support('widgets');
// Add Theme Support for wooCommerce.
add_theme_support( 'woocommerce' );
// Add Theme Support for Selective Refresh in Customizer.
add_theme_support( 'customize-selective-refresh-widgets' );

// Add support for responsive embed blocks.
add_theme_support( 'responsive-embeds' );
add_theme_support( 'automatic-feed-links' );
//post formats
//add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );


		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Orange', 'archie-rombo' ),
				'slug' => 'orange',
				'color' => '#fd9c30',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'archie-rombo' ),
	           	'slug' => 'black',
	           	'color' => '#1d1d1d',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'archie-rombo' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));
	   	add_theme_support( 'align-wide' );
	   	add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'archie-rombo' ),
		       	'shortName' => esc_html__( 'S', 'archie-rombo' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'archie-rombo' ),
		       	'shortName' => esc_html__( 'M', 'archie-rombo' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'archie-rombo' ),
		       	'shortName' => esc_html__( 'L', 'archie-rombo' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'archie-rombo' ),
		       	'shortName' => esc_html__( 'XL', 'archie-rombo' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'setup' );


function custom_header_setup() {
	add_theme_support(
		'custom-header',
		
			
			array(
				'default-image'      => '',
				'default-text-color' => '343434',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'flex-width' 		 => true,
				
				
			)
		
	);
}
add_action( 'after_setup_theme', 'custom_header_setup' );

//Menus
function menus(){
	register_nav_menus(
		array(
			'main-menu' => 'Main Menu',
			'footer-menu' => 'Footer Menu ',
		)
   );
}
add_action('init','menus');



/**
 * Register custom fonts.
 */
function fonts_url() {
	$fonts_url = '';

	$font_families = array();
	$font_families[] = 'Roboto:300,300i,400,400i,500,700';
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

function register_styles(){

	$version = wp_get_theme()->get('Version');
	wp_enqueue_style( 'google-fonts', fonts_url(), array(), null );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.2', 'all');
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/font-awesome-4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
	wp_enqueue_style('animate', get_template_directory_uri() . '/animate.css/animate.min.css', array(), '3.4.0', 'all');
	wp_enqueue_style('component-css',get_template_directory_uri().'/css/component.css' ,array(),'1.0.0','all');
	wp_enqueue_style('archie-rombo-style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');	
}
add_action('wp_enqueue_scripts','register_styles');


/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, and column width.
*/
add_editor_style( array(fonts_url() ) );



function register_scripts()
{
	wp_register_script('modernizr-custom-js',get_template_directory_uri() . '/js/modernizr.custom.js',array(),'2.6.2',true);
	wp_register_script('classie',get_template_directory_uri() . '/js/classie.js',array(),'',true);
	wp_register_script('uisearch',get_template_directory_uri() . '/js/uisearch.js',array(),'',true);
	wp_register_script('search-script',get_template_directory_uri() . '/js/search-script.js',array(),'',true);

	wp_enqueue_script('jquery');
	wp_register_script('color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '5.3.2', true);
	wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
	// wp_register_script('toggled-search-bar', get_template_directory_uri() . '/js/toggled-search-bar.js', array('jquery'), '5.3.2', true);
	wp_register_script('lazyload', get_template_directory_uri() . '/js/lazyload.js', array(), ' 2.0.0-rc.2', true);


	
		
	wp_enqueue_script('modernizr-custom-js');
	wp_enqueue_script('classie');
	wp_enqueue_script('uisearch');
	wp_enqueue_script('search-script');

	wp_enqueue_script('color-modes');
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('lazyload');
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action('wp_enqueue_scripts','register_scripts');



add_image_size('blog-large', 800, 400, false);
add_image_size('blog-small', 300, 200, false);







//Register Sidebars Widgets
function my_sidebars() {

	register_sidebar(

		array(
			'name' => 'Page Sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'id' => 'page-sidebar',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)

	);
	register_sidebar(

		array(
			'name' => 'Blog Sidebar',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'id' => 'blog-sidebar',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)

	);
}
add_action('widgets_init', 'my_sidebars');


//Registering Footer Widgets
function my_footerwidgets(){
	register_sidebar(
		array(
			'name' => 'Footer Widget 1',
			'id' => 'footer-widget-1',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget 2',
			'id' => 'footer-widget-2',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget 3',
			'id' => 'footer-widget-3',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Footer Widget 4',
			'id' => 'footer-widget-4',
			'before_widget' => '<div class="widget widget_footer  %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
}
add_action('widgets_init', 'my_footerwidgets');


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function archierombo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'archierombo_pingback_header' );



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function customize_partial_blogdescription() {
	bloginfo( 'description' );
}



//custom post type
/**
 * Register a custom post type called "Portfolio".
 *
 * @see get_post_type_labels() for label keys.
 */
// function wpdocs_codex_portfolio_init() {
// 	$args = array(
// 		'labels' => array(
// 			'name' => 'Portfolios',
// 			'singular_name' => 'portfolio',
// 		),
// 		'hierarchical' => true,
// 		'public' => true,
// 		'has_archive' => true,
// 		'menu_icon' => 'dashicons-portfolio ',
// 		'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
// 		'rewrite' =>array()

// 	);

// 	register_post_type( 'portfolios', $args );
// }

// add_action( 'init', 'wpdocs_codex_portfolio_init' );


add_action( 'after_setup_theme', 'theme_functions' );
function theme_functions() {

    add_theme_support( 'title-tag' );

}

add_filter( 'wp_title', 'custom_titles', 10, 2 );
function custom_titles( $title, $sep ) {

    //Check if custom titles are enabled from your option framework
    if ( ot_get_option( 'enable_custom_titles' ) === 'on' ) {
        //Some silly example
        $title = "Some other title" . $title;;
    }

    return $title;
}

if ( function_exists( 'register_block_style' ) ) {
    register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => __( 'Blue Quote', 'archie-rombo' ),
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: blue; }',
        )
    );
}




function wpdocs_register_block_patterns() {
        register_block_pattern(
            'wpdocs/my-example',
            array(
                'title'         => __( 'My First Block Pattern', 'archie-rombo' ),
                'description'   => _x( 'This is my first block pattern', 'Block pattern description', 'archie-rombo' ),
                'content'       => '<!-- wp:paragraph --><p>A single paragraph block style</p><!-- /wp:paragraph -->',
                'categories'    => array( 'text' ),
                'keywords'      => array( 'cta', 'demo', 'example' ),
                'viewportWidth' => 800,
            )
        );
}
add_action( 'init', 'wpdocs_register_block_patterns' );
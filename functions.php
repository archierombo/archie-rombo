<?php
/**
 * Archie-Rombo Theme Functions
 * 
 * Only works in WordPress 6.4 or later.
 */


if ( version_compare( $GLOBALS['wp_version'], '6.4', '<' ) ) {
	
	return;
}

if ( ! class_exists( 'Archie_Rombo_Bootstrap_Nav_Walker' ) ) :
	class Archie_Rombo_Bootstrap_Nav_Walker extends Walker_Nav_Menu {
		private $current_item;
		private $dropdown_menu_alignment_values = array(
			'dropdown-menu-start',
			'dropdown-menu-end',
			'dropdown-menu-sm-start',
			'dropdown-menu-sm-end',
			'dropdown-menu-md-start',
			'dropdown-menu-md-end',
			'dropdown-menu-lg-start',
			'dropdown-menu-lg-end',
			'dropdown-menu-xl-start',
			'dropdown-menu-xl-end',
			'dropdown-menu-xxl-start',
			'dropdown-menu-xxl-end',
		);

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			$dropdown_menu_class = array();
			foreach ( $this->current_item->classes as $class ) {
				if ( in_array( $class, $this->dropdown_menu_alignment_values, true ) ) {
					$dropdown_menu_class[] = $class;
				}
			}
			$indent  = str_repeat( "\t", $depth );
			$submenu = ( $depth > 0 ) ? ' sub-menu' : '';
			$output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr( implode( ' ', $dropdown_menu_class ) ) . " depth_$depth\">\n";
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$this->current_item = $item;
			$indent             = $depth ? str_repeat( "\t", $depth ) : '';

			$li_attributes = '';
			$class_names   = $value = '';
			$classes       = empty( $item->classes ) ? array() : (array) $item->classes;

			$has_children = ! empty( $args->has_children );

			$classes[] = $has_children ? 'dropdown' : '';
			$classes[] = 'nav-item';
			$classes[] = 'nav-item-' . $item->ID;
			if ( $depth && $has_children ) {
				$classes[] = 'dropdown-menu dropdown-menu-end';
			}

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = ' class="' . esc_attr( $class_names ) . '"';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
			$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

			$active_class   = ( $item->current || $item->current_item_ancestor || in_array( 'current_page_parent', $item->classes, true ) || in_array( 'current-post-ancestor', $item->classes, true ) ) ? 'active' : '';
			$nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
			$attributes    .= $has_children ? ' class="' . $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="' . $nav_link_class . $active_class . '"';

			$item_output  = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
endif;

if ( ! function_exists( 'archie_rombo_setup' ) ) :
	function archie_rombo_setup() {
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
				'unlink-homepage-logo' => true,
			)
		);

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails', array( 'post' ) );
		add_theme_support( 'widgets' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'automatic-feed-links' );

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Orange', 'archie-rombo' ),
					'slug'  => 'orange',
					'color' => '#fd9c30',
				),
				array(
					'name'  => esc_html__( 'Black', 'archie-rombo' ),
					'slug'  => 'black',
					'color' => '#1d1d1d',
				),
				array(
					'name'  => esc_html__( 'Grey', 'archie-rombo' ),
					'slug'  => 'grey',
					'color' => '#82868b',
				),
			)
		);
		add_theme_support( 'align-wide' );
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'small', 'archie-rombo' ),
					'shortName' => esc_html__( 'S', 'archie-rombo' ),
					'size'      => 12,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'regular', 'archie-rombo' ),
					'shortName' => esc_html__( 'M', 'archie-rombo' ),
					'size'      => 16,
					'slug'      => 'regular',
				),
				array(
					'name'      => esc_html__( 'larger', 'archie-rombo' ),
					'shortName' => esc_html__( 'L', 'archie-rombo' ),
					'size'      => 36,
					'slug'      => 'larger',
				),
				array(
					'name'      => esc_html__( 'huge', 'archie-rombo' ),
					'shortName' => esc_html__( 'XL', 'archie-rombo' ),
					'size'      => 48,
					'slug'      => 'huge',
				),
			)
		);
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
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
	}
endif;
add_action( 'after_setup_theme', 'archie_rombo_setup' );

function archie_rombo_register_menus() {
	register_nav_menus(
		array(
			'main-menu'   => 'Main Menu',
			'footer-menu' => 'Footer Menu ',
		)
	);
}
add_action( 'init', 'archie_rombo_register_menus' );


function archie_rombo_custom_header_setup() {
	add_theme_support(
		'custom-header',
		array(
			'default-image'      => '',
			'default-text-color' => '343434',
			'width'              => 1000,
			'height'             => 250,
			'flex-height'        => true,
			'flex-width'         => true,
		)
	);
}
add_action( 'after_setup_theme', 'archie_rombo_custom_header_setup' );




/**
 * Register custom fonts.
 */
function archie_rombo_fonts_url() {
	$font_families   = array( 'Roboto:300,300i,400,400i,500,700' );
	$query_args      = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	return esc_url_raw( $fonts_url );
}

function archie_rombo_register_styles() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'google-fonts', archie_rombo_fonts_url(), array(), null );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.3.2', 'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/fontawesome-6.5.1-web-pro/css/all.min.css', array(), '6.5.1', 'all' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/animate.css/animate.min.css', array(), '3.4.0', 'all' );
	wp_enqueue_style( 'component-css', get_template_directory_uri() . '/css/component.css', array(), '1.0.0', 'all' );
	// Dashboard Styles
	wp_enqueue_style( 'archie-rombo-style', get_stylesheet_uri(), array(), $version, 'all' );
}
add_action( 'wp_enqueue_scripts', 'archie_rombo_register_styles' );

/**
 * Generate Dynamic CSS for Theme Options.
 */
function archie_rombo_dynamic_css() {
	$primary_color = get_option( 'archie_rombo_primary_color', '#33bbcc' );
	$primary_color = sanitize_hex_color( $primary_color ) ?: '#33bbcc';

	if ( $primary_color && $primary_color !== '#33bbcc' ) {
		?>
		<style type="text/css">
			:root {
				--primary-color: <?php echo esc_attr( $primary_color ); ?>;
				--button-color: <?php echo esc_attr( $primary_color ); ?>;
				--link-color: <?php echo esc_attr( $primary_color ); ?>;
			}
			.search-form .search-submit,
			button, input[type="button"], input[type="reset"], input[type="submit"],
			.pagination .current,
			.more-link {
				background-color: <?php echo esc_attr( $primary_color ); ?>;
				border-color: <?php echo esc_attr( $primary_color ); ?>;
			}
			a,
			.reply .comment-reply-link,
			.logged-in-as a, .fn a, .comment-meta .commentmetadata, .comment-edit-link,
			.widget ul li a {
				color: <?php echo esc_attr( $primary_color ); ?>;
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'archie_rombo_dynamic_css' );


/*
 * This theme styles the visual editor to resemble the theme style,
 * specifically font, colors, and column width.
*/
add_editor_style( array( archie_rombo_fonts_url() ) );



function archie_rombo_register_scripts() {
	wp_register_script( 'modernizr-custom-js', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '2.6.2', true );
	wp_register_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), '', true );
	wp_register_script( 'uisearch', get_template_directory_uri() . '/js/uisearch.js', array(), '', true );
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '5.3.2', false ); // Load in head
	wp_register_script( 'bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '5.3.2', true ); // BS5 doesn't depend on jQuery
	wp_register_script( 'lazyload', get_template_directory_uri() . '/js/lazyload.js', array(), '2.0.0-rc.2', true );
	wp_register_script( 'searchscript', get_template_directory_uri() . '/js/search-script.js', array(), '', true );

	wp_enqueue_script( 'modernizr-custom-js' );
	wp_enqueue_script( 'classie' );
	wp_enqueue_script( 'uisearch' );
	wp_enqueue_script( 'color-modes' );
	wp_enqueue_script( 'bootstrap-bundle' );
	wp_enqueue_script( 'lazyload' );
	wp_enqueue_script( 'searchscript' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'archie_rombo_register_scripts' );



add_image_size('blog-large', 800, 400, false);
add_image_size('blog-small', 300, 200, false);







//Register Sidebars Widgets
function archie_rombo_sidebars() {

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
add_action( 'widgets_init', 'archie_rombo_sidebars' );


//Registering Footer Widgets
function archie_rombo_footer_widgets() {
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
	register_sidebar(
		array(
			'name' => 'Footer Social',
			'id' => 'footer-social',
			'before_widget' => '<div class="widget widget_footer %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-header"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		)
	);
}
add_action( 'widgets_init', 'archie_rombo_footer_widgets' );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function archie_rombo_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'archie_rombo_pingback_header' );



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function archie_rombo_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'archie_rombo_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'archie_rombo_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'archie_rombo_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function archie_rombo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function archie_rombo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}





// Include Theme Dashboard
require get_template_directory() . '/includes/theme-dashboard.php';

add_filter( 'wp_title', 'archie_rombo_custom_titles', 10, 2 );
function archie_rombo_custom_titles( $title, $sep ) {
	if ( function_exists( 'ot_get_option' ) && ot_get_option( 'enable_custom_titles' ) === 'on' ) {
		$title = 'Some other title' . $title;
	}

	return $title;
}

function archie_rombo_register_block_styles() {
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
}
add_action( 'init', 'archie_rombo_register_block_styles' );




function archie_rombo_register_block_patterns() {
	register_block_pattern(
		'archie-rombo/my-example',
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
add_action( 'init', 'archie_rombo_register_block_patterns' );





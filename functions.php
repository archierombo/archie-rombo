<?php
/**
 * Archie-Rombo Theme Functions
 * 
 * Only works in WordPress 5.8 or later.
 */


if ( version_compare( $GLOBALS['wp_version'], '5.8', '<' ) ) {
	
	return;
}

if ( ! function_exists( 'setup' ) ) :
	function setup() {
//Theme Options
//adding custom logo support
//add_theme_support('custom-logo',array('height' => 100,'width' => 400,'flex-height' => true,'flex-width'  => true,'header-text' => array( 'site-title', 'site-description' ),'unlink-homepage-logo' => true, ));




// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
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
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

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
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/fontawesome-6.5.1-web-pro/css/all.min.css', array(), '6.5.1', 'all');
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
	wp_enqueue_script('jquery');
	wp_register_script('color-modes', get_template_directory_uri() . '/js/color-modes.js', array(), '5.3.2', true);
	wp_register_script('popper', get_template_directory_uri() . '/js/popper.min.js', array(), '5.3.2', true);
	wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
	wp_register_script('lazyload', get_template_directory_uri() . '/js/lazyload.js', array(), ' 2.0.0-rc.2', true);


	
		
	wp_enqueue_script('modernizr-custom-js');
	wp_enqueue_script('classie');
	wp_enqueue_script('uisearch');
	wp_enqueue_script('color-modes');
	wp_enqueue_script('popper');
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('lazyload');
	wp_enqueue_script('searchscript');
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





// Hook to add the 'Theme Options' menu items
add_action( 'admin_menu', 'archierombo_add_theme_menu' );


//Theme Options main function
function archierombo_add_theme_menu() {
    // Add the main theme options menu
    add_menu_page(
        'Theme Options',        // Page title
        'Theme Options',        // Menu title
        'manage_options',       // Capability
        'archierombo_theme_options',  // Menu slug
        'archierombo_theme_options_page', // Function to display the page content
        'dashicons-admin-generic', // Icon (optional)
        61                      // Position in the menu
    );

    // Add a submenu for Custom Logo under the Theme Options menu
    add_submenu_page(
        'archierombo_theme_options',  // Parent slug (matches the slug of the main menu)
        'Custom Logo',                // Page title
        'Custom Logo',                // Menu title
        'manage_options',             // Capability
        'archierombo_custom_logo',    // Submenu slug
        'archierombo_custom_logo_page'	// Function to display the page content

        
    );
}

/**
 * Function to display the content of the main theme options page.
 */
function archierombo_theme_options_page() {
    echo '<div class="wrap">';
    echo '<h1 style="text-align:center">Theme Options</h1>';
    echo '<table  style="border:2px solid #495057;margin-left:auto;margin-right:auto;width:80%;">
  <thead>
   
  </thead>
  <tbody>
    <tr>
      
      <td>Logo Options</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>';
}

/**
 * Function to display the content of the "Custom Logo" submenu page.
 */
function archierombo_custom_logo_page() {
    echo '<div class="wrap">';
    echo '<h1>Custom Logo Settings</h1>';

    // Enqueue the WordPress media uploader scripts
    wp_enqueue_media();

    // Get the currently saved logo
    $custom_logo = get_option('archierombo_custom_logo');

    echo '<form method="post" action="options.php">';
    // Output security fields for the registered setting "archierombo_options"
    settings_fields( 'archierombo_options' );
    echo '<table class="form-table">';
    echo '<tr valign="top">';
    echo '<th scope="row">Select Custom Logo</th>';
    echo '<td>';
    echo '<input type="button" class="button button-secondary" id="upload_logo_button" value="Select or Upload Logo" />';
    echo '<input type="hidden" id="custom_logo" name="archierombo_custom_logo" value="' . esc_attr( $custom_logo ) . '" />';
    if ( $custom_logo ) {
        echo '<img id="logo_preview" src="' . esc_url( $custom_logo ) . '" alt="Custom Logo" style="max-width: 300px; display:block; margin-top:10px;" />';
    } else {
        echo '<img id="logo_preview" src="" style="max-width: 300px; display:none; margin-top:10px;" />';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    submit_button('Save Logo');
    echo '</form>';

    
    ?>
    <style type="text/css">
    	table {
    caption-side: bottom;
    border-collapse: collapse;
}
    </style>
    <script type="text/javascript">
    	// JavaScript to handle the media uploader
    jQuery(document).ready(function($){
        var mediaUploader;

        $('#upload_logo_button').click(function(e) {
            e.preventDefault();

            // If the uploader object has already been created, reopen the dialog
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            // Extend the wp.media object
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Logo',
                button: {
                    text: 'Choose Logo'
                },
                multiple: false
            });

            // When a file is selected, grab the URL and set it as the value of the input field
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#custom_logo').val(attachment.url);
                $('#logo_preview').attr('src', attachment.url).show();
            });

            // Open the uploader dialog
            mediaUploader.open();
        });
    });
    </script>
    <?php
}

// Register the setting for the custom logo
add_action( 'admin_init', 'archierombo_register_custom_logo_setting' );

function archierombo_register_custom_logo_setting() {
    register_setting( 'archierombo_options', 'archierombo_custom_logo' );
}
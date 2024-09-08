<?php
/**
 * Aussie Home Haven functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aussie_Home_Haven
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
//Navwalker class
/**
 * Register Custom Navigation Walker
 */
if ( ! file_exists( get_template_directory() . '/inc/bootstrap-navwalker.php' ) ) {
    // File does not exist... return an error.
    return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
    // File exists... require it.
    require_once get_template_directory() . '/inc/bootstrap-navwalker.php';
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aussie_home_haven_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Aussie Home Haven, use a find and replace
		* to change 'aussie-home-haven' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'aussie-home-haven', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'aussie-home-haven' ),
			'secondary' => esc_html__( 'Secondary', 'aussie-home-haven' ),
			'sidebar' => esc_html__( 'Sidebar', 'aussie-home-haven' ),
		)
	);

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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'aussie_home_haven_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'aussie_home_haven_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aussie_home_haven_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aussie_home_haven_content_width', 640 );
}
add_action( 'after_setup_theme', 'aussie_home_haven_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aussie_home_haven_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'aussie-home-haven' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'aussie-home-haven' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'aussie_home_haven_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aussie_home_haven_scripts() {

	//jQuery
	wp_enqueue_script('jQuery', get_template_directory_uri() . '/assets/jQuery.min.js', array(), _S_VERSION, true );

    //Default style
	wp_enqueue_style( 'aussie-home-haven-style', get_stylesheet_uri(), array(), _S_VERSION );
	
	//Bootstrap CSS
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array() );
    //Custom CSS
	wp_enqueue_style( 'custom-css', get_template_directory_uri() . '/assets/css/custom.css', array() );

	//Slick CSS
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/assets/slick/slick.css', array() );
	wp_enqueue_style( 'slick-theme-css', get_template_directory_uri() . '/assets/slick/slick-theme.css', array() );
   
	//Bootsrap JS
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), _S_VERSION, true );
	//Slick JS
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/slick/slick.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/js/custom.js', array(), _S_VERSION, true );
    
	wp_style_add_data( 'aussie-home-haven-style', 'rtl', 'replace' );

	wp_enqueue_script( 'aussie-home-haven-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aussie_home_haven_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//ACF Options Page
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));
}

// img directory url function
function img_dir_url() {
	$img_dir_url = get_template_directory_uri() . '/assets/images';
	return $img_dir_url;
}

// Featured Properties section
function featured_properties() 
{
	ob_start();
	?>
	
	<section class="section featured-property-section" id="featured-property-section">
        <!-- Top Heading area -->
       <div class="container">
          <div class="row text-center">
             <div class="col-lg-8 mx-auto col-sm-12 col-xm-12">
                <h2 class="section-heading item-space"><?php the_field( 'featured_section_heading', 'option' ); ?></h2>
                <p class="section-description item-space">
				<?php the_field( 'featured_section_description', 'option' ); ?>
                </p>               
             </div>
          </div>
          <!-- Properties area -->                
		  <div class="row">
            <?php $select_featured_properties = get_field( 'select_featured_properties', 'option' ); ?>
                <?php if ( $select_featured_properties ) : ?>
                    <?php foreach ( $select_featured_properties as $post ) :  ?>
                        <?php setup_postdata( $post ); 
						$id = $post->ID
						?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xm-12 item-space">
                            <div class="property-container">
                               <div class="f-p-img position-relative" style="background-image:url('<?php echo get_the_post_thumbnail_url($id); ?>')">
                                   <space class="f-p-price position-absolute">
                                       $<?php the_field('price', $id); ?>
                                   </space>
                               </div>
                               <div class="f-p-content">
                                <h2>
                                    <?php echo get_the_title($id); ?>
                                </h2>
                                <p>
                                    <?php echo wp_trim_words( get_the_excerpt($id), 25, '......'); ?>
                                </p>
                                <div class="f-p-details d-flex justify-content-start item-space">
                                    <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/map.png'  ?>" />
                                    <span class="f-p-item"><?php the_field('address', get_the_ID()); ?></span>
                                </div>
                                <hr>
                                  <div class="d-flex justify-content-between flex-wrap flex-row item-space">
                                     <div class="f-p-details">
                                        <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/bed.png'  ?>" />
                                        <span class="f-p-item"><?php the_field('bedrooms', get_the_ID()); ?>Bedrooms</span>
                                    </div>
                                     <div class="f-p-details">
                                        <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/bath.png'  ?>" />
                                        <span class="f-p-item"><?php the_field('bath', get_the_ID()); ?>Bath</span>
                                    </div>
                                     <div class="f-p-details">
                                        <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/area.png'  ?>" />
                                        <span class="f-p-item"><?php the_field('property_size', get_the_ID()); ?>mq</span>
                                    </div>
                                  </div>
                               </div>
                            </div>
                        </div> 
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
           </div>
          <!-- Properties area -->
		   <div class="row">
			<div class="col-lg-12 text-center">
				<?php $button_for_featured_property = get_field( 'button_for_featured-property', 'option' ); ?>
				<?php if ( $button_for_featured_property ) : ?>
					<a href="<?php echo esc_url( $button_for_featured_property['url'] ); ?>" class="btn-global" target="<?php echo esc_attr( $button_for_featured_property['target'] ); ?>"><?php echo esc_html( $button_for_featured_property['title'] ); ?></a>
				<?php endif; ?>
			</div>
		   </div>        
       </div>
    </section>

	<?php
	$html = ob_get_clean();
	return $html;
}
<?php
// Start the engine
require_once( TEMPLATEPATH . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Arconix Computers' );
define( 'CHILD_THEME_URL', 'http://arconixpc.com' );
define( 'CHILD_THEME_VERSION', '3.0' );

remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_footer', 'genesis_do_footer' );

add_action( 'init', 'arconix_post_type_supports' );
add_action( 'wp_enqueue_scripts', 'arconix_load_scripts' );
add_action( 'genesis_meta', 'arconix_add_viewport_meta_tag' );
add_action( 'genesis_footer', 'arconix_do_footer' );
add_filter( 'pre_get_posts', 'arconix_pre_get_posts' );
add_filter( 'arconix_do_footer_output', 'do_shortcode', 20 );
add_filter( 'genesis_post_info', 'arconix_post_info' );
add_filter( 'genesis_post_meta', 'arconix_post_meta' );
add_filter( 'genesis_comment_form_args', 'arconix_comment_form_args' );
add_filter( 'arconix_button_shortcode_args', 'arconix_child_button_args' );
add_filter( 'arconix_portfolio_defaults', 'arconix_child_portfolio_args' );
add_filter( 'widget_tag_cloud_args', 'arconix_tag_cloud_widget' );
add_filter( 'pre_register_arconix_plugins_css', '__return_false' );
add_filter( 'pre_register_arconix_portfolio_css', '__return_false' );
add_filter( 'pre_register_arconix_shortcodes_css', '__return_false' );
add_filter( 'pre_register_arconix_testimonials_css', '__return_false' );

// Add Structural Wraps
add_theme_support( 'genesis-structural-wraps', array( 'header', 'inner', 'footer' ) );

// Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );

// Add our own Image size for the portfolio
add_image_size( 'arconix-thumb', 320, 200 ); 

// Sets Content Width
$content_width = apply_filters( 'content_width', 740, 740, 1140 );

// Configure layout settings
genesis_set_default_layout( 'content-sidebar' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content' );
unregister_sidebar( 'sidebar-alt' );

// Add additional sidebar areas
genesis_register_sidebar( array(
    'id' => 'home-top',
    'name' => __( 'Home Top', 'arconix' ),
    'description' => __( 'This single area is the top widget area on the homepage.', 'arconix' )
) );

genesis_register_sidebar( array(
    'id' => 'feature-block',
    'name' => __( 'Feature Block', 'arconix' ),
    'description' => __( 'This single area is below home top.', 'arconix' )
) );

/**
 * Add post type support for genesis-specific options
 *
 * @since 3.0
 */
function arconix_post_type_supports() {
    $post_types = array( 'plugins', 'portfolio', 'testimonials' );
    $supports = array( 'genesis-simple-sidebars', 'genesis-layouts' );

    foreach( $post_types as $post_type ) {
        if( ! post_type_exists( $post_type ) ) continue;

        foreach ( $supports as $support ) {
            add_post_type_support( $post_type, $support ) ;
        }
    }
}

/**
 * Load Google fonts
 *
 * @since 3.0
 */
function arconix_load_scripts() {
    wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Serif', false, CHILD_THEME_VERSION );
}

/**
 * Add Viewport meta tag for mobile browsers
 *
 * @since 3.0
 */
function arconix_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

/**
 * Hook in before the main query is run and modify some values
 *
 * @since 3.0
 * @param  array $query
 * @return void
 */
function arconix_pre_get_posts( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'portfolio' ) ) {
        $query->set( 'posts_per_page', 9 );
        return;
    }

    if ( is_post_type_archive( 'plugin' ) ) {
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'asc' );
        $query->set( 'posts_per_page', -1 );
        return;
    }

}

/**
 * Modify the Post Info text
 *
 * @since 3.0
 * @param string $post_info
 * @return string
 */
function arconix_post_info( $post_info ) {
    return '[post_date] [post_comments] [post_edit]';
}

/**
 * Modify the Post Meta text
 *
 * @since 3.0
 * @param string $post_meta
 * @return string
 */
function arconix_post_meta( $post_meta ) {
    return '[post_categories before="Filed In: "] [post_tags before="Tagged: "]';
}

/**
 * Custom Footer
 *
 * @since 3.0
 */
function arconix_do_footer() {
   $backtotop_text = wp_nav_menu( array('menu' => 'Footer Nav' ) );
   $creds_text = 'Powered by [footer_wordpress_link] and <a href="http://studiopress.com/themes/genesis">Genesis</a> | Hosted by <a href="http://arcnx.co/ix">IX Webhosting</a> | [footer_loginout]';
   $output = $backtotop_text . '<div class="creds">' . $creds_text . '</div>';
   
   echo apply_filters( 'arconix_do_footer_output', $output );
}

/**
 * Modify the Comment Header Text
 *
 * @since 3.0
 * @param array $args
 * @return array $args
 */
function arconix_comment_form_args( $args ) {
    $args['title_reply'] = 'Leave a Comment';
    return $args;
}

/**
 * Modify Standard Arconix Shortcodes Button Color
 *
 * @since 3.0
 * @param array $defaults
 * @return array $defaults
 */
function arconix_child_button_args( $defaults ) {
    $defaults['color'] = 'green';
    return $defaults;
}

/**
 * Modify the post type registration for the portfolio so we can use the CPT archive instead of the shortcode
 *
 * @since 3.0
 * @param array $defaults
 * @return array $defaults
 */
function arconix_child_portfolio_args( $defaults ) {
    $defaults['post_type']['args']['has_archive'] = true;
    return $defaults;
}

/**
 * Modify the Tag Cloud parameters
 *  
 * @since 3.0
 * @version  3.0.1
 * @param  array $args 
 * @return array $args
 */
function arconix_tag_cloud_widget( $args ) {
    $args['largest'] =  16; // largest tag
    $args['smallest'] = 16; // smallest tag
    $args['unit'] = 'px'; // tag font unit
    $args['format'] = 'list'; // ul with a class of wp-tag-cloud
    $args['orderby'] = 'count'; // sort by count
    $args['number'] = 5; // set the number of tags to display

    return $args;
}

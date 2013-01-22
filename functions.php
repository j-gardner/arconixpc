<?php
// Start the engine
require_once( TEMPLATEPATH . '/lib/init.php' );

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Arconix Computers' );
define( 'CHILD_THEME_URL', 'http://arconixpc.com' );
define( 'CHILD_THEME_VERSION', '3.0' );

add_action( 'wp_enqueue_scripts', 'arconix_load_google_fonts' );
add_action( 'genesis_meta', 'arconix_add_viewport_meta_tag' );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_filter( 'genesis_post_info', 'arconix_post_info' );
add_filter( 'genesis_post_meta', 'arconix_post_meta' );
add_filter( 'genesis_footer_backtotop_text', 'arconix_footer_backtotop_text' );
add_filter( 'genesis_footer_creds_text', 'arconix_footer_creds_text' );
add_filter( 'genesis_comment_form_args', 'arconix_comment_form_args' );
add_filter( 'arconix_button_shortcode_args', 'arconix_child_button_args', 20 );

add_theme_support( 'genesis-structural-wraps', array( 'header', 'inner', 'footer' ) ); // Add Structural Wraps
remove_theme_support( 'genesis-menus' ); // Unregister primary/secondary navigation menus

add_image_size( 'arconix-thumb', 320, 200, TRUE ); // Add our own Image size for the portfolio

genesis_set_default_layout( 'content-sidebar' );

// Remove layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content' );

unregister_sidebar( 'sidebar-alt' ); // Remove Secondary sidebar

// Add additional sidebar areas
genesis_register_sidebar( array(
    'id' => 'home-full',
    'name' => __( 'Full Width Home', 'arconix' ),
    'description' => __( 'This single area is the top widget area on the homepage.', 'arconix' )
) );

genesis_register_sidebar( array(
    'id' => 'home-left',
    'name' => __( 'Home-Left', 'arconix' ),
    'description' => __( 'This is the left-featured section on the homepage.', 'arconix' )
) );

genesis_register_sidebar( array(
    'id' => 'home-right',
    'name' => __( 'Home-Right', 'arconix' ),
    'description' => __( 'This is the right-featured section on the homepage.', 'arconix' )
) );

genesis_register_sidebar( array(
    'id' => 'feature-block',
    'name' => __( 'Feature-Footer', 'arconix' ),
    'description' => __( 'This single area is below the home block.', 'arconix' )
) );

genesis_register_sidebar( array(
    'id' => 'single-plugin',
    'name' => __( 'Individual Plugin Plage', 'arconix' ),
    'description' => __( 'Sidebar on Individual Plugin Pages.', 'arconix' )
) );

/**
 * Load the necessary Google Fonts
 *
 * @since 3.0
 */
function arconix_load_google_fonts() {
    wp_enqueue_style(
    	'google-fonts',
    	'http://fonts.googleapis.com/css?family=Droid+Sans:700',
    	false,
        CHILD_THEME_VERSION
    );
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
 * Modify the "Return to Top" footer text
 *
 * @since 3.0
 * @param string $backtotop
 * @return string
 */
function arconix_footer_backtotop_text( $backtotop ) {
    return '[footer_copyright] <a href="http://arcnx.co/1" class="arconix-footer-site-link">' . CHILD_THEME_NAME . '</a>';
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
 * Modify the Credits footer text
 *
 * @since 3.0
 * @param string $creds
 * @return string
 */
function arconix_footer_creds_text( $creds ) {
    return 'Powered by [footer_wordpress_link] and <a href="http://studiopress.com/themes/genesis">Genesis</a> &bull; Hosted by <a href="http://arcnx.co/ix">IX Webhosting</a> &bull; [footer_loginout]';
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
function child_button_args( $defaults ) {
    $defaults['color'] = 'child-color';
    return $defaults;
}

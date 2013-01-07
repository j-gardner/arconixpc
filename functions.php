<?php
/* Start the engine */
require_once( TEMPLATEPATH . '/lib/init.php' );

/* Add Google fonts */
add_action( 'wp_enqueue_scripts', 'arconix_load_google_fonts' );
function arconix_load_google_fonts() {
    wp_enqueue_style(
    	'google-fonts',
    	'http://fonts.googleapis.com/css?family=Droid+Sans:700',
    	false,
        '3.0'
    );
}

/* Add Viewport meta tag for mobile browsers */
function arconix_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}
add_action( 'genesis_meta', 'arconix_add_viewport_meta_tag' );

/* Add Structural Wraps */
add_theme_support( 'genesis-structural-wraps',
    array( 'header', 'inner', 'footer' )
);

/* Add home widget areas */
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

/* Add our own Image size for the portfolio */
add_image_size( 'arconix-thumb', 320, 200, TRUE );

/* Remove Breadcrumbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

/* Remove nav menus */
remove_action( 'genesis_after_header', 'genesis_do_nav' );

/* Remove layout settings */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

/* Remove Secondary sidebar */
unregister_sidebar( 'sidebar-alt' );

/* Modify the "Return to Top Text" */
function arconix_footer_backtotop_text( $backtotop ) {
    $backtotop = '[footer_copyright] <a href="http://arcnx.co/1" class="arconix-footer-site-link">' . get_bloginfo('name') . ' </a>';

    return $backtotop;
}
add_filter('genesis_footer_backtotop_text', 'arconix_footer_backtotop_text');

/* Modify Credits section */
function arconix_footer_creds_text( $creds ) {
    $creds = 'Powered by [footer_wordpress_link] and <a href="http://studiopress.com/themes/genesis">Genesis</a> &bull; Hosted by <a href="http://arcnx.co/ix">IX Webhosting</a> &bull; [footer_loginout]';

    return $creds;
}
add_filter( 'genesis_footer_creds_text', 'arconix_footer_creds_text' );

/* Modify Comment Header text */
function arconix_comment_form_args( $args ) {
    $args['title_reply'] = 'Leave a Comment';

    return $args;
}
add_filter('genesis_comment_form_args', 'arconix_comment_form_args');

/* Modify Standard Arconix Shortcodes Button Color */
function child_button_args( $defaults ) {
    $defaults['color'] = 'arconix';

    return $defaults;
}
add_filter( 'arconix_button_shortcode_args', 'arconix_child_button_args', 20 );
?>
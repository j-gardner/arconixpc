<?php
add_action( 'genesis_meta', 'arconix_home_genesis_meta' );
add_action( 'wp_enqueue_scripts', 'arconix_load_home_scripts' );

/**
 * Load in a custom google font for just the home page
 * 
 * @since 3.0
 */
function arconix_load_home_scripts() {
	wp_enqueue_style( 'google-fonts-home', 'http://fonts.googleapis.com/css?family=Rock+Salt', false, CHILD_THEME_VERSION );
}


/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 * 
 * @since 3.0
 */
function arconix_home_genesis_meta() {
    if( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-bottom' ) ) {
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_before_loop' , 'arconix_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
    }
}

/**
 * Define our home page widget areas
 *
 * @since 3.0
 */
function arconix_home_loop_helper() {
    genesis_widget_area( 'home-top', array( 'before' => '<div class="home-top">' ) );

    genesis_widget_area( 'feature-block', array( 'before' => '<div class="feature-block">' ) );
}

genesis();
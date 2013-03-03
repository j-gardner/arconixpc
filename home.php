<?php
add_action( 'genesis_meta', 'arconix_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function arconix_home_genesis_meta() {
    if( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-bottom' ) ) {
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_before_loop' , 'arconix_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
    }
}

function arconix_home_loop_helper() {
    genesis_widget_area( 'home-top', array( 'before' => '<div class="home-top">' ) );

    genesis_widget_area( 'feature-block', array( 'before' => '<div class="feature-block">' ) );
}

genesis();
<?php
/**
 * The Docs post type archive template
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_before_loop', 'arconix_before_loop' );

remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );




/**
 * Display the Post Type Archive Title
 *
 * @since 3.0
 */
function arconix_before_loop() {
    echo '<h1 class="entry-title">WordPress Plugin Documentation</h1>';
}

genesis();
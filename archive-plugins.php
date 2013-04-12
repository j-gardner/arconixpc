<?php
/**
 * The Plugins post type archive template
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_post_meta', 'arconix_plugin_archive_post_meta' );

add_action( 'genesis_before_loop', 'arconix_before_loop' );

remove_action( 'genesis_before_post_content', 'genesis_post_info' );


/**
 * Return a custom meta for the "Plugins" archive
 *
 * @global object $post
 * @param string $post_meta
 * @return string $post_meta
 * @since 3.0
 */
function arconix_plugin_archive_post_meta( $post_meta ){
    global $post;
    $slug = get_post_meta( $post->ID, '_acpl_slug', true );
    if( ! $slug ) return;

    $details = unserialize( ARCONIX_PLUGINS::get_wporg_custom_plugin_data( $slug ) );

    if( ! $details ) return;

    $post_meta = 'Version: ' . $details->version . ' | Downloads: ' . number_format( $details->downloaded );

    return $post_meta;
}

/**
 * Display the Post Type Archive Title
 *
 * @since 3.0
 */
function arconix_before_loop() {
    echo '<h1 class="entry-title">WordPress Plugins</h1>';
}

genesis();
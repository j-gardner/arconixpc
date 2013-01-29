<?php
/**
 * The Plugins post type archive template
 */

remove_action( 'genesis_before_post_content', 'genesis_post_info' );

add_filter( 'pre_get_posts', 'arconix_plugin_archive_change_order' );
add_filter( 'genesis_post_meta', 'arconix_plugin_archive_post_meta' );


/**
 * Return a custom meta for the "Plugins" archive
 *
 * @global object $post
 * @param string $post_meta
 * @return string $post_meta
 */
function arconix_plugin_archive_post_meta( $post_meta ){
    global $post;
    $slug = get_post_meta( $post->ID, '_acpl_slug', true );
    if( ! $slug ) return '';

    $details = unserialize( ARCONIX_PLUGINS::get_wporg_custom_plugin_data( $slug ) );

    if( ! $details ) return;

    $post_meta = 'Version: ' . $details->version . ' | Last Updated: ' . date( get_option( 'date_format' ), strtotime( $details->last_updated ) );
    $post_meta .= ' <span class="arconix-plugins-ago">(' . ARCONIX_PLUGINS::ago( strtotime( $details->last_updated ) ) . ')</span> | Downloads: ' . $details->downloaded;

    return $post_meta;
}

/**
 * Change the Sort Order on the "Plugins" archive
 *
 * @param array $query
 * @return array $query
 */
function arconix_plugin_archive_change_order( $query ) {
    $query->set( 'orderby', 'title' );
    $query->set( 'order', 'asc' );

    return $query;
}

genesis();
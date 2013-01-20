<?php
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
//remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

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

    $details = get_wporg_custom_plugin_data( $slug );

    $post_meta = 'Version: ' . $details->version . ' | ' . 'Last Updated: ' . date( get_option( 'date_format' ), strtotime( $details->last_updated ) );
    $post_meta .= '<span class="arconix_plugins_ago">(' . ARCONIX_PLUGINS::ago( strtotime( $details->last_updated ) ) . ')</span> | ' . 'Downloads: ' . $details->downloaded;

    return $post_meta;
}

add_filter( 'pre_get_posts', 'arconix_plugin_archive_change_order' );
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
?>
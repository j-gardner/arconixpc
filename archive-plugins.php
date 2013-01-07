<?php
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

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
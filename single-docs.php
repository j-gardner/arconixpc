<?php
/**
 * Page template for the single Docs Post Type item
 *
 * @since  3.1
 */

remove_filter( 'genesis_post_info', 'arconix_post_info' );
remove_filter( 'genesis_post_meta', 'arconix_post_meta' );
add_filter( 'genesis_post_info', '__return_null' );
add_filter( 'genesis_post_meta', 'arconix_docs_meta' );

/**
 * Modify the Post Meta text
 *
 * @since 3.1
 * @param string $post_meta
 * @return string
 */
function arconix_docs_meta( $post_meta ) {
    $return = '<div class="modified-date">' . the_modified_date( $before ='Last updated:', $echo = false ) . '</div>';

    return $return;
}
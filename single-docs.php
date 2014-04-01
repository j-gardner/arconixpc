<?php
/**
 * Page template for the single Docs Post Type item
 *
 * @since  3.1
 */

remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );


genesis();
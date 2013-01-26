<?php
/**
 * The Portfolio post type archive template
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

add_action( 'genesis_before_post_title', 'arconix_portfolio_archive_image' );

remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_post_content', 'genesis_do_post_image' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

/**
 * Add the featured image to the portfolio archive
 *
 * @since 3.0
 */
function arconix_portfolio_archive_image() {
    if( has_post_thumbnail() ) {
        // Get the url to the 'large' image
        $_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );

        echo '<div class="arconix-portfolio-featured-image">';
        echo '<a href="' . esc_url( $_portfolio_img_url[0] ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
        echo get_the_post_thumbnail( $thumbnail->ID, 'arconix-thumb' );
        echo '</a>';
        echo '</div>';
    }
}

genesis();
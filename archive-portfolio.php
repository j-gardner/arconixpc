<?php
/**
 * The Portfolio post type archive template
 */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
add_filter( 'genesis_link_post_title', '__return_false' );
add_filter( 'genesis_post_title_text', 'arconix_post_title_text' );

add_action( 'genesis_after_post_title', 'arconix_portfolio_archive_image' );

remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_post_content', 'genesis_do_post_image' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );

/**
 * Modify the Post title
 *
 * @since 3.0
 * @param  string $title 
 * @return string $title
 */
function arconix_post_title_text( $title ) {
    //$title = get_the_content() . '<span class="arconix-portfolio-title-link">'
}

/**
 * Add the featured image to the portfolio archive
 *
 * @since 3.0
 * @return n/a Return early if the portfolio item doesn't have an image
 */
function arconix_portfolio_archive_image() {
    if( ! has_post_thumbnail() ) return;

        // Get the url to the 'large' image
        $_portfolio_img_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'portfolio-large' );

        echo '<div class="arconix-portfolio-featured-image">';
        echo '<a href="' . esc_url( $_portfolio_img_url[0] ) . '" title="' . the_title_attribute( 'echo=0' ) . '">';
        echo get_the_post_thumbnail( $thumbnail->ID, 'arconix-thumb' );
        echo '</a>';
        echo '</div>';
}

genesis();
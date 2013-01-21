<?php
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );
add_action( 'get_header', 'arconix_change_genesis_sidebar' );
add_filter( 'arconix_plugins_content_filter', 'arconix_single_plugin_filter' );

// Change the sidebar that's loaded on this page
function arconix_change_genesis_sidebar() {
    remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
    add_action( 'genesis_sidebar', 'arconix_custom_sidebar' );
}

// Output the custom sidebar
function arconix_custom_sidebar() {
    genesis_widget_area( 'single-plugin' );
}

/**
 * Customize the content shown on this page
 *
 * @since 3.0
 * @param string $content
 * @return string $content
 */
function arconix_single_plugin_filter( $content ) {
    $custom = get_post_custom();
    isset( $custom["_acpl_slug"][0] )? $slug = $custom["_acpl_slug"][0] : $slug = '';

    // Bail if $slug is not defined
    if( ! $slug ) return $content;

    // Pass the slug into the WP API to get the data we need
    $details = ARCONIX_PLUGINS::get_wporg_custom_plugin_data( $slug );
    $details = unserialize( $details );

    // Bail if $details isn't defined
    if( ! $details ) return $content;

    $sections = $details->sections;
    $description = $sections['description'];
    $installation = $sections['installation'];
    $screenshots = $sections['screenshots'];
    $changelog = $sections['changelog'];
    $faq = $sections['faq'];

    // Our page content
    $content = '[tabs]';
    $content .= '[tab title="Description"]' . $description . '[/tab]';
    $content .= '[tab title="Installation"]' . $installation . '[/tab]';
    $content .= '[tab title="Screenshots"]' . $screenshots . '[/tab]';
    $content .= '[tab title="Changelog"]' . $changelog . '[/tab]';
    $content.= '[tab title="FAQ"]' . $faq . '[/tab]';
    $content .= '[/tabs]';

    return $content;
}

genesis();
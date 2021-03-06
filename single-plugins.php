<?php
/**
 * Page template for the single Plugins Post Type item
 *
 * @since  3.0
 */

// List of shortcodes I want removed
$rs = array( 'portfolio', 'faq', 'ac-testimonials', 'ac-flexslider', 'button', 'box' );

foreach ($rs as $s ) {
    remove_shortcode( $s );
}

remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'genesis_after_post', 'genesis_do_author_box_single' );

add_action( 'get_header', 'arconix_change_genesis_sidebar' );

add_filter( 'arconix_plugins_content_filter', 'arconix_single_plugin_filter' );

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
    $details = unserialize( ARCONIX_PLUGINS::get_wporg_custom_plugin_data( $slug ) );

    // Bail if $details isn't defined
    if( ! $details ) return $content;

    $sections =     $details->sections;
    $description =  $sections['description'];
    $installation = $sections['installation'];
    $screenshots =  $sections['screenshots'];
    $faq =          $sections['faq'];
    $changelog =    $sections['changelog'];

    // Our page content
    $content  = '[tabs]';
    $content .= '[tab title="Description"]' . $description . '[/tab]';    
    $content .= '[tab title="Screenshots"]' . $screenshots . '[/tab]';
    $content .= '[tab title="Installation"]' . $installation . '[/tab]';
    $content .= '[tab title="FAQ"]' . $faq . '[/tab]';
    $content .= '[tab title="Changelog"]' . $changelog . '[/tab]';
    $content .= '[/tabs]';

    return $content;
}

genesis();
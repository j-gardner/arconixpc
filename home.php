<?php 
add_action( 'genesis_meta', 'arconix_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 * 
 */
function arconix_home_genesis_meta() {

    if( is_active_sidebar( 'home-full' ) || is_active_sidebar( 'home-left' ) || is_active_sidebar( 'home-right' ) ) {
        remove_action( 'genesis_loop', 'genesis_do_loop' );
        add_action( 'genesis_loop', 'arconix_home_loop_helper' );
        add_action( 'genesis_before_loop' , 'arconix_before_home_loop_helper' );
        add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
    }
}

function arconix_home_loop_helper() {
    
    echo '<div id="home-top">';
    
    if( is_active_sidebar( 'home-full' ) ) {
        echo '<div class="home-full">';
        dynamic_sidebar( 'home-full' );
        echo '</div><!-- end .home-full -->';
    }

    if( is_active_sidebar( 'home-left' ) ) {
        echo '<div class="home-left">';
        dynamic_sidebar( 'home-left' );
        echo '</div><!-- end .home-left -->';
    }

    if( is_active_sidebar( 'home-right' ) ) {
        echo '<div class="home-right">';
        dynamic_sidebar( 'home-right' );
        echo '</div><!-- end .home-right -->';
    }
    
    echo '</div>';
    
    echo '<div id="home-feature-block">';
    
    if( is_active_sidebar( 'feature-block' ) ) {
        echo '<div class="feature-block">';
        dynamic_sidebar( 'feature-block' );
        echo '</div><!-- end .feature-block -->';
    }
    
    echo '</div>';

}

function arconix_before_home_loop_helper() {
    
//    echo '<h1 class="entry-title">'; 
//    post_type_archive_title();
//    echo '</h1>';
//    echo '<div class="plugins-description">Below is a list of free WordPress plugins that I have developed</div>';
    
}

genesis();
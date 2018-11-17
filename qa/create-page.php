<?php

# https://www.wpexplorer.com/create-wordpress-posts-pages-using-php/

if ( ! function_exists( 'hbt_create_post' ) ) {

    function hbt_create_post() {

        $page_title = 'KMW Functions and Shortcodes Development Test Page';
        $content = file_get_contents( plugin_dir_url( __FILE__ ) . 'content.txt');

        $post_data = array(
            'post_title'    => $page_title,
            'post_content'  => $content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => null,
        );

        if ( get_page_by_title( $page_title ) == NULL ) {
            wp_insert_post( $post_data );
        }
        
    }

    add_action( 'admin_init', 'hbt_create_post' );

}
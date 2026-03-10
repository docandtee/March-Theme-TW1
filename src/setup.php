<?php

/**
 * Theme setup
 */

if (!function_exists('docandtee_setup')) {
    function docandtee_setup()
    {

      // Enable plugins to manage the document title
      // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
        add_theme_support('title-tag');

      // Register wp_nav_menu() menus
      // http://codex.wordpress.org/Function_Reference/register_nav_menus
        register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'docandtee'),
        'dashboard_navigation' => __('Dashboard Navigation', 'docandtee'),
        ]);

      // Enable post formats
      // http://codex.wordpress.org/Post_Formats
        add_theme_support('post-formats', ['gallery', 'video', 'audio']);
        
        // Add support for responsive embeds.
        add_theme_support('responsive-embeds');

        // Switch default core markup for search form, comment form, and comments to output valid HTML5.
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            )
        );

        /* add responsive embeds for Guttenberg */
        add_theme_support('responsive-embeds');

        /* Declare WooCommerce support. */
        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-slider' );
        

    }
    add_action('after_setup_theme', 'docandtee_setup');
}

<?php

// Enqueue parent theme styles, then child theme styles
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('flavor-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('martin-theme-style', get_stylesheet_uri(), ['flavor-style']);
});

// Declare WooCommerce support
add_action('after_setup_theme', function () {
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
});

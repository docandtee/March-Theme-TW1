<?php
// Enable post thumbnails
// http://codex.wordpress.org/Post_Thumbnails
// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
// http://codex.wordpress.org/Function_Reference/add_image_size
add_theme_support('post-thumbnails');
/* add_image_size('custom-post-thumb', 516, 344, true); */

// update default thumbnail sizes
update_option('thumbnail_size_w', 480);
update_option('thumbnail_size_h', 480);
update_option('thumbnail_crop', 0);
update_option('medium_size_w', 782);
update_option('medium_size_h', 782);
update_option('medium_crop', 0);
update_option('medium_large_w', 960);
update_option('medium_large_h', 960);
update_option('medium_large_crop', 0);
update_option('large_size_w', 1280);
update_option('large_size_h', 1280);
update_option('large_crop', 0);

/**
 * Render a responsive image from an attachment ID
 *
 * int|null    $image_id   The attachment ID (e.g. from ACF). If null, will use post thumbnail.
 * int|null    $post_id    Post ID (only needed if using thumbnail).
 * string|null $sizes_attr Custom sizes attribute.
 * string      $class      Additional CSS class.
 */
function docandtee_responsive_image( $image_id = null, $post_id = null, $sizes_attr = null, $class = '' ) {
    // If no image ID passed, fallback to featured image
    if ( ! $image_id ) {
        $post_id  = $post_id ?: get_the_ID();
        $image_id = get_post_thumbnail_id( $post_id );
    }

    if ( ! $image_id ) {
        return; // no image available
    }

    // Get URLs for specific sizes
    $src_thumb  = wp_get_attachment_image_url( $image_id, 'thumbnail' );
    $src_small  = wp_get_attachment_image_url( $image_id, 'medium' );
    $src_medium = wp_get_attachment_image_url( $image_id, 'medium_large' );
    $src_large  = wp_get_attachment_image_url( $image_id, 'large' );
    $src_1536   = wp_get_attachment_image_url( $image_id, '1536x1536' );
    $src_2048   = wp_get_attachment_image_url( $image_id, '2048x2048' );

    // Build srcset
    $srcset = [];
    if ( $src_thumb )  $srcset[] = "{$src_thumb} 480w";
    if ( $src_small )  $srcset[] = "{$src_small} 782w";
    if ( $src_medium ) $srcset[] = "{$src_medium} 960w";
    if ( $src_large )  $srcset[] = "{$src_large} 1280w";
    if ( $src_1536 )   $srcset[] = "{$src_1536} 1536w";
    if ( $src_2048 )   $srcset[] = "{$src_2048} 2048w";

    // Default sizes if none provided
    if ( ! $sizes_attr ) {
        $sizes_attr = '(min-width: 1536px) 40vw, (min-width: 1280px) 50vw, (min-width: 960px) 60vw, 80vw';
    }

    // Get alt text (fallback: attachment title)
    $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $image_id );

    // Add class attribute if provided
    $class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';

    // Output HTML
    printf(
        '<img src="%s" srcset="%s" sizes="%s" alt="%s"%s />',
        esc_url( $src_thumb ),
        esc_attr( implode( ', ', $srcset ) ),
        esc_attr( $sizes_attr ),
        esc_attr( $alt ),
        $class_attr
    );
}

/* uses:
news card image: docandtee_responsive_image(null, null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'aspect-16/10 w-full object-cover');
full width hero: docandtee_responsive_image(null, null, '(min-width: 1280px) 80vw, 100vw', 'parallax-bg w-full h-full object-cover');
standard page width: docandtee_responsive_image(null, null, null, 'aspect-16/10 w-full object-cover');
Staggered block image with custom image id: docandtee_responsive_image( $image, null, '(min-width: 960px) 50vw, 100vw', 'w-full h-full object-cover' );
*/


/**
 * Override default image sizes attribute for content images
 */
function docandtee_content_image_sizes( $sizes, $size, $image_src, $image_meta, $attachment_id ) {
    // Example: enforce your default rules
    $sizes = '(min-width: 1536px) 40vw, (min-width: 1280px) 60vw, (min-width: 960px) 70vw, 80vw';

    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'docandtee_content_image_sizes', 10, 5 );

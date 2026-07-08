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
 * Uses attachment metadata for correct size URLs and dimensions. Supports Performance Lab
 * Modern Image Formats: AVIF filenames use the -jpg.avif / -png.avif / -gif.avif convention.
 * SVG and other formats use the original file as fallback (no AVIF variant).
 *
 * @param int|null    $image_id   The attachment ID (e.g. from ACF). If null, will use post thumbnail.
 * @param int|null    $post_id    Post ID (only needed if using thumbnail).
 * @param string|null $sizes_attr Custom sizes attribute.
 * @param string      $class      Additional CSS class.
 */
function docandtee_responsive_image( $image_id = null, $post_id = null, $sizes_attr = null, $class = '' ) {
    // If no image ID passed, fallback to featured image
    if ( ! $image_id ) {
        $post_id  = $post_id ?: get_the_ID();
        $image_id = get_post_thumbnail_id( $post_id );
    }

    if ( ! $image_id ) {
        return;
    }

    $meta = wp_get_attachment_metadata( $image_id );
    if ( ! $meta || empty( $meta['file'] ) ) {
        return;
    }

    $upload_dir = wp_upload_dir();
    if ( ! empty( $upload_dir['error'] ) ) {
        return;
    }

    $base_url = $upload_dir['baseurl'] . '/' . dirname( $meta['file'] );
    $base_dir = $upload_dir['basedir'] . '/' . dirname( $meta['file'] );

    // Size slugs and their width descriptors for srcset (order matches WordPress size order)
    $sizes_config = [
        'thumbnail'    => 480,
        'medium'       => 782,
        'medium_large' => 960,
        'large'        => 1280,
        '1536x1536'    => 1536,
        '2048x2048'    => 2048,
    ];

    $srcset_entries     = [];
    $avif_srcset_entries = [];
    $has_any_avif       = false;

    foreach ( $sizes_config as $size_name => $width_fallback ) {
        if ( empty( $meta['sizes'][ $size_name ]['file'] ) ) {
            continue;
        }

        $file  = $meta['sizes'][ $size_name ]['file'];
        $width = ! empty( $meta['sizes'][ $size_name ]['width'] ) ? (int) $meta['sizes'][ $size_name ]['width'] : $width_fallback;
        $url   = $base_url . '/' . $file;

        if ( empty( $srcset_entries ) ) {
            $src = $url;
        }
        $srcset_entries[] = esc_url( $url ) . ' ' . $width . 'w';

        // Performance Lab naming: basename-jpg.avif, -png.avif, -gif.avif (same dir as original).
        // SVG and other extensions don't get AVIF; we use original URL as fallback for those.
        $avif_file = preg_replace_callback(
            '/\.(jpe?g|png|gif)(\?.*)?$/i',
            function ( $m ) {
                $ext    = strtolower( $m[1] );
                $suffix = ( $ext === 'jpeg' || $ext === 'jpg' ) ? 'jpg' : ( $ext === 'png' ? 'png' : 'gif' );
                return '-' . $suffix . '.avif' . ( isset( $m[2] ) ? $m[2] : '' );
            },
            $file
        );

        // Use AVIF URL when file exists; otherwise fallback to original (JPEG/PNG/GIF/SVG etc.) for this size
        if ( $avif_file !== $file ) {
            $avif_path = $base_dir . '/' . $avif_file;
            if ( file_exists( $avif_path ) ) {
                $avif_url = $base_url . '/' . $avif_file;
                $avif_srcset_entries[] = esc_url( $avif_url ) . ' ' . $width . 'w';
                $has_any_avif = true;
            } else {
                $avif_srcset_entries[] = esc_url( $url ) . ' ' . $width . 'w';
            }
        } else {
            $avif_srcset_entries[] = esc_url( $url ) . ' ' . $width . 'w';
        }
    }

    // When image is smaller than all registered sizes (e.g. small PNG), WordPress may not create any
    // sub-sizes; use the full/original file so an image still displays.
    if ( empty( $srcset_entries ) ) {
        $full_file = basename( $meta['file'] );
        $full_url  = $base_url . '/' . $full_file;
        $width     = ! empty( $meta['width'] ) ? (int) $meta['width'] : 480;
        $src       = $full_url;
        $srcset_entries[] = esc_url( $full_url ) . ' ' . $width . 'w';

        $avif_file = preg_replace_callback(
            '/\.(jpe?g|png|gif)(\?.*)?$/i',
            function ( $m ) {
                $ext    = strtolower( $m[1] );
                $suffix = ( $ext === 'jpeg' || $ext === 'jpg' ) ? 'jpg' : ( $ext === 'png' ? 'png' : 'gif' );
                return '-' . $suffix . '.avif' . ( isset( $m[2] ) ? $m[2] : '' );
            },
            $full_file
        );
        if ( $avif_file !== $full_file ) {
            $avif_path = $base_dir . '/' . $avif_file;
            if ( file_exists( $avif_path ) ) {
                $avif_url = $base_url . '/' . $avif_file;
                $avif_srcset_entries[] = esc_url( $avif_url ) . ' ' . $width . 'w';
                $has_any_avif = true;
            } else {
                $avif_srcset_entries[] = esc_url( $full_url ) . ' ' . $width . 'w';
            }
        } else {
            $avif_srcset_entries[] = esc_url( $full_url ) . ' ' . $width . 'w';
        }
    }

    if ( empty( $srcset_entries ) ) {
        return;
    }

    if ( ! $sizes_attr ) {
        $sizes_attr = '(min-width: 1536px) 40vw, (min-width: 1280px) 50vw, (min-width: 960px) 60vw, 80vw';
    }

    $alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $image_id );
    $class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';

    $has_avif = $has_any_avif;

    if ( $has_avif ) {
        echo '<picture' . $class_attr . '>';
        echo '<source type="image/avif" srcset="' . implode( ', ', $avif_srcset_entries ) . '" sizes="' . esc_attr( $sizes_attr ) . '" />';
    }

    printf(
        '<img src="%s" srcset="%s" sizes="%s" alt="%s"%s />',
        esc_url( $src ),
        esc_attr( implode( ', ', $srcset_entries ) ),
        esc_attr( $sizes_attr ),
        esc_attr( $alt ),
        $class_attr
    );

    if ( $has_avif ) {
        echo '</picture>';
    }
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

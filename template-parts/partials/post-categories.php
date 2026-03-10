<?php
$categories = get_the_category();
if ( ! empty( $categories ) ) {
    echo '<nav aria-label="Post categories" class="mb-4">';
    echo '<span class="font-bold">Categories: </span>';
    foreach( $categories as $index => $category ) {
        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="hover:text-primary transition">' . esc_html( $category->name ) . '</a>';
        if ( $index < count( $categories ) - 1 ) {
            echo ', ';
        }
    }
    echo '</nav>';
}

$tags = get_the_tags();
if ( ! empty( $tags ) ) {
    echo '<nav aria-label="Post tags">';
    echo '<span class="font-semibold">Tags: </span>';
    foreach( $tags as $index => $tag ) {
        echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="hover:text-primary transition">' . esc_html( $tag->name ) . '</a>';
        if ( $index < count( $tags ) - 1 ) {
            echo ', ';
        }
    }
    echo '</nav>';
}
?>
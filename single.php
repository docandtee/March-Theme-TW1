<?php
/**
 * Single post template file.
 *
 * @package TailPress
 */

get_header();
?>


<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <?php
        $post_type = get_post_type();

            // Try to load a template like content-single-{post_type}.php first
            if ( locate_template( "template-parts/content-single-{$post_type}.php" ) ) {
                get_template_part( 'template-parts/content-single', $post_type );
            } else {
                // Fallback to the default single content template
                get_template_part( 'template-parts/content', 'single' );
            }
        ?>
    <?php endwhile; ?>
<?php endif; ?>


<?php
get_footer();

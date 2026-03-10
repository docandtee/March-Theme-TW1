<?php
/**
 * Single page template file.
 *
 * @package TailPress
 */

get_header();

$pagewidth = get_field('page_width');
?>

    <?php if (have_posts()): ?>
        <?php get_template_part('template-parts/page-headers/page-header'); ?>
        <div class="container mx-auto <?php if( $pagewidth == 'narrow' ) { echo ' max-w-4xl '; } elseif( $pagewidth == 'fullwidth' ) { echo 'max-w-lvw'; } ?>">
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('template-parts/content', 'page'); ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

<?php
get_footer();
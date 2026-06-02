<?php
/**
 * Single page template file.
 *
 * @package TailPress
 */

get_header();

?>

    <?php if (have_posts()): ?>
        <?php get_template_part('template-parts/page-headers/page-header'); ?>
        <section class="bg-dark relative
            <?php 
            $pagewidth = get_field('page_width');
            $remove_top_padding = get_field('remove_top_padding');
            $remove_bottom_padding = get_field('remove_bottom_padding');
            if(!$remove_top_padding) { echo ' section-p-t '; } 
            if( !$remove_bottom_padding ) { echo ' section-p-b '; } 
        ?>"  aria-label="<?php echo esc_attr( get_the_title() ); ?> page content">
            <div class="container mx-auto">
                <div class="<?php if( $pagewidth == 'narrow' ) { echo ' max-w-4xl '; } elseif( $pagewidth == 'fullwidth' ) { echo 'max-w-lvw'; } ?>">
                    <?php while (have_posts()): the_post(); ?>
                        <?php get_template_part('template-parts/content', 'page'); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php
get_footer();
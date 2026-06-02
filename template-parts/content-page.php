<?php
$remove_top_padding = get_field('remove_top_padding');
$remove_bottom_padding = get_field('remove_bottom_padding');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-label="<?php echo esc_attr( get_the_title() ); ?> page content">
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <?php get_template_part('template-parts/partials/child-pages'); ?>
</article>

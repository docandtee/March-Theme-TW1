<?php
/**
 * Single page template file.
 *
 * @package TailPress
 */

get_header();

?>

    <div class="container mx-auto">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-label="<?php echo esc_attr( get_the_title() ); ?> page content woo-page">
            <div class="entry-content mx-auto mt-6 sm:mt-12 mb-6 sm:mb-12">
                <?php woocommerce_content(); ?>
            </div>
        </article>
    </div>

<?php
get_footer();
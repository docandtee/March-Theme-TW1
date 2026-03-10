<?php
/**
 * Main template file for displaying posts.
 *
 * @package TailPress
 */

get_header();
?>

<div class="container mx-auto space-y-24 lg:space-y-32 mt-6 sm:mt-12 mb-6 sm:mb-12">

	<?php get_template_part('template-parts/partials/archive-title'); ?>
	<?php get_template_part('template-parts/partials/category-nav'); ?>

    <?php if (have_posts()): ?>
		<div class="grid grid-flow-row grid-cols-12 gap-8">
			<?php while (have_posts()): the_post(); ?>
				<div class="col-span-12 md:col-span-6 lg:col-span-4">
					<?php get_template_part('template-parts/partials/news-card'); ?>
				</div>
			<?php endwhile; ?>
		</div>

        <?php TailPress\Pagination::render(); ?>
    <?php endif; ?>
</div>

<?php
get_footer();

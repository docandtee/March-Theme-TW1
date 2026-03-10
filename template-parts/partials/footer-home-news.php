<?php 
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) : 
?>

<section class="w-full overflow-hidden bg-tertiary section-p-b section-p-t" aria-label="Posts list content">
    <div class="container">
        <div class="grid grid-flow-row grid-cols-12 gap-8">
            <header class="col-span-12 text-center">
                <h2 class="section-m-b text-light">Latest news</h2>
            </header>
        </div>
        <div class="grid grid-flow-row grid-cols-12 gap-8">
            <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="col-span-12 md:col-span-6 lg:col-span-4 text-light">
                    <?php get_template_part('template-parts/partials/news-card'); ?>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="grid grid-flow-row grid-cols-12 gap-8 my-6 lg:my-12">
            <div class="col-span-12 text-center">
                <a class="inline-block py-3 px-8 text-lg font-display bg-secondary uppercase hover:bg-primary border-secondary text-dark rounded-full !no-underline ms-4 transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none" href="<?php echo esc_url(home_url('/latest-news/')); ?>">More news</a>
            </div>
        </div>
    </div>
</section>

<?php endif; wp_reset_postdata(); ?>
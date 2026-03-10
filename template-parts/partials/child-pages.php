<?php 

	$args = array(
		'post_parent'=> $post->ID,
		'post_type' => 'page',
		'ignore_sticky_posts' => true,
		'orderby' => 'menu_order',
		'order' => 'DESC'
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) : 
?>

	<section class="child-pages bg-light fullwidth section-p-b overflow-hidden" aria-label="Child pages">
		<div class="container">
			<div class="grid grid-flow-row grid-cols-12 gap-8">
			<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<div class="col-span-12 md:col-span-6 lg:col-span-4">
					<?php get_template_part('template-parts/partials/hover-block'); ?>
				</div>
			<?php endwhile; ?>
			</div>
		</div>
	</section>

<?php endif; wp_reset_postdata(); ?>



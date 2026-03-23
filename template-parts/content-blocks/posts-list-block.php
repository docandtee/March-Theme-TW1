<?php 
	$section_header = get_field('section_header');
	$section_copy = get_field('section_copy');
	$post_type = get_field('post_type');
	$post_category = get_field('post_category');
	$number_of_posts_to_display = get_field('number_of_posts_to_display');
	$display_order_by = get_field('display_order_by');
	$display_order = get_field('display_order');

	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => $number_of_posts_to_display,
		'order' => $display_order,
		'orderby' => $display_order_by,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) : 
?>

<section class="fullwidth overflow-hidden bg-light section-p-t section-p-b" aria-label="Posts list content">
	<div class="container">
		<?php if( $section_header ) { echo '<h2 class="mb-3 mt-0!">'.esc_html( $section_header ).'</h2>'; } ?>
		<?php if( $section_copy ) { echo '<div class="section-m-b">'.esc_html( $section_copy ).'</div>'; } ?>
		<div class="grid grid-flow-row grid-cols-12 gap-8">
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="col-span-12 md:col-span-6 lg:col-span-4 flex">
					<?php get_template_part('template-parts/partials/project-card'); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>

<?php endif; wp_reset_postdata(); ?>
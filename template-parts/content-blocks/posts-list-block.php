<?php 
	$fullwidth = get_field('full_width_blocks');
	$section_header = get_field('section_header');
	$post_type = get_field('post_type');
	$post_category = get_field('post_category');
	$number_of_posts_to_display = get_field('number_of_posts_to_display');
	$display_order_by = get_field('display_order_by');
	$display_order = get_field('display_order');
	$remove_bottom_margin = get_field('remove_bottom_margin');

	$args = array(
		'post_type' => $post_type,
		'cat' => $post_category,
		'posts_per_page' => $number_of_posts_to_display,
		'order' => $display_order,
		'orderby' => $display_order_by,
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) : 
?>

<section class="<?php if(!$remove_bottom_margin) { echo ' section-m-b '; } ?> <?php if( $fullwidth ) {echo ' fullwidth px-5 lg:px-10';} ?> overflow-hidden" aria-label="Posts list content">

	<?php if($section_header) : ?>
		<div class="grid grid-flow-row grid-cols-12 gap-8">
			<header class="col-span-12 text-center">
				<h2 class="section-m-b"><?php echo esc_html($section_header); ?></h2>
			</header>
		</div>
	<?php endif; ?>
	<div class="grid grid-flow-row grid-cols-12 gap-8">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="col-span-12 md:col-span-6 lg:col-span-4">
				<?php get_template_part('template-parts/partials/hover-block'); ?>
			</div>
		<?php endwhile; ?>
	</div>

</section>

<?php endif; wp_reset_postdata(); ?>
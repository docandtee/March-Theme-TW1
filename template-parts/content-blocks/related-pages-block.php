<?php
	$remove_bottom_margin = get_field('remove_bottom_margin');
	$fullwidth = get_field('full_width_blocks');
	$section_header = get_field('section_header');
	$related_pages = get_field('related_pages');
	if( $related_pages ): 
?>

<section class="<?php if(!$remove_bottom_margin) { echo ' section-m-b '; } ?> <?php if( $fullwidth ) {echo 'fullwidth';} ?> overflow-hidden" aria-label="Related pages content">
	<div class="container">
		<?php if($section_header) : ?>
			<div class="grid grid-flow-row grid-cols-12 gap-8">
				<header class="col-span-12 text-center">
					<h2 class="section-m-b"><?php echo esc_html($section_header); ?></h2>
				</header>
			</div>
		<?php endif; ?>
		<div class="grid grid-flow-row grid-cols-12 gap-8">
			<?php 
			global $post; // Important: declare global before the loop
			foreach( $related_pages as $post ): 
				// Setup this post for WP functions (variable must be named $post).
				setup_postdata($post); 
			?>
				<div class="col-span-12 md:col-span-6 lg:col-span-4">
					<?php get_template_part('template-parts/partials/hover-block'); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; wp_reset_postdata(); ?>
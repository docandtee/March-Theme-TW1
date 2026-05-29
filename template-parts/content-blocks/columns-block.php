<?php
	$background_colour = get_field('background_colour');
	$section_heading = get_field('section_heading');
	$section_copy = get_field('section_copy');
	$number_of_columns = get_field('number_of_columns');
	if( have_rows('columns') ): 
?>

<section class="<?php echo esc_attr($background_colour); ?> fullwidth overflow-hidden" aria-label="column content">
	<div class="container">
		<?php if($section_heading) {
			echo '<h2 class="section-m-b">' . esc_html($section_heading) . '</h2>';
		} ?>
		<?php if($section_copy) {
			echo '<div class="section-copy">' . esc_html($section_copy) . '</div>';
		} ?>
		<div class="grid grid-flow-row grid-cols-12 md:gap-8">
			<?php 
				while( have_rows('columns') ): the_row(); 
				$column_number = get_sub_field('column_number');
				$column_title = get_sub_field('column_title');
				$column_subtitle = get_sub_field('column_subtitle');
				$column_copy = get_sub_field('column_copy');
			?>
				<div class="col-span-12 md:col-span-6 <?php echo esc_attr($number_of_columns); ?> mb-4 md:mb-0">
					<?php if($column_number) {
						echo '<div class="number text-primary font-bold text-lg mb-2 block">' . esc_html($column_number) . '</div>';
					} ?>
					<?php if($column_title) {
						echo '<h3>' . esc_html($column_title) . '</h3>';
					} ?>
					<?php if($column_subtitle) {
						echo '<p>' . esc_html($column_subtitle) . '</p>';
					} ?>
					<?php if($column_copy) {
						echo '<p>' . esc_html($column_copy) . '</p>';
					} ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php endif; ?>
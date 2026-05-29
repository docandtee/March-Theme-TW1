<?php
	$background_colour = get_field('background_colour');
	$section_heading = get_field('section_heading');
	$section_copy = get_field('section_copy');
	$number_of_columns = get_field('number_of_columns');
	if( have_rows('columns') ): 
?>

<section class="<?php echo esc_attr($background_colour); ?> fullwidth overflow-hidden section-p-t section-p-b" aria-label="column content">
	<div class="container">
		<?php if($section_heading) {
			echo '<h2 class="mb-4 mt-0!">' . esc_html($section_heading) . '</h2>';
		} ?>
		<?php if($section_copy) {
			echo '<div class="section-copy">' . $section_copy . '</div>';
		} ?>
		<div class="grid grid-flow-row grid-cols-12 md:gap-8 mt-12">
			<?php 
				while( have_rows('columns') ): the_row(); 
				$column_number = get_sub_field('column_number');
				$column_title = get_sub_field('column_title');
				$column_subtitle = get_sub_field('column_subtitle');
				$column_copy = get_sub_field('column_copy');
			?>
				<div class="col-span-12 md:col-span-6 bg-secondary <?php echo esc_attr($number_of_columns); ?> mb-4 md:mb-0 border-t-6 border-primary p-6">
					<?php if($column_number) {
						echo '<div class="number text-primary font-bold text-4xl mb-0 block">' . esc_html($column_number) . '</div>';
					} ?>
					<?php if($column_title) {
						echo '<h3 class="mb-2 mt-4">' . esc_html($column_title) . '</h3>';
					} ?>
					<?php if($column_subtitle) {
						echo '<p class="mb-0 text-tertiary font-bold">' . esc_html($column_subtitle) . '</p>';
					} ?>
					<?php if($column_copy) {
						echo '<div class="copy mt-6">' . $column_copy . '</div>';
					} ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php endif; ?>
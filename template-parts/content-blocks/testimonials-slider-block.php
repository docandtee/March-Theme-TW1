<?php 
	if( have_rows('testimonials_slider') ): 
	$fullwidth = get_field('full_width_blocks');
	$fullheight = get_field('full_height_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
?>

<section 
	class="testimonial-slider relative overflow-hidden bg-secondary m-0! section-p-b section-p-t
	<?php 
		if( !$remove_bottom_margin ) { echo ' section-m-b '; }
		if( $fullwidth ) { echo ' fullwidth ';} 
		if( $fullheight ) { echo ' h-screen '; }
	?>
	" 
	aria-label="Testimonials Content"
>

	<div class="splide testimonials-splide">
		<div class="splide__track">
			<ul class="splide__list">
	
				<?php while( have_rows('testimonials_slider') ): the_row(); 
					$testimonial = get_sub_field('testimonial');
					$citation = get_sub_field('citation');
					$fullheight = get_sub_field('full_height_blocks');
				?>
					<li class="splide__slide">
						<div class="p-6 lg:max-w-4xl mx-auto">
							<?php if( $testimonial ) { 
									echo '<blockquote class="bg-secondary border-0 w-full text-center"><p class="text-light text-xl italic">'.$testimonial.'</p>'; 
								if( $citation ) { echo '<cite class="text-light not-italic font-bold mt-4 block">' .$citation. '</cite>'; 
								}
								echo '</blockquote>';
							}?>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
	
</section>
<?php endif; ?>
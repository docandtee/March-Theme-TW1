<?php 
	if( have_rows('content_block') ):
	$fullwidth = get_field('full_width_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
?>
   
	<section class="simple-stacked-block <?php if(!$remove_bottom_margin) { echo ' section-m-b '; } if( $fullwidth ) {echo ' fullwidth ';} ?>" aria-label="Stacked content">
		<div class="grid grid-flow-row grid-cols-12 gap-8">
			<?php 
				while( have_rows('content_block') ): the_row(); 
				$image = get_sub_field('image_block');
				$block_title = get_sub_field('block_title');
				$block_text = get_sub_field('block_text');
				$button_text = get_sub_field('button_text');
				$button_link = get_sub_field('button_link');
			?>

				<div class="col-span-12 md:col-span-6 lg:col-span-4 flex"> 
					<div 
						class="w-full h-full"
						x-data="{ shown: false }" 
						x-intersect.threshold.50="shown = true" 
						x-intersect:leave="shown = false"
					>
						<div 
							class="w-full h-full flex flex-col"
							x-show="shown" 
							x-transition:enter="transition ease-out duration-300"
							x-transition:enter-start="opacity-0 scale-50"
							x-transition:enter-end="opacity-100 scale-100"
							x-transition:leave="transition ease-in duration-300"
							x-transition:leave-start="opacity-100 scale-100"
							x-transition:leave-end="opacity-0 scale-90"
						>
							<?php if (!empty($image) ): ?>
								<div class="overflow-hidden">
									<?php docandtee_responsive_image($image, null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'mx-auto w-full max-w-3/4'); ?>
								</div>
							<?php endif; ?>
							<div class="card-body d-flex flex-column justify-content-between">
								<div class="card-wrapper">
									<?php if( $block_title ) : ?>
									<h3 class="mb-2 text-lg font-bold my-3 text-center"><?php echo $block_title; ?></h3>
									<?php endif; ?>
									<?php if( $block_text ) { echo '<div class="copy-wrap text-center mt-2">' .$block_text. '</div>'; } ?>
								</div>
								<?php if( get_sub_field( 'include_button' ) ): ?>
									<a 
										href="<?php echo $button_link; ?>" 
										class="block mt-6 font-bold hover:text-dark !no-underline text-center transition duration-200" 
										aria-label="Link to read full article" 
										itemprop="url"
									>
									<?php if( $button_text ) { echo $button_text; } ?>
								</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

			<?php endwhile; ?>
		</div>
	</section>

<?php endif; ?>
<?php 
	if( have_rows('stats_block') ): 
	$fullwidth = get_field('full_width_blocks');
?>
   
	<section class="stats-block m-0! <?php if( $fullwidth ) {echo ' fullwidth';} ?> overflow-hidden" aria-label="Staggered content">
		<div class="grid grid-flow-row grid-cols-12 gap-0">

			<?php while( have_rows('stats_block') ): the_row();
				$block_title = get_sub_field('block_title');
				$block_text = get_sub_field('block_text');
				$stats_display = get_sub_field('stats_display');
			?>
			
				<div class="text-block col-span-12 lg:col-span-6 bg-primary text-white">
					<div class="content-inner flex flex-col justify-center p-8 lg:p-20 w-full lg:h-full">
						<?php if( $block_title ) { echo '<h3 class="block-bottom mb-4 mt-0!">' .esc_html($block_title). '</h3>'; } ?>
						<?php if( $block_text ) { echo '<div class="copy-wrap">' .$block_text. '</div>'; } ?>

						<?php if( $stats_display == 'accordion' ) : ?>

							<?php 
								if( have_rows('accordion' )): 
								$remove_bottom_margin = get_field('remove_bottom_margin');
							?>
							
								<div class="accordions space-y-0" x-data="{ openAccordion: null }">
									<?php
										$hash=rand(1,999999);
										$counter=1;
										while( have_rows('accordion') ): the_row(); 
										$accordion_title = get_sub_field('accordion_title');
										$accordion_text = get_sub_field('accordion_text');
									?>
										<?php if($accordion_title ) : ?>
											<div class="accordion-title">
												<div class="border-b border-gray-200 last:border-b-0" id="heading-<?php echo $hash.'-'.$counter; ?>">
													<div>
														<button 
															class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary transition-colors duration-200 cursor-pointer" 
															type="button" 
															@click="openAccordion = openAccordion === <?php echo $counter; ?> ? null : <?php echo $counter; ?>"
															:aria-expanded="openAccordion === <?php echo $counter; ?>"
															aria-controls="collapse-<?php echo $hash.'-'.$counter; ?>"
														>
															<span class="text-lg font-medium text-gray-900 pr-4"><?php echo $accordion_title; ?></span>
															<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" :class="{ 'rotate-45': openAccordion === <?php echo $counter; ?> }" class="transition" style="height: 20px;">
																<path d="M336 112C336 103.2 328.8 96 320 96C311.2 96 304 103.2 304 112L304 304L112 304C103.2 304 96 311.2 96 320C96 328.8 103.2 336 112 336L304 336L304 528C304 536.8 311.2 544 320 544C328.8 544 336 536.8 336 528L336 336L528 336C536.8 336 544 328.8 544 320C544 311.2 536.8 304 528 304L336 304L336 112z"/>
															</svg>
														</button>
													</div>
												</div>
												<?php if($accordion_text ) : ?>
													<div 
														id="collapse-<?php echo $hash.'-'.$counter++; ?>" 
														class="overflow-hidden transition-all duration-300 ease-in-out"
														:class="openAccordion === <?php echo $counter-1; ?> ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'"
													>
														<div class="px-6 py-4 bg-gray-50">
															<div class="text-gray-700 prose prose-sm max-w-none">
																<?php echo $accordion_text; ?>
															</div>
														</div>
													</div>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
							
						<?php elseif( $stats_display == 'statistics' ) : ?>

						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>

		</div>
	</section>

<?php endif; ?>
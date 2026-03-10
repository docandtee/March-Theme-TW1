<?php 
	if( have_rows('content_block') ):
	$section_header = get_field('section_header');
	$convert_to_slider = get_field('convert_to_slider');
	$block_button_text = get_field('button_text');
	$block_button_link = get_field('button_link');
?>
   
	<section class="info-block section-p-t section-p-b fullwidth overflow-hidden" aria-label="Stacked content">
		<div class="container">
			<?php if( $section_header ) : ?>
				<div class="grid grid-flow-row grid-cols-12 gap-8">
					<header class="col-span-12 text-center">
						<h2 class="section-m-b mt-0! <?php if( $bg_color == 'dark' || $bg_color == 'secondary' ) { echo 'text-light'; } ?>"><?php echo esc_html($section_header); ?></h2>
					</header>
				</div>
			<?php endif; ?>
		</div>

		<?php if( $convert_to_slider ) : ?>
			<div class="splide info-block-splide">
				<div class="splide__track pb-6">
					<ul class="splide__list">
						<?php 
							while( have_rows('content_block') ): the_row(); 
							$image = get_sub_field('image_block');
							$block_title = get_sub_field('block_title');
							$block_text = get_sub_field('block_text');
							$button_text = get_sub_field('button_text');
							$button_link = get_sub_field('button_link');
						?>
							<li class="splide__slide">
								<div class="p-4">
									<div 
										class="w-full h-full"
										x-data="{ shown: false }" 
										x-intersect.half="shown = true" 
									>
										<div 
											class="w-full h-full flex flex-col"
											x-show="shown" 
											x-transition:enter="transition ease-out duration-300"
											x-transition:enter-start="opacity-0 scale-50"
											x-transition:enter-end="opacity-100 scale-100"
										>
											<a href="<?php if( $button_link ) { echo esc_url($button_link); } ?>" aria-label="<?php if( $block_title ) { echo esc_url($block_title); } ?>" itemprop="url" class="hover-block overflow-hidden relative block transition hover:scale-102 duration-200 ease-in-out rounded-4xl">
												<?php if ( $image ): ?>
													<?php docandtee_responsive_image($image, null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'aspect-1/1 lg:aspect-2/3 w-full object-cover'); ?>
													<div class="absolute inset-0 w-full h-full bg-dark opacity-30"></div>
												<?php endif; ?>
												
												<div class="absolute top-0 text-white p-5 lg:p-7 h-full w-full flex flex-col justify-center items-center">
													<?php if( $block_title ) { echo '<h3 class="hover-title leading-8 text-center">'.esc_html($block_title).'</h3>'; } ?>
													<?php if( $block_text ) { echo '<div class="copy-wrap text-center mt-6">' .$block_text. '</div>'; } ?>
													<?php if( $button_text ) {
														echo '<div class="mt-6 py-3 px-5 text-sm leading-none font-bold bg-transparent hover:bg-primary border border-white hover:border-primary text-white hover:text-dark rounded-full !no-underline transition duration-200 ease-in-out text-nowrap pointer-cursor" itemprop="url">'.esc_html($button_text).'</div>';
													} ?>
												</div>
											</a>
										</div>
									</div>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
				</div>
			</div>
		<?php else : ?>

			<div class="container">
				<div class="grid grid-flow-row grid-cols-12 gap-6">
					<?php 
						while( have_rows('content_block') ): the_row(); 
						$image = get_sub_field('image_block');
						$block_title = get_sub_field('block_title');
						$block_text = get_sub_field('block_text');
						$button_text = get_sub_field('button_text');
						$button_link = get_sub_field('button_link');
					?>

						<div class="col-span-12 md:col-span-6 lg:col-span-3"> 
							<div 
								class="w-full h-full"
								x-data="{ shown: false }" 
								x-intersect.half="shown = true" 
							>
								<div 
									class="w-full h-full flex flex-col"
									x-show="shown" 
									x-transition:enter="transition ease-out duration-300"
									x-transition:enter-start="opacity-0 scale-50"
									x-transition:enter-end="opacity-100 scale-100"
								>
									<a href="<?php if( $button_link ) { echo esc_url($button_link); } ?>" aria-label="<?php if( $block_title ) { echo esc_url($block_title); } ?>" itemprop="url" class="hover-block overflow-hidden relative block transition hover:scale-102 duration-200 ease-in-out rounded-4xl">
										<?php if ( $image ): ?>
											<?php docandtee_responsive_image($image, null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'aspect-1/1 lg:aspect-2/3 w-full object-cover'); ?>
											<div class="absolute inset-0 w-full h-full bg-dark opacity-30"></div>
										<?php endif; ?>
										
										<div class="absolute top-0 text-white p-5 lg:p-7 h-full w-full flex flex-col justify-between items-center">
											<?php if( $block_title ) { echo '<h3 class="hover-title mt-6 leading-8 text-center">'.esc_html($block_title).'</h3>'; } ?>
											<?php if( $block_text ) { echo '<div class="copy-wrap text-center mt-2">' .$block_text. '</div>'; } ?>
											<?php if( $button_text ) {
												echo '<div class="py-3 px-5 text-sm leading-none font-bold bg-transparent hover:bg-primary border border-white hover:border-primary text-white hover:text-dark rounded-full !no-underline transition duration-200 ease-in-out text-nowrap mb-6" itemprop="url">'.esc_html($button_text).'</div>';
											} ?>
										</div>
									</a>
								</div>
							</div>
						</div>

					<?php endwhile; ?>
				</div>
			</div>

		<?php endif; ?>

		<?php if( $block_button_text && $block_button_link ) {
			echo '
			<div class="container text-center mt-12 mb-6">
				<a href="'.esc_html($block_button_link).'" class="py-3 px-5 leading-none font-bold bg-transparent hover:bg-light border border-dark hover:border-light text-dark! rounded-full !no-underline transition duration-200 ease-in-out text-nowrap mx-auto" itemprop="url">'.esc_html($block_button_text).'</a>
			</div>';
		} ?>

	</section>

<?php endif; ?>
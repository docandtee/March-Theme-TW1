<?php 
	$image = get_field('background_image');
	$poster_img_url = wp_get_attachment_image_src( $image, 'large' );
	$add_parallax_scrolling = get_field('add_parallax_scrolling');
	$block_title = get_field('block_title');
	$block_text = get_field('block_text');
	$include_button = get_field('include_button');
	$button_text = get_field('button_text');
	$button_link = get_field('button_link');
	$fullwidth = get_field('full_width_blocks');
	$fullheight = get_field('full_height_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
	$add_video_popup_button = get_field('add_video_popup_button');
	$youtube_video_url = get_field('youtube_video_url');
	$vimeo_video_url = get_field('vimeo_video_url');
	$hash=md5(rand(111111,999999) . '-' . date('YMDHis'));
	$replace_background_image_with_video = get_field('replace_background_image_with_video');
	$video_format = get_field('video_format');
	$upload_mp4_video = get_field('upload_mp4_video');
    $vimeo_video_id = get_field('vimeo_video_id');
    $youtube_video_id = get_field('youtube_video_id');
	$popup_vimeo_id = get_field('popup_vimeo_id');
	$popup_youtube_id = get_field('popup_youtube_id');
	$convert_to_slider = get_field('convert_to_slider');

	if($convert_to_slider) :
?>

	<?php get_template_part('template-parts/content-blocks/hero-block-slider'); ?>

<?php else : ?>

	<section 
		class="hero-block relative overflow-hidden m-0!
		<?php 
			if( !$remove_bottom_margin ) { echo ' section-m-b '; }
			if( $fullwidth ) { echo 'fullwidth ';} 
			if( $fullheight ) { echo 'h-screen '; } else { echo ' hero-height '; }
		?>
		" 
		aria-label="Hero Content"
	>
		<div class="absolute inset-0 flex justify-center items-center w-full h-full z-10">
		
			<?php if ($replace_background_image_with_video) : ?>

				<div role="status" class="absolute z-0 w-full h-full flex justify-center items-center">
					<svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
						<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
					</svg>
					<span class="sr-only">Loading...</span>
				</div>
				
				<?php if($video_format == 'mp4' && $upload_mp4_video ) : ?>
					<video autoplay="" muted="" loop="" playsinline="" preload="auto" class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2" <?php if ($poster_img_url) {echo 'poster="'.$poster_img_url[0].'"';} ?> aria-label="<?php echo $block_title ? esc_attr($block_title) . ' - background video' : 'Background video'; ?>">
						<source src="<?php echo esc_url($upload_mp4_video); ?>" type="video/mp4">
						<p><?php _e('Your browser does not support the video tag.'); ?></p>
					</video>
				<?php elseif($video_format == 'vimeo' && $vimeo_video_id ) : ?>
					<iframe
						class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2"
						src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_video_id); ?>?dnt=1&amp;background=1&amp;preload=auto" 
						allow="autoplay"
						allowfullscreen
						title="<?php echo $block_title ? esc_attr($block_title) . ' - Vimeo video' : 'Background video from Vimeo'; ?>"
						aria-label="<?php echo $block_title ? esc_attr($block_title) . ' - background video' : 'Background video'; ?>"
					></iframe>
				<?php elseif($video_format == 'youtube' && $youtube_video_id ) : ?>
					<iframe
						class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2"
						src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_video_id); ?>?controls=0&amp;mute=1&amp;loop=1&amp;autoplay=1&amp;playsinline=1" 
						allow="autoplay"
						allowfullscreen
						title="<?php echo $block_title ? esc_attr($block_title) . ' - YouTube video' : 'Background video from YouTube'; ?>"
						aria-label="<?php echo $block_title ? esc_attr($block_title) . ' - background video' : 'Background video'; ?>"
					></iframe>
				<?php endif; ?>

			
			<?php elseif ($image): ?>

				<?php if($add_parallax_scrolling) : ?>
					<div class="w-full md:w-[120%] h-full md:h-auto absolute">
						<?php docandtee_responsive_image($image, null, '(min-width: 1200px) 80vw, 100vw', 'parallax-bg w-full h-full object-cover'); ?>
					</div>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							const parallaxElements = document.querySelectorAll('.parallax-bg');
							
							function updateParallax() {
								// Only run on small screens (mobile/tablet)
								if (window.innerWidth <= 782) {
									return;
								}
								
								const scrolled = window.pageYOffset;
								
								parallaxElements.forEach(function(element) {
									const speed = 0.4;
									const yPos = -(scrolled * speed);
									element.style.transform = 'translateY(' + yPos + 'px)';
								});
							}
							
							function handleResize() {
								// Reset transform on larger screens
								if (window.innerWidth <= 782) {
									parallaxElements.forEach(function(element) {
										element.style.transform = 'translateY(0px)';
									});
								}
							}
							
							window.addEventListener('scroll', updateParallax);
							window.addEventListener('resize', handleResize);
							updateParallax(); // Initial call
						});
					</script>
				<?php else : ?>
					<?php docandtee_responsive_image($image, null, '(min-width: 1280px) 80vw, 100vw', 'w-full h-full object-cover'); ?>
				<?php endif; ?>

			<?php endif; ?> 

		</div>

		<div class="absolute inset-0 w-full h-full bg-black opacity-40 z-11"></div>

		<div class="hero-content-wrapper absolute inset-0 flex justify-center items-center w-full h-full z-12">
			<div class="container mx-auto px-4">
				<div class="flex flex-col">
					<div class="hero-content w-full lg:w-2/3 mx-auto text-white text-center">
						<?php if( $block_title ) { echo '<h1 class="mb-5">' .$block_title. '</h1>'; } ?>
						<?php if( $block_text ) { echo '<div class="text-lg md:text-xl mb-8 max-w-3xl mx-auto">' .$block_text. '</div>'; } ?>

						<?php if( $include_button && !$add_video_popup_button): ?>
							<a href="<?php echo esc_url($button_link); ?>" class="inline-block px-8 py-3 border-2 border-white !no-underline text-white! font-semibold rounded-lg hover:bg-white hover:text-dark! transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none"><?php if( $button_text ) { echo esc_html($button_text); } else { _e('Learn more'); } ?></a>
						<?php endif; ?>

						<?php if($add_video_popup_button && !$include_button) : ?>
							<div x-data="{ showVideoModal: false }">
								<button type="button" class="cursor-pointer" @click="showVideoModal = true" aria-label="<?php echo $block_title ? esc_attr($block_title) . ' - Play video' : 'Play video'; ?>">
									<span class="sr-only"><?php _e('Play video'); ?></span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-20 h-20" style="fill: white;" aria-hidden="true">
										<path d="M320 96C443.7 96 544 196.3 544 320C544 443.7 443.7 544 320 544C196.3 544 96 443.7 96 320C96 196.3 196.3 96 320 96zM320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM392.7 320L272 393.7L272 246.3L392.7 320zM252.3 211.1C244.7 215.3 240 223.4 240 232L240 408C240 416.7 244.7 424.7 252.3 428.9C259.9 433.1 269.1 433 276.6 428.4L420.6 340.4C427.7 336 432.1 328.3 432.1 319.9C432.1 311.5 427.7 303.8 420.6 299.4L276.6 211.4C269.2 206.9 259.9 206.7 252.3 210.9z"/>
									</svg>
								</button>

								<!-- Video Modal -->
								<div x-show="showVideoModal" 
									x-cloak
									class="fixed inset-0 z-50 overflow-y-auto"
									role="dialog"
									aria-modal="true"
									aria-labelledby="video-modal-title">
									<div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
										<!-- Background overlay -->
										<div x-show="showVideoModal" 
											x-transition:enter="ease-out duration-300" 
											x-transition:enter-start="opacity-0" 
											x-transition:enter-end="opacity-100" 
											x-transition:leave="ease-in duration-200" 
											x-transition:leave-start="opacity-100" 
											x-transition:leave-end="opacity-0" 
											class="fixed inset-0 z-40 transition-opacity bg-gray-500 opacity-75" 
											@click="showVideoModal = false"
											aria-hidden="true"></div>

										<!-- Modal panel -->
										<div x-show="showVideoModal" 
											x-transition:enter="ease-out duration-300" 
											x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
											x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
											x-transition:leave="ease-in duration-200" 
											x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
											x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
											class="relative z-50 inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
											<div class="bg-white">
												<div class="flex items-center justify-between p-6 border-b border-gray-200">
													<?php if( $block_title ) { echo '<h3 id="video-modal-title" class="text-lg font-medium">' .esc_html($block_title). '</h3>'; } ?>
													<button type="button" 
															class="flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition-colors duration-200" 
															@click.prevent="showVideoModal = false"
															@click.stop
															aria-label="Close video modal">
														<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
														</svg>
													</button>
												</div>
												<div class="p-6">
													<div class="relative w-full" style="padding-bottom: 56.25%;">
														<div class="absolute inset-0">
															<?php if($popup_youtube_id) {
																echo wp_oembed_get( 'https://www.youtube.com/watch?v='.$popup_youtube_id, array( 'width' => 800 ) );
															} elseif($popup_vimeo_id) {
																echo wp_oembed_get( 'https://vimeo.com/'.$popup_vimeo_id, array( 'width' => 800) );
															}
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>

					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if($add_video_popup_button ) : ?>
		<!-- Video Modal -->
		<div x-data="{ showVideoModal: false }" 
		x-show="showVideoModal" 
		x-cloak
		class="fixed inset-0 z-50 overflow-y-auto"
		role="dialog"
		aria-modal="true"
		aria-labelledby="video-modal-title-2">
			<div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
				<!-- Background overlay -->
				<div x-show="showVideoModal" 
					x-transition:enter="ease-out duration-300" 
					x-transition:enter-start="opacity-0" 
					x-transition:enter-end="opacity-100" 
					x-transition:leave="ease-in duration-200" 
					x-transition:leave-start="opacity-100" 
					x-transition:leave-end="opacity-0" 
					class="fixed inset-0 transition-opacity bg-gray-500 opacity-75" 
					@click="showVideoModal = false"
					aria-hidden="true"></div>

				<!-- Modal panel -->
				<div x-show="showVideoModal" 
					x-transition:enter="ease-out duration-300" 
					x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
					x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
					x-transition:leave="ease-in duration-200" 
					x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
					x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
					class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
					<div class="bg-white">
						<div class="flex items-center justify-between p-6 border-b border-gray-200">
							<?php if( $block_title ) { echo '<h3 id="video-modal-title-2" class="text-lg font-medium text-gray-900">' .esc_html($block_title). '</h3>'; } ?>
							<button type="button" class="text-gray-400 hover:text-gray-600" @click="showVideoModal = false" aria-label="Close video modal">
								<span class="sr-only">Close</span>
								<svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>
						</div>
						<div class="p-6">
							<div class="relative w-full" style="padding-bottom: 56.25%;">
								<div class="absolute inset-0">
									<?php if($popup_youtube_id) {
										echo wp_oembed_get( 'https://www.youtube.com/watch?v='.$popup_youtube_id, array( 'width' => 800 ) );
									} elseif($popup_vimeo_id) {
										echo wp_oembed_get( 'https://vimeo.com/'.$popup_vimeo_id, array( 'width' => 800) );
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	
<?php endif; ?>

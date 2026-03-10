<?php 
	if( have_rows('slider') ): 
	$fullwidth = get_field('full_width_blocks');
	$fullheight = get_field('full_height_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
?>

<section 
	class="hero-block relative overflow-hidden 
	<?php 
		if( !$remove_bottom_margin ) { echo ' section-m-b '; }
		if( $fullwidth ) { echo ' fullwidth ';} 
		if( $fullheight ) { echo ' h-screen '; } else { echo ' hero-height '; }
	?>
	" 
	aria-label="Hero Content"
>

	<div class="splide hero-splide h-full w-full">
		<div class="splide__track h-full w-full">
			<ul class="splide__list h-full w-full">
				<?php while( have_rows('slider') ): the_row(); 
					$image = get_sub_field('slider_image');
					$replace_background_image_with_video = get_sub_field('replace_background_image_with_video');
					$poster_image = get_sub_field('poster_image');
					$video_format = get_sub_field('video_format');
					$upload_mp4_video = get_sub_field('upload_mp4_video');
					$vimeo_video_id = get_sub_field('vimeo_video_id');
					$youtube_video_id = get_sub_field('youtube_video_id');
					$block_title = get_sub_field('block_title');
					$block_text = get_sub_field('block_text');
					$button_text = get_sub_field('button_text');
					$button_link = get_sub_field('button_link');
					$include_button = get_sub_field('include_button');
				?>
					<li class="splide__slide h-full w-full p-0!">
						<div class="relative h-full w-full overflow-hidden">

							<?php if ($replace_background_image_with_video) : ?>

								<div role="status" class="absolute z-0 w-full h-full flex justify-center items-center">
									<svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
										<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
									</svg>
									<span class="sr-only">Loading...</span>
								</div>
						
								<?php if($video_format == 'mp4' && $upload_mp4_video ) : ?>
									<video autoplay="" muted="" loop="" playsinline="" preload="auto" class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2" <?php if ( $poster_image ) {echo 'poster="'.$poster_image.'"';} ?> aria-label="<?php echo $block_title ? esc_attr($block_title) . ' - background video' : 'Background video'; ?>">
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

								<?php docandtee_responsive_image($image, null, '(min-width: 1280px) 80vw, 100vw', 'w-full h-full object-cover'); ?>
							
							<?php endif; ?> 

							<div class="absolute inset-0 w-full h-full bg-black opacity-40 z-11"></div>

							<div class="hero-content-wrapper absolute inset-0 flex justify-center items-center w-full h-full z-12">
								<div class="container mx-auto px-4">
									<div class="flex flex-col">
										<div class="hero-content w-full lg:w-2/3 mx-auto text-white text-center">
											<?php if( $block_title ) { echo '<h1 class="mb-5">' .$block_title. '</h1>'; } ?>
											<?php if( $block_text ) { echo '<div class="text-lg md:text-xl mb-8 max-w-3xl mx-auto">' .$block_text. '</div>'; } ?>
											<?php if( $include_button ): ?>
												<a href="<?php echo esc_url($button_link); ?>" class="inline-block px-8 py-3 border-2 border-white !no-underline text-white! font-semibold rounded-lg hover:bg-white hover:text-dark! transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none"><?php if( $button_text ) { echo esc_html($button_text); } else { _e('Learn more'); } ?></a>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>

</section>
<?php endif; ?>
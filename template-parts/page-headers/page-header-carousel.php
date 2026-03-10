<?php 
	if( have_rows('slider') ): 
	$pagewidth = get_field('page_width');
?>

<section class="page-header relative overflow-hidden hero-height flex items-end justify-center" aria-label="Page header carousel">
    <div class="splide hero-splide h-full w-full">
		<div class="splide__track h-full w-full">
			<ul class="splide__list h-full w-full">
				<?php while( have_rows('slider') ): the_row(); 
					$slider_title = get_sub_field('slider_title');
					$slider_subtitle = get_sub_field('slider_subtitle');
					$slider_call_to_action_text = get_sub_field('slider_call_to_action_text');
					$slider_call_to_action_url = get_sub_field('slider_call_to_action_url');
					$slider_photo_credit = get_sub_field('slider_photo_credit');
					$image = get_sub_field('slider_image');
					$replace_background_image_with_video = get_sub_field('replace_background_image_with_video');
					$poster_image = get_sub_field('poster_image');
					$upload_mp4_video = get_sub_field('upload_mp4_video'); 
					$video_format = get_sub_field('video_format');
					$vimeo_video_id = get_sub_field('vimeo_video_id');
					$youtube_video_id = get_sub_field('youtube_video_id');
				?>
					<li class="splide__slide h-full w-full p-0!">
						<div class="relative h-full w-full flex items-center justify-center overflow-hidden">

							<?php if ($replace_background_image_with_video) : ?>

								<div role="status" class="absolute z-0 w-full h-full flex justify-center items-center">
									<svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
										<path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
									</svg>
									<span class="sr-only">Loading...</span>
								</div>
						
								<?php if($video_format == 'mp4' && $upload_mp4_video ) : ?>
									<video autoplay="" muted="" loop="" playsinline="" preload="auto" class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2" <?php if ( $poster_image ) {echo 'poster="'.$poster_image.'"';} ?> aria-label="<?php echo $slider_title ? esc_attr($slider_title) . ' - background video' : 'Page header background video'; ?>">
										<source src="<?php echo esc_url($upload_mp4_video); ?>" type="video/mp4">
										<p><?php _e('Your browser does not support the video tag.'); ?></p>
									</video>
								<?php elseif($video_format == 'vimeo' && $vimeo_video_id ) : ?>
									<iframe
										class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2"
										src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_video_id); ?>?dnt=1&amp;background=1&amp;preload=auto" 
										allow="autoplay"
										allowfullscreen
										title="<?php echo $slider_title ? esc_attr($slider_title) . ' - Vimeo video' : 'Page header video from Vimeo'; ?>"
										aria-label="<?php echo $slider_title ? esc_attr($slider_title) . ' - background video' : 'Page header background video'; ?>"
									></iframe>
								<?php elseif($video_format == 'youtube' && $youtube_video_id ) : ?>
									<iframe
										class="aspect-16/9 h-full w-auto lg:h-auto lg:w-full object-cover absolute z-2"
										src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_video_id); ?>?controls=0&amp;mute=1&amp;loop=1&amp;autoplay=1&amp;playsinline=1" 
										allow="autoplay"
										allowfullscreen
										title="<?php echo $slider_title ? esc_attr($slider_title) . ' - YouTube video' : 'Page header video from YouTube'; ?>"
										aria-label="<?php echo $slider_title ? esc_attr($slider_title) . ' - background video' : 'Page header background video'; ?>"
									></iframe>
								<?php endif; ?>
							
							<?php elseif ($image): ?>

								<?php docandtee_responsive_image($image, null, '(min-width: 1280px) 80vw, 100vw', 'w-full h-full object-cover'); ?>
							
							<?php endif; ?> 

							<div class="absolute inset-0 w-full h-full bg-black opacity-40 z-11"></div>

							<div class="header-content relative w-full text-white z-12">
								<div class="container mx-auto my-6 <?php if( $pagewidth == 'narrow' ) { echo ' max-w-4xl '; } elseif( $pagewidth == 'fullwidth' ) { echo 'max-w-lvw'; } ?>">
									<div class="hero-content">
										<header class="<?php if( $text_center  ) { echo 'text-center';} ?>">
											<?php if( $slider_title ) { echo '<h1 class="mb-5 [text-wrap:balance]">' .esc_html($slider_title). '</h1>'; } ?>
											<?php if( $slider_subtitle ) { echo '<p class="page-subtitle text-lg md:text-xl [text-wrap:balance]">' .esc_html($slider_subtitle). '</p>'; } ?>
											<?php if( $slider_call_to_action_text && $slider_call_to_action_url ) { 
												echo '<div class="button-wrap mt-8"><a class="inline-block px-8 py-3 border-2 border-white !no-underline text-white! font-semibold rounded-lg hover:bg-white hover:text-dark! transition-colors duration-200 focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none" href="'.esc_url($slider_call_to_action_url).'">'.esc_html($slider_call_to_action_text).'</a></div>'; 
											} ?>
										</header>
									</div>
								</div>
							</div>

							<?php if( $slider_photo_credit ) { echo '<div class="photocredit absolute z-3 top-0 end-0 small p-3 text-white" role="note" aria-label="Photo credit">'.esc_html($slider_photo_credit).'</div>';} ?>
						</div>
					</li>

				<?php endwhile; ?>
			</ul>
		</div>
	</div>

</section>
<?php endif; ?>
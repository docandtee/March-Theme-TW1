<?php 
	if( have_rows('video_thumbnail') ):
	$fullwidth = get_field('full_width_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
	$section_header = get_field('section_header');
?>

<section class="team-members-block <?php if(!$remove_bottom_margin) { echo ' section-m-b '; } if( $fullwidth ) {echo ' fullwidth';} ?> overflow-hidden" aria-label="Video gallery" x-data="videoModal()">

	<?php if($section_header) : ?>
		<div class="grid grid-flow-row grid-cols-12 gap-8">
			<header class="col-span-12 text-center">
				<h2 class="section-m-b"><?php echo esc_html($section_header); ?></h2>
			</header>
		</div>
	<?php endif; ?>

	<div class="grid grid-flow-row grid-cols-12 gap-8">

		<?php 
			// First pass: collect all data and generate hashes
			$videos = array();
			if( have_rows('video_thumbnail') ) {
				while( have_rows('video_thumbnail') ): the_row();
					$hash = md5(rand(111111,999999) . '-' . date('YMDHis'));
					$image = get_sub_field('video_image');
					$video_title = get_sub_field('video_title');
					$youtube_or_vimeo = get_sub_field('youtube_or_vimeo');
					$youtube_video_url = get_sub_field('youtube_video_url');
					$vimeo_video_url = get_sub_field('vimeo_video_url');
					
					$videos[] = array(
						'hash' => $hash,
						'image' => $image,
						'name' => $video_title,
						'youtube_video_url' => $youtube_video_url,
						'vimeo_video_url' => $vimeo_video_url
					);
				endwhile;
			}
			
			// Second pass: display the videos
			foreach($videos as $video):
		?>

			<div class="col-span-12 md:col-span-6 lg:col-span-4 col-md-4 col-lg-3 flex justify-center">
				<div 
					class="w-full h-full"
					x-data="{ shown: false }" 
					x-intersect.threshold.50="shown = true" 
				>
					<div 
						class="w-full h-full flex flex-col"
						x-show="shown" 
						x-transition:enter="transition ease-out duration-300"
						x-transition:enter-start="opacity-0 scale-50"
						x-transition:enter-end="opacity-100 scale-100"
					>
						<button type="button" class="hover-block overflow-hidden relative block transition hover:scale-110 duration-200 ease-in-out rounded-lg w-full text-left border-0 p-0 bg-transparent cursor-pointer" @click="openModal('<?php echo $video['hash']; ?>')" aria-label="Play video: <?php echo esc_attr($video['name']); ?>">
							<?php if ( $video['image'] ): ?>
								<div class="overflow-hidden">
									<?php docandtee_responsive_image($video['image'], null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'aspect-16/10 w-full object-cover'); ?>
									<div class="absolute inset-0 w-full h-full bg-black opacity-30"></div>
								</div>
							<?php endif; ?>
							<?php if( $video['name'] ) { 
								echo '<div class="absolute top-0 text-white p-5 h-full w-full flex flex-col justify-center items-center">
								<h3 class="hover-title mb-3">'.esc_html($video['name']).'</h3>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-15 h-15" style="fill: white;" aria-hidden="true">
									<path d="M320 96C443.7 96 544 196.3 544 320C544 443.7 443.7 544 320 544C196.3 544 96 443.7 96 320C96 196.3 196.3 96 320 96zM320 576C461.4 576 576 461.4 576 320C576 178.6 461.4 64 320 64C178.6 64 64 178.6 64 320C64 461.4 178.6 576 320 576zM392.7 320L272 393.7L272 246.3L392.7 320zM252.3 211.1C244.7 215.3 240 223.4 240 232L240 408C240 416.7 244.7 424.7 252.3 428.9C259.9 433.1 269.1 433 276.6 428.4L420.6 340.4C427.7 336 432.1 328.3 432.1 319.9C432.1 311.5 427.7 303.8 420.6 299.4L276.6 211.4C269.2 206.9 259.9 206.7 252.3 210.9z"/>
								</svg>
								</div>'; 
							} ?>
			
						</button>
					</div>
				</div>
			</div>

		<?php endforeach; ?>
	</div>

	<!-- Video Modal -->
	<div id="video-modal" x-show="isOpen" 
		 @keydown.escape.window="closeModal()"
		 class="fixed inset-0 z-100 overflow-y-auto" 
		 style="display: none;"
		 role="dialog"
		 aria-modal="true"
		 aria-labelledby="modal-video-title">
		
		<!-- Backdrop -->
		<div x-show="isOpen"
			 class="fixed inset-0 bg-black opacity-40" 
			 @click="closeModal()" 
			 aria-hidden="true"></div>
		
		<!-- Modal Content -->
		<div class="flex min-h-full items-center justify-center p-4">
			<div x-show="isOpen"
				 x-transition:enter="transition ease-out duration-400"
				 x-transition:enter-start="opacity-0 scale-60"
				 x-transition:enter-end="opacity-100 scale-100"
				 x-transition:leave="transition ease-in duration-200"
				 x-transition:leave-start="opacity-100 scale-100"
				 x-transition:leave-end="opacity-0 scale-60"
				 class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-hidden">
				
				<!-- Modal Header -->
				<div class="flex items-center justify-between p-6 border-b border-gray-200">
					<h3 id="modal-video-title" class="text-xl font-semibold text-gray-900" x-text="currentVideo.name"></h3>
					<button type="button" @click="closeModal()" 
							class="hover:primary transition-colors duration-200 cursor-pointer"
							aria-label="Close video player">
						<span class="sr-only">Close</span>
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
						</svg>
					</button>
				</div>
				
				<!-- Modal Body -->
				<div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">

					<div class="aspect-16/10 w-full">
						<div x-show="currentVideo.youtube_video_url && !currentVideo.vimeo_video_url" class="w-full h-full object-cover">
							<iframe 
								:src="currentVideo.youtube_video_url.replace('watch?v=', 'embed/')" 
								width="800" 
								height="450" 
								allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
								allowfullscreen
								class="w-full h-full"
								:title="currentVideo.name + ' - YouTube video'"
								:aria-label="currentVideo.name + ' video player'"
							></iframe>
						</div>
						<div x-show="currentVideo.vimeo_video_url && !currentVideo.youtube_video_url" class="w-full h-full object-cover">
							<iframe 
								:src="currentVideo.vimeo_video_url.replace('vimeo.com/', 'player.vimeo.com/video/')" 
								width="800" 
								height="450" 
								allow="autoplay; fullscreen; picture-in-picture" 
								allowfullscreen
								class="w-full h-full"
								:title="currentVideo.name + ' - Vimeo video'"
								:aria-label="currentVideo.name + ' video player'"
							></iframe>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

</section>

<script>
function videoModal() {
	return {
		isOpen: false,
		currentVideo: {
			name: '',
			youtube_video_url: '',
			vimeo_video_url: '',
			image: ''
		},
		videos: {
			<?php 
				// Use the same data collected above
				$video_data = array();
				foreach($videos as $video) {
					// Properly escape the data for JavaScript
					$name = json_encode($video['name']);
					$youtube_video_url = json_encode($video['youtube_video_url']);
					$vimeo_video_url = json_encode($video['vimeo_video_url']);
					$image_url = $video['image'] ? wp_get_attachment_image_url($video['image'], 'large') : '';
					$image_encoded = json_encode($image_url);
					
					$video_data[] = "'" . $video['hash'] . "': {
						name: " . $name . ",
						youtube_video_url: " . $youtube_video_url . ",
						vimeo_video_url: " . $vimeo_video_url . ",
						image: " . $image_encoded . "
					}";
				}
				echo implode(',', $video_data);
			?>
		},
		
		openModal(videoId) {
			if (this.videos[videoId]) {
				this.currentVideo = this.videos[videoId];
				this.isOpen = true;
				document.body.style.overflow = 'hidden'; // Prevent background scrolling
			}
		},
		
		closeModal() {
			this.isOpen = false;
			document.body.style.overflow = ''; // Restore scrolling
			
			// Stop all videos in the modal
			const iframes = document.querySelectorAll('#video-modal iframe');
			iframes.forEach(iframe => {
				// For YouTube videos, we need to stop the video by changing the src
				if (iframe.src.includes('youtube.com') || iframe.src.includes('youtu.be')) {
					iframe.src = iframe.src; // This stops the video
				}
				// For Vimeo videos, we can try to pause by posting a message
				else if (iframe.src.includes('vimeo.com')) {
					iframe.contentWindow.postMessage('{"method":"pause"}', '*');
				}
			});
		}
	}
}
</script>

<?php endif; ?>
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
		<?php if (has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?> - Featured image" itemprop="url" class="overflow-hidden relative">
				<?php docandtee_responsive_image(null, null, '(min-width: 960px) 20vw, (min-width: 782px) 30vw, 80vw', 'aspect-5/6 w-full'); ?>
			</a>
		<?php endif; ?>
		<div class="card-body flex flex-col justify-between grow">
			<div class="card-wrapper">
				<h3 class="mt-3! mb-1 mt-0 leading-6 text-xl">
					<a href="<?php the_permalink(); ?>" class="no-underline! transition duration-200" itemprop="url">
						<?php the_title(); ?>
					</a>
				</h3>
				<div class="post-excerpt text-sm mb-3">
					<?php the_excerpt(); ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="flex items-center justify-between no-underline! read-more-btn text-sm">Read more
					<svg id="Group_14" data-name="Group 14" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28.666" height="21.496" viewBox="0 0 28.666 21.496" class="arrow ms-2 transition duration-200 ease-in-out">
						<defs>
							<clipPath id="clip-path">
							<rect id="Rectangle_42" data-name="Rectangle 42" width="28.666" height="21.496"/>
							</clipPath>
						</defs>
						<g id="Group_13" data-name="Group 13" clip-path="url(#clip-path)">
							<path id="Path_9" data-name="Path 9" d="M28.405,11.381a.9.9,0,0,0,0-1.265L18.55.26a.895.895,0,1,0-1.265,1.265l8.326,8.326H.9a.9.9,0,0,0,0,1.792H25.611L17.285,19.97a.895.895,0,0,0,1.265,1.265Z" transform="translate(0 0)"/>
						</g>
					</svg>
				</a>
			</div>
		</div>
	</div>
</div>
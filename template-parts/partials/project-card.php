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
				<?php docandtee_responsive_image(null, null, '(min-width: 960px) 20vw, (min-width: 782px) 30vw, 80vw', 'aspect-3/4 w-full'); ?>
			</a>
		<?php endif; ?>
		<div class="card-body flex flex-col justify-between grow">
			<div class="card-wrapper">
				<h4 class="my-3! mt-0 leading-6">
					<a href="<?php the_permalink(); ?>" class="no-underline! hover:text-primary transition duration-200" itemprop="url">
						<?php the_title(); ?>
					</a>
				</h4>
				<div class="post-excerpt text-sm">
					<?php the_excerpt(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

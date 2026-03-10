<?php 
	if( have_rows('content_block') ): 
	$fullwidth = get_field('full_width_blocks');
?>
   
<section class="text-grid-block <?php if( $fullwidth ) {echo ' fullwidth';} ?> overflow-hidden" aria-label="Staggered content">

	<div class="grid grid-flow-row grid-cols-12 gap-0">

		<?php while( have_rows('content_block') ): the_row();
			$block_title = get_sub_field('block_title');
			$block_text = get_sub_field('block_text');
			$button_text = get_sub_field('button_text');
			$button_link = get_sub_field('button_link');
		?>
		
			<div class="text-block col-span-12 lg:col-span-6 bg-primary text-white">
				<div class="content-inner flex flex-col justify-center p-8 md:p-16 w-full lg:h-full">
					<?php if( $block_title ) { echo '<h3 class="block-bottom mb-4 mt-0!">' .esc_html($block_title). '</h3>'; } ?>
					<?php if( $block_text ) { echo '<div class="copy-wrap">' .$block_text. '</div>'; } ?>
					<?php if( $button_link && $button_text ) {
						echo '
							<div class="mt-8 mb-4"><a 
								href="'.esc_url($button_link).'" 
								class="py-3 px-5 font-bold bg-primary hover:bg-dark border-primary text-white! rounded-full !no-underline transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none"
							>'.esc_html($button_text).'</a></div>
						';
					} ?>
				</div>
			</div>
		<?php endwhile; ?>

	</div>

</section>

<?php endif; ?>


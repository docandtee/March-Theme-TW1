<?php 
	if( have_rows('content_block') ): 
	$fullwidth = get_field('full_width_blocks');
	$fullheight = get_field('full_height_blocks');
	$remove_bottom_margin = get_field('remove_bottom_margin');
?>
   
<section class="staggered-block m-0! <?php if(!$remove_bottom_margin) { echo ' section-m-b '; } if( $fullwidth ) {echo ' fullwidth';} ?> overflow-hidden" aria-label="Staggered content">

	<?php while( have_rows('content_block') ): the_row(); ?>
	
		<?php 
			$image = get_sub_field('image_block');
			$block_title = get_sub_field('block_title');
			$block_text = get_sub_field('block_text');
			$button_text = get_sub_field('button_text');
			$button_link = get_sub_field('button_link');
			$button_external_link = get_sub_field('button_external_link');
		?>
	
	<div class="grid grid-flow-row grid-cols-12 gap-0 <?php if( $fullheight ) {echo ' vh-100 ';} if( !$fullwidth ) {echo ' section-p-t section-p-b ';}	?>">
		
		<?php if ( $image ): ?>
			<div class="img-block col-span-12 lg:col-span-6">
				<div class="relative h-full min-h-128">
					<?php docandtee_responsive_image( $image, null, '(min-width: 960px) 50vw, 100vw', 'w-full absolute h-full object-cover' ); ?>
				</div>
			</div>

		<?php endif; ?> 
	
		<div class="text-block col-span-12 lg:col-span-6 flex flex-col justify-center">
			<div class="content-inner p-8 md:p-16">
				<?php if( $block_title ) { echo '<h3 class="block-bottom mb-4 mt-0!">' .esc_html($block_title). '</h3>'; } ?>
				<?php if( $block_text ) { echo '<div class="copy-wrap">' .$block_text. '</div>'; } ?>
				<?php if( $button_link && $button_text ) {
					echo '
						<div class="mt-12"><a 
							href="'.esc_url($button_link).'" 
							class="staggered-btn py-3 px-5 font-bold bg-primary hover:bg-dark border-primary text-white! rounded-full !no-underline transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none"
						>'.esc_html($button_text).'</a></div>
					';
				} ?>
			 </div>
		</div>

	</div>

	<?php unset($image); endwhile; ?>

</section>

<?php endif; ?>


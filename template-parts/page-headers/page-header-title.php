<?php
	$text_center = get_field('align_text_centrally');
	$show_sub_title = get_field('show_sub_title');
	$page_header_subtitle = get_field('page_header_subtitle');
	$include_a_cta_button = get_field('include_a_cta_button');
	$cta_button_text = get_field('cta_button_text');
	$cta_button_link = get_field('cta_button_link');
	$text_center = get_field('align_text_centrally');
	$pagewidth = get_field('page_width');
?>
<div class="container mx-auto my-6 lg:my-20 <?php if( $pagewidth == 'narrow' ) { echo ' max-w-4xl '; } elseif( $pagewidth == 'fullwidth' ) { echo 'max-w-lvw'; } ?>">
	<div class="hero-content">
		<header class="<?php if( $text_center  ) { echo 'text-center';} ?>">
			<h1 class="mb-5 [text-wrap:balance]"><?php the_title(); ?></h1>
			<?php if( $show_sub_title && $page_header_subtitle ) { echo '<p class="page-subtitle text-lg md:text-xl [text-wrap:balance]">' .esc_html($page_header_subtitle). '</p>'; } ?> 
			<?php if( $include_a_cta_button && $cta_button_text && $cta_button_link ) { 
				echo '<div class="button-wrap mt-8"><a class="flex items-center content-between py-3 px-8 text-lg font-display bg-primary hover:bg-secondary border-primary text-light rounded-full !no-underline transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none" href="'.esc_url($cta_button_link).'">
				'.esc_html($cta_button_text).'
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
				</a></div>'; 
			} ?>
		</header>
	</div>
</div>
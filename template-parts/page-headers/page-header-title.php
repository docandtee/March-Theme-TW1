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
				echo '<div class="button-wrap mt-8"><a class="inline-block py-3 px-8 text-lg font-display bg-secondary uppercase hover:bg-primary border-secondary text-dark rounded-full !no-underline transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none" href="'.esc_url($cta_button_link).'">'.esc_html($cta_button_text).'</a></div>'; 
			} ?>
		</header>
	</div>
</div>
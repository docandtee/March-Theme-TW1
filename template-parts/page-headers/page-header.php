<?php 
	$backgroundvid = get_field('replace_featured_image_with_background_video');
	$slider = get_field('use_slider');
	$animation_bg = get_field('animation_bg');
	if( $animation_bg ) : ?>

	<?php get_template_part('template-parts/page-headers/page-header-animation'); ?>

<?php elseif( $slider) :?>

	<?php get_template_part('template-parts/page-headers/page-header-carousel'); ?>
	
<?php else : ?>

	<?php if( $backgroundvid ) : ?>

		<?php get_template_part('template-parts/page-headers/page-header-video'); ?>
			
	<?php elseif (has_post_thumbnail()) : ?>

		<?php get_template_part('template-parts/page-headers/page-header-img'); ?>
			
	<?php else : ?>

		<?php get_template_part('template-parts/page-headers/page-header-title'); ?>

	<?php endif; ?>

<?php endif; ?>



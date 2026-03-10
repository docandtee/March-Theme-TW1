<?php 
// Ensure we're using the global post object
global $post;
?>
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
        <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>" aria-label="<?php echo esc_attr( get_the_title($post->ID) ); ?>" itemprop="url" class="hover-block overflow-hidden relative block transition hover:scale-110 duration-200 ease-in-out rounded-lg">
            <?php if ( has_post_thumbnail($post->ID) ) : ?>
                <?php 
                    // Get the current post's thumbnail ID
                    $thumbnail_id = get_post_thumbnail_id($post->ID);
                    if ($thumbnail_id) {
                        docandtee_responsive_image($thumbnail_id, null, '(min-width: 960px) 20vw, (min-width: 782px) 40vw, 80vw', 'aspect-3/2 w-full object-cover'); 
                    }
                ?>
                <div class="absolute inset-0 w-full h-full bg-black opacity-30"></div>
            <?php endif; ?>
            <div class="absolute top-0 text-white p-5 h-full w-full flex flex-col justify-end">
                <h4 class="hover-title mb-0 leading-6"><?php echo esc_html( get_the_title($post->ID) ); ?></h4>
            </div>
        </a>
    </div>
</div>
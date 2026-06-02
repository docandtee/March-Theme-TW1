<?php 
    $section_heading = get_field('section_heading', 'option');
    $section_copy = get_field('section_copy', 'option');
    $button_text = get_field('button_text', 'option');
    $button_link = get_field('button_link', 'option');
?>
<section class="newsletter-footer w-full section-p-b section-p-t overflow-hidden" aria-label="Contact us">
    <div class="container">
        <?php if( $section_heading ) { echo '<h1 class="mb-3">' .esc_html( $section_heading ). '</h1>'; } ?>
        <?php if( $section_copy ) { echo '<div class="text-lg">' .$section_copy. '</div>'; } ?>
        <?php if( $button_link && $button_text ) {
            echo '
                <div class="mt-12"><a 
                    href="'.esc_url($button_link).'" 
                    class="staggered-btn py-3 px-5 font-bold bg-primary hover:bg-dark border-primary text-white! rounded-full !no-underline transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none"
                >'.esc_html($button_text).'</a></div>
            ';
        } ?>
    </div>
</section>
<?php 
    $section_heading = get_field('section_heading', 'option');
    $section_copy = get_field('section_copy', 'option');
    $button_text = get_field('button_text', 'option');
    $button_link = get_field('button_link', 'option');
?>
<section class="newsletter-footer w-full overflow-hidden" aria-label="Contact us">
    <div class="container border-t-1 border-tertiary section-p-t section-p-b">
        <div class="max-w-2xl">
        <?php if( $section_heading ) { echo '<h1 class="mb-3">' .esc_html( $section_heading ). '</h1>'; } ?>
        <?php if( $section_copy ) { echo '<div class="text-lg">' .$section_copy. '</div>'; } ?>

        <?php if( $button_link && $button_text ) { 
            echo '<div class="button-wrap mt-8 flex"><a class="header-btn flex items-center content-between py-3 px-8 text-lg bg-primary hover:bg-secondary border-primary text-dark hover:text-light rounded-full !no-underline transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none" href="'.esc_url($button_link).'">
            '.esc_html($button_text).'
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
    </div>
</section>
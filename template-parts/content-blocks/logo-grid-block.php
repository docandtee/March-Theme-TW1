<?php 
	if( have_rows('logo_grid') ): 
	$section_heading = get_field('section_heading');
    $section_copy = get_field('section_copy'); 
    $show_logos_in_a_slider = get_field('show_logos_in_a_slider');
?>

<section class="logo-grid fullwidth overflow-hidden bg-white mt-0! section-p-b section-p-t" aria-label="Logo grid">

    <div class="container">

        <?php if($section_heading) {
            echo '<h2 class="mb-4 mt-0! text-dark">' . esc_html($section_heading) . '</h2>';
        } ?>
        <?php if($section_copy) {
            echo '<div class="section-copy text-dark">' . $section_copy . '</div>';
        } ?>

        <?php if($show_logos_in_a_slider) : ?>

            <div class="splide logo-splide">
                <div class="splide__track">
                    <ul class="splide__list items-center">
                        <?php 
                            $logos = get_field('logo_grid');
                            if($logos) {
                                // Render slides many times for infinite loop
                                for($i = 0; $i < 10; $i++) {
                                    foreach($logos as $slide):
                                        $logo = $slide['logo'];
                                        $company_url = $slide['company_url'];
                                        if ( $logo ):
                        ?>
                            <li class="splide__slide h-full p-0!">
                                <div class="h-full w-full px-2 flex flex-col overflow-hidden items-center justify-center">
                                    <?php if($company_url) { echo '<a href="'.esc_url($company_url).'" target="_blank" rel="noopener noreferrer" aria-label="Visit company website (opens in new tab)" class="flex-shrink-0 w-full h-full flex items-center justify-center">';} ?>
                                        <?php docandtee_responsive_image($logo, null, '20vw', 'max-w-full max-h-full object-contain'); ?>
                                    <?php if($company_url) { echo '</a>';} ?>
                                </div>
                            </li>
                        <?php 
                                        endif;
                                    endforeach;
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>

        <?php else : ?>
            <div class="grid grid-flow-row grid-cols-12 gap-8 items-center justify-items-center">
                <?php while( have_rows('logo_grid') ): the_row(); 
                    $logo = get_sub_field('logo');
                    $company_url = get_sub_field('company_url');
                ?>
                    <?php if ( $logo ): ?>
                    <div class="col-span-6 md:col-span-4 lg:col-span-2">
                        <?php if($company_url) { echo '<a href="'.esc_url($company_url).'" target="_blank" rel="noopener noreferrer" aria-label="Visit company website (opens in new tab)">';} ?>
                            <?php docandtee_responsive_image($logo, null, '20vw', 'max-w-full max-h-full object-contain'); ?>
                        <?php if( $company_url ) { echo '</a>';} ?>
                    </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
<?php endif; ?>

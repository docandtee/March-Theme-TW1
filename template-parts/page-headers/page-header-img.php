<?php 
    $photo_credit = get_field('photo_credit');
    $parallax = get_field('add_parallax_scrolling');
?>
<section class="page-header relative overflow-hidden hero-height" aria-label="Page header with featured image">

    <div class="fixed flex justify-center items-center w-full h-full">
        <?php if( $parallax ) : ?>
            <div class="w-full md:w-[120%] h-full md:h-auto absolute">
                <?php docandtee_responsive_image(null, null, '(min-width: 1280px) 80vw, 100vw', 'parallax-bg w-full h-full object-cover'); ?>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const parallaxElements = document.querySelectorAll('.parallax-bg');
                    
                    function updateParallax() {
                        // Only run on small screens (mobile/tablet)
                        if (window.innerWidth <= 782) {
                            return;
                        }
                        
                        const scrolled = window.pageYOffset;
                        
                        parallaxElements.forEach(function(element) {
                            const speed = 0.4;
                            const yPos = -(scrolled * speed);
                            element.style.transform = 'translateY(' + yPos + 'px)';
                        });
                    }
                    
                    function handleResize() {
                        // Reset transform on larger screens
                        if (window.innerWidth <= 782) {
                            parallaxElements.forEach(function(element) {
                                element.style.transform = 'translateY(0px)';
                            });
                        }
                    }
                    
                    window.addEventListener('scroll', updateParallax);
                    window.addEventListener('resize', handleResize);
                    updateParallax(); // Initial call
                });
            </script>
        <?php else : ?>
            <?php docandtee_responsive_image(null, null, '100vw', 'w-full h-full object-cover'); ?>
        <?php endif; ?>
        <div class="absolute inset-0 w-full h-full bg-black opacity-40"></div>
    </div>

    <div class="header-content relative w-full h-full flex items-center text-white">
        <?php get_template_part('template-parts/page-headers/page-header-title'); ?>
    </div>
    <?php if($photo_credit) { echo '<div class="photocredit absolute z-3 top-0 end-0 small p-3 text-white" role="note" aria-label="Photo credit">'.esc_html($photo_credit).'</div>';} ?>

</section>
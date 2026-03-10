<?php 
    $photo_credit = get_field('photo_credit');
?>
<section class="page-header particles-bg relative overflow-hidden hero-height flex items-end justify-center" aria-label="animnated page header background">

        <div class="particle particle-1 absolute w-full h-full"></div>
        <div class="particle particle-1b absolute w-full h-full"></div>


    <div class="header-content relative w-full text-white">
        <?php get_template_part('template-parts/page-headers/page-header-title'); ?>
    </div>
    <?php if($photo_credit) { echo '<div class="photocredit absolute z-3 top-0 end-0 small p-3 text-white" role="note" aria-label="Photo credit">'.esc_html($photo_credit).'</div>';} ?>

</section>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
    <section class="bg-dark text-white section-p-t section-p-b">
        <div class="container">
            <header class="mb-3">	
                <h1 id="post-title-<?php the_ID(); ?>" class="mb-5 [text-wrap:balance]"><?php the_title(); ?></h1>
            </header>
            <?php 
                $company = get_the_terms( $post->ID, 'company-type' );
                if ( !empty( $company ) ) {
                    echo '<div class="mb-1">Company type: ';
                    foreach($company as $term) {
                        echo '<span class=" '.$term->slug.'">'.$term->name.'</span>';
                    }
                    echo '</div>';
                }

                $sector = get_the_terms( $post->ID, 'sector' );
                if ( !empty( $sector ) ) {
                    echo '<div class="mb-1">Company type: ';
                    foreach($sector as $term) {
                        echo '<span class=" '.$term->slug.'">'.$term->name.'</span>';
                    }
                    echo '</div>';
                }

                $location = get_the_terms( $post->ID, 'location' );
                if ( !empty( $location ) ) {
                    echo '<div class="mb-1">Company type: ';
                    foreach($location as $term) {
                        echo '<span class=" '.$term->slug.'">'.$term->name.'</span>';
                    }
                    echo '</div>';
                }
            ?>
        </div>
    </section>
    <?php if(has_post_thumbnail()): ?>
        <section class="page-header relative overflow-hidden hero-height flex items-end justify-center" aria-label="Page header with featured image">
            <div class="absolute flex justify-center items-center w-full h-full">
                <?php docandtee_responsive_image(null, null, '100vw', 'w-full h-full object-cover'); ?>
            </div>
        </section>
    <?php endif; ?>

    <div class="container">
        <div class="entry-content mx-auto max-w-3xl mt-10 sm:mt-20 text-dark" role="main">
            <?php the_content(); ?>
        </div>
    </div>

    <?php if( have_rows('case_study_section' )): ?>
        <section class="bg-white w-full section-p-t section-p-b">
            <div class="container">
                <div class="grid grid-flow-row grid-cols-12 gap-8">
                    <?php
                        while( have_rows('case_study_section') ): the_row(); 
                        $section_title = get_sub_field('section_title');
                        $section_copy = get_sub_field('section_copy');
                    ?>
                        <?php if( $section_title ) { echo '<div class="col-span-12 md:col-span-6 lg:col-span-4"><h3 class="text-xl">'.$section_title.'</h3></div>'; } ?>
                        <?php if( $section_copy ) { echo '<div class="col-span-12 md:col-span-6 lg:col-span-8">'.$section_copy.'</div>'; } ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</article>

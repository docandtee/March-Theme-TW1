<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
    <header class="mx-auto flex max-w-5xl flex-col text-center">
        <h1 id="post-title-<?php the_ID(); ?>" class="mt-6 text-5xl tracking-tight [text-wrap:balance] sm:text-6xl font-display"><?php the_title(); ?></h1>
    </header>

    <?php if(has_post_thumbnail()): ?>
        <figure class="mt-10! sm:mt-20 mx-auto! max-w-5xl rounded-4xl overflow-hidden">
            <?php docandtee_responsive_image(null, null, null, 'aspect-16/10 w-full object-cover'); ?>
        </figure>
    <?php endif; ?>

    <div class="container">
        <div class="entry-content mx-auto max-w-3xl mt-10 sm:mt-20 text-dark" role="main">
            <?php the_content(); ?>
        </div>
    </div>

    <?php if( have_rows('case_study_section' )): ?>
        <section class="bg-white w-full">
            <div class="container">
                <div class="grid grid-flow-row grid-cols-12 gap-8">
                    <?php
                        while( have_rows('case_study_section') ): the_row(); 
                        $section_title = get_sub_field('section_title');
                        $section_copy = get_sub_field('section_copy');
                    ?>
                        <?php if( $section_title ) { echo '<div class="col-span-12 md:col-span-6 lg:col-span-4">'.$section_title.'</div>'; } ?>
                        <?php if( $section_copy ) { echo '<div class="col-span-12 md:col-span-6 lg:col-span-8">'.$section_copy.'</div>'; } ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

</article>

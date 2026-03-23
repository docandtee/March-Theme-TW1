<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
    <div class="container">
        <header class="section-p-b">
			<h1 class="mb-5 [text-wrap:balance] page-header-title-words">
				<?php
				$title_words = preg_split('/\s+/u', get_the_title(), -1, PREG_SPLIT_NO_EMPTY);
				foreach ( $title_words as $i => $word ) {
					echo '<span class="page-header-word" style="--word-index: ' . (int) $i . '">' . esc_html( $word ) . '</span>';
					if ( $i < count( $title_words ) - 1 ) {
						echo ' ';
					}
				}
				?>
			</h1>
        </header>
    </div>

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

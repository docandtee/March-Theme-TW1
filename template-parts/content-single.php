<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> aria-labelledby="post-title-<?php the_ID(); ?>">
    <header class="mx-auto flex max-w-5xl flex-col text-center">
        <h1 id="post-title-<?php the_ID(); ?>" class="mt-6 text-5xl tracking-tight [text-wrap:balance] sm:text-6xl font-display"><?php the_title(); ?></h1>

        <?php if(! is_page()): ?>
            <time datetime="<?php echo get_the_date( 'c' ); ?>" itemprop="datePublished" class="order-first text-sm text-zinc-950">
                <span class="sr-only">Published on </span><?php echo get_the_date(); ?>
            </time>

            <p class="mt-6 text-sm">
                <span class="sr-only">Written </span>by <?php the_author(); ?>
            </p>
        <?php endif; ?>
    </header>

    <?php if(has_post_thumbnail()): ?>
        <figure class="mt-10! sm:mt-20 mx-auto! max-w-5xl rounded-4xl overflow-hidden">
            <?php docandtee_responsive_image(null, null, null, 'aspect-16/10 w-full object-cover'); ?>
        </figure>
    <?php endif; ?>

    <div class="entry-content mx-auto max-w-3xl mt-10 sm:mt-20 text-dark" role="main">
        <?php the_content(); ?>
    </div>

    <?php if ( ! is_page() ): ?>
        <footer class="mx-auto max-w-3xl mt-10 pt-10 border-t border-zinc-200">
            <div class="text-sm text-zinc-600">
                <?php get_template_part('template-parts/partials/post-categories'); ?>
            </div>
        </footer>
    <?php endif; ?>
</article>

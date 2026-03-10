<?php do_action('tailpress_header'); ?>

<div x-data="{ openSearch: false }">
    <div 
        id="searchCollapse" 
        class="overflow-hidden transition-all duration-300 ease-in-out"
        :class="openSearch ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'"
    >
        <div class="px-6 py-4 bg-gray-50">
            <div class="inline-block">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>

    <header class="w-full bg-white">
        <div class="container p-3">
            <div class="flex justify-end items-center mb-3 lg:hidden">
                <button 
                    class="py-3 px-5 cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none" 
                    type="button" 
                    @click="openSearch = !openSearch"
                    :aria-expanded="openSearch"
                    aria-controls="searchCollapse"
                    aria-label="Toggle search"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon-style transition duration-200 ease-in-out" aria-hidden="true">
                        <path d="M448 272C448 174.8 369.2 96 272 96C174.8 96 96 174.8 96 272C96 369.2 174.8 448 272 448C369.2 448 448 369.2 448 272zM407.3 430C371 461.2 323.7 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272C480 323.7 461.2 371 430 407.3L571.3 548.7C577.5 554.9 577.5 565.1 571.3 571.3C565.1 577.5 554.9 577.5 548.7 571.3L407.3 430z"/>
                    </svg>
                </button>
                <a 
                    href="<?php echo esc_url(home_url('/')); ?>" 
                    class="py-3 px-5 text-sm font-bold bg-primary hover:bg-dark border-primary text-white rounded-full !no-underline ms-4 transition duration-200 ease-in-out text-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-primary focus:outline-none"
                >Custom button</a>
            </div>

            <div class="grid grid-flow-row grid-cols-12 items-center justify-between">

                <div class="col-span-4 lg:col-span-2 header-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="!no-underline h-full w-full flex align-center" aria-label="<?php echo esc_attr( get_bloginfo('name') ); ?> - Home">
                        <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 605.83 162.78" role="img" aria-labelledby="logo-title">
                            <title id="logo-title"><?php echo esc_attr( get_bloginfo('name') ); ?> Logo</title>
                            <defs><style>.cls-1{fill:#1d1d1b;}.cls-1,.cls-2{stroke-width:0px;}.cls-2{fill:#00ebb5;}</style></defs>
                            <path class="cls-1" d="M29.9,41.08H0v80.67h29.9c22.26,0,40.33-18.07,40.33-40.33s-18.06-40.33-40.33-40.33ZM30,100.88h-8.92v-38.19h8.92c10.54,0,19.14,8.61,19.14,19.04s-8.6,19.14-19.14,19.14Z"/>
                            <path class="cls-1" d="M117.13,41.08c-22.27,0-40.24,18.18-40.24,40.45s17.97,40.22,40.24,40.22,40.33-17.96,40.33-40.22-18.06-40.45-40.33-40.45ZM117.13,100.66c-10.54,0-19.14-8.71-19.14-19.25s8.6-19.25,19.14-19.25,19.25,8.6,19.25,19.25-8.61,19.25-19.25,19.25Z"/>
                            <path class="cls-1" d="M204.35,100.34c-10.97,0-18.93-7.96-18.93-18.93s7.96-18.93,18.93-18.93c5.5,0,10.23,1.94,13.55,5.27l14.85-14.95c-7.31-7.31-17.32-11.73-28.4-11.73-22.27,0-40.33,18.08-40.33,40.33s18.06,40.33,40.33,40.33c11.19,0,21.3-4.62,28.61-11.94l-15.06-14.84c-3.32,3.45-8.06,5.38-13.55,5.38Z"/>
                            <polygon class="cls-1" points="412.49 62.09 433.45 62.09 433.45 121.75 454.62 121.75 454.62 62.09 476 62.09 476 41.04 412.49 41.04 412.49 62.09"/>
                            <polygon class="cls-1" points="488.78 121.75 538.86 121.75 538.86 104.44 509.95 104.44 509.95 89.61 535.53 89.61 535.53 71.78 509.95 71.78 509.95 58.66 538.86 58.66 538.86 41.14 488.78 41.14 488.78 121.75"/>
                            <polygon class="cls-1" points="605.83 58.66 605.83 41.14 555.74 41.14 555.74 121.75 605.83 121.75 605.83 104.44 576.91 104.44 576.91 89.61 602.5 89.61 602.5 71.78 576.91 71.78 576.91 58.66 605.83 58.66"/>
                            <path class="cls-2" d="M354.52,121.85l41.02-41.16v-6.94l-44.38,44.79-54.14-53.44c-5.85-6.66-9.08-15.18-9.08-23.99,0-20.06,16.32-36.39,36.38-36.39,10.37,0,20.29,4.49,27.23,12.32,1.29,1.46,2.46,3.02,3.49,4.64,0,.01.02.03.02.04.06.15.09.32.09.48,0,.79-.64,1.43-1.42,1.43-.17,0-.34-.04-.59-.13-1.8-.75-3.68-1.22-5.59-1.41-.67-.07-1.36-.1-2.04-.1-10.99,0-19.92,8.94-19.92,19.92s8.94,19.93,19.92,19.93,19.93-8.94,19.93-19.93v-.79c0-3.31-.44-6.72-1.32-10.15-1.51-5.92-4.35-11.49-8.2-16.12-7.86-9.44-19.37-14.85-31.6-14.85-22.67,0-41.11,18.44-41.11,41.11,0,9.35,3.21,18.48,9.01,25.7.3.39.64.74.9,1.01l.17.18c.11.11.21.23.33.36,1.22,1.37,2.49,2.62,3.71,3.67l10.05,9.93c-3.48-.94-7.08-1.41-10.72-1.41-22.66,0-41.1,18.45-41.1,41.12s18.44,41.11,41.1,41.11c10.46,0,20.42-3.95,28.05-11.12l.05.05,26.42-26.52,37.88,37.4h6.69s-41.23-40.75-41.23-40.75ZM296.66,85.28c7.3,0,14.33,2.15,20.39,6.24l30.77,30.36-24.73,24.83-.53.53c-6.87,6.98-16.07,10.83-25.9,10.83-20.07,0-36.39-16.32-36.39-36.38s16.33-36.4,36.39-36.4Z"/>
                        </svg>
                    </a>
                </div>

                <?php if (has_nav_menu('primary')) : ?>
                    <div class="col-span-8 lg:hidden flex justify-end items-center">
                    <nav x-data="{ open: false }" x-init="window.mobileNavOpen = false" class="z-100">
                            <button class="w-14 h-14 relative focus:outline-none cursor-pointer" 
                                    @click="open = !open; window.mobileNavOpen = open; document.getElementById('primary-navigation').classList.toggle('mobilenav', open)"
                                    :aria-expanded="open"
                                    aria-controls="primary-navigation"
                                    aria-label="Toggle navigation menu">
                                <span class="sr-only" x-text="open ? 'Close menu' : 'Open menu'">Open menu</span>
                                <div class="block w-5 absolute left-6 top-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                    <span  class="block absolute h-0.5 w-7 text-primary bg-current transform transition duration-200 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
                                    <span  class="block absolute  h-0.5 w-5 text-primary bg-current   transform transition duration-200 ease-in-out" :class="{'opacity-0': open } "></span>
                                    <span  class="block absolute  h-0.5 w-7 text-primary bg-current transform  transition duration-200 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
                                </div>
                            </button>
                        </nav>
                    </div>
                <?php endif; ?>

                <div class="lg:col-span-10">

                    <div class="hidden lg:flex justify-end items-center mb-3">
                        <?php get_template_part('template-parts/content-blocks/social-media-icons'); ?>
                        <button 
                            class="py-3 px-5 cursor-pointer" 
                            type="button" 
                            @click="openSearch = !openSearch"
                            :aria-expanded="openSearch"
                            aria-controls="searchCollapse"
                            aria-label="Toggle search"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon-style transition duration-200 ease-in-out" aria-hidden="true">
                                <path d="M448 272C448 174.8 369.2 96 272 96C174.8 96 96 174.8 96 272C96 369.2 174.8 448 272 448C369.2 448 448 369.2 448 272zM407.3 430C371 461.2 323.7 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272C480 323.7 461.2 371 430 407.3L571.3 548.7C577.5 554.9 577.5 565.1 571.3 571.3C565.1 577.5 554.9 577.5 548.7 571.3L407.3 430z"/>
                            </svg>
                        </button>
                        <a 
                            href="<?php echo esc_url(home_url('/')); ?>" 
                            class="py-3 px-5 text-sm font-bold bg-primary hover:bg-dark border-primary text-white rounded-full !no-underline ms-4 transition duration-200 ease-in-out text-nowrap"
                        >Custom button</a>
                    </div>

                    <?php if (has_nav_menu('primary')) : ?>
                        <div 
                            id="primary-navigation"
                            class="flex justify-center lg:justify-end items-center bg-dark md:bg-transparent fixed lg:relative w-full lg:w-auto h-screen lg:h-auto top-0 left-0 lg:top-auto lg:left-auto z-50 lg:z-auto transition duration-200 ease-in-out"
                            role="navigation"
                            aria-label="Primary navigation"
                        >
                            <?php wp_nav_menu( array(
                                'theme_location'  => 'primary',
                                'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
                                'container'       => 'nav',
                                'container_class' => 'menu-main-menu-container w-full lg:w-auto px-10 lg:px-0',
                                'container_id'    => 'primary-menu',
                                'menu_class'      => 'md:flex [&_a]:!no-underline',
                                'fallback_cb'     => 'Tailwind_Navwalker::fallback',
                                'walker'            => new Tailwind_Navwalker,
                            ) ); ?>
                        </div>
                    <?php endif;?>

                </div>

            </div>
        </div>
    </header>
</div>

<div id="content" class="site-content grow">
        <?php do_action('tailpress_content_start'); ?>

        <main>
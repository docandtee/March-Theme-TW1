<header class="section-m-b">
    <h1 class="text-4xl md:text-5xl lg:text-6xl [text-wrap:balance] text-center font-display">
        <?php 
            if ( is_home()) {
                single_post_title();
            }
            elseif (is_archive()) {
                the_archive_title();
            } 
            elseif (is_category()) {
                single_cat_title();
            }
            elseif (is_tag()) {
                single_tag_title();
            }
            elseif (is_author()) {
                printf(__('Posts by %s', 'tailpress'), get_the_author());
            }
            elseif (is_day()) {
                printf(__('Daily Archives: %s', 'tailpress'), get_the_date());
            }
            elseif (is_month()) {
                printf(__('Monthly Archives: %s', 'tailpress'), get_the_date('F Y'));
            }
            elseif (is_year()) {
                printf(__('Yearly Archives: %s', 'tailpress'), get_the_date('Y'));
            }
            elseif (is_search()) {
                printf(__('Search results for: %s', 'tailpress'), get_search_query());
            }
            elseif (is_404()) {
                _e('Page Not Found', 'tailpress');      
            }
        ?>
    </h1>
</header>
<form method="GET" action="<?php echo esc_url( get_bloginfo('url') ); ?>" class="relative" role="search" aria-label="<?php _e('Site search'); ?>">
    <label for="site-search" class="sr-only"><?php _e('Search'); ?></label>
    <input type="search" id="site-search" name="s" class="border border-dark/10 px-4 py-2 text-sm rounded-full" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php _e('Search'); ?>" aria-label="<?php _e('Search for content'); ?>">
    <button type="submit" class="absolute right-2 top-2" aria-label="<?php _e('Submit search'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="text-dark/70 size-5" aria-hidden="true">
            <path fill-rule="evenodd" d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" clip-rule="evenodd" />
        </svg>
    </button>
</form>

<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'woocommerce',
            'html5' => [
                'search-form',
                'gallery',
                'caption',
            ]
        ]))
        ->withTextdomain('tailpress');
}

tailpress();


// =============================================================================
// DOCANDTEE THEME FUNCTIONALITY
// =============================================================================


add_action('wp_enqueue_scripts', function () {
    
    // Alpine core + intersect combined
    wp_enqueue_script(
        'alpine',
        get_template_directory_uri() . '/resources/js/alpine.min.js',
        [],
        '3.15',
        true
    );
});


// Defer Alpine scripts
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if (in_array($handle, ['alpine'])) {
        return '<script src="' . esc_url($src) . '" defer></script>';
    }
    return $tag;
}, 10, 3);


// Include additional theme files
$docandtee_includes = [
    'responsive-images.php',    // Responsive images
    'Walkers/NavWalker.php', // Tailwind Nav Walker
    'theme-settings-menu.php',    // Register social links
    'gutenberg-blocks.php',    // Gutenberg blocks support
    //'cpt.php',    // Custom post types
    //'shared-taxonomies.class.php',    // Shared taxonomies
    //'access.php',    // Access controls
];

$docandtee_includes_path = get_template_directory() . '/src/';
foreach ($docandtee_includes as $file) {
    if (!file_exists($docandtee_includes_path . $file)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'docandtee'), $file), E_USER_ERROR);
        continue;
    }
    include_once $docandtee_includes_path . $file;
    unset($file);
}
unset($docandtee_includes_path);


/* Move wordpress jquery core stuff to footer 
add_action( 'wp_default_scripts', 'move_jquery_into_footer' );

function move_jquery_into_footer( $wp_scripts ) {

    if( is_admin() ) {
        return;
    }

    $wp_scripts->add_data( 'jquery', 'group', 1 );
    $wp_scripts->add_data( 'jquery-core', 'group', 1 );
    $wp_scripts->add_data( 'jquery-migrate', 'group', 1 );
}
*/

// =============================================================================
// THEME CUSTOMIZATIONS
// =============================================================================


// Add excerpts to pages
add_action('init', function() {
    add_post_type_support('page', 'excerpt');
});

// Custom excerpt length
add_filter('excerpt_length', function($length) {
    return 24;
}, 999);

// Remove excerpt "more" text
add_filter('excerpt_more', function($more) {
    return ' ';
});

// Customize archive titles
add_filter('get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) {
        $title = sprintf(__('%1$s'), single_term_title('', false));
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    }
    return $title;
});

// =============================================================================
// LOGIN SCREEN CUSTOMIZATION
// =============================================================================

// Customize login logo URL
add_filter('login_headerurl', function() {
    return home_url();
});

// Enqueue custom login stylesheet
add_action('login_enqueue_scripts', function() {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/app.css');
});

// =============================================================================
// NAVIGATION & MENUS
// =============================================================================

// Widget menu navigation walker
add_filter('widget_nav_menu_args', function($args) {
    return array_merge(
        $args,
        array(
            'walker'            => new Tailwind_Navwalker,
            'container'         => 'nav',
            'container_class'   => 'widget-nav',
            'menu_class'        => 'nav flex flex-wrap items-center justify-center',
            'depth'             => 1,
        )
    );
});

// =============================================================================
// ADMIN CUSTOMIZATIONS
// =============================================================================

// Hide admin bar from non-admins
add_action('after_setup_theme', function() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
});

// =============================================================================
// ACF INTEGRATION
// =============================================================================

// Add global options for ACF (multisite specific)
add_action('init', function() {
    if (!function_exists('acf_add_options_page')) {
        return;
    }
    
    acf_add_options_page(array(
        'page_title'    => 'Sitewide content',
        'menu_title'    => 'Sitewide content',
        'menu_slug'     => 'sitewide_content',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
});


// =============================================================================
// WIDGETS & SIDEBARS
// =============================================================================
if (!function_exists('docandtee_widgets_init')) {
    function docandtee_widgets_init()
    {

        register_sidebar(array(
            'name'          => __('Footer', 'docandtee'),
            'id'            => 'sidebar-footer',
            'before_widget' => '<aside class="widget %1$s %2$s p-3" aria-label="%1$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title mb-3 font-bold">',
            'after_title'   => '</h3>'
        ));
    }
    add_action('widgets_init', 'docandtee_widgets_init');
}
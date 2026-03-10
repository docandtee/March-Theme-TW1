<?php
/**
 * Theme header template.
 *
 * @package TailPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>
    <?php do_action('tailpress_site_before'); ?>
    
    <!-- Skip Navigation Link for Accessibility -->
    <a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-0 focus:left-0 focus:z-[9999] focus:px-4 focus:py-2 focus:bg-primary focus:text-white focus:no-underline">Skip to main content</a>
    
    <div id="page" class="min-h-screen flex flex-col">
        
        <?php get_template_part('template-parts/theme-header'); ?>


    

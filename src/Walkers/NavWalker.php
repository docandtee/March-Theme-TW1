<?php
/*
 * Class Name: Tailwind_Navwalker
 * Description: A custom WordPress nav walker class with Tailwind + Alpine.js click-to-toggle dropdowns.
 * Author: Adapted for Tailwind + Alpine.js
 * Version: 1.1.0
 * License: GPL-3.0+
 */

if (!class_exists('Tailwind_Navwalker')) {
    class Tailwind_Navwalker extends \Walker_Nav_Menu
    {
        /**
         * Start submenu wrapper
         */
        public function start_lvl(&$output, $depth = 0, $args = array())
        {
            $indent = str_repeat("\t", $depth);
            $classes = array(
                'relative md:absolute left-0 py-1 w-full md:w-48 bg-transparent md:bg-white rounded-md z-50 overflow-hidden',
                'origin-top-left transition ease-out duration-100',
            );
            $class_names = ' class="' . esc_attr(join(' ', $classes)) . '"';
            $output .= "\n$indent<ul x-show=\"open\" x-transition $class_names @click.away=\"open = false\" x-cloak role=\"menu\" style=\"display: none;\">\n";
        }

        /**
         * Start menu item
         */
        public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
        {
            $indent = ($depth) ? str_repeat("\t", $depth) : '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;

            if (isset($args->has_children) && $args->has_children) {
                $classes[] = 'relative';
            } else {
                $classes[] = 'nav-item';
            }

            $class_names = ' class="' . esc_attr(join(' ', $classes)) . '"';
            
            // Generate unique ID for submenu
            $submenu_id = 'submenu-' . $item->ID;

            // If parent has children → add x-data for Alpine toggle
            if (isset($args->has_children) && $args->has_children && $depth === 0) {
                $output .= $indent . '<li ' . $class_names . ' x-data="{ open: false }">';
            } else {
                $output .= $indent . '<li ' . $class_names . '>';
            }

            // Link attributes
            $atts = array();
            $atts['href'] = !empty($item->url) ? $item->url : '#';

            if ($depth > 0) {
                $atts['class'] = 'block px-3 py-2 text-white lg:text-dark hover:text-primary font-display leading-none no-underline!';
                $atts['role'] = 'menuitem';
            } else {
                $atts['class'] = 'cursor-pointer menu-link px-3 py-2 inline-flex items-center text-white hover:text-primary text-xl no-underline! font-bold';
            }

            // Add aria-current for current page
            if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes)) {
                $atts['aria-current'] = 'page';
            }

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
                }
            }

            $title = apply_filters('the_title', $item->title, $item->ID);

            // Build link
            if (isset($args->has_children) && $args->has_children && $depth === 0) {
                // Parent link with toggle - use button for accessibility
                $item_output  = '<button @click="open = !open" type="button" class="' . esc_attr($atts['class']) . '" ';
                $item_output .= ':aria-expanded="open" ';
                $item_output .= 'aria-haspopup="true" ';
                $item_output .= 'aria-controls="' . esc_attr($submenu_id) . '">';
                $item_output .= esc_html($title);
                $item_output .= '<svg class="w-4 h-4 ml-1 text-gray-500 transition-transform duration-200" :class="{\'rotate-180\': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>';
                $item_output .= '</button>';
            } else {
                // Regular link
                $item_output  = '<a' . $attributes . '>';
                $item_output .= esc_html($title);
                $item_output .= '</a>';
            }

            $output .= $item_output;
        }

        /**
         * End menu item
         */
        public function end_el(&$output, $item, $depth = 0, $args = array())
        {
            $output .= "</li>\n";
        }

        /**
         * Display element + children
         */
        public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
        {
            if (!$element) {
                return;
            }
            $id_field = $this->db_fields['id'];
            if (is_object($args[0])) {
                $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            }
            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

        /**
         * Fallback (when no menu is assigned)
         */
        public static function fallback($args)
        {
            if (current_user_can('edit_theme_options')) {
                echo '<ul><li><a href="' . esc_url(admin_url('nav-menus.php')) . '">' . esc_html__('Add a menu', 'tailwind') . '</a></li></ul>';
            }
        }
    }
}

<?php
/**
 * wp_starter functions and definitions
 *
 * @package wp_starter
 */

/**
 * Setup
 */
require get_template_directory() . '/system/setup.php';

/**
 * Style and Script enqueues
 */
require get_template_directory() . '/system/enqueues.php';

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/system/template-tags.php';

/**
 * Optional assorted functions
 */
require get_template_directory() . '/system/optional-functions.php';

/**
 * Load custom WordPress nav walker
 */
// check if ACF plugin is installed and active first
if ( class_exists('ACF') ) {
    if ( have_rows( 'miscellaneous_options', 'option' ) ) { 
        while( have_rows( 'miscellaneous_options', 'option' ) ) { the_row(); 
            if ( get_sub_field( 'menu_type' ) === 'click' ) {
                require get_template_directory() . '/system/classes/bootstrap-wp-navwalker.php';            
            } else {
                require get_template_directory() . '/system/classes/bootstrap-wp-navwalker-hover.php';          
            }
        }
    } else {
        require get_template_directory() . '/system/classes/bootstrap-wp-navwalker-hover.php'; 
    }
} else {
    require get_template_directory() . '/system/classes/bootstrap-wp-navwalker-hover.php';
}

/**
 * Optional Gravity Forms modifications
 */
require get_template_directory() . '/system/gravity-forms.php';

/**
 * Page Modifications.
 */
require get_template_directory() . '/system/cpts/pages.php'; // Page Modifications.

<?php

/**
 * Setup Options page with ACF
 */
if ( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Site Info',
        'menu_title'    => 'Site Info',
        'menu_slug'     => 'site-info',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}


/** Gravity Forms Enqueue Script
* This is used when forms need to pass parameters or log clicks for Analytic purposes
* Needed because we usually manually embed a form outside the WordPress loop using the function/shortcode call
* Also forces the stylesheets and scripts to load in the header
* The is_page parameter needs to match the page id you are using this check on (ususally the Contact page)
* The number parameter in gravity_form_enqueue_scripts function the needs to match the form id you are targeting
* You will need to duplicate for multiple page/form checks
*/
function tgs_gf_enqueue_script( $page_id, $form_id ) {
    if ( class_exists( 'GFCommon' ) && is_page( $page_id ) ) {
        gravity_form_enqueue_scripts( $form_id, true );      
    }
} 


/**
 * Add meta title support
 */
function wp_starter_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'wp_starter_theme_slug_setup' );


/**
 * Customize WP login screen
 */
function wp_starter_custom_login() {
	echo '<link rel="stylesheet" type="text/css" href="' . esc_url( get_stylesheet_directory_uri() ) . '/includes/css/custom-login-styles.css" />';
}
add_action('login_head', 'wp_starter_custom_login');
function wp_starter_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'wp_starter_login_logo_url' );

function wp_starter_login_logo_url_title() {
	return get_bloginfo('name');
}
add_filter( 'login_headertext', 'wp_starter_login_logo_url_title' );


/**
* Add pagination
* Call in your theme with <?php wp_starter_pagination(); ?>
*/
if ( ! function_exists( 'wp_starter_pagination' ) ) {
	function wp_starter_pagination() {
		global $wp_query;  // this needs to match your query variable in your template when setting up output
                    	// $query is preferred as it doesn't interfere with the global $wp_query object

		$big = 999999999; // need an unlikely integer

        echo paginate_links( 
            array(
                'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'    => '?paged=%#%',
                'current'   => max( 1, get_query_var('paged') ),
                'total'     => $wp_query->max_num_pages,
                'prev_text' => __('&lsaquo; Previous', 'wp_starter'),
                'next_text' => __('Next &rsaquo;', 'wp_starter'),
            ) 
        );
	}
}


/**
* Add page slug to body class
*/
function tgs_add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'tgs_add_slug_body_class' );


/**
* Add custom class to images added from media library
*/
function wp_starters_image_tag_class($class) {
    $class .= ' img-fluid';
    return $class;
}
add_filter('get_image_tag_class', 'wp_starters_image_tag_class' );


/**
* Add class to <li> of 'footer' menu
*/
function wp_starters_menu_classes($classes, $item, $args) {
  if($args->theme_location == 'footer') {
    $classes[] = 'list-inline-item';
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'wp_starters_menu_classes', 1, 3);


/**
* Does page exist
*/
function tgs_page_exists($page_slug) {
     $page = get_page_by_path( $page_slug , OBJECT );
     if ( isset($page) )
        return true;
     else
        return false;
}


/**
* Ability to upload SVGs from admin
* Restrict to ADMIN ROLE ONLY
*/
if( current_user_can('administrator') ) {  
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');
} 


/**
 * Remove comments in its entirety.
 */
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect( admin_url() );
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('wp_before_admin_bar_render', function() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});


/**
 * Check if Website is visible to Search Engines
 */
function wp_starters_check_visibility() {
    if ( ! class_exists( 'WPSEO_Admin' ) ) {
        if ( '0' === get_option( 'blog_public' ) ) {
            add_action( 'admin_footer', 'wp_starters_private_wp_warning' );
        }
    }
}
add_action( 'admin_init', 'wp_starters_check_visibility' );

/**
 * If website is Private, show alert
 */
function wp_starters_private_wp_warning() {
    if ( ( function_exists( 'is_network_admin' ) && is_network_admin() ) ) {
        return;
    }

    echo '<div id="robotsmessage" class="error">';
    echo '<p><strong>' . __( 'Warning: This site is blocking access to robots.', 'wp_starter' ) . '</strong> ' . sprintf( esc_html( 'You must %sgo to your Reading Settings%s and uncheck the box for Search Engine Visibility.', 'wp_starter' ), '<a href="' . esc_url( admin_url( 'options-reading.php' ) ) . '">', '</a>' ) . '</p></div>';
}


add_filter('img_caption_shortcode', 'wp_starters_img_caption_shortcode_filter',10,3);


/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 * Removes inline width which breaks responsiveness
 * @return text HTML content describing embedded figure
 **/
function wp_starters_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'      => '',
        'align'   => '',
        'width'   => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $val;

    $capid = '';
    if ( $id ) {
        $id    = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
        $id    = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
    . do_shortcode( $content ) . '<figcaption ' . $capid 
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

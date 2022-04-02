<?php
/**
 * Style and Script Enques
 *
 * @package wp_starter
 */

/**
 * Enqueue styles
    $handle is simply the name of the stylesheet.
	$src is where it is located. The rest of the parameters are optional.
	$deps refers to whether or not this stylesheet is dependent on another stylesheet. If this is set, this stylesheet will not be loaded unless its dependent stylesheet is loaded first.
	$ver sets the version number.
	$media can specify which type of media to load this stylesheet in, such as 'all', 'screen', 'print' or 'handheld.'
 */
function wp_starter_styles() {

	// load wp_starter styles
	wp_enqueue_style( 'wp_starter-style', get_stylesheet_uri() );

	// load theme styles, compiled from SASS, with file modification time as the version
	wp_enqueue_style( 'wp_starter-theme-style', get_template_directory_uri() . '/includes/css/styles.min.css', false, filemtime( get_stylesheet_directory() . '/includes/css/styles.min.css' ) );

}
add_action( 'wp_enqueue_scripts', 'wp_starter_styles' );


/**
 * Enqueue scripts
 */
function wp_starter_scripts() {

	// load FontAwesome JS
	// default kit here, but you can add a new one with different settings if needed:  https://fontawesome.com/kits
	// just be sure to update the alpha-numeric JS string in the enqueue below
	wp_enqueue_script( 'tgs_font-awesome', 'https://kit.fontawesome.com/801c7551ff.js', array(), null, false );

	// load popper js before all vendor scripts (has to come before bootstrap JS)
	wp_enqueue_script( 'tgs_popper', get_template_directory_uri().'/includes/js/popper.min.js', array( 'jquery' ), null, true  );
	
	// load vendor js
	wp_enqueue_script( 'wp_starter-vendor', get_template_directory_uri().'/includes/js/vendors.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/includes/js/vendors.min.js' ), true  );	

	// load custom js
	wp_enqueue_script( 'wp_starter-custom', get_template_directory_uri().'/includes/js/custom.min.js', array( 'jquery', 'wp_starter-vendor'), filemtime( get_stylesheet_directory() . '/includes/js/custom.min.js' ), true );

}
add_action( 'wp_enqueue_scripts', 'wp_starter_scripts' );

/**
 * Move jQuery to the footer. 
 */
function wp_starter_enqueue_scripts() {
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}
add_action( 'wp_enqueue_scripts', 'wp_starter_enqueue_scripts' );

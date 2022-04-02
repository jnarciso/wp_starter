<?php
if ( ! function_exists( 'wp_starter_page_columns' ) ) {
/**
 * Edit the pages's columns.
 *
 * @param Array $columns Array of Columns.
 * @return Array $columns Array of Columns.
 */	
add_filter( 'manage_edit-page_columns', 'wp_starter_page_columns' );
function wp_starter_page_columns( $columns ) {
	$add_date = false;
	if( isset( $columns['date'] ) ) {
		$add_date = true;
		unset( $columns['date'] );
	}
	$columns['current-template'] = 'Current Template';
	$columns['featured-image']		= 'Featured Image';
	if( true === $add_date ){
		$columns['date'] = __( 'Date', 'wp_starter' );
	}
    return $columns;
}
}

/**
 * Register the pages's column as sortable.
 *
 * @param Array $columns Array of Columns.
 * @return Array $columns Array of Columns.
 */
add_filter( 'manage_edit-page_sortable_columns', 'wp_starter_page_column_register_sortable' ); 
function wp_starter_page_column_register_sortable( $columns ) {
	return $columns;
}

/**
 * Display Column Data For Pages.
 * @param String $column_name Column Key.
 * @param Int $id Current Page ID.
 */
add_action( 'manage_pages_custom_column', 'wp_starter_manage_page_columns', 10, 2 );
function wp_starter_manage_page_columns( $column_name, $id ) {
	global $wpdb;
	switch ($column_name) {
	case 'id':
		esc_html_e( $id );
			break;
	case 'featured-image':
		if ( has_post_thumbnail( $id ) ) {
			$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
			if ( ! empty( $full_image_url[0] ) ) {
				printf( '<a href="%1$s" alt="%2$s" target="_blank" rel="noopener noreferrer">%3$s</a>',
					esc_url( $full_image_url[0] ),
					esc_attr( the_title_attribute( array( 'post' => get_post( get_post_thumbnail_id( $id ) ) , 'echo' => 0 ) ) ),
					get_the_post_thumbnail( $id, array( 50, 50, 'bfi_thumb' => true, 'grayscale' => false ) )
				);
			}
		} else {
			_e( "Not Set", 'wp_starter');
		}
		break;
	case 'current-template':
		esc_html_e( get_post_meta( $id, '_wp_page_template', true ) );
			break;
	}
}

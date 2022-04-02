<?php
/**
 * The template for displaying search forms in wp_starter
 *
 * @package wp_starter
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url() ); ?>">
    <div class="input-group">
		<label>Search</label>
		<input type="search" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'wp_starter' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'wp_starter' ); ?>">
		<span class="input-group-btn">
			<input type="submit" class="search-submit button" value="<?php echo esc_attr_x( 'Search', 'submit button', 'wp_starter' ); ?>">
		</span>
    </div>
</form>

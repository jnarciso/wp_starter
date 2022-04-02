<?php
/**
 * The template for displaying the Contact page.
 *
 * @package wp_starter
 */
// check if ACF plugin is installed and active first
if ( class_exists('ACF') ) {
	// get values from our ACF Options/Site Info Page
	if ( have_rows( 'contact_information', 'option' ) ) {
		while ( have_rows( 'contact_information', 'option' ) ) { the_row();		

			if ( get_sub_field( 'primary_phone_number' ) ) {
				$primary_phone = get_sub_field( 'primary_phone_number' );
				$flat_main_phone = '+1' . preg_replace('/[^a-zA-Z0-9]/', '', $primary_phone);
			}

			if ( get_sub_field( 'email_address' ) ) {
				$email_address = get_sub_field( 'email_address' );
			}

			if ( get_sub_field( 'address' ) ) {
				$address = get_sub_field( 'address' );
			}

			if ( get_sub_field( 'google_map_url' ) ) {
				$google_map_url = get_sub_field( 'google_map_url' );
			}

			if ( get_sub_field( 'hours_of_operation' ) ) {
				$hours_of_operation = get_sub_field( 'hours_of_operation' );
			}						

    	}
	}
}

get_header(); ?>

	<div class="main-content" role="main">
	
		<div class="container">
			<div class="row">
				<div class="main-content-inner col-12">

					<div class="row">
						<div class="col-lg-6">
							<?php if ( !empty( $address ) ) { ?>
							<address>
								<h5>Corporate Location</h5>
								<?php echo wp_kses_post( $address ); ?>
							</address>
							<?php } ?>

							<?php if ( !empty ( $flat_main_phone ) ) { ?>
								<p>Phone:  <a href="tel:<?php esc_html_e( $flat_main_phone ); ?>"><?php esc_html_e( $primary_phone ); ?></a></p>
							<?php } ?>
							
							<?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="false"]' ); ?>
						</div>
						<?php if ( ! empty( $google_map_url ) ) { ?>
						<div class="col-lg-6">
							<div class="embed-responsive embed-responsive-1by1">
								<iframe class="embed-responsive-item" src="<?php echo esc_url( $google_map_url ); ?>" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
							</div>
						</div>
						<?php } ?>						
					</div>

				</div>
			</div>
		</div>

	</div>

<?php get_footer();

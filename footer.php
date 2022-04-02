<?php
/**
 * The template for displaying the footer.
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
				$flat_main_phone = '+1' . preg_replace('/[^0-9]/', '', $primary_phone);
			}

			if ( get_sub_field( 'email_address' ) ) {
				$email_address = get_sub_field( 'email_address' );
			}

			if ( get_sub_field( 'address' ) ) {
				$address = get_sub_field( 'address' );
			}

			if ( have_rows( 'social_media_links', 'option' ) ) {
				while ( have_rows( 'social_media_links', 'option' ) ) { the_row();

					if ( get_sub_field( 'facebook_url' ) ) {
						$facebook_url = get_sub_field( 'facebook_url' );
					}

					if ( get_sub_field( 'twitter_url' ) ) {
						$twitter_url = get_sub_field( 'twitter_url' );
					}

					if ( get_sub_field( 'instagram_url' ) ) {
						$instagram_url = get_sub_field( 'instagram_url' );
					}

					if ( get_sub_field( 'linkedin_url' ) ) {
						$linkedin_url = get_sub_field( 'linkedin_url' );
					}

					if ( get_sub_field( 'youtube_url' ) ) {
						$youtube_url = get_sub_field( 'youtube_url' );
					}																				

				}
			}

    	}
	}
}
?>

	<footer class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<p class="copyright">Copyright &copy; <?php esc_html_e( current_time('Y') ); ?> <?php esc_html_e( get_bloginfo( 'name', 'display' ) ); ?>.</p>		
				</div>
				<div class="col-6">
					<p class="tg-mark text-right">Website by <a href="<?php echo esc_url( __('https://www.tayloegray.com', 'wp_starter')); ?>" target="_blank"><img src="<?php echo esc_url( get_template_directory_uri() . '/includes/images/logo-tg-footer-dark.svg' ); ?>" alt="TG Icon Logo" /></a></p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<?php if ( ! empty( $facebook_url ) ) { ?><a href="<?php echo esc_url( $facebook_url ); ?>" title="<?php esc_html_e( get_bloginfo('name') ); ?> on Facebook" target="_blank"><i class="fab fa-facebook-square"></i></a><?php } ?>	
					<?php if ( ! empty( $twitter_url ) ) { ?><a href="<?php echo esc_url( $twitter_url ); ?>" title="<?php esc_html_e( get_bloginfo('name') ); ?> on Twitter" target="_blank"><i class="fab fa-twitter-square"></i></a><?php } ?>									
					<?php if ( ! empty( $instagram_url ) ) { ?><a href="<?php echo esc_url( $instagram_url ); ?>" title="<?php esc_html_e( get_bloginfo('name') ); ?> on Instagram" target="_blank"><i class="fab fa-instagram-square"></i></a><?php } ?>			
					<?php if ( ! empty( $linkedin_url ) ) { ?><a href="<?php echo esc_url( $linkedin_url ); ?>" title="<?php esc_html_e( get_bloginfo('name') ); ?> on LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a><?php } ?>					
					<?php if ( ! empty( $youtube_url ) ) { ?><a href="<?php echo esc_url( $youtube_url ); ?>" title="<?php esc_html_e( get_bloginfo('name') ); ?> on YouTube" target="_blank"><i class="fab fa-youtube-square"></i></a><?php } ?>					
				</div>				
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>
</body>
</html>

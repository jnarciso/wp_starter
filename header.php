<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and <header> section
 *
 * @package wp_starter
 */
// check if ACF plugin is installed and active first
if ( class_exists('ACF') ) {
	// get values from our ACF Options/Site Info Page
	if ( have_rows('miscellaneous_options', 'option') ) {
		while ( have_rows('miscellaneous_options', 'option') ) { the_row();		

			if ( get_sub_field( 'menu_type' ) === 'click' ) {
				$dropdown_type = 'click';
			} else {
				$dropdown_type = 'hover';
			}

			if ( get_sub_field( 'google_tag_manager_id' ) ) {
				$gtm_container_id = get_sub_field('google_tag_manager_id');
			}

			if ( get_sub_field( 'facebook_pixel' ) ) {
				$fb_pixel = get_sub_field('facebook_pixel');
			}

			if ( get_sub_field( 'show_site_notification' ) ) {
				$show_site_notification = get_sub_field('show_site_notification');
			}

			if ( get_sub_field( 'site_notification' ) ) {
				$site_notification = get_sub_field('site_notification');
			}			

    	}
	} 
} else if ( ! class_exists('ACF') ) {
	$dropdown_type = 'hover';
}
?>	

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php /* If Site Icon isn't set in customizer */ ?>
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>

	<?php /* Package Generated from: https://realfavicongenerator.net */ ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/apple-touch-icon.png' ); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/favicon-32x32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/favicon-16x16.png' ); ?>">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/site.webmanifest' ); ?>">
	<link rel="mask-icon" href="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/safari-pinned-tab.svg' ); ?>" color="#f36f4f">
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/favicon.ico' ); ?>">
	<meta name="msapplication-TileColor" content="#000000">
	<meta name="msapplication-config" content="<?php echo esc_url( get_template_directory_uri() . '/includes/images/device-icons/browserconfig.xml' ); ?>">
	<meta name="theme-color" content="#ffffff">

<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php 
		/** Gravity Forms Enqueue Script
		* The first parameter needs to match the page id you are using this check on (usually the Contact page)
		* The second parameter needs to match the form id you are targeting
		* You will need to duplicate for multiple page/form checks
		* Function lives in /system/optional-functions.php for further info
		*/
		//tgs_gf_enqueue_script( $page_id, $form_id )  
	?>

	<?php wp_head(); ?>
	<?php if ( ! empty( $gtm_container_id ) ) { ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php esc_html_e( $gtm_container_id ); ?>');</script>
	<!-- End Google Tag Manager -->
	<?php } ?>

	<?php if ( ! empty( $fb_pixel ) ) { ?>
		<!-- Facebook Pixel -->
		<?php echo $fb_pixel; ?>
		<!-- End Facebook Pixel -->
	<?php } ?>	
</head>

<body <?php body_class(); ?>>
	<?php if ( ! empty( $gtm_container_id ) ) { ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="<?php echo esc_url( 'https://www.googletagmanager.com/ns.html?id=' . $gtm_container_id); ?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php } ?>	
	<?php do_action( 'before' ); ?>

	<?php 
	/* For Component Examples --- if ( ! page_exists('sample-page') ) { ?>
	<div class="example-page-disclaimer">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p>Please create a page called "Sample Page" to see layout examples.</p>
				</div>
			</div>
		</div>
	</div>
	<?php } */ 
	?>

	<?php if ( ! empty( $show_site_notification ) && $show_site_notification === 'yes' ) { ?>
	<div class="site-notification alert alert-warning alert-dismissible fade show d-none" role="alert">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
	  				<?php 
	  					// wp_kses_post escapes content but allows for same html markup which are used in posts
	  					// so you can use <a> or <br> in your notification field and they will be preserved, not output
	  					echo wp_kses_post( $site_notification ); 
	  				?>
	  			</div>
	  		</div>
	  	</div>
		<button type="button" class="close site-note-close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php } ?>

	<header class="site-header" role="banner">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="navbar navbar-expand-lg justify-content-between navbar-light <?php echo $dropdown_type; ?>" role="navigation">

						<a class="site-logo navbar-brand" href="/" title="<?php esc_html_e( get_bloginfo( 'name', 'display' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/includes/images/client-logo.svg' ); ?>" alt="<?php esc_html_e( get_bloginfo( 'name', 'display' ) ); ?>" /></a>

						<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" title="Menu">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</button>

						<?php 
							wp_nav_menu(
								array(
									'theme_location'  => 'primary',
									'depth'           => 3,
									'container'       => 'div',
									'container_class' => 'collapse navbar-collapse',
									'container_id'    => 'navbarSupportedContent',
									'menu_class'      => 'navbar-nav ml-auto',
									'menu_id'         => 'main-menu',									
									'fallback_cb'     => 'bs4Navwalker::fallback',
									'walker'          => new bs4Navwalker(),
								)
								); 
							?>

					</nav>	
				</div>
			</div>
		</div>	
	</header>

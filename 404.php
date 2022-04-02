<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package wp_starter
 */

get_header(); ?>

	<div class="main-content" role="main">

		<div class="container">
			<div class="row">
				<div class="main-content-inner col-md-10 offset-md-1">
					<section>
						<header>
							<h2 class="page-title"><?php esc_html_e( 'Oops! Something went wrong here.', 'wp_starter' ); ?></h2>
						</header>

						<div class="page-content">
							<p><?php esc_html_e( 'Nothing could be found at this location. Maybe try a search?', 'wp_starter' ); ?></p>
							<?php get_template_part( 'elements/searchform' ); ?>
						</div>
					</section>
				</div>
			</div>
		</div>

	</div>

<?php 
	get_footer();

<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package wp_starter
 */

get_header(); ?>


	<div class="main-content" role="main">

		<div class="container">
			<div class="row">
				<div class="main-content-inner col-md-8">

					<div class="content-padder">

						<?php if ( have_posts() ) { ?>

							<header>
								<h1 class="page-title">
									<?php
										if ( is_category() ) {
											single_cat_title();

										} elseif ( is_tag() ) {
											single_tag_title();

										} elseif ( is_author() ) {
											/* Queue the first post, that way we know
											 * what author we're dealing with (if that is the case).
											*/
											the_post();
											printf( esc_html( 'Author: %s', 'wp_starter' ), '<span class="vcard">' . get_the_author() . '</span>' );
											/* Since we called the_post() above, we need to
											 * rewind the loop back to the beginning that way
											 * we can run the loop properly, in full.
											 */
											rewind_posts();

										} elseif ( is_day() ) {
											printf( esc_html( 'Day: %s', 'wp_starter' ), '<span>' . get_the_date() . '</span>' );

										} elseif ( is_month() ) {
											printf( esc_html( 'Month: %s', 'wp_starter' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

										} elseif ( is_year() ) {
											printf( esc_html( 'Year: %s', 'wp_starter' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

										} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
											esc_html_e( 'Asides', 'wp_starter' );

										} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
											esc_html_e( 'Images', 'wp_starter');

										} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
											esc_html_e( 'Videos', 'wp_starter' );

										} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
											esc_html_e( 'Quotes', 'wp_starter' );
											
										} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
											esc_html_e( 'Links', 'wp_starter' );
											
										} else {
											esc_html_e( 'Archives', 'wp_starter' );
										}
									?>
								</h1>
								<?php
									// Show an optional term description.
									$term_description = term_description();
									if ( ! empty( $term_description ) ) {
										printf( esc_html('<div class="taxonomy-description">%s</div>', $term_description) );
									}
								?>
							</header><!-- .page-header -->

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

							<?php endwhile; ?>

							<?php wp_starter_content_nav( 'nav-below' ); ?>

						<?php } else { ?>

							<?php get_template_part( 'content/no-results', '' ); ?>

						<?php } ?>

					</div><!-- .content-padder -->

				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>

	</div>

<?php 
	get_footer();

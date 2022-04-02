<?php
/**
 * @package wp_starter
 */

get_header(); ?>

	<div class="main-content">

		<div class="container">
			<div class="row">
				<div class="main-content-inner col-md-8">

					<header>
						<h1><?php esc_html_e( apply_filters( 'the_title', get_page( get_option('page_for_posts') )->post_title) ); ?></h1>
					</header>

					<?php if ( have_posts() ) { ?>

						<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header>
								<h1><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

								<?php if ( 'post' === get_post_type() ) { ?>
								<div class="entry-meta">
									<?php wp_starter_posted_on(); ?>
								</div>
								<?php } ?>
							</header>

							<?php if ( is_search() || is_archive() ) { // Only display Excerpts for Search and Archive Pages ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div>
							<?php } else { ?>
							<div class="entry-content">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="entry-content-thumbnail">
								<?php the_post_thumbnail( 'full', array('class' => 'img-fluid') ); ?>
								</div>
							<?php endif; ?>									
								<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp_starter' ) ); ?>
								<?php
									wp_link_pages( 
										array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'wp_starter' ),
											'after'  => '</div>',
										)
									);
								?>
							</div>
							<?php } ?>

							<footer class="entry-meta">
								<?php if ( 'post' === get_post_type() ) { // Hide category and tag text for pages on Search ?>
									<?php
										/* translators: used between list items, there is a space after the comma */
										$categories_list = get_the_category_list( __( ', ', 'wp_starter' ) );
										if ( $categories_list && wp_starter_categorized_blog() ) {
									?>
									<span class="cat-links">
										<?php printf( esc_html( 'Posted in %1$s', 'wp_starter', $categories_list ) ); ?>
									</span>
									<?php } // End if categories ?>

									<?php
										/* translators: used between list items, there is a space after the comma */
										$tags_list = get_the_tag_list( '', __( ', ', 'wp_starter' ) );
										if ( $tags_list ) {
									?>
									<span class="tags-links">
										<?php printf( esc_html( 'Tagged %1$s', 'wp_starter', $tags_list ) ); ?>
									</span>
									<?php } // End if $tags_list ?>
								<?php } // End if 'post' === get_post_type() ?>

								<?php if ( ! post_password_required() && ( comments_open() || '0' !== get_comments_number() ) ) { ?>
								<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'wp_starter' ), __( '1 Comment', 'wp_starter' ), __( '% Comments', 'wp_starter' ) ); ?></span>
								<?php } ?>

								<?php edit_post_link( __( 'Edit', 'wp_starter' ), '<span class="edit-link">', '</span>' ); ?>
							</footer>
						</article>

						<?php endwhile; ?>

				        <?php wp_starter_pagination(); ?>

					<?php } else { ?>

						<?php get_template_part( 'content/no-results', '' ); ?>

					<?php } ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>

	</div>

<?php 
	get_footer();

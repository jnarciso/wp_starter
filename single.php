<?php
/**
 * The Template for displaying all single posts.
 *
 * @package wp_starter
 */

get_header(); ?>

	<div class="main-content" role="main">

		<div class="container">
			<div class="row">
				<div class="main-content-inner col-md-8">

					<?php 
						while ( have_posts() ) : the_post(); 
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<h1 class="page-title"><?php the_title(); ?></h1>

							<div class="entry-meta">
								<?php wp_starter_posted_on(); ?>
							</div>
						</header>

						<div class="entry-content">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="entry-content-thumbnail">
							<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
							</div>
						<?php endif; ?>	
							<?php the_content(); ?>
							<?php
								wp_link_pages( 
									array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'wp_starter' ),
										'after'  => '</div>',
									) 
								);
							?>
						</div>

						<footer class="entry-meta">
							<?php
								/* translators: used between list items, there is a space after the comma */
								$category_list = get_the_category_list( __( ', ', 'wp_starter' ) );

								/* translators: used between list items, there is a space after the comma */
								$tag_list = get_the_tag_list( '', __( ', ', 'wp_starter' ) );

								if ( ! wp_starter_categorized_blog() ) {
									// This blog only has 1 category so we just need to worry about tags in the meta text
									if ( '' !== $tag_list ) {
										$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp_starter' );
									} else {
										$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp_starter' );
									}

								} else {
									// But this blog has loads of categories so we should probably display them here
									if ( '' !== $tag_list ) {
										$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp_starter' );
									} else {
										$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'wp_starter' );
									}

								} // end check for categories on this blog

								printf(
									wp_kses_post( $meta_text ),
									wp_kses_post( $category_list ),
									wp_kses_post( $tag_list ),
									esc_url( get_permalink() ),
									the_title_attribute( 'echo=0' )
								);
							?>

						</footer>
						<?php edit_post_link( __( 'Edit', 'wp_starter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
					</article>

						<?php wp_starter_content_nav( 'nav-below' ); ?>

						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' !== get_comments_number() ) {
								comments_template();
							}
						?>

					<?php endwhile; ?>

				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>

	</div>

<?php 
	get_footer();

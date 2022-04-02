<?php
/**
 * The template for displaying the home/front page.
 *
 * @package wp_starter
 */

get_header(); ?>

	<?php get_template_part('sections/slider'); ?>

	<div class="main-content" role="main">

		<div class="container">
			<div class="row">
				<div class="col-md-8">

					<?php if ( have_posts() ) { ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

								<div class="entry-content">
									<?php
										global $post;     // if outside the loop
										if ( is_page() && $post->post_parent ) { ?>
	    									<h2><?php the_title(); ?></h2>
									<?php } 
										the_content();
									?>
									<?php
										wp_link_pages( array(
											'before' => '<div class="page-links">' . __( 'Pages:', 'wp_starter' ),
											'after'  => '</div>',
										) );
									?>
								</div>
								<?php edit_post_link( __( 'Edit', 'wp_starter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
							</article>

						<?php endwhile; // end of the loop. ?>

				        <?php wp_starter_pagination(); ?>

					<?php } else { ?>

						<?php get_template_part( 'content/no-results', 'index' ); ?>

					<?php } ?>
				</div>
			</div>
		</div>

	</div>

<?php get_footer();

<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
								<h1><?php the_title(); ?></h1>
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
							<?php edit_post_link( __( 'Edit', 'wp_starter' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
						</article>

					<?php endwhile; // end of the loop. ?>

				</div>
				<?php 
					get_sidebar(); 
				?>
			</div>
		</div>

	</div>

<?php 
	get_footer();

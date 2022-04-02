<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package wp_starter
 */

get_header(); ?>

	<div class="main-content" role="main">

		<div class="container">
			<div class="row">
				<div class="col-md-8">
				<?php 
					if ( have_posts() ) { 
						while ( have_posts() ) : the_post(); ?>
							<article class="search-result">
								<header>
									<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
								</header>
							</article>
					<?php endwhile; ?>
					<?php wp_starter_content_nav( 'nav-below' ); ?>

				<?php } else { ?>

						<?php get_template_part( 'content/no-results', '' ); ?>

				<?php } ?>
				</div>

				<div class="sidebar col-md-4">
				    <div class="sidebar-padder">
						<?php get_template_part( 'elements/searchform' ); ?>
				    </div>
				</div>

			</div>
		</div>

	</div>

<?php 
	get_footer();

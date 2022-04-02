<?php
/**
 * Template Name: CPT Query Template
 */

get_header(); ?>

	<div class="main-content" role="main">
	
		<div class="container">
			<div class="row">
				<div class="main-content-inner col-md-10 offset-md-1">

                        <?php 
                        	// when using pagination, the query variable has to be
                        	// what is defined in the wp_starter_pagination function
                        	// in the optional-functions.php file
							$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        	$wp_query = new WP_Query( array(
								'post_type'      => 'test',
								'order'          => 'ASC',
								'orderby'        => 'menu_order',
								'post_status'    => 'publish',
								'posts_per_page' => 2,
                            	'paged'	         => $paged,
                        ));
                        // The Loop
                        if ( $wp_query->have_posts() ) { 
                            while ( $wp_query->have_posts() ) {
                            	$wp_query->the_post(); 
                            ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<header>
									<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
									<div class="entry-meta">
										<?php wp_starter_posted_on(); ?>
									</div>
								</header>
							</article>
                            <?php } ?>    

							<?php wp_starter_pagination(); ?>

                        <?php } ?>

						<?php wp_reset_postdata(); ?>

				</div>
			</div>
		</div>

	</div>		

<?php 
	get_footer();

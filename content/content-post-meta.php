<?php
/**
 * @package wp_starter
 */
?>

<div class="post-meta">
	<ul class="pull-right social-list">
		<li><a href="http://www.facebook.com/share.php?u=<?php esc_url( the_permalink() ); ?>&title=<?php esc_html( the_title() ); ?>" target="_blank" rel="noopener noreferrer" class="facebook">Share on Facebook</a></li>
		<li><a href="http://twitter.com/intent/tweet?status=<?php esc_html( the_title() ); ?>+<?php esc_url( the_permalink() ); ?>" target="_blank" rel="noopener noreferrer" class="twitter">Share on Twitter</a></li>
		<li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php esc_url( the_permalink() ); ?>&title=<?php esc_html( the_title() ); ?>&source=<?php echo esc_url( get_site_url() ); ?>" target="_blank" rel="noopener noreferrer" class="linkedin">Share on LinkedIn</a></li>
	</ul>			
	<p>Date: <strong><?php esc_html( the_time('m.d.Y') ); ?></strong> <span class="post-meta-divider">|</span> Posted by: <strong><?php the_author(); ?></strong></p>
</div>

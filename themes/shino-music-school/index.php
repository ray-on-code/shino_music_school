<?php
/**
 * @package shino-music-school
 */

get_header();
?>
<main class="site-main">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-content"><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'コンテンツがまだありません。', 'shino-music-school' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();

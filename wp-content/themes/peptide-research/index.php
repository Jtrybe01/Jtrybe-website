<?php
/**
 * Fallback template for blog/archive content.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="container archive" data-reveal>
	<?php if ( have_posts() ) : ?>
		<div class="archive__grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'archive-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="archive-card__media" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
					<?php endif; ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div class="archive-card__excerpt"><?php the_excerpt(); ?></div>
				</article>
				<?php
			endwhile;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found.', 'peptide-research' ); ?></p>
	<?php endif; ?>
</section>

<?php
get_footer();

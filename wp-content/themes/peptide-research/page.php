<?php
/**
 * Generic page template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<section class="container page-content" data-reveal>
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<h1><?php the_title(); ?></h1>
		<div class="page-content__body"><?php the_content(); ?></div>
		<?php
	endwhile;
	?>
</section>

<?php
get_footer();

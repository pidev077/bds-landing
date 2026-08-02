<?php
/**
 * Default classic template — blog listing / fallback for anything
 * page.php and page-landing-du-an.php don't handle.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="site-main">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry-summary"><?php the_excerpt(); ?></div>
			</article>
			<?php
		endwhile;

		the_posts_pagination();
	else :
		?>
		<p><?php esc_html_e( 'Không có nội dung.', 'bds-landing' ); ?></p>
		<?php
	endif;
	?>
</main>

<?php
get_footer();

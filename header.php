<?php
/**
 * Classic header used by index.php/page.php (regular posts/pages).
 * The landing template (page-landing-du-an.php) builds its own full HTML
 * document and does not use this file.
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="site-header__inner">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-header__logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => false,
			)
		);

		$header_cta_label = get_theme_mod( 'bds_header_cta_label' );
		if ( $header_cta_label ) :
			?>
			<a class="site-header__cta" href="<?php echo esc_url( get_theme_mod( 'bds_header_cta_url', '#' ) ); ?>">
				<?php echo esc_html( $header_cta_label ); ?>
			</a>
		<?php endif; ?>
	</div>
</header>

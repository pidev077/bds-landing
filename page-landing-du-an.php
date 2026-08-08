<?php
/**
 * Template Name: Landing Dự Án
 *
 * Full custom one-page landing template for a real-estate project. Bypasses
 * the site's normal header/footer template parts on purpose — this page is
 * meant to stand alone (it can be set as the site's static homepage).
 *
 * All section content comes from the "Landing Dự Án" ACF field group
 * (see inc/acf-fields.php). The only touchpoint with bds-manager is a
 * read-only property count lookup via bds_landing_get_project_property_count().
 */

defined( 'ABSPATH' ) || exit;

$hero_eyebrow      = get_field( 'hero_eyebrow' );
$hero_heading      = get_field( 'hero_heading' );
$hero_highlight    = get_field( 'hero_heading_highlight' );
$hero_description  = get_field( 'hero_description' );
$hero_image        = get_field( 'hero_image' );
$hero_cta_label    = get_field( 'hero_cta_label' );
$hero_cta_url      = get_field( 'hero_cta_url' );
$hero_scroll_label = get_field( 'hero_scroll_label' );
$header_cta_label  = get_field( 'header_cta_label' );
$header_cta_url    = get_field( 'header_cta_url' );

$stats_eyebrow        = get_field( 'stats_eyebrow' );
$stats_heading        = get_field( 'stats_heading' );
$linked_project_name  = get_field( 'linked_project_name' );
$auto_stat_index      = get_field( 'auto_stat_index' );
$stats                = array(
	1 => get_field( 'stat_1' ),
	2 => get_field( 'stat_2' ),
	3 => get_field( 'stat_3' ),
);

if ( $auto_stat_index && $linked_project_name && isset( $stats[ (int) $auto_stat_index ] ) ) {
	$live_count = bds_landing_get_project_property_count( $linked_project_name );
	if ( null !== $live_count ) {
		$stats[ (int) $auto_stat_index ]['value'] = number_format_i18n( $live_count );
		$stats[ (int) $auto_stat_index ]['unit']  = '';
	}
}

$features = array(
	get_field( 'feature_1' ),
	get_field( 'feature_2' ),
	get_field( 'feature_3' ),
	get_field( 'feature_4' ),
);

$ecosystem_eyebrow = get_field( 'ecosystem_eyebrow' );
$ecosystem_heading = get_field( 'ecosystem_heading' );
$ecosystem_slides  = array(
	get_field( 'ecosystem_slide_1' ),
	get_field( 'ecosystem_slide_2' ),
	get_field( 'ecosystem_slide_3' ),
	get_field( 'ecosystem_slide_4' ),
);

$masterplan_eyebrow    = get_field( 'masterplan_eyebrow' );
$masterplan_heading    = get_field( 'masterplan_heading' );
$masterplan_map_image  = get_field( 'masterplan_map_image' );
$masterplan_btn_label  = get_field( 'masterplan_map_button_label' );
$masterplan_btn_url    = get_field( 'masterplan_map_button_url' );
$masterplan_zones      = array(
	get_field( 'masterplan_zone_1' ),
	get_field( 'masterplan_zone_2' ),
	get_field( 'masterplan_zone_3' ),
	get_field( 'masterplan_zone_4' ),
);

$cta_eyebrow           = get_field( 'cta_eyebrow' );
$cta_heading           = get_field( 'cta_heading' );
$cta_heading_highlight = get_field( 'cta_heading_highlight' );
$cta_primary_label     = get_field( 'cta_primary_label' );
$cta_primary_url       = get_field( 'cta_primary_url' );
$cta_secondary_label   = get_field( 'cta_secondary_label' );
$cta_secondary_url     = get_field( 'cta_secondary_url' );
$cta_footnote          = get_field( 'cta_footnote' );

// Contact/CTA fields fall back to the site-wide Customizer settings
// (Appearance > Customize) so staff only need to fill these in on the
// project's landing page when they actually differ from head office.
$footer_address  = get_field( 'footer_address' ) ?: get_theme_mod( 'bds_address' );
$footer_phone    = get_field( 'footer_phone' ) ?: get_theme_mod( 'bds_phone' );
$footer_email    = get_field( 'footer_email' ) ?: get_theme_mod( 'bds_email' );
$footer_tagline  = get_field( 'footer_tagline' ) ?: ( get_theme_mod( 'bds_footer_tagline' ) ?: get_bloginfo( 'description' ) );

if ( ! $header_cta_label ) {
	$header_cta_label = get_theme_mod( 'bds_header_cta_label' );
	$header_cta_url   = get_theme_mod( 'bds_header_cta_url' );
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bds-landing' ); ?>>
<?php wp_body_open(); ?>

<nav class="bds-nav">
	<div class="bds-nav__inner">
		<?php if ( has_custom_logo() ) : ?>
			<div class="bds-nav__logo"><?php the_custom_logo(); ?></div>
		<?php else : ?>
			<a class="bds-nav__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'bds-nav__links',
					'fallback_cb'    => false,
				)
			);
			?>
		<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>
			<p class="bds-nav__links-hint">
				<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
					<?php esc_html_e( 'Chưa có menu — chọn Appearance > Menus để tạo & gán vào vị trí "Menu chính".', 'bds-landing' ); ?>
				</a>
			</p>
		<?php endif; ?>
		<div class="bds-nav__right">
			<?php if ( $header_cta_label ) : ?>
				<a class="bds-btn bds-btn--dark bds-nav__cta" href="<?php echo esc_url( $header_cta_url ? $header_cta_url : '#cta' ); ?>">
					<?php echo esc_html( $header_cta_label ); ?>
				</a>
			<?php endif; ?>
			<button class="bds-nav__toggle" type="button" aria-label="Mở menu" aria-expanded="false">
				<span></span><span></span><span></span>
			</button>
		</div>
	</div>
</nav>

<header id="hero" class="bds-hero"<?php echo $hero_image ? ' style="background-image:url(' . esc_url( $hero_image ) . ')"' : ''; ?>>
	<div class="bds-hero__overlay"></div>
	<div class="bds-hero__content">
		<?php if ( $hero_eyebrow ) : ?>
			<p class="bds-eyebrow bds-eyebrow--light"><?php echo esc_html( $hero_eyebrow ); ?></p>
		<?php endif; ?>
		<h1 class="bds-hero__heading">
			<?php if ( $hero_heading ) : ?><span><?php echo esc_html( $hero_heading ); ?></span><?php endif; ?>
			<?php if ( $hero_highlight ) : ?><em><?php echo esc_html( $hero_highlight ); ?></em><?php endif; ?>
		</h1>
		<?php if ( $hero_description ) : ?>
			<p class="bds-hero__description"><?php echo esc_html( $hero_description ); ?></p>
		<?php endif; ?>
		<?php if ( $hero_cta_label ) : ?>
			<a class="bds-btn bds-btn--gold" href="<?php echo esc_url( $hero_cta_url ? $hero_cta_url : '#masterplan' ); ?>">
				<?php echo esc_html( $hero_cta_label ); ?>
			</a>
		<?php endif; ?>
	</div>
	<?php if ( $hero_scroll_label ) : ?>
		<a class="bds-hero__scroll" href="#numbers">
			<?php echo esc_html( $hero_scroll_label ); ?>
			<span class="bds-hero__scroll-line"></span>
		</a>
	<?php endif; ?>
</header>

<section id="numbers" class="bds-stats">
	<div class="bds-container">
		<div class="bds-stats__grid">
			<div class="bds-stats__intro">
				<?php if ( $stats_eyebrow ) : ?><p class="bds-eyebrow"><?php echo esc_html( $stats_eyebrow ); ?></p><?php endif; ?>
				<?php if ( $stats_heading ) : ?><h2 class="bds-heading"><?php echo esc_html( $stats_heading ); ?></h2><?php endif; ?>
			</div>
			<div class="bds-stats__cards">
				<?php foreach ( $stats as $stat ) : ?>
					<?php if ( empty( $stat['value'] ) ) { continue; } ?>
					<div class="bds-stat-card">
						<p class="bds-stat-card__value">
							<?php echo esc_html( $stat['value'] ); ?><sup><?php echo esc_html( $stat['unit'] ); ?></sup>
						</p>
						<?php if ( ! empty( $stat['sublabel'] ) ) : ?>
							<p class="bds-stat-card__sublabel"><?php echo esc_html( $stat['sublabel'] ); ?></p>
						<?php endif; ?>
						<?php if ( ! empty( $stat['label'] ) ) : ?>
							<p class="bds-stat-card__label"><?php echo esc_html( $stat['label'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

		<div id="features" class="bds-features">
			<?php foreach ( $features as $feature ) : ?>
				<?php if ( empty( $feature['title'] ) ) { continue; } ?>
				<div class="bds-feature">
					<?php if ( ! empty( $feature['icon']['value'] ) ) : ?>
						<?php if ( 'dashicons' === $feature['icon']['type'] ) : ?>
							<span class="bds-feature__icon dashicons <?php echo esc_attr( $feature['icon']['value'] ); ?>"></span>
						<?php elseif ( 'media_library' === $feature['icon']['type'] ) : ?>
							<img class="bds-feature__icon bds-feature__icon--img" src="<?php echo esc_url( $feature['icon']['value']['url'] ?? '' ); ?>" alt="">
						<?php else : ?>
							<img class="bds-feature__icon bds-feature__icon--img" src="<?php echo esc_url( $feature['icon']['value'] ); ?>" alt="">
						<?php endif; ?>
					<?php endif; ?>
					<p class="bds-feature__title"><?php echo esc_html( $feature['title'] ); ?></p>
					<?php if ( ! empty( $feature['description'] ) ) : ?>
						<p class="bds-feature__description"><?php echo esc_html( $feature['description'] ); ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section id="ecosystem" class="bds-ecosystem">
	<div class="bds-container">
		<div class="bds-ecosystem__header">
			<div>
				<?php if ( $ecosystem_eyebrow ) : ?><p class="bds-eyebrow"><?php echo esc_html( $ecosystem_eyebrow ); ?></p><?php endif; ?>
				<?php if ( $ecosystem_heading ) : ?><h2 class="bds-heading"><?php echo esc_html( $ecosystem_heading ); ?></h2><?php endif; ?>
			</div>
			<div class="bds-ecosystem__nav">
				<button type="button" class="bds-carousel-btn" data-carousel-prev aria-label="Ảnh trước">←</button>
				<button type="button" class="bds-carousel-btn" data-carousel-next aria-label="Ảnh sau">→</button>
			</div>
		</div>
		<div class="bds-carousel" data-carousel>
			<div class="bds-carousel__track" data-carousel-track>
				<?php foreach ( $ecosystem_slides as $slide ) : ?>
					<?php if ( empty( $slide['image'] ) ) { continue; } ?>
					<figure class="bds-carousel__slide">
						<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="<?php echo esc_attr( $slide['caption'] ?? '' ); ?>" loading="lazy">
						<figcaption>
							<?php if ( ! empty( $slide['eyebrow'] ) ) : ?>
								<span class="bds-eyebrow bds-eyebrow--light"><?php echo esc_html( $slide['eyebrow'] ); ?></span>
							<?php endif; ?>
							<?php if ( ! empty( $slide['caption'] ) ) : ?>
								<span class="bds-carousel__caption"><?php echo esc_html( $slide['caption'] ); ?></span>
							<?php endif; ?>
						</figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<section id="masterplan" class="bds-masterplan">
	<div class="bds-container bds-masterplan__grid">
		<div class="bds-masterplan__info">
			<?php if ( $masterplan_eyebrow ) : ?><p class="bds-eyebrow"><?php echo esc_html( $masterplan_eyebrow ); ?></p><?php endif; ?>
			<?php if ( $masterplan_heading ) : ?><h2 class="bds-heading"><?php echo esc_html( $masterplan_heading ); ?></h2><?php endif; ?>
			<ol class="bds-zones">
				<?php foreach ( $masterplan_zones as $zone ) : ?>
					<?php if ( empty( $zone['name'] ) ) { continue; } ?>
					<li class="bds-zone">
						<span class="bds-zone__index"><?php echo esc_html( $zone['index_label'] ); ?></span>
						<div>
							<p class="bds-zone__name"><?php echo esc_html( $zone['name'] ); ?></p>
							<?php if ( ! empty( $zone['area'] ) ) : ?>
								<p class="bds-zone__area">Diện tích: <?php echo esc_html( $zone['area'] ); ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $zone['description'] ) ) : ?>
								<p class="bds-zone__description"><?php echo esc_html( $zone['description'] ); ?></p>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
		<div class="bds-masterplan__map">
			<?php if ( $masterplan_map_image ) : ?>
				<img src="<?php echo esc_url( $masterplan_map_image ); ?>" alt="<?php echo esc_attr( $masterplan_heading ?? 'Masterplan' ); ?>">
			<?php endif; ?>
			<?php if ( $masterplan_btn_label ) : ?>
				<a class="bds-btn bds-btn--dark bds-masterplan__btn" href="<?php echo esc_url( $masterplan_btn_url ? $masterplan_btn_url : '#' ); ?>">
					<?php echo esc_html( $masterplan_btn_label ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>

<section id="cta" class="bds-cta">
	<div class="bds-container bds-cta__inner">
		<?php if ( $cta_eyebrow ) : ?><p class="bds-eyebrow bds-eyebrow--light"><?php echo esc_html( $cta_eyebrow ); ?></p><?php endif; ?>
		<h2 class="bds-cta__heading">
			<?php if ( $cta_heading ) : ?><?php echo esc_html( $cta_heading ); ?><br><?php endif; ?>
			<?php if ( $cta_heading_highlight ) : ?><em><?php echo esc_html( $cta_heading_highlight ); ?></em><?php endif; ?>
		</h2>
		<div class="bds-cta__buttons">
			<?php if ( $cta_primary_label ) : ?>
				<a class="bds-btn bds-btn--gold" href="<?php echo esc_url( $cta_primary_url ? $cta_primary_url : '#' ); ?>"><?php echo esc_html( $cta_primary_label ); ?></a>
			<?php endif; ?>
			<?php if ( $cta_secondary_label ) : ?>
				<a class="bds-btn bds-btn--outline-light" href="<?php echo esc_url( $cta_secondary_url ? $cta_secondary_url : '#' ); ?>"><?php echo esc_html( $cta_secondary_label ); ?></a>
			<?php endif; ?>
		</div>
		<?php if ( $cta_footnote ) : ?>
			<p class="bds-cta__footnote"><?php echo esc_html( $cta_footnote ); ?></p>
		<?php endif; ?>
	</div>

	<div class="bds-container bds-footer">
		<div class="bds-footer__brand">
			<?php if ( has_custom_logo() ) : ?>
				<div class="bds-footer__logo"><?php the_custom_logo(); ?></div>
			<?php endif; ?>
			<p class="bds-footer__name"><?php bloginfo( 'name' ); ?></p>
			<?php if ( $footer_tagline ) : ?><p class="bds-footer__desc"><?php echo esc_html( $footer_tagline ); ?></p><?php endif; ?>
		</div>

		<?php
		$footer_menu_columns = array(
			'footer_du_an'    => __( 'Dự án', 'bds-landing' ),
			'footer_tien_ich' => __( 'Tiện ích', 'bds-landing' ),
		);
		foreach ( $footer_menu_columns as $location => $label ) :
			if ( has_nav_menu( $location ) ) :
				?>
				<div class="bds-footer__col">
					<p class="bds-footer__col-title"><?php echo esc_html( $label ); ?></p>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => $location,
							'container'      => false,
							'menu_class'     => 'bds-footer__menu-list',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>
				</div>
				<?php
			elseif ( current_user_can( 'edit_theme_options' ) ) :
				?>
				<p class="bds-footer__hint">
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
						<?php
						printf(
							/* translators: %s: menu location label, e.g. "Dự án" */
							esc_html__( 'Chưa có menu cột "%s" — tạo menu rồi gán vào vị trí tương ứng.', 'bds-landing' ),
							esc_html( $label )
						);
						?>
					</a>
				</p>
				<?php
			endif;
		endforeach;
		?>

		<?php if ( $footer_address || $footer_phone || $footer_email ) : ?>
			<div class="bds-footer__contact">
				<p class="bds-footer__col-title">Liên hệ</p>
				<?php if ( $footer_address ) : ?><p><?php echo esc_html( $footer_address ); ?></p><?php endif; ?>
				<?php if ( $footer_phone ) : ?><p><a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>"><?php echo esc_html( $footer_phone ); ?></a></p><?php endif; ?>
				<?php if ( $footer_email ) : ?><p><a href="<?php echo esc_url( 'mailto:' . $footer_email ); ?>"><?php echo esc_html( $footer_email ); ?></a></p><?php endif; ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="bds-container bds-footer__bottom">
		<p class="bds-footer__copyright">
			<?php
			$footer_copyright = get_theme_mod( 'bds_footer_copyright' );
			echo esc_html( $footer_copyright ? $footer_copyright : '© ' . gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All rights reserved.' );
			?>
		</p>
		<?php if ( has_nav_menu( 'footer_legal' ) ) : ?>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer_legal',
					'container'      => false,
					'menu_class'     => 'bds-footer__legal',
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
			?>
		<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>
			<p class="bds-footer__hint">
				<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
					<?php esc_html_e( 'Chưa có menu pháp lý — gán vào vị trí "Footer - Pháp lý".', 'bds-landing' ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</section>

<?php wp_footer(); ?>
</body>
</html>

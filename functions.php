<?php
/**
 * BDS Landing theme bootstrap.
 */

defined( 'ABSPATH' ) || exit;

define( 'BDS_LANDING_VERSION', '1.0.0' );
define( 'BDS_LANDING_DIR', get_template_directory() );
define( 'BDS_LANDING_URI', get_template_directory_uri() );

/**
 * Theme setup.
 */
function bds_landing_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );

	register_nav_menus(
		array(
			'primary'         => __( 'Menu chính', 'bds-landing' ),
			'footer_du_an'    => __( 'Footer - Cột Dự án', 'bds-landing' ),
			'footer_tien_ich' => __( 'Footer - Cột Tiện ích', 'bds-landing' ),
			'footer_legal'    => __( 'Footer - Pháp lý', 'bds-landing' ),
		)
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
}
add_action( 'after_setup_theme', 'bds_landing_setup' );

/**
 * Site-wide styles/fonts (all pages).
 */
function bds_landing_enqueue_assets(): void {
	wp_enqueue_style( 'bds-landing-style', get_stylesheet_uri(), array(), BDS_LANDING_VERSION );

	wp_enqueue_style(
		'bds-landing-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_script( 'bds-landing-site', BDS_LANDING_URI . '/assets/js/site.js', array(), BDS_LANDING_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'bds_landing_enqueue_assets' );

/**
 * Landing-page-only assets. Kept separate from the site-wide stylesheet so
 * regular pages/posts never pay for this page's CSS/JS.
 */
function bds_landing_enqueue_page_assets(): void {
	if ( is_page_template( 'page-landing-du-an.php' ) ) {
		wp_enqueue_style( 'bds-landing-page', BDS_LANDING_URI . '/assets/css/landing.css', array( 'bds-landing-style' ), BDS_LANDING_VERSION );
		wp_enqueue_script( 'bds-landing-page', BDS_LANDING_URI . '/assets/js/landing.js', array(), BDS_LANDING_VERSION, true );
	}

	if ( is_page_template( 'page-danh-sach-du-an.php' ) ) {
		wp_enqueue_style( 'bds-du-an-list', BDS_LANDING_URI . '/assets/css/du-an-list.css', array( 'bds-landing-style' ), BDS_LANDING_VERSION );
		wp_enqueue_script( 'bds-du-an-list', BDS_LANDING_URI . '/assets/js/du-an-list.js', array(), BDS_LANDING_VERSION, true );
	}
}
add_action( 'wp_enqueue_scripts', 'bds_landing_enqueue_page_assets' );

/**
 * Live, read-only lookup of a bds-manager project's property count.
 *
 * This is the ONLY place this theme touches bds-manager data, and it is a
 * read-only SELECT against tables bds-manager already owns — no schema
 * changes, no new REST routes, nothing added to that plugin.
 */
function bds_landing_get_project_property_count( string $project_name ): ?int {
	global $wpdb;

	if ( '' === trim( $project_name ) ) {
		return null;
	}

	$properties_table = $wpdb->prefix . 'bds_properties';
	if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $properties_table ) ) !== $properties_table ) {
		return null; // bds-manager not installed/active — fail quietly.
	}

	$count = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(*) FROM {$properties_table} WHERE project_name = %s",
			$project_name
		)
	);

	return null === $count ? null : (int) $count;
}

/**
 * Admin notice if ACF is missing — this theme's landing template depends on it.
 */
function bds_landing_admin_notice_missing_acf(): void {
	if ( function_exists( 'get_field' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p>';
	esc_html_e( 'Theme "BDS Landing" cần plugin Advanced Custom Fields để nhập nội dung trang landing. Vui lòng cài đặt và kích hoạt ACF.', 'bds-landing' );
	echo '</p></div>';
}
add_action( 'admin_notices', 'bds_landing_admin_notice_missing_acf' );

/**
 * Site-wide floating contact button (phone / Zalo / Messenger).
 * Hooked to wp_footer so it shows on every page, including the landing
 * template, which bypasses footer.php entirely.
 */
function bds_landing_render_floating_contact(): void {
	if ( ! get_theme_mod( 'bds_floating_contact_enable', true ) ) {
		return;
	}

	$phone     = get_theme_mod( 'bds_phone' );
	$zalo      = get_theme_mod( 'bds_social_zalo' );
	$messenger = get_theme_mod( 'bds_messenger_url' );

	if ( ! $phone && ! $zalo && ! $messenger ) {
		return;
	}
	?>
	<div class="bds-floating-contact">
		<div class="bds-floating-contact__panel">
			<?php if ( $messenger ) : ?>
				<a class="bds-floating-contact__item bds-floating-contact__item--messenger" href="<?php echo esc_url( $messenger ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Messenger">
					<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.14 2 11.25c0 2.9 1.45 5.49 3.72 7.19V22l3.4-1.87c.91.25 1.87.38 2.88.38 5.52 0 10-4.14 10-9.26S17.52 2 12 2Zm1.02 12.47-2.55-2.72-4.98 2.72 5.48-5.82 2.61 2.72 4.9-2.72-5.46 5.82Z"/></svg>
				</a>
			<?php endif; ?>
			<?php if ( $zalo ) : ?>
				<a class="bds-floating-contact__item bds-floating-contact__item--zalo" href="<?php echo esc_url( $zalo ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Zalo">
					<span>Zalo</span>
				</a>
			<?php endif; ?>
			<?php if ( $phone ) : ?>
				<a class="bds-floating-contact__item bds-floating-contact__item--phone" href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" aria-label="Gọi điện">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4.5 4h3.2l1.5 4.2-2 1.6a11.2 11.2 0 0 0 5 5l1.6-2 4.2 1.5v3.2c0 1-.8 1.8-1.8 1.7A16.5 16.5 0 0 1 3 5.8C2.9 4.8 3.7 4 4.5 4Z"/></svg>
				</a>
			<?php endif; ?>
		</div>
		<button type="button" class="bds-floating-contact__toggle" aria-label="Liên hệ nhanh" aria-expanded="false">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5Z"/></svg>
		</button>
	</div>
	<?php
}
add_action( 'wp_footer', 'bds_landing_render_floating_contact' );

require BDS_LANDING_DIR . '/inc/acf-fields.php';
require BDS_LANDING_DIR . '/inc/customizer.php';

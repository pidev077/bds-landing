<?php
/**
 * Classic footer used by index.php/page.php (regular posts/pages).
 *
 * Mirrors the 4-column footer built into page-landing-du-an.php (brand,
 * "Dự án"/"Tiện ích" columns, contact column, bottom bar) so regular pages
 * look consistent with project landing pages. "Dự án" and "Tiện ích" are
 * separate flat menu locations (footer_du_an/footer_tien_ich) with a
 * hardcoded column title each — no parent/child nesting for staff to get
 * wrong, unlike a single menu split by hierarchy.
 */

defined( 'ABSPATH' ) || exit;

$phone     = get_theme_mod( 'bds_phone' );
$email     = get_theme_mod( 'bds_email' );
$address   = get_theme_mod( 'bds_address' );
$copyright = get_theme_mod( 'bds_footer_copyright' );
$tagline   = get_theme_mod( 'bds_footer_tagline' ) ?: get_bloginfo( 'description' ) ?: __( 'Đơn vị phát triển bất động sản uy tín, mang đến những dự án chất lượng, pháp lý minh bạch và dịch vụ tận tâm.', 'bds-landing' );
?>
	<footer class="site-footer">
		<div class="bds-container site-footer__main">
			<div class="site-footer__brand">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-footer__logo"><?php the_custom_logo(); ?></div>
				<?php endif; ?>
				<p class="site-footer__name"><?php bloginfo( 'name' ); ?></p>
				<?php if ( $tagline ) : ?>
					<p class="site-footer__desc"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
			</div>

			<?php
			$footer_menu_columns = array(
				'footer_du_an'    => __( 'Dự án', 'bds-landing' ),
				'footer_tien_ich' => __( 'Tiện ích', 'bds-landing' ),
			);
			foreach ( $footer_menu_columns as $location => $label ) :
				if ( has_nav_menu( $location ) ) :
					?>
					<div class="site-footer__col">
						<p class="site-footer__col-title"><?php echo esc_html( $label ); ?></p>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => $location,
								'container'      => false,
								'menu_class'     => 'site-footer__menu-list',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</div>
					<?php
				elseif ( current_user_can( 'edit_theme_options' ) ) :
					?>
					<p class="site-footer__hint">
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

			<?php if ( $address || $phone || $email ) : ?>
				<div class="site-footer__contact">
					<p class="site-footer__col-title"><?php esc_html_e( 'Liên hệ', 'bds-landing' ); ?></p>
					<?php if ( $address ) : ?>
						<p class="site-footer__contact-item">
							<span class="site-footer__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 22s7-7.05 7-12a7 7 0 1 0-14 0c0 4.95 7 12 7 12Z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
							<span><?php echo esc_html( $address ); ?></span>
						</p>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<p class="site-footer__contact-item">
							<span class="site-footer__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4.5 4h3.2l1.5 4.2-2 1.6a11.2 11.2 0 0 0 5 5l1.6-2 4.2 1.5v3.2c0 1-.8 1.8-1.8 1.7A16.5 16.5 0 0 1 3 5.8C2.9 4.8 3.7 4 4.5 4Z"/></svg></span>
							<span><?php echo esc_html( $phone ); ?></span>
						</p>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<p class="site-footer__contact-item">
							<span class="site-footer__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="5.5" width="18" height="13" rx="1.5"/><path d="m3.5 6 8.5 7 8.5-7"/></svg></span>
							<span><?php echo esc_html( $email ); ?></span>
						</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="bds-container site-footer__bottom">
			<p class="site-footer__copyright">
				<?php
				if ( $copyright ) {
					echo esc_html( $copyright );
				} else {
					echo esc_html( '© ' . gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '. All rights reserved.' );
				}
				?>
			</p>
			<?php if ( has_nav_menu( 'footer_legal' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer_legal',
						'container'      => false,
						'menu_class'     => 'site-footer__legal',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>
				<p class="site-footer__hint">
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
						<?php esc_html_e( 'Chưa có menu pháp lý — gán vào vị trí "Footer - Pháp lý".', 'bds-landing' ); ?>
					</a>
				</p>
			<?php endif; ?>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>

<?php
/**
 * Classic footer used by index.php/page.php (regular posts/pages).
 */

defined( 'ABSPATH' ) || exit;

$phone     = get_theme_mod( 'bds_phone' );
$email     = get_theme_mod( 'bds_email' );
$address   = get_theme_mod( 'bds_address' );
$copyright = get_theme_mod( 'bds_footer_copyright' );
$socials   = array(
	'facebook' => get_theme_mod( 'bds_social_facebook' ),
	'zalo'     => get_theme_mod( 'bds_social_zalo' ),
	'youtube'  => get_theme_mod( 'bds_social_youtube' ),
);
?>
	<footer class="site-footer">
		<?php if ( $phone || $email || $address ) : ?>
			<p class="site-footer__contact">
				<?php echo esc_html( implode( ' · ', array_filter( array( $address, $phone, $email ) ) ) ); ?>
			</p>
		<?php endif; ?>

		<?php if ( array_filter( $socials ) ) : ?>
			<p class="site-footer__social">
				<?php foreach ( $socials as $network => $url ) : ?>
					<?php if ( $url ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( ucfirst( $network ) ); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
			</p>
		<?php endif; ?>

		<p class="site-footer__copyright">
			<?php
			if ( $copyright ) {
				echo esc_html( $copyright );
			} else {
				echo esc_html( '© ' . gmdate( 'Y' ) . ' ' . get_bloginfo( 'name' ) );
			}
			?>
		</p>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>

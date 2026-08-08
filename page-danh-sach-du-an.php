<?php
/**
 * Template Name: Danh sách dự án
 *
 * Public listing of every project marked "Hiển thị công khai" in bds-manager's
 * "Quản lý dự án" screen (wp-admin). Uses the site's normal header/footer
 * (unlike page-landing-du-an.php, which is a standalone one-page microsite).
 *
 * All data — which projects to show, description, images, video, số căn —
 * comes straight from bds-manager via BDS_API_Projects::get_public_projects().
 * That method already filters to is_published = 1 and shapes the fields; this
 * template only renders. Same read-only, fail-quietly spirit as
 * bds_landing_get_project_property_count() in functions.php: if bds-manager
 * isn't active, the page just renders an empty state instead of erroring.
 */

defined( 'ABSPATH' ) || exit;

$bds_projects = class_exists( 'BDS_API_Projects' ) ? BDS_API_Projects::get_public_projects() : array();

get_header();
?>

<main class="site-main bds-du-an-list">
	<div class="bds-du-an-list__header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php if ( get_the_content() ) : ?>
			<div class="bds-du-an-list__intro"><?php the_content(); ?></div>
		<?php endif; ?>
	</div>

	<?php if ( empty( $bds_projects ) ) : ?>
		<p class="bds-du-an-list__empty">
			<?php esc_html_e( 'Hiện chưa có dự án nào được đăng công khai.', 'bds-landing' ); ?>
		</p>
	<?php else : ?>
		<div class="bds-du-an-grid">
			<?php foreach ( $bds_projects as $project ) : ?>
				<?php
				$cover        = $project['images'][0] ?? '';
				$description  = $project['web_description'] ?? '';
				$gallery_json = wp_json_encode( $project['images'] );
				?>
				<article
					class="bds-du-an-card"
					data-du-an-card
					data-name="<?php echo esc_attr( $project['name'] ); ?>"
					data-description="<?php echo esc_attr( $description ); ?>"
					data-video="<?php echo esc_attr( $project['video_url'] ?? '' ); ?>"
					data-images="<?php echo esc_attr( $gallery_json ); ?>"
				>
					<div class="bds-du-an-card__image">
						<?php if ( $cover ) : ?>
							<img src="<?php echo esc_url( $cover ); ?>" alt="<?php echo esc_attr( $project['name'] ); ?>" loading="lazy">
						<?php else : ?>
							<div class="bds-du-an-card__placeholder" aria-hidden="true"></div>
						<?php endif; ?>
						<?php if ( ! empty( $project['property_count'] ) ) : ?>
							<span class="bds-du-an-card__badge"><?php echo esc_html( number_format_i18n( $project['property_count'] ) ); ?> sản phẩm</span>
						<?php endif; ?>
					</div>
					<div class="bds-du-an-card__body">
						<h2 class="bds-du-an-card__name"><?php echo esc_html( $project['name'] ); ?></h2>
						<?php if ( $description ) : ?>
							<p class="bds-du-an-card__desc"><?php echo esc_html( wp_trim_words( $description, 24 ) ); ?></p>
						<?php endif; ?>
						<button type="button" class="bds-btn bds-btn--dark bds-du-an-card__cta" data-du-an-open>
							<?php esc_html_e( 'Xem chi tiết', 'bds-landing' ); ?>
						</button>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</main>

<div class="bds-du-an-modal" data-du-an-modal aria-hidden="true">
	<div class="bds-du-an-modal__overlay" data-du-an-close></div>
	<div class="bds-du-an-modal__panel" role="dialog" aria-modal="true">
		<button type="button" class="bds-du-an-modal__close" data-du-an-close aria-label="<?php esc_attr_e( 'Đóng', 'bds-landing' ); ?>">&times;</button>
		<div class="bds-du-an-modal__gallery">
			<img data-du-an-modal-image src="" alt="">
			<button type="button" class="bds-du-an-modal__nav bds-du-an-modal__nav--prev" data-du-an-prev aria-label="<?php esc_attr_e( 'Ảnh trước', 'bds-landing' ); ?>">&larr;</button>
			<button type="button" class="bds-du-an-modal__nav bds-du-an-modal__nav--next" data-du-an-next aria-label="<?php esc_attr_e( 'Ảnh sau', 'bds-landing' ); ?>">&rarr;</button>
		</div>
		<div class="bds-du-an-modal__info">
			<h3 data-du-an-modal-name></h3>
			<p data-du-an-modal-desc></p>
			<a data-du-an-modal-video href="" target="_blank" rel="noopener noreferrer" class="bds-du-an-modal__video">
				<?php esc_html_e( 'Xem video', 'bds-landing' ); ?>
			</a>
		</div>
	</div>
</div>

<?php
get_footer();

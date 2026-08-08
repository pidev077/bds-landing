<?php
/**
 * ACF field group for the "Landing Dự Án" page template.
 *
 * Registered as code (acf_add_local_field_group) rather than through the ACF
 * admin UI so the field structure ships with the theme and works immediately
 * on any environment without a manual export/import step.
 *
 * ACF FREE only — no repeater/gallery/flexible-content field types are
 * available, so the fixed-count sections below (stats, features, ecosystem
 * slides, masterplan zones) use plain "group" fields instead of a repeater.
 * That matches the reference design anyway (3 stats, 4 features, 3 slides,
 * 4 zones) so nothing is actually lost for this template.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Builds one "stat card" group field (value + unit + label + sublabel).
 */
function bds_landing_field_stat( string $suffix, string $label, string $default_value = '', string $default_unit = '', string $default_label = '' ): array {
	return array(
		'key'          => "field_bdsl_stat_{$suffix}",
		'label'        => $label,
		'name'         => "stat_{$suffix}",
		'type'         => 'group',
		'layout'       => 'row',
		'sub_fields'   => array(
			array(
				'key'           => "field_bdsl_stat_{$suffix}_value",
				'label'         => 'Số liệu',
				'name'          => 'value',
				'type'          => 'text',
				'default_value' => $default_value,
				'wrapper'       => array( 'width' => '30' ),
			),
			array(
				'key'           => "field_bdsl_stat_{$suffix}_unit",
				'label'         => 'Đơn vị',
				'name'          => 'unit',
				'type'          => 'text',
				'default_value' => $default_unit,
				'wrapper'       => array( 'width' => '20' ),
			),
			array(
				'key'           => "field_bdsl_stat_{$suffix}_label",
				'label'         => 'Nhãn',
				'name'          => 'label',
				'type'          => 'text',
				'default_value' => $default_label,
				'wrapper'       => array( 'width' => '25' ),
			),
			array(
				'key'     => "field_bdsl_stat_{$suffix}_sublabel",
				'label'   => 'Chú thích nhỏ',
				'name'    => 'sublabel',
				'type'    => 'text',
				'wrapper' => array( 'width' => '25' ),
			),
		),
	);
}

/**
 * Builds one "feature item" group field (icon + title + description).
 */
function bds_landing_field_feature( string $suffix, string $label ): array {
	return array(
		'key'        => "field_bdsl_feature_{$suffix}",
		'label'      => $label,
		'name'       => "feature_{$suffix}",
		'type'       => 'group',
		'layout'     => 'row',
		'sub_fields' => array(
			array(
				'key'           => "field_bdsl_feature_{$suffix}_icon",
				'label'         => 'Icon',
				'name'          => 'icon',
				'type'          => 'icon_picker',
				'return_format' => 'array',
				'wrapper'       => array( 'width' => '20' ),
			),
			array(
				'key'     => "field_bdsl_feature_{$suffix}_title",
				'label'   => 'Tiêu đề',
				'name'    => 'title',
				'type'    => 'text',
				'wrapper' => array( 'width' => '30' ),
			),
			array(
				'key'     => "field_bdsl_feature_{$suffix}_description",
				'label'   => 'Mô tả',
				'name'    => 'description',
				'type'    => 'textarea',
				'rows'    => 2,
				'wrapper' => array( 'width' => '50' ),
			),
		),
	);
}

/**
 * Builds one "ecosystem slide" group field (image + eyebrow + caption).
 */
function bds_landing_field_ecosystem_slide( string $suffix, string $label ): array {
	return array(
		'key'        => "field_bdsl_ecosystem_{$suffix}",
		'label'      => $label,
		'name'       => "ecosystem_slide_{$suffix}",
		'type'       => 'group',
		'layout'     => 'row',
		'sub_fields' => array(
			array(
				'key'           => "field_bdsl_ecosystem_{$suffix}_image",
				'label'         => 'Ảnh',
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'url',
				'preview_size'  => 'medium',
				'wrapper'       => array( 'width' => '30' ),
			),
			array(
				'key'     => "field_bdsl_ecosystem_{$suffix}_eyebrow",
				'label'   => 'Nhãn nhỏ (eyebrow)',
				'name'    => 'eyebrow',
				'type'    => 'text',
				'wrapper' => array( 'width' => '30' ),
			),
			array(
				'key'     => "field_bdsl_ecosystem_{$suffix}_caption",
				'label'   => 'Caption',
				'name'    => 'caption',
				'type'    => 'text',
				'wrapper' => array( 'width' => '40' ),
			),
		),
	);
}

/**
 * Builds one "masterplan zone" group field (index + name + area + description).
 */
function bds_landing_field_masterplan_zone( string $suffix, string $label, string $default_index = '' ): array {
	return array(
		'key'        => "field_bdsl_zone_{$suffix}",
		'label'      => $label,
		'name'       => "masterplan_zone_{$suffix}",
		'type'       => 'group',
		'layout'     => 'row',
		'sub_fields' => array(
			array(
				'key'           => "field_bdsl_zone_{$suffix}_index",
				'label'         => 'Số thứ tự',
				'name'          => 'index_label',
				'type'          => 'text',
				'default_value' => $default_index,
				'wrapper'       => array( 'width' => '15' ),
			),
			array(
				'key'     => "field_bdsl_zone_{$suffix}_name",
				'label'   => 'Tên phân khu',
				'name'    => 'name',
				'type'    => 'text',
				'wrapper' => array( 'width' => '30' ),
			),
			array(
				'key'     => "field_bdsl_zone_{$suffix}_area",
				'label'   => 'Diện tích',
				'name'    => 'area',
				'type'    => 'text',
				'wrapper' => array( 'width' => '20' ),
			),
			array(
				'key'     => "field_bdsl_zone_{$suffix}_description",
				'label'   => 'Mô tả',
				'name'    => 'description',
				'type'    => 'textarea',
				'rows'    => 2,
				'wrapper' => array( 'width' => '35' ),
			),
		),
	);
}

function bds_landing_register_acf_fields(): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_bdsl_landing_du_an',
			'title'    => 'Landing Dự Án',
			'fields'   => array(
				// --- Tab: Hero -------------------------------------------------
				array(
					'key'   => 'field_bdsl_tab_hero',
					'label' => 'Hero',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_bdsl_hero_eyebrow',
					'label'         => 'Nhãn nhỏ trên tiêu đề',
					'name'          => 'hero_eyebrow',
					'type'          => 'text',
					'default_value' => 'THE FUTURE OF COASTAL LIVING',
				),
				array(
					'key'           => 'field_bdsl_hero_heading',
					'label'         => 'Tiêu đề chính',
					'name'          => 'hero_heading',
					'type'          => 'text',
					'default_value' => 'Tên Dự Án:',
				),
				array(
					'key'           => 'field_bdsl_hero_heading_highlight',
					'label'         => 'Tiêu đề nhấn mạnh (màu gold)',
					'name'          => 'hero_heading_highlight',
					'type'          => 'text',
					'default_value' => 'Slogan dự án',
				),
				array(
					'key'   => 'field_bdsl_hero_description',
					'label' => 'Mô tả ngắn',
					'name'  => 'hero_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'           => 'field_bdsl_hero_image',
					'label'         => 'Ảnh/nền hero',
					'name'          => 'hero_image',
					'type'          => 'image',
					'return_format' => 'url',
					'preview_size'  => 'large',
				),
				array(
					'key'           => 'field_bdsl_hero_cta_label',
					'label'         => 'Nhãn nút CTA',
					'name'          => 'hero_cta_label',
					'type'          => 'text',
					'default_value' => 'KHÁM PHÁ MASTERPLAN',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_hero_cta_url',
					'label'   => 'Link nút CTA',
					'name'    => 'hero_cta_url',
					'type'    => 'url',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_bdsl_hero_scroll_label',
					'label'         => 'Nhãn "Scroll to explore"',
					'name'          => 'hero_scroll_label',
					'type'          => 'text',
					'default_value' => 'SCROLL TO EXPLORE',
				),
				array(
					'key'           => 'field_bdsl_header_cta_label',
					'label'         => 'Nhãn nút góc trên (thanh nav)',
					'name'          => 'header_cta_label',
					'type'          => 'text',
					'default_value' => 'Private Client',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_header_cta_url',
					'label'   => 'Link nút góc trên',
					'name'    => 'header_cta_url',
					'type'    => 'url',
					'wrapper' => array( 'width' => '50' ),
				),

				// --- Tab: Số liệu ------------------------------------------------
				array(
					'key'   => 'field_bdsl_tab_stats',
					'label' => 'Số liệu',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_bdsl_stats_eyebrow',
					'label'         => 'Nhãn nhỏ',
					'name'          => 'stats_eyebrow',
					'type'          => 'text',
					'default_value' => 'THE NUMBERS',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_bdsl_stats_heading',
					'label'         => 'Tiêu đề section',
					'name'          => 'stats_heading',
					'type'          => 'text',
					'default_value' => 'Tầm Vóc Siêu Dự Án',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'         => 'field_bdsl_linked_project_name',
					'label'       => 'Tên dự án trong bds-manager (tùy chọn)',
					'name'        => 'linked_project_name',
					'type'        => 'text',
					'instructions' => 'Nhập đúng tên dự án như trong Kho sản phẩm của bds-manager để tự động lấy số sản phẩm thực tế thay cho số nhập tay bên dưới. Để trống nếu không cần.',
					'wrapper'     => array( 'width' => '60' ),
				),
				array(
					'key'           => 'field_bdsl_auto_stat_index',
					'label'         => 'Stat nào tự động cập nhật?',
					'name'          => 'auto_stat_index',
					'type'          => 'select',
					'choices'       => array(
						''  => '— Không tự động —',
						'1' => 'Stat 1',
						'2' => 'Stat 2',
						'3' => 'Stat 3',
					),
					'default_value' => '',
					'wrapper'       => array( 'width' => '40' ),
				),
				bds_landing_field_stat( '1', 'Stat 1', '2.870', 'ha', 'Tổng diện tích' ),
				bds_landing_field_stat( '2', 'Stat 2', '64', 'K', 'Tổng sản phẩm' ),
				bds_landing_field_stat( '3', 'Stat 3', '10', 'B+', 'Vốn đầu tư (USD)' ),

				// --- Tab: Tiện ích -----------------------------------------------
				array(
					'key'   => 'field_bdsl_tab_features',
					'label' => 'Tiện ích',
					'type'  => 'tab',
				),
				bds_landing_field_feature( '1', 'Tiện ích 1' ),
				bds_landing_field_feature( '2', 'Tiện ích 2' ),
				bds_landing_field_feature( '3', 'Tiện ích 3' ),
				bds_landing_field_feature( '4', 'Tiện ích 4' ),

				// --- Tab: Hệ sinh thái --------------------------------------------
				array(
					'key'   => 'field_bdsl_tab_ecosystem',
					'label' => 'Hệ sinh thái',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_bdsl_ecosystem_eyebrow',
					'label'         => 'Nhãn nhỏ',
					'name'          => 'ecosystem_eyebrow',
					'type'          => 'text',
					'default_value' => 'EXCLUSIVE LIFESTYLE',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_bdsl_ecosystem_heading',
					'label'         => 'Tiêu đề section',
					'name'          => 'ecosystem_heading',
					'type'          => 'text',
					'wrapper'       => array( 'width' => '50' ),
				),
				bds_landing_field_ecosystem_slide( '1', 'Ảnh 1' ),
				bds_landing_field_ecosystem_slide( '2', 'Ảnh 2' ),
				bds_landing_field_ecosystem_slide( '3', 'Ảnh 3' ),
				bds_landing_field_ecosystem_slide( '4', 'Ảnh 4' ),

				// --- Tab: Masterplan ----------------------------------------------
				array(
					'key'   => 'field_bdsl_tab_masterplan',
					'label' => 'Masterplan',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_bdsl_masterplan_eyebrow',
					'label'         => 'Nhãn nhỏ',
					'name'          => 'masterplan_eyebrow',
					'type'          => 'text',
					'default_value' => 'VISIONARY PLANNING',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_masterplan_heading',
					'label'   => 'Tiêu đề section',
					'name'    => 'masterplan_heading',
					'type'    => 'text',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_bdsl_masterplan_map_image',
					'label'         => 'Ảnh bản đồ masterplan',
					'name'          => 'masterplan_map_image',
					'type'          => 'image',
					'return_format' => 'url',
					'preview_size'  => 'large',
				),
				array(
					'key'           => 'field_bdsl_masterplan_map_button_label',
					'label'         => 'Nhãn nút bản đồ',
					'name'          => 'masterplan_map_button_label',
					'type'          => 'text',
					'default_value' => 'INTERACTIVE MAP EXPLORER',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_masterplan_map_button_url',
					'label'   => 'Link nút bản đồ',
					'name'    => 'masterplan_map_button_url',
					'type'    => 'url',
					'wrapper' => array( 'width' => '50' ),
				),
				bds_landing_field_masterplan_zone( '1', 'Phân khu 1', '01' ),
				bds_landing_field_masterplan_zone( '2', 'Phân khu 2', '02' ),
				bds_landing_field_masterplan_zone( '3', 'Phân khu 3', '03' ),
				bds_landing_field_masterplan_zone( '4', 'Phân khu 4', '04' ),

				// --- Tab: CTA cuối trang --------------------------------------------
				array(
					'key'   => 'field_bdsl_tab_cta',
					'label' => 'CTA cuối trang',
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_bdsl_cta_eyebrow',
					'label'         => 'Nhãn nhỏ',
					'name'          => 'cta_eyebrow',
					'type'          => 'text',
					'default_value' => 'LIMITED COLLECTION',
				),
				array(
					'key'   => 'field_bdsl_cta_heading',
					'label' => 'Tiêu đề',
					'name'  => 'cta_heading',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_bdsl_cta_heading_highlight',
					'label' => 'Tiêu đề nhấn mạnh (màu gold)',
					'name'  => 'cta_heading_highlight',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_bdsl_cta_primary_label',
					'label'         => 'Nhãn nút 1',
					'name'          => 'cta_primary_label',
					'type'          => 'text',
					'default_value' => 'NHẬN TÀI LIỆU DỰ ÁN',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_cta_primary_url',
					'label'   => 'Link nút 1',
					'name'    => 'cta_primary_url',
					'type'    => 'url',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_bdsl_cta_secondary_label',
					'label'         => 'Nhãn nút 2',
					'name'          => 'cta_secondary_label',
					'type'          => 'text',
					'default_value' => 'LIÊN HỆ CHUYÊN VIÊN',
					'wrapper'       => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_cta_secondary_url',
					'label'   => 'Link nút 2',
					'name'    => 'cta_secondary_url',
					'type'    => 'url',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'           => 'field_bdsl_cta_footnote',
					'label'         => 'Dòng chú thích nhỏ',
					'name'          => 'cta_footnote',
					'type'          => 'text',
					'default_value' => 'JOIN THE CIRCLE OF VISIONARY INVESTORS AND PIONEERS',
				),
				array(
					'key'   => 'field_bdsl_footer_address',
					'label' => 'Địa chỉ (footer)',
					'name'  => 'footer_address',
					'type'  => 'text',
				),
				array(
					'key'     => 'field_bdsl_footer_phone',
					'label'   => 'Điện thoại (footer)',
					'name'    => 'footer_phone',
					'type'    => 'text',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_bdsl_footer_email',
					'label'   => 'Email (footer)',
					'name'    => 'footer_email',
					'type'    => 'email',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'          => 'field_bdsl_footer_tagline',
					'label'        => 'Câu giới thiệu ngắn cạnh logo (footer)',
					'name'         => 'footer_tagline',
					'type'         => 'textarea',
					'rows'         => 2,
					'instructions' => 'Để trống sẽ dùng tagline chung của site (Customizer > Cài đặt chung).',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-landing-du-an.php',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'bds_landing_register_acf_fields' );

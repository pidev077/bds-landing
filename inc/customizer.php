<?php
/**
 * Site-wide header/footer settings via the WordPress Customizer.
 *
 * ACF (free edition, installed on this site) has no Options Page feature —
 * that is ACF PRO only. The Customizer is the built-in WordPress equivalent
 * for "settings that apply everywhere" (logo, contact info, social links),
 * so header.php/footer.php and the landing template read from here instead
 * of a per-page field.
 */

defined( 'ABSPATH' ) || exit;

function bds_landing_customize_register( WP_Customize_Manager $wp_customize ): void {
	// --- Thông tin liên hệ chung -------------------------------------------
	$wp_customize->add_section(
		'bds_contact',
		array(
			'title'    => __( 'Thông tin liên hệ chung', 'bds-landing' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting( 'bds_phone', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'bds_phone',
		array(
			'section' => 'bds_contact',
			'label'   => __( 'Số điện thoại', 'bds-landing' ),
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting( 'bds_email', array( 'default' => '', 'sanitize_callback' => 'sanitize_email' ) );
	$wp_customize->add_control(
		'bds_email',
		array(
			'section' => 'bds_contact',
			'label'   => __( 'Email', 'bds-landing' ),
			'type'    => 'email',
		)
	);

	$wp_customize->add_setting( 'bds_address', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'bds_address',
		array(
			'section' => 'bds_contact',
			'label'   => __( 'Địa chỉ', 'bds-landing' ),
			'type'    => 'text',
		)
	);

	// --- Header --------------------------------------------------------------
	$wp_customize->add_section(
		'bds_header',
		array(
			'title'    => __( 'Header', 'bds-landing' ),
			'priority' => 31,
		)
	);

	$wp_customize->add_setting( 'bds_header_cta_label', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'bds_header_cta_label',
		array(
			'section'     => 'bds_header',
			'label'       => __( 'Nhãn nút góc trên (mặc định)', 'bds-landing' ),
			'description' => __( 'Trang landing có thể ghi đè bằng field riêng của trang đó.', 'bds-landing' ),
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting( 'bds_header_cta_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		'bds_header_cta_url',
		array(
			'section' => 'bds_header',
			'label'   => __( 'Link nút góc trên (mặc định)', 'bds-landing' ),
			'type'    => 'url',
		)
	);

	// --- Footer --------------------------------------------------------------
	$wp_customize->add_section(
		'bds_footer',
		array(
			'title'    => __( 'Footer', 'bds-landing' ),
			'priority' => 32,
		)
	);

	$wp_customize->add_setting( 'bds_footer_copyright', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control(
		'bds_footer_copyright',
		array(
			'section'     => 'bds_footer',
			'label'       => __( 'Text bản quyền', 'bds-landing' ),
			'description' => __( 'Để trống sẽ dùng "© [năm] [tên site]".', 'bds-landing' ),
			'type'        => 'text',
		)
	);

	foreach (
		array(
			'bds_social_facebook' => __( 'Link Facebook', 'bds-landing' ),
			'bds_social_zalo'     => __( 'Link Zalo', 'bds-landing' ),
			'bds_social_youtube'  => __( 'Link Youtube', 'bds-landing' ),
		) as $setting_id => $label
	) {
		$wp_customize->add_setting( $setting_id, array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp_customize->add_control(
			$setting_id,
			array(
				'section' => 'bds_footer',
				'label'   => $label,
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'bds_landing_customize_register' );

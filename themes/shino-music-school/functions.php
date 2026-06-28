<?php
/**
 * Shino Music School theme functions.
 *
 * @package shino-music-school
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sms_theme_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );

	register_nav_menus(
		array(
			'primary' => __( 'プライマリメニュー', 'shino-music-school' ),
		)
	);
}
add_action( 'after_setup_theme', 'sms_theme_setup' );

function sms_enqueue_assets(): void {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Tailwind でビルドした本体スタイル（テーマ全体 + WPSBC カレンダー）。
	// プラグインの unlayered CSS と張り合うため、優先度 20 で他より後に出力する。
	wp_enqueue_style(
		'shino-music-school-app',
		get_theme_file_uri( 'assets/css/app.css' ),
		array(),
		$theme_version
	);

	// 曜日（日=赤 / 土=青）の色分け補助。
	wp_enqueue_script(
		'shino-music-school-wpsbc',
		get_theme_file_uri( 'assets/js/wpsbc-custom.js' ),
		array(),
		$theme_version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'sms_enqueue_assets', 20 );

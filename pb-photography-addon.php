<?php
/*
Plugin Name: Pootle Page Builder - Photography addon
Plugin URI:  http://pootlepress.com/
Description: Adds cool animation for row backgrounds in Pootle Page Builder
Author:      PooltePress
Version:     1.0
Author URI:  http://pootlepress.com/
Text Domain: ppbx-photo
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

Ppbx_Photography_Extension::instance();

final class Ppbx_Photography_Extension {

	private static $instance = null;

	private function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

		add_filter( 'siteorigin_panels_row_style_fields', array( $this, 'fields' ) );

		add_filter( 'ppb_row_styles_section_bg_image', array( $this, 'field_sections' ) );

		add_filter( 'siteorigin_panels_row_style_attributes', array( $this, 'row_style_attr' ), 10, 2 );

	}

	public function fields( $fields ) {

		$fields['ken_burns'] = array(
			'name' => __( 'Ken Burns effect', 'vantage' ),
			'type' => 'checkbox',
		);

		$fields['ken_burns_img2'] = array(
			'name' => __( 'Second BG Image', 'vantage' ),
			'type' => 'upload',
		);

		return $fields;
	}

	public function field_sections( $sections ) {

		$sections[] = 'ken_burns';
		$sections[] = 'ken_burns_img2';

		return $sections;
	}

	public function row_style_attr( $style_attributes, $styleArray ) {

		if ( ! empty( $styleArray['ken_burns'] ) ) {
			$style_attributes['class'][]               = 'ppbx-photo-ken-burns';
			$style_attributes['data-ken-burns-img'][]  = $styleArray['background_image'];
			$style_attributes['data-ken-burns-img2'][] = $styleArray['ken_burns_img2'];
		}

		return $style_attributes;
	}

	public static function instance() {
		if ( null == Self::$instance ) {

			Self::$instance = new Self;
		}

		return Self::$instance;
	}

	public function enqueue() {

		wp_enqueue_script( 'ppbx-photography-front-js', plugin_dir_url( __FILE__ ) . '/front.js', array( 'jquery', 'pootle-page-builder-front-js', ) );

		wp_enqueue_style( 'ppbx-photography-front-css', plugin_dir_url( __FILE__ ) . '/front.css' );
	}

}
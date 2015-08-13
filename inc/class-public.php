<?php

/**
 * pootle page builder for photography public class
 * @property string $token Plugin token
 * @property string $url Plugin root dir url
 * @property string $path Plugin root dir path
 * @property string $version Plugin version
 */
class pootle_page_builder_for_photography_Public{

	/**
	 * @var 	pootle_page_builder_for_photography_Public Instance
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Main pootle page builder for photography Instance
	 * Ensures only one instance of Storefront_Extension_Boilerplate is loaded or can be loaded.
	 * @since 1.0.0
	 * @return pootle_page_builder_for_photography instance
	 */
	public static function instance() {
		if ( null == self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Constructor function.
	 * @access  private
	 * @since   1.0.0
	 */
	private function __construct() {
		$this->token   =   pootle_page_builder_for_photography::$token;
		$this->url     =   pootle_page_builder_for_photography::$url;
		$this->path    =   pootle_page_builder_for_photography::$path;
		$this->version =   pootle_page_builder_for_photography::$version;
	} // End __construct()

	/**
	 * Adds front end stylesheet and js
	 * @action wp_enqueue_scripts
	 * @since 1.0.0
	 */
	public function enqueue() {
		$token = $this->token;
		$url = $this->url;

		wp_enqueue_style( $token . '-css', $url . '/assets/front-end.css' );
		wp_enqueue_script( $token . '-js', $url . '/assets/front-end.js', array( 'jquery' ) );
	}

	/**
	 * Adds or modifies the row attributes
	 * @param array $attr Row html attributes
	 * @param array $settings Row settings
	 * @return array Row html attributes
	 * @filter pootlepb_row_style_attributes
	 * @since 1.0.0
	 */
	public function row_attr( $attr, $settings ) {

		if ( ! empty( $settings['ken_burns'] ) ) {
			$attr['class'][]               = 'ppbx-photo-ken-burns';
			$attr['data-ken-burns-img'][]  = $settings['background_image'];
			$attr['data-ken-burns-img2'][] = $settings['ken_burns_img2'];
		}

		return $attr;
	}
}
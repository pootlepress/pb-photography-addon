<?php
/**
 * pootle page builder for photography Admin class
 * @property string token Plugin token
 * @property string $url Plugin root dir url
 * @property string $path Plugin root dir path
 * @property string $version Plugin version
 */
class pootle_page_builder_for_photography_Admin{

	/**
	 * @var 	pootle_page_builder_for_photography_Admin Instance
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Main pootle page builder for photography Instance
	 * Ensures only one instance of Storefront_Extension_Boilerplate is loaded or can be loaded.
	 * @return pootle_page_builder_for_photography instance
	 * @since 	1.0.0
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
	 * @since 	1.0.0
	 */
	private function __construct() {
		$this->token   =   pootle_page_builder_for_photography::$token;
		$this->url     =   pootle_page_builder_for_photography::$url;
		$this->path    =   pootle_page_builder_for_photography::$path;
		$this->version =   pootle_page_builder_for_photography::$version;
	} // End __construct()

	/**
	 * Adds row settings panel fields
	 * @param array $fields Fields to output in row settings panel
	 * @return array Tabs
	 * @filter pootlepb_row_settings_fields
	 * @since 	1.0.0
	 */
	public function row_settings_fields( $fields ) {

		$fields['ken_burns'] = array(
			'name' => __( 'Ken Burns effect', 'vantage' ),
			'type' => 'checkbox',
			'tab' => 'background',
			'priority' => 6,
		);

		$fields['ken_burns_img2'] = array(
			'name' => __( 'Second BG Image', 'vantage' ),
			'type' => 'upload',
			'tab' => 'background',
			'priority' => 6,
		);

		return $fields;
	}

	/**
	 * Adds content block panel fields
	 * @param array $fields Fields to output in content block panel
	 * @return array Tabs
	 * @filter pootlepb_content_block_fields
	 * @since 	1.0.0
	 */
	public function content_block_fields( $fields ) {
		$fields[ $this->token . '_sample_number' ] = array(
			'name' => 'Sample Number with unit',
			'type' => 'number',
			'priority' => 1,
			'min'  => '0',
			'max'  => '100',
			'step' => '1',
			'unit' => 'em',
			'tab' => $this->token,
			'help-text' => 'This is a sample boilerplate field, Sets left and top offset in em.'
		);
		return $fields;
	}

}
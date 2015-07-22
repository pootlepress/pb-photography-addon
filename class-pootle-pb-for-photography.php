<?php

class pootle_page_builder_for_photography{

	/**
	 * pootle_page_builder_for_photography Instance of main plugin class.
	 *
	 * @var 	object pootle_page_builder_for_photography
	 * @access  private
	 * @since 	0.1.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   0.1.0
	 */
	public static $token;
	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   0.1.0
	 */
	public static $version;

	/**
	 * pootle page builder for photography plugin directory URL.
	 *
	 * @var 	string Plugin directory
	 * @access  private
	 * @since 	0.1.0
	 */
	public static $url;

	/**
	 * pootle page builder for photography plugin directory Path.
	 *
	 * @var 	string Plugin directory
	 * @access  private
	 * @since 	0.1.0
	 */
	public static $path;

	/**
	 * Main pootle page builder for photography Instance
	 *
	 * Ensures only one instance of Storefront_Extension_Boilerplate is loaded or can be loaded.
	 *
	 * @since 0.1.0
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
	 * @since   0.1.0
	 */
	private function __construct() {

		self::$token   =   'pootle-pb-for-photography';
		self::$url     =   plugin_dir_url( __FILE__ );
		self::$path    =   plugin_dir_path( __FILE__ );
		self::$version =   '0.1.0';

		add_action( 'init', array( $this, 'init' ) );
	} // End __construct()

	/**
	 * Initiates the plugin
	 * @action init
	 * @since 0.1.0
	 */
	public function init() {

		if ( class_exists( 'Pootle_Page_Builder' ) ) {

			//Add the required hooks
			$this->add_hooks();

			// Pootlepress API Manager
			/** Including PootlePress_API_Manager class */
			require_once( plugin_dir_path( __FILE__ ) . 'pp-api/class-pp-api-manager.php' );
			/** Instantiating PootlePress_API_Manager */
			new PootlePress_API_Manager( self::$token, 'pootle page builder for photography', self::$version, __FILE__, self::$token );
		}
	} // End init()

	/**
	 * Adds the hooks required
	 * @since 0.1.0
	 */
	private function add_hooks() {

		//Adding front end JS and CSS in /assets folder
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

		add_filter( 'pootlepb_row_settings_fields', array( $this, 'fields' ) );

		add_filter( 'pootlepb_row_style_attributes', array( $this, 'row_style_attr' ), 10, 2 );

	} // End add_filters()

	public function fields( $fields ) {

		$fields['ken_burns'] = array(
			'name' => __( 'Ken Burns effect', 'vantage' ),
			'type' => 'checkbox',
			'tab' => 'background',
			'priority' => 3,
		);

		$fields['ken_burns_img2'] = array(
			'name' => __( 'Second BG Image', 'vantage' ),
			'type' => 'upload',
			'tab' => 'background',
			'priority' => 3,
		);

		return $fields;
	}

	public function row_style_attr( $style_attributes, $styleArray ) {

		if ( ! empty( $styleArray['ken_burns'] ) ) {
			$style_attributes['class'][]               = 'ppbx-photo-ken-burns';
			$style_attributes['data-ken-burns-img'][]  = $styleArray['background_image'];
			$style_attributes['data-ken-burns-img2'][] = $styleArray['ken_burns_img2'];
		}

		return $style_attributes;
	}

	/**
	 * Adds front end stylesheet and js
	 * @since 0.1.0
	 */
	public function enqueue() {
		$token = self::$token;
		$url = self::$url;

		wp_enqueue_style( $token . '-css', $url . '/assets/front-end.css' );
		wp_enqueue_script( $token . '-js', $url . '/assets/front-end.js', array( 'jquery' ) );
	} // End enqueue()

}
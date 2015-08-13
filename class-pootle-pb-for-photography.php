<?php
/**
 * pootle page builder for photography main class
 * @static string $token Plugin token
 * @static string $file Plugin __FILE__
 * @static string $url Plugin root dir url
 * @static string $path Plugin root dir path
 * @static string $version Plugin version
 */
class pootle_page_builder_for_photography{

	/**
	 * @var 	pootle_page_builder_for_photography Instance
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * @var     string Token
	 * @access  public
	 * @since   1.0.0
	 */
	public static $token;

	/**
	 * @var     string Version
	 * @access  public
	 * @since   1.0.0
	 */
	public static $version;

	/**
	 * @var 	string Plugin main __FILE__
	 * @access  public
	 * @since 	1.0.0
	 */
	public static $file;

	/**
	 * @var 	string Plugin directory url
	 * @access  public
	 * @since 	1.0.0
	 */
	public static $url;

	/**
	 * @var 	string Plugin directory path
	 * @access  public
	 * @since 	1.0.0
	 */
	public static $path;

	/**
	 * @var 	pootle_page_builder_for_photography_Admin Instance
	 * @access  public
	 * @since 	1.0.0
	 */
	public $admin;

	/**
	 * @var 	pootle_page_builder_for_photography_Public Instance
	 * @access  public
	 * @since 	1.0.0
	 */
	public $public;

	/**
	 * Main pootle page builder for photography Instance
	 *
	 * Ensures only one instance of Storefront_Extension_Boilerplate is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @return pootle_page_builder_for_photography instance
	 */
	public static function instance( $file ) {
		if ( null == self::$_instance ) {
			self::$_instance = new self( $file );
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Constructor function.
	 * @param string $file __FILE__ of the main plugin
	 * @access  private
	 * @since   1.0.0
	 */
	private function __construct( $file ) {

		self::$token   =   'pootle-pb-for-photography';
		self::$file    =   $file;
		self::$url     =   plugin_dir_url( $file );
		self::$path    =   plugin_dir_path( $file );
		self::$version =   '1.0.0';

		add_action( 'init', array( $this, 'init' ) );
	} // End __construct()

	/**
	 * Initiates the plugin
	 * @action init
	 * @since 1.0.0
	 */
	public function init() {

		if ( class_exists( 'Pootle_Page_Builder' ) ) {

			//Initiate admin
			$this->_admin();

			//Initiate public
			$this->_public();

			//Mark this add on as active
			add_filter( 'pootlepb_installed_add_ons', array( $this, 'add_on_active' ) );

			/** Including PootlePress_API_Manager class */
			require_once( plugin_dir_path( __FILE__ ) . 'pp-api/class-pp-api-manager.php' );
			/** Instantiating PootlePress_API_Manager */
			new PootlePress_API_Manager( self::$token, 'pootle page builder for photography', self::$version, __FILE__, self::$token );
		}
	} // End init()

	/**
	 * Initiates admin class and adds admin hooks
	 * @since 1.0.0
	 */
	private function _admin() {
		//Instantiating admin class
		$this->admin = pootle_page_builder_for_photography_Admin::instance();

		//Row settings panel fields
		add_filter( 'pootlepb_row_settings_fields', array( $this->admin, 'row_settings_fields' ) );
		//Content block panel fields
		add_filter( 'pootlepb_content_block_fields', array( $this->admin, 'content_block_fields' ) );

	}

	/**
	 * Initiates public class and adds public hooks
	 * @since 1.0.0
	 */
	private function _public() {
		//Instantiating public class
		$this->public = pootle_page_builder_for_photography_Public::instance();

		//Adding front end JS and CSS in /assets folder
		add_action( 'wp_enqueue_scripts', array( $this->public, 'enqueue' ) );
		//Add/Modify row html attributes
		add_filter( 'pootlepb_row_style_attributes', array( $this->public, 'row_attr' ), 10, 2 );
		//Add/Modify content block html attributes
		add_filter( 'pootlepb_content_block_attributes', array( $this->public, 'content_block_attr' ), 10, 2 );

	} // End enqueue()

	/**
	 * Marks this add on as active on
	 * @param array $active Active add ons
	 * @return array Active add ons
	 * @since 1.0.0
	 */
	public function add_on_active( $active ) {

		// To allows ppb add ons page to fetch name, description etc.
		$active[ self::$token ] = self::$file;

		return $active;
	}

}
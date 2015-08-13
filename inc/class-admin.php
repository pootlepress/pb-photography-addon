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
	 * Adds grid adding ui stylesheet and js
	 * @action wp_enqueue_scripts
	 * @since 1.0.0
	 */
	public function enqueue() {
		$token = $this->token;
		$url = $this->url;

		wp_enqueue_style( $token . 'admin-css', $url . 'assets/admin.css' );
		wp_enqueue_script( $token . 'admin-js', $url . 'assets/admin.js', array( 'jquery' ) );
		wp_enqueue_script( $token . 'caman-js', '//cdnjs.cloudflare.com/ajax/libs/camanjs/4.0.0/caman.full.pack.js', array( 'jquery' ) );
	}

	/**
	 * Adds row settings panel fields
	 * @param array $fields Fields to output in row settings panel
	 * @return array Tabs
	 * @filter pootlepb_row_settings_fields
	 * @since 	1.0.0
	 */
	public function row_settings_fields( $fields ) {

		$fields['background_image']['type'] = 'photo-filter';

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
	 * Renders photo filter field
	 * @param string $key Setting id
	 * @param array $field Setting data
	 * @since 1.0.0
	 */
	public function row_photo_filter_field( $key, $field ) {
		?>
		<input style=" width: 50px;" type="text" id="pp-pb-<?php esc_attr_e( $key ) ?>"
		       name="panelsStyle[<?php echo esc_attr( $key ) ?>]"
		       data-style-field="<?php echo esc_attr( $key ) ?>"
		       data-style-field-type="<?php echo esc_attr( $field['type'] ) ?>"
			/>
		<input type="hidden" id="pp-pb-<?php esc_attr_e( $key . '_filters' ) ?>"
		       name="panelsStyle[<?php echo esc_attr( $key . '_filters' ) ?>]"
		       data-style-field="<?php echo esc_attr( $key . '_filters' ) ?>"
		       data-style-field-type="<?php echo esc_attr( $field['type'] ) ?>"
			/>
		<button class="button upload-button">Select Image</button>
		<button class="button filter-button">Filter Image</button>
		<?php
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

	/**
	 * Adds content block panel fields
	 * @param array $fields Fields to output in content block panel
	 * @return array Tabs
	 * @filter pootlepb_content_block_fields
	 * @since 	1.0.0
	 */
	public function dialog() {
		?>
		<div id="photo-filter-dialog" data-title="Photo filter"
		     class="panels-admin-dialog">
			<div class="ppb-cool-panel-wrap">
				<div class="ppb-photo-sidebar">

				</div>
				<div class="ppb-photo-content">
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-0"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-1"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-2"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-3"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-4"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-5"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-6"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-7"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-8"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-9"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-10"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-11"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-12"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-13"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-14"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-15"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-16"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-17"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-18"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-19"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-20"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-21"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-22"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-23"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-24"></canvas>
					<canvas class="ppb-photo-canvas" id="ppb-photo-canvas-25"></canvas>
				</div>
			</div>
		</div>
	<?php
	}
}
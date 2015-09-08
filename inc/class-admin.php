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

	protected $filters;

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

		$this->filters = array(
			array(
				'brightness' => 'Brightness',
				'contrast' => 'Contrast',
				'saturation' => 'Saturation',
				'vibrance' => 'Vibrance',
				'exposure' => 'Exposure',
			),
			array(
				'hue' => 'Hue',
				'sepia' => 'Sepia',
				'gamma' => 'Gamma',
				'noise' => 'Noise',
				'clip' => 'Clip',
				'sharpen' => 'Sharpen',
				'stackBlur' => 'Blur',
			)
		);

		$filters = array_merge( $this->filters[0], $this->filters[1] );

		wp_enqueue_style( $token . 'admin-css', $url . 'assets/admin.css' );
		wp_enqueue_script( $token . 'admin-js', $url . 'assets/admin.js', array( 'jquery' ) );
		wp_enqueue_script( $token . 'caman-js', '//cdnjs.cloudflare.com/ajax/libs/camanjs/4.1.2/caman.full.min.js', array( 'jquery' ) );

		wp_localize_script( $token . 'admin-js', 'filter_controls', array(
			'number'  => count( $filters ),
		    'filters' => $filters,
		) );
	}

	/**
	 * Adds row settings panel fields
	 * @param array $fields Fields to output in row settings panel
	 * @return array Tabs
	 * @filter pootlepb_row_settings_fields
	 * @since 	1.0.0
	 */
	public function row_settings_fields( $fields ) {

		unset( $fields['background_image'] );
		$fields['photo_background_image'] = array(
			'name' => __( 'Background Image', 'vantage' ),
			'tab' => 'background',
			'type' => 'photo-filter',
			'priority' => 5,
		);

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
		<input style=" width: 50px;" id="pp-pb-<?php esc_attr_e( $key ) ?>"
		       type="hidden" class="image-data"
		       name="panelsStyle[<?php echo esc_attr( $key ) ?>]"
		       data-style-field="<?php echo esc_attr( $key ) ?>"
		       data-style-field-type="<?php echo esc_attr( $field['type'] ) ?>"
			/>
		<button class="button ppb-photo-button">Select Image</button>
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
					<canvas class="ppb-photo-canvas-main" data-filter="" id="ppb-photo-canvas-main"></canvas>
					<div class="controls">
						<?php
						foreach ( $this->filters[0] as $filter => $name ) {
							?>
							<div class="control">
								<label for="<?php echo $filter; ?>"><?php echo $name; ?></label>
								<input class="ppb-photo-control ppb-photo-control-<?php echo $filter; ?>"
								       data-filter="<?php echo $filter; ?>" name="<?php echo $filter; ?>"
								       type="range" min="-100" max="100" value="0">
							</div>
							<?php
						}
						foreach ( $this->filters[1] as $filter => $name ) {
							?>
							<div class="control">
								<label for="<?php echo $filter; ?>"><?php echo $name; ?></label>
								<input class="ppb-photo-control ppb-photo-control-<?php echo $filter; ?>"
								       data-filter="<?php echo $filter; ?>" name="<?php echo $filter; ?>"
								       type="range" min="0" max="<?php
								if ( 'gamma' == $filter ) {
									echo 10;
								} else if ( 'stackBlur' == $filter ) {
									echo 20;
								} else {
									echo 100;
								}
								?>" value="0">
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="ppb-photo-content">
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="" id="ppb-photo-canvas-0"></canvas>
						<center>Default</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="vintage" id="ppb-photo-canvas-1"></canvas><br>
						<center>vintage</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="lomo" id="ppb-photo-canvas-2"></canvas><br>
						<center>lomo</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="emboss" id="ppb-photo-canvas-3"></canvas><br>
						<center>emboss</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="radialBlur" id="ppb-photo-canvas-4"></canvas><br>
						<center>nostalgia</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="clarity" id="ppb-photo-canvas-5"></canvas><br>
						<center>clarity</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="orangePeel" id="ppb-photo-canvas-6"></canvas><br>
						<center>orangePeel</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="sinCity" id="ppb-photo-canvas-7"></canvas><br>
						<center>sinCity</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="sunrise" id="ppb-photo-canvas-8"></canvas><br>
						<center>sunrise</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="crossProcess" id="ppb-photo-canvas-9"></canvas><br>
						<center>crossProcess</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="love" id="ppb-photo-canvas-10"></canvas><br>
						<center>love</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="grungy" id="ppb-photo-canvas-11"></canvas><br>
						<center>grungy</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="jarques" id="ppb-photo-canvas-12"></canvas><br>
						<center>jarques</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="pinhole" id="ppb-photo-canvas-13"></canvas><br>
						<center>pinhole</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="oldBoot" id="ppb-photo-canvas-14"></canvas><br>
						<center>oldBoot</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="glowingSun" id="ppb-photo-canvas-15"></canvas><br>
						<center>glowingSun</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="hazyDays" id="ppb-photo-canvas-16"></canvas><br>
						<center>hazyDays</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="herMajesty" id="ppb-photo-canvas-17"></canvas><br>
						<center>herMajesty</center><br>
					</div>
					<div style="display: inline-block;">
						<canvas class="ppb-photo-canvas" data-filter="hemingway" id="ppb-photo-canvas-18"></canvas><br>
						<center>hemingway</center><br>
					</div>
					<div class="ppb-photo-render"></div>
					<div class="ppb-photo-in-progress">
						<div class="hv-center">
							<span class="dashicons dashicons-update"></span>
							<span class="message">Rendering...</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}
<?php
/**
 * Color class
 *
 * @package color-blender
 */

/**
 * Color class
 */
class Color {

	/**
	 * Red
	 *
	 * @var int
	 */
	public $r;

	/**
	 * Green
	 *
	 * @var int
	 */
	public $g;

	/**
	 * Blue
	 *
	 * @var int
	 */
	public $b;

	/**
	 * Color constructor
	 *
	 * @param int[] $rgb Array of RGB values.
	 */
	public function __construct( $rgb ) {

		$this->r = $rgb[0];
		$this->g = $rgb[1];
		$this->b = $rgb[2];

	}

	/**
	 * Construct with hexidecimal color
	 *
	 * @param string $hex Hexidecimal color. (#999999).
	 *
	 * @return self
	 */
	public static function with_hex( $hex ) {

		if ( 7 !== strlen( $hex ) ) {
			return;
		}

		$hex_color = substr( $hex, 1, 6 );
		$rgb_array = array( hexdec( substr( $hex_color, 0, 2 ) ), hexdec( substr( $hex_color, 2, 2 ) ), hexdec( substr( $hex_color, 4, 2 ) ) );

		$instance = new self( $rgb_array );

		return $instance;
	}

	/**
	 * Construct with RGB color
	 *
	 * @param int|int[] $r Red RGB value or array of RGB values.
	 * @param int       $g Optional. Green RGB value.
	 * @param int       $b Optional. Blue RGB value.
	 *
	 * @return self
	 */
	public static function with_rgb( $r, $g = null, $b = null ) {

		if ( is_array( $r ) ) {
			$rgb_array = $r;
		} else {
			$rgb_array = array( $r, $g, $b );
		}

		$instance = new self( $rgb_array );

		return $instance;
	}

	/**
	 * RGB values as array
	 *
	 * @return int[]
	 */
	public function coll() {

		return array( $this->r, $this->g, $this->b );
	}

	/**
	 * Whether the Color is a valid object
	 *
	 * @return bool
	 */
	public function is_valid() {

		if ( is_int( $this->r ) && is_int( $this->g ) && is_int( $this->b ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Color in hex
	 *
	 * @return string
	 */
	public function to_hex() {

		$r = $this->pad_hex( dechex( $this->r ) );
		$g = $this->pad_hex( dechex( $this->g ) );
		$b = $this->pad_hex( dechex( $this->b ) );

		return sprintf( '#%s%s%s', $r, $g, $b );
	}

	/**
	 * Two-digit hex code
	 *
	 * @param string $hex Hexidecimal value.
	 *
	 * @return string
	 */
	private function pad_hex( $hex ) {

		return str_pad( $hex, 2, '0', STR_PAD_LEFT );
	}

}

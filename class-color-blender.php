<?php
/**
 * Color_Blender Class
 *
 * @package color-blender
 */

/**
 * Color_Blender Class
 */
class Color_Blender {

	/**
	 * Starting color
	 *
	 * @var Color
	 */
	public $start;

	/**
	 * Ending color
	 *
	 * @var Color
	 */
	public $end;

	/**
	 * Number of steps between start and end colors
	 *
	 * @var int
	 */
	public $steps;

	/**
	 * Color blend palette
	 *
	 * @var Color[]
	 */
	public $color_blends;

	/**
	 * Color_Blender constructor
	 *
	 * @param string $start Hexidecimal starting color.
	 * @param string $end Hexidecimal ending color.
	 * @param int    $steps Number of blending steps.
	 */
	public function __construct( $start, $end, $steps ) {

		$this->start = Color::with_hex( $start );
		$this->end   = Color::with_hex( $end );
		$this->steps = $steps;

		$this->color_blends = $this->generate_color_blends();

	}

	/**
	 * Get blended color palette
	 *
	 * @return Color[]
	 */
	public function get_palette() {

		$palette = array();
		array_push( $palette, $this->start );
		$palette = array_merge( $palette, $this->color_blends );
		array_push( $palette, $this->end );

		return $palette;
	}

	/**
	 * Generates stepped color blends
	 *
	 * @return Color[]
	 */
	private function generate_color_blends() {

		$color_blends = array();

		$r_steps = ( $this->end->r - $this->start->r ) / $this->steps;
		$g_steps = ( $this->end->g - $this->start->g ) / $this->steps;
		$b_steps = ( $this->end->b - $this->start->b ) / $this->steps;

		for ( $i = 1; $i <= $this->steps; $i++ ) {

			$r = $this->start->r + ( $r_steps * $i );
			$g = $this->start->g + ( $g_steps * $i );
			$b = $this->start->b + ( $b_steps * $i );

			array_push( $color_blends, new Color( array( $r, $g, $b ) ) );

		}

		return $color_blends;
	}

}

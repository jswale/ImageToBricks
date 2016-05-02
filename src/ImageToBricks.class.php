<?php
include_once "lib/logger.php";
include_once "lib/vars.php";
include_once "lib/utils.php";

class ImageToBricks {

	var $color_map = array();

	var $_palette = array();

	function __construct ($palette = "default") {
		$this->palette = $palette;
	}

	/*
	 * image - the location of the image to pixelate
	 * gridSize - the size of the grid
	 */
	public function pixelate ($image, $gridSize) {
		// get the input file extension and create a GD resource from it
		$img = $this->getImage($image);

		// now we have the image loaded up and ready for the effect to be
		// applied
		// get the image size
		$size = getimagesize($image);
		$height = $size[1];
		$width = $size[0];

		$pixelate_x = round($width / $gridSize);
		$pixelate_y = round($height / $gridSize);
		if($pixelate_x > $pixelate_y) {
			$pixelate_y = $pixelate_x;
		} else {
			$pixelate_x = $pixelate_y;
		}

		// start from the top-left pixel and keep looping until we have the
		// desired effect
		for ($y = 0; $y < $height; $y += $pixelate_y + 1) {

			for ($x = 0; $x < $width; $x += $pixelate_x + 1) {
				// get the color for current pixel
				$rgb = imagecolorsforindex($img, imagecolorat($img, $x, $y));

				// get the closest color from palette
				// $color = imagecolorclosest($img, $rgb['red'], $rgb['green'],
				// $rgb['blue']);

				$color = $this->getClosestColor($rgb["red"], $rgb["green"],
						$rgb["blue"]);
				$color = imagecolorclosest($img, $color[0], $color[1],
						$color[2]);

				imagefilledrectangle($img, $x, $y, $x + $pixelate_x,
						$y + $pixelate_y, $color);
			}
		}

		return $img;
	}

	private function getPalette () {
		if (! empty($this->_palette)) return $this->_palette;
		switch ($this->palette) {
			case 'default':
				$hexs = array(
						Bricks::COLOR26,
						Bricks::COLOR23,
						Bricks::COLOR37,
						Bricks::COLOR194,
						Bricks::COLOR38,
						Bricks::COLOR221,
						Bricks::COLOR21,
						Bricks::COLOR1,
						Bricks::COLOR24
				);
				break;

			case 'full':
			default:
				$hexs = array(
						Bricks::COLOR1,
						Bricks::COLOR5,
						Bricks::COLOR18,
						Bricks::COLOR21,
						Bricks::COLOR23,
						Bricks::COLOR24,
						Bricks::COLOR26,
						Bricks::COLOR28,
						Bricks::COLOR37,
						Bricks::COLOR38,
						Bricks::COLOR102,
						Bricks::COLOR106,
						Bricks::COLOR119,
						Bricks::COLOR124,
						Bricks::COLOR135,
						Bricks::COLOR138,
						Bricks::COLOR140,
						Bricks::COLOR141,
						Bricks::COLOR151,
						Bricks::COLOR154,
						Bricks::COLOR191,
						Bricks::COLOR192,
						Bricks::COLOR194,
						Bricks::COLOR199,
						Bricks::COLOR208,
						Bricks::COLOR212,
						Bricks::COLOR221,
						Bricks::COLOR222,
						Bricks::COLOR226,
						Bricks::COLOR268,
						Bricks::COLOR283,
						Bricks::COLOR308,
						Bricks::COLOR312,
						Bricks::COLOR321,
						Bricks::COLOR322,
						Bricks::COLOR323,
						Bricks::COLOR324,
						Bricks::COLOR325,
						Bricks::COLOR326,
						Bricks::COLOR329,
						Bricks::COLOR330,
						Bricks::COLOR331
				);
				break;
		}

		foreach ($hexs as $hex)
			$this->_palette[] = array(
					'rgb' => self::HexToRGB($hex),
					'hex' => $hex
			);
		return $this->_palette;
	}

	private function getImage ($image) {
		try {
			switch (exif_imagetype($image)) {
				case IMAGETYPE_PNG:
					$outputimg = "imagecreatefrompng";
					break;
				case IMAGETYPE_JPEG:
					$outputimg = "imagecreatefromjpeg";
					break;
				case IMAGETYPE_GIF:
					$outputimg = "imagecreatefromgif";
					break;
				case IMAGETYPE_BMP:
					$outputimg = "imagecreatefrombmp";
					break;
				default:
					Logger::kill('Unsupported file');
			}

			return $outputimg($image);
		}
		catch (Exception $e) {
			Logger::kill($e->getMessage());
		}
	}

	private function getClosestColor ($r, $g, $b) {
		if (isset($this->color_map[$this->RGBToHex($r, $g, $b)])) {
			return $this->color_map[$this->RGBToHex($r, $g, $b)];
		}
		$differencearray = array();
		$colors = $this->getPalette();
		foreach ($colors as $key => $value) {
			$value = $value['rgb'];
			$differencearray[$key] = self::getDistanceBetweenColors($value,
					array(
							$r,
							$g,
							$b
					));
		}
		$smallest = min($differencearray);
		$key = array_search($smallest, $differencearray);
		$color = $this->color_map[$this->RGBToHex($r, $g, $b)] = $colors[$key]['rgb'];
		return $color;
	}

	private static function getDistanceBetweenColors ($col1, $col2) {
		$xyz1 = self::rgb_to_xyz($col1);
		$xyz2 = self::rgb_to_xyz($col2);
		$lab1 = self::xyz_to_lab($xyz1);
		$lab2 = self::xyz_to_lab($xyz2);
		return ciede2000($lab1, $lab2);
	}

	private static function rgb_to_xyz ($rgb) {
		$red = $rgb[0];
		$green = $rgb[1];
		$blue = $rgb[2];
		$_red = $red / 255;
		$_green = $green / 255;
		$_blue = $blue / 255;
		if ($_red > 0.04045) {
			$_red = ($_red + 0.055) / 1.055;
			$_red = pow($_red, 2.4);
		} else {
			$_red = $_red / 12.92;
		}
		if ($_green > 0.04045) {
			$_green = ($_green + 0.055) / 1.055;
			$_green = pow($_green, 2.4);
		} else {
			$_green = $_green / 12.92;
		}
		if ($_blue > 0.04045) {
			$_blue = ($_blue + 0.055) / 1.055;
			$_blue = pow($_blue, 2.4);
		} else {
			$_blue = $_blue / 12.92;
		}
		$_red *= 100;
		$_green *= 100;
		$_blue *= 100;
		$x = $_red * 0.4124 + $_green * 0.3576 + $_blue * 0.1805;
		$y = $_red * 0.2126 + $_green * 0.7152 + $_blue * 0.0722;
		$z = $_red * 0.0193 + $_green * 0.1192 + $_blue * 0.9505;
		return (array(
				$x,
				$y,
				$z
		));
	}

	private static function xyz_to_lab ($xyz) {
		$x = $xyz[0];
		$y = $xyz[1];
		$z = $xyz[2];
		$_x = $x / 95.047;
		$_y = $y / 100;
		$_z = $z / 108.883;
		if ($_x > 0.008856) {
			$_x = pow($_x, 1 / 3);
		} else {
			$_x = 7.787 * $_x + 16 / 116;
		}
		if ($_y > 0.008856) {
			$_y = pow($_y, 1 / 3);
		} else {
			$_y = (7.787 * $_y) + (16 / 116);
		}
		if ($_z > 0.008856) {
			$_z = pow($_z, 1 / 3);
		} else {
			$_z = 7.787 * $_z + 16 / 116;
		}
		$l = 116 * $_y - 16;
		$a = 500 * ($_x - $_y);
		$b = 200 * ($_y - $_z);

		return (array(
				'l' => $l,
				'a' => $a,
				'b' => $b
		));
	}

	static public function RGBToHex ($r, $g, $b) {
		$hex = "#";
		$hex .= str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
		$hex .= str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
		return strtoupper($hex);
	}

	static public function HexToRGB ($hex) {
		$hex = str_replace("#", "", $hex);

		if (strlen($hex) == 3) {
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		} else {
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}
		$rgb = array(
				$r,
				$g,
				$b
		);
		return $rgb; // returns an array with the rgb values
	}
}
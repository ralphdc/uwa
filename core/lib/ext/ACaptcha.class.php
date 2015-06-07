<?php

/**
 *--------------------------------------
 * captcha
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-25
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ACaptcha {
	public $width = 200;
	public $height = 70;
	public $textLength = 5;
 	/* array('spacing' => 2, 'size' => 24, 'font' => 'D:/public/font.ttf') */
	public $fonts;
	public $backgroundColor = array(255, 255, 255);
	public $colors = array(
		// blue, green, red
		array(27, 78, 181),
		array(22, 163, 35),
		array(214, 36, 7),
		);
	public $shadowColor = null; // array(0, 0, 0);
	/* Wave configuracion in X and Y axes */
	public $waveCfg = array(
		'periodX' => 9,
		'amplitudeX' => 5,
		'periodY' => 9,
		'amplitudeY' => 14);
	/* letter rotation clockwise */
	public $maxRotation = 8;
	/* 1: low, 2: medium, 3: high */
	public $scale = 3;
	/* Blur effect, Better image results with scale=3 */
	public $blur = false;
	public $debug = false;
	public $imageFormat = 'jpeg';
	public $im; // GD image
	public $text; // text

	public function __construct($width = 0, $height = 0, $textLength = 0, $fonts = array()) {
		if($width > 0) {
			$this->width = $width;
		}
		if($height > 0) {
			$this->height = $height;
		}
		if($textLength > 0) {
			$this->textLength = $textLength;
		}
		if(!empty($fonts)) {
			$this->fonts = $fonts;
		}

		/* get Text */
		$this->get_captchaText();
	}

	public function create_image() {
		$ini = microtime(true);

		/* Initialization */
		$this->allocate_image();

		/*Text insertion */
		$this->write_text();

		/* Transformations */
		$this->wave_image();

		if($this->blur && function_exists('imagefilter')) {
			imagefilter($this->im, IMG_FILTER_GAUSSIAN_BLUR);
		}

		$this->reduce_image();

		if($this->debug) {
			imagestring($this->im, 1, 1, $this->height - 8, "{$this->text} " . round((microtime(true) - $ini) * 1000) . "ms", $this->GdFgColor);
		}

		/* Output */
		$this->write_image();
		$this->cleanup();
	}

	/* Creates the image resources */
	protected function allocate_image() {
		/* cleanup */
		if(!empty($this->im)) {
			imagedestroy($this->im);
		}
		$this->im = imagecreatetruecolor($this->width * $this->scale, $this->height * $this->scale);
		/* Background color */
		$this->GdBgColor = imagecolorallocate($this->im, $this->backgroundColor[0], $this->backgroundColor[1], $this->backgroundColor[2]);
		imagefilledrectangle($this->im, 0, 0, $this->width * $this->scale, $this->height * $this->scale, $this->GdBgColor);

		/* Foreground color */
		$color = $this->colors[mt_rand(0, sizeof($this->colors) - 1)];
		$this->GdFgColor = imagecolorallocate($this->im, $color[0], $color[1], $color[2]);

		/* Shadow color */
		if(!empty($this->shadowColor) && is_array($this->shadowColor) && sizeof($this->shadowColor) >= 3) {
			$this->GdShadowColor = imagecolorallocate($this->im, $this->shadowColor[0], $this->shadowColor[1], $this->shadowColor[2]);
		}
	}

	/* Text generation */
	protected function get_captchaText() {
		$length = $this->textLength;

		$words = 'bcdfghjklmnpqrstvwxyz';
		$vocals = 'aeiou';

		$this->text = '';
		$vocal = rand(0, 1);
		for($i = 0; $i < $length; $i++) {
			if($vocal) {
				$this->text .= substr($vocals, mt_rand(0, 4), 1);
			}
			else {
				$this->text .= substr($words, mt_rand(0, 20), 1);
			}
			$vocal = !$vocal;
		}
	}

	/* Text insertion */
	protected function write_text() {
		/* Text generation (char by char) */
		$x = ($this->waveCfg['amplitudeX'] * 2 + 10) * $this->scale;
		$y = round(($this->height * 27 / 40) * $this->scale);
		$length = strlen($this->text);
		for($i = 0; $i < $length; $i++) {
			$degree = rand($this->maxRotation * -1, $this->maxRotation);
			$fontsize = rand($this->fonts['size'] - 2, $this->fonts['size'] + 2) * $this->scale;
			$letter = substr($this->text, $i, 1);

			if($this->shadowColor) {
				$coords = imagettftext($this->im, $fontsize, $degree, $x - $this->scale, $y - $this->scale, $this->GdShadowColor, $this->fonts['font'], $letter);
			}
			$coords = imagettftext($this->im, $fontsize, $degree, $x, $y, $this->GdFgColor, $this->fonts['font'], $letter);
			$x += ($coords[2] - $x) + ($this->fonts['spacing'] * $this->scale);
		}
	}

	/* Wave filter */
	protected function wave_image() {
		/* X-axis wave generation */
		$_im = imagecreatetruecolor($this->width * $this->scale, $this->height * $this->scale);
		imagefilledrectangle($_im, 0, 0, $this->width * $this->scale, $this->height * $this->scale, $this->GdBgColor);
		$xp = $this->scale * $this->waveCfg['periodX'] * rand(1, 3);
		$k = rand(0, 100);
		for($i = 0; $i < ($this->width * $this->scale); $i++) {
			imagecopy($_im, $this->im, $i - 1, sin($k + $i / $xp) * ($this->scale * $this->waveCfg['amplitudeX']), $i, 0, 1, $this->height * $this->scale);
		}

		/* Y-axis wave generation */
		$this->im = imagecreatetruecolor($this->width * $this->scale, $this->height * $this->scale);
		imagefilledrectangle($this->im, 0, 0, $this->width * $this->scale, $this->height * $this->scale, $this->GdBgColor);
		$k = rand(0, 100);
		$yp = $this->scale * $this->waveCfg['periodY'] * rand(1, 2);
		for($i = 0; $i < ($this->height * $this->scale); $i++) {
			imagecopy($this->im, $_im, sin($k + $i / $yp) * ($this->scale * $this->waveCfg['amplitudeY']), $i - 1, 0, $i, $this->width * $this->scale, 1);
		}
		imagedestroy($_im);
	}

	/* Reduce the image to the final size */
	protected function reduce_image() {
		$imResampled = imagecreatetruecolor($this->width, $this->height);
		imagecopyresampled($imResampled, $this->im, 0, 0, 0, 0, $this->width, $this->height, $this->width * $this->scale, $this->height * $this->scale);
		imagedestroy($this->im);
		$this->im = $imResampled;
	}

	/* File generation */
	protected function write_image() {
		if($this->imageFormat == 'png' && function_exists('imagepng')) {
			header("Content-type: image/png");
			imagepng($this->im);
		}
		else {
			header("Content-type: image/jpeg");
			imagejpeg($this->im, null, 90);
		}
	}

	/* cleanup */
	protected function cleanup() {
		imagedestroy($this->im);
	}
}
/**
 * Usage:
 * ----------------------------------------
 * $fonts = array('spacing' => 5, 'size' => 18, 'font' => PUBLIC_PATH . D_S . 'font/font.ttf');
 * $ac = new ACaptcha(140,30,6,$fonts);
 * ASession::set('captcha', $ac->text);
 * $ac->create_image();
 */

?>
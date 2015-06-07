<?php

/**
 *--------------------------------------
 * image
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class AImage {
	private $sourceDir = '';
	private $outputDir = '';
	public $imageError;

	public function __construct($config) {
		$classVar = get_class_vars(get_class($this));
		foreach($config as $k => $v) {
			if(array_key_exists($k, $classVar)) {
				$this->$k = $v;
			}
		}
	}

	public function set_outputDir($outputDir) {
		$outputDir = rtrim($outputDir, '\\/') . D_S;
		if(!empty($outputDir)) {
			$outputDir = rtrim($this->outputDir, '\\/') . D_S;
		}
		if(!dir_writable($outputDir)) {
			$this->imageError[] = L('_DIR_READONLY_', null, array('dir' => $outputDir));
			return false;
		}
		$this->outputDir = $outputDir;
		return true;
	}

	public function thumbnail($sourceImageName, $thumbWidth = 64, $thumbHeight = 64, $prefix = 'thumb_', $proportional = true, $outputDir = '') {
		$this->imageError = array();
		$this->set_outputDir($outputDir);
		$sourceInfo = $this->get_imageInfo(rtrim($this->sourceDir, '\\/') . D_S . $sourceImageName);
		$thumbInfo = $this->get_thumbInfo($sourceInfo, $thumbWidth, $thumbHeight, $prefix, $proportional);
		$thumbResource = $this->thumbImage($thumbInfo, $sourceInfo);
		if(empty($this->imageError)) {
			return $this->output_image($thumbResource, $thumbInfo);
		}
		return '';
	}

	public function mark($sourceImageName, $markImage, $positonNo = '9', $prefix = 'water_', $outputDir = '', $padding = 4) {
		$this->imageError = array();
		$this->set_outputDir($outputDir);
		$sourceInfo = $this->get_imageInfo(rtrim($this->sourceDir, '\\/') . D_S . $sourceImageName);
		$markInfo = $this->get_markInfo($markImage);
		$markedInfo = $this->get_markedInfo($sourceInfo, $markInfo, $positonNo, $prefix, $padding);
		$markedResource = $this->markImage($markedInfo, $sourceInfo, $markInfo);
		if(empty($this->imageError)) {
			return $this->output_image($markedResource, $markedInfo);
		}
		return '';
	}

	/* $textArr: size, angle, color(ffaacc), font, text */
	public function mark_text($sourceImageName, $textArr, $positonNo = '9', $prefix = 'water_', $outputDir = '', $padding = 4) {
		$this->imageError = array();
		$this->set_outputDir($outputDir);
		$sourceInfo = $this->get_imageInfo(rtrim($this->sourceDir, '\\/') . D_S . $sourceImageName);
		$markTextInfo = $this->get_markTextInfo($textArr);
		$markedInfo = $this->get_markedInfo($sourceInfo, $markTextInfo, $positonNo, $prefix, $padding);
		$markedResource = $this->markTextImage($markedInfo, $sourceInfo, $textArr, $markTextInfo);
		if(empty($this->imageError)) {
			return $this->output_image($markedResource, $markedInfo);
		}
		return '';
	}

	public function clip($sourceInfo, $startPos, $clipSize, $prefix = 'clip_', $outputDir = '') {
		$this->imageError = array();
		$this->set_outputDir($outputDir);
		$sourceInfo = $this->get_imageInfo(rtrim($this->sourceDir, '\\/') . D_S . $sourceImageName);
		$clipInfo = $this->get_clipInfo($sourceInfo, $startPos, $clipSize, $prefix);
		$clipResource = $this->clipImage($clipInfo, $sourceInfo);
		if(empty($this->imageError)) {
			return $this->output_image($clipResource, $clipInfo);
		}
		return '';
	}

	private function get_imageInfo($imageName) {
		if(!empty($this->imageError)) {
			return '';
		}
		if(!file_exists($imageName)) {
			$this->imageError[] = L('_IMAGE_FILE_NOT_EXIST_', null, array('file' => $imageName));
			return '';
		}
		$imageInfo['name'] = basename($imageName);
		$imageInfo['size'] = filesize($imageName);
		$gis = getimagesize($imageName);
		$imageInfo['width'] = $gis[0];
		$imageInfo['height'] = $gis[1];
		switch($gis[2]) {
			case 1:
				$imageInfo['type'] = 'gif';
				break;
			case 2:
				$imageInfo['type'] = 'jpg';
				break;
			case 3:
				$imageInfo['type'] = 'png';
				break;
			case 4:
				$imageInfo['type'] = 'swf';
				break;
			case 5:
				$imageInfo['type'] = 'psd';
				break;
			case 6:
				$imageInfo['type'] = 'bmp';
				break;
			case 7:
				$imageInfo['type'] = 'tiff(intel byte order)';
				break;
			case 8:
				$imageInfo['type'] = 'tiff(motorola byte order)';
				break;
			case 9:
				$imageInfo['type'] = 'jpc';
				break;
			case 10:
				$imageInfo['type'] = 'jp2';
				break;
			case 11:
				$imageInfo['type'] = 'jpx';
				break;
			case 12:
				$imageInfo['type'] = 'jb2';
				break;
			case 13:
				$imageInfo['type'] = 'swc';
				break;
			case 14:
				$imageInfo['type'] = 'iff';
				break;
			case 15:
				$imageInfo['type'] = 'wbmp';
				break;
			case 3:
				$imageInfo['type'] = 'xbm';
				break;
			default:
				$imageInfo['type'] = L('_UNKNOWN_');
		}
		return $imageInfo;
	}

	private function get_imageResource($imageInfo) {
		switch($imageInfo['type']) {
			case 'gif':
				$resource = imagecreatefromgif(rtrim($this->sourceDir, '\\/') . D_S . $imageInfo['name']);
				break;
			case 'jpg':
				$resource = imagecreatefromjpeg(rtrim($this->sourceDir, '\\/') . D_S . $imageInfo['name']);
				break;
			case 'png':
				$resource = imagecreatefrompng(rtrim($this->sourceDir, '\\/') . D_S . $imageInfo['name']);
				break;
			default:
				$resource = imagecreatefromjpeg(rtrim($this->sourceDir, '\\/') . D_S . $imageInfo['name']);
		}
		return $resource;
	}

	private function get_thumbInfo($sourceInfo, $thumbWidth, $thumbHeight, $prefix = 'thumb_', $proportional = true) {
		if(!empty($this->imageError)) {
			return '';
		}
		$thumbInfo['name'] = $prefix . $sourceInfo['name'];
		$thumbInfo['type'] = $sourceInfo['type'];
		if($proportional) {
			$sourceWHRate = $sourceInfo['width'] / $sourceInfo['height'];
			$WWRate = $sourceInfo['width'] / $thumbWidth;
			$HHRate = $sourceInfo['height'] / $thumbHeight;
			if($WWRate > $HHRate) {
				$thumbInfo['width'] = $thumbWidth;
				$thumbInfo['height'] = round($thumbWidth / $sourceWHRate);
			}
			else {
				$thumbInfo['width'] = round($thumbHeight * $sourceWHRate);
				$thumbInfo['height'] = $thumbHeight;
			}
		}
		else {
			$thumbInfo['width'] = $thumbWidth;
			$thumbInfo['height'] = $thumbHeight;
		}
		return $thumbInfo;
	}

	private function thumbImage($thumbInfo, $sourceInfo) {
		if(!empty($this->imageError)) {
			return '';
		}
		$thumbResource = imagecreatetruecolor($thumbInfo['width'], $thumbInfo['height']);
		$sourceResource = $this->get_imageResource($sourceInfo);

		//deal with transparent color
		$otsc = imagecolortransparent($sourceResource);
		if($otsc >= 0 && $otsc < imagecolorstotal($sourceResource)) {
			$TC = imagecolorsforindex($sourceResource, $otsc);
			$transColor = imagecolorallocate($thumbResource, $TC['red'], $TC['green'], $TC['blue']);
			imagefill($thumbResource, 0, 0, $transColor);
			imagecolortransparent($thumbResource, $transColor);
		}

		//imagecopyresized($thumbResource, $sourceResource, 0, 0, 0, 0, $thumbInfo['width'], $thumbInfo['height'], $sourceInfo['width'], $sourceInfo['height']);
		imagecopyresampled($thumbResource, $sourceResource, 0, 0, 0, 0, $thumbInfo['width'], $thumbInfo['height'], $sourceInfo['width'], $sourceInfo['height']);

		imagedestroy($sourceResource);
		return $thumbResource;
	}

	private function get_markInfo($markImage) {
		if(!empty($this->imageError)) {
			return '';
		}
		if(!file_exists($markImage)) {
			$this->imageError[] = L('_WATERMARK_FILE_NOT_EXIST_', null, array('file' => $markImage));
			return '';
		}
		$imageInfo['name'] = $markImage;
		$gis = getimagesize($markImage);
		$imageInfo['width'] = $gis[0];
		$imageInfo['height'] = $gis[1];
		switch($gis[2]) {
			case 1:
				$imageInfo['type'] = 'gif';
				break;
			case 2:
				$imageInfo['type'] = 'jpg';
				break;
			case 3:
				$imageInfo['type'] = 'png';
				break;
			default:
				$imageInfo['type'] = L('_UNKNOWN_');
		}
		return $imageInfo;
	}

	private function get_markTextInfo($textArr) {
		if(!empty($this->imageError)) {
			return '';
		}
		if(!file_exists($textArr['font'])) {
			$this->imageError[] = L('_WATERMARK_FONT_FILE_NOT_EXIST_', null, array('file' => $markImage));
			return '';
		}

		$box = @imagettfbbox($textArr['size'], $textArr['angle'], $textArr['font'],$textArr['text']);
		$markTextInfo['width'] = max($box[2], $box[4]) - min($box[0], $box[6]);
		$markTextInfo['height'] = max($box[1], $box[3]) - min($box[5], $box[7]);
		$markTextInfo['ax'] = min($box[0], $box[6]) * -1;
		$markTextInfo['ay'] = min($box[5], $box[7]) * -1;

		return $markTextInfo;
	}

	private function get_markedInfo($sourceInfo, $markInfo, $positonNo, $prefix, $padding) {
		if(!empty($this->imageError)) {
			return '';
		}
		if($sourceInfo['width'] < $markInfo['width'] || $sourceInfo['height'] < $markInfo['height']) {
			$this->imageError[] = L('_SOURCE_IMAGE_TOO_SMALL_');
			return '';
		}

		$markedInfo['name'] = $prefix . $sourceInfo['name'];
		$markedInfo['type'] = $sourceInfo['type'];
		$markedInfo['width'] = $sourceInfo['width'];
		$markedInfo['height'] = $sourceInfo['height'];
		switch($positonNo) {
			case '0':
				$markedInfo['position']['x'] = rand($padding, ($sourceInfo['width'] - $markInfo['width'] - $padding));
				$markedInfo['position']['y'] = rand($padding, ($sourceInfo['height'] - $markInfo['height'] - $padding));
				break;
			case '1':
				$markedInfo['position']['x'] = $padding;
				$markedInfo['position']['y'] = $padding;
				break;
			case '2':
				$markedInfo['position']['x'] = ($sourceInfo['width'] - $markInfo['width']) / 2;
				$markedInfo['position']['y'] = $padding;
				break;
			case '3':
				$markedInfo['position']['x'] = ($sourceInfo['width'] - $markInfo['width'] - $padding);
				$markedInfo['position']['y'] = $padding;
				break;
			case '4':
				$markedInfo['position']['x'] = $padding;
				$markedInfo['position']['y'] = ($sourceInfo['height'] - $markInfo['height']) / 2;
				break;
			case '5':
				$markedInfo['position']['x'] = ($sourceInfo['width'] - $markInfo['width']) / 2;
				$markedInfo['position']['y'] = ($sourceInfo['height'] - $markInfo['height']) / 2;
				break;
			case '6':
				$markedInfo['position']['x'] = ($sourceInfo['width'] - $markInfo['width'] - $padding);
				$markedInfo['position']['y'] = ($sourceInfo['height'] - $markInfo['height']) / 2;
				break;
			case '7':
				$markedInfo['position']['x'] = $padding;
				$markedInfo['position']['y'] = ($sourceInfo['height'] - $markInfo['height'] - $padding);
				break;
			case '8':
				$markedInfo['position']['x'] = ($sourceInfo['width'] - $markInfo['width']) / 2;
				$markedInfo['position']['y'] = ($sourceInfo['height'] - $markInfo['height'] - $padding);
				break;
			case '9':
				$markedInfo['position']['x'] = ($sourceInfo['width'] - $markInfo['width'] - $padding);
				$markedInfo['position']['y'] = ($sourceInfo['height'] - $markInfo['height'] - $padding);
				break;
			default:
				$markedInfo['position']['x'] = rand($padding, ($sourceInfo['width'] - $markInfo['width'] - $padding));
				$markedInfo['position']['y'] = rand($padding, ($sourceInfo['height'] - $markInfo['height'] - $padding));
		}

		return $markedInfo;
	}

	private function get_markResource($markInfo) {
		switch($markInfo['type']) {
			case 'gif':
				$resource = imagecreatefromgif($markInfo['name']);
				break;
			case 'jpg':
				$resource = imagecreatefromjpeg($markInfo['name']);
				break;
			case 'png':
				$resource = imagecreatefrompng($markInfo['name']);
				break;
			default:
				$resource = imagecreatefromjpeg($markInfo['name']);
		}
		return $resource;
	}

	private function markImage($markedInfo, $sourceInfo, $markInfo) {
		if(!empty($this->imageError)) {
			return '';
		}
		$sourceResource = $this->get_imageResource($sourceInfo);
		$markResource = $this->get_markResource($markInfo);
		imagecopy($sourceResource, $markResource, $markedInfo['position']['x'], $markedInfo['position']['y'], 0, 0, $markInfo["width"], $markInfo["height"]);
		imagedestroy($markResource);
		return $sourceResource;
	}

	private function markTextImage($markedInfo, $sourceInfo, $textArr, $markTextInfo) {
		if(!empty($this->imageError)) {
			return '';
		}
		$sourceResource = $this->get_imageResource($sourceInfo);
		$tc = self::convert_color($textArr['color']);
		$textArr['color'] = imagecolorallocate($sourceResource, $tc['r'], $tc['g'], $tc['b']); /* text color */
		imagettftext($sourceResource, $textArr['size'], $textArr['angle'], $markedInfo['position']['x'] + $markTextInfo['ax'], $markedInfo['position']['y'] + $markTextInfo['ay'], $textArr['color'], $textArr['font'], $textArr['text']);

		return $sourceResource;
	}

	private function get_clipInfo($sourceInfo, $startPos, $clipSize, $prefix) {
		if(!empty($this->imageError)) {
			return '';
		}
		$clipInfo['name'] = $prefix . $sourceInfo['name'];
		$clipInfo['type'] = $sourceInfo['type'];

		list($src_x, $src_y) = explode(',', $startPos);
		list($clip_w, $clip_h) = explode(',', $clipSize);
		if($sourceInfo['width'] < $src_x + $clip_w or $sourceInfo['height'] < $src_y + $clip_h) {
			$clipInfo['width'] = $sourceInfo['width'] - $src_x;
			$clipInfo['height'] = $sourceInfo['height'] - $src_y;
		}
		else {
			$clipInfo['width'] = $clip_w;
			$clipInfo['height'] = $clip_h;
		}
		$clipInfo['src_x'] = $src_x;
		$clipInfo['src_x'] = $src_y;
		return $clipInfo;
	}

	private function clipImage($clipInfo, $sourceInfo) {
		if(!empty($this->imageError)) {
			return '';
		}

		$clipResource = imagecreatetruecolor($clipInfo['width'], $clipInfo['height']);
		$sourceResource = $this->get_imageResource($sourceInfo);

		//deal with transparent color
		$otsc = imagecolortransparent($sourceResource);
		if($otsc >= 0 && $otsc < imagecolorstotal($sourceResource)) {
			$TC = imagecolorsforindex($sourceResource, $otsc);
			$transColor = imagecolorallocate($clipResource, $TC['red'], $TC['green'], $TC['blue']);
			imagefill($clipResource, 0, 0, $transColor);
			imagecolortransparent($clipResource, $transColor);
		}

		imagecopyresampled($clipResource, $sourceResource, 0, 0, $clipInfo['src_x'], $clipInfo['src_y'], $clipInfo['width'], $clipInfo['height'], $clipInfo['width'], $clipInfo['height']);

		imagedestroy($sourceResource);
		return $clipResource;
	}

	private function output_image($outputResource, $outputInfo) {
		if(!empty($this->imageError)) {
			return '';
		}
		switch($outputInfo['type']) {
			case 'gif':
				imagegif($outputResource, $this->outputDir . $outputInfo['name']);
				break;
			case 'jpg':
				imagejpeg($outputResource, $this->outputDir . $outputInfo['name']);
				break;
			case 'png':
				imagepng($outputResource, $this->outputDir . $outputInfo['name']);
				break;
			default:
				imagejpeg($outputResource, $this->outputDir . $outputInfo['name']);
		}
		imagedestroy($outputResource);
		$outputInfo['size'] = filesize($this->outputDir . $outputInfo['name']);
		return $outputInfo;
	}

	/* convert color ffffff to array('r' => 255, 'g' => 255, 'b' => 255) */
	public static function convert_color($color) {
		$rgb = array();
		$rgb['r'] = hexdec(substr($color, 0, 2));
		$rgb['g'] = hexdec(substr($color, 2, 2));
		$rgb['b'] = hexdec(substr($color, 4, 2));
		return $rgb;
	}
}
/**
 * Usage: thumbnail
 * ----------------------------------------
 * $uploadDir = './upload/';
 * $outputDir = './output/';
 * $_aimage = new AImage(array('sourceDir' => $uploadDir, 'outputDir' => $outputDir));
 * $thumb = $_aimage->thumbnail($imageName, 300, 100, false);
 * echo "<img src=\"{$outputDir}{$thumb['name']}\" width={$thumb['width']} height={$thumb['height']} />";
 * $mark = $_aimage->mark($imageName, $waterfile, 9);
 * echo "<img src=\"{$outputDir}{$mark['name']}\" width={$mark['width']} height={$mark['height']} />";
 * $clip = $_aimage->clip($imageName, '10,10', '32,32');
 * echo "<img src=\"{$outputDir}{$clip['name']}\" width={$clip['width']} height={$clip['height']} />";
 */

?>
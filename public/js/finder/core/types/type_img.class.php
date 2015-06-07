<?php

/* @desc GD image detection class */

class type_img {
	public function checkFile($file, array $config) {
		$gd = new gd($file);
		if($gd->init_error) {
			return "Unknown image format/encoding.";
		}
		return true;
	}
}

?>
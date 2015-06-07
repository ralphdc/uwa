<?php

/**
 *--------------------------------------
 * build
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-22
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class BuildModl extends Modl {
	/* show progress. $barLength: % */
	public function show_progress($msg, $barLength = '50') {
		echo '<script>show_progress("' . $msg . '", "' . $barLength . '%");</script>';
		@ob_flush();
		@flush();
	}

	/* show direction */
	public function show_direction($nextUrl, $show = false, $timeout = 0) {
		if($show) {
			echo '<script>show_direction("' . $nextUrl . '")</script>';
		}
		echo '<script>window.setTimeout("window.location=\'' . $nextUrl . '\'", ' . $timeout * 1000 . ');</script>';
		@ob_flush();
		@flush();
	}
}

?>
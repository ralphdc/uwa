<?php

/**
 *--------------------------------------
 * default controller
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: created-time
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

class IndexCtrlr extends Ctrlr {
	public function index() {
		$this->display('index');

	}

	public function test() {
		P('type=' . ARequest::get('type'));
		P('id=' . ARequest::get('id'));
	}
}

?>
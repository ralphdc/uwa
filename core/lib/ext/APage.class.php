<?php

/**
 *--------------------------------------
 * paging
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class APage {
	protected $pageSize = 20; // rows per page
	protected $nearSize = 3; // nearsize to show
	protected $pageUrl = ''; // page base url
	protected $totalPages; // total page
	protected $totalRows; // total row
	protected $currentPage; // current page

	public function __construct($totalRows, $pageSize = '', $pageUrl = '', $nearSize = '') {
		$this->totalRows = $totalRows;
		if(!empty($pageSize)) {
			$this->pageSize = intval($pageSize);
		}
		if(!empty($nearSize)) {
			$this->nearSize = intval($nearSize);
		}
		if(!empty($pageUrl)) {
			$this->pageUrl = $pageUrl;
		}
		$this->totalPages = ceil($this->totalRows / $this->pageSize);
		$this->currentPage = isset($_GET[C('VAR.PAGE')]) ? ((intval($_GET[C('VAR.PAGE')]) <= $this->totalPages) ? intval($_GET[C('VAR.PAGE')]) : $this->totalPages) : 1;
	}

	public function __get($name) {
		return isset($this->$name) ? $this->$name : '';
	}

	public function get_paging() {
		$paging = array();

		if(0 == $this->totalRows) {
			return $paging;
		}
		/* first and last page */
		if(1 == $this->currentPage) {
			$paging['firstPage'] = array('page' => 1, 'url' => '');
		}
		else {
			$paging['firstPage'] = array('page' => 1, 'url' => $this->get_pageUrl(1));
		}
		if($this->totalPages == $this->currentPage) {
			$paging['lastPage'] = array('page' => $this->totalPages, 'url' => '');
		}
		else {
			$paging['lastPage'] = array('page' => $this->totalPages, 'url' => $this->get_pageUrl($this->totalPages));
		}
		/* previous and next page */
		$prevPage = $this->currentPage - 1;
		$nextPage = $this->currentPage + 1;
		if($prevPage > 0) {
			$paging['prevPage'] = array('page' => $prevPage, 'url' => $this->get_pageUrl($prevPage));
		}
		else {
			$paging['prevPage'] = array('page' => $prevPage, 'url' => '');
		}
		if($nextPage <= $this->totalPages) {
			$paging['nextPage'] = array('page' => $nextPage, 'url' => $this->get_pageUrl($nextPage));
		}
		else {
			$paging['nextPage'] = array('page' => $nextPage, 'url' => '');
		}
		/* current page and nearpage */
		$currentPage = '';
		for($i = $this->nearSize; $i > 0; $i--) {
			$_p = $this->currentPage - $i;
			if($_p > 0) {
				$paging['nearPrevPage'][] = array('page' => $_p, 'url' => $this->get_pageUrl($_p));
			}
		}
		$paging['currentPage'] = array('page' => $this->currentPage, 'url' => $this->get_pageUrl($this->currentPage));
		for($i = 1; $i < $this->nearSize + 1; $i++) {
			$_p = $this->currentPage + $i;
			if($_p <= $this->totalPages) {
				$paging['nearNextPage'][] = array('page' => $_p, 'url' => $this->get_pageUrl($_p));
			}
		}
		$paging['totalPages'] = $this->totalPages;
		$paging['totalRows'] = $this->totalRows;

		return $paging;
	}

	/* get limit string */
	public function get_limit() {
		return ($this->currentPage - 1) * $this->pageSize . ',' . $this->pageSize;
	}

	/* get paging url */
	private function get_pageUrl($page) {
		if('' != $this->pageUrl) {
			return str_replace("_page_", $page, $this->pageUrl);
		}
		$p = C('VAR.PAGE');
		parse_str($_SERVER['QUERY_STRING'], $argument);
		$argument[$p] = $page;
		return $url = $_SERVER['PHP_SELF'] . '?' . http_build_query($argument);
	}
}

/*---------------------------------------------------------*
$p = new APage($rowsNum, $pageSize, '?page=_page_'); //for parameter
$p = new APage($rowsNum, $pageSize, 'list-_page_.html'); //for html
$PAGING = $p->get_paging();
$limit = $p->get_limit();
*/

?>
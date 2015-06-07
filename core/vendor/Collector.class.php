<?php

/**
 *--------------------------------------
 * content collector (require Snoopy, AServer class support)
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2013-12-10
 * @copyright	: (c)AsThis
 *--------------------------------------
 */

set_time_limit(0);
class Collector {
	public $spider; // collector spider
	public $entry = array(); // entry address
	public $listSet = array(); // list rules
	public $fieldSet = array(); // field rules
	public $limit = 0; // collection page limit
	public $result = array(); // collect result
	public $headInfo = array(); // custom header information

	public function __construct($entry = array()) {
		$this->set_entry($entry);

		$this->spider = get_instance('Snoopy');
		$this->spider->sagent = $_SERVER['HTTP_USER_AGENT'];
		$this->spider->referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$this->spider->rawheaders['X_FORWARDED_FOR'] = AServer::get_ip();
		$this->spider->expandlinks = true;
	}

	public function collect() {
		$count = 1;
		foreach($this->entry as $entry) {
			/* parse the page range in entry address */
			if(preg_match("~\{(\d+),(\d+)\}~", $entry, $pageNum)) {
				$pageBegin = intval($pageNum[1]);
				$pageEnd = intval($pageNum[2]);
				for(; $pageBegin <= $pageEnd; $pageBegin++) {
					$entryNow = str_replace($pageNum[0], $pageBegin, $entry);
					foreach($this->listSet as $listSet) {
						$urlList = $this->get_list($listSet['pattern'], $this->get_content($entryNow));
						foreach($urlList as $url) {
							if(($this->limit > 0 && $count <= $this->limit) || $this->limit == 0) {
								$url = $this->convert_url($url, $entryNow);
								$this->collect_singlePage($url);
								$count++;
							}
						}
					}
				}
			}
			else {
				foreach($this->listSet as $listSet) {
					$urlList = $this->get_list($listSet['pattern'], $this->get_content($entry));
					foreach($urlList as $url) {
						if(($this->limit > 0 && $count <= $this->limit) || $this->limit == 0) {
							$url = $this->convert_url($url, $entry);
							$this->collect_singlePage($url);
							$count++;
						}
					}
				}
			}
		}
		return $this->result;
	}

	public function collect_singlePage($url) {
		$result = array();
		foreach($this->fieldSet as $field => $fieldInfo) {
			$result[$field] = $this->get_field($fieldInfo, $this->get_content($url));
		}
		$this->result[] = $result;
		return $this->result;
	}

	public function set_entry($entry = '') {
		if(is_array($entry)) {
			$this->entry = $entry;
		}
		elseif(is_string($entry)) {
			$this->entry = array($entry);
		}
	}

	public function add_entry($entry = '') {
		if(is_array($entry)) {
			$this->entry = array_merge($this->entry, $entry);
		}
		elseif(is_string($entry)) {
			$this->entry[] = $entry;
		}
	}

	public function add_listSet($pattern, $tag = 'list') {
		$this->listSet[] = array('tag' => $tag, 'pattern' => $pattern);
	}

	public function add_fieldSet($field, $pattern, $matchAll = false, $replace = array(), $isRegular = false, $nextpage = '') {
		$this->fieldSet[$field] = array(
			'field' => $field,
			'pattern' => $pattern,
			'matchAll' => $matchAll,
			'replace' => $replace,
			'isRegular' => $isRegular,
			'nextpage' => $nextpage);
	}

	public function get_list($pattern = '', $content = '') {
		if(strpos($pattern, '{*}') === false) {
			return array($pattern);
		}
		$pattern = preg_quote($pattern);
		$pattern = str_replace('\{\*\}', '([^\'\">]*)', $pattern);
		$pattern = "~" . $pattern . "~is";
		preg_match_all($pattern, $content, $pregResult);
		return array_unique($pregResult[0]);
	}

	/* get html content */
	public function get_content($url) {
		$this->spider->fetch($url);
		return $this->spider->results;
	}

	public function get_field($fieldInfo, $content) {
		/* return fixed values */
		if(strpos($fieldInfo['pattern'], '{' . $fieldInfo['field'] . '}') === false) {
			return $fieldInfo['pattern'];
		}

		if($fieldInfo['isRegular']) {
			$pattern = str_replace('{' . $fieldInfo['field'] . '}', '(?P<' . $fieldInfo['field'] . '>.*?)', $fieldInfo['pattern']);
		}
		else {
			$pattern = preg_quote($fieldInfo['pattern']);
			$pattern = str_replace('\{' . $fieldInfo['field'] . '\}', '(?P<' . $fieldInfo['field'] . '>.*?)', $pattern);
		}
		$pattern = "~" . $pattern . "~is";

		if($fieldInfo['matchAll']) {
			preg_match_all($pattern, $content, $pregResult);
		}
		else {
			preg_match($pattern, $content, $pregResult);
		}
		$fieldResult = $pregResult[$fieldInfo['field']];
		$fieldResult = preg_replace("~[\r\n]*~is", '', $fieldResult); // remove line breaks

		/* replace content */
		$replaceArr = $fieldInfo['replace'];
		if(is_array($replaceArr) && !empty($replaceArr)) {
			$replaceArr[0] = "~" . $replaceArr[0] . "~s";
			$fieldResult = preg_replace($replaceArr[0], $replaceArr[1], $fieldResult);
		}

		/* recursive collect next page */
		if($fieldInfo['nextpage'] != '') {
			$pattern = $fieldInfo['nextpage'];
			$pattern = str_replace('{nextpage}', '(?P[^\'\">]*?)', $pattern);
			$pattern = "~" . $pattern . "~is";
			if(preg_match($pattern, $content, $pregResult) && $pregResult['nextpage'] != '') {
				$fieldResult .= $this->get_field($fieldInfo, $this->get_content($pregResult['nextpage'], $this->httpReferer));
			}
		}
		return $fieldResult;
	}

	public function convert_url($url, $referer) {
		/* remove behind '#' */
		$pos = strpos($url, '#');
		if($pos > 0) {
			$url = substr($url, 0, $pos);
		}
		/* if it is an absolute address, directly back */
		if(preg_match("~^(http|ftp)://~i", $url)) {
			return $url;
		}
		/* parse referer address, get protocol, host etc. */
		preg_match("~((http|ftp)://([^/]*)(.*/))([^/#]*)~i", $referer, $pergResult);
		$parentdir = $pergResult[1];
		$petrol = $pergResult[2] . '://';
		$host = $pergResult[3];
		/* begin with '/' */
		if(preg_match("~^/~i", $url)) {
			return $petrol . $host . $url;
		}
		return $parentdir . $url;
	}

}

/**
 * Usage 1
 * --------------------------------------------------------------------------
 * $spider = get_instance('Collector');
 * $spider->limit = 2;

 * $spider->add_entry('http://www.onlinedown.net/hits/week_{1,2}.htm');
 * $spider->add_listSet('../soft/{*}.htm','list');
 * $spider->add_fieldSet('title', '<title>{title}</title>', false, array('华军软件园', '如斯信息网'));
 * $spider->add_fieldSet('author','cblee');
 * $a = $spider->collect();
 * P($a);

 * Usage 2
 * -----------------------------------------------------------------------------
 * $spider = get_instance('Collector');
 * $url = 'http://tr.asthis.net/';
 * $spider->add_fieldSet('title', '<title>{title}</title>', false, array('如斯', 'AsThis'));
 * $spider->add_fieldSet('syno', '<th><a href="\S+">{syno}</a>', true, '',true);
 * $spider->add_fieldSet('author','cblee');
 * $a = $spider->collect_singlePage($url);
 * P($a);

 */

?>
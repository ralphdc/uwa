<?php

/**
 *--------------------------------------
 * ATag
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-10-1
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class ATag {
	protected $namespace;
	protected $markLeft;
	protected $markRight;
	public $tags = array();

	public function __construct($namespace, $markLeft = '<', $markRight = '>') {
		$this->namespace = $namespace;
		$this->markLeft = $markLeft;
		$this->markRight = $markRight;
	}

	public function parse_content($content) {
		$patt = $this->markLeft . $this->namespace . ':(.+?)' . $this->markRight;
		preg_match_all("/{$patt}/eis", $content, $tags);
		if(is_array($tags[1])) {
			$pattEnd = $this->markLeft . '\/' . $this->namespace . ':(\S+)' . $this->markRight;
			preg_match_all("/{$pattEnd}/eis", $content, $tagsEnd);
			if(count($tags[1]) != count($tagsEnd[1])) {
				halt(L('_TPL_TAG_ERROR_'));
			}
			foreach($tags[1] as $t) {
				$this->parse_tag($t);
			}
		}
	}

	protected function parse_tag($params) {
		$params = explode(' ', $params, 2);
		$params[1] = $params[1] . ' ';
		preg_match_all('/.*?(\s*.*?=.*?[\"|\'].*?[\"|\']\s).*?/si', $params[1], $arr);
		$a = array();
		$tagName = $params[0];
		if(isset($arr[1]) && !empty($arr[1])) {
			foreach($arr[1] as $v) {
				$t = explode('=', trim(str_replace(array('"', "'"), '', $v)));
				$a = array_merge($a, array(trim($t[0]) => trim($t[1])));
			}
		}
		$this->tags[$tagName] = $a;
	}

	public function add_tag($tag) {
		$this->tags = array_merge($this->tags, $tag);
	}

	public function get_tag($tagName) {
		if(isset($this->tags[$tagName])) {
			return $this->tags[$tagName];
		}
		return '';
	}

	public function delete_tag($tagName) {
		if(isset($this->tags[$tagName])) {
			unset($this->tags[$tagName]);
			return true;
		}
		return false;
	}

	public function deparse_tag($tags) {
		$content = '';
		foreach($tags as $tag => $params) {
			$content .= $this->markLeft . $this->namespace . ':' . $tag . ' ';
			foreach($params as $k => $v) {
				$content .= $k . '="' . $v . '" ';
			}
			$content .= $this->markRight . "\r\n" . $this->markLeft . '/' . $this->namespace . ':' . $tag . $this->markRight . "\r\n";
		}
		$content = rtrim($content);
		return $content;
	}

}

?>
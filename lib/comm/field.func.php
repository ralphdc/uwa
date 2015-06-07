<?php

/**
 *--------------------------------------
 * field function library
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-2
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

/* get field build SQL */
function get_fieldMakeSQL($f_type, $f_name, $f_default, $f_length, $f_item_name) {
	$fields = '';
	if('simpletext' == $f_type) {
		if(empty($f_default)) {
			$f_default = '';
		}
		if(empty($f_length)) {
			$f_length = 96;
		}
		if($f_length <= 255) {
			$fields = " `{$f_name}` varchar({$f_length}) NOT NULL DEFAULT '{$f_default}' COMMENT '{$f_item_name}'";
		}
		else {
			$fields = " `{$f_name}` text NOT NULL COMMENT '{$f_item_name}'";
		}
	}
	elseif('multitext' == $f_type) {
		$fields = " `{$f_name}` text NOT NULL COMMENT '{$f_item_name}'";
	}
	elseif('htmltext' == $f_type) {
		$fields = " `{$f_name}` mediumtext NOT NULL COMMENT '{$f_item_name}'";
	}
	elseif('int' == $f_type or 'datetime' == $f_type) {
		if(empty($f_default) or preg_match('#[^0-9-]#', $f_default)) {
			$f_default = 0;
		}
		$fields = " `{$f_name}` int(11) NOT NULL default '{$f_default}' COMMENT '{$f_item_name}'";
	}
	elseif('decimal' == $f_type) {
		if(empty($f_default) or preg_match("#[^0-9\.-]#", $f_default)) {
			$f_default = 0;
		}
		if(empty($f_length)) {
			$f_length = '10,2';
		}
		$fields = " `{$f_name}` decimal({$f_length}) NOT NULL default '{$f_default}' COMMENT '{$f_item_name}'";
	}
	elseif('select' == $f_type or 'radio' == $f_type ) {
		if(!empty($f_default)) {
			$f_comment = $f_default;
			$_t = explode(',', $f_default);
			$f_set = '';
			$f_default = '';
			foreach($_t as $k => $v) {
				$_t1 = explode('|', $v);
				$f_set .= "'" . $_t1[0] . "',";
				if(0 == $k) {
					$f_default = $_t1[0];
				}
			}
			$f_set = rtrim($f_set, ',');
			$fields = " `{$f_name}` enum({$f_set}) NOT NULL DEFAULT '{$f_default}' COMMENT '{$f_item_name}:{$f_comment}'";
		}
	}
	elseif('checkbox' == $f_type) {
		if(!empty($f_default)) {
			$f_comment = $f_default;
			$_t = explode(',', $f_default);
			$f_set = '';
			$f_default = '';
			foreach($_t as $k => $v) {
				$_t1 = explode('|', $v);
				$f_set .= "'" . $_t1[0] . "',";
				if(0 == $k) {
					$f_default = $_t1[0];
				}
			}
			$f_set = rtrim($f_set, ',');
			$fields = " `{$f_name}` set({$f_set}) NOT NULL DEFAULT '{$f_default}' COMMENT '{$f_item_name}:{$f_comment}'";
		}
	}
	elseif('img' == $f_type or 'addon' == $f_type) {
		if(empty($f_default)) {
			$f_default = '';
		}
		if(empty($f_length)) {
			$f_length = 96;
		}
		if($f_length <= 255) {
			$fields = " `{$f_name}` varchar({$f_length}) NOT NULL DEFAULT '{$f_default}' COMMENT '{$f_item_name}'";
		}
		else {
			$fields = " `{$f_name}` text NOT NULL COMMENT '{$f_item_name}'";
		}
	}
	elseif('linkage' == $f_type) {
		if(empty($f_default) or preg_match('#[^0-9-]#', $f_default)) {
			$f_default = 0;
		}
		$fields = " `{$f_name}` int(11) NOT NULL default '{$f_default}' COMMENT '{$f_item_name}'";
	}
	return $fields;
}

/* get field value for save */
function get_fieldValue($tag, $params, $data) {
	if(!isset($data[$tag])) {
		return '';
	}
	if('simpletext' == $params['f_type']) {
		if(MAGIC_QUOTES_GPC) {
			$fieldValue = addslashes(AFilter::plain_text(stripslashes(strval($data[$tag]))));
		}
		else {
			$fieldValue = AFilter::plain_text(strval($data[$tag]));
		}
	}
	elseif('multitext' == $params['f_type']) {
		if(1 == $params['f_is_serialize']) {
			$fieldValue = serialize($data[$tag]);
			if(MAGIC_QUOTES_GPC) {
				$fieldValue = addslashes($fieldValue);
			}
		}
		else {
			$fieldValue = AFilter::text(strval($data[$tag]));
		}
	}
	elseif('htmltext' == $params['f_type']) {
		if(MAGIC_QUOTES_GPC) {
			$fieldValue = addslashes(AFilter::remove_XSS(AFilter::safeHtml(stripslashes(strval($data[$tag])), M('Option')->get_option('interaction/allow_tags'))));
		}
		else {
			$fieldValue = AFilter::remove_XSS(AFilter::safeHtml(strval($data[$tag]), M('Option')->get_option('interaction/allow_tags')));
		}
	}
	elseif('int' == $params['f_type']) {
		$fieldValue = intval($data[$tag]);
	}
	elseif('decimal' == $params['f_type']) {
		$fieldValue = floatval($data[$tag]);
	}
	elseif('datetime' == $params['f_type']) {
		$fieldValue = intval(strtotime($data[$tag]));
	}
	elseif('select' == $params['f_type']) {
		if(MAGIC_QUOTES_GPC) {
			$fieldValue = addslashes(AFilter::text(stripslashes($data[$tag])));
		}
		else {
			$fieldValue = AFilter::text(strval($data[$tag]));
		}
	}
	elseif('radio' == $params['f_type']) {
		if(MAGIC_QUOTES_GPC) {
			$fieldValue = addslashes(AFilter::text(stripslashes($data[$tag])));
		}
		else {
			$fieldValue = AFilter::text(strval($data[$tag]));
		}
	}
	elseif('checkbox' == $params['f_type']) {
		if(MAGIC_QUOTES_GPC) {
			$fieldValue = addslashes(AFilter::text(stripslashes(implode(',', $data[$tag]))));
		}
		else {
			$fieldValue = AFilter::text(implode(',', $data[$tag]));
		}
	}
	elseif('img' == $params['f_type'] or 'addon' == $params['f_type']) {
		if(1 == $params['f_is_serialize']) {
			$fieldValue = serialize($data[$tag]);
			if(MAGIC_QUOTES_GPC) {
				$fieldValue = addslashes($fieldValue);
			}
		}
		else {
			$fieldValue = AFilter::text(strval($data[$tag]));
		}
	}
	elseif('linkage' == $params['f_type']) {
		$fieldValue = intval($data[$tag]);
	}
	return $fieldValue;
}

/* deal with field value for edit and output */
function deal_fieldValue($fieldValue, $params, $output = false) {
	if(isset($params['f_is_serialize']) and 1 == $params['f_is_serialize']) {
		$fieldValue = unserialize($fieldValue);
		if(MAGIC_QUOTES_GPC) {
			$fieldValue = stripslashes_array($fieldValue);
		}
	}

	/* deal for output */
	if($output) {
		$fieldValue = deal_fieldOutput($fieldValue, $params);
	}
	return $fieldValue;
}

/* deal output */
function deal_fieldOutput($fieldValue, $params) {
	if('simpletext' == $params['f_type']) {
		if(1 == $params['f_is_filter']) {
			$fieldValue = M('Report')->filter_content($fieldValue);
		}
	}
	elseif('multitext' == $params['f_type']) {
		if(1 == $params['f_is_filter']) {
			$fieldValue = M('Report')->filter_content($fieldValue);
		}
	}
	elseif('htmltext' == $params['f_type']) {
		/* deal with inlink */
		$_o_inlink = get_extensionOption('inlink');
		if($_o_inlink['switch']) {
			if($_o_inlink['rand']) {
				$_IL = M('Inlink')->get_inlinkList($_o_inlink['limit'], true);
			}
			else {
				$_IL = S('_INLINK_LIST');
				if(empty($_IL)) {
					$_IL = M('Inlink')->get_inlinkList($_o_inlink['limit']);
					S('_INLINK_LIST', $_IL);
				}
			}
			if(!empty($_IL)) {
				foreach($_IL as $il) {
					$fieldValue = str_replace($il['il_word'], '<a href="' . $il['il_url'] . '" target="' . $il['il_target'] . '" title="' . $il['il_title'] . '">' . $il['il_word'] . '</a>', $fieldValue);
				}
			}
		}
		/* deal with filter */
		if(1 == $params['f_is_filter']) {
			$fieldValue = M('Report')->filter_content($fieldValue);
		}
	}
	elseif('int' == $params['f_type']) {
	}
	elseif('decimal' == $params['f_type']) {
	}
	elseif('datetime' == $params['f_type']) {
		$fieldValue = date($params['f_datetime_format'], $fieldValue);
	}
	elseif('select' == $params['f_type'] or 'radio' == $params['f_type']) {
		$_fv = array();
		$_t = explode(',', $params['f_default']);
		if(!empty($_t)) {
			foreach($_t as $v) {
				$_t1 = explode('|', $v);
				$_fv[$_t1[0]] = $_t1[1];
			}
		}
		/* key */
		if(1 == $params['f_select_show_type']) {
		}
		/* value */
		elseif(2 == $params['f_select_show_type']) {
			$fieldValue = $_fv[$fieldValue];
		}
	}
	elseif('checkbox' == $params['f_type']) {
		$_fv = array();
		$_t = explode(',', $params['f_default']);
		if(!empty($_t)) {
			foreach($_t as $v) {
				$_t1 = explode('|', $v);
				$_fv[$_t1[0]] = $_t1[1];
			}
		}
		/* key */
		if(1 == $params['f_select_show_type']) {
		}
		/* value */
		elseif(2 == $params['f_select_show_type']) {
			$fv = '';
			$_t2 = explode(',', $fieldValue);
			if(!empty($_t2)) {
				foreach($_t2 as $v2) {
					$fv .= $_fv[$v2] . $params['f_select_separator'];
				}
			}
			$fieldValue = substr($fv, 0, (0 - strlen($params['f_select_separator'])));
		}
	}
	elseif('img' == $params['f_type']) {
	}
	elseif('addon' == $params['f_type']) {
	}
	elseif('linkage' == $params['f_type']) {
		$fieldValue = M('LinkageItem')->output_item($fieldValue, $params['f_linkage_show_type'], $params['f_linkage_path_separator']);
	}
	return $fieldValue;
}

?>
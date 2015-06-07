<?php

/**
 *--------------------------------------
 * uwa:a_list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-02-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagUwaAList {
	public function get_tagStr($a) {
		$aid = "aid";
		$cid = "cid";
		$issub = 'no';
		$flag = 'flag';
		$days = 'days';
		$keywords = 'keywords';
		$orderby = 'orderby';
		$offset = 0;
		$row = 10;
		$titleLenStr = '';
		$key = 'k';
		$as = 'item';

		$where = "	\$where = array();\r\n";

		/* direct read archive id  */
		if(isset($a['aid']) and !empty($a['aid'])) {
			if(strpos($aid, ',')) {
				$where .= "	\$where['__ARCHIVE__.archive_id'] = array('IN', '{$a['aid']}');\r\n";
				$aid = str_replace(',', 'uwa', $aid);
			}
			else {
				if(strpos($a['aid'], '$')) {
					$where .= "	if(!empty(" . substr($a['aid'], 2, -2) . ")) {\r\n";
					$where .= "		\$where['__ARCHIVE__.archive_id'] = array('IN', '{$a['aid']}');\r\n";
					$where .= "	}\r\n";
				}
				else {
					$where .= "	\$where['__ARCHIVE__.archive_id'] = array('IN', '{$a['aid']}');\r\n";
				}
				$aid = $a['aid'];
			}
		}
		else {
			$where = "	\$where = array();\r\n";
			$where .= "	\$where['__ARCHIVE__.a_status'] = array('EQ', 1);\r\n";
			/* channel id */
			if(!isset($a['cid']) or empty($a['cid'])) {
				if(isset($a['issub']) and 'yes' == $a['issub']) { /* as sub cycle */
					$cid = "'.C('AC_ID').'";
					$issub = 'yes';
				}
				else {
					$cid = "'.(isset(\$AC_ID) ? \$AC_ID : 0).'";
				}
			}
			elseif('all' == $a['cid']) {
				$cid = 0;
			}
			else {
				if(strpos($a['cid'], '$')) {
					$cid = "'.(!empty(" . substr($a['cid'], 2, -2) . ") ? '{$a['cid']}' : 0).'";
				}
				else {
					$cid = $a['cid'];
				}
			}

			if(strpos($cid, ',')) {
				$where .= "	\$where['__ARCHIVE__.archive_channel_id'] = array('IN', '{$cid}');\r\n";
				$cid = str_replace(',', 'uwa', $cid);
			}
			elseif('all' != $cid) {
				$where .= "\$_aci = M('ArchiveChannel')->get_channelInfo('{$cid}');\r\n";
				$where .= "C('AM_ID', \$_aci['archive_model_id']);\r\n";
				$where .= "\$_ACL = M('ArchiveChannel')->get_channelList(0, '{$cid}');\r\n";
				$where .= "\$act = new ATree(\$_ACL, array('archive_channel_id', 'ac_parent_id', 'ac_sub_channel'), '{$cid}');\r\n";
				$where .= "	\$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', \$act->get_leafid('{$cid}')));\r\n";
			}

			/* archive flag */
			if(isset($a['flag']) and !empty($a['flag'])) {
				if(strpos($a['flag'], '$')) {
					$where .= "	if(!empty(" . substr($a['flag'], 2, -2) . ")) {\r\n";
					$where .= "		\$where['__ARCHIVE__.af_alias'] = array('INSET', '{$a['flag']}');\r\n";
					$where .= "	}\r\n";
				}
				else {
					$where .= "	\$where['__ARCHIVE__.af_alias'] = array('INSET', '{$a['flag']}');\r\n";
				}
				$flag = str_replace(array('|', '&'), array('_or_', '_and_'), $a['flag']);
			}
			/* time limit */
			if(isset($a['days']) and !empty($a['days'])) {
				if(strpos($a['days'], '$')) {
					$where .= "	if(0 < " . substr($a['days'], 2, -2) . ") {\r\n";
					$where .= "		\$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400*('{$a['days']}'));\r\n";
					$where .= "	}\r\n";
				}
				else {
					$where .= "	\$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400*('{$a['days']}'));\r\n";
				}
				$days = $a['days'];
			}
			/* keyword */
			if(isset($a['keywords']) and !empty($a['keywords'])) {
				if(strpos($a['a_keywords'], '$')) {
					$where .= "	if(!empty(" . substr($a['a_keywords'], 2, -2) . ")) {\r\n";
					$where .= "		\$where['__ARCHIVE__.a_keywords'] = array('LIKE', '%{$a['keywords']}%');\r\n";
					$where .= "	}\r\n";
				}
				else {
					$where .= "	\$where['__ARCHIVE__.a_keywords'] = array('LIKE', '%{$a['keywords']}%');\r\n";
				}
				vendor('Pinyin#class');
				$pyc = get_instance('Pinyin');
				$keywords = $pyc->get_pinyin($a['keywords'], 'utf-8');
			}
		}

		/* order by */
		if(isset($a['orderby']) and !empty($a['orderby'])) {
			if(strpos($a['orderby'], '$')) {
				$order = "'.(!empty(" . substr($a['orderby'], 2, -2) . ") ? '`{$a['orderby']}`' : '`a_edit_time`').'";
			}
			else {
				$order = "`{$a['orderby']}`";
			}
			if(isset($a['order']) and !empty($a['order'])) {
				$order .= " {$a['order']}";
				$orderby = $a['orderby'] . '_' . $a['order'];
			}
			else {
				$orderby = $a['orderby'] . '_order';
			}
		}
		if(empty($order)) {
			$order = '`a_rank` DESC, `a_edit_time` DESC';
		}

		/* limit strat row */
		if(isset($a['offset']) and !empty($a['offset'])) {
			if(strpos($a['offset'], '$')) {
				$offset = "'.(!empty(" . substr($a['offset'], 2, -2) . ") ? '{$a['offset']}' : '{$offset}').'";
			}
			else {
				$offset = $a['offset'];
			}
		}

		/* row */
		if(isset($a['row']) and !empty($a['row'])) {
			if(strpos($a['row'], '$')) {
				$row = "'.(!empty(" . substr($a['row'], 2, -2) . ") ? '{$a['row']}' : '{$row}').'";
			}
			else {
				$row = $a['row'];
			}
		}

		/* title length */
		if(isset($a['titlelen']) and !empty($a['titlelen'])) {
			if(strpos($a['titlelen'], '$')) {
				$titleLenStr .= "if(!empty(" . substr($a['titlelen'], 2, -2) . ")) {\r\n";
				$titleLenStr .= "	\$item['a_title'] = AString::utf8_substr(\$item['a_title'], '{$a['titlelen']}')\r\n";
				$titleLenStr .= "}\r\n";
			}
			else {
				$titleLenStr = "\$item['a_title'] = AString::utf8_substr(\$item['a_title'], '{$a['titlelen']}')\r\n";
			}
		}

		/* key */
		if(isset($a['key']) and !empty($a['key'])) {
			if(strpos($a['key'], '$')) {
				$key = "'.(!empty(" . substr($a['key'], 2, -2) . ") ? '{$a['key']}' : '{$key}').'";
			}
			else {
				$key = $a['key'];
			}
		}

		/* as */
		if(isset($a['as']) and !empty($a['as'])) {
			if(strpos($a['as'], '$')) {
				$as = "'.(!empty(" . substr($a['as'], 2, -2) . ") ? '{$a['as']}' : '{$as}').'";
			}
			else {
				$as = $a['as'];
			}
		}

		$str = "<?php\r\n";
		$str .= "\$var_a = '_a_list_{$aid}_{$cid}_{$issub}_{$flag}_{$days}_{$keywords}_{$orderby}_{$offset}_{$row}';\r\n";
		$str .= "\$\$var_a = S('~list/~'.ltrim(\$var_a, '_'));\r\n";
		$str .= "if(empty(\$\$var_a)) {\r\n";
		$str .= $where;
		$str .= "	\$\$var_a = M('Archive')->get_archiveList(\$where, '{$order}', '{$offset},{$row}', C('AM_ID'), true);\r\n";
		/* random archive list cache 60s */
		if('random' == $a['orderby']) {
			$str .= "	S('~list/~'.ltrim(\$var_a, '_'), \$\$var_a, 60);\r\n";
		}
		else {
			$str .= "	S('~list/~'.ltrim(\$var_a, '_'), \$\$var_a);\r\n";
		}
		$str .= "}\r\n";
		$str .= "if(\$\$var_a) : foreach(\$\$var_a as \${$key} => \${$as}): \r\n";
		$str .= $titleLenStr;
		$str .= "?>\r\n";
		return $str;
	}

	public function get_tagEndStr() {
		$str = "<?php endforeach; endif; ?>\r\n";
		return $str;
	}
}

?>
<?php

/**
 *--------------------------------------
 * Tag
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-05-28
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TagCtrlr extends IndexCtrlr {
	public function index() {
		$_o = get_extensionOption('tag');
		if(!$_o['switch']) {
			$this->error(L('TAG_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@tag/index');

		$_TL = S('_TAG_LIST');
		if(empty($_TL)) {
			$_o_tag = get_extensionOption('tag');
			$_TL = array();
			$_TL['latest'] = M('Tag')->get_tagList('', '`t_add_time` DESC', $_o_tag['item_latest']);
			$_TL['most_archive'] = M('Tag')->get_tagList('', '`t_archive_count` DESC', $_o_tag['item_most_archive']);
			$_TL['most_view'] = M('Tag')->get_tagList('', '`t_view_count` DESC', $_o_tag['item_most_view']);
			$_TL['most_view_7d'] = M('Tag')->get_tagList('`t_add_time` > ' . (time() - 7 * 86400), '`t_view_count` DESC', $_o_tag['item_most_view_7d']);
			S('_TAG_LIST', $_TL);
		}

		$this->assign('_L', $_TL);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('TAG'), 'url' => ''))
		);
		$this->display('home/index_tag');
	}

	public function show_tag() {
		$_o = get_extensionOption('tag');
		if(!$_o['switch']) {
			$this->error(L('TAG_IS_OFF'), __APP__);
		}

		$this->assign('_GCAP', 'home@tag/index');

		$tName = trim(AFilter::keyword(ARequest::get('t_name')));
		$_TI = M('Tag')->get_tagInfo($tName, true);
		if(empty($_TI)) {
			halt('', true, true);
		}
		$this->assign('_V', $_TI);

		$_o_tag = get_extensionOption('tag');

		$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		$where['__ARCHIVE__.archive_id'] = array('IN', $_TI['t_related_archive']);

		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, $_o_tag['page_size'], Url::U('tag/show_tag?t_name=' . $tName . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, '`a_add_time` DESC', $limit);
		$this->assign('_L', $_AL);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => L('TAG'), 'url' => Url::U('tag/index')),
			array('name' => $_TI['t_name'], 'url' => ''))
		);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/show_tag');
		}
		else {
			$this->display('home/show_tag');
		}
	}

	/* get count */
	public function get_count() {
		$_o = get_extensionOption('tag');
		if(!$_o['switch']) {
			exit;
		}

		$tagId = intval(ARequest::get('tag_id'));
		$type = ARequest::get('type');
		if('view' == $type) {
			M('Tag')->where(array('tag_id' => array('EQ', $tagId)))->field_inc('t_view_count');
			$count = M('Tag')->where(array('tag_id' => array('EQ', $tagId)))->get_field('t_view_count');
			echo "document.write('{$count}');";
			exit;
		}
	}
}

?>
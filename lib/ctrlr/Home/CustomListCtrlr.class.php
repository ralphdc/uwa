<?php

/**
 *--------------------------------------
 * custom list
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2014-06-03
 * @copyright	: (c)2014 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class CustomListCtrlr extends IndexCtrlr {
	public function show_custom_list() {
		$customListId = intval(ARequest::get('custom_list_id'));

		$_CLI = M('CustomList')->get_customListInfo($customListId);
		if(empty($_CLI)) {
			halt('', true, true);
		}

		$this->assign('_GCAP', 'home@custom_list/show_custom_list?custom_list_id=' . $customListId);

		$this->assign('_CP', array(
			array('name' => L('HOME'), 'url' => __APP__),
			array('name' => $_CLI['cl_title'], 'url' => ''))
		);

		$where = array();
		$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		/* cid */
		$cid = $_CLI['cl_config']['cid'];
		if(strpos($_CLI['cl_config']['cid'], ',')) {
			$where['__ARCHIVE__.archive_channel_id'] = array('IN', $cid);
		}
		else {
			if('all' == $cid or empty($cid)) {
				$cid = 0;
				$_CLI['cl_config']['cid'] = 0;
			}
			$_ACL = M('ArchiveChannel')->get_channelList(0, $cid);
			$act = new ATree($_ACL, array(
				'archive_channel_id',
				'ac_parent_id',
				'ac_sub_channel'), $cid);
			$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid($cid)));
		}
		/* flag */
		if(!empty($_CLI['cl_config']['flag'])) {
			$where['__ARCHIVE__.af_alias'] = array('INSET', $_CLI['cl_config']['flag']);
		}
		/* days */
		if(!empty($_CLI['cl_config']['days'])) {
			$where['__ARCHIVE__.a_edit_time'] = array('GT', time() - 86400 * $_CLI['cl_config']['days']);
		}
		/* keywords */
		if(!empty($_CLI['cl_config']['keywords'])) {
			$where['__ARCHIVE__.a_keywords'] = array('LIKE', '%' . $_CLI['cl_config']['keywords'] . '%');
		}
		/* get paging */
		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? ($_CLI['cl_config']['max_page'] < intval(ARequest::get(C('VAR.PAGE'))) ? $_CLI['cl_config']['max_page'] : intval(ARequest::get(C('VAR.PAGE')))) : 1;
		$rowsNum = M('Archive')->where($where)->count();
		$p = new APage($rowsNum, $_CLI['cl_config']['row'], Url::U('custom_list/show_custom_list?custom_list_id=' . $customListId . '&' . C('VAR.PAGE') . '=_page_'));
		$this->assign('PAGING', $p->get_paging());
		$limit = explode(',', $p->get_limit());
		$_CLI['cl_config']['offset'] = $limit[0];

		$this->assign('_V', $_CLI);

		if('clip' == ARequest::get('type')) {
			$this->display('home/clip/' . $_CLI['cl_tpl'], 'utf-8', $_CLI['cl_content_type']);
		}
		else {
			$this->display('home/' . $_CLI['cl_tpl'], 'utf-8', $_CLI['cl_content_type']);
		}
	}
}

?>
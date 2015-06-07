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

class BuildCtrlr extends ManageCtrlr {
	public function clear_cache() {
		$nextUrl = F('~cache_next_url', '', RUNTIME_PATH);
		$this->assign('nextUrl', $nextUrl);

		$this->display();
	}
	public function clear_cache_do() {
		/* get file list*/
		$fileList = F('~cache_list', '', RUNTIME_PATH);
		if(empty($fileList)) {
			$type = ARequest::get('type');
			$type = is_array($type) ? $type : explode(',', $type);
			$_L_ID = implode(', ', $type);

			if(empty($type)) {
				$this->error(L('INPUT_NO_EMPTY'), Url::U('build/clear_cache'));
			}

			M('AdminLog')->add_log(ASession::get('m_userid'), L('CLEAR_CACHE') . ': TYPE[' . $_L_ID . ']');

			$fileList = array();
			foreach($type as $type) {
				switch($type) {
					case 'runtime':
						$fileList[] = RUNTIME_PATH . D_S . '~runtime.php';
						break;
					case 'cache':
						$fileList = array_merge($fileList, get_fileList(CACHE_PATH));
						break;
					case 'data':
						$fileList = array_merge($fileList, get_fileList(DATA_PATH));
						break;
					case 'temp':
						if('File' == C('CACHE.TYPE')) {
							$fileList = array_merge($fileList, get_fileList(TEMP_PATH));
						}
						else {
							$cache = Cache::connect();
							$cache->clear();
						}
						break;
					case 'js':
						$fileList = array_merge($fileList, get_fileList(RUNTIME_PATH . D_S . 'js'));
						break;
				}
			}
			F('~cache_list', $fileList, RUNTIME_PATH);
		}

		set_time_limit(99999999);
		$this->display('admin/build/progress');

		$totalRows = F('~cache_file_count', '', RUNTIME_PATH);
 		/* archive count */
		if(empty($totalRows)) {
			$totalRows = count($fileList);
			F('~cache_file_count', $totalRows, RUNTIME_PATH);
		}
		$pageSize = ARequest::get('page_size') ? ARequest::get('page_size') : 50;
		$currentPage = ARequest::get('current_page') ? ARequest::get('current_page') : 1;
		$totalPage = ceil($totalRows / $pageSize);
		$limitMin = ($currentPage - 1) * $pageSize;
		$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;

		/* delete file */
		foreach($fileList as $key => $file) {
			if($key >= $limitMin and $key < $limitMax) {
				if('index.html' != substr($file, -10)) {
					@unlink($file);
				}
			}
			continue;
		}

		/* progress and next page */
		if($currentPage < $totalPage) {
			$progress = round(($currentPage * $pageSize) / $totalRows * 100, 1);
			$nextUrl = Url::U('build/clear_cache_do?page_size=' . $pageSize . '&current_page=' . ($currentPage + 1));
			F('~cache_next_url', $nextUrl, RUNTIME_PATH);
			M('Build')->show_progress($progress . '% [' . ($currentPage * $pageSize) . '/' . $totalRows . ']: ' . L('CLEAR_CACHE'), $progress);
			M('Build')->show_direction($nextUrl);
		}
		else {
			$nextUrl = Url::U('build/clear_cache');
			F('~cache_next_url', null, RUNTIME_PATH);
			F('~cache_file_count', null, RUNTIME_PATH);
			F('~cache_list', null, RUNTIME_PATH);
			M('Build')->show_progress('100% [' . $totalRows . '/' . $totalRows . ']: ' . L('CLEAR_CACHE_COMPLETE'), 100);
			set_time_limit(30);
			M('Build')->show_direction(Url::U('build/clear_cache'), true, 1);
		}
	}

	/* build guide */
	public function build_guide() {
		$nextUrl = F('~build/~next_url');
		$this->assign('nextUrl', $nextUrl);

		$_ACL = M('ArchiveChannel')->get_myChannelList();
		$act = new ATree($_ACL, array(
			'archive_channel_id',
			'ac_parent_id',
			'ac_sub_channel'));
		$_ACLStr = $act->get_leafStr(0, "<option value='\$archive_channel_id'>\$spacer \$ac_name</option>\r\n");
		$this->assign('_ACLStr', $_ACLStr);

		$this->display();
	}

	/* build all[archive channel, archive, home index] */
	public function build_all_do() {
		set_time_limit(99999999);
		$this->display('admin/build/progress');

		$_o = M('Option')->get_option('core');

		$acId = F('~build/~ac_id');
 		/* archive channel ID  */
		if(empty($acId)) {
			$acId = M('ArchiveChannel')->field('archive_channel_id')->select();
			F('~build/~ac_id', $acId);
		}
		$acCount = F('~build/~ac_count');
 		/* archive channl count */
		if(empty($acCount)) {
			$acCount = count($acId);
			F('~build/~ac_count', $acCount);
		}

		$aCount = F('~build/~a_count');
 		/* archive count */
		if(empty($aCount)) {
			$aCount = M('Archive')->count();
			F('~build/~a_count', $aCount);
		}

		$allCount = F('~build/~all_count');
 		/* all task number */
		if(empty($allCount)) {
			$_oi = M('Option')->get_option('index');
			if(!$_o['html_switch'] or !$_oi['html_switch'] or !$_oi['paging_switch']) {
				$allCount = $acCount * 2 + $aCount * 2 + 1;
			}
			else {
				$allCount = $acCount * 2 + $aCount * 2 + ceil($aCount / $_oi['page_size']);
			}
			F('~build/~all_count', $allCount);
		}

		ARequest::set('log_off', true);

		$action = ARequest::get('action') ? ARequest::get('action') : 'channel_url';
		$pageSize = ARequest::get('page_size') ? ARequest::get('page_size') : 20;
		$currentPage = ARequest::get('current_page') ? ARequest::get('current_page') : 1;

		if('channel_url' == $action) {
			$totalRows = $acCount;
			$totalPage = ceil($totalRows / $pageSize);
			$limitMin = ($currentPage - 1) * $pageSize;
			$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;

			/* update url */
			foreach($acId as $key => $_acId) {
				if($key >= $limitMin and $key < $limitMax) {
					M('ArchiveChannel')->build_url($_acId['archive_channel_id']);
				}
				continue;
			}

			/* progress and next page */
			if($currentPage < $totalPage) {
				$progress = round($currentPage * $pageSize / $allCount * 100, 1);
				$nextUrl = Url::U('build/build_all_do?action=channel_url' . '&page_size=' . $pageSize . '&current_page=' . ($currentPage + 1));
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . $currentPage * $pageSize . '/' . $allCount . ']: ' . L('CHANNEL_URL'), $progress);
				M('Build')->show_direction($nextUrl);
			}
			else {
				$progress = round($totalRows / $allCount * 100, 1);
				$nextUrl = Url::U('build/build_all_do?action=archive_url&page_size=' . $pageSize);
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . $totalRows . '/' . $allCount . ']: ' . L('CHANNEL_URL_BUILD_COMPLETE'), $progress);
				set_time_limit(30);
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CHANNEL') . ': ' . L('BUILD_URL') . ' ID[' . L('ALL') . ']');
				M('Build')->show_direction($nextUrl);
			}
		}
		elseif('archive_url' == $action) {
			$totalRows = $aCount;
			$totalPage = ceil($totalRows / $pageSize);
			$limitMin = ($currentPage - 1) * $pageSize;

			/* archive ID  */
			$aId = M('Archive')->field('archive_id')->limit($limitMin . ',' . $pageSize)->select();

			/* build url */
			foreach($aId as $key => $_aId) {
				M('Archive')->build_url($_aId['archive_id']);
			}

			/* progress and next page */
			if($currentPage < $totalPage) {
				$progress = round(($currentPage * $pageSize + $acCount) / $allCount * 100, 1);
				$nextUrl = Url::U('build/build_all_do?action=archive_url' . '&page_size=' . $pageSize . '&current_page=' . ($currentPage + 1));
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . ($currentPage * $pageSize + $acCount) . '/' . $allCount . ']: ' . L('ARCHIVE_URL'), $progress);
				M('Build')->show_direction($nextUrl);
			}
			else {
				$progress = round(($totalRows + $acCount) / $allCount * 100, 1);
				$nextUrl = Url::U('build/build_all_do?action=channel_html&page_size=' . $pageSize);
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . ($currentPage * $pageSize + $acCount) . '/' . $allCount . ']: ' . L('ARCHIVE_URL_BUILD_COMPLETE'), $progress);
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_ARCHIVE') . ': ' . L('BUILD_URL') . ' ID[' . L('ALL') . ']');
				M('Build')->show_direction($nextUrl);
			}
		}
		elseif('channel_html' == $action) {
			if($_o['html_switch'] and !empty($acId)) {
				$currentKey = ARequest::get('current_key') ? ARequest::get('current_key') : 0;
				foreach($acId as $key => $acId) {
					if($key != $currentKey) {
						continue;
					}
					$acId = $acId['archive_channel_id'];

					$where = array();
					$where['__ARCHIVE__.a_status'] = array('EQ', 1);

					$_ACL = M('ArchiveChannel')->get_channelList(0, $acId);
					$act = new ATree($_ACL, array(
						'archive_channel_id',
						'ac_parent_id',
						'ac_sub_channel'), $acId);
					$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid($acId)));

					$archiveRows = ARequest::get('archive_rows') ? ARequest::get('archive_rows') : M('Archive')->where($where)->count();

					$_ACI = M('ArchiveChannel')->where(array('archive_channel_id' => array('EQ', $acId)))->find();
					ARequest::set('archive_channel_id', $acId);
					/* build index */
					$index = ARequest::get('index') ? ARequest::get('index') : 'yes';
					if(1 == $_ACI['ac_type'] and 'yes' == $index) {
						A('Admin.ArchiveChannel')->build_html_index_do();
						$progress = round(($currentKey + $acCount + $aCount) / $allCount * 100, 1);
						M('Build')->show_progress($progress . '% [' . ($currentKey + $acCount + $aCount) . '/' . $allCount . ']: ' . $_ACI['ac_name'] . L('CHANNEL_INDEX_BUILD_COMPLETE'), $progress);
					}

					$totalRows = ceil($archiveRows / $_ACI['ac_page_size']);
					$totalPage = ceil($totalRows / $pageSize);

					$limitMin = ($currentPage - 1) * $pageSize + 1;
					$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;

					if(0 == $archiveRows) {
						$_GET[C('VAR.PAGE')] = 1;
						A('Admin.ArchiveChannel')->build_html_list_do();
					}
					for($i = $limitMin; $i <= $limitMax; $i++) {
						$_GET[C('VAR.PAGE')] = $i;
						A('Admin.ArchiveChannel')->build_html_list_do();
					}

					if($currentPage < $totalPage) {
						$progress = round(($currentKey + $acCount + $aCount) / $allCount * 100, 1);
						M('Build')->show_progress($progress . '% [' . ($currentKey + $acCount + $aCount) . '/' . $allCount . ']: ' . $_ACI['ac_name'] . L('CHANNEL_LIST') . ' ' . ($currentPage * $pageSize) . '/' . $totalRows, $progress);
						$nextUrl = Url::U('build/build_all_do?page_size=' . $pageSize . '&index=no' . '&action=channel_html' . '&archive_rows=' . $archiveRows . '&current_key=' . $key . '&current_page=' . ($currentPage + 1));
						F('~build/~next_url', $nextUrl);
						M('Build')->show_direction($nextUrl);
					}
					else {
						$progress = round(($currentKey + $acCount + $aCount) / $allCount * 100, 1);
						M('Build')->show_progress($progress . '% [' . ($currentKey + $acCount + $aCount) . '/' . $allCount . ']: ' . $_ACI['ac_name'] . L('CHANNEL_LIST_BUILD_COMPLETE'), $progress);
						if($key < $acCount - 1) {
							$nextUrl = Url::U('build/build_all_do?page_size=' . $pageSize . '&action=channel_html' . '&current_key=' . ($key + 1));
							F('~build/~next_url', $nextUrl);
							M('Build')->show_direction($nextUrl);
						}
						else {
							set_time_limit(30);
							F('~build/~acid_' . $archiveChannelId, null);
							$nextUrl = Url::U('build/build_all_do?action=archive_html&page_size=' . $pageSize);
							F('~build/~next_url', $nextUrl);
							M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CHANNEL') . ': ' . L('BUILD_HTML') . ' ID[' . L('ALL') . ']');
							M('Build')->show_direction($nextUrl);
						} /*e: $key >= $acCount - 1 */
					} /*e: $currentPage >= $totalPage */
				} /*e: foreach */
			}
			else {
				$progress = round(($acCount * 2 + $aCount) / $allCount * 100, 1);
				$nextUrl = Url::U('build/build_all_do?action=archive_html');
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . ($acCount * 2 + $aCount) . '/' . $allCount . ']: ' . L('CHANNEL_HTML_BUILD_COMPLETE'), $progress);
				set_time_limit(30);
				M('Build')->show_direction($nextUrl);
			}
		}
		elseif('archive_html' == $action) {
			if($_o['html_switch']) {
				/* archive number */
				$totalRows = $aCount;
				$totalPage = ceil($totalRows / $pageSize);
				$limitMin = ($currentPage - 1) * $pageSize;

				/* archive ID  */
				$aId = M('Archive')->field('archive_id')->limit($limitMin . ',' . $pageSize)->select(); //todo

				/* build html */
				foreach($aId as $key => $_aId) {
					ARequest::set('archive_id', $_aId['archive_id']);
					A('Admin.Archive')->build_html_do();
				}

				/* progress and next page */
				if($currentPage < $totalPage) {
					$progress = round(($currentPage * $pageSize + $acCount * 2 + $aCount) / $allCount * 100, 1);
					$nextUrl = Url::U('build/build_all_do?action=archive_html' . '&page_size=' . $pageSize . '&current_page=' . ($currentPage + 1));
					F('~build/~next_url', $nextUrl);
					M('Build')->show_progress($progress . '% [' . ($currentPage * $pageSize + $acCount * 2 + $aCount) . '/' . $allCount . ']: ' . L('ARCHIVE_HTML'), $progress);
					M('Build')->show_direction($nextUrl);
				}
				else {
					$progress = round(($acCount * 2 + $aCount * 2) / $allCount * 100, 1);
					$nextUrl = Url::U('build/build_all_do?action=index_html');
					F('~build/~next_url', $nextUrl);
					M('Build')->show_progress($progress . '% [' . ($acCount * 2 + $aCount * 2) . '/' . $allCount . ']: ' . L('ARCHIVE_HTML_BUILD_COMPLETE'), $progress);
					set_time_limit(30);
					M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_ARCHIVE') . ': ' . L('BUILD_HTML') . ' ID[' . L('ALL') . ']');
					M('Build')->show_direction($nextUrl);
				}
			}
			else {
				$progress = round(($acCount * 2 + $aCount * 2) / $allCount * 100, 1);
				$nextUrl = Url::U('build/build_all_do?action=index_html');
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . ($acCount * 2 + $aCount * 2) . '/' . $allCount . ']: ' . L('ARCHIVE_HTML_SWITCH_IS_OFF'), $progress);
				set_time_limit(30);
				M('Build')->show_direction($nextUrl);
			}
		}
		elseif('index_html' == $action) {
			$_t_finish = false;
			$_oi = M('Option')->get_option('index');
			if(!$_o['html_switch'] or !$_oi['html_switch']) {
				/* delete default index file */
				if(file_exists(APP_PATH . D_S . trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'))) {
					@unlink(APP_PATH . D_S . trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'));
				}
				M('Build')->show_progress('100% [' . $allCount . '/' . $allCount . ']: ' . L('HTML_SWITCH_IS_OFF'), 100);
				$_t_finish = true;
			}
			elseif(!$_oi['paging_switch']) {
				$this->_build_index_do();
				M('Build')->show_progress('100% [' . $allCount . '/' . $allCount . ']: ' . L('HOME_INDEX_BUILD_COMPLETE'), 100);
				$_t_finish = true;
			}
			else {
				$totalRows = ceil($aCount / $_oi['page_size']);
				$totalPage = ceil($totalRows / $pageSize);
				$limitMin = ($currentPage - 1) * $pageSize + 1;
				$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;
				for($i = $limitMin; $i <= $limitMax; $i++) {
					$_GET[C('VAR.PAGE')] = $i;
					$this->_build_index_paging_do();
				}

				if($currentPage < $totalPage) {
					$progress = round(($currentPage * $pageSize + $acCount * 2 + $aCount * 2) / $allCount * 100, 1);
					M('Build')->show_progress($progress . '% [' . ($currentPage * $pageSize + $acCount * 2 + $aCount * 2) . '/' . $allCount . ']: '. L('BUILD_INDEX_LIST'), $progress);
					$nextUrl = Url::U('build/build_all_do?action=index_html&page_size=' . $pageSize . '&current_page=' . ($currentPage + 1));
					F('~build/~next_url', $nextUrl);
					M('Build')->show_direction($nextUrl);
				}
				else {
					M('Build')->show_progress('100% [' . $allCount . '/' . $allCount . ']: ' . L('BUILD_INDEX_LIST'), 100);
					$_t_finish = true;
				}
			}
			if($_t_finish) {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_INDEX_LIST'));
				F('~build/~ac_id', null);
				F('~build/~ac_count', null);
				F('~build/~a_count', null);
				F('~build/~all_count', null);
				F('~build/~next_url', null);
				set_time_limit(30);
				M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
			}
		}
	}

	public function build_index_do() {
		set_time_limit(99999999);
		$this->display('admin/build/progress');

		$_o = M('Option')->get_option('core');
		$_oi = M('Option')->get_option('index');

		/* html is off */
		if(!$_o['html_switch'] or !$_oi['html_switch']) {
			/* delete default index file */
			if(file_exists(APP_PATH . D_S . trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'))) {
				@unlink(APP_PATH . D_S . trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'));
			}
			M('Build')->show_progress(L('HTML_SWITCH_IS_OFF'), 100);
			set_time_limit(30);
			M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
			return;
		}

		/* disallow index paging */
		if(!$_oi['paging_switch']) {
			$this->_build_index_do();
			M('Build')->show_progress('100% [1/1]: ' . L('HOME_INDEX_BUILD_COMPLETE'), 100);
			set_time_limit(30);

			M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_INDEX'));
			M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
			return;
		}

		/* deal with index paging */
		$pageSize = ARequest::get('page_size') ? ARequest::get('page_size') : 20;
		$currentPage = ARequest::get('current_page') ? ARequest::get('current_page') : 1;

		$aCount = F('~build/~a_count');
		if(empty($aCount)) {
			$aCount = M('Archive')->where(array('a_status' => array('EQ', 1)))->count();
			F('~build/~a_count', $aCount);
		}
		$totalRows = ceil($aCount / $_oi['page_size']);
		$totalPage = ceil($totalRows / $pageSize);
		$limitMin = ($currentPage - 1) * $pageSize + 1;
		$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;
		for($i = $limitMin; $i <= $limitMax; $i++) {
			$_GET[C('VAR.PAGE')] = $i;
			$this->_build_index_paging_do();
		}

		if($currentPage < $totalPage) {
			$progress = round($currentPage * $pageSize / $totalRows * 100, 1);
			M('Build')->show_progress($progress . '% [' . $currentPage * $pageSize . '/' . $totalRows . ']: '. L('BUILD_INDEX_LIST'), $progress);
			$nextUrl = Url::U('build/build_index_do?page_size=' . $pageSize . '&current_page=' . ($currentPage + 1));
			F('~build/~next_url', $nextUrl);
			M('Build')->show_direction($nextUrl);
		}
		else {
			M('Build')->show_progress('100% [' . $totalRows . '/' . $totalRows . ']: ' . L('BUILD_INDEX_LIST'), 100);
			M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_INDEX_LIST'));
			set_time_limit(30);
			F('~build/~a_count', null);
			F('~build/~next_url', null);
			M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
		}
	}

	private function _build_index_do() {
		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$this->assign('_GCAP', 'home@index/index');

		/* task */
		$this->assign('TASK', 'build_html_index');

		$_oi = M('Option')->get_option('index');
		$_C = require (CFG_PATH . D_S . 'comm.php');
		$this->te->tplTheme = $_C['TE']['TPL_THEME'];
		$this->build_html(trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/'.$_oi['tpl']);
		$this->te->tplTheme = 'default';
	}
	private function _build_index_paging_do() {
		$_SITE = M('Option')->get_option('site');
		unset($_SITE['theme']);
		$this->assign('_SITE', $_SITE);

		$_G = M('Option')->get_option();
		unset($_G['site']);
		unset($_G['core']);
		unset($_G['index']);
		unset($_G['image']);
		$this->assign('_G', $_G);

		$_GET[C('VAR.PAGE')] = intval(ARequest::get(C('VAR.PAGE'))) ? intval(ARequest::get(C('VAR.PAGE'))) : 1;

		$_oi = M('Option')->get_option('index');
		$_dir = '/' . trim(str_replace('{uwa_path}', '', $_oi['html_path_paging']), '/');
		$naming = str_replace('{page}', '_page_', $_oi['html_naming_paging']);
		$file = $_dir . '/' . trim($naming, '/') . C('HTML.FILE_SUFFIX');

		$where = array();
		$where['__ARCHIVE__.a_status'] = array('EQ', 1);
		$order = '`a_rank` DESC, `a_edit_time` DESC';

		$rowsNum = F('~build/~a_count');
		if(empty($rowsNum)) {
			$rowsNum = M('Archive')->get_archiveCount($where);
			F('~build/~a_count', $rowsNum);
		}
		$p = new APage($rowsNum, $_oi['page_size'], __APP__ . ltrim($file, '/'));

		if($p->__get('totalPages') < ARequest::get(C('VAR.PAGE'))) {
			return;
		}

		$this->assign('PAGING', $p->get_paging());
		$limit = $p->get_limit();

		/* archive list */
		$_AL = M('Archive')->get_archiveList($where, $order, $limit);
		$this->assign('_L', $_AL);

		$this->assign('_GCAP', 'home@index/index');

		/* task */
		$this->assign('TASK', 'build_html_index&' . C('VAR.PAGE') . '=' . ARequest::get(C('VAR.PAGE')));

		$_C = require (CFG_PATH . D_S . 'comm.php');
		$this->te->tplTheme = $_C['TE']['TPL_THEME'];
		$this->build_html(str_replace('_page_', ARequest::get(C('VAR.PAGE')), $file), APP_PATH, 'home/'.$_oi['tpl_paging']);

		/* build default index */
		if(1 == ARequest::get(C('VAR.PAGE'))) {
			/* task */
			$this->assign('TASK', 'build_html_index');

			$this->build_html(trim($_oi['html_naming'], '/') . C('HTML.FILE_SUFFIX'), APP_PATH, 'home/'.$_oi['tpl_paging']);
		}
		$this->te->tplTheme = 'default';
	}

	public function build_channel_do() {
		set_time_limit(99999999);
		$this->display('admin/build/progress');

		ARequest::set('log_off', true);

		$archiveChannelId = ARequest::get('archive_channel_id') ? ARequest::get('archive_channel_id') : 0;

		$acId = F('~build/~acid_' . $archiveChannelId);
		if(empty($acId)) {
			$_ACL = M('ArchiveChannel')->get_channelList(0, $archiveChannelId);
			$act = new ATree($_ACL, array(
				'archive_channel_id',
				'ac_parent_id',
				'ac_sub_channel'), $archiveChannelId);
			$acId = implode(',', $act->get_leafid($archiveChannelId));

			F('~build/~acid_' . $archiveChannelId, $acId);
		}

		$_L_ID = is_array($acId) ? implode(', ', $acId) : $acId;

		$action = ARequest::get('action') ? ARequest::get('action') : 'build_url';
		$pageSize = ARequest::get('page_size') ? ARequest::get('page_size') : 20;
		$currentPage = ARequest::get('current_page') ? ARequest::get('current_page') : 1;

		if('build_url' == $action) {
			/* task paging parameter */
			$totalRows = count(explode(',', $acId));
			$totalPage = ceil($totalRows / $pageSize);
			$limitMin = ($currentPage - 1) * $pageSize;
			$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;
			/* build url */
			foreach(explode(',', $acId) as $key => $acId) {
				if($key >= $limitMin and $key < $limitMax) {
					M('ArchiveChannel')->build_url($acId);
				}
				continue;
			}
			/* progress and next page */
			if($currentPage < $totalPage) {
				$progress = round($currentPage * $pageSize / $totalRows * 100, 1);
				$nextUrl = Url::U('build/build_channel_do?page_size=' . $pageSize . '&action=' . $action . '&archive_channel_id=' . $archiveChannelId . '&total_rows=' . $totalRows . '&current_page=' . ($currentPage + 1));
				F('~build/~next_url', $nextUrl);
				M('Build')->show_progress($progress . '% [' . $currentPage * $pageSize . '/' . $totalRows . ']: ' . L('CHANNEL_URL'), $progress);
				M('Build')->show_direction($nextUrl);
			}
			else {
				M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CHANNEL') . ': ' . L('BUILD_URL') . ' ID[' . $_L_ID . ']');

				M('Build')->show_progress('100% [' . $totalRows . '/' . $totalRows . ']: ' . L('CHANNEL_URL_BUILD_COMPLETE'), 100);
				set_time_limit(30);
				F('~build/~next_url', null);
				F('~build/~acid_' . $archiveChannelId, null);
				M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
			}
		}
		elseif('build_html' == $action) {
			/* build html */
			$acId = explode(',', $acId);
			$acCount = count($acId);
			$currentKey = ARequest::get('current_key') ? ARequest::get('current_key') : 0;
			foreach($acId as $key => $acId) {
				if($key != $currentKey) {
					continue;
				}
				$where = array();
				$where['__ARCHIVE__.a_status'] = array('EQ', 1);

				$_ACL = M('ArchiveChannel')->get_channelList(0, $acId);
				$act = new ATree($_ACL, array(
					'archive_channel_id',
					'ac_parent_id',
					'ac_sub_channel'), $acId);
				$where['__ARCHIVE__.archive_channel_id'] = array('IN', implode(',', $act->get_leafid($acId)));

				$archiveRows = ARequest::get('archive_rows') ? ARequest::get('archive_rows') : M('Archive')->where($where)->count();

				$_ACI = M('ArchiveChannel')->where(array('archive_channel_id' => array('EQ', $acId)))->find();
				ARequest::set('archive_channel_id', $acId);
				$index = ARequest::get('index') ? ARequest::get('index') : 'yes';
				if(1 == $_ACI['ac_type'] and 'yes' == $index) {
					A('Admin.ArchiveChannel')->build_html_index_do();
					M('Build')->show_progress('100% [1/1]: ' . $_ACI['ac_name'] . L('CHANNEL_INDEX_BUILD_COMPLETE'), 100);
				}

				$totalRows = ceil($archiveRows / $_ACI['ac_page_size']);
				$totalPage = ceil($totalRows / $pageSize);

				$limitMax = $currentPage * $pageSize < $totalRows ? $currentPage * $pageSize : $totalRows;
				if(0 == $archiveRows) {
					$_GET[C('VAR.PAGE')] = 1;
					A('Admin.ArchiveChannel')->build_html_list_do();
				}
				for($i = ($currentPage - 1) * $pageSize + 1; $i <= $limitMax; $i++) {
					$_GET[C('VAR.PAGE')] = $i;
					A('Admin.ArchiveChannel')->build_html_list_do();
				}

				if($currentPage < $totalPage) {
					$progress = round($currentPage * $pageSize / $totalRows * 100, 1);
					M('Build')->show_progress($progress . '% [' . $currentPage * $pageSize . '/' . $totalRows . ']: ' . $_ACI['ac_name'] . L('CHANNEL_LIST'), $progress);
					$nextUrl = Url::U('build/build_channel_do?page_size=' . $pageSize . '&index=no' . '&archive_channel_id=' . $archiveChannelId . '&action=' . $action . '&archive_rows=' . $archiveRows . '&current_key=' . $key . '&current_page=' . ($currentPage + 1));
					F('~build/~next_url', $nextUrl);
					M('Build')->show_direction($nextUrl);
				}
				else {
					M('Build')->show_progress('100% [' . $totalRows . '/' . $totalRows . ']: ' . $_ACI['ac_name'] . L('CHANNEL_LIST_BUILD_COMPLETE'), 100);
					if($key < $acCount - 1) {
						$nextUrl = Url::U('build/build_channel_do?page_size=' . $pageSize . '&archive_channel_id=' . $archiveChannelId . '&action=' . $action . '&current_key=' . ($key + 1));
						F('~build/~next_url', $nextUrl);
						M('Build')->show_direction($nextUrl);
					}
					else {
						M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_CHANNEL') . ': ' . L('BUILD_HTML') . ' ID[' . $_L_ID . ']');
						set_time_limit(30);
						F('~build/~acid_' . $archiveChannelId, null);
						F('~build/~next_url', null);
						M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
					} /*e: $key >= $acCount - 1 */
				} /*e: $currentPage >= $totalPage */
			} /*e: foreach */
		} /*e: action */
	} /*e: build_list_html_do */

	public function build_archive_do() {
		set_time_limit(99999999);
		$this->display('admin/build/progress');

		ARequest::set('log_off', true);

		$pageSize = ARequest::get('page_size') ? ARequest::get('page_size') : 20;
		$currentPage = ARequest::get('current_page') ? ARequest::get('current_page') : 1;

		$archiveId = ARequest::get('archive_id');
		if(empty($archiveId)) {
			$where = array();
			/* channel id */
			$archiveChannelId = ARequest::get('archive_channel_id') ? ARequest::get('archive_channel_id') : 0;
			$acId = F('~build/~acid_' . $archiveChannelId);
			if(empty($acId)) {
				$_ACL = M('ArchiveChannel')->get_channelList(0, $archiveChannelId);
				$act = new ATree($_ACL, array(
					'archive_channel_id',
					'ac_parent_id',
					'ac_sub_channel'), $archiveChannelId);
				$acId = implode(',', $act->get_leafid($archiveChannelId));

				F('~build/~acid_' . $archiveChannelId, $acId);
			}
			/* filter channel */
			$where['archive_channel_id'] = array('IN', $acId);
			/* filter status */
			$where['a_status'] = array('EQ', 1);
			/* filter start time */
			$startTime = ARequest::get('start_time');
			$startTime = (is_int($startTime) ? $startTime : (strtotime($startTime) ? strtotime($startTime) : 0));
			$endTime = ARequest::get('end_time');
			$endTime = (is_int($endTime) ? $endTime : (strtotime($endTime) ? strtotime($endTime) : time()));
			if(0 < $startTime) {
				$where['a_add_time'] = array('BETWEEN', $startTime . ',' . $endTime);
			}
			/* filter start id and end id */
			$startId = ARequest::get('start_id') ? ARequest::get('start_id') : 0;
			$endId = ARequest::get('end_id') ? ARequest::get('end_id') : 0;
			if(0 < $startId) {
				$where['archive_id'] = array('BETWEEN', $startId . ',' . $endId);
			}

			/* task paging parameter */
			;
			$totalRows = ARequest::get('total_rows') ? ARequest::get('total_rows') : M('Archive')->where($where)->count();
			$totalPage = ceil($totalRows / $pageSize);
			$limit = ($currentPage - 1) * $pageSize . ',' . $pageSize;

			/* archive id list */
			$_AL = M('Archive')->field('archive_id')->where($where)->limit($limit)->select();
		}
		else {
			$_AL = array();
			if(!is_array($archiveId)) {
				$archiveId = explode(',', $archiveId);
			}
			foreach($archiveId as $aid) {
				$_AL[] = array('archive_id' => $aid);
			}
			$acId = 0;
			$startTime = 0;
			$endTime = time();
			$startId = 0;
			$endId = 0;
			$totalRows = count($_AL);
			$totalPage = ceil($totalRows / $pageSize);
			$_AL = array_slice($_AL, ($currentPage - 1) * $pageSize, $pageSize);
		}

		$_L_ID = array();

		/* action */
		$action = ARequest::get('action') ? ARequest::get('action') : 'build_url';

		foreach($_AL as $a) {
			$_L_ID[] = $a['archive_id'];
			if('build_url' == $action) {
				/* build url */
				M('Archive')->build_url($a['archive_id']);
			}
			elseif('build_html' == $action) {
				/* build html */
				ARequest::set('archive_id', $a['archive_id']);
				A('Admin.Archive')->build_html_do();
			}
		}

		$_L_ID = is_array($_L_ID) ? implode(', ', $_L_ID) : $_L_ID;
		M('AdminLog')->add_log(ASession::get('m_userid'), L('BUILD_ARCHIVE') . ': ' . L(strtoupper($action)) . ' ID[' . $_L_ID . ']');

		/* progress and next page */
		if($currentPage < $totalPage) {
			$progress = round($currentPage * $pageSize / $totalRows * 100, 1);
			$nextUrl = Url::U('build/build_archive_do?page_size=' . $pageSize . '&action=' . $action . '&archive_channel_id=' . $archiveChannelId . '&start_time=' . $startTime . '&end_time=' . $endTime . '&start_id=' . $startId . '&end_id=' . $endId . '&total_rows=' . $totalRows . '&archive_id=' . implode(',', $archiveId) . '&current_page=' . ($currentPage + 1));
			F('~build/~next_url', $nextUrl);
			M('Build')->show_progress($progress . '% [' . $currentPage * $pageSize . '/' . $totalRows . ']: ' . L(strtoupper($action)), $progress);
			M('Build')->show_direction($nextUrl);
		}
		else {
			M('Build')->show_progress('100% [' . $totalRows . '/' . $totalRows . ']: ' . L(strtoupper($action)) . L('BUILD_COMPLETE'), 100);
			set_time_limit(30);
			F('~build/~next_url', null);
			F('~build/~acid_' . $archiveChannelId, null);
			M('Build')->show_direction(Url::U('build/build_guide'), true, 1);
		}
	}

}

?>
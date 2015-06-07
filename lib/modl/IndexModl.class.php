<?php

/**
 *--------------------------------------
 * index
 *--------------------------------------
 * @project		: uwa
 * @author		: cblee
 * @created		: 2012-10-11
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class IndexModl extends Modl {
	public function get_manageMenu() {
		/* get archive model menu list */
		$_AML = array();
		$_t = M('ArchiveModel')->get_modelList(true, true);
		if(!empty($_t)) {
			foreach($_t as $am) {
				$_AML[] = array(
					'm_name' => $am['am_name'] . L('LIST'),
					'm_alias' => 'archive_type_' . $am['am_alias'],
					'm_url' => 'archive/list_archive?archive_model_id=' . $am['archive_model_id']);
			}
		}

		/* get extension list */
		$_EML = M('Extension')->get_extensionMenu();

		/* all menu */
		$_M = array(
			array(
				'm_name' => L('CONTENT'),
				'm_alias' => 'content',
				'm_sub_key' => 'm_conent',
				'm_sub' => array(
					array(
						'm_group_name' => L('COMMON'),
						'm_alias' => 'common',
						'm_menus' => array(
							array(
								'm_name' => L('ARCHIVE_CHANNEL'),
								'm_alias' => 'archive_channel',
								'm_url' => 'archive_channel/list_channel'),
							array(
								'm_name' => L('ALL_ARCHIVE'),
								'm_alias' => 'all_archive',
								'm_url' => 'archive/list_archive'),
							array(
								'm_name' => L('MY_ARCHIVE'),
								'm_alias' => 'my_archive',
								'm_url' => 'archive/list_archive?member_id=' . ASession::get('member_id')),
							)),
					array(
						'm_group_name' => L('CONTENT'),
						'm_alias' => 'content',
						'm_menus' => $_AML),
					array(
						'm_group_name' => L('ADVANCE'),
						'm_alias' => 'content_advance',
						'm_menus' => array(
							array(
								'm_name' => L('ARCHIVE_FLAG'),
								'm_alias' => 'archive_flag',
								'm_url' => 'archive_flag/list_flag'),
							array(
								'm_name' => L('ARCHIVE_MODEL'),
								'm_alias' => 'archive_model',
								'm_url' => 'archive_model/list_model'),
							array(
								'm_name' => L('CUSTOM_MODEL'),
								'm_alias' => 'custom_model',
								'm_url' => 'custom_model/list_model'),
							)),
					)),
			array(
				'm_name' => L('MEMBER'),
				'm_alias' => 'member',
				'm_sub_key' => 'm_member',
				'm_sub' => array(
					array(
						'm_group_name' => L('MEMBER'),
						'm_alias' => 'member',
						'm_menus' => array(
							array(
								'm_name' => L('MEMBER_LIST'),
								'm_alias' => 'member_list',
								'm_url' => 'member/list_member'),
							array(
								'm_name' => L('MEMBER_NOTIFY'),
								'm_alias' => 'member_notify',
								'm_url' => 'member_notify/list_notify'),
							array(
								'm_name' => L('MEMBER_FAVORITE'),
								'm_alias' => 'member_favorite',
								'm_url' => 'member_favorite/list_favorite'),
							array(
								'm_name' => L('MEMBER_CREDIT_ORDER'),
								'm_alias' => 'member_credit_order',
								'm_url' => 'member_credit_order/list_credit_order'),
							)),
					array(
						'm_group_name' => L('ADVANCE'),
						'm_alias' => 'member_advance',
						'm_menus' => array(
							array(
								'm_name' => L('MEMBER_CREDIT_TYPE'),
								'm_alias' => 'member_credit_type',
								'm_url' => 'member_credit_type/list_credit_type'),
							array(
								'm_name' => L('MEMBER_LEVEL'),
								'm_alias' => 'member_level',
								'm_url' => 'member_level/list_level'),
							array(
								'm_name' => L('MEMBER_PERMISSION'),
								'm_alias' => 'member_permission',
								'm_url' => 'member_permission/list_permission'),
							array(
								'm_name' => L('MEMBER_MODEL'),
								'm_alias' => 'member_model',
								'm_url' => 'member_model/list_model'),
							)),
					)),
			array(
				'm_name' => L('SYSTEM'),
				'm_alias' => 'system',
				'm_sub_key' => 'm_system',
				'm_sub' => array(
					array(
						'm_group_name' => L('SYSTEM'),
						'm_alias' => 'system',
						'm_menus' => array(
							array(
								'm_name' => L('OPTION'),
								'm_alias' => 'option',
								'm_url' => 'option/edit_option_site'),
							array(
								'm_name' => L('MENU'),
								'm_alias' => 'menu',
								'm_url' => 'menu/list_menu'),
							array(
								'm_name' => L('FINDER'),
								'm_alias' => 'finder',
								'm_url' => 'finder/browse_server'),
							array(
								'm_name' => L('LINKAGE'),
								'm_alias' => 'linkage',
								'm_url' => 'linkage/list_linkage'),
							)),
					array(
						'm_group_name' => L('ADMIN'),
						'm_alias' => 'admin',
						'm_menus' => array(
							array(
								'm_name' => L('ADMIN'),
								'm_alias' => 'admin',
								'm_url' => 'admin/list_admin'),
							array(
								'm_name' => L('ADMIN_ROLE'),
								'm_alias' => 'admin_role',
								'm_url' => 'admin_role/list_role'),
							array(
								'm_name' => L('ADMIN_PERMISSION'),
								'm_alias' => 'admin_permission',
								'm_url' => 'admin_permission/list_permission'),
							array(
								'm_name' => L('ADMIN_LOG'),
								'm_alias' => 'admin_log',
								'm_url' => 'admin_log/list_log'),
							)),
					)),
			array(
				'm_name' => L('MAINTENANCE'),
				'm_alias' => 'maintenance',
				'm_sub_key' => 'm_maintenance',
				'm_sub' => array(
					array(
						'm_group_name' => L('BUILD_CONTENT'),
						'm_alias' => 'build_content',
						'm_menus' => array(
							array(
								'm_name' => L('CLEAR_CACHE'),
								'm_alias' => 'clear_cache',
								'm_url' => 'build/clear_cache'),
							array(
								'm_name' => L('BUILD_GUIDE'),
								'm_alias' => 'build_guide',
								'm_url' => 'build/build_guide'),
							)),
					array(
						'm_group_name' => L('TEMPLATE'),
						'm_alias' => 'template',
						'm_menus' => array(
							array(
								'm_name' => L('LIST_TEMPLATE'),
								'm_alias' => 'list_template',
								'm_url' => 'template/list_template'),
							array(
								'm_name' => L('TAG_WIZARD'),
								'm_alias' => 'tag_wizard',
								'm_url' => 'template/tag_wizard'),
							)),
					array(
						'm_group_name' => L('TOOLBOX'),
						'm_alias' => 'toolbox',
						'm_menus' => array(
							array(
								'm_name' => L('GARBLE_STRING'),
								'm_alias' => 'garble_string',
								'm_url' => 'toolbox/edit_garble_string'),
							array(
								'm_name' => L('CHECK_DUPLICATE_ARCHIVE'),
								'm_alias' => 'duplicate_archive',
								'm_url' => 'toolbox/check_duplicate_archive'),
							array(
								'm_name' => L('SECURITY_CHECK'),
								'm_alias' => 'security',
								'm_url' => 'toolbox/scan_code'),
							array(
								'm_name' => L('DATABASE'),
								'm_alias' => 'database',
								'm_url' => 'database/list_table'),
							array(
								'm_name' => L('TASK'),
								'm_alias' => 'task',
								'm_url' => 'task/list_task'),
							array(
								'm_name' => L('EMAIL'),
								'm_alias' => 'email',
								'm_url' => 'email/send_email'),
							)),
					)),
			array(
				'm_name' => L('MODULE'),
				'm_alias' => 'module',
				'm_sub_key' => 'm_module',
				'm_sub' => array(
					array(
						'm_group_name' => L('SYSTEM_MODULE'),
						'm_alias' => 'module_system',
						'm_menus' => array(
							array(
								'm_name' => L('ARCHIVE_REVIEW'),
								'm_alias' => 'archive_review',
								'm_url' => 'archive_review/list_review'),
							array(
								'm_name' => L('REPORT'),
								'm_alias' => 'report',
								'm_url' => 'report/list_report'),
							array(
								'm_name' => L('UPLOAD'),
								'm_alias' => 'upload',
								'm_url' => 'upload/list_upload'),
							array(
								'm_name' => L('TAG'),
								'm_alias' => 'tag',
								'm_url' => 'tag/list_tag'),
							array(
								'm_name' => L('INLINK'),
								'm_alias' => 'inlink',
								'm_url' => 'inlink/list_inlink'),
							array(
								'm_name' => L('CUSTOM_LIST'),
								'm_alias' => 'custom_list',
								'm_url' => 'custom_list/list_custom_list'),
							)),
					array(
						'm_group_name' => L('STANDALONE_MOUDLE'),
						'm_alias' => 'module_standalone',
						'm_menus' => array(
							array(
								'm_name' => L('AD'),
								'm_alias' => 'ad',
								'm_url' => 'ad_space/list_space'),
							array(
								'm_name' => L('FLINK'),
								'm_alias' => 'flink',
								'm_url' => 'flink/list_flink'),
							array(
								'm_name' => L('GUESTBOOK'),
								'm_alias' => 'guestbook',
								'm_url' => 'guestbook/list_guestbook'),
							array(
								'm_name' => L('SINGLE_PAGE'),
								'm_alias' => 'single_page',
								'm_url' => 'single_page/list_single_page'),
							array(
								'm_name' => L('VOTE'),
								'm_alias' => 'vote',
								'm_url' => 'vote/list_vote'),
							),
						),
					)),
			array(
				'm_name' => L('EXTENSION'),
				'm_alias' => 'extension',
				'm_sub_key' => 'm_extension',
				'm_sub' => array(
					array(
						'm_group_name' => L('EXTENSION_MANAGE'),
						'm_alias' => 'extension_manage',
						'm_menus' => array(
							array(
								'm_name' => L('EXTENSION_LIST'),
								'm_alias' => 'list_extension',
								'm_url' => 'extension/list_extension'),
							array(
								'm_name' => L('UPLOAD_EXTENSION'),
								'm_alias' => 'upload_extension',
								'm_url' => 'extension/upload_extension'),
							array(
								'm_name' => L('PACKAGE_EXTENSION'),
								'm_alias' => 'package_extension',
								'm_url' => 'extension/package_extension'))),
					array(
						'm_group_name' => L('INSTALLED_EXTENSION'),
						'm_alias' => 'plugin',
						'm_menus' => $_EML),
					)));

		/* check permission */
		$allPermission = explode(',', M('AdminPermission')->get_allPermission());
		$_all = array();
		foreach($allPermission as $p) {
			$_p = explode(':', $p);
			$_all[] = parse_name($_p[0]) . '/' . $_p[1];
		}
		/* limit permission */
		$limitPermission = explode(',', M('AdminPermission')->get_limitPermission());
		$_limit = array();
		foreach($limitPermission as $lp) {
			$_lp = explode(':', $lp);
			$_limit[] = parse_name($_lp[0]) . '/' . $_lp[1];
		}
		/* my permission */
		$myRole = M('AdminRole')->get_roleInfo(ASession::get('admin_role_id'));
		$myPermission = explode(',', $myRole['ar_permission']);
		$_my = array();
		foreach($myPermission as $mp) {
			$_mp = explode(':', $mp);
			$_my[] = parse_name($_mp[0]) . '/' . $_mp[1];
		}
		/* filter menu */
		foreach($_M as $k => $menu) {
			foreach($menu['m_sub'] as $k_sub => $m_sub) {
				foreach($m_sub['m_menus'] as $k_menu => $m) {
					$mUrl = explode('?', $m['m_url']);
					if(in_array($mUrl[0], $_limit) 
						or (!in_array('_all', $myPermission) && in_array($mUrl[0], $_all) && !in_array($mUrl[0], $_my))) {
						unset($_M[$k]['m_sub'][$k_sub]['m_menus'][$k_menu]);
						continue;
					}
					$_M[$k]['m_sub'][$k_sub]['m_menus'][$k_menu]['m_url'] = Url::U($m['m_url']);
				}
				if(empty($_M[$k]['m_sub'][$k_sub]['m_menus'])) {
					unset($_M[$k]['m_sub'][$k_sub]);
				}
			}
			if(empty($_M[$k]['m_sub'])) {
				unset($_M[$k]);
			}
		}

		return $_M;
	}
}

?>
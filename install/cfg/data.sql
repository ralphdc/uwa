-- phpMyAdmin SQL Dump
-- version 3.4.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 11 月 11 日 03:56
-- 服务器版本: 5.1.28
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `uwa`
--

-- --------------------------------------------------------

--
-- 表的结构 `prefix_ad`
--

DROP TABLE IF EXISTS `prefix_ad`;
CREATE TABLE IF NOT EXISTS `prefix_ad` (
  `ad_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Ad ID',
  `a_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ad Name',
  `ad_space_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Space ID',
  `a_file` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ad File',
  `a_content` text NOT NULL COMMENT 'Ad Content',
  `a_link` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ad Link',
  `a_time_limit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Time Limit Switch(0:off, 1:on)',
  `a_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Start Time',
  `a_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad End Time',
  `a_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Display Order',
  PRIMARY KEY (`ad_id`),
  KEY `ad_id` (`ad_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Ad' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `prefix_ad`
--

INSERT INTO `prefix_ad` (`ad_id`, `a_name`, `ad_space_id`, `a_file`, `a_content`, `a_link`, `a_time_limit`, `a_start_time`, `a_end_time`, `a_display_order`) VALUES
(1, '300x200图片', 1, '{-site_url-}u/ad/ad300x200.gif', '', '#', 0, {-time-}, {-time-}, 50),
(2, '650x60 图片', 2, '{-site_url-}u/ad/ad650x60.gif', '', '#', 0, {-time-}, {-time-}, 50),
(3, '200x200 图片', 3, '{-site_url-}u/ad/ad200x200.gif', '', '#', 0, {-time-}, {-time-}, 50),
(4, '960x360 图片', 4, '{-site_url-}u/ad/ad960x360.jpg', '', '#', 0, {-time-}, {-time-}, 50),
(5, '20:5 移动横幅 ', 5, '{-site_url-}u/ad/ad20-5.gif', '', '#', 0, {-time-}, {-time-}, 50);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_admin`
--

DROP TABLE IF EXISTS `prefix_admin`;
CREATE TABLE IF NOT EXISTS `prefix_admin` (
  `admin_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Administrator ID',
  `a_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Administrator Login Time',
  `a_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Administrator Login IP',
  `a_ac_id` text NOT NULL COMMENT 'Archive Channel ID Witch Can Be Managed(divide with ‘,’ _all:All Channel)',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID',
  `admin_role_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Administrator Role ID',
  PRIMARY KEY (`admin_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Administrator' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_admin`
--

INSERT INTO `prefix_admin` (`admin_id`, `a_login_time`, `a_login_ip`, `a_ac_id`, `member_id`, `admin_role_id`) VALUES
(1, {-time-}, '{-ip-}', '_all', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_admin_log`
--

DROP TABLE IF EXISTS `prefix_admin_log`;
CREATE TABLE IF NOT EXISTS `prefix_admin_log` (
  `admin_log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Administrator Log ID',
  `m_userid` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Userid',
  `al_operation` varchar(255) NOT NULL DEFAULT '' COMMENT 'Administrator Log Operation',
  `al_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Administrator Log Operation Status(0:failed, 1:succeed)',
  `al_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Administrator Log Time',
  `al_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Administrator Log IP',
  PRIMARY KEY (`admin_log_id`),
  KEY `admin_log_id` (`admin_log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Administrator Log' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_admin_permission`
--

DROP TABLE IF EXISTS `prefix_admin_permission`;
CREATE TABLE IF NOT EXISTS `prefix_admin_permission` (
  `admin_permission_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Administrator Permission ID',
  `ap_group` varchar(96) NOT NULL DEFAULT '' COMMENT 'Administrator Permission Group',
  `ap_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Administrator Permission Name(operation)',
  `ap_content` text NOT NULL COMMENT 'Administrator Permission Content(ctrlr:actn,ctrlr:actn1)',
  PRIMARY KEY (`admin_permission_id`),
  KEY `admin_permission_id` (`admin_permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Administrator Permission' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `prefix_admin_permission`
--

INSERT INTO `prefix_admin_permission` (`ap_group`, `ap_name`, `ap_content`) VALUES
('档案频道', '频道列表', 'ArchiveChannel:list_channel'),
('档案频道', '添加频道', 'ArchiveChannel:add_batch_channel_do,ArchiveChannel:add_channel,ArchiveChannel:add_channel_do'),
('档案频道', '编辑频道', 'ArchiveChannel:edit_channel,ArchiveChannel:edit_channel_do,ArchiveChannel:update_channel_do'),
('档案频道', '删除频道', 'ArchiveChannel:delete_channel_do'),
('档案频道', '生成频道', 'ArchiveChannel:build_html_index_do,ArchiveChannel:build_html_list_do'),
('档案', '档案列表', 'Archive:choose_archive,Archive:list_archive'),
('档案', '添加档案', 'Archive:add_archive,Archive:add_archive_do'),
('档案', '编辑档案', 'Archive:add_flag_do,Archive:change_channel_do,Archive:delete_flag_do,Archive:edit_archive,Archive:edit_archive_do,Archive:pass_archive_do,Archive:refund_archive_do'),
('档案', '删除档案', 'Archive:delete_archive_do'),
('档案', '生成档案', 'Archive:build_html_do'),
('档案属性', '属性列表', 'ArchiveFlag:list_flag'),
('档案属性', '添加属性', 'ArchiveFlag:add_flag_do'),
('档案属性', '编辑属性', 'ArchiveFlag:update_flag_do'),
('档案属性', '删除属性', 'ArchiveFlag:delete_flag_do'),
('档案模型', '模型列表', 'ArchiveModel:list_model'),
('档案模型', '添加模型', 'ArchiveModel:add_model,ArchiveModel:add_model_do'),
('档案模型', '编辑模型', 'ArchiveModel:edit_model,ArchiveModel:edit_model_do,ArchiveModel:toggle_model_status_do,ArchiveModel:update_model_do'),
('档案模型', '删除模型', 'ArchiveModel:delete_model_do'),
('档案模型', '模型字段管理', 'ArchiveModel:add_model_field,ArchiveModel:add_model_field_do,ArchiveModel:delete_model_field_do,ArchiveModel:edit_model_field,ArchiveModel:edit_model_field_do'),
('档案模型', '导入模型', 'ArchiveModel:import_model,ArchiveModel:import_model_do,ArchiveModel:import_model_guide'),
('档案模型', '导出模型', 'ArchiveModel:export_model,ArchiveModel:export_model_do'),
('自定义模型', '模型列表', 'CustomModel:list_model'),
('自定义模型', '添加模型', 'CustomModel:add_model,CustomModel:add_model_do'),
('自定义模型', '编辑模型', 'CustomModel:edit_model,CustomModel:edit_model_do,CustomModel:toggle_model_status_do'),
('自定义模型', '删除模型', 'CustomModel:delete_model_do'),
('自定义模型', '添加模型字段', 'CustomModel:add_model_field,CustomModel:add_model_field_do'),
('自定义模型', '编辑模型字段', 'CustomModel:edit_model_field,CustomModel:edit_model_field_do'),
('自定义模型', '删除模型字段', 'CustomModel:delete_model_field_do'),
('自定义模型', '模型内容列表', 'CustomModel:list_content'),
('自定义模型', '添加模型内容', 'CustomModel:add_content,CustomModel:add_content_do'),
('自定义模型', '编辑模型内容', 'CustomModel:edit_content,CustomModel:edit_content_do,CustomModel:pass_content_do,CustomModel:refund_content_do'),
('自定义模型', '删除模型内容', 'CustomModel:delete_content_do'),
('会员', '会员列表', 'Member:list_member'),
('会员', '添加会员', 'Member:add_member,Member:add_member_do'),
('会员', '编辑会员', 'Member:edit_member,Member:edit_member_do,Member:forbidden_member_do,Member:pass_member_do,Member:send_verify_email'),
('会员', '删除会员', 'Member:delete_member_do'),
('会员通知', '通知列表', 'MemberNotify:list_notify'),
('会员通知', '添加通知', 'MemberNotify:add_notify_do'),
('会员通知', '删除通知', 'MemberNotify:delete_notify_do'),
('会员收藏', '收藏列表', 'MemberFavorite:list_favorite'),
('会员收藏', '删除收藏', 'MemberFavorite:delete_favorite_do'),
('会员积分订单', '积分订单列表', 'MemberCreditOrder:list_credit_order'),
('会员积分订单', '删除积分订单', 'MemberCreditOrder:delete_credit_order_do'),
('会员积分订单', '支付积分订单', 'MemberCreditOrder:pay_credit_order_do'),
('会员积分类型', '积分类型列表', 'MemberCreditType:list_credit_type'),
('会员积分类型', '添加积分类型', 'MemberCreditType:add_credit_type_do'),
('会员积分类型', '编辑积分类型', 'MemberCreditType:update_credit_type_do'),
('会员积分类型', '删除积分类型', 'MemberCreditType:delete_credit_type_do'),
('会员等级', '等级列表', 'MemberLevel:list_level'),
('会员等级', '添加等级', 'MemberLevel:add_level,MemberLevel:add_level_do'),
('会员等级', '编辑等级', 'MemberLevel:edit_level,MemberLevel:edit_level_do,MemberLevel:update_level_do'),
('会员等级', '删除等级', 'MemberLevel:delete_level_do'),
('会员权限', '权限列表', 'MemberPermission:list_permission'),
('会员权限', '添加权限', 'MemberPermission:add_permission,MemberPermission:add_permission_do,MemberPermission:get_actnList'),
('会员权限', '编辑权限', 'MemberPermission:edit_permission,MemberPermission:edit_permission_do,MemberPermission:get_actnList'),
('会员权限', '删除权限', 'MemberPermission:delete_permission_do'),
('会员模型', '模型列表', 'MemberModel:list_model'),
('会员模型', '添加模型', 'MemberModel:add_model,MemberModel:add_model_do'),
('会员模型', '编辑模型', 'MemberModel:edit_model,MemberModel:edit_model_do,MemberModel:toggle_model_status_do,MemberModel:update_model_do'),
('会员模型', '模型字段管理', 'MemberModel:add_model_field,MemberModel:add_model_field_do,MemberModel:delete_model_field_do,MemberModel:edit_model_field,MemberModel:edit_model_field_do'),
('会员模型', '导入模型', 'MemberModel:import_model,MemberModel:import_model_do,MemberModel:import_model_guide'),
('会员模型', '导出模型', 'MemberModel:export_model,MemberModel:export_model_do'),
('选项', '编辑网站选项', 'Option:edit_option_site,Option:edit_option_site_do'),
('选项', '编辑核心选项', 'Option:edit_option_core,Option:edit_option_core_do'),
('选项', '编辑首页选项', 'Option:edit_option_index,Option:edit_option_index_do'),
('选项', '编辑性能选项', 'Option:edit_option_performance,Option:edit_option_performance_do'),
('选项', '编辑上传选项', 'Option:edit_option_upload,Option:edit_option_upload_do'),
('选项', '编辑图片选项', 'Option:edit_option_image,Option:edit_option_image_do'),
('选项', '编辑会员选项', 'Option:edit_option_member,Option:edit_option_member_do'),
('选项', '编辑交互选项', 'Option:edit_option_interaction,Option:edit_option_interaction_do'),
('选项', '编辑自定义选项', 'Option:add_custom_option_do,Option:edit_custom_option,Option:edit_custom_option_do,Option:delete_custom_option_do'),
('菜单', '菜单列表', 'Menu:list_menu'),
('菜单', '添加菜单', 'Menu:add_menu,Menu:add_menu_do,Menu:get_actnList,Menu:get_menuList'),
('菜单', '编辑菜单', 'Menu:edit_menu,Menu:edit_menu_do,Menu:get_actnList,Menu:get_menuList,Menu:update_menu_do'),
('菜单', '删除菜单', 'Menu:delete_menu_do'),
('菜单展位', '展位列表', 'MenuSpace:list_space'),
('菜单展位', '添加展位', 'MenuSpace:add_space,MenuSpace:add_space_do'),
('菜单展位', '编辑展位', 'MenuSpace:edit_space,MenuSpace:edit_space_do,MenuSpace:update_space_do'),
('菜单展位', '删除展位', 'MenuSpace:delete_space_do'),
('文件浏览', '文件浏览', 'Finder:browse'),
('文件浏览', '浏览服务器', 'Finder:browse_server'),
('联动', '联动列表', 'Linkage:choose_linkage,Linkage:list_linkage'),
('联动', '添加联动', 'Linkage:add_linkage,Linkage:add_linkage_do'),
('联动', '编辑联动', 'Linkage:edit_linkage,Linkage:edit_linkage_do,Linkage:update_cache_do'),
('联动', '删除联动', 'Linkage:delete_linkage_do'),
('联动条目', '条目列表', 'LinkageItem:list_item'),
('联动条目', '添加条目', 'LinkageItem:add_item,LinkageItem:add_item_do'),
('联动条目', '编辑条目', 'LinkageItem:edit_item,LinkageItem:edit_item_do,LinkageItem:update_item_do'),
('联动条目', '删除条目', 'LinkageItem:delete_item_do'),
('管理员', '管理员列表', 'Admin:list_admin'),
('管理员', '添加及指定管理员', 'Admin:add_admin,Admin:add_admin_do,Admin:assign_admin,Admin:assign_admin_do'),
('管理员', '编辑管理员', 'Admin:edit_admin,Admin:edit_admin_do'),
('管理员', '删除管理员', 'Admin:delete_admin_do'),
('管理员角色', '角色列表', 'AdminRole:list_role'),
('管理员角色', '添加角色', 'AdminRole:add_role,AdminRole:add_role_do'),
('管理员角色', '编辑角色', 'AdminRole:edit_role,AdminRole:edit_role_do'),
('管理员角色', '删除角色', 'AdminRole:delete_role_do'),
('管理员权限', '权限列表', 'AdminPermission:list_permission'),
('管理员权限', '添加权限', 'AdminPermission:add_permission,AdminPermission:add_permission_do,AdminPermission:get_actnList'),
('管理员权限', '编辑权限', 'AdminPermission:edit_permission,AdminPermission:edit_permission_do,AdminPermission:get_actnList'),
('管理员权限', '删除权限', 'AdminPermission:delete_permission_do'),
('管理员日志', '日志列表', 'AdminLog:list_log'),
('管理员日志', '下载日志', 'AdminLog:download_log'),
('管理员日志', '删除日志', 'AdminLog:delete_old_log'),
('更新内容', '清除缓存', 'Build:clear_cache,Build:clear_cache_do'),
('更新内容', '生成内容', 'Build:build_all_do,Build:build_archive_do,Build:build_channel_do,Build:build_guide,Build:build_index_do'),
('模板', '模板及模板文件列表', 'Template:choose_template_file,Template:list_template,Template:list_template_file,Template:update_template_description_do'),
('模板', '修改模板目录', 'Template:add_template_dir,Template:add_template_dir_do,Template:delete_template_dir_do'),
('模板', '修改模板文件', 'Template:add_template_file,Template:add_template_file_do,Template:delete_template_file_do,Template:edit_template_file,Template:edit_template_file_do'),
('模板', '标签向导', 'Template:tag_preview,Template:tag_wizard,Template:update_tag_wizard_list_do'),
('工具箱', '混淆字符串', 'Toolbox:edit_garble_string,Toolbox:edit_garble_string_do'),
('工具箱', '检查重复档案', 'Toolbox:check_duplicate_archive,Toolbox:delete_duplicate_archive_do'),
('工具箱', '安全检查', 'Toolbox:build_verify_file,Toolbox:scan_code'),
('数据库', '数据库列表', 'Database:list_field,Database:list_table'),
('数据库', '备份数据表', 'Database:backup_do'),
('数据库', '修复数据库', 'Database:repair_do'),
('数据库', '优化数据库', 'Database:optimize_do'),
('数据库', '还原数据库', 'Database:list_backup_file,Database:restore_do'),
('任务', '任务列表', 'Task:list_task'),
('任务', '添加任务', 'Task:add_task,Task:add_task_do'),
('任务', '编辑任务', 'Task:edit_task,Task:edit_task_do,Task:toggle_task_status_do'),
('任务', '删除任务', 'Task:delete_task_do'),
('电子邮件', '电子邮件管理', 'Email:edit_option,Email:edit_option_do,Email:edit_template,Email:edit_template_do,Email:delete_template_do,Email:send_template,Email:send_template_do'),
('档案评论', '评论列表', 'ArchiveReview:list_review'),
('档案评论', '编辑评论', 'ArchiveReview:edit_review,ArchiveReview:edit_review_do,ArchiveReview:pass_review_do,ArchiveReview:toggle_review_status_do'),
('档案评论', '删除评论', 'ArchiveReview:delete_review_do,ArchiveReview:delete_same_ip_do'),
('报告', '报告列表', 'Report:list_report'),
('报告', '处理报告', 'Report:deal_report_do,Report:toggle_report_status_do'),
('报告', '删除报告', 'Report:delete_report_do'),
('上传', '上传列表', 'Upload:list_upload'),
('上传', '编辑上传', 'Upload:edit_upload,Upload:edit_upload_do'),
('上传', '删除上传', 'Upload:delete_upload_do'),
('上传', '上传文件', 'Upload:upload_file'),
('Tag 标签', '标签列表', 'Tag:list_tag'),
('Tag 标签', '编辑选项', 'Tag:edit_option,Tag:edit_option_do'),
('Tag 标签', '添加标签', 'Tag:add_tag,Tag:add_tag_do'),
('Tag 标签', '编辑标签', 'Tag:edit_tag,Tag:edit_tag_do'),
('Tag 标签', '删除标签', 'Tag:delete_tag_do'),
('内链', '编辑选项', 'Inlink:edit_option,Inlink:edit_option_do'),
('内链', '内链列表', 'Inlink:list_inlink'),
('内链', '添加内链', 'Inlink:add_inlink,Inlink:add_inlink_do'),
('内链', '编辑内链', 'Inlink:edit_inlink,Inlink:edit_inlink_do'),
('内链', '删除内链', 'Inlink:delete_inlink_do'),
('自定义列表', '自定义列表列表', 'CustomList:list_custom_list'),
('自定义列表', '添加自定义列表', 'CustomList:add_custom_list,CustomList:add_custom_list_do'),
('自定义列表', '编辑自定义列表', 'CustomList:edit_custom_list,CustomList:edit_custom_list_do'),
('自定义列表', '删除自定义列表', 'CustomList:delete_custom_list_do'),
('自定义列表', '生成自定义列表', 'CustomList:build_custom_list_do'),
('扩展', '扩展列表', 'Extension:list_extension'),
('扩展', '查看扩展详情', 'Extension:show_extension'),
('扩展', '安装扩展', 'Extension:install_extension,Extension:install_extension_do'),
('扩展', '卸载扩展', 'Extension:uninstall_extension_do'),
('扩展', '删除扩展', 'Extension:delete_extension_do'),
('扩展', '扩展打包', 'Extension:package_extension,Extension:package_extension_do'),
('扩展', '上传扩展', 'Extension:upload_extension,Extension:upload_extension_do'),
('其他', 'Ajax 操作', 'Ajax:check_table,Ajax:check_duplicate_archive,Ajax:check_model_alias,Ajax:delete_file,Ajax:get_channel_select,Ajax:get_default_show_template,Ajax:get_extension_hashcode,Ajax:get_file_content,Ajax:get_html_dir,Ajax:get_linkage_select,Ajax:get_model_id'),
('广告', '广告列表', 'Ad:list_ad'),
('广告', '添加广告', 'Ad:add_ad,Ad:add_ad_do'),
('广告', '编辑广告', 'Ad:edit_ad,Ad:edit_ad_do,Ad:update_ad_do'),
('广告', '删除广告', 'Ad:delete_ad_do'),
('广告位', '展位列表', 'AdSpace:list_space'),
('广告位', '添加展位', 'AdSpace:add_space,AdSpace:add_space_do'),
('广告位', '编辑展位', 'AdSpace:edit_space,AdSpace:edit_space_do,AdSpace:toggle_space_status_do'),
('广告位', '删除展位', 'AdSpace:toggle_space_status_do'),
('广告位', '生成广告 js 文件', 'AdSpace:build_js_do'),
('链接', '编辑选项', 'Flink:edit_option,Flink:edit_option_do'),
('链接', '链接列表', 'Flink:list_flink'),
('链接', '添加链接', 'Flink:add_flink,Flink:add_flink_do'),
('链接', '编辑链接', 'Flink:edit_flink,Flink:edit_flink_do,Flink:toggle_flink_status_do,Flink:update_flink_do'),
('链接', '删除链接', 'Flink:delete_flink_do'),
('链接分类', '分类列表', 'FlinkCategory:list_category'),
('链接分类', '添加分类', 'FlinkCategory:add_category_do'),
('链接分类', '编辑分类', 'FlinkCategory:update_category_do'),
('链接分类', '删除分类', 'FlinkCategory:delete_category_do'),
('留言', '编辑选项', 'Guestbook:edit_option,Guestbook:edit_option_do'),
('留言', '留言列表', 'Guestbook:list_guestbook'),
('留言', '编辑留言', 'Guestbook:edit_guestbook,Guestbook:edit_guestbook_do,Guestbook:pass_guestbook_do,Guestbook:toggle_guestbook_status_do'),
('留言', '删除留言', 'Guestbook:delete_guestbook_do,Guestbook:delete_same_ip_do'),
('单页', '单页列表', 'SinglePage:list_single_page'),
('单页', '添加单页', 'SinglePage:add_single_page,SinglePage:add_single_page_do'),
('单页', '编辑单页', 'SinglePage:edit_single_page,SinglePage:edit_single_page_do,SinglePage:update_single_page_do'),
('单页', '删除单页', 'SinglePage:delete_single_page_do'),
('单页', '生成单页', 'SinglePage:build_html_do,SinglePage:build_url_do'),
('投票', '投票列表', 'Vote:list_vote'),
('投票', '添加投票', 'Vote:add_vote,Vote:add_vote_do'),
('投票', '编辑投票', 'Vote:edit_vote,Vote:edit_vote_do,Vote:toggle_vote_status_do'),
('投票', '删除投票', 'Vote:delete_vote_do'),
('投票', '生成投票 js 文件', 'Vote:build_js_do'),
('投票', '清除投票记录', 'Vote:clear_vote_record_do');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_admin_role`
--

DROP TABLE IF EXISTS `prefix_admin_role`;
CREATE TABLE IF NOT EXISTS `prefix_admin_role` (
  `admin_role_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Administrator Role ID',
  `ar_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Administrator Role Name',
  `ar_rank` smallint(5) NOT NULL DEFAULT '0' COMMENT 'Administrator Role Rank(-1:Super Administrator)',
  `ar_permission` text NOT NULL COMMENT 'Administrator Role Permission(_all:all)',
  `ar_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Administrator Role Type(0:system, 1:custom)',
  PRIMARY KEY (`admin_role_id`),
  KEY `admin_role_id` (`admin_role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Administrator Role' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `prefix_admin_role`
--

INSERT INTO `prefix_admin_role` (`admin_role_id`, `ar_name`, `ar_rank`, `ar_permission`, `ar_type`) VALUES
(1, '超级管理员', -1, '_all', 0),
(2, '网站管理员', 10, '_all', 1),
(3, '网站编辑', 5, 'Ajax:check_table,Ajax:check_duplicate_archive,Ajax:check_model_alias,Ajax:delete_file,Ajax:get_channel_select,Ajax:get_default_show_template,Ajax:get_extension_hashcode,Ajax:get_file_content,Ajax:get_html_dir,Ajax:get_linkage_select,Ajax:get_model_id,Archive:add_archive,Archive:add_archive_do,Archive:add_flag_do,Archive:build_html_do,Archive:change_channel_do,Archive:choose_archive,Archive:delete_archive_do,Archive:delete_flag_do,Archive:edit_archive,Archive:edit_archive_do,Archive:list_archive,Archive:pass_archive_do,Archive:refund_archive_do,ArchiveChannel:list_channel,ArchiveReview:delete_review_do,ArchiveReview:delete_same_ip_do,ArchiveReview:edit_review,ArchiveReview:edit_review_do,ArchiveReview:list_review,ArchiveReview:pass_review_do,ArchiveReview:toggle_review_status_do,Finder:browse,Finder:browse_server,Tag:add_tag,Tag:add_tag_do,Tag:delete_tag_do,Tag:edit_option,Tag:edit_option_do,Tag:edit_tag,Tag:edit_tag_do,Tag:list_tag,Upload:delete_upload_do,Upload:edit_upload,Upload:edit_upload_do,Upload:list_upload,Upload:upload_file', 1);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_ad_space`
--

DROP TABLE IF EXISTS `prefix_ad_space`;
CREATE TABLE IF NOT EXISTS `prefix_ad_space` (
  `ad_space_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Ad Space ID',
  `as_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Ad Space Name',
  `as_type` varchar(32) NOT NULL DEFAULT 'code' COMMENT 'Ad Space Type(code, text, image, flash, slide)',
  `as_width` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Space Width',
  `as_height` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Space Height',
  `as_default` text NOT NULL COMMENT 'Ad Space Default Content',
  `as_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Ad Space Status(0:off, 1:on)',
  PRIMARY KEY (`ad_space_id`),
  KEY `ad_space_id` (`ad_space_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Ad Space' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `prefix_ad_space`
--

INSERT INTO `prefix_ad_space` (`ad_space_id`, `as_name`, `as_type`, `as_width`, `as_height`, `as_default`, `as_status`) VALUES
(1, '300x200 通用大方块', 'image', 300, 200, '300x200 通用大方块', 1),
(2, '650x60 通用横幅', 'image', 650, 60, '650x60 通用横幅', 1),
(3, '200x200 内页', 'image', 200, 200, '200x200 内页', 1),
(4, '960x360 登录页', 'image', 960, 360, '960x360 登录页', 1),
(5, '20:5 移动横幅', 'image', 800, 200, '20:5 移动横幅', 1);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive`
--

DROP TABLE IF EXISTS `prefix_archive`;
CREATE TABLE IF NOT EXISTS `prefix_archive` (
  `archive_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Archive ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID(0:guest)',
  `m_username` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Username',
  `a_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Title',
  `a_short_title` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Short Title',
  `a_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Thumb',
  `a_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Keywords',
  `a_description` text NOT NULL COMMENT 'Archive Description',
  `a_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Add Time',
  `a_edit_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Edit Time',
  `a_add_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Archive Add IP',
  `a_edit_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Archive Edit IP',
  `a_cost_points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Cost Points',
  `a_view_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive View Count',
  `a_review_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Review Count',
  `a_support_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Support Count',
  `a_oppose_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Oppose Count',
  `a_rank` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Rank',
  `a_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Status(0:pending, 1:audited, 2:send back)',
  `a_review_switch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Review Switch(0:off, 1:on)',
  `a_tpl` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Template',
  `a_is_html` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Build html File Switch(0:off, 1:on)',
  `a_html_path` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'html path(0:channel default, 1:custom)',
  `a_html_naming` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive html File Naming',
  `a_related` varchar(255) NOT NULL DEFAULT '' COMMENT 'Related Archive IDs',
  `af_alias` set('h','a','c','s','p') NOT NULL DEFAULT '' COMMENT 'Archive Flag Alias',
  `archive_channel_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Channel ID',
  `a_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive URL',
  `a_url_o` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive URL Origin',
  PRIMARY KEY (`archive_id`),
  KEY `main_index` (`archive_id`,`af_alias`,`member_id`),
  KEY `for_sort` (`a_status`,`a_add_time`,`a_edit_time`,`a_view_count`,`archive_channel_id`,`a_rank`),
  KEY `extra_index` (`a_support_count`,`a_oppose_count`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Archive' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_archive`
--

INSERT INTO `prefix_archive` (`archive_id`, `member_id`, `m_username`, `a_title`, `a_short_title`, `a_thumb`, `a_keywords`, `a_description`, `a_add_time`, `a_edit_time`, `a_add_ip`, `a_edit_ip`, `a_cost_points`, `a_view_count`, `a_review_count`, `a_support_count`, `a_oppose_count`, `a_rank`, `a_status`, `a_review_switch`, `a_tpl`, `a_is_html`, `a_html_path`, `a_html_naming`, `a_related`, `af_alias`, `archive_channel_id`, `a_url`, `a_url_o`) VALUES
(1, 1, '创始人', 'UWA(Universal Website AsThis)', '', '{-site_url-}u/article/thumb_01.jpg', 'UWA,2.X', 'UWA 是如斯基于 PHP 和 MySQL 开发的通用建站系统，程序简洁、灵活而具备强大的扩展性。', {-time-}, {-time-}, '{-ip-}', '{-ip-}', 0, 39, 0, 10, 0, 50, 1, 1, '', 1, 0, '', '', 'h,a,c,s,p', 1, '{-site_url-}index.php?c=archive&a=show_archive&archive_id=1', '{-site_url-}index.php?c=archive&a=show_archive&archive_id=1');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive_addon_article`
--

DROP TABLE IF EXISTS `prefix_archive_addon_article`;
CREATE TABLE IF NOT EXISTS `prefix_archive_addon_article` (
  `archive_id` int(10) unsigned NOT NULL COMMENT 'Archive ID',
  `a_a_source` varchar(32) NOT NULL DEFAULT '' COMMENT 'Article Source',
  `a_a_author` varchar(32) NOT NULL DEFAULT '' COMMENT 'Article Author',
  `a_a_content` mediumtext NOT NULL COMMENT 'Article Content',
  PRIMARY KEY (`archive_id`),
  KEY `archive_id` (`archive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Article';

--
-- 转存表中的数据 `prefix_archive_addon_article`
--

INSERT INTO `prefix_archive_addon_article` (`archive_id`, `a_a_source`, `a_a_author`, `a_a_content`) VALUES
(1, '', '', '<p>UWA 是如斯基于 PHP 和 MySQL 开发的通用建站系统，程序简洁、灵活而具备强大的扩展性。</p>\r\n\r\n<p><span style="font-size:18px"><strong>UWA 功能特点:</strong></span></p>\r\n\r\n<ul>\r\n	<li><strong>&#091;PFA 内核&#093;</strong> 简洁、优雅的高质量代码具有极高的通用性和扩展性。</li>\r\n	<li><strong>&#091;档案模型&#093;</strong> 自定义档案模型，丰富网站，便于内容扩展及二次开发。</li>\r\n	<li><strong>&#091;极速高效&#093;</strong> 高效的动静态页面部署，数据多重缓存，网站极速访问。</li>\r\n	<li><strong>&#091;自动更新&#093;</strong> 网站页面周期性自动更新，降低维护成本及服务器压力。</li>\r\n	<li><strong>&#091;会员中心&#093;</strong> 会员中心及可定制的会员模型，让您的网站交互火起来。</li>\r\n	<li><strong>&#091;功能扩展&#093;</strong> 扩展/插件/模板/模型一键安装、卸载。</li>\r\n	<li><strong>&#091;多语言支持&#093;</strong> UTF-8 编码，语言侦测，方便快捷地开发国际性网站。</li>\r\n	<li><strong>&#091;模板引擎&#093;</strong> 简单易用的模板引擎，界面设计方便快捷。</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive_addon_thematic`
--

DROP TABLE IF EXISTS `prefix_archive_addon_thematic`;
CREATE TABLE IF NOT EXISTS `prefix_archive_addon_thematic` (
  `archive_id` int(10) unsigned NOT NULL,
  `a_t_abstract` mediumtext NOT NULL COMMENT 'Thematic abstract',
  `a_t_node` text NOT NULL COMMENT 'Thematic Node',
  PRIMARY KEY (`archive_id`),
  KEY `archive_id` (`archive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Thematic';

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive_channel`
--

DROP TABLE IF EXISTS `prefix_archive_channel`;
CREATE TABLE IF NOT EXISTS `prefix_archive_channel` (
  `archive_channel_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Archive Channel ID',
  `ac_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Channel Name',
  `ac_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel Thumb',
  `ac_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel Keywords',
  `ac_description` text NOT NULL COMMENT 'Archive Channel Description',
  `ac_content` text NOT NULL COMMENT 'Archive Channel Content(Can Be Used As Single Page)',
  `ac_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Archive Channel Type(1:index, 2:list)',
  `ac_parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Channel Parent ID',
  `ac_display_switch` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Archive Channel Display Switch(0:hidden, 1:show)',
  `ac_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Channel Display Order',
  `ac_tpl_index` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Channel Index Template',
  `ac_tpl_list` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Channel List Template',
  `ac_tpl_archive` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Channel Archive Template',
  `ac_page_size` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT 'Archive Channel Page Size',
  `ac_view_ml_ids` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel View Member Level Ids(-1:off, 0:open, str:ids)',
  `ac_add_ml_ids` varchar(255) NOT NULL DEFAULT '' COMMENT 'Add Archive Member Level Ids(-1:off, 0:open, str:ids)',
  `ac_pass_switch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Pass Switch(0:off,auto pass, 1:on,need check)',
  `ac_review_switch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Review Switch(0:off, 1:on)',
  `ac_is_html` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Html File Build Switch(0:off, 1:on, 2:only archive)',
  `ac_html_dir` varchar(255) NOT NULL DEFAULT '' COMMENT 'html File Dir',
  `ac_html_index` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Channel Index File Name',
  `ac_html_naming_list` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive List html File Naming',
  `ac_html_naming_archive` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive html File Naming',
  `archive_model_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Model ID',
  `ac_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel URL',
  `ac_url_o` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel URL Origin',
  PRIMARY KEY (`archive_channel_id`),
  KEY `archive_channel_id` (`archive_channel_id`,`ac_display_order`,`ac_display_switch`,`archive_model_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Archive Channel' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_archive_channel`
--

INSERT INTO `prefix_archive_channel` (`archive_channel_id`, `ac_name`, `ac_thumb`, `ac_keywords`, `ac_description`, `ac_content`, `ac_type`, `ac_parent_id`, `ac_display_switch`, `ac_display_order`, `ac_tpl_index`, `ac_tpl_list`, `ac_tpl_archive`, `ac_page_size`, `ac_view_ml_ids`, `ac_add_ml_ids`, `ac_pass_switch`, `ac_review_switch`, `ac_is_html`, `ac_html_dir`, `ac_html_index`, `ac_html_naming_list`, `ac_html_naming_archive`, `archive_model_id`, `ac_url`, `ac_url_o`) VALUES
(1, '文章频道', '', '', '', '', 2, 0, 1, 10, 'index_channel_article', 'list_archive_article', 'show_archive_article', 20, '0', '0', 1, 1, 1, '{uwa_path}a/01', 'index', 'list_{ac_id}_{page}', '{Y}{M}/{D}/{a_id}', 2, '{-site_url-}index.php?c=archive&a=show_channel&archive_channel_id=1', '{-site_url-}index.php?c=archive&a=show_channel&archive_channel_id=1');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive_flag`
--

DROP TABLE IF EXISTS `prefix_archive_flag`;
CREATE TABLE IF NOT EXISTS `prefix_archive_flag` (
  `af_alias` varchar(10) NOT NULL COMMENT 'Archive Flag Alias(English)',
  `af_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Flag Name',
  `af_display_order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Flag Display Order',
  PRIMARY KEY (`af_alias`),
  KEY `af_alias` (`af_alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Archive Flag';

--
-- 转存表中的数据 `prefix_archive_flag`
--

INSERT INTO `prefix_archive_flag` (`af_alias`, `af_name`, `af_display_order`) VALUES
('h', '头条', 1),
('a', '特荐', 2),
('c', '推荐', 3),
('s', '幻灯', 4),
('p', '图片', 5);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive_model`
--

DROP TABLE IF EXISTS `prefix_archive_model`;
CREATE TABLE IF NOT EXISTS `prefix_archive_model` (
  `archive_model_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Archive Model ID',
  `am_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Archive Model Alias(English)',
  `am_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Name',
  `am_addon_table` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Addon Table',
  `am_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Archive Model Type(0:system, 1:custom)',
  `am_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Archive Model Status(0:off, 1:on)',
  `am_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Model Display Order',
  `am_tpl_list` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Manage Template - List',
  `am_tpl_add` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Manage Template - Add',
  `am_tpl_edit` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Manage Template - Edit',
  `am_tpl_list_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Manage Template - List for Member',
  `am_tpl_add_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Manage Template - Add for Member',
  `am_tpl_edit_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Model Manage Template - Edit for Member',
  `ac_tpl_index_default` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel Index Default Template',
  `ac_tpl_list_default` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel List Default Template',
  `ac_tpl_archive_default` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Channel Archive Default Template',
  `am_fieldset` text NOT NULL COMMENT 'Archive Model Addon Table Fieldset',
  PRIMARY KEY (`archive_model_id`),
  KEY `archive_model_id` (`archive_model_id`),
  KEY `am_alias` (`am_alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Archive Model' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `prefix_archive_model`
--

INSERT INTO `prefix_archive_model` (`archive_model_id`, `am_alias`, `am_name`, `am_addon_table`, `am_type`, `am_status`, `am_display_order`, `am_tpl_list`, `am_tpl_add`, `am_tpl_edit`, `am_tpl_list_member`, `am_tpl_add_member`, `am_tpl_edit_member`, `ac_tpl_index_default`, `ac_tpl_list_default`, `ac_tpl_archive_default`, `am_fieldset`) VALUES
(1, 'thematic', '专题', 'archive_addon_thematic', 0, 1, 90, 'archive/list_archive_thematic', 'archive/add_archive_thematic', 'archive/edit_archive_thematic', 'archive/list_archive_thematic', 'archive/add_archive_thematic', 'archive/edit_archive_thematic', 'index_channel_thematic', 'list_archive_thematic', 'show_archive_thematic', '<field:a_t_abstract f_item_name="专题导读" f_type="htmltext" f_length="" f_default="" f_is_auto="1" f_is_list="0" f_is_filter="1" f_save_remote="1" f_watermark_remote="1" f_get_thumb="1" f_get_abstract="1" f_is_paging="0" >\r\n</field:a_t_abstract>\r\n<field:a_t_node f_item_name="节点" f_type="multitext" f_length="" f_default="" f_is_auto="0" f_is_list="0" f_is_filter="0" f_is_serialize="1" >\r\n</field:a_t_node>'),
(2, 'article', '文章', 'archive_addon_article', 0, 1, 10, 'archive/list_archive_article', 'archive/add_archive_article', 'archive/edit_archive_article', 'archive/list_archive_article', 'archive/add_archive_article', 'archive/edit_archive_article', 'index_channel_article', 'list_archive_article', 'show_archive_article', '<field:a_a_source f_item_name="文章来源" f_type="simpletext" f_length="32" f_default="" f_is_auto="0" f_is_list="1" f_is_filter="0" >\r\n</field:a_a_source>\r\n<field:a_a_author f_item_name="文章作者" f_type="simpletext" f_length="32" f_default="" f_is_auto="0" f_is_list="1" f_is_filter="0" >\r\n</field:a_a_author>\r\n<field:a_a_content f_item_name="文章内容" f_type="htmltext" f_length="" f_default="" f_is_auto="1" f_is_list="0" f_is_filter="1" f_save_remote="1" f_watermark_remote="1" f_get_thumb="1" f_get_abstract="1" f_is_paging="1" >\r\n</field:a_a_content>');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_archive_review`
--

DROP TABLE IF EXISTS `prefix_archive_review`;
CREATE TABLE IF NOT EXISTS `prefix_archive_review` (
  `archive_review_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Archive Review ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID(0:guest)',
  `ar_author` varchar(255) NOT NULL DEFAULT '' COMMENT 'Archive Review Author',
  `ar_content` text NOT NULL COMMENT 'Archive Review Content',
  `ar_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Review Status(0:not passed, 1:passed, 2:filter)',
  `ar_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Review Add Time',
  `ar_add_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Archive Review Add IP',
  `ar_support_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Review Support Count',
  `ar_oppose_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Review Oppose Count',
  `ar_reply` text NOT NULL COMMENT 'Archive Review Reply',
  `archive_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive ID',
  `archive_channel_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive Channel ID',
  PRIMARY KEY (`archive_review_id`),
  KEY `archive_review_id` (`archive_review_id`),
  KEY `archive_id` (`archive_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Archive Review' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_custom_list`
--

DROP TABLE IF EXISTS `prefix_custom_list`;
CREATE TABLE IF NOT EXISTS `prefix_custom_list` (
  `custom_list_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Custom List ID',
  `cl_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom List Title',
  `cl_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom List Keywords',
  `cl_description` text NOT NULL COMMENT 'Custom List Description',
  `cl_is_build` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'File Build Switch',
  `cl_tpl` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom List Template',
  `cl_build_naming` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom List Build File Naming',
  `cl_content_type` varchar(96) NOT NULL DEFAULT 'text/html' COMMENT 'Custom List Content Type',
  `cl_config` text NOT NULL COMMENT 'Custom List Config',
  `cl_update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Custom List Update Time',
  PRIMARY KEY (`custom_list_id`),
  KEY `custom_list_id` (`custom_list_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Custom List' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_custom_list`
--

INSERT INTO `prefix_custom_list` (`custom_list_id`, `cl_title`, `cl_keywords`, `cl_description`, `cl_is_build`, `cl_tpl`, `cl_build_naming`, `cl_content_type`, `cl_config`, `cl_update_time`) VALUES
(1, 'Sitemap', 'Sitemap', '', 1, 'sitemap_xml', '{uwa_path}sitemap/SiteMap_{page}.xml', 'text/xml', 'a:8:{s:3:"cid";s:3:"all";s:4:"flag";s:0:"";s:4:"days";s:0:"";s:8:"keywords";s:0:"";s:7:"orderby";s:11:"a_edit_time";s:5:"order";s:4:"desc";s:3:"row";s:3:"500";s:8:"max_page";s:3:"100";}', {-time-});

-- --------------------------------------------------------

--
-- 表的结构 `prefix_custom_model`
--

DROP TABLE IF EXISTS `prefix_custom_model`;
CREATE TABLE IF NOT EXISTS `prefix_custom_model` (
  `custom_model_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Custom Model ID',
  `cm_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Custom Model Alias(English)',
  `cm_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom Model Name',
  `cm_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom Model Keywords',
  `cm_description` text NOT NULL COMMENT 'Custom Model Description',
  `cm_content` text NOT NULL COMMENT 'Custom Model Content',
  `cm_table` varchar(255) NOT NULL DEFAULT '' COMMENT 'Custom Model table',
  `cm_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Custom Model Status(0:off, 1:on)',
  `cm_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Custom Model Display Order',
  `cm_page_size` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT 'Custom Model Content Page Size',
  `cm_view_ml_ids` varchar(255) NOT NULL DEFAULT '' COMMENT 'Content View Member Level Ids(-1:off, 0:open, str:ids)',
  `cm_add_ml_ids` varchar(255) NOT NULL DEFAULT '' COMMENT 'Content Add Member Level Ids(-1:off, 0:open, str:ids)',
  `cm_pass_switch` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Pass Switch(0:off,auto pass, 1:on,need check)',
  `cm_tpl_list_home` varchar(255) NOT NULL DEFAULT '' COMMENT 'List template',
  `cm_tpl_show_home` varchar(255) NOT NULL DEFAULT '' COMMENT 'Show Template',
  `cm_tpl_list_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member List template',
  `cm_tpl_add_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Add Template',
  `cm_tpl_edit_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Edit template',
  `cm_tpl_list_admin` varchar(255) NOT NULL DEFAULT '' COMMENT 'Admin List template',
  `cm_tpl_add_admin` varchar(255) NOT NULL DEFAULT '' COMMENT 'Admin Add Template',
  `cm_tpl_edit_admin` varchar(255) NOT NULL DEFAULT '' COMMENT 'Admin Edit Template',
  `cm_fieldset` text NOT NULL COMMENT 'Table Fieldset',
  PRIMARY KEY (`custom_model_id`),
  KEY `custom_model_id` (`custom_model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Custom Model' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_extension`
--

DROP TABLE IF EXISTS `prefix_extension`;
CREATE TABLE IF NOT EXISTS `prefix_extension` (
  `extension_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Plugin Id',
  `e_hashcode` char(32) NOT NULL DEFAULT '' COMMENT 'Extension Hashcode(md5(e_alias|e_author|e_author_email))',
  `e_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Extension Name',
  `e_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Extension Alias',
  `e_type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Extension Type',
  `e_manage_menu` text NOT NULL COMMENT 'Extension Manage Menu()',
  PRIMARY KEY (`extension_id`),
  KEY `e_hashcode` (`e_hashcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Extension' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_flink`
--

DROP TABLE IF EXISTS `prefix_flink`;
CREATE TABLE IF NOT EXISTS `prefix_flink` (
  `flink_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Friend Link ID',
  `f_site_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Link Site Name',
  `f_site_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Link Site URL',
  `f_site_logo` varchar(255) NOT NULL DEFAULT '' COMMENT 'Link Site Logo',
  `f_site_description` text NOT NULL COMMENT 'Link Site Description',
  `f_webmaster_email` varchar(255) NOT NULL DEFAULT '' COMMENT 'Link Site Webmaster Email',
  `f_show_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Link Show Type(0:text, 1:logo)',
  `f_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Link Display Order',
  `f_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Link Status(0:not pass, 1:passed)',
  `flink_category_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Friend Link Category ID',
  PRIMARY KEY (`flink_id`),
  KEY `flink_id` (`flink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Firend Link' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_flink`
--

INSERT INTO `prefix_flink` (`flink_id`, `f_site_name`, `f_site_url`, `f_site_logo`, `f_site_description`, `f_webmaster_email`, `f_show_type`, `f_display_order`, `f_status`, `flink_category_id`) VALUES
(1, '如斯', 'http://asthis.net', '', '如斯官方网站', '', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_flink_category`
--

DROP TABLE IF EXISTS `prefix_flink_category`;
CREATE TABLE IF NOT EXISTS `prefix_flink_category` (
  `flink_category_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Friend Link Category ID',
  `fc_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Friend Link Category Name',
  `fc_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Friend Link Category Display Order',
  PRIMARY KEY (`flink_category_id`),
  KEY `flink_category_id` (`flink_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Friend Link Category' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_flink_category`
--

INSERT INTO `prefix_flink_category` (`flink_category_id`, `fc_name`, `fc_display_order`) VALUES
(1, '合作媒体', 0);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_guestbook`
--

DROP TABLE IF EXISTS `prefix_guestbook`;
CREATE TABLE IF NOT EXISTS `prefix_guestbook` (
  `guestbook_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Guestbook ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID(0:guest)',
  `g_author` varchar(255) NOT NULL DEFAULT '' COMMENT 'Guestbook Author',
  `g_content` text NOT NULL COMMENT 'Guestbook Content',
  `g_reply` text NOT NULL COMMENT 'Guestbook Reply',
  `g_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Guestbook Status(0:not passed, 1:passed, 2:filter)',
  `g_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Guestbook Add Time',
  `g_add_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Guestbook Add IP',
  PRIMARY KEY (`guestbook_id`),
  KEY `guestbook_id` (`guestbook_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Guestbook' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_guestbook`
--

INSERT INTO `prefix_guestbook` (`guestbook_id`, `member_id`, `g_author`, `g_content`, `g_reply`, `g_status`, `g_add_time`, `g_add_ip`) VALUES
(1, 1, 'UWA游客', 'UWA留言内容', '管理回复内容', 1, {-time-}, '{-ip-}');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_inlink`
--

DROP TABLE IF EXISTS `prefix_inlink`;
CREATE TABLE IF NOT EXISTS `prefix_inlink` (
  `inlink_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Inner Link ID',
  `il_word` varchar(96) NOT NULL DEFAULT '' COMMENT 'Inner Link Word',
  `il_title` text NOT NULL COMMENT 'Inner Link Title',
  `il_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Inner Link URL',
  `il_target` varchar(255) NOT NULL DEFAULT '' COMMENT 'Inner Link Target',
  PRIMARY KEY (`inlink_id`),
  KEY `inlink_id` (`inlink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Inner Link' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_inlink`
--

INSERT INTO `prefix_inlink` (`inlink_id`, `il_word`, `il_title`, `il_url`, `il_target`) VALUES
(1, '如斯', '如斯官方网站', 'http://asthis.net', '_blank');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_linkage`
--

DROP TABLE IF EXISTS `prefix_linkage`;
CREATE TABLE IF NOT EXISTS `prefix_linkage` (
  `linkage_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Linkage ID',
  `l_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Linkage Name',
  `l_alias` varchar(32) NOT NULL DEFAULT '' COMMENT 'Linkage Alias',
  `l_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Linkage Type(0:system, 1:custom)',
  `l_description` tinytext NOT NULL COMMENT 'Linkage Description',
  PRIMARY KEY (`linkage_id`),
  KEY `linkage_id` (`linkage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Linkage' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_linkage`
--

INSERT INTO `prefix_linkage` (`linkage_id`, `l_name`, `l_alias`, `l_type`, `l_description`) VALUES
(1, '地区', 'area', 0, '地区联动选择');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_linkage_item`
--

DROP TABLE IF EXISTS `prefix_linkage_item`;
CREATE TABLE IF NOT EXISTS `prefix_linkage_item` (
  `linkage_item_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Linkage Item ID',
  `li_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Linkage Item Name',
  `li_display_order` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Linkage Item Display Order',
  `li_parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT 'Linkage Item Parent ID',
  `l_alias` varchar(32) NOT NULL DEFAULT '' COMMENT 'Linkage Alias',
  PRIMARY KEY (`linkage_item_id`),
  KEY `linkage_item_id` (`linkage_item_id`),
  KEY `l_alias` (`l_alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Linkage Item' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `prefix_linkage_item`
--

INSERT INTO `prefix_linkage_item` (`linkage_item_id`, `li_name`, `li_display_order`, `li_parent_id`, `l_alias`) VALUES
(1, '中国', 0, 0, 'area'),
(2, '北京', 0, 1, 'area');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member`
--

DROP TABLE IF EXISTS `prefix_member`;
CREATE TABLE IF NOT EXISTS `prefix_member` (
  `member_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member ID',
  `m_userid` varchar(32) NOT NULL DEFAULT '' COMMENT 'Member UserID(for login)',
  `m_password` varchar(32) NOT NULL DEFAULT '' COMMENT 'Member Password',
  `m_username` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Username(display)',
  `m_email` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Email',
  `m_reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Register Time',
  `m_reg_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Member Register IP',
  `m_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Login Time',
  `m_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Member Login IP',
  `m_experience` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Experience(related with permission levels)',
  `m_points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Points(related with spending)',
  `m_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Status(0:not pass, 1:passed, 2:forbidden)',
  `member_level_id` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Level ID',
  `member_model_id` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Model ID',
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `m_userid` (`m_userid`),
  KEY `main_index` (`member_id`,`m_userid`,`m_status`,`member_level_id`,`member_model_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Member' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_member`
--

INSERT INTO `prefix_member` (`member_id`, `m_userid`, `m_password`, `m_username`, `m_email`, `m_reg_time`, `m_reg_ip`, `m_login_time`, `m_login_ip`, `m_experience`, `m_points`, `m_status`, `member_level_id`, `member_model_id`) VALUES
(1, '{-ausr-}', '{-apwd-}', '创始人', '{-email-}', {-time-}, '{-ip-}', {-time-}, '{-ip-}', 7, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_addon_person`
--

DROP TABLE IF EXISTS `prefix_member_addon_person`;
CREATE TABLE IF NOT EXISTS `prefix_member_addon_person` (
  `member_id` int(10) unsigned NOT NULL COMMENT 'Member ID',
  `m_p_gender` enum('m','f','s') NOT NULL DEFAULT 'm' COMMENT 'gender:m|male, f|female, s|secret',
  PRIMARY KEY (`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Person';

--
-- 转存表中的数据 `prefix_member_addon_person`
--

INSERT INTO `prefix_member_addon_person` (`member_id`, `m_p_gender`) VALUES
(1, 's');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_credit`
--

DROP TABLE IF EXISTS `prefix_member_credit`;
CREATE TABLE IF NOT EXISTS `prefix_member_credit` (
  `member_id` int(10) unsigned NOT NULL COMMENT 'Member ID',
  `mc_credit` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Credit',
  `mc_copper` int(10) unsigned NOT NULL DEFAULT '10' COMMENT 'Copper',
  `mc_silver` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Silver',
  PRIMARY KEY (`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Member Credit Data';

--
-- 转存表中的数据 `prefix_member_credit`
--

INSERT INTO `prefix_member_credit` (`member_id`, `mc_credit`, `mc_copper`, `mc_silver`) VALUES
(1, 0, 50, 0);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_credit_order`
--

DROP TABLE IF EXISTS `prefix_member_credit_order`;
CREATE TABLE IF NOT EXISTS `prefix_member_credit_order` (
  `member_credit_order_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member Order ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID',
  `mco_seller_member_id` int(10) unsigned NOT NULL COMMENT 'Credit Seller Member Id',
  `mco_product_type` varchar(96) NOT NULL DEFAULT '' COMMENT 'Credit Order Product Type',
  `mco_product_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Credit Order Product Name',
  `mco_points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Credit Order Points',
  `mco_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Credit Order Status',
  `mco_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Credit Order Add Time',
  `mco_add_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Credit Order Add IP',
  PRIMARY KEY (`member_credit_order_id`),
  KEY `member_id` (`member_id`),
  KEY `member_credit_order_id` (`member_credit_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Member Credit Order' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_credit_type`
--

DROP TABLE IF EXISTS `prefix_member_credit_type`;
CREATE TABLE IF NOT EXISTS `prefix_member_credit_type` (
  `member_credit_type_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member Credit Type ID',
  `mct_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Credit Type Alias(for field name)',
  `mct_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Credit Type Name',
  `mct_unit` varchar(96) NOT NULL COMMENT 'Member Credit Type Unit',
  `mct_default` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Credit Type Default Value',
  `mct_exchange` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Credit Type Exchange Switch(0:off, 1:on)',
  `mct_ratio` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Credit Type Exchange Ratio',
  PRIMARY KEY (`member_credit_type_id`),
  KEY `member_credit_type_id` (`member_credit_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Member Credit Type' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `prefix_member_credit_type`
--

INSERT INTO `prefix_member_credit_type` (`member_credit_type_id`, `mct_alias`, `mct_name`, `mct_unit`, `mct_default`, `mct_exchange`, `mct_ratio`) VALUES
(1, 'mc_credit', '积分', '分', 0, 0, 1),
(2, 'mc_copper', '铜钱', '钱', 10, 1, 1),
(3, 'mc_silver', '银子', '两', 0, 1, 1000);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_email_verify`
--

DROP TABLE IF EXISTS `prefix_member_email_verify`;
CREATE TABLE IF NOT EXISTS `prefix_member_email_verify` (
  `mev_code` char(32) NOT NULL DEFAULT '' COMMENT 'Member Email Verify',
  `mev_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Email Verify Add Time',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID',
  PRIMARY KEY (`mev_code`),
  KEY `member_id` (`member_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Member Email Verify';

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_favorite`
--

DROP TABLE IF EXISTS `prefix_member_favorite`;
CREATE TABLE IF NOT EXISTS `prefix_member_favorite` (
  `member_favorite_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member Favorite ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID',
  `archive_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Archive ID',
  `mf_title` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Favorite Title',
  `mf_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Favorite URL',
  `mf_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Favorite Add Time',
  PRIMARY KEY (`member_favorite_id`),
  KEY `member_favorite_id` (`member_favorite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Member Favorite' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_level`
--

DROP TABLE IF EXISTS `prefix_member_level`;
CREATE TABLE IF NOT EXISTS `prefix_member_level` (
  `member_level_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member Level ID',
  `ml_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Level Name',
  `ml_rank` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Member Level Rank',
  `ml_min_experience` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Level Min Experience',
  `ml_permission` text NOT NULL COMMENT 'Member Level Permission(_all:all)',
  `ml_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Level Type(0:system, 1:custom)',
  `ml_upload_option` text NOT NULL COMMENT 'Member Level Upload Option',
  PRIMARY KEY (`member_level_id`),
  KEY `member_level_id` (`member_level_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Member Level' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `prefix_member_level`
--

INSERT INTO `prefix_member_level` (`member_level_id`, `ml_name`, `ml_rank`, `ml_min_experience`, `ml_permission`, `ml_type`, `ml_upload_option`) VALUES
(1, '注册会员', 1, 0, '_all', 1, 'a:5:{s:6:"switch";s:1:"1";s:7:"imgtype";s:16:"jpg,jpeg,gif,png";s:8:"filetype";s:10:"zip,7z,rar";s:5:"space";s:5:"51200";s:7:"maxsize";s:3:"512";}'),
(2, '中级会员', 5, 500, '_all', 1, 'a:5:{s:6:"switch";s:1:"1";s:7:"imgtype";s:16:"jpg,jpeg,gif,png";s:8:"filetype";s:10:"zip,7z,rar";s:5:"space";s:6:"102400";s:7:"maxsize";s:3:"512";}'),
(3, '高级会员', 10, 2000, '_all', 1, 'a:5:{s:6:"switch";s:1:"1";s:7:"imgtype";s:16:"jpg,jpeg,gif,png";s:8:"filetype";s:10:"zip,7z,rar";s:5:"space";s:6:"102400";s:7:"maxsize";s:3:"512";}'),
(4, 'VIP 1', 50, 0, '_all', 0, 'a:5:{s:6:"switch";s:1:"1";s:7:"imgtype";s:16:"jpg,jpeg,gif,png";s:8:"filetype";s:10:"zip,7z,rar";s:5:"space";s:6:"102400";s:7:"maxsize";s:3:"512";}');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_model`
--

DROP TABLE IF EXISTS `prefix_member_model`;
CREATE TABLE IF NOT EXISTS `prefix_member_model` (
  `member_model_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member Model ID',
  `mm_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Model Alias(English)',
  `mm_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Model Name',
  `mm_addon_table` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Model Addon Table',
  `mm_agreement` text NOT NULL COMMENT 'Member Model Agreement',
  `mm_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Model Type(0:system, 1:custom)',
  `mm_default_level` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Model Default Level ID',
  `mm_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Member Model Status(0:off, 1:on)',
  `mm_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Member Model Display Order',
  `mm_tpl_add` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Model Manage Template - Add',
  `mm_tpl_edit` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Model Manage Template - Edit',
  `mm_tpl_add_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Model Manage Template - Add for Member',
  `mm_tpl_edit_member` varchar(255) NOT NULL DEFAULT '' COMMENT 'Member Model Manage Template - Edit for Member',
  `mm_fieldset` text NOT NULL COMMENT 'Member Model Fieldset',
  PRIMARY KEY (`member_model_id`),
  KEY `member_model_id` (`member_model_id`),
  KEY `mm_alias` (`mm_alias`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Member Model' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_member_model`
--

INSERT INTO `prefix_member_model` (`member_model_id`, `mm_alias`, `mm_name`, `mm_addon_table`, `mm_agreement`, `mm_type`, `mm_default_level`, `mm_status`, `mm_display_order`, `mm_tpl_add`, `mm_tpl_edit`, `mm_tpl_add_member`, `mm_tpl_edit_member`, `mm_fieldset`) VALUES
(1, 'person', '个人', 'member_addon_person', '<p style="text-align: center;"><span style="font-size:16px"><strong>UWA个人会员使用协议</strong></span></p>\r\n<p>1、在本站注册的会员，必须遵守《互联网电子公告服务管理规定》，不得在本站发表诽谤他人，侵犯他人隐私，侵犯他人知识产权，传播病毒，政治言论，商业讯息等信息。</p>\r\n<p>2、所有在本站发表的文章，本站都具有最终编辑权，并且保留用于印刷或向第三方发表的权利，如果你的资料不齐全，我们将有权不作任何通知使用你在本站发布的作品。</p>\r\n<p>3、在登记过程中，您将选择注册名和密码。注册名的选择应遵守法律法规及社会公德。您必须对您的密码保密，您将对您注册名和密码下发生的所有活动承担责任。</p>', 0, 1, 1, 10, 'member/add_member_person', 'member/edit_member_person', 'member/register_person', 'member/edit_info_addon_person', '<field:m_p_gender f_item_name="性别" f_type="radio" f_length="" f_default="s|保密,m|男,f|女" f_is_auto="1" f_is_list="0" >\r\n</field:m_p_gender>');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_notify`
--

DROP TABLE IF EXISTS `prefix_member_notify`;
CREATE TABLE IF NOT EXISTS `prefix_member_notify` (
  `member_notify_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Member Notify ID',
  `mn_admin_userid` varchar(96) NOT NULL DEFAULT '' COMMENT 'Member Notify Administrator ID',
  `mn_m_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Notify Receive Member ID(-1:all member)',
  `mn_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Notify Status(0:unread, 1:have read)',
  `mn_send_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Notify Send Time',
  `mn_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Notify Title',
  `mn_content` text NOT NULL COMMENT 'Notify Content',
  PRIMARY KEY (`member_notify_id`),
  KEY `member_notify_id` (`member_notify_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Member Notify' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_member_notify`
--

INSERT INTO `prefix_member_notify` (`member_notify_id`, `mn_admin_userid`, `mn_m_id`, `mn_status`, `mn_send_time`, `mn_title`, `mn_content`) VALUES
(1, '{-ausr-}', -1, 0, {-time-}, '全部会员通知', '全部会员通知的内容');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_member_permission`
--

DROP TABLE IF EXISTS `prefix_member_permission`;
CREATE TABLE IF NOT EXISTS `prefix_member_permission` (
  `member_permission_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Administrator Permission ID',
  `mp_group` varchar(96) NOT NULL DEFAULT '' COMMENT 'Administrator Permission Group',
  `mp_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Administrator Permission Name(operation)',
  `mp_content` text NOT NULL COMMENT 'Administrator Permission Content(ctrlr:actn,ctrlr:actn1)',
  PRIMARY KEY (`member_permission_id`),
  KEY `member_permission_id` (`member_permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Member Permission' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `prefix_member_permission`
--

INSERT INTO `prefix_member_permission` (`mp_group`, `mp_name`, `mp_content`) VALUES
('档案', '档案列表', 'Archive:list_archive'),
('档案', '添加档案', 'Archive:add_archive,Archive:add_archive_do,Archive:choose_archive,Ajax:get_channel_select'),
('档案', '编辑档案', 'Archive:choose_archive,Archive:edit_archive,Archive:edit_archive_do,Ajax:get_channel_select'),
('自定义模型', '模型内容列表', 'CustomModel:list_content'),
('自定义模型', '添加模型内容', 'CustomModel:add_content,CustomModel:add_content_do'),
('自定义模型', '编辑模型内容', 'CustomModel:edit_content,CustomModel:edit_content_do'),
('通知', '通知管理', 'MemberNotify:delete_notify_do,MemberNotify:list_notify,MemberNotify:read_notify'),
('积分', '积分兑换', 'MemberCredit:credit_exchange,MemberCredit:credit_exchange_do'),
('积分', '积分订单', 'MemberCreditOrder:buy_archive_do,MemberCreditOrder:list_credit_order,MemberCreditOrder:pay_credit_order_do'),
('收藏', '收藏管理', 'MemberFavorite:add_favorite_do,MemberFavorite:delete_favorite_do,MemberFavorite:list_favorite'),
('上传', '上传列表', 'Upload:list_upload'),
('上传', '上传文件', 'Upload:upload_file'),
('会员', '编辑基础资料', 'Member:edit_info_base,Member:edit_info_base_do'),
('会员', '编辑附加资料', 'Member:edit_info_addon,Member:edit_info_addon_do');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_menu`
--

DROP TABLE IF EXISTS `prefix_menu`;
CREATE TABLE IF NOT EXISTS `prefix_menu` (
  `menu_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Menu ID',
  `m_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Menu Name',
  `m_tip` varchar(255) NOT NULL DEFAULT '' COMMENT 'Menu Tip',
  `m_parent_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Menu Parent ID',
  `m_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Menu Type(0:compose, 1:direct url)',
  `m_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Menu URL(ctrlr/actn?params or url)',
  `m_target` varchar(32) NOT NULL DEFAULT '_self' COMMENT 'Menu Target(_self, _blank, _parent, _top, custom...)',
  `m_display_order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Menu Display Order',
  `ms_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Menu Space Alias',
  PRIMARY KEY (`menu_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Menu' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `prefix_menu`
--

INSERT INTO `prefix_menu` (`menu_id`, `m_name`, `m_tip`, `m_parent_id`, `m_type`, `m_url`, `m_target`, `m_display_order`, `ms_alias`) VALUES
(1, '首页', '返回首页', 0, 0, 'home@index/index', '_self', 10, 'main'),
(2, '文章频道', '查看文章', 0, 0, 'home@archive/show_channel?archive_channel_id=1', '_self', 20, 'main'),
(3, '留言', '留言簿', 0, 0, 'home@guestbook/list_guestbook', '_self', 30, 'main'),
(4, '关于我们', '进一步了解我们', 0, 0, 'home@single_page/show_single_page?single_page_id=1', '_self', 10, 'footer');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_menu_space`
--

DROP TABLE IF EXISTS `prefix_menu_space`;
CREATE TABLE IF NOT EXISTS `prefix_menu_space` (
  `menu_space_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Menu Space ID',
  `ms_alias` varchar(96) NOT NULL DEFAULT '' COMMENT 'Menu Space Alias',
  `ms_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Menu Space Name',
  `ms_description` text NOT NULL COMMENT 'Menu Space Description',
  PRIMARY KEY (`menu_space_id`),
  UNIQUE KEY `ms_alias` (`ms_alias`),
  KEY `menu_space_id` (`menu_space_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Menu Space' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `prefix_menu_space`
--

INSERT INTO `prefix_menu_space` (`menu_space_id`, `ms_alias`, `ms_name`, `ms_description`) VALUES
(1, 'main', '主菜单', '网站顶部主导航菜单'),
(2, 'footer', '脚部菜单', '脚部菜单');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_option`
--

DROP TABLE IF EXISTS `prefix_option`;
CREATE TABLE IF NOT EXISTS `prefix_option` (
  `option_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Option ID',
  `o_key` varchar(96) NOT NULL DEFAULT '' COMMENT 'Option Key',
  `o_value` text NOT NULL COMMENT 'Option Value',
  `o_value_type` varchar(10) NOT NULL DEFAULT 'string' COMMENT 'Option Value Type(array:serialize_array, string, number, bool, multi_text, html_text, image)',
  `o_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Option Type(0:system, 1:custom)',
  `o_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Option Title',
  `o_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'Option Description',
  PRIMARY KEY (`option_id`),
  KEY `option_id` (`option_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Option' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `prefix_option`
--

INSERT INTO `prefix_option` (`option_id`, `o_key`, `o_value`, `o_value_type`, `o_type`, `o_title`, `o_description`) VALUES
(1, 'site', 'a:15:{s:4:"name";s:43:"UWA 通用建站 - Universal Website AsThis";s:4:"host";s:17:"http://asthis.net";s:4:"logo";s:15:"u/site/logo.png";s:11:"logo_mobile";s:22:"u/site/logo_mobile.png";s:8:"language";s:5:"zh-cn";s:11:"lang_detect";s:1:"0";s:5:"theme";s:7:"default";s:14:"mobile_version";s:1:"0";s:14:"tpl_protection";s:1:"0";s:8:"timezone";s:1:"8";s:11:"time_format";s:11:"Y-m-d H:i:s";s:8:"keywords";s:22:"uwa,通用建站如斯";s:11:"description";s:33:"一个uwa通用建站如斯网站";s:9:"copyright";s:99:"<p>&copy;2014 <a href=\\"http://asthis.net\\" target=\\"_blank\\"><strong>asthis.net</strong></a></p>\r\n";s:9:"stat_code";s:0:"";}', 'array', 0, '', ''),
(2, 'core', 'a:16:{s:18:"host_prefix_switch";s:1:"0";s:14:"rewrite_switch";s:1:"0";s:11:"html_switch";s:1:"0";s:11:"forced_html";s:1:"0";s:11:"gzip_switch";s:1:"0";s:12:"cache_expire";s:4:"3600";s:17:"html_expire_index";s:4:"7200";s:16:"html_expire_list";s:5:"14400";s:19:"html_expire_archive";s:6:"604800";s:9:"html_path";s:1:"a";s:13:"cookie_prefix";s:4:"uwa_";s:13:"cookie_expire";s:4:"3600";s:10:"cookie_key";s:8:"{-cookie_key-}";s:12:"debug_switch";s:1:"1";s:10:"debug_stat";s:1:"0";s:16:"debug_page_trace";s:1:"0";}', 'array', 0, '', ''),
(3, 'index', 'a:8:{s:11:"html_switch";s:1:"0";s:13:"paging_switch";s:1:"0";s:9:"page_size";s:2:"20";s:3:"tpl";s:5:"index";s:10:"tpl_paging";s:12:"index_paging";s:11:"html_naming";s:5:"index";s:18:"html_naming_paging";s:12:"index_{page}";s:16:"html_path_paging";s:11:"{uwa_path}a";}";}', 'array', 0, '', ''),
(4, 'performance', 'a:6:{s:10:"cache_type";s:4:"File";s:13:"memcache_host";s:9:"127.0.0.1";s:13:"memcache_port";s:5:"11211";s:13:"sphinx_switch";s:1:"0";s:11:"sphinx_host";s:9:"127.0.0.1";s:11:"sphinx_port";s:4:"9312";}', 'array', 0, '', ''),
(5, 'member', 'a:10:{s:6:"switch";s:1:"1";s:8:"register";s:1:"1";s:8:"name_ban";s:47:"www,bbs,ftp,mail,user,users,admin,administrator";s:17:"userid_min_length";s:1:"5";s:19:"password_min_length";s:1:"5";s:9:"pass_type";s:1:"1";s:21:"verify_email_validity";s:4:"7200";s:12:"login_credit";a:5:{s:12:"m_experience";s:1:"2";s:8:"m_points";s:1:"0";s:9:"mc_credit";s:1:"0";s:9:"mc_copper";s:1:"2";s:9:"mc_silver";s:1:"0";}s:14:"publish_credit";a:5:{s:12:"m_experience";s:1:"2";s:8:"m_points";s:1:"0";s:9:"mc_credit";s:1:"0";s:9:"mc_copper";s:1:"2";s:9:"mc_silver";s:1:"0";}s:13:"review_credit";a:5:{s:12:"m_experience";s:1:"1";s:8:"m_points";s:1:"0";s:9:"mc_credit";s:1:"0";s:9:"mc_copper";s:1:"1";s:9:"mc_silver";s:1:"0";}}', 'array', 0, '', ''),
(6, 'upload', 'a:7:{s:6:"switch";s:1:"0";s:7:"imgtype";s:16:"jpg,jpeg,gif,png";s:8:"filetype";s:10:"zip,7z,rar";s:3:"dir";s:1:"u";s:7:"sub_dir";s:4:"Ym/d";s:5:"space";s:6:"102400";s:7:"maxsize";s:3:"512";}', 'array', 0, '', ''),
(7, 'image', 'a:12:{s:12:"thumb_prefix";s:6:"thumb_";s:11:"thumb_width";s:3:"300";s:12:"thumb_height";s:3:"180";s:18:"thumb_proportional";s:1:"1";s:9:"watermark";s:1:"0";s:14:"watermark_type";s:1:"0";s:15:"watermark_image";s:21:"/u/site/watermark.png";s:14:"watermark_text";s:10:"asthis.net";s:19:"watermark_text_font";s:8:"font.ttf";s:19:"watermark_text_size";s:2:"12";s:20:"watermark_text_color";s:6:"000000";s:18:"watermark_position";s:1:"9";}', 'array', 0, '', ''),
(8, 'interaction', 'a:12:{s:13:"review_switch";s:1:"1";s:13:"search_switch";s:1:"1";s:14:"feedback_check";s:1:"0";s:17:"feedback_interval";s:1:"9";s:15:"search_interval";s:1:"3";s:7:"captcha";s:1:"1";s:14:"manage_captcha";s:1:"1";s:13:"report_switch";s:1:"1";s:11:"auto_report";s:1:"1";s:12:"filter_words";s:19:"胡锦涛|江泽民";s:14:"filter_replace";s:1:"*";s:10:"allow_tags";s:142:"table|tbody|tfoot|th|tr|td|div|p|ul|ol|li|dl|dt|dd|strong|em|b|i|u|a|span|img|br|object|param|embed|sup|sub|h1|h2|h3|h4|h5|h6|h7|blockquote|hr";}', 'array', 0, '', ''),
(9, 'contact_company_name', 'AsThis, Inc.', 'string', 1, '公司名称', '网站公司名称');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_report`
--

DROP TABLE IF EXISTS `prefix_report`;
CREATE TABLE IF NOT EXISTS `prefix_report` (
  `report_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Report ID',
  `r_item_type` varchar(64) NOT NULL DEFAULT '' COMMENT 'Report Item Type(archive, archive_review ...)',
  `r_item_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Report Item ID',
  `r_info` text NOT NULL COMMENT 'Report Infomation',
  `r_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Report Add Time',
  `r_add_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Report Add IP',
  `r_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Report Status(0:not deal, 1:dealed)',
  PRIMARY KEY (`report_id`),
  KEY `report_id` (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Report' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_single_page`
--

DROP TABLE IF EXISTS `prefix_single_page`;
CREATE TABLE IF NOT EXISTS `prefix_single_page` (
  `single_page_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Single Page ID',
  `sp_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'Single Page Title',
  `sp_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Single Page Keywords',
  `sp_description` text NOT NULL COMMENT 'Single Page Description',
  `sp_content` mediumtext NOT NULL COMMENT 'Single Page Content',
  `sp_group` varchar(32) NOT NULL DEFAULT '' COMMENT 'Single Page Group',
  `sp_display_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Single Page Display Order',
  `sp_edit_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Single Page Edit Time',
  `sp_is_html` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Html File Build Switch',
  `sp_tpl` varchar(255) NOT NULL DEFAULT '' COMMENT 'Single Page Template',
  `sp_html_naming` varchar(255) NOT NULL DEFAULT '' COMMENT 'Single Page Html File Naming',
  `sp_url` varchar(255) NOT NULL DEFAULT '' COMMENT 'Single Page URL',
  `sp_url_o` varchar(255) NOT NULL DEFAULT '' COMMENT 'Single Page URL Origin',
  PRIMARY KEY (`single_page_id`),
  KEY `single_page_id` (`single_page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Single Page' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_single_page`
--

INSERT INTO `prefix_single_page` (`single_page_id`, `sp_title`, `sp_keywords`, `sp_description`, `sp_content`, `sp_group`, `sp_display_order`, `sp_edit_time`, `sp_is_html`, `sp_tpl`, `sp_html_naming`, `sp_url`, `sp_url_o`) VALUES
(1, '关于我们', '', '', '<p>\r\n	关于我们...</p>\r\n', 'default', 10, {-time-}, 0, 'show_single_page', '{uwa_path}about', '{-site_url-}index.php?c=single_page&a=show_single_page&single_page_id=1', '{-site_url-}index.php?c=single_page&a=show_single_page&single_page_id=1');

-- --------------------------------------------------------

--
-- 表的结构 `prefix_sphinx_counter`
--

DROP TABLE IF EXISTS `prefix_sphinx_counter`;
CREATE TABLE IF NOT EXISTS `prefix_sphinx_counter` (
  `counter_id` tinyint(1) unsigned NOT NULL COMMENT 'Counter ID',
  `max_archive_id` int(10) unsigned NOT NULL COMMENT 'Max Archive Id',
  PRIMARY KEY (`counter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Sphinx Counter Mark';

--
-- 转存表中的数据 `prefix_sphinx_counter`
--

INSERT INTO `prefix_sphinx_counter` (`counter_id`, `max_archive_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_tag`
--

DROP TABLE IF EXISTS `prefix_tag`;
CREATE TABLE IF NOT EXISTS `prefix_tag` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Tag Name',
  `t_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Tag Name',
  `t_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'Tag Keywords',
  `t_description` text NOT NULL COMMENT 'Tag Description',
  `t_related_archive` text NOT NULL COMMENT 'Tag Related Archive IDs',
  `t_archive_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Tag Archive Count',
  `t_view_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Tag View Count',
  `t_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Tag Add Time',
  `t_update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Tag Update Time',
  PRIMARY KEY (`tag_id`),
  KEY `tag_id` (`tag_id`),
  KEY `t_name` (`t_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Tag' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `prefix_tag`
--

INSERT INTO `prefix_tag` (`tag_id`, `t_name`, `t_keywords`, `t_description`, `t_related_archive`, `t_archive_count`, `t_view_count`, `t_add_time`, `t_update_time`) VALUES
(1, 'UWA', 'UWA,universal,website,AsThis', '通用建站如斯系统的缩写', '1', 1, 0, {-time-}, {-time-}),
(2, '2.X', '2.X', 'UWA 一个版本的开发代号', '1', 1, 0, {-time-}, {-time-});

-- --------------------------------------------------------

--
-- 表的结构 `prefix_task`
--

DROP TABLE IF EXISTS `prefix_task`;
CREATE TABLE IF NOT EXISTS `prefix_task` (
  `task_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Task ID',
  `t_name` varchar(96) NOT NULL DEFAULT '' COMMENT 'Task Name',
  `t_description` text NOT NULL COMMENT 'Task Description',
  `t_file` varchar(96) NOT NULL DEFAULT '' COMMENT 'Task File',
  `t_addon_params` varchar(255) NOT NULL DEFAULT '' COMMENT 'Task Addon Parameters',
  `t_run_time` varchar(8) NOT NULL DEFAULT '00:00:00' COMMENT 'Task Run Time',
  `t_cycle_time` int(10) unsigned NOT NULL DEFAULT '86400' COMMENT 'Task Cycle Time(seconds)',
  `t_time_limit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Task Time Limit Switch(0:off, 1:on)',
  `t_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Task Start time',
  `t_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Task End Time',
  `t_last_run_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Task Last Run Time',
  `t_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Task Status(0:off, 1:on)',
  PRIMARY KEY (`task_id`),
  KEY `task_id` (`task_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Task' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prefix_task`
--

INSERT INTO `prefix_task` (`task_id`, `t_name`, `t_description`, `t_file`, `t_addon_params`, `t_run_time`, `t_cycle_time`, `t_time_limit`, `t_start_time`, `t_end_time`, `t_last_run_time`, `t_status`) VALUES
(1, '优化档案表', '每月优化档案表', 'optimize_table.php', '<t:p table="archive"></t:p>', '05:00:00', 2592000, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `prefix_upload`
--

DROP TABLE IF EXISTS `prefix_upload`;
CREATE TABLE IF NOT EXISTS `prefix_upload` (
  `upload_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Upload ID',
  `u_filename` varchar(255) NOT NULL DEFAULT '' COMMENT 'Upload File Name',
  `u_src` varchar(255) NOT NULL DEFAULT '' COMMENT 'Upload File Src',
  `u_type` varchar(32) NOT NULL DEFAULT '' COMMENT 'Upload File Type',
  `u_size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Upload File Size',
  `u_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Upload Add Time',
  `u_item_type` varchar(96) NOT NULL DEFAULT '' COMMENT 'Item Type(model alias)',
  `u_item_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Item ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Member ID',
  PRIMARY KEY (`upload_id`),
  KEY `upload_id` (`upload_id`,`u_size`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Upload' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_vote`
--

DROP TABLE IF EXISTS `prefix_vote`;
CREATE TABLE IF NOT EXISTS `prefix_vote` (
  `vote_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Vote ID',
  `v_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'Vote Name',
  `v_description` text NOT NULL COMMENT 'Vote Description',
  `v_time_limit` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote Time Limit Switch(0:off, 1:on)',
  `v_start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote Start Time',
  `v_end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote End Time',
  `v_interval` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote Interval',
  `v_allow_view` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote Allow View(0:off, 1:on)',
  `v_is_multi` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Multiple Choice(0:off, 1:on)',
  `v_tpl_result` varchar(255) NOT NULL DEFAULT '' COMMENT 'Vote Template Result',
  `v_tpl_tag` varchar(255) NOT NULL DEFAULT '' COMMENT 'Vote Tag Default Template',
  `v_tpl_js` varchar(255) NOT NULL DEFAULT '' COMMENT 'Vote JS Default Template',
  `v_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote Status(0:off, 1:on)',
  `v_option_set` text NOT NULL COMMENT 'Vote Option Set',
  PRIMARY KEY (`vote_id`),
  KEY `vote_id` (`vote_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Vote' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `prefix_vote_record`
--

DROP TABLE IF EXISTS `prefix_vote_record`;
CREATE TABLE IF NOT EXISTS `prefix_vote_record` (
  `vote_record_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Vote Log ID',
  `vote_id` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote ID',
  `vr_add_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Vote Record Add Time',
  `vr_add_ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'Vote Record Add IP',
  PRIMARY KEY (`vote_record_id`),
  KEY `vote_record_id` (`vote_record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Vote Record' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

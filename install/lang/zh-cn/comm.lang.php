<?php
defined('PFA_PATH') or exit('Access Denied');

return array(
'VERSION' => '版本',
'INTERNAL_VERSION' => '内部版本',
'INSTALL_WIZARD' => '安装向导',
'LOCKED_TIP' => '程序已经被安装锁定，请删除 ./cfg/install.lock.php 文件后再尝试。',

/* stepList */
'INTRODUCE_SOFT' => '介绍',
'INTRODUCE_SOFT_TIP' => '程序介绍',
'SHOW_LICENSE' => '许可协议',
'SHOW_LICENSE_TIP' => '请仔细阅读以下协议',
'CHECK_ENVIRONMENT' => '环境检查',
'CHECK_ENVIRONMENT_TIP' => '安装环境及权限检查',
'SETUP_INSTALLATION' => '安装设置',
'SETUP_INSTALLATION_TIP' => '设置数据库和管理员信息',
'WRITE_DATA' => '写入数据',
'WRITE_DATA_TIP' => '正在写入数据...',
'LOCK' => '安装成功',
'LOCK_TIP' => '恭喜您已安装成功',

/* operation */
'START' => '开始安装',
'AGREEMENT_NO' => '不同意',
'AGREEMENT_YES' => '我同意',
'STEP_BACK' => '上一步',
'STEP_NEXT' => '下一步',
'STEP_NEED_FIXED' => '请完成设置后继续',
'SUCCESS_AND_LOCK' => '锁定安装程序',

/* step0 */
'CHOOSE_INSTALL_LANG' => '选择安装界面语言',

/* step2 */
'SYSTEM_CHECK' => '系统环境检查',
'DIR_FILE_CHECK' => '目录及文件权限检查',
'PHP_CONFIG_CHECK' => 'PHP 配置检查',
'EXTENSION_CHECK' => 'PHP 扩展检查',
'FUNCTION_CHECK' => '函数检查',
'ITEM_NAME' => '项目',
'ITEM_REQUIREMENT' => '需求配置',
'ITEM_BEST' => '最佳配置',
'ITEM_CURRENT' => '当前配置',
'DIR_FILE_TYPE' => '类型',
'DIR_FILE_PATH' => '路径',
'ITEM_STATUS' => '状态',
'OS' => '操作系统',
'PHP_VERSION' => 'PHP 版本',
'UPLOAD_MAX_FILESIZE' => '最大附件',
'GD_VERSION' => 'GD 库版本',
'DISK_SPACE' => '可用空间',
'DIR' => '目录',
'FILE' => '文件',
'RUNTIME_DIR' => '运行目录',
'HTML_DIR' => '静态缓存目录',
'CONFIG_DIR' => '配置目录',
'TEMPLATE_DIR' => '模板目录',
'PUBLIC_DIR' => '公共目录',
'DEFINE_FILE' => '预定义文件',
'CONFIG_FILE' => '应用配置文件',
'UNKNOWN' => '未知',
'NO_LIMIT' => '不限制',
'INEXISTENCE' => '不存在',
'WRITABLE' => '可写',
'ERAD_ONLY' => '只读',
'SUPPORT' => '支持',
'NONSUPPORT' => '不支持',
'RECHECK' => '重新检查',

/* step3 */
'DB_SETUP' => '数据库信息配置',
'DB_HOST' => '数据库服务器',
'DB_HOST_TIP' => '通常为 localhost',
'DB_PORT' => '服务器端口',
'DB_PORT_TIP' => '通常为 3306',
'DB_USER' => '数据库用户',
'DB_USER_TIP' => '数据库连接用户',
'DB_PASSWORD' => '数据库密码',
'DB_PASSWORD_TIP' => '数据库用户连接密码',
'DB_DATABASE' => '数据库名称',
'DB_DATABASE_TIP' => '如果数据库不存在将尝试创建',
'DB_PREFIX' => '数据表前缀',
'DB_PREFIX_TIP' => '区分同一数据库内的其他程序',
'DB_CONNECTION' => '数据库连接方式',
'DB_CONNECTION_TIP' => '选择 MySQLi, 需要 MySQLi 扩展支持',

'FOUNDER_SETUP' => '管理员信息配置',
'FOUNDER_NAME' => '管理员名称',
'FOUNDER_NAME_TIP' => '管理员用户名, 只能包含字母、数字及_， 且由字母或_开头',
'FOUNDER_EMAIL' => '管理员邮件地址',
'FOUNDER_EMAIL_TIP' => '用于收发邮件等',
'FOUNDER_PASSWORD' => '管理员密码',
'FOUNDER_PASSWORD_TIP' => '管理员密码',

'OTHER' => '其他',
'COOKIE_KEY' => 'Cookie 加密码',
'COOKIE_KEY_TIP' => '用于 Cookie 保存时加密，通常不用修改',

/* errorMessage */
'DB_ERROR_NO_2003' => '连接数据库服务器失败，请检查<strong>数据库服务器</strong>是否正确',
'DB_ERROR_NO_1045' => '连接数据库失败，请检查<strong>数据库用户</strong>和<strong>数据库密码</strong>是否正确',
'DB_ERROR_NO_1044' => '无法创建新的数据库，请检查<strong>数据库名称</strong>填写是否正确',
'DB_CONNECT_FAILED' => '连接数据库失败，请检查<strong>数据库信息配置</strong>',
'DB_DATABASE_INEXISTENCE' => '数据库不存在且创建失败，请检查<strong>数据库名称</strong>',
'DB_PREFIX_EXIST' => '当前数据库中已经含有同样前缀的数据表，请修改<strong>数据表前缀</strong>',
'EXTENSION_NOT_SUPPORT' => '扩展不支持',
'NO_EMPTY' => '不能为空',

/* sql */
'SET_SQL_MODE' => '设置SQL模式',
'DROP_TABLE' => '准备数据表',
'CREATE_TABLE' => '正在创建数据表结构',
'INSERT_DATA_INTO' => '正在写入数据到数据表',
'INSTALL_SUCCESS' => '<font color="#060">安装成功</font>',
'INSTALL_FAILED' => '<font color="#c00">安装失败，未写入数据请查看 [install/install_err.txt] 文件</font>',

/* step5 */
'SAFETY_TIPS' => '为了网站安全，请删除<strong>安装目录 [/install]</strong>，同时更改<strong>管理文件 [/admin.php]</strong>名称',
'GOTO_INDEX' => '前往网站首页',
'GOTO_MANAGE_INDEX' => '前往管理首页',
'UPGRADE_INFO' => '升级信息',

/* long text */
'SOFT_INTRODUCTION' => '<p>UWA(Universal Website AsThis)，UWA 是基于 PHP 和 MySQL 开发的通用建站程序，程序简洁、灵活而具备强大的扩展性。</p><p>UWA功能特点:<br /><ol style="list-style:decimal inside none"><li>自定义档案模型，便于内容扩展及二次开发</li><li>高效的动静态页面部署，运行效率极高</li><li>网站内容周期性自动更新，维护成本低</li><li>会员中心及可定制的会员模型，让您的网站火起来</li><li>多语言支持，方便开拓国际市场</li><li>专业简洁的界面设计，良好的用户体验</li><li>简单易用的模板引擎，界面设计方便快捷</li></ol></p>',
'SOFT_LICENSE' => '<p>本授权协议适用于 UWA 任何版本，如斯(rzpackage.com)拥有对本授权协议的最终解释权和修改权。</p><p>1、您在使用 UWA 时应遵守中华人民共和国相关法律法规、您所在国家或地区之法令及相关国际惯例，不得将 UWA 用于任何非法目的，也不以任何非法方式使用 UWA 。</p><p>2、如果您需要采用 UWA 系统的部分程序构架其他程序系统，用于实际网站，请购买使用授权。已购买使用授权的用户可查看 UWA 的全部源代码,也可以根据自己的需要对其进行修改!</p><p>3、未经使用授权,不得将本软件用于任何网站(包括但不仅限于个人网站、企业网站及其他以盈利为目的经营性网站)，否则我们将保留追究的权力。</p><p style="text-align:right;padding:10px 0 0;">版权所有&copy如斯(rzpackage.com)</p>'
);
?>
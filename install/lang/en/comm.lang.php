<?php
defined('PFA_PATH') or exit('Access Denied');

return array(
'VERSION' => 'Version',
'INTERNAL_VERSION' => 'Internal Version',
'INSTALL_WIZARD' => 'Install Wizard',
'LOCKED_TIP' => 'Soft has been installed, please delete file "./cfg/install.lock.php" and try again.',

/* stepList */
'INTRODUCE_SOFT' => 'Introduce',
'INTRODUCE_SOFT_TIP' => 'This the soft introduction',
'SHOW_LICENSE' => 'License',
'SHOW_LICENSE_TIP' => 'Please read the following license seriously',
'CHECK_ENVIRONMENT' => 'Check',
'CHECK_ENVIRONMENT_TIP' => 'Check the installation environment and permissions',
'SETUP_INSTALLATION' => 'Setup',
'SETUP_INSTALLATION_TIP' => 'Set database and administrator information',
'WRITE_DATA' => 'Install',
'WRITE_DATA_TIP' => 'Writing data...',
'LOCK' => 'Success',
'LOCK_TIP' => 'Congratulations, you haveinstalled successfully',

/* operation */
'START' => 'Start the installation',
'AGREEMENT_NO' => 'I disagree',
'AGREEMENT_YES' => 'I agree',
'STEP_BACK' => 'Back',
'STEP_NEXT' => 'Next',
'STEP_NEED_FIXED' => 'Continue after completion of setting',
'SUCCESS_AND_LOCK' => 'Lock the installation',

/* step0 */
'CHOOSE_INSTALL_LANG' => 'Choose the installation\'s interface language',

/* step2 */
'SYSTEM_CHECK' => 'Check the system environment',
'DIR_FILE_CHECK' => 'Check the directory and file permissions',
'PHP_CONFIG_CHECK' => 'Check PHP config option',
'EXTENSION_CHECK' => 'Check the PHP extesions',
'FUNCTION_CHECK' => 'Check the functions\' availability',
'ITEM_NAME' => 'Items',
'ITEM_REQUIREMENT' => 'Requirement',
'ITEM_BEST' => 'Best',
'ITEM_CURRENT' => 'Current',
'DIR_FILE_TYPE' => 'Type',
'DIR_FILE_PATH' => 'Path',
'ITEM_STATUS' => 'Status',
'OS' => 'OS',
'PHP_VERSION' => 'PHP Version',
'UPLOAD_MAX_FILESIZE' => 'Maximum attachment',
'GD_VERSION' => 'GD version',
'DISK_SPACE' => 'Free space',
'DIR' => 'Dir',
'FILE' => 'File',
'RUNTIME_DIR' => 'Runtime Dir',
'HTML_DIR' => 'Html Cache Dir',
'CONFIG_DIR' => 'Configs Dir',
'TEMPLATE_DIR' => 'Template Dir',
'PUBLIC_DIR' => 'Public Dir',
'DEFINE_FILE' => 'Defines File',
'CONFIG_FILE' => 'App Configs File',
'UNKNOWN' => 'Unknown',
'NO_LIMIT' => 'No Limit',
'INEXISTENCE' => 'Inexistence',
'WRITABLE' => 'Writable',
'ERAD_ONLY' => 'Read Only',
'SUPPORT' => 'Support',
'NONSUPPORT' => 'Nonsupport',
'RECHECK' => 'Recheck',

/* step3 */
'DB_SETUP' => 'Set database information',
'DB_HOST' => 'Database server',
'DB_HOST_TIP' => 'Usually it\'s localhost',
'DB_PORT' => 'Server Port',
'DB_PORT_TIP' => 'Usually it\'s 3306',
'DB_USER' => 'Database user',
'DB_USER_TIP' => 'Username for database connect',
'DB_PASSWORD' => 'Database password',
'DB_PASSWORD_TIP' => 'Password for database connect',
'DB_DATABASE' => 'Database',
'DB_DATABASE_TIP' => 'If it does not exist will try to create',
'DB_PREFIX' => 'Database table prefix',
'DB_PREFIX_TIP' => 'Distinguish the other programs',
'DB_CONNECTION' => 'Database Connection',
'DB_CONNECTION_TIP' => 'If choose MySQLi, need MySQLi extension support',

'FOUNDER_SETUP' => 'Set admin information',
'FOUNDER_NAME' => 'Admin username',
'FOUNDER_NAME_TIP' => 'Admin username. Letters, can only contain letters, numbers or _, and must begin with letter or _',
'FOUNDER_EMAIL' => 'Admin email',
'FOUNDER_EMAIL_TIP' => 'Used to send and receive mail, etc.',
'FOUNDER_PASSWORD' => 'Admin password',
'FOUNDER_PASSWORD_TIP' => 'Admin password',

'OTHER' => 'Other',
'COOKIE_KEY' => 'Cookie Key',
'COOKIE_KEY_TIP' => 'Used to encrypt the cookie, usually without modification',

/* errorMessage */
'DB_ERROR_NO_2003' => 'Connect to the database server fails, check the <strong>Database server</strong> is correct',
'DB_ERROR_NO_1045' => 'Connect to the database server fails, please check the <strong>Database user</strong> and <strong>Database password</strong>',
'DB_ERROR_NO_1044' => 'Can not connect the database, please check the <strong>Database</strong>',
'DB_CONNECT_FAILED' => 'Connect to the database server fails, please check the <strong>Set database information</strong>',
'DB_DATABASE_INEXISTENCE' => 'Database does not exist and creation failed, please check <strong>Database</strong>',
'DB_PREFIX_EXIST' => 'The current database already contains the same table prefix, please modify the <strong>Database table prefix</strong>',
'EXTENSION_NOT_SUPPORT' => ' extension not support',
'NO_EMPTY' => ' can not be empty',

/* sql */
'SET_SQL_MODE' => 'Set SQL mode',
'DROP_TABLE' => 'Prepare database table of ',
'CREATE_TABLE' => 'Creating the database table\'s structure of ',
'INSERT_DATA_INTO' => 'writing data to the database table of ',
'INSTALL_SUCCESS' => '<font color="#060">Install Success</font>',
'INSTALL_FAILED' => '<font color="#c00">Install failed, the data that have not been writed is in file: [install/install_err.txt]</font>',

/* step5 */
'SAFETY_TIPS' => 'For site security, please delete the <strong>install directory [/install]</strong> , and also rename <strong>the file of Management [/admin.php]</strong>',
'GOTO_INDEX' => 'Go Home',
'GOTO_MANAGE_INDEX' => 'Go Management Home',
'UPGRADE_INFO' => 'Upgrade Info',

/* long text */
'SOFT_INTRODUCTION' => '<p>UWA(Universal Website AsThis), UWA is a universal website software based on PHP and My SQL plateform developmente, it is simple, flexible and have strong scalability.</p><p>UWA Features:<br /><ol style="list-style:decimal inside none"><li>Custom content model, easy content expansion and secondary development</li><li>Efficient deplopment of dynamic and static page with high operationg efficiency</li><li>Site content periodic automatic updates, it was low maintenance costs</li><li>Member Center and member model which is customized</li><li>Multi-languzge support, easy to open up international markets</li><li>Prefessional and concise interface design</li><li>Simple and easy-to-use template engine, convernient interface design</li></ol></p>',
'SOFT_LICENSE' => '<p> this License applies to any UWA version, rzpackage.com have on the licensing agreement to the right of final explanation and modification. </p><p>1, you use the Alog should comply with the relevant PRC laws and regulations, in your country laws and the relevant international conventions, shall not be used for any illegal purpose UWA, nor in any illegal use of UWA. </p><p>2, if you need to use UWA in actural site, please buy a licence. User who have purchased the use of authorized can view the full source code of the UWA, and also can modify it according to their needs!</p><p>3, Without licence, UWA can not use to any site(include but not limited to personal websites, corporate websites or any other website for the purpose of operationg profit), otherwise we will reserve the rights.</p><p style= " text-align:right; padding:10px 00; " > copyright &copy rzpackage.com</p>',
);
?>
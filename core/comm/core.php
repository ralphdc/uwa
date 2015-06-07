<?php

/**
 *--------------------------------------
 * frame core file list
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');

return array(
	PFA_PATH . '/lib/core/Pfa.class.php',
	PFA_PATH . '/lib/core/Log.class.php', // log
	PFA_PATH . '/lib/core/Debug.class.php', // debug
	PFA_PATH . '/lib/core/App.class.php', // app base
	PFA_PATH . '/lib/core/Ctrlr.class.php', // controller base
	PFA_PATH . '/lib/core/Modl.class.php', // model base
	PFA_PATH . '/lib/core/Te.class.php', // template engine
	PFA_PATH . '/lib/core/Url.class.php', // URL dispatch
	PFA_PATH . '/lib/core/Cache.class.php', // cache base
	PFA_PATH . '/lib/core/Db.class.php', // database base
	);

?>
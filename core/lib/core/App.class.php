<?php

/**
 *--------------------------------------
 * App base
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class App extends Pfa {
	/* initialization */
	public function __construct() {
		//[RUNTIME]
		App::build(); // pre-compile
		//[/RUNTIME]
		Url::dispatch(); // URL dispatch and define CTRLR_NAME, ACTN_NAME

		self::load_comm(); // load common config and function library

		/* error reporting */
		C('DEBUG.SWITCH') ? error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING) : error_reporting(0);
		set_error_handler(array('App', 'app_error'));

		self::load_lang(); // load language
		self::load_theme(); // load template theme and define template constant

		/* define current request system constant */
		define('NOW_TIME', $_SERVER['REQUEST_TIME']);
		define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);
		define('IS_GET', 'GET' == REQUEST_METHOD ? true : false);
		define('IS_POST', 'POST' == REQUEST_METHOD ? true : false);
		define('IS_PUT', 'PUT' == REQUEST_METHOD ? true : false);
		define('IS_DELETE', 'DELETE' == REQUEST_METHOD ? true : false);
		define('IS_AJAX', ((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') || !empty($_POST[C('VAR.AJAX')]) || !empty($_GET[C('VAR.AJAX')])) ? true : false);

		date_default_timezone_set(C('APP.TIMEZONE')); // set timezone
		header('X-Powered-By: PFA ' . PFA_VERSION);

		G('initTime'); // record init time
	}

	/* start app */
	public function run() {
		$group = defined('GROUP_NAME') ? GROUP_NAME . C('APP.GROUP_DEPR') : '';
		$ctrlr = A($group . CTRLR_NAME);
		if(!preg_match('/^[A-Za-z_0-9]+$/', CTRLR_NAME) or !$ctrlr) {
			if(C('DEBUG.SWITCH')) {
				halt(L('_CTRLR_NOT_EXIST_') . CTRLR_NAME);
			}
			else {
				header('HTTP/1.1 404 Not Found');
				header('Status:404 Not Found');
				exit;
			}
		}

		/* execute current action */
		call_user_func(array(&$ctrlr, ACTN_NAME));
	}

	//[RUNTIME]
	/* load config, compile app */
	private static function build() {
		/* load app constant */
		require_cache(CFG_PATH . D_S . 'define.php');
		/* load app common option */
		C(require_cache(CFG_PATH . D_S . 'comm.php'));
		/* load app common file */
		$common = '';
		if(is_file(LIB_COMM_PATH . D_S . 'comm.func.php')) {
			include LIB_COMM_PATH . D_S . 'comm.func.php';
 			/* load common function library */
			if(!C('DEBUG.SWITCH')) {
				$common .= compile(LIB_COMM_PATH . D_S . 'comm.func.php'); // add to compile file
			}
		}
		/* load app extra config */
		$configs = C('APP.CFG_LIST');
		if(is_string($configs)) {
			$configs = explode(',', $configs);
			foreach($configs as $config) {
				$file = CFG_PATH . D_S . $config . '.php';
				if(is_file($file)) {
					C(strtoupper($config), (include $file));
				}
			}
		}
		C('APP.CFG_LIST', ''); // clear app extra config list

		/* compile app */
		if(!C('DEBUG.SWITCH')) {
			build_runtimeCache($common);
		}
	}
	//[/RUNTIME]

	/* load common config and function library */
	private static function load_comm() {
		if(defined('GROUP_NAME')) {
			/* load group common config */
			C(require_cache(CFG_PATH . D_S . GROUP_NAME . D_S . 'comm.php'));
			/* load group common function library */
			if(is_file(LIB_COMM_PATH . D_S . GROUP_NAME . D_S . 'comm.func.php')) {
				include LIB_COMM_PATH . D_S . GROUP_NAME . D_S . 'comm.func.php';
			}
		}
		/* load controller function library */
		if(is_file(LIB_COMM_PATH . D_S . CTRLR_NAME . '.func.php')) {
			include LIB_COMM_PATH . D_S . CTRLR_NAME . '.func.php';
		}
		/* load group controller function library */
		if(defined('GROUP_NAME')) {
			if(is_file(LIB_COMM_PATH . D_S . GROUP_NAME . D_S . CTRLR_NAME . '.func.php')) {
				include LIB_COMM_PATH . D_S . GROUP_NAME . D_S . CTRLR_NAME . '.func.php';
			}
		}
	}

	/* load language */
	private static function load_lang() {
		$langName = C('LANG.NAME');
		/* detect language */
		if(C('LANG.DETECT')) {
			$langset = require PFA_PATH . '/comm/langset.php';
			$_t_l = '';
			if('' != ARequest::get(C('VAR.LANG'))) {
				$_t_l = strtolower(ARequest::get(C('VAR.LANG')));
			}
			elseif('' != ACookie::get('lang')) {
				$_t_l = strtolower(ACookie::get('lang'));
			}
			elseif(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
				preg_match('/^([a-z\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
				$_t_l = strtolower($matches[1]);
			}
			if(!empty($langName) and array_key_exists($_t_l, $langset)) {
				$langName = $_t_l;
			}
		}
		if($langName != ACookie::get('lang')) {
			ACookie::set('lang', $langName);
		}

		define('LANG_NAME', $langName);
		/* load framework language */
		if(is_file(PFA_PATH . '/lang/' . LANG_NAME . '.lang.php')) {
			L(include PFA_PATH . '/lang/' . LANG_NAME . '.lang.php');
		}
		elseif(is_file(PFA_PATH . '/lang/' . C('LANG.NAME') . '.lang.php')) {
			L(include PFA_PATH . '/lang/' . C('LANG.NAME') . '.lang.php');
		}
		/* load common language */
		if(is_file(LANG_PATH . D_S . LANG_NAME . '/comm.lang.php')) {
			L(include LANG_PATH . D_S . LANG_NAME . '/comm.lang.php');
		}
		elseif(is_file(LANG_PATH . D_S . C('LANG.NAME') . '/comm.lang.php')) {
			L(include LANG_PATH . D_S . C('LANG.NAME') . '/comm.lang.php');
		}
		/* load group common language */
		if(defined('GROUP_NAME')) {
			if(is_file(LANG_PATH . D_S . LANG_NAME . D_S . GROUP_NAME . '/comm.lang.php')) {
				L(include LANG_PATH . D_S . LANG_NAME . D_S . GROUP_NAME . '/comm.lang.php');
			}
			elseif(is_file(LANG_PATH . D_S . C('LANG.NAME') . D_S . GROUP_NAME . '/comm.lang.php')) {
				L(include LANG_PATH . D_S . C('LANG.NAME') . D_S . GROUP_NAME . '/comm.lang.php');
			}
		}
		/* load controller language */
		if(is_file(LANG_PATH . D_S . LANG_NAME . D_S . CTRLR_NAME . '.lang.php')) {
			L(include LANG_PATH . D_S . LANG_NAME . D_S . CTRLR_NAME . '.lang.php');
		}
		elseif(is_file(LANG_PATH . D_S . C('LANG.NAME') . D_S . CTRLR_NAME . '.lang.php')) {
			L(include LANG_PATH . D_S . C('LANG.NAME') . D_S . CTRLR_NAME . '.lang.php');
		}
		/* load group controller language */
		if(defined('GROUP_NAME')) {
			if(is_file(LANG_PATH . D_S . LANG_NAME . D_S . GROUP_NAME . D_S . CTRLR_NAME . '.lang.php')) {
				L(include LANG_PATH . D_S . LANG_NAME . D_S . GROUP_NAME . D_S . CTRLR_NAME . '.lang.php');
			}
			elseif(is_file(LANG_PATH . D_S . C('LANG.NAME') . D_S . GROUP_NAME . D_S . CTRLR_NAME . '.lang.php')) {
				L(include LANG_PATH . D_S . C('LANG.NAME') . D_S . GROUP_NAME . D_S . CTRLR_NAME . '.lang.php');
			}
		}
	}

	/* load template theme and define template constant */
	private static function load_theme() {
		/* detect theme */
		if(C('TE.TPL_DETECT')) {
			$tplSet = C('TE.TPL_THEME');
			if('' != ARequest::get(C('VAR.TPL'))) {
				$tplSet = strtolower(ARequest::get(C('VAR.TPL')));
			}
			elseif('' != ACookie::get('theme')) {
				$tplSet = ACookie::get('theme');
			}
			/* use default theme when theme not exsit */
			if(empty($tplSet) or !preg_match('/^[A-Za-z_0-9]+$/', $tplSet) or !is_dir(TPL_PATH . D_S . $tplSet)) {
				$tplSet = C('TE.TPL_THEME');
			}
			ACookie::set('theme', $tplSet);
			C('TE.TPL_THEME', $tplSet); // current template theme name
		}

		/* detect user agent */
		if(C('TE.TPL_DETECT_USER_AGENT')) {
			$tuab = C('TE.TPL_USER_AGENT_BRANCH');

			if('' != ARequest::get(C('VAR.USER_AGENT'))) {
				$userAgent = strtolower(ARequest::get(C('VAR.USER_AGENT')));
			}
			elseif(ACookie::get('user_agent')) {
				$userAgent = ACookie::get('user_agent');
			}
			else {
				$userAgent = '';
				$ua = detect_userAgent();
				if(array_key_exists($ua, $tuab)) {
					$userAgent = $tuab[$ua];
				}
			}
			if(!preg_match('/^[A-Za-z_0-9]+$/', $userAgent)) {
				$userAgent = '';
			}

			ACookie::set('user_agent', $userAgent);

			/* set user agent branch for tpl */
			if(!empty($userAgent) and in_array($userAgent, $tuab) and is_dir(TPL_PATH . D_S . C('TE.TPL_THEME') . D_S . $userAgent)) {
				C('TE.TPL_THEME', C('TE.TPL_THEME') . '/' . $userAgent);
			}
		}

		/* template root URL */
		define('__TPL__', __APP__ . TPL_DIR . '/');
		/* template constant */
		define('THEME_NAME', C('TE.TPL_THEME'));
 		/* current template theme name */
		define('THEME_PATH', TPL_PATH . (THEME_NAME ? D_S . THEME_NAME : ''));
 		/* current template theme path */
		define('__THEME__', __APP__ . TPL_DIR . '/' . (THEME_NAME ? THEME_NAME . '/' : ''));
 		/* current template theme URL */

		if(defined('GROUP_NAME')) {
			/* current template file */
			C('TE.CURRENT_FILE', parse_name(GROUP_NAME) . D_S . parse_name(CTRLR_NAME) . D_S . strtolower(ACTN_NAME));
			/* current cache path */
			C('CACHE.PATH', C('CACHE.PATH') . D_S . parse_name(GROUP_NAME));
		}
		else {
			C('TE.CURRENT_FILE', parse_name(CTRLR_NAME) . D_S . strtolower(ACTN_NAME));
		}
		return;
	}

	/* custom error handling */
	public static function app_error($errno, $errstr, $errfile, $errline) {
		$errno = $errno & error_reporting();
		if(!defined('E_STRICT'))
			define('E_STRICT', 2048);
		if(!defined('E_RECOVERABLE_ERROR'))
			define('E_RECOVERABLE_ERROR', 4096);
		switch($errno) {
			case E_ERROR:
			case E_WARNING:
			case E_PARSE:
			case E_NOTICE:
			case E_CORE_ERROR:
			case E_CORE_WARNING:
			case E_COMPILE_ERROR:
			case E_COMPILE_WARNING:
			case E_USER_ERROR:
				$errorStr = "[{$errno}]{$errstr} " . basename($errfile) . "({$errline})";
				Log::record($errorStr);
				halt($errorStr);
				break;
			case E_USER_WARNING:
			case E_USER_NOTICE:
			case E_STRICT:
			case E_RECOVERABLE_ERROR:
			default:
				$errorStr = "[{$errno}]{$errstr} " . basename($errfile) . "({$errline})";
				Log::record($errorStr);
				break;
		}
	}

	public function __destruct() {
		G('execTime'); // recode exectime

		/* save log */
		if(C('LOG.SWITCH')) {
			Log::save();
		}

		G('endTime');

		/* debug stat and page trace */
		if(!IS_AJAX && C('DEBUG.STAT')) {
			Debug::show_stat();
		}
		if(!IS_AJAX && C('DEBUG.PAGE_TRACE')) {
			Debug::show_trace();
		}
	}
}

?>
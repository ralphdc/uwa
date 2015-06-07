<?php

/**
 *--------------------------------------
 * URL parse, route dispatch
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class Url extends Pfa {
	/* URL mapped to the controller */
	public static function dispatch() {
		/* PHP_FILE: current app full URL */
		$urlType = C('URL.TYPE');
		if($urlType == URL_REWRITE) {
			$url = dirname(_PHP_FILE_);
			if($url == '/' || $url == '\\') {
				$url = '';
			}
			define('PHP_FILE', $url);
		}
		elseif($urlType == URL_COMPAT) {
			define('PHP_FILE', _PHP_FILE_ . '?' . C('VAR.PATHINFO') . '=');
		}
		else {
			define('PHP_FILE', _PHP_FILE_);
		}

		$depr = C('URL.PATHINFO_DEPR');

		self::get_pathInfo(); // get PATHINFO

		if(!self::router_check()) {
			self::router(); // default URL dispatch
		}

		/* define constant */
		if(C('APP.GROUP_LIST')) {
			define('GROUP_NAME', self::get_group(C('VAR.GROUP')));
		}
		define('CTRLR_NAME', self::get_ctrlr(C('VAR.CTRLR')));
		define('ACTN_NAME', self::get_actn(C('VAR.ACTN')));
		/* current host */
		define('__HOST__', 'http://' . (AServer::get_env('HTTP_X_FORWARDED_HOST') ? AServer::get_env('HTTP_X_FORWARDED_HOST') : (AServer::get_env('HTTP_HOST') ? AServer::get_env('HTTP_HOST') : (AServer::get_env('SERVER_NAME') . (80 == AServer::get_env('SERVER_PORT') ? '' : ':' . AServer::get_env('SERVER_PORT'))))));
		/* site root URL */
		define('__ROOT__', (C('URL.HOST_PREFIX') ? __HOST__ : '') . ROOT);
		/* current app enter URL */
		define('__APP__', (C('URL.HOST_PREFIX') ? __HOST__ : '') . APP_ROOT);
		/* site public URL */
		define('__PUBLIC__', __ROOT__ . PUBLIC_DIR . '/');

 		/* Guaranteed get $_REQUEST value, no $_COOKIE */
		$_REQUEST = array_merge($_POST, $_GET);

		/* current group, ctrlr, actn, params */
		if(C('APP.GROUP_LIST')) {
			define('GCAP', GROUP_NAME . '@' . CTRLR_NAME . '/' . ACTN_NAME . '?' . http_build_query($_GET));
		}
		else {
			define('GCAP', 'default@' . CTRLR_NAME . '/' . ACTN_NAME . '?' . http_build_query($_GET));
		}
	}

	/* create URL, support different mode and route. $check: REWRITE mode check parameter if match route rule,
	Url::U('group@some_ctrlr/actn?parm=1'), when C('URL.PARSE_NAME') == false only can use Url::U('Group@SomeCtrlr/actn?parm=1') */
	public static function U($url = '', $check = true) {
		if(empty($url)) {
			return '';
		}
		if(0 === strpos($url, '/')) {
			$url = substr($url, 1);
		}
		/* default use current app name */
		if(!strpos($url, '://')) {
			$url = APP_NAME . '://' . $url;
		}

		/* analysis URL */
		$array = parse_url($url);
		$app = isset($array['scheme']) ? $array['scheme'] : APP_NAME;

		$group = '';
		if(C('APP.GROUP_LIST')) {
			$groupList = explode(',', C('APP.GROUP_LIST'));
			if(isset($array['user']) and in_array((C('URL.PARSE_NAME') ? parse_name($array['user'], 1) : $array['user']), $groupList)) {
				$group = $array['user'];
			}
			else {
				$group = C('URL.PARSE_NAME') ? parse_name(GROUP_NAME, 0) : GROUP_NAME;
			}
		}

		if(isset($array['path'])) {
			$actn = substr($array['path'], 1);
			if(!isset($array['host'])) {
				$ctrlr = CTRLR_NAME;
			}
			else {
				$ctrlr = $array['host'];
			}
		}
		else {
 			/* only define action name */
			$ctrlr = CTRLR_NAME;
			$actn = $array['host'];
		}

		/* default group name not display */
		if((C('URL.PARSE_NAME') ? parse_name($group, 1) : $group) == C('APP.GROUP')) {
			$group = '';
		}

		if(C('URL.PARSE_NAME')) {
			$group = parse_name($group);
			$ctrlr = parse_name($ctrlr);
		}

		if(isset($array['query'])) {
			parse_str($array['query'], $query);
			$params = $query;
		}

		/* host prefix */
		$hostPrefix = C('URL.HOST_PREFIX') ? __HOST__ : '';

		/* crate URL */
		if(C('URL.TYPE') == URL_COMMON) {
 			/* normal mode */
			$group = !empty($group) ? C('VAR.GROUP') . '=' . $group . '&' : '';
			$ctrlr = C('VAR.CTRLR') . '=' . $ctrlr . '&';
			$actn = C('VAR.ACTN') . '=' . $actn;
			$params = !empty($params) ? '&' . http_build_query($params) : '';
			return $url = $hostPrefix . str_replace(APP_NAME, $app, _PHP_FILE_) . '?' . $group . $ctrlr . $actn . $params;
		}
		elseif(C('URL.TYPE') == URL_PATHINFO) {
 			/* PATHINFO mode */
			$depr = C('URL.PATHINFO_DEPR');
			$str = $depr;
			foreach($params as $var => $val) {
				$str .= $var . $depr . $val . $depr;
			}
			$str = substr($str, 0, -1);
			$group = !empty($group) ? $group . $depr : '';
			$ctrlr = isset($ctrlr) ? $ctrlr . $depr : '';
			return $url = $hostPrefix . str_replace(APP_NAME, $app, _PHP_FILE_) . '/' . $group . $ctrlr . $actn . $str . C('HTML.FILE_SUFFIX');
		}
		elseif(C('URL.TYPE') == URL_REWRITE) {
 			/* REWRITE mode */
			/* route file(route.php) is priority than define in cfg */
			$_t_route = C('ROUTE');
			$route = !empty($_t_route) ? $_t_route : C('URL.ROUTE_RULES');

			/* deal route */
			$match = false;
			foreach($route as $regPattern => $value) {
				$_group = '';
				if(C('APP.GROUP_LIST')) {
					/* use default GROUP when do not specified */
					if(false === strpos($value, '@')) {
						$value = (C('URL.PARSE_NAME') ? parse_name(C('APP.GROUP')) : C('APP.GROUP')) . '@' . $value;
					}

					$_ca = explode('@', $value, 2);
					$_group = in_array((C('URL.PARSE_NAME') ? parse_name($_ca[0], 1) : $_ca[0]), explode(',', C('APP.GROUP_LIST'))) ? $_ca[0] : '';

					$_ca = $_ca[1];
				}
				$_ca = explode('/', $_ca, 2);
				$_ctrlr = array_shift($_ca);
				$_actn = array_shift($_ca);

				/* default group name not display */
				if((C('URL.PARSE_NAME') ? parse_name($_group, 1) : $_group) == C('APP.GROUP')) {
					$_group = '';
				}

				if(C('URL.PARSE_NAME')) {
					$_group = parse_name($_group);
					$_ctrlr = parse_name($_ctrlr);
				}

				if($group . '@' . $ctrlr . '/' . $actn != $_group . '@' . $_ctrlr . '/' . $_actn) {
					continue;
				}

				/* custom regular expression exists */
				if(preg_match_all("%<\w+?:.*?>%", $regPattern, $customRegMatch)) {
					$regInfo = array();
					foreach($customRegMatch[0] as $val) {
						$val = trim($val, '<>');
						$regTemp = explode(':', $val, 2);
						$regInfo[$regTemp[0]] = $regTemp[1];
					}

					/* match expression parameters */
					$replaceArray = array();
					$_t_k = array();
					foreach($regInfo as $key => $val) {
						if(strpos($val, '%') !== false) {
							$val = str_replace('%', '\%', $val);
						}
						if(isset($params[$key])) {
							if(!$check || preg_match("%$val%", $params[$key])) {
								$replaceArray[] = $params[$key];
								$_t_k[] = $key;
							}
							else {
								continue 2;
							}
						}
						else {
							continue 2;
						}
					}
					if(!empty($_t_k)) {
						foreach($_t_k as $k) {
							unset($params[$k]);
						}
					}
					$url = str_replace($customRegMatch[0], $replaceArray, $regPattern) . C('HTML.FILE_SUFFIX');
					$params = http_build_query($params);
					$url .= !empty($params) ? '?' . $params : '';
					return $url = str_replace(APP_NAME, $app, __APP__) . $url;
				}
				else {
					return $url = str_replace(APP_NAME, $app, __APP__) . $regPattern . C('HTML.FILE_SUFFIX');
				}
			}
			/* return by the normal mode when url not match route */
			$group = !empty($group) ? C('VAR.GROUP') . '=' . $group . '&' : '';
			$ctrlr = C('VAR.CTRLR') . '=' . $ctrlr . '&';
			$actn = C('VAR.ACTN') . '=' . $actn;
			$params = !empty($params) ? '&' . http_build_query($params) : '';
			return $url = $hostPrefix . str_replace(APP_NAME, $app, _PHP_FILE_) . '?' . $group . $ctrlr . $actn . $params;
		}
		elseif(C('URL.TYPE') == URL_COMPAT) {
 			/* compat mode */
			$depr = C('URL.PATHINFO_DEPR');
			$str = $depr;
			foreach($params as $var => $val) {
				$str .= $var . $depr . $val . $depr;
			}
			$str = substr($str, 0, -1);
			$group = !empty($group) ? $group . $depr : '';
			$ctrlr = isset($ctrlr) ? $ctrlr . $depr : '';
			$url = $hostPrefix . str_replace(APP_NAME, $app, _PHP_FILE_) . '?' . C('VAR.PATHINFO') . '=' . $group . $ctrlr . $actn . $str . C('HTML.FILE_SUFFIX');
			if(C('URL.PARSE_NAME')) {
				$url = strtolower($url);
			}
			return $url;
		}
	}

	/* get server PATH_INFO information */
	private static function get_pathInfo() {
		if(!empty($_GET[C('VAR.PATHINFO')])) {
			$path = $_GET[C('VAR.PATHINFO')];
 			/* PATHINFO parameters compatible */
			unset($_GET[C('VAR.PATHINFO')]);
		}
		else {
			$types = explode(',', C('URL.PATHINFO_FETCH'));
			foreach ($types as $type){
				if(!empty($_SERVER[$type])) {
					$path = (0 === strpos($_SERVER[$type], $_SERVER['SCRIPT_NAME']))?
						substr($_SERVER[$type], strlen($_SERVER['SCRIPT_NAME'])) : $_SERVER[$type];
					if(('REDIRECT_URL' == $type) and (empty($_SERVER['QUERY_STRING']) || $_SERVER['QUERY_STRING'] == $_SERVER["REDIRECT_QUERY_STRING"])) {
						$parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
						if(!empty($parsedUrl['query'])) {
							$_SERVER['QUERY_STRING'] = $parsedUrl['query'];
							parse_str($parsedUrl['query'], $GET);
							$_GET = array_merge($_GET, $GET);
							reset($_GET);
						}
						else {
							unset($_SERVER['QUERY_STRING']);
						}
						reset($_SERVER);
					}
					break;
				}
			}
		}
		if(C('HTML.FILE_SUFFIX') && !empty($path)) {
			$path = preg_replace('/\.' . trim(C('HTML.FILE_SUFFIX'), '.') . '$/', '', $path);
		}
		$_SERVER['PATH_INFO'] = empty($path) ? '/' : $path;
	}

	/* REWRITE mode, parse URL special dispatch */
	private static function router_check() {
		if(C('URL.TYPE') != URL_REWRITE) {
			return false; // Non-rewrite mode using the default URL dispatch
		}
		$regx = trim($_SERVER['PATH_INFO'], '/');
		if(empty($regx)) {
			return true; // not deal when path_info is null
		}

		/* route file(route.php) is priority than define in cfg */
		$_t_route = C('ROUTE');
		$route = !empty($_t_route) ? $_t_route : C('URL.ROUTE_RULES');

		/* deal with route */
		if(!empty($route)) {
			$depr = C('URL.PATHINFO_DEPR');
			foreach($route as $regPattern => $ca) {
				/* whether current url in route, extract the url parameter */
				$regPatternReplace = preg_replace("%<\w+?:(.*?)>%", "($1)", $regPattern);
				if(strpos($regPatternReplace, '%') !== false) {
					$regPatternReplace = str_replace('%', '\%', $regPatternReplace);
				}

				if(preg_match("%$regPatternReplace%", $regx, $matchValue)) {
					/* matches the entire full url */
					$matchAll = array_shift($matchValue);
					if($matchAll != $regx) {
						continue;
					}

					/* url exsits dynamic parameters */
					if(!empty($matchValue)) {
						preg_match_all("%<\w+?:.*?>%", $regPattern, $matchReg);
						foreach($matchReg[0] as $key => $val) {
							$val = trim($val, '<>');
							$tempArray = explode(':', $val, 2);
							$_GET[$tempArray[0]] = isset($matchValue[$key]) ? $matchValue[$key] : '';
						}
					}

					/* get group, controller, action */
					if((strpos($ca, '@') !== false) and C('APP.GROUP_LIST')) {
						$ca = explode('@', $ca, 2);
						$_GET[C('VAR.GROUP')] = in_array((C('URL.PARSE_NAME') ? parse_name($ca[0], 1) : $ca[0]), explode(',', C('APP.GROUP_LIST'))) ? $ca[0] : '';
						$ca = $ca[1];
					}
					$ca = explode('/', $ca, 2);
					$_GET[C('VAR.CTRLR')] = array_shift($ca);
					$_GET[C('VAR.ACTN')] = array_shift($ca);
					return true;
				}
			}
		}
		return false;
	}

	/* default URL dispatch */
	private static function router() {
		$depr = C('URL.PATHINFO_DEPR');
		$paths = explode($depr, trim($_SERVER['PATH_INFO'], '/'));
		$var = array();
		if(C('APP.GROUP_LIST') && !isset($_GET[C('VAR.GROUP')])) {
			$var[C('VAR.GROUP')] = in_array((C('URL.PARSE_NAME') ? parse_name($paths[0], 1) : $paths[0]), explode(',', C('APP.GROUP_LIST'))) ? array_shift($paths) : '';
		}
		/* define controller */
		if(!isset($_GET[C('VAR.CTRLR')])) {
			$var[C('VAR.CTRLR')] = array_shift($paths);
		}
		$var[C('VAR.ACTN')] = array_shift($paths);
		/* parse the other URL params */
		$res = preg_replace('@(\w+)' . $depr . '([^' . $depr . '\/]+)@e', '$var[\'\\1\']=\'\\2\';', implode($depr, $paths));
		$_GET = array_merge($var, $_GET);
	}

	/* get group */
	private static function get_group($var) {
		$group = (!empty($_GET[$var]) and preg_match("/^[a-zA-Z_][a-zA-Z0-9_]+$/", $_GET[$var])) ? $_GET[$var] : C('APP.GROUP');
		unset($_GET[$var]);

		if(C('URL.PARSE_NAME')) {
			/* index.php/aaa_bbb/index/ to AaaBbb group */
			$group = parse_name($group, 1);
		}
		return strip_tags($group);
	}

	/* get controller */
	private static function get_ctrlr($var) {
		$ctrlr = (!empty($_GET[$var]) and preg_match("/^[a-zA-Z_][a-zA-Z0-9_]+$/", $_GET[$var])) ? $_GET[$var] : C('APP.CTRLR');
		unset($_GET[$var]);

		if(C('URL.PARSE_NAME')) {
			/* index.php/aaa_bbb/index/ to AaaBbbCtrlr controller */
			$ctrlr = parse_name($ctrlr, 1);
		}
		return strip_tags($ctrlr);
	}

	/* get action */
	private static function get_actn($var) {
		$actn = (!empty($_POST[$var]) and preg_match("/^[a-zA-Z_][a-zA-Z0-9_]+$/", $_POST[$var])) 
			? $_POST[$var] 
			: ((!empty($_GET[$var]) and preg_match("/^[a-zA-Z_][a-zA-Z0-9_]+$/", $_GET[$var])) 
				? $_GET[$var] 
				: C('APP.CTRLR'));
		unset($_POST[$var], $_GET[$var]);

		if(C('URL.PARSE_NAME')) {
			$actn = strtolower($actn);
		}
		return strip_tags($actn);
	}

	/* constructors privatization */
	private function __construct() {
	}
}

?>
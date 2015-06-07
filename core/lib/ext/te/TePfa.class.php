<?php

/**
 *--------------------------------------
 * PFA default template engine
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-24
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */
defined('PFA_PATH') or exit('Access Denied');

class TePfa extends Te {
	public $tplVars = array(); // template variable
	protected $tplFile = ''; // current template file filename
	protected $cacheFile = ''; // current cache file
	protected $cacheIncludeFile = ''; // current cache include file list
	protected $markL = '{-'; // left mark
	protected $markR = '-}'; // right mark
	protected $tagNamespace = ''; // tag namespace. 'pfa' direct use
	protected $tagMarkL = '<'; // tag left mark
	protected $tagMarkR = '>'; // tag right mark
	protected $tplPath = ''; // template file directory path
	protected $tplThemeDefault = 'default'; // default template theme, it is uesed when the specified theme does not exsit
	protected $tplTheme = 'default'; // template theme
	protected $tplSuffix = '.php'; // template file suffix
	protected $tplProtection = true; // prohibit download the template file
	protected $tplProtectionMark = 'THIS.TEMPLATE.FILE.IS.PROTECTED'; // template protection mark
	protected $stripSpace = 0; // Whether remove the html spaces and line breaks inside the template file; 0:no; 1:yes, remain a blank; 2:all
	protected $cacheExpire = 0; // cache expire. 0: do not automatically update
	protected $cachePath = ''; // cache file path
	protected $cacheSuffix = '.php'; // cache file suffix

	public function __construct($options = '') {
		$this->options = array(
			'markL' => C('TE.MARK_L'),
			'markR' => C('TE.MARK_R'),
			'tagNamespace' => C('TE.TAG_NAMESPACE'),
			'tagMarkL' => C('TE.TAG_MARK_L'),
			'tagMarkR' => C('TE.TAG_MARK_R'),
			'tplPath' => C('TE.TPL_PATH'),
			'tplThemeDefault' => C('TE.TPL_THEME_DEFAULT'),
			'tplTheme' => C('TE.TPL_THEME'),
			'tplSuffix' => C('TE.TPL_SUFFIX'),
			'tplProtection' => C('TE.TPL_PROTECTION'),
			'tplProtectionMark' => C('TE.TPL_PROTECTION_MARK'),
			'stripSpace' => C('TE.STRIP_SPACE'),
			'cacheExpire' => C('TE.CACHE_EXPIRE'),
			'cachePath' => C('TE.CACHE_PATH'),
			'cacheSuffix' => C('TE.CACHE_SUFFIX'),
			);
		if(!empty($options)) {
			$this->options = array_merge($this->options, $options);
		}
		if(is_array($this->options)) {
			foreach($this->options as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	/* assign template variables */
	public function assign($name, $value = '') {
		if(is_array($name)) {
			$this->tplVars = array_merge($this->tplVars, $name);
		}
		elseif(is_object($name)) {
			foreach($name as $key => $val) {
				$this->tplVars[$key] = $val;
			}
		}
		else {
			$this->tplVars[$name] = $value;
		}
	}

	/* display template */
	public function display($file, $data = array()) {
		$this->fetch($file, $data, true);
	}

	/* build html file */
	public function build_html($htmlfile, $htmlpath = '', $templateFile = '') {
		$content = $this->fetch($templateFile);
		$htmlpath = !empty($htmlpath) ? $htmlpath : APP_PATH . D_S . trim(C('HTML.DIR'), '/\\');
		$htmlfile = $htmlpath . D_S . ltrim($htmlfile, '/\\');
		if(!is_dir(dirname($htmlfile))) {
			mk_dir(dirname($htmlfile));
		}

		if(false === file_put_contents($htmlfile, $content)) {
			exit(L('_HTML_BUILD_FAILED_'));
		}
		return $content;
	}

	/* fetch template content */
	public function fetch($file, $data = array(), $display = false) {
		$this->tplVars = array_merge($this->tplVars, $data);
		$this->get_fileName($file);
		if(!$this->check_cache()) {
			$this->build_cache();
		}

		/* extract template variable to variable */
		extract($this->tplVars, EXTR_OVERWRITE);

		if(!$display) {
			ob_start();
			ob_implicit_flush(0);
			include ($this->cacheFile);
			return ob_get_clean();
		}
		else {
			if(!C('TE.GZIP') || !ob_start('ob_gzhandler')) {
				if(extension_loaded('zlib')) {
					@ini_set('zlib.output_compression', 'off');
				}
				ob_start();
			}
			include ($this->cacheFile);
			ob_end_flush();
			/* output after display */
			if(!C('TE.GZIP') || !ob_start('ob_gzhandler')) {
				ob_start();
			}
		}
	}

	/* get template and cache file's full path */
	private function get_fileName($tplfile = '') {
		$useThemeDefault = false;
		$this->cachePath = rtrim($this->cachePath, "/\\") . D_S;
		if(!is_file($tplfile)) {
			if('' == $tplfile) {
				$tplfile = C('TE.CURRENT_FILE'); // default show [GROUP_NAME/]CTRLR_NAME/ACTN_NAME
			}
			$this->tplPath = rtrim($this->tplPath, "/\\") . D_S;

			$file = str_replace($this->tplSuffix, '', $tplfile) . $this->tplSuffix;
			$tplfile = $this->tplPath . $this->tplTheme . D_S . $file;
			if(!is_file($tplfile)) {
				$useThemeDefault = true;

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

					/* set user agent branch for tpl */
					if(!empty($userAgent) and in_array($userAgent, $tuab)) {
						$tplfile = $this->tplPath . substr($this->tplTheme, 0, (-1 - strlen($userAgent))) . D_S . $file;
					}
				}
				if(!is_file($tplfile)) {
					$tplfile = $this->tplPath . $this->tplThemeDefault . D_S . $file;
					if(!is_file($tplfile)) {
						halt(L('_TPL_FILE_NOT_EXIST_') . ':' . $tplfile);
					}
				}
			}
		}

		$this->tplFile = $tplfile;
		$this->cacheFile = $this->cachePath . '~' . md5($tplfile) . $this->cacheSuffix;
		$this->cacheIncludeFile = $this->cachePath . '~' . md5($tplfile) . '.include' . $this->cacheSuffix;

		/* deal with no theme, like:tpl user agent branch */
		if($useThemeDefault) {
			$this->cacheFile = $this->cachePath . '~_' . md5($tplfile) . $this->cacheSuffix;
			$this->cacheIncludeFile = $this->cachePath . '~_' . md5($tplfile) . '.include' . $this->cacheSuffix;
		}
	}

	/* check cache expire */
	public function check_cache() {
		if(!file_exists($this->cacheFile)) {
			return false;
		}
		if(filemtime($this->cacheFile) < filemtime($this->tplFile)) {
			return false;
		}
		if(filemtime($this->cacheFile) + $this->cacheExpire < time() && 0 != $this->cacheExpire) {
			return false;
		}
		/* check include file */
		if(is_file($this->cacheIncludeFile)) {
			$includeFile = include $this->cacheIncludeFile;
			if(is_array($includeFile)) {
				foreach($includeFile as $file) {
					if(filemtime($this->cacheFile) < filemtime($file)) {
						return false;
					}
				}
			}
		}
		return true;
	}

	/* build cache file */
	public function build_cache() {
		$content = $this->get_tplContent($this->tplFile);

		/* filter php tags */
		//$content = str_replace(array('<'.'?php', '?'.'>'), array('&lt;?php', '?&gt;'), $content);
		$content = str_replace(array('<' . '?php'), array('&lt;?php'), $content);

		/* deal with include */
		preg_match_all($this->markL . 'include:(.*)' . $this->markR, $content, $include);
		$include = $include[1];
		if(!empty($include)) {
			/* include file list */
			$includeFileList = array();
			/* the directory of current template file */
			$currentDir = dirname($this->tplFile);
			foreach($include as $include) {
				$file = $currentDir . D_S . 
					($this->tplSuffix == substr(trim($include), -strlen($this->tplSuffix)) 
						? substr(trim($include), 0, -strlen($this->tplSuffix)) 
						: trim($include)) . $this->tplSuffix;
				if(file_exists($file)) {
					$includeFileList[] .= $file;
					$includeContent = $this->get_tplContent($file);
					$content = str_replace($this->markL . 'include:' . $include . $this->markR, $includeContent, $content);
				}
			}
			file_put_contents($this->cacheIncludeFile, "<?php\r\nreturn " . var_export($includeFileList, true) . ";\r\n?>");
		}

		/* deal with pfa tag */
		$patt = $this->tagMarkL . 'pfa:(.+?)' . $this->tagMarkR;
		preg_match_all("/{$patt}/eis", $content, $tags);
		if(is_array($tags[1])) {
			$pattEnd = $this->tagMarkL . '\/' . 'pfa:(\S+)' . $this->tagMarkR;
			preg_match_all("/{$pattEnd}/eis", $content, $tagsEnd);
			if(count($tags[1]) != count($tagsEnd[1])) {
				halt(L('_TPL_TAG_ERROR_'));
			}
			foreach($tags[1] as $t) {
				$content = str_replace($this->tagMarkL . 'pfa:' . $t . $this->tagMarkR, $this->parse_tag($t), $content);
			}
			foreach($tagsEnd[1] as $t) {
				$content = str_replace($this->tagMarkL . '/pfa:' . $t . $this->tagMarkR, "<?php endforeach; endif; ?>", $content);
			}
		}

		/* deal with custom tag */
		if($this->tagNamespace) {
			foreach(explode(',', $this->tagNamespace) as $tns) {
				$tagClass = 'Tag' . parse_name(strtolower($tns), 1);
				import('tag.' . $tagClass, LIB_COMM_PATH);
				$tag = get_instance($tagClass);
				$patt = $this->tagMarkL . $tns . ':(.+?)' . $this->tagMarkR;
				preg_match_all("/{$patt}/eis", $content, $tags);
				if(is_array($tags[1])) {
					foreach($tags[1] as $t) {
						$content = str_replace($this->tagMarkL . $tns . ':' . $t . $this->tagMarkR, $tag->parse_tag($t), $content);
					} // endforeach
				} // endif
				$pattEnd = $this->tagMarkL . '\/' . $tns . ':(\S+)' . $this->tagMarkR;
				preg_match_all("/{$pattEnd}/eis", $content, $tagsEnd);
				if(is_array($tags[1])) {
					foreach($tagsEnd[1] as $t) {
						$content = str_replace($this->tagMarkL . '/' . $tns . ':' . $t . $this->tagMarkR, $tag->parse_tag_end($t), $content);
					} // endforeach
				} // endif
			} // endforeach
		}

		$patt = $this->markL . '(\S.+?)' . $this->markR;
		$content = preg_replace("/{$patt}/eis", "\$this->parse_label('\\1')", $content);

		$str = "<?php /* PFA Template Cache File. Create Time:" . date(C('APP.TIME_FORMAT'), time()) . " */ ?>\r\n";
		/* remove html spaces and line breaks */
		if(1 == $this->stripSpace) {
			$find = array("~>\s+<~", "~>(\s+\n|\r)~");
			$replace = array("> <", "> ");
			$content = preg_replace($find, $replace, $content);
		}
		else if(2 == $this->stripSpace) {
			$find = array("~>\s+<~", "~>(\s+\n|\r)~");
			$replace = array("><", ">");
			$content = preg_replace($find, $replace, $content);
		}
		if(ini_get('short_open_tag')) {
			/* echo <? when short_open_tag is on ,or can not properly identify the output xml */
			$content = preg_replace('/(<\?(?!php|=|$))/i', '<?php echo \'\\1\'; ?>', $content);
		}
		$content = $str . $content;
		return file_put_contents($this->cacheFile, $content);
	}

	/* get template content */
	private function get_tplContent($tplFile) {
		$content = file_get_contents($tplFile);
		$_markPre = '<?php /* ';
		$_markSuf = ' */ ?>';
		if($this->tplProtection && strtolower($this->tplSuffix) == '.php') {
			/* have protection mark */
			if($this->tplProtectionMark == substr($content, strlen($_markPre), strlen($this->tplProtectionMark))) {
				$_t_markLenth = strlen($_markPre) + strlen($this->tplProtectionMark);
				$content = substr($content, $_t_markLenth, -strlen($_markSuf));
			}
			else {
				$contentNew = $_markPre . $this->tplProtectionMark . $content . $_markSuf;
				file_put_contents($tplFile, $contentNew);
			}
		}
		else {
			/* remover protection mark */
			if($this->tplProtectionMark == substr($content, strlen($_markPre), strlen($this->tplProtectionMark))) {
				$_t_markLenth = strlen($_markPre) + strlen($this->tplProtectionMark);
				$content = substr($content, $_t_markLenth, -strlen($_markSuf));
				file_put_contents($tplFile, $content);
			}
		}
		return $content;
	}

	/* parse pfa tag */
	private function parse_tag($params) {
		$params = explode(' ', $params, 2);
		$params[1] = $params[1] . ' ';
		preg_match_all('/.*?(\s*.*?=.*?[\"|\'].*?[\"|\']\s).*?/si', $params[1], $arr);
		$a = array();
		if(isset($arr[1]) && !empty($arr[1])) {
			foreach($arr[1] as $v) {
				$t = explode('=', trim(str_replace(array('"', "'"), '', $v)));
				$a = array_merge($a, array(trim($t[0]) => trim($t[1])));
			}
		}

		$params[0] = parse_name($params[0], 1);
		/* database table */
		$str = "\$_m = M('{$params[0]}');\r\n";

		foreach($a as $k => $v) {
			/* variable parameter. such as: $a.b.c */
			if('$' == substr($v, 0, 1)) {
				$ak = '$';
				$_var = explode('.', substr($v, 1));
				foreach($_var as $_k => $_var) {
					if(0 == $_k) {
						$ak .= $_var;
					}
					else {
						$ak .= "['" . $_var . "']";
					}
				}
				$a[$k] = "'.{$ak}.'";
			}
		}

		/* parse field */
		if(isset($a['field']) && !empty($a['field'])) {
			$str .= "\$_m->field('{$a['field']}');\r\n";
		}

		/* parse where */
		if(isset($a['where']) && !empty($a['where'])) {
			$_t_from = array(
				'eq',
				'neq',
				'gt',
				'egt',
				'lt',
				'elt',
				'notlike',
				'like');
			$_t_to = array(
				'=',
				'<>',
				'>',
				'>=',
				'<',
				'<=',
				'NOT LIKE',
				'LIKE');
			$where = str_replace($_t_from, $_t_to, $a['where']);
			$str .= "\$_m->where('{$where}');\r\n";
		}

		/* parse join */
		if(isset($a['join']) && !empty($a['join'])) {
			$a['join'] = str_replace('eq', '=', $a['join']);
			$str .= "\$_m->join('{$a['join']}');\r\n";
		}

		/* parse order */
		if(isset($a['order']) && !empty($a['order'])) {
			$str .= "\$_m->order('{$a['order']}');\r\n";
		}

		/* parse limit */
		if(isset($a['limit']) && !empty($a['limit'])) {
			$str .= "\$_m->limit('{$a['limit']}');\r\n";
		}

		/* parse item variable name */
		if(isset($a['as']) && !empty($a['as'])) {
			$as = $a['as'];
		}
		else {
			$as = 'v';
		}

		$str = "<?php\r\n" . $str;
		$str .= "\$array = \$_m->select();\r\n";
		$str .= "if(\$array) : foreach(\$array as \${$as}): \r\n ?>";
		return $str;
	}

	/* parse label content. parse by the first character */
	private function parse_label($label) {
		$label = stripslashes(trim($label));
		$flags = array(
			'var' => ':$',
			'language' => ':@',
			'config' => ':#',
			'cookie' => ':+',
			'session' => ':-',
			'get' => ':%',
			'post' => ':&',
			'constant' => ':*',
			'end' => ':/');
		$flag = substr($label, 0, 2);
		if(in_array($flag, $flags)) {
			$name = substr($label, 2);
			switch($flag) {
					/* normal variable */
				case $flags['var']:
					return !empty($name) ? $this->parse_var($name) : null;
					/* output language */
				case $flags['language']:
					return !empty($name) ? $this->parse_lang($name) : null;
					/* output config */
				case $flags['config']:
					return "<?php echo(C(\"{$name}\")); ?>";
					/* output cookie */
				case $flags['cookie']:
					return "<?php echo(ACookie::get(\"{$name}\")); ?>";
					/* output session */
				case $flags['session']:
					return "<?php echo(ASession::get(\"{$name}\")); ?>";
					/* output get */
				case $flags['get']:
					return "<?php echo(ARequest::get(\"{$name}\", 'get')); ?>";
					/* output post */
				case $flags['post']:
					return "<?php echo(ARequest::get(\"{$name}\", 'post')); ?>";
					/* output constant */
				case $flags['constant']:
					if('THEME_PATH' == $name) {
						return TPL_PATH . ($this->tplTheme ? D_S . $this->tplTheme : '');
					}
					if('__THEME__' == $name) {
						return __APP__ . TPL_DIR . '/' . ($this->tplTheme ? $this->tplTheme . '/' : '');
					}
					return "<?php echo({$name}); ?>";
					/* statements end section */
				case $flags['end']:
					$name = strtolower($name);
					if('foreach' == $name) {
						return "<?php endforeach; endif; ?>";
					}
					return "<?php end{$name}; ?>";
			}
		}
		else {
			$tags = explode(':', $label, 2);
			$tag = strtolower(trim($tags[0]));
			$params = isset($tags[1]) ? trim($tags[1]) : '';
			switch($tag) {
				case 'import':
					return $this->parse_import($params);
				case 'foreach':
					$arr = trim_array(explode(',', $params));
					if(count($arr) == 3) {
						return "<?php if(isset({$arr[0]}) and is_array({$arr[0]})) : foreach({$arr[0]} as {$arr[1]} => {$arr[2]}) : ?>";
					}
					elseif(count($arr) == 2) {
						return "<?php if(isset({$arr[0]}) and is_array({$arr[0]})) : foreach({$arr[0]} as {$arr[1]}) : ?>";
					}
					return "<?php if(is_array({$arr[0]})) : foreach({$arr[0]} as \$v) : ?>";
				case 'for':
					$arr = trim_array(explode(',', $params));
					return "<?php for({$arr[0]};{$arr[1]};{$arr[2]}) : ?>";
				case 'if':
					return "<?php if({$params}) :  ?>";
				case 'elseif':
					return "<?php elseif({$params}) :  ?>";
				case 'else':
					return "<?php else : ?>";
				case 'url':
					return "<?php echo(Url::U(\"{$params}\")); ?>";
				case 'php':
					return "<?php {$params} ?>";
			}
		}
		return trim($this->markL, '\\') . $label . trim($this->markR, '\\');
	}

	/* parse variable. $varStr variable string */
	private function parse_var($varStr) {
		/* var|function_parameter */
		$varArray = explode('|', $varStr);
		/* pop the first element (variable name) */
		$var = array_shift($varArray);
		/* array by $var.xxx.xxx */
		if(strpos($var, '.')) {
			$vars = explode('.', $var);
			foreach($vars as $k => $v) {
				if(0 == $k) {
					$name = '$' . $v;
				}
				else {
					$name .= "['" . $v . "']";
				}
			}
		}
		/* arrary by $var['xxx'] */
		elseif(strpos($var, '[')) {
			$name = "$" . $var;
		}
		else {
			$name = "$$var";
		}
		/* if function is used */
		if(count($varArray) > 0) {
			/* parse variable and function parameter */
			$name = $this->parse_function($name, $varArray);
		}
		$code = !empty($name) ? "<?php echo({$name}); ?>" : '';
		return $code;
	}

	/* parse function. $varStr: variable name, $varArray: function name and parameter */
	private function parse_function($name, $varArray) {
		$len = count($varArray);
		/* get deny function */
		$not = explode(',', C('TE.TPL_DENY_FUNC'));
		for($i = 0; $i < $len; $i++) {
			/* func~param1,param2,@me */
			$arr = explode('~', $varArray[$i]);
			$funcName = array_shift($arr);
			$arr = array_shift($arr);
			/* exclude deny function */
			if(!in_array($funcName, $not)) {
				$args = explode(',', $arr);
				if(count($arr) > 0) {
					$p = array();
					foreach($args as $var) {
						$var = trim($var);
						if($var == '@me') {
							$var = $name;
						}
						$p[] = $var;
					}
					$param = join(", ", $p);
					$code = "{$funcName}($param)";
				}
				else {
					$code = "{$funcName}($arr[0])";
				}
			}
		}
		return $code;
	}

	/* parse language. $langStr language string */
	private function parse_lang($langStr) {
		/* lang|key~val,key1~$val1,key2~*VAL2 */
		$langArray = explode('|', $langStr);
		/* pop the first element (lang name) */
		$name = array_shift($langArray);
		/* if data is used */
		if(count($langArray) > 0) {
			/* parse lang data */
			$dataStr = 'array(';
			$arr = explode(',', $langArray[0]);
			foreach($arr as $data) {
				$d = explode('~', $data);
				if('$' == substr($d[1], 0, 1)) {
					$dataStr .= "\"{$d[0]}\" => {$d[1]},";
				}
				elseif('*' == substr($d[1], 0, 1)) {
					$d[1] = substr($d[1], 1);
					$dataStr .= "\"{$d[0]}\" => {$d[1]},";
				}
				else {
					$dataStr .= "\"{$d[0]}\" => \"{$d[1]}\",";
				}
			}
			$dataStr = rtrim($dataStr, ',') . ')';
			$code = "<?php echo(L(\"{$name}\", null, {$dataStr})); ?>";
		}
		else {
			$code = !empty($name) ? "<?php echo(L(\"{$name}\")); ?>" : '';
		}
		return $code;
	}

	/* parse import label */
	private function parse_import($label) {
		$param = array(); // parameter array
		$arr = explode(' ', $label);
		foreach($arr as $v) {
			if(strpos($v, '=') > 0) {
				$args = explode('=', $v);
				$param[$args[0]] = trim($args[1], '"');
			}
		}

		$fileType = !empty($param['type']) ? strtolower($param['type']) : 'js';

		$param['file'] = str_replace(array('.', '#'), array('/', '.'), $param['file']);
		$files = explode(',', $param['file']);

		$fileName = '~' . str_replace(array(',', '/'), array('-', '.'), $param['file']) . '.' . $fileType;

		$basePath = preg_replace_callback('/\((.*)\)/', array($this, 'parse_teConstant'), $param['basepath']);
		$basePath = rtrim($basePath, '/\\') . D_S;

		$baseUrl = preg_replace_callback('/\((.*)\)/', array($this, 'parse_teConstant'), $param['baseurl']);
		$baseUrl = rtrim($baseUrl, '/\\') . '/';

		$fileUrl = $baseUrl . $fileName;

		/* create temp file */
		$fileContent = '';
		foreach($files as $file) {
			if(file_exists($basePath . $file . '.' . $fileType)) {
				$fileContent .= file_get_contents($basePath . $file . '.' . $fileType);
			}
			else {
				$fileContent .= "\r\n/* load error:" . $baseUrl . $file . '.' . $fileType . " */\r\n";
			}
		}
		if(!is_dir(dirname($basePath . $fileName))) {
			mk_dir(dirname($basePath . $fileName));
		}
		file_put_contents($basePath . $fileName, $fileContent);

		switch($fileType) {
			case 'js':
				$str = '<script src="' . $fileUrl . '"></script>';
				break;
			case 'css':
				$str = '<link rel="stylesheet" type="text/css" href="' . $fileUrl . '" />';
				break;
		}

		return "<?php echo('{$str}') ?>";
	}

	/* parse constant in import label */
	private function parse_teConstant($matches) {
		if('THEME_PATH' == $matches[1]) {
			return TPL_PATH . ($this->tplTheme ? D_S . $this->tplTheme : '');
		}
		if('__THEME__' == $matches[1]) {
			return __APP__ . TPL_DIR . '/' . ($this->tplTheme ? $this->tplTheme . '/' : '');
		}
		/* $matches[1] is the match of the first parentheses' child model */
		if(defined($matches[1])) {
			return constant($matches[1]);
		}
		return null;
	}
}

?>
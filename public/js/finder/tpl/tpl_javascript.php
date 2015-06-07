<script src="<?php echo __FINDER__; ?>js/jquery.js"></script>
<script src="<?php echo __FINDER__; ?>js/jquery.rightClick.js"></script>
<script src="<?php echo __FINDER__; ?>js/jquery.drag.js"></script>
<script src="<?php echo __FINDER__; ?>js/helper.js"></script>
<script src="<?php echo __FINDER__; ?>js/browser/joiner.php"></script>
<script src="<?php echo __FINDER__; ?>js_localize.php?lng=<?php echo $this->lang; ?>"></script>
<?php IF (isset($this->opener['TinyMCE']) && $this->opener['TinyMCE']): ?>
<script src="<?php echo $this->config['_tinyMCEPath'] ?>/tiny_mce_popup.js"></script>
<?php ENDIF ?>
<?php IF (file_exists("<?php echo FINDER_PATH; ?>/themes/{$this->config['theme']}/init.js")): ?>
<script src="<?php echo __FINDER__; ?>themes/<?php echo $this->config['theme']; ?>/init.js"></script>
<?php ENDIF ?>
<script>
browser.version = "<?php echo self::VERSION ?>";
browser.support.chromeFrame = <?php echo (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), " chromeframe") !== false) ? "true" : "false" ?>;
browser.support.zip = <?php echo (class_exists('ZipArchive') && !$this->config['denyZipDownload']) ? "true" : "false" ?>;
browser.support.check4Update = <?php echo ((!isset($this->config['denyUpdateCheck']) || !$this->config['denyUpdateCheck']) && (ini_get("allow_url_fopen") || function_exists("http_get") || function_exists("curl_init") || function_exists('socket_create'))) ? "true" : "false" ?>;
browser.lang = "<?php echo text::jsValue($this->lang) ?>";
browser.type = "<?php echo text::jsValue($this->type) ?>";
browser.theme = "<?php echo text::jsValue($this->config['theme']) ?>";
browser.access = <?php echo json_encode($this->config['access']) ?>;
browser.dir = "<?php echo text::jsValue($this->session['dir']) ?>";
browser.uploadURL = "<?php echo rtrim(text::jsValue($this->config['uploadURL']), '/'); ?>";
browser.thumbsURL = browser.uploadURL + "/<?php echo text::jsValue($this->config['thumbsDir']) ?>";
<?php IF (isset($this->get['opener']) && strlen($this->get['opener'])): ?>
browser.opener.name = "<?php echo text::jsValue($this->get['opener']) ?>";
<?php ENDIF ?>
<?php IF (isset($this->opener['CKEditor']['funcNum']) && preg_match('/^\d+$/', $this->opener['CKEditor']['funcNum'])): ?>
browser.opener.CKEditor = {};
browser.opener.CKEditor.funcNum = <?php echo $this->opener['CKEditor']['funcNum'] ?>;
<?php ENDIF ?>
<?php IF (isset($this->opener['TinyMCE']) && $this->opener['TinyMCE']): ?>
browser.opener.TinyMCE = true;
<?php ENDIF ?>
browser.cms = "<?php echo text::jsValue($this->cms) ?>";
_.kuki.domain = "<?php echo text::jsValue($this->config['cookieDomain']) ?>";
_.kuki.path = "<?php echo text::jsValue($this->config['cookiePath']) ?>";
_.kuki.prefix = "<?php echo text::jsValue($this->config['cookiePrefix']) ?>";
$(document).ready(function() {
    browser.resize();
    browser.init();
    $('#all').css('visibility', 'visible');
});
$(window).resize(browser.resize);
</script>

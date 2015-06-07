<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt><strong>{-:@TAG_PREVIEW-}</strong></dt>
	<dd>
		~preview~
	</dd>
</dl><!--/.abox-->
<form id="formPreview" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@CODE-}</strong></dt>
	<dd>
		<textarea id="code" name="code" class="i" style="width:95%;height:160px;">~code~</textarea>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<span class="btn_l submit" action="{-url:template/tag_preview-}" to="#formPreview">{-:@TAG_PREVIEW-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:template/tag_wizard-}">{-:@BACK-}</a>
</div>
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>
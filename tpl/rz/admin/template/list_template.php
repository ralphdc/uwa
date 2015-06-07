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
	<dt><strong>{-:@TEMPLATE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@AUTHOR-}</th>
				<th scope="col">{-:@VERSION-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_TL,$t-}
			<tr>
				<td>{-:$t['alias']-}</td>
				<td>{-:$t['name']-}</td>
				<td>{-:$t['author']-} <a class="bg_gry_l br_3 fs_11 p_2_5 fc_gry" href="{-:$t['author_site']-}" target="_blank">{-:$t['author_site']-}</a></td>
				<td>{-:$t['version']-}</td>
				<td><a href="{-url:template/list_template_file?template={$t['alias']}-}">{-:@TEMPLATE_FILE_LIST-}</a></td>
			</tr>
			{-:/foreach-}
		</table>
	</dd>
</dl><!--/.abox-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>
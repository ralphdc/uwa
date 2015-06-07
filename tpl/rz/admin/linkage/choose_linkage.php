<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
</head>
<body>
<form id="formList" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@LINKAGE_LIST-}</strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col" width="50">{-:@ID-}</th>
				<th scope="col">{-:@NAME-}</th>
				<th scope="col">{-:@ALIAS-}</th>
				<th scope="col">{-:@DESCRIPTION-}</th>
				<th scope="col">{-:@TYPE-}</th>
				<th scope="col">{-:@MANAGE-}</th>
			</tr>
			{-foreach:$_LL,$l-}
			<tr>
				<td>{-:$l['linkage_id']-}</td>
				<td>{-:$l['l_name']-}</td>
				<td>
					<input name="l_alias[{-:$l['linkage_id']-}]" type="hidden" value="{-:$l['l_alias']-}">
					{-:$l['l_alias']-}
				</td>
				<td>{-:$l['l_description']-}</td>
				<td>
				{-if:0 == $l['l_type']-}
					<span>{-:@SYSTEM-}</span>
				{-elseif:1 == $l['l_type']-}
					<span>{-:@CUSTOM-}</span>
				{-:/if-}
				</td>
				<td><span class="btn_l choose_linkage" linkage="{-:$l['l_alias']-}">{-:@CHOOSE-}</span></td>
			</tr>
			{-:/foreach-}
		</table>
		{-include:../paging-}
	</dd>
</dl><!--/.abox-->
</form>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	$('.choose_linkage').bind('click', function() {
		var linkage = $(this).attr('linkage');
		var dialog = parent.dialog.get(window),
			data = {'linkage': linkage};
		dialog.close(data);
		dialog.remove();
	});
});
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>
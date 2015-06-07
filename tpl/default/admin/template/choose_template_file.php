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
<table class="listTable">
	<tr>
		<td colspan="6"><span class="bg_gry_d br_3 p_2_5 fc_wht fs_11">{-:@TEMPLATE-}: {-:$_FL['template']-}/{-:$_FL['base_dir']-}</span></td>
	</tr>
	<tr>
		<th scope="col">{-:@NAME-}</th>
		<th scope="col">{-:@DESCRIPTION-}</th>
		<th scope="col">{-:@CHOOSE-}</th>
	</tr>
	{-if:!empty($_FL['current_dir'])-}<tr>
		<td colspan="5"><i class="ai ai_16 ai_16_file_type_folder"></i> <a href="{-url:template/choose_template_file?template={$_FL['template']}&base_dir={$_FL['base_dir']}&dir={$_FL['parent_dir']}-}">.. [{-:@PARENT_DIR-}]</a></td>
	</tr>{-:/if-}
	{-foreach:$_FL['list']['dir'],$dir-}
	<tr>
		<td><i class="ai ai_16 ai_16_file_type_folder"></i> <a href="{-url:template/choose_template_file?template={$_FL['template']}&base_dir={$_FL['base_dir']}&dir={$_FL['current_dir']}*{$dir['name']}-}">{-:$dir['name']-}</a></td>
		<td>{-:$dir['description']-}</td>
		<td></td>
	</tr>
	{-:/foreach-}
	{-foreach:$_FL['list']['file'],$file-}
	<tr>
		<td><i class="ai ai_16 ai_16_file_type_{-:$file['type']-}"></i> {-:$file['name']-}</td>
		<td>{-:$file['description']-}</td>
		<td><span class="btn_l choose_template" file="{-:$_FL['current_dir']-}*{-:$file['name']-}">{-:@CHOOSE-}</span></td>
	</tr>
	{-:/foreach-}
</table>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	$('.choose_template').bind('click', function() {
		var file = $(this).attr('file');
		if('.php' == file.slice(-4)) {
			file = file.slice(1, -4).replace(/\*/g, '/');
		}
		else {
			file = file.slice(1).replace(/\*/g, '/');
		}
		var dialog = parent.dialog.get(window),
			data = {'templateFile': file};
		dialog.close(data);
		dialog.remove();
	});
});
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
</body>
</html>
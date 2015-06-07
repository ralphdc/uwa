<?php /* PFA Template Cache File. Create Time:2015-06-06 15:18:15 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<table class="listTable">
	<tr>
		<td colspan="6"><span class="bg_gry_d br_3 p_2_5 fc_wht fs_11"><?php echo(L("TEMPLATE")); ?>: <?php echo($_FL['template']); ?>/<?php echo($_FL['base_dir']); ?></span></td>
	</tr>
	<tr>
		<th scope="col"><?php echo(L("NAME")); ?></th>
		<th scope="col"><?php echo(L("DESCRIPTION")); ?></th>
		<th scope="col"><?php echo(L("CHOOSE")); ?></th>
	</tr>
	<?php if(!empty($_FL['current_dir'])) :  ?><tr>
		<td colspan="5"><i class="ai ai_16 ai_16_file_type_folder"></i> <a href="<?php echo(Url::U("template/choose_template_file?template={$_FL['template']}&base_dir={$_FL['base_dir']}&dir={$_FL['parent_dir']}")); ?>">.. [<?php echo(L("PARENT_DIR")); ?>]</a></td>
	</tr><?php endif; ?>
	<?php if(isset($_FL['list']['dir']) and is_array($_FL['list']['dir'])) : foreach($_FL['list']['dir'] as $dir) : ?>
	<tr>
		<td><i class="ai ai_16 ai_16_file_type_folder"></i> <a href="<?php echo(Url::U("template/choose_template_file?template={$_FL['template']}&base_dir={$_FL['base_dir']}&dir={$_FL['current_dir']}*{$dir['name']}")); ?>"><?php echo($dir['name']); ?></a></td>
		<td><?php echo($dir['description']); ?></td>
		<td></td>
	</tr>
	<?php endforeach; endif; ?>
	<?php if(isset($_FL['list']['file']) and is_array($_FL['list']['file'])) : foreach($_FL['list']['file'] as $file) : ?>
	<tr>
		<td><i class="ai ai_16 ai_16_file_type_<?php echo($file['type']); ?>"></i> <?php echo($file['name']); ?></td>
		<td><?php echo($file['description']); ?></td>
		<td><span class="btn_l choose_template" file="<?php echo($_FL['current_dir']); ?>*<?php echo($file['name']); ?>"><?php echo(L("CHOOSE")); ?></span></td>
	</tr>
	<?php endforeach; endif; ?>
</table>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
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
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>
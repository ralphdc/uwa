<?php /* PFA Template Cache File. Create Time:2015-06-08 01:18:36 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/rz/admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt><strong><?php echo(L("TEMPLATE_LIST")); ?></strong></dt>
	<dd>
		<table class="listTable">
			<tr>
				<th scope="col"><?php echo(L("ALIAS")); ?></th>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("AUTHOR")); ?></th>
				<th scope="col"><?php echo(L("VERSION")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_TL) and is_array($_TL)) : foreach($_TL as $t) : ?>
			<tr>
				<td><?php echo($t['alias']); ?></td>
				<td><?php echo($t['name']); ?></td>
				<td><?php echo($t['author']); ?> <a class="bg_gry_l br_3 fs_11 p_2_5 fc_gry" href="<?php echo($t['author_site']); ?>" target="_blank"><?php echo($t['author_site']); ?></a></td>
				<td><?php echo($t['version']); ?></td>
				<td><a href="<?php echo(Url::U("template/list_template_file?template={$t['alias']}")); ?>"><?php echo(L("TEMPLATE_FILE_LIST")); ?></a></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/rz/admin/js/c.js"></script>
</body>
</html>
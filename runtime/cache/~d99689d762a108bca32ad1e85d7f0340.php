<?php /* PFA Template Cache File. Create Time:2015-06-06 01:26:41 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
</head>
<body>
<dl class="abox">
	<dt>
		<?php if('' == ARequest::get('e_type')) :  ?>
			<strong><?php echo(L("ALL_EXTENSION")); ?></strong>
		<?php else : ?>
			<span><a href="<?php echo(Url::U("extension/list_extension")); ?>"><?php echo(L("ALL_EXTENSION")); ?></a></span>
		<?php endif; ?>
		<?php if('module' == ARequest::get('e_type')) :  ?>
			<strong><?php echo(L("MODULE")); ?></strong>
		<?php else : ?>
			<span><a href="<?php echo(Url::U("extension/list_extension?e_type=module")); ?>"><?php echo(L("MODULE")); ?></a></span>
		<?php endif; ?>
		<?php if('plugin' == ARequest::get('e_type')) :  ?>
			<strong><?php echo(L("PLUGIN")); ?></strong>
		<?php else : ?>
			<span><a href="<?php echo(Url::U("extension/list_extension?e_type=plugin")); ?>"><?php echo(L("PLUGIN")); ?></a></span>
		<?php endif; ?>
		<?php if('template' == ARequest::get('e_type')) :  ?>
			<strong><?php echo(L("TEMPLATE")); ?></strong>
		<?php else : ?>
			<span><a href="<?php echo(Url::U("extension/list_extension?e_type=template")); ?>"><?php echo(L("TEMPLATE")); ?></a></span>
		<?php endif; ?>
		<?php if('patch' == ARequest::get('e_type')) :  ?>
			<strong><?php echo(L("PATCH")); ?></strong>
		<?php else : ?>
			<span><a href="<?php echo(Url::U("extension/list_extension?e_type=patch")); ?>"><?php echo(L("PATCH")); ?></a></span>
		<?php endif; ?>
		<?php if('other' == ARequest::get('e_type')) :  ?>
			<strong><?php echo(L("OTHER")); ?></strong>
		<?php else : ?>
			<span><a href="<?php echo(Url::U("extension/list_extension?e_type=other")); ?>"><?php echo(L("OTHER")); ?></a></span>
		<?php endif; ?>
	</dt>
	<dd>
		<div class="mainTips">
			<span class="fs_12"><?php echo(L("EXTENSION_MAIN_TIP")); ?></span>
		</div><!--/.mainTips-->
		<table class="listTable">
			<tr>
				<th scope="col"><?php echo(L("NAME")); ?></th>
				<th scope="col"><?php echo(L("AUTHOR")); ?></th>
				<th scope="col"><?php echo(L("VERSION")); ?></th>
				<th scope="col"><?php echo(L("PUBLISH_DATE")); ?></th>
				<th scope="col"><?php echo(L("TYPE")); ?></th>
				<th scope="col"><?php echo(L("STATUS")); ?></th>
				<th scope="col"><?php echo(L("MANAGE")); ?></th>
			</tr>
			<?php if(isset($_EL) and is_array($_EL)) : foreach($_EL as $e) : ?>
			<tr>
				<td><?php echo($e['e_name']); ?> <span class="fc_gry fs_11 br_3 br_gry p_0_2"><?php echo($e['e_alias']); ?></span></td>
				<td><?php echo($e['e_author']); ?></td>
				<td><?php echo($e['e_version']); ?></td>
				<td><?php echo($e['e_publish_date']); ?></td>
				<td>
				<?php if('module' == $e['e_type']) :  ?>
					<?php echo(L("MODULE")); ?>
				<?php elseif('plugin' == $e['e_type']) :  ?>
					<?php echo(L("PLUGIN")); ?>
				<?php elseif('template' == $e['e_type']) :  ?>
					<?php echo(L("TEMPLATE")); ?>
				<?php elseif('patch' == $e['e_type']) :  ?>
					<?php echo(L("PATCH")); ?>
				<?php elseif('other' == $e['e_type']) :  ?>
					<?php echo(L("OTHER")); ?>
				<?php endif; ?>
				</td>
				<td>
				<?php if(1 == $e['e_status']) :  ?>
					<span class="fc_g fs_11 br_3 br_g p_0_2"><?php echo(L("INSTALLED")); ?></span>
					<span class="fc_gry fs_11 br_3 br_gry p_0_2"><?php echo(date(C('APP.TIME_FORMAT'), $e['e_install_datetime'])); ?></span>
				<?php else : ?>
					<span class="fc_gry fs_11 br_3 br_gry p_0_2"><?php echo(L("NOT_INSTALLED")); ?></span>
				<?php endif; ?>
				</td>
				<td><a href="<?php echo(Url::U("extension/show_extension?e_hashcode={$e['e_hashcode']}")); ?>"><?php echo(L("DETAIL")); ?></a>
				<?php if(1 == $e['e_status']) :  ?> | <a href="<?php echo(Url::U("extension/uninstall_extension_do?e_hashcode={$e['e_hashcode']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>"><?php echo(L("UNINSTALL")); ?></a>
				<?php else : ?> | <a href="<?php echo(Url::U("extension/install_extension?e_hashcode={$e['e_hashcode']}")); ?>"><?php echo(L("INSTALL")); ?></a> | <a href="<?php echo(Url::U("extension/delete_extension_do?e_hashcode={$e['e_hashcode']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}")); ?>" onclick="javascript:return delete_confirm();" ><?php echo(L("DELETE")); ?></a>
				<?php endif; ?></td>
			</tr>
			<?php endforeach; endif; ?>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<a class="btn_l" href="<?php echo(Url::U("extension/upload_extension")); ?>"><?php echo(L("UPLOAD_EXTENSION")); ?></a>
	<a class="btn_l" href="<?php echo(Url::U("extension/package_extension")); ?>"><?php echo(L("PACKAGE_EXTENSION")); ?></a>
</div><!--/#operation-->
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
</body>
</html>
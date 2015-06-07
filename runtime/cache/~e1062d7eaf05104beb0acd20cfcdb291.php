<?php /* PFA Template Cache File. Create Time:2015-06-06 01:16:30 */ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="/tpl/default/admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.css" />
</head>
<body>
<table width="100%">
<tr>
	<td width="40%" valign="top">
		<dl class="abox">
			<dt><strong><?php echo(L("WELCOME")); ?></strong></dt>
			<dd>
				<div class="mainTips" style="text-indent:2em">
					<?php echo(L("UWA_WELCOME", null, array("soft_name" => SOFT_NAME))); ?>
					<?php if(!empty($_SST)) :  ?>
					<h3 class=" fc_r"><?php echo(L("SITE_SAFE_TIP")); ?></h3>
					<ol class="ol fc_r"><?php if(isset($_SST) and is_array($_SST)) : foreach($_SST as $sst) : ?>
						<li><?php echo($sst); ?></li>
					<?php endforeach; endif; ?></ol>
					<?php endif; ?>
				</div>
			</dd>
		</dl><!--/.abox-->
		<dl class="abox">
			<dt><strong><?php echo(L("LATEST_ADMIN_LOG")); ?></strong><span><a href="<?php echo(Url::U("admin_log/list_log")); ?>"><?php echo(L("MORE")); ?></a></span></dt>
			<dd>
				<table class="listTable">
					<tr>
						<th scope="col"><?php echo(L("ADMIN")); ?></th>
						<th scope="col"><?php echo(L("OPERATION")); ?></th>
						<th scope="col" width="40"><?php echo(L("STATUS")); ?></th>
						<th scope="col"><?php echo(L("TIME")); ?></th>
						<th scope="col"><?php echo(L("IP")); ?></th>
					</tr>
					<?php if(isset($_LMLL) and is_array($_LMLL)) : foreach($_LMLL as $al) : ?>
					<tr>
						<td><?php echo($al['m_userid']); ?></td>
						<td><?php echo(AString::msubstr($al['al_operation'], 0, 7)); ?></td>
						<td>
						<?php if(1 == $al['al_status']) :  ?>
							<span class="bg_wht br_g br_3 p_0_2 fc_g fw_b fs_11"><?php echo(L("SUCCESS")); ?></span>
						<?php else : ?>
							<span class="bg_wht br_r br_3 p_0_2 fc_r fw_b fs_11"><?php echo(L("FAILED")); ?></span>
						<?php endif; ?>
						</td>
						<td><?php echo(date('m-d', $al['al_time'])); ?></td>
						<td><?php echo($al['al_ip']); ?></td>
					</tr>
					<?php endforeach; endif; ?>
				</table>
			</dd>
		</dl><!--/.abox-->
		<dl class="atab">
			<dt><strong><?php echo(L("SOFT_INFO")); ?></strong><strong><?php echo(L("SYSTEM_EVN")); ?></strong><?php if(!empty($LICENCE)) :  ?><strong><?php echo(L("AUTHORIZED")); ?></strong><?php endif; ?></dt>
			<dd>
				<div class="tabCntnt">
					<ul>
						<li><?php echo(L("SOFT_NAME")); ?>: <span class="status p_0_2"><?php echo(SOFT_NAME); ?></span></li>
						<li><?php echo(L("SOFT_VERSION")); ?>: <span class="status p_0_2"><?php echo(SOFT_VERSION); ?></span> <span class="btn_l" onClick="check_new_version();"><?php echo(L("CHECK_NEW_VERSION")); ?></span> <span id="check_result"></span></li>
						<li><?php echo(L("SOFT_CODENAME")); ?>: <span class="status p_0_2"><?php echo(SOFT_CODENAME); ?></span></li>
						<li><?php echo(L("SOFT_CHARSET")); ?>: <span class="status p_0_2"><?php echo(SOFT_CHARSET); ?></span></li>
						<li><?php echo(L("SOFT_AUTHOR")); ?>: <a target="_blank" href="<?php echo(SOFT_AUTHOR_URL); ?>"><span class="status p_0_2"><?php echo(SOFT_AUTHOR); ?></span></a></li>
					</ul>
				</div><!--/.tabCntnt-->
				<div class="tabCntnt">
					<ul>
						<li>
							<?php echo(L("OS")); ?>: <span class="status p_0_2"><?php echo($_SE['os']); ?></span>
							<?php echo(L("SERVER_SOFTWARE")); ?>: <span class="status p_0_2"><?php echo($_SE['server_software']); ?></span>
						</li>
						<li>
							<?php echo(L("PHP_VERSION")); ?>: <span class="status p_0_2"><?php echo($_SE['php_version']); ?></span>
							<?php echo(L("GD_VERSION")); ?>: <span class="status p_0_2"><?php echo($_SE['gd_version']); ?></span>
						</li>
						<li>
							<?php echo(L("MYSQL_VERSION")); ?>: <span class="status p_0_2"><?php echo($_SE['mysql_version']); ?></span>
							<?php echo(L("UPLOAD_MAX_SIZE")); ?>: <span class="status p_0_2"><?php echo($_SE['upload_max_size']); ?></span>
						</li>
						<li>
							<?php echo(L("SAFE_MODE")); ?>: <span class="status p_0_2"><?php echo($_SE['safe_mode']); ?></span>
						</li>
						<li>
							<?php echo(L("REGISTER_GLOBALS")); ?>: <span class="status p_0_2"><?php echo($_SE['register_globals']); ?></span>
						</li>
						<li>
							<?php echo(L("MAGIC_QUOTES_GPC")); ?>: <span class="status p_0_2"><?php echo($_SE['magic_quoter_gpc']); ?></span>
						</li>
						<li>
							<?php echo(L("ALLOW_URL_FOPEN")); ?>: <span class="status p_0_2"><?php echo($_SE['allow_url_fopen']); ?></span>
						</li>
					</ul>
				</div><!--/.tabCntnt-->
					<?php if(!empty($LICENCE)) :  ?>
				<div class="tabCntnt">
					<ul>
						<li><span class="fw_b fs_14"></span></li>
						<li><?php echo(L("LICENCE_DOMAIN")); ?>: <span class="status p_0_2"><?php echo($LICENCE['domain']); ?></span></li>
						<li><?php echo(L("LICENCE_KEY")); ?>: <span class="status p_0_2 fs_11"><?php echo($LICENCE['key']); ?></span></li>
					</ul>
					<div style="height:10px;clear:both;overflow:hidden"></div>
					<div><?php echo(L("AUTHORIZED_TIP", null, array("url" => SOFT_AUTHORIZATION_URL))); ?></div>
				</div><!--/.tabCntnt-->
				<?php endif; ?>
			</dd>
		</dl><!--/.atab-->
	</td>
	<td width="10"></td>
	<td valign="top">
		<dl class="adl">
			<dt><strong><?php echo(L("SHORTCUT")); ?></strong> <span><b class="a" id="add_shortcut"><?php echo(L("ADD")); ?></b> | <b class="a" id="manage_shortcut"><?php echo(L("MANAGE")); ?></b></span></dt>
			<dd>
				<ul class="aul_1">
					<?php if(isset($_SL) and is_array($_SL)) : foreach($_SL as $s) : ?><li>
						<img class="mi mi_16" src="/tpl/default/admin/img/mi_16/<?php echo($s['shortcut_icon']); ?>.png" /> <a href="<?php echo($s['shortcut_url']); ?>"><?php echo($s['shortcut_title']); ?></a>
					</li><?php endforeach; endif; ?>
				<div class="clear"></div></ul>
			</dd>
		</dl>
		<div style="height:10px;clear:both; overflow:hidden"></div>
		<table width="100%">
		<tr>
			<td width="70%" valign="top">
				<dl class="adl">
					<dt><strong><?php echo(L("LATEST_ARCHIVE")); ?></strong></dt>
					<dd>
						<ul class="aul"><?php if(isset($_LAL) and is_array($_LAL)) : foreach($_LAL as $a) : ?>
							<li>
								<a href="<?php echo(Url::U("archive/edit_archive?archive_id={$a['archive_id']}")); ?>"><?php echo(AString::msubstr($a['a_title'], 0, 36, 1)); ?></a><?php if(0==$a['a_status']) :  ?> <b class="fc_gry fw_n status fs_11 p_0_2">(<?php echo(L("NOT_PASSED")); ?>)</b><?php endif; ?><?php if(2==$a['a_status']) :  ?> <b class="fc_r fw_n status fs_11 p_0_2">(<?php echo(L("REFUNDED")); ?>)</b><?php endif; ?>
								<span><a target="_blank" class="fc_gry" href="<?php echo(Url::U("home@archive/show_archive?archive_id={$a['archive_id']}")); ?>"><?php echo(L("PREVIEW")); ?></a></span>
							</li>
						<?php endforeach; endif; ?></ul>
					</dd>
				</dl>
			</td>
			<td width="10"></td>
			<td valign="top">
				<dl class="adl">
					<dt><strong><?php echo(L("SITE_STAT")); ?></strong></dt>
					<dd>
						<ul class="aul">
							<li>
								<a href="<?php echo(Url::U("member/list_member")); ?>"><?php echo(L("MEMBER")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['member']['all']); ?></b>
								<?php if(0<$_CS['member']['not_passed']) :  ?>| <b class="fc_r"><?php echo($_CS['member']['not_passed']); ?> <?php echo(L("NOT_PASSED")); ?></b><?php endif; ?></span>
							</li>
							<li>
								<a href="<?php echo(Url::U("archive/list_archive")); ?>"><?php echo(L("ARCHIVE")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['archive']['all']); ?></b>
								<?php if(0<$_CS['archive']['not_passed']) :  ?>| <b class="fc_r"><?php echo($_CS['archive']['not_passed']); ?> <?php echo(L("NOT_PASSED")); ?></b><?php endif; ?></span>
							</li>
							<li>
								<a href="<?php echo(Url::U("archive_review/list_review")); ?>"><?php echo(L("REVIEW")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['archive_review']['all']); ?></b>
								<?php if(0<$_CS['archive_review']['not_passed']) :  ?>| <b class="fc_r"><?php echo($_CS['archive_review']['not_passed']); ?> <?php echo(L("NOT_PASSED")); ?></b><?php endif; ?></span>
							</li>
							<li>
								<a href="<?php echo(Url::U("report/list_report")); ?>"><?php echo(L("REPORT")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['report']['all']); ?></b>
								<?php if(0<$_CS['report']['not_deal']) :  ?>| <b class="fc_r"><?php echo($_CS['report']['not_deal']); ?> <?php echo(L("NOT_DEAL")); ?></b><?php endif; ?></span>
							</li>
							<?php if(0<$_CS['single_page']['all']) :  ?><li>
								<a href="<?php echo(Url::U("single_page/list_single_page")); ?>"><?php echo(L("SINGLE_PAGE")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['single_page']['all']); ?></b></span>
							</li><?php endif; ?>
							<?php if(0<$_CS['flink']['all']) :  ?><li>
								<a href="<?php echo(Url::U("flink/list_flink")); ?>"><?php echo(L("FLINK")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['flink']['all']); ?></b>
								<?php if(0<$_CS['flink']['not_passed']) :  ?>| <b class="fc_r"><?php echo($_CS['flink']['not_passed']); ?> <?php echo(L("NOT_PASSED")); ?></b><?php endif; ?></span>
							</li><?php endif; ?>
							<?php if(0<$_CS['guestbook']['all']) :  ?><li>
								<a href="<?php echo(Url::U("guestbook/list_guestbook")); ?>"><?php echo(L("GUESTBOOK")); ?>:</a>
								<span class="fc_gry"><b class="fc_g"><?php echo($_CS['guestbook']['all']); ?></b>
								<?php if(0<$_CS['guestbook']['not_passed']) :  ?>| <b class="fc_r"><?php echo($_CS['guestbook']['not_passed']); ?> <?php echo(L("NOT_PASSED")); ?></b><?php endif; ?></span>
							</li><?php endif; ?>
							<div class="clear"></div>
						</ul>
					</dd>
				</dl>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<div id="form_add_shortcut" style="display:none">
<form id="formAdd" action="<?php echo(Url::U("index/add_shortcut_do")); ?>" method="post">
	<table class="formTable">
		<tr>
			<td class="inputArea"><strong><?php echo(L("TITLE")); ?></strong></td>
			<td class="inputArea" width="10"></td>
			<td class="inputArea">
				<input class="required i" type="text" value="" name="shortcut_title" maxlength="96" size="10"><span class="fc_gry"><span class="fc_r">*</span> <?php echo(L("SHORTCUT_TITLE_TIP")); ?></span>
			</td>
		</tr>
		<tr>
			<td><strong><?php echo(L("ICON")); ?></strong></td>
			<td></td>
			<td>
				<input class="i" type="text" value="" name="shortcut_icon" maxlength="255" size="20">
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry"><?php echo(L("SHORTCUT_ICON_TIP")); ?></span></td>
		</tr>
		<tr>
			<td class="inputArea"><strong><?php echo(L("URL")); ?></strong></td>
			<td class="inputArea"></td>
			<td class="inputArea">
				<input class="required i" type="text" value="" name="shortcut_url" maxlength="255" size="50">
				<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
				<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
			</td>
		</tr>
	</table>
</form>
</div>
<div id="form_manage_shortcut" style="display:none">
<form id="formManage" action="<?php echo(Url::U("index/manage_shortcut_do")); ?>" method="post">
	<table class="formTable">
		<tr>
			<td class="inputTip"><?php echo(L("MANAGE_SHORTCUT_TIP")); ?></td>
		</tr>
		<tr>
			<td class="inputArea">
				<textarea class="i" name="shortcut_set" style="width:480px;height:240px;"><?php echo($_SS); ?></textarea>
				<input name="timeKey" type="hidden" value="<?php echo($_TK['timeKey']); ?>">
				<input name="token" type="hidden" value="<?php echo($_TK['token']); ?>">
			</td>
		</tr>
	</table>
</form>

</div>
<script src="<?php echo(__PUBLIC__); ?>js/jquery.js"></script>
<script src="<?php echo(__PUBLIC__); ?>js/dialog/artdialog.js"></script>
<script src="/tpl/default/admin/js/c.js"></script>
<script>
function check_new_version() {
	$('#check_result').html('<?php echo(L("CHECKING")); ?>');
	$.getJSON('<?php echo(Url::U("index/check_new_version")); ?>'+'&'+Math.random(), function(result) {
		if(0 == result.data) {
			$('#check_result').html('<?php echo(L("CHECK_FAILED")); ?>');
		}
		else {
			var newVersion = result.info;
			$('#check_result').html('');
			dialog({
				title:'<?php echo(L("NEW_VERSION")); ?>',
				content:'<a href="<?php echo(SOFT_AUTHOR_URL); ?>" target="_blank"><?php echo(L("NEW_VERSION")); ?>: ' + newVersion + '</a>',
				padding:'10px 5px',
				id:'OM'
			}).showModal();
		}
	});
}

/* shortcut manage */
$('#add_shortcut').bind('click', function() {
	dialog({
		title:'<?php echo(L("ADD_SHORTCUT")); ?>',
		content:document.getElementById('form_add_shortcut'),
		id:'FAS',
		button:[{
				value:'<?php echo(L("OK")); ?>',
				callback:function() {
					$('#formAdd').submit();
					return false;
				}
			}, {
				value:'<?php echo(L("CANCEL")); ?>'
			}
		]
	}).showModal();
});
$('#manage_shortcut').bind('click', function() {
	dialog({
		title:'<?php echo(L("MANAGE_SHORTCUT")); ?>',
		content:document.getElementById('form_manage_shortcut'),
		id:'FMS',
		button:[ {
				value:'<?php echo(L("OK")); ?>',
				callback : function() {
					$('#formManage').submit();
					return false;
				}
			}, {
				value:'<?php echo(L("CANCEL")); ?>'
			}
		]
	}).showModal();
});
</script>
</body>
</html>
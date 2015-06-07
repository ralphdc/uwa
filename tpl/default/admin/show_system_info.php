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
<table width="100%">
<tr>
	<td width="40%" valign="top">
		<dl class="abox">
			<dt><strong>{-:@WELCOME-}</strong></dt>
			<dd>
				<div class="mainTips" style="text-indent:2em">
					{-:@UWA_WELCOME|soft_name~*SOFT_NAME-}
					{-if:!empty($_SST)-}
					<h3 class=" fc_r">{-:@SITE_SAFE_TIP-}</h3>
					<ol class="ol fc_r">{-foreach:$_SST,$sst-}
						<li>{-:$sst-}</li>
					{-:/foreach-}</ol>
					{-:/if-}
				</div>
			</dd>
		</dl><!--/.abox-->
		<dl class="abox">
			<dt><strong>{-:@LATEST_ADMIN_LOG-}</strong><span><a href="{-url:admin_log/list_log-}">{-:@MORE-}</a></span></dt>
			<dd>
				<table class="listTable">
					<tr>
						<th scope="col">{-:@ADMIN-}</th>
						<th scope="col">{-:@OPERATION-}</th>
						<th scope="col" width="40">{-:@STATUS-}</th>
						<th scope="col">{-:@TIME-}</th>
						<th scope="col">{-:@IP-}</th>
					</tr>
					{-foreach:$_LMLL,$al-}
					<tr>
						<td>{-:$al['m_userid']-}</td>
						<td>{-:$al['al_operation']|AString::msubstr~@me,0,7-}</td>
						<td>
						{-if:1 == $al['al_status']-}
							<span class="bg_wht br_g br_3 p_0_2 fc_g fw_b fs_11">{-:@SUCCESS-}</span>
						{-else:-}
							<span class="bg_wht br_r br_3 p_0_2 fc_r fw_b fs_11">{-:@FAILED-}</span>
						{-:/if-}
						</td>
						<td>{-:$al['al_time']|date~'m-d',@me-}</td>
						<td>{-:$al['al_ip']-}</td>
					</tr>
					{-:/foreach-}
				</table>
			</dd>
		</dl><!--/.abox-->
		<dl class="atab">
			<dt><strong>{-:@SOFT_INFO-}</strong><strong>{-:@SYSTEM_EVN-}</strong>{-if:!empty($LICENCE)-}<strong>{-:@AUTHORIZED-}</strong>{-:/if-}</dt>
			<dd>
				<div class="tabCntnt">
					<ul>
						<li>{-:@SOFT_NAME-}: <span class="status p_0_2">{-:*SOFT_NAME-}</span></li>
						<li>{-:@SOFT_VERSION-}: <span class="status p_0_2">{-:*SOFT_VERSION-}</span> <span class="btn_l" onClick="check_new_version();">{-:@CHECK_NEW_VERSION-}</span> <span id="check_result"></span></li>
						<li>{-:@SOFT_CODENAME-}: <span class="status p_0_2">{-:*SOFT_CODENAME-}</span></li>
						<li>{-:@SOFT_CHARSET-}: <span class="status p_0_2">{-:*SOFT_CHARSET-}</span></li>
						<li>{-:@SOFT_AUTHOR-}: <a target="_blank" href="{-:*SOFT_AUTHOR_URL-}"><span class="status p_0_2">{-:*SOFT_AUTHOR-}</span></a></li>
					</ul>
				</div><!--/.tabCntnt-->
				<div class="tabCntnt">
					<ul>
						<li>
							{-:@OS-}: <span class="status p_0_2">{-:$_SE['os']-}</span>
							{-:@SERVER_SOFTWARE-}: <span class="status p_0_2">{-:$_SE['server_software']-}</span>
						</li>
						<li>
							{-:@PHP_VERSION-}: <span class="status p_0_2">{-:$_SE['php_version']-}</span>
							{-:@GD_VERSION-}: <span class="status p_0_2">{-:$_SE['gd_version']-}</span>
						</li>
						<li>
							{-:@MYSQL_VERSION-}: <span class="status p_0_2">{-:$_SE['mysql_version']-}</span>
							{-:@UPLOAD_MAX_SIZE-}: <span class="status p_0_2">{-:$_SE['upload_max_size']-}</span>
						</li>
						<li>
							{-:@SAFE_MODE-}: <span class="status p_0_2">{-:$_SE['safe_mode']-}</span>
						</li>
						<li>
							{-:@REGISTER_GLOBALS-}: <span class="status p_0_2">{-:$_SE['register_globals']-}</span>
						</li>
						<li>
							{-:@MAGIC_QUOTES_GPC-}: <span class="status p_0_2">{-:$_SE['magic_quoter_gpc']-}</span>
						</li>
						<li>
							{-:@ALLOW_URL_FOPEN-}: <span class="status p_0_2">{-:$_SE['allow_url_fopen']-}</span>
						</li>
					</ul>
				</div><!--/.tabCntnt-->
					{-if:!empty($LICENCE)-}
				<div class="tabCntnt">
					<ul>
						<li><span class="fw_b fs_14"></span></li>
						<li>{-:@LICENCE_DOMAIN-}: <span class="status p_0_2">{-:$LICENCE['domain']-}</span></li>
						<li>{-:@LICENCE_KEY-}: <span class="status p_0_2 fs_11">{-:$LICENCE['key']-}</span></li>
					</ul>
					<div style="height:10px;clear:both;overflow:hidden"></div>
					<div>{-:@AUTHORIZED_TIP|url~*SOFT_AUTHORIZATION_URL-}</div>
				</div><!--/.tabCntnt-->
				{-:/if-}
			</dd>
		</dl><!--/.atab-->
	</td>
	<td width="10"></td>
	<td valign="top">
		<dl class="adl">
			<dt><strong>{-:@SHORTCUT-}</strong> <span><b class="a" id="add_shortcut">{-:@ADD-}</b> | <b class="a" id="manage_shortcut">{-:@MANAGE-}</b></span></dt>
			<dd>
				<ul class="aul_1">
					{-foreach:$_SL,$s-}<li>
						<img class="mi mi_16" src="{-:*__THEME__-}admin/img/mi_16/{-:$s['shortcut_icon']-}.png" /> <a href="{-:$s['shortcut_url']-}">{-:$s['shortcut_title']-}</a>
					</li>{-:/foreach-}
				<div class="clear"></div></ul>
			</dd>
		</dl>
		<div style="height:10px;clear:both; overflow:hidden"></div>
		<table width="100%">
		<tr>
			<td width="70%" valign="top">
				<dl class="adl">
					<dt><strong>{-:@LATEST_ARCHIVE-}</strong></dt>
					<dd>
						<ul class="aul">{-foreach:$_LAL,$a-}
							<li>
								<a href="{-url:archive/edit_archive?archive_id={$a['archive_id']}-}">{-:$a['a_title']|AString::msubstr~@me,0,36,1-}</a>{-if:0==$a['a_status']-} <b class="fc_gry fw_n status fs_11 p_0_2">({-:@NOT_PASSED-})</b>{-:/if-}{-if:2==$a['a_status']-} <b class="fc_r fw_n status fs_11 p_0_2">({-:@REFUNDED-})</b>{-:/if-}
								<span><a target="_blank" class="fc_gry" href="{-url:home@archive/show_archive?archive_id={$a['archive_id']}-}">{-:@PREVIEW-}</a></span>
							</li>
						{-:/foreach-}</ul>
					</dd>
				</dl>
			</td>
			<td width="10"></td>
			<td valign="top">
				<dl class="adl">
					<dt><strong>{-:@SITE_STAT-}</strong></dt>
					<dd>
						<ul class="aul">
							<li>
								<a href="{-url:member/list_member-}">{-:@MEMBER-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['member']['all']-}</b>
								{-if:0<$_CS['member']['not_passed']-}| <b class="fc_r">{-:$_CS['member']['not_passed']-} {-:@NOT_PASSED-}</b>{-:/if-}</span>
							</li>
							<li>
								<a href="{-url:archive/list_archive-}">{-:@ARCHIVE-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['archive']['all']-}</b>
								{-if:0<$_CS['archive']['not_passed']-}| <b class="fc_r">{-:$_CS['archive']['not_passed']-} {-:@NOT_PASSED-}</b>{-:/if-}</span>
							</li>
							<li>
								<a href="{-url:archive_review/list_review-}">{-:@REVIEW-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['archive_review']['all']-}</b>
								{-if:0<$_CS['archive_review']['not_passed']-}| <b class="fc_r">{-:$_CS['archive_review']['not_passed']-} {-:@NOT_PASSED-}</b>{-:/if-}</span>
							</li>
							<li>
								<a href="{-url:report/list_report-}">{-:@REPORT-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['report']['all']-}</b>
								{-if:0<$_CS['report']['not_deal']-}| <b class="fc_r">{-:$_CS['report']['not_deal']-} {-:@NOT_DEAL-}</b>{-:/if-}</span>
							</li>
							{-if:0<$_CS['single_page']['all']-}<li>
								<a href="{-url:single_page/list_single_page-}">{-:@SINGLE_PAGE-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['single_page']['all']-}</b></span>
							</li>{-:/if-}
							{-if:0<$_CS['flink']['all']-}<li>
								<a href="{-url:flink/list_flink-}">{-:@FLINK-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['flink']['all']-}</b>
								{-if:0<$_CS['flink']['not_passed']-}| <b class="fc_r">{-:$_CS['flink']['not_passed']-} {-:@NOT_PASSED-}</b>{-:/if-}</span>
							</li>{-:/if-}
							{-if:0<$_CS['guestbook']['all']-}<li>
								<a href="{-url:guestbook/list_guestbook-}">{-:@GUESTBOOK-}:</a>
								<span class="fc_gry"><b class="fc_g">{-:$_CS['guestbook']['all']-}</b>
								{-if:0<$_CS['guestbook']['not_passed']-}| <b class="fc_r">{-:$_CS['guestbook']['not_passed']-} {-:@NOT_PASSED-}</b>{-:/if-}</span>
							</li>{-:/if-}
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
<form id="formAdd" action="{-url:index/add_shortcut_do-}" method="post">
	<table class="formTable">
		<tr>
			<td class="inputArea"><strong>{-:@TITLE-}</strong></td>
			<td class="inputArea" width="10"></td>
			<td class="inputArea">
				<input class="required i" type="text" value="" name="shortcut_title" maxlength="96" size="10"><span class="fc_gry"><span class="fc_r">*</span> {-:@SHORTCUT_TITLE_TIP-}</span>
			</td>
		</tr>
		<tr>
			<td><strong>{-:@ICON-}</strong></td>
			<td></td>
			<td>
				<input class="i" type="text" value="" name="shortcut_icon" maxlength="255" size="20">
			</td>
		</tr>
		<tr>
			<td class="inputArea"></td>
			<td class="inputArea"></td>
			<td class="inputArea"><span class="fc_gry">{-:@SHORTCUT_ICON_TIP-}</span></td>
		</tr>
		<tr>
			<td class="inputArea"><strong>{-:@URL-}</strong></td>
			<td class="inputArea"></td>
			<td class="inputArea">
				<input class="required i" type="text" value="" name="shortcut_url" maxlength="255" size="50">
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
			</td>
		</tr>
	</table>
</form>
</div>
<div id="form_manage_shortcut" style="display:none">
<form id="formManage" action="{-url:index/manage_shortcut_do-}" method="post">
	<table class="formTable">
		<tr>
			<td class="inputTip">{-:@MANAGE_SHORTCUT_TIP-}</td>
		</tr>
		<tr>
			<td class="inputArea">
				<textarea class="i" name="shortcut_set" style="width:480px;height:240px;">{-:$_SS-}</textarea>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
			</td>
		</tr>
	</table>
</form>

</div>
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script>
function check_new_version() {
	$('#check_result').html('{-:@CHECKING-}');
	$.getJSON('{-url:index/check_new_version-}'+'&'+Math.random(), function(result) {
		if(0 == result.data) {
			$('#check_result').html('{-:@CHECK_FAILED-}');
		}
		else {
			var newVersion = result.info;
			$('#check_result').html('');
			dialog({
				title:'{-:@NEW_VERSION-}',
				content:'<a href="{-:*SOFT_AUTHOR_URL-}" target="_blank">{-:@NEW_VERSION-}: ' + newVersion + '</a>',
				padding:'10px 5px',
				id:'OM'
			}).showModal();
		}
	});
}

/* shortcut manage */
$('#add_shortcut').bind('click', function() {
	dialog({
		title:'{-:@ADD_SHORTCUT-}',
		content:document.getElementById('form_add_shortcut'),
		id:'FAS',
		button:[{
				value:'{-:@OK-}',
				callback:function() {
					$('#formAdd').submit();
					return false;
				}
			}, {
				value:'{-:@CANCEL-}'
			}
		]
	}).showModal();
});
$('#manage_shortcut').bind('click', function() {
	dialog({
		title:'{-:@MANAGE_SHORTCUT-}',
		content:document.getElementById('form_manage_shortcut'),
		id:'FMS',
		button:[ {
				value:'{-:@OK-}',
				callback : function() {
					$('#formManage').submit();
					return false;
				}
			}, {
				value:'{-:@CANCEL-}'
			}
		]
	}).showModal();
});
</script>
</body>
</html>
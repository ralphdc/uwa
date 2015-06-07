<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/calendar/calendar.css" />
<script src="{-:*__PUBLIC__-}js/calendar/calendar.js"></script>
<script src="{-:*__PUBLIC__-}js/calendar/lang/{-:+lang-}.js"></script>
</head>
<body>
{-if:!empty($nextUrl)-}<div class="mainTips">
	<span class="fw_b fc_r">{-:@LAST_TASK-}</span> <a class="fc_g td_u" href="{-:$nextUrl-}">{-:$nextUrl|substr~@me,0,20-} ... {-:$nextUrl|substr~@me,-30-} {-:@_GO_NEXT_-}</a>
</div>{-:/if-}
<dl class="atab">
	<dt><strong>{-:@BUILD_GUIDE-}</strong><strong>{-:@BUILD_CHANNEL-}</strong><strong>{-:@BUILD_ARCHIVE-}</strong></dt>
	<dd>
		<div class="tabCntnt"><!--BUILD_GUIDE-->
	<form id="formBuildAll" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="20%"></th>
					<th scope="col">{-:@BUILD-}</th>
				</tr>
				<tr>
					<td align="right">{-:@PAGE_SIZE-}</td>
					<td><input name="page_size" class="i" type="text" value="20" size="5" /></td>
				</tr>
				<tr>
					<td align="right">{-:@BUILD_INDEX-}</td>
					<td><span class="btn_b submit" action="{-url:build/build_index_do-}" to="#formBuildAll">{-:@BUILD-}</span></td>
				</tr>
				<tr>
					<td align="right">{-:@BUILD_ALL-}</td>
					<td><span class="btn_b submit" action="{-url:build/build_all_do-}" to="#formBuildAll">{-:@BUILD-}</span> <span class="fc_gry">{-:@BUILD_ALL_TIP-}</span></td>
				</tr>
			</table>
	</form>
		</div>
		<div class="tabCntnt"><!--BUILD_CHANNEL-->
	<form id="formBuildChannel" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="20%"></th>
					<th scope="col">{-:@BUILD-}</th>
				</tr>
				<tr>
					<td align="right">{-:@CHANNEL-}</td>
					<td><select name="archive_channel_id">
						<option value="0">{-:@ALL-}</option>
						{-:$_ACLStr-}
					</select></td>
				</tr>
				<tr>
					<td align="right">{-:@ACTION-}</td>
					<td>
						<select name="action">
							<option value="build_url" selected="selected">{-:@BUILD_URL-}</option>
							<option value="build_html">{-:@BUILD_HTML-}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">{-:@PAGE_SIZE-}</td>
					<td><input name="page_size" class="i" type="text" value="20" size="5" /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span class="btn_b submit" action="{-url:build/build_channel_do-}" to="#formBuildChannel">{-:@BUILD-}</span>
						<input class="btn_l" type="reset" value="{-:@RESET-}" />
					</td>
				</tr>
			</table>
	</form>
		</div>
		<div class="tabCntnt"><!--BUILD_ARCHIVE-->
	<form id="formBuildArchive" action="" method="post">
			<table class="listTable">
				<tr>
					<th scope="col" width="20%"></th>
					<th scope="col">{-:@BUILD-}</th>
				</tr>
				<tr>
					<td align="right">{-:@CHANNEL-}</td>
					<td><select name="archive_channel_id">
						<option value="0">{-:@ALL-}</option>
						{-:$_ACLStr-}
					</select></td>
				</tr>
				<tr>
					<td align="right">{-:@ACTION-}</td>
					<td>
						<select name="action">
							<option value="build_url" selected="selected">{-:@BUILD_URL-}</option>
							<option value="build_html">{-:@BUILD_HTML-}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">{-:@PAGE_SIZE-}</td>
					<td><input name="page_size" class="i" type="text" value="20" size="5" /></td>
				</tr>
				<tr>
					<td align="right">{-:@DATE-}</td>
					<td>
					<input id="start_time" name="start_time" class="i calendar" type="text" value="" size="20">
					{-:@TO-} <input id="end_time" name="end_time" class="i calendar" type="text" value="" size="20">
					</td>
				</tr>
				<tr>
					<td align="right">{-:@ID-}</td>
					<td>
						<input name="start_id" class="i" type="text" value="" size="8" /> {-:@TO-} <input name="end_id" class="i" type="text" value="" size="8" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<span class="btn_b submit" action="{-url:build/build_archive_do-}" to="#formBuildArchive">{-:@BUILD-}</span>
						<input class="btn_l" type="reset" value="{-:@RESET-}" />
					</td>
				</tr>
			</table>
	</form>
		</div>
	</dd>
</dl><!--/.abox-->
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/cal.js"></script>
</body>
</html>
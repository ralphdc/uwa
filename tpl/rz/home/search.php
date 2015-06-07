<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@SEARCH-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="m w_500 adiv">
	<form id="search" action="{-url:home@search/search_do-}" method="post">
	<table class="p_20">
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@CHANNEL-}</td>
			<td>
				<select name="archive_channel_id">
					<option value="0">{-:@NOT_LIMIT-}</option>
					{-:$_ACLStr-}
				</select>
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@KEYWORDS-}</td>
			<td>
				<input type="text" class="i required" name="keyword" size="30" />
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;"></td>
			<td>
				<uwa:tag_list row="10">
					<a class="p_2_5 fs_14 bg_gry_l br_3" href="{-:$item['t_url']-}" target="_blank">{-:$item['t_name']-}</a>
				</uwa:tag_list>
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@KEYWORD_TYPE-}</td>
			<td>
				<label><input type="radio" name="keyword_type" value="or" checked="checked"> {-:@OR-}</label>
				<label><input type="radio" name="keyword_type" value="and"> {-:@AND-}</label>
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@SEARCH_TYPE-}</td>
			<td>
				<select name="search_type">
					<option value="title">{-:@TITLE-}</option>
					<option value="content">{-:@CONTENT-}</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@PUBLISH_DATE-}</td>
			<td>
				<select name="publish_date">
					<option value="0">{-:@NOT_LIMIT-}</option>
					<option value="7">{-:@IN_A_WEEK-}</option>
					<option value="30">{-:@IN_A_MONTH-}</option>
					<option value="90">{-:@IN_THREE_MONTHS-}</option>
					<option value="365">{-:@IN_A_YEAR-}</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@DISPLAY_ORDER-}</td>
			<td>
				<select name="display_order">
					<option value="a_edit_time">{-:@PUBLISH_DATE-}</option>
					<option value="a_view_count">{-:@VIEW_COUNT-}</option>
					<option value="archive_id">{-:@ARCHIVE_ID-}</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="fw_b fc_b ta_r p_0_10" style="width:90px;">{-:@PAGE_SIZE-}</td>
			<td>
				<select name="page_size">
					<option value="10">10</option>
					<option value="20">20</option>
					<option value="50">50</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
				<input name="token" type="hidden" value="{-:$_TK['token']-}">
				<input type="submit" class="btn_b" value="{-:@SEARCH-}" />
			</td>
		</tr>
	</table>
	</form>
</div>
{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
$('#search input[name="keyword"]').focus();

document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
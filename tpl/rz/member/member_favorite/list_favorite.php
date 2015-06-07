<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:@FAVORITE-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_SITE['description']-}" />
</head>

<body>
{-include:../header-}
<div class="m w_960">
	<div class="w_190 f_l">
{-include:../sidebar_content-}
	</div><!--/.w_190-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_760 f_l">
		<form id="formSearch" action="" method="post">
		<div class="ta_r">
			<label>{-:@KEYWORDS-} <input class="i" type="text" size="10" maxlength="64" name="mf_title" value="{-php:echo ARequest::get('mf_title');-}"></label>
			<label><span class="btn_l submit" action="{-url:member_favorite/list_favorite-}" to="#formSearch">{-:@SEARCH-}</span></label>
		</div>
		</form>
		<div class="h_10 o_h"></div>
		<dl class="atab_1 adiv">
			<dt><strong class="on">{-:@FAVORITE_LIST-}</strong></dt>
			<dd class="p_10">
				<table class="listTable">
					<tr>
						<th scope="col">{-:@TITLE-}</th>
						<th scope="col">{-:@ADD_TIME-}</th>
						<th scope="col">{-:@MANAGE-}</th>
					</tr>
					{-foreach:$_MFL,$mf-}
					<tr>
						<td><a href="{-:$mf['mf_url']-}" target="_blank">{-:$mf['mf_title']-}</a></td>
						<td>{-:$mf['mf_add_time']|date~'Y-m-d',@me-}</td>
						<td><a href="{-url:member_favorite/delete_favorite_do?member_favorite_id={$mf['member_favorite_id']}&timeKey={$_TK['timeKey']}&token={$_TK['token']}-}" onclick="javascript:return delete_confirm();">{-:@DELETE-}</a></td>
					</tr>
					{-:/foreach-}
				</table>
				{-include:../clip/paging-}
			</dd>
		</dl>
	</div><!--/.w_760-->
	<div class="c"></div>
</div>
{-include:../footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>

document.write('<script src="{-url:common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}member/js/c.js"></script>
<script src="{-:*__THEME__-}member/js/m.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
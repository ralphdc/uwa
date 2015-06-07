<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_AMI['am_name']-} {-:@LIST-} - {-:$_SITE['name']-}</title>
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
		<dl class="atab_1 adiv">
			<dt><strong {-if:!ARequest::get('a_status')-}class="on"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}-}">{-:$_AMI['am_name']-} {-:@LIST-}</a></strong><strong {-if:'n'==ARequest::get('a_status')-}class="on"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}&a_status=n-}">{-:@NOT_PASSED-}</a></strong><strong {-if:'p'==ARequest::get('a_status')-}class="on"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}&a_status=p-}">{-:@PASSED-}</a></strong><strong {-if:'r'==ARequest::get('a_status')-}class="on"{-:/if-}><a href="{-url:archive/list_archive?archive_model_id={$_AMI['archive_model_id']}&a_status=r-}">{-:@REFUNDED-}</a></strong></dt>
			<dd class="p_10">
				<table class="listTable">
					<tr>
						<th scope="col">{-:@TITLE-}</th>
						<th scope="col">{-:@CHANNEL-}</th>
						<th scope="col">{-:@AUTHOR-}</th>
						<th scope="col">{-:@EDIT_TIME-}</th>
						<th scope="col">{-:@VIEW_COUNT-}</th>
						<th scope="col">{-:@STATUS-}</th>
						<th scope="col">{-:@MANAGE-}</th>
					</tr>
					{-foreach:$_AL,$a-}
					<tr>
						<td>
							{-:$a['a_title']|AString::utf8_substr~@me,36,1-}
						</td>
						<td>
							<a target="_blank" href="{-:$a['ac_url']-}">{-:$a['ac_name']-}</a>
						</td>
						<td>
							{-:$a['a_a_author']-}
						</td>
						<td>
							{-:$a['a_edit_time']|date~'Y-m-d',@me-}
						</td>
						<td>
							{-:$a['a_view_count']-}
						</td>
						<td>
							{-if:0 == $a['a_status']-}<span class="fc_gry">{-:@NOT_PASSED-}</span>
							{-elseif:1 == $a['a_status']-}<span class="fc_g">{-:@PASSED-}</span>
							{-elseif:2 == $a['a_status']-}<span class="fc_r">{-:@REFUNDED-}</span>{-:/if-}
						</td>
						<td><a target="_blank" href="{-url:home@archive/show_archive?archive_id={$a['archive_id']}-}">{-:@PREVIEW-}</a> | <a href="{-url:archive/edit_archive?archive_id={$a['archive_id']}-}">{-:@EDIT-}</a></td>
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
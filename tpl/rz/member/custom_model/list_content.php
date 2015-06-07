<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_CMI['cm_name']-} {-:@LIST-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}member/css/m.css" />
<meta name="keywords" content="{-:$_CMI['cm_keywords']-}" />
<meta name="description" content="{-:$_CMI['cm_description']-}" />
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
			<dt><strong {-if:!ARequest::get('status')-}class="on"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}-}">{-:$_CMI['cm_name']-} {-:@LIST-}</a></strong><strong {-if:'n'==ARequest::get('status')-}class="on"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&status=n-}">{-:@NOT_PASSED-}</a></strong><strong {-if:'p'==ARequest::get('status')-}class="on"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&status=p-}">{-:@PASSED-}</a></strong><strong {-if:'r'==ARequest::get('status')-}class="on"{-:/if-}><a href="{-url:custom_model/list_content?custom_model_id={$_CMI['custom_model_id']}&status=r-}">{-:@REFUNDED-}</a></strong></dt>
			<dd class="p_10">
				<table class="listTable">
					<tr>
						<th scope="col" width="50">{-:@ID-}</th>
						<th scope="col">{-:@DETAIL-}</th>
						<th scope="col">{-:@STATUS-}</th>
						<th scope="col">{-:@MANAGE-}</th>
					</tr>
					{-foreach:$_CMCL,$cmc-}
					<tr>
						<td>{-:$cmc['id']-}</td>
						<td>
							{-if:!empty($_CMI['cm_field'])-}<ul>
							{-foreach:$_CMI['cm_field'],$field,$params-}
								{-if:1==$params['f_is_list'] and !empty($cmc[$field])-}
								<li><strong>{-:$params['f_item_name']-}</strong>:
									{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload']-}
										<a href="{-:$cmc[$field]-}" target="_blank">{-:@IMAGE_ATTACHMENT-}</a>
									{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload']-}
										<a href="{-:$cmc[$field]-}" target="_blank">{-:@FILE_ATTACHMENT-}</a>
									{-else:-}
										{-:$cmc[$field]-}
									{-:/if-}
								</li>
								{-:/if-}
							{-:/foreach-}
							</ul>{-:/if-}
						</td>
						<td>
							{-if:0 == $cmc['status']-}<span class="fc_gry">{-:@NOT_PASSED-}</span>{-elseif:1 == $cmc['status']-}<span class="fc_g">{-:@PASSED-}</span>{-elseif:2 == $cmc['status']-}<span class="fc_r">{-:@REFUNDED-}</span>{-:/if-}
						</td>
						<td><a target="_blank" href="{-url:home@custom_model/show_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}">{-:@PREVIEW-}</a> | <a href="{-url:custom_model/edit_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}">{-:@EDIT-}</a></td>
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
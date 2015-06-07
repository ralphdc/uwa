<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>{-:$_V['cm_name']-} - {-:$_SITE['name']-}</title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}home/css/cm.css" />
<meta name="keywords" content="{-:$_V['cm_keywords']-},{-:$_SITE['keywords']-}" />
<meta name="description" content="{-:$_V['cm_description']-}" />
</head>

<body>
{-include:header-}
<div class="position m w_960"><span>{-:@POSITION-}</span>{-include:clip/current_position-}</div>
<div class="h_10 o_h"></div>
<div class="m w_960">
	<div class="w_650 f_l">
		<div>
			<uwa:ad id="2">
		</div>
		<div class="h_10 o_h"></div>
{-if:!empty($_V['msg_err'])-}
		<div class="msg_err">
			{-:$_V['msg_err']-}
		</div>
{-else:-}
		<div class="adiv p_10">{-:$_V['cm_content']-}</div>
	{-if:!empty($_FF)-}
		<div class="h_10 o_h"></div>
		<div class="adiv p_10">
		{-foreach:$_FF,$f,$fp-}
			<dl class="adl_h">
				<dt><strong>{-:$fp['name']-}</strong></dt>
				<dd>
			{-foreach:$fp['params'],$f-}
					<a class="p_2_5 {-if:$f['value'] == ARequest::get($f['field'])-} fc_wht bg_b fw_b{-else:-} a fc_b{-:/if-}" href="{-:$f['url']-}">{-:$f['name']-}</a>
			{-:/foreach-}
				</dd>
			</dl>
		{-:/foreach-}
		</div>
	{-:/if-}
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:$_V['cm_name']-}</strong></dt>
			<dd><ul class="aul_custom_model">
			{-foreach:$_L,$k,$item-}
				<li class="fs_14 lh_20">
					{-if:!empty($_V['cm_field'])-}<table>
						<tr>
							<td width="120" align="right"><span class="fw_b p_0_10">ID:</span></td>
							<td>{-:$item['id']-} <a href="{-url:custom_model/show_content?custom_model_id={$_V['custom_model_id']}&id={$item['id']}-}">{-:@VIEW_DETAIL-}</a></td>
						</tr>
					{-foreach:$_V['cm_field'],$field,$params-}
						{-if:1==$params['f_is_list'] and !empty($item[$field])-}
						<tr>
							<td align="right"><span class="fw_b p_0_10">{-:$params['f_item_name']-}:</span></td>
							<td>
							{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload']-}
								<a href="{-:$item[$field]-}" target="_blank">{-:@IMAGE_ATTACHMENT-}</a>
							{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload']-}
								<a href="{-:$item[$field]-}" target="_blank">{-:@FILE_ATTACHMENT-}</a>
							{-else:-}
								{-:$item[$field]-}
							{-:/if-}
							</td>
						</tr>
						{-:/if-}
					{-:/foreach-}
					</table>{-:/if-}
				</li>
			{-:/foreach-}
			</ul></dd>
		</dl>
		{-include:clip/paging-}
{-:/if-}
	</div><!--/.w_650-->
	<div class="w_10 h_10 o_h f_l">&nbsp;</div>
	<div class="w_300 f_l">
		<dl class="adl">
			<dt><strong>{-:@COMMEND-}</strong></dt>
			<dd><ul class="aul">
			<uwa:a_list flag="c" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
			</uwa:a_list>
			</ul></dd>
		</dl>
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:@PICTURE_NEWS-}</strong></dt>
			<dd><ul class="aul">
			<uwa:a_list flag="p" row="10">
			{-if:0==$k-}
				<li class="pic">
					<a class="fc_gry_d" href="{-:$item['a_url']-}">
					<img class="a" src="{-:$item['a_thumb']-}" alt="{-:$item['a_title']-}" />
					<span>{-:$item['a_title']-}</span>
					<p class="fc_gry fs_12">{-:$item['a_description']-}</p>
					</a>
				</li>
			{-else:-}
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
			{-:/if-}
			</uwa:a_list>
			</ul></dd>
		</dl>
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:@HOT-}</strong></dt>
			<dd><ul class="aul_hot">
			<uwa:a_list orderby="a_view_count" order="desc" row="10">
				<li><a class="fc_gry_d" href="{-:$item['a_url']-}">{-:$item['a_title']-}</a></li>
			</uwa:a_list>
			</ul></dd>
		</dl>
		<div class="h_10 o_h"></div>
		<div>
			<uwa:ad id="1">
		</div>
		<div class="h_10 o_h"></div>
	</div><!--/.w_300-->
	<div class="c"></div>
</div>
{-include:footer-}
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
<script>
document.write('<script src="{-url:member@common/get_member_info-}&refresh='+Math.random()+'.js"></sc'+'ript>');
document.write('<script src="{-url:home@common/task?task={$TASK}-}&refresh='+Math.random()+'.js"></sc'+'ript>');
</script>
<script src="{-:*__THEME__-}home/js/c.js"></script>
{-:$_SITE['stat_code']-}
</body>
</html>
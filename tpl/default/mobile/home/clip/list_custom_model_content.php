{-if:!empty($_V['msg_err'])-}
	<li>
		{-:$_V['msg_err']-}
	</li>
{-else:-}
	{-foreach:$_L,$k,$item-}
		<li>
			{-if:!empty($_V['cm_field'])-}<table class="table table-bordered table-condensed">
				<caption><strong>ID: {-:$item['id']-}</strong> <a class="float-right" href="{-url:custom_model/show_content?custom_model_id={$_V['custom_model_id']}&id={$item['id']}-}"><i class="icon icon-eye"></i> {-:@VIEW_DETAIL-}</a></caption>
			{-foreach:$_V['cm_field'],$field,$params-}
				{-if:1==$params['f_is_list']-}
				<tr>
					<td align="right">{-:$params['f_item_name']-}</td>
					<td>
					{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload'] and !empty($item[$field])-}
						<a href="{-:$item[$field]-}" target="_blank">{-:@IMAGE_ATTACHMENT-}</a>
					{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload'] and !empty($item[$field])-}
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
{-:/if-}

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>

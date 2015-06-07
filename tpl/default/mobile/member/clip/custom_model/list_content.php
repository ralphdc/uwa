
{-foreach:$_CMCL,$cmc-}
<tr>
	<td>
		{-if:!empty($_CMI['cm_field'])-}<ul class="list-unstyled">
			<li>
				<strong>{-:@ID-}</strong>: {-:$cmc['id']-}
				{-if:0 == $cmc['status']-}
					<span class="text-muted">{-:@NOT_PASSED-}</span>
				{-elseif:1 == $cmc['status']-}
					<span class="text-success">{-:@PASSED-}</span>
				{-elseif:2 == $cmc['status']-}
					<span class="text-danger">{-:@REFUNDED-}</span>
				{-:/if-}
			</li>
		{-foreach:$_CMI['cm_field'],$field,$params-}
			{-if:1==$params['f_is_list']-}
			<li><strong>{-:$params['f_item_name']-}</strong>:
				{-if:'img' == $params['f_type'] and 0 == $params['f_multi_upload'] and !empty($cmc[$field])-}
					<a href="{-:$cmc[$field]-}" target="_blank"><i class="icon icon-image"></i> {-:@IMAGE_ATTACHMENT-}</a>
				{-elseif:'addon' == $params['f_type'] and 0 == $params['f_multi_upload'] and !empty($cmc[$field])-}
					<a href="{-:$cmc[$field]-}" target="_blank"><i class="icon icon-paperclip"></i> {-:@FILE_ATTACHMENT-}</a>
				{-else:-}
					{-:$cmc[$field]-}
				{-:/if-}
			</li>
			{-:/if-}
		{-:/foreach-}
		</ul>{-:/if-}
	</td>
	<td>
		<div class="btn-group-vertical">
			<a class="btn btn-primary" target="_blank" href="{-url:home@custom_model/show_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}"><i class="icon icon-search-plus"></i> {-:@PREVIEW-}</a>
			<a class="btn btn-primary" href="{-url:custom_model/edit_content?custom_model_id={$_CMI['custom_model_id']}&id={$cmc['id']}-}"><i class="icon icon-edit"></i> {-:@EDIT-}</a>
		</div>
	</td>
</tr>
{-:/foreach-}

<!--next page-->
<script>
{-if:!empty($PAGING['nextPage']['url'])-}
$('#viewMore').attr('nextpage', '{-:$PAGING['nextPage']['url']-}');
{-else:-}
$('#viewMore').remove();
{-:/if-}
</script>


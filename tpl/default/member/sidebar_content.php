
		<dl class="adl">
			<dt><strong>{-:@ARCHIVE-}</strong></dt>
			<dd><ul class="aul_5">
			{-foreach:$_AML,$item-}
				<li><img class="ai ai_16" src="{-:*__THEME__-}member/img/ai_16/archive_type_{-:$item['am_alias']-}.png" /> <a href="{-url:archive/list_archive?archive_model_id={$item['archive_model_id']}-}">{-:$item['am_name']-}</a> <a href="{-url:archive/add_archive?archive_model_id={$item['archive_model_id']}-}" class="fc_gry">{-:@PUBLISH-}</a></li>
			{-:/foreach-}
			</ul></dd>
		</dl>
	{-if:!empty($_CML)-}
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:@OTHER_CONTENT-}</strong></dt>
			<dd><ul class="aul_5">
			{-foreach:$_CML,$item-}
				<li><img class="ai ai_16" src="{-:*__THEME__-}member/img/ai_16/model_type_default.png" /> <a href="{-url:custom_model/list_content?custom_model_id={$item['custom_model_id']}-}">{-:$item['cm_name']-}</a> <a href="{-url:custom_model/add_content?custom_model_id={$item['custom_model_id']}-}" class="fc_gry">{-:@PUBLISH-}</a></li>
			{-:/foreach-}
			</ul></dd>
		</dl>
	{-:/if-}
		<div class="h_10 o_h"></div>
		<dl class="adl">
			<dt><strong>{-:@RESOURCE-}</strong></dt>
			<dd><ul class="aul_5">
				<li><i class="ai ai_16 ai_16_favorite"></i> <a href="{-url:member_favorite/list_favorite-}">{-:@FAVORITE-}</a></li>
				<li><i class="ai ai_16 ai_16_upload"></i> <a href="{-url:upload/list_upload-}">{-:@UPLOAD-}</a></li>
			</ul></dd>
		</dl>


{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
$_fi['params']['f_thumb_type'] = in_array($_fi['params']['f_thumb_type'], array('no', 'yes', 'both')) ? $_fi['params']['f_thumb_type'] : 'no';
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
{-if:is_array($_fi['params']['f_default'])-}
	{-foreach:$_fi['params']['f_default'],$k,$_pfd-}<p>
		<input id="{-:$_fi['tag']-}_{-:$k-}" class="control-input" type="text" value="{-:$_pfd-}" name="{-:$_fi['tag'][$k]-}" maxlength="{-:$_fi['params']['f_length']-}" />
		<input id="{-:$_fi['tag']-}_{-:$k-}_uploader" to="#{-:$_fi['tag']-}_{-:$k-}" btntext="{-:@UPLOAD-}" class="uploader" typeset="image" thumb="{-:$_fi['params']['f_thumb_type']-}" type="file" />
	</p>{-:/foreach-}
{-else:-}
	{-if:1 == $_fi['params']['f_multi_upload']-}
		<textarea id="{-:$_fi['tag']-}" class="control-input" name="{-:$_fi['tag']-}" style="height:60px;">{-:$_fi['params']['f_default']-}</textarea>
		<input id="{-:$_fi['tag']-}_uploader" to="#{-:$_fi['tag']-}" multi_upload="yes" btntext="{-:@UPLOAD-}" class="uploader" typeset="image" thumb="{-:$_fi['params']['f_thumb_type']-}" type="file" />
	{-else:-}
		<input id="{-:$_fi['tag']-}" class="control-input" type="text" value="{-:$_fi['params']['f_default']-}" name="{-:$_fi['tag']-}" maxlength="{-:$_fi['params']['f_length']-}" />
		<input id="{-:$_fi['tag']-}_uploader" to="#{-:$_fi['tag']-}" btntext="{-:@UPLOAD-}" class="uploader" typeset="image" thumb="{-:$_fi['params']['f_thumb_type']-}" type="file" />
	{-:/if-}
{-:/if-}
</div>

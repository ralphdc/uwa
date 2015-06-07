{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = htmlspecialchars($_fi['data'][$_fi['tag']]);
}
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
	<label><input type="checkbox" value="{-:$_fi['tag']-}" name="delete_external_links[]"> {-:@DELETE_EXTERNAL_LINKS-}</label>
{-if:isset($_fi['params']['f_is_paging']) and (1 == $_fi['params']['f_is_paging'])-}
	<label class="text-muted">[{-:@UWA_PAGING_TIP-}]</label>
{-:/if-}
{-if:isset($_fi['params']['f_is_paging']) and (1 == $_fi['params']['f_is_paging'])-}
	<textarea class="control-input editor_paging" id="{-:$_fi['tag']-}" name="{-:$_fi['tag']-}" style="height:240px;">{-:$_fi['params']['f_default']-}</textarea>
{-else:-}
	<textarea class="control-input editor" id="{-:$_fi['tag']-}" name="{-:$_fi['tag']-}" style="height:240px;">{-:$_fi['params']['f_default']-}</textarea>
{-:/if-}
</div>

{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = htmlspecialchars($_fi['data'][$_fi['tag']]);
}
-}

<tr><td colspan="2" class="inputArea">
<div style="padding:0 0 5px">
<label><input type="checkbox" value="{-:$_fi['tag']-}" name="delete_external_links[]"> {-:@DELETE_EXTERNAL_LINKS-}</label>
{-if:isset($_fi['params']['f_is_paging']) and (1 == $_fi['params']['f_is_paging'])-}
	<label class="fc_gry">[{-:@UWA_PAGING_TIP-}]</label>
{-:/if-}
</div>
{-if:isset($_fi['params']['f_is_paging']) and (1 == $_fi['params']['f_is_paging'])-}
	<textarea class="editor_paging" id="{-:$_fi['tag']-}" name="{-:$_fi['tag']-}" style="width:95%;height:240px;">{-:$_fi['params']['f_default']-}</textarea>
{-else:-}
	<textarea class="editor" id="{-:$_fi['tag']-}" name="{-:$_fi['tag']-}" style="width:95%;height:240px;">{-:$_fi['params']['f_default']-}</textarea>
{-:/if-}
</td></tr>

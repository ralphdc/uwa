{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = htmlspecialchars($_fi['data'][$_fi['tag']]);
}
-}

<tr><td colspan="2" class="inputArea">
<div style="padding:0 0 5px">
{-if:1 == $_fi['params']['f_save_remote']-}
	<label><input type="checkbox" value="{-:$_fi['tag']-}" name="save_remote_source[]"> {-:@SAVE_REMOTE_SOURCE-}</label>
{-:/if-}
{-if:1 == $_fi['params']['f_watermark_remote']-}
	<label><input type="checkbox" value="{-:$_fi['tag']-}" name="watermark_remote_img[]"> {-:@WATERMARK_REMOTE_IMG-}</label>
{-:/if-}
{-if:1 == $_fi['params']['f_get_thumb']-}
	<label><input type="checkbox" value="{-:$_fi['tag']-}" name="first_img_as_thumb[]"> {-:@FIRST_IMG_AS_THUMB-}</label>
{-:/if-}
{-if:1 == $_fi['params']['f_get_abstract']-}
	<label><input type="checkbox" value="{-:$_fi['tag']-}" name="get_abstract[]"> {-:@GET_ABSTRACT-}</label>
{-:/if-}
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

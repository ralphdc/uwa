{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
-}

<tr><td colspan="2" class="inputTitle">{-:$_fi['params']['f_item_name']-}</td></tr>
<tr><td colspan="2" class="inputArea">
	<input id="{-:$_fi['tag']-}" type="hidden" value="{-:$_fi['params']['f_default']-}" name="{-:$_fi['tag']-}" />
	<span id="{-:$_fi['tag']-}_linkage_select" class="linkage" to="#{-:$_fi['tag']-}" l_alias="{-:$_fi['params']['f_linkage_alias']-}"></span>
</td></tr>


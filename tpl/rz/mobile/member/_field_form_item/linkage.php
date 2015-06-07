{-php:
if(!is_null($_fi['data']) and isset($_fi['data'][$_fi['tag']])) {
	$_fi['params']['f_default'] = $_fi['data'][$_fi['tag']];
}
-}

<div class="form-group">
	<label class="control-label">{-:$_fi['params']['f_item_name']-}</label>
	<input id="{-:$_fi['tag']-}" type="hidden" value="{-:$_fi['params']['f_default']-}" name="{-:$_fi['tag']-}" />
	<div id="{-:$_fi['tag']-}_linkage_select" class="linkage" to="#{-:$_fi['tag']-}" l_alias="{-:$_fi['params']['f_linkage_alias']-}"></div>
</div>

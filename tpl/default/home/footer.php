
<div id="footer">
	<div class="nav_footer m w_960">
		<uwa:menu alias="footer">
		<a href="{-:$m['url']-}" title="{-:$m['m_tip']-}" target="{-:$m['m_target']-}">{-:$m['m_name']-}</a>
		{-foreach:$m['m_sub_menu'],$ms-}
			<a href="{-:$ms['url']-}" title="{-:$ms['m_tip']-}" target="{-:$ms['m_target']-}">{-:$ms['m_name']-}</a>
		{-:/foreach-}
		</uwa:menu>
		{-if:$_SITE{'mobile_version'}-}<a href="{-url:home@common/toggle_ua?ua=mobile-}">{-:@MOBILE_VERSION-}</a>{-:/if-}
		<a target="_blank" href="{-:*SOFT_AUTHOR_URL-}"><span class="logo_tiny"></span></a>
	</div><!--/.nav_footer-->
	<div class="h_10 o_h"></div>
	<div class="m w_960">
		<div class="w_650 f_l ta_l copyright">
			{-:$_SITE['copyright']-}
		</div><!--/.w_650-->
		<div class="w_10 h_10 o_h f_l">&nbsp;</div>
		<div class="w_300 f_l ta_r prowered_by">
			Powered by <strong><a href="{-:*SOFT_AUTHOR_URL-}" target="_blank">{-:*SOFT_NAME-}</a></strong> {-:*SOFT_CODENAME-}
		</div><!--/.w_300-->
		<div class="c"></div>
	</div><!--/.copyright-->
</div><!--/#footer-->

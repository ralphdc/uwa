
<div id="footer" class="ta_c m w_960">
	<div class="nav_footer">
		<uwa:menu alias="footer">
		<a href="{-:$m['url']-}">{-:$m['m_name']-}</a>
		{-foreach:$m['m_sub_menu'],$ms-}
			<a href="{-:$ms['url']-}">{-:$ms['m_name']-}</a>
		{-:/foreach-}
		</uwa:menu>
		{-if:$_SITE{'mobile_version'}-}<a href="{-url:home@common/toggle_ua?ua=mobile-}">{-:@MOBILE_VERSION-}</a>{-:/if-}
		<span class="logo_tiny"></span>
	</div><!--/.nav_footer-->
	<div class="copyright m w_960">
		{-:$_SITE['copyright']-}
	</div><!--/.copyright-->
</div><!--/#footer-->


<div id="header">
	<div id="topbar" class="m w_960">
		<div id="uwa_member"></div><!--/#uwa_member-->
		<div id="nav_topbar">
			<span id="uwa_now_time" class="fc_gry"></span>
			<span><a href="{-:*__APP__-}">{-:@HOME-}</a></span>
		</div><!--/#nav_topbar-->
	</div>
	<div class="m w_960">
		<h1><a href="{-url:member/index-}"><img src="{-:*__THEME__-}member/img/logo.png" alt="{-:@MEMBER_CENTER-}" /></a></h1>
	</div>
	{-if:'login'!=ACTN_NAME and 'register'!=ACTN_NAME-}
	<div class="m w_960">
		<dl class="menu_1">
			<dt class="a{-if:in_array(ACTN_NAME, array('index','list_member_notify','edit_info_base','edit_info_addon'))-} on{-:/if-}"><a href="{-url:member/index-}">{-:@MEMBER_CENTER-}</a></dt>
			<dt class="a{-if:in_array(ACTN_NAME, array('credit_exchange','list_credit_order'))-} on{-:/if-}"><a href="{-url:member_credit/credit_exchange-}">{-:@CREDIT-}</a></dt>
			<dt class="a{-if:in_array(ACTN_NAME, array('list_archive','add_archive','edit_archive','list_content','add_content','edit_content','list_favorite','list_upload'))-} on{-:/if-}"><a href="{-url:member_favorite/list_favorite-}">{-:@CONTENT_CENTER\-}</a></dt>
		</dl><!--/.menu-->
	</div>
	{-:/if-}
</div><!--/#header-->

<div class="h_10 o_h"></div>


<object type="application/x-shockwave-flash" data="{-:*__PUBLIC__-}flash/slide.swf?xml=
	<data>
		<channel>
				{-foreach:$_ASI['ad'],$ad-}
			<item>
				<link>{-:$ad['a_link']|str_replace~'&','^',@me-}</link>
				<image>{-if:!empty($ad['a_file'])-}{-:$ad['a_file']-}{-else:-}{-:*__APP__-}u/site/no_thumb.png{-:/if-}</image>
				<title>{-:$ad['a_name']-}</title>
			</item>
				{-:/foreach-}
		</channel>
		<config>
			<roundCorner>5</roundCorner>
			<autoPlayTime>5</autoPlayTime>
			<isHeightQuality>false</isHeightQuality>
			<blendMode>normal</blendMode>
			<transDuration>1</transDuration>
			<windowOpen>_self</windowOpen>
			<btnSetMargin>auto 5 5 auto</btnSetMargin>
			<btnDistance>20</btnDistance>
			<titleBgColor>0x000000</titleBgColor>
			<titleTextColor>0xffffff</titleTextColor>
			<titleBgAlpha>0.2</titleBgAlpha>
			<titleMoveDuration>1</titleMoveDuration>
			<btnAlpha>.5</btnAlpha>
			<btnTextColor>0xffffff</btnTextColor>
			<btnDefaultColor>0x000000</btnDefaultColor>
			<btnHoverColor>0x0066ff</btnHoverColor>
			<btnFocusColor>0x0066ff</btnFocusColor>
			<changImageMode>hover</changImageMode>
			<isShowBtn>true</isShowBtn>
			<isShowTitle>false</isShowTitle>
			<scaleMode>noBorder</scaleMode>
			<transform>breatheBlur</transform>
			<isShowAbout>false</isShowAbout>
		</config>
	</data>"
	width="{-:$_ASI['as_width']-}" height="{-:$_ASI['as_height']-}" id="ad_slide_{-:$_ASI['ad_space_id']-}" wmode="transparent">
	<param name="wmode" value="transparent">
	<param name="movie" value="{-:*__PUBLIC__-}flash/slide.swf?xml=
	<data>
		<channel>
				{-foreach:$_ASI['ad'],$ad-}
			<item>
				<link>{-:$ad['a_link']|str_replace~'&','^',@me-}</link>
				<image>{-if:!empty($ad['a_file'])-}{-:$ad['a_file']-}{-else:-}{-:*__APP__-}u/site/no_thumb.png{-:/if-}</image>
				<title>{-:$ad['a_name']-}</title>
			</item>
				{-:/foreach-}
		</channel>
		<config>
			<roundCorner>5</roundCorner>
			<autoPlayTime>5</autoPlayTime>
			<isHeightQuality>false</isHeightQuality>
			<blendMode>normal</blendMode>
			<transDuration>1</transDuration>
			<windowOpen>_self</windowOpen>
			<btnSetMargin>auto 5 5 auto</btnSetMargin>
			<btnDistance>20</btnDistance>
			<titleBgColor>0x000000</titleBgColor>
			<titleTextColor>0xffffff</titleTextColor>
			<titleBgAlpha>0.2</titleBgAlpha>
			<titleMoveDuration>1</titleMoveDuration>
			<btnAlpha>.5</btnAlpha>
			<btnTextColor>0xffffff</btnTextColor>
			<btnDefaultColor>0x000000</btnDefaultColor>
			<btnHoverColor>0x0066ff</btnHoverColor>
			<btnFocusColor>0x0066ff</btnFocusColor>
			<changImageMode>hover</changImageMode>
			<isShowBtn>true</isShowBtn>
			<isShowTitle>false</isShowTitle>
			<scaleMode>noBorder</scaleMode>
			<transform>breatheBlur</transform>
			<isShowAbout>false</isShowAbout>
		</config>
	</data>" />
</object>

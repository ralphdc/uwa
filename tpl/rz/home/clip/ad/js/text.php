	{-foreach:$_ASI['ad'],$ad-}
document.write('<a href="{-:$ad['a_link']-}" title="{-:$ad['a_name']-}" target="_blank">{-:$ad['a_name']-}</a>');
	{-:/foreach-}
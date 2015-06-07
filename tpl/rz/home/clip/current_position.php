{-foreach:$_CP,$k,$cp-}
{-if:0==$k-}
	{-if:!empty($cp['url'])-}
		<a href="{-:$cp['url']-}">{-:$cp['name']-}</a>
	{-else:-}
		{-:$cp['name']-}
	{-:/if-}
{-else:-}
	{-if:!empty($cp['url'])-}
		 &raquo; <a href="{-:$cp['url']-}">{-:$cp['name']-}</a>
	{-else:-}
		 &raquo; {-:$cp['name']-}
	{-:/if-}
{-:/if-}
{-:/foreach-}
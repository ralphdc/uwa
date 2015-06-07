{-if:!empty($PAGING)-}
<div id="page_list">
<!--first page-->
{-if:!empty($PAGING['firstPage']['url'])-}
	<a href="{-:$PAGING['firstPage']['url']-}" class="firstPage">{-:@_FIRST_PAGE_-}</a>
{-else:-}
	<span class="firstPage">{-:@_FIRST_PAGE_-}</span>
{-:/if-}

<!--prev page-->
{-if:!empty($PAGING['prevPage']['url'])-}
	<a href="{-:$PAGING['prevPage']['url']-}" class="prevPage">{-:@_PREV_PAGE_-}</a>
{-else:-}
	<span class="prevPage">{-:@_PREV_PAGE_-}</span>
{-:/if-}

<!--near prev page-->
{-if:!empty($PAGING['nearPrevPage'])-}
	{-foreach:$PAGING['nearPrevPage'],$npp-}
		<a href="{-:$npp['url']-}" class="nearPage">{-:$npp['page']-}</a>
	{-:/foreach-}
{-:/if-}

<!--current page-->
{-if:!empty($PAGING['currentPage'])-}
	<span class="currentPage">{-:$PAGING['currentPage']['page']-}</span>
{-:/if-}

<!--near next page-->
{-if:!empty($PAGING['nearNextPage'])-}
	{-foreach:$PAGING['nearNextPage'],$nnp-}
		<a href="{-:$nnp['url']-}" class="nearPage">{-:$nnp['page']-}</a>
	{-:/foreach-}
{-:/if-}

<!--next page-->
{-if:!empty($PAGING['nextPage']['url'])-}
	<a href="{-:$PAGING['nextPage']['url']-}" class="nextPage">{-:@_NEXT_PAGE_-}</a>
{-else:-}
	<span class="nextPage">{-:@_NEXT_PAGE_-}</span>
{-:/if-}

<!--last page-->
{-if:!empty($PAGING['lastPage']['url'])-}
	<a href="{-:$PAGING['lastPage']['url']-}" class="lastPage">{-:@_LAST_PAGE_-}</a>
{-else:-}
	<span class="lastPage">{-:@_LAST_PAGE_-}</span>
{-:/if-}

<!--total info-->
<span class="total">{-:@_TOTAL_PAGES_-}:{-:$PAGING['totalPages']-} | {-:@_TOTAL_ROWS_-}:{-:$PAGING['totalRows']-}</span>
</div>
{-:/if-}
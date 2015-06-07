<table class="listTable">
	<tr>
		<th scope="col" width="30">{-:@ID-}</th>
		<th scope="col">{-:@FIELD_NAME-}</th>
		<th scope="col">{-:@FIELD_TYPE-}</th>
		<th scope="col">{-:@ALLOW_NULL-}</th>
		<th scope="col">{-:@DEFAULT-}</th>
		<th scope="col">{-:@PRIMARY_KEY-}</th>
		<th scope="col">{-:@AUTO_INCREMENT-}</th>
	</tr>
	{-php:$k = 0-}
	{-foreach:$_FL,$f-}
	<tr>
		{-php:$k+=1-}
		<td>{-:$k-}</td>
		<td>{-:$f['name']-}</td>
		<td>{-:$f['type']-}</td>
		<td>{-if:'YES' == $f['null']-}{-:@YES-}{-elseif:'NO' == $f['null']-}{-:@NO-}{-:/if-}</td>
		<td>{-:$f['default']-}</td>
		<td>{-if:1 == $f['primary']-}{-:@YES-}{-:/if-}</td>
		<td>{-if:1 == $f['autoinc']-}{-:@YES-}{-:/if-}</td>
	</tr>
	{-:/foreach-}
</table>
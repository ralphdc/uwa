<html>
<body>
<table border="1" align="center" cellspacing="1" cellpadding="1">
<tr align="center">
	<td nowrap><b>{-:@ID-}</b></td>
	<td nowrap><b>{-:@ADMIN-}</b></td>
	<td nowrap><b>{-:@OPERATION-}</b></td>
	<td nowrap><b>{-:@STATUS-}</b></td>
	<td nowrap><b>{-:@TIME-}</b></td>
	<td nowrap><b>{-:@IP-}</b></td>
</tr>
{-foreach:$_ALL,$al-}<tr align="center">
	<td nowrap>{-:$al['admin_log_id']-}</td>
	<td nowrap>{-:$al['m_userid']-}</td>
	<td nowrap>{-:$al['al_operation']-}</td>
	<td nowrap>{-if:1 == $al['al_status']-}{-:@SUCCESS-}{-else:-}{-:@FAILED-}{-:/if-}</td>
	<td nowrap>{-:$al['al_time']|date~C('APP.TIME_FORMAT'),@me-}</td>
	<td nowrap>{-:$al['al_ip']-}</td>
</tr>
{-:/foreach-}
</table>
</body>
</html>
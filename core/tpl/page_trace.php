<?php

/**
 *--------------------------------------
 * page trace
 *--------------------------------------
 * @project		: pfa
 * @author		: cblee
 * @created		: 2012-9-23
 * @copyright	: (c)2012 AsThis
 *--------------------------------------
 */

defined('PFA_PATH') or exit('Access Denied');
?>

<div id="pfa_page_trace" style="padding:10px;margin:10px;color:#666;line-height:18px;background:#fff;border:1px solid #e5e5e5;">
	<p style="padding:0;margin:0;border-bottom:1px solid #ccc;font-size:14px;color:#f60;"><?php echo L('_PAGE_TRACE_INFO_') ?></p>
	<p style="padding:0 margin:5px 0 0;overflow:auto;height:300px;text-align:left;font-size:12px;">
<?php foreach($_trace as $key=>$info){echo $key . ' : ' . $info . "<br />\r\n";}?>
	</p>
</div>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/c.css" />
<link rel="stylesheet" type="text/css" href="{-:*__THEME__-}admin/css/mf.css" />
<link rel="stylesheet" type="text/css" href="{-:*__PUBLIC__-}js/dialog/artdialog.css" />
<script src="{-:*__PUBLIC__-}js/jquery.js"></script>
</head>
<body>
<form id="formAdd" action="" method="post">
<dl class="abox">
	<dt><strong>{-:@ADD_PRODUCT-}</strong></dt>
	<dd>
		<table class="formTable">
			<tr>
				<td class="inputTitle">{-:@TITLE-}</td>
				<td></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="required i" type="text" value="" name="product_title" maxlength="96" size="30">
				</td>
				<td class="inputTip">
					<span class="fc_r">*</span> <span class="fc_gry">{-:@CT_TITLE_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@GROUP-}</td>
				<td class="inputTitle">{-:@DISPLAY_ORDER-}</td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="default" name="product_group" maxlength="32" size="16"> <span class="fc_gry">{-:@CT_GROUP_TIP-}</span>
				</td>
				<td class="inputArea">
					<input class="i" type="text" value="50" name="product_display_order" maxlength="10" size="4"> <span class="fc_gry">{-:@CT_DISPLAY_ORDER_TIP-}</span>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@PRODUCT_PARENT_CATEGORY-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
				    <select name="product_parent" id="product_parent">
				    {-foreach:$ps,$p-}
				        <option value="{-:$p['pcategory_id']-}">{-:$p['pcategory_title']-}</option>
				    {-:/foreach-}
				    </select>
				    <p>先选择一级分类，然后选择一级分类下面的二级分类。如没有分类，请先添加！</p>
				</td>
				<td class="inputTip">
					{-:@PRODUCT_PARENT_CATEGORY_TIP-}
				</td>
			</tr>
			<script type="text/javascript">
					$("#product_parent").change(function(){
						var pid = $(this).val();
						$.post("{-url:product/checkcategory-}",{'pid':pid},function(data){
							var res = eval("("+data+")");
							if(res.result){
								alert(res.message)
							}else{
								var result = res.message;
								html = '';
								for(var r in result){
									html += "<option value='"+result[r].ccategory_id+"'>"+result[r].ccategory_title+"</opiton>";
								}
								$('#product_child').html(html);
							}
						})
					})
			</script>
			<tr>
				<td class="inputTitle">{-:@PRODUCT_CHILD_CATEGORY-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
				    <select name="product_child" id="product_child">
				   
				    </select>
				</td>
				
				<td class="inputTip">
					{-:@PRODUCT_CHILD_CATEGORY_TIP-}
					
				</td>
			</tr>
				<td colspan="2" class="inputArea">
					<textarea class="editor" name="product_content" style="width:95%;height:240px;"></textarea>
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@KEYWORDS-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<input class="i" type="text" value="" name="product_keywords" maxlength="255" size="50">
				</td>
				<td class="inputTip">
					{-:@CT_KEYWORDS_TIP-}
				</td>
			</tr>
			<tr>
				<td class="inputTitle">{-:@DESCRIPTION-}</td>
				<td class=""></td>
			</tr>
			<tr>
				<td class="inputArea">
					<textarea class="i" name="product_description" style="width:360px;height:60px;"></textarea>
				</td>
				<td class="inputTip">
					{-:@CT_DESCRIPTION_TIP-}
				</td>
			</tr>
		</table>
	</dd>
</dl><!--/.abox-->
<div id="operation">
	<input name="timeKey" type="hidden" value="{-:$_TK['timeKey']-}">
	<input name="token" type="hidden" value="{-:$_TK['token']-}">
	<span class="btn_b submit" action="{-url:product/add_product_do-}" to="#formAdd">{-:@SUBMIT-}</span>
	<input class="btn_l" type="reset" value="{-:@RESET-}" />
	<a class="btn_l" href="{-url:product/list_product-}">{-:@BACK-}</a>
</div>
</form>

<script src="{-:*__PUBLIC__-}js/editor/ckeditor.js"></script>
<script src="{-:*__PUBLIC__-}js/dialog/artdialog.js"></script>
<script>
$(document).ready(function() {
	var editor_option = {
		filebrowserBrowseUrl : '{-url:finder/browse?typeset=all&type=product-}',
		filebrowserImageBrowseUrl : '{-url:finder/browse?typeset=image&type=product-}',
		filebrowserUploadUrl : '{-url:upload/upload_file?typeset=all&upload_type=product&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}',
		filebrowserImageUploadUrl : '{-url:upload/upload_file?typeset=image&upload_type=product&watermark=yes&return_type=editor&timeKey={$_TK["timeKey"]}&token={$_TK["token"]}-}'
	};
	$('.editor').each(function(){
		CKEDITOR.replace(this, editor_option);
	});
});
var url_choose_template_file = '{-url:template/choose_template_file-}',
	l_choose_template = '{-:@CHOOSE_TEMPLATE-}';
</script>
<script src="{-:*__THEME__-}admin/js/c.js"></script>
<script src="{-:*__THEME__-}admin/js/c_t.js"></script>
</body>
</html>
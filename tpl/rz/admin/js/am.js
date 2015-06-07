/* add model */
function check_alias(name) {
	$('#check_alias_result').html(checking);
	var alias = $('input[name="'+name+'"]').val();
	$.getJSON(url_check_alias+'&alias='+alias+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			$('#check_alias_result').html('<span class="fc_g fw_b">[√]</span>');
		}
		else {
			$('#check_alias_result').html('<span class="fc_r fw_b">[×]</span>');
		}
	});
}
function check_table(name) {
	var table = $('input[name="'+name+'"]').val();
	$('#check_table_result').html(checking);
	$.getJSON(url_check_table+'&table='+table+'&'+Math.random(), function(result) {
		if(1 == result.data) {
			$('#check_table_result').html('<span class="fc_g fw_b">[√]</span>');
		}
		else {
			$('#check_table_result').html('<span class="fc_r fw_b">[×]</span>');
		}
	});
}


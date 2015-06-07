/* search */
$(document).ready(function() {
	var obj = document.getElementById(result_id);
	highlight_keywords(obj, keyword, "red");
});

function highlight_keywords(obj, keywords, fontColor) {
	keywords = analyze_keywords(keywords);
	if(obj == null || keywords.length == 0) {
		return;
	}
	if(fontColor == null || fontColor == "") {
		fontColor = "red";
	}
	highlight(obj, keywords);

	function highlight(obj, keywords) {
		var re = new RegExp(keywords, "i");
		var style = ' style="color:' + fontColor + ';" '
		for(var i = 0; i < obj.childNodes.length; i++) {
			var childObj = obj.childNodes[i];
			if(childObj.nodeType == 3) {
				if(childObj.data.search(re) == -1) {
					continue;
				}
				var reResult = new RegExp("(" + keywords + ")", "gi");
				var objResult = document.createElement("span");
				objResult.innerHTML = childObj.data.replace(reResult, "<span" + style + ">$1</span>");
				if(childObj.data == objResult.childNodes[0].innerHTML) {
					continue;
				}
				obj.replaceChild(objResult, childObj);
			}
			else if(childObj.nodeType == 1) {
				highlight(childObj, keywords);
			}
		}
	}

	function analyze_keywords(keywords) {
		if(keywords == null) {
			return "";
		}
		keywords = keywords.replace(/\s+/g, "|").replace(/\|+/g, "|");
		keywords = keywords.replace(/(^\|*)|(\|*$)/g, "");

		if(keywords.length == 0) {
			return "";
		}
		var wordsArr = keywords.split("|");

		if(wordsArr.length > 1) {
			var resultArr = bubble_sort(wordsArr);
			var result = "";
			for(var i = 0; i < resultArr.length; i++) {
				result = result + "|" + resultArr[i];
			}
			return result.replace(/(^\|*)|(\|*$)/g, "");
		}
		else {
			return keywords;
		}
	}

	/* put the long keyword to front by bubble sort. */
	function bubble_sort(arr) {
		var temp, exchange;
		for(var i = 0; i < arr.length; i++) {
			exchange = false;
			for(var j = arr.length - 2; j >= i; j--) {
				if((arr[j + 1].length) > (arr[j]).length) {
					temp = arr[j + 1]; arr[j + 1] = arr[j]; arr[j] = temp;
					exchange = true;
				}
			}
			if(!exchange) {
				break;
			}
		}
		return arr;
	}
}


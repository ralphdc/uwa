/* option */

function formIsDirty(form) {
	for(var i = 0; i < form.elements.length; i++) {
		var element = form.elements[i];
		var type = element.type;
		if(type == "checkbox" || type == "radio") {
			if (element.checked != element.defaultChecked) {
				return true;
			}
		}
		else if(type == "hidden" || type == "password" || type == "text" || type == "textarea") {
			if(element.value != element.defaultValue) {
				return true;
			}
		}
		else if(type == "select-one" || type == "select-multiple") {
			for(var j = 0; j < element.options.length; j++) {
				if (element.options[j].selected	!= element.options[j].defaultSelected) {
					return true;
				}
			}
		}
	}
	return false;
}

$(window).on('beforeunload', function(e){
	e = e || window.event;
	if(formIsDirty(document.forms["formEdit"])) {
		// IE and Firefox
		if(e) {
			e.returnValue = l_option_not_saved_tip;
		}
		// Safari
		return l_option_not_saved_tip;
	}
});

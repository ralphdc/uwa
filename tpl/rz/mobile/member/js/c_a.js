/* choose archive */

/* define array */
Array.prototype.distinct = function() {
	 var self = this;
	 var _a = this.concat().sort();
	 _a.sort(function(a, b) {
		 if(a == b) {
			 var n = self.indexOf(a);
			 self.splice(n, 1);
		 }
	 });
	 return self;
};

$(document).on('click', '.choose_archive', function() {
	var to_id = $(this).attr('to_id');
	dialog({
		url: url_choose_archive,
		data: {'archive': $('#' + to_id).val()},
		title: l_choose_archive,
		height: '100%',
		id:'OM' + to_id,
		onclose: function () {
			var archive = this.returnValue.archive,
				exceptArchive = this.returnValue.exceptArchive,
				archiveTitle = this.returnValue.archiveTitle;
			$('#' + to_id).val(archive_merge($('#' + to_id).val(), archive, exceptArchive, to_id, archiveTitle));
		}
	}).showModal();
});

$(document).on('click', '.archive_set span b', function() {
	var aid = $(this).parent().attr('aid'),
		to_id = $(this).parent().parent().attr('to_id');
	$('#' + to_id).val(archive_merge($('#' + to_id).val(), '', aid, to_id));
});

function archive_merge(oldid, newid, exceptid, to_id, archiveTitle) {
	var id = [];
	if('' == oldid) {
		oldid = [];
	}
	else {
		oldid = oldid.split(',');
	}
	if(null != newid) {
		newid = newid.split(',');
		itemTitles = archiveTitle;
		for(i = 0; i < newid.length; i++) {
			if(-1 == jQuery.inArray(newid[i], oldid) && '' != newid[i]) {
				oldid.push(newid[i]);
				$('.archive_set[to_id="' + to_id + '"]').append(' <span class="badge badge-success" aid="' + newid[i] + '">' + itemTitles[i] + ' <b>╳</b></span>');
			}
		}
	}
	id = oldid.distinct();

	if(null != exceptid) {
		var exceptid = exceptid.split(',');
		for(i = 0; i < exceptid.length; i++) {
			if('' != exceptid[i]) {
				idIndex = jQuery.inArray(exceptid[i], id);
				if(-1 != idIndex) {
					id.splice(idIndex, 1);
					$('.archive_set[to_id="' + to_id + '"] span[aid="' + exceptid[i] + '"]').remove();
				}
			}
		}
	}
	id = id.join(',');
	return id;
}

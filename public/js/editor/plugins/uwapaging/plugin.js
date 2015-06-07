(function()
{
	CKEDITOR.plugins.add('uwapaging',
	{
		lang : "en,zh-cn,zh",
		init : function(editor)
		{
			var l_title = editor.lang.uwapaging.title;
			pluginName = 'uwapaging';
			editor.addCommand(pluginName, {
				exec : function(editor)
				{
					editor.insertHtml("<p>#uwa_paging#</p>\r\n");
				}
			});
			editor.ui.addButton('UwaPaging',
			{
				label: l_title,
				command: pluginName,
				icon: this.path +'images/uwapaging.png'
			});
		}
	});
})();

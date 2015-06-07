/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//config.extraPlugins = 'uwapaging';
	config.toolbar = 'uwa';
	config.toolbar_uwa = [
		{ name: 'document', items : [ 'Source','-','Preview','Print','-'] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll'] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','Iframe' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'links', items : [ 'Link','Unlink' ] },
		'/',
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','UwaPaging' ] }
	]; 
	config.toolbar_uwa_simple = [
		{ name: 'document', items : [  'Source','-','Preview'] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Replace','SelectAll'] },
		{ name: 'insert', items : [ 'Image','Table','SpecialChar' ] },
		{ name: 'links', items : [ 'Link','Unlink' ] },
		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'styles', items : [ 'Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'tools', items : [ 'UwaPaging' ] },
		{ name: 'view', items : [ 'Maximize' ] }
	];
	config.toolbar_uwa_mini = [
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','-','TextColor','BGColor' ] },
		{ name: 'tools', items : [ 'UwaPaging' ] },
		'/',
		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Image','Link','Unlink' ] }
	];
	config.dialog_backgroundCoverColor = 'rgb(0,0,0)';
	config.dialog_backgroundCoverOpacity = '0.8';
	config.colorButton_colors = 
	'FFF,000,EEECE1,1F497D,E84C22,9BBB59,8064A2,F79646,F2F2F2,7F7F7F,DDD9C3,C6D9F0,F2DCDB,EBF1DD,E5E0EC,FDEADA,D8D8D8,595959,C4BD97,8DB3E2,E5B9B7,D7E3BC,CCC1D9,FBD5B5,BFBFBF,3F3F3F,938953,548DD4,D99694,C3D69B,B2A2C7,FAC08F,A5A5A5,262626,494429,17365D,953734,76923C,5F497A,E36C09,7F7F7F,0C0C0C,1D1B10,0F243E,632423,4F6128,3F3151,974806,F00,FF0,92D050,00B050,00b0f0,0070C0,002060,7030A0';
};

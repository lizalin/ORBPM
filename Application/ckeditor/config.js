/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
var hostName	= window.location.host;
var pathName	= window.location.pathname;
var FN1			= pathName.split('/')[1];
var FN2			= pathName.split('/')[2];
var URL			= 'http://'+hostName+'/'+FN1+'/'+FN2+'/';

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example: 
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//var path= ''+URL+'styles/style.css';
	config.resize_enabled = true;
	//config.width = 900;
	//config.removePlugins = 'forms,save,print,find';
	config.contentsCss =''+URL+'css/custom.css';
        //alert(''+URL+'css/custom.css');
	/*config.contentsCss ='../../ckeditor/font.css';*/
//the next line add the new font to the combobox in CKEditor
//config.font_names = 'Hindi Font/Conv_AMANOJ-N' + config.font_names;
        config.font_names = 'Akruti Sarala/AkrutiOriSarala06Normal;'+ config.font_names;	


	config.toolbar = [
	//{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [  'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Source', '-','Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	//{ name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	//'/',
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat','TextColor', 'BGColor' ] },
	{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', /*'BidiLtr', 'BidiRtl',*/ 'Language' ] },
	
	{ name: 'insert', items: [ 'Image',  'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak' /*'Flash','Iframe'*/ ] },
	//'/',
	{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	//{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	
	{ name: 'others', items: [ '-' ] }
	//{ name: 'about', items: [ 'About' ] }
];

// Toolbar groups configuration.
config.toolbarGroups = [
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	{ name: 'forms' },
	//'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	{ name: 'links' },
	{ name: 'insert' },
	//'/',
	{ name: 'styles' },
	{ name: 'colors' },
	{ name: 'tools' },
	{ name: 'others' },
	{ name: 'about' }
];
};

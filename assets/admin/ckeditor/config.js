/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
	config.toolbar_Full =
	[
		{ name: 'document',    items : [ 'Source','-','Print' ] },
		{ name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert',      items : [ 'Image','Flash','Table','PageBreak' ] },
		{ name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
		{ name: 'code',        items : [ 'Code'] }
	];  

   config.filebrowserBrowseUrl = 'http://URL-DOMAIN/ckeditor/kcfinder/browse.php';
   config.filebrowserImageBrowseUrl = 'http://URL-DOMAIN/ckeditor/kcfinder/browse.php?type=images';
   config.filebrowserFlashBrowseUrl = 'http://URL-DOMAIN/ckeditor/kcfinder//browse.php?type=flash';
   config.filebrowserUploadUrl = 'http://URL-DOMAIN/ckeditor/kcfinder/upload.php?type=files';
   config.filebrowserImageUploadUrl = 'http://URL-DOMAIN//ckeditor/kcfinder/upload.php?type=images';
   config.filebrowserFlashUploadUrl = 'http://URL-DOMAIN//ckeditor/kcfinder/upload.php?type=flash';
   config.enterMode = 'CKEDITOR.ENTER_BR' ; // p | div | br
   config.shiftEnterMode = ' CKEDITOR.ENTER_P' ; // p | div | br
   config.height = 400;
   
};

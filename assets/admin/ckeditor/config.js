/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.allowedContent = true;
	config.extraAllowedContent = 'div(*)';
	config.filebrowserBrowseUrl = '/assets/admin/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = '/assets/admin/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = '/assets/admin/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = '/assets/admin/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = '/assets/admin/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = '/assets/admin/kcfinder/upload.php?type=flash';
};

/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar =
[	
	[ 'Source','Styles','Format','Font','FontSize' ],
	[ 'TextColor','BGColor' ],
	[ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ],
	[ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
	[ 'Maximize', 'ShowBlocks' ],
	['Link','Unlink'],
	['Image'],
	//[ 'Cut','Copy','Paste','PasteText','-','Undo','Redo' ]
];
	
};

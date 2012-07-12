/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        config.toolbar = 'Custom';
        config.toolbar_Custom =
        [
            [
                'Bold',
                'Italic',
                'Underline',
                'NumberedList',
                'BulletedList',
                'Outdent',
                'Indent',
                'JustifyLeft',
                'JustifyCenter',
                'JustifyRight',
                'JustifyBlock',
                'Link',
                'Image',
                'Table',
                'HorizontalRule',
                'Format',
                'TextColor',
                'BGColor'
            ]
        ];
};

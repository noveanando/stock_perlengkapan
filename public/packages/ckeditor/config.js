/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config


	// Toolbar
	// ------------------------------

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		'/',
	];


	// Extra config
	// ------------------------------

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript,Image';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	// Allow content rules
	config.allowedContent = true;

	config.extraAllowedContent = "span(*)[*]{*};i(*)[*]{*};p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*};tr(*)[*]{*};td(*)[*]{*}";

	config.enterMode = CKEDITOR.ENTER_BR;

	config.shiftEnterMode = CKEDITOR.ENTER_P;

	// Extra plugins
	// ------------------------------

	// CKEDITOR PLUGINS LOADING
    config.extraPlugins = 'pbckcode,justify,colorbutton,alphaimagemedia,videoembed'; // add other plugins here (comma separated)

	// PBCKCODE CUSTOMIZATION
    config.pbckcode = {
        // An optional class to your pre tag.
        cls : '',

        // The syntax highlighter you will use in the output view
        highlighter : 'PRETTIFY',

        // An array of the available modes for you plugin.
        // The key corresponds to the string shown in the select tag.
        // The value correspond to the loaded file for ACE Editor.
        modes : [ ['HTML', 'html'], ['CSS', 'css'], ['PHP', 'php'], ['JS', 'javascript'] ],

        // The theme of the ACE Editor of the plugin.
        theme : 'textmate',

        // Tab indentation (in spaces)
        tab_size : '4',

        // the root path of ACE Editor. Useful if you want to use the plugin
        // without any Internet connection
        js : "http://cdn.jsdelivr.net//ace/1.1.4/noconflict/"
    };

};

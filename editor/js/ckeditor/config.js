/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'mp3player,youtube';
// 	config.extraPlugins = 'flashplayer';
// 	config.extraPlugins = '';
//  	config.extraPlugins = 'audio';
	//config.extraPlugins = 'oembed';
// 	config.extraPlugins = 'dialogui';
//  	config.extraPlugins = 'lineutils';
// 	config.extraPlugins = 'widget';
//  	config.extraPlugins = 'oembed';
config.font_names =
    'Arial/Arial, Helvetica, sans-serif;' +
    'Times New Roman/Times New Roman, Times, serif;' +
    'Verdana;' +
    'Ultra,serif;' +
    'Dosis,sans-serif;' +
    'Russo One,sans-serif;' +
    'Changa One,cursive;' +
    'Exo 2,sans-serif;' +
    'Oswald,sans-serif;' +
    'chunkfiveregular;'+
    'robotomedium_italic;' +
    'antic_slabregular;' +
    'robotobold;' +
    'robotobold_italic;' +
    'robotoitalic;' +
    'robotomedium;' +
    'robotoregular;' +
    'robotolight;' +
    'robotolight_italic;' +
    'star';

//     config.stylesSet = 'estilos_jl';
	
};

  
  // This code could (may be should) go in your config.js file
//   CKEDITOR.addStylesSet('estilos_jl', [
//     { name: 'My Custom Block', element: 'h3', styles: { color: 'blue'} },
//     { name: 'My Custom Inline', element: 'span', attributes: {'class': 'mine'} }
//   ]);
  // This code is for when you start up a CKEditor instance
//   CKEDITOR.replace( 'editor1',{
//     uiColor: '#9AB8F3',
//     stylesSet: 'my_custom_style'
//   });

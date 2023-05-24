
/**
 * @fileOverview Image Alpha plugin
 */

CKEDITOR.plugins.add( 'alphaimagemedia',
{

	hidpi: true, // %REMOVE_LINE_CORE%
	init: function( editor )
	{
		var allowed 	= 'img[alt,!src]{border-style,border-width,float,height,margin,margin-bottom,margin-left,margin-right,margin-top,width}',
		required		= 'img[alt,src]';

		// Plugin logic goes here...
		//add command
		editor.addCommand( 'showMedia',  {
			exec : function( editor ){
				editorName = editor.name;
				$('#modal-media-library').modal('show')
				getMedia(1);
		    }
	    });


		//add button to tollbar
		editor.ui.addButton( 'ImageMedia',
		{
			label: 'Insert From Media Library',
			command: 'showMedia',
			icon: this.path + 'icons/image.png',
			toolbar: 'insert,28',
			order: 5
		} );

		if ( editor.contextMenu )
		{
			editor.addMenuGroup( 'alphaImageGroup' );
			editor.contextMenu.addListener( function( element )
			{
				if ( element )
					element = element.getAscendant( 'img', true );
				if ( element && !element.isReadOnly() && !element.data( 'cke-realelement' ) ){
		 			return { alphaImage : CKEDITOR.TRISTATE_OFF };
				}
				return null;
			});
		}


	}
} );

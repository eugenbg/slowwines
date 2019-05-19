$(
	function()
	{
		Dropzone.options.filedrop = { init: function(){ this.on("complete", function( file ){ if( this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0 ){ doSomething(); } } ); } };
		
		$( '#dsID' ).val( $( '#id' ).val() );
		
		$( ".dropzone" ).sortable
		(
			{
				stop: function( event, ui )
				{
					$.ajax
					(
						{
							type: 'POST',
							url: '/jx/img.reorder.php',
							data: { 'id':$( '#id' ).val(), 'frm':$( '#frm' ).val(), 'image': JSON.stringify( $( ".dropzone" ).sortable( "toArray" ) ) },
							dataType: 'html'
						}
					);
					
				}				
			}
		);
		
		$( ".dropzone" ).disableSelection();
		
		$( ".dropzone" ).dropzone
		(
			{
				url: '/jx/img.upload.php',
				params: { 'id':$( '#id' ).val(), 'frm':$( '#frm' ).val() },
				dictDefaultMessage: '',
				parallelUploads: 4,
	            paramName: "file",
	            maxFilesize: 5.0,
	            acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
	            addRemoveLinks: true,
				clickable: true,
				init: function()
				{
					thisDropzone = this;
					
					this.on
					(
						"complete", 
						function( file ) 
						{
							if( this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0 )
							{
								console.log( "upload complete " );
								
								$.ajax
								(
									{
										type: 'POST',
										url: '/jx/img.reorder.php',
										async: false,
										data: { 'id':$( '#id' ).val(), 'frm':$( '#frm' ).val(), 'image': JSON.stringify( $( ".dropzone" ).sortable( "toArray" ) ) },
										dataType: 'html'
									}
								);
							}
						}
					);
					
					$.ajax
					(
						{
							type:		'POST',
							url:		'/jx/img.load.php',
							data:		{ 'id':$( '#id' ).val(), 'frm':$( '#frm' ).val() },
							success:	function( data )
										{
											$.each
											(
												data, 
												function( key, value )
												{
													if( value.file.length > 0 )
													{
														var mockFile	= { name: value.name, size: value.size };
														
														thisDropzone.options.addedfile.call( thisDropzone, mockFile );
														thisDropzone.options.thumbnail.call( thisDropzone, mockFile, value.file );
													}
													else
													{
														var mockFile	= { name: value.name, size: value.size };

														thisDropzone.options.addedfile.call( thisDropzone, mockFile );
														thisDropzone.options.thumbnail.call( thisDropzone, mockFile, "/dt/img/" + $( '#frm' ).val() + "/" + $( '#id' ).val() + "/" + value.name );
													}
												}
											);
										},
							dataType:	'json'
						}
					);
				},
				removedfile: function( file ) 
				{
					var _ref;
					
					if( ( _ref = file.previewElement ) != null )
					{
						bResult	= _ref.parentNode.removeChild(file.previewElement)
						
						$.ajax
						(
							{
								type: 'POST',
								url: '/jx/img.reorder.php',
								async: false,
								data: { 'id':$( '#id' ).val(), 'frm':$( '#frm' ).val(), 'image': JSON.stringify( $( ".dropzone" ).sortable( "toArray" ) ) },
								dataType: 'html'
							}
						);
						
						$.ajax
						(
							{
								type: 'POST',
								url: '/jx/img.remove.php',
								async: false,
								data: { "id":$( '#id' ).val(), 'frm':$( '#frm' ).val(), 'file':file.name },
								dataType: 'html'
							}
						);
					}
					else
					{
						bResult	= void 0;
					}
					
					return bResult
				}
			}
		);
	}
);
(function() {
	tinymce.PluginManager.add('customjjad-mce-button', function( editor, url ) {
			editor.addButton('customjjad-mce-button', {
									text: 'Generate PDF',
									icon: false,
									onclick: function() {
										// change the shortcode as per your requirement                                                                                                                                                                                                        
										alert('xxxxx');
								 }
				});
	});
})();
console.log('si se lee homs');
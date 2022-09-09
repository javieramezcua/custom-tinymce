(function(){
	tinymce.create('tinymce.plugins.MyPluginName', {
		init: function(ed, url){
			ed.addButton('myblockquotebtn', {
				title: 'My Blockquote',
				cmd: 'myBlockquoteBtnCmd',
				image: url + '/img/quote.png'
			});
			ed.addCommand('myBlockquoteBtnCmd', function(){
				var selectedText = ed.selection.getContent({format: 'html'});
				var win = ed.windowManager.open({
					title: 'Blockquote Properties',
					body: [
						{
							type: 'textbox',
							name: 'author',
							label: 'Quote Author',
							minWidth: 500,
							value: ''
						},
						{
							type: 'textbox',
							name: 'cite',
							label: 'Quote Citation',
							minWidth: 500,
							value : ''
						},
						{
							type: 'textbox',
							name: 'link',
							label: 'Citation URL',
							minWidth: 500,
							value: ''
						}
					],
					buttons: [
						{
							text: "Ok",
							subtype: "primary",
							onclick: function() {
								win.submit();
							}
						},
						{
							text: "Cancel",
							onclick: function() {
								win.close();
							}
						}
					],
					onsubmit: function(e){
						var params = [];
						if( e.data.author.length > 0 ) {
							params.push('author="' + e.data.author + '"');
						}
						if( e.data.cite.length > 0 ) {
							params.push('cite="' + e.data.cite + '"');
						}
						if( e.data.link.length > 0 ) {
							params.push('link="' + e.data.link + '"');
						}
						if( params.length > 0 ) {
							paramsString = ' ' + params.join(' ');
						}
						var returnText = '[ blockquote' + paramsString + ']' + selectedText + '[/blockquote ]';
						ed.execCommand('mceInsertContent', 0, returnText);
					}
				});
			});
		},
		getInfo: function() {
			return {
				longname : 'My Custom Buttons',
				author : 'Plugin Author',
				authorurl : 'https://www.axosoft.com',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add( 'mytinymceplugin', tinymce.plugins.MyPluginName );
})();
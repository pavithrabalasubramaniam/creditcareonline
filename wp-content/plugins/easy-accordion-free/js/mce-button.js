(function() {
	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton( 'my_mce_button', {
			text: 'EAF Shortcodes',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: 'Accordion form shortcode',
					onclick: function() {
						editor.insertContent('[efaccordion id="01"] [efitems title="Your Title here ..." text="Your Text here ..."] [efitems title="Your Title here ..." text="Your Text here ..."] [efitems title="Your Title here ..." text="Your Text here ..."][/efaccordion]');
					}
				},
				{
					text: 'Accordion form custom post',
					onclick: function() {
						editor.insertContent('[eaf_items id="02"]');
					}
				}
			]
		});
	});
})();
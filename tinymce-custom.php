<?php
	/* Add Generate PDF Button to the Coupon Editor */
	// add font type & font size selection option in the WYSIWYG editor                                                                                                                                                                                                             
	if ( ! function_exists( 'wdm_add_mce_fontoptions' ) ):
		function wdm_add_mce_fontoptions( $buttons ){
			array_unshift( $buttons, 'fontselect' );
			array_unshift( $buttons, 'fontsizeselect' );
			return $buttons;
		}
	endif;
	add_filter( 'mce_buttons_3', 'wdm_add_mce_fontoptions' );

	// hooks your functions into the correct filters                                                                                                                                                                                                                                
	function wdm_add_mce_button(){
	// check user permissions                                                                                                                                                                                                                                                       
		if ( !current_user_can( 'edit_posts' ) &&  !current_user_can( 'edit_pages' ) ):
			return;
		endif;
		// check if WYSIWYG is enabled                                                                                                                                                                                                                                                
		if ( 'true' == get_user_option( 'rich_editing' ) ):
			add_filter( 'mce_external_plugins', 'wdm_add_tinymce_plugin' );
			add_filter( 'mce_buttons', 'wdm_register_mce_button' );
		endif;
	}

	add_action('admin_head', 'wdm_add_mce_button');

	// register new button in the editor                                                                                                                                                                                                                                            
	function wdm_register_mce_button( $buttons ){
		array_push( $buttons, 'customjjad-mce-button' );
		return $buttons;
	}

	// declare a script for the new button                                                                                                                                                                                                                                          
	function wdm_add_tinymce_plugin( $plugin_array ){
		$plugin_array['wdm_mce_button'] = get_stylesheet_directory_uri() .'/tinymce-custom/js/customjjad-mce-button.js';
		return $plugin_array;
	}

	
	/**
	 * Add "Styles" drop-down
	 */ 
	function tuts_mcekit_editor_buttons($buttons) {
			array_unshift($buttons, 'styleselect');
			return $buttons;
	}
	
	add_filter('mce_buttons_2', 'tuts_mcekit_editor_buttons');
	
	
	add_filter('mce_css', 'jjad_mcekit_editor_style');
	function jjad_mcekit_editor_style($url) {
	
			if ( !empty($url) )
					$url .= ',';
	
			// Retrieves the plugin directory URL
			// Change the path here if using different directories
			$url .=  get_stylesheet_directory_uri().'/tinymce-custom/css/editor-styles.css';
	
			return $url;
	}
	
	/**
	 * Add "Styles" drop-down
	 */
	
	function tuts_mce_editor_buttons( $buttons ) {
			array_unshift( $buttons, 'styleselect' );
			return $buttons;
	}
	
	/**
	 * Add styles/classes to the "Styles" drop-down
	 */
	add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );
	
	function tuts_mce_before_init( $settings ) {
	
			$style_formats = array(
					array(
							'title' => 'Download Link',
							'selector' => 'a',
							'classes' => 'download'
					),
					array(
							'title' => 'Warning Box',
							'block' => 'div',
							'classes' => 'warning box',
							'wrapper' => true
					),
					array(
						'title' => 'Badge Blue Version',
						'block' => 'div',
						'classes' => 'badge badge-blue',
						'wrapper' => true
					),
					array(
						'title' => 'Badge Green Version',
						'block' => 'div',
						'classes' => 'badge badge-green',
						'wrapper' => true
					),
					array(
							'title' => 'Red Uppercase Text',
							'inline' => 'span',
							'styles' => array(
									'color' => '#ff0000',
									'fontWeight' => 'bold',
									'textTransform' => 'uppercase'
							)
					)
			);
	
			$settings['style_formats'] = json_encode( $style_formats );
	
			return $settings;
	
	}
	
	
	/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */
	
	/*
	* Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
	*/
	add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');
	
	/*
	* Enqueue stylesheet, if it exists.
	*/
	
	function tuts_mcekit_editor_enqueue() {
		// Customstyle.css is relative to the current file
		wp_enqueue_style( 'myCustomStyles', get_stylesheet_directory_uri().'/tinymce-custom/css/editor-styles.css');
	}
	
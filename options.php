<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_framework_theme'),
		'two' => __('Two', 'options_framework_theme'),
		'three' => __('Three', 'options_framework_theme'),
		'four' => __('Four', 'options_framework_theme'),
		'five' => __('Five', 'options_framework_theme')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_framework_theme'),
		'two' => __('Pancake', 'options_framework_theme'),
		'three' => __('Omelette', 'options_framework_theme'),
		'four' => __('Crepe', 'options_framework_theme'),
		'five' => __('Waffle', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );
		
	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

		$options[] = array(
			'name' => __('Brand Settings', 'options_framework_theme'),
			'type' => 'heading');
	
		$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('This creates a full size uploader that previews the image.', 'options_framework_theme'),
		'id' => 'logo',
		'type' => 'upload'
		);
		
		$options[] = array(
		'name' => __('Page background color', 'options_framework_theme'),
		'desc' => __('The color for the page content background.', 'options_framework_theme'),
		'id' => 'page_back_color',
		'type' => 'color'
		);
		
		$options[] = array(
		'name' => __('Links color', 'options_framework_theme'),
		'desc' => __('The color for the links.', 'options_framework_theme'),
		'id' => 'link_color',
		'type' => 'color');
		
		$options[] = array(
		'name' => __('Links on hover color', 'options_framework_theme'),
		'desc' => __('The color for the links on hovered.', 'options_framework_theme'),
		'id' => 'link_hover_color',
		'type' => 'color');		

		$options[] = array(
		'name' => __('Menu bar backgroud color', 'options_framework_theme'),
		'desc' => __('The color for background of the menu bar.', 'options_framework_theme'),
		'id' => 'back_color_menu',
		'type' => 'color');
				
		$options[] = array(
		'name' => __('Menu bar links color', 'options_framework_theme'),
		'desc' => __('The color for the links in the menu bar.', 'options_framework_theme'),
		'id' => 'link_color_menu',
		'type' => 'color');
		
		$options[] = array(
		'name' => __('Menu bar links hover color', 'options_framework_theme'),
		'desc' => __('The color for the links in the menu bar.', 'options_framework_theme'),
		'id' => 'link_hover_color_menu',
		'type' => 'color');

		$options[] = array(
		'name' => __('Menu bar button hover color', 'options_framework_theme'),
		'desc' => __('The color for the links in the menu bar.', 'options_framework_theme'),
		'id' => 'button_hover_color_menu',
		'type' => 'color');


	return $options;
}
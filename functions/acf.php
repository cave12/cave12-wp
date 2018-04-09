<?php 

/* ACF Setup for Cave12
 *
 * Adds the following field groups:
 *
 * 1) Photos et affiches
 * 2) Sur-titre
 * 3) Programme PDF
 *
*/


if( function_exists('acf_add_local_field_group') ):

/*
 * Photos et affiches
*/

acf_add_local_field_group(array(
	'key' => 'group_5480105b67137',
	'title' => 'Photos + Affiches',
	'fields' => array(
		array(
			'key' => 'field_54801064aef26',
			'label' => 'Photos',
			'name' => 'c12_photos',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => 0,
			'min_height' => 0,
			'min_size' => 0,
			'max_width' => 0,
			'max_height' => 0,
			'max_size' => 0,
			'mime_types' => 'jpg',
			'insert' => 'append',
		),
		array(
			'key' => 'field_5627ee02793e4',
			'label' => 'Affiches',
			'name' => 'c12_affiches',
			'type' => 'gallery',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'insert' => 'append',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

/*
 * Sur-titre
*/

acf_add_local_field_group(array(
	'key' => 'group_548010917decc',
	'title' => 'Sur-titre',
	'fields' => array(
		array(
			'key' => 'field_5480109a6b5c5',
			'label' => 'Sur-titre',
			'name' => 'c12_surtitre',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Sur-titre',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

/*
 * Programme PDF
*/

acf_add_local_field_group(array(
	'key' => 'group_5acb27ae615d1',
	'title' => 'Programme PDF',
	'fields' => array(
		array(
			'key' => 'field_5acb27b6fd8c5',
			'label' => 'Programme actuel PDF',
			'name' => 'c12_programme_pdf',
			'type' => 'file',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/programme.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;


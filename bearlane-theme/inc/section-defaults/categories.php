<?php
/**
 * Section Definition — Category Showcase
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'id'              => 'categories',
	'label'           => __( 'Category Showcase', 'bearlane' ),
	'description'     => __( 'Grid of WooCommerce product categories. Pick specific categories or auto-fill.', 'bearlane' ),
	'icon'            => 'dashicons-category',
	'priority'        => 30,
	'default_enabled' => true,
	'template'        => 'template-parts/front-page-categories.php',
	'fields'          => [

		'heading' => [
			'type'    => 'text',
			'label'   => __( 'Heading', 'bearlane' ),
			'default' => __( 'Shop by Category', 'bearlane' ),
		],

		'subheading' => [
			'type'    => 'textarea',
			'label'   => __( 'Subheading', 'bearlane' ),
			'default' => __( 'Explore our curated collections.', 'bearlane' ),
		],

		'source' => [
			'type'    => 'select',
			'label'   => __( 'Category Source', 'bearlane' ),
			'options' => [
				'auto'   => __( 'Automatic (most popular)', 'bearlane' ),
				'manual' => __( 'Pick specific categories', 'bearlane' ),
			],
			'default' => 'auto',
		],

		'category_ids' => [
			'type'    => 'category_ids',
			'label'   => __( 'Selected Categories', 'bearlane' ),
			'help'    => __( 'Only used when source = Pick specific categories.', 'bearlane' ),
			'default' => [],
		],

		'limit' => [
			'type'    => 'number',
			'label'   => __( 'Number of Categories', 'bearlane' ),
			'default' => 6,
		],

	],
];

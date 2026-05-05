<?php
/**
 * Section Definition — Featured Products
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'id'              => 'featured_products',
	'label'           => __( 'Featured Products', 'bearlane' ),
	'description'     => __( 'Grid of WooCommerce products. Pick specific products or auto-query.', 'bearlane' ),
	'icon'            => 'dashicons-star-filled',
	'priority'        => 40,
	'default_enabled' => false,
	'template'        => 'template-parts/front-page-featured-products.php',
	'fields'          => [

		'heading' => [
			'type'    => 'text',
			'label'   => __( 'Heading', 'bearlane' ),
			'default' => __( 'Featured Products', 'bearlane' ),
		],

		'subheading' => [
			'type'    => 'textarea',
			'label'   => __( 'Subheading', 'bearlane' ),
			'default' => __( 'Handpicked for you.', 'bearlane' ),
		],

		'source' => [
			'type'    => 'select',
			'label'   => __( 'Product Source', 'bearlane' ),
			'options' => [
				'featured' => __( 'Featured products (auto)', 'bearlane' ),
				'latest'   => __( 'Latest products (auto)', 'bearlane' ),
				'manual'   => __( 'Pick specific products', 'bearlane' ),
			],
			'default' => 'featured',
		],

		'product_ids' => [
			'type'    => 'product_ids',
			'label'   => __( 'Selected Products', 'bearlane' ),
			'help'    => __( 'Only used when source = Pick specific products.', 'bearlane' ),
			'default' => [],
		],

		'limit' => [
			'type'    => 'number',
			'label'   => __( 'Number of Products', 'bearlane' ),
			'default' => 8,
		],

		'show_view_all' => [
			'type'    => 'checkbox',
			'label'   => __( 'Show "View all" link', 'bearlane' ),
			'default' => true,
		],

		'view_all_label' => [
			'type'    => 'text',
			'label'   => __( 'View All Link Label', 'bearlane' ),
			'default' => __( 'View all products', 'bearlane' ),
		],

	],
];

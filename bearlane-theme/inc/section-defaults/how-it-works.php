<?php
/**
 * Section Definition — How It Works (4-step flow)
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$step_icon_default = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>';

return [
	'id'              => 'how_it_works',
	'label'           => __( 'How It Works', 'bearlane' ),
	'description'     => __( 'Numbered step-by-step explainer for your ordering flow.', 'bearlane' ),
	'icon'            => 'dashicons-editor-ol',
	'priority'        => 50,
	'default_enabled' => true,
	'template'        => 'template-parts/front-page-how-it-works.php',
	'fields'          => [

		'eyebrow' => [
			'type'    => 'text',
			'label'   => __( 'Eyebrow', 'bearlane' ),
			'default' => __( 'The Process', 'bearlane' ),
		],

		'heading' => [
			'type'    => 'text',
			'label'   => __( 'Heading', 'bearlane' ),
			'default' => __( 'Custom Embroidery Made Simple', 'bearlane' ),
		],

		'subheading' => [
			'type'    => 'textarea',
			'label'   => __( 'Subheading', 'bearlane' ),
			'default' => __( 'Four easy steps from blank shirt to branded perfection.', 'bearlane' ),
		],

		'steps' => [
			'type'       => 'repeater',
			'label'      => __( 'Steps', 'bearlane' ),
			'add_label'  => __( 'Add step', 'bearlane' ),
			'sub_fields' => [
				'number' => [
					'type'    => 'text',
					'label'   => __( 'Step Number', 'bearlane' ),
					'default' => '',
				],
				'icon'   => [
					'type'    => 'svg',
					'label'   => __( 'Icon SVG', 'bearlane' ),
					'default' => $step_icon_default,
				],
				'title'  => [
					'type'    => 'text',
					'label'   => __( 'Title', 'bearlane' ),
					'default' => '',
				],
				'desc'   => [
					'type'    => 'textarea',
					'label'   => __( 'Description', 'bearlane' ),
					'default' => '',
				],
			],
			'default'    => [
				[
					'number' => '01',
					'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
					'title'  => __( 'Choose Your Shirt', 'bearlane' ),
					'desc'   => __( 'Browse our range of premium shirts — polo, oxford, t-shirt, or fleece. Select your color, size, and fabric weight to match your brand.', 'bearlane' ),
				],
				[
					'number' => '02',
					'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>',
					'title'  => __( 'Upload Your Design', 'bearlane' ),
					'desc'   => __( 'Upload your logo or artwork in any format. Choose your embroidery placement — left chest, back, sleeve, or cuff — and pick your thread colors.', 'bearlane' ),
				],
				[
					'number' => '03',
					'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>',
					'title'  => __( 'Approve Your Proof', 'bearlane' ),
					'desc'   => __( 'We\'ll email you a digital stitch preview within 24 hours. Once you approve, we begin production. No surprises, no wasted shirts.', 'bearlane' ),
				],
				[
					'number' => '04',
					'icon'   => '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>',
					'title'  => __( 'We Ship to You', 'bearlane' ),
					'desc'   => __( 'Your embroidered shirts are carefully inspected, packaged, and shipped within 10–14 business days. Track your order every step of the way.', 'bearlane' ),
				],
			],
		],

		'cta_label' => [
			'type'    => 'text',
			'label'   => __( 'CTA Button Label', 'bearlane' ),
			'default' => __( 'Start Designing', 'bearlane' ),
		],

		'cta_url' => [
			'type'    => 'url',
			'label'   => __( 'CTA Button URL (blank = Shop)', 'bearlane' ),
			'default' => '',
		],

		'cta_note' => [
			'type'    => 'text',
			'label'   => __( 'Note Below CTA', 'bearlane' ),
			'default' => __( 'No design experience needed. Our team guides you every step.', 'bearlane' ),
		],

	],
];

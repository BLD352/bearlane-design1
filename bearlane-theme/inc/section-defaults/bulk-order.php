<?php
/**
 * Section Definition — Bulk / Business Order Callout
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'id'              => 'bulk_order',
	'label'           => __( 'Bulk Order Callout', 'bearlane' ),
	'description'     => __( 'High-contrast CTA for teams, schools, businesses, and events.', 'bearlane' ),
	'icon'            => 'dashicons-groups',
	'priority'        => 100,
	'default_enabled' => true,
	'template'        => 'template-parts/front-page-bulk-order.php',
	'fields'          => [

		'eyebrow' => [
			'type'    => 'text',
			'label'   => __( 'Eyebrow', 'bearlane' ),
			'default' => __( 'Bulk &amp; Business', 'bearlane' ),
		],

		'heading' => [
			'type'    => 'text',
			'label'   => __( 'Heading', 'bearlane' ),
			'default' => __( 'Ordering for a Team, Business, or Event?', 'bearlane' ),
		],

		'intro' => [
			'type'    => 'textarea',
			'label'   => __( 'Intro Paragraph', 'bearlane' ),
			'default' => __( 'We handle runs of 12 to 5,000+ units with the same quality and attention to detail as a single piece. Better pricing, faster turnaround, and a dedicated account manager.', 'bearlane' ),
		],

		'perks' => [
			'type'       => 'repeater',
			'label'      => __( 'Perks / Bullets', 'bearlane' ),
			'add_label'  => __( 'Add perk', 'bearlane' ),
			'sub_fields' => [
				'label' => [
					'type'    => 'text',
					'label'   => __( 'Perk', 'bearlane' ),
					'default' => '',
				],
			],
			'default'    => [
				[ 'label' => __( 'Volume discounts starting at 12 units', 'bearlane' ) ],
				[ 'label' => __( 'Dedicated account manager', 'bearlane' ) ],
				[ 'label' => __( 'Mixed sizes per design, no minimums per size', 'bearlane' ) ],
				[ 'label' => __( 'Free digitizing on orders of 24+', 'bearlane' ) ],
				[ 'label' => __( 'Net-30 invoicing for qualified accounts', 'bearlane' ) ],
				[ 'label' => __( 'Priority production on urgent deadlines', 'bearlane' ) ],
			],
		],

		'cta_primary_label' => [
			'type'    => 'text',
			'label'   => __( 'Primary Button Label', 'bearlane' ),
			'default' => __( 'Get a Bulk Quote', 'bearlane' ),
		],

		'cta_primary_url' => [
			'type'    => 'url',
			'label'   => __( 'Primary Button URL', 'bearlane' ),
			'default' => '/bulk-orders',
		],

		'cta_secondary_label' => [
			'type'    => 'text',
			'label'   => __( 'Secondary Button Label', 'bearlane' ),
			'default' => __( 'Talk to Our Team', 'bearlane' ),
		],

		'cta_secondary_url' => [
			'type'    => 'url',
			'label'   => __( 'Secondary Button URL', 'bearlane' ),
			'default' => '/contact',
		],

		'use_cases_label' => [
			'type'    => 'text',
			'label'   => __( 'Use Cases Label', 'bearlane' ),
			'default' => __( 'Perfect for:', 'bearlane' ),
		],

		'use_cases' => [
			'type'       => 'repeater',
			'label'      => __( 'Use Cases', 'bearlane' ),
			'add_label'  => __( 'Add use case', 'bearlane' ),
			'sub_fields' => [
				'icon'  => [
					'type'    => 'svg',
					'label'   => __( 'Icon SVG', 'bearlane' ),
					'default' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/></svg>',
				],
				'label' => [
					'type'    => 'text',
					'label'   => __( 'Label', 'bearlane' ),
					'default' => '',
				],
			],
			'default'    => [
				[ 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>', 'label' => __( 'Teams &amp; Staff', 'bearlane' ) ],
				[ 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>', 'label' => __( 'Businesses', 'bearlane' ) ],
				[ 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>', 'label' => __( 'Schools &amp; Clubs', 'bearlane' ) ],
				[ 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>', 'label' => __( 'Events', 'bearlane' ) ],
				[ 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>', 'label' => __( 'Sports Teams', 'bearlane' ) ],
				[ 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>', 'label' => __( 'Non-profits', 'bearlane' ) ],
			],
		],

		'minimum_note' => [
			'type'    => 'textarea',
			'label'   => __( 'Minimum / Note', 'bearlane' ),
			'default' => __( 'No per-design minimum. Mix sizes freely. Same stitch quality on every piece.', 'bearlane' ),
		],

	],
];

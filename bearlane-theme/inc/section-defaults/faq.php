<?php
/**
 * Section Definition — FAQ Accordion
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

return [
	'id'              => 'faq',
	'label'           => __( 'FAQ Accordion', 'bearlane' ),
	'description'     => __( 'Accordion of frequently asked questions.', 'bearlane' ),
	'icon'            => 'dashicons-editor-help',
	'priority'        => 90,
	'default_enabled' => true,
	'template'        => 'template-parts/front-page-faq.php',
	'fields'          => [

		'eyebrow' => [
			'type'    => 'text',
			'label'   => __( 'Eyebrow', 'bearlane' ),
			'default' => __( 'Questions &amp; Answers', 'bearlane' ),
		],

		'heading' => [
			'type'    => 'text',
			'label'   => __( 'Heading', 'bearlane' ),
			'default' => __( 'Everything You Want to Know', 'bearlane' ),
		],

		'subheading' => [
			'type'    => 'textarea',
			'label'   => __( 'Subheading', 'bearlane' ),
			'default' => __( 'Common questions about custom embroidery, ordering, and production.', 'bearlane' ),
		],

		'items' => [
			'type'       => 'repeater',
			'label'      => __( 'FAQ Items', 'bearlane' ),
			'add_label'  => __( 'Add question', 'bearlane' ),
			'sub_fields' => [
				'question' => [
					'type'    => 'text',
					'label'   => __( 'Question', 'bearlane' ),
					'default' => '',
				],
				'answer'   => [
					'type'    => 'richtext',
					'label'   => __( 'Answer', 'bearlane' ),
					'default' => '',
				],
			],
			'default'    => [
				[ 'question' => __( 'What file format should I upload for my logo?', 'bearlane' ), 'answer' => __( 'We accept PNG, JPG, PDF, AI, EPS, and SVG files. For the cleanest result, vector files (AI, EPS, or SVG) are ideal. If you only have a PNG or JPG, our digitizing team will trace it — just make sure it\'s at least 300 DPI and has a transparent or white background.', 'bearlane' ) ],
				[ 'question' => __( 'How long does a custom embroidery order take?', 'bearlane' ), 'answer' => __( 'Standard production is 10–14 business days from proof approval. Rush options (5–7 business days) are available at checkout for an additional fee. Shipping time is additional and depends on your selected method.', 'bearlane' ) ],
				[ 'question' => __( 'Where can embroidery be placed on the shirt?', 'bearlane' ), 'answer' => __( 'We offer left chest, right chest, full back, upper back, left sleeve, right sleeve, and cuff placements. You can combine placements on a single garment — just select them at checkout or mention it in your personalization notes.', 'bearlane' ) ],
				[ 'question' => __( 'Can I order different sizes in the same design run?', 'bearlane' ), 'answer' => __( 'Yes — you can mix any sizes (XS through 5XL) within a single order. There\'s no minimum per size. Just add each size to your cart with the same design details and we\'ll process them all together.', 'bearlane' ) ],
				[ 'question' => __( 'What is the minimum order quantity?', 'bearlane' ), 'answer' => __( 'There is no minimum for standard orders — you can order a single custom shirt. Bulk pricing discounts begin at 12 units and increase at 24, 50, 100, and 250+ unit tiers.', 'bearlane' ) ],
				[ 'question' => __( 'Can I see a proof before you start embroidering?', 'bearlane' ), 'answer' => __( 'Absolutely — every order includes a digital stitch proof emailed within 24 business hours. We don\'t run any machines until you\'ve reviewed and approved the proof. You can request adjustments to colors, sizing, or placement before final approval.', 'bearlane' ) ],
				[ 'question' => __( 'How do I care for an embroidered shirt?', 'bearlane' ), 'answer' => __( 'Machine wash cold on a gentle cycle, inside-out. Tumble dry low or hang to dry. Do not iron directly on the embroidery — if pressing is needed, place a cloth over the design. Our Madeira threads are colorfast and rated for 100+ washes when cared for correctly.', 'bearlane' ) ],
				[ 'question' => __( 'What if I\'m not happy with the finished product?', 'bearlane' ), 'answer' => __( 'We stand behind every stitch. If the embroidery doesn\'t match the approved proof, we\'ll re-do it at no charge. If we can\'t make it right, you\'ll get a full refund. Contact us within 14 days of delivery and we\'ll resolve it immediately.', 'bearlane' ) ],
			],
		],

		'footer_text' => [
			'type'    => 'text',
			'label'   => __( 'Footer Text', 'bearlane' ),
			'default' => __( 'Still have questions?', 'bearlane' ),
		],

		'footer_button_label' => [
			'type'    => 'text',
			'label'   => __( 'Footer Button Label', 'bearlane' ),
			'default' => __( 'Contact Us', 'bearlane' ),
		],

		'footer_button_url' => [
			'type'    => 'url',
			'label'   => __( 'Footer Button URL', 'bearlane' ),
			'default' => '/contact',
		],

	],
];

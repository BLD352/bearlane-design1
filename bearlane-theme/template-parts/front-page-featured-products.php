<?php
/**
 * Template Part — Featured Products
 *
 * Driven by bearlane_sections → featured_products.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$content = bearlane_current_section_content( 'featured_products' );

$heading    = (string) ( $content['heading'] ?? '' );
$subheading = (string) ( $content['subheading'] ?? '' );
$source     = (string) ( $content['source'] ?? 'featured' );
$limit      = max( 1, (int) ( $content['limit'] ?? 8 ) );

$show_view_all  = ! empty( $content['show_view_all'] );
$view_all_label = (string) ( $content['view_all_label'] ?? __( 'View all products', 'bearlane' ) );

$query_args = [
	'limit'   => $limit,
	'status'  => 'publish',
	'orderby' => 'date',
	'order'   => 'DESC',
];

switch ( $source ) {

	case 'manual':
		$ids = array_filter( array_map( 'intval', (array) ( $content['product_ids'] ?? [] ) ) );
		if ( empty( $ids ) ) {
			return;
		}
		$query_args['include'] = $ids;
		$query_args['orderby'] = 'post__in';
		break;

	case 'featured':
		$query_args['featured'] = true;
		break;

	case 'latest':
	default:
		// defaults above handle it.
		break;
}

$products = wc_get_products( $query_args );

if ( empty( $products ) && 'featured' === $source ) {
	// Fallback to latest if no featured ones.
	$products = wc_get_products( [
		'limit'   => $limit,
		'status'  => 'publish',
		'orderby' => 'date',
		'order'   => 'DESC',
	] );
}

if ( empty( $products ) ) {
	return;
}
?>

<section class="bld-section section featured-products-section" aria-label="<?php esc_attr_e( 'Featured Products', 'bearlane' ); ?>">
	<div class="bld-container container">

		<header class="section__header">
			<?php if ( $heading ) : ?>
			<h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
			<p class="section__subtitle"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
			<?php if ( $show_view_all ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="section__link">
				<?php echo esc_html( $view_all_label ); ?> →
			</a>
			<?php endif; ?>
		</header>

		<div class="product-grid product-grid--4col">
			<?php foreach ( $products as $product ) : ?>
			<?php bearlane_part( 'template-parts/product', 'card', [ 'product' => $product ] ); ?>
			<?php endforeach; ?>
		</div>

	</div>
</section>

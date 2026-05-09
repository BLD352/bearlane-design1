<?php
/**
 * Template Part — Best Sellers / Tabbed Product Showcase
 *
 * Driven by bearlane_sections → best_sellers.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$content = bearlane_current_section_content( 'best_sellers' );

$eyebrow  = (string) ( $content['eyebrow'] ?? '' );
$heading  = (string) ( $content['heading'] ?? '' );
$per_tab  = max( 1, (int) ( $content['products_per_tab'] ?? 4 ) );

$tabs = [];

if ( ! empty( $content['show_best_sellers'] ) ) {
	$tabs['best-sellers'] = [
		'label'    => (string) ( $content['best_sellers_label'] ?? __( 'Best Sellers', 'bearlane' ) ),
		'products' => wc_get_products( [
			'limit'   => $per_tab,
			'status'  => 'publish',
			'orderby' => 'popularity',
			'order'   => 'DESC',
		] ),
	];
}

if ( ! empty( $content['show_new_arrivals'] ) ) {
	$tabs['new-arrivals'] = [
		'label'    => (string) ( $content['new_arrivals_label'] ?? __( 'New Arrivals', 'bearlane' ) ),
		'products' => wc_get_products( [
			'limit'   => $per_tab,
			'status'  => 'publish',
			'orderby' => 'date',
			'order'   => 'DESC',
		] ),
	];
}

if ( ! empty( $content['show_staff_picks'] ) ) {
	$tabs['featured'] = [
		'label'    => (string) ( $content['staff_picks_label'] ?? __( 'Staff Picks', 'bearlane' ) ),
		'products' => wc_get_products( [
			'limit'    => $per_tab,
			'status'   => 'publish',
			'featured' => true,
			'orderby'  => 'date',
			'order'    => 'DESC',
		] ),
	];
}

// Drop empty tabs.
foreach ( $tabs as $key => $tab ) {
	if ( empty( $tab['products'] ) ) {
		unset( $tabs[ $key ] );
	}
}

if ( empty( $tabs ) ) {
	return;
}

$tab_keys = array_keys( $tabs );
$first    = $tab_keys[0];

$footer_label = (string) ( $content['footer_button_label'] ?? __( 'View All Products', 'bearlane' ) );
$footer_url   = (string) ( $content['footer_button_url'] ?? '' );
if ( ! $footer_url ) {
	$footer_url = wc_get_page_permalink( 'shop' );
}
?>

<section class="bld-section section best-sellers-section" aria-label="<?php esc_attr_e( 'Shop Our Collection', 'bearlane' ); ?>">
	<div class="bld-container container">

		<div class="best-sellers-header">
			<div class="best-sellers-header__text">
				<?php if ( $eyebrow ) : ?>
				<div class="section__eyebrow bld-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
				<h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
			</div>

			<nav class="product-tabs" aria-label="<?php esc_attr_e( 'Product categories', 'bearlane' ); ?>" role="tablist">
				<?php foreach ( $tabs as $key => $tab ) : ?>
				<button class="product-tab<?php echo $key === $first ? ' is-active' : ''; ?>"
					role="tab"
					id="tab-<?php echo esc_attr( $key ); ?>"
					aria-controls="tabpanel-<?php echo esc_attr( $key ); ?>"
					aria-selected="<?php echo $key === $first ? 'true' : 'false'; ?>"
					data-tab="<?php echo esc_attr( $key ); ?>">
					<?php echo esc_html( $tab['label'] ); ?>
				</button>
				<?php endforeach; ?>
			</nav>
		</div>

		<?php foreach ( $tabs as $key => $tab ) : ?>
		<div class="product-tab-panel<?php echo $key === $first ? ' is-active' : ''; ?>"
			id="tabpanel-<?php echo esc_attr( $key ); ?>"
			role="tabpanel"
			aria-labelledby="tab-<?php echo esc_attr( $key ); ?>"
			<?php echo $key !== $first ? 'hidden' : ''; ?>>
			<div class="product-grid product-grid--4col">
				<?php foreach ( $tab['products'] as $product ) : ?>
				<?php bearlane_part( 'template-parts/product', 'card', [ 'product' => $product ] ); ?>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endforeach; ?>

		<div class="best-sellers-footer">
			<a href="<?php echo esc_url( $footer_url ); ?>" class="bld-button btn btn--outline">
				<?php echo esc_html( $footer_label ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
			</a>
		</div>

	</div>
</section>

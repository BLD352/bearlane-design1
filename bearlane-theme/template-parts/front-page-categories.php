<?php
/**
 * Template Part — Category Showcase
 *
 * Driven by bearlane_sections → categories. Categories are either
 * auto-selected (most popular, excluding the uncategorised default)
 * or hand-picked from the admin UI.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$content = bearlane_current_section_content( 'categories' );

$heading    = (string) ( $content['heading'] ?? '' );
$subheading = (string) ( $content['subheading'] ?? '' );
$source     = (string) ( $content['source'] ?? 'auto' );
$limit      = max( 1, (int) ( $content['limit'] ?? 6 ) );

if ( 'manual' === $source ) {
	$ids = array_filter( array_map( 'intval', (array) ( $content['category_ids'] ?? [] ) ) );
	if ( empty( $ids ) ) {
		return;
	}
	$categories = get_terms( [
		'taxonomy'   => 'product_cat',
		'include'    => $ids,
		'orderby'    => 'include',
		'hide_empty' => false,
	] );
} else {
	$categories = get_terms( [
		'taxonomy'   => 'product_cat',
		'orderby'    => 'count',
		'order'      => 'DESC',
		'number'     => $limit,
		'hide_empty' => true,
		'parent'     => 0,
		'exclude'    => [ get_option( 'default_product_cat', 0 ) ],
	] );
}

if ( is_wp_error( $categories ) || empty( $categories ) ) {
	return;
}
?>

<section class="bld-section section categories-section" aria-label="<?php esc_attr_e( 'Shop by Category', 'bearlane' ); ?>">
	<div class="bld-container container">

		<header class="section__header">
			<?php if ( $heading ) : ?>
			<h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
			<p class="section__subtitle"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
		</header>

		<div class="category-grid">
			<?php foreach ( $categories as $category ) : ?>
			<?php
			$thumbnail_id  = get_term_meta( $category->term_id, 'thumbnail_id', true );
			$thumbnail_url = $thumbnail_id
				? wp_get_attachment_image_url( $thumbnail_id, 'bearlane-card' )
				: wc_placeholder_img_src( 'bearlane-card' );
			$category_url  = get_term_link( $category );
			?>
			<a href="<?php echo esc_url( $category_url ); ?>" class="category-card">
				<div class="category-card__image-wrap">
					<img src="<?php echo esc_url( $thumbnail_url ); ?>"
						alt="<?php echo esc_attr( $category->name ); ?>"
						class="category-card__image"
						loading="lazy"
						width="600"
						height="600">
				</div>
				<div class="category-card__body">
					<h3 class="category-card__title"><?php echo esc_html( $category->name ); ?></h3>
					<span class="category-card__count">
						<?php
						echo esc_html( sprintf(
							/* translators: %d: product count */
							_n( '%d product', '%d products', $category->count, 'bearlane' ),
							$category->count
						) );
						?>
					</span>
				</div>
				<span class="category-card__arrow" aria-hidden="true">→</span>
			</a>
			<?php endforeach; ?>
		</div>

	</div>
</section>

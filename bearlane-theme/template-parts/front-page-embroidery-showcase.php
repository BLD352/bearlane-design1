<?php
/**
 * Template Part — Embroidery Quality Showcase
 *
 * Driven by bearlane_sections → embroidery_showcase.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'embroidery_showcase' );

$image_id  = (int) ( $content['image'] ?? 0 );
$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'large' ) : '';

$badge_label = (string) ( $content['badge_label'] ?? '' );
$eyebrow     = (string) ( $content['eyebrow'] ?? '' );
$heading     = (string) ( $content['heading'] ?? '' );
$intro       = (string) ( $content['intro'] ?? '' );
$points      = (array)  ( $content['points'] ?? [] );

$cta_primary_label   = (string) ( $content['cta_primary_label'] ?? '' );
$cta_primary_url     = (string) ( $content['cta_primary_url'] ?? '' );
$cta_secondary_label = (string) ( $content['cta_secondary_label'] ?? '' );
$cta_secondary_url   = (string) ( $content['cta_secondary_url'] ?? '' );

if ( ! $cta_primary_url && class_exists( 'WooCommerce' ) ) {
	$cta_primary_url = wc_get_page_permalink( 'shop' );
}
?>

<section class="bld-section section embroidery-showcase-section" aria-label="<?php esc_attr_e( 'Embroidery Quality', 'bearlane' ); ?>">
	<div class="bld-container container">
		<div class="embroidery-showcase">

			<div class="embroidery-showcase__visual">
				<?php if ( $image_url ) : ?>
				<img src="<?php echo esc_url( $image_url ); ?>"
					alt="<?php esc_attr_e( 'Close-up of embroidery stitch detail on a BearLane shirt', 'bearlane' ); ?>"
					class="embroidery-showcase__image"
					loading="lazy"
					width="600"
					height="700">
				<?php else : ?>
				<div class="embroidery-showcase__placeholder" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
					<p><?php esc_html_e( 'Add a close-up embroidery photo via Homepage Sections', 'bearlane' ); ?></p>
				</div>
				<?php endif; ?>

				<?php if ( $badge_label ) : ?>
				<div class="embroidery-showcase__badge" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17 5.8 21.3l2.4-7.4L2 9.4h7.6z"/></svg>
					<span><?php echo esc_html( $badge_label ); ?></span>
				</div>
				<?php endif; ?>
			</div>

			<div class="embroidery-showcase__content">
				<?php if ( $eyebrow ) : ?>
				<div class="section__eyebrow bld-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
				<h2 class="embroidery-showcase__title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $intro ) : ?>
				<p class="embroidery-showcase__intro"><?php echo esc_html( $intro ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $points ) ) : ?>
				<ul class="embroidery-quality-list" role="list">
					<?php foreach ( $points as $point ) : ?>
					<li class="embroidery-quality-item">
						<span class="embroidery-quality-item__icon" aria-hidden="true">
							<?php echo bearlane_sanitize_inline_svg( (string) ( $point['icon'] ?? '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
						<div class="embroidery-quality-item__text">
							<strong class="embroidery-quality-item__title"><?php echo esc_html( (string) ( $point['title'] ?? '' ) ); ?></strong>
							<span class="embroidery-quality-item__desc"><?php echo esc_html( (string) ( $point['desc'] ?? '' ) ); ?></span>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( ( $cta_primary_label && $cta_primary_url ) || ( $cta_secondary_label && $cta_secondary_url ) ) : ?>
				<div class="embroidery-showcase__actions">
					<?php if ( $cta_primary_label && $cta_primary_url ) : ?>
					<a href="<?php echo esc_url( $cta_primary_url ); ?>" class="bld-button btn btn--primary">
						<?php echo esc_html( $cta_primary_label ); ?>
					</a>
					<?php endif; ?>
					<?php if ( $cta_secondary_label && $cta_secondary_url ) : ?>
					<a href="<?php echo esc_url( $cta_secondary_url ); ?>" class="bld-button btn btn--outline">
						<?php echo esc_html( $cta_secondary_label ); ?>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

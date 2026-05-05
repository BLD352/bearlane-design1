<?php
/**
 * Template Part — Bulk / Business Order Callout
 *
 * Driven by bearlane_sections → bulk_order.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'bulk_order' );

$eyebrow     = (string) ( $content['eyebrow'] ?? '' );
$heading     = (string) ( $content['heading'] ?? '' );
$intro       = (string) ( $content['intro'] ?? '' );
$perks       = (array)  ( $content['perks'] ?? [] );
$use_cases   = (array)  ( $content['use_cases'] ?? [] );
$use_cases_label = (string) ( $content['use_cases_label'] ?? '' );
$minimum_note = (string) ( $content['minimum_note'] ?? '' );

$cta_primary_label   = (string) ( $content['cta_primary_label'] ?? '' );
$cta_primary_url     = (string) ( $content['cta_primary_url'] ?? '' );
$cta_secondary_label = (string) ( $content['cta_secondary_label'] ?? '' );
$cta_secondary_url   = (string) ( $content['cta_secondary_url'] ?? '' );
?>

<section class="bld-section section bulk-order-section" aria-label="<?php esc_attr_e( 'Bulk and Business Orders', 'bearlane' ); ?>">
	<div class="bld-container container">
		<div class="bulk-order-inner">

			<div class="bulk-order__content">
				<?php if ( $eyebrow ) : ?>
				<div class="section__eyebrow bld-eyebrow section__eyebrow bld-eyebrow--light"><?php echo wp_kses_post( $eyebrow ); ?></div>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
				<h2 class="bulk-order__title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $intro ) : ?>
				<p class="bulk-order__intro"><?php echo esc_html( $intro ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $perks ) ) : ?>
				<ul class="bulk-order-perks" role="list">
					<?php foreach ( $perks as $perk ) : ?>
					<li class="bulk-order-perk">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
						<?php echo esc_html( (string) ( $perk['label'] ?? '' ) ); ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>

				<?php if ( ( $cta_primary_label && $cta_primary_url ) || ( $cta_secondary_label && $cta_secondary_url ) ) : ?>
				<div class="bulk-order__actions">
					<?php if ( $cta_primary_label && $cta_primary_url ) : ?>
					<a href="<?php echo esc_url( $cta_primary_url ); ?>" class="bld-button btn btn--primary btn--large">
						<?php echo esc_html( $cta_primary_label ); ?>
					</a>
					<?php endif; ?>
					<?php if ( $cta_secondary_label && $cta_secondary_url ) : ?>
					<a href="<?php echo esc_url( $cta_secondary_url ); ?>" class="bld-button btn btn--ghost btn--large">
						<?php echo esc_html( $cta_secondary_label ); ?>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $use_cases ) ) : ?>
			<div class="bulk-order__use-cases">
				<?php if ( $use_cases_label ) : ?>
				<p class="bulk-order__use-cases-label"><?php echo esc_html( $use_cases_label ); ?></p>
				<?php endif; ?>
				<div class="bulk-use-cases-grid">
					<?php foreach ( $use_cases as $case ) : ?>
					<div class="bulk-use-case">
						<span class="bulk-use-case__icon" aria-hidden="true">
							<?php echo bearlane_sanitize_inline_svg( (string) ( $case['icon'] ?? '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</span>
						<span class="bulk-use-case__label"><?php echo wp_kses_post( (string) ( $case['label'] ?? '' ) ); ?></span>
					</div>
					<?php endforeach; ?>
				</div>
				<?php if ( $minimum_note ) : ?>
				<div class="bulk-order__minimum-note">
					<?php echo esc_html( $minimum_note ); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>
</section>

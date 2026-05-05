<?php
/**
 * Template Part — How It Works
 *
 * Driven by bearlane_sections → how_it_works.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'how_it_works' );

$eyebrow    = (string) ( $content['eyebrow'] ?? '' );
$heading    = (string) ( $content['heading'] ?? '' );
$subheading = (string) ( $content['subheading'] ?? '' );
$steps      = (array)  ( $content['steps'] ?? [] );
$cta_label  = (string) ( $content['cta_label'] ?? '' );
$cta_url    = (string) ( $content['cta_url'] ?? '' );
$cta_note   = (string) ( $content['cta_note'] ?? '' );

if ( ! $cta_url && class_exists( 'WooCommerce' ) ) {
	$cta_url = wc_get_page_permalink( 'shop' );
}

if ( empty( $steps ) ) {
	return;
}
?>

<section class="bld-section section how-it-works-section" aria-label="<?php esc_attr_e( 'How It Works', 'bearlane' ); ?>">
	<div class="bld-container container">

		<header class="section__header">
			<?php if ( $eyebrow ) : ?>
			<div class="section__eyebrow bld-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
			<h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
			<p class="section__subtitle"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
		</header>

		<div class="how-it-works-grid">
			<?php foreach ( $steps as $i => $step ) : ?>
			<div class="how-it-works-step">
				<div class="how-it-works-step__header">
					<div class="how-it-works-step__icon" aria-hidden="true">
						<?php echo bearlane_sanitize_inline_svg( (string) ( $step['icon'] ?? '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php if ( ! empty( $step['number'] ) ) : ?>
					<span class="how-it-works-step__number" aria-hidden="true"><?php echo esc_html( (string) $step['number'] ); ?></span>
					<?php endif; ?>
				</div>
				<?php if ( ! empty( $step['title'] ) ) : ?>
				<h3 class="how-it-works-step__title"><?php echo esc_html( (string) $step['title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $step['desc'] ) ) : ?>
				<p class="how-it-works-step__desc"><?php echo esc_html( (string) $step['desc'] ); ?></p>
				<?php endif; ?>
				<?php if ( $i < count( $steps ) - 1 ) : ?>
				<div class="how-it-works-step__connector" aria-hidden="true">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
				</div>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $cta_label || $cta_note ) : ?>
		<div class="how-it-works-cta">
			<?php if ( $cta_label && $cta_url ) : ?>
			<a href="<?php echo esc_url( $cta_url ); ?>" class="bld-button btn btn--primary btn--large">
				<?php echo esc_html( $cta_label ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
			</a>
			<?php endif; ?>
			<?php if ( $cta_note ) : ?>
			<p class="how-it-works-cta__note">
				<?php echo esc_html( $cta_note ); ?>
			</p>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>
</section>

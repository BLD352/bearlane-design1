<?php
/**
 * Template Part — Homepage Hero
 *
 * All content (headline, CTAs, trust strip, stats, background image)
 * is driven by the hero section content stored under
 * bearlane_sections → hero. Edit from Appearance → Homepage Sections.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'hero' );

$hero_image_id  = (int) ( $content['background_image'] ?? 0 );
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'bearlane-hero' ) : '';

$eyebrow    = (string) ( $content['eyebrow_label'] ?? '' );
$heading    = (string) ( $content['heading'] ?? '' );
$subheading = (string) ( $content['subheading'] ?? '' );

$cta_primary_label   = (string) ( $content['cta_primary_label'] ?? '' );
$cta_primary_url     = (string) ( $content['cta_primary_url'] ?? '' );
$cta_secondary_label = (string) ( $content['cta_secondary_label'] ?? '' );
$cta_secondary_url   = (string) ( $content['cta_secondary_url'] ?? '' );

$trust_items = (array) ( $content['trust_items'] ?? [] );
$stats       = (array) ( $content['stats'] ?? [] );
?>

<section class="bld-section hero hero--embroidery<?php echo $hero_image_url ? ' hero--has-image' : ''; ?>"
	<?php if ( $hero_image_url ) : ?>
	style="--hero-image: url('<?php echo esc_url( $hero_image_url ); ?>')"
	<?php endif; ?>
	aria-label="<?php esc_attr_e( 'Homepage Hero', 'bearlane' ); ?>">

	<div class="hero__backdrop" aria-hidden="true"></div>

	<div class="bld-container container hero__container">
		<div class="hero__content">

			<?php if ( $eyebrow ) : ?>
			<div class="hero__eyebrow">
				<span class="hero__badge">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17 5.8 21.3l2.4-7.4L2 9.4h7.6z"/></svg>
					<?php echo esc_html( $eyebrow ); ?>
				</span>
			</div>
			<?php endif; ?>

			<?php if ( $heading ) : ?>
			<h1 class="hero__heading"><?php echo wp_kses_post( $heading ); ?></h1>
			<?php endif; ?>

			<?php if ( $subheading ) : ?>
			<p class="hero__subheading"><?php echo wp_kses_post( $subheading ); ?></p>
			<?php endif; ?>

			<?php if ( ( $cta_primary_label && $cta_primary_url ) || ( $cta_secondary_label && $cta_secondary_url ) ) : ?>
			<div class="hero__cta-group">
				<?php if ( $cta_primary_label && $cta_primary_url ) : ?>
				<a href="<?php echo esc_url( $cta_primary_url ); ?>" class="bld-button btn btn--primary btn--large hero__cta-primary">
					<?php echo esc_html( $cta_primary_label ); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
				</a>
				<?php endif; ?>
				<?php if ( $cta_secondary_label && $cta_secondary_url ) : ?>
				<a href="<?php echo esc_url( $cta_secondary_url ); ?>" class="bld-button btn btn--outline btn--large hero__cta-secondary">
					<?php echo esc_html( $cta_secondary_label ); ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $trust_items ) ) : ?>
			<div class="hero__trust-strip" aria-label="<?php esc_attr_e( 'Trust indicators', 'bearlane' ); ?>">
				<?php foreach ( $trust_items as $i => $item ) : ?>
					<?php if ( $i > 0 ) : ?>
					<span class="hero__trust-sep" aria-hidden="true">·</span>
					<?php endif; ?>
					<span class="hero__trust-item">
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
						<?php echo esc_html( (string) ( $item['label'] ?? '' ) ); ?>
					</span>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

		</div>
	</div>

	<?php if ( ! empty( $stats ) ) : ?>
	<div class="hero__stats" aria-label="<?php esc_attr_e( 'Key statistics', 'bearlane' ); ?>">
		<div class="bld-container container">
			<div class="hero__stats-grid">
				<?php foreach ( $stats as $stat ) : ?>
				<div class="hero__stat">
					<span class="hero__stat-number"><?php echo esc_html( (string) ( $stat['number'] ?? '' ) ); ?></span>
					<span class="hero__stat-label"><?php echo esc_html( (string) ( $stat['label'] ?? '' ) ); ?></span>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="hero__scroll" aria-hidden="true">
		<span class="hero__scroll-line"></span>
	</div>

</section>

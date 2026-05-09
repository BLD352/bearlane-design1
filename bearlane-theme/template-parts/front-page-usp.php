<?php
/**
 * Template Part — Homepage USP Grid
 *
 * Driven by bearlane_sections → usp.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'usp' );

$heading    = (string) ( $content['heading'] ?? '' );
$subheading = (string) ( $content['subheading'] ?? '' );
$items      = (array)  ( $content['items'] ?? [] );

if ( empty( $items ) ) {
	return;
}
?>

<section class="bld-section section usp-section" aria-label="<?php esc_attr_e( 'Why BearLane', 'bearlane' ); ?>">
	<div class="bld-container container">

		<header class="section__header">
			<?php if ( $heading ) : ?>
			<h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
			<p class="section__subtitle"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
		</header>

		<div class="usp-grid usp-grid--6col">
			<?php foreach ( $items as $usp ) : ?>
			<div class="usp-item">
				<div class="usp-item__icon" aria-hidden="true">
					<?php echo bearlane_sanitize_inline_svg( (string) ( $usp['icon'] ?? '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php if ( ! empty( $usp['title'] ) ) : ?>
				<h3 class="usp-item__title"><?php echo esc_html( (string) $usp['title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $usp['desc'] ) ) : ?>
				<p class="usp-item__desc"><?php echo esc_html( (string) $usp['desc'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<?php
/**
 * Template Part — Frequently Asked Questions
 *
 * Driven by bearlane_sections → faq.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'faq' );

$eyebrow        = (string) ( $content['eyebrow'] ?? '' );
$heading        = (string) ( $content['heading'] ?? '' );
$subheading     = (string) ( $content['subheading'] ?? '' );
$items          = (array)  ( $content['items'] ?? [] );
$footer_text    = (string) ( $content['footer_text'] ?? '' );
$footer_label   = (string) ( $content['footer_button_label'] ?? '' );
$footer_url     = (string) ( $content['footer_button_url'] ?? '' );

if ( empty( $items ) ) {
	return;
}
?>

<section class="bld-section section faq-section" aria-label="<?php esc_attr_e( 'Frequently Asked Questions', 'bearlane' ); ?>">
	<div class="bld-container container">

		<header class="section__header">
			<?php if ( $eyebrow ) : ?>
			<div class="section__eyebrow bld-eyebrow"><?php echo wp_kses_post( $eyebrow ); ?></div>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
			<h2 class="section__title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
			<p class="section__subtitle"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
		</header>

		<div class="faq-accordion" role="list">
			<?php foreach ( $items as $i => $faq ) :
				$id       = 'faq-' . $i;
				$question = (string) ( $faq['question'] ?? '' );
				$answer   = (string) ( $faq['answer'] ?? '' );
				if ( ! $question ) { continue; }
			?>
			<div class="faq-item" role="listitem">
				<button class="faq-item__trigger js-faq-trigger"
					aria-expanded="false"
					aria-controls="<?php echo esc_attr( $id ); ?>"
					id="<?php echo esc_attr( $id . '-btn' ); ?>">
					<span class="faq-item__question"><?php echo esc_html( $question ); ?></span>
					<span class="faq-item__icon" aria-hidden="true">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
					</span>
				</button>
				<div class="faq-item__body"
					id="<?php echo esc_attr( $id ); ?>"
					role="region"
					aria-labelledby="<?php echo esc_attr( $id . '-btn' ); ?>"
					hidden>
					<div class="faq-item__answer"><?php echo wp_kses_post( wpautop( $answer ) ); ?></div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>

		<?php if ( $footer_text || $footer_label ) : ?>
		<div class="faq-footer">
			<?php if ( $footer_text ) : ?>
			<p class="faq-footer__text"><?php echo esc_html( $footer_text ); ?></p>
			<?php endif; ?>
			<?php if ( $footer_label && $footer_url ) : ?>
			<a href="<?php echo esc_url( $footer_url ); ?>" class="bld-button btn btn--outline">
				<?php echo esc_html( $footer_label ); ?>
			</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>
</section>

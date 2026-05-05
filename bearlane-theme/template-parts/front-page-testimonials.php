<?php
/**
 * Template Part — Homepage Testimonials
 *
 * Driven by bearlane_sections → testimonials.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'testimonials' );

$eyebrow     = (string) ( $content['eyebrow'] ?? '' );
$heading     = (string) ( $content['heading'] ?? '' );
$subheading  = (string) ( $content['subheading'] ?? '' );
$items       = (array)  ( $content['items'] ?? [] );
$footer_text = (string) ( $content['footer_text'] ?? '' );
$cta_label   = (string) ( $content['cta_label'] ?? '' );
$cta_url     = (string) ( $content['cta_url'] ?? '' );

if ( ! $cta_url && class_exists( 'WooCommerce' ) ) {
	$cta_url = wc_get_page_permalink( 'shop' );
}

if ( empty( $items ) ) {
	return;
}
?>

<section class="bld-section section testimonials-section" aria-label="<?php esc_attr_e( 'Customer Reviews', 'bearlane' ); ?>">
	<div class="bld-container container">

		<header class="section__header">
			<?php if ( $eyebrow ) : ?>
			<div class="section__eyebrow bld-eyebrow"><?php echo esc_html( $eyebrow ); ?></div>
			<?php endif; ?>
			<?php if ( $heading ) : ?>
			<h2 class="section__title"><?php echo wp_kses_post( $heading ); ?></h2>
			<?php endif; ?>
			<?php if ( $subheading ) : ?>
			<p class="section__subtitle"><?php echo esc_html( $subheading ); ?></p>
			<?php endif; ?>
		</header>

		<div class="testimonials-grid">
			<?php foreach ( $items as $t ) : ?>
			<?php
			$rating   = max( 0, min( 5, (int) ( $t['rating'] ?? 5 ) ) );
			$quote    = (string) ( $t['quote'] ?? '' );
			$name     = (string) ( $t['name'] ?? '' );
			$context  = (string) ( $t['context'] ?? '' );
			$initials = (string) ( $t['initials'] ?? '' );
			$image_id = (int)    ( $t['image'] ?? 0 );
			$image_url= $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : '';
			?>
			<blockquote class="testimonial-card">

				<div class="testimonial-card__stars" aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %d out of 5', 'bearlane' ), $rating ) ); ?>">
					<?php for ( $i = 0; $i < 5; $i++ ) : ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
						fill="<?php echo $i < $rating ? 'currentColor' : 'none'; ?>"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
						aria-hidden="true"
						class="star<?php echo $i < $rating ? ' star--filled' : ''; ?>">
						<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
					</svg>
					<?php endfor; ?>
				</div>

				<?php if ( $quote ) : ?>
				<p class="testimonial-card__quote">&ldquo;<?php echo esc_html( $quote ); ?>&rdquo;</p>
				<?php endif; ?>

				<footer class="testimonial-card__footer">
					<div class="testimonial-card__avatar" aria-hidden="true">
						<?php if ( $image_url ) : ?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="" loading="lazy">
						<?php else : ?>
							<?php echo esc_html( $initials ); ?>
						<?php endif; ?>
					</div>
					<div class="testimonial-card__meta">
						<?php if ( $name ) : ?>
						<cite class="testimonial-card__name"><?php echo esc_html( $name ); ?></cite>
						<?php endif; ?>
						<?php if ( $context ) : ?>
						<span class="testimonial-card__context"><?php echo esc_html( $context ); ?></span>
						<?php endif; ?>
					</div>
					<div class="testimonial-card__verified" aria-label="<?php esc_attr_e( 'Verified purchase', 'bearlane' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
						<?php esc_html_e( 'Verified', 'bearlane' ); ?>
					</div>
				</footer>

			</blockquote>
			<?php endforeach; ?>
		</div>

		<?php if ( $footer_text || $cta_label ) : ?>
		<div class="testimonials-cta">
			<?php if ( $footer_text ) : ?>
			<p class="testimonials-cta__text">
				<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
				<?php echo esc_html( $footer_text ); ?>
			</p>
			<?php endif; ?>
			<?php if ( $cta_label && $cta_url ) : ?>
			<a href="<?php echo esc_url( $cta_url ); ?>" class="bld-button btn btn--outline">
				<?php echo esc_html( $cta_label ); ?>
			</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div>
</section>

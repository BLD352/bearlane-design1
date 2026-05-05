<?php
/**
 * Template Part — Email Capture Section
 *
 * Driven by bearlane_sections → email_capture.
 *
 * @package BearLane
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$content = bearlane_current_section_content( 'email_capture' );

$eyebrow       = (string) ( $content['eyebrow'] ?? '' );
$heading       = (string) ( $content['heading'] ?? '' );
$description   = (string) ( $content['description'] ?? '' );
$benefits      = (array)  ( $content['benefits'] ?? [] );
$name_ph       = (string) ( $content['name_placeholder'] ?? '' );
$email_ph      = (string) ( $content['email_placeholder'] ?? '' );
$submit_label  = (string) ( $content['submit_label'] ?? '' );
$privacy_note  = (string) ( $content['privacy_note'] ?? '' );
?>

<section class="bld-section section email-capture-section" aria-label="<?php esc_attr_e( 'Sign up for offers', 'bearlane' ); ?>">
	<div class="bld-container container">
		<div class="email-capture-inner">

			<div class="email-capture__text">
				<?php if ( $eyebrow ) : ?>
				<div class="section__eyebrow bld-eyebrow section__eyebrow bld-eyebrow--accent"><?php echo esc_html( $eyebrow ); ?></div>
				<?php endif; ?>
				<?php if ( $heading ) : ?>
				<h2 class="email-capture__title"><?php echo esc_html( $heading ); ?></h2>
				<?php endif; ?>
				<?php if ( $description ) : ?>
				<p class="email-capture__desc"><?php echo esc_html( $description ); ?></p>
				<?php endif; ?>
				<?php if ( ! empty( $benefits ) ) : ?>
				<ul class="email-capture__benefits" role="list">
					<?php foreach ( $benefits as $benefit ) : ?>
					<li>
						<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
						<?php echo esc_html( (string) ( $benefit['label'] ?? '' ) ); ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>

			<div class="email-capture__form-wrap">
				<form class="email-capture-form newsletter-form" method="post" novalidate
					aria-label="<?php esc_attr_e( 'Email signup form', 'bearlane' ); ?>">

					<div class="email-capture-form__row">
						<div class="email-capture-form__field">
							<label for="email-capture-name" class="screen-reader-text">
								<?php esc_html_e( 'Your first name', 'bearlane' ); ?>
							</label>
							<input type="text"
								id="email-capture-name"
								name="first_name"
								class="email-capture-form__input"
								placeholder="<?php echo esc_attr( $name_ph ); ?>"
								autocomplete="given-name">
						</div>
						<div class="email-capture-form__field">
							<label for="email-capture-email" class="screen-reader-text">
								<?php esc_html_e( 'Your email address', 'bearlane' ); ?>
							</label>
							<input type="email"
								id="email-capture-email"
								name="email"
								class="email-capture-form__input newsletter-form__input"
								placeholder="<?php echo esc_attr( $email_ph ); ?>"
								required
								autocomplete="email">
						</div>
					</div>

					<?php if ( $submit_label ) : ?>
					<button type="submit" class="bld-button btn btn--primary btn--full newsletter-form__btn">
						<?php echo esc_html( $submit_label ); ?>
					</button>
					<?php endif; ?>

					<?php if ( $privacy_note ) : ?>
					<p class="email-capture-form__privacy">
						<?php echo esc_html( $privacy_note ); ?>
					</p>
					<?php endif; ?>

				</form>
			</div>

		</div>
	</div>
</section>

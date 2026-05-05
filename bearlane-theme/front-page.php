<?php
/**
 * BearLane Design — Front Page
 *
 * Shown when Reading Settings → "Front page displays" is set to a
 * static page. The section order, visibility, and content are all
 * driven by Appearance → Homepage Sections. Zero content is hardcoded
 * here.
 *
 * Override order of precedence:
 *   1. If the static front page is edited with Elementor, Elementor's
 *      canvas template handles rendering via elementor/theme/get_location
 *      (see inc/elementor-compat.php) — this file's sections loop is
 *      skipped automatically.
 *   2. Otherwise, if the static front page contains block editor
 *      content (non-empty post_content), we render those blocks
 *      below the section loop — allowing a Gutenberg-first workflow
 *      that adds custom layouts below the managed sections.
 *   3. Otherwise, we loop through bearlane_sections_active_ids() and
 *      render each enabled section in saved order.
 *
 * @package BearLane
 */

get_header();

/**
 * Allow Elementor (or any page builder) to fully take over. When a
 * page builder declares it is rendering this request, we skip the
 * managed section loop entirely.
 */
$builder_takeover = apply_filters( 'bearlane_front_page_builder_takeover', false );
?>

<main id="site-content" class="front-page bld-homepage">

	<?php if ( $builder_takeover ) : ?>

		<?php
		// Builder owns the page — render its content only.
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				the_content();
			endwhile;
		endif;
		?>

	<?php else : ?>

		<?php
		/**
		 * Managed section loop.
		 *
		 * bearlane_sections_active_ids() returns an ordered list of
		 * section IDs that are both in the registry AND enabled. The
		 * renderer defers to a tiny dispatcher so third parties can
		 * swap any section's output via the bearlane_render_section_{id}
		 * action.
		 */
		$active_ids = bearlane_sections_active_ids();

		foreach ( $active_ids as $section_id ) {
			bearlane_render_section( $section_id );
		}
		?>

		<?php
		/**
		 * Optional Gutenberg / post_content below the managed sections.
		 * This lets editors add custom blocks under the last section
		 * without leaving the block editor.
		 */
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				if ( get_the_content() ) :
					?>
					<section class="front-page__content container">
						<?php the_content(); ?>
					</section>
					<?php
				endif;
			endwhile;
		endif;
		?>

	<?php endif; ?>

</main>

<?php get_footer(); ?>

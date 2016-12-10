<?php
/**
 * Taxonomy Languages Selector Field.
 *
 * @link       https://github.com/brenoalvs/monk
 * @since      1.0.0
 *
 * @package    Monk
 * @subpackage Monk/Admin/Partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! isset( $_GET['monk_term_id'] ) ) {
	?>
	<div class="form-field term-language-wrap">
		<label for="monk-language"><?php esc_html_e( 'Language', 'monk' ); ?></label>
		<select class="postform" id="monk-language" name="monk-language">
			<?php foreach ( $languages as $language ) : ?>
				<option value="<?php echo esc_attr( $language ); ?>" <?php selected( $default_language, $language ); ?>><?php echo esc_html( $monk_languages[ $language ]['name'] ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php
} else {
	$monk_term_translations = get_option( 'monk_term_translations_' . $_GET['monk_term_id'], false );

	if ( isset( $_GET['translation_lang'] ) ) {
		$translation_lang = sanitize_text_field( wp_unslash( $_GET['translation_lang'] ) );
	} else {
		$translation_lang = $default_language;
	}

	$monk_term_translations_id = sanitize_text_field( wp_unslash( $_GET['monk_term_id'] ) );

	?>
	<div class="form-field term-language-wrap">
		<label for="monk-language"><?php esc_html_e( 'Language', 'monk' ); ?></label>
		<input type="hidden" name="monk_term_id" value="<?php echo esc_attr( $monk_term_translations_id ); ?>">
		<select class="postform" id="monk-language" name="monk-language">
			<?php foreach ( $languages as $language ) :
				if ( ! array_key_exists( $language, $monk_term_translations ) ) :
			?>
				<option value="<?php echo esc_attr( $language ); ?>" <?php selected( $translation_lang, $language ); ?>><?php echo esc_html( $monk_languages[ $language ]['name'] ); ?></option>
			<?php endif; endforeach; ?>
		</select>
	</div>

	<?php
}

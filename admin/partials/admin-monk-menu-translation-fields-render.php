<?php
/**
 * Provide the view for the monk_add_menu_translation_fields function
 *
 * @since      0.3.0
 *
 * @package    Monk
 * @subpackage Monk/Admin/Partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$monk_languages = monk_get_available_languages();
?>
<!-- The button to create a new translation -->
<span class="hide-if-no-js add-menu-translation">
	<?php if ( $menu_language ) : ?>
		<?php if ( count( $active_languages ) !== $translation_counter ) : ?>
			<a href="<?php echo esc_url( $new_translation_url ); ?>" class="button"><?php esc_html_e( 'Add translation +', 'monk' ); ?></a>
		<?php else : ?>
			<?php esc_html_e( 'No more languages available.', 'monk' ); ?>
		<?php endif; ?>
	<?php else : ?>
		<select name="monk_language" id="menu-language">
			<?php foreach ( $active_languages as $locale ) : ?>
				<?php if ( ! array_key_exists( $locale, $menu_translations ) ) : ?>
				<option value="<?php echo esc_html( $locale ); ?>"><?php echo esc_html( $monk_languages[ $locale ]['english_name'] ); ?></option>
			<?php
				endif;
				endforeach;
			?>
		</select>
	<?php endif; ?>
</span>
<?php if ( 0 !== count( $menu_translations ) ) : ?>
<!-- The select element with the available languages to choose from -->
<fieldset class="hide-if-no-js menu-settings-group menu-language">
	<legend class="menu-settings-group-name howto">Language</legend>
	<div class="menu-settings-input">
		<?php if ( empty( $menu_language ) ) : ?>
			<select name="monk_language" id="menu-language">
			<?php foreach ( $active_languages as $locale ) : ?>
				<?php if ( ! array_key_exists( $locale, $menu_translations ) ) : ?>
				<option value="<?php echo esc_html( $locale ); ?>"><?php echo esc_html( $monk_languages[ $locale ]['english_name'] ); ?></option>
			<?php
				endif;
				endforeach;
			?>
			</select>
		<?php else : ?>
			<span class="menu-flag flag-icon flag-icon-<?php echo esc_attr( strtolower( $menu_language ) ); ?>"></span>
			<span><?php echo esc_html( $monk_languages[ $menu_language ]['english_name'] ); ?></span>
			<input type="hidden" name="monk_language" value="<?php echo esc_attr( $menu_language ); ?>">
		<?php endif; ?>
	</div>
</fieldset>
<!-- A list with the selected menu translations -->
<div class="hide-if-no-js menu-translations">
	<h3><?php esc_html_e( 'Menu Translations', 'monk' ); ?></h3>
	<?php if ( 1 === count( $menu_translations ) ) : ?>
	<p>
		<?php esc_html_e( 'This menu does not have translations. ', 'monk' ); ?>
		<a href="<?php echo esc_url( $new_translation_url ); ?>">
			<?php esc_html_e( 'You can add one here. ', 'monk' ); ?>
		</a>
	</p>
	<?php else : ?>
	<ul class="current-menu-translations">
		<?php foreach ( $menu_translations as $locale => $id ) : ?>
			<?php if ( $locale !== $menu_language ) : ?>
				<li>
					<a href="<?php echo esc_url( admin_url( 'nav-menus.php?action=edit&menu=' . $id ) ); ?>">
						<?php echo esc_html( $monk_languages[ $locale ]['english_name'] ); ?>
					</a>
				</li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>
<?php endif; ?>
<?php

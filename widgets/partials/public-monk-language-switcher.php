<?php
/**
 * Monk Language Switcher.
 *
 * @since      0.1.0
 *
 * @package    Monk
 * @subpackage Monk/Widgets/Partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

foreach ( $switchable_languages as $code => $name ) {
	if ( $monk_languages[ $code ]['slug'] === $current_language ) {
		$current_language = $code;
		$current_slug = $monk_languages[ $code ]['slug'];
	}
}

echo $args['before_widget'];
?>
	<?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
	<div id="monk-language-switcher">
		<div class="monk-current-lang">
			<span class="monk-dropdown-arrow"></span>
			<span class="monk-current-lang-name">
					<?php if ( ! $flag ) : ?>
						<span class="monk-language-flag flag-icon <?php echo esc_attr( 'flag-icon-' . $current_slug ); ?>"></span>
					<?php endif; ?>
						<span class="monk-language-name"><?php echo esc_html( $monk_languages[ $current_language ]['native_name'] ); ?></span>
			</span>
		</div>
		<ul class="monk-language-dropdown">
			<?php foreach ( $switchable_languages as $code => $url ) : ?>
				<?php if ( $monk_languages[ $current_language ]['native_name'] !== $monk_languages[ $code ]['native_name'] ) : ?>
					<li class="monk-lang">
						<a class="monk-language-link" href="<?php echo esc_url( $url ); ?>">
							<?php if ( ! $flag ) : ?>
								<span class="monk-language-flag flag-icon <?php echo esc_attr( 'flag-icon-' . $monk_languages[ $code ]['slug'] ) ?>"></span>
							<?php endif; ?>
								<span class="monk-language-name"><?php echo esc_html( $monk_languages[ $code ]['native_name'] ); ?></span>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php echo $args['after_widget']; ?>

<?php

/**
 * Provide the view for the monk_post_meta_box_field_render function
 *
 * @link       https://github.com/brenoalvs/monk
 * @since      1.0.0
 *
 * @package    Monk
 * @subpackage Monk/Admin/Partials
 */

	if ( empty( $monk_id ) ) {
		if ( isset( $_GET['lang'] ) && isset( $_GET['monk_id'] ) ) {
			$lang    = $_GET['lang'];
			$monk_id = $_GET['monk_id'];
		} else {
			$lang    = $site_default_language;
			$monk_id = $post->ID;
		}
	}
?>
<input type="hidden" name="monk_id" value="<?php echo $monk_id; ?>" />
	<?php if ( $current_screen->action == 'add' || $post_default_language == '' ) : ?>
	<div>
		<h4><?php _e( 'Default post language', 'monk' ); ?></h4>
		<p>
			<select name="monk_post_language">
			<?php
				foreach ( $active_languages as $lang_code ) :
					if ( array_key_exists( $lang_code, $monk_languages ) ) :
						$lang_name = $monk_languages[$lang_code]['name'];
			?>
				<option value="<?php echo esc_attr( $lang_code ); ?>" <?php selected( $lang, $lang_code ); ?>>
					<?php echo esc_html( $lang_name ); ?>
				</option>
			<?php endif; endforeach; ?>
			</select>
		</p>
	</div>
	<?php else : 
		$translation_counter = 0;
		$option_current_name = 'monk_post_translations_' . $monk_id;
		$post_translations   = get_option( $option_current_name );
		foreach ($active_languages as $code ) {
			if ( $post_translations && array_key_exists( $code , $post_translations ) ) {
				$translation_counter = $translation_counter + 1;
			}
		}
	?>
	<input type="hidden" name="monk_post_language" value="<?php echo esc_attr( $post_default_language ); ?>">
	<div class="monk-post-meta-text">
		<label for="monk-post-add-translation"><?php _e( 'Translations', 'monk' ); ?></label>
		<?php if ( $translation_counter !== count( $active_languages ) ) : ?>
		<a class="edit-post-status hide-if-no-js">
			<span aria-hidden="true" class="monk-add-translation">
				Add<strong>+</strong>
			</span>
			<span class="screen-reader-text"><?php _e( 'Add new translation', 'monk' ); ?></span>
		</a>
		<?php endif; ?>
	</div>
	<div class="monk-post-meta-add-translation">
		<?php if ( $translation_counter !== count( $active_languages ) ) : ?>
			<select name="monk_post_translation_id">
				<?php
					foreach ( $active_languages as $lang_code ) :
						$encoded_url = add_query_arg( array(
								'lang'    => $lang_code,
								'monk_id' => $monk_id
							), $monk_translation_url );
						$lang_id = sanitize_title( $lang_code );
						if ( array_key_exists( $lang_code, $monk_languages ) && ! array_key_exists( $lang_code, $post_translations ) ) :
							$lang_name = $monk_languages[$lang_code]['name'];
				?>
						<option  value="<?php echo esc_url( $encoded_url ); ?>"/>
							<?php echo esc_html( $lang_name ); ?>
						</option>
				<?php endif; endforeach; ?>
			</select>
			<button class="monk-submit-translation button"><?php esc_html_e( 'Ok', 'monk' ); ?></button>
			<a class="monk-cancel-submit-translation hide-if-no-js button-cancel"><?php esc_html_e( 'Cancel', 'monk' ); ?></a>
		<?php endif; ?>
	</div>
	<ul class="monk-translated-to">
		<li>
			<?php echo esc_html( $monk_languages[$post_default_language]['name'] ); ?>

			<!-- 
				Gives the option to alter the current post language
				When the user select this feature,
				the option containig translations is updated
			-->
			<a class="edit-post-status hide-if-no-js">
				<span aria-hidden="true" class="monk-change-language">
					<?php esc_html_e( 'Change', 'monk' ); ?>
				</span>
				<span class="screen-reader-text"><?php esc_html_e( 'Change current language', 'monk' ); ?></span>
			</a>
			<div class="monk-change-current-language">
				<?php if ( $translation_counter !== count( $active_languages ) ) : ?>
					<select name="monk_new_language">
						<option value=""><?php esc_html_e( 'Choose language', 'monk' ); ?></option>
						<?php
							foreach ( $active_languages as $lang_code ) :
								if ( array_key_exists( $lang_code, $monk_languages ) && ! array_key_exists( $lang_code, $post_translations ) ) :
									$lang_name = $monk_languages[$lang_code]['name'];
						?>
								<option  value="<?php echo esc_attr( $lang_code ); ?>"/>
									<?php echo esc_html( $lang_name ); ?>
								</option>
						<?php endif; endforeach; ?>
					</select>
					<button class="button"><?php esc_html_e( 'Ok', 'monk' ); ?></button>
					<a class="monk-cancel-language-change hide-if-no-js button-cancel"><?php esc_html_e( 'Cancel', 'monk' ); ?></a>
				<?php endif; ?>
			</div>
		</li>
		<?php
		if ( isset( $post_translations ) && $post_translations ) :
			foreach ( $post_translations as $lang_code => $monk_id ) :
				if ( $monk_id != $post->ID ) :
					$encoded_url = get_edit_post_link( $monk_id ); ?>
					<li>
						<a href="<?php echo esc_url( $encoded_url) ; ?>"><?php esc_html_e( $monk_languages[$lang_code]['name'] ); ?></a>
					</li>
		<?php 	
				endif;
			endforeach;
		endif;
		if ( isset( $post_translations ) && count( $post_translations ) == 1 ) : ?>
			<span class="monk-add-translation">
				<?php _e( 'Not translated, add one', 'monk' ); ?>
			</span>
		<?php endif; ?>
	</ul>
<?php
endif;

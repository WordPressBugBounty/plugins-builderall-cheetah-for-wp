<select name="<?php echo esc_attr($name); ?>_matching">
	<?php /* translators: %s: an object like posts or taxonomie */ ?>
	<option value="1" <?php selected( $settings->{ $name . '_matching' }, '1' ); ?>><?php printf( _x( 'Match these %s...', '%s is an object like posts or taxonomies.', 'ba-cheetah' ), esc_html($label) ); ?></option>
	<?php /* translators: %s: an object like posts or taxonomie */ ?>
	<option value="0" <?php selected( $settings->{ $name . '_matching' }, '0' ); ?>><?php printf( _x( 'Match all %s except...', '%s is an object like posts or taxonomies.', 'ba-cheetah' ), esc_html($label) ); ?></option>
	<?php if ( 'ba_cheetah_as_terms' === $field['action'] ) : ?>
		<?php /* translators: %s: an object like posts or taxonomie */ ?>
		<option value="related" <?php selected( $settings->{ $name . '_matching' }, 'related' ); ?>><?php printf( _x( 'Match all related %s except...', '%s is an object like posts or taxonomies.', 'ba-cheetah' ), esc_html($label) ); ?></option>
	<?php endif; ?>
</select>

<div id="ba-cheetah-settings-section-general" class="ba-cheetah-settings-section">
	<div class="ba-cheetah-settings-section-content">
		<table class="ba-cheetah-form-table">
			<tr id="ba-cheetah-field-sidebar" class="ba-cheetah-field" data-type="select" data-preview='{"type":"refresh"}'>
				<th>
					<label for="sidebar"><?php _e( 'Sidebar', 'ba-cheetah' ); ?></label>
				</th>
				<td>
					<select name="sidebar">
						<?php foreach ( BACheetahModel::get_wp_sidebars() as $sidebar ) : ?>
						<option value="<?php echo esc_attr($sidebar['id']); ?>"<?php echo ( isset( $settings->sidebar ) && $settings->sidebar == $sidebar['id'] ) ? ' selected="selected"' : ''; ?>><?php echo esc_html($sidebar['name']); ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
		</table>
	</div>
</div>

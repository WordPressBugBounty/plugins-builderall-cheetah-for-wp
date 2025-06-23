<div id="ba-cheetah-integrations-form" class="ba-cheetah-settings-form">

	<!-- 
		Form
	-->

	<form id="integrations-form" action="<?php BACheetahAdminSettings::render_form_action( 'integrations' ); ?>" method="post">
			
		<!-- 
			Wathermark
		-->
		
		<?php 
		
		if (BACheetahAuthentication::is_builderall_user()) :
			echo '<h3 class="ba-cheetah-settings-form-header">' . __('Builderall', 'ba-cheetah') . '</h3>';
			$watermark = get_option( '_ba_cheetah_watermark', array('show' => false, 'position' => 'left') );
		?>
		<table class="form-table">
			<tr>
				<td>
					<label for="ba-cheetah-show-watermark">
					<input type="checkbox" name="ba-cheetah-show-watermark" id="ba-cheetah-show-watermark" value="1" <?php echo checked($watermark['show'], true) ?> /> 
						<?php echo __('Show Watermark', 'ba-cheetah'); ?>
					</label>
				</td>
				<td>
					<label for="ba-cheetah-watermark-position"><?php echo __('Position', 'ba-cheetah'); ?>:</label>
					<select name="ba-cheetah-watermark-position" id="ba-cheetah-watermark-position">
						<option value="left" <?php echo selected($watermark['position'], 'left') ?>><?php echo __('Left', 'ba-cheetah'); ?></option>
						<option value="right" <?php echo selected($watermark['position'], 'right')?>><?php echo __('Right', 'ba-cheetah'); ?></option>
					</select>
				</td>
			</tr>
		</table>
		<hr>

		<?php endif;?>

		<!-- 
			Buttons
		-->



		<!-- 
			Recaptcha
		-->

		<h3 class="ba-cheetah-settings-form-header"><?= __('Google Recaptcha', 'ba-cheetah'); ?></h3>

		<section class="ba-cheetah-admin-form-section">
			<p><?php echo __('Enter your Recaptcha keys to enable it in Mailingboss.', 'ba-cheetah')?></p>
			
			<fieldset>
				<label for="recaptcha_sitekey">Site Key</label>
				<input name="recaptcha_sitekey" minlength="20" id="recaptcha_sitekey" type="text" value="<?php echo get_option('_ba_cheetah_recaptcha_sitekey', '') ?>" placeholder="YOUR_SITE_KEY" class="regular-text code">
			</fieldset>
			<fieldset>
				<label for="recaptcha_secretkey">Secret Key</label>
				<input name="recaptcha_secretkey" minlength="20" id="recaptcha_secretkey" type="text" value="<?php echo get_option('_ba_cheetah_recaptcha_secretkey', '') ?>" placeholder="YOUR_SECRET_KEY" class="regular-text code">
			</fieldset>

			<a href="https://www.google.com/recaptcha/admin/create" target="_blank">
				<?php echo __('Get Keys', 'ba-cheetah') ?>
			</a>
		</section>

		<hr>

		<!-- 
			Pixel
		-->

		<h3 class="ba-cheetah-settings-form-header"><?= __('Facebook Pixel', 'ba-cheetah'); ?></h3>

		<section class="ba-cheetah-admin-form-section">
			<p><?php echo __('After entering the Facebook Pixel ID, it will run on all pages built with Builderall Builder. You can disable this for each page or add custom events in page settings and click events.', 'ba-cheetah'); ?></p>

			<fieldset>
				<label for="pixel_id">Pixel ID</label>
				<input name="pixel_id" minlength="10" pattern="[0-9]+" id="pixel_id" type="text" value="<?php echo get_option('_ba_cheetah_facebook_pixel_id', '') ?>" class="regular-text code" placeholder="PIXEL_ID">
			</fieldset>

			<a href="https://www.facebook.com/events_manager2" target="_blank">
				<?php echo __('Get My Pixel ID', 'ba-cheetah') ?>
			</a>
		</section>

		<!-- 
			Submit
		-->

		<p class="submit">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'ba-cheetah' ); ?>" />
			<?php wp_nonce_field( 'ba-integrations', 'ba-cheetah-integrations-config-nonce' ); ?>
		</p>
	</form>
	
</div>

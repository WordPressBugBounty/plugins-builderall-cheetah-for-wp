<div id="ba-cheetah-account-form" class="ba-cheetah-settings-form">
	<?php
	$user = BACheetahAuthentication::user();

	$showLinkButton = $showUnlinkButton = false;
	if ($user) {
		$showUnlinkButton = true;
	}
	else {
		$showLinkButton = true;
	}
	?>
	<!-- 
		Form
	-->

	<form id="account-form" class="ba-ai-center" action="<?php BACheetahAdminSettings::render_form_action( 'account' ); ?>" method="post">
		<div class="supercharge-account-panel ba-font-syne ba-font-29 ba-font-extrabold">
            <?php _e('Websites, Emails, Courses, Funnels, Chatbots.', 'ba-cheetah') ?>
            <?php _e('Get Everything You Need in One Platform', 'ba-cheetah') ?>
		</div>
		<div>
			<div class="ba-jc-center ba-mg-t-1 ba-text-ai-center">
                <?php if ($user) : ?>
                    <?php printf(__('Your account %s is already connected!', 'ba-cheetah'), $user['email']) ?>
                <?php else: ?>
                     <span class="ba-w-70"> <?php _e('Link your Builderall for WordPress with your Builderall account to unlock integrations with Booking, Supercheckout, Mailingboss and more!', 'ba-cheetah')?> </span> 
                <?php endif ?>
			</div>			
		</div>

		<div class="ba-text-ai-center ba-text-width ba-mg-t-1 supercharge-buttons ba-jc-center ba-ai-center">
			<?php if ($showLinkButton) : ?>
				<a href="<?= get_rest_url(null, 'ba-cheetah/v1/oauth/redirect'); ?>">
					<?= __('LINK BUILDERALL ACCOUNT', 'ba-cheetah'); ?>
				</a>
			<?php endif; ?>
			<?php if ($showUnlinkButton) : ?>
				<a href="<?= get_rest_url(null, 'ba-cheetah/v1/oauth/logout'); ?>" class="unlink" onclick="return confirm('<?= __('By unlinking your account you will lose access to all Builderall Integrations, do you want to continue?', 'ba-cheetah'); ?>')"><?= __('UNLINK MY BUILDERALL ACCOUNT', 'ba-cheetah'); ?></a>
			<?php endif; ?>
			<?php if ($showLinkButton) : ?>
				<div class="ba-font-syne ba-font-21 ba-font-bold">
				    <?php _e('OR') ?> 
			    </div>
				<a href="https://checkout.builderall.com/plans?utm_source=wordpress&utm_medium=WordpressPlugin&utm_campaign=newaccount" target="_blank" rel="noopener noreferrer"><?php _e('NEW ACCOUNT', 'ba-cheetah') ?></a>
			<?php endif; ?>
		</div>
		<p class="submit" style="display: none;">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'ba-cheetah' ); ?>" />
			<?php wp_nonce_field( 'ba-supercharge', 'ba-cheetah-supercharge-nonce' ); ?>
		</p>
	</form>
	
</div>
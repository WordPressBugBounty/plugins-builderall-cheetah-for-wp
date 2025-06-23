<div id="ba-cheetah-supercharge-form" class="ba-cheetah-settings-form">

	<?php
	$user = BACheetahAuthentication::user();
	$showLinkButton = true;
	if ($user) {
		$showLinkButton = false;
	} else {
		$showLinkButton = true;
	}
	?>

	<!-- 
		Form
	-->

	<form id="supercharge-form" class="ba-ai-center" action="<?= admin_url('admin.php?page=supercharge-bundle') ?>" method="post">
		<div class="supercharge-panel">
			<img id="supercharge-logo" src="<?php echo BA_CHEETAH_URL . 'img/supercharge/supercharge-logo.svg'; ?>" />
			<img id="supercharge-title" src="<?php echo BA_CHEETAH_URL . 'img/supercharge/supercharge-title.svg'; ?>" />
		</div>
		<div>
			<div class="ba-jc-center ba-mg-t-1 ba-font-syne ba-font-21 ba-font-bold">
				<?php _e('One Line of Code. 5 Tools. Any Platform.') ?>
			</div>
			<div class="ba-text-ai-center ba-mg-t-1 ba-jc-center">
				<span class="ba-tooltip">
					<div class="ba-switch-box">
						<span class="supercharge-status">
							<?php
							if (get_option('_ba_cheetah_supercharge_enabled') == true) {
								_e('Active');
							} else {
								_e('Inactive');
							}
							?>
						</span>
						<!-- <div id="nav-menu-bulk-actions-top" class="bulk-actions" <?php echo $hide_style; ?>>
					<label class="bulk-select-button" for="bulk-select-switcher-top">
						<input type="checkbox" id="bulk-select-switcher-top" name="bulk-select-switcher-top" class="bulk-select-switcher">
						<span class="bulk-select-button-label" 
						title="<?php _e('This is a PRO Element', 'ba-cheetah'); ?>"
						><?php _e('Bulk Select'); ?></span>
					</label>
				</div>				 -->
						<?php
						$supercharge_enabled = get_option('_ba_cheetah_supercharge_enabled', false);
						?>
						<label class="ba-switch">
							<input type="checkbox" name="ba-cheetah-supercharge-enabled" value="1" <?php echo checked($supercharge_enabled, true); ?>
								<?php echo !$user ? 'disabled' : ''; ?> id="ba-cheetah-supercharge-enabled"> <span class="ba-slider"></span>
						</label>
							<?php if ( ! $supercharge_enabled ) : ?>
								<span class="ba-tooltip-text">
									<?php _e( 'To activate the bundle, link your Builderall Account OR Sign up.', 'ba-cheetah' ); ?>
								</span>
							<?php endif; ?>
						</span>
					</div>
				</span>

			</div>


		</div>
		<div class="ba-text-ai-center ba-text-width ba-mg-t-1">
			<p><?php _e('Designed for the entrepreneuers looking for supercharge their website, the Builderall Supercharge Bundle offers a selection of essential tools that enhance user engagement and drive conversions on any platform.')  ?>
			</p>
			<p>
				<?php if (!$supercharge_enabled) {
					_e('With just one line of code added to any website, on any platform, you get easy acess to this powerful set of tools that will Boost your conversions and supercharge your business!');
				}
				?>
			</p>
		</div>
		<?php if ($showLinkButton) : ?>
			<div class="supercharge-buttons ba-jc-center ba-ai-center">
				<a href="https://checkout.builderall.com/plans" target="_blank" rel="noopener noreferrer"><?php _e( 'NEW ACCOUNT', 'ba-cheetah' ); ?></a>
				<div class="ba-font-syne ba-font-21 ba-font-bold">
					<?php _e('OR') ?>
				</div>
				<?php if ($showLinkButton) : ?>
					<a href="<?= get_rest_url(null, 'ba-cheetah/v1/oauth/redirect'); ?>">
						<?= __('LINK BUILDERALL ACCOUNT', 'ba-cheetah'); ?>
					</a>
				<?php endif; ?>
			</div>

		<?php endif ?>
			<?php if ($supercharge_enabled == true) : ?>
			<div class="ba-cheetah--supercharge-bundle-panel">
				<div class="supercharge-card-content">
					<div class="tool-card">
						<div class="tool-top">
							<span><?php _e( 'Exit Intent Popup', 'ba-cheetah' ); ?></span>
						</div>
						<div class="card-container">
							<div class="tool-card-content">
								<div class="tool-card-description">
									<span><?php _e( 'Offer exclusive deals and content to keep them wanting more.', 'ba-cheetah' ); ?></span>
								</div>
								<div class="icon">
									<img src="<?php echo BA_CHEETAH_URL . 'img/supercharge/exit-popup.svg'; ?>">
								</div>
							</div>
							<div class="tool-card-footer">
							<?php
							echo sprintf(
								'<a href="%s" class="tool-card-link">
										<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
											<path d="M12.2989 7.79853C12.0493 7.61548 11.9002 7.32147 11.9002 7.01171C11.9002 6.70195 12.0493 6.40794 12.2985 6.22524L13.4514 5.37996C13.6352 5.24486 13.7111 5.0072 13.6394 4.79055C13.3426 3.89872 12.8732 3.0853 12.2439 2.37233C12.0923 2.20153 11.848 2.14763 11.6391 2.23933L10.3409 2.81019C10.0581 2.9348 9.72873 2.91695 9.46028 2.76189C9.19217 2.60719 9.01226 2.33138 8.97831 2.02372L8.82221 0.598484C8.79736 0.371678 8.62865 0.186872 8.40535 0.141021C7.49637 -0.0448339 6.5412 -0.0479838 5.61612 0.137521C5.39142 0.182672 5.22236 0.367478 5.19751 0.595334L5.04281 2.01147C5.00886 2.31948 4.82895 2.59529 4.56014 2.74999C4.29204 2.9047 3.96373 2.92325 3.67987 2.79829L2.37468 2.22428C2.16748 2.13258 1.92247 2.18578 1.77092 2.35623C1.1395 3.0664 0.668037 3.87877 0.368078 4.7699C0.295276 4.9862 0.370878 5.22526 0.555333 5.36071L1.70091 6.20074C1.95082 6.38414 2.09993 6.67815 2.09993 6.98791C2.09993 7.29767 1.95082 7.59168 1.70161 7.77438L0.548683 8.61965C0.364928 8.75476 0.288976 8.99241 0.360728 9.20907C0.657536 10.1009 1.1269 10.9143 1.75622 11.6273C1.90777 11.7984 2.15278 11.8527 2.36103 11.7603L3.65922 11.1894C3.94203 11.0648 4.27103 11.0827 4.53984 11.2377C4.80795 11.3924 4.98785 11.6682 5.02181 11.9759L5.17791 13.4011C5.20276 13.6279 5.37147 13.8127 5.59477 13.8586C6.05468 13.9524 6.5272 14 7.00006 14C7.46137 14 7.92688 13.9534 8.38365 13.8617C8.60835 13.8166 8.77741 13.6318 8.80226 13.4039L8.95731 11.9878C8.99126 11.6798 9.17117 11.404 9.43998 11.2493C9.70808 11.0949 10.0367 11.0767 10.3203 11.201L11.6254 11.775C11.8333 11.867 12.0776 11.8138 12.2292 11.643C12.8606 10.9329 13.3321 10.1205 13.632 9.22937C13.7048 9.01306 13.6292 8.77401 13.4448 8.63855L12.2989 7.79853ZM7.00006 9.44988C5.64692 9.44988 4.54999 8.35295 4.54999 6.99981C4.54999 5.64667 5.64692 4.54974 7.00006 4.54974C8.3532 4.54974 9.45013 5.64667 9.45013 6.99981C9.45013 8.35295 8.3532 9.44988 7.00006 9.44988Z" fill="white" />
										</svg>
									<span>%s</span></a>',
								admin_url('edit.php?post_type=ba-cheetah-popup'),
								__('Configure', 'ba-cheetah')
							  );
							  
							?>
							</div>
						</div>
					</div>
				</div>
				<div class="supercharge-card-content">
					<div class="tool-card">
						<div class="tool-top">
							<span><?php _e( 'Social Proof', 'ba-cheetah' ); ?></span>
						</div>
						<div class="card-container">
							<div class="tool-card-content">
								<div class="tool-card-description">
									<span><?php _e( 'Show real-time customer activity to build trust instantly.', 'ba-cheetah' ); ?></span>
								</div>
								<div class="icon">
									<img src="<?php echo BA_CHEETAH_URL . 'img/supercharge/proof.svg'; ?>">
								</div>
							</div>
							<div class="tool-card-footer">
								<a href="https://office.builderall.com/br/office/new-social-proof" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
										<path d="M12.2989 7.79853C12.0493 7.61548 11.9002 7.32147 11.9002 7.01171C11.9002 6.70195 12.0493 6.40794 12.2985 6.22524L13.4514 5.37996C13.6352 5.24486 13.7111 5.0072 13.6394 4.79055C13.3426 3.89872 12.8732 3.0853 12.2439 2.37233C12.0923 2.20153 11.848 2.14763 11.6391 2.23933L10.3409 2.81019C10.0581 2.9348 9.72873 2.91695 9.46028 2.76189C9.19217 2.60719 9.01226 2.33138 8.97831 2.02372L8.82221 0.598484C8.79736 0.371678 8.62865 0.186872 8.40535 0.141021C7.49637 -0.0448339 6.5412 -0.0479838 5.61612 0.137521C5.39142 0.182672 5.22236 0.367478 5.19751 0.595334L5.04281 2.01147C5.00886 2.31948 4.82895 2.59529 4.56014 2.74999C4.29204 2.9047 3.96373 2.92325 3.67987 2.79829L2.37468 2.22428C2.16748 2.13258 1.92247 2.18578 1.77092 2.35623C1.1395 3.0664 0.668037 3.87877 0.368078 4.7699C0.295276 4.9862 0.370878 5.22526 0.555333 5.36071L1.70091 6.20074C1.95082 6.38414 2.09993 6.67815 2.09993 6.98791C2.09993 7.29767 1.95082 7.59168 1.70161 7.77438L0.548683 8.61965C0.364928 8.75476 0.288976 8.99241 0.360728 9.20907C0.657536 10.1009 1.1269 10.9143 1.75622 11.6273C1.90777 11.7984 2.15278 11.8527 2.36103 11.7603L3.65922 11.1894C3.94203 11.0648 4.27103 11.0827 4.53984 11.2377C4.80795 11.3924 4.98785 11.6682 5.02181 11.9759L5.17791 13.4011C5.20276 13.6279 5.37147 13.8127 5.59477 13.8586C6.05468 13.9524 6.5272 14 7.00006 14C7.46137 14 7.92688 13.9534 8.38365 13.8617C8.60835 13.8166 8.77741 13.6318 8.80226 13.4039L8.95731 11.9878C8.99126 11.6798 9.17117 11.404 9.43998 11.2493C9.70808 11.0949 10.0367 11.0767 10.3203 11.201L11.6254 11.775C11.8333 11.867 12.0776 11.8138 12.2292 11.643C12.8606 10.9329 13.3321 10.1205 13.632 9.22937C13.7048 9.01306 13.6292 8.77401 13.4448 8.63855L12.2989 7.79853ZM7.00006 9.44988C5.64692 9.44988 4.54999 8.35295 4.54999 6.99981C4.54999 5.64667 5.64692 4.54974 7.00006 4.54974C8.3532 4.54974 9.45013 5.64667 9.45013 6.99981C9.45013 8.35295 8.3532 9.44988 7.00006 9.44988Z" fill="white" />
									</svg>
									<span>
										<?php
										_e('Configure')
										?>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="supercharge-card-content">
					<div class="tool-card">
						<div class="tool-top">
							<span><?php _e( 'Browser Notifications', 'ba-cheetah' ); ?></span>
						</div>
						<div class="card-container">
							<div class="tool-card-content">
								<div class="tool-card-description">
									<span><?php _e( 'Push Browser Notifications and keep users coming back.', 'ba-cheetah' ); ?></span>
								</div>
								<div class="icon">
									<img src="<?php echo BA_CHEETAH_URL . 'img/supercharge/notify.svg'; ?>">
								</div>
							</div>
							<div class="tool-card-footer">
								<a href="https://office.builderall.com/br/office/browser-notifications" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
										<path d="M12.2989 7.79853C12.0493 7.61548 11.9002 7.32147 11.9002 7.01171C11.9002 6.70195 12.0493 6.40794 12.2985 6.22524L13.4514 5.37996C13.6352 5.24486 13.7111 5.0072 13.6394 4.79055C13.3426 3.89872 12.8732 3.0853 12.2439 2.37233C12.0923 2.20153 11.848 2.14763 11.6391 2.23933L10.3409 2.81019C10.0581 2.9348 9.72873 2.91695 9.46028 2.76189C9.19217 2.60719 9.01226 2.33138 8.97831 2.02372L8.82221 0.598484C8.79736 0.371678 8.62865 0.186872 8.40535 0.141021C7.49637 -0.0448339 6.5412 -0.0479838 5.61612 0.137521C5.39142 0.182672 5.22236 0.367478 5.19751 0.595334L5.04281 2.01147C5.00886 2.31948 4.82895 2.59529 4.56014 2.74999C4.29204 2.9047 3.96373 2.92325 3.67987 2.79829L2.37468 2.22428C2.16748 2.13258 1.92247 2.18578 1.77092 2.35623C1.1395 3.0664 0.668037 3.87877 0.368078 4.7699C0.295276 4.9862 0.370878 5.22526 0.555333 5.36071L1.70091 6.20074C1.95082 6.38414 2.09993 6.67815 2.09993 6.98791C2.09993 7.29767 1.95082 7.59168 1.70161 7.77438L0.548683 8.61965C0.364928 8.75476 0.288976 8.99241 0.360728 9.20907C0.657536 10.1009 1.1269 10.9143 1.75622 11.6273C1.90777 11.7984 2.15278 11.8527 2.36103 11.7603L3.65922 11.1894C3.94203 11.0648 4.27103 11.0827 4.53984 11.2377C4.80795 11.3924 4.98785 11.6682 5.02181 11.9759L5.17791 13.4011C5.20276 13.6279 5.37147 13.8127 5.59477 13.8586C6.05468 13.9524 6.5272 14 7.00006 14C7.46137 14 7.92688 13.9534 8.38365 13.8617C8.60835 13.8166 8.77741 13.6318 8.80226 13.4039L8.95731 11.9878C8.99126 11.6798 9.17117 11.404 9.43998 11.2493C9.70808 11.0949 10.0367 11.0767 10.3203 11.201L11.6254 11.775C11.8333 11.867 12.0776 11.8138 12.2292 11.643C12.8606 10.9329 13.3321 10.1205 13.632 9.22937C13.7048 9.01306 13.6292 8.77401 13.4448 8.63855L12.2989 7.79853ZM7.00006 9.44988C5.64692 9.44988 4.54999 8.35295 4.54999 6.99981C4.54999 5.64667 5.64692 4.54974 7.00006 4.54974C8.3532 4.54974 9.45013 5.64667 9.45013 6.99981C9.45013 8.35295 8.3532 9.44988 7.00006 9.44988Z" fill="white" />
									</svg>
									<span>
										<?php
											_e('Configure')
										?>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="supercharge-card-content">
					<div class="tool-card">
						<div class="tool-top">
							<span><?php _e( 'Live Chat', 'ba-cheetah' ); ?></span>
						</div>
						<div class="card-container">
							<div class="tool-card-content">
								<div class="tool-card-description">
									<span><?php _e( 'Chat in real-time with website visitors. Offer live support.', 'ba-cheetah' ); ?></span>
								</div>
								<div class="icon">
									<img src="<?php echo BA_CHEETAH_URL . 'img/supercharge/live-chat.svg'; ?>">
								</div>
							</div>
							<div class="tool-card-footer">
								<a href="https://office.builderall.com/br/office/livechat" target="_blank" rel="noopener noreferrer">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
										<path d="M12.2989 7.79853C12.0493 7.61548 11.9002 7.32147 11.9002 7.01171C11.9002 6.70195 12.0493 6.40794 12.2985 6.22524L13.4514 5.37996C13.6352 5.24486 13.7111 5.0072 13.6394 4.79055C13.3426 3.89872 12.8732 3.0853 12.2439 2.37233C12.0923 2.20153 11.848 2.14763 11.6391 2.23933L10.3409 2.81019C10.0581 2.9348 9.72873 2.91695 9.46028 2.76189C9.19217 2.60719 9.01226 2.33138 8.97831 2.02372L8.82221 0.598484C8.79736 0.371678 8.62865 0.186872 8.40535 0.141021C7.49637 -0.0448339 6.5412 -0.0479838 5.61612 0.137521C5.39142 0.182672 5.22236 0.367478 5.19751 0.595334L5.04281 2.01147C5.00886 2.31948 4.82895 2.59529 4.56014 2.74999C4.29204 2.9047 3.96373 2.92325 3.67987 2.79829L2.37468 2.22428C2.16748 2.13258 1.92247 2.18578 1.77092 2.35623C1.1395 3.0664 0.668037 3.87877 0.368078 4.7699C0.295276 4.9862 0.370878 5.22526 0.555333 5.36071L1.70091 6.20074C1.95082 6.38414 2.09993 6.67815 2.09993 6.98791C2.09993 7.29767 1.95082 7.59168 1.70161 7.77438L0.548683 8.61965C0.364928 8.75476 0.288976 8.99241 0.360728 9.20907C0.657536 10.1009 1.1269 10.9143 1.75622 11.6273C1.90777 11.7984 2.15278 11.8527 2.36103 11.7603L3.65922 11.1894C3.94203 11.0648 4.27103 11.0827 4.53984 11.2377C4.80795 11.3924 4.98785 11.6682 5.02181 11.9759L5.17791 13.4011C5.20276 13.6279 5.37147 13.8127 5.59477 13.8586C6.05468 13.9524 6.5272 14 7.00006 14C7.46137 14 7.92688 13.9534 8.38365 13.8617C8.60835 13.8166 8.77741 13.6318 8.80226 13.4039L8.95731 11.9878C8.99126 11.6798 9.17117 11.404 9.43998 11.2493C9.70808 11.0949 10.0367 11.0767 10.3203 11.201L11.6254 11.775C11.8333 11.867 12.0776 11.8138 12.2292 11.643C12.8606 10.9329 13.3321 10.1205 13.632 9.22937C13.7048 9.01306 13.6292 8.77401 13.4448 8.63855L12.2989 7.79853ZM7.00006 9.44988C5.64692 9.44988 4.54999 8.35295 4.54999 6.99981C4.54999 5.64667 5.64692 4.54974 7.00006 4.54974C8.3532 4.54974 9.45013 5.64667 9.45013 6.99981C9.45013 8.35295 8.3532 9.44988 7.00006 9.44988Z" fill="white" />
									</svg>
									<span>
										<?php
											_e('Configure')
										?>
									</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div>
					<?php 
					echo sprintf(
						__('<a href="%s" target="_blank" style="margin-top: 20px" rel="noopener noreferrer">Learn more about the SuperCharge Bundle</a>', 'ba-cheetah'),
						esc_url('https://youtu.be/mHp-Q3phNCY?si=uUb67yqedgBUD8sV')
					);
					?>
				</div>

			</div>
			<?php else : 
			echo sprintf(
				__('<a href="%s" style="margin-top: 20px" target="_blank" rel="noopener noreferrer">Learn More</a>', 'ba-cheetah'),
				esc_url('https://youtu.be/mHp-Q3phNCY?si=uUb67yqedgBUD8sV')
			);
				?>
			<?php endif ?>
			
		<p class="submit" style="display: none;">
			<input type="submit" name="update" class="button-primary" value="<?php esc_attr_e('Save Changes', 'ba-cheetah'); ?>" />
			<?php wp_nonce_field('ba-supercharge', 'ba-cheetah-supercharge-nonce'); ?>
		</p>
	</form>

</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const checkbox = document.getElementById('ba-cheetah-supercharge-enabled');
		const form = document.getElementById('supercharge-form');

		if (checkbox && form) {
			checkbox.addEventListener('change', () => {
				form.submit();
			});
		}
	});


</script>
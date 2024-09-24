<?php
$node_id = "ba-node-$id";
?>

<div class="ba-module__supercheckout <?php echo $node_id; ?>">
	<?php if (isset($settings->product) && $settings->product) : ?>
		<iframe src="<?php echo esc_url(BA_CHEETAH_SC_URL.'c/product-version/'. $settings->product); ?>" width="100%" height="100%" frameborder="0" scrolling="auto"></iframe>
	<?php else : ?>
		<p><?= __('Select a product', 'ba-cheetah'); ?></p>
	<?php endif; ?>
</div>
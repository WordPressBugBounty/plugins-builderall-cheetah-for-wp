<?php if ( ! empty( $settings->height ) ) : ?>
.ba-cheetah-node-<?php echo $id; ?> .ba-module__slideshow {
	height: <?php echo esc_attr($settings->height); ?>px;
}
<?php endif; ?>
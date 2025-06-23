<?php
final class BACheetahSupercharge {

	const OPTION_ENABLED = '_ba_cheetah_supercharge_enabled';
	const OPTION_SCRIPT_CACHE = '_ba_cheetah_supercharge_script_cache';
	const SCRIPT_API_URL_BASE = 'https://bgs.builderall.com/api/get-script-by-uuid/';

	public static function is_enabled() {
		return get_option(self::OPTION_ENABLED, false) == true;
	}

	public static function render_script_header_code() {

		if (!self::is_enabled() || BACheetahModel::is_builder_active()) {
			return;
		}

		$script = self::get_cached_script();

		if ($script) {
			preg_match('/bgskey:\s*"([^"]+)"/', $script, $matches);
			if (isset($matches[1])):
				$bgskey = ($matches[1])
				?>
				<script>
				(function(b, u, i, l, d, e, r) {
					const config = {
						bgskey: "<?= esc_attr($bgskey) ?>",
						url: encodeURI(u.href)
					}
					d = b.createElement(i);
					e = new URLSearchParams(config).toString()
					d.src = `${l}/main.js?${e}`;
					d.defer = !0;
					b.head.appendChild(d);
				})(document, location, 'script', 'https://bgs.builderall.com')
				</script>
				<?php
			endif;
		}
	}

	private static function get_user_uuid() {
		$user = (object) BACheetahAuthentication::user();
		return isset($user->id) ? $user->id : null;
	}

	private static function get_cached_script() {
		$uuid = self::get_user_uuid();

		if (!$uuid) {
			return null;
		}

		$cache_key = self::OPTION_SCRIPT_CACHE . '_' . $uuid;
		$cached = get_option($cache_key);

		if (!empty($cached)) {
			return $cached;
		}

		$response = wp_remote_get(self::SCRIPT_API_URL_BASE . $uuid);

		if (is_wp_error($response)) {
			return null;
		}

		$body = wp_remote_retrieve_body($response);
		$data = json_decode($body);

		if (!empty($data->status) && $data->status === 'success' && !empty($data->data->script)) {
			$script = $data->data->script;
			update_option($cache_key, $script, true);
			return $script;
		}

		return null;
	}
}
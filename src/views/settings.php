<h2>Refresh Page Settings</h2>
<p>Here you can configure how many seconds of inactivity triggers page refersh</p>
<form method="post" action="<?= esc_html(admin_url('admin-post.php')) ?>">
    Refresh after how many seconds?<br>
    <input type="number" name="seconds" placeholder="<?= isset($this->settings['seconds']) ? (int) $this->settings['seconds'] : 60 ?>"><br>
    <input type="hidden" name="action" value="bj_refresh_settings">
    <?php wp_nonce_field( 'bj-refresh-settings', 'bj-refresh-settings-wpnonce' ); ?>
    <?php submit_button(); ?>
</form>
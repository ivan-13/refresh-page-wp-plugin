<?php 

class BJ_Settings
{
    private $settings = [];

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_page']);
        add_action('admin_post_bj_refresh_settings', [$this, 'save']);
        $this->get_settings();
    }

    public function register_page()
    {
        add_management_page(
            'BJ Refresh', 
            'BJ Refresh page settings', 
            'manage_options', 
            BJ_PLUGIN_MENU_SLUG, 
            [$this, 'page_html']
        );
    }

    private function get_settings()
    {
        $this->settings = get_option('bj_refresh_settings');
    }

    public function page_html()
    {
        ob_start();
        include(dirname(__FILE__, 2) . '/views/settings.php');
        echo ob_get_clean();
    }

    public function save()
    {
        if(!(isset($_POST['bj-refresh-settings-wpnonce']) && wp_verify_nonce($_POST['bj-refresh-settings-wpnonce'], 'bj-refresh-settings'))) {
            wp_die('Invalid nonce specified', 'Error', array(
                'response' 	=> 403,
                'back_link' => 'tools.php?page=' . BJ_PLUGIN_MENU_SLUG,
            ));
        }

        $update = [];

        if(isset($_POST['seconds']) && !empty($_POST['seconds'])) {
            $update['seconds'] = $_POST['seconds'];
        } else {
            $update['seconds'] = 60;
        }

        update_option('bj_refresh_settings', $update);

        $url = esc_url(get_admin_url(null, 'tools.php?page=' . BJ_PLUGIN_MENU_SLUG));
        wp_safe_redirect($url);
        exit;
    }
}
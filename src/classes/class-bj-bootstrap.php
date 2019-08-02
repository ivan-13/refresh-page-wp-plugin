<?php

class BJ_Bootstrap
{
    private $seconds;

    public function __construct()
    {
        add_filter( 'plugin_action_links_' . BJ_PLUGIN_BASENAME, [$this, 'show_settings_link'], 10, 1 );
        add_action( 'wp', [$this, 'maybe_enqueue_scripts'] );
    }

    /**
     * enqueue scripts only if it is enabled on the post or page edit screen
     *
     * @return void
     */
    public function maybe_enqueue_scripts()
    {
        global $wp_query;
        $refresh = get_post_meta( $wp_query->post->ID, '_bj_refresh_page', true );
        if(false !== $refresh && $refresh == 'on') {
            $this->set_seconds();
            add_action('wp_enqueue_scripts', [$this, 'add_scripts']);
        }
    }

    /**
     * enqueue plugin js scripts and css styles
     *
     * @return void
     */
    public function add_scripts()
    {
        wp_enqueue_script( 'bj-refresh', BJ_PLUGIN_URL . 'src/js/refresh.js', array ('jquery'), '1.0.0', true);
        wp_localize_script('bj-refresh', 'bj_object', [
            'seconds' => $this->seconds
            ] 
        );
    }

    /**
     * Shows link to settings page on plugins screen
     *
     * @return array
     */
    public function show_settings_link($links)
    {
        $links[] = '<a href="'. esc_url(get_admin_url(null, 'tools.php?page=' . BJ_PLUGIN_MENU_SLUG)) .'">Settings</a>';
        return $links;
    }

    /**
     * Pulls number of seconds for js script
     *
     * @return int
     */
    private function set_seconds()
    {
        $settings = get_option('bj_refresh_settings');
        $this->seconds = isset($settings['seconds']) ? (int) $settings['seconds'] * 1000 : 60000;
    }
}
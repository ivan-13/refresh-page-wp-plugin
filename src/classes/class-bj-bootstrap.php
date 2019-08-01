<?php

class BJ_Bootstrap
{
    private $seconds;

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'add_scripts']);
        $this->set_seconds();
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

    private function set_seconds()
    {
        $settings = get_option('bj_refresh_settings');
        $this->seconds = isset($settings['seconds']) ? (int) $settings['seconds'] * 1000 : 60000;
    }
}
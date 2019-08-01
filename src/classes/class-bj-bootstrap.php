<?php

class BJ_Bootstrap
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'add_scripts']);
    }

    /**
     * enqueue plugin js scripts and css styles
     *
     * @return void
     */
    public function add_scripts()
    {
        wp_enqueue_script( 'bj-refresh', BJ_PLUGIN_URL . 'src/js/refresh.js', array ('jquery'), '1.0.0', true);
    }
}
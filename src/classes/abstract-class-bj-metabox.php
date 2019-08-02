<?php

abstract class BJ_Metabox
{
    public static function add()
    {
        $args = [
            'public'   => true,
            '_builtin' => false,
        ];
        
        $custom_post_types = get_post_types( $args ); 

        $screens = array_merge(['post', 'page'], $custom_post_types);
        foreach ($screens as $screen) {
            add_meta_box(
                'bj_refresh_page',
                'Page refresh',
                [self::class, 'html'],
                $screen
            );
        }
    }
 
    public static function save($post_id)
    {
        if (array_key_exists('bj_refresh_page', $_POST)) {
            update_post_meta(
                $post_id,
                '_bj_refresh_page',
                $_POST['bj_refresh_page']
            );
        }
        else {
            update_post_meta(
                $post_id,
                '_bj_refresh_page',
                'off'
            );
        }
    }
 
    public static function html($post)
    {
        $value = get_post_meta($post->ID, '_bj_refresh_page', true);
        ?>
        <input id="bj-refresh-page" type="checkbox" name="bj_refresh_page" <?php checked( $value, 'on' ); ?>>
        <label for="bj-refresh-page">Automatically refresh this page?</label><br>
        <small>You can set the refresh frequency <a href="<?= esc_url(get_admin_url(null, 'tools.php?page=' . BJ_PLUGIN_MENU_SLUG)) ?>" target="_blank">here</a><small/>
        <?php
    }
}
 
add_action('add_meta_boxes', ['BJ_Metabox', 'add']);
add_action('save_post', ['BJ_Metabox', 'save']);
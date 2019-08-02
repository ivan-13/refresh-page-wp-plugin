<?php
/**
* Plugin Name: Refresh Page After Inactivity
* Description: This plugin will refresh page after X seconds of inactivity
* Version: 2019.07
* Author: BJ
**/

if(!defined('ABSPATH')) exit;
define('BJ_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define('BJ_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('BJ_PLUGIN_BASENAME', plugin_basename( __FILE__ ));
define('BJ_PLUGIN_MENU_SLUG', 'bj-refresh-settings');

require_once BJ_PLUGIN_PATH . 'src/classes/class-bj-bootstrap.php';
require_once BJ_PLUGIN_PATH . 'src/classes/class-bj-settings.php';

new BJ_Bootstrap;
new BJ_Settings;
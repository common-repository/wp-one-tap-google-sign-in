<?php

/**
 * Plugin Name:     Wp One Tap Google Sign In
 * Plugin URI:      https://profiles.wordpress.org/xpertzmate
 * Description:     This plugin is used for manage wordpress sign in , sing up using google one tap sign in functionality.
 * Author:          XpertzMate Team
 * Author URI:      https://www.xpertzmate.com/
 * Text Domain:     wp-onetapgsi
 * Domain Path:     /languages
 * Version:         1.0.1
 * License:         GPL v2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * 
 * @package         Wp_Onetapgsi
 */

if (!defined('WP_ONETAPGSI_PATH')) :
    define('WP_ONETAPGSI_PATH', plugin_dir_path(__FILE__));
endif;

if (!defined('WP_ONETAPGSI_URL')) :
    define('WP_ONETAPGSI_URL', plugin_dir_url(__FILE__));
endif;

require_once WP_ONETAPGSI_PATH . "admin/index.php";
require_once WP_ONETAPGSI_PATH . "includes/index.php";
require_once WP_ONETAPGSI_PATH . "public/index.php";

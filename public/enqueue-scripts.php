<?php

/**
 * Render Script Required For GSI
 *
 * @return void
 */
function wp_onetapgsi_script_enqueue()
{
    if (!is_user_logged_in()) :

        echo wp_sprintf('<script src="%s"></script>', esc_url('https://accounts.google.com/gsi/client'));

        //wp_enqueue_style('one-tap-gsi', WP_ONETAPGSI_URL . 'assets/css/style-login.css');
        wp_enqueue_script('one-tap-gsi', WP_ONETAPGSI_URL . 'assets/js/app-gsi.js', array('jquery'), strtotime('now'), true);
        wp_localize_script('one-tap-gsi', 'onetapgsi', array('ajax_url' => admin_url('admin-ajax.php'), 'gsi_cliet_id' => get_wp_onetapgsi_client_id()));

    endif;
}
add_action('login_enqueue_scripts', 'wp_onetapgsi_script_enqueue', 999);

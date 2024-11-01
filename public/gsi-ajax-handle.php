<?php

/**
 * Handle Mailchimp SignUp
 */
function wp_onetapgsi_handle_submission()
{

    require_once WP_ONETAPGSI_PATH . 'vendor/autoload.php';



    unset($_COOKIE['g_state']);
    $token = json_decode(stripslashes_deep($_REQUEST['gsi_data']));

    $client = new Google_Client(['client_id' => get_wp_onetapgsi_client_id()]);

    $payload = $client->verifyIdToken($token->data);

    if (isset($payload['email'])) :
        $user_email = $payload['email'];
        $user = get_user_by('email', $user_email);
        wp_clear_auth_cookie();

        if ($user) :
            wp_set_current_user($user->ID); // Set the current user detail
            wp_set_auth_cookie($user->ID); // Set auth details in cookie
            do_action('wp_login', $user->user_login, $user);
            echo admin_url();
        else :
            echo 'fail';
        endif;
    else :
        echo 'fail';
    endif;

    wp_die();
}
add_action('wp_ajax_wp_onetapgsi_login', 'wp_onetapgsi_handle_submission');
add_action('wp_ajax_nopriv_wp_onetapgsi_login', 'wp_onetapgsi_handle_submission');

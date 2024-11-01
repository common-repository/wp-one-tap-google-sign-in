<?php

/**
 * Get Client Id For Wp One Tap Google Sign In
 */
function get_wp_onetapgsi_client_id()
{
    $getSettingsData = get_option('wp_one_tap_gsi_settings');
    return (isset($getSettingsData['google_api_client_id'])) ? esc_attr($getSettingsData['google_api_client_id']) : '';
}

<?php
class OneTapGsiSettings
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_plugin_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'One Tap GSI Settings',
            'One Tap GSI Settings',
            'manage_options',
            'one-tap-gsi-settings',
            array($this, 'gsi_settings_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function gsi_settings_admin_page()
    {
        // Set class property
        $this->options = get_option('wp_one_tap_gsi_settings');
?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('wp_one_tap_gsi');
                do_settings_sections('one-tap-gsi-settings');
                submit_button();
                ?>
            </form>
        </div>
<?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting(
            'wp_one_tap_gsi', // Option group
            'wp_one_tap_gsi_settings', // Option name
            array($this, 'sanitize') // Sanitize
        );

        add_settings_section(
            'one_tap_gsi_section_settings', // ID
            'One Tap Google Sign In Settings', // Title
            array($this, 'print_section_info'), // Callback
            'one-tap-gsi-settings' // Page
        );

        add_settings_field(
            'google_api_client_id', // ID
            'Google API client ID', // Title 
            array($this, 'google_api_client_id_callback'), // Callback
            'one-tap-gsi-settings', // Page
            'one_tap_gsi_section_settings' // Section           
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = array();
        if (isset($input['google_api_client_id']))
            $new_input['google_api_client_id'] = sanitize_text_field($input['google_api_client_id']);

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        printf("Enter your settings below: &nbsp; &nbsp; <a href='%s' target='_blank'>Get Client Id</a>", 'https://console.developers.google.com/apis/credentials');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function google_api_client_id_callback()
    {
        printf(
            '<input type="text" id="google_api_client_id" name="wp_one_tap_gsi_settings[google_api_client_id]" value="%s" class="regular-text" />',
            isset($this->options['google_api_client_id']) ? esc_attr($this->options['google_api_client_id']) : ''
        );
    }
}

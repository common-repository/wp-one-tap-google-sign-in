<?php

require_once WP_ONETAPGSI_PATH . "admin/admin-settings.php";

/**
 * Create Object in admin only screen
 */
if (is_admin()) :
    new OneTapGsiSettings();
endif;

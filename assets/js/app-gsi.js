
/**
 * DOM Ready Script Execution
 */
jQuery(document).ready(function () {
    function handleWpGsiCredentialResponse(response) {
        var data = {
            'action': 'wp_onetapgsi_login',
            'gsi_data': JSON.stringify({
                data: response.credential
            })
        };
        jQuery.post(onetapgsi.ajax_url, data, function (response) {
            google.accounts.id.cancel();
            if (response !== 'fail') {
                window.location.href = response;
            }
        });
    }
    window.onGoogleLibraryLoad = () => {
        google.accounts.id.initialize({
            client_id: onetapgsi.gsi_cliet_id,
            callback: handleWpGsiCredentialResponse,
            cancel_on_tap_outside: false
        });
        google.accounts.id.prompt((notification) => {
            if (notification.getMomentType() == 'dismissed') {
                google.accounts.id.cancel();
            }
        });
    };
});

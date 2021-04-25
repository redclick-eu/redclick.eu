<?php

namespace App\Rest;


define("SITE_REST_VERSION", "v1");
define("SITE_REST_NAMESPACE", "site/" . SITE_REST_VERSION);

add_action('rest_api_init', function () {
    (new REST_Callback_Controller)->register_routes();
    (new REST_Live_Search_Controller)->register_routes();
});

<?php

namespace App\Rest;

use function App\recaptcha_verify;

use WP_Query;
use WP_REST_Controller;
use WP_REST_Server;

class REST_Callback_Controller extends WP_REST_Controller {
    public function __construct() {
        $this->namespace = SITE_REST_NAMESPACE;
        $this->rest_base = "/callback";
    }

    public function register_routes() {
        register_rest_route($this->namespace, $this->rest_base, [
            "methods" => WP_REST_Server::CREATABLE,
            "callback" => [$this, "create_item"],
            "permission_callback" => [$this, "create_item_permissions_check"],
            "args" => [
                "name" => [
                    "description" => "customer name",
                    "type" => "string",
                    "required" => true,
                    "validate_callback" => function ($param) {
                        return !empty($param);
                    }
                ],
                "email" => [
                    "description" => "customer email",
                    "type" => "string",
                    "required" => true,
                    "validate_callback" => function ($param) {
                        return !empty($param);
                    }
                ],
                "message" => [
                    "description" => "customer message",
                    "type" => "string",
                    "required" => true,
                    "validate_callback" => function ($param) {
                        return !empty($param);
                    }
                ],
                "g-recaptcha-response" => [
                    "description" => "recaptcha response",
                    "type" => "string",
                    "required" => true,
                    "validate_callback" => function ($param) {
                        return !empty($param);
                    }
                ],
            ]
        ]);
    }

    public function create_item_permissions_check($request) {
        return recaptcha_verify($request['g-recaptcha-response']);
    }

    public function create_item($request) {
        $params = $request->get_params();

        $to = get_field('email_address', (new WP_Query(['pagename' => 'mainpage']))->post->ID);
        $theme = 'A letter from the callback form';

        $subject = $theme . ' from ' . $params['name'];
        $message = '
        <table>
          <tr>
            <td>Theme</td>
            <td>' . $theme . '</td>
          </tr>
          <tr>
            <td>Name</td>
            <td>' . $params['name'] . '</td>
          </tr>
          <tr>
            <td>E-mail</td>
            <td>' . $params['email'] . '</td>
          </tr>
          <tr>
            <td>Message</td>
            <td>' . $params['message'] . '</td>
          </tr>
        </table>
        ';

        $headers = "Content-type: text/html; charset=utf-8\r\n";
        $headers .= 'Reply-To: ' . $params['email'] . "\r\n";

        wp_mail($to, $subject, $message, $headers);

        return [
            "success" => true,
            "\$to" => $to,
            "\$subject" => $subject,
            "\$message" => $message,
            "\$headers" => $headers,
            "message" => "Message successfully delivered"
        ];
    }
}

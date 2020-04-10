<?php

namespace App\Rest;

use WP_REST_Request;
use WP_Error;
use WP_Query;

function callback_permission(WP_REST_Request $request) {
	$params = $request->get_params();
	$curl_out = false;
	$is_recaptcha = isset($params['g-recaptcha-response']) && !empty($params['g-recaptcha-response']);

	if ($is_recaptcha && $curl = curl_init()) {
		$curl_data = array(
			'secret' => '6LcFh7AUAAAAADw8r-VTyz1PA892irpQjOXsA9ip',
			'response' => $params['g-recaptcha-response']
		);
		curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_data);
		$curl_out = json_decode(curl_exec($curl), true);
		curl_close($curl);
	}
	if (!$is_recaptcha) {
		$data['error'][] = 'recaptcha';
		$data['status'] = 403;
		return new WP_Error('recaptcha', '', $data);
	}

	if (!$curl_out['success']) {
		$data['error'][] = 'recaptcha';
		$data['error']['recaptcha'] = $curl_out;
		$data['status'] = 403;
		return new WP_Error('recaptcha', '', $data);
	}
	return true;
}

;

function callback(WP_REST_Request $request) {
	$params = $request->get_params();

	$data = [];
	$data['error'] = [];

	if (!(isset($params['name']) && !empty($params['name']))) {
		$data['error'][] = 'name';
	};

	if (!(isset($params['email']) && !empty($params['email']))) {
		$data['error'][] = 'email';
	};

	if (!(isset($params['message']) && strlen($params['message']) >= 10)) {
		$data['error'][] = 'message';
	};

	if (!empty($data['error'])) {
		return $data;
	}

	$page = new WP_Query(['pagename' => 'mainpage']);
	$page->the_post();
	$mail = get_field('email_address');
	wp_reset_postdata();

	$to =  $mail;
	$theme = wpcl_t('Callback form');

	$subject = $theme . ' от ' . $params['name'];
	$message = '
    <table>
      <tr>
        <td>Тема</td>
        <td>' . $theme . '</td>
      </tr>
      <tr>
        <td>Имя</td>
        <td>' . $params['name'] . '</td>
      </tr>
      <tr>
        <td>E-mail</td>
        <td>' . $params['email'] . '</td>
      </tr>
      <tr>
        <td>Сообщение</td>
        <td>' . $params['message'] . '</td>
      </tr>
    </table>
    ';
	$headers = "Content-type: text/html; charset=utf-8\r\n";
	$headers .= 'Reply-To: ' . $params['email'] . "\r\n";

	wp_mail($to, $subject, $message, $headers);

	return [
		"success" => true,
	];
};

add_action('rest_api_init', function () {
	register_rest_route('redclick/v1', '/callback', array(
		'methods' => 'POST',
		'permission_callback' => __NAMESPACE__ . '\\callback_permission',
		'callback' => __NAMESPACE__ . '\\callback',
	));
});

function search(WP_REST_Request $request) {
	$out = [];
	$params = $request->get_params();
	$max = 6;
	$the_query = new WP_Query(array(
		's' => esc_attr($params['keyword']),
		'post_type' => 'any'
	));

	while ($the_query->have_posts()) {
		$the_query->the_post();
		$max--;
		$out[get_the_title()] = [
			"href" => esc_url(get_the_permalink()),
			"title" => get_the_title()
		];
		if ($max === 0) {
			break;
		}
	}
	wp_reset_postdata();

	if($max > 0) {
		$the_query = new WP_Query(array('post_type' => 'post'));
		while ($the_query->have_posts()) {
			$the_query->the_post();
			if(mb_strpos(mb_strtolower(get_field('content')),mb_strtolower($params['keyword'])) && !isset($out[get_the_title()])) {
				$max--;
				$out[get_the_title()] = [
					"href" => esc_url(get_the_permalink()),
					"title" => get_the_title(),
				];
			}
			if($max === 0) {
				break;
			}
		}
	}
	wp_reset_postdata();

	$out = array_values($out);

	if($max > 0) {
		foreach (get_categories() as $cat) {
			if (strpos(mb_strtolower($cat->cat_name), mb_strtolower($params['keyword'])) !== false) {
				$max--;
				$out[] = [
					"href" => esc_url(get_term_link($cat->term_id)),
					"title" => $cat->name
				];
			}
			if ($max === 0) break;
		}
	}

	if(empty($out)) {
		$out[] = [
			"error" => true,
			"text" =>  wpcl_t("Sorry, no results were found for your request.")
		];
	}

	return $out;
}

add_action('rest_api_init', function () {
	register_rest_route('redclick/v1', '/search', array(
		'methods' => 'POST',
		'callback' => __NAMESPACE__ . '\\search',
	));
});
<?php

namespace App\Rest;

use WP_Query;
use WP_REST_Controller;
use WP_REST_Server;
use WP_Error;

class REST_Live_Search_Controller extends WP_REST_Controller {
    public function __construct() {
        $this->namespace = SITE_REST_NAMESPACE;
        $this->rest_base = "/live_search";
    }

    public function register_routes() {
        register_rest_route($this->namespace, $this->rest_base, [
            "methods" => WP_REST_Server::READABLE,
            "callback" => [$this, "get_items"],
            "permission_callback" => "__return_true",
            "args" => [
                "keyword" => [
                    "description" => "search keyword",
                    "type" => "string",
                    "required" => true,
                    "validate_callback" => function ($param) {
                        return !empty($param);
                    }
                ],
                "size" => [
                    "description" => "maximum number of pages in search results",
                    "type" => "integer",
                    "required" => false,
                    "validate_callback" => function ($param) {
                        return $param > 0;
                    }
                ]
            ]
        ]);
    }

    public function get_items($request) {
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
                "link" => esc_url(get_the_permalink()),
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
                        "link" => esc_url(get_the_permalink()),
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
                        "link" => esc_url(get_term_link($cat->term_id)),
                        "title" => $cat->name
                    ];
                }
                if ($max === 0) break;
            }
        }

        if(empty($out)) {
            $out[] = [
                "error" => wpcl_t("Sorry, no results were found for your request.")
            ];
        }

        return $out;
    }
}

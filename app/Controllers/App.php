<?php

namespace App\Controllers;

use Sober\Controller\Controller;

use App\Breadcrumbs;

use WP_Query;

class App extends Controller
{
    protected $acf = false;
    private static $acf_data = false;

    public function __construct()
    {
        if (acf_get_valid_post_id(get_queried_object())) {
            $this->acf = true;
        }
    }

    public static function get_field($name = false, $printError = true)
    {
        if (self::$acf_data === false) {
            $page = new WP_Query(['pagename' => 'mainpage']);
            self::$acf_data = get_fields($page->post->ID);
        }

        if ($name === false) {
            return self::$acf_data;
        }

        if (isset(self::$acf_data[$name])) {
            return self::$acf_data[$name];
        }

        if ($printError) {
            return '%%' . $name . '%%';
        }

        return null;
    }

    public function breadcrumbs() {
        return (new Breadcrumbs)->get_crumbs(' › ', [], []);
    }

    public function fields() {
        return self::get_field();
    }

    public function wpml_languages()
    {
        $languages = apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc');

        unset($languages[ICL_LANGUAGE_CODE]);

        return $languages;
    }

    public function wpml_current()
    {
        return apply_filters('wpml_active_languages', NULL, 'orderby=id&order=desc')[ICL_LANGUAGE_CODE];
    }

    public function services_block()
    {
        $services = [
            "design" => [],
            "development" => [],
            "promotion" => [],
            "support" => [],
        ];
        $query = new WP_Query(['category_name' => 'services']);

        foreach ($query->posts as $post) {
            $services[get_field('service_type', $post->ID)][] = [
                'title' => get_the_title($post->ID),
                'link' => get_permalink($post->ID)
            ];
        }

        return $services;
    }

    public function portfolio_block()
    {
        $portfolio = [];
        $queryArgs = ['category_name' => 'portfolio'];

        if(is_front_page()) {
            $queryArgs['meta_key'] = 'display_on_main_page';
            $queryArgs['meta_value'] = true;
        }

        $query = new WP_Query($queryArgs);

        if($query->posts) {
            foreach ($query->posts as $post) {
                $types = get_field('project_types', $post->ID);
                array_unshift($types, '');

                $portfolio[] = [
                    'title' => $post->post_title,
                    'desc' => get_field('description_small', $post->ID),
                    'link' => get_permalink($post->ID),
                    'logo' => get_field('logo_little', $post->ID),
                    'types' => $types,
                    'position' => get_field('project_position', $post->ID),
                ];
            }
        }

        usort($portfolio, function($a, $b) {
            return $b['position'] - $a['position'];
        });

        return $portfolio;
    }

    public function reviews_block()
    {
        $output = [];

        $posts = get_posts([
            'category_name' => 'portfolio',
            'meta_key' => 'project_view',
            'meta_value' => true
        ]);

        foreach ($posts as $post) {
            $fields = get_fields($post->ID);

            $output[] = [
                'photo' => [
                    'url' => $fields['project_clientPhoto']['url'],
                    'alt' => $fields['project_clientPhoto']['title'],
                ],
                'text' => trim(mb_substr(strip_tags($fields['project_review']), 0, 600)),
                'client_name' => $fields['project_clientInfo'],
                'company_name' => $post->post_title,
                'link' => get_permalink($post->ID),
            ];
        }

        return $output;
    }

    public function privacy_policy_content()
    {
        $query = new WP_Query(['post_type' => 'page', 'pagename' => 'privacy']);
        if (!empty($query->posts)) {
            return $query->posts[0]->post_content;
        } else {
            return 'Soon';
        }
    }

    public function google_maps_data() {
        self::get_field();

        return json_encode([
           'coordinates' => [
               'lat' => isset(self::$acf_data['maps_lat']) ? (float)self::$acf_data['maps_lat'] : 0,
               'lng' => isset(self::$acf_data['maps_lng']) ? (float)self::$acf_data['maps_lng'] : 0,
           ],
           'key' => isset(self::$acf_data['maps_key']) ? self::$acf_data['maps_key'] : 0
        ]);
    }
}

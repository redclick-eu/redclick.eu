<?php

namespace App\Controllers;

use Sober\Controller\Controller;
use WP_Query;

class App extends Controller
{
    protected $acf = false;
    private static $redclick = false;

    public function __construct()
    {
        if (acf_get_valid_post_id(get_queried_object())) {
            $this->acf = true;
        }
    }

    public static function redclick($name = false)
    {
        if (self::$redclick !== false) {
            if ($name !== false) {
                return isset(self::$redclick[$name]) ? self::$redclick[$name] : '%%' . $name . '%%';
            }
            return self::$redclick;
        }
        $page = new WP_Query(['pagename' => 'mainpage']);
        $page->the_post();
        self::$redclick = get_fields();
        wp_reset_postdata();

        if ($name !== false) {
            return self::$redclick[$name];
        }
        return self::$redclick;
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
        $query = new WP_Query(['category_name' => 'portfolio']);

        foreach ($query->posts as $post) {
            $types = "";

            foreach (get_field('project_types', $post->ID) as $type)
                $types .= "js-isotope-" . $type . " ";

            $portfolio[] = [
                'title' => get_field('description_small', $post->ID),
                'link' => get_permalink($post->ID),
                'logo' => get_field('logo_little', $post->ID),
                'types' => $types
            ];
        }

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
}

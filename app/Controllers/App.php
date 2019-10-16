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

    public static function redclick($name = false) {
        if (self::$redclick !== false) {
            if ($name !== false) {
                return isset(self::$redclick[$name]) ? self::$redclick[$name] : '%%'.$name.'%%';
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
    
    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public function wpml_languages()
    {
        $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );

        unset($languages[ICL_LANGUAGE_CODE]);

        return $languages;
    }

    public function wpml_current()
    {
        return apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' )[ICL_LANGUAGE_CODE];
    }

    public function services_block()
    {
        $services = [
            "design" => [],
            "development" => [],
            "promotion" => [],
            "support" => [],
        ];
        $query = new WP_Query( ['category_name' => 'services'] );

        foreach ($query->posts as $post) {
            $services[get_field('service_type', $post->ID)][] = [
                'title' =>  get_field('service_name', $post->ID),
                'link' => get_permalink($post->ID)
            ];
        }

        return $services;
    }
}

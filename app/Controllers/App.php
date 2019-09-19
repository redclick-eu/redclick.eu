<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    protected $acf = true;
    private static $ulady = false;

    public static function leeway($name = false) {
        if (self::$ulady !== false) {
            if ($name !== false) {
                return isset(self::$ulady[$name]) ? self::$ulady[$name] : '%%'.$name.'%%';
            }
            return self::$ulady;
        }
        $page = new WP_Query(['pagename' => 'mainpage']);
        $page->the_post();
        self::$ulady = get_fields();
        wp_reset_postdata();

        if ($name !== false) {
            return self::$ulady[$name];
        }
        return self::$ulady;
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
}

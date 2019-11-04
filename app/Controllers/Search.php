<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Search extends Controller
{
    public function items()
    {
        $items = [];

        while (have_posts()) {
            the_post();
            $items[] = [
                'title' => get_the_title(),
                'link' => get_the_permalink(),
            ];
        }

        foreach (get_categories() as $cat) {
            if (strpos(mb_strtolower($cat->cat_name), mb_strtolower(get_query_var('s'))) !== false) {
                $items[] = [
                    'title' => $cat->name,
                    'link' => get_category_link($cat->term_id),
                ];
            }
        }

        return $items;
    }
}

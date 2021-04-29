<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FrontPage extends Controller
{
    public function carousel_images()
    {
        $images_data = get_field('carousel_fullwidth');
        $images = [];

        foreach ($images_data as $image_data) {
            $images[] = [
                'url' => $image_data['image']['url'],
                'alt' => $image_data['image']['alt'],
            ];
        }

        return $images;
    }
}

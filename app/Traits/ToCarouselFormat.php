<?php

namespace App\Traits;


trait ToCarouselFormat {
    private function toCarouselFormat($carousel) {
        $output = [];

        foreach ($carousel as $c) {
            $output[] = [
                'alt' => $c['photo']['title'],
                'src' => $c['photo']['url'],
                'srcset' =>  "
                    {$c['photo']['sizes']['thumbnail']} 576w,
                    {$c['photo']['sizes']['medium']} 768w,
                    {$c['photo']['sizes']['large']} 1200w,
                    {$c['photo']['url']} 1920w",
            ];
        }

        return $output;
    }
}

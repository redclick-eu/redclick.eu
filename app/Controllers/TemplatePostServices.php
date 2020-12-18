<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplatePostServices extends Controller
{
	public function post_vars(){
        $fields = get_fields();

        return [
		    'title' => $fields['service_name'],
            'content' => get_the_content(),
            'cost' => $fields['service_cost'],
            'deadline' => $fields['service_time'],
            'carousel' =>  $this->carousel($fields['project_photos']),
        ];
	}

    private function carousel($carousel) {
        $output = [];

        foreach ($carousel as $c) {
            $output[] = [
                'alt' => $c['photo']['title'],
                'url' => $c['photo']['url']
            ];
        }

        return $output;
    }
}

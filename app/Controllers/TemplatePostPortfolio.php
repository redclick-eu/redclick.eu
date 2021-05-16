<?php

namespace App\Controllers;

use App\Traits\ToCarouselFormat;
use Sober\Controller\Controller;

class TemplatePostPortfolio extends Controller
{
    use ToCarouselFormat;

	public function post_vars(){
        $fields = get_fields();

        return [
		    'title' => $fields['project_name'],
            'carousel' =>  $this->toCarouselFormat($fields['project_photos']),
            'text' => [
                'task' => $fields['project_task'],
                'solution' => $fields['project_solution'],
                'result' => $fields['project_result'],
            ],
            'review' => [
                'photo' => [
                    'url' => $fields['project_clientPhoto']['url'],
                    'alt' => $fields['project_clientPhoto']['title'],
                ],
                'text' => $fields['project_review'],
                'name' => $fields['project_clientInfo'],
            ]
        ];
	}

	private function services($services) {
	    $output = "";

	    foreach ($services as $s) {
	        $output.= wpcl_t($s) . " | ";
        }

	    return substr($output, 0, strlen($output) - 2);
    }
}

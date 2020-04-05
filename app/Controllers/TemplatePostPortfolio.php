<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class TemplatePostPortfolio extends Controller
{
	public function post_vars(){
        $fields = get_fields();

        return [
		    'title' => $fields['project_name'],
            'site' => $fields['project_site'],
            'site_url' => $fields['project_site_protocol'].'://'.$fields['project_site'],
            'services' => $this->services($fields['project_types']),
            'carousel' =>  $this->carousel($fields['project_photos']),
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

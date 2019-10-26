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
            'deadline' => $fields['service_time']
        ];
	}
}

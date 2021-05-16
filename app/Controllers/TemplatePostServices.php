<?php

namespace App\Controllers;

use App\Traits\ToCarouselFormat;
use Sober\Controller\Controller;

class TemplatePostServices extends Controller
{
    use ToCarouselFormat;

	public function post_vars(){
        $fields = get_fields();

        return [
		    'title' => $fields['service_name'],
            'content' => get_the_content(),
            'cost' => $fields['service_cost'],
            'deadline' => $fields['service_time'],
            'carousel' =>  isset($fields['project_photos']) && is_array($fields['project_photos']) ? $this->ToCarouselFormat($fields['project_photos']) : [],
        ];
	}
}

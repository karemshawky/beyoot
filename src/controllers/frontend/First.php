<?php

namespace Controllers\Frontend;

class First extends \Controllers\Base
{

    public function index($request, $response)
    {
        $data['houses'] = $this->dbt->get_housing(3);
        $data['sliders'] = $this->dbt->get_table('slider');  
        $data['settings'] = $this->dbt->get_one('about_us');  

        return $this->views->render($response, 'frontend/index.php', $data);
    }

}
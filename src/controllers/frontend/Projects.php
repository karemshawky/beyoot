<?php
namespace Controllers\Frontend;

use Intervention\Image\ImageManager;

class Projects extends \Controllers\Base
{

    public function index($request, $response)
    {
        $data['settings'] = $this->dbt->get_one('about_us');
        $data['projects'] = $this->dbt->pagination('our_projects', [], [], 1, 6, ['created_date', 'desc']);
  
        return $this->views->render($response, 'frontend/project/all_projects.php', $data);
    }

    public function load_more($request, $response)
    {
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 2;

        $data['projects'] = $this->dbt->pagination('our_projects', [], [], $pageNum, 6, ['created_date', 'desc']);
        echo json_encode( $data['projects'] );
    }

    public function single($request, $response, $args)
    {
        $data['settings'] = $this->dbt->get_one('about_us');
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['project'] = $this->dbt->get_one('our_projects',['id'=>$id]);
            $data['images'] = $this->dbt->get_table('images',['type_id'=> 2,'housing_id'=> $data['project']['id']] ,['id','title','link']);          
            if( empty($data['project']['id']) ){
                header('Location: ' . BaseUrl );
                exit;
            }
            return $this->views->render($response, 'frontend/project/single_project.php', $data);
        }else{
            header('Location: ' . BaseUrl );
            exit;
        }
      }

    public function three60($request, $response, $args)
    {
        $url = $args['url'];
        if( $url ) 
        {
            $data['data'] = $url;
            return $this->views->render($response, 'frontend/panaroma-mob/index.php', $data);
        }else{
            header('Location: ' . BaseUrl );
            exit;
        }
    }

}
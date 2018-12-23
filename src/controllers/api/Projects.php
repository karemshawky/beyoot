<?php
namespace Apis;

use Respect\Validation\Validator as v;

class Projects extends \Controllers\Base
{

    /**
     * Get single project with details
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_single_project($request, $response)
    {
        $id = $this->httpPost('project_id');
        $validations = [ v::intVal()->validate($id) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if ($id) {
            $query  = $this->dbt->get_one('our_projects', ['id' => $id]);
            $images = $this->dbt->get_table('images', ['housing_id' => $query['id']], ['id', 'title', 'link']);
        }
        
        if ($query)
        {
            $thumb[] = ['id'=> 0, 'title'=> $query['title'], 'link'=> $query['pic'] ];
            $data['status']  = 200;
            $data['results'] = $query;
            $data['results']['images'] = array_merge ($thumb , $images) ;
            
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'Project not found']);
    }

    /**
     * Get latest projects with pagination
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_our_projects($request, $response)
    {
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 1;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 3; 

        $query = $this->dbt->pagination('our_projects', [], ['id', 'title', 'address', 'pic'], $pageNum, $perPage, ['created_date', 'desc']);
        if ($query)
        {
            $data['status'] = 200;
            $data['results'] = $query;
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'No more projects']);
    }

}
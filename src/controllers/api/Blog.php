<?php
namespace Apis;

use Respect\Validation\Validator as v;

class Blog extends \Controllers\Base
{

    /**
     * Get single blog news with details
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_single_blog_news($request, $response)
    {
        $id = $this->httpPost('news_id');
        $token = ($this->httpPost('token_id')) ? $this->httpPost('token_id') : 0;

        $validations = [ v::intVal()->validate($id) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if ($id) {
            $query = $this->dbt->get_one('blog', ['id' => $id]);
            ($token) ? $fav = $this->dbt->get_one('favorite',['token_id'=>$token,'number_id'=> $query['id']],'number_id') : $fav = 0; 
        }

        if ($query)
        {
            $res = ['id'=> $query['id'], 'link' => BaseUrl . 'blogs/mob/' . $query['id']];
            $data['status']  = 200;
            $data['results'] = $res;
            $data['results']['is_fav'] = ($fav == $query['id']) ? 1 : 0;
            
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'News not found']);
    }

    /**
     * Get latest blog news with pagination
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_latest_blog_news($request, $response)
    {
        $type = $this->httpPost('type_id');
        $validations = [ v::intVal()->validate($type) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if ($type) {
            $query = $this->dbt->pagination('blog', ['type_id' => $type], ['id', 'title', 'pic'], 1, 5, ['created_date', 'desc']);
        }

        if ($query)
        {
            $data['status']  = 200;
            $data['results'] = $query;
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'No more news']);
    }

    /**
     * Get residual of latest blog news with pagination
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_residual_blog_news($request, $response)
    {
        $type    = $this->httpPost('type_id'); 
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 2;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 5; 

        $validations = [ v::intVal()->validate($type) ];

        if ($this->validate($validations) === false){
            return $response->withStatus(400);
        }

        if ($type) {
            $query = $this->dbt->pagination('blog', ['type_id' => $type], ['id', 'title', 'pic'], $pageNum, $perPage, ['created_date', 'desc']);
        }
        
        if ($query)
        {
            $data['status']  = 200;
            $data['results'] = $query;
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'No more news']);
    }

}
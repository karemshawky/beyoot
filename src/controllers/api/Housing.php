<?php
namespace Apis;

use Respect\Validation\Validator as v;

class Housing extends \Controllers\Base
{
    /**
     * Get single house with details
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_single_house($request, $response)
    {
        $id = $this->httpPost('house_id');
        $token = ($this->httpPost('token_id')) ? $this->httpPost('token_id') : 0;

        $validations = [ v::intVal()->validate($id) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if ($id) 
        {
            $query     = $this->dbt->get_one('housing', ['id' => $id]);
            $images    = $this->dbt->get_table('images', ['housing_id' => $query['id']], ['id', 'title', 'link']);
            $additions = $this->dbt->get_table('housing_additions', ['housing_id' => $query['id']]);
            $phone     = $this->dbt->get_one('about_us',[],'phone');
            ($token) ? $fav = $this->dbt->get_one('favorite',['token_id'=>$token,'type_id'=>1,'number_id'=> $query['id']],'number_id') : $fav = 0; 
        }

        if ($query)
        {   
            $data['status']  = 200;
            $data['results'] = $query;
            $data['results']['app_phone'] = $phone;
            $data['results']['type']   = $this->dbt->get_one('housing_types', ['id' => $query['type_id'] ], 'name');
            $data['results']['city_id']   = $this->dbt->get_one('cities', ['id' => $query['city_id'] ], 'name');
            $data['results']['is_fav']    = ($fav == $query['id']) ? 1 : 0;
            $thumb[] = ['id'=> 0, 'title'=> $query['title'], 'link'=> $query['pic'] ];
            $data['results']['images'] = array_merge ($thumb , $images) ;
            
            if ($additions)
            {
                foreach ($additions as $value)
                {
                    $types[] = [ 'type'    => $this->dbt->get_one('housing_additions_type', ['id' => $value['type']], 'type') , 
                                 'value'   => $value['value'] , 
                                 'type_id' => $value['type_id'] 
                               ];
                }
                $data['results']['additions'] = $types;
            }

            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'House not found']);
    }

    /**
     * Get latest houses with pagination
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_housing($request, $response)
    {
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 1;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 5;
        $token   = ($this->httpPost('token_id')) ? $this->httpPost('token_id') : 0; 

        if ($token) :
            $favs  = $this->dbt->get_table('favorite',['token_id'=>$token,'type_id'=>1]);
            if (!empty($favs)) :
                foreach ($favs as $fav) :
                    $pages[] = $this->dbt->get_one('housing', ['id'=> $fav['number_id'] ],'id');
                endforeach;
            endif;
        else :
            $pages = 0;
        endif;
         
        $query = $this->dbt->pagination('housing', ['is_active'=> 1], ['id', 'title', 'price', 'type_id', 'address', 'pic'], $pageNum, $perPage, ['created_date', 'desc']);
        if ($query)
        {
            foreach ($query as $value) :
                if ( $pages ) :
                    $favorite[] = $value['id'];         
                    $intersection = array_intersect($favorite, $pages);
                    ( in_array( $value['id'], $intersection) ) ? $favz = 1 : $favz = 0 ;
                else :
                    $favz = 0;
                endif;

                $arr[] = [  'id'      => $value['id'], 
                            'title'   => $value['title'],
                            'price'   => $value['price'], 
                            'type'    => $this->dbt->get_one('housing_types',['id'=> $value['type_id']],'name'), 
                            'address' => $value['address'], 
                            'pic'     => $value['pic'],
                            'is_fav'  => $favz
                         ];
            endforeach;

            $data['status']  = 200;            
            $data['results'] = $arr;

            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'No more houses']);
    }

    /**
     * Search results of houses with pagination
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_search($request, $response)
    {
        $city    = ($this->httpPost('city_id')) ? (int) $this->httpPost('city_id') : 0;
        $type    = ($this->httpPost('type_id')) ? (int) $this->httpPost('type_id') : 0;
        $from    = ($this->httpPost('price_from')) ? $this->httpPost('price_from') : 100000;
        $to      = ($this->httpPost('price_to')) ? $this->httpPost('price_to') : 1000000;
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 1;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 5;
        $token   = ($this->httpPost('token_id')) ? $this->httpPost('token_id') : 0; 

        if ($token) :
            $favs  = $this->dbt->get_table('favorite',['token_id'=>$token,'type_id'=>1]);
            if (!empty($favs)) :
                foreach ($favs as $fav) :
                    $pages[] = $this->dbt->get_one('housing', ['id'=> $fav['number_id'] ],'id');
                endforeach;
            endif;
        else :
            $pages = 0;
        endif;  

        $validations = [ v::intVal()->length(1, 11)->validate($city) ,
                         v::intVal()->length(1, 2 )->validate($type) ,
                         v::intVal()->length(1, 11)->validate($from) ,
                         v::intVal()->length(1, 11)->validate($to)
                       ];

        if ($this->validate($validations) === false){
            return $response->withStatus(400);
        }

        if ($from && $to) 
        {
            $query = $this->dbt->search($city, $type, $from, $to, $pageNum, $perPage);
        }

        if ($query)
        {
            foreach ($query as $value) :
                if ( $pages ) :
                    $favorite[] = $value['id'];         
                    $intersection = array_intersect($favorite, $pages);
                    ( in_array( $value['id'], $intersection) ) ? $favz = 1 : $favz = 0 ;
                else :
                    $favz = 0;
                endif;

                $arr[] = [  'id'      => $value['id'], 
                            'title'   => $value['title'], 
                            'price'   => $value['price'], 
                            'type'    => $this->dbt->get_one('housing_types', ['id' => $value['type_id']], 'name'),
                            'address' => $value['address'],
                            'pic'     => $value['pic'],
                            'is_fav'  => $favz
                         ];
            endforeach;

            $data['status'] = 200;
            $data['results'] = $arr;

            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'Search not found']);
    }

    /**
     * Details of search
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean
     */
    public function search_details($request, $response)
    {
        $data['status'] = 200;
        $data['cities'] = $this->dbt->get_table('cities');
        $data['type']   = $this->dbt->get_table('housing_types');
        $data['min']    = $this->dbt->min('housing','price');
        $data['max']    = $this->dbt->max('housing','price');

        if ($data['cities'] && $data['type'])
        {
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'Error in cities or type']);
    }

    /**
     * Two things this function can do :
     *  1- Contact about house from user
     *  2- Contact about project from investor
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return Slim\Http\Response|boolean
     */
    public function contact_message($request, $response)
    {
        $post = $this->httpPostAll();
        $post['created_date'] = date('Y-m-d H:i:s');

        $validations = [ v::phone()->length(1, 30)->validate($post['phone']) ,
                         v::email()->length(1, 255)->validate($post['email']) ,
                         v::intVal()->length(1, 11)->validate($post['housing_id']) ,
                         v::intVal()->length(1, 1)->validate($post['type_id'])
                       ];

        if ( $this->validate($validations) === false || 
             !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['name']) || 
             !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['details']) ) {
             return $response->withStatus(400);
        }

        if ( $post['name'] && $post['phone'] && $post['email'] && $post['details'] && $post['housing_id'] && $post['type_id'] ) 
        {
            unset($post['token']);
            $query = $this->dbt->insert_this('contact', $post);
            $data = ['status' => '200', 'message' => 'Message sent successfully'];
            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400','message'=>'Error in send message']);        
    }

}
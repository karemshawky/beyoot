<?php
namespace Apis;

use Respect\Validation\Validator as v;

class Users extends \Controllers\Base
{
    /**
     * User register
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function user_register($request, $response)
    {
        $post = $this->httpPostAll();
        $post['token_id']     = make_token();
        $post['created_date'] = date('Y-m-d H:i:s');

        $validations = [ v::phone()->length(1, 30)->validate($post['phone']) ];

        if ($this->validate($validations) === false || !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['name']) ) {
            return $response->withStatus(400);
        }

        if ($post['phone']) {
            $check = $this->dbt->get_table('users', ['phone'=>$post['phone']]);
        }

        if ($check) {
            return $response->withStatus(400)->withJson(['status' => '400','message'=>'Phone Already exist']);
        }
        
        if ($post['name'] && $post['phone']) 
        {
            $lastId = $this->dbt->insert_this('users', $post,'id');
            
            $data['status'] = 200;
            $data['results'] = $this->dbt->get_one('users', ['id' => $lastId]);

            echo self::encode($data);
            return true;
        }
    }

    /**
     * Check if phone number is exists
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function check_number_exist($request, $response)
    {
        $phone = $this->httpPost('phone');
        $validations = [ v::phone()->length(1, 30)->validate($phone) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if ($phone) {
            $check = $this->dbt->get_table('users', ['phone'=>$phone]);
        }

        if ($check) {
            return $response->withStatus(400)->withJson(['status' => '400','message'=>'Phone Already exist']);
        }

        return $response->withStatus(200)->withJson(['status'=> '200', 'message'=> 'Number not found']);
    }

    /**
     * User login
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function user_login($request, $response)
    {
        $phone = $this->httpPost('phone');
        $fcm   = $this->httpPost('token_fcm');
        $validations = [ v::phone()->length(1, 30)->validate($phone) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if($phone) {
            $query  = $this->dbt->get_one('users', ['phone' => $phone]);
            $tknfcm = $this->dbt->update_this('users', ['token_fcm'=> $fcm], ['phone' => $phone]);
        }

        if ($query) {
            $data['status'] = 200;
            $data['results'] = $this->dbt->get_one('users', ['phone' => $phone]);

            echo self::encode($data);
            return true;
        }
        
        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'User not found']);
    }

    /**
     * Get user favorite house and blog news
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function get_user_favorite($request, $response)
    {
        $id   = ($this->httpPost('token')) ? $this->httpPost('token') : 0;
        $type = $this->httpPost('type_id');
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 1;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 5; 

        $validations = [ v::intVal()->length(1,11)->validate($type) ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        // if ($id) {
        //     $allFav = $this->dbt->get_table('favorite', ['token_id' => $id, 'type_id'=> $type]);
        // }

        if ($id) {
            $allFav  = $this->dbt->get_table('favorite', ['token_id' => $id,'type_id'=> 1]);
            $allFav1 = $this->dbt->get_table('favorite', ['token_id' => $id,'type_id'=> 2]);
            $allFav2 = $this->dbt->get_table('favorite', ['token_id' => $id,'type_id'=> 3]);
        }
            
        if ( !empty($allFav) ) 
        {
            // foreach ($allFav as $fav)
            // {
            //     $arr[] = $fav['number_id'] ;
            // }
            foreach ($allFav as $fav)
            {
                $arr[] = $fav['number_id'] ;
            }

            foreach ($allFav1 as $favs1)
            {
                $arr25[] = $favs1['number_id'] ;
            }

            foreach ($allFav2 as $favs2)
            {
                $arr26[] = $favs2['number_id'] ;
            }

            $data['status']  = 200;
            if ( $type == 1) :

                if( !empty ($arr) ) 
                { 
                    $query = $this->dbt->get_whereOperator('housing', ['id','IN'] , $arr, ['id', 'title', 'price', 'type_id', 'address', 'pic'] , 
                                                           $pageNum , $perPage , ['created_date', 'desc'] );                
                        foreach ($query as $result) :
                            $results[] = [  'id'      => $result['id'], 
                                            'title'   => $result['title'], 
                                            'price'   => $result['price'], 
                                            'type'    => $this->dbt->get_one('housing_types', ['id' => $result['type_id']], 'name') , 
                                            'address' => $result['address'], 
                                            'pic'     => $result['pic']
                                        ];
                        endforeach;
                    if ( !empty ($results) ) :
                        $data['housing'] = $results;
                    else :
                        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'No more favorite']);
                    endif;
                }else{
                    return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'No more favorite']);
                }

            elseif ($type == 2) :

                if( !empty ($arr25) ) {
                    $query2 = $this->dbt->get_whereOperator('blog', ['id','IN'] , $arr25, ['id', 'title', 'details',  'pic', 'type_id'] , 
                                                            $pageNum , $perPage , ['created_date', 'desc'] );  
                    foreach ($query2 as $result2) :
                        $arr2[] = [ 'id'      => $result2['id'], 
                                    'title'   => $result2['title'], 
                                    'details' => $result2['details'], 
                                    'pic'     => $result2['pic'],
                                    'type'    => 'السياحة',
                                ];
                    endforeach;
                    if ( !empty ($arr2) ) :
                        $data['blog'] = $arr2;
                    else :
                        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'No more favorite']);
                    endif;

                }else{
                    return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'No more favorite']);                
                }

            elseif ($type == 3) :

                if( !empty ($arr26) ) {
                    $query3 = $this->dbt->get_whereOperator('blog', ['id','IN'] , $arr26, ['id', 'title', 'details',  'pic', 'type_id'] , 
                                                            $pageNum , $perPage , ['created_date', 'desc'] );  
                    foreach ($query3 as $result3) :
                        $arr3[] = [ 'id'      => $result3['id'], 
                                    'title'   => $result3['title'], 
                                    'details' => $result3['details'], 
                                    'pic'     => $result3['pic'],
                                    'type'    => 'التجارة و الأعمال',
                                ];
                    endforeach;
                    if ( !empty ($arr3) ) :
                        $data['blog'] = $arr3;
                    else :
                        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'No more favorite']);
                    endif;

                }else{
                    return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'No more favorite']);                
                }    
            endif;    

            echo self::encode($data);
            return true;
        }
        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'User not found']);
    }

    /**
     * Add user favorite
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return Slim\Http\Response|boolean
     */
    public function add_user_favorite($request, $response)
    {
        $post['token_id']  = ($this->httpPost('token')) ? $this->httpPost('token') : 0;
        $post['type_id']   = $this->httpPost('type_id');
        $post['number_id'] = ($this->httpPost('number_id')) ? $this->httpPost('number_id') : 0;
        $post['created_date'] = date('Y-m-d H:i:s');

        $validations = [ v::intVal()->length(1,11)->validate($post['type_id']) ,
                         v::intVal()->length(1,11)->validate($post['number_id'])
                       ];
        
        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        $check = $this->dbt->get_table('favorite', ['token_id'=> $post['token_id'], 'type_id'=> $post['type_id'], 'number_id'=> $post['number_id'] ]);

        if ($check) {
            return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'Favorite already exists']);
        }

        if( $post['token_id'] && $post['type_id'] && $post['number_id']) 
        {
            $this->dbt->insert_this('favorite', $post);
            return $response->withStatus(200)->withJson(['status' => '200', 'message' => 'Add to favorite successfully']);
        }
    }

    /**
     * Delete user favorite house or blog news
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function remove_user_favorite($request, $response)
    {
        $token = ($this->httpPost('token')) ? $this->httpPost('token') : 0;
        $type  = ($this->httpPost('type_id')) ? $this->httpPost('type_id') : 0; 
        $id    = ($this->httpPost('id')) ? $this->httpPost('id'): 0;        

        $validations = [ v::intVal()->length(1,11)->validate($id),
                         v::intVal()->length(1,2)->validate($type),
                       ];

        if ($this->validate($validations) === false) {
            return $response->withStatus(400);
        }

        if ($token && $type && $id) {
            $query = $this->dbt->get_one('favorite', ['token_id' => $token,'type_id'=> $type,'number_id'=> $id]);
            if ($query) {
                $this->dbt->delete_this('favorite', ['token_id' => $token,'type_id'=> $type,'number_id'=> $id]);
                return $response->withStatus(200)->withJson(['status' => '200', 'message' => 'Deleted successfully']);
            }
        }
        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'Favorite not found']);
    }

    /**
     * Updated user token fcm
     *
     * @param Slim\Http\Request $request
     * @param Slim\Http\Response $response
     * @return boolean|Slim\Http\Response
     */
    public function update_fcm_token($request, $response)
    {
        $id  = ($this->httpPost('token')) ? $this->httpPost('token') : 0;
        $fcm = $this->httpPost('token_fcm');

        $check = $this->dbt->get_one('users', ['token_id' => $id]);
        if (!$check) {
            return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'User not found']);
        }

        if ($id && $fcm) 
        {
            $query = $this->dbt->update_this('users', ['token_fcm' => $fcm], ['token_id' => $id]);
            return $response->withStatus(200)->withJson(['status' => '200', 'message' => 'Updated successfully']);
        }
        return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'Error in Token Fcm']);
    }

    // /**
    //  * Delete user by phone
    //  *
    //  * @param Slim\Http\Request $request
    //  * @param Slim\Http\Response $response
    //  * @return boolean|Slim\Http\Response
    //  */
    // public function delete_user($request, $response)
    // {
    //     $phone = $this->httpPost('phone');

    //     $validations = [ v::phone()->length(1, 50)->validate($phone) ];

    //     if ($this->validate($validations) === false) {
    //         return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'Error in Phone Number']);
    //     }

    //     $check = $this->dbt->get_one('users', ['phone' => $phone]);
    //     if (!$check) {
    //         return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'User not found']);
    //     }

    //     if ($check) 
    //     {
    //         $query1 = $this->dbt->delete_this('users', ['phone' => $phone]);
    //         $query2 = $this->dbt->delete_this('favorite', ['token_id' => $check['token_id']]);
    //         return $response->withStatus(200)->withJson(['status' => '200', 'message' => 'Deleted successfully']);
    //     }
    //     return $response->withStatus(400)->withJson(['status' => '400', 'message' => 'Error in Phone Number again']);
    // }

    // /**
    //  * Get user favorite profile without pagniation
    //  *
    //  * @param Slim\Http\Request $request
    //  * @param Slim\Http\Response $response
    //  * @return boolean|Slim\Http\Response
    //  */
    // public function get_user_favorite($request, $response)
    // {
    //     $id = ($this->httpPost('token')) ? $this->httpPost('token') : 0;
    //     if ($id) {
    //         $allFav = $this->dbt->get_table('favorite', ['token_id' => $id]);
    //     }

    //     if ($fav) {}
    //     foreach ($allFav as $fav)
    //     {
    //         if( $fav['type_id'] == 1 ) :
    //             $query = $this->dbt->pagination('housing', ['id' => $fav['number_id'], null, ]);
    //             foreach ($query as $result) :
    //                 $arr1[] = [ 'id'      => $result['id'],  
    //                             'title'   => $result['title'], 
    //                             'price'   => $result['price'], 
    //                             'type'    => $this->dbt->get_one('housing_types', ['id' => $result['type_id']], 'name') , 
    //                             'address' => $result['address'], 
    //                             'pic'     => $result['pic']
    //                         ];
    //             endforeach;
    //         else :
    //             $query = $this->dbt->pagination('blog', ['id' => $fav['number_id']]);
    //             foreach ($query as $result) :
    //                 $arr2[] = [ 'id'      => $result['id'], 
    //                             'title'   => $result['title'], 
    //                             'details' => $result['details'], 
    //                             'pic'     => $result['pic'],
    //                             'type'    => $result['type_id']
    //                         ];
    //             endforeach;
    //         endif;
    //     }

    //     if ($query) {
    //         $data['status']  = 200;
    //         $data['housing'] = $arr1;
    //         $data['blog']    = $arr2;

    //         echo self::encode($data);
    //         return true;
    //     }

    //     $status = 404;
    //     echo $this->error('post#users{user_id}', $request->getUri()->getPath() , $status);
    //     return $response->withStatus($status);
    // }

}
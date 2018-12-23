<?php
namespace Controllers\Frontend;

use Respect\Validation\Validator as v;

class Housing extends \Controllers\Base
{
    
    public function index($request, $response)
    {
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 1;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 6;
        
        $data['settings'] = $this->dbt->get_one('about_us');
        $data['cities'] = $this->dbt->get_table('cities');
        $data['types']  = $this->dbt->get_table('housing_types');
        $data['housing'] = $this->dbt->housing_paginate($perPage,$pageNum);

        return $this->views->render($response, 'frontend/housing/all_houses.php', $data);
    }

    public function load_more() 
    {
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 2;

        $data['housing'] = $this->dbt->housing_paginate(6,$pageNum);
        echo json_encode( $data['housing'] );
    }

    public function search($request, $response)
    {
        $city    = ($this->httpPost('city_id')) ? (int) $this->httpPost('city_id') : 0;
        $type    = ($this->httpPost('type_id')) ? (int) $this->httpPost('type_id') : 0;
        $from    = ($this->httpPost('price_from')) ? $this->httpPost('price_from') : 1000;
        $to      = ($this->httpPost('price_to')) ? $this->httpPost('price_to') : 10000000;
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 1;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 6;
        
        $data['cities'] = $this->dbt->get_table('cities');
        $data['types']   = $this->dbt->get_table('housing_types');
        $data['settings'] = $this->dbt->get_one('about_us');
        
        $validations = [ v::intVal()->length(1, 11)->validate($city) ,
                         v::intVal()->length(1, 2 )->validate($type) ,
                         v::intVal()->length(1, 11)->validate($from) ,
                         v::intVal()->length(1, 11)->validate($to)
                       ];
    
        if ($this->validate($validations) === false){
            header('Location: ' . BaseUrl );
            exit;
        }
    
        if ( $_SESSION['token'] == $this->httpPost('token') )
        {
            $query = $this->dbt->search($city, $type, $from, $to, $pageNum, $perPage);
            if ($query)
            {
                foreach ($query as $value) :    
                    $arr[] = [  'id'      => $value['id'], 
                                'title'   => $value['title'], 
                                'price'   => $value['price'], 
                                'type'    => $this->dbt->get_one('housing_types', ['id' => $value['type_id']], 'name'),
                                'address' => $value['address'],
                                'pic'     => $value['pic'],
                             ];
                endforeach;
        
                $data['housing'] = $arr;
                return $this->views->render($response, 'frontend/housing/all_houses.php', $data);
            }else{
                $data['err'] = 'لا توجد نتائج بحث';
                return $this->views->render($response, 'frontend/housing/all_houses.php', $data);                
            }
        }
    }

    public function search_more() 
    {
        $city    = ($this->httpPost('city_id')) ? (int) $this->httpPost('city_id') : 0;
        $type    = ($this->httpPost('type_id')) ? (int) $this->httpPost('type_id') : 0;
        $from    = ($this->httpPost('price_from')) ? $this->httpPost('price_from') : 1000;
        $to      = ($this->httpPost('price_to')) ? $this->httpPost('price_to') : 10000000;
        $pageNum = ($this->httpPost('page_numz')) ? (int) $this->httpPost('page_numz') : 2;
        $perPage = ($this->httpPost('per_page')) ? (int) $this->httpPost('per_page') : 6;

        $query = $this->dbt->search($city, $type, $from, $to, $pageNum, $perPage);
        if ( !empty($query) )
        {
            foreach ($query as $value) :    
                $arr[] = [  'id'      => $value['id'], 
                            'title'   => $value['title'], 
                            'price'   => $value['price'], 
                            'type'    => $this->dbt->get_one('housing_types', ['id' => $value['type_id']], 'name'),
                            'address' => $value['address'],
                            'pic'     => $value['pic'],
                            'lat'     => $value['lat'],
                            'lang'    => $value['lang']
                         ];
            endforeach;
    
            $data['housing'] = $arr;
        }else{
            $data['housing'] = '';
        }
        echo json_encode( $data['housing'] );

    }

    public function single($request, $response, $args)
    {
        $id = (int) $args['id'];

        if ($id) 
        {
            $query     = $this->dbt->get_one('housing', ['id' => $id]);
            $images    = $this->dbt->get_table('images', ['housing_id' => $query['id'],'type' =>1,'type_id' =>1], ['id', 'title', 'link']);
            $panorama  = $this->dbt->get_table('images', ['housing_id' => $query['id'],'type' =>2,'type_id' =>1], ['id', 'title', 'link']);
            $additions = $this->dbt->get_table('housing_additions', ['housing_id' => $query['id']]);
            $phone     = $this->dbt->get_one('about_us',[],'phone');

            if ( !empty( $_SESSION['userid'] ) ) {
                $fav = $this->dbt->get_one('favorite',['token_id'=> $_SESSION['userid'],'type_id'=>1,'number_id'=> $query['id']],'number_id');
            }else{
                $fav = 0;
            }
        }

        if ($query)
        {   
            $data['house'] = $query;
            $data['settings'] = $this->dbt->get_one('about_us');            
            $data['house']['app_phone'] = $phone;
            $data['house']['type'] = $this->dbt->get_one('housing_types', ['id' => $query['type_id'] ], 'name');
            $data['house']['city_id'] = $this->dbt->get_one('cities', ['id' => $query['city_id'] ], 'name');
            $data['house']['is_fav']  = ($fav == $query['id']) ? 1 : 0;
            $thumb[] = ['id'=> 0, 'title'=> $query['title'], 'link'=> $query['pic'] ];
            $data['house']['images'] = array_merge ($thumb , $images) ;

            $three60[] = ['id'=> 0, 'title'=> $query['title'], 'link'=> $query['360_degree'] ];
            $data['house']['panorama'] = array_merge ($three60 , $panorama) ;
            
            if ($additions)
            {   
                foreach ($additions as $value)
                {
                    if($value['value'] == 0)
                    {
                      unset($value);
                    }

                    $types[] = [ 'type'    => $this->dbt->get_one('housing_additions_type', ['id' => @$value['type']], 'type') , 
                                 'value'   => @$value['value'] , 
                                 'type_id' => @$value['type_id'] 
                               ];
                }
                $data['house']['additions'] = $types;
            }

            return $this->views->render($response, 'frontend/housing/single_house.php', $data);
        }

        header('Location: ' . BaseUrl . 'housing' );
        exit;
    }

}
<?php
namespace Controllers\Backend;

class Cities extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'مدينة';
        $data['details'] = 'عرض كل المدن';
        $data['breadcrumb'] = 'المدن';
        $data['cities'] = $this->dbt->get_table('cities');

        return $this->views->render($response, 'backend/cities/all_cities.php', $data);
    }

    public function add($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف مدينة جديدة';
        $data['breadcrumb'] = 'المدن';

        return $this->views->render($response, 'backend/cities/add_city.php', $data);
    }

    public function save($request, $response)
    {
        $this->check();
        $post = $this->httpPost('name');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post) ) {
            $data['err'] = 'خطأ فى أسم المدينة ';
            return $this->views->render($response, 'backend/cities/add_city.php', $data);
        }
        
        $this->dbt->insert_this('cities',['name'=>$post]);
        header('Location: ' . AdminPanel . 'cities' );
        exit;
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل أسم مدينة';
        $data['breadcrumb'] = 'المدن';
        
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['city'] = $this->dbt->get_one('cities',['id'=>$id]);        
            if( empty($data['city']['id']) ){
                header('Location: ' . AdminPanel . 'cities' );
                exit;
            }
            return $this->views->render($response, 'backend/cities/edit_city.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'cities' );
            exit;
        }
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $city = $this->dbt->get_one('cities',['id'=>$id]);
        $post = $this->httpPost('name');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post) ) {
            $data['err'] = 'خطأ فى أسم المدينة ';
            return $this->views->render($response, 'backend/cities/edit_city.php', $data);
        }

        if( $id ) 
        {
            if ( $post ) 
            {
                $this->dbt->update_this('cities',['name'=>$post],['id'=> $city['id'] ]);
                header('Location: ' . AdminPanel . 'cities' );
                exit;
            }
            
        }else{
            header('Location: ' . AdminPanel . 'cities' );
            exit;
        }
    }

}
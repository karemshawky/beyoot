<?php
namespace Controllers\Backend;

class Housing_types extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'نوع عقار';
        $data['details'] = 'عرض كل الأنواع';
        $data['breadcrumb'] = 'الأنواع';
        $data['types'] = $this->dbt->get_table('housing_types');

        return $this->views->render($response, 'backend/housing_types/all_types.php', $data);
    }

    public function add($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف نوع جديد';
        $data['breadcrumb'] = 'الأنواع';

        return $this->views->render($response, 'backend/housing_types/add_type.php', $data);
    }

    public function save($request, $response)
    {
        $this->check();
        $post = $this->httpPost('name');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post) ) {
            $data['err'] = 'خطأ فى النوع  ';
            return $this->views->render($response, 'backend/housing_types/add_type.php', $data);
        }
        
        $this->dbt->insert_this('housing_types',['name'=>$post]);
        header('Location: ' . AdminPanel . 'housing_types' );
        exit;
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل نوع';
        $data['breadcrumb'] = 'الأنواع';
        
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['type'] = $this->dbt->get_one('housing_types',['id'=>$id]);        
            if( empty($data['type']['id']) ){
                header('Location: ' . AdminPanel . 'housing_types' );
                exit;
            }
            return $this->views->render($response, 'backend/housing_types/edit_type.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'housing_types' );
            exit;
        }
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $type = $this->dbt->get_one('housing_types',['id'=>$id]);
        $post = $this->httpPost('name');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post) ) {
            $data['err'] = 'خطأ فى أسم المدينة ';
            return $this->views->render($response, 'backend/housing_types/edit_type.php', $data);
        }

        if( $id ) 
        {
            if ( $post ) 
            {
                $this->dbt->update_this('housing_types',['name'=>$post],['id'=> $type['id'] ]);
                header('Location: ' . AdminPanel . 'housing_types' );
                exit;
            }
            
        }else{
            header('Location: ' . AdminPanel . 'housing_types' );
            exit;
        }
    }

}
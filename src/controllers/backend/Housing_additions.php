<?php
namespace Controllers\Backend;

class Housing_additions extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'تفاصيل لعقار';
        $data['details'] = 'عرض كل التفاصيل';
        $data['breadcrumb'] = 'التفاصيل';
        $data['additions'] = $this->dbt->get_table('housing_additions_type');

        return $this->views->render($response, 'backend/housing_additions/all_additions.php', $data);
    }

    public function add($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف تفاصيل جديدة';
        $data['breadcrumb'] = 'التفاصيل';

        return $this->views->render($response, 'backend/housing_additions/add_additions.php', $data);
    }

    public function save($request, $response)
    {
        $this->check();
        $type = $this->httpPost('type');
        $type_id = $this->httpPost('type_id');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$type) ) {
            $data['err'] = 'خطأ فى أسم الإضافة ';
            return $this->views->render($response, 'backend/housing_additions/add_additions.php', $data);
        }
        
        $this->dbt->insert_this('housing_additions_type',['type'=>$type,'type_id'=>$type_id]);
        header('Location: ' . AdminPanel . 'housing_additions' );
        exit;
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل التفاصيل';
        $data['breadcrumb'] = 'التفاصيل';
        
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['additions'] = $this->dbt->get_one('housing_additions_type',['id'=>$id]);        
            if( empty($data['additions']['id']) ){
                header('Location: ' . AdminPanel . 'housing_additions' );
                exit;
            }
            return $this->views->render($response, 'backend/housing_additions/edit_additions.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'housing_additions' );
            exit;
        }
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $additions = $this->dbt->get_one('housing_additions_type',['id'=>$id]);
        $type = $this->httpPost('type');
        $type_id = $this->httpPost('type_id');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$type) ) {
            $data['err'] = 'خطأ فى أسم الاضافة ';
            return $this->views->render($response, 'backend/housing_additions/edit_additions.php', $data);
        }

        if( $id ) 
        {
            if ( $type ) 
            {
                $this->dbt->update_this('housing_additions_type', ['type'=>$type, 'type_id'=>$type_id],['id'=> $additions['id'] ]);
                header('Location: ' . AdminPanel . 'housing_additions' );
                exit;
            }
            
        }else{
            header('Location: ' . AdminPanel . 'housing_additions' );
            exit;
        }
    }

}
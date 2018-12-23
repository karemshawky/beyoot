<?php
namespace Controllers\Backend;

use Psr\Http\Message\ServerRequestInterface as Request;

class Contact extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = 'أستفسار';
        $data['details'] = 'عرض كل أستفسارات العقارات';
        $data['breadcrumb'] = 'الأستفسارات';
        $data['contact'] = $this->dbt->get_table('contact',['type_id'=>1]);

        return $this->views->render($response, 'backend/contact/all_messages.php', $data);
    }

    public function projects($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = 'أستفسار';
        $data['details'] = 'عرض كل أستفسارات المشاريع';
        $data['breadcrumb'] = 'الأستفسارات';
        $data['contact'] = $this->dbt->get_table('contact',['type_id'=>2]);

        return $this->views->render($response, 'backend/contact/all_messages.php', $data);
    }

    public function show($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض أستفسار';
        $data['breadcrumb'] = 'الأستفسارات';
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['contact'] = $this->dbt->get_one('contact',['id'=>$id]);        
            if( empty($data['contact']['id']) ){
                header('Location: ' . AdminPanel . 'contact' );
                exit;
            }
            return $this->views->render($response, 'backend/contact/show_message.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'contact' );
            exit;
        }
    }
}
<?php
namespace Controllers\Backend;

class Settings extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض كل المعلومات';
        $data['breadcrumb'] = 'المعلومات';
        $data['settings'] = $this->dbt->get_table('about_us');

        return $this->views->render($response, 'backend/settings/all_settings.php', $data);
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل المعلومات ';
        $data['breadcrumb'] = 'المعلومات';   

        $data['settings'] = $this->dbt->get_one('about_us',['id'=>1]);        
        return $this->views->render($response, 'backend/settings/edit_setting.php', $data);
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $post = $this->httpPostAll();
        if ( $post ) 
        {
            unset($post['_METHOD']);
            $this->dbt->update_this('about_us',$post,['id'=> 1 ]);
            header('Location: ' . AdminPanel . 'settings' );
            exit;
        }

    }
}
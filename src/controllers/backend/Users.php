<?php
namespace Controllers\Backend;

class Users extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض كل المستخدمين';
        $data['breadcrumb'] = 'المستخدمين';
        $data['users'] = $this->dbt->get_table('users',[],['id','name','phone','created_date']);

        return $this->views->render($response, 'backend/users/all_users.php', $data);
    }

}
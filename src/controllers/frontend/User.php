<?php
namespace Controllers\Frontend;

use Respect\Validation\Validator as v;
use Intervention\Image\ImageManager;

class User extends \Controllers\Base
{
    public function index($request, $response)
    {
        if ( !$_SESSION['username'] ) {
            header('Location: ' . BaseUrl );
            exit;
        }

        $data['settings'] = $this->dbt->get_one('about_us');

        $id = ( !empty( $_SESSION['userid'] ) ) ? $_SESSION['userid'] : 0;

        if ($id) {
            $allFav  = $this->dbt->get_table('favorite', ['token_id' => $id,'type_id'=> 1]);
            $allFav1 = $this->dbt->get_table('favorite', ['token_id' => $id,'type_id'=> 2]);
            $allFav2 = $this->dbt->get_table('favorite', ['token_id' => $id,'type_id'=> 3]);
        }
            
        if ( !empty($allFav) ) 
        {
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

            if ( !empty ($arr) ) 
            {
                $query = $this->dbt->get_favfront('housing', null, ['id','IN'] , $arr, ['id', 'title', 'price', 'type_id', 'address', 'pic'] , ['created_date', 'desc'] );                
                foreach ($query as $result) :
                    $results[] = [  'id'      => $result['id'], 
                                    'title'   => $result['title'], 
                                    'price'   => $result['price'], 
                                    'type'    => $this->dbt->get_one('housing_types', ['id' => $result['type_id']], 'name') , 
                                    'address' => $result['address'], 
                                    'pic'     => $result['pic']
                                ];
                endforeach;
                $data['housing'] = $results;
            }else{
                $data['housing'] = '';
            }

            if ( !empty ($arr25) ) 
            {
                $query2 = $this->dbt->get_favfront('blog', 1, ['id','IN'] , $arr25, ['id', 'title', 'details',  'pic', 'type_id'] , ['created_date', 'desc'] );  
                foreach ($query2 as $result2) :
                    $arr2[] = [ 'id'      => $result2['id'], 
                                'title'   => $result2['title'], 
                                'details' => $result2['details'], 
                                'pic'     => $result2['pic'],
                                'type'    => 'سياحة',
                                ];
                endforeach;
                $data['tourisms'] = $arr2;
            }else{
                $data['tourisms'] = '';
            }

            if ( !empty ($arr26) ) 
            {
                $query3 = $this->dbt->get_favfront('blog', 2, ['id','IN'] , $arr26, ['id', 'title', 'details',  'pic', 'type_id'] , ['created_date', 'desc'] );  
                foreach ($query3 as $result3) :
                    $arr3[] = [ 'id'      => $result3['id'], 
                                'title'   => $result3['title'], 
                                'details' => $result3['details'], 
                                'pic'     => $result3['pic'],
                                'type'    => 'أعمال',
                                ];
                endforeach;
                $data['business'] = $arr3;
            }else{
                $data['business'] = '';
            }

            return $this->views->render($response, 'frontend/user/all_fav.php', $data);
        }

        return $this->views->render($response, 'frontend/user/all_fav.php');

    }

    public function user_register($request, $response)
    {
        $post = $this->httpPostAll();
        $post['token_id'] = make_token();
        $post['created_date'] = date('Y-m-d H:i:s');
        
        $validations = [ v::phone()->length(1, 30)->validate($post['phone']) ];

        if ($this->validate($validations) === false || !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['name']) ) {
            return $response->withJson(['message'=>' خطأ فى كتابة الاسم أو رقم الهاتف ']);
        }
        
        if ($post['phone']) {
            $check = $this->dbt->get_table('users', ['phone'=>$post['phone']]);
        }

        if ($check) {
            return $response->withJson(['message'=>'هاتف موجود بالفعل ... أختر رقم هاتف مختلف أو قم بتسجيل الدخول']);
        }

        if ( $_SESSION['token'] == $post['token'] ) 
        {
            if ($post['name'] && $post['phone']) 
            {
                unset($post['token']);
                if ( $post['phone'][0] != '+' )
                {
                    $post['phone'] = '+' . $post['phone'];
                }

                $this->dbt->insert_this('users', $post);
                return $response->withJson(['succ'=>' تم تسجيلك بنجاح .. سجل دخولك برقم الهاتف ']);
            }
        }
    }

    public function user_login($request, $response)
    {
        $phone = $this->httpPost('phone');

        if($phone) {
            $query  = $this->dbt->get_one('users', ['phone' => $phone]);
        }

        if ( !empty($query) ) {
            $results = $this->dbt->get_one('users', ['phone' => $phone]);
            $_SESSION['userid'] = $results['token_id'];
            $_SESSION['username'] = $results['name'];
            $_SESSION['userphone'] = $results['phone'];
            header('Location: ' . BaseUrl );
            exit;
        }
    }

    public function user_logout($request, $response)
    {
        session_destroy(); 
        header('Location: ' . BaseUrl );
        exit;
    }

    public function add_user_favorite($request, $response)
    {
        if ( !$_SESSION['username'] ) {
            header('Location: ' . BaseUrl );
            exit;
        }

        $post['token_id']  = ($_SESSION['userid']) ? $_SESSION['userid'] : 0;
        $post['type_id']   = $this->httpPost('type_id');
        $post['number_id'] = ($this->httpPost('number_id')) ? $this->httpPost('number_id') : 0;
        $post['created_date'] = date('Y-m-d H:i:s');

        $validations = [ v::intVal()->length(1,11)->validate($post['type_id']) ,
                         v::intVal()->length(1,11)->validate($post['number_id'])
                       ];
        
        if ($this->validate($validations) === false) {
            header('Location: ' . BaseUrl );
            exit;
        }

        if( $post['token_id'] && $post['type_id'] && $post['number_id']) 
        {
            $this->dbt->insert_this('favorite', $post);
            header('Location: ' . $_SERVER['HTTP_REFERER'] );
            exit;
        }
    }


    public function del_user_favorite($request, $response)
    {
        if ( !$_SESSION['username'] ) {
            header('Location: ' . BaseUrl );
            exit;
        }

        $post['token_id']  = ($_SESSION['userid']) ? $_SESSION['userid'] : 0;
        $post['type_id']   = $this->httpPost('type_id');
        $post['number_id'] = ($this->httpPost('number_id')) ? $this->httpPost('number_id') : 0;
        $post['created_date'] = date('Y-m-d H:i:s');

        $validations = [ v::intVal()->length(1,11)->validate($post['type_id']) ,
                         v::intVal()->length(1,11)->validate($post['number_id'])
                       ];
        
        if ($this->validate($validations) === false) {
            header('Location: ' . BaseUrl );
            exit;
        }

        $check = $this->dbt->get_table('favorite', ['token_id'=> $post['token_id'], 'type_id'=> $post['type_id'], 'number_id'=> $post['number_id'] ]);

        if ( $post['token_id'] && $post['type_id']  && $post['number_id']) 
        {
            $query = $this->dbt->get_one('favorite', ['token_id' => $post['token_id'],'type_id'=> $post['type_id'],'number_id'=> $post['number_id']]);
            if ($query) {
                $this->dbt->delete_this('favorite', ['token_id' => $post['token_id'],'type_id'=> $post['type_id'],'number_id'=> $post['number_id']]);
                header('Location: ' . $_SERVER['HTTP_REFERER'] );
                exit;
            }
        }
        
    }

}
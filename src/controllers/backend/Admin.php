<?php
namespace Controllers\Backend;

class Admin extends \Controllers\Base
{
    public function index($request, $response)
    {
        if( $_SESSION['name'] ){
            header('Location: ' . AdminPanel . 'main' );
            exit;
        }
        return $this->views->render($response, 'backend/login.php');
    }

    public function login($request, $response)
    {
        $name = $this->httpPost('name');
        $pass = $this->httpPost('password');
        $token = $this->httpPost('token');

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$name) ) {
            $data['err'] = 'خطأ فى الاسم أو الرقم السرى  ';
            return $this->views->render($response, 'backend/login.php', $data);
        }

        if ( $_SESSION['token'] == $token ) {

            $login = $this->dbt->admin_login($name, md5( md5( sha1($pass) ) ) );
    
            if ( $login ) {
                $_SESSION['name'] = $login['name']; 
                if ( $_SESSION['name'] ) {
                    header('Location: ' . AdminPanel . 'main' );
                    exit;
                }
            }else{
                $data['err'] = 'خطأ فى الاسم أو الرقم السرى  ';
                return $this->views->render($response, 'backend/login.php', $data);
            }
        }

        return $this->views->render($response, 'backend/login.php');
    }

    public function logout($request, $response)
    {
        session_destroy(); 
        header('Location: ' . AdminPanel . 'login' );
        exit;
    }

}
<?php

namespace Controllers\Frontend;

use Respect\Validation\Validator as v;

class Contact extends \Controllers\Base
{

    public function send($request, $response)
    {
        $post = $this->httpPostAll();
        $post['created_date'] = date('Y-m-d H:i:s');

        if ( $_SESSION['token'] == $post['token']) 
        {
            $validations = [ v::phone()->length(1, 30)->validate($post['phone']) ,
                             v::email()->length(1, 255)->validate($post['email'])
                        ];

            if ( $this->validate($validations) === false || 
                !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['name']) || 
                !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['details']) ) 
            {
                return false;
            }else{
                    unset($post['token']);
                    $query = $this->dbt->insert_this('contact', $post);
            }
        }
    }
}
<?php

namespace Middlewares;

use Slim\Middleware\HttpBasicAuthentication\AuthenticatorInterface;

class BasicAuth implements AuthenticatorInterface 
{

    public function __invoke(array $args)
    {
        $user = $args['user'];
        $pswd = $args['password'];

        if ($user == 'beyoot' && $pswd == '2@e637e697d54#') { 
            return true;
        }    
        echo "Error in Authentication"; 
        exit;
    }

}
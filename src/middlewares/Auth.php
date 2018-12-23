<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Models\BeyootModel as Models;

class Auth 
{
    /**
     * Check if real user by his token id or by app secret token
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $dbt = new Models;
        $app_secret_token = 'ff2cbc5671938162e637e6975cc4cf8d5';

        $user = '';
        $get_token = $request->getParsedBody()['token'];
        $token_id  = $dbt->get_table('users',['token_id'=> $get_token]);
        
        if($token_id)
            $user = $token_id[0]['token_id'];
    
        if ( $get_token == $user ) :
            $newResponse = $next($request, $response);            
            return $newResponse;
        elseif ( $get_token == $app_secret_token ) :
            $newResponse = $next($request, $response);            
            return $newResponse;
        else :
            exit;
        endif;
    }

}
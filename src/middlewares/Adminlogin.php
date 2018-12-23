<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
// use Slim\Views\PhpRenderer as Rend;
use Models\BeyootModel as Models;
//use Slim\Interfaces\RouterInterface as Router;


class AdminLogin
{
     /**
      * To make new object from view
      *
      * @var Slim\Views\PhpRenderer
      */
      protected $views;
    /**
     * To make new object from database
     *
     * @var string 
     */
     protected $dbt;

    // protected $router;

    // public function __construct(Router $router) {
    //     $this->router = $router;
    // }

    /**
     * Admin login middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     */
    public function __invoke($request, $response, $next)
    {
        // $this->views = new Rend("templates/");
        $this->dbt = new Models;
        
        // $name = $request->getParsedBody()['name'];
        // $pass = $request->getParsedBody()['pass']; 


        // if ( $name && $pass ) 
        // {
        //     if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$name) ) {
        //         $data['err'] = 'خطأ فى الاسم أو الرقم السرى   ';
        //         $response->withRedirect( BaseUrl . '/admin-panel/login')->write($data);
        //         return $response;
        //     }

        //     $login = $this->dbt->admin_login($name, md5( md5( sha1($pass) ) ) );
        //     if ( $login ) {
        //         $_SESSION['name'] = $login['name']; 
        //     }

        //     if ( $_SESSION['name'] ) {
        //         $response = $next($request, $response);
        //         $response->withRedirect( BaseUrl . '/admin-panel/main');
        //         return $response;
        //     }
        // }



        $response->withRedirect( BaseUrl . '/admin-panel/login');
        $response = $next($request, $response);
        //$response->getBody()->write('AFTER');

        return $response;

        // if (!isset($_SESSION['name'])) {
        //     return $response->withRedirect($this->router->pathFor('adminlg'));
        // }

        // return $next($request, $response);

    }

}
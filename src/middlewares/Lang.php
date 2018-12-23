<?php

namespace Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class lang
{
    /**
     * Login middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        if (!isset($_COOKIE['lang']))
        {
            setcookie('lang', 'en', time() + 60 * 60 * 24 * 365);
            $_COOKIE['lang'] = 'en';
        }
        else
        {
            if (isset($_GET['lang']))
            {
                if ($_GET['lang'] == 'ar')
                {
                    setcookie('lang', 'ar', time() + 60 * 60 * 24 * 365);
                    $_COOKIE['lang'] = 'ar';
                }
                else
                {
                    setcookie('lang', 'en', time() + 60 * 60 * 24 * 365);
                    $_COOKIE['lang'] = 'en';

                }
            }
        }
        $newResponse = $next($request, $response);
        //$newResponse->getBody()->write('AFTER');
        return $newResponse;
    }

}
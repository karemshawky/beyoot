<?php

if ( !function_exists ('make_token') ) 
{

    function make_token() 
    {
        return md5(uniqid(rand(), true));
    }
}

if ( !function_exists ('genStr') ) 
{

    function genStr() 
    {
        return substr(md5(mt_rand()), 0, 7);
    }
}

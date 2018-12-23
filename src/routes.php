<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;


// Front-End
$app->get('/','Controllers\Frontend\First:index'); //->add( new Middlewares\Lang )->setName('index');
$app->get('/blogs/{type}','Controllers\Frontend\Blogs:show');
$app->post('/blogs/load','Controllers\Frontend\Blogs:load_more');
$app->get('/blogs/news/{id}','Controllers\Frontend\Blogs:single');
$app->get('/blogs/mob/{id}','Controllers\Frontend\Blogs:singlemob');

$app->get('/projects','Controllers\Frontend\Projects:index');
$app->post('/projects/load','Controllers\Frontend\Projects:load_more');
$app->get('/projects/details/{id}','Controllers\Frontend\Projects:single');
$app->get('/projects/three60/{url}','Controllers\Frontend\Projects:three60');

$app->get('/housing','Controllers\Frontend\Housing:index');
$app->get('/housing/details/{id}','Controllers\Frontend\Housing:single');
$app->post('/housing/load','Controllers\Frontend\Housing:load_more');
$app->post('/housing/search','Controllers\Frontend\Housing:search');
$app->post('/housing/search/load','Controllers\Frontend\Housing:search_more');

$app->get('/user/fav','Controllers\Frontend\User:index');
$app->post('/user/reg', 'Controllers\Frontend\User:user_register');
$app->post('/user/login','Controllers\Frontend\User:user_login');
$app->get('/user/logout', 'Controllers\Frontend\User:user_logout');
$app->post('/user/addfav', 'Controllers\Frontend\User:add_user_favorite');
$app->delete('/user/delfav',  'Controllers\Frontend\User:del_user_favorite');

$app->post('/contact/send','Controllers\Frontend\Contact:send');

// Back-End
$app->group('/admin-panel', function () {

    $this->get('/login','Controllers\Backend\Admin:index');
    $this->post('/login','Controllers\Backend\Admin:login');
    $this->get('/logout','Controllers\Backend\Admin:logout');
    
    $this->get('/main','Controllers\Backend\Main:index');
    $this->get('/main/slider','Controllers\Backend\Main:slider');
    $this->get('/main/slider/add','Controllers\Backend\Main:slider_add');
    $this->post('/main/slider/save','Controllers\Backend\Main:slider_save');
    $this->get('/main/slider/show/{id}','Controllers\Backend\Main:slider_show');
    $this->get('/main/slider/edit/{id}','Controllers\Backend\Main:slider_edit');
    $this->put('/main/slider/update/{id}','Controllers\Backend\Main:slider_update');
    $this->delete('/main/slider/delete/{id}','Controllers\Backend\Main:slider_delete');

    $this->get('/blog','Controllers\Backend\Blog:index');
    $this->get('/blog/show/{id}','Controllers\Backend\Blog:show');
    $this->get('/blog/add','Controllers\Backend\Blog:add');
    $this->post('/blog/save','Controllers\Backend\Blog:save');
    $this->get('/blog/edit/{id}','Controllers\Backend\Blog:edit');
    $this->put('/blog/update/{id}','Controllers\Backend\Blog:update');
    $this->delete('/blog/delete/{id}','Controllers\Backend\Blog:delete');

    $this->get('/project','Controllers\Backend\Project:index');
    $this->get('/project/show/{id}','Controllers\Backend\Project:show');
    $this->get('/project/add','Controllers\Backend\Project:add');
    $this->post('/project/save','Controllers\Backend\Project:save');
    $this->get('/project/edit/{id}','Controllers\Backend\Project:edit');
    $this->put('/project/update/{id}','Controllers\Backend\Project:update');
    $this->delete('/project/delete/{id}','Controllers\Backend\Project:delete');
    $this->get('/project/addimg/{id}','Controllers\Backend\Project:add_img');
    $this->post('/project/saveimg','Controllers\Backend\Project:save_img');
    $this->delete('/project/delimg/{id}','Controllers\Backend\Project:delete_img');

    $this->get('/housing','Controllers\Backend\Housing:index');
    $this->get('/housing/show/{id}','Controllers\Backend\Housing:show');
    $this->get('/housing/add','Controllers\Backend\Housing:add');
    $this->post('/housing/save','Controllers\Backend\Housing:save');
    $this->get('/housing/edit/{id}','Controllers\Backend\Housing:edit');
    $this->put('/housing/update/{id}','Controllers\Backend\Housing:update');
    $this->delete('/housing/delete/{id}','Controllers\Backend\Housing:delete');
    $this->get('/housing/addimg/{id}','Controllers\Backend\Housing:add_img');
    $this->get('/housing/addpanorama/{id}','Controllers\Backend\Housing:add_panorama');
    $this->post('/housing/saveimg','Controllers\Backend\Housing:save_img');
    $this->delete('/housing/delimg/{id}','Controllers\Backend\Housing:delete_img');

    $this->get('/cities','Controllers\Backend\Cities:index');
    $this->get('/cities/add','Controllers\Backend\Cities:add');
    $this->post('/cities/save','Controllers\Backend\Cities:save');
    $this->get('/cities/edit/{id}','Controllers\Backend\Cities:edit');
    $this->put('/cities/update/{id}','Controllers\Backend\Cities:update');

    $this->get('/housing_types','Controllers\Backend\Housing_types:index');
    $this->get('/housing_types/add','Controllers\Backend\Housing_types:add');
    $this->post('/housing_types/save','Controllers\Backend\Housing_types:save');
    $this->get('/housing_types/edit/{id}','Controllers\Backend\Housing_types:edit');
    $this->put('/housing_types/update/{id}','Controllers\Backend\Housing_types:update');

    $this->get('/housing_additions','Controllers\Backend\Housing_additions:index');
    $this->get('/housing_additions/add','Controllers\Backend\Housing_additions:add');
    $this->post('/housing_additions/save','Controllers\Backend\Housing_additions:save');
    $this->get('/housing_additions/edit/{id}','Controllers\Backend\Housing_additions:edit');
    $this->put('/housing_additions/update/{id}','Controllers\Backend\Housing_additions:update');

    $this->get('/contact','Controllers\Backend\Contact:index');
    $this->get('/contact/projects','Controllers\Backend\Contact:projects');
    $this->get('/contact/show/{id}','Controllers\Backend\Contact:show');

    $this->get('/settings','Controllers\Backend\Settings:index');
    $this->get('/settings/edit/{id}','Controllers\Backend\Settings:edit');
    $this->put('/settings/update/{id}','Controllers\Backend\Settings:update');

    $this->get('/users','Controllers\Backend\Users:index');

    
});//->add( new Middlewares\AdminLogin() );//->setName('adminlg');

// Apis
$app->group('/apis', function () {
    
    $this->post('/users/number', 'Apis\Users:check_number_exist');
    $this->post('/users/tknfcm', 'Apis\Users:update_fcm_token');
    $this->post('/users/register', 'Apis\Users:user_register');
    $this->post('/users/login', 'Apis\Users:user_login');
    $this->post('/users/getfav', 'Apis\Users:get_user_favorite');
    $this->post('/users/addfav', 'Apis\Users:add_user_favorite');
    $this->post('/users/delfav', 'Apis\Users:remove_user_favorite');
    $this->post('/users/deluser', 'Apis\Users:delete_user');

    $this->post('/projects/single', 'Apis\Projects:get_single_project');
    $this->post('/projects/latest', 'Apis\Projects:get_our_projects');

    $this->post('/blogs/single', 'Apis\Blog:get_single_blog_news');
    $this->post('/blogs/latest', 'Apis\Blog:get_latest_blog_news');
    $this->post('/blogs/residual', 'Apis\Blog:get_residual_blog_news');
    
    $this->post('/houses/single', 'Apis\Housing:get_single_house');
    $this->post('/houses/details', 'Apis\Housing:search_details');
    $this->post('/houses/latest', 'Apis\Housing:get_housing');
    $this->post('/houses/search', 'Apis\Housing:get_search');

    $this->post('/contact/', 'Apis\Housing:contact_message');
    
});
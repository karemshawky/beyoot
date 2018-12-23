<?php
namespace Controllers\Backend;

use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use \Gumlet\ImageResize;

class Blog extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'مقال';
        $data['details'] = 'عرض كل المقالات';
        $data['breadcrumb'] = 'المقالات';
        $data['news'] = $this->dbt->get_table('blog',[],['id','title','type_id','created_date'],['created_date','desc']);

        return $this->views->render($response, 'backend/blog/all_news.php', $data);
    }

    public function show($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض مقال';
        $data['breadcrumb'] = 'المقالات';
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['blog'] = $this->dbt->get_one('blog',['id'=>$id]);        
            if( empty($data['blog']['id']) ){
                header('Location: ' . AdminPanel . 'blog' );
                exit;
            }
            return $this->views->render($response, 'backend/blog/show_news.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'blog' );
            exit;
        }
    }
    
    public function add($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف مقال جديد';
        $data['breadcrumb'] = 'المقالات';

        return $this->views->render($response, 'backend/blog/add_news.php', $data);
    }

    public function save($request, $response)
    {
        $this->check();
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['upload'];        

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['title']) ) {
            $data['err'] = 'خطأ فى عنوان الخبر ';
            return $this->views->render($response, 'backend/blog/add_news.php', $data);
        }

        $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
        if ( in_array( $ext , $vd ) ) {
            $pic = date('d-m-Y').'-'.$files['name'];
            $this->uploadImages($files['tmp_name'] , $path .'files/'. $pic );
            $this->resizeImages($files['tmp_name'], $path . 'thumbs/'. $pic, 1024,693,'crop');
        }else{
            $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
            return $this->views->render($response, 'backend/blog/add_news.php', $data);
        }
        
        $post['pic'] = $pic;
        $post['created_date'] = date('Y-m-d h:i:s');
        $this->dbt->insert_this('blog',$post);
        header('Location: ' . AdminPanel . 'blog' );
        exit;
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل مقال ';
        $data['breadcrumb'] = 'المقالات';   
        
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['blog'] = $this->dbt->get_one('blog',['id'=>$id]);        
            if( empty($data['blog']['id']) ){
                header('Location: ' . AdminPanel . 'blog' );
                exit;
            }
            return $this->views->render($response, 'backend/blog/edit_news.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'blog' );
            exit;
        }
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $data['blog'] = $blog = $this->dbt->get_one('blog',['id'=>$id]);
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['upload'];    

        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu",$post['title']) ) {
            $data['err'] = 'خطأ فى عنوان الخبر ';
            return $this->views->render($response, 'backend/blog/edit_news.php', $data);
        }

        if( $id ) 
        {
            if ( $files['error'] == 0 ) 
            {
                unlink( 'uploads/img/files/' . $blog['pic']);
                unlink( 'uploads/img/thumbs/' . $blog['pic']);
                $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $pic = date('d-m-Y').'-'.genStr().'-'.$files['name'];
                    $this->uploadImages($files['tmp_name'] , $path .'files/'. $pic );
                    $this->resizeImages($files['tmp_name'], $path . 'thumbs/'. $pic, 1024,693,'crop');
                }else{
                    $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                    return $this->views->render($response, 'backend/blog/edit_news.php', $data);
                }
                $post['pic'] = $pic;
            }

            if ( $post ) 
            {
                unset($post['_METHOD']);
                $post['created_date'] = date('Y-m-d h:i:s');
                $this->dbt->update_this('blog',$post,['id'=> $blog['id'] ]);
                header('Location: ' . AdminPanel . 'blog' );
                exit;
            }
            
        }else{
            header('Location: ' . AdminPanel . 'blog' );
            exit;
        }
    }

    public function delete($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        if( $id ) 
        {
            $blog = $this->dbt->get_one('blog',['id'=>$id]); 
            unlink( 'uploads/img/files/' . $blog['pic']);
            unlink( 'uploads/img/thumbs/' . $blog['pic']);        
            $this->dbt->delete_this('blog',['id'=>$id]);
            header('Location: ' . AdminPanel . 'blog' );
            exit;
        }else{
            header('Location: ' . AdminPanel . 'blog' );
            exit;
        }
    }
}
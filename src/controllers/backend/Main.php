<?php
namespace Controllers\Backend;

use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use \Gumlet\ImageResize;

class Main extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'الرئيسية';
        $data['breadcrumb'] = '';
        $data['housing'] = $this->dbt->count('housing','id');
        $data['projects'] = $this->dbt->count('our_projects','id');
        $data['bussiness'] = $this->dbt->count_where('blog','id',['type_id'=>1]);
        $data['tourism'] = $this->dbt->count_where('blog','id',['type_id'=>2]);
        $data['cities'] = $this->dbt->count('cities','id');
        $data['users'] = $this->dbt->count('users','id');

        return $this->views->render($response, 'backend/index.php', $data);
    }

    public function slider($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'صورة متحركة';
        $data['details'] = 'كل الصور المتحركة فى الصفحة الرئيسية فى الموقع';
        $data['breadcrumb'] = 'الصور المتحركة';

        $data['sliders'] = $this->dbt->get_table('slider');

        return $this->views->render($response, 'backend/slider/all_slider.php', $data);
    }

    public function slider_show($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض الصورة';
        $data['breadcrumb'] = 'الصور المتحركة';
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['slider'] = $this->dbt->get_one('slider',['id'=>$id]);

            if( empty($data['slider']['id']) ){
               header('Location: ' . AdminPanel . 'main/slider' );
                exit;
            }
            return $this->views->render($response, 'backend/slider/show_slider.php', $data);
        }else{
           header('Location: ' . AdminPanel . 'main/slider' );
            exit;
        }
    }

    public function slider_add($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف صورة متحركة ';
        $data['breadcrumb'] = 'الصور المتحركة';   
        
        return $this->views->render($response, 'backend/slider/add_slider.php', $data);
    }

    public function slider_save($request, $response, $args)
    {
        $this->check();
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['upload'];    

        if ( $files['error'] == 0 ) 
        {
            $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $pic = date('d-m-Y').'-'.genStr().'-'.$files['name'];
                $this->resizeImages($files['tmp_name'], $path . 'slider/'. $pic, 1440,957,'crop');
            }else{
                $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                return $this->views->render($response, 'backend/slider/edit_slider.php', $data);
            }
            $post['pic'] = $pic;
        }

        if ( $post ) 
        {
            if ( $post['position'] == 1 )    : $post['position_en'] = "top-right"; 
            elseif( $post['position'] == 2 ) : $post['position_en'] = "bottom-right"; 
            elseif( $post['position'] == 3 ) : $post['position_en'] = "top-left"; 
            elseif( $post['position'] == 4 ) : $post['position_en'] = "bottom-left"; 
            endif; 
            
            $this->dbt->insert_this('slider',$post);
            header('Location: ' . AdminPanel . 'main/slider' );
            exit;
        }
            
    }


    public function slider_edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل صورة متحركة ';
        $data['breadcrumb'] = 'الصور المتحركة';   
        
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['slider'] = $this->dbt->get_one('slider',['id'=>$id]);

            if( empty($data['slider']['id']) ){
                header('Location: ' . AdminPanel . 'main/slider' );
                exit;
            }
            return $this->views->render($response, 'backend/slider/edit_slider.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'main/slider' );
            exit;
        }
    }

    public function slider_update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $data['slider'] = $slider = $this->dbt->get_one('slider',['id'=>$id]);
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['upload'];    

        if( $id ) 
        {
            if ( $files['error'] == 0 ) 
            {
                @unlink( 'uploads/img/slider/' . $project['pic']);
                $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $pic = date('d-m-Y').'-'.genStr().'-'.$files['name'];
                    $this->resizeImages($files['tmp_name'], $path . 'slider/'. $pic, 1440,957,'crop');
                }else{
                    $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                    return $this->views->render($response, 'backend/slider/edit_slider.php', $data);
                }
                $post['pic'] = $pic;
            }

            if ( $post ) 
            {
                if ( $post['position'] == 1 )    : $post['position_en'] = "top-right"; 
                elseif( $post['position'] == 2 ) : $post['position_en'] = "bottom-right"; 
                elseif( $post['position'] == 3 ) : $post['position_en'] = "top-left"; 
                elseif( $post['position'] == 4 ) : $post['position_en'] = "bottom-left"; 
                endif; 
             
                unset($post['_METHOD']);                
                $this->dbt->update_this('slider',$post,['id'=> $slider['id'] ]);
                header('Location: ' . AdminPanel . 'main/slider' );
                exit;
            }
            
        }else{
            header('Location: ' . AdminPanel . 'main/slider' );
            exit;
        }
    }

    public function slider_delete($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        if( $id ) 
        {
            $slider = $this->dbt->get_one('slider',['id'=>$id]); 
            unlink( 'uploads/img/slider/' . $slider['pic']);
            $this->dbt->delete_this('slider',['id'=>$id]);
            header('Location: ' . AdminPanel . 'main/slider' );
            exit;
        }else{
            header('Location: ' . AdminPanel . 'main/slider' );
            exit;
        }
    }

}
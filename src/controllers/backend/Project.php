<?php
namespace Controllers\Backend;

use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use \Gumlet\ImageResize;

class Project extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'مشروع';
        $data['details'] = 'عرض كل المشاريع';
        $data['breadcrumb'] = 'المشاريع';
        $data['projects'] = $this->dbt->get_table('our_projects',[],['id','title','details','current_phase','address','created_date'],['created_date','desc']);

        return $this->views->render($response, 'backend/projects/all_projects.php', $data);
    }

    public function show($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض مشروع';
        $data['breadcrumb'] = 'المشاريع';
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['project'] = $this->dbt->get_one('our_projects',['id'=>$id]);
            $data['images'] = $this->dbt->get_table('images',['type_id'=> 2,'housing_id'=> $data['project']['id']] ,['id','title','link']);          
            if( empty($data['project']['id']) ){
                header('Location: ' . AdminPanel . 'project' );
                exit;
            }
            return $this->views->render($response, 'backend/projects/show_project.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'project' );
            exit;
        }
    }

    public function add($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف مشروع جديد';
        $data['breadcrumb'] = 'المشاريع';

        $gmap = new \Map\GoogleMapAPI();
        $gmap->setDivId('test1');
        $gmap->setDirectionDivId('route');
        $gmap->setCenter('Sarajevo ');
        $gmap->setEnableWindowZoom(true);
        $gmap->setEnableAutomaticCenterZoom(false);
        $gmap->setDisplayDirectionFields(true);
        $gmap->setSize('1200px','600px');
        $gmap->setZoom(11);
        $gmap->setLang('en');
        $gmap->setDefaultHideMarker(false);

        $coordtab []= array('sarajevo bosnia','Sarajevo','<strong>html Sarajevo</strong>');
        $gmap->addArrayMarkerByAddress($coordtab,'cat2');
        $gmap->generate();

        $data['map'] = $gmap->getGoogleMap();

        return $this->views->render($response, 'backend/projects/add_project.php', $data);
    }

    public function save($request, $response)
    {
        $this->check();
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['upload'];        

        if ($this->filter_it( $post['title'] ) == false ) {
            $data['errTitle'] = 'خطأ فى أسم المشروع ';
            return $this->views->render($response, 'backend/projects/add_project.php', $data);                
        }

        if ($this->filter_it( $post['address'] ) == false ) {
            $data['errAddress'] = 'خطأ فى عنوان المشروع ';
            return $this->views->render($response, 'backend/projects/add_project.php', $data);                
        }
        
        if ($this->filter_it( $post['current_phase'] ) == false ) {
            $data['errPhase'] = 'خطأ فى مرحلة المشروع ';
            return $this->views->render($response, 'backend/projects/add_project.php', $data);
        }

        if ( !preg_match("/^[0-9 -]+(\\.[0-9]+)?$/",$post['lat']) ) {
            $data['errLat'] = 'خطأ فى  خط العرض ';     
            return $this->views->render($response, 'backend/projects/add_project.php', $data);           
        }

        if ( !preg_match("/^[0-9 -]+(\\.[0-9]+)?$/",$post['lang']) ) {
            $data['errLang'] = 'خطأ فى خط الطول ';   
            return $this->views->render($response, 'backend/projects/add_project.php', $data);             
        }

        $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
        if ( in_array( $ext , $vd ) ) {
            $pic = date('d-m-Y').'-'.$files['name'];
            $this->uploadImages($files['tmp_name'] , $path .'files/'. $pic );
            $this->resizeImages($files['tmp_name'] , $path . 'thumbs/'. $pic, 1024,693,'crop');
        }else{
            $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
            return $this->views->render($response, 'backend/projects/add_project.php', $data);
        }
        
        $post['pic'] = $pic;
        $post['created_date'] = date('Y-m-d h:i:s');
        $this->dbt->insert_this('our_projects',$post);
        header('Location: ' . AdminPanel . 'project' );
        exit;
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل مشروع ';
        $data['breadcrumb'] = 'المشاريع';
        
        $gmap = new \Map\GoogleMapAPI();
        $gmap->setDivId('test1');
        $gmap->setDirectionDivId('route');
        $gmap->setCenter('Sarajevo ');
        $gmap->setEnableWindowZoom(true);
        $gmap->setEnableAutomaticCenterZoom(false);
        $gmap->setDisplayDirectionFields(true);
        $gmap->setSize('1200px','600px');
        $gmap->setZoom(11);
        $gmap->setLang('en');
        $gmap->setDefaultHideMarker(false);

        $coordtab []= array('sarajevo bosnia','Sarajevo','<strong>html Sarajevo</strong>');
        $gmap->addArrayMarkerByAddress($coordtab,'cat2');
        $gmap->generate();

        $data['map'] = $gmap->getGoogleMap();
        
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['project'] = $this->dbt->get_one('our_projects',['id'=>$id]);        
            if( empty($data['project']['id']) ){
                header('Location: ' . AdminPanel . 'project' );
                exit;
            }
            return $this->views->render($response, 'backend/projects/edit_project.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'project' );
            exit;
        }
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $data['project'] = $project = $this->dbt->get_one('our_projects',['id'=>$id]);
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['upload'];    

        if ($this->filter_it( $post['title'] ) == false ) {
            $data['errTitle'] = 'خطأ فى أسم المشروع ';
            return $this->views->render($response, 'backend/projects/edit_project.php', $data);                
        }

        if ($this->filter_it( $post['address'] ) == false ) {
            $data['errAddress'] = 'خطأ فى عنوان المشروع ';
            return $this->views->render($response, 'backend/projects/edit_project.php', $data);                
        }
        
        if ($this->filter_it( $post['current_phase'] ) == false ) {
            $data['errPhase'] = 'خطأ فى مرحلة المشروع ';
            return $this->views->render($response, 'backend/projects/edit_project.php', $data);
        }

        if ( !preg_match("/^[0-9 -]+(\\.[0-9]+)?$/",$post['lat']) ) {
            $data['errLat'] = 'خطأ فى  خط العرض ';     
            return $this->views->render($response, 'backend/projects/edit_project.php', $data);           
        }

        if ( !preg_match("/^[0-9 -]+(\\.[0-9]+)?$/",$post['lang']) ) {
            $data['errLang'] = 'خطأ فى خط الطول ';   
            return $this->views->render($response, 'backend/projects/edit_project.php', $data);             
        }

        if( $id ) 
        {
            if ( $files['error'] == 0 ) 
            {
                unlink( 'uploads/img/files/' . $project['pic']);
                unlink( 'uploads/img/thumbs/' . $project['pic']);
                $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $pic = date('d-m-Y').'-'.genStr().'-'.$files['name'];
                    $this->uploadImages($files['tmp_name'] , $path .'files/'. $pic );
                    $this->resizeImages($files['tmp_name'], $path . 'thumbs/'. $pic, 1024,693,'crop');
                }else{
                    $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                    return $this->views->render($response, 'backend/projects/edit_project.php', $data);
                }
                $post['pic'] = $pic;
            }

            if ( $post ) 
            {
                unset($post['_METHOD']);
                $post['created_date'] = date('Y-m-d h:i:s');
                $this->dbt->update_this('our_projects',$post,['id'=> $project['id'] ]);
                header('Location: ' . AdminPanel . 'project' );
                exit;
            }
            
        }else{
            header('Location: ' . AdminPanel . 'project' );
            exit;
        }
    }

    public function delete($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        if( $id ) 
        {
            $project = $this->dbt->get_one('our_projects',['id'=>$id]); 
            $images  = $this->dbt->get_table('images',['type_id'=> 2,'housing_id'=> $project['id']]);   

            unlink( 'uploads/img/files/' . $project['pic']);
            unlink( 'uploads/img/thumbs/' . $project['pic']);

            foreach ( $images as $img ) 
            {
                unlink( 'uploads/img/files/' . $img['link']);
                unlink( 'uploads/img/thumbs/' . $img['link']);
            }

            $this->dbt->delete_this('our_projects',['id'=>$id]);
            $this->dbt->delete_this('images',['type_id'=> 2,'housing_id'=> $project['id']]);

            header('Location: ' . AdminPanel . 'project' );
            exit;
        }else{
            header('Location: ' . AdminPanel . 'project' );
            exit;
        }
    }

    public function add_img($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف صور لمشروع';
        $data['breadcrumb'] = 'المشاريع';
        $data['id'] = (int) $args['id'];

        return $this->views->render($response, 'backend/projects/add_images.php', $data);
    }

    public function save_img($request, $response)
    {
        $this->check();
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $id = (int) $this->httpPost('id');
        
        $post1 = ($this->httpPost('detail-1') ) ? $this->httpPost('detail-1') : '';
        $files1 = ($_FILES['pic-1']) ? $_FILES['pic-1'] : '';        

        $post2 = ($this->httpPost('detail-2') ) ? $this->httpPost('detail-2') : '';
        $files2 = ($_FILES['pic-2']) ? $_FILES['pic-2'] : '';        
 
        $post3 = ($this->httpPost('detail-3') ) ? $this->httpPost('detail-3') : '';
        $files3 = ($_FILES['pic-3']) ? $_FILES['pic-3'] : ''; 

        $post4 = ($this->httpPost('detail-4') ) ? $this->httpPost('detail-4') : '';
        $files4 = ($_FILES['pic-4']) ? $_FILES['pic-4'] : ''; 

        $post5 = ($this->httpPost('detail-5') ) ? $this->httpPost('detail-5') : '';
        $files5 = ($_FILES['pic-5']) ? $_FILES['pic-5'] : ''; 

        if ( !empty ($files1) && $files1['error'] == 0 ) 
        {
            $ext = pathinfo($files1['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $img1 = date('d-m-Y').'-'.genStr().'-'.$files1['name'];
                $this->uploadImages($files1['tmp_name'] , $path .'files/'. $img1 );
                $this->resizeImages($files1['tmp_name'], $path . 'thumbs/'. $img1, 1024,693,'crop');
            }
            $this->dbt->insert_this('images',['type_id'=>2, 'type'=>1, 'housing_id'=> $id, 'title'=> $post1, 'link'=> $img1 ]);
        }
 
        if ( !empty ($files2) && $files2['error'] == 0 ) 
        {
            $ext = pathinfo($files2['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $img2 = date('d-m-Y').'-'.genStr().'-'.$files2['name'];
                $this->uploadImages($files2['tmp_name'] , $path .'files/'. $img2 );
                $this->resizeImages($files2['tmp_name'], $path . 'thumbs/'. $img2, 1024,693,'crop');
            }
            $this->dbt->insert_this('images',['type_id'=>2, 'type'=>1, 'housing_id'=> $id, 'title'=> $post2, 'link'=> $img2 ]);
        }
 
        if ( !empty ($files3) && $files3['error'] == 0 ) 
        {
            $ext = pathinfo($files3['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $img3 = date('d-m-Y').'-'.genStr().'-'.$files3['name'];
                $this->uploadImages($files3['tmp_name'] , $path .'files/'. $img3 );
                $this->resizeImages($files3['tmp_name'], $path . 'thumbs/'. $img3, 1024,693,'crop');
            }
            $this->dbt->insert_this('images',['type_id'=>2, 'type'=>1, 'housing_id'=> $id, 'title'=> $post3, 'link'=> $img3 ]);
        }
 
        if ( !empty ($files4) && $files4['error'] == 0 ) 
        {
            $ext = pathinfo($files4['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $img4 = date('d-m-Y').'-'.genStr().'-'.$files4['name'];
                $this->uploadImages($files4['tmp_name'] , $path .'files/'. $img4 );
                $this->resizeImages($files4['tmp_name'], $path . 'thumbs/'. $img4, 1024,693,'crop');
            }
            $this->dbt->insert_this('images',['type_id'=>2, 'type'=>1, 'housing_id'=> $id, 'title'=> $post4, 'link'=> $img4 ]);
        }
 
        if ( !empty ($files5) && $files5['error'] == 0 ) 
        {
            $ext = pathinfo($files5['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $img5 = date('d-m-Y').'-'.genStr().'-'.$files5['name'];
                $this->uploadImages($files5['tmp_name'] , $path .'files/'. $img5 );
                $this->resizeImages($files5['tmp_name'], $path . 'thumbs/'. $img1, 1024,693,'crop');
            }
            $this->dbt->insert_this('images',['type_id'=>2, 'type'=>1, 'housing_id'=> $id, 'title'=> $post5, 'link'=> $img5 ]);
        }

        header('Location: ' . AdminPanel . 'project' );
        exit;
    }

    public function delete_img($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        if( $id ) 
        {
            $img = $this->dbt->get_one('images',['id'=>$id]);
            unlink( 'uploads/img/files/' . $img['link']);
            unlink( 'uploads/img/thumbs/' . $img['link']);        
            $this->dbt->delete_this('images',['id'=>$id]);
            header('Location: ' . $_SERVER['HTTP_REFERER'] );
            exit;
        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER'] );
            exit;
        }
    }
}
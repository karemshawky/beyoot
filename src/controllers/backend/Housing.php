<?php
namespace Controllers\Backend;

use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;
use \Gumlet\ImageResize;

class Housing extends \Controllers\Base
{
    public function index($request, $response)
    {
        $this->check();
        $data['addLink'] = 'add';
        $data['addCategory'] = 'عقار';
        $data['details'] = 'عرض كل العقارات';
        $data['breadcrumb'] = 'العقارات';
        $data['housing'] = $this->dbt->get_housing();

        return $this->views->render($response, 'backend/housing/all_houses.php', $data);
    }

    public function show($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'عرض عقار';
        $data['breadcrumb'] = 'العقارات';
        $id = (int) $args['id'];

        if( $id ) 
        {
            $data['house'] = $this->dbt->get_one('housing',['id'=>$id]);        
            $data['city'] = $this->dbt->get_one('cities',['id'=> $data['house']['city_id']],'name');        
            $data['type'] = $this->dbt->get_one('housing_types',['id'=> $data['house']['type_id']],'name');        
            $data['images'] = $this->dbt->get_table('images',['type'=> 1,'type_id'=> 1,'housing_id'=> $data['house']['id']] ,['id','title','link']);        
            $data['panorama'] = $this->dbt->get_table('images',['type'=> 2,'type_id'=> 1,'housing_id'=> $data['house']['id']] ,['id','title','link']);        
            $data['additions'] = $this->dbt->get_housing_additions($data['house']['id']);   

            if( empty($data['house']['id']) ){
                header('Location: ' . AdminPanel . 'housing' );
                exit;
            }
            return $this->views->render($response, 'backend/housing/show_house.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'housing' );
            exit;
        }
    }
    
    public function add($request, $response)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف عقار جديد';
        $data['breadcrumb'] = 'العقارات';
        $data['type'] = $this->dbt->get_table('housing_types');
        $data['city'] = $this->dbt->get_table('cities');
        $data['additions'] = $this->dbt->get_table('housing_additions_type',[],[],['type_id','desc']);

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
                                        

        return $this->views->render($response, 'backend/housing/add_house.php', $data);
    }

    public function save($request, $response)
    {
        $this->check();
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['pic'];        
        $panorama = $_FILES['360_degree'];        
        $insert = array_chunk($post, 11,true);

        $save= $insert[0];
        $additions= $insert[1];

        if ( !empty ($files) && $files['error'] == 0 ) 
        {
            $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $pic = date('d-m-Y').'-'.genStr().'-'.$files['name'];
                $this->uploadImages($files['tmp_name'] , $path .'files/'. $pic );
                $this->resizeImages($files['tmp_name'], $path . 'thumbs/'. $pic, 1024,693,'crop');
            }else{
                $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                return $this->views->render($response, 'backend/housing/add_house.php', $data);
            }
        }
        $save['pic'] = ($pic) ? $pic :0;
        
        if ( !empty ($panorama) && $panorama['error'] == 0 ) 
        {
            $ext = pathinfo($panorama['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                $pan = date('d-m-Y').'-'.genStr().'-'.$panorama['name'];
                $this->uploadImages($panorama['tmp_name'] , $path .'360/'. $pan );
            }else{
                $data['errPan'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                return $this->views->render($response, 'backend/housing/add_house.php', $data);
            }
        }
        $save['360_degree'] = ($pan) ? $pan : 0;

        $save['video'] = ($save['video']) ? $save['video'] : 'https://www.youtube.com';
        $save['phone'] = ($save['phone']) ? $save['phone'] : 0;
        $save['address'] = ($save['address']) ? $save['address'] : 0;
        $save['lat'] = ($save['lat']) ? $save['lat'] : 0;
        $save['lang'] = ($save['lang']) ? $save['lang'] : 0;
        $save['is_active'] = 1;
        $save['created_date'] = date('Y-m-d h:i:s');
        
        $this->dbt->insert_housing($save,$additions);
        header('Location: ' . AdminPanel . 'housing' );
        exit;
    }

    public function edit($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'تعديل عقار ';
        $data['breadcrumb'] = 'العقارات';   
        
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
            $data['house'] = $this->dbt->get_one('housing',['id'=>$id]);
            $data['type'] = $this->dbt->get_table('housing_types');
            $data['city'] = $this->dbt->get_table('cities');        
            $data['additions'] = $this->dbt->get_housing_additions($data['house']['id']);   
            
            if( empty($data['house']['id']) ){
                header('Location: ' . AdminPanel . 'housing' );
                exit;
            }
            return $this->views->render($response, 'backend/housing/edit_house.php', $data);
        }else{
            header('Location: ' . AdminPanel . 'housing' );
            exit;
        }
    }

    public function update($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        $data['housing'] = $this->dbt->get_one('housing',['id'=>$id]);
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $post = $this->httpPostAll();
        $files = $_FILES['pic'];        
        $panorama = $_FILES['360_degree'];        
        $insert = array_chunk($post, 12,true);

        $save= $insert[0];
        $additions= $insert[1];

        if ( !empty ($files) && $files['error'] == 0 ) 
        {
            $ext = pathinfo($files['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                @unlink( 'uploads/img/files/' . $data['housing']['pic']);
                @unlink( 'uploads/img/thumbs/' . $data['housing']['pic']);  
                $pic = date('d-m-Y').'-'.genStr().'-'.$files['name'];
                $this->uploadImages($files['tmp_name'] , $path .'files/'. $pic );
                $this->resizeImages($files['tmp_name'], $path . 'thumbs/'. $pic, 1024,693,'crop');
            }else{
                $data['picerr'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                return $this->views->render($response, 'backend/housing/add_house.php', $data);
            }
            $save['pic'] = ($pic) ? $pic : 0;
        }
        
        if ( !empty ($panorama) && $panorama['error'] == 0 ) 
        {
            $ext = pathinfo($panorama['name'], PATHINFO_EXTENSION);
            if ( in_array( $ext , $vd ) ) {
                @unlink( 'uploads/img/360/' . $data['housing']['360_degree']);  
                $pan = date('d-m-Y').'-'.genStr().'-'.$panorama['name'];
                $this->uploadImages($panorama['tmp_name'] , $path .'360/'. $pan );
            }else{
                $data['errPan'] = 'خطأ فى حجم الصورة أو نوعها  '; 
                return $this->views->render($response, 'backend/housing/add_house.php', $data);
            }
            $save['360_degree'] = ($pan) ? $pan : 0;
        }

        $save['video'] = ($save['video']) ? $save['video'] : 'https://www.youtube.com';
        $save['phone'] = ($save['phone']) ? $save['phone'] : 0;
        $save['address'] = ($save['address']) ? $save['address'] : 0;
        $save['lat'] = ($save['lat']) ? $save['lat'] : 0;
        $save['lang'] = ($save['lang']) ? $save['lang'] : 0;
        $save['is_active'] = 1;
        $save['created_date'] = date('Y-m-d h:i:s');

        unset($save['_METHOD']);
        $this->dbt->update_this('housing', $save, ['id'=> $data['housing']['id']]);
        $this->dbt->delete_this('housing_additions',['housing_id'=> $data['housing']['id'] ]);
        $this->dbt->insert_additions($additions, $data['housing']['id'] );

        header('Location: ' . AdminPanel . 'housing' );
        exit;
    }

    public function delete($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        if( $id ) 
        {
            $housing = $this->dbt->get_one('housing',['id'=>$id]); 
            $images  = $this->dbt->get_table('images',['type_id'=> 1,'housing_id'=> $housing['id']]);   

            unlink( 'uploads/img/files/' . $housing['pic']);
            unlink( 'uploads/img/thumbs/' . $housing['pic']);
            unlink( 'uploads/img/360/' . $housing['360_degree']);

            foreach ( $images as $img ) 
            {
                unlink( 'uploads/img/files/' . $img['link']);
                unlink( 'uploads/img/thumbs/' . $img['link']);
                unlink( 'uploads/img/360/' . $img['link']);
            }

            $this->dbt->delete_this('housing',['id'=>$id]);
            $this->dbt->delete_this('images',['type_id'=> 1,'housing_id'=> $housing['id']]);
            $this->dbt->delete_this('housing_additions',['housing_id'=> $housing['id']]);

            header('Location: ' . AdminPanel . 'housing' );
            exit;
        }else{
            header('Location: ' . AdminPanel . 'housing' );
            exit;
        }

    }

    public function add_img($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف صور لعقار';
        $data['breadcrumb'] = 'العقارات';
        $data['id'] = (int) $args['id'];

        return $this->views->render($response, 'backend/housing/add_images.php', $data);
    }

    public function add_panorama($request, $response, $args)
    {
        $this->check();
        $data['addLink'] = '';
        $data['addCategory'] = '';
        $data['details'] = 'أضف صور لعقار';
        $data['breadcrumb'] = 'العقارات';
        $data['id'] = (int) $args['id'];

        return $this->views->render($response, 'backend/housing/add_panorama.php', $data);
    }


    public function save_img($request, $response)
    {
        $this->check();
        $vd = ['jpeg', 'jpg', 'png'];
        $path = 'uploads/img/';
        $id = (int) $this->httpPost('id');
        $type = (int) $this->httpPost('type');

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
           if ( $type == 1)
           {
                $ext = pathinfo($files1['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img1 = date('d-m-Y').'-'.genStr().'-'.$files1['name'];
                    $this->uploadImages($files1['tmp_name'] , $path .'files/'. $img1 );
                    $this->resizeImages($files1['tmp_name'], $path . 'thumbs/'. $img1, 1024,693,'crop');
                }
            }
            if ( $type == 2)
            {
                 $ext = pathinfo($files1['name'], PATHINFO_EXTENSION);
                 if ( in_array( $ext , $vd ) ) {
                     $img1 = date('d-m-Y').'-'.genStr().'-'.$files1['name'];
                     $this->uploadImages($files1['tmp_name'] , $path .'360/'. $img1 );
                 }
             }
            $this->dbt->insert_this('images',['type_id'=>1, 'type'=>$type, 'housing_id'=> $id, 'title'=> $post1, 'link'=> $img1 ]);
       }

       if ( !empty ($files2) && $files2['error'] == 0 ) 
       {
           if ( $type == 1)
           {
                $ext = pathinfo($files2['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img2 = date('d-m-Y').'-'.genStr().'-'.$files2['name'];
                    $this->uploadImages($files2['tmp_name'] , $path .'files/'. $img2 );
                    $this->resizeImages($files2['tmp_name'], $path . 'thumbs/'. $img2, 1024,693,'crop');
                }
            }
            if ( $type == 2)
            {
                 $ext = pathinfo($files2['name'], PATHINFO_EXTENSION);
                 if ( in_array( $ext , $vd ) ) {
                     $img2 = date('d-m-Y').'-'.genStr().'-'.$files2['name'];
                     $this->uploadImages($files2['tmp_name'] , $path .'360/'. $img2 );
                 }
             }
            $this->dbt->insert_this('images',['type_id'=>1, 'type'=>$type, 'housing_id'=> $id, 'title'=> $post2, 'link'=> $img2 ]);
       }

       if ( !empty ($files3) && $files3['error'] == 0 ) 
       {
            if ( $type == 1)
            {
                $ext = pathinfo($files3['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img3 = date('d-m-Y').'-'.genStr().'-'.$files3['name'];
                    $this->uploadImages($files3['tmp_name'] , $path .'files/'. $img3 );
                    $this->resizeImages($files3['tmp_name'], $path . 'thumbs/'. $img3, 1024,693,'crop');
                }
            }
            if ( $type == 2)
            {
                $ext = pathinfo($files3['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img3 = date('d-m-Y').'-'.genStr().'-'.$files3['name'];
                    $this->uploadImages($files3['tmp_name'] , $path .'360/'. $img3 );
                }
            }
            $this->dbt->insert_this('images',['type_id'=>1, 'type'=>$type, 'housing_id'=> $id, 'title'=> $post3, 'link'=> $img3 ]);
       }

       if ( !empty ($files4) && $files4['error'] == 0 ) 
       {
            if ( $type == 1)
            {
                $ext = pathinfo($files4['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img4 = date('d-m-Y').'-'.genStr().'-'.$files4['name'];
                    $this->uploadImages($files4['tmp_name'] , $path .'files/'. $img4 );
                    $this->resizeImages($files4['tmp_name'], $path . 'thumbs/'. $img4, 1024,693,'crop');
                }
            }
            if ( $type == 2)
            {
                $ext = pathinfo($files4['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img4 = date('d-m-Y').'-'.genStr().'-'.$files4['name'];
                    $this->uploadImages($files4['tmp_name'] , $path .'360/'. $img4 );
                }
            }
            $this->dbt->insert_this('images',['type_id'=>1, 'type'=>$type, 'housing_id'=> $id, 'title'=> $post4, 'link'=> $img4 ]);
       }

       if ( !empty ($files5) && $files5['error'] == 0 ) 
       {
            if ( $type == 1)
            {
                $ext = pathinfo($files5['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img5 = date('d-m-Y').'-'.genStr().'-'.$files5['name'];
                    $this->uploadImages($files5['tmp_name'] , $path .'files/'. $img5 );
                    $this->resizeImages($files5['tmp_name'], $path . 'thumbs/'. $img5, 1024,693,'crop');
                }
            }
            if ( $type == 2)
            {
                $ext = pathinfo($files5['name'], PATHINFO_EXTENSION);
                if ( in_array( $ext , $vd ) ) {
                    $img5 = date('d-m-Y').'-'.genStr().'-'.$files5['name'];
                    $this->uploadImages($files5['tmp_name'] , $path .'360/'. $img5 );
                }
            }
            $this->dbt->insert_this('images',['type_id'=>1, 'type'=>$type, 'housing_id'=> $id, 'title'=> $post5, 'link'=> $img5 ]);
       }

        header('Location: ' . AdminPanel . 'housing' );
        exit;
    }

    public function delete_img($request, $response, $args)
    {
        $this->check();
        $id = (int) $args['id'];
        if( $id ) 
        {
            $img = $this->dbt->get_one('images',['id'=>$id]);
            @unlink( 'uploads/img/files/' . $img['link']);
            @unlink( 'uploads/img/thumbs/' . $img['link']);        
            @unlink( 'uploads/img/360/' . $img['link']);        
            $this->dbt->delete_this('images',['id'=>$id]);
            header('Location: ' . $_SERVER['HTTP_REFERER'] );
            exit;
        }else{
            header('Location: ' . $_SERVER['HTTP_REFERER'] );
            exit;
        }
    }
}
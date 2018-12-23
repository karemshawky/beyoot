<?php
namespace Controllers\Frontend;

use Respect\Validation\Validator as v;

class Blogs extends \Controllers\Base
{
    public function show($request, $response, $args)
    {
        $data['settings'] = $this->dbt->get_one('about_us');

        $type = $args['type'];
        $validations = [ v::stringType()->length(1, 10)->validate( $type ) ];

        if ($this->validate($validations) === false) {
            header('Location: ' . BaseUrl );
            exit;
        }

        if( $type == 'tourism' ) 
        {
            $data['sliders'] = $this->dbt->get_table('blog',['type_id'=> 1],[],['created_date','desc'],3);        
            $data['blogs'] = array_slice($this->dbt->pagination('blog',['type_id'=> 1],[],1,12,['created_date','desc']),3);

            if( empty($data['blogs']) )
            {
                header('Location: ' . BaseUrl . 'blog/tourism' );
                exit;
            }
            return $this->views->render($response, 'frontend/blog/all_blog.php', $data);

        }elseif( $type == 'business' ) {
            $data['sliders'] = $this->dbt->get_table('blog',['type_id'=> 2],[],['created_date','desc'],3);        
            $data['blogs'] = array_slice($this->dbt->pagination('blog',['type_id'=> 2],[],1,12,['created_date','desc']),3);    
            if( empty($data['blogs']) )
            {
                header('Location: ' . BaseUrl . 'blog/business' );
                exit;
            }
            return $this->views->render($response, 'frontend/blog/all_blog.php', $data);

        }else{
            header('Location: ' . BaseUrl );
            exit;
        }
    }

    public function load_more() 
    {
        $pageNum = ($this->httpPost('page_num')) ? (int) $this->httpPost('page_num') : 3;
        $type = ($this->httpPost('type')) ? (int) $this->httpPost('type') : 0;
        
        if ($type === 1 ) {
            $data['blogs'] = $this->dbt->pagination('blog',['type_id'=> 1],[],$pageNum,6,['created_date','desc']);    
        }
        if ($type === 2 ) {
            $data['blogs'] = $this->dbt->pagination('blog',['type_id'=> 2],[],$pageNum,6,['created_date','desc']);    
       }
        if( $type == 0){
            $data['blogs']='';
        }
        
       echo json_encode( $data['blogs'] );
    }

    public function single($request, $response, $args)
    {
        $data['settings'] = $this->dbt->get_one('about_us');
        $data['theNew']  = $this->dbt->get_table('blog',[],[],['created_date','desc'],3);
        
        $id = (int) $args['id'];
        if( $id ) 
        {
            $data['blog'] = $this->dbt->get_one('blog',['id'=>$id]);

            if ( $data['blog']['type_id'] == 1 ) 
            {
                if ( !empty( $_SESSION['userid'] ) ) {
                    $fav = $this->dbt->get_one('favorite',['token_id'=> $_SESSION['userid'],'type_id'=>2,'number_id'=> $data['blog']['id']],'number_id');
                }else{
                    $fav = 0;
                }
            }

            if ( $data['blog']['type_id'] == 2 ) 
            {
                if ( !empty( $_SESSION['userid'] ) ) {
                    $fav = $this->dbt->get_one('favorite',['token_id'=> $_SESSION['userid'],'type_id'=>3,'number_id'=> $data['blog']['id']],'number_id');
                }else{
                    $fav = 0;
                }
            }

            $data['blog']['is_fav'] = ($fav == $data['blog']['id']) ? 1 : 0;

            if( empty($data['blog']['id']) ){
                header('Location: ' . BaseUrl );
                exit;
            }
            return $this->views->render($response, 'frontend/blog/single_blog.php', $data);
        }else{
            header('Location: ' . BaseUrl );
            exit;
        }
    }

    public function singlemob($request, $response, $args)
    {
        $id = (int) $args['id'];
        if( $id ) 
        {
            $data['blog'] = $this->dbt->get_one('blog',['id'=>$id]);        
            if( empty($data['blog']['id']) ){
                header('Location: ' . BaseUrl );
                exit;
            }elseif ( $data['blog']['type_id'] == 1 ) {
                header('Location: http://beyoot.4art-studio.com/mobile/first.html' );
                exit;

            }elseif( $data['blog']['type_id'] == 2 ) {
                header('Location: http://beyoot.4art-studio.com/mobile/second.html' );
                exit;
            }
            //return $this->views->render($response, 'frontend/blog/mobview.php', $data);
        }else{
            header('Location: ' . BaseUrl );
            exit;
        }
    }

}
<?php
namespace Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Intervention\Image\ImageManager as Image;
use Models\BeyootModel as Models;
use Slim\Views\PhpRenderer as Rend;
use \Slim\Container;
use \Gumlet\ImageResize;

class Base
{
   /**
    * Slim DI Container
    *
    * @var \Slim\Container
    */
    protected $container;

    /**
     * To make new object from database
     *
     * @var string 
     */
     protected $dbt;

     /**
      * To make new object from view
      *
      * @var Slim\Views\PhpRenderer
      */
      
    /**
     * Construtor
     *
     * @param object $container
     * @param object $dbt
     * @param object $views
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->dbt = new Models;
        $this->views = new Rend("templates/");
    }
    
    public function check() 
    {
        if ( !$_SESSION['name'] ) 
        {
            header('Location: ' . AdminPanel . 'login' );
            exit;
        }
    }
    /**
     * Get a $ _GET variable set in request
     *
     * @param string $key
     * @return string|null
     */
    public function httpGet($key)
    {
        if (isset($this->container->request->getQueryParams()[$key])) {
            return $this->container->request->getQueryParams()[$key];
        }
		
        return null;
    }

    /**
     * Get a $ _GET all variable set in request
     *
     * @return string|null
     */
    public function httpGetAll()
    {
        if ($this->container->request->getQueryParams() !== null) {
            return $this->container->request->getQueryParams();
        }
		
        return null;
    }

    /**
     * Get a $ _POST variable set in request
     *
     * @param string $key
     * @return string|null
     */
    public function httpPost($key)
    {
        if (isset($this->container->request->getParsedBody()[$key])) {
            return $this->container->request->getParsedBody()[$key];
        }
		
        return null;
    }
    
    /**
     * Get a $_POST all variable set in request
     *
     * @return string|null
     */
    public function httpPostAll()
    {
        if ($this->container->request->getParsedBody() !== null) {
            return $this->container->request->getParsedBody();       
        }
		
        return null;
    }

    /**
     * Transforms an object into a string in json format
     *
     * @param object $data
     * @return string
     * @throws \Exception When $data is not an object
     */
    public static function encode($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL;
    }
    
    /**
     * Creates an error object in string in json format
     *
     * @param string $code
     * @param string $path
     * @param string $status
     * @param string $extra
     * @return string
     */
    public static function error($code, $path, $status, $extra = '')
    {
        $error = new \StdClass;
        
        $error->error = [
            'code' => $code,
            'path' => $path,
            'status' => $status
        ];
        
        if ($extra) {
            $error->error['extra'] = $extra;
        }

        return self::encode($error);
    }
    
    /**
     * Creates a resource object in string in json format
     *
     * @param string $request
     * @param string $path
     * @return string
     */
    public function resource($path)
    {
        $uri = $this->container->request->getUri();

        $scheme = $uri->getScheme();
        $host = $uri->getHost();
        $port = $uri->getPort();
        
        $location = $scheme . '://' . $host . ($port ? ':' . $port : null) . '/' . $path;
        
        $resource = new \StdClass;
        
        $resource->resource = [
            'location' => $location
        ];

        return self::encode($resource);
    }
    
    /**
     * Check out a list of boolean expressions
     *
     * @param array $validations
     * @return bool
     * @throws \Exception When $validations is not an array
     */
    public static function validate($validations)
    {
        if (!is_array($validations)) {
            throw new \Exception('$validations must be an array of Boolean values.');
        }
		
		foreach ($validations as $v) {
			if ($v === false) {
				return false;
			}
		}
        return true;
    }

    /**
     * Filter input with preg match arabic, english language and numbers
     *
     * @param array $validations
     * @return bool
     * @throws \Exception When $validations is not an array
     */
    public function filter_it($field='')
    {
        if ( !preg_match("~^[a-zA-Z0-9\-'\s\p{Arabic}]{1,60}$~iu", $field ) ) {   
            return false;
        }		
        return true;
    }

    /**
     * Upload images
     *
     * @param mixed $image
     * @param mixed $savepath
     * @return void
     */
    public function uploadImages($image=null, $savepath=null)
    {
        /**
         * example :
         * 
         *  $files = $_FILES['upload'];
         *  for ($i = 0; $i < count($files['name']); $i++) 
         *  {
         *      $this->uploadImages($files['tmp_name'][$i] , date('d-m-Y').'-'.$files['name'][$i] );
         *  }
         */
            $img = new ImageResize($image);
            $img->save($savepath);
    }

    /**
     * Resize or crop images
     *
     * @param mixed $image
     * @param mixed $savepath
     * @param mixed $width
     * @param mixed $height
     * @param mixed $type
     * @return void
     */
    public function resizeImages($image=null, $savepath=null, $width = null,$height = null,$type = 'resize')
    {
        /**
         * example :
         * 
         *  $files = $_FILES['upload'];
         *  for ($i = 0; $i < count($files['name']); $i++) 
         *  {
         *      $this->resizeImages($files['tmp_name'][$i], date('d-m-Y').'-'.$files['name'][$i], 300,200,'resize');
         *      $this->resizeImages($files['tmp_name'][$i], date('d-m-Y').'-'.$files['name'][$i], 300,200,'crop');
         *  }
         */
            $img = new ImageResize($image);

            if( $type == 'resize' ) {
                
                if( $width && $height) :
                    $img->resize($width, $height);
                elseif( $width && empty($height) ) :
                    $img->resizeToWidth($width);
                elseif( $height && empty($width) ) :
                    $img->resizeToHeight($height);
                endif;

            }elseif ( $type == 'crop' ) {

                if( $width && $height) :
                    $img->crop($width , $height, ImageResize::CROPCENTER);
                endif;
            }

            $img->save($savepath,null,80);
    }

}
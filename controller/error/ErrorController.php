<?php 
@require_once 'controller/BaseController.php';
@require_once 'model/BaseModel.php';
@require_once 'model/server/ServerModel.php';


class ErrorController extends BaseController{
    
    protected static $methodObjects =[];
    
    public function __construct(){

        
    
        
    }


    public static function views(array $params = [],$template='error/404secure',$_ext='.php',$handler='ErrorController',$handlerPath='error/') : void
    {
        
        
        $objs = $handler;
        $methods = self::$methodObjects;

        
        $path  = self::view(template:$template, _ext:null, handler:$objs,handlerPath:$handlerPath);

        if(is_file($path)){
            $obj = new $objs();
            
            require_once $path;
        }else{
            $path;
        }

    
    }
    public static function index(array $params = [])
    {
        self::views(params:$params, template:'error/404index', handlerPath:'error/');
    }

    public static function admin(array $params = [])
    {
        self::views(params:$params, template:'error/404admin', handlerPath:'error/');
    }

    public static function secure(array $params = [])
    {
        self::views(params:$params, template:'error/404secure', handlerPath:'error/');
    }

    public static function secure505(array $params = [])
    {
        self::views(params:$params, template:'error/505secure', handlerPath:'error/');
    }

    
}


?>
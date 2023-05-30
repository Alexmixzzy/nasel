<?php 
@require_once 'controller/BaseController.php';
class  HomeController extends  BaseController implements BaseInterFace {

    
    public static function views(array $params = [],$template='public/home',$_ext='.php',$handler='HomeController',$handlerPath='public/') : void
    {
        
        
        $objs = $handler;
        $path  = self::view(template:$template, _ext:null, handler:$objs,handlerPath:$handlerPath);

        if(is_file($path)){
            $obj = new $objs();
            require_once $path;
            
            
        }else{
            $path;
        }

    
    }

    public function renderView(string $fileName, $dotLev=''){
        
            return $this->render('public/'.$fileName,$dotLev);
    
    }

    public function renderStep(string $fileName,$dotLev=''){
        
        return $this->render('public/include/'.$fileName,$dotLev);

}

}


?>
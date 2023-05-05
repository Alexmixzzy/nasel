<?php 
@require_once 'controller/BaseController.php';
class  HomeController extends  BaseController implements BaseInterFace {



    public static function views(array $params = [])
    {
        $obj = 'HomeController';
        
        return self::view('public/home', null, $params, $obj,'public/');
        //echo ' Welcome Home';
    }

    public function renderView(string $fileName, $dotLev=''){
        
            return $this->render('public/'.$fileName,$dotLev);
    
    }

    public function renderStep(string $fileName,$dotLev=''){
        
        return $this->render('public/include/'.$fileName,$dotLev);

}

}


?>
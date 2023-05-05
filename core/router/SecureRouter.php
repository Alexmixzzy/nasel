<?php 
@require_once 'model/BaseUserModel.php';
@require_once 'model/BaseUserModel.php';
class SecureRouter  {

    private  $routing;
    private $models;

    public function __construct($routerr){

        

        $this->routing = $routerr;

        $this->models  = new BaseUserModel();
    

        $this->userRouterCheck();

        

    }

    private function routerPages ($base="/dashboard/"){
        $handlerPath = 'secure/';
        //get Methods
        $this->routing->get($base.'',UserController::class.'::index',$handlerPath);
        $this->routing->get($base.'home',UserController::class.'::index',$handlerPath);
        $this->routing->get($base.'edit-profile',UserController::class.'::editProfile',$handlerPath);
        $this->routing->get($base.'settings',UserController::class.'::settings',$handlerPath);
        $this->routing->get($base.'profile',UserController::class.'::profile',$handlerPath);
        $this->routing->get($base.'deposit',UserController::class.'::deposit',$handlerPath);
        $this->routing->get($base.'reset-investment',UserController::class.'::resetInvestment',$handlerPath);
        $this->routing->get($base.'myinvestment',UserController::class.'::myInvestment',$handlerPath);
        $this->routing->get($base.'requestCapital',UserController::class.'::requestCapital',$handlerPath);
        $this->routing->get($base.'withdraw',UserController::class.'::withdrawFund',$handlerPath);
        
        

        //Post Methods
        $this->routing->post($base.'edit-profile',UserController::class.'::editProfile',$handlerPath);
        $this->routing->post($base.'settings',UserController::class.'::settings',$handlerPath);
        $this->routing->post($base.'deposit',UserController::class.'::deposit',$handlerPath);
        $this->routing->post($base.'reset-investment',UserController::class.'::resetInvestment',$handlerPath);
        $this->routing->post($base.'withdraw',UserController::class.'::withdrawFund',$handlerPath);
        $this->routing->post($base.'requestCapital',UserController::class.'::requestCapital',$handlerPath);
    }

    private function routerPageReject ($base="/dashboard/"){
        $handlerPath = 'error/';
        $this->routing->get($base.'404',ErrorController::class.'::secure',$handlerPath);
        $this->routing->get($base.'505',ErrorController::class.'::secure505',$handlerPath);
        
    }

    private function userRouterCheck() :void{

        if(!empty($this->models->authUser)){
            if($this->models->hashVerify($this->models->authUser, $this->models->getUser('hash_code'))){

                $this->routerPages();
                $this->routerPageReject();
            }else{
                $this->models->logOut();
                $this->routerPageReject();
                
            }
        }else{
            $this->routerPageReject();
        
            
            
        }
    }


}


?>
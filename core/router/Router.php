<?php  
@require_once 'BaseRouter.php';
@require_once 'SecureRouter.php';

/* 
I decided to use router in this way because of  the project  plan, there are many ways to do this but this option suites me well in this project and help organise the routes in methods according to  folders just as normal folders.

You can easily create another method for just logged in users and chain it  with key for logged in user, for example: key that checks the request  and if the user  is  a logged in user before they can even be able to call the route but if not logged in then the route will not be valid.

1 example: Create another class SecureRouter, then call the SecureRouter with a parameter SecureRouter($this) with the connstruct of this  router then Wrapp

*/
class Router extends  BaseRouter {
    public function __construct(){
    $this->publicRouters();
    $this->adminRouters();
    $this->loginRouter();
    $this->signupRouter();

    $this->userLogout();

    $this->secRouters();
    

    }

    private function publicRouters ($base='/'){
        $handlerPath = 'public/';
        $this->get($base,HomeController::class.'::views',$handlerPath);
        $this->get('/contact',ContactController::class.'::views',$handlerPath);
        $this->get('/404',ErrorController::class.'::index','error/');
        $this->get('/505',ErrorController::class.'::index505','error/');
        
    }

    private function loginRouter($base='/login/'){
        $handlerPath = 'public/auth/';
        $this->get($base.'',AuthController::class.'::login',$handlerPath);
        $this->post($base.'',AuthController::class.'::login',$handlerPath);
        $this->get($base.'login',AuthController::class.'::login',$handlerPath);
        $this->post($base.'login',AuthController::class.'::login',$handlerPath);
    }

    private function SignupRouter($base='/register/'){
        $handlerPath = 'public/auth/';
        $this->get(path:$base.'',handler:AuthController::class.'::signup',handlerPath:$handlerPath);
        $this->post($base.'',AuthController::class.'::signup',$handlerPath);
        $this->get($base.'signup',AuthController::class.'::signup',$handlerPath);
        $this->post($base.'signup',AuthController::class.'::signup',$handlerPath);
    }

    private function adminRouters ($base='/myAdmin/'){
        $handlerPath = 'admin/';
        $this->get($base.'',AdminController::class.'::views',$handlerPath);
    }

    private function userRouters ($base="/dashboard/"){
        $handlerPath = 'secure/';
        $this->get($base.'',UserController::class.'::index',$handlerPath);
        $this->get($base.'home',UserController::class.'::index',$handlerPath);
    }

    public function userLogout ($base="/logout/"){
        $handlerPath = 'public/auth/';
        $this->get($base.'',AuthController::class.'::logUserOut',$handlerPath);
    }

    private function secRouters() : void{
        new SecureRouter($this);
    }

}



?>
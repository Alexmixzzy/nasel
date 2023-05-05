<?php 

@require_once 'core/trait/BasicFunctions.php';
class BaseRouter {
    use BasicFunctions;
    private array $handlers;
    private   $callback;
    private   $notFoundHandler =true;
    private $pageMissing = true;
    private $handlerFolder;

    private $handlerPathFile;
    

    private $method;

    private $controller;


    public function __construct(){
        //$this->checkPageMissing();
    }
    public function get(string $path, $handler='', $handlerPath=''): void
    {
        
        $method = self::METHOD_GET;
        $this->addHandler(self::METHOD_GET, $path, $handler,$handlerPath);
        
    }
    
    
    public function post(string $path,$handler='',$handlerPath=''): void
    {
        $method = self::METHOD_POST;
        $this->addHandler(self::METHOD_POST, $path, $handler,$handlerPath);
        
        
    }



    public function addNotFoundHandler($handler):void {

        $this->notFoundHandler = $handler;

    }

    private function addHandler(string $method, string $path, $handler, $handlerPath=null): void
    {

        $this->handlers[$method .$path] = [
            'path' =>$path,
            'method'=>$method,
            'handler'=>$handler,
            'handlerPath'=>$handlerPath,
        ];
    }

    protected function validateHandler(){
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        if(!empty($this->handlers)){

            foreach($this->handlers as $handler){
                $pat =  explode("?", $_SERVER['REQUEST_URI']);
                $getQuery =  array_shift($pat);
                $sortQuery =  array_shift($pat);
            
                $extra = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    
                if(($handler['path'] == $requestPath || $this->basePats.$handler['path']===implode($requestUri) || $this->basePats.$handler['path'].'?'.$extra===$_SERVER['REQUEST_URI'])  && $method ==  $handler['method']){
                    
                    $this->pageMissing = false;
                
                
                    $controller = $handler['handler'];
                    $handlerPath  = $handler['handlerPath'];
                    $this->handlerFolder = $handlerPath;
                    
                    if(is_callable($controller)){
                        $controller();
                    }else{
                    
                    $arr ='';
                    if(is_string($controller)){
                        $arr = explode("::",$controller);
                    
    
                    }
                    /*
                    You can use  this method if  you  want to, it  works  fine also, but if you will use this method then uncomment  the exit below so it won't be  called twice
                    $classNamex = array_shift($arr);
                    $methodx = array_shift($arr);
                
                    require_once 'controller/'.$handlerPath.$classNamex.'.php';
                    $controller = new $classNamex();
                    $controller->$methodx();

                    */
                    
                    }
                    $this->callback = $handler['handler'];
        
                    //exit();
            
                }
    
                
            }

            if($this->pageMissing){
               $this->checkPageMissing();
              
            }
        }

    }

    private function handleCallBack()
    {
        if (is_callable($this->callback)) {
            call_user_func_array($this->callback, [

                array_merge($_GET, $_POST)
            ]);
        }
    }

    private function errorHandler(){
       //echo 'Handler not found for this pag'.$this->callback;
       // echo (int)is_callable($this->callback).'---klo'; 
        
        if($this->isDashBoardDir()){
            
            header('location:../dashboard/505');
            
            }else if($this->isAdminDir()){
                header('location:../myAdmin/505');
            }else{
                header('location:../505');
        }
    
    }

    protected function checkCallBack(){

        if(is_string($this->callback)){

            $parts = explode('::',$this->callback);
            if(is_array($parts)){
                
                $className = array_shift($parts);
                $fileName = 'controller/'.$this->handlerFolder.$className.'.php';
                if(file_exists($fileName)){
                /* only require if the file can be found 
                and validate to see if they are callable before calling them

                */
                require_once $fileName;
                $handler = new $className;
                $method  = array_shift($parts);
                $this->callback = [$handler,$method];
                $this->controller = $className;
                $this->method = $method;
                if(is_callable($this->callback) && method_exists($className.'',$method) ){

                        $this->pageMissing = false;
                        $this->notFoundHandler = false;
                        $this->handleCallBack();
                
                }else {
                    
                        //$this->errorHandler();
                    
                }
                

                }else{
                    //$this->errorHandler();
                }
                

                
            

                
    
            
            }
        }

        if($this->notFoundHandler){
            if($this->pageMissing){
                $this->checkPageMissing();
            }else{
                $this->errorHandler();
            }
        
        }
    }

    public function checkPageMissing() :void{

            
            if($this->isDashBoardDir()){
        
            header('location:../dashboard/404');
            }else if($this->isAdminDir()){
                header('location:../myAdmin/404');
            }else{
                header('location:../404');
            }
        

    
        
    }

    private  function isDashDir(){
        $url = explode("/",$_SERVER['REQUEST_URI']);
            $count = count($url);
            if($url[$count-2]==='dashboard' ||  $url[$count-1] ==='dashboard' && (in_array('dashboard',$url))){
                return true;

            }else{
                return false;
            }
    }

    private function isDir($dir,$no1,$no2):bool{
        $url = explode("/",$_SERVER['REQUEST_URI']);
        $count = count($url);
        if($url[$count-$no1]==='dashboard' ||  $url[$count-$no2] ===$dir && (in_array($dir,$url))){
            return true;

        }else{
            return false;
        }
}
    private function isDashBoardDir($dir='/'):bool{
            return $this->isDir('dashboard',2,1);
    }
    private function isAdminDir($dir='/'):bool{
        return $this->isDir('myAdmin',2,1);

    
    }

    public function runMain()
    {
    
        $this->validateHandler();

        $this->checkCallBack();

        

        
    
        
    
    }


}



?>
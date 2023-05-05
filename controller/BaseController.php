<?php
@require_once 'interface/BaseInterFace.php';
@require_once 'core/trait/BasicFunctions.php';
@require_once 'core/trait/GeoLocate.php';
@require_once 'core/trait/Currency.php';
@require_once 'core/trait/Country.php';
@require_once 'core/trait/Tables.php';
@require_once 'core/middleware/MiddValidator.php';
class BaseController
{

    use BasicFunctions;
    use GeoPlugins;
    use Currencies;
    use Countries;
    use Tables;

    protected $pdo;
    public $msg = null;
    public $msgs = null;

    public $compo;
    protected $sym  = '$';
    protected $currency = 'USD';
    protected static $setCRFTOKEN;
    protected static $midd;
    protected $midware;
    public function __construct()
    {
        //$this->geoLocate($_SERVER['REMOTE_ADDR']);
        $this->midware = new MiddValidator();
        self::$setCRFTOKEN = $this->midware->setCrfToken();
        
        
    }

    

    protected static function view($template = '', $_ext = '.php', $handler = '', $handlerPath = null)
    {

        
            
        $_SESSION['crfToken']= self::$setCRFTOKEN;
        

        $obj = null;
        if (self::validateController($handler, $handlerPath)) {
            $obj = new $handler();
            if (!empty($_ext)) {
                $ext = $_ext;
            } else {
                $ext = '.php';
            }
            $viewPath = 'view/' . $template . $ext;
            if (file_exists($viewPath)) {
                return $viewPath;
            } else {
                return self::template404();
            }

        } else {
            return self::handler404();
        }

    }


    public function render(string $pathFileName, $levelUp = '')
    {
        $viewPath = 'view/' . $pathFileName;
        if (file_exists($viewPath)) {
            require_once $viewPath;

        } else {
            return self::template404($pathFileName);
        }
    }

    protected function setToken()
    {
        //$_SESSION['crfToken']= $this->getCrfToken();
        //$_SESSION['crfToken'] = self::genCrfToken(self::$crfToken);

    }

    private static function validateController($controller, $path)
    {

        $controllerPath = 'controller/' . $path . $controller . '.php';

        if (file_exists($controllerPath)) {

            if (class_exists($controller)) {
                return true;
            } else {
                return false;
            }
        

        } else {
            return false;
        }

    }

    public function crfKey()
    {
        if (!empty($_SESSION['crfToken'])) {
            return $_SESSION['crfToken'];
        }
    }

    private function crfTokenInput(){
        $token = $this->crfKey();
        return '<input  type="hidden" name="cTokens" value="'.$token.'">';
    }
    public function crfToken() :void{
        echo $this->crfTokenInput();
    }

    public function crfToken2(){
        return $this->crfTokenInput();
    }

    public function voidCal($data): void{

        echo $data;

    }

    public function voidFormMsg():void{
        if (!empty($this->msg)) {
            echo $this->msg;
        }
        if (!empty($this->msgs)) {
            echo $this->msgs;
        }
    }

    public function voidSession($session=null) :void {
            if(!empty($session)){
                if(!empty($_SESSION[$session])){
                    echo $_SESSION[$session];
                }else{
                    echo null;
                }
            }
    }

}

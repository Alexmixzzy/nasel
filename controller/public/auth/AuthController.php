<?php
@require_once 'controller/BaseController.php';
@require_once 'model/public/auth/AuthModel.php';
class AuthController extends BaseController
{

    public $model;
    private $loginKey = "5@$84bc5Mb4100C5169f@1fa15177ed$&Rb78d75f9846afc466a4bae05119c824";

    public function __construct()
    {
        parent::__construct();
        $this->model = new AuthModel();

    }

    

    public static function views(array $params = [], $template = 'public/login', $_ext = '.php', $handler = 'AuthController', $handlerPath = 'public/auth/'): void
    {

        $objs = $handler;

        $path = self::view(template:$template, _ext:null, handler:$objs, handlerPath:$handlerPath);

        if (is_file($path)) {
            $obj = new $objs();

            require_once $path;
        } else {
            $path;
        }
    }

    public static function login(array $params = [])
    {

        self::views(params:$params, template:'public/auth/login');

    }

    public static function signup(array $params = [])
    {

        self::views(params:$params, template:'public/auth/register');

    }

    public function renders(string $fileName, $levelUp = '')
    {

        return $this->render(pathFileName:'public/' . $fileName, levelUp:$levelUp);

    }

    public function renderView(string $pathFileName, $levelUp = '')
    {

        $obj = $this;
        $model = $this->model;
        $viewPath = 'view/public/' . $pathFileName;
        if ($this->fileExist($viewPath)) {
            require_once $viewPath;

        } else {
            return self::template404();
        }

    }

    public function renderStep(string $fileName, $levelUp = '')
    {

        $this->renderView(pathFileName:'include/' . $fileName, levelUp:$levelUp);

    }

    public function loginUser(array $params = [])
    {
        $empty = true;
        $table = $this->model->table;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['loginUser'])) {

                    if (!empty($params['cTokens'])) {

                        $midChecker = $this->midware->sanitizeInput('loginVal',$params);
                        if($midChecker['status']){
                            $post = $midChecker['data'];

                            if(!empty($post['username'])&& !empty($post['password'])){
                                $username = $post['username'];
                                $pass = $post['password'];

                                if ($this->model->ifExist($username, 'username', $this->model->table) === 1) {

                                    
                                    $login = $this->model->login($username, $pass);
    
                                    if ($login === $this->success) {
                                        
                                        $_SESSION[$this->model->sessionUser] = $username;
                                        $_SESSION[$this->model->sessionEmail] = $this->model->getData($table, 'email', 'username', $username);
    
                                        // $lastUrl = $this->model->getUser('last_url');
    
                                        header("location:" . $this->model->dashBoard);
                                    
    
                                    } else {
                                        $this->msg = $this->error($login);
                                    }
    
                                } else {
    
                                    
                                    $this->msg = $this->error('Invalid Credentials, retrys');
                                }

                            }else{
                                $this->msg = $this->error('Please enter  required fields');
                            }
                        }else{
                            $this->msg = $this->error($midChecker['msg']);
                        }
                    }else{
                        $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                    }
                

                }
            }
        }

    }

    public function registerUser(array $params = [])
    {
        $empty = true;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['signUser'])) {

                    if (!empty($params['cTokens'])) {
                        $midChecker = $this->midware->sanitizeInput('loginVal',$params);
                        if($midChecker['status']){
                            $post = $midChecker['data'];

                            foreach ($post as $key => $val) {
                                if ($key === "signUser" || $key === "ref") {
                                    
                                } else {
                                    if (empty($val)) {

                                        $this->msg = $this->error('Please enter required fields');
                                        $empty = true;
                                    } else {
                                        $empty = false;
                                    }
                                }
                            

                            }

                            if (!$empty) {
                                
                                $username =  strtolower($post['username']);
                                $pass =  $post['password'];
                                $cpass =  $post['cpassword'];
                                $email =  strtolower($post['email']);
                                $ref =  $post['ref'];
                                $name =  $post['fullname'];

                                $check1 = $this->model->ifExist($username, 'username', $this->model->table);
                                $check2 = $this->model->ifExist($username, 'email', $this->model->table);
                                if ($pass === $cpass) {
                                    $validPass = $this->make_password($pass);
                                    $userHash = $this->hashUser($username);
                                    //$newPin = $this->model->genValidatePin($this->model->table, 'pin');

                                    $is_active = true;
                                    $is_blocked = false;
                                    $is_restricted = false;

                                    $phoneCode = null;
                                    $phone = null;
                                    $email_verified = 0;
                                    $auto_withdraw = 0;
                                    $verified = false;
                                    $userType = 'user';
                                    $currency = 'USD';
                                    $address = null;
                                    $country = null;
                                    $userIp = null;
                                    $lastUrl = $this->getUrl();
                                    $time = $this->dateTime();
                                    $resetCode = uniqid('fgt_', false);
                                    $userIp = $this->geo_ip;
                                    if ($this->is_email($email)) {
                                        if ($check1 === 0 && $check2 === 0) {
                                            $fields = $this->model->fetchField($this->model->table);

                                            $values = array(null, $username, $email, $name, $validPass, $userHash, $phoneCode, $phone, $ref, $email_verified, $verified, $userType, $resetCode, $is_blocked, $is_active, $is_restricted, $auto_withdraw, $currency, $country, $address, $userIp, $lastUrl, $time);
                                            //$values = array(null,$username);

                                            $post = $this->model->postData($this->model->table, $fields, $values);

                                            if ($post === 100) {
                                                $this->msg = $this->success('Your account has been registered, please activate to login', 'Registration Success!');
                                            } else {
                                                $this->msg = $this->error($post);
                                            }

                                        } else {
                                            if ($check1 === 1) {
                                                $this->msg = $this->error('Username is already in use, please change it');
                                            }

                                            if ($check2 === 1) {
                                                $this->msg = $this->error('Email is already in use, please change it');
                                            }

                                        }

                                    } else {
                                        $this->msg = $this->error('Please use a valid email for your account');
                                    }
                                } else {
                                    $this->msg = $this->error('Your passwords did not match, retry');
                                }

                            }
                        }else{
                            $this->msg = $this->error($midChecker['msg']); 
                        }
                        //old 
                        $cToken = htmlspecialchars($params['cTokens']);
                        $tokenCRF = self::$midware->validateCrfToken($cToken, 128);

                        if ($tokenCRF) {

                            $name = htmlspecialchars($params['fullname']);
                            $email = htmlspecialchars(strtolower($params['email']));
                            $ref = $params['ref'];
                            $username = htmlspecialchars(strtolower($params['username']));
                            $pass = htmlspecialchars($params['password']);
                            $cpass = htmlspecialchars($params['cpassword']);

                            //if(!empty($name) && !empty($name))
                            foreach ($params as $key => $val) {
                                if ($key === "signUser" || $key === "ref") {
                                    // echo $val;
                                } else {
                                    if (empty($val)) {

                                        $this->msg = $this->error('Please enter required fields');
                                        $empty = true;
                                    } else {
                                        $empty = false;
                                    }
                                }
                                // $this->msg  = $val.' is  required';

                            }

                            if (!$empty) {
                                //$this->msg = $this->success();

                                $check1 = $this->model->ifExist($username, 'username', $this->model->table);
                                $check2 = $this->model->ifExist($username, 'email', $this->model->table);
                                if ($pass === $cpass) {
                                    $validPass = $this->make_password($pass);
                                    $userHash = $this->hashUser($username);
                                    //$newPin = $this->model->genValidatePin($this->model->table, 'pin');

                                    $is_active = true;
                                    $is_blocked = false;
                                    $is_restricted = false;

                                    $phoneCode = null;
                                    $phone = null;
                                    $email_verified = 0;
                                    $auto_withdraw = 0;
                                    $verified = false;
                                    $userType = 'user';
                                    $currency = 'USD';
                                    $address = null;
                                    $country = null;
                                    $userIp = null;
                                    $lastUrl = $this->getUrl();
                                    $time = $this->dateTime();
                                    $resetCode = uniqid('fgt_', false);
                                    $userIp = $this->geo_ip;
                                    if ($this->is_email($email)) {
                                        if ($check1 === 0 && $check2 === 0) {
                                            $fields = $this->model->fetchField($this->model->table);

                                            $values = array(null, $username, $email, $name, $validPass, $userHash, $phoneCode, $phone, $ref, $email_verified, $verified, $userType, $resetCode, $is_blocked, $is_active, $is_restricted, $auto_withdraw, $currency, $country, $address, $userIp, $lastUrl, $time);
                                            //$values = array(null,$username);

                                            $post = $this->model->postData($this->model->table, $fields, $values);

                                            if ($post === 100) {
                                                $this->msg = $this->success('Your account has been registered, please activate to login', 'Registration Success!');
                                            } else {
                                                $this->msg = $this->error($post);
                                            }

                                        } else {
                                            if ($check1 === 1) {
                                                $this->msg = $this->error('Username is already in use, please change it');
                                            }

                                            if ($check2 === 1) {
                                                $this->msg = $this->error('Email is already in use, please change it');
                                            }

                                        }

                                    } else {
                                        $this->msg = $this->error('Please use a valid email for your account');
                                    }
                                } else {
                                    $this->msg = $this->error('Your passwords did not match, retry');
                                }

                            }

                        } else {
                            $this->msg = $this->error('Sorry! we can not veriify your input at the moment ');
                        }

                    } else {
                        $this->msg = $this->error('Sorry! we can not veriify your input at the moment ');

                    }

                }
            }

            //var_dump($params);

        }

    }

    public static function logUserOut(array $params = []): void
    {
        //session_start();
        session_destroy();
        header("location:../login/");
    }

}

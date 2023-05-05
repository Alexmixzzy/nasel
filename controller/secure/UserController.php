<?php 
@require_once 'controller/BaseController.php';
@require_once 'core/components/secure/UserComponents.php';
@require_once 'core/widgets/secure/UserWidgets.php';
@require_once 'model/secure/UserModel.php';
@require_once 'model/server/ServerModel.php';
@require_once 'HandleInvestDeposit.php';
@require_once 'HandleWithdraw.php';


class UserController extends BaseController implements BaseInterFace{
    protected $model;
    protected static $methodObjects =[];
    
    
    public function __construct(){

        $this->model = new UserModel();
        $this->compo = new UserComponents($this->model,$this);
        self::$methodObjects['compo'] = $this->compo;
        self::$methodObjects['model'] = $this->model;
        self::$methodObjects['wiget'] =  new UserWidgets();
        self::$methodObjects['site'] = new ServerModel($this->model);
        parent::__construct();
        
    
        
    }

    
    private static function requireFile(array $params =[],$file,$objs ) : void{
        $obj = $objs;
        $methods = self::$methodObjects;
        $model = $methods['model'];
        $compo = $methods['compo'];
        $wiget = $methods['wiget'];
        $site = $methods['site'];

        if(is_file($file)){
            require_once $file;
    
            }else{
            self::template404($file,'404secure');
            }
    }

    public static function views(array $params = [],$template='secure/index',$_ext='.php',$handler='UserController',$handlerPath='secure/') : void
    {
        
        
        $objs = $handler;
        $path  = self::view(template:$template, _ext:null, handler:$objs,handlerPath:$handlerPath);

        if(is_file($path)){
            $obj = new $objs();
            self::requireFile($params,$path,$obj);
            
            
        }else{
            $path;
        }

    
    }
    public function renderView(string $pathFileName,$dotLev='',$mainPath ='view/secure/'){
        $obj =  $this;
    
        $viewPath = $mainPath . $pathFileName;
        self::requireFile([],$viewPath,$obj);
    

    }

    public function renderStep(string $fileName,$dotLev=''){
        
        return $this->renderView($fileName,$dotLev);

    }

    public function renderJs(string $fileName){
        
        //return $this->renderView($fileName,$dotLev,'static/secure/');
        $data = '
        <script src="../static/secure/'.$fileName.'"></script>
        ';

        echo $data;

    }

    private static function checkToken($token){
        return self::$midware->validateCrfToken($token, 128);
    }

    


    public static function index(array $params = [])
    {
        self::views(params:$params, template:'secure/index', handlerPath:'secure/');
    }

    public static function editProfile(array $params = [])
    {
        self::views(params:$params, template:'secure/edit-profile', handlerPath:'secure/');
    }

    public static function profile(array $params = [])
    {
        self::views(params:$params, template:'secure/profile', handlerPath:'secure/');
    }

    public static function settings(array $params = [])
    {
        self::views(params:$params, template:'secure/settings', handlerPath:'secure/');
    }

    public static function withdrawFund(array $params = [])
    {
        self::views(params:$params, template:'secure/withdraw', handlerPath:'secure/');
    }

    public  function deposit(array $params = []):void
    {
        
        self::views(params:$params, template:'secure/deposit', handlerPath:'secure/');
        
        
    
    }

    public static function resetInvestment(array $params = [])
    {
        self::views(params:$params, template:'secure/resetinvest', handlerPath:'secure/');
    }

    public static function myInvestment(array $params = [])
    {
        self::views(params:$params, template:'secure/investments', handlerPath:'secure/');
    }

    public static function requestCapital(array $params = [])
    {
        self::views(params:$params, template:'secure/requestCapital', handlerPath:'secure/');
    }

    public static function updateWithdrawMethod(array $params = [])
    {
        self::views(params:$params, template:'secure/settings', handlerPath:'secure/');
    }



    public function args(){

        $numargs = func_num_args();
        echo "Number of arguments: $numargs \n";
        if ($numargs >= 2) {
            echo "Second argument is: " . func_get_arg(1) . "\n";
        }
        $arg_list = func_get_args();
        for ($i = 0; $i < $numargs; $i++) {
            echo "Argument $i is: " . $arg_list[$i] . "\n";
        }

       // echo  func_num_args();
    }

    public function handleProfileUpdate(array $params = []){
        $empty = true;
        if(!empty($params)){
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['updateProfile'])) {

                    if (!empty($params['cTokens'])) {
                        $cToken = htmlspecialchars($params['cTokens']);
                        $tokenCRF = self::$midware->validateCrfToken($cToken, 128);

                        if ($tokenCRF) {
                    
                    foreach ($params as $key => $val) {
                        if ($key === "updateProfile") {

                        } else {
                            if (empty($val)) {

                                $this->msg = $this->error('Please enter  required fields');
                                $empty = true;
                            } else {
                                $empty = false;
                            }
                        }
                    }

                        if (!$empty) {
                            $this->msgs = $this->success('Profile Update successfully');

                        }else{
                            $this->msg = $this->error('Please enter  required fields'); 
                            
                        }
                        

                    

                    }else{
                        $this->msg = $this->error('Sorry, input  validation failure');
                    }
                }else{
                    $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                }

                }
            }
            //$this->msg = $this->error('Profile failed to update');
        }
    }

    public  function handleDeposit(array $params = [])
    {
        $depHander = new HandleInvestDeposit($this->model);
        $empty = true;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['invest'])) {

                    if (!empty($params['cTokens'])) {
                        $cToken = htmlspecialchars($params['cTokens']);
                        $tokenCRF = $this->midware->validateCrfToken($cToken, 128);
                        $amount = explode(",", $params['amount']);
                        $amount = implode("", $amount);
                        $plan = $params['plan'];
                        $min = $params['min_deposit'];
                        $payMethod = $params['payMethod'];
                        $payMethods = explode("_", $payMethod);
                        $coinName = $params['coinName'];
                        $payMethodType = $payMethods[0];
                        $payMethodKey = $payMethods[1];

                        if ($tokenCRF) {

                            foreach ($params as $key => $val) {
                                if ($key === "invest" ||  $key === 'coinName') {
                                } else {
                                    if (empty($val) || $val === "" || $val === null) {

                                        $this->msg = $this->error('Please enter  required fields');
                                        $empty = true;
                                    } else {
                                        $empty = false;
                                    }
                                }
                            }

                            if (!$empty && !empty($amount) && !empty($plan) && !empty($payMethod) && !empty($min)) {
                                // $this->msgs = $this->success('Deposit Created successfully <br>',$amount);

                                if ($payMethodType === 'crypto' && empty($coinName)) {
                                    $this->msg = $this->error('Please select the coin you want to send');
                                    return;
                                }

                                $req = $depHander->depHandleDeposit($this->model->authUser, $amount, $plan, $payMethod,$coinName);

                                if ($req['status'] === 100  || $req['status'] > 99) {
                                    $this->msgs = $this->success($req['msg']);
                                } else {
                                    $this->msg = $this->error($req['msg']);
                                }
                            } else {
                                $this->msg = $this->error('Please enter  required fields');
                            }
                        } else {
                            $this->msg = $this->error('Sorry, input  validation failure');
                        }
                    } else {
                        $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                    }
                }
            }
            //$this->msg = $this->error('Profile failed to update');
        }
    }

    public  function handleResetInvest(array $params = [])
    {
        $depHandler = new HandleInvestDeposit($this->model);
        $empty = true;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['resetInvest'])) {  

                    if (!empty($params['cTokens'])) {
                        
                        $midChecker = $this->midware->sanitizeInput('invesReset',$params);

                        
                            if($midChecker['status']){
                                $post = $midChecker['data'];
                                
                                
                                if(!empty($post['invest_id'])&& !empty($post['plan'])){

                                    $handle = $depHandler->depHandleReset($post['invest_id'],$post['plan']);

                                    if(!empty($handle['status']) && $handle['status'] >90){
                                        //$this->msgs = $this->success('Request handled sucessfully '.$handle['fold'].$post['invest_id']);
                                        if(!empty($handle['msg'])){
                                            $this->msgs = $this->success($handle['msg']);
                                        }else{
                                            $this->msgs = $this->success('Your reset request submitted and handled sucessfully ');
                                        }

                                    }else{
                                        if(!empty($handle['msg'])){
                                            $this->msg = $this->error($handle['msg']);
                                        }else{
                                            $this->msg = $this->error('Sorry, we can not handle your request at the moment. Please try again later');
                                        }
                                    }

                                }else{
                                    $this->msg = $this->error('Sorry, you need to select a new  plan to re invest in');
                                }
                                
                            }else{
                                $this->msg = $this->error($midChecker['msg']);
                            }

                    } else {
                        $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                    }
                }
            }
            
        }
    }

    public  function handleWithdrawFund(array $params = [])
    {
        $Handler = new HandleWithdraw($this->model);
        $empty = true;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['wFund'])) {  

                    if (!empty($params['cTokens'])) {
                        
                        $midChecker = $this->midware->sanitizeInput('withdrawProfit',$params);

                        
                            if($midChecker['status']){
                                $post = $midChecker['data'];
                                
                                
                                if(!empty($post['payAddress'])&& !empty($post['payAmount'])){

                                    //$handle = $depHandler->depHandleReset($post['invest_id'],$post['plan']);
                                    $handle = $Handler->handleProfitWithdraw($post['payAmount'],$post['payAddress'],$post['payMethod']);

                                    if(!empty($handle['status']) && $handle['status'] > 90){
                                        $this->msg = $this->success($handle['msg']);

                                    }else{
                                        $this->msg = $this->error($handle['msg']);
                                    }


                                    

                                }else{
                                    $this->msg = $this->error('Sorry, you need to select payment destination and enter amount --'.(int)$midChecker['status']);
                                }
                                
                            }else{
                                $this->msg = $this->error($midChecker['msg']);
                            }

                    } else {
                        $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                    }
                }
            }
            
        }
    }

    public  function handleWithdrawCapital(array $params = [])
    {
        $Handler = new HandleWithdraw($this->model);
        $empty = true;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['reqCapital'])) {  

                    if (!empty($params['cTokens'])) {
                        
                        $midChecker = $this->midware->sanitizeInput('withdrawCapital',$params);

                        
                            if($midChecker['status']){
                                $post = $midChecker['data'];
                                
                                
                                if(!empty($post['payAddress'])&& !empty($post['invest_id'])){

                                    //$handle = $depHandler->depHandleReset($post['invest_id'],$post['plan']);
                                    $handle = $Handler->handleCapitalWithdraw($post['invest_id'],$post['payAddress'],$post['payMethod']);

                                    if(!empty($handle['status']) && $handle['status'] > 90){
                                        $this->msg = $this->success($handle['msg']);

                                    }else{
                                        $this->msg = $this->error($handle['msg']);
                                    }


                                    

                                }else{
                                    $this->msg = $this->error('Sorry, you need to select payment destination and enter amount --'.(int)$midChecker['status']);
                                }
                                
                            }else{
                                $this->msg = $this->error($midChecker['msg']);
                            }

                    } else {
                        $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                    }
                }
            }
            
        }
    }

    public function handleCloseInvoice(array $params =[]){
        $depHander = new HandleInvestDeposit($this->model);
        $empty = true;
        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (isset($_POST['closeInvoice'])) {

                    if (!empty($params['cTokens'])) {
                        if (self::checkToken($params['cTokens'])) {
                            $depHander->closeInvoice();


                        }else{
                            $this->msg = $this->error('Sorry, input  validation failure');
                        }
                    }else{
                        $this->msg = $this->error('Sorry, we can not verify your input at the  moment');
                    }
                }
            }
        }
    }
}


?>
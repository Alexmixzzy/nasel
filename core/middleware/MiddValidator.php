<?php 
require_once 'MiddleWare.php';

class MiddValidator extends MiddleWare {


    
    private $sucess = true;
    private $error = false;

    private  $inputValidateError;
    private  $tokenValidateError;

    private  $noMatchValidateError;
    private  $validateError;


    public function __construct(){
        $this->noMatchValidateError ='';
        $this->tokenValidateError ='Sorry, your input can not be validated at the moment';
        $this->inputValidateError ='';
        $this->validateError = 'Invalid request or No valid data for validation';
        $this->noMatchValidateError ='Invalid request, please fill up the required data';
    }
    private function validateUserSignup(array $params = [])
    {
        $validated = array();
        $req = array();
        $req['status'] =  false;
        $req['msg'] = $this->validateError;
        $keys = array('signUser'=>'', 'cTokens'=>'','password'=>'','cpassword'=>'','username'=>'','email'=>'','fullname'=>'','ref'=>'');
        
        $checkIT = false;

        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (count($params) === count($keys)) {
                    $vCrf = $this->validateCrfToken(htmlspecialchars($params['cTokens']));
                    

                    if ($vCrf) {
                        foreach ($params as $key => $value) {
                            if (!array_key_exists($key,$keys)) {
                                $req['status'] =  false;
                                $req['msg'] = $this->noMatchValidateError;
                                $checkIT  = false;
                                
                                break;
                                

                            } else {
                            
                        
                                if ($key === 'username') {
                                    $newData = $this->cleanUserName(htmlspecialchars(strtolower($value)));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'ref') {
                                    $newData = $this->cleanUserName(htmlspecialchars($value));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'email') {
                                    $newData = $this->cleanUserName(htmlspecialchars(strtolower($value)));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'fullname') {
                                    $newData = $this->cleanName(htmlspecialchars($value));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'password') {
                                    $newData = htmlspecialchars($value);
                                    
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'cTokens') {
                                    
                                    array_push($validated, $validated[$key] = htmlspecialchars($value) );
                                }
                                
                                if ($key === 'loginUser') {
                                    array_push($validated, $validated[$key] = '');
                                }
                                

                                $checkIT = true;
                                //continue;
                                

                            }
                            # code...
                        }
                    } else {
                        $req['status'] =  false;
                        $req['msg'] = $this->tokenValidateError;
                    }
                } else {
                    $req['status'] =  false;
                    $req['msg'] = $this->noMatchValidateError;
                }
            }
        }
        if($checkIT){
            $req['status'] = true;
            $req['data'] = $validated;
            return $req;
        }else{
            $req['status'] = false;
            $req['data'] = $validated;
            return $req;
        }
        
    }

    private function validateUserLogin(array $params = [])
    {
        $validated = array();
        $req = array();
        $req['status'] =  false;
        $req['msg'] = $this->validateError;
        $keys = array('loginUser'=>'', 'cTokens'=>'','password'=>'','username'=>'');
        
        $checkIT = false;

        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (count($params) === count($keys)) {
                    $vCrf = $this->validateCrfToken(htmlspecialchars($params['cTokens']));
                    

                    if ($vCrf) {
                        foreach ($params as $key => $value) {
                            if (!array_key_exists($key,$keys)) {
                                $req['status'] =  false;
                                $req['msg'] = $this->noMatchValidateError;
                                $checkIT  = false;
                                
                                break;
                                

                            } else {
                            
                        
                                if ($key === 'username') {
                                    $newData = $this->cleanUserName(htmlspecialchars(strtolower($value)));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'password') {
                                    $newData = htmlspecialchars($value);
                                    
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'cTokens') {
                                    
                                    array_push($validated, $validated[$key] = htmlspecialchars($value) );
                                }
                                
                                if ($key === 'loginUser') {
                                    array_push($validated, $validated[$key] = '');
                                }
                                

                                $checkIT = true;
                                //continue;
                                

                            }
                            # code...
                        }
                    } else {
                        $req['status'] =  false;
                        $req['msg'] = $this->tokenValidateError;
                    }
                } else {
                    $req['status'] =  false;
                    $req['msg'] = $this->noMatchValidateError;
                }
            }
        }
        if($checkIT){
            $req['status'] = true;
            $req['data'] = $validated;
            return $req;
        }else{
            $req['status'] = false;
            $req['data'] = $validated;
            return $req;
        }
        
    }

    private function validateUserDeposit(){
        
    }

    private function validateResetInvest(array $params = [])
    {
        $validated = array();
        $req = array();
        $req['status'] =  false;
        $req['msg'] = 'Invalid request or No valid data for validation';
        $keys = array('invest_id', 'cTokens','plan', 'resetInvest');
        $newInvestID = null;
        $newKey = null;
        $newToken = null;

        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (count($params) === count($keys)) {
                    $vCrf = $this->validateCrfToken(htmlspecialchars($params['cTokens']));

                    if ($vCrf) {
                        foreach ($params as $key => $value) {
                            if (in_array($key, $keys)) {

                            

                                if ($key === 'invest_id') {
                                    $newInvestID = $this->cleanTID($value);
                                    array_push($validated, $validated[$key] = $newInvestID);
                                }
                                if ($key === 'plan') {
                                    $newInvestID = $this->cleanTextField(htmlspecialchars($value));
                                    array_push($validated, $validated[$key] = $newInvestID);
                                }
                                if ($key === 'cTokens') {
                                    
                                    array_push($validated, $validated[$key] = htmlspecialchars($value) );
                                }
                                if ($key === 'resetInvest') {
                                    array_push($validated, $validated[$key] = '');
                                }

                                $req['status'] = true;
                                $req['data'] = $validated;


                            } else {
                                $req['status'] =  false;
                                $req['msg'] = 'Token  keys did not  match';
                            }
                            # code...
                        }
                    } else {
                        $req['status'] =  false;
                        $req['msg'] = 'Sorry, your input ca not bbe validated at the moment';
                    }
                } else {
                    $req['status'] =  false;
                    $req['msg'] = 'Invalid Parameter Tokens';
                }
            }
        }
        return $req;
    }

    private function validateWithdrawFund(array $params = [])
    {
        $validated = array();
        $req = array();
        $req['status'] =  false;
        $req['msg'] = $this->validateError;
        $keys = array('wFund'=>'', 'cTokens'=>'','payAddress'=>'', 'payMethod'=>'','payAmount'=>'');
        $checkIT = false;

        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (count($params) === count($keys)) {
                    $vCrf = $this->validateCrfToken(htmlspecialchars($params['cTokens']));
                    

                    if ($vCrf) {
                        foreach ($params as $key => $value) {
                            if (!array_key_exists($key,$keys)) {
                                $req['status'] =  false;
                                $req['msg'] = $this->noMatchValidateError;
                                $checkIT  = false;
                                break;

                            
                            } else {
                            
                                if ($key === 'payAddress') {
                                    $newData = $this->cleanTextField(htmlspecialchars($value));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'payMethod') {
                                    $newData = $this->cleanTextField(htmlspecialchars($value));
                                    
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'cTokens') {
                                    
                                    array_push($validated, $validated[$key] = htmlspecialchars($value) );
                                }
                                if ($key === 'payAmount') {
                                    $newData = $this->cleanAmount(htmlspecialchars($value));
                                    $amount = explode(",", $this->cleanAmount($value));
                                    $amount = implode("", $amount);
                                    array_push($validated, $validated[$key] = htmlspecialchars($amount) );
                                }
                                if ($key === 'wFund') {
                                    array_push($validated, $validated[$key] = '');
                                }

                                $checkIT = true;

                            }
                            # code...
                        }
                    } else {
                        $req['status'] =  false;
                        $req['msg'] = $this->tokenValidateError;
                    }
                } else {
                    $req['status'] =  false;
                    $req['msg'] = $this->noMatchValidateError;
                }
            }
        }
        if($checkIT){
            $req['status'] = true;
            $req['data'] = $validated;
            return $req;
        }else{
            $req['status'] = false;
            $req['data'] = $validated;
            return $req;
        }
        
    }

    private function validateWithdrawCapital(array $params = [])
    {
        $validated = array();
        $req = array();
        $req['status'] =  false;
        $req['msg'] = $this->validateError;
        $keys = array('reqCapital'=>'', 'cTokens'=>'','payAddress'=>'','payMethod'=>'','invest_id'=>'');
        
        $checkIT = false;

        if (!empty($params)) {
            if ($_SERVER["REQUEST_METHOD"] === self::METHOD_POST) {
                if (count($params) === count($keys)) {
                    $vCrf = $this->validateCrfToken(htmlspecialchars($params['cTokens']));
                    

                    if ($vCrf) {
                        foreach ($params as $key => $value) {
                            if (!array_key_exists($key,$keys)) {
                                $req['status'] =  false;
                                $req['msg'] = $this->noMatchValidateError;
                                $checkIT  = false;
                                
                                break;
                                

                            } else {
                            
                        
                                if ($key === 'payAddress') {
                                    $newData = $this->cleanTextField(htmlspecialchars($value));
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'payMethod') {
                                    $newData = $this->cleanTextField(htmlspecialchars($value));
                                    
                                    array_push($validated, $validated[$key] = $newData);
                                }
                                if ($key === 'cTokens') {
                                    
                                    array_push($validated, $validated[$key] = htmlspecialchars($value) );
                                }
                                if ($key === 'invest_id') {
                                    $newData = $this->cleanTID($value);
                                    array_push($validated, $validated[$key] = htmlspecialchars($newData) );
                                }
                                if ($key === 'reqCapital') {
                                    array_push($validated, $validated[$key] = '');
                                }
                                

                                $checkIT = true;
                                //continue;
                                

                            }
                            # code...
                        }
                    } else {
                        $req['status'] =  false;
                        $req['msg'] = $this->tokenValidateError;
                    }
                } else {
                    $req['status'] =  false;
                    $req['msg'] = $this->noMatchValidateError;
                }
            }
        }
        if($checkIT){
            $req['status'] = true;
            $req['data'] = $validated;
            return $req;
        }else{
            $req['status'] = false;
            $req['data'] = $validated;
            return $req;
        }
        
    }

    private function validateError(){
                $req = array();
                $req['status'] = false;
                $req['msg'] = 'Sorry we could not match nor  validate  your request at the moment';

                return $req;
    }

    public function sanitizeInput($key,array $params){
        try {
        $match = match ($key){
            'invesReset'=>$this->validateResetInvest($params),
            'withdrawProfit'=>$this->validateWithdrawFund($params),
            'withdrawCapital'=>$this->validateWithdrawCapital($params),
            'loginVal'=>$this->validateUserLogin($params),
            'signupVal'=>$this->validateUserSignup($params),
        };
        } catch (\UnhandledMatchError $e) {
        $match = $this->validateError();
        }

        return $match;
    }


    public   function setCrfToken(){
    
        return $this->setCrf();
    }


    public function validateCrfToken($token, $lent = 128)
    {
        return $this->validateCrf($token,$lent);
    }


    
}



?>
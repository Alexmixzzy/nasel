<?php 

@require_once 'core/api/StaticWalletAPI.php';
@require_once 'controller/BaseController.php';

class HandleInvestDeposit extends BaseController {


    protected $model;
    protected $obj;
    protected  $table;
    protected  $settingsTable;

    protected $deposit_status ='pending';
    protected  $amount = 0;
    protected $min  =100;
    protected $max  =10000000;


    protected $method;

    protected $user;

    public function __construct($model){
            $this->model = $model;
            
            $this->table  =  $this->tb_Invest;
            $this->settingsTable  =  $this->tb_InvestSettings;
            $this->user = $model->authUser;
            $this->depCurSign();
            $this->depMini();
            

    }


    private function depMini() :void{
        
        $minDep = $this->model->getData($this->settingsTable,'min_deposit','use_now','yes');
        $maxDep = $this->model->getData($this->settingsTable,'max_deposit','use_now','yes');

        if(!empty($minDep) && (is_float($minDep) || is_numeric($$minDep) || is_int($$minDep))){
        
        $this->min = $minDep;
        }
        if(!empty($maxDep) && (is_float($maxDep) || is_numeric($$maxDep) || is_int($$maxDep))){
        
        $this->max = $minDep;
        }


    }

    private function depCurSign(){
        if(!empty($this->model->site->currency)){
        $this->currency = $this->model->site->currency;
        }

        $this->sym = $this->xeSym($this->currency);
    }

    private function depGetPlan($field,$plan){
        return  $this->model->getData($this->tb_Plans,$field,'main_id',$plan);
    }

    private function depInvestExist($field,$data){
        return  $this->model->ifExist($data,$field,$this->table,$this->user,'username');
    }

    private function depGetInvest($id,$field){
        return  $this->model->getData($this->table,$field,'invest_id',$id,'username',$this->user);
    }

    private function depUpdateInvest($id,array $field,array $values){
        return  $this->model->updateData($this->table,$field,$values,'invest_id',$id,'username',$this->user);
    }


    private function depGetSettings($field){
        return  $this->model->getData($this->tb_InvestSettings,$field,'id',1,'use_now','yes');
    }

    private function depGetRef($user){
        return  $this->model->getData($this->tb_Users,'ref','username',$user);
    }

    private function depGetPlanCate($field,$cate){
        return  $this->model->getData($this->tb_PlanCate,$field,'cate_plan',$cate);
    }

    private function depReturnFold($plan){

        $returnInvest = $this->depGetPlan('return_invest',$plan);
        $resetInvest = $this->depGetPlan('plan_reinvest',$plan);
        $returnFold = $this->depGetPlan('return_fold',$plan);
        $perc =0;

        if($resetInvest==='yes' && $returnInvest==='yes'){
            $perc = $returnFold;
        }

        return $perc;

        
    }

    private function depSetRecord($id,$amount,$coinAmount,$plan,$coinName,$addr,$method,$statuus='pending'){
        $return = array();
        $plan_name = $this->depGetPlan('plan_name',$plan);
        $plan_cate = $this->depGetPlan('plan_category',$plan);
        $plan_cateName = $this->depGetPlanCate('cate_name',$plan_cate);

        

                        $investID = $id;
						$profit = 0;
						$status = $statuus;
						$category = ''.strtoupper($plan_name).'-'.strtoupper($plan_cate).'';
						//$category_REF = strtoupper($plan_cate).'-INVEST-REFERRAL';
						$desc = ''.strtoupper($plan_name).'-'.strtoupper($plan_cateName).'';
						$place_order = 'no';
						$received_status = 'no';
						$payout_consent = 'no';
						$day_counter = 0;
						$total_not_paid = 0;
						$total_paid = 0;
						$address =$addr;
						$plan_type = $plan;
						$coin_type = $coinName;
						$coin_amount = $coinAmount;
						$pay_level = 0;
						$deposit_id = null;
					    $qr_code = 'qr.png';
					    $date_day_ = date("d");
					    $date_day2_ = date("l");
					    $date_month_ = date("m");
					    $date_month2_ = date("F");
					    $date_year_ = date("Y");
                        $date = $this->dateTime();
                        $userType = $this->model->auth->authType;
                        $plan_addtime = $this->depGetPlan('add_time',$plan);
                        $userName = $this->model->authUser;
                        $methods  = explode('_',$method);
                        $methodKey = $methods[1];
                        $methodName = $methods[0];
                        
                        $field = $this->model->fetchField($this->table);
                        $values = array(null,$investID,$userName,$amount,$profit,$status,$category,$desc,$place_order,$received_status,$payout_consent,$day_counter,$date,$total_not_paid,$total_paid,$address,$plan_type,$coin_type,$coin_amount,$qr_code,$deposit_id,$pay_level,$userType,$plan_addtime,$plan_addtime,$plan_cate,null,null,$date_day_,$date_day2_,$date_month_,$date_month2_,$date_year_,$method,$methodKey,$methodName,null);

                        $post = $this->model->postData($this->table,$field,$values);

                        if($post===$this->model->success){
                            $return['status']=100;
                            $return['msg']='Deposit Created successfully and waiting for payment';
                        }else{
                            $return['status']=0;
                            $return['msg']=$post;
                        }

                        
                        return $return;


    }

    private function depHasRef($user){
        $ref = $this->depGetRef($user);
        if(!empty($ref)){
            return true;
        }else{
            return false;
        }
    }

    private function depGenerateID(){
        return $this->model->genValidateDepKey($this->table,'invest_id','INV-');
    }

    private function depPaypalWeb($user,$amount,$plan,$method){

    }

    private function depPaypalCard($user,$amount,$plan,$method){
        
    }

    private function depCoinPayment($user,$amount,$plan,$method){
        
    }

    private function depStaticWallet($amount,$coinName){
        $return = array();
        $converter = new StaticWalletApi($this->model);

        $convert = $converter->apiStaticConvert($amount,$this->currency,$coinName);
        return $convert;
        
    }

    private function depHandleCrypto($methodKey,$amount,$coinName){
        
        $match = match($methodKey){
            'static' => $this->depStaticWallet($amount,$coinName),
            'coinpayment' => 'This food is a bar',
            'blockchain' => 'This food is a cake',
        };

        return $match;
    }

    private function depHandleBank($methodKey,$amount){
            $return = array();
            $return['status'] =100;
            $return['paymentDetails'] ='our bank';

            return  $return;
    }

    private function depHandleMethod($method,$amount,$coinName){
        $return = array();
        $payMethods = explode("_",$method);
        $methodKey = $payMethods[1];
        $methodName = $payMethods[0];
        if($methodName==='crypto'){
            $this->method = 'crypto';
            $handler = $this->depHandleCrypto($methodKey,$amount,$coinName);
        }else{
            $this->method = 'bank';
            $handler = $this->depHandleBank($methodKey,$amount);
            
        }

        return $handler;
    }

    private function depCheckHander($handle){
            if(!empty($handle['status'])){
                if($handle['status']===100 || $handle['status'] >90){
                        return true;      
                }else{
                    return 50;
                }
            }else{
                return 0;
            }
    }

    private function unsetSesh($s=null){
            if(!empty($s)){
                if(!empty($_SESSION[$s])){
                    unset($_SESSION[$s]);
                    $_SESSION[$s] =null;
                }
            }
    }

    private function depHandleCloseInvoice($method) {
       return match($method){
            'crypto' => $this->closeCryptoInvoice(),
            'bank' => $this->closeBankInvoice(),
        };

        

        
    }

    private  function setBankInvoice(){
        
    }

    private function setCryptoInvoice(){

    }

    private  function closeBankInvoice(){
        
    }

    private function closeCryptoInvoice() : void{
        $this->unsetSesh('d_amount');
        $this->unsetSesh('d_address');
        $this->unsetSesh('d_coinType');
        $this->unsetSesh('amount');
        $this->unsetSesh('invoice');
    }

    private function seshExist($s=null) : bool{
        $re = false;
        if(!empty($s)){
            if(!empty($_SESSION[$s])){
                $re  = true;
            }
        }

        return $re;
    }

    public function depResetDeposit($id,$newPlan){
        $return = array();
        $oldPlan = $this->depGetInvest($id,'plan_type');
        $plan = $newPlan;
        $pac = $this->depReturnFold($oldPlan);
        //$amount = $pac / 100 * $this->depGetInvest($id,'amount');
        $amount = $this->getPercentBal($pac,$this->depGetInvest($id,'amount'));

        $planCate = $this->depGetInvest('plan_category', $plan);
        $start_amount = $this->depGetPlan('plan_amount', $plan);
        $end_amount = $this->depGetPlan('plan_amount2', $plan);
        $plan_name = $this->depGetPlan('plan_name', $plan);
        $plan_unlimited = $this->depGetPlan('unlimited', $plan);
        $plan_addtime = $this->depGetPlan('add_time', $plan);
        $ref_Pay = $this->depGetSettings('ref_percent');
        $ref_cut = 0;
        $ref_fee  = 0;
        $coinAmount =0;
        $address = null;
        $coinName =$this->model->site->currency;
        $investID = $this->depGenerateID();
        $status = 'confirmed';
        
        $methodName = 'ROI';
        $method = 'ROI_profit';
        if($plan_unlimited==='no'){
            $endPay = $end_amount;
        }else{
            $endPay = 100000000;
        }

        if(is_numeric($amount)){


            if($amount >= $start_amount && $amount <= $endPay){
            
                    

                $deposit = $this->depSetRecord($investID,$amount,$coinAmount,$plan,$coinName,$address,$method,$status);

                if($deposit['status']>90){
                    
                    $field = array('status');
                    $values =  array('close');
                    $update = $this->depUpdateInvest($id,$field,$values);

                    if($update ===100){
                        $return['status'] = 100;
                        $return['msg'] = 'Your reset request submitted and handled sucessfully';
                    }else{
                    $return['status'] = 80;
                    $return['msg'] = $update['msg'];
                    }
                }else{
                    $return['status'] = $deposit['status'];
                    $return['msg'] = $deposit['msg'];
                }

                    
                

            }else if($amount > $endPay){
                $return['status']  = 0;
                $return['msg'] = 'Your subscripton for this plan demands maximum of '.$this->sym.$this->fmt($endPay,2).'!';

            }else if($amount < $start_amount && !empty($start_amount) ){
                $return['status']  = 0;
                $return['msg'] = 'Your subscripton for this plan demands minimum of '.$this->sym.$this->fmt($start_amount,2).'!';

            }else{
                $return['status']  = 0;
                $return['msg'] = 'Sorry, We can not determin your plan amount at the moment, retry  '.$amount.' - '.$start_amount;
            }
        }else{
            $return['status']  = 0;
            $return['msg'] = 'Please only digit is allowed';
        }

        if ( !empty( $return ) ) {
            return $return;
        }else{
            $return['status'] = 0;
            $return['msg'] = 'Sorry we ccould not handle your deposit at the meoment due to unknown error';
        }

    }


    public function depHandleDeposit($user,$amount,$plan,$method,$coinName){
        $return = array();

        $planCate = $this->depGetPlan('plan_category', $plan);
        $start_amount = $this->depGetPlan('plan_amount', $plan);
        $end_amount = $this->depGetPlan('plan_amount2', $plan);
        $plan_name = $this->depGetPlan('plan_name', $plan);
        $plan_unlimited = $this->depGetPlan('unlimited', $plan);
        $plan_addtime = $this->depGetPlan('add_time', $plan);
        $ref_Pay = $this->depGetSettings('ref_percent');
        $ref_cut = 0;
        $ref_fee  = 0;
        $coinAmount =0;
        $address = null;
        $investID = $this->depGenerateID();
        $methods  = explode('_',$method);
        $methodName = $methods[0];
        if($plan_unlimited==='no'){
            $endPay = $end_amount;
        }else{
            $endPay = 100000000;
        }

        if(is_numeric($amount)){


            if($amount >= $start_amount && $amount <= $endPay){
            
                    

                    if($this->depHasRef($user) && $ref_Pay==='yes'){
                        $ref_cut = $this->depGetSettings('ref_percent');
                        $ref_fee  = $ref_cut / 100 * $amount;
                    }

                    $handle = $this->depHandleMethod($method,$amount,$coinName);
                    
                    if($this->method==='crypto'){
                        if($this->depCheckHander($handle)){
                            $address = $handle['address'];
                            $coinAmount = $handle['amount'];
                        

                        }

                        $deposit = $this->depSetRecord($investID,$amount,$coinAmount,$plan,$coinName,$address,$method);

                        if($deposit['status']>90){
                            $return['status'] = $deposit['status'];
                            $return['msg'] = $deposit['msg'];
                            $_SESSION['d_amount'] = $coinAmount;
                            $_SESSION['d_address'] = $address;
                            $_SESSION['d_coinType'] = $coinName;
                            $_SESSION['amount'] = $amount;
                            $_SESSION['invoice'] = $methodName;
                            $_SESSION['invoiceID'] = $investID;
                        }else{
                            $return['status'] = $deposit['status'];
                            $return['msg'] = $deposit['msg'];
                        }
                    }
                

            }else if($amount > $endPay){
                $return['status']  = 0;
                $return['msg'] = 'Your subscripton for this plan demands maximum of '.$this->sym.$this->fmt($endPay,2).'!';

            }else if($amount < $start_amount && !empty($start_amount) ){
                $return['status']  = 0;
                $return['msg'] = 'Your subscripton for this plan demands minimum of '.$this->sym.$this->fmt($start_amount,2).'!';

            }else{
                $return['status']  = 0;
                $return['msg'] = 'Sorry, We can not determin your plan amount at the moment, retry  '.$amount.' - '.$start_amount;
            }
        }else{
            $return['status']  = 0;
            $return['msg'] = 'Please only digit is allowed';
        }

        if ( !empty( $return ) ) {
            return $return;
        }else{
            $return['status'] = 0;
            $return['msg'] = 'Sorry we ccould not handle your deposit at the meoment due to unknown error';
        }

    }


    public function closeInvoice() :void{
                if($this->seshExist($_SESSION['invoice'])){
                    //$this->depHandleCloseInvoice($_SESSION['invoice']);
                    if(trim(strtolower($_SESSION['invoice']))==='crypto'){
                        

                    }
                }
                $this->closeCryptoInvoice();
                //



    }

    public function depHandleReset($investID,$newPlan){
        $req = array();
        $req['status'] = 0;
        $req['msg'] = 'Sorry, our system can not handle your request at the moment, try again  later';
        $checker = $this->depInvestExist('invest_id',$investID);



        if ($checker === 1) {
            $checkStatus = $this->depGetInvest($investID, 'status');

            if ($checkStatus === 'done') {
                $planID = $this->depGetInvest($investID, 'plan_type');
                $checkReturnStatus = $this->depGetPlan('return_invest',$planID);
                $checkReInvestStatus = $this->depGetPlan('plan_reinvest',$planID);
                if($checkReInvestStatus==='yes' && $checkReturnStatus==='yes' ){
                    $reqs = $this->depResetDeposit($investID, $newPlan);
                if (!empty($reqs['status'] > 90)) {
                    $req['status'] = 100;
                    $req['msg'] = $reqs['msg'];;
                } else if (!empty($reqs['status'] > 70)) {
                    $req['status'] = 100;
                    $req['msg'] = $reqs['msg'];
                } else {
                    $req['status'] = 0;
                    $req['msg'] = $reqs['msg'];
                }
                }else{
                    $req['status'] = 0;
                    $req['msg'] = 'Sorry, This investment fund can not be reinvested as it may be without  capital return';
                }
                
            }else{
                $req['status'] = 0;
                $req['msg'] = 'Sorry, only completed  investment can be reinvested';
            }
        } else {
            $req['status'] = 0;
            $req['msg'] = 'Invalid validation token, check your request and retry';
        }

            return $req;
    }

    





}


?>
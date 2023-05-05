<?php 

@require_once 'controller/BaseController.php';

class HandleWithdraw extends BaseController {

    private $model;
    private $table;
    private $tableProfit;
    private $user;

    private $balance=0;
    private $totalgain=0;
    private $totalwithdraw=0;

    private $min=10;
    private $max=10000;
    private $withdrawStatus=0;
    public function __construct($model){
        $this->model = $model;
        
        $this->table  =  $this->tb_Withdraw;
        $this->tableProfit  =  $this->tb_Profits;
       // $this->settingsTable  =  $this->tb_InvestSettings;
        $this->user = $model->authUser;
        $this->depCurSign();

        $this->balance = $this->model->getProfit('balance');
        $this->totalwithdraw = $this->model->getProfit('total_withraw');
        $this->withdrawStatus = $this->model->getProfit('withdraw');
        

}

private function postWithdraw(array $fields, array $values){
                $post = $this->model->postData($this->table,$fields,$values);
                if($post ===100){
                    return true;
                }else{
                    return $post;
                }

}

private function getWdata($field,$id){


}

private function getPlanData($field,$plan){
    return  $this->model->getData($this->tb_Plans,$field,'main_id',$plan);
}

private function checkInvestExist($field,$data){
    return  $this->model->ifExist($data,$field,$this->tb_Invest,$this->user,'username');
}

private function getInvestData($id,$field){
    return  $this->model->getData($this->tb_Invest,$field,'invest_id',$id,'username',$this->user);
}

private function updateInvestData($id,array $field,array $values){
    return  $this->model->updateData($this->tb_Invest,$field,$values,'invest_id',$id,'username',$this->user);
}

private function planReturnFold($plan){

    $returnInvest = $this->getPlanData('return_invest',$plan);
    $resetInvest = $this->getPlanData('plan_reinvest',$plan);
    $returnFold = $this->getPlanData('return_fold',$plan);
    $perc =0;

    if($resetInvest==='yes' && $returnInvest==='yes'){
        $perc = $returnFold;
    }

    return $perc;

    
}

private function planCanReturn($plan){

    $returnInvest = $this->getPlanData('return_invest',$plan);
    $resetInvest = $this->getPlanData('plan_reinvest',$plan);
    $returnFold = $this->getPlanData('return_fold',$plan);
    $perc =0;

    if($resetInvest==='yes' && $returnInvest==='yes'){
        $perc = $returnFold;
        
    }

    if($perc >10){
        return true;
    }else{
        return false;
    }

    

    
}

private function gettPlanData($field,$plan){
    return  $this->model->getData($this->tb_Plans,$field,'main_id',$plan);
}




private function updateBalance(array $fields, array $values){
            $update = $this->model->updateData($this->tableProfit,$fields,$values,'username',$this->user);
            if($update===100){
                return true;
            }else{
                return $update;
            }

}

private function wGenerateID(){
    return $this->model->genValidateDepKey($this->table,'transaction_id','WPN-');
}

private function setWithdrawRecord($amount, $addr, $method, $cur)
{


        $id = null;
        $transaction_id = $this->wGenerateID();;
        $username = null;
        $pay_method = $method;
        $pay_type  = null;
        $year_ = null;
        $withdraw_id  = null;
        $txn_id  = null;
        $currency  = $cur;
        $acct_type  = 'user';
        $address  = $addr;
        $remove  = 'no';
        $status  = 'pending';
        $date_day_ = date("d");
		$date_day2_ = date("l");
		$date_month_ = date("m");
		$date_month2_ = date("F");
		$date_year_ = date("Y");
        $date_time  = $this->dateTime();
        $type  = 'Profit Withdrawal';
        $field  = $this->model->fetchField($this->table);
        $values  = array($id, $transaction_id, $this->user, $amount, $type, $pay_method, $pay_type, $withdraw_id, $txn_id, $currency, $acct_type, $address, $remove, $status, $date_day_,$date_day2_,$date_month_,$date_month2_,$date_year_, $date_time);

        $post = $this->postWithdraw($field, $values);

        if($post){
            return  true;
        }else{
            return  $post;
        }
}

private function closeIvestment($id){
            $field = array('status');
            $values = array('closed');
            $data = $this->updateInvestData($id,$field,$values);
            if($data===100){
                return true;
            }else{
                return $data;
            }
}


private function depCurSign(){
    if(!empty($this->model->site->currency)){
    $this->currency = $this->model->site->currency;
    }

    $this->sym = $this->xeSym($this->currency);
}

private function debitUserProfit($amount){

                $charge = $this->balance - $amount;
                $totW   = $this->totalwithdraw + $amount;
                

                $field  = array('balance','total_withdraw');
                $values = array($charge,$totW);

                $debit = $this->updateBalance($field,$values);
                if($debit){
                    return  true;
                }else{
                    return $debit;
                }
}

private function handleCryptoWithdraw($amount,$address,$method='crypto'){

    $req = array();
    $req['status']=0;
    $req['msg'] = 'Sorry! Something went wrong, please try again after sometime ';
        
        if($amount >= $this->min &&  $amount <= $this->max ){
            if($this->balance >= $amount){

                $charge = $this->debitUserProfit($amount);

                if($charge){
                        $rec = $this->setWithdrawRecord($amount,$address,$method,'BTC');
                        if($rec){
                            $req['status'] = 100;
                            $req['msg'] = 'Withdrawal success, please check your receiving address for confirmation';
                        }else{
                            $req['status']=0;
                            $req['msg'] = $rec; 
                        }
                }else{
                    $req['status']=0;
                    $req['msg'] = $charge;
                }


            }else{
                $req['status']=0;
                $req['msg'] = 'Sorry! your balance is not enough to carry such withdrawal';

            }
        }else if($amount <  $this->min){
            $req['status']=0;
            $req['msg'] = 'Please  allowed minimum withdrawal is '.$this->sym.$this->fmt($this->min);

        }else if($amount > $this->max){
            $req['status']=0;
            $req['msg'] = 'Please  allowed maximum withdrawal is '.$this->sym.$this->fmt($this->max);

        }else{
            $req['status']=0;
            $req['msg'] = 'Please  check  your balance and limit before withdrawal ';

        }

        return $req;
}

private function handleCryptoWithdrawCapital($id, $amount, $address, $method = 'crypto')
    {

        $req = array();
        $req['status'] = 0;
        $req['msg'] = 'Sorry! Something went wrong, please try again after sometime ';



        $rec = $this->setWithdrawRecord($amount, $address, $method, 'BTC');
        if ($rec) {
            $req['status'] = 100;
            $req['msg'] = 'Withdrawal success, please check your receiving address for confirmation';
        } else {
            $req['status'] = 0;
            $req['msg'] = $rec;
        }






        return $req;
    }

private function handleCheckCapitalWithdraw($id,$address,$method='crypto'){

    $req = array();
    $req['status']=0;
    $req['msg'] = 'Sorry! Something went wrong, please try again after sometime ';
    $plan = $this->getInvestData($id,'plan_type');
    $pac = $this->planReturnFold($plan);
    $amount = $this->getPercentBal($pac,$this->getInvestData($id,'amount'));
        
        if($amount >= $this->min &&  $amount <= $this->max ){
            

                $charge = $this->closeIvestment($id);

                $canReturn = $this->planCanReturn($plan);

                if($canReturn){
                    if($charge){
                        if ($method === 'crypto') {
                            return $this->handleCryptoWithdrawCapital($id,$amount, $address);
                        } else {
                            $req['status'] = 0;
                            $req['msg'] = 'Sorry! The method you selected is not available for withdrawal at the moment. ';
                        }
                    }else{
                        $req['status']=0;
                        $req['msg'] = $charge;
                    }
                }else{
                            $req['status'] = 0;
                            $req['msg'] = 'Sorry! your investment plan does not seem to have capital return. ';
                }

                


            
        }else if($amount <  $this->min){
            $req['status']=0;
            $req['msg'] = 'Please  allowed minimum withdrawal is '.$this->sym.$this->fmt($this->min);

        }else if($amount > $this->max){
            $req['status']=0;
            $req['msg'] = 'Please  allowed maximum withdrawal is '.$this->sym.$this->fmt($this->max);

        }else{
            $req['status']=0;
            $req['msg'] = 'Please  check  your balance and limit before withdrawal ';

        }

        return $req;
}


public function handleProfitWithdraw($amount,$address,$method='crypto'){
        $req = array();
        $req['status']=0;
        $req['msg'] = 'Sorry! Something went wrong, please try again after sometime ';
            
            if($method==='crypto'){
                return $this->handleCryptoWithdraw($amount,$address);
            }else{
                $req['status']=0;
                $req['msg'] = 'Sorry! The method you selected is not available for withdrawal at the moment. ';
            }

            return $req;
}

public function handleCapitalWithdraw($id,$address,$method='crypto'){
        $req = array();
        $req['status'] = 0;
        $req['msg'] = 'Sorry! Something went wrong, please try again after sometime ';
        $checker = $this->checkInvestExist('invest_id',$id);

        if ($checker === 1) {
            $checkStatus = $this->getInvestData($id, 'status');

            if ($checkStatus === 'done') {

                return $this->handleCheckCapitalWithdraw($id, $address,$method);
            } else {
                $req['status'] = 0;
                $req['msg'] = 'Sorry, only completed  investment can be set for withdrawal';
            }
        }else{
            $req['status'] = 0;
            $req['msg'] = 'Invalid validation token, check your request and retry again';
        }

        return $req;
}


}

<?php 

class GlobalComponents{

    private object $model;
    private object $obj;
    public function __construct($models,$objs)
    {

        $this->model = $models;
        $this->obj = $objs;
        
    }


    // Private methods start

    private function gloPlanTimeName($endTime,$time,$hour,$day,$week,$month,$year){
        $res =null;
        if(!empty($endTime)){
            $res = $endTime;
        } else {
            $res = match ($time) {
                'hour' => $hour.'Hours',
                'day' => $day.'Days',
                'week' => $week.' Week(s)',
                'month' => $month.' Month(s)',
                'year' => $year.' Year(s)',
            };
        }

        return $res;

    }

    private function gloPlanAmount($unlimited,$start,$end,$syms){
                $sym = $syms??'$';
                
                if($unlimited==='yes'){
                    return $sym.$this->obj->fmt($start).' -  Unlimited';
                }else{
                    return $sym.$this->obj->fmt($start).' - '.$sym.$this->obj->fmt($end);
                }
    }

    private function globalGetPlans(){

        return $this->model->getRows($this->obj->tb_Plans,'yes','use_now');

        

    }

    private function globalGetPlanCate(){

        return $this->model->getRows($this->obj->tb_PlanCate,'yes','use_now');

        

    }

    private function globalGetMethods($table,$clause,$field,$limit=20){
        return $this->model->getRows($table,$clause,$field,$limit);

    }

    private function globalWithdrawMethodOptions(){

            $methods  = [];
            $newMethod = $methods['crypto']= array('name'=>'Crypto Payment','info'=>'to any btc wallet');
            $newMethod1 = $methods['bank']= array('name'=>'Bank Payment','info'=>'to any bank account');
            $newMethod2 = $methods['wallet']= array('name'=>'Wallet Payment','info'=>'to any bank account');
            $newMethod3 = $methods['paypal']= array('name'=>'Paypal Payment','info'=>'to any bank account');
            

            return $methods;
            
    }

    private function globalGetBankDetails(): void{

        $bankMethod  = $this->globalGetMethods($this->obj->tb_BoxBank,'on','status');
        
        echo '<optgroup label="Bank Transfer">';
        if (!empty($bankMethod) && is_array($bankMethod)) {

            foreach ($bankMethod as $key) {
                # code...
                echo ' <option value="bank_'.$key['bank_id'].'"> '.$key['display_name'].' </option>';
                
            }

            
        }
        echo ' </optgroup>';

        
    }

    private function  globalGetStaticWallets() : void {

        $method  = $this->globalGetMethods($this->obj->tb_BoxStaticWallet,'on','status');
        
        echo ' <optgroup label="Crypto Wallets">';

                    echo '<option value="coinpayment">Coin Payment</option>';
                    echo '<option value="staticwallets">Other Wallets</option>';
            
        

        

        echo '</optgroup> ';
    }

    private function  globalGetCryptoMethods() : void {

        $method  = $this->globalGetMethods($this->obj->tb_BoxCryptoMethod,'on','status');
        
        echo ' <optgroup label="Crypto Methods">';

                    
                    if (!empty($method) && is_array($method)) {

                        foreach ($method as $key) {
                            # code...
                            echo ' <option value="crypto_'.$key['type'].'"> '.$key['display_name'].' </option>';
                            
                        }
            
                        
                    }
            
        

        

        echo '</optgroup> ';
    }

    private function  globalGetCoinPayment() : void {

        $method  = $this->globalGetMethods($this->obj->tb_BoxBank,'on','status');
        
        echo ' <optgroup label="Crypto Wallets';
        if (!empty($method) && is_array($method)) {
                
                foreach ($method as $key) {
                    # code...
                    echo '<option value=""></option>';
                }

        }

        echo '</optgroup> ';
    }

    private function  globalGetPayPal() : void {

        $method  = $this->globalGetMethods($this->obj->tb_BoxBank,'on','status');
        
        echo ' <optgroup label="Crypto Wallets';
        if (!empty($method) && is_array($method)) {
                
                foreach ($method as $key) {
                    # code...
                    echo '<option value="paypalweb"> Paypal Web</option>';
                }

        }

        echo '</optgroup> ';
    }

    private function  globalGetPaypalCard() : void {

        $method  = $this->globalGetMethods($this->obj->tb_BoxBank,'on','status');
        
        echo ' <optgroup label="Crypto Wallets';
        if (!empty($method) && is_array($method)) {
                
                foreach ($method as $key) {
                    # code...
                    echo '<option value=""></option>';
                }

        }

        echo '</optgroup> ';
    }

    private function  globalGetPayPalWeb() : void {

        $method  = $this->globalGetMethods($this->obj->tb_BoxBank,'on','status');
        
    
        if (!empty($method) && is_array($method)) {
                
                foreach ($method as $key) {
                    # code...
                    echo '<option value=""></option>';
                }

        }

        
    }

    private function globalGetCoins() : void{
        $method  = $this->globalGetMethods($this->obj->tb_BoxCrypto,'on','status');
        
        echo ' <optgroup label="Crypto Coins">';
        echo '<option selected value=""> Select Coin Type </option>';
        if (!empty($method) && is_array($method)) {
                
                foreach ($method as $key) {
                    if(!empty($key['display_name'])){
                        $name = $key['display_name'];
                    }else{
                        $name = $key['coin_name'].' | Network ( '.$key['network'].' )';
                    }
                    # code...
                    echo '<option value="'.$key['type'].'"> '.$name.' </option>';
                }

        }

        echo '</optgroup> ';
        

    }

    private function globalGetPlanOptions($planName = 'Plans', $planCateName = 'Plan Category')
    {
        $plans = $this->globalGetPlans();
        $cates = $this->globalGetPlanCate();
        $resp = array();
        
        


        if (!empty($plans) && is_array($plans)) {
            
            $count = count($plans);
            foreach ($cates as  $cate) {
                # code...
                $checkCatePlans = $this->model->ifExist('yes', 'use_now',$this->obj->tb_Plans, $cate['cate_plan'], 'plan_category');
                if ($checkCatePlans === 1) {
                    array_push($resp,'<optgroup label="' . $cate['cate_name'] . '">');
                    //sort($plans);
                    foreach ($plans as $plan) {
                        

                        $timeName = $this->gloPlanTimeName($plan['end_time'], $plan['add_time'], $plan['end_hour'], $plan['end_day'], $plan['end_week'], $plan['end_month'], $plan['end_year']);
                        $currency = $this->model->site->currency;
                        $sym = $this->obj->xeSym($currency);
                        $amount = $this->gloPlanAmount($plan['unlimited'],$plan['plan_amount'],$plan['plan_amount2'],$sym);
                        
                        if ($plan['plan_category'] === $cate['cate_plan'] && $plan['use_now'] === 'yes') {
                            
                            array_push($resp,'<option value="' . $plan['main_id'] . '"> ' . $plan['plan_name'] . ' - (' . $timeName . ') - (' . $plan['plan_display'] . ') -  ('.$amount.')</option> ');
                        }
                    }
    
                    array_push($resp,'</optgroup>');
                }

            
            }
        } else {
        
            array_push($resp,'No data to display');
        }

        return $resp;

    }



    //private methods Ends


    //public methods starts


    public function globalPlanOptions($planName = 'Plans', $planCateName = 'Plan Category')
    {
        $plans = implode("",$this->globalGetPlanOptions());

        echo $plans;
    
    }

    public function globalPlanOptions2($planName = 'Plans', $planCateName = 'Plan Category')
    {
        return $this->globalGetPlanOptions();
    
    }

    public function globalMinDeposit(): void{

        $data =  $this->model->getData($this->obj->tb_InvestSettings,'min_deposit','use_now','yes');
        $min_dep = floatval($data);

        //return $this->model->getRows($this->obj->tb_PlanCate,'yes','use_now');
        echo  '<input type="hidden" name="min_deposit" id="min_deposit" value="'.$min_dep.'">';

        

    }

    public function globalPaymentMethods(){

        
        echo $this->globalGetCryptoMethods();
        echo $this->globalGetBankDetails();

    }


    public function globalAcceptedCoins() : void{

        echo $this->globalGetCoins();
    }

    public  function globalWithdrawMethods(){
        return $this->globalWithdrawMethodOptions();
    }

    


}



?>
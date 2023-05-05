<?php 

class InvestmentModel
{

    private $model;
    private $obj;
    private $table;
    private $user;


    public function __construct($models){
    $this->model = $models;
    $this->table = $models->tb_Invest;
    $this->user = $models->authUser;
    } 


    private function getInvestment($field,$id){
        $this->model->getData($this->table, $field, 'invest_id', 1,'username',$this->user);
    }
    private function getInvestSettings($field,$id){
        $this->model->getData($this->table, $field, 'invest_id', 1,'username',$this->user);
    }

    private function getInvestPlan($field,$id){
        $this->model->getData($this->table, $field, 'invest_id', 1,'username',$this->user);
    }

    private function getInvestPlanCate($field,$id){
        $this->model->getData($this->table, $field, 'invest_id', 1,'username',$this->user);
    }

    private function getAllInfo($id=null,$field=null,$limit=200){
        return $this->model->getRows($this->table,$this->user,'username',$limit,$id,$field);

    }




    public function getAllInvestMent($field=null){
        $data  = $this->getAllInfo();
        $amount =0;
        $count = 0;
        $return =0;
        
        foreach ($data as $key) {
            # code...
            if(!empty($field)){
                if($key[$field]){
                    $return += $key['amount']++;
                    $count++;
                    
                }

            }else{
                $return = $count++;
            
            }
            
        }

        return $return;
    }

    public function investTotalDeposit(){
        $data  = $this->getAllInfo();
        $amount =0;
        $count = 0;
        $return =0;
        
        foreach ($data as $key) {
            # code...
            if($key['amount']){
                $amount += $key['amount']++;
                $count++;
                
            }
            
        }

        return $amount;

    }
    public function investDepositCount(){
        
    }

    public function investActiveDeposit(){
        $data  = $this->getAllInfo('confirmed','status');
        $amount =0;
        $count = 0;
        $return =0;
        
        foreach ($data as $key) {
            # code...
            if($key['amount']){
                $amount += $key['amount']++;
                $count++;
                
            }
            
        }

        return $amount;
    }
    public function investActiveCount(){
        
    }

    public function investPendingDeposit(){
        $data  = $this->getAllInfo('pending','status');
        $amount =0;
        $count = 0;
        $return =0;
        
        foreach ($data as $key) {
            # code...
            if($key['amount']){
                $amount += $key['amount']++;
                $count++;
                
            }
            
        }

        return $amount;
    }

    public function investPendingCount(){
        
    }

    


    
}



?>
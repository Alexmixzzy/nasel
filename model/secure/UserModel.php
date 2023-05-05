<?php 
@require_once 'model/BaseUserModel.php';
@require_once 'UserDetailsModel.php';
@require_once 'InvestmentModel.php';

class UserModel extends BaseUserModel{
    
    protected $username = null;
    public object $auth;
    public object $investModel;
    public function __construct(){
        parent::__construct();
        $this->username  =  $this->authUser;
        $this->auth = new UserDetailsModel($this);
        $this->investModel = new InvestmentModel($this);

        $this->sendOut();
    }

    public function profileImage () : void{

        if(!empty($this->auth->authImage)){
            echo '../static/public/images/profile/'.$this->getUser('image');
        }else{
            echo '../static/public/images/profile/avater.png';
        }
        
    }

    public function invoicDetails($field,$ids=null) : void{
        $id = $this->checkSession('invoiceID');
        if(!empty($id) && !empty($field)){
            $data = $this->getData($this->tb_Invest,$field,'invest_id',$id);
            echo $data;
        }else{

        }
        

        

    }

    public function getInvoicDetails($field,$ids=null){
        $id = $this->checkSession('invoiceID');
        
        if(!empty($id) && !empty($field)){
            $data = $this->getData($this->tb_Invest,$field,'invest_id',$id);
            return $data;
        }else{

        }
        
        return;
        

    }

    public function getProfit($field){
        $data = $this->getData($this->tb_Profits,$field,'username',$this->authUser);
        return $data;
    }

    public function voidProfit($field):void{
        $data = $this->getData($this->tb_Profits,$field,'username',$this->authUser);
        echo $data;
    }


}



?>
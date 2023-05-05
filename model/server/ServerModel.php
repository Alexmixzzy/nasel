<?php 

class ServerModel {

    public $name = 'Nasel Invest' ;
    public $nameShort =null;
    public $domain;

    public $desc =null;
    public $title =null;
    public $currency ='USD';
    public $supportMail =null;
    public $contactMail =null;

    public $phone1 =null;
    public $phone2 =null;
    public $address =null;

    public $country =null;
    public $workStart =null;
    public $workClose =null;
    public $domainSL =null;
    public $sym;
    protected $model;
    private $tableCore ='core';
    private $tableHeaders ='headers';
    public function __construct($mod){
        $this->model = $mod;
        $this->setServerCore();
        $this->sym = $this->model->xeSym($this->currency);
        

        

    }


    private function getServerCore($field){
        return $this->model->getData($this->tableCore, $field, 'id', 1);
    }

    private function getServerHeader($field){
        return $this->model->getData($this->tableHeaders, $field, 'id', 1);
    }

    private function serverEmpty(){
       (int) $id = $this->getServerCore('id');
        if(empty($id) || $id < 1){
            return true;
        }else{
            return false;
        }
    }

    private function setServerCore(): void
    {

        if (!empty($this->getServerCore('domain'))) {
            $this->domain = $this->getServerCore('domain');
            $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
            $this->domainSL = $protocol . $this->getServerCore('domain');
        } else {
            $this->domain = $_SERVER['HTTP_HOST'];
            $this->domainSL =  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        }

        if (!$this->serverEmpty()) {
            $this->desc = $this->getServerCore('description');
            $this->currency = $this->getServerCore('currency');
            $this->name = $this->getServerCore('name');
            $this->address = $this->getServerCore('address');
            $this->country = $this->getServerCore('country');
            $this->phone1 = $this->getServerCore('phone_1');
            $this->phone2 = $this->getServerCore('phone_2');
            $this->supportMail = $this->getServerCore('support_mail');
            $this->contactMail = $this->getServerCore('contact_mail');
        }
    }

    private function setServerHeaders() : void {

        
    }

    public function  voidSite($field='domain') : void{
        $data = $this->getServerCore($field);
        echo $data;
    }

    public function  getSite($field='domain'){
        $data = $this->getServerCore($field);
        return $data;
    }

    public function getSym(){
        return $this->sym;
    }
    public function voidSym(): void{
        echo $this->sym;
    }

    
}


?>
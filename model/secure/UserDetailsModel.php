<?php

class UserDetailsModel {

    protected $db;

    public $authName =null;
    public $authHash =null;
    public $authImage =null;
    public $authPhoneCode =null;
    public $authPhone =null;
    public $authCountry =null;

    public $authBlocked =null;

    public $authActive =null;
    public $authRestricted =null;

    public $authCurrency =null;

    public $authIP =null;

    public $authAddress =null;
    public $authLastUrl =null;

    public $authVerified =false;

    public $authEmailVerified =null;

    public $authType =null;

    public $authRef =null;




    public function __construct($mod)
    {
        $this->db = $mod;

        $this->authName = $this->db->getUser('fullname');
        $this->authImage = $this->db->getUser('image');
        $this->authHash = $this->db->getUser('hash_code');
        $this->authPhoneCode = $this->db->getUser('phone_code');
        $this->authPhone = $this->db->getUser('phone');
        $this->authAddress = $this->db->getUser('address');
        $this->authIP = $this->db->getUser('user_ip');
        $this->authLastUrl = $this->db->getUser('last_url');
        $this->authRef = $this->db->getUser('ref');
        $this->authEmailVerified = $this->db->getUser('email_verified');
        $this->authVerified = $this->db->getUser('verified');
        $this->authBlocked = $this->db->getUser('is_blocked');
        $this->authActive = $this->db->getUser('is_active');
        $this->authRestricted = $this->db->getUser('restricted');
        $this->authCurrency = $this->db->getUser('currency');
        $this->authType = $this->db->getUser('type');
        
    }
}


?>
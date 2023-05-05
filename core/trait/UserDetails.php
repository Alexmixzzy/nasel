<?php

trait UserDetails {

    protected $db;

    public $authName =null;
    public $authHash =null;
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

    public $authType =null;

    public $authRef =null;
}


?>
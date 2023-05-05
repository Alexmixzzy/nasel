<?php 

@require_once 'core/trait/BasicFunctions.php';
class MiddleWare {

    use BasicFunctions;
    private   const CRFHASHTOKEN = '@#os4Mx@&$6cf@to84$&K0u1hTtdd9e3OyP';



    protected  function setCrf(){
    
        return $this->fetchCrfToken(self::CRFHASHTOKEN);
    }


    protected  function fetchCrfToken($password)
    {
        $sort1 = $this->sortPass($password, 12000, 12, 'hashit_718', 128);
        $sort2 = $this->sortPass($password, 12000, 18, 'hashit_718', 128);
        $passArr = array($sort1, $sort2);
        shuffle($passArr);
        $token = $passArr[0];

        return $token;
    }


    protected function validateCrf($token, $lent = 0)
    {
        $password = self::CRFHASHTOKEN;
        
        return $this->verify_Password($token,$password,$lent);
    }

    



}



?>
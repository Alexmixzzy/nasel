<?php

trait BasicFunctions
{

    protected const METHOD_GET = 'GET';
    protected const METHOD_POST = 'POST';
    public $adminPath = 'admin';
    public $userPath = 'users';
    public $publicPath = 'public';
    public $viewPath = '/view/';
    public $staticPath = '/static/';
    protected $basePats = '/php/nasel';
    protected $hashValue="sha512";
    
    public $success = 100;

    public $isDone = true;
    protected $failed = 0;

    protected static function template404($file = null,$f404=null)
    {
        // if(is_file($file)){
    
            echo 'Template you requested could not be found' . $file;
        
    
        

    }

    protected static function handler404($file = null)
    {

        echo 'Handler or method  not found' . $file;

    }

    public function yesMatch($data){
    
    }

    public function fmt($amount =0,$slice=2){
        return number_format($amount,$slice);
    }

    public function getUrl()
    {
        //SERVER_PROTOCOL = HTTP/1.1
        //file and pathname = SCRIPT_NAME
        //SCRIPT_NAME localhost
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
        $scheme = $_SERVER['REQUEST_SCHEME'];
        return $scheme . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    }

    public function fileExist($viewPath=null){
        
        if (file_exists($viewPath)) {
            return true;
        }else{
            return false;
        }
    }

    public function getCrfToken()
    {
        return $this->passwordHash(uniqid(bin2hex(random_bytes(88)), true));
    }

    public function genCrfToken($password)
    {
        $sort1 = $this->sortPass($password, 12000, 12, 'hashit_718', 128);
        $sort2 = $this->sortPass($password, 12000, 18, 'hashit_718', 128);
        $passArr = array($sort1, $sort2);
        shuffle($passArr);
        $newPass = $passArr[0];

        // This string is to be saved into DB, just like what Django generate.
        return $newPass;
    }

    

    public function sortPass($password, $iteration = 390000, $salt = 16, $algo = "pbkdf2_sha256", $lent = 0)
    {
        // this way is for you customize your hash both for django, as crfToken and for php  purpose or any hash purpose
        
        $algorithm = $algo;
        $iterations = $iteration;
        $newSalt = random_bytes($salt);
        $newSalt = base64_encode($newSalt);

        $hash = hash_pbkdf2("SHA256", $password, $newSalt, $iterations, $lent, true);
        $data = $algorithm . "$" . $iterations . "$" . $newSalt . "$" . base64_encode($hash);

        // This string is to be saved into DB, just like what Django generate.
        return $data;
    }
    public function make_password($password)
    {

        $sort1 = $this->sortPass($password);
        $sort2 = $this->sortPass($password, 390000, 6);
        $passArr = array($sort1, $sort2);
        shuffle($passArr);
        $newPass = $passArr[0];

        
        return $newPass;
    }

    public function verify_Password($dbString, $password, $lent = 0,$exp="$",$hValue="SHA256")
    {
        $pieces = explode($exp, $dbString);

        $iterations = $pieces[1];
        $salt = $pieces[2];
        $old_hash = $pieces[3];

        $hash = hash_pbkdf2($hValue, $password, $salt, $iterations, $lent, true);
        // $hash = hash_pbkdf2("SHA256", $password, $salt, $iterations, 0, true);
        $hash = base64_encode($hash);

        if ($hash == $old_hash) {
            
            return true;
        } else {
            
            return false;
        }
    }
    public function passwordHash($password)
    {
        $value = hash($this->hashValue, $password, false);
        return $value;
    }

    public function hashUser($data){
        return  password_hash($data, PASSWORD_DEFAULT);
    }

    public function hashVerify($data,$hash){

        return  password_verify($data, $hash);
    }

    public function passwordVerify($hash, $password)
    {
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }

    }

    public function dateTime()
    {
        return date("Y-m-d h:i:s"); //2017-08-02 00:00:00
    }

    public function jsutTime()
    {
        return date("h:i:s"); //2017-08-02 00:00:00
    }

    ////get date
    public function justDate()
    {
        return date("Y-m-d"); //2017-08-02 00:00:00
    }

    public function is_email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    public function statusName($status){
        try {
        $match = match(strtolower($status)){
            
            'done'=>'Completed',
            'pending'=>'Pending',
            'confirmed'=>'Confirmed',
            'canceled'=>'Canceled',
            'closed'=>'Closed',
            'default'=>'Unknown',
        };

        return $match;
    } catch (\UnhandledMatchError $e) {
        return 'Unknown';
    }
    }

    public function statusNameINV($status){
        try {
        $match = match(strtolower($status)){
            'done'=>'Completed',
            'pending'=>'Pending',
            'confirmed'=>'Active',
            'canceled'=>'Canceled',
            'closed'=>'Closed',
            'default'=>'Info',
        };
        return $match;
    } catch (\UnhandledMatchError $e) {
        return 'Unkwnown';
    }

        
    }
    public function statusBadge($status){
        try {
        $match = match(strtolower($status)){
            'done'=>'success',
            'pending'=>'warning',
            'confirmed'=>'success',
            'canceled'=>'danger',
            'closed'=>'danger',
            'default'=>'danger',
        };

        return $match;
    } catch (\UnhandledMatchError $e) {
        return 'danger';
    }
    }

    public function percentName($percent){
        $match = match(true){
            $percent >= 100=>'Completed (Success)',
            $percent >= 99=>'Completed (please wait)',
            $percent >= 70=>'In Progress',
            $percent >= 50=>'In progress',
            $percent >= 0=>'In Progress',
            'default'=>'In Progress',
        };

        return $match;
    }

    public function percentBadge($percent=true){
        $match = match(true){
            $percent >= 99 =>'success',
            $percent >= 70 =>'info',
            $percent >= 50 =>'warning',
            $percent >= 0 =>'danger',
            'default'=>'danger',
        };

        return $match;
    }

    public function getPercent($c,$a,$decimal=2){

        return round($c / $a * 100,$decimal);

    }

    public function getPercentBal($pac,$amount){
        $data = $pac / 100 * $amount;
        return $data;
    }

    public function error($string = 'Action failed to execute, retry', $header = "Error! ")
    {
        $data = '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban icon-new_releases"></i> ' . $header . ' </h4>
        <p>  ' . $string . '</p>
        </div>';

        return $data;
    }

    public function success($string = 'Action executed successfully', $header = 'Success! ')
    {
        $data = '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check"></i> ' . $header . ' </h4>
        <p> ' . $string . '</p>
        
        </div>';
        return $data;
    }

    public function warning($string = 'Something Went Wrong', $header = 'Warning! ')
    {
        $data = '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-check icon-warning"></i> ' . $header . ' </h4>
        <p> ' . $string . '</p>
        
        </div>';
        return $data;
    }

    public function cleanTextField( $string ) {


        $string = str_replace( '/', '', $string ); 
        $string = str_replace( '<', '', $string );
        $string = str_replace( '>', '', $string );
        $string = str_replace( ')', '', $string );
        $string = str_replace( '(', '', $string );
        $string = str_replace( "'", '', $string );
        $string = str_replace( "''", '', $string );
        $string = str_replace( '""', '', $string );
        $string = str_replace( "'", '', $string );
        $string = str_replace( '\\', '', $string );
        //$string = str_replace( ',', '', $string );
        //$string = str_replace( ' ', '', $string );
        $string = str_replace( '~', '', $string );
        $string = str_replace( '!', '', $string );
        $string = str_replace( '+', '', $string );
        $string = str_replace( '=', '', $string );
        $string = str_replace( '||', '', $string );
        $string = str_replace( '[]', '', $string );
        $string = str_replace( '[', '', $string );
        $string = str_replace( ']', '', $string );
        $string = str_replace( '}', '', $string );
        $string = str_replace( '{', '', $string );
        $string = str_replace( '#', '', $string );
        $string = str_replace( '%', '', $string );
        $string = str_replace( '^', '', $string );
        $string = str_replace( '?', '', $string );
        $string = str_replace( '  ', ' ', $string );
        $string = str_replace( '   ', ' ', $string );
        $string = str_replace( '    ', ' ', $string );
        $string = str_replace( '     ', ' ', $string );
        $string = str_replace( '      ', ' ', $string );
        $string = str_replace( '       ', ' ', $string );
        $string = str_replace( '        ', ' ', $string );
        $string = str_replace( '         ', ' ', $string );
        $string = str_replace( '          ', ' ', $string );
        $string = str_replace( '           ', ' ', $string );
        
    
        return $string;
    
    
    }

    public function cleanPhone( $string ) {
        $string = str_replace( ' ', '', $string );
        $string = preg_replace( '/[^0-9\-]/', '', $string );
        return $string;
    }

    public function cleanAmount( $string ) {
        
        $string = preg_replace("/[^0-9\.]/", "", $string);
        
        return $string;
    }

    public function cleanTID( $string ) {
        $string = str_replace( ' ', '', $string );
        $string = preg_replace( '/[^A-Z0-9\-]/', '', $string );
        return $string;
    }

    public function cleanUserName( $string ) {
        $string = str_replace( ' ', '', $string );
        $string = preg_replace( '/[^A-Za-z0-9]/', '', $string );
        return $string;
    }

    public function cleanName( $string ) {

        $string = preg_replace( '/[^A-Za-z0-9\-]/', ' ', $string );
        $string = preg_replace( '/\d+/u', '', $string );
        return $string;
    }

    public function cleanEmail( $string ) {
        
        $string = str_replace( ' ', '', $string );
        $string = preg_replace( '/[^A-Za-z0-9\_]/', '', $string );
        
        
        return $string;
    }



    public function validateName($string)
    {

        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
        $string = preg_replace('/\d+/u', '', $string);
        $arr = explode(' ', trim($string));
        
        if (count($arr) >= 2) {
            if ((strlen($arr[0]) >= 2) && (strlen($arr[1]) >=2)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function validateNamex($string)
    {

        $string = preg_replace('/[^A-Za-z0-9\-]/', ' ', $string);
        $string = preg_replace('/\d+/u', '', $string);
        $arr = explode(' ', trim($string));
        
        // if (count($arr) >= 1) {
        //     if ((strlen($arr[0]) >= 2) && (strlen($arr[1]) <= 0)) {
        //         return TRUE;
        //     } else {
        //         return FALSE;
        //     }
        // } else {
        //     return FALSE;
        // }

        var_dump(count($arr));
    }

    function arrayDiff($a, $b)
    {
        if ($a === $b) {
            return 0;
        }
        return ($a > $b) ? 1 : -1;
    }





}

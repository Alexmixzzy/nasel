<?php 
@require_once 'model/BaseModel.php';
@require_once 'controller/interface/UserModelInterFace.php';

class BaseUserModel extends Model implements UserModelInterFace
{

    public $table;
    public $authUser=null;
    public $authEmail=null;

    public $isLoggedIn = false;


    public function __construct(){
        parent::__construct();
        $this->table = $this->tb_Users;
       // $this->pdo = $this->PDB();
        $this->setUser();

        



    }

    public function getUser($field,$tb=null){
        $table = $tb ?? $this->table;
        return $this->getData($table,$field,'username',$this->authUser);

    }

    public function voidUser($field,$tb=null){
        $table = $tb ?? $this->table;
        echo $this->getUser($field,$table);

    }

    private function  setUser(){

        if(!empty($_SESSION[$this->sessionUser])){
            $this->authUser = $_SESSION[$this->sessionUser];
        }

        if(!empty($_SESSION[$this->sessionEmail])){
            $this->authEmail = $_SESSION[$this->sessionEmail];
        }
    }

    public function isLogedIN()
    {
        if (isset($_SESSION[$this->sessionUser]) && !empty($_SESSION[$this->sessionUser]) && !empty($_SESSION[$this->sessionEmail])) {
            if (($this->ifExist($_SESSION[$this->sessionUser], 'username', $this->table) === 1) &&
                ($this->ifExist($_SESSION[$this->sessionEmail], 'email', $this->table) === 1)) {
                return true;
            } else {
                return false;
            }
        } else {
            
            return false;
        }
    }

    public function sendOut()
    {

        if ($this->isLogedIN()) {

        } else {
            
        $this->logOut();
        }
    }

    public function sendIN()
    {

        if ($this->isLogedIN()) {
            header("location:" . $this->dashBoard);
        } else {

        }
    }

    public function logOut()
    {

        //header( "location:" . $this->logoutPage );

        if(session_status() ===PHP_SESSION_DISABLED  || session_status() ===PHP_SESSION_NONE) @session_start();
    

        if (!empty($_SESSION[$this->sessionUser])) {
            unset($_SESSION[$this->sessionUser]);
        }
        if (!empty($_SESSION[$this->sessionEmail])) {
            unset($_SESSION[$this->sessionEmail]);
        }

        session_destroy();

        header("location:" . $this->loginPage);

    }

	public function get($field,$clause=null) {
        return $this->getData($this->table,$field,'username',$this->authUser);
	}
}




?>
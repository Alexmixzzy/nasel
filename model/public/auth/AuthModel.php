<?php
@require_once 'model/BaseModel.php';

class AuthModel extends Model   implements UserModelInterFace
{


    public $table = 'users';
    public function login($username, $pass)
    {

        $sql = "SELECT * FROM $this->table WHERE username = :username  LIMIT 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $username);
       //$stmt->bindValue(':password', $pass);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['is_blocked'] === 1) {

                return 'Your Account is blocked  at the moment, please contact main admin';
            } else {
                 //Blocked account error massage
                
                if ($row['username'] === $username) {
                    $myPass = $this->verify_Password($row['password'], $pass);

                    if ($myPass) {

                        if ($row['is_active'] === 1) {

                            return $this->success;
                        } else {

                            return 'Account is not yet activated for use';
                        } 
                        //activate email
                    } else {
                        return 'Invalid Credential, Retry- '.(int)$myPass;
                    }
                } else {
                    return 'Invalid Credential, Retry!';
                }
            }
             //Blocked account error massage

        } else {
            return 'Credential error, Retry!';
        }

    } 

    public function get($field,$clause){
    
        $this->getData($this->table,$field,'username',$clause);
    }

    

}

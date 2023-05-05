<?php
require_once 'core/Connect.php';
@require_once 'core/trait/BasicFunctions.php';
@require_once 'core/trait/Tables.php';
@require_once 'model/server/ServerModel.php';
@require_once 'core/trait/ModelStatic.php';
@require_once 'core/trait/Currency.php';
ob_start();
session_start();

class Model
{
    use Connection;
    use BasicFunctions;
    use Tables;
    use Currencies;
    use ModelStaticTrait;
    protected $table;

    protected $pdo;

    public object $site;

    public function __construct()
    {
        $this->pdo = $this->PDB();
        $this->site = new ServerModel($this);

    }

    private static function generateQuestionMark($arr)
    {
        $count = count($arr);
        $x = 0;
        $s = "";
        foreach ($arr as $value) {
            if ($x === ($count - 1)) {
                $s = $s . "?";
            } else {
                $s = $s . "?,";
            }
            $x++;
        }
        return $s;
    }

    private static function generateUpdateQuery($table, $arr, $condition, $clause, $condition2 = null, $clause2 = null, $condition3 = null, $clause3 = null)
    {
        $count = count($arr);
        $x = 0;
        $s = "UPDATE {$table} SET ";
        foreach ($arr as $value) {
            if ($x === ($count - 1)) {
                $s = $s . "{$value} = ?";
            } else {
                $s = $s . "{$value} = ?,";
            }
            $x++;
        }
        if (!empty($condition2) && !empty($clause2)) {
            return $s . " WHERE {$condition} = '$clause' and {$condition2} = '$clause2' ";
        } else if (!empty($condition3) && !empty($clause3)) {
            return $s . " WHERE {$condition} = '$clause' and {$condition2} = '$clause2' and {$condition3} = '$clause3' ";
        } else {
            return $s . " WHERE {$condition} = '$clause'";
        }
    }

    private function returnStatmentSQL($field,array $clause, $field2 =null, array $clause2 = []){

        $sql ='';
        if(!empty($field)  &&!empty($field2) &&  is_array($clause) && is_array($clause2)){
            if(count($clause)>1 && count($clause2)>1){
                $sql =  " AND (`$field` = '" . $clause[0] . "' || `$field` = '" . $clause[1] . "') AND (`$field2` = '" . $clause2[0] . "' || `$field2` = '" . $clause2[1] . "') ";
            }else if(count($clause)===1 && count($clause2)===1){
                $sql =  " AND `$field` = '" . $clause[0] . "' AND `$field2` = '" . $clause2[0] . "' ";

            }else if(count($clause)>1 && count($clause2)===1){
                $sql =  " AND (`$field` = '" . $clause[0] . "' || `$field` = '" . $clause[1] . "') AND `$field2` = '" . $clause2[0] . "' ";
            }else if(count($clause)===1 && count($clause2)>1){
                $sql =  " AND `$field` = '" . $clause[0] . "' AND (`$field2` = '" . $clause2[0] . "' || `$field2` = '" . $clause2[1] . "') ";
            }
        

        }else if(!empty($field) && empty($field2)  &&  is_array($clause)){
            if(count($clause)>1){
                $sql =  " AND (`$field` = '" . $clause[0] . "' || `$field` = '" . $clause[1] . "')  ";
            }else if(count($clause)===1){
                $sql =  " AND `$field` = '" . $clause[0] . "' ";
            }
        
        }
    

        return $sql;

    }

    private function returnStatmentIfExist($table,$field,array $clause, $field2 =null, array $clause2 =[]){

        $sql ='';

    if(is_array($clause) && is_array($clause2)){

        if(!empty($field)  &&!empty($field2) &&  is_array($clause) && is_array($clause2)){
            if(count($clause)>1 && count($clause2)>1){
                $sql =  "' AND (`$field` = '" . $clause[0] . "' || `$field` = '" . $clause[1] . "') AND (`$field2` = '" . $clause2[0] . "' || `$field2` = '" . $clause2[1] . "') ";
            }else if(count($clause)===1 && count($clause2)===1){
                $sql =  "' AND `$field` = '" . $clause[0] . "' AND `$field2` = '" . $clause2[0] . "' ";

            }else if(count($clause)>1 && count($clause2)===1){
                $sql =  "' AND (`$field` = '" . $clause[0] . "' || `$field` = '" . $clause[1] . "') AND `$field2` = '" . $clause2[0] . "' ";
            }else if(count($clause)===1 && count($clause2)>1){
                $sql =  "' AND `$field` = '" . $clause[0] . "' AND (`$field2` = '" . $clause2[0] . "' || `$field2` = '" . $clause2[1] . "') ";
            }
        

        }else if(!empty($field) && empty($field2)  &&  is_array($clause)){
            if(count($clause)>1){
                $sql =  "' AND (`$field` = '" . $clause[0] . "' || `$field` = '" . $clause[1] . "')  ";
            }else if(count($clause)===1 && count($clause2)>1){
                $sql =  "' AND `$field` = '" . $clause[0] . "' ";
            }
        
        }
    }

        return $sql;

    }

    public function postDatax($table, $fields = array(), $values = array())
    {
        if (is_array($fields) && is_array($values)) {
            if (count($fields) && count($values)) {

                $db = $this->pdo;
                $queryFields = implode(",", $fields);
                $s = self::generateQuestionMark($fields);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                $db = $this->pdo;
                $sql = "INSERT INTO " . $table . " (" . $queryFields . ") VALUES (" . $s . ");";
                if ($stmt = $db->prepare($sql)) {
                    $x = 1;
                    foreach ($values as $val) {
                        $stmt->bindValue($x, $val);
                        $x++;
                    }
                    if ($stmt->execute()) {
                        return 100;
                    } else {
                        return "Query could not be executed. Error!";
                    }
                }
            } else {
                return 'invalid parameters or empty data';
            }
        } else {
            return 'Invalid parameter. Parameter must be array!';
        }

    }

    public function postData($table, $fields = array(), $values = array())
    {
        if (is_array($fields) && is_array($values)) {
            if (count($fields) && count($values)) {

                $db = $this->pdo;
                $queryFields = implode(",", $fields);
                $s = self::generateQuestionMark($fields);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                $sql = "INSERT INTO " . $table . " (" . $queryFields . ") VALUES (" . $s . ");";
                if ($stmt = $db->prepare($sql)) {
                    $x = 1;
                    foreach ($values as $val) {
                        $stmt->bindValue($x, $val);
                        $x++;
                    }
                    if ($stmt->execute()) {
                        return $this->success;
                    } else {
                        return "Query could not be executed. Error!";
                    }
                }
            } else {
                return 'invalid parameters or empty data';
            }
        } else {
            return 'Invalid parameter. Parameter must be array!';
        }
        return $this;

    }

    public function updateData($table, $fields = array(), $values = array(), $condition, $clause, $condition2 = null, $clause2 = null, $condition3 = null, $clause3 = null)
    {
        if (is_array($fields) && is_array($values)) {
            if (count($fields) && count($values)) {

                $db = $this->pdo;
                $queryFields = implode(",", $fields);
                if (!empty($condition2) && !empty($clause2)) {
                    $query = self::generateUpdateQuery($table, $fields, $condition, $clause, $condition2, $clause2);
                } else if (!empty($condition3) && !empty($clause3)) {
                    $query = self::generateUpdateQuery($table, $fields, $condition, $clause, $condition2, $clause2, $condition3, $clause3);
                } else {
                    $query = self::generateUpdateQuery($table, $fields, $condition, $clause, $condition2, $clause2);
                }
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                if ($stmt = $db->prepare($query)) {
                    $x = 1;
                    foreach ($values as $val) {
                        $stmt->bindValue($x, $val);
                        $x++;
                    }
                    if ($stmt->execute()) {

                        return $this->success;
                    } else {

                        return 'Data could not be updated, retry';
                    }
                } else {

                    return 'Query could not be executed. Error!';
                }
            } else {

                return 'invalid parameters.Empty arrays';
            }
        } else {

            return 'Invalid parameter. Parameter must be array!';
        }
        //return $this;
    }

    public function ifExist($data, $fieldname, $tablename, $data2 = null, $fieldname2 = null, $data3 = null, $fieldname3 = null)
    {
        if (!empty($data) && !empty($fieldname) && !empty($tablename)) {

            try {
                if (empty($fieldname3) && !empty($fieldname2)) {
                    $sql = "select $fieldname, $fieldname2 from $tablename where $fieldname = :data and $fieldname2 = :data2";
                } elseif (!empty($fieldname2) && !empty($fieldname3)) {
                    $sql = "SELECT $fieldname, $fieldname2, $fieldname3 from $tablename WHERE $fieldname = :data AND $fieldname2 = :data2 AND $fieldname3 = :data3";
                } else {
                    $sql = "select $fieldname from $tablename where $fieldname = :data";
                }

                $stmt = $this->pdo->prepare($sql);

                if (empty($fieldname3) && !empty($fieldname2)) {

                    $stmt->bindValue(':data', $data);
                    $stmt->bindValue(':data2', $data2);
                } elseif (!empty($fieldname2) && !empty($fieldname3)) {

                    $stmt->bindValue(':data', $data);
                    $stmt->bindValue(':data2', $data2);
                    $stmt->bindValue(':data3', $data3);
                } else {

                    $stmt->bindValue(':data', $data);
                }

                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    return 1;
                } else {
                    return 0;
                }

            } catch (Exception $e) {

                return 0;

            }

        } else {
            return 0;
        }
    }

    public function fetchField($tb)
    {

        $sql = "SHOW COLUMNS FROM $tb";
        $stmt = $this->pdo->prepare($sql);

        $response = array();
        if ($stmt->execute()) {

            if (!empty($stmt)) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    array_push($response, $row['Field']);
                    //array_push( $response, $row['Type']);

                }
            } else {
                $res = array(" Data returns empty");
                array_push($response, $res);

            }
            return $response;

        }

        //return $this;
    }

    public function fetchFieldOn($tb, $fields = array())
    {
        $response = array();

        if (is_array($fields)) {
            return array_intersect($this->fetchField($tb), $fields);
        } else {
            $res = array(" Invalid Passed data");
            array_push($response, $res);
        }
    }

    public function fetchFieldEx($tb, $fields = array())
    {
        $response = array();

        if (is_array($fields)) {
            return array_diff($this->fetchField($tb), $fields);
        } else {
            $res = array(" Invalid Passed data");
            array_push($response, $res);
        }
    }

    public function fetchColumns($table, $rows = 'Field')
    {

        $sql = "SHOW COLUMNS FROM $table";

        $stmt = $this->pdo->prepare($sql);

        $response = array();
        if ($stmt->execute()) {

            if (!empty($stmt)) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    if (!empty($rows)) {
                        array_push($response, $row[$rows]);

                    } else {
                        array_push($response, $row);
                    }

                }
            } else {
                $res = array();
                $res['status'] = 0;
                array_push($response, $res);

            }
            return $response;

        }

    }

    public function genValidatePin($tb, $fi, $no = null)
    {

        $newAcct = $no . rand(000000, 999999);

        //$RRa = uniqid( '', true );
        // $RRa1 = uniqid( '', true );
        //$code1 = 'TFR_' . substr( $RRa1, -4 ) . substr( $RRa, -8 );

        $code1 = $newAcct;

        $check1 = $this->ifExist($code1, $fi, $tb);

        if ($check1 === 1) {

            return $this->genValidatePin($tb, $fi, $no);
        } else {
            return $code1;
        }

    }

    public function genValidateDepKey($tb, $fi, $no = null)
    {

        $newAcct = $no. rand(000000000000, 9999999999999);

        //$RRa = uniqid( '', true );
        // $RRa1 = uniqid( '', true );
        //$code1 = 'TFR_' . substr( $RRa1, -4 ) . substr( $RRa, -8 );

        $code1 = $newAcct;

        $check1 = $this->ifExist($code1, $fi, $tb);

        if ($check1 === 1) {

            return $this->genValidateDepKey($tb, $fi, $no);
        } else {
            return $code1;
        }

    }

    public function generateFormType($col, $field)
    {
        $form = '';
        $arr = array('id', 'product_id', 'image', 'item_image');
        if (!empty($col)) {
            if (!in_array($field, $arr)) {
                $int = filter_var($col, FILTER_SANITIZE_NUMBER_INT);
                $string = preg_replace('/[0-9]+/', '', $col);
                $string = str_replace('(', '', $string);
                strtolower($string = str_replace(')', '', $string));

                if ($string === "varchar") {
                    if ($field === 'email') {
                        $form = '<div class="styled-input">
            <input max="' . $int . '" type="email" name="' . $field . '" id="' . $field . '" data-tag="' . $field . '">
            <label>' . ucfirst(str_replace('_', ' ', $field)) . '</label>
            <span></span>
        </div>';
                    } else {
                        $form = '<div class="styled-input">
                <input max="' . $int . '" type="text" name="' . $field . '" id="' . $field . '" data-tag="' . $field . '">
                <label>' . ucfirst(str_replace('_', ' ', $field)) . '</label>
                <span></span>
            </div>';
                    }
                }

                if ($string === "int" || $string === "float") {

                    $form = '<div class="styled-input">
            <input max="' . $int . '" type="number" name="' . $field . '" id="' . $field . '" data-tag="' . $field . '" step="any">
            <label>' . ucfirst(str_replace('_', ' ', $field)) . '</label>
            <span></span>
        </div>';

                }
            }

        }

        return $form;
    }

    public function getData($table, $dataField, $fieldName, $clause,$fieldName2=null, $clause2=null,$fieldName3=null, $clause3=null)
    {

        if (!empty($clause) && !empty($dataField) && !empty($fieldName) && !empty($table)) {
            $checker = 0;
            if(!empty($fieldName2) && !empty($fieldName3)){
                $checker = $this->ifExist($clause, $fieldName, $table, $clause2,$fieldName2, $clause3, $fieldName3);
                $sql = "SELECT $dataField FROM $table WHERE  $fieldName = '" . $clause . "' and $fieldName2 = '" . $clause2 . "' and $fieldName3 = '" . $clause3 . "' LIMIT 1 ";
            }elseif(empty($fieldName3) && !empty($fieldName2)){
                    $checker = $this->ifExist($clause, $fieldName, $table, $clause2,$fieldName2);
                    $sql = "SELECT $dataField FROM $table WHERE  $fieldName = '" . $clause . "' and $fieldName2 = '" . $clause2 . "' LIMIT 1 ";
            }else{
                    $checker = $this->ifExist($clause, $fieldName, $table);
                    $sql = "SELECT $dataField FROM $table WHERE  $fieldName = '" . $clause . "' LIMIT 1 ";
            }
            
            if ($checker === 1) {

                try {

                    $stmt = $this->pdo->prepare($sql);
                    if ($stmt->execute()) {
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $data = $row[$dataField];
                        if (!empty($data)) {
                            return $data;
                        } else {
                            return null;
                        }
                    } else {
                        //$this->_errMsg = 0;
                        return null;
                    }
                } catch (Exception $e) {

                   // return null;
                }

            } else {
                return null;
            }

        } else {
            return null;
        }
    }

    public function getRows($table, $clause, $field, $limit = 20, $clause2 = null, $field2 = null, $clause3 = null, $field3 = null)
    {
        $response = array();
        $checker = 0;
        if (!empty($field2) && !empty($field3)) {
            $checker = $this->ifExist($clause, $field, $table, $clause2, $field2, $clause3, $field3);
        } else if (empty($field3) && !empty($field2)) {
            $checker = $this->ifExist($clause, $field, $table, $clause2, $field2);
        } else {
            $checker = $this->ifExist($clause, $field, $table);
        }

        if ($checker === 1) {
            if (!empty($field2) && !empty($field3)) {
                $sql = "SELECT * FROM $table WHERE `$field` = '" . $clause . "' AND `$field2` = '" . $clause2 . "' AND `$field3` = '" . $clause3 . "' ORDER BY id DESC Limit $limit ";
            } elseif (empty($field3) && !empty($field2)) {
                $sql = "SELECT * FROM $table WHERE `$field` = '" . $clause . "' and `$field2` = '" . $clause2 . "'  ORDER BY id DESC Limit $limit ";
            } else {
                $sql = "SELECT * FROM $table WHERE `$field` = '" . $clause . "'  ORDER BY id DESC Limit $limit ";
            }

            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute()) {

                $i = 1;
                if (!empty($stmt) || $stmt > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        array_push($response, $row);

                        // $i++;
                    }

                } else {

                    $res = array(" Data returns empty");
                    array_push($response, $res);
                }

                return $response;
            }else{
                return null;
            }

        } else {

            return null;
        }

        //return $this;
    }

    public function getRowsOR($table, $clause, $field, $limit = 20, array $clause2 = [], $field2 = null, array  $clause3 = [], $field3 = null)
    {
        $response = array();
        $checker = 0;
        $checker2 =0;
        $checker3 =0;
        $checker4 =0;


        
        if (!empty($field2) && !empty($field3) && is_array($clause2) && is_array($clause3)) {
            if(count($clause2)>1 && count($clause3)>1){
                $checker = $this->ifExist($clause, $field, $table, $clause2[0], $field2, $clause3[0], $field3);
                $checker2 = $this->ifExist($clause, $field, $table, $clause2[1], $field2, $clause3[0], $field3);
                $checker3 = $this->ifExist($clause, $field, $table, $clause2[0], $field2, $clause3[1], $field3);
                $checker4 = $this->ifExist($clause, $field, $table, $clause2[1], $field2, $clause3[1], $field3);
            }else  if(count($clause2)===1 && count($clause3)===1){
                $checker = $this->ifExist($clause, $field, $table, $clause2[0], $field2, $clause3[0], $field3);
            }else if(count($clause2)===1 && count($clause3)>1){
                $checker = $this->ifExist($clause, $field, $table, $clause2[0], $field2, $clause3[0], $field3);
                $checker2 = $this->ifExist($clause, $field, $table, $clause2[0], $field2, $clause3[1], $field3);
            }else if(count($clause2)>1 && count($clause3)===1){
                $checker = $this->ifExist($clause, $field, $table, $clause2[0], $field2, $clause3[0], $field3);
                $checker2 = $this->ifExist($clause, $field, $table, $clause2[1], $field2, $clause3[0], $field3);
            }
            
        } else if (empty($field3) && !empty($field2) && is_array($clause2) && is_array($clause3)) {
            if(count($clause2)===1){
                $checker = $this->ifExist($clause, $field, $table, $clause2[0], $field2);
            }else if(count($clause2)>1){
                $checker = $this->ifExist($clause, $field, $table, $clause2[0]);
                $checker2 = $this->ifExist($clause, $field, $table, $clause2[1]);
            }
        } else {
            $checker = $this->ifExist($clause, $field, $table);
        }

        if ($checker === 1 ||  $checker2 ===  1 ||  $checker3 ===  1 ||  $checker4 ===  1) {
            $sqlGet = $this->returnStatmentSQL($field2,$clause2,$field3,$clause3);
            $sql = "SELECT * FROM $table WHERE `$field` = '" . $clause . "' $sqlGet  ORDER BY id DESC Limit $limit ";
        

            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute()) {

                $i = 1;
                if (!empty($stmt) || $stmt > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        array_push($response, $row);

                        // $i++;
                    }

                } else {

                    $res = array(" Data returns empty");
                    array_push($response, $res);
                }

                return $response;
            }else{
                return null;
            }

        } else {

            return null;
        }

        //return $this;
    }

    public function formsx()
    {

        $sql = "SHOW COLUMNS FROM $this->table";

        //$db = $this->pdo;
        $stmt = $this->pdo->prepare($sql);
        //$stmt->execute();
        $response = array();
        $form = '';
        if ($stmt->execute()) {

            if (!empty($stmt)) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    //array_push( $response, $row[ 'Field' ] );
                    //array_push( $response, $row['Type']);
                    //array_diff( $row, $fields );
                    //echo $row['Field']. '<br>';
                    $fieldName = $row['Field'];
                    $fieldType = $row['Type'];
                    $fieldNull = $row['Null'];
                    $fieldKey = $row['Key'];
                    $fieldDefault = $row['Default'];
                    $fieldExtra = $row['Extra'];

                    echo $fieldType . '<br>';

                    foreach ($row as $key => $val) {
                        echo $key . ':' . $val . '<br>';
                        //echo $row['Field']. '<br>';

                        if ($key === "Type") {
                            //echo $val. '<br>';
                            $string = preg_replace('/[0-9]+/', '', $val);
                            $string = str_replace('(', '', $string);
                            $string = str_replace(')', '', $string);
                            if ($string === "varchar") {
                                $x = '<div class="styled-input">
                      <input type="text" name="Subject" required="">
                      <label>Subject</label>
                      <span></span>
                  </div>';

                            }

                        }
                    }

                }
            } else {

            }
            //return $response;

        }

        return $this;
    }

    public function checkFkey()
    {

        //$sql = "SHOW COLUMNS FROM $this->table";
        $sql = "SELECT * FROM information_schema.TABLE_CONSTRAINTS T";

        //$db = $this->pdo;
        $stmt = $this->pdo->prepare($sql);
        //$stmt->execute();
        $response = array();
        $form = '';
        if ($stmt->execute()) {

            if (!empty($stmt)) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                    //array_push( $response, $row[ 'Field' ] );
                    //array_push( $response, $row['Type']);
                    //array_diff( $row, $fields );
                    //echo $row['Field']. '<br>';
                    //echo $row;
                    //array_push( $response, $row);

                    $xf = $row;
                    foreach ($xf as $key => $val) {
                        echo $key . ':' . $val . '<br>';
                        // foreach($val as $key=>$val){
                        //     return $key;
                        // }

                    }

                }
            } else {

            }
            return $response;

        }

        //return $this;
    }

    protected function checkSession($s=null){
        if(!empty($s)){
            if(!empty($_SESSION[$s])){
                return $_SESSION[$s];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

}

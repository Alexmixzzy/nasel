<?php
declare (strict_types = 1);

trait Connection
{
    private $daHost = 'localhost';
    public $isConnected = false;
    private $daPass = '';

    public $pdos;
    private $daUser = 'root';
    private $daDatabase = 'nasel_db';
    private $noCon = 'STEerror 738933737 ';

    public function __construct(){
        //$this->pdo = $pdo;
        $this->pdos = $this->PDB();
        
    }

    public function PDB()
    {
        try {
            $DBH = new PDO("mysql:host=$this->daHost;dbname=$this->daDatabase", $this->daUser, $this->daPass);
            $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->isConnected = true;
            return $DBH;
        } catch (PDOException $e) {
        //echo $e;
        }
    }
    public function conQuery($query)
    {
        $con = @mysqli_connect($this->daHost, $this->daUser, $this->daPass, $this->daDatabase);
        
        if ($con) {
            $this->isConnected = true;
            $result = mysqli_query($con, $query);
            

            return $result;

        } else {
            $this->isConnected = false;
            echo $this->getMessage();
        }

    }

    public function sql($query,array $param =[])
    {
        $sql = new mysqli($this->daHost, $this->daUser, $this->daPass, $this->daDatabase);
        
        if ($sql) {
            $this->isConnected = true;
            $result = $sql->execute_query($query,$param);
            

            return $result;

        } else {
            $this->isConnected = false;
            echo $this->getMessage();
        }

    }

}

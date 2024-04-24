<?php
Class Conexion extends mysqli{
    private $host = "localhost";
    private $db = "matchfilm";
    private $user = "matchfilm";
    private $pass = "matchfilm";

    public function __construct()
    {
        try{
            parent::__construct($this->host, $this->user, $this->pass, $this->db);
            
        }catch (mysqli_sql_exception $e){
            echo "ERROR: {$e->getMessage()}";
            // header("HTTP/1.1 400 Bad Request");
            
            exit;
        }
    }
}
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

?>
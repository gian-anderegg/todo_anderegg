<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Headers: *');
    include_once("util.php");
    include_once("config.php");
    include_once("db.php");
    include_once("application.php");
    include_once("rest.php");
    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;

    error_reporting(E_ALL ^ E_NOTICE);


    $dsn = "mysql:host=".HOST.";dbname=".DB.";charset=".CHARSET.";";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    global $pdo;
    try {
        $pdo = new PDO($dsn, DBUSER, DBPASSWORD, $options);
} catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    // Get requested method
    $method = $_SERVER['REQUEST_METHOD'];

    // Read post, put, delete data from client
    $dataFromClient = json_decode(file_get_contents('php://input'));

    // Read get data from client
    foreach ( $_GET as $pname => $pvalue ) {
        if ( !$dataFromClient )  $dataFromClient = new stdClass();
        $dataFromClient->$pname = $pvalue;
    }

    // Run controller
    $dataToClient = controller( $method, $dataFromClient->ressource, $dataFromClient->id, $dataFromClient,$pdo );

    // Send response to client
    rest::sendStatusAndData($dataToClient['status'], $dataToClient['data']);

?>

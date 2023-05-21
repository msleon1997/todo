
<?php
header("Access-Control-Allow-Origin:*");

$dsn = "mysql:dbname=agenda;host=localhost:3306";
$username = "root";
$password = "SaNtIaGo@159753";

try {
    $connection = new PDO($dsn, $username, $password);
}catch (Exception $exception) {
    print_r($exception);
}



$query = "SELECT * FROM tasks";



$result = $connection->query($query, PDO:: FETCH_OBJ);

if (!$result) {
    echo "no se puede listar el contenido";
    die();
} 


$tasks = [];
foreach ($result as $item){
    $tasks[] = $item;
}
echo json_encode($tasks);



?>

<?php
header("Access-Control-Allow-Origin:*");

$dsn = "mysql:dbname=agenda;host=localhost:3306";
$username = "root";
$password = "SaNtIaGo@159753";


$connection = new PDO($dsn, $username, $password);


$id = $_GET['id'];

$query = "DELETE FROM tasks WHERE id = '$id'";



$result = $connection->query($query, PDO:: FETCH_OBJ);

echo "{'message': 'Eliminado'}";

?>
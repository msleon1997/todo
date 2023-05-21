
<?php
//Permite recibir peticiones desde cualquier dirección
header("Access-Control-Allow-Origin:*");
//Para recibir datos enviados en el cuerpo de la petición
$content = file_get_contents("php://input");
// Transformar el rawData en un objeto de PHP
$tasks = json_decode($content);
//Para ver en pantalla qué estamos recibiendo

$dsn = "mysql:dbname=agenda;host=localhost:3306";
$username = "root";
$password = "SaNtIaGo@159753";


$connection = new PDO($dsn, $username, $password);

$name = $tasks->name;
$desciption = $tasks->description;
$date = $tasks->date;

$query = "INSERT INTO tasks 
    (name, description, date) 
    VALUES('$name', '$desciption', '$date')";



$result = $connection->query($query);

if ($result) {
    echo "{'message': 'ok'}";

} else {
    echo "{'error': 'no resgistrado'}";

}






?>
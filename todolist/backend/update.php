
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
$id = $tasks->id;
$name = $tasks->name;
$desciption = $tasks->description;
$date = $tasks->date;
$status = $tasks->status;
$query = "UPDATE tasks SET  name = '$name', description = '$desciption', date = '$date', status = '$status' WHERE id = $id";



$result = $connection->query($query);

if ($result) {
    echo "{'Tarea Actualizado}";

} else {
    echo "{'error': 'no se actualizo'}";

}






?>
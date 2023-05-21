<?php 
    /*Database conexion*/
    $host = 'localhost';
    $username = 'root';
    $password = 'SaNtIaGo@159753';
    $database = 'agenda';
    Global $dbconfig;
    $dbconfig = mysqli_connect($host,$username,$password,$database) or die("Un error ha ocurrido conectado con la base de datos");



/* sentencia sql para insertar tareas en el todo*/ 
    if (isset($_GET['insert_description'])) {
		$desc=$_GET['insert_description'];

  		if(mysqli_query($dbconfig,"INSERT INTO todo(descripcion) values('$desc')")){
  			$response_array['status']="Bien";
  		}else {
  			$response_array['status']="error";
  		}
  		header('Content-type: application/json');//preparando en codificado para json
    	echo json_encode($response_array);//enviar respuesta a ajax
	}

/* sentencia sql para eliminar tareas en el todo*/ 
    if (isset($_GET['delete_id'])) {
        $delete_id=$_GET['delete_id'];
          if(mysqli_query($dbconfig,"DELETE FROM todo WHERE id=$delete_id")){
            $response_array['delete_status']="bien";
          }else {
            $response_array['delete_status']="error";
          }
          header('Content-type: application/json');//sending response to ajax
          echo json_encode($response_array);
      }

/* sentencia sql para editar o actualizar tareas en el todo*/ 

      if (isset($_GET['edit_id'])){
        $edit_id= $_GET['edit_id']; 
        $new_desc= $_GET['new_desc'];
          if(mysqli_query($dbconfig,"UPDATE todo SET descripcion='$new_desc' WHERE id=$edit_id")){
            $response_array['edit_status']="bien";
          }else {
            $response_array['edit_status']="error";
          }
          header('Content-type: application/json');//enviar respuesta a ajax
          echo json_encode($response_array);
      }
?>
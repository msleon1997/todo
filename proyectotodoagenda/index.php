<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="//code.jquery.com/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" type="text/css" href="alertify/css/main.css"> -->
<!--   <link rel="stylesheet" type="text/css" href="alertify/css/alertify.bootstrap.css"> -->
  <link rel="stylesheet" type="text/css" href="./alertas/css/alertify.core.css">
  <link rel="stylesheet" type="text/css" href="./alertas/css/alertify.default.css">
  <!-- <link rel="stylesheet" type="text/css" href="alertify/css/alertify.css">  -->
  <link rel="stylesheet" type="text/css" href="custom.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>TODO LISTA DE TAREAS</title>
</head>
<header>
    <nav>
        <ul>
		<li><a href="http://localhost/agenda">Inicio</a></li>
		<li><a href="http://localhost/agenda/proyectotodoagenda/">Lista de tareas con AJAX JS</a></l>
		<li><a href="http://localhost/agenda/todolist/frontend/">Todo list visto en Clase</a></li>
		
	 </ul>
    </nav>
</header>
<body>
<br><br>
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-success" role="alert">
            <h4>TODO LISTA DE TAREAS CON HTML, JS Y PHP</h4>
            </div>
        </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="input-group">
          <input type="text" class="form-control" id="txtNewItem" placeholder="Descripcion de la nueva tarea">
          <span class="input-group-btn">
            <button class="btn btn-primary" id="addButton" onclick="return validateForm();" type="button">Añadir nueva</button>
          </span>
        </div>
      </div>
    </div>

<br><br><br>
<div class="row">
      <div id="list" class="col-md-8 col-md-offset-2">  
        <?php include './list.php' ?>
      </div>
</div>


</div>

<script src="./alertas/js/alertify.min.js"></script>
<script>
    function validateForm() {
        var val = document.getElementById("txtNewItem").value;
        //comprueba si exede la descripcion mas de 20 caracteres
        if (val.length<20) {
            alertify.error("La descricion de la tarea debe contener mas de 20 caracteres");
            return false;
        }else {
            InsertTareaDatabase();
        }
    }

    function validateEdit(desc) {
        var desc = document.getElementById("txtNewItem").value;
        //comprueba si exede la descripcion mas de 20 caracteres
        if (val.length<20) {
            alertify.error("La descricion de la tarea debe contener mas de 20 caracteres");
            return false;
        }else {
            return true;
        }
    }


    function InsertTareaDatabase(){

        var buttonString= "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate' id='spinner'></span> "+$('#addButton').html();
        $('#addButton').html(buttonString);
      
      var new_desc=document.getElementById("txtNewItem").value;
      document.getElementById("txtNewItem").value="";
      $.ajax({
        url:'./process.php?insert_description=' + new_desc,
        complete: function (response) {
          var status = JSON.parse(response.responseText);
                console.log(response);
               if(status.status =="success"){
                alertify.success("Nueva tarea ingresada satisfactoriamente");
              }else if(status.status =="error"){
                alertify.error("Error mientras se añade un tarea");
              }
                  $( "#list" ).load( "./list.php"); // para recargar la lista desde la base de datos
                  $( "#spinner" ).remove(); //remover spiner cuando la tarea es completada
                },
                error: function () {
                  $('#output').html('Mensaje: Esto es un error!');
                  alertify.error("Error mientras se añade una tarea");
                },
              });
    }

</script>
<script>
    /* funciones para acciones con la base de datos del todo*/

    function DeleteItem(id) {
        alertify.confirm("Estas seguro en eliminar esta tarea?", function (e) {
          if (e) {
            //para el spiner
            var buttonString= "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate' id='spinner'></span> "+$('#delete_'+id).html();
            $('#delete_'+id).html(buttonString);

            $.ajax({
              url:'./process.php?delete_id=' + id,
              complete: function (response) {
                     var status = JSON.parse(response.responseText);//cambia el estado cuando recibe desde php
                     if(status.delete_status =="ESCELENTE"){
                      alertify.success("Tarea Eliminada");
                           $( "#list" ).load( "./list.php" );// para recargar el todo de la  base de datos
                         }else if(status.delete_status =="error"){
                          alertify.error("Error mientras se eliminaba la tarea");
                        }
                      },
                      error: function () {
                        $('#output').html('Mensaje: Este es un error!');
                      },
                    });
          }
        });
      }


      //edit
      function EditItem(id) {
        $.ajax({
          url:'./process.php?edit_id=' + id,
          complete: function (response) {
                var status = JSON.parse(response.responseText);//cambia el estado cuando recibe desde php
                if(status.edit_status =="ESCELENTE"){
                  alertify.success("Tarea Eliminada");
                      $( "#list" ).load( "./list.php" );// para recargar el todo de la  base de datos
                    }else if(status.edit_status =="error"){
                      alertify.error("Error mientras se eliminaba la tarea");
                    }
                  },
                  error: function () {
                    $('#output').html('Mensaje: Este es un error!');
                  },
                });
      }


      function checks(id,desc){
     
        alertify.prompt("Editar lista de tareas, ID="+id, function (e, str) {
        if (e) {
            if (str.length>20) {
              /*Cambia en la base si el texto de la tarea es editable*/
          
            var buttonString= "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate' id='spinner'></span> "+$('#edit_'+id).html();
            $('#edit_'+id).html(buttonString);
            
              $.ajax({
                url:'./process.php',
                data : {edit_id:id, new_desc:str},
                complete: function (response) {
                var status = JSON.parse(response.responseText);//cambia el estado cuando recibe desde php
                if(status.edit_status =="success"){
                  alertify.success("Informacion actualizada");
                      $( "#list" ).load( "./list.php" );// para recargar el todo de la  base de datos
                      $( "#spinner" ).remove(); // quita el spinner cuando la tarea ha sido cumplida
                    }else if(status.edit_status =="error"){
                      alertify.error("Error mientras se actualiza la tarea");
                    }
                  },
                  error: function () {
                    $('#output').html('Mensaje: Este es un error!');
                  },
                });
              
             
             }else{
              alertify.error("La descripción de la tarea debe contener al menos 20 caracteres. No se han realizado cambios");
             }
        } else {
           
        }
      }, desc);
  }
</script>

</body>
</html>
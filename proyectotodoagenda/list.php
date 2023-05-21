<?php 

/*Database conexion*/
$host = 'localhost';
$username = 'root';
$password = 'SaNtIaGo@159753';
$database = 'agenda';
Global $dbconfig;
$dbconfig = mysqli_connect($host,$username,$password,$database) or die("Un error ha ocurrido conectado con la base de datos");

// consulta para traer todo el listado del todo de la base de datos
$result=mysqli_query($dbconfig,"SELECT * FROM todo");




?>
<!-- creamos la tabla para mostrar las tareas -->
<table class="table" id=todoListTable>
	<thead>
		<th class="col-md-1">ID</th>
		<th class="col-md-9">Titulo</th>
		<th class="col-md-2"> <div class="pull-right">Accion</div></th>
	</thead>
	<tbody>
		<?php $i=1;?>
		<?php while($res = mysqli_fetch_assoc($result)){?>
		<tr>
			<td class="col-md-1"><?=$i;$i++;?></td>
			<td class="col-md-9"><?=$res['descripcion']?></td>
			<td class="col-md-2">
				<div class="btn-group pull-right">
				<a title="Delete" class="btn btn-danger btn-xs delete-button" id="delete_<?=$res['id']?>" onclick="DeleteItem(<?=$res['id']?>);"><span class='glyphicon glyphicon-trash'></span></a>
				<a style="margin-left: 2px" title="Edit" class="btn btn-info btn-xs edit-button" id="edit_<?=$res['id']?>" onclick="checks(<?=$res['id']?>,'<?=$res['descripcion']?>');"><span class='glyphicon glyphicon-edit'></span></a>
				</div>
			</td>
		</tr>
		<?php }?>
	</tbody>
</table>
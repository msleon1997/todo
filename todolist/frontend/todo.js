let updateMode = false;

const cancelDeleteButton = document.getElementById('cancelDeleteButton');
cancelDeleteButton.addEventListener('click', function (){
    const confirmDeleteButton = document.getElementById('confirmDeleteDialog');
    confirmDeleteButton.close();


});

const confirmDeleteButton = document.getElementById('confirmDeleteButton');
confirmDeleteButton.addEventListener('click', () =>{
    const id = document.getElementById('idToDelete');
    fetch('http://localhost/agenda/todolist/backend/delete.php?id=' + id.value)
    .then(() => {
        alert('Tarea Eliminada');
        showTasks();
    })

    .catch ((error) => {
        console.log(error)
        alert('No se pudo eliminar')
    })
})


function insert() {
    const id = document.getElementById('id').value;
    const name = document.getElementById('name').value;
    const description = document.getElementById('description').value;
    const date = document.getElementById('date').value;
    const status = document.getElementById('status').value;
    const task = {
        id: id,
        name:name,
        description:description,
        date:date,
        status:status
    
    };
   
    let  apiFile = 'insert.php';
    if (updateMode == true) apiFile = 'update.php';


    fetch(`http://localhost/agenda/todolist/backend/${apiFile}`,{
        method: 'POST', body: JSON.stringify(task)})
    .then(() =>  {
        alert('Tarea registrada');
          showTasks();
    })
    .catch((error) => {
        console.log(error);
        alert('no registrado satisfactoriamente');
   
    })

}


function showTasks() {
    fetch("http://localhost/agenda/todolist/backend/list.php")
    .then(response => data = response.json())
    .then(data => {
       const tasks = data
        renderTasks(tasks)

    })
    .catch(error => {
        console.log(error);
        alert(' No listado ');
    })
}

function renderTasks(tasks) {

    clearTasks();

    for (let i = 0; i < tasks.length; i++) {
        
       

        const colName = document.createElement('td');
        colName.innerHTML = tasks[i].name;
   

        const  colDescription = document.createElement('td');
          colDescription.innerHTML = tasks[i].description;

        const colDate = document.createElement('td');
         colDate.innerHTML = tasks[i].date;

        const  colStatus = document.createElement('td');
          colStatus.innerHTML = tasks[i].status;


        const colUpdate = document.createElement('button');
        colUpdate.innerHTML = 'Editar';
        colUpdate.setAttribute('onclick', `fillform('${tasks[i].id}','${tasks[i].name}', '${tasks[i].description}', '${tasks[i].date}',)`)
        
        const colDelete = document.createElement('button');
        colDelete.innerHTML = 'Eliminar';
        colDelete.setAttribute('onclick', `confirmDelete('${tasks[i].id}','${tasks[i].name}', '${tasks[i].description}', '${tasks[i].date}',)`)

        
        const colChangeStatus = document.createElement('button');
        colChangeStatus.innerHTML = 'Cambiar estado';
        colChangeStatus.setAttribute('onclick', `fillform('${tasks[i].id}','${tasks[i].name}', '${tasks[i].description}', '${tasks[i].date}', '${tasks[i].status}')`)
        



        
        row = document.createElement('tr');
        row.setAttribute('class', 'tasks-data');
        row.appendChild(colName);
        row.appendChild(colDescription);
        row.appendChild(colDate);
        row.appendChild(colStatus);
        row.appendChild(colUpdate);
        row.appendChild(colDelete);
        row.appendChild(colChangeStatus);
        const table = document.getElementById('tasks');
        table.appendChild(row);
    } 
}

function clearTasks() {
 const tasks = document.getElementsByClassName('tasks-data');
 const arrayTasks = [...tasks];
 arrayTasks.map(task => task.remove());
}

function fillform(id, name,description,date) {

    const txtId = document.getElementById('id');
    txtId.value = id;

    const txtName = document.getElementById('name'); 
    txtName.value = name;
    const txtDescription = document.getElementById('description'); 
    txtDescription.value = description;
    const txtDate = document.getElementById('date'); 
    txtDate.value = date;

    updateMode = true;

}

function confirmDelete(id, name, description, date) {
    const confirmDeleteDialog = document.getElementById('confirmDeleteDialog')
    confirmDeleteDialog.showModal();

    const spanName = document.getElementById('spanName');
    spanName.innerHTML = name;
    const spanDescription = document.getElementById('spanDescription');('spanName');
    spanDescription.innerHTML = description;
    const spanFecha = document.getElementById('spanFecha');
    spanFecha.innerHTML = date;

    const txtid = document.getElementById('idToDelete');
    txtid.value = id;
    
}
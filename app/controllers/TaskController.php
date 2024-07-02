<?php

require_once ROOT_PATH . '/app/models/Task.class.php';
class TaskController extends Controller {

    public function __construct(){
    }
    //Listar todas las tareas
	public function indexAction()
	{
        $taskModel = new Task();
		$allTasks = $taskModel->fetchAll();
        $this->view->allTasks = $allTasks;
	}
	
    //Crear tarea
	/*public function addAction()
	{
		require_once "../models/Task.class.php";
        $tasks = Task::addTasks();
        require_once "../views/add.php";
	}

    //Actualizar tarea
    public function updateAction()
	{
		require_once "../models/Task.class.php";
        $tasks = Task::updateTasks();
        require_once "../views/update.php";
	}

    //Borrar tarea
    public function deleteAction()
	{
		require_once "../models/Task.class.php";
        $tasks = Task::deleteTasks();
        require_once "../views/delete.php";
	}

    //Listar una tarea
    public function infoAction()
	{
		require_once "../models/Task.class.php";
        $tasks = Task::infoTasks();
        require_once "../views/info.php";
	}*/
}

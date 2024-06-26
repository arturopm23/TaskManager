<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class TaskController extends Controller {

    //Listar todas las tareas
	public function indexAction()
	{
		require_once "../models/Task.class.php";
        $tasks = Task::getAllTasks();
        require_once "../views/homeView.php";
	}
	
    //Crear tarea
	public function addAction()
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
	}
}

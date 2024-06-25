<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{

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
		echo "hello from test::check";
	}

    //Actualizar tarea
    public function updateAction()
	{
		echo "hello from test::check";
	}

    //Borrar tarea
    public function deleteAction()
	{
		echo "hello from test::check";
	}

    //Listar una tarea
    public function infoAction()
	{
		echo "hello from test::check";
	}
}

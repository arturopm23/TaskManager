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
		$this->view->message = "hello from test::index";
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

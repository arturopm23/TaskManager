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
	public function addAction() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $taskModel = new Task();
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $user = $_POST['user'];
            $startDate = $_POST['startDate'];
            $deadline = $_POST['deadline'];

            $data = [
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'user' => $user,
                'startDate' => $startDate,
                'deadline' => $deadline
            ];

            $taskModel->create($data);
            header('Location: ' . WEB_ROOT . '/index');
            exit;
        }

    //Actualizar tarea
    /*public function updateAction()
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
}
?>
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
    }

// Actualizar tarea
public function editAction() {
    $taskModel = new Task();
    $url_parts = explode('/', $_SERVER['REQUEST_URI']);
    $taskId = end($url_parts);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Process form submission here
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $user = $_POST['user'];
        $startDate = $_POST['startDate'];
        $deadline = $_POST['deadline'];

        $data = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'status' => $status,
            'user' => $user,
            'startDate' => $startDate,
            'deadline' => $deadline
        ];

        $taskModel->edit($data);
        header('Location: ' . WEB_ROOT . '/index');
        exit;
    } else {
        // Fetch task details using $taskId
        $task = $taskModel->fetchTask($taskId);
        if (!$task) {
            // Handle case where task with $taskId does not exist
            die('Task not found.');
        }

        // Pass task data to the view
        $this->view->task = $task;
    }
}


    //Borrar tarea
    /*public function deleteAction()
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
?>
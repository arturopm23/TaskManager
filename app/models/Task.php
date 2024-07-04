<?php

require_once "Status.php"; // Incluye el archivo Status.php

class Task extends Model
{
    // Propiedades privadas de la clase
    private $filePath;
    private int $id;
    private string $name;
    private string $description;
    private Status $status;
    private DateTime $dateCreated;
    private DateTime $dateFinished;
    private int $userId;

    // Constructor de la clase
    public function __construct()
    {
        $this->filePath = ROOT_PATH . "/data/tasks.json"; // Define la ruta del archivo JSON
        $this->loadTasks(); // Carga las tareas desde el archivo JSON
    }

    // Carga las tareas desde el archivo JSON
    private function loadTasks(): void
    {
        // Si el archivo no existe, lo crea con un array vacío
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }

        $jsonString = file_get_contents($this->filePath); // Lee el contenido del archivo
        $this->tasks = json_decode($jsonString, true) ?? []; // Decodifica el JSON y lo almacena en $this->tasks
    }

    // Métodos Getters para acceder a las propiedades privadas
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    public function getDateFinished(): DateTime
    {
        return $this->dateFinished;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    // Métodos Setters para modificar las propiedades privadas
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStatus(Status $status): void
    {
        $this->status = $status;
    }

    public function setDateCreated(DateTime $dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }

    public function setDateFinished(DateTime $dateFinished): void
    {
        $this->dateFinished = $dateFinished;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    // Método para crear una nueva tarea
    public function create($data = []): bool
    {
        // Mezcla los datos proporcionados con los actuales
        $data = array_merge([
            "id" => $this->getId(),
            "task_name" => $this->getName(),
            "description" => $this->getDescription(),
            "status" => $this->getStatus()->getName(),
            "dateCreated" => $this->getDateCreated()->format('Y-m-d'),
            "dateFinished" => $this->getDateFinished()->format('Y-m-d'),
            "userId" => $this->getUserId(),
        ], $data);

        // Lee el contenido existente del archivo JSON
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Determina el próximo ID
        $data['id'] = empty($tasks) ? 1 : end($tasks)['id'] + 1;

        // Verifica si la tarea ya existe para el usuario
        if ($this->checkRepeat($data['task_name'], $data['userId']) === false) {
            $tasks[] = $data;
            // Guarda los datos actualizados en el archivo JSON
            if (file_put_contents($this->filePath, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                $_SESSION['message'] = "Tarea creada con éxito.";
                $_SESSION['tasks'] = $tasks;
                return true;
            } else {
                $_SESSION['message'] = "Error al guardar tarea.";
                return false;
            }
        } else {
            $_SESSION["message"] = "Esta tarea ya existe para este usuario.";
            return false;
        }
    }

    // Obtiene todas las tareas
    public function getAll(): array
    {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        $_SESSION['tasks'] = $tasks;

        return $tasks;
    }

    // Obtiene todas las tareas de un usuario específico
    public function getAllTasksUser(int $userId): array
    {
        $tasksFound = [];

        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Filtra las tareas por el ID del usuario
        foreach ($tasks as $task) {
            if ($task['userId'] === $userId) {
                $tasksFound[] = $task;
            }
        }

        if (empty($tasksFound)) {
            $_SESSION['message'] = "Este ID de usuario no existe.";
        }

        $_SESSION['tasksFound'] = $tasksFound;

        return $tasksFound;
    }

    // Obtiene una tarea específica por su ID
    public function getOneTask(int $id): array
    {
        $tasksFound = [];

        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Filtra la tarea por su ID
        foreach ($tasks as $task) {
            if ($task['id'] === $id) {
                $tasksFound[] = $task;
            }
        }

        if (empty($tasksFound)) {
            $_SESSION['message'] = "Este ID de tarea no existe.";
        }

        $_SESSION['tasksFound'] = $tasksFound;

        return $tasksFound;
    }

    // Busca tareas que contengan una cadena específica
    public function findTasks(string $string): array
    {
        $tasksFound = [];

        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Busca tareas que contengan la cadena en el nombre
        foreach ($tasks as $task) {
            if (stripos($task['task_name'], $string) !== false) {
                $tasksFound[] = $task;
            }
        }

        if (empty($tasksFound)) {
            $_SESSION['message'] = "No se encontraron tareas que contengan esta palabra.";
        }

        $_SESSION['tasksFound'] = $tasksFound;

        return $tasksFound;
    }

    // Elimina una tarea por su ID
    public function deleteTask(int $id): bool
    {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Busca y elimina la tarea por su ID
        foreach ($tasks as $key => $task) {
            if ($task['id'] == $id) {
                unset($tasks[$key]);
                file_put_contents($this->filePath, json_encode(array_values($tasks), JSON_PRETTY_PRINT));
                $_SESSION['message'] = "Tarea eliminada correctamente.";
                return true;
            }
        }

        $_SESSION['message'] = "No se encontró la tarea a eliminar.";
        return false;
    }

    // Obtiene una tarea por su ID
    public function getTaskById(int $id): ?array
    {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Busca la tarea por su ID
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return $task;
            }
        }

        return null;
    }

    // Actualiza una tarea específica
    public function updateTask(int $id, string $name, string $description, string $status, int $userId, string $dateFinished): bool
    {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Verifica si la tarea ya existe para el usuario, excluyendo la tarea actual
        if ($this->checkRepeat($name, $userId, $id) === false) {
            foreach ($tasks as $key => $task) {
                if ($task['id'] == $id) {
                    $tasks[$key]['task_name'] = $name;
                    $tasks[$key]['description'] = $description;
                    $tasks[$key]['status'] = $status;
                    $tasks[$key]['userId'] = $userId;
                    $tasks[$key]['dateFinished'] = $dateFinished;
                    break;
                }
            }

            // Guarda los datos actualizados en el archivo JSON
            if (file_put_contents($this->filePath, json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                $_SESSION['message'] = "Tarea actualizada con éxito.";
                return true;
            } else {
                $_SESSION['message'] = "Error al actualizar la tarea.";
                return false;
            }
        } else {
            $_SESSION["message"] = "Esta tarea ya existe para este usuario.";
            return false;
        }
    }

    // Verifica si una tarea ya existe para un usuario específico
    public function checkRepeat(string $name, int $userId, int $id = null): bool
    {
        if (file_exists($this->filePath)) {
            $jsonContent = file_get_contents($this->filePath);
            $tasks = json_decode($jsonContent, true);
        } else {
            $tasks = [];
        }

        // Verifica si la tarea ya existe para el usuario, excluyendo la tarea actual si se proporciona un ID
        foreach ($tasks as $task) {
            if ($task['task_name'] == $name && $task['userId'] == $userId && ($id === null || $task['id'] != $id)) {
                return true;
            }
        }

        return false;
    }
}
?>

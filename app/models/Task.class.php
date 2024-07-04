<?php
class Task extends Model {

    protected array $allTasks;
    protected string $dataRoute = ROOT_PATH . "\app\data\data.json";


    public function __construct() {
        $this->loadTasks();
    }

    private function loadTasks(){
        $dataRoute = ROOT_PATH . "\app\data\data.json";
        $this->allTasks = json_decode(file_get_contents($dataRoute), true) ?? [];
    }

    public function fetchAll(){
        return $this->allTasks;
    }

    public function create(array $data){
        $id = count($this->allTasks) + 1;
        $task = [
            'id' => $id,
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'user' => $data['user'],
            'startDate' => $data['startDate'],
            'deadline' => $data['deadline']
        ];

        $this->allTasks[] = $task;
        file_put_contents($this->dataRoute, json_encode($this->allTasks, JSON_PRETTY_PRINT));
    }

    
        public function edit(array $data) {
            foreach ($this->allTasks as &$task) { // Use reference to modify the original array
                if ($task['id'] == $data['id']) {
                    $task['title'] = $data['title'];
                    $task['description'] = $data['description'];
                    $task['status'] = $data['status'];
                    $task['user'] = $data['user'];
                    $task['startDate'] = $data['startDate'];
                    $task['deadline'] = $data['deadline'];
                    break; // Exit the loop once the task is found and updated
                }
            }
            file_put_contents($this->dataRoute, json_encode($this->allTasks, JSON_PRETTY_PRINT));
        }
    
        public function fetchTask($id) {
            foreach ($this->allTasks as $task) {
                if ($task['id'] == $id) {
                    return $task;
                }
            }
            return null;
        }

    public function delete($id) {
        $deleted = false;
        foreach ($this->allTasks as $key => $task) {
            if ($task['id'] == $id) {
                unset($this->allTasks[$key]);
                $deleted = true;
                break;
            }
        }
        if ($deleted) {
            file_put_contents($this->dataRoute, json_encode($this->allTasks, JSON_PRETTY_PRINT));
        }
        return $deleted;
    }
}        
?>

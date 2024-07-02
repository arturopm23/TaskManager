<?php
class Task extends Model {


    protected array $allTasks;
    /*private int $id;
    private string $title;
    private string $description;
    private string $status; //Podria hacer un enum, no prometo nada
    private int $idUser;
    private string $startDate; //por ahora se queda en string, veremos luego
    private string $endDate;*/


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

    /*private function getId() : int {
        return $this->id;
    }

    private function getTitle() : string {
        return $this->title;
    }

    private function getDescription() : string {
        return $this->description;
    }

    private function getSatus() : string {
        return $this->status;
    }

    private function getIdUser() : int {
        return $this->idUser;
    }

    private function getStartdate() : string {
        return $this->startDate;
    }

    private function getEndDate() : string {
        return $this->endDate;
    }

    private function setId(int $id) : void {
        $this->id = $id;
    }

    private function setTitle(string $title) : void {
        $this->title = $title;
    }

    private function setDescription(string $description) : void {
        $this->description = $description;
    }

    private function setStatus(string $status) : void {
        $this->status = $status;
    }

    private function setIdUser(int $idUser) : void {
        $this->idUser = $idUser;
    }

    private function setFechaInicio(string $startDate) : void {
        $this->startDate = $startDate;
    }

    private function setFechaFinal(string $endDate) : void {
        $this->endDate = $endDate;
    }*/
}
?>

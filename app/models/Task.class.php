<?php
class Task extends Model {
    private int $id;
    private string $title;
    private string $description;
    private string $status; //Podria hacer un enum, no prometo nada
    private int $idUser;
    private string $startDate; //por ahora se queda en string, veremos luego
    private string $endDate;


    private function __construct(int $id, string $title, string $description, string $status, int $idUser, string $startDate, string $endDate) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->idUser = $idUser;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    private function getId() : int {
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
    }
}
?>

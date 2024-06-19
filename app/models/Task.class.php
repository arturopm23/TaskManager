<?php
class Task extends Model {
    private int $id;
    private string $title;
    private string $description;
    private string $estado; //Podria hacer un enum, no prometo nada
    private int $idUsuario;
    private string $fechaInicio; //por ahora se queda en string, veremos luego
    private string $fechaFinal;


    private function __construct(int $id, string $title, string $description, string $estado, int $idUsuario, string $fechaInicio, string $fechaFinal) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->estado = $estado;
        $this->idUsuario = $idUsuario;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
    }

    private function getId() : int {
        return $this->$id;
    }

    private function getTitle() : string {
        return $this->$title;
    }

    private function getDescription() : string {
        return $this->$description;
    }

    private function getEstado() : string {
        return $this->$estado;
    }

    private function getIdUsuario() : int {
        return $this->$idUsuario;
    }

    private function getFechaInicio() : string {
        return $this->$fechaInicio;
    }

    private function getFechaFinal() : string {
        return $this->$fechaFinal;
    }

    private function setId(int $id) : void {
        $this->$id = $id;
    }

    private function setTitle(string $title) : void {
        $this->$title = $title;
    }

    private function setDescription(string $description) : void {
        $this->$description = $description;
    }

    private function setEstado(string $estado) : void {
        $this->$estado = $estado;
    }

    private function setIdUsuario(int $idUsuario) : void {
        $this->$idUsuario = $idUsuario;
    }

    private function setFechaInicio(string $fechaInicio) : void {
        $this->$fechaInicio;
    }

    private function setFechaFinal(string $fechaFinal) : void {
        $this->$fechaFinal;
    }
}
?>
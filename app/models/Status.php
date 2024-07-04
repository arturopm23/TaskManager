<?php

class Status
{
    // Propiedad privada que contiene los estados posibles
    private $statuses = ['Pending', 'In Progress', 'Completed'];
    
    // Propiedad privada para almacenar el nombre del estado actual
    private $name;

    // Constructor de la clase
    public function __construct(string $name = 'Pending')
    {
        // Verifica si el nombre del estado proporcionado es válido
        if (!in_array($name, $this->statuses)) {
            throw new InvalidArgumentException("Invalid status name");
        }
        // Asigna el nombre del estado a la propiedad
        $this->name = $name;
    }

    // Método para obtener el nombre del estado actual
    public function getName(): string
    {
        return $this->name;
    }

    // Método para establecer el nombre del estado
    public function setName(string $name): void
    {
        // Verifica si el nombre del estado proporcionado es válido
        if (!in_array($name, $this->statuses)) {
            throw new InvalidArgumentException("Invalid status name");
        }
        // Asigna el nuevo nombre del estado a la propiedad
        $this->name = $name;
    }

    // Método para obtener todos los estados posibles
    public function getStatuses(): array
    {
        return $this->statuses;
    }

    // Método para verificar si un nombre de estado es válido
    public function isValidStatus(string $name): bool
    {
        return in_array($name, $this->statuses);
    }

    // Método estático para validar un nombre de estado sin necesidad de instanciar la clase
    public static function validateStatus(string $name): void
    {
        $statuses = ['Pending', 'In Progress', 'Completed'];
        // Verifica si el nombre del estado proporcionado es válido
        if (!in_array($name, $statuses)) {
            throw new InvalidArgumentException("Invalid status name");
        }
    }
}
?>

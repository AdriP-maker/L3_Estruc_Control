<?php
//Clase que encapsula los datos de un alumno (nombre y promedio).

class Alumno
{
    private string $nombre;
    private float $promedio;

    // Inicia constructor de la clase Alumno     
    public function __construct(string $nombre, $promedio)
    {
        // --- Validación del nombre ---
        $nombre = trim($nombre);
        if ($nombre === '') {
            throw new InvalidArgumentException(
                'El nombre del alumno no puede estar vacío.'
            );
        }

        // --- Validación: el nombre no debe contener números ---
        if (preg_match('/[0-9]/', $nombre)) {
            throw new InvalidArgumentException(
                "El nombre \"$nombre\" no es válido. No se permiten números en el nombre."
            );
        }

        // --- Validación del promedio ---
        if (!is_numeric($promedio)) {
            throw new InvalidArgumentException(
                "El promedio de \"$nombre\" no es un valor numérico válido."
            );
        }

        $promedio = (float) $promedio;

        if ($promedio < 0 || $promedio > 100) {
            throw new InvalidArgumentException(
                "El promedio de \"$nombre\" debe estar entre 0 y 100. Se recibió: $promedio"
            );
        }

        // --- Asignación de propiedades ---
        $this->nombre = $nombre;
        $this->promedio = $promedio;
    }
    // Termina constructor de la clase Alumno

    // Inicia métodos getter (acceso a propiedades privadas)
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getPromedio(): float
    {
        return $this->promedio;
    }


    public function getLetra(): string
    {
        if ($this->promedio >= 91) {
            return 'A';
        } elseif ($this->promedio >= 81) {
            return 'B';
        } elseif ($this->promedio >= 71) {
            return 'C';
        } elseif ($this->promedio >= 61) {
            return 'D';
        } else {
            return 'F';
        }
    }
    // Termina método getLetra

    // Inicia método __toString — Representación en texto del objeto
    public function __toString(): string
    {
        return sprintf(
            '%s — Promedio: %.1f (%s)',
            $this->nombre,
            $this->promedio,
            $this->getLetra()
        );
    }

    // Termina método __toString
}

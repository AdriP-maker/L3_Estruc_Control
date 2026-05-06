<?php
/**

 * Clase que encapsula los datos de un alumno (nombre y promedio).
 * Implementa Programación Orientada a Objetos (POO):
 *   - Propiedades privadas (encapsulamiento)
 *   - Constructor con validación (try-catch)
 *   - Métodos getter y de cálculo
 *
 * Se incluye desde L3P2.php con require_once.

 */
class Alumno
{

    // ============================================================
    // Inicia declaración de propiedades privadas de la clase
    // ============================================================

    /** @var string Nombre completo del alumno */
    private string $nombre;

    /** @var float Promedio final del alumno (0 – 100) */
    private float $promedio;

    // ============================================================
    // Termina declaración de propiedades privadas de la clase
    // ============================================================


    // ============================================================
    // Inicia constructor de la clase Alumno
    // ============================================================

    /**
     * Constructor — Crea un objeto Alumno validando los datos recibidos.
     *
     * @param string $nombre   Nombre del alumno (no puede estar vacío)
     * @param mixed  $promedio Promedio final (debe ser numérico, entre 0 y 100)
     *
     * @throws InvalidArgumentException Si el nombre está vacío
     * @throws InvalidArgumentException Si el promedio no es numérico
     * @throws InvalidArgumentException Si el promedio está fuera del rango 0-100
     */
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

    // ============================================================
    // Termina constructor de la clase Alumno
    // ============================================================


    // ============================================================
    // Inicia métodos getter (acceso a propiedades privadas)
    // ============================================================

    /**
     * Obtiene el nombre del alumno.
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Obtiene el promedio final del alumno.
     * @return float
     */
    public function getPromedio(): float
    {
        return $this->promedio;
    }

    // ============================================================
    // Termina métodos getter
    // ============================================================


    // ============================================================
    // Inicia método getLetra — Convierte promedio numérico a letra
    // ============================================================

    /**
     * Convierte el promedio a su letra equivalente según la escala:
     *   A = 91 – 100
     *   B = 81 – 90
     *   C = 71 – 80
     *   D = 61 – 70
     *   F = 0  – 60
     *
     * Usa estructura de control if/elseif/else.
     *
     * @return string Letra correspondiente ('A', 'B', 'C', 'D' o 'F')
     */
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

    /**
     * Representación en texto del alumno (nombre + promedio + letra).
     * Se invoca automáticamente al hacer echo de un objeto Alumno.
     *
     * Usa printf para formato, y retorna cadena formateada con sprintf.
     *
     * @return string
     */
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

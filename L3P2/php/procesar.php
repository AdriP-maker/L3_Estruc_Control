<?php
/**
 * ================================================================
 * PHP/procesar.php — Lógica de procesamiento de datos de alumnos.
 * ================================================================
 * Este archivo procesa el envío del formulario (POST):
 *   1. Captura la cantidad de alumnos y la opción elegida.
 *   2. Valida y crea objetos de la clase Alumno.
 *   3. Ordena los alumnos por promedio para los reportes.
 *   4. Gestiona la persistencia de datos mediante sesiones.
 *
 * Variables pobladas (globales en L3P2.php):
 *   - $alumnos, $alumnosOrd, $opcion, $cantAlumnos, $mensajeError, $mensajeExito
 *
 */

// ── Procesamiento del formulario (solo cuando es POST) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Guardar todos los datos del POST en la sesión para persistencia
    $_SESSION['L3P2_datos'] = $_POST;

    // Captar cantidad de alumnos del POST
    $cantAlumnos = (int) ($_POST['cantidad'] ?? 0);

    // Validación del límite máximo de alumnos (50)
    if ($cantAlumnos > 50) {
        $cantAlumnos = 50;
        $_POST['cantidad'] = 50;
        $_SESSION['L3P2_datos']['cantidad'] = 50;
        $mensajeError = 'El máximo permitido es 50 alumnos. Se ajustó automáticamente.';
    }

    // Solo procesar si se presionó el botón "Procesar" y hay alumnos
    if (isset($_POST['btn_procesar']) && $cantAlumnos > 0) {

        // Bloque try-catch para validación de datos del formulario
        try {

            // Inicia ciclo for para crear objetos Alumno desde los inputs
            for ($i = 0; $i < $cantAlumnos; $i++) {

                // ── Captar nombre y promedio del POST ──
                $nombre = trim($_POST["nombre_$i"] ?? '');
                $promedio = trim($_POST["promedio_$i"] ?? '');

                // ── Validar que no estén vacíos ──
                if ($nombre === '' || $promedio === '') {
                    throw new InvalidArgumentException(
                        "El alumno #" . ($i + 1) . " tiene campos vacíos. Complete nombre y promedio."
                    );
                }

                // ── Crear objeto Alumno (la validación está en el constructor) ──
                $alumnos[] = new Alumno($nombre, $promedio);
            }
            // Termina ciclo for de creación de objetos Alumno

            // Inicia captura de la opción de operación seleccionada
            $opcion = $_POST['operacion'] ?? '';
            if ($opcion === '') {
                throw new InvalidArgumentException(
                    'Debe seleccionar una operación del menú desplegable.'
                );
            }
            // Termina captura de la opción de operación

            // Inicia ordenamiento del array de alumnos por promedio
            $alumnosOrd = $alumnos;  // Copia del array original

            usort($alumnosOrd, function (Alumno $a, Alumno $b): int {
                // Ordenar descendente: si b > a retorna positivo
                if ($b->getPromedio() == $a->getPromedio())
                    return 0;
                return ($b->getPromedio() > $a->getPromedio()) ? 1 : -1;
            });
            // Termina ordenamiento del array

            // ── Mensaje de éxito ──
            $mensajeExito = '✔ Datos de ' . count($alumnos) . ' alumnos procesados correctamente.';

        } catch (InvalidArgumentException $e) {
            // Captura de excepción — Error de validación
            // Se limpia el array de alumnos y la opción
            $mensajeError = $e->getMessage();
            $alumnos = [];
            $alumnosOrd = [];
            $opcion = '';
        }
        // Termina bloque try-catch
    }

} elseif (isset($_SESSION['L3P2_datos'])) {
    // Si es GET y hay datos guardados en sesión, restaurarlos en $_POST
    // para que el formulario los muestre (persistencia al navegar)
    $_POST = $_SESSION['L3P2_datos'];
    $cantAlumnos = (int) ($_POST['cantidad'] ?? 0);
}
?>
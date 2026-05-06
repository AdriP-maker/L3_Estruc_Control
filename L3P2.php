<?php
// Inicia sesión PHP para persistir datos al navegar entre páginas
session_start();

// Inclusión de la clase Alumno (POO) con require_once
require_once 'L3P2/php/Alumno.php';

// Si se solicita limpiar, borrar datos de sesión y redirigir
if (isset($_GET['limpiar'])) {
    unset($_SESSION['L3P2_datos']);
    header('Location: L3P2.php');
    exit;
}

// Declaración de variables globales del controlador

/** @var string Mensaje de error para mostrar en el formulario */
$mensajeError = '';

/** @var string Mensaje de éxito tras procesar datos correctamente */
$mensajeExito = '';

/** @var array Array de objetos Alumno con los datos originales */
$alumnos = [];

/** @var array Array de objetos Alumno ordenados por promedio (mayor a menor) */
$alumnosOrd = [];
$opcion = '';
$cantAlumnos = 0;

// Procesamiento del formulario (solo cuando es POST)
require_once 'L3P2/php/procesar.php';
// Termina procesamiento del formulario
?>
<?php
// Inclusión del menú de navegación compartido (navbar)
require_once 'html/menu.html';
?>
<!-- Inclusión de la hoja de estilos propia del Programa 2 -->
<link href="L3P2/css/estilos.css" rel="stylesheet">

<!-- Inicia contenido principal de la página (main) -->
<main class="main-content">
    <div class="container">

        <?php
        // Inicia inclusión del encabezado del Programa 2 (título + descripción)
        include 'L3P2/html/header.html';
        // Termina inclusión del encabezado ?>
        <?php
        // Inicia inclusión del formulario de captura de alumnos
        require_once 'L3P2/php/formulario.php';
        // Termina inclusión del formulario ?>
        <?php
        // Inicia sección condicional de resultados
        // Solo se muestra si hay alumnos procesados Y una opción elegida
        if (!empty($alumnos) && $opcion !== ''):
            ?>
            <?php
            // ── Incluir el archivo de resultados ──
            require_once 'L3P2/php/resultado.php';
            ?>
        <?php endif; ?>

        <!-- Termina sección condicional de resultados -->
    </div>
</main>
<!-- Termina contenido principal de la página -->
<?php
// Inclusión del footer del Programa 2 (cierra HTML + scripts)
include 'L3P2/html/footer.html';
?>
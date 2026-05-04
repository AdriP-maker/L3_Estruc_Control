<?php
// Detecta la página activa para resaltar el enlace en el nav
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 3 - POO | Estructuras de Control | Arreglos</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos propios -->
    <link href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>index.php">
            <i class="bi bi-code-slash me-2"></i>Lab 3 - POO
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_actual === 'index.php') ? 'active' : ''; ?>"
                       href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>index.php">
                        <i class="bi bi-house-door me-1"></i>Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_actual === 'L3P1.php') ? 'active' : ''; ?>"
                       href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>L3P1.php">
                        <i class="bi bi-cart3 me-1"></i>P1 - Almacén
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_actual === 'L3P2.php') ? 'active' : ''; ?>"
                       href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>L3P2.php">
                        <i class="bi bi-mortarboard me-1"></i>P2 - Alumnos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_actual === 'L3P3.php') ? 'active' : ''; ?>"
                       href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>L3P3.php">
                        <i class="bi bi-graph-up me-1"></i>P3 - Ventas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($pagina_actual === 'L3P4.php') ? 'active' : ''; ?>"
                       href="<?php echo str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2); ?>L3P4.php">
                        <i class="bi bi-grid-3x3 me-1"></i>P4 - Inventario
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

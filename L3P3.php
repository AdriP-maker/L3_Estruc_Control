<?php 
// Carga el menú de navegación principal
require_once 'html/menu.html'; 
?>

<main class="main-content">
    <div class="container">
        <?php 
        // Carga el encabezado del laboratorio
        require_once 'L3P3/html/header.html'; 
        ?>

        <!-- FORMULARIO DE ENTRADA -->
        <?php 
        // Carga la interfaz para la entrada de datos y selección de opciones
        require_once 'L3P3/html/formulario.html'; 
        ?>

        <!-- ÁREA DE PROCESAMIENTO PHP -->
        <div id="contenedor-resultados">
            <?php 
            // Carga la lógica de procesamiento y visualización de cálculos
            require_once 'L3P3/php/procesar.php'; 
            ?>
        </div>
    </div>
</main>

<?php 
// Carga el pie de página
require_once 'L3P3/html/footer.html'; 
?>
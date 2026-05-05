<?php
// ── Clase de negocio ──────────────────────────────────────────
require_once 'L3P4/php/Inventario.php';

// ── Variables de estado ───────────────────────────────────────
$mensajeError  = '';
$mensajeExito  = '';
$erroresCampos = [];
$inv           = null;
$opcion        = '';

// ── Procesar POST ─────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $matrizRaw = [];
        for ($i = 0; $i < 3; $i++) {
            $fila = [];
            for ($j = 0; $j < 4; $j++) {
                $campo = "m{$i}{$j}";
                $valor = trim($_POST[$campo] ?? '');
                if ($valor === '') {
                    $erroresCampos[$campo] = true;
                    throw new InvalidArgumentException(
                        "El campo de la fila " . ($i + 1) . ", columna " . ($j + 1) . " está vacío."
                    );
                }
                $fila[] = $valor;
            }
            $matrizRaw[] = $fila;
        }

        $inv = new Inventario($matrizRaw);
        $inv->validar();

        $opcion = $_POST['operacion'] ?? '';
        if ($opcion === '') {
            throw new InvalidArgumentException('Debe seleccionar una operación del menú desplegable.');
        }

        $mensajeExito = '✔ Datos procesados correctamente.';

    } catch (InvalidArgumentException $e) {
        $mensajeError = $e->getMessage();
        $inv    = null;
        $opcion = '';
    }
}
?>

<?php require_once 'html/menu.html'; ?>

<!-- Estilos y fuentes propias del Programa 4 (tema oscuro) -->
<link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Barlow:wght@400;600&display=swap" rel="stylesheet">
<link href="L3P4/css/estilos.css" rel="stylesheet">

<?php require_once 'L3P4/html/banner.html'; ?>

<div class="container" style="padding-bottom: 2rem;">
    <?php require_once 'L3P4/html/header.html'; ?>
    <?php require_once 'L3P4/php/formulario.php'; ?>
    <?php if ($inv !== null && $opcion !== ''): ?>
        <?php require_once 'L3P4/php/resultado.php'; ?>
    <?php endif; ?>
</div>

<?php require_once 'L3P4/html/footer.html'; ?>

<?php
require_once 'L3P4/php/Inventario.php';

$mensajeError  = '';
$mensajeExito  = '';
$erroresCampos = [];
$inv           = null;
$opcion        = '';

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
<link href="L3P4/css/estilos.css" rel="stylesheet">

<main class="main-content">
    <div class="container">
        <?php require_once 'L3P4/html/header.html'; ?>
        <?php require_once 'L3P4/php/formulario.php'; ?>
        <?php if ($inv !== null && $opcion !== ''): ?>
            <?php require_once 'L3P4/php/resultado.php'; ?>
        <?php endif; ?>
    </div>
</main>

<?php require_once 'L3P4/html/footer.html'; ?>

<?php
/**
 * PHP/formulario.php — Formulario de ingreso de la matriz 3×4.
 *
 * Variables esperadas desde L3P4.php:
 *  - $mensajeError   : string
 *  - $mensajeExito   : string
 *  - $erroresCampos  : array (campo => true)
 */
$sucursales = ['Centro', 'Norte', 'Oeste'];
$productos  = ['Laptops', 'Tablets', 'Smartphones', 'Accesorios'];
$iconos     = ['💻', '📱', '📲', '🎧'];
?>

<?php if (!empty($mensajeError)): ?>
    <div class="alert alert-danger">
        <span class="glyphicon glyphicon-remove-circle"></span>
        &nbsp;<?= htmlspecialchars($mensajeError) ?>
    </div>
<?php endif; ?>

<?php if (!empty($mensajeExito)): ?>
    <div class="alert alert-success">
        <span class="glyphicon glyphicon-ok-circle"></span>
        &nbsp;<?= htmlspecialchars($mensajeExito) ?>
    </div>
<?php endif; ?>

<div class="panel panel-default" id="formulario">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="glyphicon glyphicon-edit"></span> Ingresar Inventario por Sucursal
        </h4>
    </div>
    <div class="panel-body">
        <form method="POST" action="L3P4.php" id="form-inventario">

            <!-- Encabezado de columnas -->
            <div class="matrix-header">
                <div class="col-label-suc">Sucursal</div>
                <?php foreach ($productos as $k => $prod): ?>
                    <div class="col-label-prod"><?= $iconos[$k] ?> <?= $prod ?></div>
                <?php endforeach; ?>
            </div>

            <!-- Filas de la matriz -->
            <?php foreach ($sucursales as $i => $suc): ?>
                <div class="matrix-row">
                    <div class="row-suc-label"><?= $suc ?></div>
                    <?php foreach ($productos as $j => $prod): ?>
                        <?php
                            $campo      = "m{$i}{$j}";
                            $valor      = htmlspecialchars($_POST[$campo] ?? '');
                            $claseError = isset($erroresCampos[$campo]) ? 'input-error' : '';
                        ?>
                        <input type="number"
                               name="<?= $campo ?>"
                               id="<?= $campo ?>"
                               class="form-control input-matrix <?= $claseError ?>"
                               min="0" placeholder=""
                               value="<?= $valor ?>">
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <hr>

            <div class="row">
                <div class="col-sm-7">
                    <div class="form-group">
                        <label for="sel-operacion" class="control-label">
                            <span class="glyphicon glyphicon-list"></span>
                            Operación a mostrar
                        </label>
                        <select name="operacion" id="sel-operacion" class="form-control">
                            <option value="">-- Elegir opción --</option>
                            <option value="1" <?= (($_POST['operacion'] ?? '') == '1') ? 'selected' : '' ?>>
                                1. Mostrar la matriz completa
                            </option>
                            <option value="2" <?= (($_POST['operacion'] ?? '') == '2') ? 'selected' : '' ?>>
                                2. Total por Sucursal
                            </option>
                            <option value="3" <?= (($_POST['operacion'] ?? '') == '3') ? 'selected' : '' ?>>
                                3. Total por Tipo de Producto
                            </option>
                            <option value="4" <?= (($_POST['operacion'] ?? '') == '4') ? 'selected' : '' ?>>
                                4. Sucursal con mayor inventario
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5" style="padding-top:25px;">
                    <button type="submit" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-play"></span>
                        Calcular
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

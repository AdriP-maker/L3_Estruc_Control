<?php
/**
 * PHP/formulario.php
 * ──────────────────────────────────────────────
 * Formulario de ingreso de la matriz 3×4.
 * Preserva los valores del $_POST al recargar.
 *
 * Variables esperadas desde L3P4.php:
 *  - $mensajeError   : string (vacío si no hay error)
 *  - $mensajeExito   : string (vacío si no hay éxito)
 *  - $erroresCampos  : array  (mapa campo => true para marcar en rojo)
 */

$sucursales = ['Centro', 'Norte', 'Oeste'];
$productos  = ['Laptops', 'Tablets', 'Smartphones', 'Accesorios'];
$iconos     = ['💻', '📱', '📲', '🎧'];
?>

<!-- =============================================
     PHP/formulario.php
     Formulario de ingreso con validación
     ============================================= -->
<div class="panel-dark" id="formulario">
  <div class="panel-heading">
    <span class="glyphicon glyphicon-edit"></span>
    &nbsp; Ingresar Inventario por Sucursal
  </div>
  <div class="panel-body">

    <!-- Alertas de validación -->
    <?php if (!empty($mensajeError)): ?>
      <div class="alerta alerta-danger">
        <span class="glyphicon glyphicon-remove-circle"></span>
        &nbsp;<?= htmlspecialchars($mensajeError) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($mensajeExito)): ?>
      <div class="alerta alerta-success">
        <span class="glyphicon glyphicon-ok-circle"></span>
        &nbsp;<?= htmlspecialchars($mensajeExito) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="L3P4.php" id="form-inventario">

      <!-- Encabezado de columnas -->
      <div class="matrix-header">
        <div class="col-label-suc">Sucursal</div>
        <?php foreach ($productos as $k => $prod): ?>
          <div class="col-label-prod"><?= $iconos[$k] ?> <?= $prod ?></div>
        <?php endforeach; ?>
      </div>

      <!-- Filas de la matriz (foreach sobre sucursales) -->
      <?php foreach ($sucursales as $i => $suc): ?>
        <div class="matrix-row">

          <div class="row-suc-label"><?= $suc ?></div>

          <!-- Inputs de cada producto (foreach sobre productos) -->
          <?php foreach ($productos as $j => $prod): ?>
            <?php
              $campo      = "m{$i}{$j}";
              $valor      = htmlspecialchars($_POST[$campo] ?? '');
              $claseError = isset($erroresCampos[$campo]) ? 'input-error' : '';
            ?>
            <input
              type="number"
              name="<?= $campo ?>"
              id="<?= $campo ?>"
              class="form-control input-matrix <?= $claseError ?>"
              min="0"
              placeholder="0"
              value="<?= $valor ?>"
            >
          <?php endforeach; ?>

        </div><!-- /matrix-row -->
      <?php endforeach; ?>

      <hr class="sep">

      <!-- SELECT de operaciones -->
      <div class="row">
        <div class="col-sm-7">
          <div class="form-group">
            <label class="control-label-dark">
              <span class="glyphicon glyphicon-list"></span>
              &nbsp;Seleccione la operación a mostrar
            </label>
            <select name="operacion" id="sel-operacion" class="form-control select-dark">
              <option value="">-- Elegir opción --</option>
              <option value="1" <?= (($_POST['operacion'] ?? '') == '1') ? 'selected' : '' ?>>
                1. Mostrar la matriz completa (tabla)
              </option>
              <option value="2" <?= (($_POST['operacion'] ?? '') == '2') ? 'selected' : '' ?>>
                2. Total de productos por Sucursal
              </option>
              <option value="3" <?= (($_POST['operacion'] ?? '') == '3') ? 'selected' : '' ?>>
                3. Total de productos por Tipo de Producto
              </option>
              <option value="4" <?= (($_POST['operacion'] ?? '') == '4') ? 'selected' : '' ?>>
                4. Sucursal con mayor inventario
              </option>
            </select>
          </div>
        </div>
        <div class="col-sm-5" style="padding-top:24px;">
          <button type="submit" class="btn btn-primary btn-block btn-enviar">
            <span class="glyphicon glyphicon-play"></span>
            &nbsp; Enviar / Calcular
          </button>
        </div>
      </div><!-- /row -->

    </form>
  </div><!-- /panel-body -->
</div><!-- /panel-dark -->

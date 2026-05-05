<?php
/**
 * PHP/resultado.php
 * ──────────────────────────────────────────────
 * Muestra el resultado de la operación elegida en formato tabular.
 *
 * Variables esperadas desde L3P4.php:
 *  - $inv    : instancia de Inventario (ya validada)
 *  - $opcion : string '1'|'2'|'3'|'4'
 */
if (!isset($inv) || !isset($opcion) || $opcion === '') return;

$sucursales = $inv->getSucursales();
$productos  = $inv->getProductos();
$iconos     = ['💻', '📱', '📲', '🎧'];
$matriz     = $inv->getMatriz();
?>

<!-- =============================================
     PHP/resultado.php
     Tablas de resultado según opción elegida
     ============================================= -->
<div class="panel-dark" id="resultado">
  <div class="panel-heading">
    <span class="glyphicon glyphicon-stats"></span>
    &nbsp; Resultado — Opción <?= htmlspecialchars($opcion) ?>
  </div>
  <div class="panel-body">

    <?php
    // ── Opción 1: Matriz completa ─────────────────────────
    if ($opcion === '1'):
      $totalesSuc = $inv->totalesPorSucursal();
    ?>
      <p class="resultado-titulo">// Matriz Completa de Inventario (3 sucursales × 4 productos)</p>
      <div class="table-responsive">
        <table class="table-dark-custom">
          <thead>
            <tr>
              <th>Sucursal</th>
              <?php foreach ($productos as $k => $prod): ?>
                <th><?= $iconos[$k] ?> <?= $prod ?></th>
              <?php endforeach; ?>
              <th class="th-total">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sucursales as $i => $suc): ?>
              <tr>
                <td class="td-suc"><?= $suc ?></td>
                <?php foreach ($matriz[$i] as $val): ?>
                  <td><?= $val ?></td>
                <?php endforeach; ?>
                <td class="td-total"><?= $totalesSuc[$i] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    <?php
    // ── Opción 2: Totales por Sucursal ────────────────────
    elseif ($opcion === '2'):
      $totalesSuc = $inv->totalesPorSucursal();
    ?>
      <p class="resultado-titulo">// Total de Productos por Sucursal (vector fila)</p>
      <div class="table-responsive">
        <table class="table-dark-custom">
          <thead>
            <tr><th>Sucursal</th><th class="th-total">Total de Productos</th></tr>
          </thead>
          <tbody>
            <?php foreach ($sucursales as $i => $suc): ?>
              <tr>
                <td class="td-suc"><?= $suc ?></td>
                <td class="td-total"><?= $totalesSuc[$i] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    <?php
    // ── Opción 3: Totales por Tipo de Producto ────────────
    elseif ($opcion === '3'):
      $totalesProd = $inv->totalesPorProducto();
    ?>
      <p class="resultado-titulo">// Total de Productos por Tipo (vector columna)</p>
      <div class="table-responsive">
        <table class="table-dark-custom">
          <thead>
            <tr><th>Tipo de Producto</th><th class="th-total">Total en todas las Sucursales</th></tr>
          </thead>
          <tbody>
            <?php foreach ($productos as $j => $prod): ?>
              <tr>
                <td class="td-suc"><?= $iconos[$j] ?> <?= $prod ?></td>
                <td class="td-total"><?= $totalesProd[$j] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    <?php
    // ── Opción 4: Sucursal con mayor inventario ───────────
    elseif ($opcion === '4'):
      $totalesSuc = $inv->totalesPorSucursal();
      $ganador    = $inv->sucursalMayorInventario();
    ?>
      <p class="resultado-titulo">// Sucursal con Mayor Inventario Total</p>
      <div class="table-responsive">
        <table class="table-dark-custom">
          <thead>
            <tr><th>Sucursal</th><th class="th-total">Total de Productos</th><th>Estado</th></tr>
          </thead>
          <tbody>
            <?php foreach ($sucursales as $i => $suc): ?>
              <?php $esGanador = ($i === $ganador['idx']); ?>
              <tr class="<?= $esGanador ? 'winner-row' : '' ?>">
                <td class="td-suc">
                  <?= $suc ?>
                  <?php if ($esGanador): ?>
                    <span class="winner-badge">★ MAYOR</span>
                  <?php endif; ?>
                </td>
                <td class="<?= $esGanador ? 'td-ganador' : 'td-total' ?>">
                  <?= $totalesSuc[$i] ?>
                </td>
                <td><?= $esGanador ? '🏆 Mayor inventario' : '—' ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="alerta alerta-success" style="margin-top:14px;">
        🏆 La sucursal <strong><?= $ganador['nombre'] ?></strong>
        tiene el mayor inventario con
        <strong><?= $ganador['total'] ?></strong> productos en total.
      </div>

    <?php endif; ?>

  </div><!-- /panel-body -->
</div><!-- /panel-dark -->

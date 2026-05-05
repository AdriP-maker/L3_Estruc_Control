<?php
/**
 * PHP/resultado.php — Tablas de resultado según opción elegida.
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

<div class="panel panel-default" id="resultado">
    <div class="panel-heading">
        <strong><span class="glyphicon glyphicon-stats"></span>
        Resultado — Opción <?= htmlspecialchars($opcion) ?></strong>
    </div>
    <div class="panel-body">

        <?php if ($opcion === '1'):
            $totalesSuc = $inv->totalesPorSucursal(); ?>

            <p class="resultado-titulo">// Matriz completa de inventario (3 sucursales × 4 productos)</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <?php foreach ($productos as $k => $prod): ?>
                                <th class="text-center"><?= $iconos[$k] ?> <?= $prod ?></th>
                            <?php endforeach; ?>
                            <th class="text-center text-success">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sucursales as $i => $suc): ?>
                            <tr>
                                <td><strong><?= $suc ?></strong></td>
                                <?php foreach ($matriz[$i] as $val): ?>
                                    <td class="text-center"><?= $val ?></td>
                                <?php endforeach; ?>
                                <td class="text-center text-primary"><strong><?= $totalesSuc[$i] ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($opcion === '2'):
            $totalesSuc = $inv->totalesPorSucursal(); ?>

            <p class="resultado-titulo">// Total de productos por sucursal (vector fila)</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th class="text-center text-success">Total de Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sucursales as $i => $suc): ?>
                            <tr>
                                <td><strong><?= $suc ?></strong></td>
                                <td class="text-center text-primary"><strong><?= $totalesSuc[$i] ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($opcion === '3'):
            $totalesProd = $inv->totalesPorProducto(); ?>

            <p class="resultado-titulo">// Total por tipo de producto (vector columna)</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tipo de Producto</th>
                            <th class="text-center text-success">Total en todas las sucursales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $j => $prod): ?>
                            <tr>
                                <td><?= $iconos[$j] ?> <strong><?= $prod ?></strong></td>
                                <td class="text-center text-primary"><strong><?= $totalesProd[$j] ?></strong></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php elseif ($opcion === '4'):
            $totalesSuc = $inv->totalesPorSucursal();
            $ganador    = $inv->sucursalMayorInventario(); ?>

            <p class="resultado-titulo">// Sucursal con mayor inventario total</p>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th class="text-center text-success">Total de Productos</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sucursales as $i => $suc):
                            $esGanador = ($i === $ganador['idx']); ?>
                            <tr class="<?= $esGanador ? 'winner-row' : '' ?>">
                                <td>
                                    <strong><?= $suc ?></strong>
                                    <?php if ($esGanador): ?>
                                        <span class="winner-badge">★ MAYOR</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center <?= $esGanador ? 'td-ganador' : 'text-primary' ?>">
                                    <strong><?= $totalesSuc[$i] ?></strong>
                                </td>
                                <td class="text-center"><?= $esGanador ? '🏆 Mayor inventario' : '—' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="alert alert-success" style="margin-top:10px;">
                🏆 La sucursal <strong><?= $ganador['nombre'] ?></strong>
                tiene el mayor inventario con
                <strong><?= $ganador['total'] ?></strong> productos en total.
            </div>

        <?php endif; ?>

    </div>
</div>

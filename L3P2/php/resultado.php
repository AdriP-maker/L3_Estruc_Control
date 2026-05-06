<?php
/**
 * Este archivo genera las tablas y paneles de resultado del Programa 2.
 * Variables esperadas desde L3P2.php:
 *   - $alumnos       : array de objetos Alumno (datos originales)
 *   - $alumnosOrd    : array de objetos Alumno (ordenados por promedio desc)
 *   - $opcion        : string '1'|'2'|'3'|'4' — operación seleccionada
 *
 * Usa: echo(), printf(), print(), foreach, for, if/elseif/else
 *
 * @author  Desarrollo de Software VII
 * @version 1.0
 * ================================================================
 */

// ── Verificación de seguridad: no ejecutar si faltan variables ──
if (!isset($alumnos) || !isset($opcion) || $opcion === '')
    return;
?>


<!-- ============================================================ -->
<!-- Inicia panel de resultados (Bootstrap 3 panel) -->
<!-- ============================================================ -->
<div class="panel panel-default" id="resultado">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="glyphicon glyphicon-stats"></span>
            Resultado &mdash; Opción <?= htmlspecialchars($opcion) ?>
        </h4>
    </div>
    <div class="panel-body">


        // Inicia estructura de control principal (if/elseif) para las 4 opciones

        <?php if ($opcion === '1'):
            // ============================================================
            // OPCIÓN 1: Información completa captada en el formulario
            // Muestra una tabla con todos los alumnos tal como fueron ingresados.
            // Usa foreach para recorrer el array de objetos Alumno.
            // ============================================================
            ?>

            <!-- Inicia tabla de información completa (sin ordenar) -->
            <p class="resultado-titulo">
                // Información completa captada en el formulario (<?= count($alumnos) ?> alumnos)
            </p>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre del Alumno</th>
                            <th class="text-center">Promedio</th>
                            <th class="text-center">Letra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ── Recorrido con foreach del array de objetos Alumno ──
                        $contador = 1;
                        foreach ($alumnos as $alumno):
                            ?>
                            <tr>
                                <td class="text-center"><?= $contador ?></td>
                                <td>
                                    <?php
                                    // Uso de echo() para imprimir el nombre
                                    echo htmlspecialchars($alumno->getNombre());
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    // Uso de printf() para formato con 1 decimal
                                    printf('%.1f', $alumno->getPromedio());
                                    ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge-letra badge-<?= $alumno->getLetra() ?>">
                                        <?php
                                        // Uso de print() para imprimir la letra
                                        print ($alumno->getLetra());
                                        ?>
                                    </span>
                                </td>
                            </tr>
                            <?php
                            $contador++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Termina tabla de información completa -->

        <?php elseif ($opcion === '2'):
            // ============================================================
            // OPCIÓN 2: Información ordenada por promedio (mayor a menor)
            // Muestra la tabla con los alumnos ordenados descendentemente.
            // El array $alumnosOrd ya viene ordenado desde L3P2.php.
            // ============================================================
            ?>

            <!-- Inicia tabla de información ordenada por promedio -->
            <p class="resultado-titulo">
                // Información ordenada por promedio de mayor a menor
            </p>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Pos.</th>
                            <th>Nombre del Alumno</th>
                            <th class="text-center">Promedio</th>
                            <th class="text-center">Letra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ── Recorrido con for del array ordenado ──
                        for ($i = 0; $i < count($alumnosOrd); $i++):
                            $alumno = $alumnosOrd[$i];
                            // Determinar si es el mejor (posición 0)
                            $esMejor = ($i === 0);
                            ?>
                            <tr class="<?= $esMejor ? 'winner-row' : '' ?>">
                                <td class="text-center">
                                    <?= ($i + 1) ?>
                                    <?php if ($esMejor): ?>
                                        <span class="winner-badge">★ 1°</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($alumno->getNombre()); ?></strong>
                                </td>
                                <td class="text-center <?= $esMejor ? 'td-ganador' : '' ?>">
                                    <strong><?php printf('%.1f', $alumno->getPromedio()); ?></strong>
                                </td>
                                <td class="text-center">
                                    <span class="badge-letra badge-<?= $alumno->getLetra() ?>">
                                        <?php print ($alumno->getLetra()); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
            <!-- Termina tabla de información ordenada por promedio -->


        <?php elseif ($opcion === '3'):
            // ============================================================
            // OPCIÓN 3: Estudiante con mejor rendimiento académico
            // El mejor estudiante es el primero del array ordenado.
            // Si hay empate, se muestran todos los que tengan el mismo promedio.
            // ============================================================
            $mejorPromedio = $alumnosOrd[0]->getPromedio();
            // ── Buscar todos los alumnos con el mismo mejor promedio ──
            $mejores = [];
            foreach ($alumnosOrd as $alumno) {
                if ($alumno->getPromedio() == $mejorPromedio) {
                    $mejores[] = $alumno;
                }
            }
            ?>

            <!-- Inicia panel del mejor estudiante -->
            <p class="resultado-titulo">
                // Estudiante<?= count($mejores) > 1 ? 's' : '' ?> con mejor rendimiento académico
            </p>

            <?php foreach ($mejores as $mejor): ?>
                <div class="mejor-estudiante">
                    <div class="icono-trofeo">
                        <span class="glyphicon glyphicon-star"></span>
                    </div>
                    <div class="nombre-mejor">
                        <?php
                        // Uso de echo() para el nombre del mejor estudiante
                        echo htmlspecialchars($mejor->getNombre());
                        ?>
                    </div>
                    <div class="prom-mejor">
                        Promedio final:
                        <?php
                        // Uso de printf() para imprimir el promedio formateado
                        printf('%.1f', $mejor->getPromedio());
                        ?>
                        &mdash;
                        <span class="badge-letra badge-<?= $mejor->getLetra() ?>">
                            <?php print ($mejor->getLetra()); ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Tabla comparativa para contexto -->
            <div class="table-responsive" style="margin-top:20px;">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Pos.</th>
                            <th>Nombre</th>
                            <th class="text-center">Promedio</th>
                            <th class="text-center">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($alumnosOrd as $idx => $alumno):
                            $esGanador = ($alumno->getPromedio() == $mejorPromedio);
                            ?>
                            <tr class="<?= $esGanador ? 'winner-row' : '' ?>">
                                <td class="text-center"><?= ($idx + 1) ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($alumno->getNombre()); ?></strong>
                                    <?php if ($esGanador): ?>
                                        <span class="winner-badge">★ MEJOR</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center <?= $esGanador ? 'td-ganador' : 'text-primary' ?>">
                                    <strong><?php printf('%.1f', $alumno->getPromedio()); ?></strong>
                                </td>
                                <td class="text-center">
                                    <?= $esGanador ? '🏆 Mejor rendimiento' : '—' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- ============================================================ -->
            <!-- Termina panel del mejor estudiante -->
            <!-- ============================================================ -->


        <?php elseif ($opcion === '4'):
            // ============================================================
            // OPCIÓN 4: Informe resumen con cantidad de alumnos por letra
            // Escala: A (91-100), B (81-90), C (71-80), D (61-70), F (0-60)
            // Usa un array asociativo para contar alumnos por letra.
            // ============================================================
        
            // ── Inicializar contadores por letra usando array asociativo ──
            $conteo = ['A' => 0, 'B' => 0, 'C' => 0, 'D' => 0, 'F' => 0];

            // ── Recorrer todos los alumnos y contar por letra con foreach ──
            foreach ($alumnos as $alumno) {
                $letra = $alumno->getLetra();
                $conteo[$letra]++;
            }

            $totalAlumnos = count($alumnos);

            // ── Rangos descriptivos de cada letra ──
            $rangos = [
                'A' => '91 – 100',
                'B' => '81 – 90',
                'C' => '71 – 80',
                'D' => '61 – 70',
                'F' => '0 – 60'
            ];
            ?>

            <!-- Inicia informe resumen por letras A/B/C/D/F -->
            <p class="resultado-titulo">
                // Informe resumen — Distribución de <?= $totalAlumnos ?> alumnos por rendimiento
            </p>

            <!-- Tabla con el conteo por letra -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Letra</th>
                            <th class="text-center">Rango</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // ── Recorrido con foreach del array asociativo de conteo ──
                        foreach ($conteo as $letra => $cantidad):
                            $porcentaje = ($totalAlumnos > 0)
                                ? round(($cantidad / $totalAlumnos) * 100, 1)
                                : 0;
                            ?>
                            <tr>
                                <td class="text-center">
                                    <span class="badge-letra badge-<?= $letra ?>">
                                        <?php echo $letra; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php print ($rangos[$letra]); ?>
                                </td>
                                <td class="text-center">
                                    <strong><?php echo $cantidad; ?></strong>
                                </td>
                                <td class="text-center">
                                    <?php printf('%.1f%%', $porcentaje); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Fila de total -->
                        <tr class="active">
                            <td class="text-center" colspan="2">
                                <strong>TOTAL</strong>
                            </td>
                            <td class="text-center">
                                <strong><?php echo $totalAlumnos; ?></strong>
                            </td>
                            <td class="text-center">
                                <strong>100%</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Gráfico de barras horizontal (visual) -->
            <p class="resultado-titulo" style="margin-top:20px;">
                // Gráfico de distribución por letra
            </p>
            <?php
            // ── Barras visuales usando foreach y cálculo de porcentaje ──
            foreach ($conteo as $letra => $cantidad):
                $porcentaje = ($totalAlumnos > 0)
                    ? round(($cantidad / $totalAlumnos) * 100, 1)
                    : 0;
                ?>
                <div class="barra-resumen">
                    <div class="letra-label">
                        <span class="badge-letra badge-<?= $letra ?>"><?= $letra ?></span>
                    </div>
                    <div class="barra-contenedor">
                        <div class="barra-relleno barra-<?= $letra ?>" style="width: <?= max($porcentaje, 2) ?>%;">
                        </div>
                    </div>
                    <div class="barra-cantidad">
                        <?php printf('%d (%.0f%%)', $cantidad, $porcentaje); ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Termina informe resumen por letras -->
        <?php endif; ?>
    </div>
</div>
<!-- Termina panel de resultados -->
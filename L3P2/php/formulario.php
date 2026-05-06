<?php
/**
 * Variables esperadas desde L3P2.php:
 *   - $mensajeError   : string — Mensaje de error del try-catch
 *   - $mensajeExito   : string — Mensaje de éxito tras procesar
 *   - $cantAlumnos    : int    — Cantidad de alumnos seleccionada
 */

// Inicia captura de la cantidad de alumnos enviada por POST
$cantAlumnos = (int) ($_POST['cantidad'] ?? 0);
// Termina captura de la cantidad de alumnos
?>


<!-- Inicia sección de mensajes de error y éxito (alerts Bootstrap 3) -->
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
<!-- Termina sección de mensajes de error y éxito -->


<!-- Inicia panel del formulario principal (Bootstrap 3 panel) -->
<div class="panel panel-default" id="formulario">
    <div class="panel-heading">
        <h4 class="panel-title">
            <span class="glyphicon glyphicon-education"></span>
            Captura de Datos de Alumnos
        </h4>
    </div>
    <div class="panel-body">

        <!-- Inicia formulario HTML — método POST, envía a L3P2.php -->
        <form method="POST" action="L3P2.php" id="form-alumnos">

            <!-- Inicia input de cantidad de alumnos (N) -->
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="input-cantidad" class="control-label">
                            <span class="glyphicon glyphicon-user"></span>
                            Cantidad de alumnos (N)
                        </label>
                        <input type="number" name="cantidad" id="input-cantidad" class="form-control"
                            placeholder="Ingrese la cantidad de alumnos" min="1" max="50"
                            value="<?= ($cantAlumnos > 0) ? $cantAlumnos : '' ?>" required>
                    </div>
                </div>
                <div class="col-sm-3" style="padding-top:25px;">
                    <button type="submit" name="btn_generar" class="btn btn-primary btn-block">
                        <span class="glyphicon glyphicon-plus"></span>
                        Generar campos
                    </button>
                </div>
            </div>
            <!-- Termina input de cantidad de alumnos -->


            <?php if ($cantAlumnos > 0): ?>
                <!-- Inicia campos dinámicos de alumnos (se muestran solo si N > 0) -->

                <hr>

                <!-- Encabezados de columna del formulario dinámico -->
                <div class="alumno-header">
                    <span class="lbl-num">#</span>
                    <span class="lbl-nombre">Nombre del Alumno</span>
                    <span class="lbl-prom">Promedio (0-100)</span>
                </div>

                <?php
                // Inicia ciclo for que genera N filas de inputs (nombre + promedio)
                // Cada fila tiene un número, un campo de texto y un campo numérico.
                // Los valores se persisten con $_POST para no perder datos al recargar.
                for ($i = 0; $i < $cantAlumnos; $i++):
                    // ── Recuperar valores del POST para persistencia ──
                    $nombreVal = htmlspecialchars($_POST["nombre_$i"] ?? '');
                    $promedioVal = htmlspecialchars($_POST["promedio_$i"] ?? '');
                    ?>
                    <!-- Fila del alumno #<?= ($i + 1) ?> -->
                    <div class="alumno-row">
                        <!-- Número de fila (badge circular verde) -->
                        <div class="alumno-num"><?= ($i + 1) ?></div>

                        <!-- Input de nombre del alumno (no permite números) -->
                        <input type="text" name="nombre_<?= $i ?>" id="nombre_<?= $i ?>" class="form-control alumno-nombre"
                            placeholder="Nombre del alumno <?= ($i + 1) ?>" value="<?= $nombreVal ?>"
                            pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Solo se permiten letras y espacios, no números"
                            oninput="this.value = this.value.replace(/[0-9]/g, '')" required>

                        <!-- Input de promedio del alumno (numérico, 0-100) -->
                        <input type="number" name="promedio_<?= $i ?>" id="promedio_<?= $i ?>"
                            class="form-control alumno-promedio" placeholder="0 – 100" min="0" max="100" step="0.1"
                            value="<?= $promedioVal ?>" required>
                    </div>
                <?php endfor; ?>
                <!-- Termina ciclo for de filas de inputs de alumnos -->

                <hr>

                <!-- Inicia selector de operación (qué resultado mostrar) -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="sel-operacion" class="control-label">
                                <span class="glyphicon glyphicon-list"></span>
                                Operación a mostrar
                            </label>
                            <select name="operacion" id="sel-operacion" class="form-control">
                                <option value="">-- Elegir opción --</option>
                                <option value="1" <?= (($_POST['operacion'] ?? '') == '1') ? 'selected' : '' ?>>
                                    1. Información completa captada
                                </option>
                                <option value="2" <?= (($_POST['operacion'] ?? '') == '2') ? 'selected' : '' ?>>
                                    2. Información ordenada por promedio (mayor a menor)
                                </option>
                                <option value="3" <?= (($_POST['operacion'] ?? '') == '3') ? 'selected' : '' ?>>
                                    3. Estudiante con mejor rendimiento
                                </option>
                                <option value="4" <?= (($_POST['operacion'] ?? '') == '4') ? 'selected' : '' ?>>
                                    4. Informe resumen A/B/C/D/F
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- Inicia botones de acción (Procesar y Limpiar) -->
                    <div class="col-sm-3" style="padding-top:25px;">
                        <button type="submit" name="btn_procesar" class="btn btn-success btn-block">
                            <span class="glyphicon glyphicon-play"></span>
                            Procesar
                        </button>
                    </div>
                    <div class="col-sm-3" style="padding-top:25px;">
                        <button type="button" class="btn btn-default btn-block" id="btn-limpiar"
                            onclick="window.location.href='L3P2.php?limpiar=1'">
                            <span class="glyphicon glyphicon-refresh"></span>
                            Limpiar
                        </button>
                    </div>
                    <!-- Termina botones de acción -->
                </div>
                <!-- Termina selector de operación -->
            <?php endif; ?>
            <!-- Termina campos dinámicos de alumnos -->
        </form>
        <!-- Termina formulario HTML -->

    </div>
</div>
<!-- Termina panel del formulario principal -->
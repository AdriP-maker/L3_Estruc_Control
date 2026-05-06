<?php
// Verifica la existencia de los datos necesarios antes de procesar
if (!isset($_POST["calcular"]) || !isset($_POST["ventas"])) {
    return;
}

// Inicialización de variables basadas en la entrada del formulario
$ventas = $_POST["ventas"];
$meses = (int)$_POST["meses"];
$opcion = $_POST["opcion"];

echo "<div class='resultado-php'>";

// Estructura de control para determinar el tipo de reporte a generar
switch ($opcion) {
    case "tabla":
        // Genera una matriz completa con todos los datos ingresados
        echo "<h3>Resumen Completo de Ventas</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Departamento</th>";
        for ($i = 1; $i <= $meses; $i++) echo "<th>Mes $i</th>";
        echo "</tr></thead><tbody>";
        foreach ($ventas as $depto => $valores) {
            echo "<tr><td><strong>$depto</strong></td>";
            foreach ($valores as $v) {
                echo "<td>$ " . number_format((float)$v, 2) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
        break;

    case "totdep":
        // Calcula y muestra la sumatoria total por cada departamento
        echo "<h3>Total Acumulado por Departamento</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Departamento</th><th>Total</th></tr></thead><tbody>";
        foreach ($ventas as $depto => $valores) {
            echo "<tr><td><strong>$depto</strong></td><td>$ " . number_format(array_sum($valores), 2) . "</td></tr>";
        }
        echo "</tbody></table>";
        break;

    case "totmes":
        // Suma las ventas de todos los departamentos correspondientes a un mismo mes
        echo "<h3>Ventas Consolidadas por Mes</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Mes</th><th>Monto Total</th></tr></thead><tbody>";
        for ($i = 0; $i < $meses; $i++) {
            $columna = array_column($ventas, $i);
            $sumaMes = array_sum($columna);
            echo "<tr><td>Mes " . ($i + 1) . "</td><td>$ " . number_format($sumaMes, 2) . "</td></tr>";
        }
        echo "</tbody></table>";
        break;

    case "total":
        // Realiza la sumatoria global de todas las celdas de la matriz
        $totalGeneral = 0;
        foreach ($ventas as $v) $totalGeneral += array_sum($v);
        echo "<h3>Balance General</h3>";
        echo "<table class='tabla-resultados'><tr><th style='background:#27ae60'>Venta Total Global</th><td class='gran-total'>$ " . number_format($totalGeneral, 2) . "</td></tr></table>";
        break;

    case "mayordep":
        // Identifica el departamento con la cifra de ventas más alta
        $max = -1; $nombre = "";
        foreach ($ventas as $depto => $valores) {
            $suma = array_sum($valores);
            if ($suma > $max) { $max = $suma; $nombre = $depto; }
        }
        echo "<h3>Departamento con Mayor Rendimiento</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Líder</th><th>Monto Máximo</th></tr></thead><tbody>";
        echo "<tr><td><strong>$nombre</strong></td><td>$ " . number_format($max, 2) . "</td></tr>";
        echo "</tbody></table>";
        break;

    case "mayormes":
        // Determina cuál de los meses registrados obtuvo el mayor volumen de ventas
        $max = -1; $mesMax = 0;
        for ($i = 0; $i < $meses; $i++) {
            $suma = array_sum(array_column($ventas, $i));
            if ($suma > $max) { $max = $suma; $mesMax = $i + 1; }
        }
        echo "<h3>Mes con Mayor Flujo</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Mes</th><th>Venta Lograda</th></tr></thead><tbody>";
        echo "<tr><td><strong>Mes $mesMax</strong></td><td>$ " . number_format($max, 2) . "</td></tr>";
        echo "</tbody></table>";
        break;
}

echo "</div>";
?>
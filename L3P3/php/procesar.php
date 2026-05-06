<?php
/**
 * Clase ProcesadorVentas
 * Se encarga de la lógica de cálculo y generación de tablas HTML
 * para el reporte de ventas por departamento.
 */
class ProcesadorVentas {
    // Propiedades privadas para almacenar los datos de entrada
    private $ventas;
    private $meses;

    /**
     * Constructor: Inicializa los datos recibidos
     */
    public function __construct($ventas, $meses) {
        $this->ventas = $ventas;
        $this->meses = (int)$meses;
    }

    /**
     * Método principal que decide qué reporte imprimir según la opción seleccionada
     */
    public function generarReporte($opcion) {
        echo "<div class='resultado-php'>";
        switch ($opcion) {
            case "tabla":
                $this->renderTablaCompleta();
                break;
            case "totdep":
                $this->renderTotalDepartamento();
                break;
            case "totmes":
                $this->renderTotalMes();
                break;
            case "total":
                $this->renderTotalGeneral();
                break;
            case "mayordep":
                $this->renderMayorDepartamento();
                break;
            case "mayormes":
                $this->renderMayorMes();
                break;
        }
        echo "</div>";
    }

    /**
     * Genera la tabla con todos los datos originales formateados
     */
    private function renderTablaCompleta() {
        echo "<h3>Resumen Completo de Ventas</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Departamento</th>";
        for ($i = 1; $i <= $this->meses; $i++) echo "<th>Mes $i</th>";
        echo "</tr></thead><tbody>";
        foreach ($this->ventas as $depto => $valores) {
            echo "<tr><td><strong>$depto</strong></td>";
            foreach ($valores as $v) {
                echo "<td>$ " . number_format((float)$v, 2) . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    /**
     * Calcula y muestra el total de ventas acumulado por cada departamento
     */
    private function renderTotalDepartamento() {
        echo "<h3>Total Acumulado por Departamento</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Departamento</th><th>Inversión Total</th></tr></thead><tbody>";
        foreach ($this->ventas as $depto => $valores) {
            echo "<tr><td><strong>$depto</strong></td><td>$ " . number_format(array_sum($valores), 2) . "</td></tr>";
        }
        echo "</tbody></table>";
    }

    /**
     * Suma las ventas de todos los departamentos columna por columna (por mes)
     */
    private function renderTotalMes() {
        echo "<h3>Ventas Consolidadas por Mes</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Período</th><th>Monto Total</th></tr></thead><tbody>";
        for ($i = 0; $i < $this->meses; $i++) {
            $sumaMes = array_sum(array_column($this->ventas, $i));
            echo "<tr><td>Mes " . ($i + 1) . "</td><td>$ " . number_format($sumaMes, 2) . "</td></tr>";
        }
        echo "</tbody></table>";
    }

    /**
     * Realiza la sumatoria global de todos los valores ingresados
     */
    private function renderTotalGeneral() {
        $totalGeneral = 0;
        foreach ($this->ventas as $v) $totalGeneral += array_sum($v);
        echo "<h3>Balance General</h3>";
        echo "<table class='tabla-resultados'><tr><th style='background:#27ae60'>Venta Total Global</th><td class='gran-total'>$ " . number_format($totalGeneral, 2) . "</td></tr></table>";
    }

    /**
     * Identifica el departamento con el mayor volumen de ventas acumulado
     */
    private function renderMayorDepartamento() {
        $max = -1; $nombre = "";
        foreach ($this->ventas as $depto => $valores) {
            $suma = array_sum($valores);
            if ($suma > $max) { $max = $suma; $nombre = $depto; }
        }
        echo "<h3>Departamento con Mayor Rendimiento</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Líder</th><th>Monto Máximo</th></tr></thead><tbody>";
        echo "<tr><td><strong>$nombre</strong></td><td>$ " . number_format($max, 2) . "</td></tr>";
        echo "</tbody></table>";
    }

    /**
     * Determina qué mes tuvo el mejor rendimiento sumando todos los departamentos
     */
    private function renderMayorMes() {
        $max = -1; $mesMax = 0;
        for ($i = 0; $i < $this->meses; $i++) {
            $suma = array_sum(array_column($this->ventas, $i));
            if ($suma > $max) { $max = $suma; $mesMax = $i + 1; }
        }
        echo "<h3>Mes con Mayor Flujo de Caja</h3>";
        echo "<table class='tabla-resultados'><thead><tr><th>Mes</th><th>Venta Lograda</th></tr></thead><tbody>";
        echo "<tr><td><strong>Mes $mesMax</strong></td><td>$ " . number_format($max, 2) . "</td></tr>";
        echo "</tbody></table>";
    }
}

// --- LÓGICA DE EJECUCIÓN ---
// Se activa solo si se detecta una petición válida desde el formulario
if (isset($_POST["calcular"]) && isset($_POST["ventas"])) {
    // Instancia de la clase con los datos de la petición
    $procesador = new ProcesadorVentas($_POST["ventas"], $_POST["meses"]);
    // Llamada al método para procesar y mostrar el HTML resultante
    $procesador->generarReporte($_POST["opcion"]);
}
?>
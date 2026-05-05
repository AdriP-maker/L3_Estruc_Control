<?php
/**
 * PHP/Inventario.php
 * ──────────────────────────────────────────────
 * Clase que encapsula toda la lógica del inventario.
 * Se incluye desde L3P4.php con require_once.
 *
 * @author  Desarrollo de Software VII
 * @version 1.0
 */
class Inventario {

    /** @var array Matriz 3x4 con los datos de inventario */
    private array $matriz;

    /** @var array Nombres de las sucursales (filas) */
    private array $sucursales = ['Centro', 'Norte', 'Oeste'];

    /** @var array Tipos de productos (columnas) */
    private array $productos = ['Laptops', 'Tablets', 'Smartphones', 'Accesorios'];

    /**
     * Constructor
     * @param array $datos Array bidimensional [3][4] recibido del formulario
     */
    public function __construct(array $datos) {
        $this->matriz = $datos;
    }

    // ─────────────────────────────────────────────
    //  VALIDACIÓN
    // ─────────────────────────────────────────────

    /**
     * Valida que todos los valores sean numéricos y >= 0
     * @throws InvalidArgumentException si algún valor es inválido
     * @return bool true si todo es válido
     */
    public function validar(): bool {
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $val = $this->matriz[$i][$j];

                if (!is_numeric($val)) {
                    throw new InvalidArgumentException(
                        "El valor en {$this->sucursales[$i]} / {$this->productos[$j]} no es numérico."
                    );
                }
                if ((float)$val < 0) {
                    throw new InvalidArgumentException(
                        "El valor en {$this->sucursales[$i]} / {$this->productos[$j]} debe ser ≥ 0."
                    );
                }
            }
        }
        return true;
    }

    // ─────────────────────────────────────────────
    //  GETTERS
    // ─────────────────────────────────────────────

    /** @return array Matriz completa como enteros */
    public function getMatriz(): array {
        return array_map(
            fn($fila) => array_map('intval', $fila),
            $this->matriz
        );
    }

    /** @return array Nombres de sucursales */
    public function getSucursales(): array { return $this->sucursales; }

    /** @return array Nombres de productos */
    public function getProductos(): array { return $this->productos; }

    // ─────────────────────────────────────────────
    //  CÁLCULOS
    // ─────────────────────────────────────────────

    /**
     * Total por sucursal — suma de cada fila
     * @return array Vector [3] con totales
     */
    public function totalesPorSucursal(): array {
        $totales = [];
        foreach ($this->getMatriz() as $fila) {
            $totales[] = array_sum($fila);
        }
        return $totales;
    }

    /**
     * Total por tipo de producto — suma de cada columna
     * @return array Vector [4] con totales
     */
    public function totalesPorProducto(): array {
        $totales = [0, 0, 0, 0];
        $m = $this->getMatriz();
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 4; $j++) {
                $totales[$j] += $m[$i][$j];
            }
        }
        return $totales;
    }

    /**
     * Sucursal con mayor inventario total
     * @return array ['nombre' => string, 'total' => int, 'idx' => int]
     */
    public function sucursalMayorInventario(): array {
        $totales = $this->totalesPorSucursal();
        $maxIdx  = 0;
        for ($i = 1; $i < count($totales); $i++) {
            if ($totales[$i] > $totales[$maxIdx]) $maxIdx = $i;
        }
        return [
            'nombre' => $this->sucursales[$maxIdx],
            'total'  => $totales[$maxIdx],
            'idx'    => $maxIdx
        ];
    }
}

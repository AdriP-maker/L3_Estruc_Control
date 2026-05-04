<?php require_once 'php/menu.php'; ?>

<main class="main-content">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="display-5 fw-bold mb-3">Laboratorio 3</h1>
            <p class="lead text-muted">POO &bull; Estructuras de Control &bull; Arreglos &bull; Formularios</p>
            <hr class="my-4 w-50 mx-auto">
        </div>

        <div class="row g-4 justify-content-center mb-5">
            <!-- Tarjeta P1 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-cart3 fs-1 text-primary mb-3 d-block"></i>
                        <h5 class="card-title fw-bold">Programa 1</h5>
                        <p class="card-text text-muted small">Almacén de computadoras con arreglos y factura</p>
                        <a href="L3P1.php" class="btn btn-primary btn-sm mt-2">
                            <i class="bi bi-arrow-right-circle me-1"></i>Abrir
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta P2 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-mortarboard fs-1 text-success mb-3 d-block"></i>
                        <h5 class="card-title fw-bold">Programa 2</h5>
                        <p class="card-text text-muted small">Promedios de alumnos ordenados de mayor a menor</p>
                        <a href="L3P2.php" class="btn btn-success btn-sm mt-2">
                            <i class="bi bi-arrow-right-circle me-1"></i>Abrir
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta P3 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-graph-up fs-1 text-warning mb-3 d-block"></i>
                        <h5 class="card-title fw-bold">Programa 3</h5>
                        <p class="card-text text-muted small">Ventas mensuales por departamento</p>
                        <a href="L3P3.php" class="btn btn-warning btn-sm mt-2">
                            <i class="bi bi-arrow-right-circle me-1"></i>Abrir
                        </a>
                    </div>
                </div>
            </div>
            <!-- Tarjeta P4 -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 shadow-sm border-0 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-grid-3x3 fs-1 text-danger mb-3 d-block"></i>
                        <h5 class="card-title fw-bold">Programa 4</h5>
                        <p class="card-text text-muted small">Inventario de productos por sucursal (matriz 3×4)</p>
                        <a href="L3P4.php" class="btn btn-danger btn-sm mt-2">
                            <i class="bi bi-arrow-right-circle me-1"></i>Abrir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'php/footer.php'; ?>

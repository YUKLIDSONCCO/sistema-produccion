<?php include __DIR__ . '/../../../templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">🐟 Panel de Peces - CORAQUA</h2>

    <div class="row">
        <!-- BPA 01 - Control de Peces -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📋 FORMATO N°01</h5>
                    <p class="card-text">Control y Registro de Peces</p>
                    <a href="#" class="btn btn-primary w-100">Abrir</a>
                </div>
            </div>
        </div>

        <!-- BPA 02 - Seguimiento de Crecimiento -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📈 FORMATO N°02</h5>
                    <p class="card-text">Seguimiento de Crecimiento</p>
                    <a href="#" class="btn btn-primary w-100">Abrir</a>
                </div>
            </div>
        </div>

        <!-- BPA 03 - Clasificación -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🔎 FORMATO N°03</h5>
                    <p class="card-text">Clasificación de Peces</p>
                    <a href="#" class="btn btn-primary w-100">Abrir</a>
                </div>
            </div>
        </div>

        <!-- Puedes agregar más BPAs según tu lista -->
    </div>

    <div class="text-center mt-5">
        <a href="index.php?controller=JefePlanta&action=dashboard" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
</div>

<?php include __DIR__ . '/../../../templates/footer.php'; ?>

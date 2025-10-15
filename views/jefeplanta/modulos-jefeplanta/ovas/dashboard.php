<?php include __DIR__ . '/../../../templates/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">🥚 Panel de Ovas - CORAQUA</h2>

    <div class="row">
        <!-- BPA 04 - Control de Ovas Embrionadas -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📋 FORMATO N°04</h5>
                    <p class="card-text">Control de Ovas Embrionadas</p>
                    <a href="#" class="btn btn-primary w-100">Abrir</a>
                </div>
            </div>
        </div>

        <!-- BPA 05 - Registro de Incubación -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🧫 FORMATO N°05</h5>
                    <p class="card-text">Registro de Incubación</p>
                    <a href="#" class="btn btn-primary w-100">Abrir</a>
                </div>
            </div>
        </div>

        <!-- BPA 06 - Reincubación -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">♻️ FORMATO N°06</h5>
                    <p class="card-text">Control de Reincubación</p>
                    <a href="#" class="btn btn-primary w-100">Abrir</a>
                </div>
            </div>
        </div>

        <!-- Puedes agregar más BPAs relacionados a ovas aquí -->
    </div>

    <div class="text-center mt-5">
        <a href="index.php?controller=JefePlanta&action=dashboard" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Volver al Panel Principal
        </a>
    </div>
</div>

<?php include __DIR__ . '/../../../templates/footer.php'; ?>

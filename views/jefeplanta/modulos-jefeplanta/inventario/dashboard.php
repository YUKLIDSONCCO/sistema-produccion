<?php include __DIR__ . '/../../../templates/header.php'; ?>

<div class="container-fluid bg-light min-vh-100 py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark">📦 Panel de Inventario - CORAQUA</h2>
            <a href="index.php?controller=JefePlanta&action=index" class="btn btn-outline-secondary">
                ⬅ Volver al Panel Principal
            </a>
        </div>

        <div class="text-muted mb-5">
            <p class="fs-5">Selecciona un formato BPA para gestionar los registros de inventario, alimentación, medicamentos y suplementos.</p>
        </div>

        <div class="row g-4">
            <!-- BPA 7 -->
            <div class="col-md-6 col-lg-4">
                <a href="index.php?controller=Inventario&action=bpa7" class="text-decoration-none">
                    <div class="card bpa-card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-orange">🧾 BPA N°07</h5>
                            <p class="text-muted mb-2">ALIMENTACIÓN DIARIA</p>
                            <small class="text-secondary d-block mb-2">CÓDIGO: CORAQUA BPA-7</small>
                            <span class="badge bg-orange text-white">Versión 2.0</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- BPA 8 -->
            <div class="col-md-6 col-lg-4">
                <a href="index.php?controller=Inventario&action=bpa8" class="text-decoration-none">
                    <div class="card bpa-card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-orange">📦 BPA N°08</h5>
                            <p class="text-muted mb-2">CONTROL DE ALIMENTO EN ALMACÉN</p>
                            <small class="text-secondary d-block mb-2">CÓDIGO: CORAQUA BPA-8</small>
                            <span class="badge bg-orange text-white">Versión 2.0</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- BPA 13 -->
            <div class="col-md-6 col-lg-4">
                <a href="index.php?controller=Inventario&action=bpa13" class="text-decoration-none">
                    <div class="card bpa-card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-orange">🧂 BPA N°13</h5>
                            <p class="text-muted mb-2">CONTROL DE SAL EN ALMACÉN</p>
                            <small class="text-secondary d-block mb-2">CÓDIGO: CORAQUA BPA-13</small>
                            <span class="badge bg-orange text-white">Versión 2.0</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- BPA 14 -->
            <div class="col-md-6 col-lg-4">
                <a href="index.php?controller=Inventario&action=bpa14" class="text-decoration-none">
                    <div class="card bpa-card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-orange">💊 BPA N°14</h5>
                            <p class="text-muted mb-2">CONTROL DE MEDICAMENTO</p>
                            <small class="text-secondary d-block mb-2">CÓDIGO: CORAQUA BPA-14</small>
                            <span class="badge bg-orange text-white">Versión 2.0</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- BPA 16 -->
            <div class="col-md-6 col-lg-4">
                <a href="index.php?controller=Inventario&action=bpa16" class="text-decoration-none">
                    <div class="card bpa-card shadow-sm border-0 rounded-4 p-4 h-100">
                        <div class="card-body text-center">
                            <h5 class="fw-bold text-orange">⚗️ BPA N°16</h5>
                            <p class="text-muted mb-2">DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS</p>
                            <small class="text-secondary d-block mb-2">CÓDIGO: CORAQUA BPA-16</small>
                            <span class="badge bg-orange text-white">Versión 2.0</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --orange: #ff7e00;
        --soft-blue: #005b96;
    }

    .text-orange {
        color: var(--orange);
    }

    .bg-orange {
        background-color: var(--orange);
    }

    .bpa-card {
        transition: all 0.3s ease-in-out;
        background: white;
        border-top: 4px solid var(--orange);
    }

    .bpa-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-top: 4px solid var(--soft-blue);
    }

    body {
        background-color: #f5f6fa;
    }
</style>

<?php include __DIR__ . '/../../../templates/footer.php'; ?>

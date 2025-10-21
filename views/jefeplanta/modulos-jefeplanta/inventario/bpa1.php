<?php 
include __DIR__ . '/../../../templates/header.php'; 
?>
<link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<div class="dashboard-container">

    <aside class="sidebar">
        <div class="logo">CORAQUA</div>
        <nav class="main-nav">
            <ul>
                <li class="active"><i class="fas fa-box-open"></i> Inventario</li>
                <li><i class="fas fa-file-alt"></i> BPA-01 Alimentación Diaria</li>
                <li><i class="fas fa-warehouse"></i> BPA-08 Control Almacén</li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        <header class="dashboard-header">
            <h1>FORMATO N°07 - ALIMENTACIÓN DIARIA</h1>
            <div class="header-info">
                <span>CÓDIGO: CORAQUA BPA-7 | VERSIÓN: 2.0 | FECHA: 03/08/2020</span>
                <a href="index.php?controller=Inventario&action=index" class="btn btn-outline-secondary">⬅ Volver al Panel</a>
            </div>
        </header>

        <section class="bpa-table-section">
            <table class="bpa1-table">
                <thead>
                    <tr>
                        <th colspan="7">RESPONSABLE:</th>
                        <th colspan="7">FECHA:</th>
                        <th colspan="7">SEDE:</th>
                    </tr>
                    <tr>
                        <th>UP</th>
                        <th>LOTE</th>
                        <th>BIOMASA</th>
                        <th>T.A. (%)</th>
                        <th>AL. SUM (KG)</th>
                        <th>CALIBRE</th>
                        <th>OBS.</th>

                        <th>UP</th>
                        <th>LOTE</th>
                        <th>BIOMASA</th>
                        <th>T.A. (%)</th>
                        <th>AL. SUM (KG)</th>
                        <th>CALIBRE</th>
                        <th>OBS.</th>

                        <th>UP</th>
                        <th>LOTE</th>
                        <th>BIOMASA</th>
                        <th>T.A. (%)</th>
                        <th>AL. SUM (KG)</th>
                        <th>CALIBRE</th>
                        <th>OBS.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=0; $i<10; $i++): ?>
                    <tr>
                        <?php for($j=0; $j<21; $j++): ?>
                            <td contenteditable="true"></td>
                        <?php endfor; ?>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>

            <div class="table-actions" style="text-align:center; margin-top:20px;">
                <a href="index.php?controller=Inventario&action=guardarBpa1" 
                   class="btn btn-primary">💾 Guardar Registro BPA N°07</a>
            </div>
        </section>
    </main>
</div>

<?php 
include __DIR__ . '/../../../templates/footer.php'; 
?>

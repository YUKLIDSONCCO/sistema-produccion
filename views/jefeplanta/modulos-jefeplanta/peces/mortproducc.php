<?php
// views/jefeplanta/modulos-jefeplanta/mortproducc.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte de Mortalidad</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <main class="main-content">
    <header class="header">
      <h2>Reporte de Mortalidad</h2>
      <div class="header-actions">
        <button class="btn-export"><i class="fas fa-file-excel"></i> Exportar Excel</button>
        <button class="btn-export"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
      </div>
    </header>

    <section class="dashboard">
      <table class="data-table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Tanque</th>
            <th>Cantidad Muerta</th>
            <th>Causa</th>
            <th>Responsable</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>2025-10-20</td><td>Tanque A</td><td>5</td><td>Falta de oxígeno</td><td>Raúl Gómez</td></tr>
          <tr><td>2025-10-21</td><td>Tanque B</td><td>3</td><td>Alta temperatura</td><td>Carla Núñez</td></tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>

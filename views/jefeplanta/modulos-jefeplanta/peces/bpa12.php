<?php
// views/jefeplanta/modulos-jefeplanta/bpa12.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPA 12 - Control de Crecimiento</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <main class="main-content">
    <header class="header">
      <h2>BPA 12 - Control de Crecimiento</h2>
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
            <th>Peso Promedio (g)</th>
            <th>Longitud (cm)</th>
            <th>Responsable</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>2025-10-20</td><td>Tanque A</td><td>250</td><td>18</td><td>José Vega</td></tr>
          <tr><td>2025-10-21</td><td>Tanque B</td><td>300</td><td>20</td><td>Laura Soto</td></tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>

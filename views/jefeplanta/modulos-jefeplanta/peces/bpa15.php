<?php
// views/jefeplanta/modulos-jefeplanta/bpa15.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPA 15 - Registro de Áreas</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <?php include 'sidebar.php'; ?>

  <main class="main-content">
    <header class="header">
      <h2>BPA 15 - Registro de Áreas</h2>
      <div class="header-actions">
        <button class="btn-export"><i class="fas fa-file-excel"></i> Exportar Excel</button>
        <button class="btn-export"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
      </div>
    </header>

    <section class="dashboard">
      <table class="data-table">
        <thead>
          <tr>
            <th>ID Área</th>
            <th>Nombre</th>
            <th>Ubicación</th>
            <th>Estado</th>
            <th>Responsable</th>
          </tr>
        </thead>
        <tbody>
          <tr><td>001</td><td>Área Norte</td><td>Sector 1</td><td>Activa</td><td>Marcos Torres</td></tr>
          <tr><td>002</td><td>Área Sur</td><td>Sector 3</td><td>En Mantenimiento</td><td>Lucía Ramos</td></tr>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>

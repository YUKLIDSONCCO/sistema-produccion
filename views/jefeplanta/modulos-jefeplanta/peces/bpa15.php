<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CORAQUA BPA 15 - Control Sanitario en Alevines</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_inventario.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
      display: flex;
    }

    /* === SIDEBAR === */
    .sidebar {
      width: 240px;
      background: #fff;
      border-right: 1px solid #ccc;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      overflow-y: auto;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
      z-index: 100;
    }

    .sidebar-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px 20px;
      border-bottom: 1px solid #eee;
    }

    .sidebar-header .logo {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: bold;
      font-size: 16px;
    }

    .sidebar-header .logo i {
      color: #007bff;
    }

    .sidebar-nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-nav ul li a {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 20px;
      text-decoration: none;
      color: #333;
      font-size: 15px;
      transition: 0.3s;
    }

    .sidebar-nav ul li a:hover,
    .sidebar-nav ul li a.active {
      background: #007bff;
      color: #fff;
    }

    /* === CONTENIDO === */
    .container {
      background: #fff;
      max-width: 1200px;
      margin: 30px auto;
      padding: 20px 30px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-left: 270px;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    header .logo img {
      width: 80px;
    }

    header .info {
      text-align: center;
      flex: 1;
    }

    header .info h2 {
      margin: 0;
      font-size: 16px;
    }

    header .info h3 {
      margin: 5px 0 0;
      font-size: 14px;
    }

    header .details {
      font-size: 13px;
      border: 1px solid #ccc;
      padding: 8px 12px;
      border-radius: 4px;
      background: #f4f4f4;
    }

    .meta {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      font-size: 14px;
      margin-bottom: 15px;
      background: #fffcaa;
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 4px;
    }

    .meta div {
      flex: 1 1 45%;
      margin-bottom: 8px;
    }

    .meta textarea {
      width: 100%;
      height: 70px;
      resize: none;
      padding: 5px;
      border-radius: 3px;
      border: 1px solid #aaa;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }

    th, td {
      border: 1px solid #555;
      text-align: center;
      padding: 6px;
      font-size: 13px;
    }

    th {
      background: #e6e6e6;
    }

    input[type="text"], input[type="number"], input[type="date"] {
      width: 100%;
      box-sizing: border-box;
      padding: 4px;
      border: 1px solid #aaa;
      border-radius: 3px;
    }

    button {
      margin-top: 15px;
      padding: 8px 16px;
      background: #007bff;
      border: none;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #0056b3;
    }

    .botones-panel {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 15px;
    }

    .botones-panel button {
      display: flex;
      align-items: center;
      gap: 6px;
    }
  </style>
</head>
<body>
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <div class="logo">
        <i class="fas fa-fish"></i>
        <span>Panel Peces</span>
      </div>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="index.php?controller=JefePlanta&action=dashboard"><i class="fas fa-th-large"></i> Dashboard</a></li>
        <li><a href="index.php?controller=JefePlanta&action=moduloPeces"><i class="fas fa-fish"></i> Panel Peces</a></li>
        <li class="active"><a href="#"><i class="fas fa-vial"></i> BPA 15 - Control Sanitario</a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
      </ul>
    </nav>
  </aside>

  <div class="container">
    <header>
      <div class="logo">
        <img src="/ruta/a/logo_coraqua.png" alt="Logo Coraqua">
      </div>

      <div class="info">
        <h2>FORMATO N°15</h2>
        <h3>CONTROL SANITARIO EN ALEVINES<br>TRATAMIENTO EN BAÑO SALINO</h3>
      </div>

      <div class="details">
        <p><strong>CÓDIGO:</strong> CORAQUA BPA</p>
        <p><strong>VERSIÓN:</strong> 2.0</p>
        <p><strong>FECHA:</strong> 03/08/2020</p>
      </div>
    </header>

    <div class="meta">
      <div><strong>Fecha:</strong> <input type="date" name="fecha"></div>
      <div><strong>Encargado:</strong> <input type="text" name="encargado"></div>
      <div><strong>Lote:</strong> <input type="text" name="lote"></div>
      <div><strong>Sede:</strong> <input type="text" name="sede"></div>
      <div style="flex: 1 1 100%;"><strong>Actividad:</strong> 
        <textarea name="actividad" placeholder="Describa la actividad realizada..."></textarea>
      </div>
    </div>

    <div class="botones-panel">
      <button class="excel" id="btnExcelSemana">
        📅 <i class="fas fa-calendar-week"></i> Semana (Excel)
      </button>
      <button class="excel" id="btnExcelMes">
        🗓️ <i class="fas fa-calendar-alt"></i> Mes (Excel)
      </button>
      <button class="excel" id="btnExcelAnio">
        📆 <i class="fas fa-calendar"></i> Año (Excel)
      </button>

      <button class="pdf" id="btnPDF">
        🧾 <i class="fas fa-file-pdf"></i> PDF
      </button>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>N°</th>
            <th colspan="2">ORIGEN</th>
            <th colspan="2">DESTINO</th>
            <th>CONCENTRACIÓN DE SAL</th>
            <th>OBSERVACIÓN</th>
          </tr>
          <tr>
            <th></th>
            <th>U.P.</th>
            <th></th>
            <th>U.P.</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <!-- Filas de ejemplo -->
          <tr>
            <td>1</td>
            <td><input type="text" name="origen_1"></td>
            <td></td>
            <td><input type="text" name="destino_1"></td>
            <td></td>
            <td><input type="text" name="concentracion_1"></td>
            <td><input type="text" name="observacion_1"></td>
          </tr>
          <tr>
            <td>2</td>
            <td><input type="text" name="origen_2"></td>
            <td></td>
            <td><input type="text" name="destino_2"></td>
            <td></td>
            <td><input type="text" name="concentracion_2"></td>
            <td><input type="text" name="observacion_2"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <button type="submit">Guardar</button>
  </div>
</body>
</html>

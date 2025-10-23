<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CORAQUA BPA 12 - Control Diario de Parámetros</title>
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
    }

    .meta div {
      flex: 1 1 45%;
      margin-bottom: 8px;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 950px;
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

    input[type="text"], input[type="number"], input[type="date"], input[type="time"] {
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

    .subheader {
      background: #f4f4f4;
      font-weight: bold;
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
        <li class="active"><a href="#"><i class="fas fa-thermometer-half"></i> BPA 12 - Control Parámetros</a></li>
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
        <h2>FORMATO N°12</h2>
        <h3>CONTROL DIARIO DE PARÁMETROS</h3>
      </div>

      <div class="details">
        <p><strong>CÓDIGO:</strong> CORAQUA BPA 12</p>
        <p><strong>VERSIÓN:</strong> 2.0</p>
        <p><strong>FECHA:</strong> 03/08/2020</p>
      </div>
    </header>

    <div class="meta">
      <div><strong>Mes:</strong> <input type="text" name="mes"></div>
      <div><strong>Sede:</strong> <input type="text" name="sede"></div>
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
            <th rowspan="2">DÍA</th>
            <th colspan="3">6:30 a.m</th>
            <th colspan="3">12:00 m</th>
            <th colspan="3">3:30 p.m</th>
            <th rowspan="2">RESPONSABLE</th>
            <th rowspan="2">OBS</th>
          </tr>
          <tr class="subheader">
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th>
          </tr>
        </thead>
        <tbody>
          <!-- Filas de ejemplo -->
          <tr>
            <td>1</td>
            <td><input type="number" name="t1_630"></td>
            <td><input type="number" name="o1_630"></td>
            <td><input type="number" name="s1_630"></td>
            <td><input type="number" name="t1_1200"></td>
            <td><input type="number" name="o1_1200"></td>
            <td><input type="number" name="s1_1200"></td>
            <td><input type="number" name="t1_1530"></td>
            <td><input type="number" name="o1_1530"></td>
            <td><input type="number" name="s1_1530"></td>
            <td><input type="text" name="responsable_1"></td>
            <td><input type="text" name="obs_1"></td>
          </tr>
          <tr>
            <td>2</td>
            <td><input type="number" name="t2_630"></td>
            <td><input type="number" name="o2_630"></td>
            <td><input type="number" name="s2_630"></td>
            <td><input type="number" name="t2_1200"></td>
            <td><input type="number" name="o2_1200"></td>
            <td><input type="number" name="s2_1200"></td>
            <td><input type="number" name="t2_1530"></td>
            <td><input type="number" name="o2_1530"></td>
            <td><input type="number" name="s2_1530"></td>
            <td><input type="text" name="responsable_2"></td>
            <td><input type="text" name="obs_2"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <button type="submit">Guardar</button>
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CORAQUA BPA 7 - Alimentación Diaria</title>
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
      justify-content: space-between;
      font-size: 14px;
      margin-bottom: 15px;
      flex-wrap: wrap;
    }

    .meta div {
      flex: 1 1 30%;
      margin-bottom: 8px;
    }

    .table-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
    }

    table {
      width: 32%;
      border-collapse: collapse;
      font-size: 13px;
      min-width: 300px;
    }

    th, td {
      border: 1px solid #555;
      text-align: center;
      padding: 6px;
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
        <li class="active"><a href="#"><i class="fas fa-utensils"></i> BPA 7 - Alimentación Diaria</a></li>
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
        <h2>FORMATO N°07</h2>
        <h3>ALIMENTACIÓN DIARIA</h3>
      </div>

      <div class="details">
        <p><strong>CÓDIGO:</strong> CORAQUA BPA-7</p>
        <p><strong>VERSIÓN:</strong> 2.0</p>
        <p><strong>FECHA:</strong> 03/08/2020</p>
      </div>
    </header>

    <div class="meta">
      <div><strong>Responsable:</strong> <input type="text" name="responsable"></div>
      <div><strong>Fecha:</strong> <input type="date" name="fecha"></div>
      <div><strong>Sede:</strong> <input type="text" name="sede"></div>
    </div>

    <div class="table-container">
      <!-- Tabla 1 -->
      <table>
        <thead>
          <tr>
            <th>U.P.</th>
            <th>LOTE</th>
            <th>BIOMASA</th>
            <th>T.A. (%)</th>
            <th>AL. SUM (Kg)</th>
            <th>CALIBRE</th>
            <th>OBS.</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="up1_1"></td>
            <td><input type="text" name="lote1_1"></td>
            <td><input type="number" name="biomasa1_1"></td>
            <td><input type="number" name="ta1_1" step="0.01"></td>
            <td><input type="number" name="alsum1_1" step="0.01"></td>
            <td><input type="text" name="calibre1_1"></td>
            <td><input type="text" name="obs1_1"></td>
          </tr>
          <tr>
            <td><input type="text" name="up1_2"></td>
            <td><input type="text" name="lote1_2"></td>
            <td><input type="number" name="biomasa1_2"></td>
            <td><input type="number" name="ta1_2" step="0.01"></td>
            <td><input type="number" name="alsum1_2" step="0.01"></td>
            <td><input type="text" name="calibre1_2"></td>
            <td><input type="text" name="obs1_2"></td>
          </tr>
        </tbody>
      </table>

      <!-- Tabla 2 -->
      <table>
        <thead>
          <tr>
            <th>U.P.</th>
            <th>LOTE</th>
            <th>BIOMASA</th>
            <th>T.A. (%)</th>
            <th>AL. SUM (Kg)</th>
            <th>CALIBRE</th>
            <th>OBS.</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="up2_1"></td>
            <td><input type="text" name="lote2_1"></td>
            <td><input type="number" name="biomasa2_1"></td>
            <td><input type="number" name="ta2_1" step="0.01"></td>
            <td><input type="number" name="alsum2_1" step="0.01"></td>
            <td><input type="text" name="calibre2_1"></td>
            <td><input type="text" name="obs2_1"></td>
          </tr>
          <tr>
            <td><input type="text" name="up2_2"></td>
            <td><input type="text" name="lote2_2"></td>
            <td><input type="number" name="biomasa2_2"></td>
            <td><input type="number" name="ta2_2" step="0.01"></td>
            <td><input type="number" name="alsum2_2" step="0.01"></td>
            <td><input type="text" name="calibre2_2"></td>
            <td><input type="text" name="obs2_2"></td>
          </tr>
        </tbody>
      </table>

      <!-- Tabla 3 -->
      <table>
        <thead>
          <tr>
            <th>U.P.</th>
            <th>LOTE</th>
            <th>BIOMASA</th>
            <th>T.A. (%)</th>
            <th>AL. SUM (Kg)</th>
            <th>CALIBRE</th>
            <th>OBS.</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="text" name="up3_1"></td>
            <td><input type="text" name="lote3_1"></td>
            <td><input type="number" name="biomasa3_1"></td>
            <td><input type="number" name="ta3_1" step="0.01"></td>
            <td><input type="number" name="alsum3_1" step="0.01"></td>
            <td><input type="text" name="calibre3_1"></td>
            <td><input type="text" name="obs3_1"></td>
          </tr>
          <tr>
            <td><input type="text" name="up3_2"></td>
            <td><input type="text" name="lote3_2"></td>
            <td><input type="number" name="biomasa3_2"></td>
            <td><input type="number" name="ta3_2" step="0.01"></td>
            <td><input type="number" name="alsum3_2" step="0.01"></td>
            <td><input type="text" name="calibre3_2"></td>
            <td><input type="text" name="obs3_2"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <button type="submit">Guardar</button>
  </div>
</body>
</html>

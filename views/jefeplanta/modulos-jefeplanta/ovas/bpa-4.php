<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMATO N°04 - MORTALIDAD DIARIA - OVAS</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background: #f8f9fa;
      margin: 0;
      padding: 20px;
      color: #222;
    }

    .container {
      background: #fff;
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      max-width: 1400px;
      margin: auto;
    }

    header {
      text-align: center;
      margin-bottom: 20px;
      border-bottom: 2px solid #0078d4;
      padding-bottom: 10px;
    }

    header h1 {
      font-size: 20px;
      margin: 0;
      font-weight: bold;
    }

    .codigo {
      text-align: right;
      font-size: 14px;
      color: #444;
    }

    .info {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .info div {
      display: flex;
      flex-direction: column;
    }

    .info label {
      font-weight: bold;
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ccc;
      text-align: center;
      padding: 6px;
    }

    th {
      background: #0078d4;
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background: #f2f6fc;
    }

    .observaciones {
      margin-top: 20px;
    }

    .observaciones label {
      font-weight: bold;
      display: block;
      margin-bottom: 6px;
    }

    .observaciones textarea {
      width: 100%;
      height: 100px;
      border-radius: 6px;
      border: 1px solid #ccc;
      padding: 8px;
      resize: vertical;
      font-size: 13px;
    }

    .firmas {
      display: flex;
      justify-content: space-around;
      text-align: center;
      margin-top: 40px;
    }

    .firmas div {
      width: 30%;
      border-top: 1px solid #000;
      padding-top: 5px;
      font-size: 13px;
    }

    @media print {
      body {
        background: none;
      }
      .container {
        box-shadow: none;
        border: none;
      }
      textarea {
        border: none;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>FORMATO N°04 - MORTALIDAD DIARIA - OVAS</h1>
      <div class="codigo">
        <strong>CÓDIGO:</strong> CORAQUA - BPA 4 &nbsp;&nbsp; | &nbsp;&nbsp;
        <strong>VERSIÓN:</strong> 2.0 &nbsp;&nbsp; | &nbsp;&nbsp;
        <strong>FECHA:</strong> 03/08/2020
      </div>
    </header>

    <div class="info">
      <div>
        <label>Encargado:</label>
        <span>____________________________</span>
      </div>
      <div>
        <label>Cant. Siembra:</label>
        <span>____________________________</span>
      </div>
      <div>
        <label>Lote:</label>
        <span>____________________________</span>
      </div>
      <div>
        <label>Sede:</label>
        <span>____________________________</span>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>FECHA</th>
          <th>BAT.</th>
          <th>BATEA</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>C5</th>
          <th>C6</th>
          <th>C7</th>
          <th>TOTAL</th>
          <th>OBS</th>
          <th>FECHA</th>
          <th>BAT.</th>
          <th>BATEA</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>C5</th>
          <th>C6</th>
          <th>C7</th>
          <th>TOTAL</th>
          <th>OBS</th>
        </tr>
      </thead>
      <tbody>
        <!-- Filas vacías -->
        ${Array.from({ length: 30 }).map(() => `
        <tr>
          ${Array.from({ length: 24 }).map(() => `<td>&nbsp;</td>`).join('')}
        </tr>`).join('')}
      </tbody>
    </table>

    <div class="observaciones">
      <label>OBSERVACIONES:</label>
      <textarea></textarea>
    </div>

    <div class="firmas">
      <div>RESPONSABLE DE ÁREA</div>
      <div>JEFE DE PLANTA</div>
      <div>JEFE DE PRODUCCIÓN</div>
    </div>
  </div>
</body>
</html>

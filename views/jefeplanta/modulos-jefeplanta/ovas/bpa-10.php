<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FORMATO N°10 - MUESTREO</title>
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
      max-width: 1500px;
      margin: auto;
    }

    header {
      text-align: center;
      border-bottom: 2px solid #0078d4;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }

    header h1 {
      margin: 0;
      font-size: 20px;
      font-weight: bold;
    }

    .codigo {
      text-align: right;
      font-size: 14px;
      color: #444;
      margin-top: 6px;
    }

    .info {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 10px;
      margin-top: 20px;
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
      margin-top: 15px;
    }

    th, td {
      border: 1px solid #ccc;
      text-align: center;
      padding: 5px;
    }

    th {
      background: #0078d4;
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background: #f3f7fb;
    }

    .section-title {
      font-weight: bold;
      margin-top: 15px;
      margin-bottom: 5px;
      color: #333;
      text-align: center;
    }

    .footer-table {
      margin-top: 10px;
    }

    .footer-table td {
      text-align: center;
      padding: 8px;
      font-weight: bold;
      border: none;
    }

    .firmas {
      display: flex;
      justify-content: space-around;
      margin-top: 40px;
      text-align: center;
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
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>FORMATO N°10 - MUESTREO</h1>
      <div class="codigo">
        <strong>CÓDIGO:</strong> CORAQUA BPA 10 &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>VERSIÓN:</strong> 2.0 &nbsp;&nbsp;|&nbsp;&nbsp;
        <strong>FECHA:</strong> 03/08/2020
      </div>
    </header>

    <div class="info">
      <div><label>Encargado:</label><span>____________________________</span></div>
      <div><label>Sede:</label><span>____________________________</span></div>
      <div><label>Fecha:</label><span>____________________________</span></div>
      <div><label>Hora:</label><span>____________________________</span></div>
    </div>

    <div class="section-title">DATOS DE MUESTREO</div>
    <table>
      <thead>
        <tr>
          <th>UP</th>
          <th>Peso</th>
          <th>Peso</th>
          <th>Peso</th>
          <th>Peso</th>
          <th></th>
          <th>UP</th>
          <th>Peso</th>
          <th>Peso</th>
          <th>Peso</th>
          <th>Peso</th>
          <th>Long.</th>
        </tr>
      </thead>
      <tbody>
        <!-- Generar 50 filas -->
        ${Array.from({ length: 50 }).map((_, i) => `
          <tr>
            <td>${i + 1}</td>
            <td></td><td></td><td></td><td></td>
            <td></td>
            <td>${i + 1}</td>
            <td></td><td></td><td></td><td></td>
            <td></td>
          </tr>
        `).join('')}
      </tbody>
    </table>

    <table class="footer-table">
      <tr>
        <td>P.P.</td><td>P.P.</td><td>P.P.</td><td>P.P.</td>
        <td></td>
        <td>P.P.</td><td>P.P.</td><td>P.P.</td><td>P.P.</td>
      </tr>
      <tr>
        <td colspan="5">PESO PROMEDIO</td>
        <td colspan="6">PESO PROMEDIO</td>
      </tr>
      <tr>
        <td colspan="5">C.V</td>
        <td colspan="6">C.V</td>
      </tr>
      <tr>
        <td colspan="5">K</td>
        <td colspan="6">K</td>
      </tr>
    </table>

    <div class="firmas">
      <div>RESPONSABLE DE ÁREA</div>
      <div>JEFE DE PLANTA</div>
      <div>JEFE DE PRODUCCIÓN</div>
    </div>
  </div>
</body>
</html>

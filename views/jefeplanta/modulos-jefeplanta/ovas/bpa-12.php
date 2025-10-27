<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FORMATO N°12 - CONTROL DIARIO DE PARÁMETROS</title>
<style>
  * {
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }
  body {
    margin: 30px;
    background-color: #f9f9f9;
  }
  .formato {
    background: white;
    border: 2px solid #1f497d;
    border-radius: 8px;
    padding: 20px 30px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
  }
  header {
    text-align: center;
    margin-bottom: 20px;
  }
  header h1 {
    font-size: 20px;
    color: #1f497d;
    margin: 0;
    font-weight: bold;
  }
  .info-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
    font-size: 14px;
  }
  .info-table td {
    border: 1px solid #1f497d;
    padding: 5px 10px;
  }
  .info-table td:first-child {
    font-weight: bold;
    background: #d9e1f2;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 13px;
    text-align: center;
  }
  th, td {
    border: 1px solid #1f497d;
    padding: 5px;
  }
  th {
    background-color: #d9e1f2;
    font-weight: bold;
  }
  tr:nth-child(even) {
    background-color: #f2f6fa;
  }
  .footer {
    margin-top: 30px;
    display: flex;
    justify-content: space-between;
    font-size: 13px;
  }
  .footer div {
    text-align: center;
    width: 30%;
  }
  .footer p {
    border-top: 1px solid #1f497d;
    margin-top: 40px;
    padding-top: 5px;
    font-weight: bold;
  }
</style>
</head>
<body>
  <div class="formato">
    <header>
      <h1>FORMATO N°12 - CONTROL DIARIO DE PARÁMETROS</h1>
    </header>

    <table class="info-table">
      <tr>
        <td>Código</td>
        <td>CORAQUA BPA 12</td>
        <td>Versión</td>
        <td>2.0</td>
        <td>Fecha</td>
        <td>3/08/2020</td>
      </tr>
      <tr>
        <td>Mes</td>
        <td></td>
        <td>Sede</td>
        <td colspan="3"></td>
      </tr>
    </table>

    <table>
      <tr>
        <th rowspan="2">Día</th>
        <th colspan="4">6:30 a.m.</th>
        <th colspan="4">12:00 m.</th>
        <th colspan="4">3:30 p.m.</th>
        <th rowspan="2">Responsable</th>
        <th rowspan="2">Obs</th>
      </tr>
      <tr>
        <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th><th>pH</th>
        <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th><th>pH</th>
        <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th><th>pH</th>
      </tr>
      <!-- Filas de días -->
      ${Array.from({length: 31}, (_, i) => `
        <tr>
          <td>${i + 1}</td>
          ${'<td></td>'.repeat(12)}
          <td></td><td></td>
        </tr>
      `).join('')}
      <tr>
        <td><b>PROM.</b></td>
        ${'<td></td>'.repeat(12)}
        <td></td><td></td>
      </tr>
    </table>

    <div class="footer">
      <div><p>Responsable de Área</p></div>
      <div><p>Jefe de Planta</p></div>
      <div><p>Jefe de Producción</p></div>
    </div>
  </div>
</body>
</html>

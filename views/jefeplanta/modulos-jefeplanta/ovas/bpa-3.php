<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FORMATO N°03 - RECEPCIÓN, REINCUBACIÓN DE OVAS IMPORTADAS Y DISTRIBUCIÓN EN ECLOSERÍA</title>
<style>
  * {
    box-sizing: border-box;
    font-family: "Poppins", "Segoe UI", sans-serif;
  }

  body {
    background: linear-gradient(135deg, #fffaf2, #ffd9b3);
    margin: 0;
    padding: 0;
    color: #333;
  }

  .container {
    max-width: 1200px;
    margin: 40px auto;
    background: #fff;
    padding: 35px 40px;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    border-top: 6px solid #ff7b00;
  }

  header {
    text-align: center;
    margin-bottom: 20px;
  }

  header h2 {
    color: #ff7b00;
    font-size: 1.6em;
    margin-bottom: 5px;
  }

  header h3 {
    font-size: 1em;
    color: #333;
    margin-bottom: 5px;
  }

  header p {
    font-size: 0.9em;
    color: #555;
  }

  .codigo-box {
    border: 1px solid #ff7b00;
    padding: 8px;
    border-radius: 8px;
    text-align: center;
    display: inline-block;
    margin-top: 10px;
    background: #fff3e0;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 12px;
    margin-top: 15px;
  }

  label {
    font-weight: 600;
    font-size: 0.9em;
    color: #2d3436;
  }

  input {
    width: 100%;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.9em;
    transition: 0.2s;
  }

  input:focus {
    border-color: #ff7b00;
    outline: none;
    box-shadow: 0 0 4px #ffb366;
  }

  .section-title {
    background: #ffeedb;
    color: #ff7b00;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 25px;
  }

  .table-container {
    overflow-x: auto;
    margin-top: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85em;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 6px;
    text-align: center;
  }

  th {
    background: #ff7b00;
    color: white;
  }

  td input {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
  }

  td input:focus {
    background: #fff4e6;
    outline: none;
  }

  .observaciones {
    margin-top: 20px;
  }

  textarea {
    width: 100%;
    height: 80px;
    border-radius: 8px;
    border: 1px solid #ccc;
    padding: 10px;
    resize: none;
  }

  footer {
    display: flex;
    justify-content: space-between;
    margin-top: 40px;
    font-weight: 600;
    font-size: 0.9em;
    text-align: center;
  }

  footer div {
    width: 45%;
    border-top: 1px solid #000;
    padding-top: 5px;
  }

  .btns {
    margin-top: 20px;
    text-align: right;
  }

  button {
    background: #ff7b00;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 0.9em;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background: #e66e00;
  }
</style>
</head>
<body>

<div class="container">
  <header>
    <img src="https://upload.wikimedia.org/wikipedia/commons/1/17/Circle-icons-fish.svg" alt="CORAQUA" width="70">
    <h2>FORMATO N° 03</h2>
    <h3>RECEPCIÓN, REINCUBACIÓN DE OVAS IMPORTADAS Y DISTRIBUCIÓN EN ECLOSERÍA</h3>
    <p>DATOS DE REINCUBACIÓN DE OVAS EMBRIONADAS DE TRUCHA ARCO IRIS (Oncorhynchus mykiss)</p>
    <div class="codigo-box">
      <p><strong>CÓDIGO:</strong> CORAQUA BPA-03 &nbsp; | &nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp; | &nbsp; <strong>FECHA:</strong> 03/09/2020</p>
    </div>
  </header>

  <section class="info-grid">
    <div><label>Origen</label><input type="text"></div>
    <div><label>Procedencia</label><input type="text"></div>
    <div><label>Proveedor / Centro de Producción</label><input type="text"></div>
    <div><label>Sede</label><input type="text"></div>
    <div><label>Fecha</label><input type="date"></div>
    <div><label>Hora Inicial</label><input type="time"></div>
    <div><label>Hora Final</label><input type="time"></div>
    <div><label>Grupo</label><input type="text"></div>
    <div><label>Encargado</label><input type="text"></div>
    <div><label>Temp. de Agua (°C)</label><input type="number" step="0.1"></div>
  </section>

  <div class="section-title">Recepción - Reincubación - Distribución</div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th rowspan="2">N° CAJA</th>
          <th rowspan="2">CANTIDAD DE OVAS (MILLAR)</th>
          <th rowspan="2">CANTIDAD DE HIELO (%)</th>
          <th rowspan="2">UTA</th>
          <th colspan="3">RECEPCIÓN</th>
          <th colspan="4">REINCUBACIÓN</th>
          <th colspan="8">DISTRIBUCIÓN</th>
          <th rowspan="2">OBSERVACIONES</th>
        </tr>
        <tr>
          <th>N° BANDEJA</th>
          <th>TEMP. (°C)</th>
          <th>TEMP. ACLIM. (°C)</th>
          <th>HORA</th>
          <th>TEMP. (°C)</th>
          <th>AGUA (lt)</th>
          <th>DESINFECTANTE (ml)</th>
          <th>TIEMPO (min)</th>
          <th>N° OVAS/ICTIÓMETRO</th>
          <th>DIÁMETRO (mm)</th>
          <th>OVAS/LITRO</th>
          <th>OVAS/CANASTILLO (ml)</th>
          <th>EXCEDENTE (ml)</th>
          <th>TOTAL OVAS (und)</th>
          <th>CARACTERÍSTICA</th>
          <th>UNIDADES</th>
          <th>%</th>
        </tr>
      </thead>
      <tbody>
        <!-- Sección repetitiva de cajas -->
        <!-- Puedes duplicar o reducir según el número de cajas -->
        ${[1,2,3,4,5].map(i => `
        <tr>
          <td>${i}</td>
          ${'<td><input type="text"></td>'.repeat(19)}
        </tr>`).join('')}
      </tbody>
    </table>
  </div>

  <div class="section-title">Totales</div>
  <div class="info-grid">
    <div><label>Total de Ovas</label><input type="text"></div>
  </div>

  <div class="observaciones">
    <label>Observaciones:</label>
    <textarea placeholder="Escriba observaciones aquí..."></textarea>
  </div>

  <footer>
    <div>RESPONSABLE DE SALA</div>
    <div>JEFE DE PRODUCCIÓN</div>
  </footer>

  <div class="btns">
    <button onclick="window.print()">🖨️ Imprimir Formato</button>
  </div>
</div>

</body>
</html>

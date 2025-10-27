<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FORMATO N°02 - SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES</title>
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
    min-height: 100vh;
  }

  .container {
    max-width: 1200px;
    margin: 40px auto;
    background: #fff;
    padding: 35px 40px;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    border-top: 6px solid #ff7b00;
    animation: fadeIn 0.8s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
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

  .section-title {
    background: #ffeedb;
    color: #ff7b00;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 25px;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 15px;
    margin-top: 20px;
  }

  label {
    font-weight: 600;
    font-size: 0.9em;
    color: #2d3436;
  }

  input {
    width: 100%;
    padding: 8px;
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

  .table-container {
    overflow-x: auto;
    margin-top: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9em;
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
    <h2>FORMATO N° 02</h2>
    <h3>SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES</h3>
    <p>ÁMBITO DE APLICACIÓN: PECES REPRODUCTORES</p>
    <div class="codigo-box">
      <p><strong>CÓDIGO:</strong> CORAQUA BPA-02 &nbsp; | &nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp; | &nbsp; <strong>FECHA:</strong> 03/09/2020</p>
    </div>
  </header>

  <section class="info-grid">
    <div>
      <label>Responsable</label>
      <input type="text" placeholder="Ejemplo: Juan Pérez">
    </div>
    <div>
      <label>Fecha</label>
      <input type="date">
    </div>
    <div>
      <label>Hora Inicio</label>
      <input type="time">
    </div>
    <div>
      <label>Hora Final</label>
      <input type="time">
    </div>
  </section>

  <div class="section-title">Registro de Reproductores Aptos para Desove</div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>ITEM</th>
          <th>DESCRIPCIÓN</th>
          <th>OBSERVACIÓN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>CANTIDAD DE REPRODUCTORES HEMBRAS APTAS PARA DESOVE</td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td>2</td>
          <td>CANTIDAD DE REPRODUCTORES MACHOS APTOS PARA DESOVE</td>
          <td><input type="text"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="section-title">Registro de Reproductores Desovados</div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>ITEM</th>
          <th>DESCRIPCIÓN</th>
          <th>OBSERVACIÓN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>CANTIDAD DE REPRODUCTORES HEMBRAS DESOVADAS</td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td>2</td>
          <td>CANTIDAD DE REPRODUCTORES MACHOS DESOVADOS</td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td>3</td>
          <td>Estimación de Relación de N° de Hembras / N° de Machos</td>
          <td><input type="text"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="section-title">Volumen y Cantidad de Óvulos Fertilizados</div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>ITEM</th>
          <th>DESCRIPCIÓN</th>
          <th>OBSERVACIÓN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Volumen Óvulos Fertilizados (litros)</td>
          <td><input type="text"></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Cantidad (Número de Óvulos fértiles)</td>
          <td><input type="text"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="observaciones">
    <label>OBSERVACIONES:</label>
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

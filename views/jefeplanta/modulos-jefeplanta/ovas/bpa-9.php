<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FORMATO N°09 - SELECCIÓN, PESAJE Y TRASLADO</title>
<style>
  * {
    box-sizing: border-box;
    font-family: "Segoe UI", Tahoma, sans-serif;
  }

  body {
    background: #f5f7fa;
    margin: 0;
    padding: 0;
    color: #333;
  }

  .container {
    max-width: 1200px;
    margin: 40px auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  header {
    text-align: center;
    margin-bottom: 20px;
  }

  header h2 {
    margin: 0;
    font-size: 1.4em;
    color: #0a3d62;
  }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 10px;
    margin-bottom: 20px;
  }

  label {
    font-weight: 600;
    font-size: 0.9em;
    color: #2d3436;
  }

  input, textarea {
    width: 100%;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.9em;
  }

  textarea {
    resize: vertical;
    min-height: 60px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    font-size: 0.9em;
  }

  th, td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
  }

  th {
    background: #0a3d62;
    color: #fff;
    position: sticky;
    top: 0;
    z-index: 2;
  }

  .table-container {
    overflow-x: auto;
    margin-bottom: 15px;
  }

  .actions {
    text-align: right;
    margin-top: 10px;
  }

  button {
    background: #0a3d62;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    font-size: 0.9em;
    cursor: pointer;
    transition: 0.2s;
  }

  button:hover {
    background: #074f7f;
  }

  .section-title {
    background: #e8f0fe;
    color: #0a3d62;
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: 600;
    margin-top: 20px;
  }

  @media (max-width: 768px) {
    th, td { font-size: 0.8em; }
    input { font-size: 0.8em; }
  }
</style>
</head>
<body>

<div class="container">
  <header>
    <h2>FORMATO N°09 - SELECCIÓN, PESAJE Y TRASLADO</h2>
    <p><strong>CÓDIGO:</strong> CORAQUA BPA 9 | <strong>VERSIÓN:</strong> 2.0 | <strong>FECHA:</strong> 03/08/2020</p>
  </header>

  <section class="info-grid">
    <div>
      <label>Fecha</label>
      <input type="date" name="fecha">
    </div>
    <div>
      <label>Actividad</label>
      <input type="text" name="actividad" placeholder="Ejemplo: Pesaje de lotes">
    </div>
    <div>
      <label>Encargado</label>
      <input type="text" name="encargado" placeholder="Nombre del encargado">
    </div>
    <div>
      <label>Lote</label>
      <input type="text" name="lote" placeholder="Ejemplo: L-001">
    </div>
    <div>
      <label>Sede</label>
      <input type="text" name="sede" placeholder="Ejemplo: Planta Principal">
    </div>
  </section>

  <!-- SECCIÓN 1: ORIGEN / DESTINO -->
  <div class="section-title">ORIGEN / DESTINO / PESAJE</div>
  <div class="table-container">
    <table id="tablaPesaje">
      <thead>
        <tr>
          <th>N°</th>
          <th>U.P. Origen</th>
          <th>> ó <</th>
          <th>Peso Vivo (gr)</th>
          <th>Peso Acum. (gr)</th>
          <th>U.P. Destino</th>
        </tr>
      </thead>
      <tbody id="bodyPesaje">
      </tbody>
    </table>
  </div>
  <div class="actions">
    <button onclick="agregarFila('bodyPesaje', 30)">➕ Agregar fila</button>
    <button onclick="eliminarFila('bodyPesaje')">➖ Quitar fila</button>
  </div>

  <!-- SECCIÓN 2: MUESTREO -->
  <div class="section-title">MUESTREO</div>
  <div class="table-container">
    <table id="tablaMuestreo">
      <thead>
        <tr>
          <th>N°</th>
          <th>Peso Total (gr)</th>
          <th>Unidades</th>
          <th>Peso Uni (gr)</th>
          <th>OBS</th>
        </tr>
      </thead>
      <tbody id="bodyMuestreo">
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" style="text-align:left;"><strong>P.P.</strong> <input type="text" style="width:150px;"></td>
        </tr>
      </tfoot>
    </table>
  </div>
  <div class="actions">
    <button onclick="agregarFila('bodyMuestreo', 10)">➕ Agregar fila</button>
    <button onclick="eliminarFila('bodyMuestreo')">➖ Quitar fila</button>
  </div>

  <!-- SECCIÓN 3: RESUMEN -->
  <div class="section-title">RESUMEN</div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>U.P.</th>
          <th>Biomasa + Agua</th>
          <th>Biomasa</th>
          <th>P.P.</th>
          <th>UND</th>
          <th>OBS</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="6"><input type="text" placeholder="Ingresar resumen..."></td></tr>
      </tbody>
    </table>
  </div>

  <div>
    <label>Observaciones:</label>
    <textarea placeholder="Escriba observaciones adicionales..."></textarea>
  </div>
</div>

<script>
  // === JS general para las dos tablas ===
  function agregarFila(idTabla, max) {
    const tbody = document.getElementById(idTabla);
    const filas = tbody.querySelectorAll("tr").length;
    if (filas >= max) {
      alert(`Límite máximo de ${max} filas alcanzado.`);
      return;
    }

    let fila;
    if (idTabla === 'bodyPesaje') {
      fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${filas + 1}</td>
        <td><input type="text"></td>
        <td><input type="text" maxlength="1"></td>
        <td><input type="number" step="0.01"></td>
        <td><input type="number" step="0.01"></td>
        <td><input type="text"></td>
      `;
    } else {
      fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${filas + 1}</td>
        <td><input type="number" step="0.01"></td>
        <td><input type="number"></td>
        <td><input type="number" step="0.01"></td>
        <td><input type="text"></td>
      `;
    }
    tbody.appendChild(fila);
  }

  function eliminarFila(idTabla) {
    const tbody = document.getElementById(idTabla);
    if (tbody.lastChild) tbody.removeChild(tbody.lastChild);
  }

  // Generar filas iniciales
  for (let i = 0; i < 10; i++) agregarFila('bodyPesaje', 30);
  for (let i = 0; i < 10; i++) agregarFila('bodyMuestreo', 10);
</script>

</body>
</html>

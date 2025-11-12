<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CONTROL DE DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS</title>
<style>
  * { box-sizing: border-box; font-family: "Poppins", "Segoe UI", sans-serif; }
  body {
    margin: 0;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding: 40px 20px;
  }

  .container {
    width: 95%;
    max-width: 1300px;
    background: #fff;
    border-radius: 18px;
    padding: 35px 45px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    border-top: 8px solid #ff7b00;
    animation: fadeIn 0.6s ease;
  }
  @keyframes fadeIn { from {opacity:0; transform:translateY(12px)} to {opacity:1; transform:none} }

  .header {
    text-align: center;
  }
  .header img { width: 90px; margin-bottom: 10px; }
  .header h1 { font-size: 1.6rem; color: #ff7b00; margin: 0; letter-spacing: 0.5px; }
  .meta { font-size: 0.95rem; color: #555; margin-top: 6px; }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
    gap: 18px;
    margin-top: 25px;
  }
  label { font-weight: 600; color: #333; font-size: 1rem; }
  input, select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #d8d8d8;
    border-radius: 10px;
    font-size: 0.95rem;
  }
  input:focus, select:focus { outline: none; border-color: #ff7b00; box-shadow: 0 0 8px rgba(255,123,0,0.2); }

  .section-title {
    background: #ffeedb;
    color: #ff7b00;
    padding: 10px 12px;
    border-radius: 10px;
    font-weight: 700;
    margin-top: 28px;
    text-align: center;
    font-size: 1.1rem;
  }

  .table-container {
    overflow-x: auto;
    margin-top: 15px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
  }
  th, td {
    border: 1px solid #e6e6e6;
    text-align: center;
    padding: 10px 6px;
  }
  th {
    background: #ff7b00;
    color: #fff;
  }
  td input {
    width: 100%;
    border: none;
    text-align: center;
    background: transparent;
  }
  td input:focus {
    background: #fff7f0;
    outline: none;
  }

  .actions {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
  }
  .btn {
    background: #ff7b00;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    font-size: 0.95rem;
  }
  .btn:hover { background: #e66e00; }
  .btn.secondary {
    background: #fff;
    color: #ff7b00;
    border: 2px solid #ff7b00;
  }
  .btn.secondary:hover {
    background: #ff7b00;
    color: #fff;
  }

  footer {
    text-align: center;
    color: #666;
    font-size: 0.9rem;
    margin-top: 22px;
  }
</style>
</head>
<body>

<div class="container">
  <div class="header">
    <img src="/sistema-produccion/public/img/coraqua.png" alt="CORAQUA" />
    <h1>CONTROL DE DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS</h1>
    <div class="meta"><b>CÓDIGO:</b> CORAQUA BPA-4 | <b>REVISIÓN:</b> 2.0</div>
  </div>

  <div class="info-grid">
    <div><label>Fecha</label><input id="fecha" type="date"></div>
    <div><label>Sede</label>
      <select id="sede">
        <option value="">Seleccione sede</option>
        <option>Chichillapi</option>
        <option>Cambruni</option>
      </select>
    </div>
    <div><label>Encargado</label><input id="encargado" type="text" placeholder="Nombre del encargado"></div>
    <div><label>Mes</label>
      <select id="mes">
        <option value="">Seleccione mes</option>
        <option>Enero</option><option>Febrero</option><option>Marzo</option>
        <option>Abril</option><option>Mayo</option><option>Junio</option>
        <option>Julio</option><option>Agosto</option><option>Setiembre</option>
        <option>Octubre</option><option>Noviembre</option><option>Diciembre</option>
      </select>
    </div>
  </div>

  <div class="section-title">Detalle de Dosificación</div>
  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>FECHA</th>
          <th>MEDICAMENTO / SUPLEMENTO</th>
          <th>DOSIS (gr)</th>
          <th>DÍAS</th>
          <th>LOTE / ALEVINES</th>
          <th>SALA</th>
          <th>RESPONSABLE</th>
          <th>OBSERVACIONES</th>
        </tr>
      </thead>
      <tbody id="bodyDosificacion"></tbody>
    </table>
  </div>

  <div class="actions">
    <div>
      <button class="btn" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn" onclick="eliminarFila()">➖ Quitar fila</button>
      <button class="btn" onclick="limpiarFormulario()">🧹 Limpiar</button>
      <button class="btn" onclick="guardarDatos()">💾 Guardar</button>
    </div>
    <div>
      <button class="btn secondary" onclick="verListado()">📖 Ver Listado</button>
      <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Panel</button>
    </div>
  </div>

  <footer>CORAQUA © 2025 — Control de Dosificación</footer>
</div>

<form id="formBPA4" style="display:none" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA4">
  <input type="hidden" name="fecha" id="hiddenFecha">
  <input type="hidden" name="sede" id="hiddenSede">
  <input type="hidden" name="encargado" id="hiddenEncargado">
  <input type="hidden" name="mes" id="hiddenMes">
</form>

<script>
function agregarFila() {
  const tbody = document.getElementById('bodyDosificacion');
  const n = tbody.rows.length + 1;
  const hoy = document.getElementById('fecha').value || new Date().toISOString().split('T')[0];
  const fila = document.createElement('tr');
  fila.innerHTML = `
    <td>${n}</td>
    <td><input type="date" value="${hoy}"></td>
    <td><input type="text" placeholder="Medicamento o suplemento"></td>
    <td><input type="number" step="0.01" placeholder="gr"></td>
    <td><input type="number" step="1" placeholder="Días"></td>
    <td><input type="text" placeholder="Lote / alevines"></td>
    <td><input type="text" placeholder="Sala"></td>
    <td><input type="text" placeholder="Responsable"></td>
    <td><input type="text" placeholder="Observaciones"></td>`;
  tbody.appendChild(fila);
}

function eliminarFila() {
  const tbody = document.getElementById('bodyDosificacion');
  if (tbody.rows.length > 1) tbody.deleteRow(-1);
  else alert('Debe quedar al menos una fila.');
}

function limpiarFormulario() {
  if (confirm('¿Desea limpiar todos los campos y filas?')) {
    document.getElementById('fecha').value = new Date().toISOString().split('T')[0];
    document.getElementById('sede').value = "";
    document.getElementById('encargado').value = "";
    document.getElementById('mes').value = "";
    document.getElementById('bodyDosificacion').innerHTML = "";
    for (let i = 0; i < 5; i++) agregarFila();
  }
}

function guardarDatos() {
  const fecha = document.getElementById('fecha').value;
  const sede = document.getElementById('sede').value;
  const encargado = document.getElementById('encargado').value;
  const mes = document.getElementById('mes').value;

  if (!fecha || !sede || !encargado || !mes) {
    alert('⚠️ Complete todos los campos.');
    return;
  }

  const filas = document.querySelectorAll('#bodyDosificacion tr');
  if (filas.length === 0) {
    alert('Agregue al menos una fila.');
    return;
  }

  const form = document.getElementById('formBPA4');
  document.getElementById('hiddenFecha').value = fecha;
  document.getElementById('hiddenSede').value = sede;
  document.getElementById('hiddenEncargado').value = encargado;
  document.getElementById('hiddenMes').value = mes;

  if (confirm('¿Desea guardar los registros?')) form.submit();
}

function verListado() {
  window.location.href = "/sistema-produccion/public/Inventario/listarBPA4";
}

function volverAtras() {
  window.history.back();
}

document.addEventListener('DOMContentLoaded', () => {
  const hoy = new Date().toISOString().split('T')[0];
  document.getElementById('fecha').value = hoy;
  for (let i = 0; i < 5; i++) agregarFila();
});
</script>
</body>
</html>

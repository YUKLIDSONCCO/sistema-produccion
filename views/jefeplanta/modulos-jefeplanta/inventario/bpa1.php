<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CONTROL DE ALIMENTO EN ALMACÉN</title>
<style>
  * { box-sizing: border-box; font-family: "Poppins", "Segoe UI", sans-serif; }
  html, body { margin: 0; padding: 0; height: 100%; }

  body {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333;
    padding: 0;
  }

  .container {
    width: 100%;
    max-width: 1400px;
    background: #fff;
    border-radius: 14px;
    padding: 24px 20px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    border-top: 7px solid #ff7b00;
    margin: 20px;
    animation: fadeIn 0.6s ease;
  }

  @keyframes fadeIn { from {opacity:0; transform:translateY(8px)} to {opacity:1; transform:none} }

  .header-row {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 8px;
  }

  .logo img {
    width: 90px;
    height: 90px;
    object-fit: contain;
  }

  h1 { font-size: 1.8rem; margin: 6px 0 0; color: #0f2b2b; font-weight: 700; }
  .meta { font-size: 0.9rem; color: #555; }
  .meta strong { color:#ff7b00; }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 14px;
    margin-top: 20px;
  }

  label { font-weight: 600; color:#333; margin-bottom:6px; display:block; }
  input[type="text"], input[type="date"], select, input[type="number"] {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 0.95rem;
    transition: all .2s;
  }
  input:focus, select:focus { border-color: #ff7b00; box-shadow: 0 0 6px rgba(255,123,0,0.3); outline: none; }

  .section-title {
    margin-top: 20px;
    background:#ffeedb;
    color:#ff7b00;
    padding:8px 12px;
    border-radius:8px;
    font-weight:700;
  }

  .table-container {
    overflow-x: auto;
    margin-top: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
  }

  th, td {
    border: 1px solid #e6e6e6;
    padding: 8px 6px;
    text-align: center;
  }

  th {
    background: #ff7b00;
    color: #fff;
    position: sticky;
    top: 0;
  }

  td input {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    padding: 4px;
  }

  td input:focus { background: #fff7f0; outline: none; }

  .actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px;
    margin-top: 18px;
  }

  .btn {
    background: #ff7b00;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
  }

  .btn:hover { background: #e66e00; transform: translateY(-2px); }
  .btn.secondary { background: #fff; color: #ff7b00; border: 2px solid #ff7b00; }
  .btn.secondary:hover { background:#ff7b00; color:#fff; }

  footer {
    text-align:center;
    color:#666;
    font-size:0.9rem;
    margin-top:20px;
  }

  @media (max-width: 768px) {
    .container { padding: 16px; margin: 10px; }
    h1 { font-size: 1.4rem; }
    table { font-size: 0.85rem; }
    .btn { flex: 1; text-align: center; }
  }
</style>
</head>
<body>

<div class="container">
  <div class="header-row">
    <div class="logo">
      <img src="/sistema-produccion/public/img/coraqua.png" alt="Logo CORAQUA">
    </div>
    <h1>CONTROL DE ALIMENTO EN ALMACÉN</h1>
    <div class="meta">
      <strong>CÓDIGO:</strong> CORAQUA MPA-1 &nbsp;|&nbsp;
      <strong>VERSIÓN:</strong> 2.0
    </div>
  </div>

  <div class="info-grid">
    <div>
      <label for="fecha">Fecha</label>
      <input id="fecha" type="date">
    </div>
    <div>
      <label for="sede">Sede</label>
      <select id="sede">
        <option value="">Seleccione sede</option>
        <option>Chichillapi</option>
        <option>Cambruni</option>
      </select>
    </div>
    <div>
      <label for="encargado">Encargado</label>
      <input id="encargado" type="text" placeholder="Nombre del encargado">
    </div>
    <div>
      <label for="mes">Mes</label>
      <select id="mes">
        <option value="">Seleccione mes</option>
        <option>Enero</option><option>Febrero</option><option>Marzo</option>
        <option>Abril</option><option>Mayo</option><option>Junio</option>
        <option>Julio</option><option>Agosto</option><option>Setiembre</option>
        <option>Octubre</option><option>Noviembre</option><option>Diciembre</option>
      </select>
    </div>
  </div>

  <div class="section-title">Detalle de Alimentos</div>
  <div class="table-container">
    <table id="tablaAlimentos">
      <thead>
        <tr>
          <th>#</th>
          <th>FECHA</th>
          <th>MARCA</th>
          <th>CALIBRE</th>
          <th>CANTIDAD</th>
          <th>NOMBRE</th>
          <th>OBS</th>
        </tr>
      </thead>
      <tbody id="bodyAlimentos">
        <tr>
          <td>1</td>
          <td><input type="date" id="fechaFila1"></td>
          <td><input type="text" placeholder="Marca"></td>
          <td><input type="text" placeholder="Calibre"></td>
          <td><input type="number" step="0.01" placeholder="Kg / Unid"></td>
          <td><input type="text" placeholder="Nombre del producto"></td>
          <td><input type="text" placeholder="Observaciones"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="actions">
    <div class="left-actions">
      <button class="btn" onclick="agregarFilaAlimentos()">➕ Agregar fila</button>
      <button class="btn" onclick="eliminarFilaAlimentos()">➖ Quitar fila</button>
      <button class="btn" onclick="guardarDatos()">💾 Guardar</button>
    </div>
    <div class="right-actions">
      <button class="btn secondary" onclick="verListado()">📖 Ver Listado</button>
      <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Panel</button>
    </div>
  </div>

  <footer>CORAQUA © 2025 — Control de Alimento en Almacén</footer>
</div>

<form id="formBPA1" style="display:none" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA1">
  <input type="hidden" name="fecha" id="hiddenFecha">
  <input type="hidden" name="sede" id="hiddenSede">
  <input type="hidden" name="encargado" id="hiddenEncargado">
  <input type="hidden" name="mes" id="hiddenMes">
</form>

<script>
function agregarFilaAlimentos() {
  const tbody = document.getElementById('bodyAlimentos');
  const n = tbody.rows.length + 1;
  const hoy = new Date().toISOString().split('T')[0];
  const fila = document.createElement('tr');
  fila.innerHTML = `
    <td>${n}</td>
    <td><input type="date" value="${hoy}"></td>
    <td><input type="text" placeholder="Marca"></td>
    <td><input type="text" placeholder="Calibre"></td>
    <td><input type="number" step="0.01" placeholder="Kg / Unid"></td>
    <td><input type="text" placeholder="Nombre del producto"></td>
    <td><input type="text" placeholder="Observaciones"></td>
  `;
  tbody.appendChild(fila);
}

function eliminarFilaAlimentos() {
  const tbody = document.getElementById('bodyAlimentos');
  if (tbody.rows.length > 1) tbody.deleteRow(-1);
  else alert('Debe quedar al menos una fila.');
}

function guardarDatos() {
  const fecha = document.getElementById('fecha').value;
  const sede = document.getElementById('sede').value;
  const encargado = document.getElementById('encargado').value;
  const mes = document.getElementById('mes').value;

  if (!fecha || !sede || !encargado || !mes) {
    alert('Por favor complete todos los campos del formulario.');
    return;
  }

  const filas = document.querySelectorAll('#bodyAlimentos tr');
  const datos = [];
  filas.forEach(tr => {
    const inputs = tr.querySelectorAll('input');
    const fila = {
      fecha: inputs[0].value,   
      marca: inputs[1].value,
      calibre: inputs[2].value,
      cantidad: inputs[3].value,
      nombre_alimento: inputs[4].value, 
      observaciones: inputs[5].value
    };
    datos.push(fila);
  });

  const form = document.getElementById('formBPA1');

  // Limpiar inputs anteriores
  form.querySelectorAll('input[name]').forEach(e => e.remove());

  // Campos principales
  const mainFields = { fecha, sede, encargado, mes };
  for (const key in mainFields) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = key;
    input.value = mainFields[key];
    form.appendChild(input);
  }

  // Campos de la tabla
  datos.forEach(fila => {
    for (const key in fila) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = key + '[]';
      input.value = fila[key];
      form.appendChild(input);
    }
  });

  if (confirm('¿Desea guardar los datos y enviar el reporte?')) {
    form.submit();
  }
}

function verListado() { window.location.href = "/sistema-produccion/public/Inventario/listarBPA1"; }
function volverAtras() { window.history.back(); }

// ✅ Fecha actual por defecto y 5 filas iniciales con fecha de hoy
document.addEventListener('DOMContentLoaded', () => {
  const hoy = new Date().toISOString().split('T')[0];
  document.getElementById('fecha').value = hoy;
  document.getElementById('fechaFila1').value = hoy;
  for (let i = 0; i < 4; i++) agregarFilaAlimentos();
});
</script>
</body>
</html>

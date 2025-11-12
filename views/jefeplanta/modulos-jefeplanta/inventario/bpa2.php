<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>CONTROL DE SAL EN ALMACÉN — CORAQUA</title>
<style>
  * { box-sizing: border-box; font-family: "Poppins", "Segoe UI", sans-serif; }
  body {
    margin: 0;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 20px;
  }
  .container {
    width: 100%;
    max-width: 1400px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    padding: 30px;
    border-top: 8px solid #ff7b00;
    animation: fadeIn 0.6s ease;
  }
  @keyframes fadeIn { from{opacity:0; transform:translateY(8px)} to{opacity:1; transform:none} }

  .header { text-align: center; margin-bottom: 20px; }
  .header img { width: 90px; height: auto; }
  .header h1 { margin: 8px 0 4px; color: #ff7b00; font-size: 1.5rem; }
  .meta { font-size: 0.9rem; color: #555; }
  .meta strong { color: #ff7b00; }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
    gap: 16px;
    margin-bottom: 20px;
  }
  label { font-weight: 600; color: #333; margin-bottom: 6px; display: block; }
  input, select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 0.95rem;
    transition: 0.2s;
  }
  input:focus, select:focus {
    outline: none;
    border-color: #ff7b00;
    box-shadow: 0 0 6px rgba(255,123,0,0.2);
  }

  .section-title {
    background: #ffeedb;
    color: #ff7b00;
    padding: 10px;
    border-radius: 8px;
    font-weight: 700;
    margin-bottom: 8px;
    text-align: center;
  }

  .table-container {
    overflow-x: auto;
    width: 100%;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 700px;
  }
  th, td {
    border: 1px solid #e6e6e6;
    text-align: center;
    padding: 8px;
  }
  th {
    background: #ff7b00;
    color: #fff;
    font-size: 0.9rem;
  }
  td input {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    padding: 6px;
  }
  td input:focus { background: #fff6eb; outline: none; }

  .actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px;
    margin-top: 20px;
  }
  .btn {
    padding: 10px 14px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.2s;
  }
  .btn.orange { background: #ff7b00; color: #fff; }
  .btn.orange:hover { background: #e66e00; transform: translateY(-2px); }
  .btn.white {
    background: #fff; color: #ff7b00; border: 2px solid #ff7b00;
  }
  .btn.white:hover {
    background: #ff7b00; color: #fff;
  }

  footer {
    text-align: center;
    font-size: 0.9rem;
    color: #555;
    margin-top: 30px;
  }

  @media (max-width: 768px) {
    .header h1 { font-size: 1.2rem; }
    th, td { font-size: 0.85rem; }
  }
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <img src="/sistema-produccion/public/img/coraqua.png" alt="Logo CORAQUA">
    <h1>CONTROL DE SAL EN ALMACÉN</h1>
    <div class="meta"><strong>CÓDIGO:</strong> CORAQUA BPA-2 | <strong>VERSIÓN:</strong> 2.0</div>
  </div>

  <div class="info-grid">
    <div><label for="fecha">Fecha</label><input id="fecha" type="date"></div>
    <div><label for="sede">Sede</label>
      <select id="sede">
        <option value="">Seleccione sede</option>
        <option>Chichillapi</option>
        <option>Cambruni</option>
      </select>
    </div>
    <div><label for="encargado">Encargado</label><input id="encargado" type="text" placeholder="Nombre del encargado"></div>
    <div><label for="mes">Mes</label>
      <select id="mes">
        <option value="">Seleccione mes</option>
        <option>Enero</option><option>Febrero</option><option>Marzo</option>
        <option>Abril</option><option>Mayo</option><option>Junio</option>
        <option>Julio</option><option>Agosto</option><option>Setiembre</option>
        <option>Octubre</option><option>Noviembre</option><option>Diciembre</option>
      </select>
    </div>
  </div>

  <div class="section-title">Detalle de Control de Sal</div>

  <div class="table-container">
    <table id="tablaSal">
      <thead>
        <tr><th>#</th><th>FECHA</th><th>CANTIDAD</th><th>NOMBRE DEL PRODUCTO</th><th>OBSERVACIONES</th></tr>
      </thead>
      <tbody id="bodySal">
        <tr>
          <td>1</td>
          <td><input type="date" name="fecha_detalle[]"></td>
          <td><input type="number" step="0.01" name="cantidad[]" placeholder="Kg / Unid"></td>
          <td><input type="text" name="nombre_sal[]" placeholder="Ej. Sal industrial"></td>
          <td><input type="text" name="observaciones[]" placeholder="Ej. Buen estado"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="actions">
    <div class="left">
      <button class="btn orange" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn orange" onclick="eliminarFila()">➖ Eliminar fila</button>
      <button class="btn orange" onclick="guardarDatos()">💾 Guardar</button>
    </div>
    <div class="right">
      <button class="btn white" onclick="verListado()">📄 Ver Listado</button>
      <button class="btn white" onclick="volverAtras()">⬅️ Volver Panel</button>
    </div>
  </div>

  <footer>© 2025 CORAQUA — Sistema de Control de Sal en Almacén</footer>
</div>

<!-- Formulario oculto -->
<form id="formBPA2" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA2" style="display:none;">
  <input type="hidden" id="hiddenFecha" name="fecha">
  <input type="hidden" id="hiddenSede" name="sede">
  <input type="hidden" id="hiddenEncargado" name="encargado">
  <input type="hidden" id="hiddenMes" name="mes">
  <input type="hidden" name="enviar_reporte" value="1">
</form>

<script>
function agregarFila() {
  const tbody = document.getElementById('bodySal');
  const n = tbody.rows.length + 1;
  const hoy = new Date().toISOString().split('T')[0];
  const fila = document.createElement('tr');
  fila.innerHTML = `
    <td>${n}</td>
    <td><input type="date" name="fecha_detalle[]" value="${hoy}"></td>
    <td><input type="number" step="0.01" name="cantidad[]" placeholder="Kg / Unid"></td>
    <td><input type="text" name="nombre_sal[]" placeholder="Ej. Sal industrial"></td>
    <td><input type="text" name="observaciones[]" placeholder="Ej. Buen estado"></td>`;
  tbody.appendChild(fila);
}

function eliminarFila() {
  const tbody = document.getElementById('bodySal');
  if (tbody.rows.length > 1) tbody.deleteRow(-1);
  else alert('Debe quedar al menos una fila.');
}

function guardarDatos() {
  const fecha = document.getElementById('fecha').value;
  const sede = document.getElementById('sede').value;
  const encargado = document.getElementById('encargado').value;
  const mes = document.getElementById('mes').value;

  if (!fecha || !sede || !encargado || !mes) {
    alert('⚠️ Por favor complete todos los campos del formulario');
    return;
  }

  const filas = document.querySelectorAll('#bodySal tr');
  const datos = [];

  filas.forEach(tr => {
    const inputs = tr.querySelectorAll('input');
    const fila = {
      fecha_detalle: inputs[0].value,
      cantidad: inputs[1].value,
      nombre_sal: inputs[2].value,
      observaciones: inputs[3].value
    };
    datos.push(fila);
  });

  const form = document.getElementById('formBPA2');
  document.getElementById('hiddenFecha').value = fecha;
  document.getElementById('hiddenSede').value = sede;
  document.getElementById('hiddenEncargado').value = encargado;
  document.getElementById('hiddenMes').value = mes;

  form.querySelectorAll('input[name^="fila"]').forEach(el => el.remove());

  datos.forEach(fila => {
    for (const key in fila) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = key + '[]';
      input.value = fila[key];
      form.appendChild(input);
    }
  });

  if (confirm('¿Desea guardar todos los registros ingresados?')) form.submit();
}

function verListado() {
  window.location.href = "/sistema-produccion/public/Inventario/listarBPA2";
}

function volverAtras() {
  window.location.href = "/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloInventario#";
}

// ✅ Fecha actual por defecto y 5 filas iniciales con fecha de hoy
document.addEventListener('DOMContentLoaded', () => {
  const hoy = new Date().toISOString().split('T')[0];
  document.getElementById('fecha').value = hoy;
  const fila1 = document.querySelector('#bodySal tr input[type="date"]');
  if (fila1) fila1.value = hoy;
  for (let i = 0; i < 4; i++) agregarFila();
});
</script>
</body>
</html>

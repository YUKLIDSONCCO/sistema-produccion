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
    min-height: 100vh;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333;
    padding: 30px 16px;
  }

  .container {
    max-width: 1200px;
    margin: 18px auto;
    background: #fff;
    border-radius: 14px;
    padding: 28px 32px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    border-top: 7px solid #ff7b00;
    animation: fadeIn 0.6s ease;
  }
  @keyframes fadeIn { from {opacity:0; transform:translateY(8px)} to {opacity:1; transform:none} }

  /* ===== Encabezado ===== */
  .header-row {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
  }
  .logo {
    width: 72px; height: 72px;
    margin-bottom: 8px;
  }
  .logo img { width: 100%; height: auto; }

  .title-block h1 {
    margin: 0;
    font-size: 1.25rem;
    color: #ff7b00;
    letter-spacing: 0.2px;
    font-weight: 700;
  }
  .meta {
    margin-top:6px;
    color:#555;
    font-size:0.9rem;
  }
  .meta strong { color:#ff7b00; }

  /* ===== Wizard ===== */
  .wizard {
    display:flex;
    justify-content:center;
    align-items:flex-start;
    gap:72px;
    margin:22px auto 10px;
    flex-wrap:wrap;
  }
  .step {
    display:flex;
    flex-direction:column;
    align-items:center;
    position:relative;
    cursor:pointer;
    width:100px;
  }
  .step:not(:last-child)::after {
    content:"";
    position:absolute;
    top:22px;
    right:-56px;
    width:112px;
    height:3px;
    background:#e6e6e6;
    z-index:0;
  }
  .circle {
    width:48px; height:48px;
    border-radius:50%;
    background:#ddd;
    display:flex; align-items:center; justify-content:center;
    font-weight:700; color:#fff; z-index:1;
    transition:all .25s ease;
    font-size:1rem;
  }
  .label {
    margin-top:8px;
    font-weight:600;
    font-size:0.92rem;
    color:#555;
    text-align:center;
  }
  .step.active .circle { background:#ff7b00; box-shadow:0 0 12px #ffb366; transform:translateY(-2px);}
  .step.active .label { color:#ff7b00; }
  .step:hover .circle { transform:translateY(-3px); box-shadow:0 6px 18px rgba(0,0,0,0.08); }

  /* ===== Wizard contenido ===== */
  .wizard-panel {
    margin: 8px auto 20px;
    max-width: 880px;
    text-align: center;
  }
  .wizard-content {
    display: none;
    opacity: 0;
    transform: translateY(6px);
    transition: all .35s ease;
  }
  .wizard-content.active {
    display: block;
    opacity: 1;
    transform: none;
  }
  .download-btn {
    display:inline-block;
    background:#ff7b00;
    color:#fff;
    border:none;
    padding:10px 16px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition: background .18s, transform .12s;
  }
  .download-btn:hover { background:#e66e00; transform:translateY(-2px); }

  /* ===== Formulario ===== */
  .info-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:14px;
    margin-top:20px;
  }
  label { display:block; font-weight:600; color:#333; margin-bottom:6px; font-size:0.92rem; }
  input[type="text"], input[type="date"], select {
    width:100%; padding:9px 10px; border-radius:8px; border:1px solid #d8d8d8;
    font-size:0.95rem; transition: box-shadow .15s, border-color .15s;
  }
  input:focus, select:focus { outline:none; border-color:#ff7b00; box-shadow:0 0 6px rgba(255,123,0,0.12); }

  /* ===== Tabla ===== */
  .section-title {
    background:#ffeedb; color:#ff7b00; padding:8px 12px; border-radius:8px; font-weight:700; margin-top:20px;
  }
  .table-container { overflow:auto; margin-top:10px; }
  table { width:100%; border-collapse:collapse; min-width:900px; }
  th, td { padding:8px 6px; border:1px solid #e6e6e6; text-align:center; font-size:0.92rem; }
  th { background:#ff7b00; color:#fff; }
  td input { width:100%; border:none; background:transparent; padding:4px; text-align:center; }
  td input:focus { background:#fff7f0; outline:none; }

  /* ===== Botones ===== */
  .actions {
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:12px;
    margin-top:18px;
  }
  .btn { background:#ff7b00; color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:700; }
  .btn:hover { background:#e66e00; transform:translateY(-2px); }
  .btn.secondary { background:#fff; color:#ff7b00; border:2px solid #ff7b00; }
  .btn.secondary:hover { background:#ff7b00; color:#fff; }

  footer { text-align:center; color:#666; font-size:0.88rem; margin-top:20px; }

</style>
</head>
<body>

<div class="container">

  <!-- Logo y título centrado -->
  <div class="header-row">
    <div class="logo">
      <img src="img/logo-coraqua.png" alt="Logo CORAQUA" />
    </div>
    <div class="title-block">
      <h1>CONTROL DE DOSIFICACIÓN DE SUPLEMENTOS Y MEDICAMENTOS</h1>
      <div class="meta">
        <span><strong>CÓDIGO:</strong> CORAQUA BPA-4</span> |
        <span><strong>REVISIÓN:</strong> 2.0</span> |
      </div>
    </div>
  </div>

  <!-- Wizard -->
  <div class="wizard">
    <div class="step active" onclick="mostrarPaso(1)">
      <div class="circle">1</div>
      <div class="label">Semanal</div>
    </div>
    <div class="step" onclick="mostrarPaso(2)">
      <div class="circle">2</div>
      <div class="label">Mensual</div>
    </div>
    <div class="step" onclick="mostrarPaso(3)">
      <div class="circle">3</div>
      <div class="label">Anual</div>
    </div>
  </div>

  <div class="wizard-panel">
    <div id="contenido1" class="wizard-content active">
      <p>📅 Descargar reporte semanal en Excel</p>
      <button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button>
    </div>
    <div id="contenido2" class="wizard-content">
      <p>🗓️ Descargar reporte mensual en Excel</p>
      <button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button>
    </div>
    <div id="contenido3" class="wizard-content">
      <p>📊 Descargar reporte anual en Excel</p>
      <button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button>
    </div>
  </div>

  <!-- Formulario -->
  <div class="info-grid">
    <div><label for="fecha">Fecha</label><input id="fecha" type="date" /></div>
    <div><label for="sede">Sede</label><input id="sede" type="text" placeholder="Ejemplo: Piscigranja Principal" /></div>
    <div><label for="encargado">Encargado</label><input id="encargado" type="text" placeholder="Nombre del encargado" /></div>
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

  <!-- Tabla -->
  <div class="section-title">Detalle de Dosificación</div>
  <div class="table-container">
    <!-- En la tabla, agregar la columna de observaciones -->
<table id="tablaDosificacion">
  <thead>
    <tr>
      <th>#</th>
      <th>FECHA</th>
      <th>MEDICAMENTO O SUPLEMENTO</th>
      <th>DOSIS (gr)</th>
      <th>DIAS DE TRATAMIENTO</th>
      <th>LOTE / ALEVINES</th>
      <th>SALA</th>
      <th>RESPONSABLE</th>
      <th>OBSERVACIONES</th> <!-- NUEVA COLUMNA -->
    </tr>
  </thead>
  <tbody id="bodyDosificacion">
    <tr>
      <td>1</td>
      <td><input type="date" /></td>
      <td><input type="text" placeholder="Nombre del medicamento o suplemento" /></td>
      <td><input type="number" step="0.01" placeholder="gr" /></td>
      <td><input type="number" step="1" placeholder="Días" /></td>
      <td><input type="text" placeholder="Lote o alevines" /></td>
      <td><input type="text" placeholder="Sala" /></td>
      <td><input type="text" placeholder="Responsable" /></td>
      <td><input type="text" placeholder="Observaciones" /></td> <!-- NUEVO CAMPO -->
    </tr>
  </tbody>
</table>
  </div>

  <!-- Acciones -->
     <div class="actions">
    <div class="left-actions">
      <button class="btn" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn" onclick="eliminarFila()">➖ Quitar fila</button>
      <button class="btn" id="btnGuardarEnviar" onclick="guardarDatos()">💾 Guardar y Enviar Reporte</button>
    </div>

    <div class="right-actions">
      <button class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
      <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
    </div>
  </div>

  <footer>CORAQUA © 2025 — Control de Dosificación de Suplementos y Medicamentos</footer>
</div>
<!-- Agregar esto antes del cierre del </body> en bpa4.php -->

<!-- Formulario oculto para enviar datos -->
<form id="formBPA4" style="display: none;" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA4">
    <input type="hidden" name="fecha" id="hiddenFecha">
</form>
<form id="formBPA4" style="display:none" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA4">
  <input type="hidden" name="fecha" id="hiddenFecha">
  <input type="hidden" name="sede" id="hiddenSede">
  <input type="hidden" name="encargado" id="hiddenEncargado">
  <input type="hidden" name="mes" id="hiddenMes">
  <input type="hidden" name="enviar_reporte" value="1">
  <div id="inputsDetalles"></div>
</form>

<script>
// ===================== GUARDAR DATOS =====================
function guardarDatos() {
  const fecha = document.getElementById('fecha').value;
  const sede = document.getElementById('sede')?.value || '';
  const encargado = document.getElementById('encargado')?.value || '';
  const mes = document.getElementById('mes')?.value || '';

  if (!fecha || !sede || !encargado || !mes) {
    alert('⚠️ Por favor complete todos los campos obligatorios (fecha, sede, encargado, mes)');
    return;
  }

  const filas = document.querySelectorAll('#bodyDosificacion tr');
  const medicamentos = [], dosis_gr = [], dias_tratamiento = [],
        lotes_alevines = [], salas = [], responsables = [], observaciones = [];

  let datosValidos = false;

  filas.forEach(fila => {
    const inputs = fila.querySelectorAll('input');
    const medicamento = inputs[1]?.value || '';
    const dosis = inputs[2]?.value || '';
    const dias = inputs[3]?.value || '';
    const lote_alevines = inputs[4]?.value || '';
    const sala = inputs[5]?.value || '';
    const responsable = inputs[6]?.value || '';
    const obs = inputs[7]?.value || '';

    medicamentos.push(medicamento);
    dosis_gr.push(dosis);
    dias_tratamiento.push(dias);
    lotes_alevines.push(lote_alevines);
    salas.push(sala);
    responsables.push(responsable);
    observaciones.push(obs);

    if (medicamento && dosis) datosValidos = true;
  });

  if (!datosValidos) {
    alert('⚠️ Ingrese al menos un medicamento y su dosis en la tabla.');
    return;
  }

  const form = document.getElementById('formBPA4');
  document.getElementById('hiddenFecha').value = fecha;
  document.getElementById('hiddenSede').value = sede;
  document.getElementById('hiddenEncargado').value = encargado;
  document.getElementById('hiddenMes').value = mes;

  const existing = form.querySelectorAll('input[name^="medicamento_suplemento"],input[name^="dosis_gr"],input[name^="dias_tratamiento"],input[name^="lote_alevines"],input[name^="sala"],input[name^="responsable"],input[name^="observaciones"]');
  existing.forEach(e => e.remove());

  medicamentos.forEach(v => form.appendChild(hidden('medicamento_suplemento[]', v)));
  dosis_gr.forEach(v => form.appendChild(hidden('dosis_gr[]', v)));
  dias_tratamiento.forEach(v => form.appendChild(hidden('dias_tratamiento[]', v)));
  lotes_alevines.forEach(v => form.appendChild(hidden('lote_alevines[]', v)));
  salas.forEach(v => form.appendChild(hidden('sala[]', v)));
  responsables.forEach(v => form.appendChild(hidden('responsable[]', v)));
  observaciones.forEach(v => form.appendChild(hidden('observaciones[]', v)));

  if (confirm('¿Desea guardar y enviar el reporte?')) form.submit();
}

// Crear input hidden dinámico
function hidden(name, value) {
  const input = document.createElement('input');
  input.type = 'hidden';
  input.name = name;
  input.value = value;
  return input;
}

// ===================== TABLA =====================
function agregarFila() {
  const tbody = document.getElementById('bodyDosificacion');
  const n = tbody.rows.length + 1;
  const fechaPrincipal = document.getElementById('fecha').value;

  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td>${n}</td>
    <td><input type="date" value="${fechaPrincipal}"></td>
    <td><input type="text" placeholder="Medicamento o suplemento"></td>
    <td><input type="number" step="0.01" placeholder="Dosis (gr)"></td>
    <td><input type="number" step="1" placeholder="Días de tratamiento"></td>
    <td><input type="text" placeholder="Lote o alevines"></td>
    <td><input type="text" placeholder="Sala"></td>
    <td><input type="text" placeholder="Responsable"></td>
    <td><input type="text" placeholder="Observaciones"></td>`;
  tbody.appendChild(tr);
}

function eliminarFila() {
  const tbody = document.getElementById('bodyDosificacion');
  if (tbody.rows.length > 1) tbody.deleteRow(-1);
  else alert('Debe quedar al menos una fila.');
}

// ===================== SINCRONIZACIÓN =====================
function sincronizarFechasTabla() {
  const fechaPrincipal = document.getElementById('fecha').value;
  document.querySelectorAll('#bodyDosificacion input[type="date"]').forEach(i => i.value = fechaPrincipal);
}

// ===================== BOTONES =====================
function agregarBotonGuardar() {
  const leftActions = document.querySelector('.left-actions');
  if (!leftActions.querySelector('#btnGuardarEnviar')) {
    const btn = document.createElement('button');
    btn.id = 'btnGuardarEnviar';
    btn.type = 'button';
    btn.className = 'btn';
    btn.innerHTML = '💾 Guardar y Enviar Reporte';
    btn.onclick = guardarDatos;
    leftActions.appendChild(btn);
  }
}

function verListado() {
  window.location.href = "/sistema-produccion/public/Inventario/listarBPA4";
}

function volverAtras() {
  window.location.href = "/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloInventario#";
}

function descargarExcel(tipo) {
  alert('📁 Se generará el archivo Excel: Dosificación_' + tipo + '.xlsx (simulado)');
}

// ===================== WIZARD (pasos) =====================
function mostrarPaso(n) {
  const steps = document.querySelectorAll('.step');
  const contents = document.querySelectorAll('.wizard-content');
  steps.forEach((s, i) => s.classList.toggle('active', i === n - 1));
  contents.forEach((c, i) => c.classList.toggle('active', i === n - 1));
}

// ===================== INICIALIZACIÓN =====================
document.addEventListener('DOMContentLoaded', () => {
  agregarBotonGuardar();

  const fechaInput = document.getElementById('fecha');
  if (fechaInput && !fechaInput.value) {
    fechaInput.value = new Date().toISOString().split('T')[0];
  }

  sincronizarFechasTabla();
  fechaInput.addEventListener('change', sincronizarFechasTabla);
});
</script>

</body>
</html>

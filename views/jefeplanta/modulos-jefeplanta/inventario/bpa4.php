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
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Acciones -->
  <div class="actions">
    <div class="left-actions">
      <button class="btn" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn" onclick="eliminarFila()">➖ Quitar fila</button>
    </div>

    <div class="right-actions">
      <button class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
      <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
    </div>
  </div>

  <footer>CORAQUA © 2025 — Control de Dosificación de Suplementos y Medicamentos</footer>
</div>

<script>
function mostrarPaso(n){
  const steps=document.querySelectorAll('.step');
  const contents=document.querySelectorAll('.wizard-content');
  steps.forEach((s,i)=>s.classList.toggle('active',i===n-1));
  contents.forEach((c,i)=>c.classList.toggle('active',i===n-1));
}

function agregarFila(){
  const tbody=document.getElementById('bodyDosificacion');
  const n=tbody.rows.length+1;
  const tr=document.createElement('tr');
  tr.innerHTML=`
    <td>${n}</td>
    <td><input type="date" /></td>
    <td><input type="text" placeholder="Nombre del medicamento o suplemento" /></td>
    <td><input type="number" step="0.01" placeholder="gr" /></td>
    <td><input type="number" step="1" placeholder="Días" /></td>
    <td><input type="text" placeholder="Lote o alevines" /></td>
    <td><input type="text" placeholder="Sala" /></td>
    <td><input type="text" placeholder="Responsable" /></td>`;
  tbody.appendChild(tr);
}
function eliminarFila(){
  const tbody=document.getElementById('bodyDosificacion');
  if(tbody.rows.length>1){tbody.deleteRow(-1);}
  else{alert('Debe quedar al menos una fila.');}
}
function descargarExcel(tipo){
  alert('📁 Se generará el archivo Excel: Dosificacion_'+tipo+'.xlsx (simulado)');
}
function verListado(){alert('📅 Mostrando listado diario (simulado).');}
function volverAtras(){window.history.back();}
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES — CORAQUA</title>

<!-- Fuentes -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

<style>
  :root{
    --cora-orange:#ff7b00;
    --cora-dark:#0f2b2b;
    --bg-1: linear-gradient(135deg,#fffaf2 0%, #fff1e0 40%, #f6fbff 100%);
    --card-bg: rgba(255,255,255,0.98);
    --glass: rgba(255,255,255,0.6);
    --muted:#6b6b6b;
    --accent:#0f5660;
    --radius:12px;
    --soft-shadow: 0 8px 30px rgba(15,43,43,0.06);
  }

  *{box-sizing:border-box}
  body{
    margin:0; min-height:100vh;
    font-family:Inter, Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background: var(--bg-1);
    color:var(--cora-dark);
    padding:32px;
    -webkit-font-smoothing:antialiased;
    -moz-osx-font-smoothing:grayscale;
  }

  .container{
    max-width:1100px; margin: 18px auto;
    background:var(--card-bg);
    border-radius:16px;
    padding:26px;
    box-shadow:var(--soft-shadow);
    border-top:6px solid rgba(255,123,0,0.95);
    transform: translateY(6px);
    animation: enter .5s ease both;
  }
  @keyframes enter { from{opacity:0; transform:translateY(12px)} to{opacity:1; transform:none} }

  /* Header */
  .header {
    display:flex; align-items:center; gap:18px; justify-content:space-between;
    margin-bottom:12px;
  }
  .brand {
    display:flex; gap:14px; align-items:center;
  }
  .logo {
    width:86px; height:86px; border-radius:10px;
    background: linear-gradient(180deg, #ffffff 0%, rgba(255,255,255,0.6) 100%);
    display:flex; align-items:center; justify-content:center;
    box-shadow: 0 6px 20px rgba(15,43,43,0.06);
    border:1px solid rgba(15,43,43,0.04);
    overflow:hidden;
  }
  .logo img{ width:76px; height:auto; object-fit:contain; }

  .title-col {
    display:flex; flex-direction:column;
  }
  .title-col h1{
    margin:0; font-size:1.25rem; color:var(--cora-dark); font-weight:700;
    letter-spacing:0.2px;
  }
  .meta {
    margin-top:6px; color:var(--muted); font-size:0.9rem;
  }
  .meta strong{ color:var(--cora-orange); margin-right:6px; font-weight:700; }

  /* Controls right */
  .header-actions { display:flex; gap:10px; align-items:center; }

  .badge {
    background: linear-gradient(90deg,var(--cora-orange), #ff9a4a);
    color:white; padding:8px 12px; border-radius:10px; font-weight:700;
    box-shadow: 0 6px 20px rgba(255,123,0,0.14);
  }

  /* Wizard */
  .wizard {
    margin-top:18px; display:flex; gap:18px; align-items:center; justify-content:center;
    padding:12px; border-radius:14px;
    background: linear-gradient(90deg, rgba(15,86,96,0.03), rgba(255,123,0,0.02));
    border:1px solid rgba(15,43,43,0.03);
  }

  .step {
    display:flex; flex-direction:column; align-items:center; gap:8px; cursor:pointer;
    width:120px; text-align:center;
  }
  .progress {
    width:100%; height:8px; background: #f0f0f0; border-radius:999px; overflow:hidden;
    margin-top:10px;
  }
  .progress > i{ display:block; height:100%; width:33.333%; background: linear-gradient(90deg,var(--cora-orange),#ffab6a); transition:width .35s ease; }

  .circle {
    width:46px; height:46px; border-radius:50%; display:flex; align-items:center; justify-content:center;
    background: #fff; border:2px solid #eee; box-shadow: 0 6px 18px rgba(2,8,8,0.04);
    font-weight:700; color:var(--cora-dark);
  }
  .label { font-size:0.9rem; color:var(--muted); font-weight:600; }

  .step.active .circle { background:var(--cora-orange); color:white; box-shadow: 0 8px 26px rgba(255,123,0,0.18); transform:translateY(-4px); }
  .step.active .label { color:var(--cora-orange); }

  /* Form grid */
  .grid {
    display:grid; grid-template-columns:repeat(12,1fr); gap:14px; margin-top:18px;
    align-items:start;
  }
  .card {
    grid-column: span 12;
    background: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.97));
    padding:16px; border-radius:12px; border:1px solid rgba(15,43,43,0.03);
    box-shadow:0 6px 22px rgba(2,8,8,0.03);
  }

  /* info row */
  .info-row { display:flex; gap:12px; flex-wrap:wrap; }
  .field { flex:1 1 220px; min-width:160px; display:flex; flex-direction:column; gap:6px; }
  label{ font-weight:700; color:var(--cora-dark); font-size:0.88rem; }
  input[type="text"], input[type="time"], input[type="date"], select {
    padding:10px 12px; border-radius:10px; border:1px solid #e6e6e6; font-size:0.95rem;
    background:linear-gradient(180deg,#fff,#fffdf9);
  }
  input:focus, select:focus{ outline:none; box-shadow: 0 6px 18px rgba(15,43,43,0.05); border-color: rgba(255,123,0,0.9); }

  /* table */
  .section-title {
    margin-top:14px; display:flex; align-items:center; justify-content:space-between;
  }
  .section-title h3{ margin:0; font-size:1rem; color:var(--cora-dark); }
  .section-note{ color:var(--muted); font-size:0.88rem; }

  .table-wrap { overflow:auto; margin-top:10px; border-radius:10px; border:1px solid #f0f0f0; }
  table { width:100%; border-collapse:collapse; min-width:760px; background:white; }
  thead th { background: linear-gradient(90deg,var(--cora-orange), #ff9a4a); color:white; font-weight:700; padding:10px; position:sticky; top:0; text-align:center; }
  th, td { padding:10px 8px; border-bottom:1px solid #f4f4f4; text-align:center; font-size:0.95rem; }
  tbody tr:hover{ background: linear-gradient(90deg, rgba(255,123,0,0.03), rgba(15,86,96,0.01)); }

  td input[type="text"], td input[type="number"], td input[type="time"], td input[type="date"]{
    width:100%; padding:8px; border-radius:8px; border:1px solid #eee; text-align:center;
    background:transparent;
  }

  /* actions */
  .actions { margin-top:16px; display:flex; justify-content:space-between; gap:12px; align-items:center; flex-wrap:wrap; }
  .btn {
    background:var(--cora-orange); color:white; border:none; padding:10px 14px; border-radius:10px; cursor:pointer;
    font-weight:700; box-shadow: 0 8px 22px rgba(255,123,0,0.14);
  }
  .btn.secondary { background:transparent; color:var(--cora-orange); border:2px solid rgba(255,123,0,0.12); box-shadow:none; }
  .btn.ghost{ background:transparent; color:var(--muted); border:1px solid #eee; }

  footer { margin-top:18px; text-align:center; color:var(--muted); font-size:0.9rem; }

  @media(max-width:900px){
    .wizard{ flex-wrap:wrap; gap:10px; }
    .grid{ grid-template-columns: repeat(6, 1fr); }
    .card{ grid-column: span 6; }
  }
  @media(max-width:640px){
    .grid{ grid-template-columns: repeat(1, 1fr); }
    .card{ grid-column: span 1; }
    .brand { gap:10px; }
    .logo { width:68px; height:68px; }
  }

</style>
</head>
<body>

<div class="container" role="main">

  <!-- HEADER -->
  <div class="header">
    <div class="brand">
      <div class="logo" aria-hidden="true">
        <!-- Reemplaza src con tu logo real -->
        <img src="img/logo-coraqua.png" alt="Logo CORAQUA" />
      </div>
      <div class="title-col">
        <h1>FORMATO N°02 — SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES</h1>
        <div class="meta">
          <span><strong>CÓDIGO:</strong> CORAQUA BPA-01</span>
          &nbsp;|&nbsp;
          <span><strong>VERSIÓN:</strong> 2.0</span>
        </div>
      </div>
    </div>

    <div class="header-actions">
      <div class="badge">OVAS</div>
      <button class="btn secondary" onclick="descargarExcel('pdf')">📄 Exportar PDF</button>
      <button class="btn" id="guardarBtn">💾 Guardar</button>
    </div>
  </div>

  <!-- WIZARD -->
  <div class="wizard" aria-hidden="false">
    <div class="step active" onclick="mostrarPaso(1)">
      <div class="circle">1</div>
      <div class="label">Registro</div>
    </div>
    <div class="step" onclick="mostrarPaso(2)">
      <div class="circle">2</div>
      <div class="label">Verificar</div>
    </div>
    <div class="step" onclick="mostrarPaso(3)">
      <div class="circle">3</div>
      <div class="label">Finalizar</div>
    </div>
    <div style="flex:1 1 100%;">
      <div class="progress" aria-hidden="true"><i id="progressBar"></i></div>
    </div>
  </div>

  <!-- FORM -->
  <div class="grid" role="form">
    <div class="card" id="mainCard">
      <!-- Info principal -->
      <div class="info-row">
        <div class="field">
          <label for="fecha">FECHA</label>
          <input id="fecha" type="date" />
        </div>
        <div class="field">
          <label for="responsable">RESPONSABLE</label>
          <input id="responsable" type="text" placeholder="Nombre del responsable" />
        </div>
        <div class="field">
          <label for="horaInicio">HORA INICIO</label>
          <input id="horaInicio" type="time" />
        </div>
        <div class="field">
          <label for="horaFinal">HORA FINAL</label>
          <input id="horaFinal" type="time" />
        </div>
      </div>

      <!-- ITEMS -->
      <div class="section-title">
        <h3>DETALLE DE REPRODUCTORES Y OVAS</h3>
        <div class="section-note">Rellena las cantidades y observaciones. Al menos una fila con datos.</div>
      </div>

      <div class="table-wrap" aria-live="polite">
        <table id="tablaOvas" role="table" aria-label="Tabla de ovas y reproductores">
          <thead>
            <tr>
              <th>#</th>
              <th>ITEM / DESCRIPCIÓN</th>
              <th>VALOR / CANTIDAD</th>
              <th>OBSERVACIÓN</th>
            </tr>
          </thead>
          <tbody id="bodyOvas">
            <!-- Prellenado con los ítems que nos diste -->
            <tr>
              <td>1</td>
              <td style="text-align:left">CANTIDAD DE REPRODUCTORES HEMBRAS APTAS PARA DESOVE</td>
              <td><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td>
              <td><input type="text" placeholder="Observación" /></td>
            </tr>

            <tr>
              <td>2</td>
              <td style="text-align:left">CANTIDAD DE REPRODUCTORES MACHOS APTOS PARA DESOVE</td>
              <td><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td>
              <td><input type="text" placeholder="Observación" /></td>
            </tr>

            <tr>
              <td>3</td>
              <td style="text-align:left">CANTIDAD DE REPRODUCTORES HEMBRAS DESOVADAS</td>
              <td><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td>
              <td><input type="text" placeholder="Observación (ej: calidad de ovulación)" /></td>
            </tr>

            <tr>
              <td>4</td>
              <td style="text-align:left">CANTIDAD DE REPRODUCTORES MACHOS DESOVADOS</td>
              <td><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td>
              <td><input type="text" placeholder="Observación" /></td>
            </tr>

            <tr>
              <td>5</td>
              <td style="text-align:left">ESTIMACIÓN DE RELACIÓN Nº HEMBRAS / Nº MACHOS</td>
              <td><input type="text" placeholder="Ej: 1:2" /></td>
              <td><input type="text" placeholder="Observación" /></td>
            </tr>

            <tr>
              <td>6</td>
              <td style="text-align:left">VOLUMEN ÓVULOS FERTILIZADOS (LITROS)</td>
              <td><input type="number" step="0.01" min="0" placeholder="Litros" /></td>
              <td><input type="text" placeholder="Observación" /></td>
            </tr>

            <tr>
              <td>7</td>
              <td style="text-align:left">CANTIDAD (NÚMERO DE OVAS FÉRTILES)</td>
              <td><input type="number" step="1" min="0" placeholder="Nº" /></td>
              <td><input type="text" placeholder="Observación" /></td>
            </tr>

            <tr>
              <td>8</td>
              <td style="text-align:left">OBSERVACIONES GENERALES</td>
              <td colspan="2"><input type="text" style="text-align:left" placeholder="Comentarios relevantes sobre la sesión de fertilización" /></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Actions -->
      <div class="actions" role="group" aria-label="Acciones del formulario">
        <div style="display:flex; gap:8px; align-items:center;">
          <button class="btn" type="button" onclick="agregarFila()">➕ Agregar item</button>
          <button class="btn ghost" type="button" onclick="eliminarFila()">➖ Quitar item</button>
          <button class="btn secondary" type="button" onclick="verListado()">📖 Ver Listado</button>
        </div>

        <div style="display:flex; gap:8px; align-items:center;">
          <button class="btn secondary" type="button" onclick="descargarExcel('semana')">⬇️ Descargar Excel</button>
          <button class="btn" id="guardarVisible">💾 Guardar y Enviar</button>
        </div>
      </div>

      <footer> CORAQUA © <span id="anio"></span> — Formato BPA-02 </footer>

    </div>
  </div>

  <!-- Formulario oculto para envío al servidor -->
  <form id="formHidden" style="display:none" method="POST" action="/sistema-produccion/public/Ovas/guardarBPA2">
    <input type="hidden" name="fecha" id="hidden_fecha" />
    <input type="hidden" name="responsable" id="hidden_responsable" />
    <input type="hidden" name="horaInicio" id="hidden_horaInicio" />
    <input type="hidden" name="horaFinal" id="hidden_horaFinal" />
    <!-- Arrays -->
    <!-- Se añadirán inputs hidden dinámicamente: item_desc[], item_valor[], item_obs[] -->
  </form>

</div>

<script>
  // Inicializaciones
  document.getElementById('anio').textContent = new Date().getFullYear();

  // Set fecha por defecto a hoy si está vacío
  (function setFechaDefault(){
    const f = document.getElementById('fecha');
    if(f && !f.value){
      const t = new Date().toISOString().split('T')[0];
      f.value = t;
    }
  })();

  // Wizard progress
  function mostrarPaso(n){
    const steps = document.querySelectorAll('.wizard .step');
    const progress = document.getElementById('progressBar');
    steps.forEach((s,i)=> s.classList.toggle('active', i === (n-1)) );
    if(progress){
      const pct = Math.max(0, Math.min(100, (n-1) * 50));
      progress.style.width = (n===1? '33.333%': n===2? '66.666%':'100%');
    }
  }

  // Tabla manipulación
  function agregarFila(){
    const tbody = document.getElementById('bodyOvas');
    const n = tbody.rows.length + 1;
    const tr = document.createElement('tr');
    tr.innerHTML = `<td>${n}</td>
      <td style="text-align:left"><input type="text" placeholder="Descripción del item" /></td>
      <td><input type="text" placeholder="Valor / Cantidad" /></td>
      <td><input type="text" placeholder="Observación" /></td>`;
    tbody.appendChild(tr);
  }

  function eliminarFila(){
    const tbody = document.getElementById('bodyOvas');
    // No eliminar los primeros 8 ítems predefinidos (opc: permitir eliminación solo si filas adicionales)
    if(tbody.rows.length > 8){
      tbody.deleteRow(-1);
    } else {
      alert('No se pueden eliminar los ítems predefinidos. Si desea vaciarlos, borre sus valores.');
    }
  }

  // Descargar Excel simulado
  function descargarExcel(tipo){
    const nombres = { semana:'BPA02_Semanal.xlsx', mes:'BPA02_Mensual.xlsx', anio:'BPA02_Anual.xlsx', pdf:'BPA02_Formato.pdf' };
    alert('Se generará (simulado) el archivo: ' + (nombres[tipo] || 'BPA02_Formato.xlsx'));
  }

  // Ver listado (redirige al listar)
  function verListado(){
    window.location.href = "/sistema-produccion/public/Ovas/listarBPA2";
  }

  // Guardar -> arma form oculto y submit
  function recogerYEnviar(){
    // validar campos principales
    const fecha = document.getElementById('fecha').value.trim();
    const responsable = document.getElementById('responsable').value.trim();
    const horaInicio = document.getElementById('horaInicio').value.trim();
    const horaFinal = document.getElementById('horaFinal').value.trim();

    if(!fecha || !responsable){
      alert('Por favor complete al menos FECHA y RESPONSABLE antes de guardar.');
      return;
    }

    // Recolectar tabla
    const tbody = document.getElementById('bodyOvas');
    const item_desc = [];
    const item_valor = [];
    const item_obs = [];

    for(let r=0; r<tbody.rows.length; r++){
      const cols = tbody.rows[r].cells;
      // Si fila predefinida con <td> texto en col 2 o input dependiendo
      let descEl = cols[1].querySelector('input');
      let valorEl = cols[2].querySelector('input');
      let obsEl = cols[3].querySelector('input');

      const desc = descEl ? descEl.value.trim() : cols[1].textContent.trim();
      const valor = valorEl ? valorEl.value.trim() : cols[2].textContent.trim();
      const obs = obsEl ? obsEl.value.trim() : cols[3].textContent.trim();

      item_desc.push(desc);
      item_valor.push(valor);
      item_obs.push(obs);
    }

    // Validación básica: al menos una cantidad/valor
    const hayDatos = item_valor.some(v => v !== "" && v !== "0");
    if(!hayDatos){
      if(!confirm('No se detectaron valores en la tabla. ¿Desea guardar de todos modos?')) return;
    }

    // Pegar valores en formHidden
    const form = document.getElementById('formHidden');

    // Limpiar dinámicos previos
    Array.from(form.querySelectorAll('input[name^="item_"]')).forEach(n => n.remove());

    document.getElementById('hidden_fecha').value = fecha;
    document.getElementById('hidden_responsable').value = responsable;
    document.getElementById('hidden_horaInicio').value = horaInicio;
    document.getElementById('hidden_horaFinal').value = horaFinal;

    // Agregar arrays
    item_desc.forEach(v => {
      const i = document.createElement('input'); i.type='hidden'; i.name='item_desc[]'; i.value = v; form.appendChild(i);
    });
    item_valor.forEach(v => {
      const i = document.createElement('input'); i.type='hidden'; i.name='item_valor[]'; i.value = v; form.appendChild(i);
    });
    item_obs.forEach(v => {
      const i = document.createElement('input'); i.type='hidden'; i.name='item_obs[]'; i.value = v; form.appendChild(i);
    });

    // Submit
    form.submit();
  }

  // Eventos del botón guardar
  document.getElementById('guardarBtn').addEventListener('click', recogerYEnviar);
  document.getElementById('guardarVisible').addEventListener('click', recogerYEnviar);

  // Mejoras UX: focus visual y accesibilidad
  (function attachEnterToAdd(){
    document.addEventListener('keydown', function(e){
      if(e.key === 'F9'){ agregarFila(); }
    });
  })();

</script>
</body>
</html>

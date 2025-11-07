<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FORMATO N°12 - CONTROL DIARIO DE PARÁMETROS (CORAQUA BPA 12)</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <style>
    * { box-sizing: border-box; font-family: "Poppins", "Segoe UI", sans-serif; }
    :root {
      --orange: #ff7b00;
      --orange-dark: #e66e00;
      --bg-start: #fffaf2;
      --bg-end: #ffd9b3;
      --muted: #666;
    }

    body {
      margin: 0;
      min-height: 100vh;
      background: linear-gradient(135deg,var(--bg-start),var(--bg-end) 60%);
      color: #222;
      padding: 30px 16px;
    }

    .container {
      max-width: 1200px;
      margin: 18px auto;
      background: #fff;
      border-radius: 14px;
      padding: 28px 32px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
      border-top: 7px solid var(--orange);
      animation: fadeIn 0.6s ease;
    }
    @keyframes fadeIn { from {opacity:0; transform:translateY(8px)} to {opacity:1; transform:none} }

    /* ===== Encabezado (estilo BPA 6) ===== */
    .header-row {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      gap: 10px;
      text-align: center;
    }
    .logo {
      width: 85px; height: 85px;
      background: #fff;
      border-radius: 8px;
      padding: 8px;
      display:flex; align-items:center; justify-content:center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .logo img { width:100%; height:auto; object-fit:contain; }

    .title-block h1 {
      margin: 8px 0 0;
      font-size: 1.25rem;
      color: #0f2b2b;
      font-weight: 700;
      letter-spacing: 0.2px;
    }
    .meta {
      margin-top:6px;
      color:var(--muted);
      font-size:0.9rem;
    }
    .meta strong { color:var(--orange); }

    /* ===== Wizard ===== */
    .wizard {
      display:flex;
      justify-content:center;
      align-items:flex-start;
      gap: 80px;
      margin: 20px 0 12px;
      flex-wrap:wrap;
    }
    .step {
      display:flex;
      flex-direction:column;
      align-items:center;
      position:relative;
      cursor:pointer;
      width:100px;
      user-select:none;
    }
    .step:not(:last-child)::after {
      content:"";
      position:absolute;
      top:22px;
      right:-60px;
      width:120px;
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
      transition: all .25s ease;
      font-size:1rem;
    }
    .label {
      margin-top:8px;
      font-weight:600;
      font-size:0.92rem;
      color:#555;
      text-align:center;
    }
    .step.active .circle { background:var(--orange); box-shadow:0 0 12px rgba(255,123,0,0.28); transform:translateY(-2px); }
    .step.active .label { color:var(--orange); }
    .step:hover .circle { transform:translateY(-3px); box-shadow:0 6px 18px rgba(0,0,0,0.08); }

    /* ===== Panel wizard content ===== */
    .wizard-panel {
      margin: 0 auto 0;
      max-width: 880px;
      text-align:left;
    }
    .wizard-content { display:none; opacity:0; transform:translateY(6px); transition: all .35s ease; }
    .wizard-content.active { display:block; opacity:1; transform:none; }

    .download-btn {
      background:var(--orange);
      color:#fff;
      border:none;
      padding:10px 16px;
      border-radius:10px;
      cursor:pointer;
      font-weight:600;
      transition: background .18s, transform .12s;
    }
    .download-btn:hover { background:var(--orange-dark); transform:translateY(-2px); }

    /* ===== Top info and meta ===== */
    .top-info {
      margin-top: 18px;
      display:flex;
      justify-content:space-between;
      gap:12px;
      flex-wrap:wrap;
      align-items:flex-start;
    }
    .card-details{
      background:#f4f4f4;
      padding:10px 12px;
      border-radius:8px;
      font-size:0.95rem;
      border:1px solid #eee;
    }
    .meta-fields{
      display:flex;
      gap:12px;
      margin-top:8px;
      flex-wrap:wrap;
    }
    .meta-fields .field{ flex:1 1 200px; min-width:160px; }
    label.small{ display:block; font-weight:600; margin-bottom:6px; color:#333; font-size:0.92rem; }
    input[type="text"], input[type="date"], input[type="number"], select {
      width:100%; padding:9px 10px; border-radius:8px; border:1px solid #d8d8d8; font-size:0.95rem;
      transition: box-shadow .15s, border-color .15s; background:transparent;
    }
    input:focus, select:focus { outline:none; border-color:var(--orange); box-shadow:0 0 6px rgba(255,123,0,0.12); }

    /* ===== Tabla ===== */
    .table-container { overflow:auto; margin-top:10px; }
    table { width:100%; border-collapse:collapse; min-width:900px; }
    th, td { padding:8px 6px; border:1px solid #e6e6e6; text-align:center; font-size:0.92rem; vertical-align:middle; }
    th { background:var(--orange); color:#fff; position:sticky; top:0; z-index:2; }
    tbody tr { background: #fffaf0; }
    tbody tr:nth-child(even) { background: #fff6ea; }

    td input { width:100%; border:none; background:transparent; padding:6px; text-align:center; font-size:0.92rem; }
    td input:focus { background:#fff7f0; outline:none; border-radius:6px; box-shadow: 0 6px 18px rgba(255,123,0,0.06); }

    .subheader { background:#ffeedb; font-weight:700; color:var(--orange); }

    /* ===== Buttons area ===== */
    .actions { display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-top:18px; }
    .left-actions, .right-actions { display:flex; gap:10px; align-items:center; }
    .btn { background:var(--orange); color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:700; }
    .btn:hover { background:var(--orange-dark); transform:translateY(-2px); }
    .btn.secondary { background:#fff; color:var(--orange); border:2px solid var(--orange); }
    .btn.secondary:hover { background:var(--orange); color:#fff; }
    .btn.ghost { background:transparent; color:#444; border:1px solid #eee; }

    footer { text-align:center; color:var(--muted); font-size:0.88rem; margin-top:20px; }

    /* responsive tweaks */
    @media (max-width:900px){
      .wizard { gap:34px; }
      .step:not(:last-child)::after { right:-44px; width:88px; }
      .container { padding:20px; }
      table { min-width:700px; }
    }
    @media (max-width:640px){
      .wizard { gap:20px; }
      .step:not(:last-child)::after { display:none; }
      .step { width:84px; }
      .meta-fields { grid-template-columns: 1fr; }
    }

    /* small helpers */
    .muted { color:var(--muted); font-size:0.9rem; }
    .small { font-size:0.85rem; color:#444; }
  </style>
</head>
<body>
  <div class="container">

    <!-- Encabezado -->
    <div class="header-row">
      <div class="logo">
        <img src="/ruta/a/logo_coraqua.png" alt="Logo CORAQUA" onerror="this.style.display='none'"/>
      </div>

      <div class="title-block">
        <h1>FORMATO N°12 - CONTROL DIARIO DE PARÁMETROS</h1>
        <div class="meta">
          <span><strong>CÓDIGO:</strong> CORAQUA BPA 12</span>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <span><strong>VERSIÓN:</strong> 2.0</span>
        </div>
      </div>
    </div>

    <!-- Wizard -->
    <div class="wizard" role="tablist" aria-label="Descargas">
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

    <!-- Descargas (panel) -->
    <div class="wizard-panel">
      <div id="contenido1" class="wizard-content active">
        <p class="small">📅 Descargar reporte semanal en Excel</p>
        <button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button>
      </div>
      <div id="contenido2" class="wizard-content">
        <p class="small">🗓️ Descargar reporte mensual en Excel</p>
        <button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button>
      </div>
      <div id="contenido3" class="wizard-content">
        <p class="small">📊 Descargar reporte anual en Excel</p>
        <button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button>
      </div>
    </div>

    <!-- Formulario superior (Mes / Sede) y detalles -->
    <div class="top-info" aria-label="Información general">
      <div class="left">
        <div class="card-details">
          <p><strong>CÓDIGO:</strong> CORAQUA BPA 12</p>
          <p><strong>VERSIÓN:</strong> 2.0</p>
          <p><strong>FECHA:</strong> 03/08/2020</p>
        </div>
      </div>

      <div class="right">
        <div class="meta-fields">
          <div class="field">
            <label class="small" for="mes">Mes</label>
            <input id="mes" type="text" name="mes" placeholder="Ej: Marzo">
          </div>
          <div class="field">
            <label class="small" for="sede">Sede</label>
            <input id="sede" type="text" name="sede" placeholder="Ej: Estanque 01">
          </div>
        </div>

        <div style="margin-top:12px; display:flex; gap:10px; flex-wrap:wrap;">
          <button class="btn secondary" id="btnExcelSemanaTop" onclick="descargarExcel('semana')">📅 Semana (Excel)</button>
          <button class="btn secondary" id="btnExcelMesTop" onclick="descargarExcel('mes')">🗓️ Mes (Excel)</button>
          <button class="btn secondary" id="btnExcelAnioTop" onclick="descargarExcel('anio')">📆 Año (Excel)</button>
          <button class="btn secondary" id="btnPDFTop" onclick="generarPDF()">🧾 PDF</button>
        </div>
      </div>
    </div>

    <!-- Tabla principal (estructura exacta del BPA 12) -->
    <div class="table-container" role="region" aria-label="Tabla de parámetros">
      <table id="tablaParametros">
        <thead>
          <tr>
            <th rowspan="2">DÍA</th>
            <th colspan="3">6:30 a.m</th>
            <th colspan="3">12:00 m</th>
            <th colspan="3">3:30 p.m</th>
            <th rowspan="2">RESPONSABLE</th>
            <th rowspan="2">OBS</th>
          </tr>
          <tr class="subheader">
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>% SAT</th>
          </tr>
        </thead>
        <tbody id="bodyParametros">
          <tr>
            <td class="dia">1</td>

            <td><input type="number" name="t1_630" step="0.1" /></td>
            <td><input type="number" name="o1_630" step="0.1" /></td>
            <td><input type="number" name="s1_630" step="0.1" /></td>

            <td><input type="number" name="t1_1200" step="0.1" /></td>
            <td><input type="number" name="o1_1200" step="0.1" /></td>
            <td><input type="number" name="s1_1200" step="0.1" /></td>

            <td><input type="number" name="t1_1530" step="0.1" /></td>
            <td><input type="number" name="o1_1530" step="0.1" /></td>
            <td><input type="number" name="s1_1530" step="0.1" /></td>

            <td><input type="text" name="responsable_1" /></td>
            <td><input type="text" name="obs_1" /></td>
          </tr>

          <tr>
            <td class="dia">2</td>

            <td><input type="number" name="t2_630" step="0.1" /></td>
            <td><input type="number" name="o2_630" step="0.1" /></td>
            <td><input type="number" name="s2_630" step="0.1" /></td>

            <td><input type="number" name="t2_1200" step="0.1" /></td>
            <td><input type="number" name="o2_1200" step="0.1" /></td>
            <td><input type="number" name="s2_1200" step="0.1" /></td>

            <td><input type="number" name="t2_1530" step="0.1" /></td>
            <td><input type="number" name="o2_1530" step="0.1" /></td>
            <td><input type="number" name="s2_1530" step="0.1" /></td>

            <td><input type="text" name="responsable_2" /></td>
            <td><input type="text" name="obs_2" /></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Botones de acción -->
    <div class="actions" role="group" aria-label="Acciones">
      <div class="left-actions">
        <button class="btn" type="button" onclick="agregarFila()">➕ Agregar fila</button>
        <button class="btn ghost" type="button" onclick="eliminarFila()">➖ Quitar fila</button>
        <button class="btn secondary" type="button" onclick="verListado()">📖 Ver Listado Diario</button>
      </div>

      <div class="right-actions">
        <button class="btn secondary" type="button" onclick="volverAtras()">⬅️ Volver Atrás</button>
        <button id="guardarBtn" class="btn" type="button" onclick="guardarDatos()">💾 Guardar</button>
      </div>
    </div>

    <footer> CORAQUA © 2025 — Control Diario de Parámetros (BPA 12) </footer>
  </div>

  <script>
    // ====== WIZARD ======
    function mostrarPaso(n){
      const steps = document.querySelectorAll('.step');
      const contents = document.querySelectorAll('.wizard-content');
      steps.forEach((s, i) => s.classList.toggle('active', i === n - 1));
      contents.forEach((c, i) => c.classList.toggle('active', i === n - 1));
    }

    // ====== Tabla - Agregar / Eliminar filas manteniendo names ======
    const tbody = document.getElementById('bodyParametros');

    function getRowCount(){ return tbody.querySelectorAll('tr').length; }

    function agregarFila(){
      const count = getRowCount();
      const newIndex = count + 1;

      // clonar última fila
      const lastRow = tbody.querySelector('tr:last-child');
      let newRow;
      if(lastRow){
        newRow = lastRow.cloneNode(true);
        // limpiar valores
        newRow.querySelectorAll('input').forEach(inp => inp.value = '');
      } else {
        newRow = document.createElement('tr');
        newRow.innerHTML = `
          <td class="dia">${newIndex}</td>
          <td><input type="number" name="t${newIndex}_630" step="0.1" /></td>
          <td><input type="number" name="o${newIndex}_630" step="0.1" /></td>
          <td><input type="number" name="s${newIndex}_630" step="0.1" /></td>

          <td><input type="number" name="t${newIndex}_1200" step="0.1" /></td>
          <td><input type="number" name="o${newIndex}_1200" step="0.1" /></td>
          <td><input type="number" name="s${newIndex}_1200" step="0.1" /></td>

          <td><input type="number" name="t${newIndex}_1530" step="0.1" /></td>
          <td><input type="number" name="o${newIndex}_1530" step="0.1" /></td>
          <td><input type="number" name="s${newIndex}_1530" step="0.1" /></td>

          <td><input type="text" name="responsable_${newIndex}" /></td>
          <td><input type="text" name="obs_${newIndex}" /></td>
        `;
      }

      // actualizar día y names si clonamos
      tbody.appendChild(newRow);
      actualizarIndices();
      newRow.scrollIntoView({behavior:'smooth', block:'center'});
    }

    function eliminarFila(){
      const rows = tbody.querySelectorAll('tr');
      if(rows.length > 1){
        tbody.removeChild(rows[rows.length - 1]);
        actualizarIndices();
      } else {
        alert('Debe quedar al menos una fila.');
      }
    }

    function actualizarIndices(){
      const rows = Array.from(tbody.querySelectorAll('tr'));
      rows.forEach((tr, i) => {
        const idx = i + 1;
        const diaTd = tr.querySelector('td.dia');
        if(diaTd) diaTd.textContent = idx;

        const inputs = tr.querySelectorAll('input');
        const nameMap = [
          `t${idx}_630`,`o${idx}_630`,`s${idx}_630`,
          `t${idx}_1200`,`o${idx}_1200`,`s${idx}_1200`,
          `t${idx}_1530`,`o${idx}_1530`,`s${idx}_1530`,
          `responsable_${idx}`, `obs_${idx}`
        ];
        inputs.forEach((inp, j) => {
          if(nameMap[j]) inp.name = nameMap[j];
        });
      });
    }

    // ====== Acciones extra ======
    function verListado(){
      const mes = document.getElementById('mes')?.value || '';
      const sede = document.getElementById('sede')?.value || '';

      const filas = Array.from(document.querySelectorAll('#bodyParametros tr')).map(tr => {
        const inputs = tr.querySelectorAll('input');
        const obj = {};
        inputs.forEach(inp => obj[inp.name || inp.getAttribute('name') || ('col' + Math.random().toString(36).slice(2,6))] = inp.value);
        return obj;
      });

      const registro = { mes, sede, filas };
      const registros = JSON.parse(localStorage.getItem('bpa12_registros') || '[]');
      registros.push(registro);
      localStorage.setItem('bpa12_registros', JSON.stringify(registros));

      window.location.href = 'index.php?controller=Peces&action=bpa12Listado';
    }

    function volverAtras(){
      if(window.history.length > 1) window.history.back();
      else alert('No hay historial de navegación.');
    }

    // ====== Guardar (simulado) ======
    function guardarDatos(){
      const mes = document.getElementById('mes').value.trim();
      const sede = document.getElementById('sede').value.trim();
      if(!mes || !sede){
        alert('Por favor complete Mes y Sede antes de guardar.');
        return;
      }

      const filas = Array.from(tbody.querySelectorAll('tr')).map(tr => {
        const inputs = tr.querySelectorAll('input');
        const obj = {};
        inputs.forEach(inp => obj[inp.name] = inp.value);
        return obj;
      });

      // validación simple: al menos un campo con dato
      const any = filas.some(f=>{
        return Object.values(f).some(v => v !== '' && v !== null);
      });
      if(!any){
        alert('Ingrese al menos un registro antes de guardar.');
        return;
      }

      console.log({ mes, sede, filas });
      const ok = confirm('¿Deseas guardar (simulado) los datos ingresados?');
      if(!ok) return;
      setTimeout(()=> alert('✅ Datos guardados (simulado). Revisa la consola para ver el objeto con los datos.'), 250);
    }

    // ====== Descarga simulada / PDF ======
    function descargarExcel(tipo){
      const nombres = {
        semana: 'BPA12_Semanal.xlsx',
        mes: 'BPA12_Mensual.xlsx',
        anio: 'BPA12_Anual.xlsx'
      };
      alert('📁 Se generará (simulado) el archivo: ' + (nombres[tipo] || 'BPA12.xlsx'));
      // Integrar SheetJS aquí para export real
    }

    function generarPDF(){
      alert('🧾 Generación de PDF (simulado). Integra jsPDF / html2canvas para PDF real.');
    }

    // ====== Inicialización ======
    (function init(){
      actualizarIndices();
    })();

  </script>
</body>
</html>

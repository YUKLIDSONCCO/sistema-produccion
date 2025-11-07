<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FORMATO N°06 - MORTALIDAD DIARIA DE ALEVINOS (CORAQUA BPA 6)</title>
  
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

    /* ===== Encabezado ===== */
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

    /* ===== Formulario ===== */
    .info-grid {
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
      gap:14px;
      margin-top:18px;
    }
    label { display:block; font-weight:600; color:#333; margin-bottom:6px; font-size:0.92rem; }
    input[type="text"], input[type="date"], input[type="number"], select {
      width:100%; padding:9px 10px; border-radius:8px; border:1px solid #d8d8d8; font-size:0.95rem;
      transition: box-shadow .15s, border-color .15s;
      background:transparent;
    }
    input:focus, select:focus { outline:none; border-color:var(--orange); box-shadow:0 0 6px rgba(255,123,0,0.12); }

    /* ===== Tabla ===== */
    .section-title {
      background:#ffeedb; color:var(--orange); padding:8px 12px; border-radius:8px; font-weight:700; margin-top:20px;
    }
    .table-container { overflow:auto; margin-top:10px; }
    table { width:100%; border-collapse:collapse; min-width:840px; }
    th, td { padding:8px 6px; border:1px solid #e6e6e6; text-align:center; font-size:0.92rem; vertical-align:middle; }
    th { background:var(--orange); color:#fff; position:sticky; top:0; z-index:2; }
    tbody tr { background: #fffaf0; }
    tbody tr:nth-child(even) { background: #fff6ea; }

    td input { width:100%; border:none; background:transparent; padding:6px; text-align:center; font-size:0.92rem; }
    td input:focus { background:#fff7f0; outline:none; border-radius:6px; box-shadow: 0 6px 18px rgba(255,123,0,0.06); }

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
      .info-grid { grid-template-columns: 1fr; }
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
        <!-- reemplaza por tu logo si quieres -->
        <img src="img/logo-coraqua.png" alt="Logo CORAQUA" onerror="this.style.display='none'"/>
      </div>

      <div class="title-block">
        <h1>FORMATO N°06 - MORTALIDAD DIARIA DE ALEVINOS (CORAQUA BPA 6)</h1>
        <div class="meta">
          <span><strong>CÓDIGO:</strong> CORAQUA BPA 6</span>
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

    <!-- Formulario -->
    <div class="info-grid" aria-label="Información general">
      <div>
        <label for="responsable">Responsable</label>
        <input id="responsable" type="text" placeholder="Ej. Juan Pérez">
      </div>
      <div>
        <label for="fecha">Fecha</label>
        <input id="fecha" type="date" />
      </div>
      <div>
        <label for="sede">Sede / Estanque</label>
        <input id="sede" type="text" placeholder="Ej. Estanque 01">
      </div>
      <div>
        <label for="especie">Especie</label>
        <input id="especie" type="text" placeholder="Ej. Trucha arcoíris">
      </div>
    </div>

    <!-- Tabla -->
    <div class="section-title">Detalle - Mortalidad Alevinos</div>
    <div class="table-container" role="region" aria-label="Tabla de mortalidad">
      <table id="tablaMortalidad" aria-describedby="tableDesc">
        <thead>
          <tr>
            <th>#</th>
            <th>U.P.</th>
            <th>LOTE</th>
            <th>MORTALIDAD</th>
            <th>MORBILIDAD</th>
            <th>TOTAL</th>
            <th>OBSERVACIONES</th>
          </tr>
        </thead>
        <tbody id="bodyMortalidad">
          <tr>
            <td class="index">1</td>
            <td><input type="text" placeholder="UP-01" class="up"></td>
            <td><input type="text" placeholder="L-001" class="lote"></td>
            <td><input type="number" min="0" step="1" class="mort" value="0"></td>
            <td><input type="number" min="0" step="1" class="morb" value="0"></td>
            <td><input type="number" min="0" step="1" class="total" value="0" readonly></td>
            <td><input type="text" class="obs" placeholder="Observaciones"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Botones -->
    <div class="actions" role="group" aria-label="Acciones">
      <div class="left-actions">
        <button type="button" class="btn" onclick="agregarFila()">➕ Agregar fila</button>
        <button type="button" class="btn ghost" onclick="eliminarFila()">➖ Quitar fila</button>
        <button type="button" class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
      </div>

      <div class="right-actions">
        <button type="button" class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
        <button id="guardarBtn" type="button" class="btn" onclick="guardarDatos()">💾 Guardar</button>
      </div>
    </div>

    <footer> CORAQUA © 2025 — Mortalidad Diaria Alevinos (BPA 6) </footer>
  </div>

  <script>
    // ====== WIZARD ======
    function mostrarPaso(n){
      const steps = document.querySelectorAll('.step');
      const contents = document.querySelectorAll('.wizard-content');
      steps.forEach((s, i) => s.classList.toggle('active', i === n - 1));
      contents.forEach((c, i) => c.classList.toggle('active', i === n - 1));
    }

    // ====== TABLE FUNCTIONS ======
    function agregarFila(){
      const tbody = document.getElementById('bodyMortalidad');
      const num = tbody.querySelectorAll('tr').length + 1;
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="index">${num}</td>
       
        <td><input type="text" placeholder="UP-${String(num).padStart(2,'0')}" class="up"></td>
        <td><input type="text" placeholder="L-${String(num).padStart(3,'0')}" class="lote"></td>
        <td><input type="number" min="0" step="1" value="0" class="mort"></td>
        <td><input type="number" min="0" step="1" value="0" class="morb"></td>
        <td><input type="number" min="0" step="1" value="0" class="total" readonly></td>
        <td><input type="text" class="obs" placeholder="Observaciones"></td>
      `;
      tbody.appendChild(tr);
      attachRowListeners(tr);
      scrollToRow(tr);
    }

    function eliminarFila(){
      const tbody = document.getElementById('bodyMortalidad');
      const rows = tbody.querySelectorAll('tr');
      if(rows.length > 1){
        tbody.removeChild(rows[rows.length - 1]);
      } else {
        alert('Debe quedar al menos una fila.');
      }
    }

    function recalcRow(row){
      const mort = Number(row.querySelector('.mort').value) || 0;
      const morb = Number(row.querySelector('.morb').value) || 0;
      const total = row.querySelector('.total');
      total.value = mort + morb;
    }

    function attachRowListeners(row){
      const mort = row.querySelector('.mort');
      const morb = row.querySelector('.morb');
      if(mort) mort.addEventListener('input', () => recalcRow(row));
      if(morb) morb.addEventListener('input', () => recalcRow(row));
    }

    // attach listeners for initial rows
    document.querySelectorAll('#bodyMortalidad tr').forEach(r => attachRowListeners(r));

    function scrollToRow(tr){
      tr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // ====== DOWNLOAD SIMULATION ======
    function descargarExcel(tipo){
      const nombres = {
        semana: 'Mortalidad_Alevinos_Semanal.xlsx',
        mes: 'Mortalidad_Alevinos_Mensual.xlsx',
        anio: 'Mortalidad_Alevinos_Anual.xlsx'
      };
      alert('📁 Se generará (simulado) el archivo: ' + (nombres[tipo] || 'Mortalidad_Alevinos.xlsx'));
      // Aquí puedes integrar SheetJS o llamar a un endpoint que genere el Excel cuando haya backend
    }

    // ====== VER LISTADO ======
    function verListado() {
  // recalcular totales antes de guardar
  document.querySelectorAll('#bodyMortalidad tr').forEach(tr => recalcRow(tr));

  const responsable = document.getElementById('responsable').value || '';
  const fechaForm = document.getElementById('fecha').value || '';
  const sede = document.getElementById('sede').value || '';
  const especie = document.getElementById('especie').value || '';

  const filas = Array.from(document.querySelectorAll('#bodyMortalidad tr')).map(tr => {
    return {
      up: tr.querySelector('.up')?.value || '',
      lote: tr.querySelector('.lote')?.value || '',
      mort: Number(tr.querySelector('.mort')?.value) || 0,
      morb: Number(tr.querySelector('.morb')?.value) || 0,
      total: Number(tr.querySelector('.total')?.value) || 0,
      obs: tr.querySelector('.obs')?.value || ''
    };
  });

  // Guardar datos simulados
  const registros = JSON.parse(localStorage.getItem('bpa6_registros') || '[]');
  registros.push({ responsable, fechaForm, sede, especie, filas });
  localStorage.setItem('bpa6_registros', JSON.stringify(registros));

  // Redirigir al listado
  window.location.href = 'index.php?controller=Peces&action=bpa6Listado';
}


    // ====== VOLVER ATRÁS ======
    function volverAtras(){
      if(window.history.length > 1) window.history.back();
      else alert('No hay historial de navegación.');
    }

    // ====== GUARDAR (simulado) ======
    function guardarDatos(){
      // recalcular totales por si acaso
      document.querySelectorAll('#bodyMortalidad tr').forEach(tr => recalcRow(tr));

      const responsable = document.getElementById('responsable').value || '';
      const fechaForm = document.getElementById('fecha').value || '';
      const sede = document.getElementById('sede').value || '';
      const especie = document.getElementById('especie').value || '';
      const filas = Array.from(document.querySelectorAll('#bodyMortalidad tr')).map(tr => {
        return {
          fecha: tr.querySelector('.fechaRow')?.value || '',
          up: tr.querySelector('.up')?.value || '',
          lote: tr.querySelector('.lote')?.value || '',
          mort: Number(tr.querySelector('.mort')?.value) || 0,
          morb: Number(tr.querySelector('.morb')?.value) || 0,
          total: Number(tr.querySelector('.total')?.value) || 0,
          obs: tr.querySelector('.obs')?.value || ''
        };
      });

      // Validación simple: al menos una fila con mortalidad o UP
      const anyData = filas.some(f => f.up || f.mort > 0 || f.morb > 0);
      if(!responsable || !fechaForm || !sede){
        alert('Por favor complete Responsable, Fecha y Sede antes de guardar.');
        return;
      }
      if(!anyData){
        alert('Ingrese al menos un registro con UP o algún valor de mortalidad/morbilidad.');
        return;
      }

      // simulación: mostrar resumen y log en consola
      console.log({
        responsable, fechaForm, sede, especie, filas
      });

      const ok = confirm('¿Deseas guardar (simulado) los datos ingresados?');
      if(!ok) return;

      // feedback simulado
      setTimeout(() => {
        alert('✅ Datos guardados (simulado). Revisa la consola para ver el objeto con los datos.');
      }, 250);
    }

    // Inicializar fecha con hoy
    (function init(){
      const fechaInput = document.getElementById('fecha');
      if(fechaInput && !fechaInput.value){
        const hoy = new Date();
        const yyyy = hoy.getFullYear();
        const mm = String(hoy.getMonth() + 1).padStart(2, '0');
        const dd = String(hoy.getDate()).padStart(2, '0');
        fechaInput.value = `${yyyy}-${mm}-${dd}`;
      }
      // inicializar primer row date también
      document.querySelectorAll('.fechaRow').forEach(inp => {
        if(!inp.value){
          const hoy = new Date().toISOString().split('T')[0];
          inp.value = hoy;
        }
      });
    })();
  </script>
</body>
</html>

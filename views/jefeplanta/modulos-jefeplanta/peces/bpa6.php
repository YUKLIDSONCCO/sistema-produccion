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

    .btn-back {
  font-size: 1.2rem;
  padding: 0.5rem 1rem;
  border: none;
  outline: none;
  border-radius: 0.2rem;
  cursor: pointer;
  text-transform: uppercase;
  background-color: rgb(14, 14, 26);
  color: rgb(234, 234, 234);
  font-weight: 700;
  transition: all 0.6s ease;
  box-shadow: 0px 0px 60px #1f4c65;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  letter-spacing: 1px;
  -webkit-box-reflect: below 10px linear-gradient(to bottom, rgba(0,0,0,0.0), rgba(0,0,0,0.4));
}

.btn-back:active {
  scale: 0.2;
}

.btn-back:hover {
  background: linear-gradient(270deg, rgba(2, 29, 78, 0.8) 0%, rgba(31, 215, 232, 0.9) 60%);
  color: rgba(22, 22, 64, 0.46);
  transform: translateY(-3px);
  box-shadow: 0 0 25px rgba(31, 215, 232, 0.8);
}


.btn-back:hover::before {
  transform: translateX(-6px);
}
    
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

    /* Breadcrumb and back button */
    .breadcrumb {
      display:flex; align-items:center; gap:12px; margin:16px 0; padding:8px 12px; border-radius:8px;
      background: linear-gradient(90deg, rgba(255,255,255,0.6), rgba(255,255,255,0.4));
      box-shadow: 0 6px 18px rgba(0,0,0,0.04);
      font-size:0.95rem;
    }
    .breadcrumb a { color:var(--orange-dark); text-decoration:none; font-weight:600; }
    .breadcrumb a:hover { text-decoration:underline; }
    .breadcrumb .spacer { flex:1; }
    .back-top { padding:6px 10px; border-radius:8px; font-weight:700; }

    /* subtle entrance for main container */
    .container { animation: floatIn 0.6s cubic-bezier(.2,.9,.2,1); }
    @keyframes floatIn { from { opacity: 0; transform: translateY(8px) scale(.995);} to { opacity:1; transform:none; } }

    /* subtle button micro-interactions */
    .btn { transition: transform .12s ease, box-shadow .12s ease; }
    .btn:active { transform: translateY(1px) scale(.998); }
    .btn:hover { box-shadow: 0 10px 24px rgba(0,0,0,0.06); }
      #Formularios {
  width: 100%;
  padding: 11px 14px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  font-size: 0.95rem;
  background: linear-gradient(180deg, #fff, #fffdf9);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
  transition: border 0.2s, box-shadow 0.2s;
  appearance: none; /* para ocultar flecha por defecto si se quiere personalizar */
  cursor: pointer;
}
#Formularios:focus {
  outline: none;
  border-color: var(--cora-orange);
  box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.15);
}

  </style>
</head>
<body>
  <div class="container">
    <?php if(isset($_GET['status']) && $_GET['status']==='ok'): ?>
      <div style="background:#d9f7d9;border:1px solid #4caf50;color:#256029;padding:10px 14px;border-radius:8px;font-weight:600;margin-bottom:12px;">
        ✅ Registro(s) guardado(s) correctamente. Usa el botón "Ver Listado Diario" para revisar.
      </div>
    <?php endif; ?>
    <form id="formBpa6" action="/sistema-produccion/public/index.php?controller=Peces&action=guardarBpa6" method="POST" style="display:none"></form>
    <!-- Encabezado -->
    <div class="header-row">
      <div class="logo">
        <!-- reemplaza por tu logo si quieres -->
        <img src="/sistema-produccion/public/img/coraqua.png" alt="Logo CORAQUA" onerror="this.style.display='none'"/>

      </div>
      <div style="flex:1; min-width:160px">
  <label for="Formularios">Formularios</label>
  <select id="Formularios" onchange="redirigirFormulario()">
    <option value="" disabled selected>Seleccione Formularios</option>
    <option value="dashboard">Panel</option>
    <option value="bpa6">BPA-6</option>
    <option value="bpa7">BPA-7</option>
    <option value="bpa10">BPA-10</option>
    <option value="bpa12">BPA-12</option>
  </select>
</div>

      <div class="title-block">
        
        <h1>FORMATO N°06 - MORTALIDAD DIARIA DE ALEVINOS (CORAQUA BPA 6)</h1>
        <div class="meta">
          <span><strong>CÓDIGO:</strong> CORAQUA BPA 6</span>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <span><strong>VERSIÓN:</strong> 2.0</span>
        </div>
      </div>
    </div>s
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
      // construir POST y enviar al controlador
      const form = document.getElementById('formBpa6');
      form.innerHTML = '';
      const add = (name, value) => {
        const i = document.createElement('input');
        i.type = 'hidden'; i.name = name; i.value = value; form.appendChild(i);
      };
      add('codigo_formato', 'CORAQUA BPA-6');
      add('version', '2.0');
      add('fecha_registro', fechaForm);
      add('responsable', responsable);
      add('sede', sede);
      // soporte de IDs opcionales (crear in-situ si no existieran en backend)
      add('id_especie', '');
      add('id_lote', '');
      add('id_sede', '');

      filas.forEach(f => {
        add('up[]', f.up);
        add('lote[]', f.lote);
        add('mortalidad[]', f.mort);
        add('morbilidad[]', f.morb);
        add('observaciones[]', f.obs);
      });

      if(!confirm('¿Deseas guardar los datos ingresados?')) return;
      form.submit();
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

    // Mostrar ruta actual (path + query) en el encabezado
    (function showRoute(){
      try {
        const el = document.getElementById('currentRoute');
        if (!el) return;
        const path = window.location.pathname.replace(/\\/g, '/');
        const qs = window.location.search || '';
        el.textContent = path + qs;
      } catch(e){ console.error(e); }
    })();
  </script>
  <script>
  function redirigirFormulario() {
    const valor = document.getElementById('Formularios').value;

    // Obtener la raíz base del proyecto sin importar desde dónde se acceda
    const base = window.location.origin + "/sistema-produccion/views/jefeplanta/modulos-jefeplanta/peces/";

    const rutas = {
      'dashboard': base + 'dashboard.php',
      'bpa6': base + 'bpa6.php',
      'bpa7': base + 'bpa7.php',
      'bpa10': base + 'bpa10.php',
      'bpa12': base + 'bpa12.php'
    };

    if (rutas[valor]) {
      window.location.href = rutas[valor];
    } else {
      alert('Ruta no configurada.');
    }
  }
</script>

</body>
</html>

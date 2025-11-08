<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FORMATO N°10 - MUESTREO (CORAQUA BPA 10)</title>

  <!-- Fonts & icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root{
      --orange:#ff7b00;
      --orange-dark:#e66e00;
      --bg-start:#fffaf2;
      --bg-end:#ffd9b3;
      --card-bg:#fff;
      --muted:#666;
      --accent-shadow:rgba(255,123,0,0.22);
      --rounded:12px;
      --green:#28a745;
      --green-dark:#218838;
    }

    *{ box-sizing:border-box; font-family:'Poppins','Segoe UI',sans-serif; }

    body{
      margin:0; min-height:100vh;
      background: linear-gradient(135deg,var(--bg-start),var(--bg-end));
      color:#222; display:flex;
    }

    /* SIDEBAR */
    .sidebar{
      width:260px;
      background: linear-gradient(180deg,#fff6f0,#fff0e6);
      border-right:1px solid rgba(0,0,0,0.05);
      height:100vh; position:fixed; left:0; top:0;
      padding:18px; box-shadow:4px 0 18px rgba(0,0,0,0.06);
      display:flex; flex-direction:column; gap:12px; z-index:120;
    }
    .sidebar .logo{ display:flex; align-items:center; gap:10px; padding-bottom:6px; border-bottom:1px solid rgba(0,0,0,0.04); }
    .sidebar .logo i{
      background: radial-gradient(circle at 30% 30%, var(--orange), var(--orange-dark));
      color:white; width:44px; height:44px; display:grid; place-items:center; border-radius:10px; font-size:18px;
      box-shadow:0 6px 18px var(--accent-shadow);
    }
    .sidebar .logo span{ font-weight:700; color:var(--orange-dark); font-size:14px; }
    .sidebar-nav{ margin-top:8px; flex:1; overflow:auto; }
    .sidebar-nav ul{ list-style:none; padding:0; margin:0; }
    .sidebar-nav li{ margin-bottom:6px; }
    .sidebar-nav a{
      display:flex; align-items:center; gap:12px; padding:10px 12px; border-radius:10px; color:#3b3b3b;
      text-decoration:none; transition: all .18s ease; font-weight:600; font-size:14px;
    }
    .sidebar-nav a:hover, .sidebar-nav a.active{
      background: linear-gradient(90deg,var(--orange),var(--orange-dark)); color:#fff; box-shadow:0 8px 20px rgba(230,110,0,0.12);
    }
    .sidebar-footer{ font-size:12px; color:var(--muted); text-align:center; padding-top:8px; border-top:1px solid rgba(0,0,0,0.03); }

    /* MAIN */
    .main{ margin-left:290px; padding:36px; width: calc(100% - 290px); }
    .card{
      background:var(--card-bg); border-radius:var(--rounded); padding:28px;
      box-shadow:0 8px 30px rgba(0,0,0,0.06); border-top:6px solid var(--orange); animation:fadeIn .6s ease;
    }
    @keyframes fadeIn{ from{opacity:0; transform:translateY(8px);} to{opacity:1; transform:translateY(0);} }

    header.top{ display:flex; gap:20px; align-items:center; justify-content:space-between; flex-wrap:wrap; margin-bottom:18px; }
    .brand{ display:flex; gap:18px; align-items:center; }
    .brand img{ width:86px; height:86px; object-fit:contain; border-radius:10px; background:linear-gradient(135deg,#fff,#fff4ea); padding:8px; box-shadow:0 8px 20px rgba(255,123,0,0.06); }
    .title{text-align:center; flex:1;}
    .title h1{ margin:0; font-size:18px; color:var(--orange-dark); font-weight:700; }
    .title p{ margin:6px 0 0; font-size:13px; color:var(--muted); }
    .meta-box{ background:#fff8f2; border:1px solid rgba(255,123,0,0.08); padding:10px 12px; border-radius:8px; font-size:13px; text-align:right; min-width:200px; }

    /* WIZARD */
    .wizard{ display:flex; justify-content:center; gap:72px; margin:8px 0 18px; }
    .step{ display:flex; flex-direction:column; align-items:center; cursor:pointer; position:relative; }
    .step .circle{ width:46px;height:46px;border-radius:50%; background:#eee;color:#fff;display:grid;place-items:center;font-weight:700;font-size:16px; transition:all .25s; box-shadow:0 6px 16px rgba(0,0,0,0.04); }
    .step .label{ margin-top:8px; font-weight:600; color:#666; font-size:13px; text-align:center; }
    .step.active .circle{ background:var(--orange); box-shadow:0 0 14px rgba(255,123,0,0.22); }
    .step.active .label{ color:var(--orange-dark); }
    .step:not(:last-child)::after{ content:""; position:absolute; right:-60px; top:22px; width:120px;height:3px;background:#f0d9c2;border-radius:4px; z-index:0; }
    .wizard-content{ display:none; text-align:center; margin-bottom:18px; }
    .wizard-content.active{ display:block; }
    .download-btn{ background:var(--orange); color:white; border:none; padding:10px 14px; border-radius:8px; cursor:pointer; font-weight:700; transition:all .18s; }
    .download-btn:hover{ background:var(--orange-dark); }

    /* FORM */
    .info-grid{ display:grid; grid-template-columns: repeat(auto-fit,minmax(220px,1fr)); gap:12px; margin-top:14px; }
    label{ display:block; font-weight:600; font-size:13px; color:#333; margin-bottom:6px; }
    input[type="text"], input[type="date"], input[type="time"], input[type="number"], select{ width:100%; padding:9px 10px; border-radius:8px; border:1px solid #e6e6e6; font-size:14px; background:transparent; }
    input:focus{ outline:none; box-shadow:0 6px 18px rgba(255,123,0,0.08); border-color:var(--orange); }

    /* TABLE */
    .table-wrap{ margin-top:18px; overflow:auto; border-radius:10px; border:1px solid rgba(0,0,0,0.04); }
    table{ width:100%; border-collapse:collapse; min-width:900px; background:transparent; }
    thead th{
      position:sticky; top:0; z-index:2;
      background: linear-gradient(90deg,var(--orange),var(--orange-dark));
      color:white; font-weight:700; padding:10px; text-align:center; font-size:13px;
    }
    tbody td{
      border-bottom:1px solid #f0e6dc; padding:8px 10px; text-align:center; vertical-align:middle; font-size:14px; background:#fffceb;
    }
    tbody tr:nth-child(even) td{ background:#fff7ea; }
    td input{ width:100%; padding:6px 8px; border-radius:6px; border:1px solid #e6d9ce; text-align:center; font-weight:600; }
    td input:focus{ box-shadow:0 6px 18px rgba(255,123,0,0.06); border-color:var(--orange); background:#fff; }

    .table-actions{ display:flex; justify-content:space-between; align-items:center; gap:10px; margin-top:16px; flex-wrap:wrap; }
    .btn{ background:var(--orange); color:white; border:none; padding:10px 14px; border-radius:8px; cursor:pointer; font-weight:700; transition:all .16s; }
    .btn.secondary{ background:transparent; color:var(--orange); border:2px solid var(--orange); font-weight:700; }
    .btn.ghost{ background:#fff; color:#444; border:1px solid #eee; box-shadow:none; }
    .btn.green{ background:var(--green); }
    .btn.green:hover{ background:var(--green-dark); }
    .btn:hover{ transform:translateY(-2px); box-shadow:0 10px 28px rgba(0,0,0,0.06); }
    .btn.secondary:hover{ background:var(--orange); color:white; }
    footer{ text-align:center; margin-top:20px; color:var(--muted); font-size:13px; }

    @media (max-width:980px){
      .sidebar{ display:none; }
      .main{ margin-left:0; width:100%; padding:18px; }
      .brand img{ width:64px; height:64px; }
      .wizard{ gap:28px; }
      table{ min-width:700px; }
    }
  </style>
</head>
<body>
  <form id="formBpa10" action="index.php?controller=Peces&action=guardarBpa10" method="POST" style="display:none"></form>
  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="logo">
      <i class="fas fa-fish"></i>
      <div>
        <div style="font-size:13px;color:#444;font-weight:700">Panel Peces</div>
        <div style="font-size:12px;color:var(--muted)">CORAQUA</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="index.php?controller=JefePlanta&action=dashboard"><i class="fa-solid fa-th-large fa-fw"></i> Dashboard</a></li>
        <li><a href="index.php?controller=JefePlanta&action=moduloPeces"><i class="fa-solid fa-layer-group fa-fw"></i> Panel Peces</a></li>
        <li><a class="active" href="#"><i class="fa-solid fa-vial fa-fw"></i> BPA 10 - Muestreo</a></li>
        <li><a href="#"><i class="fa-solid fa-sign-out-alt fa-fw"></i> Salir</a></li>
      </ul>
    </nav>

    <div class="sidebar-footer">
      &copy; CORAQUA 2025
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">
    <div class="card" role="main">
      <?php if(isset($_GET['status']) && $_GET['status']==='ok'): ?>
        <div style="background:#d9f7d9;border:1px solid #4caf50;color:#256029;padding:10px 14px;border-radius:8px;font-weight:600;margin-bottom:12px;">
          ✅ Registro(s) guardado(s) correctamente. Usa el botón "Ver Listado Diario" para revisar.
        </div>
      <?php endif; ?>
      <header class="top" aria-label="Encabezado del formato">
        <div class="brand">
          <img src="/ruta/a/logo_coraqua.png" alt="Logo Coraqua" onerror="this.style.display='none'">
        </div>

        <div class="title">
          <h1>FORMATO N°10 - MUESTREO (CORAQUA BPA 10)</h1>
          <p><strong>CÓDIGO:</strong> CORAQUA BPA 10 | <strong>VERSIÓN:</strong> 2.0 | <strong>FECHA:</strong> 03/08/2020</p>
        </div>

        <div class="meta-box">
          <div style="font-weight:700; color:var(--orange-dark)">Registro</div>
          <div style="font-size:12px; color:var(--muted)">Muestreo</div>
        </div>
      </header>

      <!-- WIZARD -->
      <div class="wizard" role="tablist" aria-label="Opciones de descarga">
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

      <div id="contenido1" class="wizard-content active">
        <p style="margin:0 0 10px">📅 Descargar reporte semanal en formato Excel:</p>
        <button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button>
      </div>

      <div id="contenido2" class="wizard-content">
        <p style="margin:0 0 10px">🗓️ Descargar reporte mensual en formato Excel:</p>
        <button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button>
      </div>

      <div id="contenido3" class="wizard-content">
        <p style="margin:0 0 10px">📊 Descargar reporte anual en formato Excel:</p>
        <button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button>
      </div>

      <!-- FORM INFO -->
      <section class="info-grid" aria-label="Información general">
        <div>
          <label for="encargado">Encargado</label>
          <input id="encargado" type="text" placeholder="Ejemplo: Juan Pérez">
        </div>

        <div>
          <label for="sede">Sede</label>
          <input id="sede" type="text" placeholder="Ejemplo: Planta Principal">
        </div>

        <div>
          <label for="fecha">Fecha</label>
          <input id="fecha" type="date" value="">
        </div>

        <div>
          <label for="hora">Hora</label>
          <input id="hora" type="time" value="">
        </div>
      </section>

      <!-- TABLE (optimizada) -->
      <div class="table-wrap" role="region" aria-label="Tabla de muestreo">
        <table id="tablaMuestreo">
          <thead>
            <tr>
              <th>N°</th>
              <th>U.P.</th>
              <th>Peso 1</th>
              <th>Peso 2</th>
              <th>Peso 3</th>
              <th>Peso 4</th>
              <th>Long.</th>
              <th>OBS.</th>
            </tr>
          </thead>

          <tbody id="bodyMuestreo">
            <!-- filas iniciales de ejemplo -->
            <tr>
              <td class="index">1</td>
              <td><input type="text" class="up" placeholder="UP-01"></td>
              <td><input type="number" min="0" step="0.01" class="p1"></td>
              <td><input type="number" min="0" step="0.01" class="p2"></td>
              <td><input type="number" min="0" step="0.01" class="p3"></td>
              <td><input type="number" min="0" step="0.01" class="p4"></td>
              <td><input type="number" min="0" step="0.01" class="long"></td>
              <td><input type="text" class="obs"></td>
            </tr>

            <tr>
              <td class="index">2</td>
              <td><input type="text" class="up" placeholder="UP-02"></td>
              <td><input type="number" min="0" step="0.01" class="p1"></td>
              <td><input type="number" min="0" step="0.01" class="p2"></td>
              <td><input type="number" min="0" step="0.01" class="p3"></td>
              <td><input type="number" min="0" step="0.01" class="p4"></td>
              <td><input type="number" min="0" step="0.01" class="long"></td>
              <td><input type="text" class="obs"></td>
            </tr>

            <tr>
              <td class="index">3</td>
              <td><input type="text" class="up" placeholder="UP-03"></td>
              <td><input type="number" min="0" step="0.01" class="p1"></td>
              <td><input type="number" min="0" step="0.01" class="p2"></td>
              <td><input type="number" min="0" step="0.01" class="p3"></td>
              <td><input type="number" min="0" step="0.01" class="p4"></td>
              <td><input type="number" min="0" step="0.01" class="long"></td>
              <td><input type="text" class="obs"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- ACTIONS -->
      <div class="table-actions" aria-label="Acciones del formulario">
        <div class="actions-left" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
          <button class="btn" onclick="agregarFila()">➕ Agregar Fila</button>
          <button class="btn ghost" onclick="eliminarFila()">➖ Quitar Fila</button>
          <button class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
        </div>

        <div class="actions-right" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
          <button class="btn green" title="Descargar semanal" onclick="descargarExcel('semana')"><i class="fa-solid fa-file-excel" style="margin-right:8px"></i> Semanal</button>
          <button class="btn green" title="Descargar mensual" onclick="descargarExcel('mes')"><i class="fa-solid fa-file-excel" style="margin-right:8px"></i> Mensual</button>
          <button class="btn green" title="Descargar anual" onclick="descargarExcel('anio')"><i class="fa-solid fa-file-excel" style="margin-right:8px"></i> Anual</button>
          <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
          <button id="guardarBtn" class="btn" onclick="guardarDatos()">💾 Guardar</button>
        </div>
      </div>

      <footer>
        CORAQUA © 2025 - Muestreo
      </footer>
    </div>
  </main>

  <script>
    // WIZARD
    function mostrarPaso(n){
      const steps = document.querySelectorAll('.step');
      const contents = document.querySelectorAll('.wizard-content');
      steps.forEach((s,i) => i===n-1 ? s.classList.add('active') : s.classList.remove('active'));
      contents.forEach((c,i) => c.classList.toggle('active', i===n-1));
    }

    // TABLE FUNCTIONS
    function agregarFila(){
      const tbody = document.getElementById('bodyMuestreo');
      const num = tbody.querySelectorAll('tr').length + 1;
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="index">${num}</td>
        <td><input type="text" class="up" placeholder="UP-${String(num).padStart(2,'0')}"></td>
        <td><input type="number" min="0" step="0.01" class="p1"></td>
        <td><input type="number" min="0" step="0.01" class="p2"></td>
        <td><input type="number" min="0" step="0.01" class="p3"></td>
        <td><input type="number" min="0" step="0.01" class="p4"></td>
        <td><input type="number" min="0" step="0.01" class="long"></td>
        <td><input type="text" class="obs"></td>
      `;
      tbody.appendChild(tr);
      scrollToRow(tr);
    }

    function eliminarFila(){
      const tbody = document.getElementById('bodyMuestreo');
      const rows = tbody.querySelectorAll('tr');
      if(rows.length > 1) tbody.removeChild(rows[rows.length - 1]);
      else alert('Debe haber al menos una fila.');
    }

    function scrollToRow(row){
      try{ row.scrollIntoView({ behavior:'smooth', block:'center' }); } catch(e){}
    }

    // Ver listado: redirigir al listado
    function verListado(){
      window.location.href = 'index.php?controller=Peces&action=bpa10Listado';
    }

    // Volver atras
    function volverAtras(){
      if(window.history.length > 1) window.history.back();
      else alert('No hay historial de navegación.');
    }

    // Descarga simulada (puedo integrar SheetJS si quieres export real)
    function descargarExcel(tipo){
      let archivo = '';
      switch(tipo){
        case 'semana': archivo = 'Muestreo_Semanal.xlsx'; break;
        case 'mes': archivo = 'Muestreo_Mensual.xlsx'; break;
        case 'anio': archivo = 'Muestreo_Anual.xlsx'; break;
        default: archivo = 'Muestreo_Report.xlsx';
      }
      alert(`📂 Generando y descargando ${archivo}...`);
    }

    // Guardar: construir POST y enviar al controlador
    function guardarDatos(){
      const encargado = document.getElementById('encargado').value.trim();
      const fecha = document.getElementById('fecha').value.trim();
      if(!encargado || !fecha){
        alert('Por favor complete Encargado y Fecha antes de guardar.');
        return;
      }

      const sede = document.getElementById('sede').value || '';
      const hora = document.getElementById('hora').value || '';

      const add = (name, value) => {
        const f = document.getElementById('formBpa10');
        const i = document.createElement('input');
        i.type = 'hidden'; i.name = name; i.value = value; f.appendChild(i);
      };

      // campos generales
      add('codigo_formato','CORAQUA BPA-10');
      add('version','2.0');
      add('fecha_registro', fecha);
      add('encargado', encargado);
      add('sede', sede);
      add('fecha_muestreo', fecha);
      add('hora_muestreo', hora);

      // filas
      document.querySelectorAll('#bodyMuestreo tr').forEach(tr => {
        const up = tr.querySelector('.up')?.value || '';
        const p1 = Number(tr.querySelector('.p1')?.value) || 0;
        const p2 = Number(tr.querySelector('.p2')?.value) || 0;
        const p3 = Number(tr.querySelector('.p3')?.value) || 0;
        const p4 = Number(tr.querySelector('.p4')?.value) || 0;
        const obs = tr.querySelector('.obs')?.value || '';
        if(!up && !p1 && !p2 && !p3 && !p4 && !obs) return;
        const pesos = [p1,p2,p3,p4].filter(v => v>0);
        const prom = pesos.length ? (pesos.reduce((a,b)=>a+b,0)/pesos.length) : 0;
        add('up[]', up);
        add('lote[]', up); // mientras no exista campo lote, usar up como referencia
        add('peso_promedio[]', prom.toFixed(2));
        add('coeficiente_variacion[]', 0);
        add('factor_k[]', 0);
        add('observaciones[]', obs);
      });

      if(!confirm('¿Deseas guardar los datos ingresados?')) return;
      document.getElementById('formBpa10').submit();
    }

    // Inicializar fecha y hora con hoy/hora actual
    (function init(){
      const fechaInput = document.getElementById('fecha');
      const horaInput = document.getElementById('hora');
      if(fechaInput){
        const hoy = new Date();
        const yyyy = hoy.getFullYear();
        const mm = String(hoy.getMonth() + 1).padStart(2,'0');
        const dd = String(hoy.getDate()).padStart(2,'0');
        fechaInput.value = `${yyyy}-${mm}-${dd}`;
      }
      if(horaInput){
        const h = new Date();
        const hh = String(h.getHours()).padStart(2,'0');
        const mi = String(h.getMinutes()).padStart(2,'0');
        horaInput.value = `${hh}:${mi}`;
      }
    })();
  </script>
</body>
</html>

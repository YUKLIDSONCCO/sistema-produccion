<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FORMATO N°15 - CONTROL SANITARIO EN ALEVINES (CORAQUA BPA 15)</title>

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

    .info-grid {
      display:grid;
      grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
      gap:14px;
      margin-top:18px;
    }
    label { display:block; font-weight:600; color:#333; margin-bottom:6px; font-size:0.92rem; }
    input[type="text"], input[type="date"], textarea {
      width:100%; padding:9px 10px; border-radius:8px; border:1px solid #d8d8d8; font-size:0.95rem;
      transition: box-shadow .15s, border-color .15s;
      background:transparent; resize: none;
    }
    input:focus, textarea:focus { outline:none; border-color:var(--orange); box-shadow:0 0 6px rgba(255,123,0,0.12); }

    .section-title {
      background:#ffeedb; color:var(--orange); padding:8px 12px; border-radius:8px; font-weight:700; margin-top:22px;
    }
    .table-container { overflow:auto; margin-top:10px; }
    table { width:100%; border-collapse:collapse; min-width:840px; }
    th, td { padding:8px 6px; border:1px solid #e6e6e6; text-align:center; font-size:0.92rem; vertical-align:middle; }
    th { background:var(--orange); color:#fff; position:sticky; top:0; z-index:2; }
    tbody tr { background: #fffaf0; }
    tbody tr:nth-child(even) { background: #fff6ea; }
    td input { width:100%; border:none; background:transparent; padding:6px; text-align:center; font-size:0.92rem; }
    td input:focus { background:#fff7f0; outline:none; border-radius:6px; box-shadow: 0 6px 18px rgba(255,123,0,0.06); }

    .actions { display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-top:18px; }
    .left-actions, .right-actions { display:flex; gap:10px; align-items:center; flex-wrap: wrap; }
    .btn { background:var(--orange); color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:700; }
    .btn:hover { background:var(--orange-dark); transform:translateY(-2px); }
    .btn.secondary { background:#fff; color:var(--orange); border:2px solid var(--orange); }
    .btn.secondary:hover { background:var(--orange); color:#fff; }
    .btn.ghost { background:transparent; color:#444; border:1px solid #eee; }

    .download-panel {
      margin-top: 28px;
      background: #fff8f0;
      border: 2px dashed var(--orange);
      padding: 16px;
      border-radius: 12px;
      text-align: center;
      animation: fadeIn 0.5s ease;
    }
    .download-panel h3 {
      color: var(--orange-dark);
      margin: 0 0 10px;
      font-weight: 700;
    }
    .download-panel .btn {
      margin: 4px;
    }

    footer { text-align:center; color:var(--muted); font-size:0.88rem; margin-top:24px; }
  </style>
</head>
<body>
  <div class="container">

    <div class="header-row">
      <div class="logo">
        <img src="img/logo-coraqua.png" alt="Logo CORAQUA" onerror="this.style.display='none'"/>
      </div>
      <div class="title-block">
        <h1>FORMATO N°15 - CONTROL SANITARIO EN ALEVINES<br>TRATAMIENTO EN BAÑO SALINO</h1>
        <div class="meta">
          <span><strong>CÓDIGO:</strong> CORAQUA BPA 15</span>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <span><strong>VERSIÓN:</strong> 2.0</span>
        </div>
      </div>
    </div>

    <!-- Datos Generales -->
    <div class="info-grid">
      <div>
        <label for="fecha">Fecha</label>
        <input id="fecha" type="date">
      </div>
      <div>
        <label for="encargado">Encargado</label>
        <input id="encargado" type="text" placeholder="Ej. Juan Pérez">
      </div>
      <div>
        <label for="lote">Lote</label>
        <input id="lote" type="text" placeholder="Ej. L-01">
      </div>
      <div>
        <label for="sede">Sede / Estanque</label>
        <input id="sede" type="text" placeholder="Ej. Estanque 03">
      </div>
      <div style="grid-column: 1 / -1;">
        <label for="actividad">Actividad</label>
        <textarea id="actividad" placeholder="Describa la actividad realizada..."></textarea>
      </div>
    </div>

    <!-- Tabla -->
    <div class="section-title">Detalle - Control Sanitario en Alevines</div>
    <div class="table-container">
      <table id="tablaControl">
        <thead>
          <tr>
            <th>N°</th>
            <th colspan="2">ORIGEN</th>
            <th colspan="2">DESTINO</th>
            <th>CONCENTRACIÓN DE SAL</th>
            <th>OBSERVACIÓN</th>
          </tr>
          <tr>
            <th></th>
            <th>U.P.</th>
            <th></th>
            <th>U.P.</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="bodyControl">
          <tr>
            <td class="index">1</td>
            <td><input type="text" placeholder="UP-01"></td>
            <td></td>
            <td><input type="text" placeholder="UP-02"></td>
            <td></td>
            <td><input type="text" placeholder="%"></td>
            <td><input type="text" placeholder="Observaciones..."></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Botones -->
    <div class="actions">
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

    <!-- Panel de Descargas -->
    <div class="download-panel">
      <h3>📊 Descarga de Reportes</h3>
      <button class="btn secondary">📅 Reporte Semanal</button>
      <button class="btn secondary">📆 Reporte Mensual</button>
      <button class="btn secondary">🗓️ Reporte Anual</button>
    </div>

    <footer> CORAQUA © 2025 — Control Sanitario en Alevines (BPA 15) </footer>
  </div>

  <script>
    function agregarFila(){
      const tbody = document.getElementById('bodyControl');
      const num = tbody.querySelectorAll('tr').length + 1;
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td class="index">${num}</td>
        <td><input type="text" placeholder="UP-${String(num).padStart(2,'0')}"></td>
        <td></td>
        <td><input type="text" placeholder="UP-${String(num+1).padStart(2,'0')}"></td>
        <td></td>
        <td><input type="text" placeholder="%"></td>
        <td><input type="text" placeholder="Observaciones..."></td>
      `;
      tbody.appendChild(tr);
      tr.scrollIntoView({behavior:"smooth", block:"center"});
    }

    function eliminarFila(){
      const tbody = document.getElementById('bodyControl');
      const rows = tbody.querySelectorAll('tr');
      if(rows.length > 1) tbody.removeChild(rows[rows.length-1]);
      else alert("Debe quedar al menos una fila.");
    }

    function verListado(){
      const rows = document.querySelectorAll('#bodyControl tr').length;
      alert(`📋 Listado de registros: ${rows} fila(s).`);
    }

    function volverAtras(){
      if(window.history.length > 1) window.history.back();
      else alert("No hay historial de navegación.");
    }

    function guardarDatos(){
      const fecha = document.getElementById('fecha').value;
      const encargado = document.getElementById('encargado').value;
      const lote = document.getElementById('lote').value;
      const sede = document.getElementById('sede').value;
      const actividad = document.getElementById('actividad').value;

      if(!fecha || !encargado || !lote || !sede){
        alert("⚠️ Complete todos los campos principales antes de guardar.");
        return;
      }

      const filas = Array.from(document.querySelectorAll('#bodyControl tr')).map(tr => ({
        origen: tr.children[1].querySelector('input')?.value,
        destino: tr.children[3].querySelector('input')?.value,
        concentracion: tr.children[5].querySelector('input')?.value,
        observacion: tr.children[6].querySelector('input')?.value
      }));

      console.log({fecha, encargado, lote, sede, actividad, filas});
      alert("✅ Datos guardados (simulado). Revisa la consola para ver los detalles.");
    }
  </script>
</body>
</html>

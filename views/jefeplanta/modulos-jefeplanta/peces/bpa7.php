<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FORMATO N°07 - ALIMENTACIÓN DIARIA (CORAQUA BPA 7)</title>

  <!-- Poppins -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
   <style>
    :root{
      --orange: #ff7b00;
      --orange-dark: #e66e00;
      --bg-start: #fffaf2;
      --bg-end: #ffd9b3;
      --card-bg: #fff;
      --muted: #666;
      --rounded: 12px;
      --accent-shadow: rgba(255,123,0,0.16);
    }

    *{ box-sizing: border-box; font-family: "Poppins", "Segoe UI", sans-serif; }

    body{
      margin: 0;
      min-height: 100vh;
      background: linear-gradient(135deg,var(--bg-start),var(--bg-end) 60%);
      color: #222;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    /* Contenedor principal centrado */
    .main{
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      max-width: 1400px;
    }

    .card{
      width: 100%;
      max-width: 1200px;
      background: #fff;
      border-radius: 14px;
      padding: 28px 32px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
      border-top: 7px solid var(--orange);
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn { from {opacity:0; transform:translateY(8px)} to {opacity:1; transform:none} }

    header.top{
      display:flex;
      flex-wrap:wrap;
      gap:18px;
      align-items:center;
      justify-content:space-between;
      margin-bottom:12px;
      text-align: center;
    }

    .brand img{
      width:80px; height:80px;
      object-fit:contain; border-radius:10px;
      background: linear-gradient(135deg,#fff,#fff4ea);
      padding:8px;
      box-shadow: 0 8px 20px rgba(255,123,0,0.06);
    }

    .title{ flex:1; text-align:center; }
    .title h1{ margin:0; font-size:18px; color:var(--orange-dark); font-weight:700; }
    .title p{ margin:6px 0 0; font-size:13px; color:var(--muted); }

    .meta-box{
      background:#fff8f2;
      border:1px solid rgba(255,123,0,0.08);
      padding:10px 12px;
      border-radius:8px;
      font-size:13px;
      text-align:right;
      min-width:200px;
    }

 
    .step{ display:flex; flex-direction:column; align-items:center; cursor:pointer; position:relative; }
    .step .circle{ width:44px; height:44px; border-radius:50%; background:#eee; display:grid; place-items:center; font-weight:700; }
    .step.active .circle{ background:var(--orange); color:#fff; }
    .step .label{ margin-top:8px; font-weight:600; color:#666; font-size:13px; }

    .wizard-content{ display:none; text-align:center; margin-bottom:16px; }
    .wizard-content.active{ display:block; }

    .download-btn{ background:var(--orange); color:#fff; border:none; padding:8px 12px; border-radius:8px; cursor:pointer; font-weight:700; }
    .download-btn:hover{ background:var(--orange-dark); }

    .info-grid{
      display:grid;
      grid-template-columns: repeat(auto-fit,minmax(220px,1fr));
      gap:12px;
      margin-top:6px;
    }
    label{ display:block; font-weight:600; font-size:13px; color:#333; margin-bottom:6px; }
    input[type="text"], input[type="date"], input[type="number"], select{
      width:100%; padding:9px 10px; border-radius:8px; border:1px solid #e6e6e6; font-size:14px; background:transparent;
    }

    .section-title{ background:#ffeedb; color:var(--orange); padding:8px 12px; border-radius:8px; font-weight:700; margin-top:16px; }

    .blocks {
      display:grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap:12px;
      margin-top:12px;
    }

    .block {
      background: linear-gradient(180deg,#fffef9, #fff9f0);
      padding:10px;
      border-radius:10px;
      border:1px solid rgba(0,0,0,0.04);
      box-shadow: 0 6px 18px rgba(0,0,0,0.04);
    }

    .block h3{ margin:0 0 8px 0; font-size:14px; color:var(--orange-dark); text-align:center; }
    .block table{ width:100%; border-collapse:collapse; }
    .block th, .block td{ padding:8px 6px; border:1px solid #f0e6dc; text-align:center; font-size:13px; }
    .block thead th{ background: linear-gradient(90deg,var(--orange),var(--orange-dark)); color:#fff; font-weight:700; }
    .block input[type="text"], .block input[type="number"], .block input[type="date"]{
      width:100%; padding:6px 8px; border-radius:6px; border:1px solid #e6d9ce; text-align:center; font-weight:600;
    }

    .block-actions{ display:flex; gap:8px; justify-content:center; margin-top:8px; flex-wrap:wrap; }

    .actions { display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-top:18px; }
    .btn{ background:var(--orange); color:white; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:700; }
    .btn.secondary{ background:#fff; color:var(--orange); border:2px solid var(--orange); }

    footer{ text-align:center; color:var(--muted); font-size:13px; margin-top:16px; }

    /* === RESPONSIVE === */
    @media (max-width:900px){
      .meta-box{ text-align:center; min-width:auto; }
      .title h1{ font-size:16px; }
      .wizard{ gap:20px; }
      .card{ padding:20px; }
    }

    @media (max-width:600px){
      body{ padding:10px; }
      .card{ padding:18px; }
      .brand img{ width:60px; height:60px; }
      .actions{ flex-direction:column; align-items:center; }
      .btn{ width:100%; }
    }
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
  </style>
</head>
<body>
  <form id="formBpa7" action="index.php?controller=Peces&action=guardarBpa7" method="POST" style="display:none"></form>

  
  <!-- MAIN -->
  <main class="main">
    <div class="card">
       <button class="btn-back" onclick="volverAtras()">⬅️ Atrás</button>
      <?php if(isset($_GET['status']) && $_GET['status']==='ok'): ?>
        <div style="background:#d9f7d9;border:1px solid #4caf50;color:#256029;padding:10px 14px;border-radius:8px;font-weight:600;margin-bottom:12px;">
          ✅ Registro(s) guardado(s) correctamente. Usa el botón "Ver Listado" para revisar.
        </div>
      <?php endif; ?>
      <header class="top">
           

        <div class="brand">
          <img src="/ruta/a/logo_coraqua.png" alt="Logo Coraqua" onerror="this.style.display='none'">
        </div>

        <div class="title">
          <h1>FORMATO N°07 - ALIMENTACIÓN DIARIA (CORAQUA BPA 7)</h1>
          <p><strong>CÓDIGO:</strong> CORAQUA BPA-7 &nbsp; | &nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp; | &nbsp; <strong>FECHA:</strong> 03/08/2020</p>
        </div>

        <div class="meta-box">
          <div style="font-weight:700; color:var(--orange-dark)">Registro</div>
          <div style="font-size:12px; color:var(--muted)">Alimentación Diaria</div>
        </div>
      </header>



      <!-- GENERAL INFO -->
      <section class="info-grid" aria-label="Información general">
        <div>
          <label for="responsable">Responsable</label>
          <input id="responsable" type="text" placeholder="Ej. Juan Pérez">
        </div>
        <div>
          <label for="fecha">Fecha</label>
          <input id="fecha" type="date" />
        </div>
        <div>
          <label for="sede">Sede</label>
          <select id="sede" name="sede" required>
            <option value="" disabled selected>Seleccione una sede</option>
            <option value="Chichillapi">Chichillapi</option>
            <option value="Cambruni">Cambruni</option>
          </select>
        </div>
        <div>
          <label for="turno">Turno / Observación</label>
          <input id="turno" type="text" placeholder="Mañana / Tarde">
        </div>
      </section>

      <!-- THREE BLOCKS OF TABLES -->
      <div class="section-title">Detalle de Alimentación (3 Bloques)</div>
      <div class="blocks" role="region" aria-label="Bloques de tablas de alimentación">

        <!-- BLOCK 1 -->
        <div class="block" id="block1">
          <h3>Bloque 1</h3>
          <table>
            <thead>
              <tr>
                <th>U.P.</th><th>LOTE</th><th>BIOMASA</th><th>T.A. (%)</th><th>AL. SUM (Kg)</th><th>CALIBRE</th><th>OBS.</th>
              </tr>
            </thead>
            <tbody id="b1">
              <tr>
                <td><input type="text" name="up1_1" placeholder="UP-01"></td>
                <td><input type="text" name="lote1_1" placeholder="L-001"></td>
                <td><input type="number" name="biomasa1_1" step="0.01"></td>
                <td><input type="number" name="ta1_1" step="0.01"></td>
                <td><input type="number" name="alsum1_1" step="0.01"></td>
                <td><input type="text" name="calibre1_1"></td>
                <td><input type="text" name="obs1_1"></td>
              </tr>
              <tr>
                <td><input type="text" name="up1_2" placeholder="UP-02"></td>
                <td><input type="text" name="lote1_2" placeholder="L-002"></td>
                <td><input type="number" name="biomasa1_2" step="0.01"></td>
                <td><input type="number" name="ta1_2" step="0.01"></td>
                <td><input type="number" name="alsum1_2" step="0.01"></td>
                <td><input type="text" name="calibre1_2"></td>
                <td><input type="text" name="obs1_2"></td>
              </tr>
            </tbody>
          </table>

          <div class="block-actions">
            <button class="btn small" onclick="agregarFilaBloque('b1')">➕ Agregar</button>
            <button class="btn ghost small" onclick="eliminarFilaBloque('b1')">➖ Quitar</button>
          </div>
        </div>

        <!-- BLOCK 2 -->
        <div class="block" id="block2">
          <h3>Bloque 2</h3>
          <table>
            <thead>
              <tr>
                <th>U.P.</th><th>LOTE</th><th>BIOMASA</th><th>T.A. (%)</th><th>AL. SUM (Kg)</th><th>CALIBRE</th><th>OBS.</th>
              </tr>
            </thead>
            <tbody id="b2">
              <tr>
                <td><input type="text" name="up2_1" placeholder="UP-01"></td>
                <td><input type="text" name="lote2_1" placeholder="L-001"></td>
                <td><input type="number" name="biomasa2_1" step="0.01"></td>
                <td><input type="number" name="ta2_1" step="0.01"></td>
                <td><input type="number" name="alsum2_1" step="0.01"></td>
                <td><input type="text" name="calibre2_1"></td>
                <td><input type="text" name="obs2_1"></td>
              </tr>
              <tr>
                <td><input type="text" name="up2_2" placeholder="UP-02"></td>
                <td><input type="text" name="lote2_2" placeholder="L-002"></td>
                <td><input type="number" name="biomasa2_2" step="0.01"></td>
                <td><input type="number" name="ta2_2" step="0.01"></td>
                <td><input type="number" name="alsum2_2" step="0.01"></td>
                <td><input type="text" name="calibre2_2"></td>
                <td><input type="text" name="obs2_2"></td>
              </tr>
            </tbody>
          </table>

          <div class="block-actions">
            <button class="btn small" onclick="agregarFilaBloque('b2')">➕ Agregar</button>
            <button class="btn ghost small" onclick="eliminarFilaBloque('b2')">➖ Quitar</button>
          </div>
        </div>

        <!-- BLOCK 3 -->
        <div class="block" id="block3">
          <h3>Bloque 3</h3>
          <table>
            <thead>
              <tr>
                <th>U.P.</th><th>LOTE</th><th>BIOMASA</th><th>T.A. (%)</th><th>AL. SUM (Kg)</th><th>CALIBRE</th><th>OBS.</th>
              </tr>
            </thead>
            <tbody id="b3">
              <tr>
                <td><input type="text" name="up3_1" placeholder="UP-01"></td>
                <td><input type="text" name="lote3_1" placeholder="L-001"></td>
                <td><input type="number" name="biomasa3_1" step="0.01"></td>
                <td><input type="number" name="ta3_1" step="0.01"></td>
                <td><input type="number" name="alsum3_1" step="0.01"></td>
                <td><input type="text" name="calibre3_1"></td>
                <td><input type="text" name="obs3_1"></td>
              </tr>
              <tr>
                <td><input type="text" name="up3_2" placeholder="UP-02"></td>
                <td><input type="text" name="lote3_2" placeholder="L-002"></td>
                <td><input type="number" name="biomasa3_2" step="0.01"></td>
                <td><input type="number" name="ta3_2" step="0.01"></td>
                <td><input type="number" name="alsum3_2" step="0.01"></td>
                <td><input type="text" name="calibre3_2"></td>
                <td><input type="text" name="obs3_2"></td>
              </tr>
            </tbody>
          </table>

          <div class="block-actions">
            <button class="btn small" onclick="agregarFilaBloque('b3')">➕ Agregar</button>
            <button class="btn ghost small" onclick="eliminarFilaBloque('b3')">➖ Quitar</button>
          </div>
        </div>

      </div> <!-- /blocks -->

      <!-- Observaciones y firma -->
      <div class="section-title">Observaciones y Firma</div>
      <div style="margin-top:10px; display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
        <div>
          <label for="observaciones">Observaciones generales</label>
          <input id="observaciones" type="text" placeholder="Comentarios, incidencias...">
        </div>
        <div>
          <label for="firma">Responsable (firma / nombre)</label>
          <input id="firma" type="text" placeholder="Nombre del responsable">
        </div>
      </div>

      <!-- ACTIONS -->
      <div class="actions" role="group" aria-label="Acciones">
        <div class="left-actions">
          <button class="btn" onclick="verListado()">📖 Ver Listado</button>
          <button class="btn ghost" onclick="limpiarFormulario()">🧹 Limpiar</button>
        </div>

        <div class="right-actions">
          
          <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
          <button id="guardarBtn" class="btn" onclick="guardarDatos()">💾 Guardar</button>
        </div>
      </div>

      <footer> CORAQUA © 2025 — Alimentación Diaria (BPA 7) </footer>
    </div>
  </main>

  <script>


    // Add/remove row functions for blocks
    function agregarFilaBloque(tbodyId){
      const tbody = document.getElementById(tbodyId);
      const rowCount = tbody.querySelectorAll('tr').length;
      const tr = document.createElement('tr');

      tr.innerHTML = `
        <td><input type="text" placeholder="UP-${String(rowCount+1).padStart(2,'0')}"></td>
        <td><input type="text" placeholder="L-${String(rowCount+1).padStart(3,'0')}"></td>
        <td><input type="number" step="0.01"></td>
        <td><input type="number" step="0.01"></td>
        <td><input type="number" step="0.01"></td>
        <td><input type="text"></td>
        <td><input type="text"></td>
      `;
      tbody.appendChild(tr);
      // scroll into view softly
      tr.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function eliminarFilaBloque(tbodyId){
      const tbody = document.getElementById(tbodyId);
      const rows = tbody.querySelectorAll('tr');
      if(rows.length > 1){
        tbody.removeChild(rows[rows.length - 1]);
      } else {
        alert('Debe quedar al menos una fila en el bloque.');
      }
    }

    // Simulate downloads
    function descargarExcel(tipo){
      const nombres = {
        semana: 'Alimentacion_Diaria_Semanal_BPA7.xlsx',
        mes: 'Alimentacion_Diaria_Mensual_BPA7.xlsx',
        anio: 'Alimentacion_Diaria_Anual_BPA7.xlsx'
      };
      alert('📁 (Simulado) Generando archivo: ' + (nombres[tipo] || 'Alimentacion_BPA7.xlsx'));
    }

    // Ver listado: redirigir al listado
    function verListado(){
      window.location.href = 'index.php?controller=Peces&action=bpa7Listado';
    }

    // Volver atras
    function volverAtras(){
      if(window.history.length > 1) window.history.back();
      else alert('No hay historial de navegación.');
    }

    // Limpiar formulario
    function limpiarFormulario(){
      if(!confirm('¿Limpiar todos los campos del formulario?')) return;
      document.getElementById('responsable').value = '';
      const fecha = document.getElementById('fecha');
      if(fecha) {
        const hoy = new Date().toISOString().split('T')[0];
        fecha.value = hoy;
      }
      document.getElementById('sede').value = '';
      document.getElementById('turno').value = '';
      document.getElementById('observaciones').value = '';
      document.getElementById('firma').value = '';
      // reset blocks to default 2 rows each
      resetBlock('b1');
      resetBlock('b2');
      resetBlock('b3');
    }

    function resetBlock(id){
      const tbody = document.getElementById(id);
      tbody.innerHTML = '';
      for(let i=1;i<=2;i++){
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td><input type="text" placeholder="UP-${String(i).padStart(2,'0')}"></td>
          <td><input type="text" placeholder="L-${String(i).padStart(3,'0')}"></td>
          <td><input type="number" step="0.01"></td>
          <td><input type="number" step="0.01"></td>
          <td><input type="number" step="0.01"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        `;
        tbody.appendChild(tr);
      }
    }

    // Guardar: construir POST y enviar al controlador
    function guardarDatos(){
      // simple validation
      const responsable = document.getElementById('responsable').value.trim();
      const fecha = document.getElementById('fecha').value.trim();
      const sede = document.getElementById('sede').value.trim();

      if(!responsable || !fecha || !sede){
        alert('Por favor complete Responsable, Fecha y Sede antes de guardar.');
        return;
      }

      const add = (name, value) => {
        const f = document.getElementById('formBpa7');
        const i = document.createElement('input');
        i.type = 'hidden'; i.name = name; i.value = value; f.appendChild(i);
      };

      // Campos generales
      add('codigo_formato','CORAQUA BPA-7');
      add('version','2.0');
      add('fecha_registro', fecha);
      add('responsable', responsable);
      add('sede', sede);

      const pushRow = (tr) => {
        const inputs = Array.from(tr.querySelectorAll('input'));
        if(inputs.length < 7) return; // up,lote,biomasa,ta,alsum,calibre,obs
        const [up,lote,biomasa,ta,alsum,calibre,obs] = inputs.map(i => i.value || '');
        if(!up && !lote && !biomasa && !ta && !alsum && !calibre && !obs) return;
        add('up[]', up);
        add('lote[]', lote);
        add('biomasa[]', biomasa);
        add('tasa_alimentacion[]', ta);
        add('alimento_suministrado[]', alsum);
        add('calibre[]', calibre);
        add('observaciones[]', obs);
      };

      ['b1','b2','b3'].forEach(id => {
        document.querySelectorAll(`#${id} tr`).forEach(pushRow);
      });

      if(!confirm('¿Deseas guardar los datos ingresados?')) return;
      document.getElementById('formBpa7').submit();
    }

    // Initialize default date and ensure blocks have at least 2 rows
    (function init(){
      const fecha = document.getElementById('fecha');
      if(fecha && !fecha.value){
        const hoy = new Date().toISOString().split('T')[0];
        fecha.value = hoy;
      }
      // ensure blocks have two rows
      ['b1','b2','b3'].forEach(id => {
        const tbody = document.getElementById(id);
        if(tbody.querySelectorAll('tr').length === 0) resetBlock(id);
      });
    })();

  </script>
</body>
</html>

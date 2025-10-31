  <!DOCTYPE html>
  <html lang="es">
  <head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CONTROL DE ALIMENTO EN ALMACÉN</title>
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
      font-size: 1.4rem;
      color: #0f2b2b;
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
      gap: 80px;
      margin: 24px 0 12px;
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
    .step.active .circle { background:#ff7b00; box-shadow:0 0 12px #ffb366; transform:translateY(-2px); }
    .step.active .label { color:#ff7b00; }
    .step:hover .circle { transform:translateY(-3px); box-shadow:0 6px 18px rgba(0,0,0,0.08); }

    /* ===== Panel del wizard (descargas a la izquierda) ===== */
    .wizard-panel {
      margin: 0 auto 0;
      max-width: 880px;
      text-align:left;
    }
    .wizard-content { display:none; opacity:0; transform:translateY(6px); transition: all .35s ease; }
    .wizard-content.active { display:block; opacity:1; transform:none; }

    .download-btn {
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
      width:100%; padding:9px 10px; border-radius:8px; border:1px solid #d8d8d8; font-size:0.95rem;
      transition: box-shadow .15s, border-color .15s;
    }
    input:focus, select:focus { outline:none; border-color:#ff7b00; box-shadow:0 0 6px rgba(255,123,0,0.12); }

    /* ===== Tabla ===== */
    .section-title {
      background:#ffeedb; color:#ff7b00; padding:8px 12px; border-radius:8px; font-weight:700; margin-top:20px;
    }
    .table-container { overflow:auto; margin-top:10px; }
    table { width:100%; border-collapse:collapse; min-width:780px; }
    th, td { padding:8px 6px; border:1px solid #e6e6e6; text-align:center; font-size:0.92rem; }
    th { background:#ff7b00; color:#fff; position:sticky; top:0; }
    td input { width:100%; border:none; background:transparent; padding:4px; text-align:center; }
    td input:focus { background:#fff7f0; outline:none; }

    /* ===== Botones ===== */
    .actions { display:flex; justify-content:space-between; gap:12px; flex-wrap:wrap; margin-top:18px; }
    .left-actions, .right-actions { display:flex; gap:10px; align-items:center; }
    .btn { background:#ff7b00; color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:700; }
    .btn:hover { background:#e66e00; transform:translateY(-2px); }
    .btn.secondary { background:#fff; color:#ff7b00; border:2px solid #ff7b00; }
    .btn.secondary:hover { background:#ff7b00; color:#fff; }

    footer { text-align:center; color:#666; font-size:0.88rem; margin-top:20px; }

    @media (max-width:900px){
      .wizard { gap:34px; }
      .step:not(:last-child)::after { right:-44px; width:88px; }
    }
    @media (max-width:640px){
      .wizard { gap:20px; }
      .step:not(:last-child)::after { display:none; }
      .step { width:84px; }
    }
  </style>
  </head>
  <body>

  <div class="container">

    <!-- Encabezado -->
    <div class="header-row">
      <div class="logo">
        <img src="img/logo-coraqua.png" alt="Logo CORAQUA" />
      </div>

      <div class="title-block">
        <h1>CONTROL DE ALIMENTO EN ALMACÉN</h1>
        <div class="meta">
          <span><strong>CÓDIGO:</strong> CORAQUA BPA-1</span>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <span><strong>VERSIÓN:</strong> 2.0</span>
        </div>
      </div>
    </div>
    <div id="mensajeEnviado" style="
    display:none;
    background:#28a745;
    color:#fff;
    padding:12px 20px;
    border-radius:10px;
    margin-bottom:16px;
    text-align:center;
    font-weight:600;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
    animation: fadeInMsg 0.5s ease;
">
    ✅ Los datos fueron enviados al Supervisor para su revisión.
</div>

<style>
@keyframes fadeInMsg {
  from {opacity:0; transform:translateY(-6px);}
  to {opacity:1; transform:none;}
}
</style>


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

    <!-- Descargas a la izquierda -->
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
      <div>
        <label for="fecha">Fecha</label>
        <input id="fecha" type="date" />
      </div>
      <div>
        <label for="sede">Sede</label>
        <input id="sede" type="text" placeholder="Ejemplo: Almacén Central" />
      </div>
      <div>
        <label for="encargado">Encargado</label>
        <input id="encargado" type="text" placeholder="Nombre del encargado" />
      </div>
      <div>
        <label for="mes">Mes</label>
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
    <div class="section-title">Detalle de Alimentos</div>
    <div class="table-container">
      <table id="tablaAlimentos">
        <thead>
          <tr>
            <th>#</th>
            <th>FECHA</th>
            <th>MARCA</th>
            <th>CALIBRE</th>
            <th>CANTIDAD</th>
            <th>NOMBRE</th>
            <th>OBS</th>
          </tr>
        </thead>
        <tbody id="bodyAlimentos">
          <tr>
            <td>1</td>
            <td><input type="date" /></td>
            <td><input type="text" placeholder="Marca A" /></td>
            <td><input type="text" placeholder="Calibre" /></td>
            <td><input type="number" step="0.01" placeholder="Kg / Unid" /></td>
            <td><input type="text" placeholder="Nombre del producto" /></td>
            <td><input type="text" placeholder="Observaciones" /></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Botones -->
    <div class="actions">
      <div class="left-actions">
        <button class="btn" onclick="agregarFilaAlimentos()">➕ Agregar fila</button>
        <button class="btn" onclick="eliminarFilaAlimentos()">➖ Quitar fila</button>
      </div>

      <div class="right-actions">
        <button class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
        <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
      </div>
    </div>

    <footer> CORAQUA © 2025 — Control de Alimento en Almacén </footer>
  </div>
  <!-- CAMBIAR ESTA LÍNEA -->
   <form id="formBPA1" style="display:none;" method="POST" action="/sistema-produccion/public/Supervisor/recibirBPA1">

      <input type="hidden" name="fecha" id="hiddenFecha">
      <input type="hidden" name="sede" id="hiddenSede">
      <input type="hidden" name="encargado" id="hiddenEncargado">
      <input type="hidden" name="mes" id="hiddenMes">
  </form>
  <script>
  // Función para guardar los datos
  function guardarDatos() {
      // Obtener datos del formulario principal
      const fecha = document.getElementById('fecha').value;
      const sede = document.getElementById('sede').value;
      const encargado = document.getElementById('encargado').value;
      const mes = document.getElementById('mes').value;
      
      // Validar campos obligatorios
      if (!fecha || !sede || !encargado || !mes) {
          alert('Por favor complete todos los campos del formulario');
          return;
      }
      
      // Obtener datos de la tabla
      const filas = document.querySelectorAll('#bodyAlimentos tr');
      const marcas = [];
      const calibres = [];
      const cantidades = [];
      const nombres = [];
      const observaciones = [];
      
      let datosValidos = false;
      
      filas.forEach(fila => {
          const inputs = fila.querySelectorAll('input');
          const marca = inputs[1]?.value || '';
          const cantidad = inputs[3]?.value || '';
          
          marcas.push(marca);
          calibres.push(inputs[2]?.value || '');
          cantidades.push(cantidad);
          nombres.push(inputs[4]?.value || '');
          observaciones.push(inputs[5]?.value || '');
          
          if (marca && cantidad) {
              datosValidos = true;
          }
      });
      
      if (!datosValidos) {
          alert('Por favor ingrese al menos una marca y cantidad en la tabla');
          return;
      }
      
      // Crear formulario dinámico para enviar todos los datos
      const form = document.getElementById('formBPA1');
      document.getElementById('hiddenFecha').value = fecha;
      document.getElementById('hiddenSede').value = sede;
      document.getElementById('hiddenEncargado').value = encargado;
      document.getElementById('hiddenMes').value = mes;
      
      // Agregar arrays como campos hidden
      marcas.forEach((marca, index) => {
          let input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'marca[]';
          input.value = marca;
          form.appendChild(input);
      });
      
      calibres.forEach((calibre, index) => {
          let input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'calibre[]';
          input.value = calibre;
          form.appendChild(input);
      });
      
      cantidades.forEach((cantidad, index) => {
          let input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'cantidad[]';
          input.value = cantidad;
          form.appendChild(input);
      });
      
      nombres.forEach((nombre, index) => {
          let input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'nombre_alimento[]';
          input.value = nombre;
          form.appendChild(input);
      });
      
      observaciones.forEach((obs, index) => {
          let input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'observaciones[]';
          input.value = obs;
          form.appendChild(input);
      });
      
      // Enviar formulario
      // Mostrar mensaje visual antes de enviar
const mensaje = document.getElementById('mensajeEnviado');
mensaje.style.display = 'block';

// Esperar 1.2 segundos antes de enviar
setTimeout(() => {
    form.submit();
}, 1200);


  }

  // Agregar botón de guardar en la sección de acciones
  function agregarBotonGuardar() {
      const leftActions = document.querySelector('.left-actions');
      const botonGuardar = document.createElement('button');
      botonGuardar.type = 'button';
      botonGuardar.className = 'btn';
      botonGuardar.innerHTML = '💾 Guardar';
      botonGuardar.onclick = guardarDatos;
      leftActions.appendChild(botonGuardar);
  }

  // Ejecutar cuando se cargue la página
  document.addEventListener('DOMContentLoaded', function() {
      agregarBotonGuardar();
      
      // Establecer fecha actual por defecto
      const fechaInput = document.getElementById('fecha');
      if (fechaInput && !fechaInput.value) {
          const today = new Date().toISOString().split('T')[0];
          fechaInput.value = today;
      }
  });
  </script>
  <script>
    function mostrarPaso(n){
      const steps=document.querySelectorAll('.step');
      const contents=document.querySelectorAll('.wizard-content');
      steps.forEach((s,i)=>s.classList.toggle('active',i===n-1));
      contents.forEach((c,i)=>c.classList.toggle('active',i===n-1));
    }
    function agregarFilaAlimentos(){
      const tbody=document.getElementById('bodyAlimentos');
      const n=tbody.rows.length+1;
      const tr=document.createElement('tr');
      tr.innerHTML=`<td>${n}</td>
        <td><input type="date" /></td>
        <td><input type="text" placeholder="Marca" /></td>
        <td><input type="text" placeholder="Calibre" /></td>
        <td><input type="number" step="0.01" placeholder="Kg / Unid" /></td>
        <td><input type="text" placeholder="Nombre del producto" /></td>
        <td><input type="text" placeholder="Observaciones" /></td>`;
      tbody.appendChild(tr);
    }
    function eliminarFilaAlimentos(){
      const tbody=document.getElementById('bodyAlimentos');
      if(tbody.rows.length>1) tbody.deleteRow(-1);
      else alert('Debe quedar al menos una fila.');
    }
    function descargarExcel(tipo){
      let nombre={semana:'ControlAlimento_Semanal.xlsx',mes:'ControlAlimento_Mensual.xlsx',anio:'ControlAlimento_Anual.xlsx'}[tipo];
      alert('📁 Se generará el archivo: '+nombre+' (simulado).');
    }
    function verListado() {
    // Redirige al método listarBPA1 del controlador
    window.location.href = "/sistema-produccion/public/Inventario/listarBPA1";
  }

    function volverAtras(){ window.history.back(); }
  </script>
  </body>
  </html>

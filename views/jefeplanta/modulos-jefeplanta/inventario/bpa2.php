<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CONTROL DE SAL EN ALMACÉN</title>
<style>
  * { box-sizing: border-box; font-family: "Poppins", "Segoe UI", sans-serif; }
  body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333;
    padding: 30px 16px;
  }
  .container { max-width: 1200px; margin: 18px auto; background: #fff; border-radius: 14px;
    padding: 28px 32px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); border-top: 7px solid #ff7b00;
    animation: fadeIn 0.6s ease; }
  @keyframes fadeIn { from {opacity:0; transform:translateY(8px)} to {opacity:1; transform:none} }
  .header-row { display:flex; justify-content:center; align-items:center; flex-direction:column; text-align:center; }
  .logo { width:72px; height:72px; margin-bottom:8px; }
  .logo img { width:100%; height:auto; }
  .title-block h1 { margin:0; font-size:1.25rem; color:#ff7b00; letter-spacing:0.2px; font-weight:700; }
  .meta { margin-top:6px; color:#555; font-size:0.9rem; }
  .meta strong { color:#ff7b00; }
  .wizard { display:flex; justify-content:center; align-items:flex-start; gap:72px; margin:22px auto 10px; flex-wrap:wrap; }
  .step { display:flex; flex-direction:column; align-items:center; position:relative; cursor:pointer; width:100px; }
  .step:not(:last-child)::after { content:""; position:absolute; top:22px; right:-56px; width:112px; height:3px; background:#e6e6e6; z-index:0; }
  .circle { width:48px; height:48px; border-radius:50%; background:#ddd; display:flex; align-items:center; justify-content:center;
    font-weight:700; color:#fff; z-index:1; transition:all .25s ease; font-size:1rem; }
  .label { margin-top:8px; font-weight:600; font-size:0.92rem; color:#555; text-align:center; }
  .step.active .circle { background:#ff7b00; box-shadow:0 0 12px #ffb366; transform:translateY(-2px);}
  .step.active .label { color:#ff7b00; }
  .wizard-panel { margin:8px auto 20px; max-width:880px; text-align:center; }
  .wizard-content { display:none; opacity:0; transform:translateY(6px); transition:all .35s ease; }
  .wizard-content.active { display:block; opacity:1; transform:none; }
  .download-btn { display:inline-block; background:#ff7b00; color:#fff; border:none; padding:10px 16px; border-radius:10px;
    cursor:pointer; font-weight:600; transition: background .18s, transform .12s; }
  .download-btn:hover { background:#e66e00; transform:translateY(-2px); }
  .info-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:14px; margin-top:20px; }
  label { display:block; font-weight:600; color:#333; margin-bottom:6px; font-size:0.92rem; }
  input[type="text"], input[type="date"], select {
    width:100%; padding:9px 10px; border-radius:8px; border:1px solid #d8d8d8;
    font-size:0.95rem; transition: box-shadow .15s, border-color .15s;
  }
  input:focus, select:focus { outline:none; border-color:#ff7b00; box-shadow:0 0 6px rgba(255,123,0,0.12); }
  .section-title { background:#ffeedb; color:#ff7b00; padding:8px 12px; border-radius:8px; font-weight:700; margin-top:20px; }
  .table-container { overflow:auto; margin-top:10px; }
  table { width:100%; border-collapse:collapse; min-width:700px; }
  th, td { padding:8px 6px; border:1px solid #e6e6e6; text-align:center; font-size:0.92rem; }
  th { background:#ff7b00; color:#fff; }
  td input { width:100%; border:none; background:transparent; padding:4px; text-align:center; }
  td input:focus { background:#fff7f0; outline:none; }
  .actions { display:flex; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-top:18px; }
  .btn { background:#ff7b00; color:#fff; border:none; padding:10px 14px; border-radius:10px; cursor:pointer; font-weight:700; }
  .btn:hover { background:#e66e00; transform:translateY(-2px); }
  .btn.secondary { background:#fff; color:#ff7b00; border:2px solid #ff7b00; }
  .btn.secondary:hover { background:#ff7b00; color:#fff; }
  footer { text-align:center; color:#666; font-size:0.88rem; margin-top:20px; }
</style>
</head>
<body>
<div class="container">
  <div class="header-row">
    <div class="logo"><img src="img/logo-coraqua.png" alt="Logo CORAQUA" /></div>
    <div class="title-block">
      <h1>CONTROL DE SAL EN ALMACÉN</h1>
      <div class="meta"><span><strong>CÓDIGO:</strong> CORAQUA BPA-2</span> | <span><strong>VERSIÓN:</strong> 2.0</span></div>
    </div>
  </div>
  <div class="wizard">
    <div class="step active" onclick="mostrarPaso(1)"><div class="circle">1</div><div class="label">Semanal</div></div>
    <div class="step" onclick="mostrarPaso(2)"><div class="circle">2</div><div class="label">Mensual</div></div>
    <div class="step" onclick="mostrarPaso(3)"><div class="circle">3</div><div class="label">Anual</div></div>
  </div>
  <div class="wizard-panel">
    <div id="contenido1" class="wizard-content active"><p>📅 Descargar reporte semanal en Excel</p><button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button></div>
    <div id="contenido2" class="wizard-content"><p>🗓️ Descargar reporte mensual en Excel</p><button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button></div>
    <div id="contenido3" class="wizard-content"><p>📊 Descargar reporte anual en Excel</p><button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button></div>
  </div>
  <div class="info-grid">
    <div><label for="fecha">Fecha</label><input id="fecha" type="date" /></div>
    <div><label for="sede">Sede</label><input id="sede" type="text" placeholder="Ejemplo: Almacén Central" /></div>
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
  <div class="section-title">Detalle de Control de Sal</div>
  <div class="table-container">
    <table id="tablaSal">
      <thead>
        <tr><th>#</th><th>FECHA</th><th>CANTIDAD</th><th>NOMBRE</th><th>OBS</th></tr>
      </thead>
      <tbody id="bodySal">
        <tr>
          <td>1</td>
          <td><input type="date" name="fecha_detalle[]" /></td>
          <td><input type="number" step="0.01" name="cantidad[]" placeholder="Kg / Unid" /></td>
          <td><input type="text" name="nombre_sal[]" placeholder="Nombre del producto" /></td>
          <td><input type="text" name="observaciones[]" placeholder="Observaciones" /></td>
        </tr>
      </tbody>
    </table>
  </div>
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
  <footer>CORAQUA ≥ 2025 — Control de Sal en Almacén</footer>
</div>
<!-- Formulario oculto para guardar datos -->
<form id="formBPA2" style="display: none;" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA2">
    <input type="hidden" name="fecha" id="hiddenFecha">
    <input type="hidden" name="sede" id="hiddenSede">
    <input type="hidden" name="encargado" id="hiddenEncargado">
    <input type="hidden" name="mes" id="hiddenMes">
    <input type="hidden" name="enviar_reporte" value="1">
</form>

<script>
function configurarElementosDOM() {
    // Definimos el botón para guardar y enviar reporte
    const btnGuardarEnviar = document.createElement('button');
    btnGuardarEnviar.id = 'btnGuardarEnviar';
    btnGuardarEnviar.classList.add('btn');
    btnGuardarEnviar.textContent = '💾 Guardar y Enviar Reporte';
    btnGuardarEnviar.onclick = guardarDatos;

    // Añadimos el botón a la sección de acciones
    const acciones = document.querySelector('.actions');
    acciones.appendChild(btnGuardarEnviar);
}

// Configuramos los elementos del DOM
configurarElementosDOM();

// Función para guardar los datos y enviar reporte
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
    const filas = document.querySelectorAll('#bodySal tr');
    const cantidades = [];
    const nombres = [];
    const observaciones = [];
    
    let datosValidos = false;
    
    filas.forEach(fila => {
        const cantidad = fila.querySelector('input[name="cantidad[]"]').value || '';
        const nombre = fila.querySelector('input[name="nombre_sal[]"]').value || '';
        const obs = fila.querySelector('input[name="observaciones[]"]').value || '';
        
        cantidades.push(cantidad);
        nombres.push(nombre);
        observaciones.push(obs);
        
        if (cantidad || nombre || obs) {
            datosValidos = true;
        }
    });
    
    if (!datosValidos) {
        alert('Por favor ingrese al menos una fila con datos');
        return;
    }
    
    // Crear formulario dinámico para enviar todos los datos
    const form = document.getElementById('formBPA2');
    document.getElementById('hiddenFecha').value = fecha;
    document.getElementById('hiddenSede').value = sede;
    document.getElementById('hiddenEncargado').value = encargado;
    document.getElementById('hiddenMes').value = mes;
    
    // Limpiar campos anteriores
    const camposExistentes = form.querySelectorAll('input[name="cantidad[]"], input[name="nombre_sal[]"], input[name="observaciones[]"]');
    camposExistentes.forEach(campo => campo.remove());
    
    // Agregar arrays como campos hidden
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
        input.name = 'nombre_sal[]';
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
    
    // Mostrar confirmación
    if (confirm('¿Desea guardar los datos y enviar el reporte al supervisor?')) {
        // Enviar formulario
        form.submit();
    }
}
// Establecer fecha actual por defecto
document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fecha');
    if (fechaInput && !fechaInput.value) {
        const today = new Date().toISOString().split('T')[0];
        fechaInput.value = today;
    }
});
function mostrarPaso(n){
  const steps=document.querySelectorAll('.step');
  const contents=document.querySelectorAll('.wizard-content');
  steps.forEach((s,i)=>s.classList.toggle('active',i===n-1));
  contents.forEach((c,i)=>c.classList.toggle('active',i===n-1));
}
function agregarFila(){
  const tbody=document.getElementById('bodySal');
  const n=tbody.rows.length+1;
  const tr=document.createElement('tr');
  tr.innerHTML=`
    <td>${n}</td>
    <td><input type="date" name="fecha_detalle[]" /></td>
    <td><input type="number" step="0.01" name="cantidad[]" placeholder="Kg / Unid" /></td>
    <td><input type="text" name="nombre_sal[]" placeholder="Nombre del producto" /></td>
    <td><input type="text" name="observaciones[]" placeholder="Observaciones" /></td>`;
  tbody.appendChild(tr);
}
function eliminarFila(){
  const tbody=document.getElementById('bodySal');
  if(tbody.rows.length>1) tbody.deleteRow(-1);
  else alert('Debe quedar al menos una fila.');
}
function descargarExcel(tipo){
  alert('📁 Se generará el archivo Excel: ControlSal_'+tipo+'.xlsx (simulado)');
}
function verListado(){window.location.href="/sistema-produccion/public/Inventario/listarBPA2";}
function volverAtras(){
  window.location.href = "/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloInventario#";
}
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CONTROL DE MEDICAMENTO</title>
<style>
  * { box-sizing: border-box; font-family: "Poppins","Segoe UI",sans-serif; }
  body {
    margin: 0; min-height: 100vh;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333; padding: 30px 16px;
  }
  .container {
    max-width: 1200px; margin: 18px auto; background:#fff;
    border-radius:14px; padding:28px 32px;
    box-shadow:0 8px 24px rgba(0,0,0,0.12);
    border-top:7px solid #ff7b00; animation:fadeIn 0.6s ease;
  }
  @keyframes fadeIn { from{opacity:0;transform:translateY(8px)} to{opacity:1;transform:none} }
  .header-row { display:flex; flex-direction:column; text-align:center; align-items:center; }
  .logo { width:72px; height:72px; margin-bottom:8px; }
  .logo img { width:100%; height:auto; }
  h1 { margin:0; font-size:1.25rem; color:#ff7b00; font-weight:700; }
  .meta { margin-top:6px; font-size:0.9rem;color:#555; }
  .meta strong{color:#ff7b00;}
  .wizard{display:flex;justify-content:center;gap:72px;margin:22px auto 10px;flex-wrap:wrap;}
  .step{display:flex;flex-direction:column;align-items:center;cursor:pointer;width:100px;position:relative;}
  .step:not(:last-child)::after{content:"";position:absolute;top:22px;right:-56px;width:112px;height:3px;background:#e6e6e6;}
  .circle{width:48px;height:48px;border-radius:50%;background:#ddd;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;transition:all .25s;}
  .label{margin-top:8px;font-weight:600;font-size:0.92rem;color:#555;}
  .step.active .circle{background:#ff7b00;box-shadow:0 0 12px #ffb366;transform:translateY(-2px);}
  .step.active .label{color:#ff7b00;}
  .wizard-panel{text-align:center;margin:8px auto 20px;max-width:880px;}
  .wizard-content{display:none;opacity:0;transform:translateY(6px);transition:.35s;}
  .wizard-content.active{display:block;opacity:1;transform:none;}
  .download-btn{background:#ff7b00;color:#fff;padding:10px 16px;border-radius:10px;font-weight:600;border:none;cursor:pointer;}
  .download-btn:hover{background:#e66e00;transform:translateY(-2px);}
  .info-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px;margin-top:20px;}
  label{font-weight:600;margin-bottom:6px;}
  input,select{
    width:100%;padding:9px;border-radius:8px;border:1px solid #d8d8d8;font-size:0.95rem;
  }
  .section-title{background:#ffeedb;color:#ff7b00;padding:8px 12px;border-radius:8px;font-weight:700;margin-top:20px;}
  .table-container{overflow:auto;margin-top:10px;}
  table{width:100%;border-collapse:collapse;min-width:700px;}
  th,td{padding:8px;border:1px solid #e6e6e6;text-align:center;font-size:0.92rem;}
  th{background:#ff7b00;color:#fff;}
  td input{width:100%;border:none;padding:4px;text-align:center;background:transparent;}
  td input:focus{background:#fff7f0;outline:none;}
  .actions{display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:18px;}
  .btn{
    background:#ff7b00;color:#fff;padding:10px 14px;border:none;border-radius:10px;font-weight:700;cursor:pointer;
  }
  .btn.secondary{background:#fff;color:#ff7b00;border:2px solid #ff7b00;}
  .btn:hover{background:#e66e00;transform:translateY(-2px);}
  footer{text-align:center;margin-top:20px;color:#666;font-size:0.88rem;}
</style>
</head>

<body>
<div class="container">

  <!-- Header -->
  <div class="header-row">
    <div class="logo"><img src="img/logo-coraqua.png"></div>
    <h1>CONTROL DE MEDICAMENTO</h1>
    <div class="meta"><span><strong>CÓDIGO:</strong> CORAQUA BPA-3</span> | <span><strong>VERSIÓN:</strong> 2.0</span></div>
  </div>

  <!-- Wizard -->
  <div class="wizard">
    <div class="step active" onclick="mostrarPaso(1)"><div class="circle">1</div><div class="label">Semanal</div></div>
    <div class="step" onclick="mostrarPaso(2)"><div class="circle">2</div><div class="label">Mensual</div></div>
    <div class="step" onclick="mostrarPaso(3)"><div class="circle">3</div><div class="label">Anual</div></div>
  </div>

  <div class="wizard-panel">
    <div id="contenido1" class="wizard-content active"><p>📅 Descargar reporte semanal en Excel</p><button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button></div>
    <div id="contenido2" class="wizard-content"><p>🗓️ Descargar reporte mensual</p><button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button></div>
    <div id="contenido3" class="wizard-content"><p>📊 Descargar reporte anual</p><button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button></div>
  </div>

  <!-- Form -->
  <div class="info-grid">
    <div><label>Fecha</label><input id="fecha" type="date"></div>
    <div><label>Sede</label><input id="sede" type="text" placeholder="Ejemplo: Almacén Central"></div>
    <div><label>Encargado</label><input id="encargado" type="text" placeholder="Nombre del encargado"></div>
    <div>
      <label>Mes</label>
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
  <div class="section-title">Registro de Medicamentos</div>
  <div class="table-container">
    <table id="tablaMed">
      <thead>
        <tr><th>#</th><th>FECHA</th><th>CANTIDAD</th><th>MEDICAMENTO</th><th>OBS</th></tr>
      </thead>
      <tbody id="bodyMed">
        <tr>
          <td>1</td>
          <td><input type="date" name="fecha_detalle[]"></td>
          <td><input type="number" step="0.01" name="cantidad[]" placeholder="Cantidad"></td>
          <td><input type="text" name="medicamento[]" placeholder="Nombre del medicamento"></td>
          <td><input type="text" name="observaciones[]" placeholder="Observación"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Botones -->
  <div class="actions">
    <div>
      <button class="btn" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn" onclick="eliminarFila()">➖ Quitar fila</button>
      <button class="btn" id="btnGuardarEnviar" onclick="guardarDatos()">💾 Guardar y Enviar Reporte</button>
    </div>
    <div>
      <button class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
      <button class="btn secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
    </div>
  </div>

  <footer>CORAQUA ≥ 2025 — Control de Medicamento</footer>

</div>

<!-- Form oculto -->
<form id="formBPA3" style="display:none" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA3">
  <input type="hidden" name="fecha" id="hiddenFecha">
  <input type="hidden" name="sede" id="hiddenSede">
  <input type="hidden" name="encargado" id="hiddenEncargado">
  <input type="hidden" name="mes" id="hiddenMes">
  <input type="hidden" name="enviar_reporte" value="1">
    <div id="inputsDetalles"></div>
</form>

<script>
document.addEventListener('DOMContentLoaded', ()=>{
  const f=document.getElementById('fecha');
  if(!f.value) f.value=new Date().toISOString().split('T')[0];
});

function mostrarPaso(n){
  document.querySelectorAll('.step').forEach((s,i)=>s.classList.toggle('active',i===n-1));
  document.querySelectorAll('.wizard-content').forEach((c,i)=>c.classList.toggle('active',i===n-1));
}

function agregarFila(){
  const tbody=document.getElementById('bodyMed');
  const n=tbody.rows.length+1;
  const tr=document.createElement('tr');
  tr.innerHTML=`
    <td>${n}</td>
    <td><input type="date" name="fecha_detalle[]"></td>
    <td><input type="number" step="0.01" name="cantidad[]"></td>
    <td><input type="text" name="medicamento[]"></td>
    <td><input type="text" name="observaciones[]"></td>`;
  tbody.appendChild(tr);
}

function eliminarFila(){
  const tbody=document.getElementById('bodyMed');
  if(tbody.rows.length>1) tbody.deleteRow(-1);
  else alert("Debe quedar al menos una fila.");
}

function guardarDatos(){
  const fecha=document.getElementById('fecha').value;
  const sede=document.getElementById('sede').value;
  const encargado=document.getElementById('encargado').value;
  const mes=document.getElementById('mes').value;
  if(!fecha||!sede||!encargado||!mes) return alert("Complete todos los campos");

  const filas=document.querySelectorAll('#bodyMed tr');
  let meds=[],cant=[],obs=[];
  let valido=false;
  filas.forEach(f=>{
    const c=f.querySelector('input[name="cantidad[]"]').value||'';
    const m=f.querySelector('input[name="medicamento[]"]').value||'';
    const o=f.querySelector('input[name="observaciones[]"]').value||'';
    meds.push(m); cant.push(c); obs.push(o);
    if(c||m||o) valido=true;
  });
  if(!valido) return alert("Ingrese al menos una fila con datos");

  const form=document.getElementById('formBPA3');
  document.getElementById('hiddenFecha').value=fecha;
  document.getElementById('hiddenSede').value=sede;
  document.getElementById('hiddenEncargado').value=encargado;
  document.getElementById('hiddenMes').value=mes;
  const cont = document.getElementById('inputsDetalles');
cont.innerHTML = ''; // limpiar

cant.forEach(v=>{
  cont.innerHTML += `<input type="hidden" name="cantidad[]" value="${v}">`;
});
meds.forEach(v=>{
  cont.innerHTML += `<input type="hidden" name="medicamento[]" value="${v}">`;
});
obs.forEach(v=>{
  cont.innerHTML += `<input type="hidden" name="observaciones[]" value="${v}">`;
});


  if(confirm("¿Guardar y enviar reporte?")) form.submit();
}

function descargarExcel(t){alert('📁 Archivo generado: Medicamento_'+t+'.xlsx (simulado)');}
function verListado(){window.location='/sistema-produccion/public/Inventario/listarBPA3';}
function volverAtras(){window.location="/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloInventario#";}
</script>
</body>
</html>

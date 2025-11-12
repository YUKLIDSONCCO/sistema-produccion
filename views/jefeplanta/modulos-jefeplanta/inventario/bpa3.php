<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CONTROL DE MEDICAMENTO — CORAQUA</title>
<style>
  * { box-sizing: border-box; font-family: "Poppins","Segoe UI",sans-serif; }

  body {
    margin: 0;
    background: linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color: #333;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 20px;
  }

  .container {
    width: 100%;
    max-width: 1400px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    padding: 30px;
    border-top: 8px solid #ff7b00;
  }

  .header-row {
    text-align: center;
    margin-bottom: 20px;
  }

  .logo img { width: 90px; height: auto; }

  h1 {
    margin: 8px 0 4px;
    font-size: 1.6rem;
    color: #ff7b00;
    font-weight: 800;
  }

  .meta {
    font-size: 0.9rem;
    color: #555;
  }
  .meta strong { color: #ff7b00; }

  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
    gap: 16px;
    margin-bottom: 20px;
  }

  label {
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
    display: block;
  }

  input, select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 0.95rem;
    transition: 0.2s;
  }

  input:focus, select:focus {
    outline: none;
    border-color: #ff7b00;
    box-shadow: 0 0 6px rgba(255,123,0,0.2);
  }

  .section-title {
    background: #ffeedb;
    color: #ff7b00;
    padding: 10px;
    border-radius: 8px;
    font-weight: 700;
    margin-bottom: 8px;
    text-align: center;
  }

  .table-container { overflow-x: auto; width: 100%; }

  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
  }

  th, td {
    border: 1px solid #e6e6e6;
    text-align: center;
    padding: 8px;
  }

  th {
    background: #ff7b00;
    color: #fff;
    font-size: 0.9rem;
  }

  td input {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
    padding: 6px;
  }

  td input:focus {
    background: #fff6eb;
    outline: none;
  }

  .actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 10px;
    margin-top: 20px;
  }

  .btn {
    padding: 10px 14px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.2s;
  }

  .btn.orange { background: #ff7b00; color: #fff; }
  .btn.orange:hover { background: #e66e00; transform: translateY(-2px); }

  .btn.white {
    background: #fff; color: #ff7b00; border: 2px solid #ff7b00;
  }

  .btn.white:hover { background: #ff7b00; color: #fff; }

  footer {
    text-align: center;
    font-size: 0.9rem;
    color: #555;
    margin-top: 30px;
  }

  @media (max-width:768px) {
    h1 { font-size: 1.2rem; }
    th, td { font-size: 0.85rem; }
  }
</style>
</head>
<body>
<div class="container">

  <div class="header-row">
    <div class="logo"><img src="/sistema-produccion/public/img/coraqua.png" alt="CORAQUA"></div>
    <h1>CONTROL DE MEDICAMENTO</h1>
    <div class="meta"><strong>CÓDIGO:</strong> CORAQUA BPA-3 | <strong>VERSIÓN:</strong> 2.0</div>
  </div>

  <div class="info-grid">
    <div><label>Fecha</label><input id="fecha" type="date"></div>
    <div><label>Sede</label>
      <select id="sede">
        <option value="">Seleccione sede</option>
        <option>Chichillapi</option><option>Cambruni</option>
      </select>
    </div>
    <div><label>Encargado</label><input id="encargado" type="text" placeholder="Nombre del encargado"></div>
    <div><label>Mes</label>
      <select id="mes">
        <option value="">Seleccione mes</option>
        <option>Enero</option><option>Febrero</option><option>Marzo</option>
        <option>Abril</option><option>Mayo</option><option>Junio</option>
        <option>Julio</option><option>Agosto</option><option>Setiembre</option>
        <option>Octubre</option><option>Noviembre</option><option>Diciembre</option>
      </select>
    </div>
  </div>

  <div class="section-title">Registro de Medicamentos</div>

  <div class="table-container">
    <table id="tablaMed">
      <thead>
        <tr><th>#</th><th>FECHA</th><th>CANTIDAD</th><th>MEDICAMENTO</th><th>OBSERVACIÓN</th></tr>
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

  <div class="actions">
    <div>
      <button class="btn orange" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn orange" onclick="eliminarFila()">➖ Quitar fila</button>
      <button class="btn orange" onclick="guardarDatos()">💾 Guardar</button>
    </div>
    <div>
      <button class="btn white" onclick="verListado()">📖 Ver Listado</button>
      <button class="btn white" onclick="volverAtras()">⬅️ Volver Panel</button>
    </div>
  </div>

  <footer>CORAQUA © 2025 — Control de Medicamento</footer>

</div>

<form id="formBPA3" style="display:none" method="POST" action="/sistema-produccion/public/Inventario/guardarBPA3">
  <input type="hidden" name="fecha" id="hiddenFecha">
  <input type="hidden" name="sede" id="hiddenSede">
  <input type="hidden" name="encargado" id="hiddenEncargado">
  <input type="hidden" name="mes" id="hiddenMes">
  <input type="hidden" name="enviar_reporte" value="1">
  <div id="inputsDetalles"></div>
</form>

<script>
document.addEventListener('DOMContentLoaded', ()=> {
  const hoy = new Date().toISOString().split('T')[0];
  document.getElementById('fecha').value = hoy;
  const tbody = document.getElementById('bodyMed');
  tbody.querySelector('input[name="fecha_detalle[]"]').value = hoy;
  for (let i = 1; i < 5; i++) agregarFila();
  tbody.querySelectorAll('input[name="fecha_detalle[]"]').forEach(i => i.value = hoy);
});

function agregarFila(){
  const tbody=document.getElementById('bodyMed');
  const n=tbody.rows.length+1;
  const hoy = new Date().toISOString().split('T')[0];
  const tr=document.createElement('tr');
  tr.innerHTML=`<td>${n}</td>
    <td><input type="date" name="fecha_detalle[]" value="${hoy}"></td>
    <td><input type="number" step="0.01" name="cantidad[]" placeholder="Cantidad"></td>
    <td><input type="text" name="medicamento[]" placeholder="Nombre del medicamento"></td>
    <td><input type="text" name="observaciones[]" placeholder="Observación"></td>`;
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
  const datos=[];
  filas.forEach(tr=>{
    const i=tr.querySelectorAll('input');
    datos.push({
      fecha_detalle:i[0].value,
      cantidad:i[1].value,
      medicamento:i[2].value,
      observaciones:i[3].value
    });
  });

  const form=document.getElementById('formBPA3');
  document.getElementById('hiddenFecha').value=fecha;
  document.getElementById('hiddenSede').value=sede;
  document.getElementById('hiddenEncargado').value=encargado;
  document.getElementById('hiddenMes').value=mes;

  const cont=document.getElementById('inputsDetalles');
  cont.innerHTML='';
  datos.forEach(f=>{
    for(const k in f){
      cont.innerHTML+=`<input type="hidden" name="${k}[]" value="${f[k]}">`;
    }
  });

  if(confirm("¿Guardar y enviar reporte?")) form.submit();
}

function verListado(){window.location='/sistema-produccion/public/Inventario/listarBPA3';}
function volverAtras(){window.location="/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloInventario#";}
</script>
</body>
</html>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>MORTALIDAD DIARIA - LARVAS — CORAQUA</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --cora-orange:#ff7b00;
    --cora-dark:#0f2b2b;
    --bg-1: linear-gradient(135deg,#fffaf2 0%, #fff1e0 40%, #f6fbff 100%);
    --card-bg: rgba(255,255,255,0.98);
    --muted:#6b6b6b;
    --accent:#0f5660;
    --radius:12px;
    --soft-shadow: 0 8px 30px rgba(15,43,43,0.06);
  }
  *{box-sizing:border-box;}
  body{
    margin:0;
    min-height:100vh;
    font-family:Inter, Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    background: var(--bg-1);
    color:var(--cora-dark);
    padding:16px;
    -webkit-font-smoothing:antialiased;
  }
  .container{
    max-width:1200px;
    margin:20px auto;
    background:var(--card-bg);
    border-radius:16px;
    padding:24px;
    box-shadow:var(--soft-shadow);
    border-top:6px solid var(--cora-orange);
  } 
  .header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    flex-wrap:wrap;
  }
  .brand{display:flex; align-items:center; gap:14px;}
  .logo{width:64px; height:64px; border-radius:12px; background:linear-gradient(180deg,#fff,#fffdf9); display:flex; align-items:center; justify-content:center; box-shadow:0 6px 20px rgba(15,43,43,0.06);}
  .logo img{width:58px; height:auto;}
  .title-col h1{margin:0; font-size:1.15rem; font-weight:700; line-height:1.3; text-transform:uppercase;}
  .meta{color:var(--muted); font-size:0.9rem; margin-top:4px;}
  .btn{
    background:var(--cora-orange);
    color:white;
    border:none;
    padding:9px 15px;
    border-radius:10px;
    cursor:pointer;
    font-weight:700;
    box-shadow:0 6px 18px rgba(255,123,0,0.18);
    transition:all 0.2s ease;
    display:flex;
    align-items:center;
    gap:6px;
    font-size:0.95rem;
  }
  .btn:hover{transform:translateY(-2px);}
  .btn.secondary{background:transparent; color:var(--cora-orange); border:2px solid var(--cora-orange);}
  .btn.ghost{background:transparent; color:var(--muted); border:1px solid #ddd;}
  .section{margin-top:22px;}
  .section h3{
    margin:0 0 12px 0;
    font-size:1.05rem;
    color:var(--cora-dark);
    font-weight:700;
    padding-bottom:6px;
    border-bottom:1px solid rgba(15,43,43,0.06);
  }
  .table-section{width:100%; border-radius:12px; overflow-x:auto; border:1px solid #eee; box-shadow:0 2px 6px rgba(0,0,0,0.02);}
  table{width:100%; border-collapse:collapse; min-width:900px;}
  th, td{padding:8px 10px; border-bottom:1px solid #f2f2f2; text-align:center;}
  thead th{background:linear-gradient(90deg,var(--cora-orange),#ff9a4a); color:white; font-weight:700; font-size:0.9rem;}
  input[type="text"],input[type="number"],input[type="date"]{
    width:100%; padding:7px 9px; border-radius:8px; border:1px solid #ddd; font-size:0.9rem;
  }
  textarea{
    width:100%; border-radius:10px; border:1px solid #ddd; padding:10px; font-size:0.9rem; min-height:80px;
  }
  .actions{
    margin-top:20px;
    display:flex;
    justify-content:center;
    gap:12px;
    flex-wrap:wrap;
    padding-top:16px;
    border-top:1px solid #f0f0f0;
  }
  footer{text-align:center; margin-top:20px; color:var(--muted); font-size:0.9rem;}
  @media(max-width:768px){
    table{font-size:0.8rem;}
    th,td{padding:6px;}
    .brand{flex-direction:column; text-align:center;}
    .title-col h1{font-size:1rem;}
  }
</style>
</head>
<body>
<div class="container">
  <form id="formOvas" method="POST">
    <div class="header">
      <div class="brand">
        <div class="logo"><img src="img/logo-coraqua.png" alt="Logo CORAQUA"></div>
        <div class="title-col">
          <h1>MORTALIDAD DIARIA - LARVAS</h1>
          <div class="meta"><strong>CÓDIGO:</strong> CORAQUA-BPA 3 | <strong>VERSIÓN:</strong> 2.0</div>
        </div>
      </div>
      <button class="btn ghost" id="volverBtn" type="button">◀️ Volver atrás</button>
    </div>

    <!-- DATOS GENERALES -->
    <div class="section">
      <h3>DATOS GENERALES</h3>
      <div style="display:flex; flex-wrap:wrap; gap:12px;">
        <div style="flex:1; min-width:160px">
          <label>ENCARGADO</label>
          <input type="text" id="encargado" name="encargado" required>
        </div>
        <div style="flex:1; min-width:160px">
          <label>LOTE</label>
          <input type="text" id="lote" name="lote" required>
        </div>
        <div style="flex:1; min-width:160px">
          <label>SEDE</label>
          <input type="text" id="sede" name="sede" required>
        </div>
        <div style="flex:1; min-width:160px">
          <label>CANT. SIEMBRA</label>
          <input type="number" id="cantsiembra" name="cantidad_siembra" required>
        </div>
      </div>
    </div>

    <!-- TABLA DE REGISTRO -->
    <div class="section">
      <h3>REGISTRO DIARIO DE MORTALIDAD</h3>
      <div class="table-section">
        <table id="tablaLarvas">
          <thead>
            <tr>
              <th>FECHA</th><th>BATERIA</th><th>BATEA</th>
              <th colspan="2">C1</th><th colspan="2">C2</th><th colspan="2">C3</th>
              <th colspan="2">C4</th><th colspan="2">C5</th><th colspan="2">C6</th><th colspan="2">C7</th>
              <th>TOTAL</th><th>OBSERVACIONES</th>
            </tr>
            <tr>
              <th colspan="3"></th>
              <th>L.M.</th><th>L.D.</th><th>L.M.</th><th>L.D.</th><th>L.M.</th><th>L.D.</th>
              <th>L.M.</th><th>L.D.</th><th>L.M.</th><th>L.D.</th><th>L.M.</th><th>L.D.</th><th>L.M.</th><th>L.D.</th>
              <th colspan="2"></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
      <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:10px;">
        <button class="btn secondary" type="button" onclick="agregarFila()">➕ Agregar fila</button>
        <button class="btn ghost" type="button" onclick="eliminarFila()">➖ Quitar fila</button>
      </div>
    </div>

    <!-- OBSERVACIONES -->
    <div class="section">
      <h3>OBSERVACIONES GENERALES</h3>
      <textarea id="observaciones" name="observacion"></textarea>
    </div>

    <input type="hidden" name="id_lote" value="1">
    <input type="hidden" name="id_sede" value="1">
    <input type="hidden" name="id_especie" value="1">
    <input type="hidden" name="responsable_area" value="Responsable Area">
    <input type="hidden" name="jefe_planta" value="Jefe Planta">
    <input type="hidden" name="jefe_produccion" value="Jefe Produccion">
    <input type="hidden" name="codigo_formato" value="CORAQUA-BPA3">
    <input type="hidden" name="version" value="2.0">

    <div class="actions">
      <button id="btnGuardar" class="btn" type="submit">💾 Guardar Datos</button>
      <button class="btn secondary" id="limpiarBtn" type="button">🧹 Limpiar</button>
    </div>

    <footer>CORAQUA © MORTALIDAD DIARIA DE LARVAS</footer>
  </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => agregarFila());

// ✅ AGREGAR FILA (con nombres de inputs con [])
function agregarFila(){
  const tbody = document.querySelector('#tablaLarvas tbody');
  const tr = document.createElement('tr');
  const fechaHoy = new Date().toISOString().split('T')[0];
  tr.innerHTML = `
    <td><input type="date" name="fecha_control[]" value="${fechaHoy}"></td>
    <td><input type="text" name="bateria[]"></td>
    <td><input type="text" name="batea[]"></td>
    ${[1,2,3,4,5,6,7].map(i=>`
      <td><input type="number" name="c${i}_lm[]" value="0" min="0"></td>
      <td><input type="number" name="c${i}_ld[]" value="0" min="0"></td>
    `).join('')}
    <td><input type="number" name="total[]" value="0" min="0" readonly></td>
    <td><input type="text" name="observacion[]"></td>
  `;
  tbody.appendChild(tr);

  // recalcula total automático
  tr.querySelectorAll('input[type="number"]').forEach(inp =>
    inp.addEventListener('input', ()=>calcularTotal(tr))
  );
}

// ✅ ELIMINAR ÚLTIMA FILA
function eliminarFila(){
  const tbody=document.querySelector('#tablaLarvas tbody');
  if(tbody.rows.length>0) tbody.deleteRow(-1);
}

// ✅ CALCULAR TOTAL AUTOMÁTICO
function calcularTotal(fila){
  const nums=[...fila.querySelectorAll('input[type="number"]')]
    .slice(0,-1)
    .map(i=>parseInt(i.value||0));
  fila.querySelector('input[name="total[]"]').value=nums.reduce((a,b)=>a+b,0);
}

// ✅ SUBMIT DEL FORMULARIO
document.getElementById('formOvas').addEventListener('submit', async e=>{
  e.preventDefault();
  const btn=document.getElementById('btnGuardar');
  btn.disabled=true; btn.textContent='Guardando...';

  try{
    const formData=new FormData();

    // Datos generales
    ['encargado','lote','sede','cantidad_siembra','id_lote','id_sede','id_especie','responsable_area','jefe_planta','jefe_produccion','codigo_formato','version']
      .forEach(id=>{
        const el=document.getElementById(id)||document.querySelector(`[name="${id}"]`);
        formData.append(id,el?.value||'');
      });
    formData.append('observacion_general',document.getElementById('observaciones').value);

    // Filas
    const filas=document.querySelectorAll('#tablaLarvas tbody tr');
    if(!filas.length){
      alert('Debe agregar al menos una fila');
      btn.disabled=false; btn.textContent='💾 Guardar Datos';
      return;
    }

    filas.forEach(f=>{
      f.querySelectorAll('input').forEach(inp=>{
        formData.append(inp.name, inp.value);
      });
    });

    // Enviar al backend
    const res=await fetch('/sistema-produccion/public/index.php?controller=Ovas&action=procesarBPA3',{
      method:'POST',
      body:formData
    });

    const txt=await res.text();
    console.log('Respuesta del servidor:',txt);

    let data;
    try{ data=JSON.parse(txt); }
    catch(e){ throw new Error('Respuesta del servidor no es JSON válido: '+txt); }

    if(data.success){
      alert('✅ '+data.message);
      document.getElementById('formOvas').reset();
      document.querySelector('#tablaLarvas tbody').innerHTML='';
      agregarFila();
    }else{
      alert('❌ Error: '+(data.error||'No se guardaron los datos'));
    }

  }catch(err){
    console.error(err);
    alert('❌ Error: '+err.message);
  }finally{
    btn.disabled=false;
    btn.textContent='💾 Guardar Datos';
  }
});

// ✅ BOTÓN LIMPIAR
document.getElementById('limpiarBtn').addEventListener('click',()=>{
  if(confirm('¿Limpiar todo el formulario?')){
    document.getElementById('formOvas').reset();
    document.querySelector('#tablaLarvas tbody').innerHTML='';
    agregarFila();
  }
});

// ✅ BOTÓN VOLVER
document.getElementById('volverBtn').addEventListener('click',()=>window.history.back());
</script>

</body>
</html>

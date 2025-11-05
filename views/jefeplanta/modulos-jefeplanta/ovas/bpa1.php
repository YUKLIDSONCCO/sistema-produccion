<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES — CORAQUA</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --cora-orange:#ff7b00;
    --cora-dark:#0f2b2b;
    --bg-1: linear-gradient(135deg,#fffaf2 0%, #fff1e0 40%, #f6fbff 100%);
    --card-bg: rgba(255,255,255,0.98);
    --muted:#6b6b6b;
    --accent:#0f5660;
    --radius:12px;
    --soft-shadow: 0 8px 30px rgba(15,43,43,0.06);
  }
  *{box-sizing:border-box}
  body{margin:0; min-height:100vh; font-family:Inter, Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background: var(--bg-1); color:var(--cora-dark); padding:28px; -webkit-font-smoothing:antialiased;}

  .container{max-width:1100px; margin:20px auto; background:var(--card-bg); border-radius:16px; padding:24px; box-shadow:var(--soft-shadow); border-top:6px solid var(--cora-orange);} 

  /* header */
  .header{display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap}
  .brand{display:flex; align-items:center; gap:14px}
  .logo{width:76px; height:76px; border-radius:12px; background:linear-gradient(180deg,#fff,#fffdf9); display:flex; align-items:center; justify-content:center; box-shadow:0 6px 20px rgba(15,43,43,0.06); border:1px solid rgba(15,43,43,0.04); overflow:hidden}
  .logo img{width:70px; height:auto}
  .title-col h1{margin:0; font-size:1.15rem; font-weight:700; line-height:1.3}
  .meta{color:var(--muted); font-size:0.92rem; margin-top:4px}

  .header-actions{display:flex; gap:12px; align-items:center; flex-wrap:wrap}
  .btn{
    background:var(--cora-orange);
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:10px;
    cursor:pointer;
    font-weight:700;
    box-shadow:0 6px 18px rgba(255,123,0,0.18);
    transition: all 0.2s ease;
    display:flex;
    align-items:center;
    gap:6px;
    font-size:0.95rem;
  }
  .btn:hover{transform:translateY(-2px); box-shadow:0 8px 24px rgba(255,123,0,0.25);}
  .btn:active{transform:translateY(0);}
  .btn.secondary{
    background:transparent;
    color:var(--cora-orange);
    border:2px solid var(--cora-orange);
    box-shadow:none;
  }
  .btn.secondary:hover{background:rgba(255,123,0,0.04);}
  .btn.ghost{
    background:transparent;
    color:var(--muted);
    border:1px solid #ddd;
    box-shadow:none;
  }
  .btn.ghost:hover{background:#f9f9f9;}

  /* steps */
  .wizard{
    display:flex;
    gap:12px;
    padding:12px 16px;
    margin-top:16px;
    border-radius:12px;
    background:linear-gradient(90deg, rgba(15,86,96,0.03), rgba(255,123,0,0.02));
    border:1px solid rgba(15,43,43,0.04);
    align-items:center;
    font-size:0.95rem;
  }
  .step-simple{
    padding:8px 14px;
    border-radius:10px;
    font-weight:700;
    color:var(--muted);
    background:transparent;
    transition: all 0.2s;
  }
  .step-simple.active{
    background:rgba(255,123,0,0.15);
    color:var(--cora-dark);
  }
  .progress{
    flex:1;
    height:8px;
    background:#f0f0f0;
    border-radius:999px;
    overflow:hidden;
    margin:0 12px;
  }
  .progress>i{
    display:block;
    height:100%;
    width:33%;
    background:linear-gradient(90deg,var(--cora-orange),#ffab6a);
    border-radius:999px;
  }

  .grid{display:grid; grid-template-columns:repeat(12,1fr); gap:16px; margin-top:20px}
  .card{
    grid-column:span 12;
    background:var(--card-bg);
    padding:20px;
    border-radius:14px;
    border:1px solid rgba(15,43,43,0.04);
    box-shadow:0 6px 22px rgba(2,8,8,0.03);
  }

  label{
    font-weight:700;
    color:var(--cora-dark);
    font-size:0.88rem;
    display:block;
    margin-bottom:6px;
  }
  input[type="text"],
  input[type="time"],
  input[type="date"],
  input[type="number"],
  select,
  textarea{
    width:100%;
    padding:11px 14px;
    border-radius:10px;
    border:1px solid #e0e0e0;
    font-size:0.95rem;
    background:linear-gradient(180deg,#fff,#fffdf9);
    transition: border 0.2s, box-shadow 0.2s;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.02);
  }
  input:focus,
  textarea:focus{
    outline:none;
    border-color:var(--cora-orange);
    box-shadow: 0 0 0 3px rgba(255,123,0,0.15);
  }
  textarea{min-height:100px; resize:vertical;}

  .section{margin-top:22px}
  .section h3{
    margin:0 0 12px 0;
    font-size:1.1rem;
    color:var(--cora-dark);
    font-weight:700;
    padding-bottom:6px;
    border-bottom:1px solid rgba(15,43,43,0.06);
  }
  .section .tools{
    display:flex;
    gap:10px;
    margin-bottom:12px;
    flex-wrap:wrap;
    justify-content: flex-end; /* Botones a la derecha */
  }

  .table-section{
    width:100%;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #eee;
    box-shadow:0 2px 6px rgba(0,0,0,0.02);
  }
  table{
    width:100%;
    border-collapse:collapse;
    min-width:640px;
  }
  th, td{
    padding:10px 12px;
    border-bottom:1px solid #f2f2f2;
    text-align:left;
  }
  thead th{
    background:linear-gradient(90deg,var(--cora-orange),#ff9a4a);
    color:white;
    font-weight:700;
    font-size:0.9rem;
  }
  .small{width:140px}
  .center{text-align:center}

 .actions{
  margin-top:20px;
  display:flex; 
  justify-content:center; 
  gap:14px; 
  flex-wrap:wrap; 
  padding-top:16px; 
  border-top:1px solid #f0f0f0;
}

  footer{
    margin-top:20px;
    text-align:center;
    color:var(--muted);
    font-size:0.9rem;
  }

  @media(max-width:900px){
    .grid{grid-template-columns:repeat(6,1fr)}
    .card{grid-column:span 6}
    .header{flex-direction:column; align-items:stretch;}
    .header-actions{justify-content:center;}
  }
  @media(max-width:640px){
    .grid{grid-template-columns:1fr}
    .card{grid-column:1}
    .logo{width:64px;height:64px}
    .title-col h1{font-size:1.05rem}
    .wizard{flex-wrap:wrap; gap:8px;}
    .progress{order:100; width:100%; margin:8px 0 0 0;}
  }
</style>
</head>
<body>

<div class="container" role="main">
  <div class="header">
    <div class="brand">
      <div class="logo" aria-hidden="true"><img src="img/logo-coraqua.png" alt="Logo CORAQUA"></div>
      <div class="title-col">
        <h1>SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES</h1>
        <div class="meta"><strong>CÓDIGO:</strong> CORAQUA MPA-01 &nbsp;|&nbsp; <strong>VERSIÓN:</strong> 2.0</div>
      </div>
    </div>

    <div class="header-actions" role="group" aria-label="Acciones principales">
      <button class="btn ghost" id="volverBtn">◀️ Volver atrás</button>
        <button class="btn" id="verListaBtn">📄 Ver Lista</button>
    </div>
  </div>

  <div class="grid" role="form">
    <div class="card" id="mainCard">
      <div style="display:flex; gap:14px; flex-wrap:wrap; align-items:end;">
        <div style="flex:1; min-width:160px">
          <label for="fecha">FECHA</label>
          <input id="fecha" type="date" />
        </div>
        <div style="flex:2; min-width:200px">
          <label for="responsable">RESPONSABLE</label>
          <input id="responsable" type="text" placeholder="Nombre del responsable" />
        </div>
        <div style="flex:1; min-width:140px">
          <label for="horaInicio">HORA INICIO</label>
          <input id="horaInicio" type="time" />
        </div>
        <div style="flex:1; min-width:140px">
          <label for="horaFinal">HORA FINAL</label>
          <input id="horaFinal" type="time" />
        </div>
      </div>

      <div class="section" id="secAptos">
        <h3>REPRODUCTORES APTOS PARA DESOVE</h3>
        <div class="tools">
          <button class="btn secondary" type="button" onclick="addRow('aptos')">➕ Agregar fila</button>
          <button class="btn ghost" type="button" onclick="removeRow('aptos')">➖ Quitar fila</button>
        </div>
        <div class="table-section">
          <table id="tableAptos">
            <thead><tr><th class="small center">ITEM</th><th>DESCRIPCIÓN</th><th class="small center">CANTIDAD</th><th>OBSERVACIÓN</th></tr></thead>
            <tbody>
              <tr>
                <td class="center">1</td>
                <td>CANTIDAD DE REPRODUCTORES HEMBRAS APTAS PARA DESOVE</td>
                <td class="center"><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td>
                <td><input type="text" placeholder="Observación" /></td>
              </tr>
              <tr>
                <td class="center">2</td>
                <td>CANTIDAD DE REPRODUCTORES MACHOS APTOS PARA DESOVE</td>
                <td class="center"><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td>
                <td><input type="text" placeholder="Observación" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="section" id="secDesovados">
        <h3>DESOVADOS Y RELACIÓN</h3>
        <div class="tools">
          <button class="btn secondary" type="button" onclick="addRow('desovados')">➕ Agregar fila</button>
          <button class="btn ghost" type="button" onclick="removeRow('desovados')">➖ Quitar fila</button>
        </div>
        <div class="table-section">
          <table id="tableDesovados">
            <thead><tr><th class="small center">ITEM</th><th>DESCRIPCIÓN</th><th class="small center">CANTIDAD</th><th>OBSERVACIÓN</th></tr></thead>
            <tbody>
              <tr>
                <td class="center">1</td>
                <td>CANTIDAD DE REPRODUCTORES HEMBRAS DESOVADAS</td>
                <td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td>
                <td><input type="text" placeholder="Observación (ej: calidad de ovulación)" /></td>
              </tr>
              <tr>
                <td class="center">2</td>
                <td>CANTIDAD DE REPRODUCTORES MACHOS DESOVADOS</td>
                <td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td>
                <td><input type="text" placeholder="Observación" /></td>
              </tr>
              <tr>
                <td class="center">3</td>
                <td>ESTIMACIÓN DE RELACIÓN Nº HEMBRAS / Nº MACHOS</td>
                <td class="center"><input type="text" placeholder="Ej: 1:2" /></td>
                <td><input type="text" placeholder="Observación" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ✅ SECCIÓN VOLUMEN: primera fila con texto fijo -->
      <div class="section" id="secVolumen">
        <h3>VOLUMEN ÓVULOS FERTILIZADOS (LITROS)</h3>
        <div class="tools">
          <button class="btn secondary" type="button" onclick="addRow('volumen')">➕ Agregar fila</button>
          <button class="btn ghost" type="button" onclick="removeRow('volumen')">➖ Quitar fila</button>
        </div>
        <div class="table-section">
          <table id="tableVolumen">
            <thead><tr><th class="small center">ITEM</th><th>DESCRIPCIÓN</th><th class="small center">LITROS</th><th>OBSERVACIÓN</th></tr></thead>
            <tbody>
              <tr>
                <td class="center">1</td>
                <td>VOLUMEN ÓVULOS FERTILIZADOS</td>
                <td class="center"><input type="number" step="0.01" min="0" placeholder="Litros" /></td>
                <td><input type="text" placeholder="Observación" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- ✅ SECCIÓN OVAS: primera fila con texto fijo -->
      <div class="section" id="secOvas">
        <h3>CANTIDAD (NÚMERO DE OVAS FÉRTILES)</h3>
        <div class="tools">
          <button class="btn secondary" type="button" onclick="addRow('ovas')">➕ Agregar fila</button>
          <button class="btn ghost" type="button" onclick="removeRow('ovas')">➖ Quitar fila</button>
        </div>
        <div class="table-section">
          <table id="tableOvasCustom">
            <thead><tr><th class="small center">ITEM</th><th>DESCRIPCIÓN</th><th class="small center">Nº</th><th>OBSERVACIÓN</th></tr></thead>
            <tbody>
              <tr>
                <td class="center">1</td>
                <td>CANTIDAD DE OVAS FÉRTILES</td>
                <td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td>
                <td><input type="text" placeholder="Observación" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="section">
        <h3>OBSERVACIONES GENERALES</h3>
        <textarea id="observaciones" placeholder="Comentarios relevantes sobre la sesión de fertilización"></textarea>
      </div>

      <div class="actions" role="group" aria-label="Acciones del formulario">
        <div style="display:flex; gap:10px; flex-wrap:wrap">
          <button class="btn" id="guardarBtnFooter">💾 Guardar</button>
          <button class="btn secondary" id="limpiarBtnFooter">🧹 Limpiar</button>
        </div>
      </div>

      <footer> CORAQUA © SELECCIÓN Y FERTILIZACIÓN DE OVAS NACIONALES </footer>
    </div>
  </div>

  <form id="formHidden" style="display:none" method="POST" action="/sistema-produccion/public/Ovas/guardarBPA2">
    <input type="hidden" name="fecha" id="hidden_fecha" />
    <input type="hidden" name="responsable" id="hidden_responsable" />
    <input type="hidden" name="horaInicio" id="hidden_horaInicio" />
    <input type="hidden" name="horaFinal" id="hidden_horaFinal" />
  </form>
</div>

<script>
  (function setFechaDefault(){
    const f = document.getElementById('fecha');
    if(f && !f.value){
      f.value = new Date().toISOString().split('T')[0];
    }
  })();

  function addRow(section){
    let table, idx, tr;
    if(section==='aptos'){ table = document.getElementById('tableAptos'); }
    else if(section==='desovados'){ table = document.getElementById('tableDesovados'); }
    else if(section==='volumen'){ table = document.getElementById('tableVolumen'); }
    else if(section==='ovas'){ table = document.getElementById('tableOvasCustom'); }
    else return;

    const tbody = table.tBodies[0];
    idx = tbody.rows.length + 1;
    tr = document.createElement('tr');

    if(section === 'volumen'){
      // Nuevas filas: descripción editable, no texto fijo
      tr.innerHTML = `
        <td class="center">${idx}</td>
        <td><input type="text" placeholder="Descripción del volumen" style="width:100%"/></td>
        <td class="center"><input type="number" step="0.01" min="0" placeholder="Litros" /></td>
        <td><input type="text" placeholder="Observación" /></td>
      `;
    } else if(section === 'ovas'){
      tr.innerHTML = `
        <td class="center">${idx}</td>
        <td><input type="text" placeholder="Descripción de ovas" style="width:100%"/></td>
        <td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td>
        <td><input type="text" placeholder="Observación" /></td>
      `;
    } else {
      tr.innerHTML = `
        <td class="center">${idx}</td>
        <td><input type="text" placeholder="Descripción del item" style="width:100%"/></td>
        <td class="center"><input type="text" placeholder="Valor / Cantidad"/></td>
        <td><input type="text" placeholder="Observación"/></td>
      `;
    }
    tbody.appendChild(tr);
  }

  function removeRow(section){
    let table;
    if(section==='aptos'){ table = document.getElementById('tableAptos'); }
    else if(section==='desovados'){ table = document.getElementById('tableDesovados'); }
    else if(section==='volumen'){ table = document.getElementById('tableVolumen'); }
    else if(section==='ovas'){ table = document.getElementById('tableOvasCustom'); }
    else return;

    const tbody = table.tBodies[0];
    const minRows = (section==='aptos'||section==='desovados')? (section==='aptos'?2:3) : 1;
    if(tbody.rows.length > minRows){
      tbody.deleteRow(-1);
    } else {
      alert('No se pueden eliminar las filas mínimas requeridas.');
    }
  }

  function recogerYEnviar(){
    const fecha = document.getElementById('fecha').value.trim();
    const responsable = document.getElementById('responsable').value.trim();
    const horaInicio = document.getElementById('horaInicio').value.trim();
    const horaFinal = document.getElementById('horaFinal').value.trim();

    if(!fecha || !responsable){
      alert('Por favor complete al menos FECHA y RESPONSABLE antes de guardar.');
      return;
    }

    const form = document.getElementById('formHidden');
    Array.from(form.querySelectorAll('input[name^="sec_"]')).forEach(n=>n.remove());

    document.getElementById('hidden_fecha').value = fecha;
    document.getElementById('hidden_responsable').value = responsable;
    document.getElementById('hidden_horaInicio').value = horaInicio;
    document.getElementById('hidden_horaFinal').value = horaFinal;

    function pushFromTable(tableId, prefix){
      const tbody = document.getElementById(tableId).tBodies[0];
      for(let r=0;r<tbody.rows.length;r++){
        const cols = tbody.rows[r].cells;
        const descIn = cols[1].querySelector('input');
        const desc = descIn ? descIn.value.trim() : cols[1].textContent.trim();
        const valIn = cols[2].querySelector('input');
        const val = valIn ? valIn.value.trim() : cols[2].textContent.trim();
        const obsIn = cols[3].querySelector('input');
        const obs = obsIn ? obsIn.value.trim() : cols[3].textContent.trim();

        const i1=document.createElement('input'); i1.type='hidden'; i1.name=`sec_${prefix}_desc[]`; i1.value=desc; form.appendChild(i1);
        const i2=document.createElement('input'); i2.type='hidden'; i2.name=`sec_${prefix}_valor[]`; i2.value=val; form.appendChild(i2);
        const i3=document.createElement('input'); i3.type='hidden'; i3.name=`sec_${prefix}_obs[]`; i3.value=obs; form.appendChild(i3);
      }
    }

    pushFromTable('tableAptos','aptos');
    pushFromTable('tableDesovados','desovados');
    pushFromTable('tableVolumen','volumen');
    pushFromTable('tableOvasCustom','ovas');

    const obsEl = document.getElementById('observaciones');
    const oi=document.createElement('input'); oi.type='hidden'; oi.name='observaciones'; oi.value = obsEl ? obsEl.value.trim() : ''; form.appendChild(oi);

    form.submit();
  }

  function limpiarFormulario(){
    if(!confirm('¿Desea limpiar el formulario? Se perderán los datos no guardados.')) return;
    document.getElementById('responsable').value='';
    document.getElementById('horaInicio').value='';
    document.getElementById('horaFinal').value='';
    document.getElementById('fecha').value = new Date().toISOString().split('T')[0];
    document.getElementById('observaciones').value='';

    // Restaurar estado inicial (con texto fijo en primera fila)
    document.getElementById('tableAptos').tBodies[0].innerHTML = `
      <tr><td class="center">1</td><td>CANTIDAD DE REPRODUCTORES HEMBRAS APTAS PARA DESOVE</td><td class="center"><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td><td><input type="text" placeholder="Observación" /></td></tr>
      <tr><td class="center">2</td><td>CANTIDAD DE REPRODUCTORES MACHOS APTOS PARA DESOVE</td><td class="center"><input type="number" step="1" min="0" class="inp" placeholder="Nº" /></td><td><input type="text" placeholder="Observación" /></td></tr>`;

    document.getElementById('tableDesovados').tBodies[0].innerHTML = `
      <tr><td class="center">1</td><td>CANTIDAD DE REPRODUCTORES HEMBRAS DESOVADAS</td><td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td><td><input type="text" placeholder="Observación (ej: calidad de ovulación)" /></td></tr>
      <tr><td class="center">2</td><td>CANTIDAD DE REPRODUCTORES MACHOS DESOVADOS</td><td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td><td><input type="text" placeholder="Observación" /></td></tr>
      <tr><td class="center">3</td><td>ESTIMACIÓN DE RELACIÓN Nº HEMBRAS / Nº MACHOS</td><td class="center"><input type="text" placeholder="Ej: 1:2" /></td><td><input type="text" placeholder="Observación" /></td></tr>`;

    document.getElementById('tableVolumen').tBodies[0].innerHTML = `
      <tr><td class="center">1</td><td>VOLUMEN ÓVULOS FERTILIZADOS</td><td class="center"><input type="number" step="0.01" min="0" placeholder="Litros" /></td><td><input type="text" placeholder="Observación" /></td></tr>`;

    document.getElementById('tableOvasCustom').tBodies[0].innerHTML = `
      <tr><td class="center">1</td><td>CANTIDAD DE OVAS FÉRTILES</td><td class="center"><input type="number" step="1" min="0" placeholder="Nº" /></td><td><input type="text" placeholder="Observación" /></td></tr>`;
  }

  function volverPanel(){
    window.location.href = '/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
  }

  document.getElementById('guardarBtnFooter').addEventListener('click', recogerYEnviar);
  document.getElementById('limpiarBtnFooter').addEventListener('click', limpiarFormulario);
  document.getElementById('volverBtn').addEventListener('click', volverPanel);

  document.addEventListener('keydown', function(e){
    if(e.key === 'F9'){
      addRow('aptos');
    }
  });
  document.getElementById('verListaBtn').addEventListener('click', function(){
  window.location.href = '/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/lista1.php';
});

</script>
</body>
</html>

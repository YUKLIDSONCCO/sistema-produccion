<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>CONTROL DIARIO DE PARÁMETROS — CORAQUA</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<style>
  :root{
    --cora-orange:#ff7b00;
    --cora-dark:#0f2b2b;
    --bg-1: linear-gradient(135deg,#fffaf2 0%, #fff1e0 40%, #f6fbff 100%);
    --card-bg: rgba(255,255,255,0.98);
    --muted:#6b6b6b;
    --accent:#0f5660;
    --soft-shadow: 0 8px 30px rgba(15,43,43,0.06);
  }
  *{box-sizing:border-box}
  body{margin:0; min-height:100vh; font-family:Inter, Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background: var(--bg-1); color:var(--cora-dark); padding:28px;}
  .container{max-width:1300px; margin:20px auto; background:var(--card-bg); border-radius:16px; padding:24px; box-shadow:var(--soft-shadow); border-top:6px solid var(--cora-orange);} 
  .header{display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap}
  .brand{display:flex; align-items:center; gap:14px}
  .logo{width:76px; height:76px; border-radius:12px; background:linear-gradient(180deg,#fff,#fffdf9); display:flex; align-items:center; justify-content:center; box-shadow:0 6px 20px rgba(15,43,43,0.06); border:1px solid rgba(15,43,43,0.04);}
  .logo img{width:70px; height:auto}
  .title-col h1{margin:0; font-size:1.2rem; font-weight:700; line-height:1.3; text-transform:uppercase;}
  .meta{color:var(--muted); font-size:0.92rem; margin-top:4px}
  .btn{background:var(--cora-orange); color:white; border:none; padding:10px 16px; border-radius:10px; cursor:pointer; font-weight:700; box-shadow:0 6px 18px rgba(255,123,0,0.18); transition: all 0.2s ease; display:flex; align-items:center; gap:6px; font-size:0.95rem;}
  .btn:hover{transform:translateY(-2px); box-shadow:0 8px 24px rgba(255,123,0,0.25);}
  .btn.secondary{background:transparent; color:var(--cora-orange); border:2px solid var(--cora-orange);}
  .btn.ghost{background:transparent; color:var(--muted); border:1px solid #ddd;}
  .section{margin-top:24px}
  .section h3{margin:0 0 12px 0; font-size:1.1rem; color:var(--cora-dark); font-weight:700; padding-bottom:6px; border-bottom:1px solid rgba(15,43,43,0.06);}
  .table-section{width:100%; border-radius:12px; overflow-x:auto; border:1px solid #eee; box-shadow:0 2px 6px rgba(0,0,0,0.02);}
  table{width:100%; border-collapse:collapse; min-width:1000px;}
  th, td{padding:8px 10px; border-bottom:1px solid #f2f2f2; text-align:center; font-size:0.9rem;}
  thead th{background:linear-gradient(90deg,var(--cora-orange),#ff9a4a); color:white; font-weight:700; font-size:0.9rem;}
  input[type="text"],input[type="number"]{width:100%; padding:6px 8px; border-radius:8px; border:1px solid #ddd; font-size:0.85rem;}
  .info-row{display:flex; flex-wrap:wrap; gap:12px; margin-top:8px;}
  .info-row div{flex:1; min-width:180px;}
  .actions{margin-top:20px; display:flex; justify-content:center; gap:14px; flex-wrap:wrap; padding-top:16px; border-top:1px solid #f0f0f0;}
  footer{text-align:center; margin-top:20px; color:var(--muted); font-size:0.9rem;}
</style>
</head>
<body>
<div class="container">
  <div class="header">
    <div class="brand">
      <div class="logo"><img src="img/logo-coraqua.png" alt="Logo CORAQUA"></div>
      <div class="title-col">
        <h1> CONTROL DIARIO DE PARÁMETROS</h1>
        <div class="meta"><strong>CÓDIGO:</strong> CORAQUA-BPA 12 &nbsp;|&nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp;|&nbsp; <strong>FECHA:</strong> 03/08/2020</div>
      </div>
    </div>
    <button class="btn ghost" id="volverBtn">◀️ Volver atrás</button>
  </div>

  <div class="section">
    <h3>DATOS GENERALES</h3>
    <div class="info-row">
      <div>
        <label for="mes">MES</label>
        <input type="text" id="mes" placeholder="Ejemplo: Enero">
      </div>
      <div>
        <label for="sede">SEDE</label>
        <input type="text" id="sede" placeholder="Nombre de la sede">
      </div>
      <div>
        <label for="responsable">RESPONSABLE</label>
        <input type="text" id="responsable" placeholder="Nombre del responsable">
      </div>
    </div>
  </div>

  <div class="section">
    <h3>CONTROL DE PARÁMETROS</h3>
    <div class="table-section">
      <table id="tablaParametros">
        <thead>
          <tr>
            <th rowspan="2">DÍA</th>
            <th colspan="4">6:30 a.m.</th>
            <th colspan="4">12:00 m.</th>
            <th colspan="4">3:30 p.m.</th>
            <th rowspan="2">T° ACUM.</th>
            <th rowspan="2">OBS</th>
          </tr>
          <tr>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>%SAT</th><th>PH</th>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>%SAT</th><th>PH</th>
            <th>T° (°C)</th><th>O₂ (mg/L)</th><th>%SAT</th><th>PH</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>

  <div class="actions">
    <button class="btn" id="agregarFilaBtn">➕ Agregar fila</button>
    <button class="btn secondary" id="quitarFilaBtn">➖ Quitar fila</button>
    <button class="btn" id="guardarBtn">💾 Guardar</button>
    <button class="btn secondary" id="limpiarBtn">🧹 Limpiar</button>
  </div>

  <footer>CORAQUA © CONTROL DIARIO DE PARÁMETROS</footer>
</div>

<script>
  const tbody = document.querySelector('#tablaParametros tbody');

  function crearFila(num){
    const fila = document.createElement("tr");
    fila.innerHTML = `
      <td>${num}</td>
      ${Array.from({length:3}).map(()=>`
        <td><input type="number" step="0.01" placeholder="T°"></td>
        <td><input type="number" step="0.01" placeholder="O₂"></td>
        <td><input type="number" step="0.01" placeholder="%SAT"></td>
        <td><input type="number" step="0.01" placeholder="PH"></td>
      `).join('')}
      <td><input type="number" step="0.01" placeholder="T° Acum."></td>
      <td><input type="text" placeholder="Observación"></td>
    `;
    return fila;
  }

  function generarTabla(){
    for(let i=1;i<=30;i++){
      tbody.appendChild(crearFila(i));
    }
  }

  function limpiarFormulario(){
    document.querySelectorAll('input').forEach(el=>el.value='');
  }

  function volverPanel(){
    window.location.href='/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
  }

  function agregarFila(){
    const total = tbody.querySelectorAll("tr").length + 1;
    tbody.appendChild(crearFila(total));
  }

  function quitarFila(){
    const filas = tbody.querySelectorAll("tr");
    if(filas.length>1){
      filas[filas.length-1].remove();
    }
  }

  document.getElementById('volverBtn').addEventListener('click', volverPanel);
  document.getElementById('limpiarBtn').addEventListener('click', limpiarFormulario);
  document.getElementById('agregarFilaBtn').addEventListener('click', agregarFila);
  document.getElementById('quitarFilaBtn').addEventListener('click', quitarFila);

  window.addEventListener('DOMContentLoaded', generarTabla);
  function guardarDatos() {
    const datos = {
        mes: document.getElementById('mes').value,
        sede: document.getElementById('sede').value,
        responsable: document.getElementById('responsable').value,
        id_sede: 1, // Ajusta según tu lógica
        dia: [],
        t_0630: [], o2_0630: [], sat_0630: [], ph_0630: [],
        t_1200: [], o2_1200: [], sat_1200: [], ph_1200: [],
        t_1530: [], o2_1530: [], sat_1530: [], ph_1530: [],
        t_acumulada: [], observacion: []
    };

    // Recoger datos de todas las filas
    const filas = tbody.querySelectorAll('tr');
    filas.forEach(fila => {
        const inputs = fila.querySelectorAll('input');
        datos.dia.push(parseInt(fila.cells[0].textContent));
        
        // 6:30 a.m.
        datos.t_0630.push(inputs[0].value || null);
        datos.o2_0630.push(inputs[1].value || null);
        datos.sat_0630.push(inputs[2].value || null);
        datos.ph_0630.push(inputs[3].value || null);
        
        // 12:00 m.
        datos.t_1200.push(inputs[4].value || null);
        datos.o2_1200.push(inputs[5].value || null);
        datos.sat_1200.push(inputs[6].value || null);
        datos.ph_1200.push(inputs[7].value || null);
        
        // 3:30 p.m.
        datos.t_1530.push(inputs[8].value || null);
        datos.o2_1530.push(inputs[9].value || null);
        datos.sat_1530.push(inputs[10].value || null);
        datos.ph_1530.push(inputs[11].value || null);
        
        // T° Acum. y Observación
        datos.t_acumulada.push(inputs[12].value || null);
        datos.observacion.push(inputs[13].value || '');
    });

    // ✅ CORREGIR ESTA URL - apuntar al index.php principal
    fetch('/sistema-produccion/public/index.php?controller=Ovas&action=guardarBPA4', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(datos)
    })
    .then(response => {
        // Verificar si la respuesta es JSON válido
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
            return response.text().then(text => {
                throw new Error(`Respuesta no JSON: ${text.substring(0, 100)}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Opcional: redirigir o limpiar el formulario
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al guardar los datos: ' + error.message);
    });
}

// Actualiza el event listener del botón Guardar
document.getElementById('guardarBtn').addEventListener('click', guardarDatos);
</script>
</body>
</html>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>MORTALIDAD DIARIA - LARVAS — CORAQUA</title>
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
  .container{max-width:1200px; margin:20px auto; background:var(--card-bg); border-radius:16px; padding:24px; box-shadow:var(--soft-shadow); border-top:6px solid var(--cora-orange);} 
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
  table{width:100%; border-collapse:collapse; min-width:900px;}
  th, td{padding:10px 12px; border-bottom:1px solid #f2f2f2; text-align:center;}
  thead th{background:linear-gradient(90deg,var(--cora-orange),#ff9a4a); color:white; font-weight:700; font-size:0.9rem;}
  input[type="text"],input[type="number"],input[type="date"]{width:100%; padding:8px 10px; border-radius:8px; border:1px solid #ddd; font-size:0.9rem;}
  textarea{width:100%; border-radius:10px; border:1px solid #ddd; padding:10px; font-size:0.9rem; min-height:90px;}
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
        <h1> MORTALIDAD DIARIA - LARVAS</h1>
        <div class="meta"><strong>CÓDIGO:</strong> CORAQUA-BPA 5 &nbsp;|&nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp;|&nbsp; <strong>FECHA:</strong> 03/08/2020</div>
      </div>
    </div>
    <button class="btn ghost" id="volverBtn">◀️ Volver atrás</button>
  </div>

  <div class="section">
    <h3>DATOS GENERALES</h3>
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
      <div style="flex:1; min-width:180px">
        <label>ENCARGADO</label>
        <input type="text" id="encargado" placeholder="Nombre del encargado">
      </div>
      <div style="flex:1; min-width:180px">
        <label>LOTE</label>
        <input type="text" id="lote" placeholder="Código de lote">
      </div>
      <div style="flex:1; min-width:180px">
        <label>SEDE</label>
        <input type="text" id="sede" placeholder="Nombre de sede">
      </div>
      <div style="flex:1; min-width:180px">
        <label>CANT. SIEMBRA</label>
        <input type="number" id="cantsiembra" placeholder="Cantidad">
      </div>
    </div>
  </div>

  <div class="section">
    <h3>REGISTRO DIARIO DE MORTALIDAD</h3>
    <div class="table-section">
      <table id="tablaLarvas">
        <thead>
          <tr>
            <th>FECHA</th><th>BAT.</th><th>BATEA</th>
            <th colspan="2">C1</th><th colspan="2">C2</th><th colspan="2">C3</th><th colspan="2">C4</th>
            <th colspan="2">C5</th><th colspan="2">C6</th><th colspan="2">C7</th>
            <th>TOTAL</th><th>OBSERVACIONES</th>
          </tr>
          <tr>
            <th colspan="3"></th>
            <th>L.M.</th><th>L.D.</th>
            <th>L.M.</th><th>L.D.</th>
            <th>L.M.</th><th>L.D.</th>
            <th>L.M.</th><th>L.D.</th>
            <th>L.M.</th><th>L.D.</th>
            <th>L.M.</th><th>L.D.</th>
            <th>L.M.</th><th>L.D.</th>
            <th colspan="2"></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:10px;">
      <button class="btn secondary" type="button" onclick="agregarFila()">➕ Agregar fila</button>
      <button class="btn ghost" type="button" onclick="eliminarFila()">➖ Quitar fila</button>
    </div>
  </div>

  <div class="section">
    <h3>OBSERVACIONES GENERALES</h3>
    <textarea id="observaciones" placeholder="Escriba comentarios u observaciones adicionales"></textarea>
  </div>

  <div class="actions">
    <button class="btn" id="guardarBtn">💾 Guardar</button>
    <button class="btn secondary" id="limpiarBtn">🧹 Limpiar</button>
  </div>

  <footer>CORAQUA © MORTALIDAD DIARIA DE LARVAS</footer>
</div>

<script>
  function crearFila() {
    const fila = document.createElement("tr");
    fila.innerHTML = `
      <td><input type="date"></td>
      <td><input type="text" placeholder="Bat."></td>
      <td><input type="text" placeholder="Batea"></td>
      ${Array.from({length: 7}).map(()=>`
        <td><input type="number" placeholder="L.M."></td>
        <td><input type="number" placeholder="L.D."></td>
      `).join('')}
      <td><input type="number" placeholder="Total"></td>
      <td><input type="text" placeholder="Observación"></td>
    `;
    return fila;
  }

  function agregarFila(){
    const tabla = document.querySelector('#tablaLarvas tbody');
    tabla.appendChild(crearFila());
  }

  function eliminarFila(){
    const tabla = document.querySelector('#tablaLarvas tbody');
    if(tabla.rows.length>1) tabla.deleteRow(-1);
    else alert('Debe quedar al menos una fila.');
  }

  function limpiarFormulario(){
    document.querySelectorAll('input, textarea').forEach(el=>el.value='');
  }

  function volverPanel(){
    window.location.href='/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
  }

  document.getElementById('volverBtn').addEventListener('click', volverPanel);
  document.getElementById('limpiarBtn').addEventListener('click', limpiarFormulario);

  // Crear 5 filas por defecto
  window.addEventListener('DOMContentLoaded', ()=>{
    const tbody = document.querySelector('#tablaLarvas tbody');
    for(let i=0;i<5;i++) tbody.appendChild(crearFila());
  });
</script>
</body>
</html>

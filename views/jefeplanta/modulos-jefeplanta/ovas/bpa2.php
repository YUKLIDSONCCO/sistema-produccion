<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>MORTALIDAD DIARIA - OVAS — CORAQUA</title>
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
  table{width:100%; border-collapse:collapse; min-width:800px;}
  th, td{padding:10px 12px; border-bottom:1px solid #f2f2f2; text-align:center;}
  thead th{background:linear-gradient(90deg,var(--cora-orange),#ff9a4a); color:white; font-weight:700; font-size:0.9rem;}
  input[type="text"],input[type="number"],input[type="date"]{width:100%; padding:8px 10px; border-radius:8px; border:1px solid #ddd; font-size:0.9rem;}
  textarea{width:100%; border-radius:10px; border:1px solid #ddd; padding:10px; font-size:0.9rem; min-height:90px;}
  .actions{margin-top:20px; display:flex; justify-content:center; gap:14px; flex-wrap:wrap; padding-top:16px; border-top:1px solid #f0f0f0;}
  footer{text-align:center; margin-top:20px; color:var(--muted); font-size:0.9rem;}
</style>
</head>
<body>
  <form id="formBPA2" method="POST" action="/sistema-produccion/public/index.php?controller=Ovas&action=guardarBPA2">


<div class="container">
  <div class="header">
    <div class="brand">
      <div class="logo"><img src="img/logo-coraqua.png" alt="Logo CORAQUA"></div>
      <div class="title-col">
        <h1>MORTALIDAD DIARIA - OVAS</h1>
        <div class="meta"><strong>CÓDIGO:</strong> CORAQUA-BPA 4 &nbsp;|&nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp;|&nbsp; <strong>FECHA:</strong> 03/08/2020</div>
      </div>
    </div>
    <button class="btn ghost" id="volverBtn" type="button">◀️ Volver atrás</button>
  </div>

  <div class="section">
    <h3>DATOS GENERALES</h3>
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
      <div style="flex:1; min-width:180px">
        <label for="encargado">ENCARGADO</label>
        <input type="text" id="encargado" name="encargado" placeholder="Nombre del encargado" required>
      </div>
      <div style="flex:1; min-width:180px">
        <label for="lote">LOTE</label>
        <input type="text" id="lote" name="lote" placeholder="Código de lote" required>
      </div>
      <div style="flex:1; min-width:180px">
        <label for="sede">SEDE</label>
        <input type="text" id="sede" name="sede" placeholder="Nombre de sede" required>
      </div>
      <div style="flex:1; min-width:180px">
        <label for="cantidad_siembra">CANT. SIEMBRA</label>
        <input type="number" id="cantidad_siembra" name="cantidad_siembra" placeholder="Cantidad" required>
      </div>
    </div>
  </div>

  <div class="section">
    <h3>REGISTRO DIARIO DE MORTALIDAD</h3>
    <div class="table-section">
      <table id="tablaMortalidad">
        <thead>
          <tr>
            <th>FECHA</th><th>BAT.</th><th>BATEA</th>
            <th>C1</th><th>C2</th><th>C3</th><th>C4</th><th>C5</th><th>C6</th><th>C7</th>
            <th>TOTAL</th><th>OBSERVACIÓN</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="date" name="fecha_control[]"></td>
            <td><input type="text" name="bateria[]"></td>
            <td><input type="text" name="batea[]"></td>
            <td><input type="number" name="c1[]"></td>
            <td><input type="number" name="c2[]"></td>
            <td><input type="number" name="c3[]"></td>
            <td><input type="number" name="c4[]"></td>
            <td><input type="number" name="c5[]"></td>
            <td><input type="number" name="c6[]"></td>
            <td><input type="number" name="c7[]"></td>
            <td><input type="number" name="total[]"></td>
            <td><input type="text" name="observacion[]"></td>
          </tr>
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
    <textarea id="observaciones" name="observaciones" placeholder="Escriba comentarios u observaciones adicionales"></textarea>
  </div>

  <div class="actions">
    <button class="btn" type="submit">💾 Guardar</button>
    <button class="btn secondary" type="reset">🧹 Limpiar</button>
  </div>

  <footer>CORAQUA © MORTALIDAD DIARIA DE OVAS</footer>
</div>
<script>
document.getElementById('formBPA2').addEventListener('submit', async function(e) {
    e.preventDefault(); // evita redirección

    const form = e.target;
    const data = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: data
        });

        // Si el servidor responde 200 (éxito)
        if (response.ok) {
            alert('✅ Registros guardados correctamente.');
            // refresca los datos de la tabla en la misma vista sin ir a otra página
            location.reload();
        } else {
            alert('⚠️ Error al guardar los registros.');
        }
    } catch (error) {
        console.error(error);
        alert('❌ Error de conexión con el servidor.');
    }
});
</script>
<script>
  document.addEventListener('DOMContentLoaded', ()=>{
    for(let i=1; i<5; i++){
      agregarFila();
    }

    const form = document.getElementById('formBPA2');
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const formData = new FormData(form);

      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(res => {
        if(!res.ok) throw new Error('Código: ' + res.status);
        return res.text();
      })
      .then(resp => {
        alert('✅ Guardado exitoso');
      })
      .catch(err => {
        alert('⚠️ Error al guardar. ' + err.message);
      });
    });
  });

  function agregarFila(){
    const tabla = document.querySelector('#tablaMortalidad tbody');
    const fila = tabla.rows[0].cloneNode(true);
    fila.querySelectorAll('input').forEach(i=>i.value='');
    tabla.appendChild(fila);
  }

  function eliminarFila(){
    const tabla = document.querySelector('#tablaMortalidad tbody');
    if(tabla.rows.length>1) tabla.deleteRow(-1);
    else alert('Debe quedar al menos una fila.');
  }

  function volverPanel(){
    window.location.href='/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
  }

  document.getElementById('volverBtn').addEventListener('click', volverPanel);
</script>
</form>
</body>
</html>

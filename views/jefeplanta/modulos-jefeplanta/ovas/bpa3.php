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
  <form id="formOvas" method="POST">

  <div class="header">
    <div class="brand">
      <div class="logo"><img src="img/logo-coraqua.png" alt="Logo CORAQUA"></div>
      <div class="title-col">
        <h1> MORTALIDAD DIARIA - LARVAS</h1>
        <div class="meta"><strong>CÓDIGO:</strong> CORAQUA-BPA 5 &nbsp;|&nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp;|&nbsp; <strong>FECHA:</strong> 03/08/2020</div>
      </div>
    </div>
    <button class="btn ghost" id="volverBtn" type="button">◀️ Volver atrás</button>
  </div>

  <div class="section">
    <h3>DATOS GENERALES</h3>
    <div style="display:flex; flex-wrap:wrap; gap:12px;">
      <div style="flex:1; min-width:180px">
        <label>ENCARGADO</label>
        <input type="text" id="encargado" name="encargado" placeholder="Nombre del encargado" required>
      </div>
      <div style="flex:1; min-width:180px">
        <label>LOTE</label>
        <input type="text" id="lote" name="lote" placeholder="Código de lote" required>
      </div>
      <div style="flex:1; min-width:180px">
        <label>SEDE</label>
        <input type="text" id="sede" name="sede" placeholder="Nombre de sede" required>
      </div>
      <div style="flex:1; min-width:180px">
        <label>CANT. SIEMBRA</label>
        <input type="number" id="cantsiembra" name="cantidad_siembra" placeholder="Cantidad" required>
      </div>
      <!-- Campos adicionales requeridos -->
      <input type="hidden" name="id_lote" value="1">
      <input type="hidden" name="id_sede" value="1">
      <input type="hidden" name="id_especie" value="1">
    </div>
  </div>

  <div class="section">
    <h3>REGISTRO DIARIO DE MORTALIDAD</h3>
    <div class="table-section">
      <table id="tablaLarvas">
        <thead>
          <tr>
            <th>FECHA CONTROL</th><th>BATERIA</th><th>BATEA</th>
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
          <!-- Las filas se agregarán aquí dinámicamente -->
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
    <textarea id="observaciones" name="observacion" placeholder="Escriba comentarios u observaciones adicionales"></textarea>
  </div>

  <!-- CAMPOS OCULTOS CORREGIDOS - FUERA DEL FORMULARIO PRINCIPAL -->
  <input type="hidden" name="responsable_area" value="Responsable Area">
  <input type="hidden" name="jefe_planta" value="Jefe Planta">
  <input type="hidden" name="jefe_produccion" value="Jefe Produccion">

  <div class="actions">
    <button id="btnGuardar" class="btn btn-success" type="submit">💾 Guardar Datos</button>
    <button class="btn secondary" id="limpiarBtn" type="button">🧹 Limpiar</button>
  </div>

  <footer>CORAQUA © MORTALIDAD DIARIA DE LARVAS</footer>
  </form>
</div>
<script>
// Agregar una fila inicial al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    agregarFila();
});

function agregarFila() {
    const tbody = document.querySelector("#tablaLarvas tbody");
    const fila = document.createElement("tr");
    const fechaHoy = new Date().toISOString().split('T')[0];
    
    fila.innerHTML = `
        <td><input type="date" name="fecha_control" value="${fechaHoy}" required></td>
        <td><input type="text" name="bateria" placeholder="Batería"></td>
        <td><input type="text" name="batea" placeholder="Batea"></td>
        <td><input type="number" name="c1_lm" value="0" min="0"></td>
        <td><input type="number" name="c1_ld" value="0" min="0"></td>
        <td><input type="number" name="c2_lm" value="0" min="0"></td>
        <td><input type="number" name="c2_ld" value="0" min="0"></td>
        <td><input type="number" name="c3_lm" value="0" min="0"></td>
        <td><input type="number" name="c3_ld" value="0" min="0"></td>
        <td><input type="number" name="c4_lm" value="0" min="0"></td>
        <td><input type="number" name="c4_ld" value="0" min="0"></td>
        <td><input type="number" name="c5_lm" value="0" min="0"></td>
        <td><input type="number" name="c5_ld" value="0" min="0"></td>
        <td><input type="number" name="c6_lm" value="0" min="0"></td>
        <td><input type="number" name="c6_ld" value="0" min="0"></td>
        <td><input type="number" name="c7_lm" value="0" min="0"></td>
        <td><input type="number" name="c7_ld" value="0" min="0"></td>
        <td><input type="number" name="total" value="0" min="0"></td>
        <td><input type="text" name="observacion" placeholder="Observaciones"></td>
    `;
    tbody.appendChild(fila);
}

function eliminarFila() {
    const tbody = document.querySelector("#tablaLarvas tbody");
    if (tbody.rows.length > 0) {
        tbody.deleteRow(-1);
    }
}

// Manejar el envío del formulario
document.getElementById('formOvas').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btnGuardar = document.getElementById('btnGuardar');
    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Guardando...';
    
    try {
        // Crear FormData manualmente para mejor control
        const formData = new FormData();
        
        // Agregar datos generales manualmente
        formData.append('encargado', document.getElementById('encargado').value);
        formData.append('lote', document.getElementById('lote').value);
        formData.append('sede', document.getElementById('sede').value);
        formData.append('cantidad_siembra', document.getElementById('cantsiembra').value);
        formData.append('id_lote', '1');
        formData.append('id_sede', '1');
        formData.append('id_especie', '1');
        formData.append('responsable_area', 'Responsable Area');
        formData.append('jefe_planta', 'Jefe Planta');
        formData.append('jefe_produccion', 'Jefe Produccion');
        formData.append('observacion', document.getElementById('observaciones').value);
        formData.append('codigo_formato', 'CORAQUA-BPA3');
        formData.append('version', '2.0');
        
        // Obtener datos de la tabla
        const filas = document.querySelectorAll('#tablaLarvas tbody tr');
        console.log('Número de filas encontradas:', filas.length);
        
        if (filas.length === 0) {
            alert('Debe agregar al menos una fila de datos');
            btnGuardar.disabled = false;
            btnGuardar.textContent = '💾 Guardar Datos';
            return;
        }
        
        // Crear arrays para cada campo
        const fecha_control = [];
        const bateria = [];
        const batea = [];
        const c1_lm = [];
        const c1_ld = [];
        const c2_lm = [];
        const c2_ld = [];
        const c3_lm = [];
        const c3_ld = [];
        const c4_lm = [];
        const c4_ld = [];
        const c5_lm = [];
        const c5_ld = [];
        const c6_lm = [];
        const c6_ld = [];
        const c7_lm = [];
        const c7_ld = [];
        const total = [];
        const observacion = [];
        
        // Recopilar datos de cada fila
        filas.forEach((fila, index) => {
            const inputs = fila.querySelectorAll('input');
            console.log(`Procesando fila ${index} con ${inputs.length} inputs`);
            
            fecha_control.push(inputs[0].value || '');
            bateria.push(inputs[1].value || '');
            batea.push(inputs[2].value || '');
            c1_lm.push(inputs[3].value || '0');
            c1_ld.push(inputs[4].value || '0');
            c2_lm.push(inputs[5].value || '0');
            c2_ld.push(inputs[6].value || '0');
            c3_lm.push(inputs[7].value || '0');
            c3_ld.push(inputs[8].value || '0');
            c4_lm.push(inputs[9].value || '0');
            c4_ld.push(inputs[10].value || '0');
            c5_lm.push(inputs[11].value || '0');
            c5_ld.push(inputs[12].value || '0');
            c6_lm.push(inputs[13].value || '0');
            c6_ld.push(inputs[14].value || '0');
            c7_lm.push(inputs[15].value || '0');
            c7_ld.push(inputs[16].value || '0');
            total.push(inputs[17].value || '0');
            observacion.push(inputs[18].value || '');
        });
        
        // Agregar los arrays al FormData con la sintaxis correcta para PHP
        fecha_control.forEach((valor, index) => {
            formData.append(`fecha_control[${index}]`, valor);
        });
        bateria.forEach((valor, index) => {
            formData.append(`bateria[${index}]`, valor);
        });
        batea.forEach((valor, index) => {
            formData.append(`batea[${index}]`, valor);
        });
        c1_lm.forEach((valor, index) => {
            formData.append(`c1_lm[${index}]`, valor);
        });
        c1_ld.forEach((valor, index) => {
            formData.append(`c1_ld[${index}]`, valor);
        });
        c2_lm.forEach((valor, index) => {
            formData.append(`c2_lm[${index}]`, valor);
        });
        c2_ld.forEach((valor, index) => {
            formData.append(`c2_ld[${index}]`, valor);
        });
        c3_lm.forEach((valor, index) => {
            formData.append(`c3_lm[${index}]`, valor);
        });
        c3_ld.forEach((valor, index) => {
            formData.append(`c3_ld[${index}]`, valor);
        });
        c4_lm.forEach((valor, index) => {
            formData.append(`c4_lm[${index}]`, valor);
        });
        c4_ld.forEach((valor, index) => {
            formData.append(`c4_ld[${index}]`, valor);
        });
        c5_lm.forEach((valor, index) => {
            formData.append(`c5_lm[${index}]`, valor);
        });
        c5_ld.forEach((valor, index) => {
            formData.append(`c5_ld[${index}]`, valor);
        });
        c6_lm.forEach((valor, index) => {
            formData.append(`c6_lm[${index}]`, valor);
        });
        c6_ld.forEach((valor, index) => {
            formData.append(`c6_ld[${index}]`, valor);
        });
        c7_lm.forEach((valor, index) => {
            formData.append(`c7_lm[${index}]`, valor);
        });
        c7_ld.forEach((valor, index) => {
            formData.append(`c7_ld[${index}]`, valor);
        });
        total.forEach((valor, index) => {
            formData.append(`total[${index}]`, valor);
        });
        observacion.forEach((valor, index) => {
            formData.append(`observacion[${index}]`, valor);
        });
        
        console.log('Arrays creados:');
        console.log('fecha_control:', fecha_control);
        console.log('bateria:', bateria);
        console.log('batea:', batea);
        console.log('Enviando datos al servidor...');
        
        // Enviar datos
        const response = await fetch('/sistema-produccion/public/index.php?controller=Ovas&action=procesarBPA3', {
            method: 'POST',
            body: formData
        });
        
        // Verificar si la respuesta es JSON válido
        const responseText = await response.text();
        console.log('Respuesta completa del servidor:', responseText);
        
        let data;
        
        try {
            data = JSON.parse(responseText);
        } catch (parseError) {
            console.error('Error parseando JSON:', parseError);
            console.error('Respuesta del servidor (texto):', responseText);
            throw new Error('El servidor respondió con un formato inválido. Verifica los logs del servidor.');
        }
        
        if (data.success) {
            alert('✅ ' + data.message);
            // Limpiar formulario después de guardar exitosamente
            document.getElementById('formOvas').reset();
            const tbody = document.querySelector("#tablaLarvas tbody");
            tbody.innerHTML = '';
            agregarFila(); // Agregar fila vacía inicial
        } else {
            alert('❌ Error: ' + (data.error || 'No se pudo guardar los datos'));
        }
    } catch (error) {
        console.error('Error en el envío:', error);
        alert('❌ Error: ' + error.message);
    } finally {
        btnGuardar.disabled = false;
        btnGuardar.textContent = '💾 Guardar Datos';
    }
});

// Botón limpiar
document.getElementById('limpiarBtn').addEventListener('click', function() {
    if (confirm('¿Está seguro de que desea limpiar todos los datos?')) {
        document.getElementById('formOvas').reset();
        const tbody = document.querySelector("#tablaLarvas tbody");
        tbody.innerHTML = '';
        agregarFila(); // Agregar una fila vacía
    }
});

// Botón volver
document.getElementById('volverBtn').addEventListener('click', function() {
    window.history.back();
});
</script>
</body>
</html>
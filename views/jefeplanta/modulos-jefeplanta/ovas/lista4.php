<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Listado de Mortalidad Diaria — CORAQUA</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --naranja:#ff7b00;
  --verde:#3bb273;
  --verde-claro:#d9f6e6;
  --texto:#0f2b2b;
  --gris:#777;
  --bg:linear-gradient(135deg,#fffaf2 0%, #fff7ec 40%, #f6fbff 100%);
}
body{
  font-family:'Inter',sans-serif;
  margin:0; padding:28px;
  background:var(--bg); color:var(--texto);
}
.container{
  max-width:1200px; margin:0 auto;
  background:#fff; border-radius:16px;
  box-shadow:0 8px 30px rgba(0,0,0,0.05);
  padding:24px;
  border-top:6px solid var(--naranja);
}

/* ENCABEZADO */
.header{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;}
.brand{display:flex;align-items:center;gap:14px;}
.brand img{width:70px;height:auto;border-radius:12px;}
.title h1{margin:0;font-size:1.2rem;font-weight:700;}
.meta{color:var(--gris);font-size:0.9rem;}
.btn{
  background:var(--naranja);
  color:#fff;
  border:none;
  padding:10px 16px;
  border-radius:10px;
  cursor:pointer;
  font-weight:700;
  transition:0.2s;
}
.btn:hover{transform:translateY(-2px);}

/* DATOS DEL ENCABEZADO */
.info-panel{
  background:var(--verde-claro);
  border-left:5px solid var(--verde);
  border-radius:10px;
  padding:12px 18px;
  margin-top:16px;
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
  gap:10px;
}
.info-item strong{color:var(--naranja);}

/* WIZARD */
.wizard{
  display:flex;justify-content:center;align-items:center;
  gap:80px; margin:30px 0;
  position:relative;
}
.step{text-align:center;cursor:pointer;}
.circle{
  width:42px;height:42px;
  background:var(--verde);
  color:#fff;
  border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 8px;
  font-weight:700;
  box-shadow:0 0 0 4px var(--verde-claro);
}
.step.active .circle{background:var(--naranja);}
.label{font-size:0.9rem;font-weight:600;color:var(--texto);}
.wizard::before{
  content:"";
  position:absolute;
  top:21px; left:90px; right:90px;
  height:4px;
  background:var(--verde-claro);
  z-index:0;
}

/* CONTENIDO DEL WIZARD */
.wizard-content{
  background:var(--verde-claro);
  padding:18px; border-radius:12px;
  text-align:center; max-width:500px;
  margin:0 auto 20px;
}
.download-btn{
  background:var(--verde);
  color:white;
  border:none;
  padding:8px 14px;
  border-radius:8px;
  font-weight:600;
  margin-top:6px;
  cursor:pointer;
}
.download-btn:hover{opacity:0.9;}

/* BUSCADOR */
.search-bar{
  margin:20px 0;
  display:flex;gap:12px;flex-wrap:wrap;justify-content:flex-end;
}
.search-bar input{
  padding:10px 14px;
  border:1px solid #ddd;
  border-radius:8px;
  font-size:0.9rem;
}
.search-bar button{
  background:var(--naranja);
  color:white;
  border:none;
  border-radius:8px;
  padding:10px 16px;
  font-weight:600;
  cursor:pointer;
}

/* TABLA */
.table-section{
  overflow-x:auto;
  border-radius:12px;
  box-shadow:0 2px 6px rgba(0,0,0,0.05);
}
table{
  width:100%; border-collapse:collapse;
  min-width:800px;
}
th,td{
  padding:10px 12px; border-bottom:1px solid #eee;
}
thead th{
  background:var(--naranja);
  color:#fff;
  text-align:left;
}
tbody tr:nth-child(even){background:#fff9f4;}
td.actions{
  display:flex; gap:6px; justify-content:center;
}
.action-btn{
  border:none;border-radius:8px;padding:6px 10px;
  font-size:0.85rem;font-weight:600;cursor:pointer;
}
.ver{background:#3bb273;color:#fff;}
.editar{background:#ffb020;color:#fff;}
.eliminar{background:#e74c3c;color:#fff;}

/* PAGINACIÓN */
.pagination{
  margin-top:16px;
  display:flex;gap:8px;
  justify-content:center;
}
.pagination button{
  background:#fff;
  border:1px solid var(--naranja);
  color:var(--naranja);
  border-radius:6px;
  padding:6px 10px;
  cursor:pointer;
}
.pagination button.active{
  background:var(--naranja);
  color:white;
}

/* FOOTER */
footer{text-align:center;margin-top:30px;color:var(--gris);font-size:0.9rem;}
</style>
</head>
<body>

<div class="container">
  <div class="header">
    <div class="brand">
      <img src="img/logo-coraqua.png" alt="Logo">
      <div class="title">
        <h1>LISTADO — MORTALIDAD DIARIA DE LARVAS</h1>
        <div class="meta">CORAQUA | Registro de Mortalidad — Formato BPA3</div>
      </div>
    </div>
    <button class="btn" onclick="volver()">⬅ Volver al Panel</button>
  </div>

  <!-- PANEL DE INFORMACIÓN -->
  <div class="info-panel">
    <div class="info-item"><strong>Responsable:</strong> Juan Pérez</div>
    <div class="info-item"><strong>Fecha:</strong> 2025-11-12</div>
    <div class="info-item"><strong>Lote:</strong> L-002</div>
    <div class="info-item"><strong>Sede:</strong> Planta Principal</div>
  </div>

  <!-- WIZARD -->
  <div class="wizard">
    <div class="step active" onclick="mostrar(1)">
      <div class="circle">1</div>
      <div class="label">Semanal</div>
    </div>
    <div class="step" onclick="mostrar(2)">
      <div class="circle">2</div>
      <div class="label">Mensual</div>
    </div>
    <div class="step" onclick="mostrar(3)">
      <div class="circle">3</div>
      <div class="label">Anual</div>
    </div>
  </div>

  <div id="contenido1" class="wizard-content">
    <form method="GET" action="/sistema-produccion/public/index.php" style="display:inline-block;">
      <input type="hidden" name="controller" value="Ovas">
      <input type="hidden" name="action" value="exportBpa4ExcelSemana">
      <label>Semana (tome cualquier fecha de la semana):</label><br>
      <input type="date" name="fecha_semana" required>
      <button type="submit" class="download-btn">Descargar Semana</button>
    </form>
  </div>
  <div id="contenido2" class="wizard-content" style="display:none;">
    <form method="GET" action="/sistema-produccion/public/index.php" style="display:inline-block;">
      <input type="hidden" name="controller" value="Ovas">
      <input type="hidden" name="action" value="exportBpa4ExcelMes">
      <label>Mes:</label><br>
      <input type="month" name="fecha_mes" required>
      <button type="submit" class="download-btn">Descargar Mes</button>
    </form>
  </div>
  <div id="contenido3" class="wizard-content" style="display:none;">
    <form method="GET" action="/sistema-produccion/public/index.php" style="display:inline-block;">
      <input type="hidden" name="controller" value="Ovas">
      <input type="hidden" name="action" value="exportBpa4ExcelAnio">
      <label>Año:</label><br>
      <input type="number" name="fecha_anio" min="2000" max="2100" value="2025" required>
      <button type="submit" class="download-btn">Descargar Año</button>
    </form>
  </div>

  <!-- BUSCADOR -->
  <div class="search-bar">
    <input type="date" placeholder="Buscar por fecha">
    <input type="month" placeholder="Buscar por mes">
    <input type="text" placeholder="Buscar por responsable">
    <button>Buscar</button>
  </div>

  <!-- TABLA -->
  <div class="table-section">
    <table>
      <thead>
        <tr>
          <th>FECHA</th>
          <th>BATALLA</th>
          <th>CANTIDAD TOTAL</th>
          <th>MORTALIDAD (%)</th>
          <th>OBSERVACIONES</th>
          <th>ACCIÓN</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2025-11-10</td>
          <td>Batea 5</td>
          <td>15000</td>
          <td>1.8%</td>
          <td>Condiciones normales</td>
          <td class="actions">
            <button class="action-btn ver">Ver</button>
            <button class="action-btn editar">Editar</button>
            <button class="action-btn eliminar">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>2025-11-11</td>
          <td>Batea 8</td>
          <td>14600</td>
          <td>2.3%</td>
          <td>Ligero aumento por cambio de temperatura</td>
          <td class="actions">
            <button class="action-btn ver">Ver</button>
            <button class="action-btn editar">Editar</button>
            <button class="action-btn eliminar">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- PAGINACIÓN -->
  <div class="pagination">
    <button class="active">1</button>
    <button>2</button>
    <button>3</button>
  </div>

  <footer>CORAQUA © Listado de Mortalidad Diaria de Larvas (BPA3)</footer>
</div>

<script>
function mostrar(num){
  document.querySelectorAll('.wizard-content').forEach(c=>c.style.display='none');
  document.getElementById('contenido'+num).style.display='block';
  document.querySelectorAll('.step').forEach(s=>s.classList.remove('active'));
  document.querySelectorAll('.step')[num-1].classList.add('active');
}
function volver(){
  window.location.href='/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
}
</script>

</body>
</html>

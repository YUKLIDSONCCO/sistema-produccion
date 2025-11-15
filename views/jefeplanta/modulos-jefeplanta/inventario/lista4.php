<?php
// views/jefeplanta/modulos-jefeplanta/inventario/lista4.php
$fechaBusqueda = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Listado Diario — Control de Dosificación</title>
<style>
  *{box-sizing:border-box;font-family:"Poppins","Segoe UI",sans-serif;}
  body{
    margin:0;
    background:linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color:#333;
    padding:40px 20px;
    min-height:100vh;
  }
  .container{
    max-width:1150px;
    margin:auto;
    background:#fff;
    border-radius:18px;
    padding:40px 42px;
    box-shadow:0 10px 28px rgba(0,0,0,0.15);
    border-top:8px solid #ff7b00;
    animation:fadeIn .6s ease;
  }
  @keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
  h1{text-align:center;color:#ff7b00;font-size:1.8rem;margin-bottom:25px;}

  /* Panel de descarga */
  .wizard-panel{
    background:#fff6eb;
    border:2px dashed #ffa94d;
    padding:40px;
    border-radius:16px;
    text-align:center;
    margin-bottom:30px;
  }

  .wizard{
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:relative;
    margin-bottom:35px;
  }
  .wizard::before{
    content:"";
    position:absolute;
    top:50%;
    left:10%;
    right:10%;
    height:4px;
    background:#ffc180;
    z-index:0;
  }
  .step{
    text-align:center;
    position:relative;
    z-index:1;
    cursor:pointer;
    flex:1;
  }
  .circle{
    width:50px;
    height:50px;
    line-height:50px;
    border-radius:50%;
    background:#ffb366;
    color:#fff;
    font-weight:700;
    margin:auto;
    font-size:1.2rem;
    border:3px solid #ff7b00;
    transition:all .2s ease;
  }
  .step.active .circle{
    background:#ff7b00;
    color:#fff;
    transform:scale(1.1);
  }
  .label{
    margin-top:6px;
    font-weight:600;
    font-size:0.9rem;
    color:#ff7b00;
  }

  .wizard-content{display:none;}
  .wizard-content.active{display:block;}

  .download-btn{
    background:#ff7b00;
    color:#fff;
    border:none;
    padding:12px 20px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:all .2s;
    margin-top:10px;
    font-size:1rem;
  }
  .download-btn:hover{background:#e66e00;transform:translateY(-2px);}

  /* Buscador */
  .search-bar{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:12px;
    margin-bottom:25px;
    flex-wrap:wrap;
  }
  label{
    font-weight:600;
    color:#444;
    font-size:1rem;
  }
  input[type="date"]{
    padding:10px 14px;
    border-radius:10px;
    border:2px solid #ffb366;
    font-size:1rem;
    background:#fffaf2;
    color:#333;
    transition:all .3s;
  }
  input[type="date"]:focus{
    outline:none;
    border-color:#ff7b00;
    box-shadow:0 0 6px #ffb366;
  }
  button{
    background:#ff7b00;
    color:#fff;
    border:none;
    padding:10px 18px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:all .2s;
  }
  button:hover{background:#e66e00;transform:translateY(-2px);}

  /* Tabla */
  table{width:100%;border-collapse:collapse;margin-top:20px;}
  th,td{border:1px solid #e6e6e6;padding:8px;text-align:center;font-size:0.95rem;}
  th{background:#ff7b00;color:#fff;}
  tr:nth-child(even){background:#fff8f0;}
  .back-btn{margin-top:25px;display:inline-block;text-decoration:none;background:#fff;color:#ff7b00;
    border:2px solid #ff7b00;padding:10px 14px;border-radius:10px;font-weight:700;}
  .back-btn:hover{background:#ff7b00;color:#fff;}
  footer{text-align:center;margin-top:30px;color:#666;font-size:0.9rem;}
</style>
</head>
<body>

<div class="container">
  <h1>📅 Listado Diario — Control de Dosificación</h1>

  <!-- Panel de descarga -->
  <div class="wizard-panel">
    <div class="wizard">
      <div class="step active" onclick="mostrarPaso(1)">
        <div class="circle">1</div>
        <div class="label">Semanal</div>
      </div>
      <div class="step" onclick="mostrarPaso(2)">
        <div class="circle">2</div>
        <div class="label">Mensual</div>
      </div>
      <div class="step" onclick="mostrarPaso(3)">
        <div class="circle">3</div>
        <div class="label">Anual</div>
      </div>
    </div>

    <div id="contenido1" class="wizard-content active">
      <p>📅 Descargar reporte semanal en Excel</p>
      <form method="GET" action="/sistema-produccion/public/index.php" style="display:inline-block;">
        <input type="hidden" name="controller" value="Inventario">
        <input type="hidden" name="action" value="exportBPAExcel">
        <input type="hidden" name="bpa" value="4">
        <label for="fecha_semana_4">Fecha base:</label>
        <input type="date" id="fecha_semana_4" name="fecha_semana" value="<?php echo date('Y-m-d'); ?>" required>
        <button class="download-btn" type="submit">Descargar Excel Semanal</button>
      </form>
    </div>
    <div id="contenido2" class="wizard-content">
      <p>🗓️ Descargar reporte mensual en Excel</p>
      <form method="GET" action="/sistema-produccion/public/index.php" style="display:inline-block;">
        <input type="hidden" name="controller" value="Inventario">
        <input type="hidden" name="action" value="exportBPAExcel">
        <input type="hidden" name="bpa" value="4">
        <label for="fecha_mes_4">Mes:</label>
        <input type="month" id="fecha_mes_4" name="fecha_mes" value="<?php echo date('Y-m'); ?>" required>
        <button class="download-btn" type="submit">Descargar Excel Mensual</button>
      </form>
    </div>
    <div id="contenido3" class="wizard-content">
      <p>📊 Descargar reporte anual en Excel</p>
      <form method="GET" action="/sistema-produccion/public/index.php" style="display:inline-block;">
        <input type="hidden" name="controller" value="Inventario">
        <input type="hidden" name="action" value="exportBPAExcel">
        <input type="hidden" name="bpa" value="4">
        <label for="fecha_anio_4">Año:</label>
        <input type="number" id="fecha_anio_4" name="fecha_anio" value="<?php echo date('Y'); ?>" min="2000" max="2100" required>
        <button class="download-btn" type="submit">Descargar Excel Anual</button>
      </form>
    </div>
  </div>

  <!-- Buscador CORREGIDO (evita el error de enrutador) -->
  <form method="GET" class="search-bar" action="/sistema-produccion/public/index.php">
    <input type="hidden" name="controller" value="Inventario">
    <input type="hidden" name="action" value="listarBPA4"> <!-- AJUSTA SI EL NOMBRE ES DISTINTO -->

    <label for="fecha"><strong>Seleccionar fecha:</strong></label>
    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fechaBusqueda); ?>" required>
    <button type="submit">🔍 Buscar</button>
  </form>

  <!-- Tabla de 9 columnas (sin cambios) -->
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>MEDICAMENTO</th>
        <th>DOSIS (gr)</th>
        <th>DIAS TRAT.</th>
        <th>LOTE</th>
        <th>SALA</th>
        <th>RESPONSABLE</th>
        <th>OBS</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($datos)): ?>
        <?php $i=1; foreach ($datos as $row): ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
            <td><?php echo htmlspecialchars($row['medicamento_suplemento']); ?></td>
            <td><?php echo htmlspecialchars($row['dosis_gr']); ?></td>
            <td><?php echo htmlspecialchars($row['dias_tratamiento']); ?></td>
            <td><?php echo htmlspecialchars($row['lote_alevines']); ?></td>
            <td><?php echo htmlspecialchars($row['sala']); ?></td>
            <td><?php echo htmlspecialchars($row['responsable']); ?></td>
            <td><?php echo htmlspecialchars($row['obs']); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="9">❌ No hay registros para esta fecha.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <a href="/sistema-produccion/public/index.php?controller=Inventario&action=dashboard" class="back-btn">⬅️ Volver al Inventario</a>

  <footer>CORAQUA © 2025 — Listado Diario de Control de Dosificación</footer>
</div>

<script>
function mostrarPaso(n){
  document.querySelectorAll('.step').forEach((el,i)=>{
    el.classList.toggle('active', i+1===n);
  });
  document.querySelectorAll('.wizard-content').forEach((el,i)=>{
    el.classList.toggle('active', i+1===n);
  });
}
// No-op removed — forms now submit directly to controller for download
</script>
</body>
</html>
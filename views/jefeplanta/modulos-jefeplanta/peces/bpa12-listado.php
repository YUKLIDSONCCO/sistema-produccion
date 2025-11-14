<?php
// Evitar errores si $registros no está definido
if (!isset($registros)) {
  $registros = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado Control de Parámetros - CORAQUA PERÚ</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_peces.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body>

<main id="main" class="main">
  <section class="section-listado">
    <div class="container">

      <!-- ========== BLOQUE 1: ENCABEZADO ========== -->
      <div class="bloque-separado encabezado shadow-sm">
        <div class="titulo">
          <h2>🌡️ LISTADO DE CONTROL DE PARÁMETROS - BPA12</h2>
          <p>Sistema de Producción - CORAQUA PERÚ</p>
        </div>
        <div class="acciones-superior">
          <a href="index.php?controller=Peces&action=bpa12" class="btn-principal">
            ➕ Nuevo Registro
          </a>
          <a href="index.php?controller=JefePlanta&action=moduloPeces" class="btn-secundario">
            ⬅️ Volver al Panel
          </a>
        </div>
        <div style="flex:1; min-width:180px">
            <label for="Formularios">Formularios</label>
            <select id="Formularios" onchange="redirigirFormulario()">
              <option value="" disabled selected>Seleccione Formularios</option>
              <option value="dashboard">Panel</option>
              <option value="bpa6-listado">BPA-6-listado</option>
              <option value="bpa7-listado">BPA-7-listado</option>
              <option value="bpa10-listado">BPA-10-listado</option>
              <option value="bpa12-listado">BPA-12-lista</option>
            </select>
          </div>
      </div>

      <!-- ========== BLOQUE 2: PANEL WIZARD DE REPORTES ========== -->
      <div class="bloque-separado wizard-panel">
        <h3>📊 Generar Reportes de Control de Parámetros</h3>
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

        <!-- PASO 1 -->
        <div id="contenido1" class="wizard-content active">
          <p>📅 Selecciona una fecha para generar el <strong>reporte semanal</strong>:</p>
          <form method="GET" action="index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="exportBpa12ExcelSemana">
            <input type="date" name="fecha_semana" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Semanal</button>
          </form>
        </div>

        <!-- PASO 2 -->
        <div id="contenido2" class="wizard-content">
          <p>🗓️ Selecciona el mes del <strong>reporte mensual</strong>:</p>
          <form method="GET" action="index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="exportBpa12ExcelMes">
            <input type="month" name="fecha_mes" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Mensual</button>
          </form>
        </div>

        <!-- PASO 3 -->
        <div id="contenido3" class="wizard-content">
          <p>📈 Selecciona el año del <strong>reporte anual</strong>:</p>
          <form method="GET" action="index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="exportBpa12ExcelAnio">
            <input type="number" name="fecha_anio" min="2020" max="2100" placeholder="Ejemplo: 2025" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Anual</button>
          </form>
        </div>
      </div>

      <!-- ========== BLOQUE 3: CONTENEDOR PRINCIPAL - TABLA DE REGISTROS ========== -->
      <!-- ========== BLOQUE 3: CONTENEDOR PRINCIPAL - TABLA DE REGISTROS ========== -->
      <div class="bloque-separado card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h4>📋 Registros de Parámetros Ambientales</h4>

          <!-- BUSCADOR POR FECHA (PHP - GET) -->
          <form class="buscador-fecha" method="GET" action="index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="bpa12Listado">
            <label for="fechaBusqueda">Seleccionar fecha:</label>
            <input type="date" id="fechaBusqueda" name="fechaBusqueda" value="<?= isset($_GET['fechaBusqueda']) ? htmlspecialchars($_GET['fechaBusqueda']) : '' ?>" required>
            <button type="submit" class="btn-buscar">🔍 Buscar</button>
            <?php if (isset($_GET['fechaBusqueda'])): ?>
              <a href="index.php?controller=Peces&action=bpa12Listado" class="btn-limpiar" title="Limpiar filtro">✖️ Limpiar</a>
            <?php endif; ?>
          </form>
        </div>

        <div class="card-body">
          <?php if (isset($_GET['fecha']) && !empty($_GET['fecha'])): ?>
            <div class="filtro-activo">
              📅 Mostrando registros del: <strong><?= htmlspecialchars($_GET['fecha']) ?></strong>
              <a href="index.php?controller=Peces&action=bpa12Listado" class="btn-limpiar-inline">Mostrar todos</a>
            </div>
          <?php endif; ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Código Formato</th>
                  <th>Versión</th>
                  <th>Fecha Registro</th>
                  <th>Mes</th>
                  <th>Sede</th>
                  <th>Día</th>
                  <th>T° (6:30)</th>
                  <th>O₂ (6:30)</th>
                  <th>Sat. (6:30)</th>
                  <th>pH (6:30)</th>
                  <th>T° (12:00)</th>
                  <th>O₂ (12:00)</th>
                  <th>Sat. (12:00)</th>
                  <th>pH (12:00)</th>
                  <th>T° (15:30)</th>
                  <th>O₂ (15:30)</th>
                  <th>Sat. (15:30)</th>
                  <th>pH (15:30)</th>
                  <th>Responsable</th>
                  <th>Observaciones</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($registros)): ?>
                  <?php $i = 1; foreach ($registros as $r): ?>
                    <tr>
                      <td><?= $i++ ?></td>
                      <td><?= htmlspecialchars($r['codigo_formato'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['version'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['fecha_registro'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['mes'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['sede'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['dia'] ?? '') ?></td>

                      <td><?= htmlspecialchars($r['t_0630'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['o2_0630'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['sat_0630'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['ph_0630'] ?? '') ?></td>

                      <td><?= htmlspecialchars($r['t_1200'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['o2_1200'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['sat_1200'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['ph_1200'] ?? '') ?></td>

                      <td><?= htmlspecialchars($r['t_1530'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['o2_1530'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['sat_1530'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['ph_1530'] ?? '') ?></td>

                      <td><?= htmlspecialchars($r['responsable'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['observacion'] ?? '') ?></td>
                      <td>
                        <a href="index.php?controller=Peces&action=eliminarBpa12&id=<?= urlencode($r['id']) ?>"
                           class="btn-eliminar"
                           onclick="return confirm('¿Seguro que deseas eliminar este registro?');">
                           🗑️ Eliminar
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="22" class="text-muted py-3">No existen registros disponibles.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer text-end">
          <a href="index.php?controller=Peces&action=bpa12" class="btn-ir-bpa">🌡️ Ir al BPA12</a>
          <a href="index.php?controller=JefePlanta&action=moduloPeces" class="btn-volver">⬅️ Volver</a>
        </div>
      </div>

    </div>
  </section>
</main>

<!-- ======= ESTILOS ======= -->
<style>
  body {
    background: linear-gradient(120deg, #eaf3ff, #f9fbff);
    font-family: "Poppins", sans-serif;
  }

  .section-listado { padding: 40px 20px; }
  .container { max-width: 1400px; margin: 0 auto; padding: 0 15px; }

  /* ===== Separación visual de bloques ===== */
  .bloque-separado {
    margin-bottom: 35px;
    position: relative;
  }

  .bloque-separado::after {
    content: '';
    position: absolute;
    bottom: -18px;
    left: 5%;
    right: 5%;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(0,123,255,0.2), transparent);
    border-radius: 2px;
  }

  .bloque-separado:last-child::after {
    display: none;
  }

  .bloque-separado {
    transform: translateY(0);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .bloque-separado:hover {
    transform: translateY(-2px);
  }

  /* Encabezado */
  .encabezado {
    background: #004b8d;
    color: white;
    border-radius: 15px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  .encabezado .titulo h2 { margin: 0; font-weight: 700; font-size: 1.7rem; }
  .encabezado .titulo p { margin: 0; font-size: 0.95rem; opacity: 0.9; }

  .acciones-superior a {
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s ease;
    margin-left: 10px;
  }

  .btn-principal { background: #00aaff; color: white; }
  .btn-principal:hover { background: #0095e0; }
  .btn-secundario { background: white; color: #004b8d; border: 2px solid #004b8d; }
  .btn-secundario:hover { background: #004b8d; color: white; }

  /* === WIZARD === */
  .wizard-panel {
    background: #eaf4ff;
    border: 2px dashed #007bff;
    padding: 35px;
    border-radius: 18px;
    text-align: center;
  }

  .wizard-panel h3 { margin-bottom: 20px; color: #004b8d; }

  .wizard {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
    margin: 25px 0;
  }

  .wizard::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 10%;
    right: 10%;
    height: 4px;
    background: #b3d7ff;
    z-index: 0;
  }

  .step {
    text-align: center;
    position: relative;
    z-index: 1;
    cursor: pointer;
    flex: 1;
  }

  .circle {
    width: 50px;
    height: 50px;
    line-height: 50px;
    border-radius: 50%;
    background: #b3d7ff;
    color: #004b8d;
    font-weight: 700;
    margin: auto;
    font-size: 1.2rem;
    border: 3px solid #007bff;
    transition: all .2s ease;
  }

  .step.active .circle {
    background: #007bff;
    color: white;
    transform: scale(1.1);
  }

  .label { margin-top: 6px; font-weight: 600; font-size: 0.9rem; color: #004b8d; }

  .wizard-content { display: none; }
  .wizard-content.active { display: block; }

  .input-fecha {
    padding: 10px 14px;
    border-radius: 10px;
    border: 2px solid #007bff;
    font-size: 1rem;
    background: #ffffff;
    color: #333;
    margin-right: 10px;
    margin-bottom: 10px;
    transition: all .3s;
  }

  .input-fecha:focus { outline: none; box-shadow: 0 0 6px #007bff; }

  .download-btn {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    transition: all .2s;
    font-size: 1rem;
  }

  .download-btn:hover { background: #0062cc; transform: translateY(-2px); }

  /* === TABLA === */
  .card { background: #ffffff; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
  .card-header { background: #007bff; color: white; padding: 18px 30px; font-weight: 600; font-size: 1.2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; }
  .card-body { padding: 30px; overflow-x: auto; }
  .card-footer { padding: 18px 30px; background: #f8f9fa; border-top: 1px solid #dee2e6; }

  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin: 0 -15px;
    padding: 0 15px;
  }

  .table { 
    border: 2px solid #dee2e6; 
    font-size: 0.85rem;
    width: 100%;
    margin-bottom: 0;
    table-layout: auto;
    min-width: 1200px;
  }
  
  .table thead { 
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    font-weight: 700;
    color: white;
  }
  
  .table thead th {
    padding: 12px 8px;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    border: none;
    vertical-align: middle;
    white-space: nowrap;
  }
  
  .table tbody td {
    padding: 12px 8px;
    font-size: 0.85rem;
    vertical-align: middle;
    border-bottom: 1px solid #e9ecef;
  }
  
  .table tbody tr { 
    background: #ffffff;
    transition: all 0.3s ease;
  }
  
  .table tbody tr:nth-child(even) { 
    background: #f8f9fa;
  }
  
  .table tbody tr:hover { 
    background-color: #e3f2fd;
    transform: scale(1.005);
    box-shadow: 0 2px 8px rgba(0,123,255,0.15);
  }

  .btn-ver {
    color: white;
    background: #17a2b8;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.8rem;
    margin-right: 4px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
  }

  .btn-ver:hover { 
    background: #117a8b;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(23,162,184,0.3);
  }

  .btn-eliminar {
    color: white;
    background: #dc3545;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
  }

  .btn-eliminar:hover { 
    background: #b02a37;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220,53,69,0.3);
  }

  .btn-ir-bpa, .btn-volver {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s;
    margin-left: 8px;
  }

  .btn-ir-bpa { background: #007bff; color: white; }
  .btn-ir-bpa:hover { background: #0062cc; }
  .btn-volver { background: #343a40; color: white; }
  .btn-volver:hover { background: #23272b; }

  /* --- BUSCADOR FECHA --- */
  .buscador-fecha {
    display: flex;
    align-items: center;
    gap: 10px;
    background: #eaf4ff;
    padding: 8px 15px;
    border-radius: 10px;
    border: 1px solid #ffffff;
  }

  .buscador-fecha label { font-weight: 600; color: white; }

  .buscador-fecha input[type="date"] {
    border: 2px solid #ffffff;
    border-radius: 8px;
    padding: 6px 10px;
    font-size: 0.9rem;
  }

  .buscador-fecha .btn-buscar {
    background: #00ccff;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
  }

  .buscador-fecha .btn-buscar:hover { background: #0095e0; }

  .buscador-fecha .btn-limpiar {
    background: #ff6b6b;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
    text-decoration: none;
    display: inline-block;
  }

  .buscador-fecha .btn-limpiar:hover { background: #ee5a52; }

  .filtro-activo {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 12px 18px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-weight: 500;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .btn-limpiar-inline {
    background: #28a745;
    color: white;
    padding: 5px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: 0.3s;
  }

  .btn-limpiar-inline:hover { background: #218838; }

  /* Ajustes responsive */
  @media (max-width: 1200px) {
    .table { font-size: 0.8rem; min-width: 1100px; }
    .table thead th { padding: 10px 6px; font-size: 0.75rem; }
    .table tbody td { padding: 10px 6px; font-size: 0.8rem; }
  }

  @media (max-width: 768px) {
    .card-body { padding: 20px 15px; }
    .table { font-size: 0.75rem; min-width: 1000px; }
    .table thead th { padding: 8px 4px; font-size: 0.7rem; }
    .table tbody td { padding: 8px 4px; font-size: 0.75rem; }
  }
</style>

<!-- ======= SCRIPT ======= -->
<script>
function mostrarPaso(n) {
  document.querySelectorAll('.step').forEach((el, i) => {
    el.classList.toggle('active', i + 1 === n);
  });
  document.querySelectorAll('.wizard-content').forEach((el, i) => {
    el.classList.toggle('active', i + 1 === n);
  });
}

// Buscador por fecha y descarga de reportes ahora funcionan 100% en PHP (form GET)
</script>

<script>
function redirigirFormulario() {
  const valor = document.getElementById('Formularios').value;
  const base = window.location.origin + "/sistema-produccion/views/jefeplanta/modulos-jefeplanta/peces/";

  const rutas = {
    'dashboard': base + 'dashboard.php',
    'bpa6-listado': base + 'bpa6-listado.php',
    'bpa7-listado': base + 'bpa7-listado.php',
    'bpa10-listado': base + 'bpa10-listado.php',
    'bpa12-listado': base + 'bpa12-listado.php'
  };

  if (rutas[valor]) {
    window.location.href = rutas[valor];
  } else {
    alert('Ruta no configurada.');
  }
}
</script>

</body>
</html>

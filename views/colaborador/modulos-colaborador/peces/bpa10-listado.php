<?php 
$fechaBusqueda = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de Muestreo - CORAQUA PERÚ</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_peces.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body>
<main id="main" class="main">
  <section class="section-listado">
    <div class="container">

      <!-- ENCABEZADO -->
      <div class="encabezado shadow-sm">
        <div class="titulo">
          <h2>🧪 LISTADO DE MUESTREO - BPA10</h2>
          <p>Sistema de Producción - CORAQUA PERÚ</p>
        </div>
        <div class="acciones-superior">
          <a href="index.php?controller=Peces&action=bpa10" class="btn-principal">
            ➕ Nuevo Registro
          </a>
          <a href="index.php?controller=Colaborador&action=peces" class="btn-secundario">
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

      <!-- PANEL WIZARD DE REPORTES -->
      <div class="wizard-panel">
        <h3>📊 Generar Reportes de Muestreo</h3>
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
          <form onsubmit="descargarExcel(event, 'semana')">
            <input type="date" name="fecha_semana" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Semanal</button>
          </form>
        </div>

        <!-- PASO 2 -->
        <div id="contenido2" class="wizard-content">
          <p>🗓️ Selecciona el mes del <strong>reporte mensual</strong>:</p>
          <form onsubmit="descargarExcel(event, 'mes')">
            <input type="month" name="fecha_mes" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Mensual</button>
          </form>
        </div>

        <!-- PASO 3 -->
        <div id="contenido3" class="wizard-content">
          <p>📈 Selecciona el año del <strong>reporte anual</strong>:</p>
          <form onsubmit="descargarExcel(event, 'anio')">
            <input type="number" name="fecha_anio" min="2020" max="2030" placeholder="Ejemplo: 2025" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Anual</button>
          </form>
        </div>
      </div>

      <!-- CONTENEDOR PRINCIPAL -->
      <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h4>📋 Registros de Muestreo</h4>

          <!-- BUSCADOR POR FECHA -->
          <form class="buscador-fecha" onsubmit="buscarPorFecha(event)">
            <label for="fechaBusqueda">Seleccionar fecha:</label>
            <input type="date" id="fechaBusqueda" name="fechaBusqueda" value="<?= isset($_GET['fechaBusqueda']) ? htmlspecialchars($_GET['fechaBusqueda']) : '' ?>" required>
            <button type="submit" class="btn-buscar">🔍 Buscar</button>
            <?php if (isset($_GET['fechaBusqueda'])): ?>
              <a href="index.php?controller=Peces&action=bpa10Listado" class="btn-limpiar" title="Limpiar filtro">✖️ Limpiar</a>
            <?php endif; ?>
          </form>
        </div>

        <div class="card-body">
          <?php if (isset($_GET['fechaBusqueda'])): ?>
            <div class="filtro-activo">
              📅 Mostrando registros del: <strong><?= htmlspecialchars($_GET['fechaBusqueda']) ?></strong>
              <a href="index.php?controller=Peces&action=bpa10Listado" class="btn-limpiar-inline">Mostrar todos</a>
            </div>
          <?php endif; ?>

          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Encargado</th>
                  <th>Sede</th>
                  <th>UP</th>
                  <th>Lote</th>
                  <th>Fecha Muestreo</th>
                  <th>Hora Muestreo</th>
                  <th>Peso Promedio</th>
                  <th>Coef. Variación</th>
                  <th>Factor K</th>
                  <th>Observaciones</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($registros)): ?>
                  <?php foreach ($registros as $r): ?>
                    <tr>
                      <td><?= htmlspecialchars($r['id']) ?></td>
                      <td><?= htmlspecialchars($r['fecha_registro']) ?></td>
                      <td><?= htmlspecialchars($r['encargado'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['sede'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['up'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['lote'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['fecha_muestreo'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['hora_muestreo'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['peso_promedio'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['coeficiente_variacion'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['factor_k'] ?? '') ?></td>
                      <td><?= htmlspecialchars($r['observaciones'] ?? '') ?></td>
                      <td>
                        <a href="index.php?controller=Peces&action=eliminarBpa10&id=<?= urlencode($r['id']) ?>"
                           class="btn-eliminar"
                           onclick="return confirm('¿Seguro que deseas eliminar este registro?');">
                           🗑️ Eliminar
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="13" class="text-muted py-3">No existen registros disponibles.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer text-end">
          <a href="index.php?controller=Peces&action=bpa10" class="btn-ir-bpa">🧪 Ir al BPA10</a>
          <a href="index.php?controller=JefePlanta&action=moduloPeces" class="btn-volver">⬅️ Volver</a>
        </div>
      </div>

    </div>
  </section>
</main>



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

function descargarExcel(event, tipo) {
  event.preventDefault();
  let valor = event.target.querySelector('input').value;
  alert("📁 Descargando reporte en Excel: " + tipo + "\\nFecha seleccionada: " + valor);
}

function buscarPorFecha(event) {
  event.preventDefault();
  let fecha = document.getElementById('fechaBusqueda').value;
  if (fecha) {
    window.location.href = 'index.php?controller=Peces&action=bpa10Listado&fechaBusqueda=' + encodeURIComponent(fecha);
  } else {
    alert('⚠️ Por favor selecciona una fecha');
  }
}
</script>

<script>
function redirigirFormulario() {
  const valor = document.getElementById('Formularios').value;
  const rutas = {
    'dashboard': 'index.php?controller=JefePlanta&action=moduloPeces',
    'bpa6-listado': 'index.php?controller=Peces&action=bpa6Listado',
    'bpa7-listado': 'index.php?controller=Peces&action=bpa7Listado',
    'bpa10-listado': 'index.php?controller=Peces&action=bpa10Listado',
    'bpa12-listado': 'index.php?controller=Peces&action=bpa12Listado'
  };

  if (rutas[valor]) {
    window.location.href = rutas[valor];
  } else {
    alert('Ruta no configurada.');
  }
}
</script>
</script>

<?php 
$fechaBusqueda = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado Alimentación Diaria - CORAQUA PERÚ</title>
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
          <h2>🍽️ LISTADO DE ALIMENTACIÓN DIARIA - BPA7</h2>
          <p>Sistema de Producción - CORAQUA PERÚ</p>
        </div>
        <div class="acciones-superior">
          <a href="/sistema-produccion/public/index.php?controller=Peces&action=bpa7Formulario" class="btn-principal">
            ➕ Nuevo Registro
          </a>
          <a href="/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloPeces" class="btn-secundario">
            ⬅️ Volver al Panel
          </a>
        </div>
      </div>

      <!-- ========== BLOQUE 2: PANEL WIZARD DE REPORTES ========== -->
      <div class="bloque-separado wizard-panel">
        <h3>📊 Generar Reportes de Alimentación</h3>
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
          <form method="GET" action="/sistema-produccion/public/index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="exportBpa7ExcelSemana">
            <input type="date" name="fecha_semana" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Semanal</button>
          </form>
        </div>

        <!-- PASO 2 -->
        <div id="contenido2" class="wizard-content">
          <p>🗓️ Selecciona el mes del <strong>reporte mensual</strong>:</p>
          <form method="GET" action="/sistema-produccion/public/index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="exportBpa7ExcelMes">
            <input type="month" name="fecha_mes" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Mensual</button>
          </form>
        </div>

        <!-- PASO 3 -->
        <div id="contenido3" class="wizard-content">
          <p>📈 Selecciona el año del <strong>reporte anual</strong>:</p>
          <form method="GET" action="/sistema-produccion/public/index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="exportBpa7ExcelAnio">
            <input type="number" name="fecha_anio" min="2020" max="2100" placeholder="Ejemplo: 2025" required class="input-fecha">
            <button type="submit" class="download-btn">Descargar Excel Anual</button>
          </form>
        </div>
      </div>

      <!-- ========== BLOQUE 3: CONTENEDOR PRINCIPAL - TABLA DE REGISTROS ========== -->
      <div class="bloque-separado card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
          <h4>📋 Registros de Alimentación</h4>

          <!-- BUSCADOR POR FECHA (PHP - GET) -->
          <form class="buscador-fecha" method="GET" action="/sistema-produccion/public/index.php">
            <input type="hidden" name="controller" value="Peces">
            <input type="hidden" name="action" value="bpa7Listado">
            <label for="fechaBusqueda">Seleccionar fecha:</label>
            <input type="date" id="fechaBusqueda" name="fechaBusqueda" value="<?= isset($_GET['fechaBusqueda']) ? htmlspecialchars($_GET['fechaBusqueda']) : '' ?>" required>
            <button type="submit" class="btn-buscar">🔍 Buscar</button>
            <?php if (isset($_GET['fechaBusqueda'])): ?>
              <a href="/sistema-produccion/public/index.php?controller=Peces&action=bpa7Listado" class="btn-limpiar" title="Limpiar filtro">✖️ Limpiar</a>
            <?php endif; ?>
          </form>
        </div>

        <div class="card-body">
          <?php if (isset($_GET['fechaBusqueda'])): ?>
            <div class="filtro-activo">
              📅 Mostrando registros del: <strong><?= htmlspecialchars($_GET['fechaBusqueda']) ?></strong>
              <a href="/sistema-produccion/public/index.php?controller=Peces&action=bpa7Listado" class="btn-limpiar-inline">Mostrar todos</a>
            </div>
          <?php endif; ?>
          <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Fecha</th>
                  <th>Responsable</th>
                  <th>Sede</th>
                  <th>UP</th>
                  <th>Lote</th>
                  <th>Biomasa</th>
                  <th>Tasa Alimentación</th>
                  <th>Alimento Suministrado</th>
                  <th>Calibre</th>
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
                      <td><?= htmlspecialchars($r['responsable']) ?></td>
                      <td><?= htmlspecialchars($r['sede']) ?></td>
                      <td><?= htmlspecialchars($r['up']) ?></td>
                      <td><?= htmlspecialchars($r['lote']) ?></td>
                      <td><?= htmlspecialchars($r['biomasa']) ?></td>
                      <td><?= htmlspecialchars($r['tasa_alimentacion']) ?></td>
                      <td><?= htmlspecialchars($r['alimento_suministrado']) ?></td>
                      <td><?= htmlspecialchars($r['calibre']) ?></td>
                      <td><?= htmlspecialchars($r['observaciones'] ?? '') ?></td>
                      <td>
                        <a href="/sistema-produccion/public/index.php?controller=Peces&action=eliminarBpa7&id=<?= urlencode($r['id']) ?>"
                           class="btn-eliminar"
                           onclick="return confirm('¿Seguro que deseas eliminar este registro?');">
                           🗑️ Eliminar
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr><td colspan="12" class="text-muted py-3">No existen registros disponibles.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer text-end">
          <a href="/sistema-produccion/public/index.php?controller=Peces&action=bpa7" class="btn-ir-bpa">🍤 Ir al BPA7</a>
          <a href="/sistema-produccion/public/index.php?controller=JefePlanta&action=moduloPeces" class="btn-volver">⬅️ Volver</a>
        </div>
      </div>

    </div>
  </section>
</main>

<!-- ======= ESTILOS ======= -->
<style>
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

  /* Efecto de elevación para cada bloque */
  .bloque-separado {
    transform: translateY(0);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .bloque-separado:hover {
    transform: translateY(-2px);
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

// Funciones JS de descarga y búsqueda ya no son necesarias;
// los formularios ahora envían directamente al backend por GET
</script>

</body>
</html>

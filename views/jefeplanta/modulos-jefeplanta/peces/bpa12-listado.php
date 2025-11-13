<?php
// Evitar errores si $registros no está definido
if (!isset($registros)) {
  $registros = [];
}
?>

<main id="main" class="main">
  <section class="section-listado">
    <div class="container">

      <!-- ENCABEZADO -->
      <div class="encabezado shadow-sm">
        <div class="titulo">
          <h2>🌡️ LISTADO DE CONTROL DE PARÁMETROS - BPA12</h2>
          <p>Sistema de Producción - CORAQUA PERÚ</p>
        </div>
        <div class="acciones-superior">
          <a href="index.php?controller=Peces&action=bpa12" class="btn-principal">
            ➕ Nuevo Registro
          </a>
                          <div style="flex:1; min-width:160px">
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
      </div>

      <!-- TABLA PRINCIPAL -->
      <div class="card shadow-lg">
        <div class="card-header">
          <h4>📋 Registros de Parámetros Ambientales</h4>
        </div>

        <div class="card-body">
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
                        <a href="index.php?controller=Peces&action=verBpa12&id=<?= urlencode($r['id']) ?>" class="btn-ver">👁️ Ver</a>
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
          <a href="/sistema-produccion/views/jefeplanta/dashboard.php" class="btn-volver">⬅️ Volver</a>
        </div>
      </div>

    </div>
  </section>
</main>

<style>
  body {
    background: linear-gradient(120deg, #f0f9ff, #fefefe);
    font-family: "Poppins", sans-serif;
  }

  .section-listado {
    padding: 40px 0;
  }

  .container {
    max-width: 1400px;
    margin: 0 auto;
  }

  /* Encabezado */
  .encabezado {
    background: #0056b3;
    color: white;
    border-radius: 15px;
    padding: 25px 30px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
  }

  .encabezado .titulo h2 {
    margin: 0;
    font-weight: 700;
    font-size: 1.7rem;
  }

  .encabezado .titulo p {
    margin: 0;
    font-size: 0.95rem;
    opacity: 0.9;
  }

  .acciones-superior .btn-principal,
  .acciones-superior .btn-secundario {
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s ease;
    margin-left: 10px;
  }

  .btn-principal {
    background: #00aaff;
    color: white;
  }

  .btn-principal:hover {
    background: #008ed6;
  }

  .btn-secundario {
    background: white;
    color: #0056b3;
    border: 2px solid #0056b3;
  }

  .btn-secundario:hover {
    background: #0056b3;
    color: white;
  }

  /* Tarjeta principal */
  .card {
    background: #ffffff;
    border-radius: 15px;
    overflow: hidden;
  }

  .card-header {
    background: #007bff;
    color: white;
    padding: 15px 25px;
    font-weight: 600;
    font-size: 1.1rem;
  }

  .card-body {
    padding: 25px;
  }

  .card-footer {
    padding: 15px 25px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
  }

  /* Tabla */
  .table {
    border: 1px solid #dee2e6;
    font-size: 0.85rem;
  }

  .table thead {
    background-color: #e3f2fd;
    font-weight: 600;
  }

  .table tbody tr:hover {
    background-color: #f1f8ff;
  }

  /* Botones */
  .btn-ver {
    color: white;
    background: #17a2b8;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    margin-right: 4px;
  }

  .btn-ver:hover {
    background: #117a8b;
  }

  .btn-eliminar {
    color: white;
    background: #dc3545;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
  }

  .btn-eliminar:hover {
    background: #b02a37;
  }

  .btn-ir-bpa,
  .btn-volver {
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s;
    margin-left: 8px;
  }

  .btn-ir-bpa {
    background: #007bff;
    color: white;
  }

  .btn-ir-bpa:hover {
    background: #005fcc;
  }

  .btn-volver {
    background: #343a40;
    color: white;
  }

  .btn-volver:hover {
    background: #23272b;
  }
</style>
<style>
        #Formularios {
  width: 100%;
  padding: 11px 14px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  font-size: 0.95rem;
  background: linear-gradient(180deg, #fff, #fffdf9);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
  transition: border 0.2s, box-shadow 0.2s;
  appearance: none; /* para ocultar flecha por defecto si se quiere personalizar */
  cursor: pointer;
}
#Formularios:focus {
  outline: none;
  border-color: var(--cora-orange);
  box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.15);
}
</style>
  <script>
  function redirigirFormulario() {
    const valor = document.getElementById('Formularios').value;

    // Obtener la raíz base del proyecto sin importar desde dónde se acceda
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
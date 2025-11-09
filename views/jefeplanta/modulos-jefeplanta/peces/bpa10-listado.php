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
          <a href="index.php?controller=JefePlanta&action=moduloPeces" class="btn-secundario">
            ⬅️ Volver al Panel
          </a>
        </div>
      </div>

      <!-- CONTENEDOR PRINCIPAL -->
      <div class="card shadow-lg">
        <div class="card-header">
          <h4>📋 Registros de Muestreo</h4>
        </div>

        <div class="card-body">
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
                  <tr><td colspan="12" class="text-muted py-3">No existen registros disponibles.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer text-end">
          <a href="index.php?controller=Peces&action=bpa10" class="btn-ir-bpa">🧪 Ir al BPA10</a>
          <a href="/sistema-produccion/views/jefeplanta/dashboard.php" class="btn-volver">⬅️ Volver</a>
        </div>
      </div>

    </div>
  </section>
</main>

<style>
  /* === ESTILOS GENERALES === */
  body {
    background: linear-gradient(120deg, #e9f3ff, #f9fbff);
    font-family: "Poppins", sans-serif;
  }

  .section-listado {
    padding: 40px 0;
  }

  .container {
    max-width: 1300px;
    margin: 0 auto;
  }

  /* === ENCABEZADO === */
  .encabezado {
    background: #004b8d;
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
    color: #004b8d;
    border: 2px solid #004b8d;
  }

  .btn-secundario:hover {
    background: #004b8d;
    color: white;
  }

  /* === TARJETA PRINCIPAL === */
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

  /* === TABLA === */
  .table {
    border: 1px solid #dee2e6;
    font-size: 0.9rem;
  }

  .table thead {
    background-color: #e3f2fd;
    font-weight: 600;
  }

  .table tbody tr:hover {
    background-color: #f1f8ff;
  }

  /* === BOTONES === */
  .btn-eliminar {
    color: white;
    background: #dc3545;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    display: inline-block;
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

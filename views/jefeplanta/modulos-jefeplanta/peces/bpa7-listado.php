<main id="main" class="main">
  <section class="section-listado">
    <div class="container">

      <!-- ENCABEZADO -->
      <div class="encabezado shadow-sm">
        <div class="titulo">
          <h2>🍽️ LISTADO DE ALIMENTACIÓN DIARIA - BPA7</h2>
          <p>Sistema de Producción - CORAQUA PERÚ</p>
        </div>
        <div class="acciones-superior">
          <a href="index.php?controller=Peces&action=bpa7Formulario" class="btn-principal">
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

      <!-- CONTENEDOR PRINCIPAL -->
      <div class="card shadow-lg">
        <div class="card-header">
          <h4>📋 Registros de Alimentación</h4>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle text-center">
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
                        <a href="index.php?controller=Peces&action=eliminarBpa7&id=<?= urlencode($r['id']) ?>"
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
          <a href="index.php?controller=Peces&action=bpa7Formulario" class="btn-ir-bpa">🍤 Ir al BPA7</a>
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


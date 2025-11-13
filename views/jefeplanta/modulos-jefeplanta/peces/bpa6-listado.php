<main id="main" class="main">
  <section class="section-listado">
    <div class="container">
      <div class="encabezado shadow-sm">
        <div class="titulo">
          <h2>🐟 LISTADO DE MORTALIDAD DE ALEVINOS - BPA6</h2>
          <p>Sistema de Producción - CORAQUA PERÚ</p>
        </div>
        <div class="acciones-superior">
          <a href="index.php?controller=Peces&action=bpa6" class="btn-principal">
            ➕ Nuevo Registro
          </a>
          
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
      </div>

      <div class="card shadow-lg">
        <div class="card-header">
          <h4>📋 Registros de Mortalidad</h4>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover text-center align-middle">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Código Formato</th>
                  <th>Versión</th>
                  <th>Fecha Registro</th>
                  <th>Responsable</th>
                  <th>Sede</th>
                  <th>UP</th>
                  <th>Lote</th>
                  <th>Mortalidad</th>
                  <th>Morbilidad</th>
                  <th>Total</th>
                  <th>Observaciones</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($registros)): ?>
                  <?php foreach ($registros as $r): ?>
                    <tr>
                      <td><?= htmlspecialchars($r['id']) ?></td>
                      <td><?= htmlspecialchars($r['codigo_formato']) ?></td>
                      <td><?= htmlspecialchars($r['version']) ?></td>
                      <td><?= htmlspecialchars($r['fecha_registro']) ?></td>
                      <td><?= htmlspecialchars($r['responsable']) ?></td>
                      <td><?= htmlspecialchars($r['sede']) ?></td>
                      <td><?= htmlspecialchars($r['up']) ?></td>
                      <td><?= htmlspecialchars($r['lote']) ?></td>
                      <td><?= htmlspecialchars($r['mortalidad']) ?></td>
                      <td><?= htmlspecialchars($r['morbilidad']) ?></td>
                      <td><?= htmlspecialchars($r['total']) ?></td>
                      <td><?= htmlspecialchars($r['observaciones'] ?? '') ?></td>
                      <td>
                        <a href="index.php?controller=Peces&action=eliminarBpa6&id=<?= urlencode($r['id']) ?>"
                            class="btn-eliminar"
                            onclick="return confirm('¿Deseas eliminar este registro?');">🗑️ Eliminar</a>
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
        
      </div>

    </div>
  </section>
</main>

<style>
  /* === PALETA DE COLORES Y VARIABLES === */
  :root {
    --cora-dark-blue: #004b8d;
    --cora-action-blue: #00aaff;
    --cora-action-blue-hover: #0095e0;
    --cora-accent-orange: #ff7b00; /* Naranja de CORAQUA para foco */
    --cora-danger: #dc3545;
    --cora-danger-hover: #b02a37;
    --cora-bg-light: #f8f9fa;
    --cora-bg-body: linear-gradient(120deg, #eaf3ff, #f9fbff);
    --cora-white: #ffffff;
    --cora-text-dark: #212529;
    --cora-text-light: #6c757d;
    --cora-border: #dee2e6;
    --cora-shadow-sm: 0 .125rem .25rem rgba(0,0,0,.075);
    --cora-shadow-lg: 0 1rem 3rem rgba(0,0,0,.175);
  }

  /* === ESTILOS GENERALES === */
  body {
    background: var(--cora-bg-body);
    font-family: "Poppins", sans-serif;
    color: var(--cora-text-dark);
  }

  .section-listado {
    padding: 40px 15px; /* Añadido padding lateral para móviles */
  }

  .container {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 15px;
  }
  
  /* Utilidades de Bootstrap que estabas usando */
  .shadow-sm { box-shadow: var(--cora-shadow-sm) !important; }
  .shadow-lg { box-shadow: var(--cora-shadow-lg) !important; }
  .text-center { text-align: center !important; }
  .align-middle { vertical-align: middle !important; }
  .text-muted { color: var(--cora-text-light) !important; }
  .py-3 { padding-top: 1rem !important; padding-bottom: 1rem !important; }

  /* === ENCABEZADO === */
  .encabezado {
    background: var(--cora-dark-blue);
    color: var(--cora-white);
    border-radius: 15px;
    padding: 25px 30px;
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap; /* Permite que se ajuste en pantallas pequeñas */
    gap: 20px; /* Espacio entre el título y las acciones */
  }

  .encabezado .titulo h2 {
    margin: 0 0 4px 0;
    font-weight: 700;
    font-size: 1.7rem;
  }

  .encabezado .titulo p {
    margin: 0;
    font-size: 0.95rem;
    opacity: 0.9;
  }

  .acciones-superior {
    display: flex;
    align-items: center;
    flex-wrap: wrap; /* Permite que los botones se ajusten */
    gap: 20px; /* Espacio entre botón y selector */
  }

  .btn-principal {
    text-decoration: none;
    padding: 11px 20px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s ease;
    background: var(--cora-action-blue);
    color: var(--cora-white);
    white-space: nowrap; /* Evita que el texto del botón se parta */
  }

  .btn-principal:hover {
    background: var(--cora-action-blue-hover);
    transform: translateY(-2px);
  }
  
  /* Estilos para el contenedor del Label y Select */
  .acciones-superior > div {
    display: flex;
    flex-direction: column;
  }
  
  .acciones-superior label {
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--cora-white);
    opacity: 0.9;
    margin-bottom: 4px;
  }

  /* === ESTILO DEL SELECT (unificado) === */
  #Formularios {
    width: 100%;
    padding: 11px 40px 11px 14px; /* Espacio para la flecha */
    border-radius: 8px;
    border: 1px solid #ced4da;
    font-size: 0.95rem;
    background-color: var(--cora-white);
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='none' stroke='%23333333' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 12px;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
    transition: border-color 0.2s, box-shadow 0.2s;
    appearance: none;
    cursor: pointer;
  }

  #Formularios:focus {
    outline: none;
    border-color: var(--cora-accent-orange);
    box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.25);
  }

  /* === TARJETA PRINCIPAL === */
  .card {
    background: var(--cora-white);
    border-radius: 15px;
    overflow: hidden;
    border: none;
  }

  .card-header {
    background: var(--cora-white);
    color: var(--cora-dark-blue);
    padding: 20px 25px;
    font-weight: 600;
    font-size: 1.2rem;
    border-bottom: 1px solid var(--cora-border);
  }
  
  .card-header h4 {
    margin: 0;
  }

  .card-body {
    padding: 25px;
  }

  /* === TABLA === */
  .table-responsive {
    border: 1px solid var(--cora-border);
    border-radius: 8px;
    overflow: hidden; /* Clave para que el radius afecte a la tabla */
  }

  .table {
    border-collapse: collapse; /* Quita bordes duplicados */
    margin-bottom: 0; /* El wrapper se encarga del espacio */
    font-size: 0.9rem;
    min-width: 1200px; /* Evita que la tabla se comprima demasiado */
  }

  .table thead th {
    background-color: var(--cora-bg-light);
    color: var(--cora-dark-blue);
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    padding: 15px 10px;
    border-bottom: 2px solid var(--cora-border);
  }

  .table tbody tr:hover {
    background-color: #f1f8ff;
  }
  
  .table tbody td {
    padding: 12px 10px;
    border-top: 1px solid var(--cora-border);
  }
  
  /* Alineación específica para columnas */
  .table th:nth-child(1), .table td:nth-child(1) { width: 5%; } /* ID */
  .table th:nth-child(4), .table td:nth-child(4) { width: 10%; } /* Fecha */
  .table th:nth-child(12), .table td:nth-child(12) {
    text-align: left; /* Observaciones alineadas a la izquierda */
    min-width: 200px;
    white-space: normal; /* Permite que el texto se ajuste */
  }
  .table th:nth-child(13), .table td:nth-child(13) { width: 10%; } /* Acciones */


  /* Fila de "No existen registros" */
  .table tbody tr:last-child td[colspan="13"] {
    text-align: center;
    font-style: italic;
    padding: 25px;
  }
  

  /* === BOTONES ACCIONES === */
  .btn-eliminar {
    color: var(--cora-white);
    background: var(--cora-danger);
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 500;
    transition: background-color 0.2s;
  }

  .btn-eliminar:hover {
    background: var(--cora-danger-hover);
  }

  /* Estilos no utilizados en este HTML, pero mantenidos por si acaso */
  .btn-secundario {
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s ease;
    margin-left: 10px;
    background: white;
    color: var(--cora-dark-blue);
    border: 2px solid var(--cora-dark-blue);
  }

  .btn-secundario:hover {
    background: var(--cora-dark-blue);
    color: white;
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
    background: var(--cora-action-blue);
    color: white;
  }

  .btn-ir-bpa:hover {
    background: var(--cora-action-blue-hover);
  }

  .btn-volver {
    background: #343a40;
    color: white;
  }

  .btn-volver:hover {
    background: #23272b;
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

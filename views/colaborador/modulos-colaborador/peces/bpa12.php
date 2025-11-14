<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPA 12 - Control Diario de Parámetros</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_peces.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<main class="col-md-12 mt-4 d-flex justify-content-center align-items-center flex-column">
  <div class="card shadow-lg border-0" style="max-width: 95%; background-color: #fffaf3;">
    
    <div class="card-header text-white text-center py-4 rounded-top"
         style="background: linear-gradient(135deg, #ff7e00, #ff9d42);">
      <h3 class="mb-0 fw-bold">🐟 BPA 12 - Control Diario de Parámetros</h3>
      <p class="mb-0 fst-italic text-light">CORAQUA - Versión 2.0</p>
    </div>

    <div class="card-body px-5 py-4">
      <button class="btn-back" onclick="volverAtras()">⬅️ Atrás</button>
      
      
      <form id="bpa12Form" method="post" action="index.php?controller=Peces&action=guardarBpa12" novalidate>
        <input type="hidden" name="codigo_formato" value="CORAQUA BPA-12">
        <input type="hidden" name="version" value="2.0">

        <!-- Datos generales -->
        <div class="row mb-4">
          <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">📅 Fecha de Registro</label>
            <input type="date" name="fecha_registro" class="form-control shadow-sm" value="<?= date('Y-m-d') ?>" required>
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">🗓️ Mes</label>
            <input type="text" name="mes" class="form-control shadow-sm" placeholder="Ej: Noviembre" required>
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">🏢 Sede</label>
            <input type="text" name="sede" class="form-control shadow-sm" placeholder="Nombre de la sede" required>
          </div>
          <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">👤 Responsable</label>
            <input type="text" name="responsable_global" class="form-control shadow-sm" placeholder="Nombre del responsable" required>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-center">CONTROL DE PARÁMETROS</h5>

            <div class="text-center mb-3">
              <button type="button" id="btn-1200" class="btn btn-warning">Horario 12:00</button>
              <button type="button" id="btn-1530" class="btn btn-warning">Horario 3:30 p.m.</button>
            </div>

            <!-- HORARIO 6:30 -->
            <div id="horario-0630" class="table-responsive horario-section">
              <h6 class="text-center">Horario 6:30 a.m.</h6>
              <table class="table table-bordered text-center align-middle">
                <thead class="table-warning">
                  <tr>
                    <th>Día</th>
                    <th>T° (°C)</th>
                    <th>O₂ (mg/L)</th>
                    <th>%SAT</th>
                    <th>PH</th>
                    <th>Observación</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody id="tabla-0630-body"></tbody>
              </table>
            </div>

            <!-- HORARIO 12:00 -->
            <div id="horario-1200" class="table-responsive horario-section" style="display:none;">
              <h6 class="text-center">Horario 12:00 p.m.</h6>
              <table class="table table-bordered text-center align-middle">
                <thead class="table-warning">
                  <tr>
                    <th>Día</th>
                    <th>T° (°C)</th>
                    <th>O₂ (mg/L)</th>
                    <th>%SAT</th>
                    <th>PH</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody id="tabla-1200-body"></tbody>
              </table>
            </div>

            <!-- HORARIO 3:30 -->
            <div id="horario-1530" class="table-responsive horario-section" style="display:none;">
              <h6 class="text-center">Horario 3:30 p.m.</h6>
              <table class="table table-bordered text-center align-middle">
                <thead class="table-warning">
                  <tr>
                    <th>Día</th>
                    <th>T° (°C)</th>
                    <th>O₂ (mg/L)</th>
                    <th>%SAT</th>
                    <th>PH</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody id="tabla-1530-body"></tbody>
              </table>
            </div>

            <div class="text-center mt-3">
              <button type="button" id="btnAgregar" class="btn btn-success">➕ Agregar fila</button>
              <button type="submit" class="btn btn-primary px-4">Guardar todo</button>
              <button type="button" class="btn secondary" onclick="verListado()">📖 Ver Listado Diario</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>

<script>
let contador = 0;

const tabla0630 = document.getElementById("tabla-0630-body");
const tabla1200 = document.getElementById("tabla-1200-body");
const tabla1530 = document.getElementById("tabla-1530-body");

const btnAgregar = document.getElementById("btnAgregar");
const btn1200 = document.getElementById("btn-1200");
const btn1530 = document.getElementById("btn-1530");

// Mostrar / ocultar horarios
btn1200.addEventListener("click", () => {
  const tabla = document.getElementById("horario-1200");
  tabla.style.display = tabla.style.display === "none" ? "block" : "none";
});

btn1530.addEventListener("click", () => {
  const tabla = document.getElementById("horario-1530");
  tabla.style.display = tabla.style.display === "none" ? "block" : "none";
});

// Agregar fila sincronizada
function agregarFila() {
  contador++;

  const fila0630 = crearFila("0630", contador, true);  // con observación
  const fila1200 = crearFila("1200", contador, false); // sin observación
  const fila1530 = crearFila("1530", contador, false); // sin observación

  tabla0630.appendChild(fila0630);
  tabla1200.appendChild(fila1200);
  tabla1530.appendChild(fila1530);
}

// Crear fila (parámetro: incluir observación o no)
function crearFila(horario, dia, conObservacion) {
  const fila = document.createElement("tr");

  let columnas = `
    <td class="dia">${dia}</td>
    <td><input type="text" name="t_${horario}[]" class="form-control"></td>
    <td><input type="text" name="o2_${horario}[]" class="form-control"></td>
    <td><input type="text" name="sat_${horario}[]" class="form-control"></td>
    <td><input type="text" name="ph_${horario}[]" class="form-control"></td>
  `;

  if (conObservacion) {
    columnas += `<td><input type="text" name="obs_${horario}[]" class="form-control"></td>`;
  }

  columnas += `<td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(${dia})">🗑️</button></td>`;
  fila.innerHTML = columnas;

  return fila;
}

// Eliminar fila sincronizada
function eliminarFila(numDia) {
  ["0630", "1200", "1530"].forEach(h => {
    const tabla = document.getElementById(`tabla-${h}-body`);
    const fila = Array.from(tabla.children).find(f => f.querySelector(".dia").textContent == numDia);
    if (fila) fila.remove();
  });
  contador--;
  actualizarDias();
}

// Reajustar numeración
function actualizarDias() {
  ["0630", "1200", "1530"].forEach(h => {
    const filas = document.querySelectorAll(`#tabla-${h}-body tr`);
    filas.forEach((fila, index) => {
      const dia = index + 1;
      fila.querySelector(".dia").textContent = dia;
      fila.querySelector("button").setAttribute("onclick", `eliminarFila(${dia})`);
    });
  });
}

// 5 filas por defecto
for (let i = 0; i < 5; i++) agregarFila();
btnAgregar.addEventListener("click", agregarFila);


</script>
<script>
function verListado() {
  // Redirige al listado usando el front controller
  window.location.href = 'index.php?controller=Peces&action=bpa12Listado';
}
</script>

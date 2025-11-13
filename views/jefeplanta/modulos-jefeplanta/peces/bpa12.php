<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BPA 12 - Control Diario de Parámetros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #fff7ed, #ffe2c2);
      font-family: "Poppins", sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }

    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    .card-header {
      background: linear-gradient(135deg, #ff7e00, #ff9d42);
      border: none;
      border-radius: 1rem 1rem 0 0 !important;
      box-shadow: 0 3px 10px rgba(255, 126, 0, 0.4);
    }

    h3, h5, h6 {
      font-weight: 700;
    }

    label {
      font-size: 0.95rem;
      color: #333;
    }

    .form-control {
      border-radius: 0.5rem;
      border: 1px solid #ddd;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #ff7e00;
      box-shadow: 0 0 5px rgba(255, 126, 0, 0.3);
    }

    .btn-warning {
      color: #fff;
      background: linear-gradient(135deg, #ff9f2f, #ffb84d);
      border: none;
      font-weight: 600;
      transition: transform 0.2s;
    }

    .btn-warning:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(255, 159, 47, 0.4);
    }

    .btn-success, .btn-primary {
      border: none;
      border-radius: 0.5rem;
      font-weight: 600;
      transition: transform 0.2s ease;
    }

    .btn-success:hover, .btn-primary:hover {
      transform: translateY(-2px);
    }

    .table {
      border-radius: 0.6rem;
      overflow: hidden;
    }

    .table th {
      background: #ffeed9 !important;
      color: #3b2b17;
      font-weight: 600;
    }

    .horario-section {
      border: 1px solid #ffe3bf;
      border-radius: 0.7rem;
      padding: 1rem;
      margin-bottom: 1rem;
      background: #fffdf8;
      box-shadow: 0 2px 10px rgba(255, 165, 0, 0.1);
    }

    .card-title {
      color: #ff7e00;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    #btnAgregar, [type="submit"] {
      border-radius: 0.6rem;
      padding: 0.7rem 1.5rem;
      font-size: 1rem;
    }
     .btn-back {
  font-size: 1.2rem;
  padding: 0.5rem 1rem;
  border: none;
  outline: none;
  border-radius: 0.2rem;
  cursor: pointer;
  text-transform: uppercase;
  background-color: rgb(14, 14, 26);
  color: rgb(234, 234, 234);
  font-weight: 700;
  transition: all 0.6s ease;
  box-shadow: 0px 0px 60px #1f4c65;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  letter-spacing: 1px;
  -webkit-box-reflect: below 10px linear-gradient(to bottom, rgba(0,0,0,0.0), rgba(0,0,0,0.4));
}

.btn-back:active {
  scale: 0.2;
}

.btn-back:hover {
  background: linear-gradient(270deg, rgba(2, 29, 78, 0.8) 0%, rgba(31, 215, 232, 0.9) 60%);
  color: rgba(22, 22, 64, 0.46);
  transform: translateY(-3px);
  box-shadow: 0 0 25px rgba(31, 215, 232, 0.8);
}


.btn-back:hover::before {
  transform: translateX(-6px);
}
      #Formularios {
  width: 100%;
  padding: 11px 14px;
  border-radius: 10px;
  border: 1px solid #e0e0e0;
  font-size: 0.95rem;
  background: linear-gradient(180deg, #fff, #fffdf9);
  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
  transition: border 0.2s, box-shadow 0.2s;
  appearance: none;
  cursor: pointer;
}
#Formularios:focus {
  outline: none;
  border-color: #ff7e00;
  box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.15);
}
  </style>
</head>

<body>

<main class="col-md-12 mt-4 d-flex justify-content-center align-items-center flex-column">
  <div class="card shadow-lg border-0" style="max-width: 95%; background-color: #fffaf3;">
    
    <div class="card-header text-white text-center py-4 rounded-top"
         style="background: linear-gradient(135deg, #ff7e00, #ff9d42);">
      <h3 class="mb-0 fw-bold">🐟 BPA 12 - Control Diario de Parámetros</h3>
      <p class="mb-0 fst-italic text-light">CORAQUA - Versión 2.0</p>
    </div>
    
    <div style="flex:1; min-width:160px; padding: 20px;">
      <label for="Formularios">Formularios</label>
      <select id="Formularios" onchange="redirigirFormulario()">
        <option value="" disabled selected>Seleccione Formularios</option>
        <option value="dashboard">Panel</option>
        <option value="bpa6">BPA-6 (Mortalidad Alevinos)</option>
        <option value="bpa7">BPA-7</option>
        <option value="bpa10">BPA-10</option>
        <option value="bpa12">BPA-12</option>
      </select>
    </div>

    <div class="card-body px-5 py-4">
      <form id="bpa12Form" method="post" action="/sistema-produccion/public/index.php?controller=Peces&action=guardarBpa12" novalidate>
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

// Manejar el envío del formulario
document.getElementById('bpa12Form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validar campos requeridos
    const fecha = document.querySelector('input[name="fecha_registro"]').value;
    const mes = document.querySelector('input[name="mes"]').value;
    const sede = document.querySelector('input[name="sede"]').value;
    const responsable = document.querySelector('input[name="responsable_global"]').value;
    
    if (!fecha || !mes || !sede || !responsable) {
        alert('Por favor complete todos los campos generales (Fecha, Mes, Sede, Responsable)');
        return;
    }
    
    // Verificar que haya al menos una fila con datos
    let tieneDatos = false;
    ['0630', '1200', '1530'].forEach(horario => {
        const filas = document.querySelectorAll(`#tabla-${horario}-body tr`);
        filas.forEach(fila => {
            const inputs = fila.querySelectorAll('input[type="text"]');
            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    tieneDatos = true;
                }
            });
        });
    });
    
    if (!tieneDatos) {
        alert('Por favor ingrese al menos un parámetro en alguna de las tablas');
        return;
    }
    
    // Mostrar confirmación
    if (confirm('¿Está seguro de que desea guardar todos los datos?')) {
        // Enviar formulario
        this.submit();
    }
});

function redirigirFormulario() {
    const valor = document.getElementById('Formularios').value;

    const rutas = {
        'dashboard': '/sistema-produccion/public/index.php?controller=Peces&action=dashboard',
        'bpa6': '/sistema-produccion/public/index.php?controller=Peces&action=bpa6',
        'bpa7': '/sistema-produccion/public/index.php?controller=Peces&action=bpa7',
        'bpa10': '/sistema-produccion/public/index.php?controller=Peces&action=bpa10',
        'bpa12': '/sistema-produccion/public/index.php?controller=Peces&action=bpa12'
    };

    if (rutas[valor]) {
        window.location.href = rutas[valor];
    } else {
        alert('Ruta no configurada.');
    }
}

console.log('Formulario BPA12 cargado correctamente');
</script>
</body>
</html>
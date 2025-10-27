<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FORMATO N°07 - ALIMENTACIÓN DIARIA</title>
<style>
  * {
    box-sizing: border-box;
    font-family: "Poppins", "Segoe UI", sans-serif;
  }

  body {
    background: linear-gradient(135deg, #fffaf2, #ffd9b3);
    margin: 0;
    padding: 0;
    color: #333;
    min-height: 100vh;
  }

  .container {
    max-width: 1200px;
    margin: 40px auto;
    background: #fff;
    padding: 35px 40px;
    border-radius: 16px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.1);
    border-top: 6px solid #ff7b00;
    animation: fadeIn 0.8s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  header {
    text-align: center;
    margin-bottom: 30px;
  }

  header h2 {
    color: #ff7b00;
    font-size: 1.6em;
    margin-bottom: 5px;
  }

  header p {
    font-size: 0.9em;
    color: #555;
  }

  /* ==== Wizard ==== */
  .wizard {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 80px;
  margin-bottom: 30px;
}

.step {
  display: flex;
  flex-direction: column; /* 👉 ahora el texto irá debajo */
  align-items: center;
  position: relative;
  cursor: pointer;
}

.step:not(:last-child)::after {
  content: "";
  width: 100px;
  height: 3px;
  background: #ddd;
  position: absolute;
  top: 19px; /* centra la línea con el círculo */
  right: -90px;
  z-index: 0;
}

.circle {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: #ddd;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  z-index: 1;
  transition: all 0.3s;
  font-size: 1.1em;
}

.step.active .circle {
  background: #ff7b00;
  box-shadow: 0 0 10px #ffb366;
}

.label {
  margin-top: 8px; /* separa el texto del círculo */
  font-weight: 600;
  color: #555;
  text-align: center;
}

.step.active .label {
  color: #ff7b00;
}

  /* ==== Contenido de pasos ==== */
  .wizard-content {
    display: none;
    animation: fadeIn 0.6s ease;
  }

  .wizard-content.active {
    display: block;
  }

  .download-btn {
    background: #ff7b00;
    color: #fff;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.95em;
    transition: all 0.2s;
  }

  .download-btn:hover {
    background: #e66e00;
  }

  /* ==== Info General ==== */
  .info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 15px;
    margin-top: 30px;
  }

  label {
    font-weight: 600;
    font-size: 0.9em;
    color: #2d3436;
  }

  input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.9em;
    transition: 0.2s;
  }

  input:focus {
    border-color: #ff7b00;
    outline: none;
    box-shadow: 0 0 4px #ffb366;
  }

  /* ==== Tabla ==== */
  .section-title {
    background: #ffeedb;
    color: #ff7b00;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
    margin-top: 25px;
  }

  .table-container {
    overflow-x: auto;
    margin-top: 10px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9em;
  }

  th, td {
    border: 1px solid #ddd;
    padding: 6px;
    text-align: center;
  }

  th {
    background: #ff7b00;
    color: white;
    position: sticky;
    top: 0;
  }

  td input {
    width: 100%;
    border: none;
    background: transparent;
    text-align: center;
  }

  td input:focus {
    background: #fff4e6;
    outline: none;
  }

  /* ==== Botones ==== */
  .actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 20px;
    gap: 10px;
  }

  button {
    background: #ff7b00;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 0.9em;
    cursor: pointer;
    transition: 0.3s;
  }

  button:hover {
    background: #e66e00;
  }

  .secondary {
    background: white;
    color: #ff7b00;
    border: 2px solid #ff7b00;
  }

  .secondary:hover {
    background: #ff7b00;
    color: white;
  }

  footer {
    text-align: center;
    margin-top: 30px;
    font-size: 0.85em;
    color: #666;
  }
</style>
</head>
<body>

<div class="container">
  <header>
    <h2>FORMATO N°07 - ALIMENTACIÓN DIARIA</h2>
    <p><strong>CÓDIGO:</strong> CORAQUA BPA-1 | <strong>VERSIÓN:</strong> 2.0 | <strong>FECHA:</strong> 03/08/2020</p>
  </header>

  <!-- WIZARD -->
  <div class="wizard">
    <div class="step active" onclick="mostrarPaso(1)">
      <div class="circle">1</div><span class="label">Semanal</span>
    </div>
    <div class="step" onclick="mostrarPaso(2)">
      <div class="circle">2</div><span class="label">Mensual</span>
    </div>
    <div class="step" onclick="mostrarPaso(3)">
      <div class="circle">3</div><span class="label">Anual</span>
    </div>
  </div>

  <div id="contenido1" class="wizard-content active">
    <p>📅 Descargar reporte semanal en formato Excel:</p>
    <button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button>
  </div>

  <div id="contenido2" class="wizard-content">
    <p>🗓️ Descargar reporte mensual en formato Excel:</p>
    <button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button>
  </div>

  <div id="contenido3" class="wizard-content">
    <p>📊 Descargar reporte anual en formato Excel:</p>
    <button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button>
  </div>

  <!-- FORMULARIO GENERAL -->
  <section class="info-grid">
    <div>
      <label>Responsable</label>
      <input type="text" placeholder="Ejemplo: Juan Pérez">
    </div>
    <div>
      <label>Fecha</label>
      <input type="date">
    </div>
    <div>
      <label>Sede</label>
      <input type="text" placeholder="Ejemplo: Planta Principal">
    </div>
  </section>

  <!-- TABLA -->
  <div class="section-title">Registro de Alimentación</div>
  <div class="table-container">
    <table id="tablaAlimentacion">
      <thead>
        <tr>
          <th>N°</th>
          <th>UP</th>
          <th>LOTE</th>
          <th>BIOMASA</th>
          <th>T.A. (%)</th>
          <th>AL. SUM (KG)</th>
          <th>CALIBRE</th>
          <th>OBSERVACIONES</th>
        </tr>
      </thead>
      <tbody id="bodyAlimentacion">
        <tr>
          <td>1</td>
          <td><input type="text" placeholder="UP-01"></td>
          <td><input type="text" placeholder="L-001"></td>
          <td><input type="number" step="0.01"></td>
          <td><input type="number" step="0.01"></td>
          <td><input type="number" step="0.01"></td>
          <td><input type="text"></td>
          <td><input type="text"></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- BOTONES -->
  <div class="actions">
    <div>
      <button onclick="agregarFila()">➕ Agregar Fila</button>
      <button onclick="eliminarFila()">➖ Quitar Fila</button>
    </div>
    <div>
      <button class="secondary" onclick="verListado()">📖 Ver Listado Diario</button>
      <button class="secondary" onclick="volverAtras()">⬅️ Volver Atrás</button>
    </div>
  </div>

  <footer>
    CORAQUA © 2025 - Alimentación Diaria
  </footer>
</div>

<script>
  // ======= FUNCIONES DEL WIZARD =======
  function mostrarPaso(n) {
    const steps = document.querySelectorAll('.step');
    const contents = document.querySelectorAll('.wizard-content');

    steps.forEach((step, i) => {
      if (i === n - 1) step.classList.add('active');
      else step.classList.remove('active');
    });

    contents.forEach((content, i) => {
      content.classList.remove('active');
      if (i === n - 1) content.classList.add('active');
    });
  }

  // ======= FUNCIONES DE TABLA =======
  function agregarFila() {
    const tbody = document.getElementById("bodyAlimentacion");
    const num = tbody.querySelectorAll("tr").length + 1;
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${num}</td>
      <td><input type="text" placeholder="UP-${num.toString().padStart(2,'0')}"></td>
      <td><input type="text" placeholder="L-${num.toString().padStart(3,'0')}"></td>
      <td><input type="number" step="0.01"></td>
      <td><input type="number" step="0.01"></td>
      <td><input type="number" step="0.01"></td>
      <td><input type="text"></td>
      <td><input type="text"></td>
    `;
    tbody.appendChild(tr);
  }

  function eliminarFila() {
    const tbody = document.getElementById("bodyAlimentacion");
    if (tbody.rows.length > 1) tbody.deleteRow(-1);
    else alert("Debe haber al menos una fila.");
  }

  // ======= DESCARGAS SIMULADAS =======
  function descargarExcel(tipo) {
    let archivo = "";
    switch (tipo) {
      case 'semana': archivo = "Reporte_Semanal.xlsx"; break;
      case 'mes': archivo = "Reporte_Mensual.xlsx"; break;
      case 'anio': archivo = "Reporte_Anual.xlsx"; break;
    }
    alert(`📂 Descargando ${archivo}...`);
  }

  function verListado() {
    alert("📅 Mostrando listado diario...");
  }

  function volverAtras() {
    window.history.back();
  }
</script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>CONTROL DIARIO DE PARÁMETROS — CORAQUA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cora-orange: #ff7b00;
            --cora-dark: #0f2b2b;
            --bg-1: linear-gradient(135deg, #fffaf2 0%, #fff1e0 40%, #f6fbff 100%);
            --card-bg: rgba(255, 255, 255, 0.98);
            --muted: #6b6b6b;
            --accent: #0f5660;
            --soft-shadow: 0 8px 30px rgba(15, 43, 43, 0.06);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            height: 100%;
            font-family: Inter, Poppins, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: var(--bg-1);
            color: var(--cora-dark);
            -webkit-font-smoothing: antialiased;
        }

        body {
            display: flex;
            flex-direction: column;
            padding: 0;
            overflow: hidden; /* Evita scroll general del body */
        }

        .app-header {
            background: var(--card-bg);
            padding: 12px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-bottom: 3px solid var(--cora-orange);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            z-index: 100;
            flex-shrink: 0; /* Evita que el header se encoja */
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(180deg, #fff, #fffdf9);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 43, 43, 0.08);
            border: 1px solid rgba(15, 43, 43, 0.04);
        }

        .logo img {
            width: 44px;
            height: auto;
        }

        .title-col h1 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .meta {
            color: var(--muted);
            font-size: 0.82rem;
            margin-top: 2px;
        }

        .btn {
            background: var(--cora-orange);
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 123, 0, 0.18);
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(255, 123, 0, 0.25);
        }

        .btn.secondary {
            background: transparent;
            color: var(--cora-orange);
            border: 2px solid var(--cora-orange);
        }

        .btn.ghost {
            background: transparent;
            color: var(--muted);
            border: 1px solid #ddd;
        }

        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 16px;
        }

        .form-container {
            background: var(--card-bg);
            border-radius: 14px;
            padding: 20px;
            box-shadow: var(--soft-shadow);
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* Cambiado a hidden para evitar doble scroll */
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            margin: 0 0 12px 0;
            font-size: 1rem;
            color: var(--cora-dark);
            font-weight: 700;
            padding-bottom: 6px;
            border-bottom: 1px solid rgba(15, 43, 43, 0.06);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 6px;
            color: var(--cora-dark);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 0.9rem;
            transition: border-color 0.2s;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: var(--cora-orange);
            box-shadow: 0 0 0 2px rgba(255, 123, 0, 0.1);
        }

        .table-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .table-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #eee;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        }

        .table-wrapper {
            flex: 1;
            overflow: auto; /* Scroll solo en la tabla */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1200px;
        }

        th, td {
            padding: 8px 10px;
            border-bottom: 1px solid #f2f2f2;
            text-align: center;
            font-size: 0.85rem;
        }

        thead th {
            background: linear-gradient(90deg, var(--cora-orange), #ff9a4a);
            color: white;
            font-weight: 700;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        thead tr:first-child th {
            background: linear-gradient(90deg, var(--cora-orange), #ff9a4a);
        }

        thead tr:nth-child(2) th {
            background: rgba(255, 154, 74, 0.9);
        }

        tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        tbody tr:hover {
            background-color: #f8f8f8;
        }

        .table-controls {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
            flex-shrink: 0; /* Evita que los controles se encojan */
        }

        .form-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
            margin-top: 10px;
            flex-shrink: 0; /* Evita que los botones se encojan */
        }

        footer {
            text-align: center;
            padding: 12px;
            color: var(--muted);
            font-size: 0.8rem;
            background: var(--card-bg);
            border-top: 1px solid #eee;
            flex-shrink: 0; /* Fija el footer */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .app-header {
                padding: 10px 15px;
            }
            
            .brand {
                margin-bottom: 8px;
            }
            
            .header-actions {
                width: 100%;
                justify-content: flex-end;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .table-controls, .form-actions {
                justify-content: center;
            }
            
            .btn {
                padding: 6px 10px;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 10px;
            }
            
            .form-container {
                padding: 15px;
            }
            
            .table-controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .table-controls .btn {
                width: 100%;
                justify-content: center;
            }
        }

        .copy-btn {
            background: #0f5660;
            color: white;
            border: none;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.75rem;
            margin: 2px;
            width: 100%;
        }

        .copy-btn:hover {
            background: #0d4a52;
        }

        .row-actions {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 100px;
        }
    </style>
</head>
<body>
    <header class="app-header">
        <div class="brand">
              <div style="flex:1; min-width:160px">
    <label for="Formularios">Formularios</label>
    <select id="Formularios">
      <option value="" disabled selected>Seleccione Formularios</option>
      <option value="dashboard">Panel</option>
      <option value="bpa1">bpa1</option>
      <option value="bpa2">bpa2</option>
      <option value="bpa3">bpa3</option>
      <option value="bpa4">bpa4</option>
    </select>
  </div>
            <div class="logo">
                <img src="/sistema-produccion/public/img/coraqua.png" alt="Logo CORAQUA">
            </div>
            <div class="title-col">
                <h1>CONTROL DIARIO DE PARÁMETROS</h1>
                <div class="meta">
                    <strong>CÓDIGO:</strong> CORAQUA-BPA 12 &nbsp;|&nbsp; <strong>VERSIÓN:</strong> 2.0 &nbsp;|&nbsp; <strong>FECHA:</strong> 03/08/2020
                </div>
            </div>
        </div>
        <div class="header-actions">
            <button class="btn ghost" id="volverBtn">◀️ Volver</button>
        </div>
    </header>

    <main class="main-container">
        <div class="form-container">
            <div class="section">
                <h3>DATOS GENERALES</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="mes">MES</label>
                        <input type="text" id="mes" name="mes" placeholder="Ejemplo: Enero" required>
                    </div>
                    <div>
                    <label for="sede">Sede</label>
                    <select id="sede" name="sede" required>
                        <option value="" disabled selected>Seleccione una sede</option>
                        <option value="Chichillapi">Chichillapi</option>
                        <option value="Cambruni">Cambruni</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="responsable">RESPONSABLE</label>
                        <input type="text" id="responsable" name="responsable" placeholder="Nombre del responsable" required>
                    </div>
                </div>
            </div>

            <div class="section table-section">
                <h3>CONTROL DE PARÁMETROS</h3>
                <div class="table-container">
                    <div class="table-wrapper">
                        <table id="tablaParametros">
                            <thead>
                                <tr>
                                    <th rowspan="2">DÍA</th>
                                    <th colspan="4">6:30 a.m.</th>
                                    <th colspan="4">12:00 m.</th>
                                    <th colspan="4">3:30 p.m.</th>
                                    <th rowspan="2">T° ACUM.</th>
                                    <th rowspan="2">OBS</th>
                                    <th rowspan="2">ACCIONES</th>
                                </tr>
                                <tr>
                                    <th>T° (°C)</th>
                                    <th>O₂ (mg/L)</th>
                                    <th>%SAT</th>
                                    <th>PH</th>
                                    <th>T° (°C)</th>
                                    <th>O₂ (mg/L)</th>
                                    <th>%SAT</th>
                                    <th>PH</th>
                                    <th>T° (°C)</th>
                                    <th>O₂ (mg/L)</th>
                                    <th>%SAT</th>
                                    <th>PH</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se generan dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-controls">
                    <button class="btn secondary" id="agregarFilaBtn">➕ Agregar fila</button>
                    <button class="btn secondary" id="agregarMultiplesBtn">➕ Agregar 5 filas</button>
                    <button class="btn ghost" id="quitarFilaBtn">➖ Quitar fila</button>
                    <button class="btn ghost" id="limpiarTablaBtn">🗑️ Limpiar tabla</button>
                </div>
            </div>

            <div class="form-actions">
                <button class="btn" id="guardarBtn">💾 Guardar</button>
                <button class="btn secondary" id="limpiarBtn">🧹 Limpiar</button>
            </div>
        </div>
    </main>

    <footer>
        CORAQUA © CONTROL DIARIO DE PARÁMETROS
    </footer>

    <script>
        const tbody = document.querySelector('#tablaParametros tbody');
        let currentDay = 1;

        // Inicializar la tabla con 5 filas al cargar
        document.addEventListener('DOMContentLoaded', function() {
            inicializarTabla(5);
            
            // Configurar eventos
            document.getElementById('volverBtn').addEventListener('click', volverPanel);
            document.getElementById('limpiarBtn').addEventListener('click', limpiarFormulario);
            document.getElementById('agregarFilaBtn').addEventListener('click', agregarFila);
            document.getElementById('agregarMultiplesBtn').addEventListener('click', () => agregarMultiplesFilas(5));
            document.getElementById('quitarFilaBtn').addEventListener('click', quitarFila);
            document.getElementById('limpiarTablaBtn').addEventListener('click', limpiarTabla);
            document.getElementById('guardarBtn').addEventListener('click', guardarDatos);
        });

        function inicializarTabla(numFilas) {
            tbody.innerHTML = '';
            currentDay = 1;
            for(let i = 0; i < numFilas; i++) {
                agregarFila();
            }
        }

        function crearFila(dia) {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td>${dia}</td>
                <td><input type="number" step="0.01" placeholder="T°" name="t_0630"></td>
                <td><input type="number" step="0.01" placeholder="O₂" name="o2_0630"></td>
                <td><input type="number" step="0.01" placeholder="%SAT" name="sat_0630"></td>
                <td><input type="number" step="0.01" placeholder="PH" name="ph_0630"></td>
                <td><input type="number" step="0.01" placeholder="T°" name="t_1200"></td>
                <td><input type="number" step="0.01" placeholder="O₂" name="o2_1200"></td>
                <td><input type="number" step="0.01" placeholder="%SAT" name="sat_1200"></td>
                <td><input type="number" step="0.01" placeholder="PH" name="ph_1200"></td>
                <td><input type="number" step="0.01" placeholder="T°" name="t_1530"></td>
                <td><input type="number" step="0.01" placeholder="O₂" name="o2_1530"></td>
                <td><input type="number" step="0.01" placeholder="%SAT" name="sat_1530"></td>
                <td><input type="number" step="0.01" placeholder="PH" name="ph_1530"></td>
                <td><input type="number" step="0.01" placeholder="T° Acum." name="t_acumulada"></td>
                <td><input type="text" placeholder="Observación" name="observacion"></td>
                <td class="row-actions">
                    <button type="button" class="copy-btn" onclick="copiarFilaAnterior(this)">⬆️ Anterior</button>
                    <button type="button" class="copy-btn" onclick="copiarFilaSiguiente(this)">⬇️ Siguiente</button>
                </td>
            `;
            return fila;
        }

        function agregarFila() {
            tbody.appendChild(crearFila(currentDay));
            currentDay++;
        }

        function agregarMultiplesFilas(cantidad) {
            for(let i = 0; i < cantidad; i++) {
                agregarFila();
            }
        }

        function quitarFila() {
            const filas = tbody.querySelectorAll("tr");
            if(filas.length > 1) {
                filas[filas.length - 1].remove();
                currentDay--;
            } else {
                alert('Debe quedar al menos una fila.');
            }
        }

        function limpiarTabla() {
            if(confirm('¿Está seguro de que desea limpiar toda la tabla? Se perderán todos los datos.')) {
                inicializarTabla(5);
            }
        }

        function limpiarFormulario() {
            if(confirm('¿Limpiar todo el formulario?')) {
                document.querySelectorAll('input').forEach(el => el.value = '');
                inicializarTabla(5);
            }
        }

        function volverPanel() {
            window.location.href = '/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
        }

        function copiarFilaAnterior(boton) {
            const filaActual = boton.closest('tr');
            const filaAnterior = filaActual.previousElementSibling;
            
            if (!filaAnterior) {
                alert('No hay fila anterior para copiar.');
                return;
            }
            
            const camposActual = filaActual.querySelectorAll('input');
            const camposAnterior = filaAnterior.querySelectorAll('input');
            
            for (let i = 0; i < camposActual.length; i++) {
                camposActual[i].value = camposAnterior[i].value;
            }
        }

        function copiarFilaSiguiente(boton) {
            const filaActual = boton.closest('tr');
            const filaSiguiente = filaActual.nextElementSibling;
            
            if (!filaSiguiente) {
                alert('No hay fila siguiente para copiar.');
                return;
            }
            
            const camposActual = filaActual.querySelectorAll('input');
            const camposSiguiente = filaSiguiente.querySelectorAll('input');
            
            for (let i = 0; i < camposActual.length; i++) {
                camposActual[i].value = camposSiguiente[i].value;
            }
        }

        function guardarDatos() {
            const datos = {
                mes: document.getElementById('mes').value,
                sede: document.getElementById('sede').value,
                responsable: document.getElementById('responsable').value,
                id_sede: 1,
                dia: [],
                t_0630: [], o2_0630: [], sat_0630: [], ph_0630: [],
                t_1200: [], o2_1200: [], sat_1200: [], ph_1200: [],
                t_1530: [], o2_1530: [], sat_1530: [], ph_1530: [],
                t_acumulada: [], observacion: []
            };

            // Validar datos generales
            if (!datos.mes || !datos.sede || !datos.responsable) {
                alert('Por favor complete todos los datos generales');
                return;
            }

            // Recoger datos de todas las filas
            const filas = tbody.querySelectorAll('tr');
            if (filas.length === 0) {
                alert('Debe agregar al menos una fila');
                return;
            }

            filas.forEach(fila => {
                const inputs = fila.querySelectorAll('input');
                datos.dia.push(parseInt(fila.cells[0].textContent));
                
                // 6:30 a.m.
                datos.t_0630.push(inputs[0].value || null);
                datos.o2_0630.push(inputs[1].value || null);
                datos.sat_0630.push(inputs[2].value || null);
                datos.ph_0630.push(inputs[3].value || null);
                
                // 12:00 m.
                datos.t_1200.push(inputs[4].value || null);
                datos.o2_1200.push(inputs[5].value || null);
                datos.sat_1200.push(inputs[6].value || null);
                datos.ph_1200.push(inputs[7].value || null);
                
                // 3:30 p.m.
                datos.t_1530.push(inputs[8].value || null);
                datos.o2_1530.push(inputs[9].value || null);
                datos.sat_1530.push(inputs[10].value || null);
                datos.ph_1530.push(inputs[11].value || null);
                
                // T° Acum. y Observación
                datos.t_acumulada.push(inputs[12].value || null);
                datos.observacion.push(inputs[13].value || '');
            });

            // Mostrar loading
            const guardarBtn = document.getElementById('guardarBtn');
            const originalText = guardarBtn.innerHTML;
            guardarBtn.innerHTML = '⏳ Guardando...';
            guardarBtn.disabled = true;

            // Enviar datos al servidor
            fetch('/sistema-produccion/public/index.php?controller=Ovas&action=guardarBPA4', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(datos)
            })
            .then(response => {
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    return response.text().then(text => {
                        throw new Error(`Respuesta no JSON: ${text.substring(0, 100)}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('✅ ' + data.message);
                    limpiarFormulario();
                } else {
                    alert('❌ Error: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('❌ Error al guardar los datos: ' + error.message);
            })
            .finally(() => {
                guardarBtn.innerHTML = originalText;
                guardarBtn.disabled = false;
            });
        }
        // ✅ Redirección al cambiar de formulario
document.getElementById('Formularios').addEventListener('change', function() {
  const val = this.value;
  if (!val) return;

  // Redirige según la opción seleccionada
  if (val === 'dashboard') {
    window.location.href = '/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
  } else {
    window.location.href = `/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/${val}.php`;
  }
});

    </script>
</body>
</html>
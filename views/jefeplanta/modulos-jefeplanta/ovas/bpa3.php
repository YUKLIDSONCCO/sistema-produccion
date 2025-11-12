<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MORTALIDAD DIARIA - LARVAS — CORAQUA</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --cora-orange: #ff7b00;
            --cora-dark: #0f2b2b;
            --bg-1: linear-gradient(135deg, #fffaf2 0%, #fff1e0 40%, #f6fbff 100%);
            --card-bg: rgba(255, 255, 255, 0.98);
            --muted: #6b6b6b;
            --accent: #0f5660;
            --radius: 12px;
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
            overflow: hidden;
        }

        body {
            display: flex;
            flex-direction: column;
            padding: 0;
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
            overflow: hidden;
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
            overflow: auto;
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

        .total-cell {
            background-color: #f9f9f9;
            font-weight: bold;
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

        .table-controls {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        textarea {
            width: 100%;
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 0.9rem;
            min-height: 80px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
            padding-top: 16px;
            border-top: 1px solid #f0f0f0;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            padding: 12px;
            color: var(--muted);
            font-size: 0.8rem;
            background: var(--card-bg);
            border-top: 1px solid #eee;
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
    </style>
</head>
<body>
    <header class="app-header">
        <div class="brand">
            <div class="logo">
                <img src="img/logo-coraqua.png" alt="Logo CORAQUA">
            </div>
            <div class="title-col">
                <h1>MORTALIDAD DIARIA - LARVAS</h1>
                <div class="meta">
                    <strong>CÓDIGO:</strong> CORAQUA-BPA 3 | <strong>VERSIÓN:</strong> 2.0
                </div>
            </div>
        </div>
        <div class="header-actions">
            <button class="btn ghost" id="volverBtn" type="button">◀️ Volver</button>
        </div>
    </header>

    <main class="main-container">
        <form id="formOvas" method="POST" class="form-container">
            <div class="section">
                <h3>DATOS GENERALES</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="encargado">ENCARGADO</label>
                        <input type="text" id="encargado" name="encargado" required>
                    </div>
                    <div class="form-group">
                        <label for="lote">LOTE</label>
                        <input type="text" id="lote" name="lote" required>
                    </div>
                    <div class="form-group">
                        <label for="sede">SEDE</label>
                        <input type="text" id="sede" name="sede" required>
                    </div>
                    <div class="form-group">
                        <label for="cantsiembra">CANT. SIEMBRA</label>
                        <input type="number" id="cantsiembra" name="cantidad_siembra" required>
                    </div>
                </div>
            </div>

            <div class="section" style="flex: 1; display: flex; flex-direction: column;">
                <h3>REGISTRO DIARIO DE MORTALIDAD</h3>
                <div class="table-container">
                    <div class="table-wrapper">
                        <table id="tablaLarvas">
                            <thead>
                                <tr>
                                    <th rowspan="2">FECHA</th>
                                    <th rowspan="2">BATERIA</th>
                                    <th rowspan="2">BATEA</th>
                                    <th colspan="2">C1</th>
                                    <th colspan="2">C2</th>
                                    <th colspan="2">C3</th>
                                    <th colspan="2">C4</th>
                                    <th colspan="2">C5</th>
                                    <th colspan="2">C6</th>
                                    <th colspan="2">C7</th>
                                    <th rowspan="2">TOTAL</th>
                                    <th rowspan="2">OBSERVACIONES</th>
                                    <th rowspan="2">ACCIONES</th>
                                </tr>
                                <tr>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                    <th>L.M.</th>
                                    <th>L.D.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas se generan dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="table-controls">
                    <button class="btn secondary" type="button" onclick="agregarFila()">➕ Agregar fila</button>
                    <button class="btn secondary" type="button" onclick="agregarMultiplesFilas(5)">➕ Agregar 5 filas</button>
                    <button class="btn ghost" type="button" onclick="eliminarFila()">➖ Quitar fila</button>
                    <button class="btn ghost" type="button" onclick="limpiarTabla()">🗑️ Limpiar tabla</button>
                </div>
            </div>

            <div class="section">
                <h3>OBSERVACIONES GENERALES</h3>
                <textarea id="observaciones" name="observacion"></textarea>
            </div>

            <input type="hidden" name="id_lote" value="1">
            <input type="hidden" name="id_sede" value="1">
            <input type="hidden" name="id_especie" value="1">
            <input type="hidden" name="responsable_area" value="Responsable Area">
            <input type="hidden" name="jefe_planta" value="Jefe Planta">
            <input type="hidden" name="jefe_produccion" value="Jefe Produccion">
            <input type="hidden" name="codigo_formato" value="CORAQUA-BPA3">
            <input type="hidden" name="version" value="2.0">

            <div class="form-actions">
                <button id="btnGuardar" class="btn" type="submit">💾 Guardar Datos</button>
                <button class="btn secondary" id="limpiarBtn" type="button">🧹 Limpiar</button>
            </div>
        </form>
    </main>

    <footer>
        CORAQUA © MORTALIDAD DIARIA DE LARVAS
    </footer>

    <script>
        // Inicializar la tabla con 5 filas al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            inicializarTabla(5);
            
            // Configurar el botón de volver
            document.getElementById('volverBtn').addEventListener('click', function() {
                window.history.back();
            });
            
            // Configurar el envío del formulario
            document.getElementById('formOvas').addEventListener('submit', async function(e) {
                e.preventDefault();
                
                const btn = document.getElementById('btnGuardar');
                btn.disabled = true;
                btn.textContent = 'Guardando...';

                try {
                    const formData = new FormData();

                    // Datos generales
                    ['encargado', 'lote', 'sede', 'cantidad_siembra', 'id_lote', 'id_sede', 'id_especie', 'responsable_area', 'jefe_planta', 'jefe_produccion', 'codigo_formato', 'version']
                        .forEach(id => {
                            const el = document.getElementById(id) || document.querySelector(`[name="${id}"]`);
                            formData.append(id, el?.value || '');
                        });
                    formData.append('observacion_general', document.getElementById('observaciones').value);

                    // Filas
                    const filas = document.querySelectorAll('#tablaLarvas tbody tr');
                    if (!filas.length) {
                        alert('Debe agregar al menos una fila');
                        btn.disabled = false;
                        btn.textContent = '💾 Guardar Datos';
                        return;
                    }

                    filas.forEach(f => {
                        f.querySelectorAll('input').forEach(inp => {
                            formData.append(inp.name, inp.value);
                        });
                    });

                    // Enviar al backend
                    const res = await fetch('/sistema-produccion/public/index.php?controller=Ovas&action=procesarBPA3', {
                        method: 'POST',
                        body: formData
                    });

                    const txt = await res.text();
                    console.log('Respuesta del servidor:', txt);

                    let data;
                    try {
                        data = JSON.parse(txt);
                    } catch (e) {
                        throw new Error('Respuesta del servidor no es JSON válido: ' + txt);
                    }

                    if (data.success) {
                        alert('✅ ' + data.message);
                        document.getElementById('formOvas').reset();
                        document.querySelector('#tablaLarvas tbody').innerHTML = '';
                        inicializarTabla(5);
                    } else {
                        alert('❌ Error: ' + (data.error || 'No se guardaron los datos'));
                    }

                } catch (err) {
                    console.error(err);
                    alert('❌ Error: ' + err.message);
                } finally {
                    btn.disabled = false;
                    btn.textContent = '💾 Guardar Datos';
                }
            });

            // BOTÓN LIMPIAR
            document.getElementById('limpiarBtn').addEventListener('click', () => {
                if (confirm('¿Limpiar todo el formulario?')) {
                    document.getElementById('formOvas').reset();
                    document.querySelector('#tablaLarvas tbody').innerHTML = '';
                    inicializarTabla(5);
                }
            });
        });

        // Inicializar la tabla con un número específico de filas
        function inicializarTabla(numFilas) {
            const tabla = document.querySelector('#tablaLarvas tbody');
            tabla.innerHTML = '';
            
            for (let i = 0; i < numFilas; i++) {
                agregarFila();
            }
        }

        // ✅ AGREGAR FILA (con nombres de inputs con [])
        function agregarFila() {
            const tbody = document.querySelector('#tablaLarvas tbody');
            const tr = document.createElement('tr');
            const fechaHoy = new Date().toISOString().split('T')[0];
            tr.innerHTML = `
                <td><input type="date" name="fecha_control[]" value="${fechaHoy}"></td>
                <td><input type="text" name="bateria[]" placeholder="Batería"></td>
                <td><input type="text" name="batea[]" placeholder="Batea"></td>
                ${[1, 2, 3, 4, 5, 6, 7].map(i => `
                    <td><input type="number" name="c${i}_lm[]" value="0" min="0" class="campo-mortalidad"></td>
                    <td><input type="number" name="c${i}_ld[]" value="0" min="0" class="campo-mortalidad"></td>
                `).join('')}
                <td><input type="number" name="total[]" value="0" min="0" readonly class="total-cell"></td>
                <td><input type="text" name="observacion[]" placeholder="Observaciones"></td>
                <td class="row-actions">
                    <button type="button" class="copy-btn" onclick="copiarFilaAnterior(this)">⬆️ Anterior</button>
                    <button type="button" class="copy-btn" onclick="copiarFilaSiguiente(this)">⬇️ Siguiente</button>
                </td>
            `;
            tbody.appendChild(tr);

            // Recalcula total automático
            tr.querySelectorAll('.campo-mortalidad').forEach(inp =>
                inp.addEventListener('input', () => calcularTotal(tr))
            );
        }

        // Agregar múltiples filas a la vez
        function agregarMultiplesFilas(cantidad) {
            for (let i = 0; i < cantidad; i++) {
                agregarFila();
            }
        }

        // ✅ ELIMINAR ÚLTIMA FILA
        function eliminarFila() {
            const tbody = document.querySelector('#tablaLarvas tbody');
            if (tbody.rows.length > 1) {
                tbody.deleteRow(-1);
            } else {
                alert('Debe quedar al menos una fila.');
            }
        }

        // Limpiar toda la tabla (manteniendo una fila)
        function limpiarTabla() {
            if (confirm('¿Está seguro de que desea limpiar toda la tabla? Se perderán todos los datos.')) {
                const tabla = document.querySelector('#tablaLarvas tbody');
                tabla.innerHTML = '';
                agregarFila();
            }
        }

        // ✅ CALCULAR TOTAL AUTOMÁTICO
        function calcularTotal(fila) {
            const nums = [...fila.querySelectorAll('.campo-mortalidad')]
                .map(i => parseInt(i.value || 0));
            fila.querySelector('input[name="total[]"]').value = nums.reduce((a, b) => a + b, 0);
        }

        // Copiar datos de la fila anterior
        function copiarFilaAnterior(boton) {
            const filaActual = boton.closest('tr');
            const filaAnterior = filaActual.previousElementSibling;
            
            if (!filaAnterior) {
                alert('No hay fila anterior para copiar.');
                return;
            }
            
            // Copiar todos los campos excepto el total
            const camposActual = filaActual.querySelectorAll('input:not(.total-cell)');
            const camposAnterior = filaAnterior.querySelectorAll('input:not(.total-cell)');
            
            for (let i = 0; i < camposActual.length; i++) {
                camposActual[i].value = camposAnterior[i].value;
            }
            
            // Recalcular el total para la fila actual
            calcularTotal(filaActual);
        }

        // Copiar datos de la fila siguiente
        function copiarFilaSiguiente(boton) {
            const filaActual = boton.closest('tr');
            const filaSiguiente = filaActual.nextElementSibling;
            
            if (!filaSiguiente) {
                alert('No hay fila siguiente para copiar.');
                return;
            }
            
            // Copiar todos los campos excepto el total
            const camposActual = filaActual.querySelectorAll('input:not(.total-cell)');
            const camposSiguiente = filaSiguiente.querySelectorAll('input:not(.total-cell)');
            
            for (let i = 0; i < camposActual.length; i++) {
                camposActual[i].value = camposSiguiente[i].value;
            }
            
            // Recalcular el total para la fila actual
            calcularTotal(filaActual);
        }
    </script>
</body>
</html>
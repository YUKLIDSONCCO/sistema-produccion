<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MORTALIDAD DIARIA - OVAS — CORAQUA</title>
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
            --header-height: 70px;
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
            height: var(--header-height);
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
            min-width: 900px;
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
                height: auto;
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
                <h1>MORTALIDAD DIARIA - OVAS</h1>
                <div class="meta">
                    <strong>CÓDIGO:</strong> CORAQUA-BPA 4 &nbsp;|&nbsp; 
                    <strong>VERSIÓN:</strong> 2.0 &nbsp;|&nbsp; 
                    <strong>FECHA:</strong> 03/08/2020
                </div>
            </div>
        </div>
        <div class="header-actions">
            <button class="btn ghost" id="volverBtn" type="button">◀️ Volver</button>
        </div>
    </header>

    <main class="main-container">
        <form id="formBPA2" method="POST" action="/sistema-produccion/public/index.php?controller=Ovas&action=guardarBPA2" class="form-container">
            <div class="section">
                <h3>DATOS GENERALES</h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="encargado">ENCARGADO</label>
                        <input type="text" id="encargado" name="encargado" placeholder="Nombre del encargado" required>
                    </div>
                    <div class="form-group">
                        <label for="lote">LOTE</label>
                        <input type="text" id="lote" name="lote" placeholder="Código de lote" required>
                    </div>
                    <div class="form-group">
                        <label for="sede">SEDE</label>
                        <input type="text" id="sede" name="sede" placeholder="Nombre de sede" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad_siembra">CANT. SIEMBRA</label>
                        <input type="number" id="cantidad_siembra" name="cantidad_siembra" placeholder="Cantidad" required>
                    </div>
                </div>
            </div>

            <div class="section" style="flex: 1; display: flex; flex-direction: column;">
                <h3>REGISTRO DIARIO DE MORTALIDAD</h3>
                <div class="table-container">
                    <div class="table-wrapper">
                        <table id="tablaMortalidad">
                            <thead>
                                <tr>
                                    <th>FECHA</th>
                                    <th>BAT.</th>
                                    <th>BATEA</th>
                                    <th>C1</th>
                                    <th>C2</th>
                                    <th>C3</th>
                                    <th>C4</th>
                                    <th>C5</th>
                                    <th>C6</th>
                                    <th>C7</th>
                                    <th>TOTAL</th>
                                    <th>OBSERVACIÓN</th>
                                    <th>ACCIONES</th>
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
                <textarea id="observaciones" name="observaciones" placeholder="Escriba comentarios u observaciones adicionales"></textarea>
            </div>

            <div class="form-actions">
                <button class="btn" type="submit">💾 Guardar</button>
                <button class="btn secondary" type="reset">🧹 Limpiar</button>
            </div>
        </form>
    </main>

    <footer>
        CORAQUA © MORTALIDAD DIARIA DE OVAS
    </footer>

    <script>
        // Inicializar la tabla con 5 filas al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            inicializarTabla(5);
            
            // Configurar el botón de volver
            document.getElementById('volverBtn').addEventListener('click', function() {
                window.location.href = '/sistema-produccion/views/jefeplanta/modulos-jefeplanta/ovas/dashboard.php';
            });
            
            // Configurar el envío del formulario
            document.getElementById('formBPA2').addEventListener('submit', async function(e) {
                e.preventDefault();
                
                // Validar que al menos una fila tenga datos
                if (!validarFormulario()) {
                    alert('⚠️ Debe ingresar al menos una fila con datos válidos.');
                    return;
                }
                
                const form = e.target;
                const data = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: data
                    });

                    if (response.ok) {
                        alert('✅ Registros guardados correctamente.');
                        location.reload();
                    } else {
                        alert('⚠️ Error al guardar los registros.');
                    }
                } catch (error) {
                    console.error(error);
                    alert('❌ Error de conexión con el servidor.');
                }
            });
        });

        // Inicializar la tabla con un número específico de filas
        function inicializarTabla(numFilas) {
            const tabla = document.querySelector('#tablaMortalidad tbody');
            tabla.innerHTML = '';
            
            for (let i = 0; i < numFilas; i++) {
                agregarFila();
            }
        }

        // Agregar una nueva fila a la tabla
        function agregarFila() {
            const tabla = document.querySelector('#tablaMortalidad tbody');
            const nuevaFila = document.createElement('tr');
            nuevaFila.className = 'fila-datos';
            
            // Obtener la fecha actual para la nueva fila
            const hoy = new Date();
            const fechaStr = hoy.toISOString().split('T')[0];
            
            nuevaFila.innerHTML = `
                <td><input type="date" name="fecha_control[]" value="${fechaStr}"></td>
                <td><input type="text" name="bateria[]" placeholder="Ej: B1"></td>
                <td><input type="text" name="batea[]" placeholder="Ej: A1"></td>
                <td><input type="number" name="c1[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="c2[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="c3[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="c4[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="c5[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="c6[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="c7[]" min="0" class="campo-mortalidad" onchange="calcularTotal(this)"></td>
                <td><input type="number" name="total[]" class="total-cell" readonly></td>
                <td><input type="text" name="observacion[]" placeholder="Observaciones"></td>
                <td class="row-actions">
                    <button type="button" class="copy-btn" onclick="copiarFilaAnterior(this)">⬆️ Anterior</button>
                    <button type="button" class="copy-btn" onclick="copiarFilaSiguiente(this)">⬇️ Siguiente</button>
                </td>
            `;
            
            tabla.appendChild(nuevaFila);
        }

        // Agregar múltiples filas a la vez
        function agregarMultiplesFilas(cantidad) {
            for (let i = 0; i < cantidad; i++) {
                agregarFila();
            }
        }

        // Eliminar la última fila
        function eliminarFila() {
            const tabla = document.querySelector('#tablaMortalidad tbody');
            if (tabla.rows.length > 1) {
                tabla.deleteRow(-1);
            } else {
                alert('Debe quedar al menos una fila.');
            }
        }

        // Limpiar toda la tabla (manteniendo una fila)
        function limpiarTabla() {
            if (confirm('¿Está seguro de que desea limpiar toda la tabla? Se perderán todos los datos.')) {
                const tabla = document.querySelector('#tablaMortalidad tbody');
                tabla.innerHTML = '';
                agregarFila(); // Agregar una fila vacía
            }
        }

        // Calcular el total de mortalidad para una fila
        function calcularTotal(input) {
            const fila = input.closest('tr');
            const campos = fila.querySelectorAll('.campo-mortalidad');
            let total = 0;
            
            campos.forEach(campo => {
                const valor = parseInt(campo.value) || 0;
                total += valor;
            });
            
            fila.querySelector('input[name="total[]"]').value = total;
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
            calcularTotal(camposActual[3]); // Usar el primer campo de mortalidad
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
            calcularTotal(camposActual[3]); // Usar el primer campo de mortalidad
        }

        // Validar que al menos una fila tenga datos
        function validarFormulario() {
            const filas = document.querySelectorAll('#tablaMortalidad tbody tr');
            
            for (let fila of filas) {
                const fecha = fila.querySelector('input[name="fecha_control[]"]').value;
                const bateria = fila.querySelector('input[name="bateria[]"]').value;
                const batea = fila.querySelector('input[name="batea[]"]').value;
                
                // Si al menos una fila tiene datos básicos, el formulario es válido
                if (fecha || bateria || batea) {
                    return true;
                }
            }
            
            return false;
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
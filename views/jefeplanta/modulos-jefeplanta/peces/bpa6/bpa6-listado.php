<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Listado — Mortalidad Diaria de Alevinos (BPA 6)</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #fffaf2, #ffd9b3 70%);
      margin: 0;
      padding: 30px 16px;
      color: #333;
    }
    .container {
      max-width: 1200px;
      margin: 20px auto;
      background: #fff;
      border-radius: 14px;
      padding: 28px 32px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
      border-top: 7px solid #ff7b00;
    }
    h1 {
      text-align: center;
      color: #0f2b2b;
      margin-bottom: 10px;
    }
    .subtitle {
      text-align: center;
      color: #666;
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border: 1px solid #eee;
      padding: 8px;
      text-align: center;
    }
    th {
      background: #ff7b00;
      color: white;
      font-weight: 600;
    }
    tbody tr:nth-child(even) {
      background: #fff8f0;
    }
    .actions {
      margin-top: 20px;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 10px;
    }
    .btn {
      background: #ff7b00;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 600;
    }
    .btn:hover { background: #e66e00; transform: translateY(-2px); }
    .btn.secondary {
      background: #fff;
      color: #ff7b00;
      border: 2px solid #ff7b00;
    }
    .btn.secondary:hover {
      background: #ff7b00;
      color: #fff;
    }
    .muted {
      text-align: center;
      color: #999;
      font-size: 0.9rem;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Listado — Mortalidad Diaria de Alevinos (BPA 6)</h1>
    <div class="subtitle">Registros simulados (sin base de datos)</div>

    <table id="tablaListado">
      <thead>
        <tr>
          <th>#</th>
          <th>Fecha</th>
          <th>Responsable</th>
          <th>Sede</th>
          <th>Especie</th>
          <th>UP</th>
          <th>Lote</th>
          <th>Mortalidad</th>
          <th>Morbilidad</th>
          <th>Total</th>
          <th>Observaciones</th>
        </tr>
      </thead>
      <tbody>
        <!-- se llena dinámicamente -->
      </tbody>
    </table>

    <div class="muted">Aquí verás los datos simulados que hayas “guardado” en el formulario BPA 6.</div>

    <div class="actions">
      <button class="btn" onclick="descargarExcel()">⬇️ Descargar Excel</button>
      <div>
        <button class="btn secondary" onclick="volverFormulario()">⬅️ Volver al Formulario</button>
      </div>
    </div>
  </div>

  <script>
    // Simular carga de datos guardados (del localStorage o vacío)
    const registros = JSON.parse(localStorage.getItem('bpa6_registros') || '[]');

    const tbody = document.querySelector('#tablaListado tbody');

    if (registros.length === 0) {
      const tr = document.createElement('tr');
      tr.innerHTML = `<td colspan="11">No hay registros guardados (simulado).</td>`;
      tbody.appendChild(tr);
    } else {
      registros.forEach((r, i) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${i + 1}</td>
          <td>${r.fechaForm}</td>
          <td>${r.responsable}</td>
          <td>${r.sede}</td>
          <td>${r.especie}</td>
          <td>${r.filas[0]?.up || '-'}</td>
          <td>${r.filas[0]?.lote || '-'}</td>
          <td>${r.filas[0]?.mort || 0}</td>
          <td>${r.filas[0]?.morb || 0}</td>
          <td>${r.filas[0]?.total || 0}</td>
          <td>${r.filas[0]?.obs || ''}</td>
        `;
        tbody.appendChild(tr);
      });
    }

    function descargarExcel() {
      alert('📥 Simulando descarga del listado en Excel...');
      // Aquí podrías integrar SheetJS para exportar la tabla real.
    }

    function volverFormulario() {
      window.location.href = 'index.php?controller=Peces&action=bpa6';
    }
  </script>
</body>
</html>

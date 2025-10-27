<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>FORMATO N°11 - CONTEO Y VENTA DE PECES (CORAQUA BPA 11)</title>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root{
      --orange:#ff7b00;
      --orange-dark:#e66e00;
      --bg-start:#fffaf2;
      --bg-end:#ffd9b3;
      --card-bg:#fff;
      --muted:#666;
      --accent-shadow:rgba(255,123,0,0.22);
      --rounded:12px;
      --excel:#28a745;
      --pdf:#dc3545;
      --blue:#007bff;
    }

    *{ box-sizing:border-box; font-family:'Poppins','Segoe UI',sans-serif; }

    body{
      margin:0;
      min-height:100vh;
      background: linear-gradient(135deg,var(--bg-start),var(--bg-end));
      color:#222;
      display:flex;
    }

    /* SIDEBAR */
    .sidebar{
      width:260px;
      background: linear-gradient(180deg,#fff6f0,#fff0e6);
      border-right:1px solid rgba(0,0,0,0.05);
      height:100vh; position:fixed; left:0; top:0;
      padding:18px; box-shadow:4px 0 18px rgba(0,0,0,0.06);
      display:flex; flex-direction:column; gap:12px; z-index:120;
    }
    .sidebar .logo{ display:flex; align-items:center; gap:10px; padding-bottom:6px; border-bottom:1px solid rgba(0,0,0,0.04); }
    .sidebar .logo i{
      background: radial-gradient(circle at 30% 30%, var(--orange), var(--orange-dark));
      color:white; width:44px; height:44px; display:grid; place-items:center; border-radius:10px; font-size:18px;
      box-shadow:0 6px 18px var(--accent-shadow);
    }
    .sidebar .logo span{ font-weight:700; color:var(--orange-dark); font-size:14px; }
    .sidebar-nav{ margin-top:8px; flex:1; overflow:auto; }
    .sidebar-nav ul{ list-style:none; padding:0; margin:0; }
    .sidebar-nav li{ margin-bottom:6px; }
    .sidebar-nav a{
      display:flex; align-items:center; gap:12px; padding:10px 12px; border-radius:10px; color:#3b3b3b;
      text-decoration:none; transition: all .18s ease; font-weight:600; font-size:14px;
    }
    .sidebar-nav a:hover, .sidebar-nav a.active{
      background: linear-gradient(90deg,var(--orange),var(--orange-dark)); color:#fff; box-shadow:0 8px 20px rgba(230,110,0,0.12);
    }
    .sidebar-footer{ font-size:12px; color:var(--muted); text-align:center; padding-top:8px; border-top:1px solid rgba(0,0,0,0.03); }

    /* MAIN */
    .main{ margin-left:290px; padding:36px; width: calc(100% - 290px); }
    .card{
      background:var(--card-bg); border-radius:var(--rounded); padding:28px;
      box-shadow:0 8px 30px rgba(0,0,0,0.06); border-top:6px solid var(--orange); animation:fadeIn .6s ease;
    }
    @keyframes fadeIn{ from{opacity:0; transform:translateY(8px);} to{opacity:1; transform:translateY(0);} }

    header.top{ display:flex; gap:20px; align-items:center; justify-content:space-between; flex-wrap:wrap; margin-bottom:18px; }
    .brand{ display:flex; gap:18px; align-items:center; }
    .brand img{ width:86px; height:86px; object-fit:contain; border-radius:10px; background:linear-gradient(135deg,#fff,#fff4ea); padding:8px; box-shadow:0 8px 20px rgba(255,123,0,0.06); }
    .title{text-align:center; flex:1;}
    .title h1{ margin:0; font-size:18px; color:var(--orange-dark); font-weight:700; }
    .title p{ margin:6px 0 0; font-size:13px; color:var(--muted); }
    .meta-box{ background:#fff8f2; border:1px solid rgba(255,123,0,0.08); padding:10px 12px; border-radius:8px; font-size:13px; text-align:right; min-width:200px; }

    /* WIZARD */
    .wizard{ display:flex; justify-content:center; gap:72px; margin:8px 0 18px; }
    .step{ display:flex; flex-direction:column; align-items:center; cursor:pointer; position:relative; }
    .step .circle{ width:46px;height:46px;border-radius:50%; background:#eee;color:#fff;display:grid;place-items:center;font-weight:700;font-size:16px; transition:all .25s; box-shadow:0 6px 16px rgba(0,0,0,0.04); }
    .step .label{ margin-top:8px; font-weight:600; color:#666; font-size:13px; text-align:center; }
    .step.active .circle{ background:var(--orange); box-shadow:0 0 14px rgba(255,123,0,0.22); }
    .step.active .label{ color:var(--orange-dark); }
    .step:not(:last-child)::after{ content:""; position:absolute; right:-60px; top:22px; width:120px;height:3px;background:#f0d9c2;border-radius:4px; z-index:0; }
    .wizard-content{ display:none; text-align:center; margin-bottom:18px; }
    .wizard-content.active{ display:block; }
    .download-btn{ background:var(--orange); color:white; border:none; padding:10px 14px; border-radius:8px; cursor:pointer; font-weight:700; transition:all .18s; }
    .download-btn:hover{ background:var(--orange-dark); }

    /* FORM */
    .meta{ display:flex; flex-wrap:wrap; gap:12px; margin-top:8px; }
    .meta div{ flex:1 1 45%; }
    label{ display:block; font-weight:600; font-size:13px; color:#333; margin-bottom:6px; }
    input[type="text"], input[type="date"], input[type="time"], input[type="number"] { width:100%; padding:9px 10px; border-radius:8px; border:1px solid #e6e6e6; font-size:14px; background:transparent; }
    input:focus{ outline:none; box-shadow:0 6px 18px rgba(255,123,0,0.08); border-color:var(--orange); }

    /* BUTTONS PANEL */
    .botones-panel{ display:flex; gap:10px; flex-wrap:wrap; margin:14px 0; }
    .botones-panel button{ display:flex; align-items:center; gap:8px; padding:8px 12px; border-radius:8px; border:none; cursor:pointer; font-weight:700; }
    .btn-excel{ background:var(--excel); color:#fff; box-shadow:0 8px 20px rgba(40,167,69,0.12); }
    .btn-pdf{ background:var(--pdf); color:#fff; box-shadow:0 8px 20px rgba(220,53,69,0.12); }
    .btn-guardar{ background:var(--blue); color:#fff; box-shadow:0 8px 20px rgba(0,123,255,0.12); }
    .btn-ghost{ background:#fff; border:1px solid rgba(0,0,0,0.06); color:#333; }

    /* TABLE */
    .table-wrap{ margin-top:8px; overflow:auto; border-radius:10px; border:1px solid rgba(0,0,0,0.04); }
    table{ width:100%; border-collapse:collapse; min-width:1000px; background:transparent; }
    thead th{
      position:sticky; top:0; z-index:2; background: linear-gradient(90deg,var(--orange),var(--orange-dark));
      color:white; font-weight:700; padding:10px; text-align:center; font-size:13px;
    }
    tbody td{ border-bottom:1px solid #f0e6dc; padding:8px 10px; text-align:center; vertical-align:middle; font-size:14px; background:#fffceb; }
    tbody tr:nth-child(even) td{ background:#fff7ea; }
    td input{ width:100%; padding:6px 8px; border-radius:6px; border:1px solid #e6d9ce; text-align:center; font-weight:600; }
    td input:focus{ box-shadow:0 6px 18px rgba(255,123,0,0.06); border-color:var(--orange); background:#fff; }

    .table-actions{ display:flex; justify-content:flex-end; gap:10px; margin-top:12px; }
    footer{ text-align:center; margin-top:18px; color:var(--muted); font-size:13px; }

    @media (max-width:980px){
      .sidebar{ display:none; }
      .main{ margin-left:0; width:100%; padding:18px; }
      .brand img{ width:64px; height:64px; }
      .wizard{ gap:28px; }
      table{ min-width:700px; }
    }
  </style>
</head>
<body>
  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <div class="logo">
      <i class="fas fa-fish"></i>
      <div>
        <div style="font-size:13px;color:#444;font-weight:700">Panel Peces</div>
        <div style="font-size:12px;color:var(--muted)">CORAQUA</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <ul>
        <li><a href="index.php?controller=JefePlanta&action=dashboard"><i class="fa-solid fa-th-large fa-fw"></i> Dashboard</a></li>
        <li><a href="index.php?controller=JefePlanta&action=moduloPeces"><i class="fa-solid fa-layer-group fa-fw"></i> Panel Peces</a></li>
        <li><a class="active" href="#"><i class="fa-solid fa-clipboard-list fa-fw"></i> BPA 11 - Conteo y Venta</a></li>
        <li><a href="#"><i class="fa-solid fa-sign-out-alt fa-fw"></i> Salir</a></li>
      </ul>
    </nav>

    <div class="sidebar-footer">
      &copy; CORAQUA 2025
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">
    <div class="card" role="main">
      <header class="top" aria-label="Encabezado del formato">
        <div class="brand">
          <img src="/ruta/a/logo_coraqua.png" alt="Logo Coraqua" onerror="this.style.display='none'">
        </div>

        <div class="title">
          <h1>FORMATO N°11 - CONTEO Y VENTA DE PECES (CORAQUA BPA 11)</h1>
          <p><strong>CÓDIGO:</strong> CORAQUA BPA 11 | <strong>REVISIÓN:</strong> 2.0 | <strong>FECHA:</strong> 03/08/2020</p>
        </div>

        <div class="meta-box">
          <div style="font-weight:700; color:var(--orange-dark)">Registro</div>
          <div style="font-size:12px; color:var(--muted)">Conteo y Venta</div>
        </div>
      </header>

      <!-- WIZARD -->
      <div class="wizard" role="tablist" aria-label="Opciones de descarga">
        <div class="step active" onclick="mostrarPaso(1)">
          <div class="circle">1</div>
          <div class="label">Semanal</div>
        </div>

        <div class="step" onclick="mostrarPaso(2)">
          <div class="circle">2</div>
          <div class="label">Mensual</div>
        </div>

        <div class="step" onclick="mostrarPaso(3)">
          <div class="circle">3</div>
          <div class="label">Anual</div>
        </div>
      </div>

      <div id="contenido1" class="wizard-content active">
        <p style="margin:0 0 10px">📅 Descargar reporte semanal en formato Excel:</p>
        <button class="download-btn" onclick="descargarExcel('semana')">Descargar Excel Semanal</button>
      </div>

      <div id="contenido2" class="wizard-content">
        <p style="margin:0 0 10px">🗓️ Descargar reporte mensual en formato Excel:</p>
        <button class="download-btn" onclick="descargarExcel('mes')">Descargar Excel Mensual</button>
      </div>

      <div id="contenido3" class="wizard-content">
        <p style="margin:0 0 10px">📊 Descargar reporte anual en formato Excel:</p>
        <button class="download-btn" onclick="descargarExcel('anio')">Descargar Excel Anual</button>
      </div>

      <!-- META (mantengo campos originales) -->
      <section class="meta" aria-label="Información general">
        <div>
          <label for="mes">Mes:</label>
          <input id="mes" type="text" name="mes" placeholder="Ejemplo: Octubre">
        </div>
      </section>

      <!-- BOTONES DE ACCIÓN (Excel / PDF) -->
      <div class="botones-panel" role="toolbar" aria-label="Botones de acciones">
        <button class="btn-excel" id="btnExcelSemana" onclick="descargarExcel('semana')">
          📅 <i class="fa-solid fa-calendar-week"></i> Semana (Excel)
        </button>

        <button class="btn-excel" id="btnExcelMes" onclick="descargarExcel('mes')">
          🗓️ <i class="fa-solid fa-calendar-alt"></i> Mes (Excel)
        </button>

        <button class="btn-excel" id="btnExcelAnio" onclick="descargarExcel('anio')">
          📆 <i class="fa-solid fa-calendar"></i> Año (Excel)
        </button>

        <button class="btn-pdf" id="btnPDF" onclick="generarPDF()">
          🧾 <i class="fa-solid fa-file-pdf"></i> PDF
        </button>
      </div>

      <!-- TABLA (mantuve exactamente los mismos campos) -->
      <div class="table-wrap" role="region" aria-label="Tabla Conteo y Venta">
        <table id="tablaVenta">
          <thead>
            <tr>
              <th>FECHA DE CONTEO</th>
              <th>FECHA DE ENTREGA</th>
              <th>CANTIDAD</th>
              <th>CARGA</th>
              <th>SUB CANT.</th>
              <th>LOTE</th>
              <th>PROVEEDOR</th>
              <th>TALLA (cm)</th>
              <th>PESO (g)</th>
              <th>CLIENTE / EMPRESA</th>
              <th>LUGAR DE ENTREGA</th>
              <th>OBSERVACIÓN</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><input type="date" name="fecha_conteo_1"></td>
              <td><input type="date" name="fecha_entrega_1"></td>
              <td><input type="number" name="cantidad_1"></td>
              <td><input type="text" name="carga_1"></td>
              <td><input type="number" name="subcant_1"></td>
              <td><input type="text" name="lote_1"></td>
              <td><input type="text" name="proveedor_1"></td>
              <td><input type="number" name="talla_1"></td>
              <td><input type="number" name="peso_1"></td>
              <td><input type="text" name="cliente_1"></td>
              <td><input type="text" name="lugar_1"></td>
              <td><input type="text" name="observacion_1"></td>
            </tr>

            <tr>
              <td><input type="date" name="fecha_conteo_2"></td>
              <td><input type="date" name="fecha_entrega_2"></td>
              <td><input type="number" name="cantidad_2"></td>
              <td><input type="text" name="carga_2"></td>
              <td><input type="number" name="subcant_2"></td>
              <td><input type="text" name="lote_2"></td>
              <td><input type="text" name="proveedor_2"></td>
              <td><input type="number" name="talla_2"></td>
              <td><input type="number" name="peso_2"></td>
              <td><input type="text" name="cliente_2"></td>
              <td><input type="text" name="lugar_2"></td>
              <td><input type="text" name="observacion_2"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- BOTONES INFERIORES -->
      <div class="table-actions">
        <button class="btn-ghost" onclick="volverAtras()">⬅️ Volver Atrás</button>
        <button class="btn-guardar" onclick="verListado()">📖 Ver Listado</button>
        <button class="btn-guardar" id="guardarBtn" onclick="guardarDatos()">💾 Guardar</button>
      </div>

      <footer>
        CORAQUA © 2025 - Conteo y Venta de Peces
      </footer>
    </div>
  </main>

  <script>
    // WIZARD
    function mostrarPaso(n){
      const steps = document.querySelectorAll('.step');
      const contents = document.querySelectorAll('.wizard-content');
      steps.forEach((s,i) => i===n-1 ? s.classList.add('active') : s.classList.remove('active'));
      contents.forEach((c,i) => c.classList.toggle('active', i===n-1));
    }

    // Descarga simulada - puedes integrar SheetJS si quieres export real
    function descargarExcel(tipo){
      let archivo = '';
      switch(tipo){
        case 'semana': archivo = 'ConteoVenta_Semanal.xlsx'; break;
        case 'mes': archivo = 'ConteoVenta_Mensual.xlsx'; break;
        case 'anio': archivo = 'ConteoVenta_Anual.xlsx'; break;
        default: archivo = 'ConteoVenta_Report.xlsx';
      }
      alert(`📂 Generando y descargando ${archivo}...`);
    }

    // Generar PDF (simulado) - integrar librería si deseas PDF real
    function generarPDF(){
      alert('📄 Generando PDF... (si quieres un PDF real, puedo integrar jsPDF o backend)');
    }

    // Ver listado
    function verListado(){
      const rows = document.querySelectorAll('#tablaVenta tbody tr').length;
      alert(`📅 Mostrando listado — ${rows} fila(s) en la tabla.`);
    }

    // Volver atras
    function volverAtras(){
      if(window.history.length > 1) window.history.back();
      else alert('No hay historial de navegación.');
    }

    // Guardar con confirmación
    function guardarDatos(){
      // Recolectar mínimo para confirmar: no cambiaré datos ni validaciones complejas
      const rows = Array.from(document.querySelectorAll('#tablaVenta tbody tr')).map((tr, idx) => {
        // sólo para registro local, no envío
        const inputs = tr.querySelectorAll('input');
        const values = Array.from(inputs).map(i => i.value);
        return values;
      });

      // Mostrar confirmación
      if(!confirm('¿Deseas guardar los datos ingresados?')) return;

      // Simular petición
      console.log({ rows });
      setTimeout(() => {
        alert('✅ Registro guardado correctamente.');
      }, 250);
    }

    // Inicializar (por ejemplo, podría llenarse fecha hoy si se requiere)
    (function init(){
      // No modifico campos por defecto para respetar tu estructura.
    })();
  </script>
</body>
</html>

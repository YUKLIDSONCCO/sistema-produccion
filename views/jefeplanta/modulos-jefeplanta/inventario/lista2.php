<?php
// Verificar si hay datos y definir $fechaBusqueda
$fechaBusqueda = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Listado Diario — Control de Sal</title>
<style>
  *{box-sizing:border-box;font-family:"Poppins","Segoe UI",sans-serif;}
  body{
    margin:0;
    background:linear-gradient(135deg,#fffaf2,#ffd9b3 60%);
    color:#333;
    padding:30px 16px;
    min-height:100vh;
  }
  .container{
    max-width:1100px;
    margin:auto;
    background:#fff;
    border-radius:14px;
    padding:28px 32px;
    box-shadow:0 8px 24px rgba(0,0,0,0.12);
    border-top:7px solid #ff7b00;
    animation:fadeIn .6s ease;
  }
  @keyframes fadeIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:none}}
  h1{text-align:center;color:#ff7b00;font-size:1.6rem;margin-bottom:20px;}
  .search-bar{
    display:flex;justify-content:center;align-items:center;gap:10px;margin-bottom:20px;flex-wrap:wrap;
  }
  input[type="date"]{
    padding:8px 10px;border-radius:8px;border:1px solid #ccc;font-size:1rem;
  }
  button, .btn{
    background:#ff7b00;color:#fff;border:none;padding:10px 16px;border-radius:8px;
    cursor:pointer;font-weight:600;transition:all .2s;text-decoration:none;display:inline-block;
  }
  button:hover, .btn:hover{background:#e66e00;transform:translateY(-2px);}
  table{width:100%;border-collapse:collapse;margin-top:20px;}
  th,td{border:1px solid #e6e6e6;padding:8px;text-align:center;font-size:0.95rem;}
  th{background:#ff7b00;color:#fff;}
  tr:nth-child(even){background:#fff8f0;}
  .back-btn{margin-top:20px;display:inline-block;text-decoration:none;background:#fff;color:#ff7b00;
    border:2px solid #ff7b00;padding:10px 14px;border-radius:10px;font-weight:700;}
  .back-btn:hover{background:#ff7b00;color:#fff;}
  footer{text-align:center;margin-top:30px;color:#666;font-size:0.9rem;}
</style>
</head>
<body>

<div class="container">
  <h1>📅 Listado Diario — Control de Sal en Almacén</h1>

  <!-- Buscador por fecha -->
  <form method="GET" class="search-bar" action="/sistema-produccion/public/index.php">
    <input type="hidden" name="controller" value="Inventario">
    <input type="hidden" name="action" value="listarBPA2">

    <label for="fecha"><strong>Seleccionar fecha:</strong></label>
    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fechaBusqueda); ?>" required>
    <button type="submit">🔍 Buscar</button>

    <!-- ✅ Botón "Ver todo" que muestra todos los registros -->
    <a href="/sistema-produccion/public/index.php?controller=Inventario&action=listarBPA2&ver_todo=1" class="btn">📋 Ver todo</a>
  </form>

  <!-- Tabla de registros -->
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>FECHA</th>
        <th>CANTIDAD</th>
        <th>NOMBRE</th>
        <th>OBS</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($datos)): ?>
        <?php $i=1; foreach ($datos as $row): ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
            <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
            <td><?php echo htmlspecialchars($row['obs']); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5">❌ No hay registros para esta fecha.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- ✅ Este botón ahora lleva correctamente al formulario principal -->
  <a href="/sistema-produccion/public/index.php?controller=Inventario&action=bpa2" class="back-btn">⬅️ Volver Atrás</a>

  <footer>CORAQUA © 2025 — Listado Diario de Control de Sal</footer>
</div>

</body>
</html>

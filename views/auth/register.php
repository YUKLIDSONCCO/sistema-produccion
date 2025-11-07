<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrar Nuevo Usuario</title>
  <link rel="stylesheet" href="/sistema-produccion/public/css/style_login.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap"
    rel="stylesheet"
  />
</head>
<body>
  <?php
  if (session_status() === PHP_SESSION_NONE) session_start();

  // Solo puede acceder el Administrador
  if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Administrador') {
      header("Location: index.php?controller=Auth&action=login");
      exit;
  }
  ?>

  <div class="container" id="container">
    <div class="sign-up" style="width: 100%;">
  <form method="POST" action="index.php?controller=Admin&action=registrarUsuario">
    <h1>Registrar Usuario</h1>
    <span>Solo el administrador puede crear cuentas nuevas</span>
    
    <!-- AGREGAR ESTE MENSAJE INFORMATIVO -->
    <div style="background: #fff3cd; border: 1px solid #ffeaa7; padding: 10px; border-radius: 5px; margin: 10px 0;">
      <strong>Nota:</strong> Los nuevos usuarios quedarán en estado "suspendido" hasta que el administrador los active.
    </div>

    <input type="text" name="nombre" placeholder="Nombre completo" required />
    <input type="email" name="correo" placeholder="Correo" required />
    <input type="password" name="password" placeholder="Contraseña" required />

    <select name="rol" required>
      <option value="">-- Selecciona un rol --</option>
      <option value="4">Administrador</option>
      <option value="2">Jefe Planta</option>
      <option value="3">Supervisor</option>
    </select>

    <button type="submit">Registrar</button>
  </form>
</div>
  </div>

  <script src="/sistema-produccion/public/js/script_login.js"></script>
</body>
</html>

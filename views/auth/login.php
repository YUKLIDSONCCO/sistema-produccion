<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mostrar mensaje de error
if (isset($_SESSION['error'])) {
    echo '<div style="
        background-color: #ffdddd;
        color: #a94442;
        border: 1px solid #f5c6cb;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        text-align: center;
    ">'
    . htmlspecialchars($_SESSION['error']) .
    '</div>';
    unset($_SESSION['error']); // limpiar después de mostrarlo
}

// Mostrar mensaje de éxito
if (isset($_SESSION['success'])) {
    echo '<div style="
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        text-align: center;
    ">'
    . htmlspecialchars($_SESSION['success']) .
    '</div>';
    unset($_SESSION['success']); // limpiar después de mostrarlo
}

// Mostrar mensajes de éxito o error
if (isset($_SESSION['success'])) {
    echo '<div style="background: #d4edda; color: #155724; padding: 10px; margin: 10px; border-radius: 5px; text-align: center;">' . $_SESSION['success'] . '</div>';
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo '<div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px; border-radius: 5px; text-align: center;">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema Producción - Login</title>
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
  <div class="container" id="container">
    <div class="sign-up">
      <form method="POST" action="index.php?controller=Auth&action=register" id="registroForm">
        <h1>Crear Cuenta</h1>
        <span>Usa tu correo para registrarte</span>
        <input type="text" name="nombre" placeholder="Nombre completo" required />
        <input type="email" name="correo" placeholder="Correo" required />
        <input type="password" name="password" placeholder="Contraseña" required />
        
        <!-- AGREGAR SELECT DE ROLES -->
        <select name="rol" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 8px;">
          <option value="">-- Selecciona tu rol --</option>
          <option value="2">Jefe Planta</option>
          <option value="3">Supervisor</option>
          <option value="4">Colaborador</option>
        </select>
        <label for="foto">Sube una foto nítida de tu rostro:</label>
<input type="file" name="foto" id="foto" accept="image/*" capture="user" required 
       style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 8px;" />

        
        <button type="submit">Registrarse</button>
        <div id="mensajeRegistro" style="margin-top: 10px;"></div>
      </form>
    </div>

    <div class="sign-in">
      <form method="POST" action="index.php?controller=Auth&action=login">
        <h1>Iniciar Sesión</h1>
        <span>Accede con tu cuenta</span>
        <input type="email" name="correo" placeholder="Correo" required />
        <input type="password" name="password" placeholder="Contraseña" required />
        <a href="#">¿Olvidaste tu contraseña?</a>
        <button type="submit">Ingresar</button>
      </form>
    </div>

    <div class="toogle-container">
      <div class="toogle">
        <div class="toogle-panel toogle-left">
          <h1>Bienvenido de nuevo!</h1>
          <p>Si ya tienes cuenta, inicia sesión aquí</p>
          <button class="hidden" id="login">Iniciar Sesión</button>
        </div>
        <div class="toogle-panel toogle-right">
          <h1>¡Hola!</h1>
          <p>Si aún no tienes cuenta, regístrate aquí</p>
          <button class="hidden" id="register">Registrarse</button>
        </div>
      </div>
    </div>
  </div>

  <script src="/sistema-produccion/public/js/script_login.js"></script>
  <script>
  // AJAX para el formulario de registro
  document.getElementById('registroForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(this);
      const mensajeDiv = document.getElementById('mensajeRegistro');
      const button = this.querySelector('button[type="submit"]');
      
      // Mostrar loading
      button.innerHTML = 'Registrando...';
      button.disabled = true;
      
      fetch(this.action, {
          method: 'POST',
          body: formData
      })
      .then(response => {
          if (response.redirected) {
              // Si hay redirección, recargar la página para mostrar mensajes de sesión
              window.location.href = response.url;
          } else {
              return response.text();
          }
      })
      .then(data => {
          if (data) {
              // Si hay datos, mostrar mensaje
              if (data.includes('éxito') || data.includes('success')) {
                  mensajeDiv.innerHTML = '<div style="color: green; background: #d4edda; padding: 10px; border-radius: 5px;">✅ Registro exitoso. Tu cuenta está pendiente de activación.</div>';
                  this.reset();
              } else {
                  mensajeDiv.innerHTML = '<div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px;">❌ ' + data + '</div>';
              }
          }
      })
      .catch(error => {
          mensajeDiv.innerHTML = '<div style="color: red; background: #f8d7da; padding: 10px; border-radius: 5px;">❌ Error en el registro</div>';
      })
      .finally(() => {
          button.innerHTML = 'Registrarse';
          button.disabled = false;
      });
  });
  </script>
</body>
</html>

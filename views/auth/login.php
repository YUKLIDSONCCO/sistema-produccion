<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema Producción - Login</title>
  <link rel="stylesheet" href="style.css" />
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
    <style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  background-color: #c9d6ff;
  background: linear-gradient(to right, #e2e2e2, #c9d6ff);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  height: 100vh;
}

.container {
  background-color: #fff;
  border-radius: 150px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
  position: relative;
  overflow: hidden;
  width: 768px;
  max-width: 100%;
  min-height: 480px;
}

.container p {
  font-size: 14px;
  line-height: 20px;
  letter-spacing: 0.3px;
  margin: 20px 0;
}


.container span {
  font-size: 12px;
}

.container a {
  color: #333;
  font-size: 13px;
  text-decoration: none;
  margin: 15px 0 10px;
}
.container button {
  background-color: #a82d2d;
  color: #fff;
  padding: 10px 45px;
  border: 1px solid transparent;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  margin-top: 10px;
  cursor: pointer;
}

.container button.hidden {
  background-color: transparent;
  border-color: #fff;
}

.container form {
  background-color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 0 40px;
  height: 100%;
}

.container input {
  background-color: #eee;
  border: none;
  margin: 8px 0;
  padding: 10px 15px;
  font-size: 13px;
  border-radius: 8px;
  width: 100%;
  outline: none;
}

.sign-up, .sign-in {
  position: absolute;
  top: 0;
  height: 100%;
  transition: all 0.6s ease-in-out;
}

.sign-in {
  left: 0;
  width: 50%;
  z-index: 2;
}

.container.active .sign-in {
  transform: translateX(100%);
}

.sign-up {
  left: 0;
  width: 50%;
  z-index: 1;
  opacity: 0;
}

.container.active .sign-up {
  transform: translateX(100%);
  opacity: 1;
  z-index: 5;
  animation: move 0.6s;
}

@keyframes move {
  0%, 49.99%{
    opacity: 0;
    z-index: 1;
  }
   50%, 100%{
    opacity: 1;
    z-index: 5;
  }
}

.icons {
  margin: 20px 0;
}

.icons a {
  border: 1px solid #ccc;
  border-radius: 20%;
  display: inline-flex;
  justify-content: center;
  align-items: center;
  margin: 0 3px;
  width: 40px;
  height: 40px;
}

.toogle-container {
  position: absolute;
  top: 0;
  left: 50%;
  width: 50%;
  height: 100%;
  overflow: hidden;
  border-radius: 150px;
  z-index: 1000;
  transition: all 0.6s ease-in-out;
}

.container.active .toogle-container {
  transform: translateX(-100%);
  border-radius: 150px;
}

.toogle {
  background-color: #a82d2d;
  height: 100%;
  background: linear-gradient(to right, #c05c5c, #a82d2d);
  color: #fff;
  position: relative;
  left: -100%;
  width: 200%;
  transform: translateX(0);
  transition: all 0.6s ease-in-out;
}

.container.active .toogle {
  transform: translateX(50%);
}

.toogle-panel {
  position: absolute;
  width: 50%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  padding: 0 30px;
  text-align: center;
  top: 0;
  transform: translateX(0);
  transition: all 0.6s ease-in-out;
}

.toogle-left {
  transform: translateX(-200%);
}

.container.active .toogle-left {
  transform: translateX(0);
}

.toogle-right {
  right: 0;
  transform: translateX(0);
}

.container.active .toogle-right {
  transform: translateX(200%);
}
</style>
</head>
<body>
  <div class="container" id="container">
    <!-- Registro -->
    <div class="sign-up">
      <form method="POST" action="index.php?controller=Auth&action=register">
        <h1>Crear Cuenta</h1>
        <span>Usa tu correo para registrarte</span>
        <input type="text" name="nombre" placeholder="Nombre completo" required />
        <input type="email" name="correo" placeholder="Correo" required />
        <input type="password" name="password" placeholder="Contraseña" required />
        <button type="submit">Registrarse</button>
      </form>
    </div>

    <!-- Login -->
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

    <!-- Panel animado -->
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

  <script>
    const container = document.getElementById("container");
    const registerbtn = document.getElementById("register");
    const loginbtn = document.getElementById("login");

    registerbtn.addEventListener("click", () => {
    container.classList.add("active");
    });

    loginbtn.addEventListener("click", () => {
    container.classList.remove("active");
});

  </script>
</body>
</html>
 
document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  const toggleBtn = document.getElementById('toggleSidebar');

  // --- Alternar Sidebar ---
  function toggleSidebar() {
    sidebar.classList.toggle('open');
    mainContent.classList.toggle('sidebar-open');
  }

  toggleBtn.addEventListener('click', toggleSidebar);

  // --- Cerrar sidebar si se hace clic fuera (en móvil) ---
  document.addEventListener('click', function(e) {
    if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
      if (window.innerWidth <= 480) {
        sidebar.classList.remove('open');
        mainContent.classList.remove('sidebar-open');
      }
    }
  });

  // --- Ajustar sidebar según tamaño ---
  window.addEventListener('resize', function() {
    if (window.innerWidth > 480) {
      sidebar.classList.remove('open');
      mainContent.classList.remove('sidebar-open');
    }
  });

  // --- Cerrar sidebar al hacer clic en enlace (móvil) ---
  const navLinks = document.querySelectorAll('.sidebar-nav a');
  navLinks.forEach(link => {
    link.addEventListener('click', function() {
      if (window.innerWidth <= 480) {
        sidebar.classList.remove('open');
        mainContent.classList.remove('sidebar-open');
      }
    });
  });

  // ==========================
  // 🔹 Control de secciones
  // ==========================
  const inicioBtn = document.getElementById('inicioBtn');
  const formatosBtn = document.getElementById('formatosBtn');
  const listadoBtn = document.getElementById('listadoBtn');
  const reportesBtn = document.getElementById('reportesBtn');

  const inicioSection = document.getElementById('inicioSection');
  const formatosSection = document.getElementById('formatosSection');
  const listadoSection = document.getElementById('listadoSection');
  const reportesSection = document.getElementById('reportesSection');

  function mostrar(seccion) {
    // Oculta todo
    inicioSection.style.display = 'none';
    formatosSection.style.display = 'none';
    listadoSection.style.display = 'none';
    reportesSection.style.display = 'none';
    // Muestra la elegida
    seccion.style.display = 'block';
  }

  // --- Eventos para mostrar secciones ---
  inicioBtn.addEventListener('click', () => mostrar(inicioSection));
  formatosBtn.addEventListener('click', () => mostrar(formatosSection));
  listadoBtn.addEventListener('click', () => mostrar(listadoSection));
  reportesBtn.addEventListener('click', () => mostrar(reportesSection));

  // Mostrar inicio por defecto
  mostrar(inicioSection);
});

/* ================================
   🐟 GENERADOR DE PECES ALEATORIOS
   ================================ */
document.addEventListener("DOMContentLoaded", () => {
  const totalPeces = 30; // Cantidad total de peces
  const imagenes = [
    "https://fondolunaria.org/informe2021/assets/GIFs/Personajes/pez-2.gif",
    "https://i.gifer.com/origin/b4/b4e3a0c856b18e134d175aa49f406bb1_w200.gif",
    "https://images.emojiterra.com/google/noto-emoji/animated-emoji/1f41f.gif"
  ];

  for (let i = 0; i < totalPeces; i++) {
    const pez = document.createElement("img");
    pez.src = imagenes[Math.floor(Math.random() * imagenes.length)];
    pez.classList.add("fish");

    // Posición vertical aleatoria (distribuidos de 5% a 95%)
    const topPosition = Math.random() * 90 + 5;
    pez.style.top = `${topPosition}%`;

    // Tamaño aleatorio
    const size = Math.random() * 30 + 40; // 40 a 70 px
    pez.style.width = `${size}px`;

    // Duración de nado aleatoria (más natural)
    const swimDuration = Math.random() * 20 + 15; // 15s a 35s
    const floatDuration = Math.random() * 3 + 2;  // 2s a 5s
    pez.style.animationDuration = `${swimDuration}s, ${floatDuration}s`;

    // Retraso diferente para que salgan uno por uno
    const swimDelay = Math.random() * 25; // hasta 25 segundos
    pez.style.animationDelay = `${swimDelay}s, ${Math.random() * 2}s`;

    document.body.appendChild(pez);
  }
});


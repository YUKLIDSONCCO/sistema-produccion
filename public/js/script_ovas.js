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

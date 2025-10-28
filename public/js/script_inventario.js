document.addEventListener('DOMContentLoaded', function() {
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  const toggleBtn = document.getElementById('toggleSidebar');

  // Función para alternar el sidebar
  function toggleSidebar() {
    sidebar.classList.toggle('open');
    mainContent.classList.toggle('sidebar-open');
  }

  // Evento click para el botón hamburguesa
  toggleBtn.addEventListener('click', toggleSidebar);

  // Cerrar sidebar al hacer clic fuera en móvil
  document.addEventListener('click', function(e) {
    if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
      if (window.innerWidth <= 480) {
        sidebar.classList.remove('open');
        mainContent.classList.remove('sidebar-open');
      }
    }
  });

  // Ajustar sidebar según tamaño de pantalla
  window.addEventListener('resize', function() {
    if (window.innerWidth > 480) {
      sidebar.classList.remove('open');
      mainContent.classList.remove('sidebar-open');
    }
  });

  // Opcional: cerrar sidebar si se hace clic en un enlace (en móvil)
  const navLinks = document.querySelectorAll('.sidebar-nav a');
  navLinks.forEach(link => {
    link.addEventListener('click', function() {
      if (window.innerWidth <= 480) {
        sidebar.classList.remove('open');
        mainContent.classList.remove('sidebar-open');
      }
    });
  });

    const inicioBtn = document.getElementById('inicioBtn');
    const formatosBtn = document.getElementById('formatosBtn');
    const listadoBtn = document.getElementById('listadoBtn');
    const laboratorioBtn = document.getElementById('laboratorioBtn');
    const salaBtn = document.getElementById('salaBtn');
    const reportesBtn = document.getElementById('reportesBtn');

    function mostrar(seccion) {
      [inicioSection, formatosSection, listadoSection, laboratorioSection, salaSection, reportesSection].forEach(s => s.style.display = 'none');
      seccion.style.display = 'block';
    }

    inicioBtn.addEventListener('click', () => mostrar(inicioSection));
    formatosBtn.addEventListener('click', () => mostrar(formatosSection));
    listadoBtn.addEventListener('click', () => mostrar(listadoSection));
    laboratorioBtn.addEventListener('click', () => mostrar(laboratorioSection));
    salaBtn.addEventListener('click', () => mostrar(salaSection));
    reportesBtn.addEventListener('click', () => {
      mostrar(reportesSection);
      renderCharts();
    });

    
});
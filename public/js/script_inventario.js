document.addEventListener('DOMContentLoaded', () => {
    // 1. Manejo de la navegación (simulación de activación de enlaces)
    const navItems = document.querySelectorAll('.main-nav li');
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            // Elimina la clase 'active' de todos los elementos
            navItems.forEach(i => i.classList.remove('active'));
            // Agrega la clase 'active' solo al elemento clickeado
            this.classList.add('active');
            
            // En una aplicación real, aquí cargarías el nuevo contenido 
            // o redirigirías al usuario.
            console.log(`Navegando a: ${this.textContent.trim()}`);
        });
    });

    // 2. Manejo de clics en el calendario (simulación de selección de fecha)
    const calendarDays = document.querySelectorAll('.calendar-grid .day');
    calendarDays.forEach(day => {
        if (!day.classList.contains('inactive')) {
            day.addEventListener('click', function() {
                // Elimina la clase 'selected' de todos los días (excepto los inactivos)
                calendarDays.forEach(d => d.classList.remove('selected'));
                // Agrega la clase 'selected' al día clickeado
                this.classList.add('selected');
                console.log(`Día seleccionado: ${this.textContent.trim()}`);
            });
        }
    });

    // 3. Simulación de la funcionalidad del botón Log Out
    const logOutBtn = document.querySelector('.log-out-btn');
    logOutBtn.addEventListener('click', () => {
        alert('¡Sesión cerrada!');
        // En un entorno real: window.location.href = '/login';
    });
    
    // NOTA: Para hacer el carrusel de notas, los controles de fecha y 
    // el medidor de vacaciones, se necesitaría mucha más lógica JS.
});
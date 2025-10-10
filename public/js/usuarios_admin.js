
// Variables globales
let modal = document.getElementById("modalUsuario");
let span = document.getElementsByClassName("close")[0];
let formUsuario = document.getElementById("formUsuario");

// Abrir modal para nuevo usuario
document.getElementById("btnNuevoUsuario").onclick = function() {
    document.getElementById("modalTitulo").textContent = "Nuevo Usuario";
    document.getElementById("id_usuario").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("correo").value = "";
    document.getElementById("password").value = "";
    document.getElementById("password").required = true;
    document.getElementById("rol").value = "";
    document.getElementById("estado").value = "activo";
    modal.style.display = "block";
}

// Cerrar modal al hacer clic en la X
span.onclick = function() {
    modal.style.display = "none";
}

// Cerrar modal al hacer clic fuera de él
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Función para cerrar modal
function cerrarModal() {
    modal.style.display = "none";
}

// Función para editar usuario
function editarUsuario(id) {
    // En una implementación real, aquí haríamos una petición AJAX para obtener los datos del usuario
    // Por ahora, simulamos la obtención de datos
    fetch('index.php?controller=Admin&action=obtenerUsuario&id=' + id)
        .then(response => response.json())
        .then(usuario => {
            document.getElementById("modalTitulo").textContent = "Editar Usuario";
            document.getElementById("id_usuario").value = usuario.id_usuario;
            document.getElementById("nombre").value = usuario.nombre;
            document.getElementById("correo").value = usuario.correo;
            document.getElementById("password").value = "";
            document.getElementById("password").required = false;
            document.getElementById("rol").value = usuario.rol;
            document.getElementById("estado").value = usuario.estado;
            modal.style.display = "block";
        })
        .catch(error => {
            console.error('Error al obtener datos del usuario:', error);
            alert('Error al cargar los datos del usuario');
        });
}

// Función para actualizar la lista de usuarios automáticamente
function actualizarListaUsuarios() {
    fetch('index.php?controller=Admin&action=index')
        .then(response => response.text())
        .then(html => {
            // Extraer solo el contenido del tbody
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const nuevoTbody = doc.querySelector('#tbodyUsuarios');
            
            if (nuevoTbody) {
                document.getElementById('tbodyUsuarios').innerHTML = nuevoTbody.innerHTML;
            }
            
            // Actualizar timestamp
            const ahora = new Date();
            document.getElementById('ultimaActualizacion').textContent = 
                'Última actualización: ' + ahora.toLocaleTimeString();
        })
        .catch(error => {
            console.error('Error al actualizar:', error);
        });
}

// Actualizar cada 3 segundos
setInterval(actualizarListaUsuarios, 2000);

// También actualizar cuando la página gana foco
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        actualizarListaUsuarios();
    }
});

// Actualizar cuando la ventana se hace visible
window.addEventListener('focus', actualizarListaUsuarios);

// Mostrar hora de última actualización al cargar
const ahora = new Date();
document.getElementById('ultimaActualizacion').textContent = 
    'Última actualización: ' + ahora.toLocaleTimeString();

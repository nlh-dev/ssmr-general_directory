// sidebar.js
function setupSidebar() {
    const sidebar = document.getElementById('logo-sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const contentMain = document.querySelector('.content-main'); // Añadido para el contenido

    // Verificar si el sidebar debe estar oculto al cargar
    const isHidden = localStorage.getItem('sidebar-hidden') === 'true';

    // Estado inicial
    if (isHidden && window.innerWidth >= 640) { // sm breakpoint
        toggleSidebar(sidebar, contentMain, true);
    }

    // Evento para el botón de toggle
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            const isCurrentlyHidden = sidebar.classList.contains('-translate-x-full');
            toggleSidebar(sidebar, contentMain, !isCurrentlyHidden);
        });
    }

    // Evento para cambios de tamaño de pantalla
    window.addEventListener('resize', () => {
        if (window.innerWidth < 640) { // móvil
            toggleSidebar(sidebar, contentMain, true);
        } else {
            const isHidden = localStorage.getItem('sidebar-hidden') === 'true';
            toggleSidebar(sidebar, contentMain, isHidden);
        }
    });
}

// Función para alternar el estado del sidebar y el contenido
function toggleSidebar(sidebar, contentMain, hide) {
    if (hide) {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('sm:translate-x-0');
        if (contentMain) contentMain.classList.add('sidebar-hidden');
        localStorage.setItem('sidebar-hidden', 'true');
    } else {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('sm:translate-x-0');
        if (contentMain) contentMain.classList.remove('sidebar-hidden');
        localStorage.setItem('sidebar-hidden', 'false');
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', setupSidebar);
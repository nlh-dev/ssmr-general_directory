function clearModalForm(modalId) {
    const modal = document.getElementById(modalId);
    if (!modal) return;
    const form = modal.querySelector('form');
    if (!form) return;
    form.reset();

    // Si usas select2 o estilos especiales, puedes limpiar manualmente aquí
    // Ejemplo: limpiar selects personalizados
    form.querySelectorAll('select').forEach(select => {
        select.selectedIndex = 0;
    });

    // Quitar clases de error o estilos si es necesario
    form.querySelectorAll('input, select, textarea').forEach(el => {
        el.classList.remove('cursor-not-allowed');
        el.removeAttribute('aria-readonly');
        el.disabled = false;
    });
}
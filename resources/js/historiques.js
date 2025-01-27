document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal');
    const modalBackdrop = document.getElementById('deleteModal-backdrop');
    const cancelButton = document.getElementById('cancelDelete');
    const confirmButton = document.getElementById('confirmDelete');
    let currentForm = null;

    // Gestionnaire pour les boutons de suppression
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            currentForm = this;
            modal.classList.add('active');
            modalBackdrop.classList.add('active');
        });
    });

    // Fermer le modal lors du clic sur Annuler
    cancelButton.addEventListener('click', () => {
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
        currentForm = null;
    });

    // Soumettre le formulaire lors du clic sur Confirmer
    confirmButton.addEventListener('click', () => {
        if (currentForm) {
            currentForm.submit();
        }
    });

    // Fermer le modal en cliquant sur l'arrière-plan
    modalBackdrop.addEventListener('click', () => {
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
        currentForm = null;
    });
});

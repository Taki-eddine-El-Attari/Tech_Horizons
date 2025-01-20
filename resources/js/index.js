document.addEventListener('DOMContentLoaded', () => {
    const navButton = document.querySelector('.nav-button');
    const navMenu = document.querySelector('.nav-menu');
    let isOpen = false;

    navButton.addEventListener('click', () => {
        isOpen = !isOpen;  // Corrigé ici
        navMenu.classList.toggle('active');
        navButton.classList.toggle('nav-button-active');
    });

    document.addEventListener('click', (event) => {
        const isClickInside = navButton.contains(event.target) || navMenu.contains(event.target);
        
        if (!isClickInside && isOpen) {
            isOpen = false;
            navMenu.classList.remove('active');
            navButton.classList.remove('nav-button-active');
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Sélectionner le lien par son attribut data
    const logoutLink = document.querySelector('[data-logout]');
    const logoutForm = document.querySelector('.form-logout');

    if (logoutLink && logoutForm) {
    // Ajouter l'événement click sur le lien
    logoutLink.addEventListener('click', (event) => {
        event.preventDefault();
        logoutForm.submit();
    });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal');
    const modalBackdrop = document.getElementById('deleteModal-backdrop');
    const cancelButton = document.getElementById('cancelDelete');
    const confirmButton = document.getElementById('confirmDelete');
    let currentFormId = null;

    // Gestionnaire pour les liens de suppression
    document.querySelectorAll('.delete-post').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            currentFormId = this.getAttribute('data-form');
            modal.classList.add('active');
            modalBackdrop.classList.add('active');
        });
    });

    // Fermer la modale lors du clic sur Annuler
    cancelButton.addEventListener('click', function() {
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
        currentFormId = null;
    });

    // Fermer la modale lors du clic sur l'arrière-plan
    modalBackdrop.addEventListener('click', function() {
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
        currentFormId = null;
    });

    // Confirmer la suppression
    confirmButton.addEventListener('click', function() {
        if (currentFormId) {
            document.getElementById(currentFormId).submit();
        }
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
    });
});

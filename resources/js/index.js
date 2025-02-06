// Gestion du menu de navigation mobile
document.addEventListener('DOMContentLoaded', () => {
    const navButton = document.querySelector('.nav-button');
    const navMenu = document.querySelector('.nav-menu');
    let isOpen = false;

    // Toggle le menu de navigation
    navButton.addEventListener('click', () => {
        isOpen = !isOpen;
        navMenu.classList.toggle('active');
        navButton.classList.toggle('nav-button-active');
    });

    // Ferme le menu de navigation si click en dehors
    document.addEventListener('click', (event) => {
        const isClickInside = navButton.contains(event.target) || navMenu.contains(event.target);

        if (!isClickInside && isOpen) {
            isOpen = false;
            navMenu.classList.remove('active');
            navButton.classList.remove('nav-button-active');
        }
    });
});

// Gestion du lien de déconnexion
document.addEventListener('DOMContentLoaded', () => {
    // Sélectionner le lien par son attribut data
    const logoutLink = document.querySelector('[data-logout]');
    const logoutForm = document.querySelector('.form-logout');

    if (logoutLink && logoutForm) {
        // Gestionnaire d'événement pour le clic sur le lien
        logoutLink.addEventListener('click', (event) => {
            event.preventDefault(); // Bloque l'action par défaut du lien
            logoutForm.submit(); // Soumet le formulaire de déconnexion
        });
    }
});

// Gestion de la modale de suppression
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('deleteModal');
    const modalBackdrop = document.getElementById('deleteModal-backdrop');
    const cancelButton = document.getElementById('cancelDelete');
    const confirmButton = document.getElementById('confirmDelete');
    let currentFormId = null;

    // Gestionnaire pour les liens de suppression
    document.querySelectorAll('.delete-post').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            currentFormId = this.getAttribute('data-form');
            modal.classList.add('active');
            modalBackdrop.classList.add('active');
        });
    });

    // Fermer la modale lors du clic sur Annuler
    cancelButton.addEventListener('click', function () {
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
        currentFormId = null;
    });

    // Fermer la modale lors du clic sur l'arrière-plan
    modalBackdrop.addEventListener('click', function () {
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active');
        currentFormId = null;
    });

    // Confirmer la suppression
    confirmButton.addEventListener('click', function () {
        if (currentFormId) {
            document.getElementById(currentFormId).submit(); // Soumission du formulaire
        }
        modal.classList.remove('active');
        modalBackdrop.classList.remove('active'); // Fermeture après confirmation
    });
});

// Gestion de selection de theme en fonction du role 
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.querySelector('[name="role"]');
    const themeSelect = document.querySelector('[name="theme_id"]');
    const themeSelectContainer = themeSelect?.closest('.form-fields > div');

    // Gestion de l'affichage conditionnel du thème
    function toggleThemeSelect() {
        if (roleSelect && themeSelectContainer && themeSelect) {
            const isResponsable = roleSelect.value === 'Responsable';
            themeSelectContainer.style.display = isResponsable ? 'block' : 'none';
            
            if (!isResponsable) {
                themeSelect.value = ''; // Réinitialiser la sélection si pas Responsable
                themeSelect.disabled = true; // Désactiver le select
            } else {
                themeSelect.disabled = false; // Activer le select pour Responsable
            }
        }
    }
    // Initialisation au chargement
    toggleThemeSelect();

    // Écouteur de changement de rôle
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleThemeSelect);
    }
});

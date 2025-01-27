//Classe qui gère le système de notation avec étoiles et commentaires
 
class Rating {

     //Initialise le système de notation
     
    constructor(ratingEl) {
        // Stockage des références DOM
        this.ratingEl = ratingEl;
        this.selectedValue = 0; // Valeur de la note (0-5)
        this.form = this.ratingEl.closest('form'); // Formulaire parent
        this.submitButton = this.form.querySelector('.comment-button'); // Bouton d'envoi
        this.commentInput = this.form.querySelector('.comment-input'); // Champ de texte

        // Active l'animation après le chargement
        setTimeout(() => {
            this.ratingEl.classList.add("rating--animatable");
        }, 0);

        // Mise en place des écouteurs d'événements
        this.ratingEl.addEventListener("click", this.onClick.bind(this));
        this.commentInput.addEventListener('input', this.checkFormValidity.bind(this));
    }

    // Récupère tous les boutons d'étoiles//
    get ratingButtons() {
        return [...this.ratingEl.querySelectorAll(".rating-button")];
    }

    //Récupère les boutons d'étoiles non actifs//
    get offButtons() {
        return this.ratingButtons.filter(
            (button) => !button.classList.contains("rating-button--active")
        );
    }

    //Active le bouton si un commentaire est présent//
    checkFormValidity() {
        const hasComment = this.commentInput.value.trim().length > 0;
        this.submitButton.disabled = !hasComment;
    }

    //Gère le clic sur une étoile//
    onClick(e) {
        // Trouve le bouton cliqué ou son plus proche parent
        const target = e.target.matches(".rating-button")
            ? e.target
            : e.target.closest(".rating-button");
        if (!target) return;

        // Réinitialise les délais d'animation
        this.ratingButtons.forEach((button) => {
            button.style.setProperty("--transition-delay", 0);
        });

        // Applique un délai en cascade pour l'animation des étoiles non actives
        this.offButtons.forEach((button, index) => {
            const DELAY_UNIT = 100;
            button.style.setProperty("--transition-delay", `${DELAY_UNIT * index}ms`);
        });

        // Met à jour l'état des étoiles
        const clickedButtonIndex = this.ratingButtons.indexOf(target);
        this.selectedValue = parseInt(target.dataset.value);

        // Active/désactive les étoiles selon la sélection
        this.ratingButtons.forEach((button, index) => {
            if (index <= clickedButtonIndex) {
                button.classList.add("rating-button--active");
            } else {
                button.classList.remove("rating-button--active");
            }
        });

        // Gère l'input caché pour la soumission du formulaire
        let ratingInput = this.form.querySelector('input[name="rating"]');
        if (!ratingInput) {
            ratingInput = document.createElement('input');
            ratingInput.type = 'hidden';
            ratingInput.name = 'rating';
            this.form.appendChild(ratingInput);
        }
        ratingInput.value = this.selectedValue;

        this.checkFormValidity();
    }
}

// Initialise le système de notation pour chaque élément .rating de la page
Array.from(document.querySelectorAll(".rating")).forEach(
    (ratingEl) => new Rating(ratingEl)
);

// Ajoutez ce code à la fin du fichier
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('deleteModal');
    const modalBackdrop = document.getElementById('deleteModal-backdrop');
    const cancelButton = document.getElementById('cancelDelete');
    const confirmButton = document.getElementById('confirmDelete');
    let currentFormId = null;

    // Gestionnaire pour les liens de suppression
    document.querySelectorAll('.delete-comment').forEach(function(link) {
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
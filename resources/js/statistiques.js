// Sélectionne tous les éléments
const counters = document.querySelectorAll(".statistiques-section-item-value");

counters.forEach((counter) => {
  counter.innerText = "0";
  const updateCounter = () => {
    const target = +counter.getAttribute("data-target");
    const count = +counter.innerText;
    const increment = target / 200;
    if (count < target) {
      // Met à jour la valeur avec arrondi supérieur
      counter.innerText = `${Math.ceil(count + increment)}`;
      // Rappel récursif après 30ms pour l'effet d'animation
      setTimeout(updateCounter, 30); // la vitesse du compteur
    } else {
      // Fixe la valeur finale exacte quand l'animation est terminée
      counter.innerText = target;
    }
  };

  // Démarre l'animation
  updateCounter();
});
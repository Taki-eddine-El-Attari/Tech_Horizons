const counters = document.querySelectorAll(".statistiques-section-item-value");

counters.forEach((counter) => {
  counter.innerText = "0";
  const updateCounter = () => {
    const target = +counter.getAttribute("data-target");
    const count = +counter.innerText;
    const increment = target / 200;
    if (count < target) {
      counter.innerText = `${Math.ceil(count + increment)}`;
      setTimeout(updateCounter, 30); // vitesse de conteur
    } else counter.innerText = target;
  };
  updateCounter();
});
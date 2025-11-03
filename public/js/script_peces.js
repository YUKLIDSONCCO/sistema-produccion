
/* ================================
   🐟 GENERADOR DE PECES ALEATORIOS
   ================================ */
document.addEventListener("DOMContentLoaded", () => {
  const totalPeces = 80; // Cantidad total de peces
  const imagenes = [
    "https://fondolunaria.org/informe2021/assets/GIFs/Personajes/pez-2.gif",
    "https://i.gifer.com/origin/b4/b4e3a0c856b18e134d175aa49f406bb1_w200.gif",
    "https://images.emojiterra.com/google/noto-emoji/animated-emoji/1f41f.gif"
  ];

  for (let i = 0; i < totalPeces; i++) {
    const pez = document.createElement("img");
    pez.src = imagenes[Math.floor(Math.random() * imagenes.length)];
    pez.classList.add("fish");

    // Posición vertical aleatoria (distribuidos de 5% a 95%)
    const topPosition = Math.random() * 90 + 5;
    pez.style.top = `${topPosition}%`;

    // Tamaño aleatorio
    const size = Math.random() * 30 + 40; // 40 a 70 px
    pez.style.width = `${size}px`;

    // Duración de nado aleatoria (más natural)
    const swimDuration = Math.random() * 20 + 15; // 15s a 35s
    const floatDuration = Math.random() * 3 + 2;  // 2s a 5s
    pez.style.animationDuration = `${swimDuration}s, ${floatDuration}s`;

    // Retraso diferente para que salgan uno por uno
    const swimDelay = Math.random() * 25; // hasta 25 segundos
    pez.style.animationDelay = `${swimDelay}s, ${Math.random() * 2}s`;

    document.body.appendChild(pez);
  }
});

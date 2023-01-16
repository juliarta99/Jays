const humberger = document.querySelector(".humberger");
const nav = document.querySelector("nav ul");

humberger.addEventListener("click", () => {
      humberger.classList.toggle("geser");
      nav.classList.toggle("geser");
});

document.querySelectorAll(".nav-link").forEach(n => n.
      addEventListener("click", () =>{
            humberger.classList.remove("geser");
            nav.classList.remove("geser");
      }))

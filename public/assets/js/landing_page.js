//IO Effect
const io = new IntersectionObserver((eles) => {
  eles.forEach((ele) => {
    if (ele.isIntersecting) {
      ele.target.classList.add("animation-show");
    } else {
      // ele.target.classList.remove("animation-show");
    }
  });
});

const hiddenEles = document.querySelectorAll(".animation-hidden");
hiddenEles.forEach((el) => io.observe(el));
//change navbar after scrolling
let navbar = document.querySelector(".navbar");

window.addEventListener("scroll", () => {
  if (window.scrollY > 0) {
    navbar.classList.add("navbar-dark");
    navbar.classList.remove("py-3");
  } else {
    navbar.classList.remove("navbar-dark");
    navbar.classList.add("py-3");
  }
});
//faq
function toggles(e) {
  $tog = e.lastElementChild.style.display;
  if ($tog == "block") {
    e.lastElementChild.style.display = "none";
    e.style.borderColor = "";
    e.firstElementChild.style.color = "";
    e.firstElementChild.lastElementChild.innerHTML =
      "<i class='fa-solid fa-greater-than'></i>";
  } else {
    e.firstElementChild.lastElementChild.innerHTML =
      "<i class='fa-solid fa-chevron-down'></i>";
    ("<i class='fa-solid fa-greater-than'></i>");
    e.lastElementChild.style.display = "block";
    e.style.borderColor = "var(--primary-2)";
    e.firstElementChild.style.color = "var(--primary-2)";
  }
  console.log(e.lastElementChild);
}
//logo slider partner
let dupl = document.querySelector(".slides").cloneNode(true);
document.querySelector(".slider").appendChild(dupl);

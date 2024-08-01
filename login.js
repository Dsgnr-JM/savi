import Bell from "./lib/bell.js"
import validatedInput from "./lib/validatedInput.js"

const $form = document.querySelector("#login");

document.querySelectorAll("input").forEach(input => input.addEventListener("input",() => {
  validatedInput(input, true)
}))

$form.addEventListener("submit", login);

async function login(e) {
  e.preventDefault();
  const $btn = e.submitter;
  $btn.disabled = true;
  const formDt = new FormData(e.target);
  formDt.append("login",true)
  const fetching = await fetch("api.php", {
    method: "POST",
    body: formDt,
  });
  const data = await fetching.json();
  if (data.success) {
    const bell = new Bell(
      { title: data.message, description: "Ud sera redireccionado..." },
      "check",
      {
        animate: true,
        isColored: true,
        transitionDuration: 300,
        position: "bottom-right",
        typeAnimation: "fade-in",
        timeScreen: 8000,
        expand: true,
      }
    );
    bell.launch();
    setTimeout(() => (window.location = "dashboard"), 3000);
  } else {
    const bell = new Bell(
      { title: "Upps ocurrio un error", description: data.message },
      "error",
      {
        animate: true,
        isColored: true,
        transitionDuration: 300,
        position: "bottom-right",
        typeAnimation: "fade-in",
        timeScreen: 8000,
        expand: true,
      }
    );
    bell.launch();
    $btn.disabled = false;
  }
}

import Bell from "./lib/bell.esm.js";
import validatedInput from "./lib/validatedInput.js"

document.querySelectorAll("input").forEach(input => input.addEventListener("input",() => {
  validatedInput(input, true)
}))
const $form = document.querySelector("#signup");

$form.addEventListener("submit", signup);

async function signup(e) {
  e.preventDefault();
  const $btn = e.submitter;
  $btn.disabled = true;
  const formDt = new FormData(e.target);
  const fetching = await fetch("api.php", {
    method: "POST",
    body: formDt,
  });
  const data = await fetching.json();
  if (data.success) {
    const bell = new Bell(
      { title: data.message, description: "Ud sera redireccionado..." },
      "success",
      {
        position: "top-center",
        typeAnimation: "bound-2",
        timeScreen: 8000,
        expand: true,
      }
    );
    bell.launch();
    e.target.reset()
    setTimeout(() => (window.location = "login.php"), 3000);
  } else if(data.error === 1){
    const bell = new Bell(
      { title: "Algo salio mal", description:data.message},
      "warning",
      {
        position: "top-center",
        typeAnimation: "bound-2",
        timeScreen: 8000,
        expand: true,
      }
    );
    bell.launch();
    $btn.disabled = false
  }
  else {
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

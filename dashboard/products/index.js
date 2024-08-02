const $tdTables = document.querySelectorAll("#avatar")

$tdTables.forEach($td => {
  appendAvatar($td)
})

// import Bell from "../../lib/bell.js"

// const $form = document.querySelector("#register");

// $form.addEventListener("submit", register);

// async function register(e) {
//   e.preventDefault();
//   const $btn = e.submitter;
//   $btn.disabled = true;
//   const formDt = new FormData(e.target);
//   const fetching = await fetch("../api.php?target=product", {
//     method: "POST",
//     body: formDt,
//   });
//   console.log(await fetching.text())
  // const data = await fetching.json();
  // if (data.success) {
  //   const bell = new Bell(
  //     { title: "Correcto", description: data.message },
  //     "check",
  //     {
  //       animate: true,
  //       isColored: true,
  //       transitionDuration: 300,
  //       position: "bottom-right",
  //       typeAnimation: "fade-in",
  //       timeScreen: 5000,
  //       expand: true,
  //     }
  //   );
  //   bell.launch();
  //   e.target.reset()
  // } else {
  //   const bell = new Bell(
  //     { title: "Upps ocurrio un error", description: data.message },
  //     "error",
  //     {
  //       animate: true,
  //       isColored: true,
  //       transitionDuration: 300,
  //       position: "bottom-right",
  //       typeAnimation: "fade-in",
  //       timeScreen: 5000,
  //       expand: true,
  //     }
  //   );
  //   bell.launch();
  // }
//   $btn.disabled = false;
// }
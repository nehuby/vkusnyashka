for (const btn of document.querySelectorAll("[data-id]")) {
  btn.addEventListener("click", (e) => {
    btn.disabled = true;
    let dish_id = btn.dataset.id;
    const url = "cart.php";
    let data = {
      dish_id: dish_id,
    };
    void fetch(url, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    }).then((response) => {
      btn.innerHTML = "Добавлено";
    });
  });
}

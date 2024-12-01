$(".favorite-btn").click(function () {
    const profesionalId = $(this).data("profesional-id");
  
    // Cambia de color el corazón
    $(this).toggleClass("morado");
  
    // Enviar solicitud al servidor
    $.post("guardar_favorito.php", { profesional_id: profesionalId }, function (response) {
      console.log(response.message); // Mensaje de éxito o error
    }, "json");
  });
  
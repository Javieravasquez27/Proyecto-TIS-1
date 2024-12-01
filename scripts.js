function submitRating(stars) {
    document.getElementById("rating").value = stars;

    // Datos para enviar (puedes reemplazar con IDs dinámicos)
    const rutUsuario = 123; // ID del usuario
    const rutProfesional = 456; // ID del profesional
    const rating = stars;

    // Enviar datos mediante AJAX
    $.ajax({
        url: 'guardar_calificacion.php', // Archivo PHP que guarda la calificación
        type: 'POST',
        data: { rating, rutUsuario, rutProfesional },
        success: function(response) {
            // Mostrar confirmación al usuario
            alert("Tu calificación ha sido enviada.");
        },
        error: function() {
            // Manejar errores
            alert("Hubo un error al enviar la calificación. Inténtalo nuevamente.");
        }
    });
}

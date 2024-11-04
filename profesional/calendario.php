<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Disponibilidad de Horas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h2>Selecciona una fecha para ver las horas disponibles</h2>
    <input type="date" id="fecha" name="fecha">

    <h3>Horas disponibles:</h3>
    <ul id="horas-disponibles"></ul>

    <script>
        // Detecta cuando cambia la fecha y hace una solicitud AJAX
        $('#fecha').on('change', function () {
            const fechaSeleccionada = $(this).val();

            if (fechaSeleccionada) {
                $.ajax({
                    url: 'consultar_disponibilidad.php', // Archivo PHP que manejará la solicitud
                    type: 'POST',
                    data: { fecha: fechaSeleccionada },
                    success: function (data) {
                        // Actualiza la lista de horas disponibles
                        $('#horas-disponibles').html(data);
                    },
                    error: function () {
                        $('#horas-disponibles').html('<li>Error al obtener disponibilidad</li>');
                    }
                });
            }
        });
    </script>
</body>
</html>

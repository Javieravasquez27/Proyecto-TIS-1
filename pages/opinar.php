<?php
include 'database/conexion.php';

$rut_profesional = $_GET['rut_profesional'];

// Consulta para obtener los detalles del profesional
$query_profesional = "SELECT nombres, apellido_p, apellido_m, foto_perfil FROM usuario WHERE rut = '$rut_profesional'";
$resultado_profesional = mysqli_query($conexion, $query_profesional);
$profesional = mysqli_fetch_assoc($resultado_profesional);
?>

<style>
    .voucher {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .voucher-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .voucher-section {
        margin-bottom: 15px;
    }
    .voucher-section strong {
        display: block;
        margin-bottom: 5px;
    }
    .profile-info {
        display: flex;
        align-items: center;
    }
    .profile-info img {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin-right: 20px;
    }
    .profile-info .details {
        flex: 1;
    }
    .stars {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
    .stars input {
        display: none;
    }
    .stars label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
    }
    .stars input:checked ~ label,
    .stars input:checked ~ label ~ label {
        color: #f5c518;
    }
    .stars label:hover,
    .stars label:hover ~ label {
        color: #f5c518;
    }
</style>

<div class="voucher">
    <div class="voucher-header">
        <h2>Opinar sobre el Profesional</h2>
    </div>
    <div class="voucher-section profile-info">
        <img src="<?php echo $profesional['foto_perfil']; ?>" alt="Foto de perfil">
        <div class="details">
            <p><strong>Nombre:</strong> <?php echo $profesional['nombres'] . ' ' . $profesional['apellido_p'] . ' ' . $profesional['apellido_m']; ?></p>
            <p><strong>RUT Profesional:</strong> <?php echo $rut_profesional; ?></p>
        </div>
    </div>
    <form id="opinionForm">
        <input type="hidden" name="rut_profesional" value="<?php echo $rut_profesional; ?>">
        <input type="hidden" name="servicio" value="<?php echo $servicio; ?>">
        <div class="voucher-section">
            <strong>Calificación:</strong>
            <div class="stars">
                <input type="radio" id="star1" name="rating" value="5"><label for="star1">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="4"><label for="star2">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="2"><label for="star4">&#9733;</label>
                <input type="radio" id="star5" name="rating" value="1"><label for="star5">&#9733;</label>
            </div>
        </div>
        <div class="voucher-section">
            <strong>Opinión:</strong>
            <textarea name="opinion" rows="4" class="form-control" placeholder="Escribe tu opinión aquí..."></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enviar Opinión</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#opinionForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'utils/guardar_calificacion.php',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Opinión enviada',
                        text: 'Gracias por enviar tu opinión',
                        showConfirmButton: true,
                        willClose: () => {
                            window.location.href = 'index.php';
                        }
                    });
                },
                error: function() {
                    alert('Error al enviar la opinión');
                }
            });
        });
    });
</script>
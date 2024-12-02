<?php 
    $rut_recibe = $_GET['rut'];
?>

<style>

    .chat-container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    #mensajes {
        padding: 20px;
        height: 400px;
        overflow-y: auto;
        border-bottom: 1px solid #ddd;
    }
    .message {
        margin-bottom: 15px;
    }
    .message .username {
        font-weight: bold;
        margin-right: 5px;
    }
    .message .text {
        display: inline-block;
        background-color: #e9ecef;
        padding: 10px;
        border-radius: 5px;
    }
    #enviar {
        padding: 10px;
        background-color: #f1f1f1;
        display: flex;
        align-items: center;
    }
    #msg {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
</style>

<div class="chat-container">
    <section id="mensajes"></section>

    <section id="enviar">
        <input type="text" class="form-control" id="msg" placeholder="Escribe algo aquí..." onkeypress="check(event)">
    </section>
</div>

<section id="hide"></section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function recargar(){
        var parametros = {
            "rut_recibe" : <?php echo $rut_recibe; ?>,
            "rut_envia" : <?php echo $_SESSION['rut']; ?>
        };
        $.ajax({
            data: parametros,
            url: 'utils/obtenerMensaje.php',
            type: 'post',
            success: function(response){
                $("#mensajes").html(response);
                $("#mensajes").scrollTop($("#mensajes")[0].scrollHeight); // Scroll to bottom
            }
        })
    }

    function check(e){
        if(e.key === "Enter"){
            enviar();
        }
    }

    function enviar(){
        var mensaje = document.getElementById("msg").value;
        var parametros = {
            "mensaje" : mensaje,
            "rut_recibe" : <?php echo $rut_recibe; ?>,
            "rut_envia" : <?php echo $_SESSION['rut']; ?>
        };
        $.ajax({
            data: parametros,
            url: 'utils/enviarMensaje.php',
            type: 'post',
            success: function(response){
                $("#hide").html(response);
                $("#msg").val("");
                recargar();
            }
        });
    }

    setInterval(recargar, 1000);
</script>
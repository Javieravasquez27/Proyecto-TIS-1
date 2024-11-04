<?php
/*
require('database/conexion.php');
if (isset($_SESSION['rut'])) {
  $query = "SELECT precio_serv_prof FROM servicio_profesional
            where rut_profesional = '$_SESSION[rut]'";
  $resultado=mysqli_query($conexion,$query);
  $user= mysqli_fetch_assoc($resultado);
}else{
  $rut=$_POST['rut'];
  $query = "SELECT precio_serv_prof FROM servicio_profesional
  where rut_profesional = '$rut'";
  $resultado=mysqli_query($conexion,$query);
  $user= mysqli_fetch_assoc($resultado);
}
$precio_serv_prof = $user['precio_serv_prof'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function get_ws($data,$method,$type,$endpoint){
    $curl = curl_init();
    if($type=='live'){
		$TbkApiKeyId='597055555532';
		$TbkApiKeySecret='579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
        $url="https://webpay3g.transbank.cl".$endpoint;//Live
    }else{
		$TbkApiKeyId='597055555532';
		$TbkApiKeySecret='579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
        $url="https://webpay3gint.transbank.cl".$endpoint;//Testing
    }
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Tbk-Api-Key-Id: '.$TbkApiKeyId.'',
        'Tbk-Api-Key-Secret: '.$TbkApiKeySecret.'',
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    //echo $response;
    return json_decode($response);
}
$baseurl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$url="https://webpay3g.transbank.cl/";//Live
$url="https://webpay3gint.transbank.cl/";//Testing
$action = isset($_GET["action"]) ? $_GET["action"] : 'init';
$message=null;
$post_array = false;
switch ($action) {
    
    case "init":
        $buy_order=rand();
        $session_id=session_id();
        $amount=$precio_serv_prof;
        $return_url = $baseurl."?action=getResult";
		    $type="sandbox";
          $data=[
              'buy_order'=> $buy_order,
              'session_id'=> $session_id,
              'amount'=> $amount,
              'return_url'=> $return_url
          ];
          $method='POST';
           $endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions';
          
          $response = get_ws(json_encode($data),$method,$type,$endpoint);
          $message.= "<pre>";
          $message.= print_r($response,TRUE);
          $message.= "</pre>";
          $url_tbk = $response->url;
          $token = $response->token;
          $submit='Continuar!';
    break;
    case "getResult":
        
        $message.= "<pre>".print_r($_POST,TRUE)."</pre>";
        if (!isset($_POST["token_ws"]))
            break;
        /** Token de la transacción */
        /*$token = filter_input(INPUT_POST, 'token_ws');
        
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        $data='';
		    $method='PUT';
	  	  $type='sandbox';
	  	  $endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token;
		
        $response = get_ws(json_encode($data),$method,$type,$endpoint);
       
        $message.= "<pre>";
        $message.= print_r($response,TRUE);
        $message.= "</pre>";
        
        $url_tbk = $baseurl."?action=getStatus";
        $submit='Ver Status!';
        
        break;
        
    case "getStatus":
        
        if (!isset($_POST["token_ws"]))
            break;*/
        /** Token de la transacción */
        /*$token = filter_input(INPUT_POST, 'token_ws');
        
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        
        $data='';
  		  $method='GET';
	  	  $type='sandbox';
		    $endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token;
		
        $response = get_ws(json_encode($data),$method,$type,$endpoint);
       
        $message.= "<pre>";
        $message.= print_r($response,TRUE);
        $message.= "</pre>";      
        $url_tbk = $baseurl."?action=refund";
        $submit='Refund!';
        break;
        
    case "refund":
        
        if (!isset($_POST["token_ws"]))
            break;*/
        /** Token de la transacción */
        /*$token = filter_input(INPUT_POST, 'token_ws');
        
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        $amount=$precio_serv_prof;
        $data='{
                  "amount": '.$amount.'
                }';
		$method='POST';
		$type='sandbox';
		$endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token.'/refunds';
		
        $response = get_ws($data,$method,$type,$endpoint);
       
        $message.= "<pre>";
        $message.= print_r($response,TRUE);
        $message.= "</pre>";
        $submit='Crear nueva!';
        $url_tbk = $baseurl;
        break;        
} */       
?>

<title>KindomJob's</title>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function cargarRegiones() {
            fetch("utils/get_region.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("region");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Región";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las regiones recibidas
                    data.forEach(region => {
                        const option = document.createElement("option");
                        option.value = region.id_region;
                        option.textContent = region.nombre_region;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar regiones:", error));
        }

        function cargarCiudades() {
            fetch("utils/get_ciudad.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("ciudad");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Ciudad";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las ciudades recibidas
                    data.forEach(ciudad => {
                        const option = document.createElement("option");
                        option.value = ciudad.id_ciudad;
                        option.textContent = ciudad.nombre_ciudad;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar ciudades:", error));
        }

        function cargarComunas() {
            fetch("utils/get_comuna.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("comuna");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Comuna";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las comunas recibidas
                    data.forEach(comuna => {
                        const option = document.createElement("option");
                        option.value = comuna.id_comuna;
                        option.textContent = comuna.nombre_comuna;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar comunas:", error));
        }

        function cargarProfesiones() {
            fetch("utils/get_profesion.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("profesion");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Profesión";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las profesiones recibidas
                    data.forEach(profesion => {
                        const option = document.createElement("option");
                        option.value = profesion.id_profesion;
                        option.textContent = profesion.nombre_profesion;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar profesiones:", error));
        }

        function cargarInstituciones() {
            fetch("utils/get_institucion.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("institucion");
                    select.innerHTML = '';
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Seleccione una institución";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);
                    data.forEach(institucion => {
                        const option = document.createElement("option");
                        option.value = institucion.id_institucion;
                        option.textContent = institucion.nombre_institucion;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar instituciones:", error));
        }

        function cargarServicios() {
            fetch("utils/get_servicio.php")
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById("servicio");

                    // Vaciar el select por si tiene opciones
                    select.innerHTML = '';

                    // Agregar una opción por defecto
                    const defaultOption = document.createElement("option");
                    defaultOption.textContent = "Servicio";
                    defaultOption.value = "";
                    select.appendChild(defaultOption);

                    // Rellenar el select con las servicios recibidas
                    data.forEach(servicio => {
                        const option = document.createElement("option");
                        option.value = servicio.id_servicio;
                        option.textContent = servicio.nombre_servicio;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error("Error al cargar servicios:", error));
        }

        cargarRegiones();
        cargarCiudades();
        cargarComunas();
        cargarProfesiones();
        cargarServicios();
    });
</script>

<div class="container">
        
        <div class="row py-5">
            <div class="col-1"></div>
            <div class="col-7">
                <div class="row py-3">
                    <div class="col py-5 px-1 mt-4">
                        <select id="profesion" name="profesion" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="region" name="region" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="ciudad" name="ciudad" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="comuna" name="comuna" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>
                    <div class="col py-5 px-1 mt-4">
                        <select id="servicio" name="servicio" class="form-select" required>
                            <!-- Las opciones se llenarán aquí con AJAX -->
                        </select>
                    </div>                    
                    
                </div>
            </div>
            <div class="col-3">
                <div class="row py-3">
                    <div class="col py-5 px-1 mt-4">
                        <form class="d-flex" role="search" action="index.php?p=busqueda">
                            <input class="form-control me-1" type="search" placeholder="Ingrese un término" aria-label="Search">
                            <button class="btn btn-outline-success " type="submit">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col text-center mb-1" style="font-size: 20px;"><span>Busqueda de profesionales cercanos</span></div>
            </div>
        </div>
        
        <div class="container cont_mapa">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 mapa">
			<iframe src="https://locatestore.com/8xSkHE" style="border:none;width:100%;height:300px" allow="geolocation"></iframe>
                    <!-- <iframe class="mapa" src="https://locatestore.com/Xh--K4" style="border:none;width:100%;height:300px" allow="geolocation"></iframe> -->
                </div>
                <dic class="col-2"></dic>
            </div>
        </div>
            
    </div>
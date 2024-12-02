<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap  -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">

	<!-- Material Icons -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

	<!-- CSS -->
	<?php
		// Se hace la consulta para obtener si es que profile_cita se repite en alguna parte
		// de la pagina si es asi entonces se muestra el profile_profesional
		$pagina = isset($_GET['p']) ? strtolower($_GET['p']): 'home';
		$esprofilecita = preg_match('*\b'.preg_quote('profile_cita').'\b*i',$pagina);
		if ($esprofilecita == 1) { ?>
			<link rel="stylesheet" href="public/css/profile_profesional.css">

	<?php
		} 
	?>
	<link rel="stylesheet" href="public/css/styles.css">
	
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="public/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="public/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="public/images/favicon-16x16.png">
	<link rel="manifest" href="public/images/site.webmanifest">

	<!-- Tipografía -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">

	<!-- SweetAlert2 -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- jQuery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- Select2 -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!-- Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php global $sinNavbarFooter; ?>

<body style="background-color: rgb(240, 223, 255);">
<?php if (empty($sinNavbarFooter)): ?>
	<div class="min-vh-100">
<?php endif; ?>
	<?php if (empty($sinNavbarFooter)): ?>
		<div class="min-vh-100">
    		<?php require_once 'includes/navbar.php'; ?>
	<?php endif; ?>
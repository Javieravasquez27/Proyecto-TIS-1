<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Citas</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos principales */
        .card { 
            max-width: 600px; 
            margin: 20px auto; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }
        
        /* Perfil */
        .profile-section { 
            display: flex; 
            align-items: center; 
            margin-bottom: 15px; 
        }
        .profile-section img { 
            border-radius: 50%; 
            width: 60px; 
            height: 60px; 
            margin-right: 15px; 
            border: 2px solid #ddd;
        }
        .badge { 
            background-color: #e6f4ea; 
            color: #28a745; 
            font-size: 0.8rem; 
            padding: 5px 10px; 
            border-radius: 5px; 
        }
        
        /* Texto */
        .text-muted { 
            font-size: 0.9rem; 
        }
        .price-info { 
            font-weight: bold; 
            font-size: 1.1rem; 
            color: #333; 
        }

        /* Disponibilidad */
        .availability { 
            margin-top: 20px; 
        }
        .day-column { 
            text-align: center; 
            margin: 10px 0; 
        }
        .day-column strong { 
            display: block; 
            font-weight: 600; 
            margin-bottom: 10px; 
            font-size: 0.9rem; 
        }
        .day-column button { 
            width: 100%; 
            margin: 5px 0; 
            font-size: 0.9rem; 
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .profile-section { 
                flex-direction: column; 
                align-items: flex-start; 
                text-align: left; 
            }
            .profile-section img { 
                margin-bottom: 10px; 
            }
            .day-column button { 
                width: 100%; 
            }
        }
        .nav-tabs .nav-link.active {
            font-weight: bold; /* Texto en negrita */
            border: none;
            border-bottom: 3px solid #000; /* Línea inferior en negrita */
            color: #000; /* Color del texto */
        }
        /* Estilo para las pestañas inactivas */
        .nav-tabs .nav-link {
            color: #666; /* Color del texto inactivo */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-body">
            <!-- Sección de perfil -->
            <div class="profile-section">
                <img src="profile.jpg" alt="Foto de perfil">
                <div>
                    <h5 class="mt-2">Nombre</h5>
                    <p class="text-muted">Profesion</p>
                </div>
            </div>

            <!-- Información de contacto -->
            <div>
                <p><strong>Dirección:</strong>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#direccion" data-toggle="tab">Dirección</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#online" data-toggle="tab">Online</a>
                        </li>
                    </ul>
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="direccion">
                            <p>Contenido para Dirección.</p>
                        </div>
                        <div class="tab-pane fade" id="online">
                            <p>Contenido para Online.</p>
                        </div>
                    </div>
                <p class="price-info">Precio:</p>
            </div>

            <!-- Disponibilidad -->
            <div class="availability">
                <div class="row">
                    <div class="col-3 day-column">
                        <strong>Hoy</strong>
                        <!-- Aquí puedes añadir los horarios -->
                        <button class="btn btn-light btn-sm" disabled>-</button>
                    </div>
                    <div class="col-3 day-column">
                        <strong>Mañana</strong>
                        <!-- Aquí puedes añadir los horarios -->
                        <button class="btn btn-primary btn-sm">20:30</button>
                        <button class="btn btn-primary btn-sm">21:30</button>
                    </div>
                    <div class="col-3 day-column">
                        <strong>Mar</strong>
                        <!-- Aquí puedes añadir los horarios -->
                        <button class="btn btn-primary btn-sm">19:30</button>
                        <button class="btn btn-primary btn-sm">20:30</button>
                        <button class="btn btn-primary btn-sm">21:30</button>
                    </div>
                    <div class="col-3 day-column">
                        <strong>Mié</strong>
                        <!-- Aquí puedes añadir los horarios -->
                        <button class="btn btn-light btn-sm" disabled>19:30</button>
                        <button class="btn btn-primary btn-sm">20:30</button>
                        <button class="btn btn-primary btn-sm">21:30</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

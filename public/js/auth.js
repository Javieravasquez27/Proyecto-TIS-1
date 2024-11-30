/**
 * Archivo que se encarga de enviar los datos de los formularios de login y registro,
 * además de manejar el logout, por medio de AJAX.
 **/

// Función para validar el RUT
function validarRut(rut) {
    rut = rut.replace(/\./g, "").toUpperCase(); // Se quitan puntos y pasa "K" a mayúsculas si no lo está
    const regex = /^[0-9]+[K0-9]$/; // Se valida el formato del RUT (13799304K o 13799304k)
    if (!regex.test(rut)) return false;

    const cuerpo = rut.slice(0, -1);
    const dv = rut.slice(-1);

    let suma = 0;
    let multiplo = 2;

    for (let i = cuerpo.length - 1; i >= 0; i--) {
        suma += multiplo * parseInt(cuerpo[i]);
        multiplo = multiplo === 7 ? 2 : multiplo + 1;
    }

    const dvEsperado = 11 - (suma % 11);
    const dvCalculado = dvEsperado === 11 ? "0" : dvEsperado === 10 ? "K" : dvEsperado.toString();

    return dv === dvCalculado;
}

const loginForm = document.querySelector("#login-form");

if (loginForm) {
    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();

        // Se obtienen los valores del formulario
        const rut = document.querySelector("#rut").value.trim();
        const password = document.querySelector("#password").value;

        // Se valida el formato del RUT
        if (!validarRut(rut)) {
            Swal.fire({
                icon: "error",
                title: "RUT inválido",
                text: "Por favor, ingresa un RUT válido.",
                showConfirmButton: false,
                timer: 1500,
            });
            return;
        }

        // Se envían los datos del formulario al servidor
        $.ajax({
            url: "api/auth/login.php",
            method: "POST",
            data: {
                rut: rut,
                password: password,
            },
        }).done(function (response) {
            const result = JSON.parse(response);
            if (result.success) {
                Swal.fire({
                    icon: "success",
                    title: "¡Bienvenido!",
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    window.location.href = result.redirect;
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    const registrationForm = document.querySelector("#registration-form");

    // Se valida RUT (restricción de carácteres, distinto a función validarRut de más arriba)
    function validarRutInput(rut) {
        const regex = /^[0-9]+[kK0-9]$/; // Solo números y 'K'/'k'
        return regex.test(rut);
    }

    // Se valida teléfono
    function validarTelefonoInput(telefono) {
        const regex = /^[0-9]+$/; // Solo números
        return regex.test(telefono);
    }

    // Se valida nombre de usuario
    function validarNombreUsuarioInput(nombreUsuario) {
        const regex = /^[a-zA-Z0-9_]+$/; // Solo letras, números y guion bajo
        return regex.test(nombreUsuario);
    }

    // Se valida contraseña
    function validarPasswordInput(password) {
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/; // Mínimo 8 caracteres, 1 minúscula, 1 mayúscula, 1 número
        return regex.test(password);
    }

    if (registrationForm) {
        registrationForm.addEventListener("submit", async (event) => {
            event.preventDefault();

            const rut = document.getElementById("rut").value.trim();
            const telefono = document.getElementById("telefono").value.trim();
            const nombreUsuario = document.getElementById("nombre_usuario").value.trim();
            const password = document.getElementById("password").value.trim();
            const confirmarPassword = document.getElementById("confirmar_password").value.trim();

            // Validaciones
            if (!validarRut(rut) || !validarRutInput(rut)) {
                Swal.fire({
                    title: "Error",
                    text: "El RUT ingresado no es válido. Debe contener solo números y una 'K' si corresponde.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            if (!validarTelefonoInput(telefono)) {
                Swal.fire({
                    title: "Error",
                    text: "El teléfono solo puede contener números.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            if (!validarNombreUsuarioInput(nombreUsuario)) {
                Swal.fire({
                    title: "Error",
                    text: "El nombre de usuario solo puede contener letras, números y guion bajo (_).",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            if (!validarPasswordInput(password)) {
                Swal.fire({
                    title: "Error",
                    text: "La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            if (password !== confirmarPassword) {
                Swal.fire({
                    title: "Error",
                    text: "Las contraseñas no coinciden.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            const formData = new FormData(registrationForm);
            
            // Se obtiene dirección y comuna desde el formulario de registro
            const direccion = formData.get("direccion");
            const comuna = document.querySelector("#comuna option:checked").text;

            if (!direccion || !comuna) {
                Swal.fire({
                    title: "Error",
                    text: "Debe ingresar una dirección y seleccionar una comuna",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            // Se geocodifica dirección + comuna
            const query = `${direccion}, ${comuna}`;
            try {
                const geocodeResponse = await fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&limit=1`);
                const geocodeData = await geocodeResponse.json();

                if (geocodeData.length > 0) {
                    const { lat, lon } = geocodeData[0];
                    document.getElementById("latitud").value = lat;
                    document.getElementById("longitud").value = lon;
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "No se pudo geocodificar la dirección. Por favor, verifica los datos ingresados.",
                        icon: "error",
                        button: "Aceptar",
                    });
                    return;
                }
            } catch (error) {
                Swal.fire({
                    title: "Error",
                    text: "Ocurrió un error al geocodificar la dirección.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            // Se recrea FormData después de actualizar los valores dinámicos
            const updatedFormData = new FormData(registrationForm);

            // Se envían los datos del formulario al servidor
            try {
                const response = await fetch("api/auth/register.php", {
                    method: "POST",
                    body: updatedFormData,
                });

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        title: "Registro exitoso",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "Aceptar",
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.href = "index.php?p=auth/login";
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: data.message,
                        icon: "error",
                        button: "Aceptar",
                    });
                }
            } catch (error) {
                Swal.fire({
                    title: "Error",
                    text: "Ocurrió un error en el servidor. Intente más tarde.",
                    icon: "error",
                    button: "Aceptar",
                });
            }
        });
    }
});

const logout = document.querySelector("#logout");

if (logout) {
    logout.addEventListener("click", (event) => {
        event.preventDefault();
        $.ajax({
            url: "api/auth/logout.php",
            method: "POST",
        }).done(function (response) {
            console.log(response);
            const result = JSON.parse(response);
            console.log(result);
            if (result.success) {
                Swal.fire({
                    icon: "success",
                    title: "¡Hasta luego!",
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    window.location.href = "index.php";
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "¡Error!",
                    text: result.message,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });
    });
}
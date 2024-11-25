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

    // Se muestran u ocultan campos adicionales según el rol seleccionado
    const camposProfesional = document.getElementById("campos_profesional");
    const rolInputs = document.querySelectorAll('input[name="rol"]');

    if (rolInputs) {
        rolInputs.forEach((input) => {
            input.addEventListener("change", (event) => {
                if (event.target.value === "3") {
                    camposProfesional.style.display = "block";
                } else {
                    camposProfesional.style.display = "none";
                }
            });
        });
    }

    if (registrationForm) {
        registrationForm.addEventListener("submit", async (event) => {
            event.preventDefault();

            const formData = new FormData(registrationForm);

            // Se valida el RUT
            const rutInput = document.getElementById("rut");
            if (!validarRut(rutInput.value)) {
                Swal.fire({
                    title: "Error",
                    text: "El RUT ingresado no es válido.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            // Se verifican las contraseñas
            const password = document.getElementById("password").value;
            const confirmarPassword = document.getElementById("confirmar_password").value;
            if (password !== confirmarPassword) {
                Swal.fire({
                    title: "Error",
                    text: "Las contraseñas no coinciden.",
                    icon: "error",
                    button: "Aceptar",
                });
                return;
            }

            // Se verifican archivos si el rol es profesional
            const rol = formData.get("rol");
            if (rol === "3") {
                const fotoPerfil = document.getElementById("foto_perfil").files[0];
                const tituloProfesional = document.getElementById("titulo_profesional").files[0];

                if (!fotoPerfil || !tituloProfesional) {
                    Swal.fire({
                        title: "Error",
                        text: "Debe cargar la foto de perfil y el título profesional.",
                        icon: "error",
                        button: "Aceptar",
                    });
                    return;
                }
            }

            try {
                // Se envían los datos del formulario al servidor
                const response = await fetch("api/auth/register.php", {
                    method: "POST",
                    body: formData,
                });

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        title: "Registro exitoso",
                        text: data.message,
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar",
                        allowOutsideClick: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "index.php?p=auth/login";
                        }
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
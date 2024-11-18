const loginForm = document.querySelector("#login-form");

if (loginForm) {
    loginForm.addEventListener("submit", (event) => {
        // Prevenir el comportamiento predeterminado del formulario al enviarlo
        event.preventDefault();

        // Obtener los valores del formulario
        const rut = document.querySelector("#rut").value;
        const password = document.querySelector("#password").value;

        console.log(rut, password);

        // Enviar los datos del formulario al servidor
        $.ajax({
            url: "api/auth/login.php",
            method: "POST",
            data: {
                rut: rut,
                password: password,
            },
        }).done(function (response) {
            // console.log(response);
            const result = JSON.parse(response);
            // console.log(result);
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

const registrationForm = document.querySelector("#registration-form");

if (registrationForm) {
    registrationForm.addEventListener("submit", (event) => {
        event.preventDefault();

        // Crear un objeto FormData para enviar los datos del formulario
        const formData = new FormData(registrationForm);

        // Obtener el rol seleccionado y agregarlo a FormData
        const rolSeleccionado = document.querySelector('input[name="rol"]:checked');
        const rol = rolSeleccionado ? rolSeleccionado.value : null;
        formData.append("rol", rol);

        // Verificar si el rol es "Profesional" (ejemplo: ID = "3")
        if (rol === "3") {
            // Obtener los archivos de foto_perfil y titulo_profesional y agregarlos a FormData
            const fotoPerfilInput = document.querySelector("#foto_perfil");
            const tituloProfesionalInput = document.querySelector("#titulo_profesional");

            if (fotoPerfilInput.files.length > 0) {
                formData.append("foto_perfil", fotoPerfilInput.files[0]);
            }

            if (tituloProfesionalInput.files.length > 0) {
                formData.append("titulo_profesional", tituloProfesionalInput.files[0]);
            }
        }

        // Enviar los datos del formulario al servidor
        $.ajax({
            url: "api/auth/register.php",
            method: "POST",
            data: formData,
            processData: false, // Evita que jQuery procese los datos (porque es FormData)
            contentType: false, // Evita que jQuery configure el contentType
        })
        .done(function (response) {
            const data = JSON.parse(response);
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
        })
        .fail(function () {
            Swal.fire({
                title: "Error",
                text: "Error en el servidor. Intente de nuevo más tarde.",
                icon: "error",
                button: "Aceptar",
            });
        });
    });
}

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

const busqueda = document.querySelector("#logout");
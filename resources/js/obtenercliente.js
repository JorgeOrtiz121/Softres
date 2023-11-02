$(document).ready(function () {
    $('.autocompletar').on('input', function () {
        var cedula = $(this).val();

        if (cedula.length >= 10) {
            // Realizar una solicitud AJAX al servidor para obtener los datos del cliente
            $.ajax({
                url: '/obtener-datos-cliente', // Reemplaza esto con la URL de tu controlador
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cedula: cedula
                },
                success: function (response) {
                    if (response && response.nombre) {
                        // Rellenar los campos con los datos del cliente
                        $('#nombre').val(response.nombre);
                        $('#email').val(response.email);
                        $('#direccion').val(response.direccion);
                    } else {
                        var confirmar = confirm('No se encontraron datos para esta cédula. ¿Desea redirigir a la seccion de clientes para su registro?');
                        if (confirmar) {
                            window.location.href = '/comercio/clientes/crear'; // Reemplaza con la URL de tu página de destino
                        } else {
                            $('#nombre').val("");
                            $('#email').val("");
                            $('#direccion').val("");
                        }                  
                    }
                },
                error: function () {
                    // Manejo de errores si es necesario
                }
            });
        }
    });
});
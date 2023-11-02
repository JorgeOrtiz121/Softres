$(document).ready(function () {
    $('#forma').change(function() {
        var valorSeleccionado = $(this).val();

        // Mostrar u ocultar el campo adicional según la selección
        if (valorSeleccionado === 'Tarjeta de Credito') {
            $('#campoTarjetaCredito').show();
            $.ajax({
            url: '/obtener-tipo-tarjeta', // Reemplaza esto con la URL de tu controlador
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                forma: valorSeleccionado
            },
            success: function (response) {
                var $select = $('#tipoTarjeta'); // Obtén el elemento <select>

              $select.empty(); // Limpia las opciones actuales

             $.each(response.opciones, function (key, value) {
            $select.append($('<option>', {
              value: key,
              text: value
             }));
             });
            },
            error: function () {
                // Manejo de errores si es necesario
            }
        });
        } else {
            $('#campoTarjetaCredito').hide();
        }
    });
});
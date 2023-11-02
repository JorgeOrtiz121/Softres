$(document).ready(function () {
    $('#forma').change(function() {
        var valorSeleccionado = $(this).val();

        if (valorSeleccionado) {
            $.ajax({
                url: '/obtener-valor-seleccionado', // Reemplaza esto con la URL de tu controlador
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    forma: valorSeleccionado
                },
                success: function (response) {
                    var $select = $('#tipopago'); // Obtén el elemento <select>

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
        }
    });
});
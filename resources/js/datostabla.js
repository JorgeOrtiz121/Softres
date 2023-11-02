$(document).ready(function () {
    // Manejar el evento de entrada en los inputs de artículo
    $(document).on('input', '.articuloInput', function () {
        var articulo = $(this).val();
        var filaActual = $(this).closest('tr');
        var proximaFila = filaActual.next();

        // Realizar una solicitud AJAX al servidor para obtener los datos del artículo
        $.ajax({
            url: '/obtener-datosde-tabla', // Reemplaza esto con la URL de tu controlador
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                articulo: articulo
            },
            success: function (response) {
                if (response && response.codigo) {
                    // Rellenar los campos de la fila actual con los datos del artículo
                    filaActual.find('#numserie').text(response.id);
                    filaActual.find('#codart').text(response.codigo);
                    filaActual.find('#punit').text(response.precio_compra_sin_iva);
                    filaActual.find('#total').text(response.id_iva);
                    filaActual.find('#stock').text(response.stock_actual);
                } else {
                    // Limpia los campos de la fila actual si no se encontraron datos
                    filaActual.find('#numserie').text('');
                    filaActual.find('#codart').text('');
                    filaActual.find('#punit').text('');
                    filaActual.find('#total').text('');
                    filaActual.find('#stock').text('');
                }

              // Verificar si ya existe una fila vacía al final de la tabla
        var filas = $('#miTabla tbody tr');
        var ultimaFila = filas[filas.length - 1];
        var inputUltimaFila = $(ultimaFila).find('.articuloInput');

        // Crear una nueva fila solo si la última fila no está vacía
        if (articulo.trim() !== '' && inputUltimaFila.val() !== '') {
            var newRow = filaActual.clone(true); // Clonar la fila actual y sus eventos
            newRow.find('.articuloInput').val(''); // Limpiar el input del nuevo artículo
            $('#miTabla tbody').append(newRow); // Agregar la nueva fila a la tabla
        }
            },
            error: function () {
                // Manejo de errores si es necesario
            }
        });
    });
});




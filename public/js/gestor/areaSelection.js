$(document).ready(function () {
    $.ajax({
        url: '/api/areas',
        method: 'GET',
        success: function (response) {
            response.forEach(function (area) {
                $('#areasSelect').append(new Option(area.name_area, area.id));
            });
        },
        error: function (xhr, status, error) {
            console.error('Error en la solicitud AJAX:', xhr, status, error);
        }
    });
});

function agregarALista() {
    var select = document.getElementById('areasSelect');
    var tabla = document.getElementById('tablaAreas').getElementsByTagName('tbody')[0];

    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].selected && select.options[i].value !== '0') {
            var fila = tabla.insertRow();
            fila.classList.add('text-center');
            fila.classList.add('text-light');
            var celda1 = fila.insertCell(0);
            var celda2 = fila.insertCell(1);

            celda1.innerHTML = select.options[i].text;
            celda2.innerHTML =
                '<button class="btn btn-danger" type="button" onclick="quitarDeLista(this, \'' + select.options[i].value + '\')"><i class="bi bi-trash3"></i><span class="d-none d-sm-inline"> Eliminar</span></button>';

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'areas_list[]';
            input.value = select.options[i].value;
            fila.appendChild(input);

            select.options[i].disabled = true; // Deshabilita la opción en el select
            select.options[i].selected = false; // Deselecciona la opción
        }
    }
}

function quitarDeLista(btn, valor) {
    var select = document.getElementById('areasSelect');
    var fila = btn.parentNode.parentNode;
    fila.parentNode.removeChild(fila);

    // Re-habilita la opción en el select
    for (var i = 0; i < select.options.length; i++) {
        if (select.options[i].value === valor) {
            select.options[i].disabled = false;
            break;
        }
    }
}

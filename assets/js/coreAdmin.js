function generarID_longitud(longitud) {
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
    var contraseña = "";
    for (i = 0; i < longitud; i++)
        contraseña += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    return contraseña;
}

//--- DROPDOWN MENU TABLE ---//
$(document).ready(function() {
    $('.table-responsive').on('show.bs.dropdown', function() {
        $('.table-responsive').css("overflow", "inherit");
    });
    $('.table-responsive').on('hide.bs.dropdown', function() {
        $('.table-responsive').css("overflow", "auto");
    })
})

//--- CHECK BOX ---//
function compruebaCheckBoxSwitch(idCheckBox) {
    var estadoCheck = $('#' + idCheckBox).is(':checked');
    if (estadoCheck) {
        return true;
    } else {
        return false;
    }
}

//--- FORMAT NUMBER ---//
function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);
    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');
    //return amount_parts.join('.');
    return amount_parts.toLocaleString('.');
}

//--- SELECT CBU/ALIAS ---//
function modificarTexbox() {
    document.getElementById("inputCBU").value = "";
    document.getElementById("inputCBU").disabled = false;
    switch (document.getElementById("selectCBU").value) {
        case "1":
            document.getElementById("inputCBU").setAttribute("pattern", "\\d*");
            document.getElementById("inputCBU").setAttribute("minlength", "22");
            document.getElementById("inputCBU").setAttribute("maxlength", "22");
            document.getElementById('inputCBU').type = 'text';
            break;
        case "2":
            document.getElementById("inputCBU").removeAttribute("pattern");
            document.getElementById("inputCBU").setAttribute("minlength", "5");
            document.getElementById("inputCBU").setAttribute("maxlength", "50");
            document.getElementById('inputCBU').type = 'text';
            break;
    }
}

//--- DATE PICKER---//
$(document).ready(function() {
    $.datetimepicker.setLocale('es');
    $('#min-date').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-ventas-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-ventas-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-egresos-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-egresos-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-gastos-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-gastos-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-abonos-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-abonos-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-cte-clientes-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-cte-clientes-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-cte-proveedores-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-cte-proveedores-informe').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fechaDesdeMovTesoreria').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fechaHastaMovTesoreria').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaCobro').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaCobroCobrar').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaCobroVenta').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaInicioAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaPrimeraVenta').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaFinAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fechaNuevoCobro').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaGasto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaPagoCompra').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaPagoCompra_formModificarCompra').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmisionCompra').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmisionCompra_formModificarCompra').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaPago').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaMovimiento').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fechaDesdeMovCaja').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fechaHastaMovCaja').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formNuevoPresupuesto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaCobroPresupuesto_formNuevoPresupuesto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formEditarAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaCobro_formEditarAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaInicioAbono_formEditarAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaFinAbono_formEditarAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaPrimeraVenta_formEditarAbono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVtoGasto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVtoGasto_modificarGasto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaGasto_modificarGasto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVigencia_formNuevoPresupuesto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVigencia_formModificarPresupuesto').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#fecha-arqueo-cajas').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputInicioActividad_formConfiguracionSistema').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaInicioServicio').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaFinServicio').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaInicioServicio_update').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaFinServicio_update').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaInicioServicio_abono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaFinServicio_abono').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaInicioServicio_abonoupdate').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaFinServicio_abonoupdate').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formNuevaNotaDebito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formNuevaNotaDebito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formNuevaNotaCredito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formNuevaNotaCredito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formModificarNotaDebito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formModificarNotaDebito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formModificarNotaCredito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formModificarNotaCredito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formNuevaNotaDebitoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formNuevaNotaDebitoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formNuevaNotaCreditoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formNuevaNotaCreditoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formModificarNotaDebitoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formModificarNotaDebitoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formModificarNotaCreditoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaVencimiento_formModificarNotaCreditoProveedor').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-libro-iva-ventas').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-libro-iva-ventas').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#min-date-listado-libro-iva-compra').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#max-date-listado-libro-iva-compra').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
    $('#inputFechaEmision_formNuevoRemito').datetimepicker({
        lang: 'es',
        //mask:'dd/mm/aaaa',
        timepicker: false,
        //startDate:'1900/01/01',
        format: 'Y-m-d',
        formatDate: 'Y-m-d',
        //minDate:'-1970/01/02', // yesterday is minimum date
        //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
    });
});
//--- TAGS COMERCIOS ---//
$(document).ready(function() {
    var tagApiPc = $(".tm-input-pc").tagsManager();
    $(".typeahead-pc").typeahead({
        name: "tags",
        displayKey: "name",
        source: function(query, process) {
            ////console.log(query);
            $.ajax({
                url: URL + 'beneficio_rojo/get_tags',
                type: 'POST',
                data: 'query=' + query,
                dataType: 'JSON',
                async: true,
                success: function(data) {
                    //console.log(data);
                    process(data);
                }
            });
        },
        afterSelect: function(item) {
            tagApiPc.tagsManager("pushTag", item);
        }
    });
})

function generaTags(etiquetas) {
    var tagApiPc = $(".tm-input-pc").tagsManager();
    tagApiPc.tagsManager("pushTag", etiquetas);
}

//--- RESET FORM TESORERIA ---//
function resetFormCuentaTesoreria() {
    document.getElementById("formCuentaTesoreria").reset();
    document.getElementById('inputIdCuenta_formCuentasTesoreria').value = null;
    $('#selectTipoCuenta_formCuentasTesoreria').val(0).trigger('change');
    $("#errorInputNombCuenta_formCuentasTesoreria").css("display", "none");
    $("#errorSelectTipoCuenta_formCuentasTesoreria").css("display", "none");
}

//--- RESET FORM MOVIMIENTOS CUENTAS---//
function resetFormMovimientoCuentas() {
    document.getElementById("formMovimientoCuentas").reset();
    document.getElementById('inputFechaMovimiento').value = null;
    document.getElementById('montoMovimiento').value = null;
    document.getElementById('descripcionMovimiento').value = null;
    $('#selectCuentaSalida').val(0).trigger('change');
    $('#selectCuentaEntrada').val(0).trigger('change');
    $("#errormontoMovimiento").css("display", "none");
    $("#errorselectCuentaSalida").css("display", "none");
    $("#errorselectCuentaEntrada").css("display", "none");
}

//--- TESORERIA ---//
$(function() {
    $('#nuevaCuentaTesoreria').click(function(e) {
        e.preventDefault();
        var inputIdCuenta = $('#inputIdCuenta_formCuentasTesoreria').val();
        var inputNombCuenta = $('#nombCuenta_formCuentasTesoreria').val();
        var selectTipoCuenta = $('#selectTipoCuenta_formCuentasTesoreria').val();
        var val1, val2;
        var PostCuenta;
        //inputNota
        if (inputNombCuenta == null || inputNombCuenta.length == 0 || /^\s+$/.test(inputNombCuenta)) {
            $("#errorInputNombCuenta_formCuentasTesoreria").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputNombCuenta_formCuentasTesoreria").css("display", "none");
            val1 = true;
        }

        //selectCatVentas
        if (selectTipoCuenta == null || selectTipoCuenta.length == 0 || selectTipoCuenta == 0) {
            $("#errorSelectTipoCuenta_formCuentasTesoreria").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectTipoCuenta_formCuentasTesoreria").css("display", "none");
            val2 = true;
        }

        if (val1 && val2) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formCuentaTesoreria")[0]);
            //inputIdCuenta
            if (inputIdCuenta != null && inputIdCuenta.length != 0) {
                PostCuenta = 'tesoreria/update_cuenta_tesoreria/';
            } else {
                PostCuenta = 'tesoreria/set_cuenta_tesoreria/';
            }

            $.ajax({
                    url: URL + PostCuenta,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Cuenta Tesoreria',
                            dato['msg'],
                            'success'
                        )
                        $("#popUpError").modal("hide");
                        resetFormCuentaTesoreria();
                        //console.log(dato['cuenta'][0]['idTipoCuenta']);
                        //console.log(dato['cuenta']);
                        var table = $('#' + dato['cuenta'][0]['idTipoCuenta']).DataTable();
                        if (inputIdCuenta != null && inputIdCuenta.length != 0) {
                            $('#' + dato['cuenta'][0]['idTipoCuenta']).dataTable().fnDeleteRow("#" + inputIdCuenta);
                        }

                        var idGenCuenta = "'" + dato['cuenta'][0]['idGenCuenta'] + "'";
                        var idTipoCuenta = "'" + dato['cuenta'][0]['idTipoCuenta'] + "'";
                        var row = table.row.add([
                            dato['cuenta'][0]['descripcion'],
                            '<a href="#modal-delete" data-toggle="modal" role="button" onclick="deleteCuentaTesoreria(' + idGenCuenta + ',' + idTipoCuenta + ')" class="tip">' +
                            '<i class="icon-remove4"></i>' +
                            '</a>' +
                            '&nbsp;&nbsp;&nbsp;' +
                            '<a href="#modal-cuenta-tesoreria" data-toggle="modal" role="button" onclick="resetFormCuentaTesoreria();editarCuentaTesoreria(' + idGenCuenta + ',' + idTipoCuenta + ')" class="tip">' +
                            '<i class="icon-pencil3"></i>' +
                            '</a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['cuenta'][0]['idGenCuenta']);
                        table.row(row).column(0).nodes().to$().addClass('text-right');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        swal(
                            'Cuenta Tesoreria',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
        }
    });
})

function editarCuentaTesoreria(idGenCuenta, idTipoCuenta) {
    //console.log(idGenCuenta);
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'tesoreria/get_info_cuenta_tesoreria/',
            type: 'POST',
            cache: false,
            data: {
                id: idGenCuenta
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                $("#popUpError").modal("hide");
                resetFormCuentaTesoreria();
                //--- CARGO DATOS ---//
                $('#selectTipoCuenta_formCuentasTesoreria').val(dato['cuenta'][0]['idTipoCuenta']).trigger('change');
                document.getElementById('inputIdCuenta_formCuentasTesoreria').value = dato['cuenta'][0]['idGenCuenta'];
                document.getElementById('nombCuenta_formCuentasTesoreria').value = dato['cuenta'][0]['descripcion'];
            } else {
                $("#modal-cargando").modal("hide");
                $("#modal-exitoso").modal("hide");
                $("#popUpError").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}

function deleteCuentaTesoreria(idGenCuenta, idTipoCuenta) {
    //e.preventDefault();
    $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

    var idGenCuenta = idGenCuenta;
    var idTipoCuenta = idTipoCuenta;
    ////console.log(idGenCuenta);
    ////console.log(idTipoCuenta);
    $('.button-delete-si').click(function(e) {
        e.preventDefault();
        $("#modal-delete").modal("hide");
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'tesoreria/eliminar_cuenta_tesoreria/',
                type: 'POST',
                cache: false,
                data: {
                    id: idGenCuenta
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                ////console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    swal(
                        'Cuenta Tesoreria',
                        dato['msg'],
                        'success'
                    )
                    $('body #gen_' + idGenCuenta).remove();
                    $('#' + idTipoCuenta).dataTable().fnDeleteRow("#" + idGenCuenta);
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    swal(
                        'Cuenta Tesoreria',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");
            });
    })
}

//--- CATEGORIA ---//
$(function() {
    $('.editarCategoria').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'categorias/get_categoria_by_idCategoria/',
                type: 'POST',
                dataType: 'json',
                data: { id: id }
            })
            .done(function(data) {

                if (data) {
                    $("#modal-cargando").hide();
                    $('#idCategoria').val(data['categoria']['idCategoria']);
                    $('#descripcionCategoria').val(data['categoria']['descripcion']);
                    $("#boxTags").html("");
                } else {
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    });
    $('#editarCategoria').click(function(e) {
        e.preventDefault();
        var val1;
        var descripcionCategoria = $('#descripcionCategoria').val();
        if (descripcionCategoria == null || descripcionCategoria.length == 0 || descripcionCategoria == ' ' || descripcionCategoria == '') {
            $("#errordescripcionCategoria").css("display", "block");
            val1 = false;
        } else {
            $("#errordescripcionCategoria").css("display", "none");
            val1 = true;
        }

        if (val1) {
            var formData = new FormData($("#form-edit-categoria")[0]);
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'categorias/modificar/',
                    type: 'POST',
                    data: formData,
                    //necesario para subir archivos via ajax
                    cache: false,
                    contentType: false,
                    processData: false

                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-editar-categoria").modal("hide");
                        $("#operacionExitosa").modal("show");
                    } else {
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function() {
                    $("#popUpError").modal("show");
                });
        }
    });
    $("#listadoCategorias").on("click", "a.eliminarCategoria", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

        var id = $(this).data('id');
        var dataString = 'id=' + id;
        $('.button-delete-si').click(function(e) {
            $("#modal-cargando").modal("show");
            $.ajax({
                type: "POST",
                url: URL + "categorias/eliminar_categoria/",
                data: dataString,
                success: function(data) {
                    data = JSON.parse(data)

                    if (data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-eliminar-categoria").modal("hide");
                        $("#eliminacion-exitosa").modal("show");
                        setTimeout(function() {
                            location.href = URL + 'categorias';
                        }, 850);
                    } else {
                        $("#modal-eliminar-categoria").modal("hide");
                        $("#popUpError").modal("show");
                    }
                },
                error: function() {
                    $("#popUpError").modal("show");
                }
            });
        });
    });
    $('#agregarCategoria').click(function(e) {
        e.preventDefault();
        var val1;
        var descripcionCategoriaAgregar = $('#descripcionCategoriaAgregar').val();
        if (descripcionCategoriaAgregar == null || descripcionCategoriaAgregar.length == 0 || descripcionCategoriaAgregar == ' ' || descripcionCategoriaAgregar == '') {
            $("#errordescripcionCategoriaAgregar").css("display", "block");
            val1 = false;
        } else {
            $("#errordescripcionCategoriaAgregar").css("display", "none");
            val1 = true;
        }

        if (val1) {
            $("#modal-agregar-categoria").modal("hide");
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#form-agregar-categoria")[0]);
            $.ajax({
                    url: URL + 'categorias/insert_categoria/',
                    type: 'POST',
                    data: formData,
                    //necesario para subir archivos via ajax
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#operacionExitosa").modal("show");
                        setTimeout(function() {
                            location.href = URL + 'categorias';
                        }, 2000);
                    } else {
                        $("#popUpError").modal("show");
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
    $('#btnAgregarCobro').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4 = true;
        var idGenIngresoCobro = $('#idGenIngresoCobro').val();
        var montoAdeudado = parseFloat($('#montoAdeudado').val());
        var montoCobro = parseFloat($('#montoCobro').val());
        var saldoAFavor = parseFloat($('#saldoAFavor').val());
        var selectMedioCobro = $('#selectMedioCobro').val();
        var selectSaldoAFavor = $('#selectSaldoAFavor').val();
        //        var descripcionCobro = $('#descripcionCobro').val();

        if (idGenIngresoCobro == null || idGenIngresoCobro.length == 0 || idGenIngresoCobro == ' ' || idGenIngresoCobro == '') {
            val1 = false;
        } else {
            val1 = true;
        }
        if ((montoCobro == 0 && saldoAFavor > 0 && selectSaldoAFavor == 0) || (montoCobro > 0 && (montoCobro <= (montoAdeudado - saldoAFavor)) && selectSaldoAFavor == 0) || (montoCobro > 0 && selectSaldoAFavor == 1)) {
            $("#errormontoCobro").css("display", "none");
            val2 = true;
            //            if (montoCobro > montoAdeudado) {
            //                document.getElementById("msgError").innerHTML = "No puede poner un monto superior al adeudado.";
            //                $("#popUpErrorMsg").modal("show");
            //                val2 = false;
            //            }
        } else {
            $("#errormontoCobro").css("display", "block");
            val2 = false;
        }
        if (selectMedioCobro == 0) {
            $("#errorselectMedioCobro").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectMedioCobro").css("display", "none");
            val3 = true;
        }
        //        if (descripcionCobro == null || descripcionCobro.length == 0 || descripcionCobro == ' ' || descripcionCobro == '') {
        //            $("#errordescripcionCobro").css("display", "block");
        //            val4 = false;
        //        } else {
        //            $("#errordescripcionCobro").css("display", "none");
        //            val4 = true;
        //        }

        //--- si es 1 no quiere incluir el dinero a favor, entonces lo convertimos en 0 por el motivo de que si tiene monto a favor no se validara correctamente la siguiente verificacion ---//
        if (selectSaldoAFavor == 1) {
            saldoAFavor = 0;
        }

        //--- Verificación que el monto ingresado entre el a favor con el monto a cobrar no supere la deuda ---//
        //        if (montoAdeudado <= montoCobro + saldoAFavor) {
        //            val4 = false;
        //        }


        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formAgregarCobro")[0]);
            $.ajax({
                    url: URL + 'ventas/set_cobro/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                //console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-agregar-cobro").modal("hide");
                        $("#operacionExitosa").modal("show");
                        var idGenIngreso = dato['idGenIngreso'];
                        $.ajax({
                                url: URL + 'ventas/generaPDFcupon/' + dato['idGenIngreso'],
                                type: 'POST',
                                cache: false,
                            })
                            .done(function(data) {
                                $("#operacionExitosa").modal("hide");
                                var dato = JSON.parse(data);
                                ////console.log(dato);
                                if (dato['valid']) {
                                    //--- eliminado y agregado del resgistro ---//
                                    var table = $('#listadoIngresos').DataTable();
                                    $("#listadoIngresos").dataTable().fnDeleteRow("#" + dato['ingreso'][0]['idIngreso']);
                                    var texto = "";
                                    var clase = "";
                                    var bloque1;
                                    var bloque2;
                                    var factura;
                                    if (dato['ingreso'][0]['idEstado'] == 1) {
                                        clase = "btn-success";
                                        texto = "Cobrado";
                                    } else if (dato['ingreso'][0]['idEstado'] == 2) {
                                        clase = "btn-info";
                                        texto = "A Cobrar";
                                    } else if (dato['ingreso'][0]['idEstado'] == 3) {
                                        clase = "btn-danger";
                                        texto = "Vencido";
                                    } else {
                                        clase = "btn-warning";
                                        texto = "Sin Estado";
                                    }

                                    var facturaIdIngreso = dato['ingreso'][0]['facturaIdIngreso'];
                                    if (dato['ingreso'][0]['idUsuario'] != 28 && dato['ingreso'][0]['idUsuario'] != 29 && facturaIdIngreso == false) {
                                        bloque1 = '<li><a href="' + URL + 'ventas/editar_venta/' + dato['ingreso'][0]['idIngreso'] + '"><i class="icon-cogs"></i> Editar</a></li>' +
                                            '<li><a href="#modal-delete" class="tip deleteIngreso" data-id="' + dato['ingreso'][0]['idIngreso'] + '" data-toggle="modal" ><i class="icon-close"></i> Eliminar</a></li>' +
                                            '<li class="divider"></li>';
                                    } else {
                                        bloque1 = '';
                                    }

                                    //--- Opcion de facturacion ---//
                                    if (facturaIdIngreso) {
                                        factura = '<li><a href="#" onclick=""><i class="icon-binoculars"></i> Ver Factura</a></li>';
                                    } else {
                                        factura = '<li><a href="#" onclick=""><i class="fas fa-file-invoice-dollar fa-lg"></i> Facturar Venta</a></li>';
                                    }

                                    idGenIngreso = "'" + dato['ingreso'][0]['idGenIngreso'] + "'";
                                    if (dato['ingreso'][0]['idUsuario'] != 28 && dato['ingreso'][0]['idUsuario'] != 29) {
                                        bloque2 = '<li><a onclick="abrir_nc(' + idGenIngreso + ')"><i class="icon-notebook"></i> Crear NC</a></li>' +
                                            '<li><a onclick="abrir_nd(' + idGenIngreso + ')"><i class="icon-notebook"></i> Crear ND</a></li>' +
                                            '<li><a href="' + URL + 'remitos/agregar_remito/' + dato['ingreso'][0]['idGenIngreso'] + '"><i class="icon-newspaper"></i> Crear remito</a></li>' +
                                            '<li><a onclick="llenado_tabla_cta_cte_clientes(' + dato['ingreso'][0]['idCliente'] + ')" ><i class="icon-clipboard"></i> Cta Cte</a></li>' +
                                            '<li class="divider"></li>' +
                                            factura +
                                            '<li><a href="#" onclick="verComprobantesPagos(' + idGenIngreso + ')"><i class="icon-binoculars"></i> Comprobantes</a></li>' +
                                            '<li><a href="' + URL + 'notas_credito_debito/nota_credito_debito_venta/' + dato['ingreso'][0]['idGenIngreso'] + '"><i class="icon-binoculars"></i> Detalle</a></li>' +
                                            '<li><a href="#" onclick="generarPdfDetalleVenta(' + idGenIngreso + ')"><i class="icon-binoculars"></i> Ver detalle</a></li>' +
                                            '<li><a href="#" onclick="enviarDetalleVenta(' + idGenIngreso + ')" ><i class="icon-attachment"></i> Enviar detalle</a></li>';
                                    }

                                    var opcion = ' <div class="btn-group">' +
                                        '<button class="btn ' + clase + '" style="padding: 3px;font-size: 0.8em;">' + texto + '</button>' +
                                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                        '<ul class="dropdown-menu icons-right">' +
                                        bloque1 +
                                        '<li><a class="tip" onclick="llenado_apertura_agregarCobro(' + idGenIngreso + ')" ><i class="icon-tag5"></i> Agregar cobranza</a></li>' +
                                        bloque2 +
                                        '</ul>' +
                                        '</div>';
                                    var row = table.row.add([
                                        opcion,
                                        dato['ingreso'][0]['fechaEmision'],
                                        dato['ingreso'][0]['fechaVtoCobro'],
                                        dato['ingreso'][0]['nombEmpresa'],
                                        dato['ingreso'][0]['categoriaVenta'],
                                        "$" + number_format(parseFloat(dato['ingreso'][0]['total']) + parseFloat(dato['ingreso'][0]['descuentoTotal']), 2, ",", "."),
                                        "$" + number_format(dato['ingreso'][0]['descuentoTotal'], 2, ",", "."),
                                        "$" + number_format(dato['ingreso'][0]['total'], 2, ",", "."),
                                        "$" + number_format(dato['ingreso'][0]['total'], 2, ",", "."),
                                        "$" + number_format(dato['ingreso'][0]['aCobrar'], 2, ",", "."),
                                        "$" + number_format(dato['ingreso'][0]['total'] - dato['ingreso'][0]['aCobrar'], 2, ",", "."),
                                        dato['ingreso'][0]['nombreVend'],
                                    ]).draw(false);
                                    row.nodes().to$().attr('id', dato['ingreso'][0]['idIngreso']);
                                    table.row(row).column(0).nodes().to$().addClass('text-center');
                                    table.row(row).column(1).nodes().to$().addClass('text-center');
                                    table.row(row).column(2).nodes().to$().addClass('text-center');
                                    table.row(row).column(3).nodes().to$().addClass('text-center');
                                    table.row(row).column(4).nodes().to$().addClass('text-center');
                                    table.row(row).column(5).nodes().to$().addClass('text-right');
                                    table.row(row).column(6).nodes().to$().addClass('text-right');
                                    table.row(row).column(7).nodes().to$().addClass('text-right');
                                    table.row(row).column(8).nodes().to$().addClass('text-right');
                                    table.row(row).column(9).nodes().to$().addClass('text-right');
                                    table.row(row).column(10).nodes().to$().addClass('text-right');
                                    table.row(row).column(11).nodes().to$().addClass('text-center');

                                    swal({
                                        title: "Comprobante",
                                        text: "Transaccion",
                                        //type: "info",
                                        width: "800px",
                                        html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/cobro/' + dato['ingreso'][0]['idGenIngreso'] + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                                        showCancelButton: false,
                                        confirmButtonText: 'Cerrar',
                                    })

                                } else {
                                    swal(
                                        'Error',
                                        dato['msg'],
                                        'error'
                                    )
                                }
                            })
                            .fail(function(data) {
                                $("#operacionExitosa").modal("hide");
                                $("#popUpError").modal("show");
                            });
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
    $('#btnAgregarCobroGasto').click(function(e) {
        e.preventDefault();
        var val1, val2;
        var idGenGasto = $('#idGenGasto').val();
        var montoAdeudado = parseFloat($('#montoAdeudado_formAgregarCobroGasto').val());
        var montoCobro = parseFloat($('#montoCobro_formAgregarCobroGasto').val());
        var medioCobro = parseFloat($('#selectMedioCobro_formAgregarCobroGasto').val());

        if (montoCobro == 0) {
            $("#errormontoCobro_formAgregarCobroGasto").css("display", "block");
            val1 = false;
        } else {
            $("#errormontoCobro_formAgregarCobroGasto").css("display", "none");
            val1 = true;
        }

        if (medioCobro == 0) {
            $("#errorselectMedioCobro_formAgregarCobroGasto").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectMedioCobro_formAgregarCobroGasto").css("display", "none");
            val2 = true;
        }

        if (val1 && val2) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formAgregarCobroGasto")[0]);
            $.ajax({
                    url: URL + 'gastos/set_cobro_gasto/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    ////console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-agregar-cobro-gasto").modal("hide");
                        swal(
                            'Gasto',
                            dato['msg'],
                            'success'
                        )

                        if (dato['saldado']) {
                            $("#listadoGastos").dataTable().fnDeleteRow("#" + dato['gasto'][0]['idGasto']);
                            tableListadoGastos = $('#listadoGastos').DataTable();
                            idGenGasto = "'" + dato['gasto'][0]['idGenGasto'] + "'";

                            var opcion = '<div class="btn-group">' +
                                '<button class="btn btn-success" style="padding: 3px;font-size: 0.8em;"> Pagado </button>' +
                                '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                '<ul class="dropdown-menu icons-right">' +
                                '<li><a href="#"><i class="icon-grid3"></i> Ver</a></li>' +
                                '<li><a class="tip deleteGasto" data-id="' + dato['gasto'][0]['idGasto'] + '"><i class="icon-close"></i> Eliminar</a></li>' +
                                '<li class="divider"></li>' +
                                '</ul>' +
                                '</div>';

                            var row = tableListadoGastos.row.add([
                                opcion,
                                dato['gasto'][0]['fechaGasto'],
                                dato['gasto'][0]['categoria'],
                                dato['gasto'][0]['subcategoria'],
                                "$" + number_format(dato['gasto'][0]['montoGasto'], 2),
                                dato['gasto'][0]['descripcionGasto'],
                                dato['gasto'][0]['medioPago'],
                                dato['gasto'][0]['fechaAlta']
                            ]).draw(false);
                            row.nodes().to$().attr('id', dato['gasto'][0]['idGasto']);
                            tableListadoGastos.row(row).column(0).nodes().to$().addClass('text-center');
                            tableListadoGastos.row(row).column(1).nodes().to$().addClass('text-center');
                            tableListadoGastos.row(row).column(2).nodes().to$().addClass('text-center');
                            tableListadoGastos.row(row).column(3).nodes().to$().addClass('text-center');
                            tableListadoGastos.row(row).column(4).nodes().to$().addClass('text-right');
                            tableListadoGastos.row(row).column(5).nodes().to$().addClass('text-center');
                            tableListadoGastos.row(row).column(6).nodes().to$().addClass('text-center');
                            tableListadoGastos.row(row).column(7).nodes().to$().addClass('text-center');
                        }
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#modal-agregar-cobro-gasto").modal("hide");
                        swal(
                            'Gasto',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
    $('#btnAgregarMovimiento').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val5;
        var montoMovimiento = ($('#montoMovimiento').val());
        var selectCuentaSalida = $('#selectCuentaSalida').val();
        var selectCuentaEntrada = $('#selectCuentaEntrada').val();
        //        var descripcionMovimiento = $('#descripcionMovimiento').val();


        if (montoMovimiento == null || montoMovimiento.length == 0 || montoMovimiento == ' ') {
            $("#errormontoMovimiento").css("display", "block");
            val1 = false;
        } else {
            $("#errormontoMovimiento").css("display", "none");
            val1 = true;
        }
        if (selectCuentaSalida == 0) {
            $("#errorselectCuentaSalida").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectCuentaSalida").css("display", "none");
            val2 = true;
        }
        if (selectCuentaEntrada == 0) {
            $("#errorselectCuentaEntrada").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectCuentaEntrada").css("display", "none");
            val3 = true;
        }
        //        if (descripcionMovimiento == null || descripcionMovimiento.length == 0 || descripcionMovimiento == ' ' || descripcionMovimiento == '') {
        //            $("#errordescripcionMovimiento").css("display", "block");
        //            val4 = false;
        //        } else {
        //            $("#errordescripcionMovimiento").css("display", "none");
        //            val4 = true;
        //        }
        if (selectCuentaSalida == selectCuentaEntrada) {
            swal(
                'Error',
                "Debe seleccionar dos cajas diferentes",
                'error'
            )
            val5 = false;
        } else {
            val5 = true;
        }

        if (val1 && val2 && val3 && val5) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formMovimientoCuentas")[0]);
            $.ajax({
                    url: URL + 'tesoreria/set_movimiento/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                //console.log(dato);

                    if (dato['valid']) {

                        $("#modal-cargando").modal("hide");
                        $("#modal-movimiento-cuentas").modal("hide");
                        swal({
                            title: "Operacion exitosa",
                            text: "Movimiento",
                            type: "success",
                            html: 'Se ha realizado el movimiento con exito',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                        })
                        setTimeout(function() {
                            location.href = URL + 'tesoreria/listar_saldos';
                        }, 500);
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )

                    }
                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
    $('#btnAgregarPago').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4;
        var idGenEgresoPagar = $('#idGenEgresoPagar').val();
        var montoAdeudadoPagar = $('#montoAdeudadoPagar').val();
        var montoPagar = $('#montoPagar').val();
        var selectMedioPago = $('#selectMedioPago').val();
        //        var descripcionPago = $('#descripcionPago').val();


        if (idGenEgresoPagar == null || idGenEgresoPagar.length == 0 || idGenEgresoPagar == ' ' || idGenEgresoPagar == '') {
            val1 = false;
        } else {
            val1 = true;
        }
        if (montoAdeudadoPagar == null || montoAdeudadoPagar.length == 0 || montoAdeudadoPagar == ' ' || montoAdeudadoPagar == '') {
            $("#errormontoAdeudadoPagar").css("display", "block");
            val2 = false;
        } else {
            $("#errormontoAdeudadoPagar").css("display", "none");
            val2 = true;
            if (parseFloat(montoPagar) > parseFloat(montoAdeudadoPagar)) {
                document.getElementById("msgError").innerHTML = "No puede poner un monto superior al adeudado.";
                $("#popUpErrorMsg").modal("show");
                val2 = false;
            }
        }
        if (selectMedioPago == 0) {
            $("#errorselectMedioPago").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectMedioPago").css("display", "none");
            val3 = true;
        }
        //        if (descripcionPago == null || descripcionPago.length == 0 || descripcionPago == ' ' || descripcionPago == '') {
        //            $("#errordescripcionPago").css("display", "block");
        //            val4 = false;
        //        } else {
        //            $("#errordescripcionPago").css("display", "none");
        //            val4 = true;
        //        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formAgregarPago")[0]);
            $.ajax({
                    url: URL + 'compras/set_pago/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                        //console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-agregar-pago").modal("hide");
                        $("#operacionExitosa").modal("show");
                        var idGenEgreso = dato['idGenEgreso'];
                        $.ajax({
                                url: URL + 'compras/generaPDFcupon/' + dato['idGenEgreso'],
                                type: 'POST',
                                cache: false,
                            })
                            .done(function(data) {
                                $("#operacionExitosa").modal("hide");
                                var dato = JSON.parse(data);
                                if (dato['valid']) {

                                    //--- eliminado y agregado del resgistro ---//
                                    var table = $('#listadoEgresos').DataTable();
                                    $("#listadoEgresos").dataTable().fnDeleteRow("#" + dato['egreso'][0]['idEgreso']);
                                    var texto = "";
                                    var clase = "";
                                    if (dato['egreso'][0]['idEstado'] == 1) {
                                        clase = "btn-info";
                                        texto = "A Cobrar";
                                    } else if (dato['egreso'][0]['idEstado'] == 2) {
                                        clase = "btn-success";
                                        texto = "Pagado";
                                    } else if (dato['egreso'][0]['idEstado'] == 3) {
                                        clase = "btn-danger";
                                        texto = "Vencido";
                                    } else {
                                        clase = "btn-warning";
                                        texto = "Sin Estado";
                                    }

                                    idGenEgreso = "'" + dato['egreso'][0]['idGenEgreso'] + "'";
                                    if (dato['egreso'][0]['idUsuario'] != 28 && dato['egreso'][0]['idUsuario'] != 29) {
                                        var bloque1 = '<li><a href="#"><i class="icon-grid3"></i> Ver</a></li>' +
                                            '<li><a href="' + URL + 'compras/editar_compra/' + dato['egreso'][0]['idGenEgreso'] + '"><i class="icon-cogs"></i> Editar</a></li>' +
                                            '<li><a class="tip deleteEgreso" data-id="' + dato['egreso'][0]['idEgreso'] + '"><i class="icon-close"></i> Eliminar</a></li>' +
                                            '<li class="divider"></li>' +
                                            '<li><a href="#modal-agregar-pago" class="tip agregarPago" data-id="' + dato['egreso'][0]['idGenEgreso'] + '" data-toggle="modal" ><i class="icon-tag5"></i> Agregar Pago</a></li>';
                                    }

                                    if (dato['egreso'][0]['idUsuario'] != 28 && dato['egreso'][0]['idUsuario'] != 29) {
                                        var bloque2 = '<li><a href="#"><i class="icon-clipboard"></i> Cta Cte</a></li>' +
                                            '<li class="divider"></li>' +
                                            '<li><a href="#" onclick="generarPdfDetalleEgreso(' + idGenEgreso + ')" ><i class="icon-binoculars"></i> Ver detalle</a></li>' +
                                            '<li><a href="#"><i class="icon-print"></i> Imprimir detalle</a></li>';
                                    }

                                    var opcion = ' <div class="btn-group">' +
                                        '<button class="btn ' + clase + '" style="padding: 3px;font-size: 0.8em;">' + texto + '</button>' +
                                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                        '<ul class="dropdown-menu icons-right">' +
                                        bloque1 +
                                        bloque2 +
                                        '</ul>' +
                                        '</div>';
                                    var row = table.row.add([
                                        opcion,
                                        dato['egreso'][0]['fechaEmision'],
                                        dato['egreso'][0]['fechaVtoPago'],
                                        dato['egreso'][0]['nombEmpresa'],
                                        "$" + number_format(parseFloat(dato['egreso'][0]['total']) + parseFloat(dato['egreso'][0]['descuentoTotal']), 2, ",", "."),
                                        "$" + number_format(dato['egreso'][0]['descuentoTotal'], 2, ",", "."),
                                        "$" + number_format(dato['egreso'][0]['total'], 2, ",", "."),
                                        "$" + number_format(dato['egreso'][0]['total'], 2, ",", "."),
                                        "$" + number_format(dato['egreso'][0]['aPagar'], 2, ",", "."),
                                        "$" + number_format(dato['egreso'][0]['total'] - dato['egreso'][0]['aPagar'], 2, ",", "."),
                                        dato['egreso'][0]['nombreVend'],
                                    ]).draw(false);
                                    row.nodes().to$().attr('id', dato['egreso'][0]['idEgreso']);
                                    table.row(row).column(0).nodes().to$().addClass('text-center');
                                    table.row(row).column(1).nodes().to$().addClass('text-center');
                                    table.row(row).column(2).nodes().to$().addClass('text-center');
                                    table.row(row).column(3).nodes().to$().addClass('text-center');
                                    table.row(row).column(4).nodes().to$().addClass('text-right');
                                    table.row(row).column(5).nodes().to$().addClass('text-right');
                                    table.row(row).column(6).nodes().to$().addClass('text-right');
                                    table.row(row).column(7).nodes().to$().addClass('text-right');
                                    table.row(row).column(8).nodes().to$().addClass('text-right');
                                    table.row(row).column(9).nodes().to$().addClass('text-right');
                                    table.row(row).column(10).nodes().to$().addClass('text-center');
                                    swal({
                                        title: "Comprobante",
                                        text: "Transaccion",
                                        //type: "info",
                                        width: "800px",
                                        html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/pago/' + dato['egreso'][0]['idGenEgreso'] + '/' + dato['idGenComprobante'] + '#zoom=100&view=fitH"></iframe>',
                                        showCancelButton: false,
                                        confirmButtonText: 'Cerrar',
                                    })
                                } else {
                                    swal(
                                        'Error',
                                        dato['msg'],
                                        'error'
                                    )
                                }
                            })
                            .fail(function(data) {
                                $("#operacionExitosa").modal("hide");
                                $("#popUpError").modal("show");
                            });
                    } else {
                        document.getElementById("msgError").innerHTML = dato['msg'];
                        $("#popUpErrorMsg").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
    $('#btnAgregarGasto').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4, val5, val6, val7;
        var montoGasto = $('#montoGasto').val();
        var selectCatGasto = $('#selectCatGasto').val();
        var selectSubCatGasto = $('#selectSubCatGasto').val();
        var selectMedioPago = $('#selectMedioPago2').val();
        var selectTipoFactura = $('#selectTipoFactura').val();
        var fileGasto = document.getElementById("fileGasto");
        var inputFechaVtoGasto = $('#inputFechaVtoGasto').val();

        if (montoGasto == null || montoGasto.length == 0 || montoGasto == ' ' || montoGasto == '') {
            $("#errormontoGasto").css("display", "block");
            val1 = false;
        } else {
            $("#errormontoGasto").css("display", "none");
            val1 = true;
        }
        if (selectCatGasto == 0) {
            $("#errorselectCatGasto").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectCatGasto").css("display", "none");
            val2 = true;
        }
        if (selectSubCatGasto == 0) {
            $("#errorselectSubCatGasto").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectSubCatGasto").css("display", "none");
            val3 = true;
        }
        if (selectMedioPago == 0) {
            $("#errorselectMedioPago_formAgregarGasto").css("display", "block");
            val4 = false;
        } else {
            $("#errorselectMedioPago_formAgregarGasto").css("display", "none");
            val4 = true;
        }
        if (selectTipoFactura == 0) {
            $("#errorselectTipoFactura").css("display", "block");
            val6 = false;
        } else {
            $("#errorselectTipoFactura").css("display", "none");
            val6 = true;
        }
        if (inputFechaVtoGasto == 0) {
            $("#errorinputFechaVtoGasto").css("display", "block");
            val7 = false;
        } else {
            $("#errorinputFechaVtoGasto").css("display", "none");
            val7 = true;
        }

        if ($('#pagado_agregarGasto').prop('checked')) {
            pagado = 2;
        } else {
            pagado = 1;
        }

        if (val1 && val2 && val3 && val4 && val6 && val7) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formAgregarGasto")[0]);
            formData.append("idEstado", pagado);
            $.ajax({
                    url: URL + 'gastos/set_gasto/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    $("#modal-agregar-gasto").modal("hide");
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Gasto',
                            dato['msg'],
                            'success'
                        )
                        tableListadoGastos = $('#listadoGastos').DataTable();
                        idGenGasto = "'" + dato['gasto'][0]['idGenGasto'] + "'";


                        if (pagado == 1) {
                            var opcion = '<div class="btn-group">' +
                                '<button class="btn btn-warning" style="padding: 3px;font-size: 0.8em;"> Pendiente </button>' +
                                '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                '<ul class="dropdown-menu icons-right">' +
                                '<li><a onclick="llenadoGastosModificar(' + idGenGasto + ', 1)"><i class="icon-grid3"></i> Ver</a></li>' +
                                '<li><a href="#modal-agregar-cobro-gasto" class="tip agregarCobroGasto" data-id="' + dato['gasto'][0]['idGenGasto'] + '" data-toggle="modal" ><i class="icon-tag5"></i> Agregar cobranza</a></li>' +
                                '<li><a onclick="llenadoGastosModificar(' + idGenGasto + ', 2)"><i class="icon-cogs"></i> Editar</a></li>' +
                                '<li><a class="tip deleteGasto" data-id="' + dato['gasto'][0]['idGasto'] + '"><i class="icon-close"></i> Eliminar</a></li>' +
                                '<li class="divider"></li>' +
                                '</ul>' +
                                '</div>'
                        } else if (pagado == 2) {
                            var opcion = '<div class="btn-group">' +
                                '<button class="btn btn-success" style="padding: 3px;font-size: 0.8em;"> Pagado </button>' +
                                '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                '<ul class="dropdown-menu icons-right">' +
                                '<li><a onclick="llenadoGastosModificar(' + idGenGasto + ', 1)"><i class="icon-grid3"></i> Ver</a></li>' +
                                '<li><a class="tip deleteGasto" data-id="' + dato['gasto'][0]['idGasto'] + '"><i class="icon-close"></i> Eliminar</a></li>' +
                                '<li class="divider"></li>' +
                                '</ul>' +
                                '</div>'
                        }

                        var row = tableListadoGastos.row.add([
                            opcion,
                            dato['gasto'][0]['fechaGasto'],
                            dato['gasto'][0]['categoria'],
                            dato['gasto'][0]['subcategoria'],
                            "$" + number_format(dato['gasto'][0]['montoGasto'], 2),
                            dato['gasto'][0]['descripcionGasto'],
                            dato['gasto'][0]['medioPago'],
                            dato['gasto'][0]['fechaAlta']
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['gasto'][0]['idGasto']);
                        tableListadoGastos.row(row).column(0).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(1).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(2).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(3).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(4).nodes().to$().addClass('text-right');
                        tableListadoGastos.row(row).column(5).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(6).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(7).nodes().to$().addClass('text-center');
                    } else {
                        $("#popUpError").modal("show");
                    }

                })
                .fail(function(data) {
                    swal(
                        'Gasto',
                        dato['msg'],
                        'error'
                    )
                });
        }
    });
    $('#visiblebtnModificarGasto').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4, val5, val6, val7, val8;
        var option;
        var montoGasto = $('#montoGasto_modificarGasto').val();
        var selectCatGasto = $('#selectCatGasto_modificarGasto').val();
        var selectSubCatGasto = $('#selectSubCatGasto_modificarGasto').val();
        var selectMedioPago = $('#selectMedioPago_modificarGasto').val();
        var selectTipoFactura = $('#selectTipoFactura_modificarGasto').val();
        var fileGasto = $('#fileGasto').val();
        var inputFechaVtoGasto = $('#inputFechaVtoGasto_modificarGasto').val();
        if (montoGasto == null || montoGasto.length == 0 || montoGasto == ' ' || montoGasto == '') {
            $("#errormontoGasto_modificarGasto").css("display", "block");
            val1 = false;
        } else {
            $("#errormontoGasto_modificarGasto").css("display", "none");
            val1 = true;
        }
        if (selectCatGasto == 0) {
            $("#errorselectCatGasto_modificarGasto").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectCatGasto_modificarGasto").css("display", "none");
            val2 = true;
        }
        if (selectSubCatGasto == 0) {
            $("#errorselectSubCatGasto_modificarGasto").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectSubCatGasto_modificarGasto").css("display", "none");
            val3 = true;
        }
        if (selectMedioPago == 0) {
            $("#errorselectMedioPago_modificarGasto").css("display", "block");
            val4 = false;
        } else {
            $("#errorselectMedioPago_modificarGasto").css("display", "none");
            val4 = true;
        }
        if (selectTipoFactura == 0) {
            $("#errorselectTipoFactura_modificarGasto").css("display", "block");
            val6 = false;
        } else {
            $("#errorselectTipoFactura_modificarGasto").css("display", "none");
            val6 = true;
        }
        if (inputFechaVtoGasto == 0) {
            $("#errorinputFechaVtoGasto_modificarGasto").css("display", "block");
            val8 = false;
        } else {
            $("#errorinputFechaVtoGasto_modificarGasto").css("display", "none");
            val8 = true;
        }

        if (val1 && val2 && val3 && val4 && val6 && val8) {
            $("#modal-cargando").modal("show");
            var formData = new FormData($("#formModificarGasto")[0]);
            $.ajax({
                    url: URL + 'gastos/update_gasto/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    $("#modal-modificar-gasto").modal("hide");
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Gasto',
                            dato['msg'],
                            'success'
                        )

                        $("#listadoGastos").dataTable().fnDeleteRow("#" + dato['gasto'][0]['idGasto']);
                        tableListadoGastos = $('#listadoGastos').DataTable();
                        idGenGasto = "'" + dato['gasto'][0]['idGenGasto'] + "'";

                        if (dato['gasto'][0]['estado'] == "Pendiente") {
                            opcion = '<div class="btn-group">' +
                                '<button class="btn btn-warning" style="padding: 3px;font-size: 0.8em;">' + dato['gasto'][0]['estado'] + '</button>' +
                                '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                '<ul class="dropdown-menu icons-right">' +
                                '<li><a onclick="llenadoGastosModificar(' + idGenGasto + ', 1)><i class="icon-grid3"></i> Ver</a></li>' +
                                '<li><a href="#modal-agregar-cobro-gasto" class="tip agregarCobroGasto" data-id="' + dato['gasto'][0]['idGenGasto'] + '" data-toggle="modal" ><i class="icon-tag5"></i> Agregar cobranza</a></li>' +
                                '<li><a onclick="llenadoGastosModificar(' + idGenGasto + ', 2)"><i class="icon-cogs"></i> Editar</a></li>' +
                                '<li><a class="tip deleteGasto" data-id="' + dato['gasto'][0]['idGasto'] + '"><i class="icon-close"></i> Eliminar</a></li>' +
                                '<li class="divider"></li>' +
                                '</ul>' +
                                '</div>'
                        } else {
                            opcion = '<div class="btn-group">' +
                                '<button class="btn btn-success" style="padding: 3px;font-size: 0.8em;">' + dato['gasto'][0]['estado'] + '</button>' +
                                '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' +
                                '<ul class="dropdown-menu icons-right">' +
                                '<li><a onclick="llenadoGastosModificar(' + idGenGasto + ', 1)"><i class="icon-grid3"></i> Ver</a></li>' +
                                '<li><a class="tip deleteGasto" data-id="' + dato['gasto'][0]['idGasto'] + '"><i class="icon-close"></i> Eliminar</a></li>' +
                                '<li class="divider"></li>' +
                                '</ul>' +
                                '</div>'
                        }

                        var row = tableListadoGastos.row.add([
                            opcion,
                            dato['gasto'][0]['fechaGasto'],
                            dato['gasto'][0]['categoria'],
                            dato['gasto'][0]['subcategoria'],
                            "$" + number_format(dato['gasto'][0]['montoGasto'], 2),
                            dato['gasto'][0]['descripcionGasto'],
                            dato['gasto'][0]['medioPago'],
                            dato['gasto'][0]['fechaAlta']
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['gasto'][0]['idGasto']);
                        tableListadoGastos.row(row).column(0).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(1).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(2).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(3).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(4).nodes().to$().addClass('text-right');
                        tableListadoGastos.row(row).column(5).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(6).nodes().to$().addClass('text-center');
                        tableListadoGastos.row(row).column(7).nodes().to$().addClass('text-center');
                    } else {
                        swal(
                            'Gasto',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#modal-cargando").modal("show");
                    document.getElementById("msgError").innerHTML = "Error al realizar el update";
                    $("#popUpErrorMsg").modal("show");
                });
        } else {
            $("#modal-cargando").modal("show");
        }
    });
    $('#btnGuardarAbono').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4 = true,
            val5 = true,
            val6 = true,
            val7 = true,
            val8, val9, val10, val11, val12;
        var selectCliente = $('#selectCliente').val();
        var inputFechaEmision = $('#inputFechaEmision').val();
        var inputFechaCobro = $('#inputFechaCobro').val();
        var selectTipoFact = $('#selectTipoFact').val();
        var selectCategoriaVenta = $('#selectCategoriaVenta').val();
        var selectSubCategoriaVenta = $('#selectSubCategoriaVenta').val();
        var inputFechaInicioAbono = $('#inputFechaInicioAbono').val();
        var inputFechaFinAbono = $('#inputFechaFinAbono').val();
        var selectModalidadAbono = $('#selectModalidadAbono').val();
        var inputFechaPrimeraVenta = $('#inputFechaPrimeraVenta').val();
        var inputFechaFinAbono = $('#inputFechaFinAbono').val();
        var notaCliente = $('#notaCliente').val();
        var notaInterna = $('#notaInterna').val();
        var fechaInicioServicio = $('#inputFechaInicioServicio_abono').val();
        var fechaFinServicio = $('#inputFechaFinServicio_abono').val();
        var idConceptoFactura = $('#idConceptoFactura_abono').val();
        var descCliente = $('#descuentoCliente').val();
        var descEfectuado = $('#descEfectuado').val();
        var importeNoGravado = $('#importeNoGravado').val();
        var total = $('#totalVenta').val();
        var totalIva = 0;
        //        var cobrado=compruebaCheckBoxSwitch("cobrado");
        var cobrado = 0; //Lo dejo en cero para mantener la estructura del array 
        if (selectCliente == 0) {
            $("#errorselectCliente").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente").css("display", "none");
            val1 = true;
        }
        if (selectTipoFact == 0) {
            $("#errorselectTipoFact").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectTipoFact").css("display", "none");
            val2 = true;
        }
        if (inputFechaPrimeraVenta == null || inputFechaPrimeraVenta.length == 0 || inputFechaPrimeraVenta == ' ' || inputFechaPrimeraVenta == '') {
            $("#errorinputFechaPrimeraVenta").css("display", "block");
            val10 = false;
        } else {
            $("#errorinputFechaPrimeraVenta").css("display", "none");
            val10 = true;
        }
        if (selectSubCategoriaVenta == 0) {
            $("#errorselectSubCategoriaVenta").css("display", "block");
            val8 = false;
        } else {
            $("#errorselectSubCategoriaVenta").css("display", "none");
            val8 = true;
        }
        if (selectCategoriaVenta == 0) {
            $("#errorselectCategoriaVenta").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectCategoriaVenta").css("display", "none");
            val3 = true;
            if (selectCategoriaVenta == 1) {

                if (inputFechaInicioAbono == null || inputFechaInicioAbono.length == 0 || inputFechaInicioAbono == ' ' || inputFechaInicioAbono == '') {
                    $("#errorinputFechaInicioAbono").css("display", "block");
                    val4 = false;
                } else {
                    $("#errorinputFechaInicioAbono").css("display", "none");
                    val4 = true;
                }
                if (inputFechaFinAbono == null || inputFechaFinAbono.length == 0 || inputFechaFinAbono == ' ' || inputFechaFinAbono == '') {
                    $("#errorinputFechaFinAbono").css("display", "block");
                    val5 = false;
                } else {
                    $("#errorinputFechaFinAbono").css("display", "none");
                    val5 = true;
                }
            }
        }

        if (selectModalidadAbono == 0) {
            $("#errorselectModalidadAbono").css("display", "block");
            val6 = false;
        } else {
            $("#errorselectModalidadAbono").css("display", "none");
            val6 = true;
        }

        if (idConceptoFactura == 2) {
            if (fechaInicioServicio == "") {
                $("#errorinputFechaInicioServicio_abono").css("display", "block");
                val11 = false;
            } else {
                $("#errorinputFechaInicioServicio_abono").css("display", "none");
                val11 = true;
            }
            if (fechaFinServicio == "") {
                $("#errorinputFechaFinServicio_abono").css("display", "block");
                val12 = false;
            } else {
                $("#errorinputFechaFinServicio_abono").css("display", "none");
                val12 = true;
            }
        } else {
            fechaInicioServicio = "";
            fechaFinServicio = "";
        }

        var info = tableListadoVenta.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val7 = false;
        } else {
            val7 = true;
        }

        if ((val1 && val2 && val3 && val7 && val8 && val10 && idConceptoFactura != 2) || (val1 && val2 && val3 && val7 && val8 && val10 && val11 && val12 && idConceptoFactura == 2)) {
            $("#modal-cargando").modal("show");
            var datosFacturacion = {
                "selectCliente": selectCliente,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaCobro": inputFechaCobro,
                "selectTipoFact": selectTipoFact,
                "selectCategoriaVenta": selectCategoriaVenta,
                "inputFechaInicioAbono": inputFechaInicioAbono,
                "inputFechaFinAbono": inputFechaFinAbono,
                "selectModalidadAbono": selectModalidadAbono,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "totalNoGravado": importeNoGravado,
                "total": total,
                "descTotal": descEfectuado,
                "descCliente": descCliente,
                "totalIva": totalIva,
                "cobrado": cobrado,
                "selectSubCategoriaVenta": selectSubCategoriaVenta,
                "inputFechaPrimeraVenta": inputFechaPrimeraVenta,
                "fechaInicioServicio": inputFechaInicioAbono,
                "fechaFinServicio": inputFechaFinAbono
            };
            var datosVenta = [];
            var info = tableListadoVenta.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoVenta.data();
            var totalVenta = 0;
            var k = 0;
            //--- Obtenemos las configuraciones del sistema para verificar si se de controlar o no el stock ---//
            $.ajax({
                    url: URL + 'configuracion_sistema/get_empresa/',
                    type: 'POST',
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    var empresa = dato['empresa'];
                    for (var i = 0; i < count; i++) {
                        var idInputSubTotal = "subTotalProd" + tabla[i][0];
                        var valorInputSubTotal = $('#' + idInputSubTotal).val();
                        totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                        var e = document.getElementById('selectIva' + tabla[i][0]);
                        var valueIvaSelect = e.options[e.selectedIndex].text;
                        //--- validamos si tiene en cuenta el stock o no, de tener que controlarlo verificar que ninguno exceda su limite antes de realizar el registro del abono ---//
                        if ((empresa[0]['stock'] == 0 && parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4])) || empresa[0]['stock'] == 1) {
                            datosVenta.push({
                                "idProducto": tabla[i][0],
                                "codigo": tabla[i][1],
                                "stock": tabla[i][4],
                                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                                "precio": $('#precioProd' + tabla[i][0]).val(),
                                "descuento": $('#descProd' + tabla[i][0]).val(),
                                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                                "iva": $('#selectIva' + tabla[i][0]).val(),
                                "ivaText": valueIvaSelect
                            });
                        } else {
                            k++;
                            //console.log(k);
                        }
                    }
                    //--- validamos si tiene en cuenta el stock o no, de tener que controlarlo verificar que ninguno hay excedido su limite antes de realizar el registro del abono ---//
                    if ((empresa[0]['stock'] == 0 && k == 0) || empresa[0]['stock'] == 1) {
                        $.ajax({
                                url: URL + 'abonos/set_abono/',
                                type: 'POST',
                                data: { datosVenta: datosVenta, datosFacturacion: datosFacturacion }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                //                            //console.log(dato);

                                if (dato['valid']) {
                                    $("#modal-cargando").modal("hide");
                                    swal(
                                        'Abono',
                                        dato['msg'],
                                        'success'
                                    )
                                    setTimeout(function() {
                                        location.href = URL + 'abonos/listar_abonos';
                                    }, 2000);
                                } else {
                                    swal(
                                        'Abono',
                                        dato['msg'],
                                        'error'
                                    )
                                }

                            })
                            .fail(function(data) {
                                $("#popUpError").modal("show");
                            });
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "Controle, hay productos que superan el stock";
                        $("#popUpErrorMsg").modal("show");
                        //console.log("Hay productos sin stock");
                    }
                })
                .fail(function(data) {});
        }
    });
    $('#btnGuardarVenta').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val7 = true,
            val8, val10, val11, val12;
        var selectCliente = $('#selectCliente').val();
        var inputFechaEmision = $('#inputFechaEmision').val();
        var inputFechaCobro = $('#inputFechaCobroVenta').val();
        var selectTipoFact = $('#selectTipoFact').val();
        var selectCategoriaVenta = $('#selectCategoriaVenta').val();
        var selectSubCategoriaVenta = $('#selectSubCategoriaVenta').val();
        var notaCliente = $('#notaCliente').val();
        var notaInterna = $('#notaInterna').val();
        var razonSocial = $('#selectRazonSocial').val();
        var venta_presupuesto = $('#venta_presupuesto').val();
        var fechaInicioServicio = $('#inputFechaInicioServicio').val();
        var fechaFinServicio = $('#inputFechaFinServicio').val();
        var idConceptoFactura = $('#idConceptoFactura').val();
        var descCliente = $('#descuentoCliente').val();
        var descEfectuado = $('#descEfectuado').val();
        var importeNoGravado = $('#importeNoGravado').val();
        var total = $('#totalVenta').val();
        var cobrado = compruebaCheckBoxSwitch("cobrado");

        var totalIva = 0;

        if (selectCliente == 0) {
            $("#errorselectCliente").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente").css("display", "none");
            val1 = true;
        }
        if (selectTipoFact == 0) {
            $("#errorselectTipoFact").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectTipoFact").css("display", "none");
            val2 = true;
        }
        if (selectSubCategoriaVenta == 0) {
            $("#errorselectSubCategoriaVenta").css("display", "block");
            val8 = false;
        } else {
            $("#errorselectSubCategoriaVenta").css("display", "none");
            val8 = true;
        }
        if (selectCategoriaVenta == 0) {
            $("#errorselectCategoriaVenta").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectCategoriaVenta").css("display", "none");
            val3 = true;
        }

        //        if (razonSocial == "") {
        //            $("#errorSelectRazonSocial").css("display", "block");
        //            val10 = false;
        //        } else {
        //            $("#errorSelectRazonSocial").css("display", "none");
        //            val10 = true;
        //        }

        if (idConceptoFactura == 2) {
            if (fechaInicioServicio == "") {
                $("#errorinputFechaInicioServicio").css("display", "block");
                val11 = false;
            } else {
                $("#errorinputFechaInicioServicio").css("display", "none");
                val11 = true;
            }
            if (fechaFinServicio == "") {
                $("#errorinputFechaFinServicio").css("display", "block");
                val12 = false;
            } else {
                $("#errorinputFechaFinServicio").css("display", "none");
                val12 = true;
            }
        } else {
            fechaInicioServicio = "";
            fechaFinServicio = "";
        }

        //--- verificamos si estamos en una venta que depende de un presupuesto o no ---//
        //--- 1 es una venta comun y 2 es una venta dependiente de un presupuesto ---//
        if (venta_presupuesto == 1) {
            var tableListadoVenta = $('#listadoVenta').DataTable();
            idGenPresupuesto = "";
        } else if (venta_presupuesto == 2) {
            var tableListadoVenta = $('#listadoVentaPresupuesto').DataTable();
            var idGenPresupuesto = $('#idGenPresupuesto').val();
        }

        var info = tableListadoVenta.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val7 = false;
        } else {
            val7 = true;
        }

        if ((val1 && val2 && val3 && val7 && val8 && idConceptoFactura != 2) || (val1 && val2 && val3 && val7 && val8 && val11 && val12 && idConceptoFactura == 2)) {
            $("#modal-cargando").modal("show");

            var datosVenta = [];
            var info = tableListadoVenta.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoVenta.data();
            var totalVenta = 0;
            var k = 0;
            var p = 0;
            //--- obtencion de las configuraciones iniciales del sistema para verificar el stock ---//
            $.ajax({
                    url: URL + 'configuracion_sistema/get_empresa/',
                    type: 'POST',
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    var empresa = dato['empresa'];
                    for (var i = 0; i < count; i++) {
                        var idInputSubTotal = "subTotalProd" + tabla[i][0];
                        var valorInputSubTotal = $('#' + idInputSubTotal).val();
                        totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                        var e = document.getElementById('selectIva' + tabla[i][0]);
                        var valueIvaSelect = e.options[e.selectedIndex].text;
                        //Si es X puede tener o no IVA

                        //Si es C o E no tiene que tener asociado el IVA
                        if (selectTipoFact == 3 || selectTipoFact == 5) {
                            //No tiene que tener iva por lo tanto el select deberia estar en "IVA", sino sumo el error a p
                            if (valueIvaSelect == "IVA") {
                                p++;
                            }
                            //Si es A, B o M tiene que tener asociado el IVA
                        } else if (selectTipoFact == 1 || selectTipoFact == 2 || selectTipoFact == 4) {
                            if (valueIvaSelect == "IVA") {
                                p++;
                            }
                        }

                        //--- verificamos si se debe controlar o no el stock, de serlo tenemos que verificar que cada detalle no haya excedido de su maximo ---//
                        if ((empresa[0]['stock'] == 0 && parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4])) || empresa[0]['stock'] == 1) {
                            datosVenta.push({
                                "idGenProducto": tabla[i][0],
                                "codigo": tabla[i][1],
                                "stock": tabla[i][4],
                                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                                "precio": $('#precioProd' + tabla[i][0]).val(),
                                "descuento": $('#descProd' + tabla[i][0]).val(),
                                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                                "iva": $('#selectIva' + tabla[i][0]).val(),
                                "idProducto": tabla[i][10],
                                "ivaText": valueIvaSelect
                            });

                            //--- Total de iva en la venta ---//
                            totalIva += $('#subTotalProd' + tabla[i][0]).val() * $('#selectIva' + tabla[i][0]).val();
                        } else {
                            k++;
                        }
                    }

                    var datosFacturacion = {
                        "selectCliente": selectCliente,
                        "inputFechaEmision": inputFechaEmision,
                        "inputFechaCobro": inputFechaCobro,
                        "selectTipoFact": selectTipoFact,
                        "selectCategoriaVenta": selectCategoriaVenta,
                        "notaCliente": notaCliente,
                        "notaInterna": notaInterna,
                        "totalNoGravado": importeNoGravado,
                        "total": total,
                        "descTotal": descEfectuado,
                        "descCliente": descCliente,
                        "totalIva": totalIva,
                        "cobrado": cobrado,
                        "selectSubCategoriaVenta": selectSubCategoriaVenta,
                        "razonSocial": razonSocial,
                        "fechaInicioServicio": fechaInicioServicio,
                        "fechaFinServicio": fechaFinServicio
                    };

                    //--- verificamos si se debe controlar o no el stock, de serlo tenemos que verificar que ningun detalle se haya excedido de su maximo ---//
                    if ((empresa[0]['stock'] == 0 && k == 0) || empresa[0]['stock'] == 1) {
                        if (p == 0) {
                            $.ajax({
                                    url: URL + 'ventas/set_venta/',
                                    type: 'POST',
                                    data: { datosVenta: datosVenta, datosFacturacion: datosFacturacion, idGenPresupuesto: idGenPresupuesto }
                                })
                                .done(function(data) {
                                    var dato = JSON.parse(data);
                                    //console.log(dato);
                                    if (dato['valid']) {
                                        $("#modal-cargando").modal("hide");
                                        if (selectTipoFact == 1 || selectTipoFact == 2 || selectTipoFact == 4) {
                                            generarPdfComprobanteLegal(dato['idGenIngreso']);
                                        } else {
                                            generarPdfComprobanteNoLegal(dato['idGenIngreso']);
                                        }
                                    } else {
                                        swal(
                                            'Venta',
                                            dato['msg'],
                                            'error'
                                        )
                                    }

                                })
                                .fail(function(data) {
                                    $("#popUpError").modal("show");
                                });
                        } else {
                            k = 0
                            $("#modal-cargando").modal("hide");
                            document.getElementById("msgError").innerHTML = "Controle, hay productos que contienen un valor de iva que no corresponde al tipo de factura seleccionado.";
                            $("#popUpErrorMsg").modal("show");
                        }
                    } else {
                        k = 0
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "Controle, hay productos que superan el stock O todavia no guardo el nuevo producto.";
                        $("#popUpErrorMsg").modal("show");
                    }
                })
                .fail(function(data) {});
        }
    });
    $('#btnGuardarCompra').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4, val6, val7, val8;
        var selectProveedor = $('#selectProveedor').val();
        var selectCategoriaCompra = $('#selectCategoriaCompra').val();
        var inputFechaEmisionCompra = $('#inputFechaEmisionCompra').val();
        var inputFechaPagoCompra = $('#inputFechaPagoCompra').val();
        var selectTipoFactCompra = $('#selectTipoFactCompra').val();
        var notaInterna = $('#notaInterna').val();
        var razonSocial = $('#selectRazonSocial').val();
        var descProveedor = $('#descuentoProveedor').val();
        var descTotal = $('#descEfectuado').val();
        var totalNoGravado = $('#importeNoGravado').val();
        var total = $('#totalCompra').val();
        var totalIva = 0;
        if (selectProveedor == 0) {
            $("#errorselectProveedor").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectProveedor").css("display", "none");
            val1 = true;
        }
        if (selectCategoriaCompra == 0) {
            $("#errorselectCategoriaCompra").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectCategoriaCompra").css("display", "none");
            val2 = true;
        }

        if (selectTipoFactCompra == 0) {
            $("#errorselectTipoFactCompra").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectTipoFactCompra").css("display", "none");
            val3 = true;
        }

        var info = tableListadoCompra.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val4 = false;
        } else {
            val4 = true;
        }

        //        if (razonSocial == "") {
        //            $("#errorSelectRazonSocial").css("display", "block");
        //            val7 = false;
        //        } else {
        //            $("#errorSelectRazonSocial").css("display", "none");
        //            val7 = true;
        //        }

        if (inputFechaPagoCompra == "") {
            $("#errorinputFechaPagoCompra").css("display", "block");
            val8 = false;
        } else {
            $("#errorinputFechaPagoCompra").css("display", "none");
            val8 = true;
        }

        if (val1 && val2 && val3 && val4 && val8) {
            $("#modal-cargando").modal("show");
            var datosFacturacion = {
                "selectProveedor": selectProveedor,
                "selectCategoriaCompra": selectCategoriaCompra,
                "inputFechaEmisionCompra": inputFechaEmisionCompra,
                "inputFechaPagoCompra": inputFechaPagoCompra,
                "selectTipoFactCompra": selectTipoFactCompra,
                "notaInterna": notaInterna,
                "totalNoGravado": totalNoGravado,
                "total": total,
                "descTotal": descTotal,
                "descProveedor": descProveedor,
                "totalIva": totalIva,
                "razonSocial": razonSocial
            };
            var datosCompra = [];
            var info = tableListadoCompra.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoCompra.data();
            var totalVenta = 0;
            var k = 0;
            //--- Obtencion de las configuraciones iniciales del sistema ---//
            $.ajax({
                    url: URL + 'configuracion_sistema/get_empresa/',
                    type: 'POST',
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    var empresa = dato['empresa'];
                    for (var i = 0; i < count; i++) {
                        var idInputSubTotal = "subTotalProd" + tabla[i][0];
                        var valorInputSubTotal = $('#' + idInputSubTotal).val();
                        totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                        var e = document.getElementById('selectIva' + tabla[i][0]);
                        var valueIvaSelect = e.options[e.selectedIndex].text;
                        //--- verificamos si se debe controlar o no el stock, de serlo tenemos que verificar que cada detalle no haya excedido de su maximo ---//
                        if ((empresa[0]['stock'] == 0 && parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4])) || empresa[0]['stock'] == 1) {
                            datosCompra.push({
                                "idProducto": tabla[i][0],
                                "codigo": tabla[i][1],
                                "stock": tabla[i][4],
                                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                                "precio": $('#precioProd' + tabla[i][0]).val(),
                                "descuento": $('#descProd' + tabla[i][0]).val(),
                                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                                "iva": $('#selectIva' + tabla[i][0]).val(),
                                "ivaText": valueIvaSelect
                            });
                        } else {
                            k++;
                        }
                    }

                    //--- verificamos si se debe controlar o no el stock, de serlo tenemos que verificar que ningun detalle se haya excedido de su maximo ---//
                    if ((empresa[0]['stock'] == 0 && k == 0) || empresa[0]['stock'] == 1) {
                        $.ajax({
                                url: URL + 'compras/set_compra/',
                                type: 'POST',
                                data: { datosCompra: datosCompra, datosFacturacion: datosFacturacion }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                //console.log(dato);
                                if (dato['valid']) {
                                    $("#modal-cargando").modal("hide");
                                    swal(
                                        'Compra',
                                        dato['msg'],
                                        'success'
                                    )
                                    setTimeout(function() {
                                        location.href = URL + 'compras/listar_compras';
                                    }, 1000);
                                } else {
                                    swal(
                                        'Compra',
                                        dato['msg'],
                                        'error'
                                    )
                                }

                            })
                            .fail(function(data) {
                                $("#popUpError").modal("show");
                            });
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "Falta guardar algun producto nuevo";
                        $("#popUpErrorMsg").modal("show");
                    }
                })
                .fail(function(data) {});
        }
    });
    $('#btnEditarVenta').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val7, val8, val10, val11, val12;
        var selectCliente = $('#selectCliente').val();
        var inputFechaEmision = $('#inputFechaEmision').val();
        var inputFechaCobro = $('#inputFechaCobro').val();
        var selectTipoFact = $('#selectTipoFact').val();
        var selectCategoriaVenta = $('#selectCategoriaVenta').val();
        var selectSubCategoriaVenta = $('#selectSubCategoriaVenta').val();
        var inputFechaInicioAbono = $('#inputFechaInicioAbono').val();
        var inputDuracion = $('#inputDuracion').val();
        var selectModalidadAbono = $('#selectModalidadAbono').val();
        var notaCliente = $('#notaCliente').val();
        var notaInterna = $('#notaInterna').val();
        var idGenIngreso = $('#idGenIngreso').val();
        var totalVentaPost = $('#totalVenta').val();
        var importeNoGravado = $('#importeNoGravado').val();
        var razonSocial = $('#selectRazonSocial').val();
        var fechaInicioServicio = $('#inputFechaInicioServicio_update').val();
        var fechaFinServicio = $('#inputFechaFinServicio_update').val();
        var idConceptoFactura = $('#idConceptoFactura_update').val();

        var totalNoGravado = $('#importeNoGravado').val();
        var total = $('#totalVenta').val();
        var descTotal = $('#descEfectuado').val();
        var descCliente = $('#descuentoCliente').val();
        var totalIva = 0;

        var cobrado = compruebaCheckBoxSwitch("cobrado");
        if (selectCliente == 0) {
            $("#errorselectCliente").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente").css("display", "none");
            val1 = true;
        }
        if (selectTipoFact == 0) {
            $("#errorselectTipoFact").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectTipoFact").css("display", "none");
            val2 = true;
        }
        if (selectCategoriaVenta == 0) {
            $("#errorselectCategoriaVenta").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectCategoriaVenta").css("display", "none");
            val3 = true;
        }
        if (selectSubCategoriaVenta == 0) {
            $("#errorselectSubCategoriaVenta").css("display", "block");
            val8 = false;
        } else {
            $("#errorselectSubCategoriaVenta").css("display", "none");
            val8 = true;
        }
        //        if (razonSocial == 0) {
        //            $("#errorSelectRazonSocial").css("display", "block");
        //            val11 = false;
        //        } else {
        //            $("#errorSelectRazonSocial").css("display", "none");
        //            val11 = true;
        //        }

        if (idConceptoFactura == 2) {
            if (fechaInicioServicio == "") {
                $("#errorinputFechaInicioServicio_update").css("display", "block");
                val11 = false;
            } else {
                $("#errorinputFechaInicioServicio_update").css("display", "none");
                val11 = true;
            }
            if (fechaFinServicio == "") {
                $("#errorinputFechaFinServicio_update").css("display", "block");
                val12 = false;
            } else {
                $("#errorinputFechaFinServicio_update").css("display", "none");
                val12 = true;
            }
        } else {
            fechaInicioServicio = "";
            fechaFinServicio = "";
        }

        if (totalVentaPost == 0) {
            val10 = false;
        } else {
            val10 = true;
        }

        var info = tableListadoVentaEditar.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val7 = false;
        } else {
            val7 = true;
        }

        if ((val1 && val2 && val3 && val7 && val8 && val10 && idConceptoFactura != 2) || (val1 && val2 && val3 && val7 && val8 && val10 && val11 && val12 && idConceptoFactura == 2)) {
            $("#modal-cargando").modal("show");

            var datosVenta = [];
            var info = tableListadoVentaEditar.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoVentaEditar.data();
            var totalVenta = 0;
            var k = 0;
            var p = 0;
            //--- Obtenemos las configuraciones iniciales del sistema para saber si deberemos verificar el stock ---//
            $.ajax({
                    url: URL + 'configuracion_sistema/get_empresa/',
                    type: 'POST',
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    var empresa = dato['empresa'];
                    for (var i = 0; i < count; i++) {
                        var idInputSubTotal = "subTotalProd" + tabla[i][0];
                        var valorInputSubTotal = $('#' + idInputSubTotal).val();
                        totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                        //console.log($('#cantProd' + tabla[i][0]).val());
                        //console.log(tabla[i][4]);
                        var e = document.getElementById('selectIva' + tabla[i][0]);
                        var valueIvaSelect = e.options[e.selectedIndex].text;
                        //Si es X puede tener o no IVA

                        //Si es C o E no tiene que tener asociado el IVA
                        if (selectTipoFact == 3 || selectTipoFact == 5) {
                            //No tiene que tener iva por lo tanto el select deberia estar en "IVA", sino sumo el error a p
                            if (valueIvaSelect != "IVA") {
                                p++;
                            }
                            //Si es A, B o M tiene que tener asociado el IVA
                        } else if (selectTipoFact == 1 || selectTipoFact == 2 || selectTipoFact == 4) {
                            if (valueIvaSelect == "IVA") {
                                p++;
                            }
                        }

                        //--- verificamos si se debe controlar o no el stock, de serlo verificamos que cada detalle no se este excediendo el stock ---//
                        if ((empresa[0]['stock'] == 0 && parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4])) || empresa[0]['stock'] == 1) {
                            datosVenta.push({
                                "idProducto": tabla[i][0],
                                "codigo": tabla[i][1],
                                "stock": tabla[i][4],
                                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                                "precio": $('#precioProd' + tabla[i][0]).val(),
                                "descuento": $('#descProd' + tabla[i][0]).val(),
                                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                                "iva": $('#selectIva' + tabla[i][0]).val(),
                                "ivaText": valueIvaSelect
                            });

                            totalIva += $('#subTotalProd' + tabla[i][0]).val() * $('#selectIva' + tabla[i][0]).val();
                        } else {
                            k++;
                            //console.log(k);
                        }
                    }

                    var datosFacturacion = [
                        selectCliente,
                        inputFechaEmision,
                        inputFechaCobro,
                        selectTipoFact,
                        selectCategoriaVenta,
                        inputFechaInicioAbono,
                        inputDuracion,
                        selectModalidadAbono,
                        notaCliente,
                        notaInterna,
                        totalNoGravado,
                        total,
                        descTotal,
                        totalIva,
                        cobrado,
                        selectSubCategoriaVenta,
                        razonSocial,
                        fechaInicioServicio,
                        fechaFinServicio,
                        descCliente
                    ];

                    //--- verificamos si se debe controlar o no el stock, de serlo verificamos que ninguna detalle este excediendo el stock ---//
                    if ((empresa[0]['stock'] == 0 && k == 0) || empresa[0]['stock'] == 1) {
                        if (p == 0) {
                            $.ajax({
                                    url: URL + 'ventas/update_venta/',
                                    type: 'POST',
                                    data: { datosVenta: datosVenta, datosFacturacion: datosFacturacion, idGenIngreso: idGenIngreso, totalVenta: totalVentaPost, importeNoGravado: importeNoGravado }
                                })
                                .done(function(data) {
                                    var dato = JSON.parse(data);
                                    //console.log(dato);
                                    if (dato['valid']) {
                                        $("#modal-cargando").modal("hide");
                                        if (selectTipoFact == 1 || selectTipoFact == 2 || selectTipoFact == 4) {
                                            generarPdfComprobanteLegal(dato['idGenIngreso']);
                                        } else {
                                            generarPdfComprobanteNoLegal(dato['idGenIngreso']);
                                        }
                                    } else {
                                        swal(
                                            'Venta',
                                            dato['msg'],
                                            'error'
                                        )
                                    }

                                })
                                .fail(function(data) {
                                    $("#popUpError").modal("show");
                                });
                        } else {
                            k = 0
                            $("#modal-cargando").modal("hide");
                            document.getElementById("msgError").innerHTML = "Controle, hay productos que contienen un valor de iva que no corresponde al tipo de factura seleccionado.";
                            $("#popUpErrorMsg").modal("show");
                        }
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "Controle, hay productos que superan el stock";
                        $("#popUpErrorMsg").modal("show");
                        //console.log("Hay productos sin stock");
                    }
                })
                .fail(function(data) {});
        }
    });
    $('#btnEditarCompra').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val7, val8, val9, val10, val11, val12;
        var selectProveedor = $('#selectProveedor_formModificarCompra').val();
        var selectTipoFact = $('#selectTipoFactCompra_formModificarCompra').val();
        var selectCategoriaCompra = $('#selectCategoriaCompra_formModificarCompra').val();
        var selectSubCategoriaCompra = $('#selectSubCategoriaCompra_formModificarCompra').val();
        var inputFechaEmision = $('#inputFechaEmisionCompra_formModificarCompra').val();
        var inputFechaCobro = $('#inputFechaPagoCompra_formModificarCompra').val();
        var idGenEgreso = $('#idGenEgreso').val();
        var notaInterna = $('#notaInterna_formModificarCompra').val();
        var totalCompraPost = $('#totalCompra_formModificarCompra').val();
        var descEfectuado = $('#descEfectuado_formModificarCompra').val();
        var importeNoGravado = $('#importeNoGravado_formModificarCompra').val();
        var razonSocial = $('#selectRazonSocial').val();
        var descProveedor = $('#descuentoProveedor_formModificarCompra').val();
        var descTotal = $('#descEfectuado_formModificarCompra').val();
        var totalNoGravado = $('#importeNoGravado_formModificarCompra').val();
        var total = $('#totalCompra_formModificarCompra').val();
        var totalIva = 0;
        var cobrado = compruebaCheckBoxSwitch("cobrado");

        if (selectProveedor == 0) {
            $("#errorselectProveedor_formModificarCompra").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectProveedor_formModificarCompra").css("display", "none");
            val1 = true;
        }
        if (selectTipoFact == 0) {
            $("#errorselectTipoFact").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectTipoFact").css("display", "none");
            val2 = true;
        }
        if (selectCategoriaCompra == 0) {
            $("#errorselectCategoriaCompra_formModificarCompra").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectCategoriaCompra_formModificarCompra").css("display", "none");
            val3 = true;
        }
        if (selectSubCategoriaCompra == 0) {
            $("#errorselectSubCategoriaCompra").css("display", "block");
            val8 = false;
        } else {
            $("#errorselectSubCategoriaCompra").css("display", "none");
            val8 = true;
        }

        if (totalCompraPost == 0) {
            val10 = false;
        } else {
            val10 = true;
        }
        if (inputFechaCobro == "") {
            $("#errorinputFechaPagoCompra_formModificarCompra").css("display", "block");
            val12 = false;
        } else {
            $("#errorinputFechaPagoCompra_formModificarCompra").css("display", "none");
            val12 = true;
        }

        tableListadoCompraEditar = $('#listadoCompra_formModificarCompra').DataTable();
        var info = tableListadoCompraEditar.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val7 = false;
        } else {
            val7 = true;
        }

        if (val1 && val2 && val3 && val7 && val8 && val10 && val12) {
            $("#modal-cargando").modal("show");
            var datosFacturacion = {
                "selectProveedor": selectProveedor,
                "selectCategoriaCompra": selectCategoriaCompra,
                "inputFechaEmisionCompra": inputFechaEmision,
                "inputFechaPagoCompra": inputFechaCobro,
                "selectTipoFactCompra": selectTipoFact,
                "selectSubCategoriaCompra": selectSubCategoriaCompra,
                "notaInterna": notaInterna,
                "totalNoGravado": importeNoGravado,
                "total": totalCompraPost,
                "descTotal": descEfectuado,
                "descProveedor": descProveedor,
                "totalIva": totalIva,
                "razonSocial": razonSocial
            };
            var datosCompra = [];
            var info = tableListadoCompraEditar.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoCompraEditar.data();
            var totalVenta = 0;
            var k = 0;
            var p = 0;
            //--- Obtenemos las configuraciones iniciales del sistema para saber si deberemos verificar el stock ---//
            $.ajax({
                    url: URL + 'configuracion_sistema/get_empresa/',
                    type: 'POST',
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    var empresa = dato['empresa'];
                    for (var i = 0; i < count; i++) {
                        var idInputSubTotal = "subTotalProd" + tabla[i][0];
                        var valorInputSubTotal = $('#' + idInputSubTotal).val();
                        totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                        //console.log($('#cantProd' + tabla[i][0]).val());
                        //console.log(tabla[i][4]);
                        var e = document.getElementById('selectIva' + tabla[i][0]);
                        var valueIvaSelect = e.options[e.selectedIndex].text;
                        //Si es X puede tener o no IVA

                        //Si es C o E no tiene que tener asociado el IVA
                        if (selectTipoFact == 3 || selectTipoFact == 5) {
                            //No tiene que tener iva por lo tanto el select deberia estar en "IVA", sino sumo el error a p
                            if (valueIvaSelect != "IVA") {
                                p++;
                            }
                            //Si es A, B o M tiene que tener asociado el IVA
                        } else if (selectTipoFact == 1 || selectTipoFact == 2 || selectTipoFact == 4) {
                            if (valueIvaSelect == "IVA") {
                                p++;
                            }
                        }

                        //--- verificamos si se debe controlar o no el stock, de serlo verificamos que cada detalle no se este excediendo el stock ---//
                        if ((empresa[0]['stock'] == 0 && parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4])) || empresa[0]['stock'] == 1) {
                            datosCompra.push({
                                "idProducto": tabla[i][0],
                                "codigo": tabla[i][1],
                                "stock": tabla[i][4],
                                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                                "precio": $('#precioProd' + tabla[i][0]).val(),
                                "descuento": $('#descProd' + tabla[i][0]).val(),
                                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                                "iva": $('#selectIva' + tabla[i][0]).val(),
                                "ivaText": valueIvaSelect
                            });
                        } else {
                            k++;
                            //console.log(k);
                        }
                        console.log($('#selectIva' + tabla[i][0]).val());
                    }

                    //--- verificamos si se debe controlar o no el stock, de serlo verificamos que ninguna detalle este excediendo el stock ---//
                    if ((empresa[0]['stock'] == 0 && k == 0) || empresa[0]['stock'] == 1) {
                        if (p == 0) {
                            $.ajax({
                                    url: URL + 'compras/update_compra/',
                                    type: 'POST',
                                    data: { datosCompra: datosCompra, datosFacturacion: datosFacturacion, idGenEgreso: idGenEgreso, totalCompra: totalCompraPost, importeNoGravado: importeNoGravado }
                                })
                                .done(function(data) {
                                    var dato = JSON.parse(data);
                                    //console.log(dato);
                                    if (dato['valid']) {
                                        $("#modal-cargando").modal("hide");
                                        swal(
                                            'Compra',
                                            dato['msg'],
                                            'success'
                                        )
                                        setTimeout(function() {
                                            location.href = URL + 'compras/listar_compras';
                                        }, 2000);
                                    } else {
                                        swal(
                                            'Compra',
                                            dato['msg'],
                                            'error'
                                        )
                                    }

                                })
                                .fail(function(data) {
                                    $("#popUpError").modal("show");
                                });
                        } else {
                            k = 0;
                            $("#modal-cargando").modal("hide");
                            document.getElementById("msgError").innerHTML = "Controle, hay productos que contienen un valor de iva que no corresponde al tipo de factura seleccionado.";
                            $("#popUpErrorMsg").modal("show");
                        }
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "Controle, hay productos que superan el stock";
                        $("#popUpErrorMsg").modal("show");
                        //console.log("Hay productos sin stock");
                    }
                })
                .fail(function(data) {});
        }
    });
    $('#btnEditarAbono').click(function(e) {
        e.preventDefault();
        var val1, val2, val3, val4 = true,
            val5 = true,
            val6 = true,
            val7 = true,
            val10, val11, val12, val13, val14;
        var selectCliente = $('#selectCliente_formEditarAbono').val();
        var inputFechaEmision = $('#inputFechaEmision_formEditarAbono').val();
        var inputFechaCobro = $('#inputFechaCobro_formEditarAbono').val();
        var selectTipoFact = $('#selectTipoFact_formEditarAbono').val();
        var selectCategoriaVenta = $('#selectCategoriaVenta_formEditarAbono').val();
        var selectSubCategoriaVenta = $('#selectSubCategoriaVenta_formEditarAbono').val();
        var inputFechaInicioAbono = $('#inputFechaInicioAbono_formEditarAbono').val();
        var inputFechaFinAbono = $('#inputFechaFinAbono_formEditarAbono').val();
        var selectModalidadAbono = $('#selectModalidadAbono_formEditarAbono').val();
        var inputFechaPrimeraVenta = $('#inputFechaPrimeraVenta_formEditarAbono').val();
        var inputFechaFinAbono = $('#inputFechaFinAbono_formEditarAbono').val();
        var notaCliente = $('#notaCliente_formEditarAbono').val();
        var notaInterna = $('#notaInterna_formEditarAbono').val();
        var totalVenta = $('#totalVenta_formEditarAbono').val();
        var descEfectuado = $('#descEfectuado_formEditarAbono').val();
        var descCliente = $('#descuentoCliente_formEditarAbono').val();
        var importeNoGravado = $('#importeNoGravado_formEditarAbono').val();
        var idGenAbono = $('#idGenAbono').val();
        var cobrado = 0; //Lo dejo en cero para mantener la estructura del array 
        var fechaInicioServicio = $('#inputFechaInicioServicio_abonoupdate').val();
        var fechaFinServicio = $('#inputFechaFinServicio_abonoupdate').val();
        var idConceptoFactura = $('#idConceptoFactura_abonoupdate').val();
        var idEstadoAbono = $('#idEstadoAbono').val();
        if (selectCliente == 0) {
            $("#errorselectCliente_formEditarAbono").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente_formEditarAbono").css("display", "none");
            val1 = true;
        }
        if (selectTipoFact == 0) {
            $("#errorselectTipoFact_formEditarAbono").css("display", "block");
            val2 = false;
        } else {
            $("#errorselectTipoFact_formEditarAbono").css("display", "none");
            val2 = true;
        }
        if (inputFechaPrimeraVenta == null || inputFechaPrimeraVenta.length == 0 || inputFechaPrimeraVenta == ' ' || inputFechaPrimeraVenta == '') {
            $("#errorinputFechaPrimeraVenta_formEditarAbono").css("display", "block");
            val10 = false;
        } else {
            $("#errorinputFechaPrimeraVenta_formEditarAbono").css("display", "none");
            val10 = true;
        }
        if (selectCategoriaVenta == 0) {
            $("#errorselectCategoriaVenta_formEditarAbono").css("display", "block");
            val3 = false;
        } else {
            $("#errorselectCategoriaVenta_formEditarAbono").css("display", "none");
            val3 = true;
        }
        if (selectSubCategoriaVenta == 0) {
            $("#errorselectSubCategoriaVenta_formEditarAbono").css("display", "block");
            val9 = false;
        } else {
            $("#errorselectSubCategoriaVenta_formEditarAbono").css("display", "none");
            val9 = true;
        }
        if (inputFechaInicioAbono == null || inputFechaInicioAbono.length == 0 || inputFechaInicioAbono == ' ' || inputFechaInicioAbono == '') {
            $("#errorinputFechaInicioAbono_formEditarAbono").css("display", "block");
            val4 = false;
        } else {
            $("#errorinputFechaInicioAbono_formEditarAbono").css("display", "none");
            val4 = true;
        }
        if (inputFechaFinAbono == null || inputFechaFinAbono.length == 0 || inputFechaFinAbono == ' ' || inputFechaFinAbono == '') {
            $("#errorinputFechaFinAbono_formEditarAbono").css("display", "block");
            val5 = false;
        } else {
            $("#errorinputFechaFinAbono_formEditarAbono").css("display", "none");
            val5 = true;
        }
        if (selectModalidadAbono == 0) {
            $("#errorselectModalidadAbono_formEditarAbono").css("display", "block");
            val6 = false;
        } else {
            $("#errorselectModalidadAbono_formEditarAbono").css("display", "none");
            val6 = true;
        }
        if (inputFechaCobro == null || inputFechaCobro.length == 0 || inputFechaCobro == ' ' || inputFechaCobro == '') {
            $("#errorinputFechaCobro_formEditarAbono").css("display", "block");
            val11 = false;
        } else {
            $("#errorinputFechaCobro_formEditarAbono").css("display", "none");
            val11 = true;
        }
        if (inputFechaEmision == null || inputFechaEmision.length == 0 || inputFechaEmision == ' ' || inputFechaEmision == '') {
            $("#errorinputFechaEmision_formEditarAbono").css("display", "block");
            val12 = false;
        } else {
            $("#errorinputFechaEmision_formEditarAbono").css("display", "none");
            val12 = true;
        }

        var info = $('#listadoAbonoEditar').DataTable().page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val7 = false;
        } else {
            val7 = true;
        }

        if (idConceptoFactura == 2) {
            if (fechaInicioServicio == "") {
                $("#errorinputFechaInicioServicio_abonoupdate").css("display", "block");
                val13 = false;
            } else {
                $("#errorinputFechaInicioServicio_abonoupdate").css("display", "none");
                val13 = true;
            }
            if (fechaFinServicio == "") {
                $("#errorinputFechaFinServicio_abonoupdate").css("display", "block");
                val14 = false;
            } else {
                $("#errorinputFechaFinServicio_abonoupdate").css("display", "none");
                val14 = true;
            }
        } else {
            fechaInicioServicio = "";
            fechaFinServicio = "";
        }

        if ((val1 && val2 && val3 && val5 && val6 && val7 && val9 && val10 && idConceptoFactura != 2) || (val1 && val2 && val3 && val5 && val6 && val7 && val9 && val10 && val13 && val14 && idConceptoFactura == 2)) {
            $("#modal-cargando").modal("show");
            var datosFacturacion = {
                "selectCliente": selectCliente,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaCobro": inputFechaCobro,
                "selectTipoFact": selectTipoFact,
                "selectCategoriaVenta": selectCategoriaVenta,
                "inputFechaInicioAbono": inputFechaInicioAbono,
                "inputFechaFinAbono": inputFechaFinAbono,
                "selectModalidadAbono": selectModalidadAbono,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "totalNoGravado": importeNoGravado,
                "total": totalVenta,
                "descTotal": descEfectuado,
                "descCliente": descCliente,
                "totalIva": 0,
                "cobrado": cobrado,
                "selectSubCategoriaVenta": selectSubCategoriaVenta,
                "inputFechaPrimeraVenta": inputFechaPrimeraVenta,
                "fechaInicioServicio": fechaInicioServicio,
                "fechaFinServicio": fechaFinServicio,
                "idEstado": idEstadoAbono
            };
            var datosVenta = [];
            var info = $('#listadoAbonoEditar').DataTable().page.info();
            var count = info.recordsTotal;
            var tabla = $('#listadoAbonoEditar').DataTable().data();
            var totalVenta = 0;
            var k = 0;
            //--- Obtencion de las configuraciones iniciales del sistema ---//
            $.ajax({
                    url: URL + 'configuracion_sistema/get_empresa/',
                    type: 'POST',
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    var empresa = dato['empresa'];
                    for (var i = 0; i < count; i++) {
                        var idInputSubTotal = "subTotalProd" + tabla[i][0];
                        var valorInputSubTotal = $('#' + idInputSubTotal).val();
                        totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                        var e = document.getElementById('selectIva' + tabla[i][0]);
                        var valueIvaSelect = e.options[e.selectedIndex].text;
                        //--- verificamos que se controle o no el stock, de serlo tenemos que verifica que el detalle se haya excedido del maximo ---//
                        if ((empresa[0]['stock'] == 0 && parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4])) || empresa[0]['stock'] == 1) {
                            datosVenta.push({
                                "idProducto": tabla[i][0],
                                "codigo": tabla[i][1],
                                "stock": tabla[i][4],
                                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                                "precio": $('#precioProd' + tabla[i][0]).val(),
                                "descuento": $('#descProd' + tabla[i][0]).val(),
                                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                                "iva": $('#selectIva' + tabla[i][0]).val(),
                                "ivaText": valueIvaSelect
                            });
                        } else {
                            k++;
                        }
                    }

                    //--- verificamos que se controle o no el stock, de serlo tenemos que verifica que ningun detalle se haya excedido del maximo ---//
                    if ((empresa[0]['stock'] == 0 && k == 0) || empresa[0]['stock'] == 1) {
                        $.ajax({
                                url: URL + 'abonos/update_abono/',
                                type: 'POST',
                                data: { datosVenta: datosVenta, datosFacturacion: datosFacturacion, idGenAbono: idGenAbono, totalVenta: totalVenta, importeNoGravado: importeNoGravado }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                //console.log(dato);
                                if (dato['valid']) {
                                    $("#modal-cargando").modal("hide");
                                    swal(
                                        'Abono',
                                        dato['msg'],
                                        'success'
                                    )
                                    setTimeout(function() {
                                        location.href = URL + 'abonos/listar_abonos';
                                    }, 2000);
                                } else {
                                    $("#modal-cargando").modal("hide");
                                    swal(
                                        'Abono',
                                        dato['msg'],
                                        'error'
                                    )
                                }

                            })
                            .fail(function(data) {
                                $("#modal-cargando").modal("hide");
                                document.getElementById("msgError").innerHTML = "Controle, " + dato['msg'];
                                $("#popUpErrorMsg").modal("show");
                            });
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "Controle, hay productos que superan el stock";
                        $("#popUpErrorMsg").modal("show");
                        //console.log("Hay productos sin stock");
                    }
                })
                .fail(function(data) {});
        }
    });
});

function generarPdfComprobanteLegal(idGenIngreso) {
    $.ajax({
            url: URL + 'ventas/generaPDFComprobanteLegal/' + idGenIngreso,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            $("#operacionExitosa").modal("hide");
            var dato = JSON.parse(data);
            if (dato['valid']) {
                swal({
                    title: "Comprobante Legal",
                    text: "Venta",
                    width: "800px",
                    html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/ventas/' + idGenIngreso + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                    showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                    closeOnClickOutside: false,
                    onClose: (login) => {
                        location.href = URL + 'ventas/listar_ventas';
                    },

                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#operacionExitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

function generarPdfComprobanteNoLegal(idGenIngreso) {
    $.ajax({
            url: URL + 'ventas/generaPDFComprobanteNoLegal/' + idGenIngreso,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            $("#operacionExitosa").modal("hide");
            var dato = JSON.parse(data);
            if (dato['valid']) {
                swal({
                    title: "Comprobante",
                    text: "",
                    width: "800px",
                    html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/ventas/' + idGenIngreso + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                    showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                    closeOnClickOutside: false,
                    onClose: (login) => {
                        location.href = URL + 'ventas/listar_ventas';
                    },
                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#operacionExitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- Agregar producto nuevo - no esta en la bd Venta---//
function addProductoNew() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                var row = tableListadoVenta.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + ',' + 1 + ',' + 0 + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporal(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVenta(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                    dato['idGenProducto'],
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                tableListadoVenta.row(row).column(0).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(1).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(2).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(3).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(4).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(5).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(6).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(7).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(8).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- Agregar producto nuevo - no esta en la bd Venta---//
function addProductoNewEditarVenta() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                tableListadoVenta = $('#listadoVentaEditar').DataTable();
                var row = tableListadoVenta.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + ',' + 1 + ',' + 0 + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalEditar(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVenta(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                tableListadoVenta.row(row).column(0).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(1).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(2).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(3).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(4).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(5).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(6).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(7).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(8).nodes().to$().addClass('text-center');
                tableListadoVenta.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- Agregar producto nuevo presupuesto - no esta en la bd Presupuesto---//
function addProductoNewPresupuesto() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                listadoPresupuesto = $('#listadoPresupuesto_formNuevoPresupuesto').DataTable();
                var row = listadoPresupuesto.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoPresupuesto(' + idGenProd + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoPresupuesto(' + idGenProd + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoPresupuesto(' + idGenProd + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalPresupuesto(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaPresupuesto(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                listadoPresupuesto.row(row).column(0).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(1).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(2).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(3).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(4).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(5).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(6).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(7).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(8).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}
//--- Agregar producto nuevo presupuesto - no esta en la bd Presupuesto editar---//
function addProductoNewPresupuesto_editar() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                listadoPresupuesto = $('#listadoPresupuesto_formModificarPresupuesto').DataTable();
                var row = listadoPresupuesto.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoVenta(' + idGenProd + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoVenta(' + idGenProd + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoVenta(' + idGenProd + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalPresupuestoDetalle(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaPresupuestoDetalle(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                listadoPresupuesto.row(row).column(0).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(1).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(2).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(3).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(4).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(5).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(6).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(7).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(8).nodes().to$().addClass('text-center');
                listadoPresupuesto.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}
//--- Agregar producto nuevo - no esta en la bd COMPRA---//
function addProductoNewCompra() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                var row = tableListadoCompra.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + ',' + 1 + ',' + 0 + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoCompra(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoCompra(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoCompra(' + idGenProd + ',' + 1 + ',' + 0 + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalCompra(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVenta(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                tableListadoCompra.row(row).column(0).nodes().to$().addClass('text-center');
                tableListadoCompra.row(row).column(1).nodes().to$().addClass('text-center');
                tableListadoCompra.row(row).column(2).nodes().to$().addClass('text-center');
                tableListadoCompra.row(row).column(3).nodes().to$().addClass('text-center');
                tableListadoCompra.row(row).column(4).nodes().to$().addClass('text-right');
                tableListadoCompra.row(row).column(5).nodes().to$().addClass('text-right');
                tableListadoCompra.row(row).column(6).nodes().to$().addClass('text-right');
                tableListadoCompra.row(row).column(7).nodes().to$().addClass('text-right');
                tableListadoCompra.row(row).column(8).nodes().to$().addClass('text-right');
                tableListadoCompra.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}
//--- Agregar producto nuevo - no esta en la bd COMPRA---//
function addProductoNewCompraEditar() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                tableListadoCompraEditar = $('#listadoCompra_formModificarCompra').DataTable();
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                var row = tableListadoCompraEditar.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idProducto'] + '" onkeyup="calculoCompraEditar(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idProducto'] + '" onkeyup="calculoCompraEditar(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idProducto'] + '" disabled class="select-full" onchange="calculoCompraEditar(' + idGenProd + ',' + 1 + ',' + 0 + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalCompraEditar(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaCompraEditar(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                tableListadoCompraEditar.row(row).column(0).nodes().to$().addClass('text-center hide-column');
                tableListadoCompraEditar.row(row).column(1).nodes().to$().addClass('text-center');
                tableListadoCompraEditar.row(row).column(2).nodes().to$().addClass('text-center');
                tableListadoCompraEditar.row(row).column(3).nodes().to$().addClass('text-center');
                tableListadoCompraEditar.row(row).column(4).nodes().to$().addClass('text-right');
                tableListadoCompraEditar.row(row).column(5).nodes().to$().addClass('text-right');
                tableListadoCompraEditar.row(row).column(6).nodes().to$().addClass('text-right');
                tableListadoCompraEditar.row(row).column(7).nodes().to$().addClass('text-right');
                tableListadoCompraEditar.row(row).column(8).nodes().to$().addClass('text-right');
                tableListadoCompraEditar.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- Agregar producto nuevo - no esta en la bd COMPRA---//
function addProductoNewAbonoEditar() {
    $("#modal-cargando").modal("show");
    listadoAbonoEditar = $('#listadoAbonoEditar').DataTable();
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                var row = listadoAbonoEditar.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoCompra(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoCompra(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoAbonoEditar(' + idGenProd + ',' + 1 + ',' + 0 + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalCompra(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaAbonoEditar(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                listadoAbonoEditar.row(row).column(0).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(1).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(2).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(3).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(4).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(5).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(6).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(7).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(8).nodes().to$().addClass('text-center');
                listadoAbonoEditar.row(row).column(9).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}

function saveProductoTemporal(id) {
    $("#modal-cargando").modal("show");
    tableListadoVenta = $('#listadoVenta').DataTable();
    row = tableListadoVenta.row("#" + id).data();
    //console.log("id - " + id);
    var val1, val2;
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }
    //    //console.log("val1: "+val1);
    //    //console.log("val2: "+val2);


    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option = "";
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            if (dato['producto'][0]['idIvaVta'] == dato['iva_tipos'][i]['idIva']) {
                                iva_tipos_option += '<option selected="selected" value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                            } else {
                                iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                            }
                        }
                    }

                    //                $("#idAgregarP"+id).css("display", "none");
                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVenta(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    tableListadoVenta.row("#" + id).data(row);
                    tableListadoVenta.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    //                document.getElementById("altaProd"+id).value = "1";
                    $("#operacionExitosa").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                var dato = JSON.parse(data);
                document.getElementById("msgError").innerHTML = "adsdfasdf";
                $("#popUpErrorMsg").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
        $("#popUpErrorMsg").modal("show");
    }
}

function saveProductoTemporalEditar(id) {
    $("#modal-cargando").modal("show");
    tableListadoVenta = $('#listadoVentaEditar').DataTable();
    row = tableListadoVenta.row("#" + id).data();
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }
    //    //console.log("val1: "+val1);
    //    //console.log("val2: "+val2);


    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                        }
                    }
                    idGenProducto = "'" + dato['producto'][0]['idGenProducto'] + "'";
                    //                $("#idAgregarP"+id).css("display", "none");
                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoVentaEditar(' + idGenProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVentaEditar(' + dato['producto'][0]['idProducto'] + ',' + 0 + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVentaEditar(' + dato['producto'][0]['idProducto'] + ',' + 0 + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVentaEditar(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    tableListadoVenta.row("#" + id).data(row);
                    tableListadoVenta.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    //                document.getElementById("altaProd"+id).value = "1";
                    $("#operacionExitosa").modal("show");
                    totalVentaEditar();
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                var dato = JSON.parse(data);
                document.getElementById("msgError").innerHTML = "adsdfasdf";
                $("#popUpErrorMsg").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
        $("#popUpErrorMsg").modal("show");
    }
}

function saveProductoTemporalPresupuesto(id) {
    $("#modal-cargando").modal("show");
    listadoPresupuesto = $('#listadoPresupuesto_formNuevoPresupuesto').DataTable();
    row = listadoPresupuesto.row("#" + id).data();
    var idGenProducto = row[0].val();
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }

    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                        }
                    }

                    //                $("#idAgregarP"+id).css("display", "none");
                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVenta(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    listadoPresupuesto.row("#" + id).data(row);
                    listadoPresupuesto.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    //                document.getElementById("altaProd"+id).value = "1";
                    $("#operacionExitosa").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#popUpError").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
        $("#popUpErrorMsg").modal("show");
    }
}

function saveProductoTemporalPresupuestoDetalle(id) {
    $("#modal-cargando").modal("show");
    listadoPresupuesto = $('#listadoPresupuesto_formModificarPresupuesto').DataTable();
    row = listadoPresupuesto.row("#" + id).data();
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }

    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                        }
                    }

                    //                $("#idAgregarP"+id).css("display", "none");
                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    listadoPresupuesto.row("#" + id).data(row);
                    listadoPresupuesto.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    //                document.getElementById("altaProd"+id).value = "1";
                    $("#operacionExitosa").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#popUpError").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
        $("#popUpErrorMsg").modal("show");
    }
}

function saveProductoTemporalCompra(id) {
    $("#modal-cargando").modal("show");
    listadoAbonoEditar = $('#listadoAbonoEditar').DataTable();
    row = listadoAbonoEditar.row("#" + id).data();
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    var val1, val2;
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }

    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            if (dato['producto'][i]['idIvaCompra'] == dato['iva_tipos'][i]['idIva']) {
                                iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                            } else {
                                iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                            }
                        }
                    }

                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoAbonoEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + 1 + ',' + 0 + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoAbonoEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + 1 + ',' + 0 + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoAbonoEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + 1 + ',' + 0 + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaAbonoEditar(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    listadoAbonoEditar.row("#" + id).data(row);
                    listadoAbonoEditar.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    $("#operacionExitosa").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
                $("#popUpErrorMsg").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        $("#popUpError").modal("show");
    }
}

function saveProductoTemporalCompraEditar(id) {
    $("#modal-cargando").modal("show");
    listadoCompraEditar = $('#listadoCompra_formModificarCompra').DataTable();
    row = listadoCompraEditar.row("#" + id).data();
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    var val1, val2;
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }

    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            if (dato['producto'][0]['idIvaCompra'] == dato['iva_tipos'][i]['idIva']) {
                                iva_tipos_option += '<option selected="selected" value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                            } else {
                                iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                            }
                        }
                    }

                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoCompraEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoCompraEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoCompraEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaCompraEditar(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    listadoCompraEditar.row("#" + id).data(row);
                    listadoCompraEditar.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    $("#operacionExitosa").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
                $("#popUpErrorMsg").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        $("#popUpError").modal("show");
    }
}

function saveProductoTemporalAbonoEditar(id) {
    $("#modal-cargando").modal("show");
    row = tableListadoCompra.row("#" + id).data();
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }
    //    //console.log("val1: "+val1);
    //    //console.log("val2: "+val2);


    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                        }
                    }

                    //                $("#idAgregarP"+id).css("display", "none");
                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVenta(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 0 + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaCompra(' + dato['producto'][0]['idProducto'] + ',' + 0 + ')"></i>' +
                        '&nbsp;';
                    tableListadoCompra.row("#" + id).data(row);
                    tableListadoCompra.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    //                document.getElementById("altaProd"+id).value = "1";
                    $("#operacionExitosa").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
                $("#popUpErrorMsg").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        $("#popUpError").modal("show");
    }
}


//--- PROVINCIA/LOCALIDAD ---//
$(document).ready(function() {
    $("#selectProvincia").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectProvincia option:selected").each(function() {
            var idProvincia = $('#selectProvincia').val();
            var idUsuario = $('#idUsuarioAgregar').val();
            $.post(URL + 'localidad/buscaLocalidadUsuario', {
                idProvincia: idProvincia,
                id: idUsuario
            }, function(data) {
                document.getElementById("selectLocalidad").value = "";
                $("#selectLocalidad").html(data);
                $("#modal-cargando").modal("hide");
            });
        });
    })
    $("#selectCategoriaVenta").change(function() {
            $("#modal-cargando").modal("show");
            $("#selectCategoriaVenta option:selected").each(function() {
                idCategoriaVentaDetalle = $('#selectCategoriaVenta').val();
                $.post(URL + 'ventas/buscaSubcategoriaVentaDetalle', {
                    idCategoriaVentaDetalle: idCategoriaVentaDetalle
                }, function(data) {
                    document.getElementById("selectSubCategoriaVenta").value = "";
                    $("#selectSubCategoriaVenta").html(data);
                    $("#modal-cargando").modal("hide");
                });
            });
        })
        //--- Carga de la subcategoria en presupuesto ---//
        //--- Nuevo ---//
    $("#selectCategoriaPresupuesto_formNuevoPresupuesto").change(function() {
            $("#modal-cargando").modal("show").css('z-index', '9999');
            $("#selectCategoriaPresupuesto_formNuevoPresupuesto option:selected").each(function() {
                idCategoriaPresupuesto = $('#selectCategoriaPresupuesto_formNuevoPresupuesto').val();
                $.post(URL + 'presupuesto/buscaSubcategoriaPresupuesto', {
                    idCategoriaPresupuesto: idCategoriaPresupuesto
                }, function(data) {
                    document.getElementById("selectSubCategoriaPresupuesto_formNuevoPresupuesto").value = "";
                    $("#selectSubCategoriaPresupuesto_formNuevoPresupuesto").html(data);
                    $("#modal-cargando").modal("hide");
                });
            });
        })
        //--- Modificar ---//
    $("#selectCategoriaPresupuesto_formModificarPresupuesto").change(function() {
            $("#modal-cargando").modal("show").css('z-index', '9999');
            $("#selectCategoriaPresupuesto_formModificarPresupuesto option:selected").each(function() {
                idCategoriaPresupuesto = $('#selectCategoriaPresupuesto_formModificarPresupuesto').val();
                $.post(URL + 'presupuesto/buscaSubcategoriaPresupuesto', {
                    idCategoriaPresupuesto: idCategoriaPresupuesto
                }, function(data) {
                    document.getElementById("selectSubCategoriaPresupuesto_formModificarPresupuesto").value = "";
                    $("#selectSubCategoriaPresupuesto_formModificarPresupuesto").html(data);
                    $("#modal-cargando").modal("hide");
                });
            });
        })
        //--- Fin ---//
    $("#selectCatGasto_modificarGasto").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectCatGasto_modificarGasto option:selected").each(function() {
            var selectCatGasto = $('#selectCatGasto_modificarGasto').val();
            $.post(URL + 'gastos/buscaSubcategoriaGasto', {
                selectCatGasto: selectCatGasto
            }, function(data) {
                document.getElementById("selectSubCatGasto_modificarGasto").value = "";
                $("#selectSubCatGasto_modificarGasto").html(data);
                $("#modal-cargando").modal("hide");
            });
        });
    })
    $("#selectCatGasto").change(function() {
            $("#modal-cargando").modal("show");
            $("#selectCatGasto option:selected").each(function() {
                var selectCatGasto = $('#selectCatGasto').val();
                $.post(URL + 'gastos/buscaSubcategoriaGasto', {
                    selectCatGasto: selectCatGasto
                }, function(data) {
                    document.getElementById("selectSubCatGasto").value = "";
                    $("#selectSubCatGasto").html(data);
                    $("#modal-cargando").modal("hide");
                });
            });
        })
        /*$("#selectCategoriaCompra").change(function() {
            $("#modal-cargando").modal("show");
            $("#selectCategoriaCompra option:selected").each(function() {
                idCategoriaCompra = $('#selectCategoriaCompra').val();
                $.post(URL + 'compras/buscaSubcategoriaCompraDetalle', {
                    idCategoriaCompra: idCategoriaCompra
                }, function(data) {
                    document.getElementById("selectSubCategoriaCompra").value = "";
                    $("#selectSubCategoriaCompra").html(data);
                    $("#modal-cargando").modal("hide");
                });
            });
        })
    $("#selectCategoriaCompra_formModificarCompra").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectCategoriaCompra_formModificarCompra option:selected").each(function() {
            idCategoriaVentaDetalle = $('#selectCategoriaCompra_formModificarCompra').val();
            //console.log("id - " + idCategoriaVentaDetalle);
            $.post(URL + 'compras/buscaSubcategoriaCompraDetalle', {
                idCategoriaVentaDetalle: idCategoriaVentaDetalle
            }, function(data) {
                document.getElementById("selectSubCategoriaCompra_formModificarCompra").value = "";
                $("#selectSubCategoriaCompra_formModificarCompra").html(data);
                $("#modal-cargando").modal("hide");
            });
        });
    })*/
    $("#selectCategoriaVenta_formEditarAbono").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectCategoriaVenta_formEditarAbono option:selected").each(function() {
            idCategoriaAbonoDetalle = $('#selectCategoriaVenta_formEditarAbono').val();
            //console.log("id - " + idCategoriaAbonoDetalle);
            $.post(URL + 'ventas/buscaSubcategoriaVentaDetalle', {
                idCategoriaVentaDetalle: idCategoriaAbonoDetalle
            }, function(data) {
                document.getElementById("selectSubCategoriaVenta_formEditarAbono").value = "";
                //console.log("Entro");
                $("#selectSubCategoriaVenta_formEditarAbono").html(data);
                $("#modal-cargando").modal("hide");
            });
        });
    })
    $("#selectProvincia_formProveedor").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectProvincia_formProveedor option:selected").each(function() {
            var idProvincia = $('#selectProvincia_formProveedor').val();
            var idGenProveedor = $('#inputIdGenProveedor_formProveedor').val();
            $.post(URL + 'localidad/buscaLocalidadProveedor', {
                idProvincia: idProvincia,
                id: idGenProveedor
            }, function(data) {
                var dato = JSON.parse(data);
                if (dato['options'] != "") {
                    $("#modal-cargando").modal("hide");
                    document.getElementById("selectLocalidad_formProveedor").value = "";
                    $("#selectLocalidad_formProveedor").html(dato['options']);
                    //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                    if (dato['idLocalidad'] != "") {
                        $('#selectLocalidad_formProveedor').val(parseInt(dato['idLocalidad'])).trigger('change');
                    }
                } else {
                    $.ajax({
                            url: URL + 'localidad/buscaLocalidadProveedor',
                            type: 'POST',
                            data: { idProvincia: idProvincia, id: idGenProveedor }
                        })
                        .done(function(data) {
                            var datos = JSON.parse(data);

                            $("#modal-cargando").modal("hide");
                            document.getElementById("selectLocalidad_formProveedor").value = "";
                            $("#selectLocalidad_formProveedor").html(datos['options']);

                            //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                            if (datos['idLocalidad'] != "") {
                                $('#selectLocalidad_formProveedor').val(parseInt(datos['idLocalidad'])).trigger('change');
                            }
                        });
                }
            });
        });
    })

    $("#selectProvinciaFac_formProveedor").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectProvinciaFac_formProveedor option:selected").each(function() {

            var idProvincia = $('#selectProvinciaFac_formProveedor').val();
            var idGenProveedor = $('#inputIdGenProveedor_formProveedor').val();

            $.post(URL + 'localidad/buscaLocalidadProveedor', {
                idProvincia: idProvincia,
                id: idGenProveedor
            }, function(data) {
                var dato = JSON.parse(data);

                if (dato['options'] != "") {
                    $("#modal-cargando").modal("hide");
                    document.getElementById("selectLocalidadFac_formProveedor").value = "";
                    $("#selectLocalidadFac_formProveedor").html(dato['options']);
                    //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                    if (dato['idLocalidadFac'] != "") {
                        $('#selectLocalidadFac_formProveedor').val(parseInt(dato['idLocalidadFac'])).trigger('change');
                    }
                } else {
                    $.ajax({
                            url: URL + 'localidad/buscaLocalidadProveedor',
                            type: 'POST',
                            data: { idProvincia: idProvincia, id: idGenProveedor }
                        })
                        .done(function(data) {
                            var datos = JSON.parse(data);

                            $("#modal-cargando").modal("hide");
                            document.getElementById("selectLocalidadFac_formProveedor").value = "";
                            $("#selectLocalidadFac_formProveedor").html(datos['options']);

                            //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                            if (datos['idLocalidadFac'] != "") {
                                $('#selectLocalidadFac_formProveedor').val(parseInt(datos['idLocalidadFac'])).trigger('change');
                            }
                        });
                }
            });
        });
    })

    $("#selectProvincia_formCliente").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectProvincia_formCliente option:selected").each(function() {
            //--- Obtencion de datos ---//
            var idProvincia = $('#selectProvincia_formCliente').val();
            var idGenCliente = $('#inputIdGenCliente_formCliente').val();
            $.post(URL + 'localidad/buscaLocalidadCliente', {
                idProvincia: idProvincia,
                id: idGenCliente
            }, function(data) {
                var dato = JSON.parse(data);

                if (dato['options'] != "") {
                    $("#modal-cargando").modal("hide");
                    document.getElementById("selectLocalidad_formCliente").value = "";
                    $("#selectLocalidad_formCliente").html(dato['options']);
                    //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                    if (dato['idLocalidad'] != "") {
                        $('#selectLocalidad_formCliente').val(parseInt(dato['idLocalidad'])).trigger('change');
                    }
                } else {
                    $.ajax({
                            url: URL + 'localidad/buscaLocalidadCliente',
                            type: 'POST',
                            data: { idProvincia: idProvincia, id: idGenCliente }
                        })
                        .done(function(data) {
                            var datos = JSON.parse(data);

                            $("#modal-cargando").modal("hide");
                            document.getElementById("selectLocalidad_formCliente").value = "";
                            $("#selectLocalidad_formCliente").html(datos['options']);

                            //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                            if (datos['idLocalidad'] != "") {
                                $('#selectLocalidad_formCliente').val(parseInt(datos['idLocalidad'])).trigger('change');
                            }
                        });
                }
            });
        });
    })

    $("#selectProvincia_formConfiguracionSistema").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectProvincia_formConfiguracionSistema option:selected").each(function() {
            idProvincia = $('#selectProvincia_formConfiguracionSistema').val();
            $.post(URL + 'localidad/buscaLocalidad', {
                idProvincia: idProvincia
            }, function(data) {
                document.getElementById("selectLocalidad_formConfiguracionSistema").value = "";
                $("#selectLocalidad_formConfiguracionSistema").html(data);
                $("#modal-cargando").modal("hide");
            });
        });
    })

    $("#selectProvinciaFac_formCliente").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectProvinciaFac_formCliente option:selected").each(function() {
            //--- Obtencion de datos ---//
            var idProvincia = $('#selectProvinciaFac_formCliente').val();
            var idGenCliente = $('#inputIdGenCliente_formCliente').val();
            $.post(URL + 'localidad/buscaLocalidadCliente', {
                idProvincia: idProvincia,
                id: idGenCliente
            }, function(data) {
                var dato = JSON.parse(data);

                if (dato['options'] != "") {
                    //console.log("Entre al options");
                    //console.log(dato['options']);
                    $("#modal-cargando").modal("hide");
                    document.getElementById("selectLocalidadFac_formCliente").value = "";
                    $("#selectLocalidadFac_formCliente").html(dato['options']);
                    //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                    if (dato['idLocalidadFac'] != "") {
                        $('#selectLocalidadFac_formCliente').val(parseInt(dato['idLocalidadFac'])).trigger('change');
                    }
                } else {
                    $.ajax({
                            url: URL + 'localidad/buscaLocalidadCliente',
                            type: 'POST',
                            data: { idProvincia: idProvincia, id: idGenCliente }
                        })
                        .done(function(data) {
                            var datos = JSON.parse(data);

                            $("#modal-cargando").modal("hide");
                            document.getElementById("selectLocalidadFac_formCliente").value = "";
                            $("#selectLocalidadFac_formCliente").html(datos['options']);

                            //--- Validamos que no venga vacio para poder seleccionar la localidad correspondiente ---//
                            if (datos['idLocalidadFac'] != "") {
                                $('#selectLocalidadFac_formCliente').val(parseInt(datos['idLocalidadFac'])).trigger('change');
                            }
                        });
                }

            });
        });
    })



    //Agregar producto
    $("#selectProductos").change(function() {
            $("#selectProductos option:selected").each(function() {
                var idProducto = $('#selectProductos').val();
                var idCliente = $('#selectCliente').val();
                if (idCliente != 0) {
                    if (idProducto == "addProdNew") {
                        addProductoNew();
                    } else if (idProducto != 0) {
                        $("#modal-cargando").modal("show");
                        $.ajax({
                                url: URL + 'productos/get_producto/',
                                type: 'POST',
                                data: { idProducto: idProducto }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                //console.log(dato);

                                if (dato['valid']) {
                                    if (dato['producto'][0]['stock'] > 0) {
                                        //--- AGREGO FILA ---//
                                        $("#errorStockProducto").css("display", "none");
                                        var iva_tipos_option = "";
                                        if (dato['iva_tipos']) {
                                            for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                                if (parseInt(dato['ivaDefecto']) == parseInt(dato['iva_tipos'][i]['idIva'])) {
                                                    iva_tipos_option += '<option selected="selected" value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                                } else {
                                                    iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                                }
                                            }
                                        }

                                        tableListadoVenta = $('#listadoVenta').DataTable();
                                        var info = tableListadoVenta.page.info();
                                        var count = info.recordsTotal;
                                        var tabla = tableListadoVenta.data();
                                        var p = 0;
                                        for (var i = 0; i < count; i++) {
                                            if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                                p++;
                                            }
                                        }

                                        idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                                        if (p == 0) {
                                            var row = tableListadoVenta.row.add([
                                                dato['producto'][0]['idProducto'],
                                                dato['producto'][0]['codigo'],
                                                dato['producto'][0]['nombre'],
                                                '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVenta(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                                '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                                'Stock: ' + dato['producto'][0]['stock'] +
                                                '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                                dato['producto'][0]['stock'],
                                                '<div class="input-group">' +
                                                '<span class="input-group-addon">$</span>' +
                                                '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                                '</div>',
                                                '<div class="input-group">' +
                                                '<span class="input-group-addon">%</span>' +
                                                '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVenta(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                                '</div>',
                                                '<div class="input-group">' +
                                                '<span class="input-group-addon">$</span>' +
                                                '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                                '</div>',
                                                '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVenta(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                                '<option value="0">IVA</option>' +
                                                iva_tipos_option +
                                                '</select>',
                                                '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVenta(' + idProducto + ')"></i>' +
                                                '&nbsp;',
                                                dato['producto'][0]['idProducto'],
                                            ]).draw(false);
                                            row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                            tableListadoVenta.row(row).column(0).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(1).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(2).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(3).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(4).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(5).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(6).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(7).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(8).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(9).nodes().to$().addClass('text-center');
                                            tableListadoVenta.row(row).column(10).nodes().to$().addClass('text-center');
                                            calculoVenta(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                                        } else {
                                            $("#modal-cargando").modal("hide");
                                            document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                            $("#popUpErrorMsg").modal("show");
                                        }
                                        $("#modal-cargando").modal("hide");
                                    } else {
                                        //console.log('Sin Stock');
                                        $("#modal-cargando").modal("hide");
                                        $("#errorStockProducto").css("display", "block");
                                    }
                                } else {
                                    $("#modal-cargando").modal("hide");
                                    $("#modal-exitoso").modal("hide");
                                    $("#popUpError").modal("show");
                                }
                            })
                            .fail(function(data) {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            });
                    }
                } else {
                    swal(
                        'Error',
                        "Debe primero seleccionar un cliente",
                        'error'
                    )
                }
            });
        })
        //Agregar producto
    $("#selectProductos_editarVenta").change(function() {
        $("#selectProductos_editarVenta option:selected").each(function() {
            var idProducto = $('#selectProductos_editarVenta').val();
            var idCliente = $('#selectCliente').val();
            if (idCliente != 0) {
                if (idProducto == "addProdNew_formEditarVenta") {
                    addProductoNewEditarVenta();
                } else if (idProducto != 0) {
                    $("#modal-cargando").modal("show");
                    $.ajax({
                            url: URL + 'productos/get_producto/',
                            type: 'POST',
                            data: { idProducto: idProducto }
                        })
                        .done(function(data) {
                            var dato = JSON.parse(data);
                            //                //console.log(dato);

                            if (dato['valid']) {
                                if (dato['producto'][0]['stock'] > 0) {
                                    //--- AGREGO FILA ---//
                                    $("#errorStockProducto").css("display", "none");
                                    var iva_tipos_option;
                                    if (dato['iva_tipos']) {
                                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                            if (dato['ivaDefecto'] == dato['iva_tipos'][i]['idIva']) {
                                                iva_tipos_option = iva_tipos_option + '<option selected="selected" value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                            } else {
                                                iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                            }
                                        }
                                    }

                                    tableListadoVenta = $('#listadoVentaEditar').DataTable();
                                    var info = tableListadoVenta.page.info();
                                    var count = info.recordsTotal;
                                    var tabla = tableListadoVenta.data();
                                    var p = 0;
                                    for (var i = 0; i < count; i++) {
                                        if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                            p++;
                                        }
                                    }

                                    idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                                    if (p == 0) {
                                        var row = tableListadoVenta.row.add([
                                            dato['producto'][0]['idProducto'],
                                            dato['producto'][0]['codigo'],
                                            dato['producto'][0]['nombre'],
                                            '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVentaEditar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                            '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                            'Stock: ' + dato['producto'][0]['stock'] +
                                            '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                            dato['producto'][0]['stock'],
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">%</span>' +
                                            '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVentaEditar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                            '</div>',
                                            '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVentaEditar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                            '<option value="0">IVA</option>' +
                                            iva_tipos_option +
                                            '</select>',
                                            '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVentaEditar(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                                            '&nbsp;',
                                        ]).draw(false);
                                        row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                        tableListadoVenta.row(row).column(0).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(1).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(2).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(3).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(4).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(5).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(6).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(7).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(8).nodes().to$().addClass('text-center');
                                        tableListadoVenta.row(row).column(9).nodes().to$().addClass('text-center');
                                        calculoVentaEditar(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                                    } else {
                                        $("#modal-cargando").modal("hide");
                                        document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                        $("#popUpErrorMsg").modal("show");
                                    }
                                    $("#modal-cargando").modal("hide");
                                } else {
                                    //console.log('Sin Stock');
                                    $("#modal-cargando").modal("hide");
                                    $("#errorStockProducto").css("display", "block");
                                }
                            } else {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            }
                        })
                        .fail(function(data) {
                            $("#modal-cargando").modal("hide");
                            $("#modal-exitoso").modal("hide");
                            $("#popUpError").modal("show");
                        });
                }
            } else {
                swal(
                    'Error',
                    "Debe primero seleccionar un cliente",
                    'error'
                )
            }
        });
    })
    $("#selectProductosCompras").change(function() {
        $("#selectProductosCompras option:selected").each(function() {
            var idProducto = $('#selectProductosCompras').val();
            var idProveedor = $('#selectProveedor').val();
            if (idProveedor != 0) {
                $("#modal-cargando").modal("show");
                if (idProducto == "addProductoNewCompra") {
                    addProductoNewCompra();
                } else {
                    $.ajax({
                            url: URL + 'productos/get_producto/',
                            type: 'POST',
                            data: { idProducto: idProducto }
                        })
                        .done(function(data) {
                            var dato = JSON.parse(data);
                            //                //console.log(dato);

                            if (dato['valid']) {
                                //--- AGREGO FILA ---//
                                $("#errorStockProducto").css("display", "none");
                                var iva_tipos_option;
                                if (dato['iva_tipos']) {
                                    for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                        if (dato['ivaDefecto'] == dato['iva_tipos'][i]['idIva']) {
                                            iva_tipos_option += '<option selected="selected" value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                        } else {
                                            iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                        }
                                    }
                                }

                                tableListadoCompra = $('#listadoCompra').DataTable();
                                var info = tableListadoCompra.page.info();
                                var count = info.recordsTotal;
                                var tabla = tableListadoCompra.data();
                                var p = 0;
                                for (var i = 0; i < count; i++) {
                                    if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                        p++;
                                    }
                                }

                                if (p == 0) {
                                    var row = tableListadoCompra.row.add([
                                        dato['producto'][0]['idProducto'],
                                        dato['producto'][0]['codigo'],
                                        dato['producto'][0]['nombre'],
                                        '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoCompra(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                        '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                        'Stock: ' + dato['producto'][0]['stock'] +
                                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                        dato['producto'][0]['stock'],
                                        '<div class="input-group">' +
                                        '<span class="input-group-addon">$</span>' +
                                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" onblur="calculoCompra(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                        '</div>',
                                        '<div class="input-group">' +
                                        '<span class="input-group-addon">%</span>' +
                                        '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoCompra(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                        '</div>',
                                        '<div class="input-group">' +
                                        '<span class="input-group-addon">$</span>' +
                                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                        '</div>',
                                        '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoCompra(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] +
                                        '<option value="0">IVA</option>' +
                                        iva_tipos_option +
                                        '</select>',
                                        '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaCompra(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                                        '&nbsp;',
                                    ]).draw(false);
                                    row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                    tableListadoCompra.row(row).column(0).nodes().to$().addClass('text-center');
                                    tableListadoCompra.row(row).column(1).nodes().to$().addClass('text-center');
                                    tableListadoCompra.row(row).column(2).nodes().to$().addClass('text-center');
                                    tableListadoCompra.row(row).column(3).nodes().to$().addClass('text-center');
                                    tableListadoCompra.row(row).column(4).nodes().to$().addClass('text-right');
                                    tableListadoCompra.row(row).column(5).nodes().to$().addClass('text-right');
                                    tableListadoCompra.row(row).column(6).nodes().to$().addClass('text-right');
                                    tableListadoCompra.row(row).column(7).nodes().to$().addClass('text-right');
                                    tableListadoCompra.row(row).column(8).nodes().to$().addClass('text-right');
                                    tableListadoCompra.row(row).column(9).nodes().to$().addClass('text-center');
                                    calculoCompra(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                                } else {
                                    $("#modal-cargando").modal("hide");
                                    document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                    $("#popUpErrorMsg").modal("show");
                                }
                                $("#modal-cargando").modal("hide");
                            } else {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            }
                        })
                        .fail(function(data) {
                            $("#modal-cargando").modal("hide");
                            $("#modal-exitoso").modal("hide");
                            $("#popUpError").modal("show");
                        });
                }
            } else {
                swal(
                    'Error',
                    "Debe primero seleccionar un proveedor",
                    'error'
                )
            }
        });
    })
    $("#selectProductosCompras_formModificarCompra").change(function() {
            $("#selectProductosCompras_formModificarCompra option:selected").each(function() {
                $("#modal-cargando").modal("show");
                var idProducto = $('#selectProductosCompras_formModificarCompra').val();
                var idProveedor = $('#selectProveedor_formModificarCompra').val();
                if (idProveedor != 0) {
                    if (idProducto == "addProductoNewCompra_formModificarCompra") {
                        addProductoNewCompraEditar();
                    } else {
                        $.ajax({
                                url: URL + 'productos/get_producto/',
                                type: 'POST',
                                data: { idProducto: idProducto }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                //                //console.log(dato);

                                if (dato['valid']) {
                                    //--- AGREGO FILA ---//
                                    $("#errorStockProducto").css("display", "none");
                                    tableListadoCompra = $('#listadoCompra_formModificarCompra').DataTable();
                                    var iva_tipos_option;
                                    if (dato['iva_tipos']) {
                                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                            if (dato['ivaDefecto'] == dato['iva_tipos'][i]['idIva']) {
                                                iva_tipos_option += '<option selected="selected" value="' + dato['iva_tipos'][i]['idIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                            } else {
                                                iva_tipos_option += '<option value="' + dato['iva_tipos'][i]['idIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                            }
                                        }
                                    }

                                    var info = tableListadoCompra.page.info();
                                    var count = info.recordsTotal;
                                    var tabla = tableListadoCompra.data();
                                    var p = 0;
                                    for (var i = 0; i < count; i++) {
                                        if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                            p++;
                                        }
                                    }
                                    if (p == 0) {
                                        var row = tableListadoCompra.row.add([
                                            dato['producto'][0]['idProducto'],
                                            dato['producto'][0]['codigo'],
                                            dato['producto'][0]['nombre'],
                                            '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoCompraEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                            '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                            'Stock: ' + dato['producto'][0]['stock'] +
                                            '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                            dato['producto'][0]['stock'],
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">%</span>' +
                                            '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoCompraEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                            '</div>',
                                            '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoCompraEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                            '<option value="0">IVA</option>' +
                                            iva_tipos_option +
                                            '</select>',
                                            '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaCompraEditar(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                                            '&nbsp;',
                                        ]).draw(false);
                                        row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                        tableListadoCompra.row(row).column(0).nodes().to$().addClass('text-center hide-column');
                                        tableListadoCompra.row(row).column(1).nodes().to$().addClass('text-center');
                                        tableListadoCompra.row(row).column(2).nodes().to$().addClass('text-center');
                                        tableListadoCompra.row(row).column(3).nodes().to$().addClass('text-center');
                                        tableListadoCompra.row(row).column(4).nodes().to$().addClass('text-right');
                                        tableListadoCompra.row(row).column(5).nodes().to$().addClass('text-right');
                                        tableListadoCompra.row(row).column(6).nodes().to$().addClass('text-right');
                                        tableListadoCompra.row(row).column(7).nodes().to$().addClass('text-right');
                                        tableListadoCompra.row(row).column(8).nodes().to$().addClass('text-right');
                                        tableListadoCompra.row(row).column(9).nodes().to$().addClass('text-center');
                                        calculoCompraEditar(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                                    } else {
                                        $("#modal-cargando").modal("hide");
                                        document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                        $("#popUpErrorMsg").modal("show");
                                    }
                                    $("#modal-cargando").modal("hide");
                                } else {
                                    $("#modal-cargando").modal("hide");
                                    $("#modal-exitoso").modal("hide");
                                    $("#popUpError").modal("show");
                                }
                            })
                            .fail(function(data) {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            });
                    }
                } else {
                    swal(
                        'Error',
                        "Debe primero seleccionar un proveedor",
                        'error'
                    )
                }
            });
        })
        //DETECTAR MOVIMIENTOS EN LA TABLA
        //var table = $('#example').DataTable(); YA ESTA MAS ARRIBA DEFINIDA

    $("#selectPais_formConfiguracionSistema").change(function() {
        $("#modal-cargando").modal("show");
        $("#selectPais_formConfiguracionSistema option:selected").each(function() {
            idPais = $('#selectPais_formConfiguracionSistema').val();
            $("#modal-cargando").modal("hide");
            if (idPais == 13) {
                //--- Campos localidad ---//
                $("#paisArgentina").css("display", "block");
                $("#paisNoArgentina").css("display", "none");
                //--- Campos de AFIP para argentinos ---//
                $("#inputCuit_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                $("#inputIibb_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                $("#selectTipoAnteAfip_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                $("#inputPuntoVenta_formConfiguracionSistema").removeAttr('disabled', 'disabled');

                $("#inputToken_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                $("#inputRazonSocial_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                //$("#selectCondicionFacturacion_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                $("#inputCertificado_formConfiguracionSistema").removeAttr('disabled', 'disabled');
                $("#selectFacturaElectronica_formConfiguracionSistema").removeAttr('disabled', 'disabled');
            } else {
                //--- Campos localidad ---//
                $("#paisNoArgentina").css("display", "block");
                $("#paisArgentina").css("display", "none");
                //--- Campos de AFIP para argentinos ---//
                $("#inputCuit_formConfiguracionSistema").attr('disabled', 'disabled');
                $("#inputIibb_formConfiguracionSistema").attr('disabled', 'disabled');
                $("#selectTipoAnteAfip_formConfiguracionSistema").attr('disabled', 'disabled');
                $("#inputPuntoVenta_formConfiguracionSistema").attr('disabled', 'disabled');

                $("#inputToken_formConfiguracionSistema").attr('disabled', 'disabled');
                $("#inputRazonSocial_formConfiguracionSistema").attr('disabled', 'disabled');
                //$("#selectCondicionFacturacion_formConfiguracionSistema").attr('disabled', 'disabled');
                $("#inputCertificado_formConfiguracionSistema").attr('disabled', 'disabled');
                $("#selectFacturaElectronica_formConfiguracionSistema").attr('disabled', 'disabled');

                $('#selectFacturaElectronica_formConfiguracionSistema').val(1).trigger('change');
            }
        });
    })
});

function mostrarCampoLocalidad() {
    $("#modal-cargando").modal("show");
    $("#selectPais_formConfiguracionSistema option:selected").each(function() {
        idPais = $('#selectPais_formConfiguracionSistema').val();
        $("#modal-cargando").modal("hide");
        if (idPais == 13) {
            $("#paisArgentina").css("display", "block");
            $("#paisNoArgentina").css("display", "none");
        } else if (idPais == 0) {
            $("#paisNoArgentina").css("display", "none");
            $("#paisArgentina").css("display", "none");
        } else {
            $("#paisNoArgentina").css("display", "block");
            $("#paisArgentina").css("display", "none");
        }
    });
}

function mostrarCamposFacturacionSegunFacturacion() {
    idPais = $('#selectPais_formConfiguracionSistema').val();

    if (idPais == 13) {
        //--- Campos localidad ---//
        $("#paisArgentina").css("display", "block");
        $("#paisNoArgentina").css("display", "none");
        //--- Campos de AFIP para argentinos ---//
        $("#inputCuit_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#inputIibb_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#selectTipoAnteAfip_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#inputPuntoVenta_formConfiguracionSistema").removeAttr('disabled', 'disabled');

        $("#inputToken_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#inputRazonSocial_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        //$("#selectCondicionFacturacion_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#inputCertificado_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#selectFacturaElectronica_formConfiguracionSistema").removeAttr('disabled', 'disabled');
    } else {
        //--- Campos localidad ---//
        $("#paisNoArgentina").css("display", "block");
        $("#paisArgentina").css("display", "none");
        //--- Campos de AFIP para argentinos ---//
        $("#inputCuit_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#inputIibb_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#selectTipoAnteAfip_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#inputPuntoVenta_formConfiguracionSistema").attr('disabled', 'disabled');

        $("#inputToken_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#inputRazonSocial_formConfiguracionSistema").attr('disabled', 'disabled');
        //$("#selectCondicionFacturacion_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#inputCertificado_formConfiguracionSistema").attr('disabled', 'disabled');

        $('#selectFacturaElectronica_formConfiguracionSistema').val(1).trigger('change');

        $("#selectFacturaElectronica_formConfiguracionSistema").attr('disabled', 'disabled');
    }
}

function deleteRowListaVenta(id) {
    tableListadoVenta = $('#listadoVenta').DataTable();
    tableListadoVenta.row('#' + id).remove().draw();
    totalVenta();
}

function deleteRowListaNotaCredito(id) {
    var deleteRowListaNotaCredito = $('#listadoDetalleNotaCredito').DataTable();
    deleteRowListaNotaCredito.row('#' + id).remove().draw();
    totalDetalleNotaCredito();
}

function deleteRowListaNotaCreditoProveedor(id) {
    var deleteRowListaNotaCreditoProveedor = $('#listadoDetalleNotaCreditoProveedor').DataTable();
    deleteRowListaNotaCreditoProveedor.row('#' + id).remove().draw();
    totalDetalleNotaCreditoProveedor();
}

function deleteRowListaNotaCreditoModificarProveedor(id) {
    var deleteRowListaNotaCreditoModificarProveedor = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
    deleteRowListaNotaCreditoModificarProveedor.row('#' + id).remove().draw();
    totalDetalleNotaCreditoModificarProveedor();
}

function deleteRowListaNotaCreditoModificar(id) {
    var deleteRowListaNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificar').DataTable();
    deleteRowListaNotaCreditoModificar.row('#' + id).remove().draw();
    totalDetalleNotaCreditoModificar();
}

function deleteRowListaNotaDebito(id) {
    var deleteRowListaNotaDebito = $('#listadoDetalleNotaDebito').DataTable();
    deleteRowListaNotaDebito.row('#' + id).remove().draw();
    totalDetalleNotaDebito();
}

function deleteRowListaNotaDebitoProveedor(id) {
    var deleteRowListaNotaDebitoProveedor = $('#listadoDetalleNotaDebitoProveedor').DataTable();
    deleteRowListaNotaDebitoProveedor.row('#' + id).remove().draw();
    totalDetalleNotaDebitoProveedor();
}

function deleteRowListaNotaDebitoModificarProveedor(id) {
    var deleteRowListaNotaDebitoModificarProveedor = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
    deleteRowListaNotaDebitoModificarProveedor.row('#' + id).remove().draw();
    totalDetalleNotaDebitoModificarProveedor();
}

function deleteRowListaNotaDebitoModificar(id) {
    var deleteRowListaNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificar').DataTable();
    deleteRowListaNotaDebitoModificar.row('#' + id).remove().draw();
    totalDetalleNotaDebitoModificar();
}

function deleteRowListaVentaEditar(id) {
    tableListadoVentaEditar = $('#listadoVentaEditar').DataTable();
    tableListadoVentaEditar.row('#' + id).remove().draw();
    totalVentaEditar();
}

function deleteRowListaCompra(id) {
    tableListadoCompra.row('#' + id).remove().draw();
    totalCompra();
}

function deleteRowListaPresupuesto(id) {
    $('#listadoPresupuesto_formNuevoPresupuesto').DataTable().row('#' + id).remove().draw();
    totalPresupuesto();
}

function deleteRowListaAbonoEditar(id) {
    var tableListadoAbonoEditar = $('#listadoAbonoEditar').DataTable().data();
    tableListadoAbonoEditar.row('#' + id).remove().draw();
    totalAbonoEditar();
}

function deleteRowListaPresupuestoDetalle(idProducto) {
    $('#listadoPresupuesto_formModificarPresupuesto').DataTable().row('#' + idProducto).remove().draw();
    totalPresupuestoDetalle();
}

function deleteRowListaCompraEditar(idProducto) {
    $('#listadoCompra_formModificarCompra').DataTable().row('#' + idProducto).remove().draw();
    totalCompraEditar();
}

function calculoDetalleNotaCredito(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaCredito();
}

function calculoDetalleNotaCreditoProveedor(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaCreditoProveedor();
}

function calculoDetalleNotaCreditoModificarProveedor(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaCreditoModificarProveedor();
}

function calculoDetalleNotaCreditoModificar(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    
    //    //console.log(cantidadProducto);
    //    //console.log(stock);

    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaCreditoModificar();
}

function calculoDetalleNotaDebitoModificar(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    
    //    //console.log(cantidadProducto);
    //    //console.log(stock);

    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaDebitoModificar();
}

function calculoDetalleNotaDebito(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaDebito();
}

function calculoDetalleNotaDebitoProveedor(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaDebitoProveedor();
}

function calculoDetalleNotaDebitoModificarProveedor(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
    totalDetalleNotaDebitoModificarProveedor();
}

function calculoVenta(idInput, stock, controlStock) {
    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    
    //console.log(cantidadProducto);
    //console.log(stock);
    if (controlStock == 0) {
        if (parseInt(cantidadProducto) > parseInt(stock)) {
            $("#errorStock" + idInput).css("display", "block");
            //console.log("Entre");
        } else {
            $("#errorStock" + idInput).css("display", "none");
            document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
            totalVenta();
        }
    } else {
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalVenta();
    }
}

function calculoVentaEditar(idInput, stock, cantidadAnterior, controlStock) {
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    

    if (controlStock == 0) {
        if ((cantidadProducto - cantidadAnterior) > stock) {
            $("#errorStock" + idInput).css("display", "block");
        } else {
            $("#errorStock" + idInput).css("display", "none");
            document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
            totalVentaEditar();
        }
    } else {
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalVentaEditar();
    }
}

function calculoCompra(idInput, stock, controlStock) {
    $.ajax({
            url: URL + 'productos/get_producto/',
            type: 'POST',
            cache: false,
            data: {
                idProducto: idInput
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                var precioProd = $('#precioProd' + idInput).val();
                var acepto_menor = false;
                if (precioProd < dato['producto'][0]['precioVenta']) {
                    swal({
                        title: 'Precio menor al anterior',
                        text: 'Se ingreso un valor mejor al precio anterior, ¿ Desea modificarlo igualmente ?',
                        width: '350px',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        showLoaderOnConfirm: true,
                        preConfirm: (login) => {
                            acepto_menor = true;
                            var descProd = $('#descProd' + idInput).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var cantidadProducto = $('#cantProd' + idInput).val();
                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
                            if (controlStock == 0) {
                                if (cantidadProducto > stock) {
                                    $("#errorStock" + idInput).css("display", "block");
                                } else {
                                    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
                                    totalCompra();
                                }
                            } else {
                                document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
                                totalCompra();
                            }
                        },
                        onClose: (login) => {
                            if (!acepto_menor) {
                                document.getElementById('precioProd' + idInput).value = dato['producto'][0]['precioVenta'];
                                precioProd = dato['producto'][0]['precioVenta'];
                                var descProd = $('#descProd' + idInput).val();
                                var descProd = parseFloat(descProd) / parseFloat(100);
                                var cantidadProducto = $('#cantProd' + idInput).val();
                                //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                                var subtotalProducto = cantidadProducto * precioProd;
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
                                if (controlStock == 0) {
                                    if (cantidadProducto > stock) {
                                        $("#errorStock" + idInput).css("display", "block");
                                    } else {
                                        $("#errorStock" + idInput).css("display", "none");
                                        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
                                        totalCompra();
                                    }
                                } else {
                                    document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
                                    totalCompra();
                                }
                            }
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    })
                } else {
                    //                        acepto_menor = true;
                    var descProd = $('#descProd' + idInput).val();
                    var descProd = parseFloat(descProd) / parseFloat(100);
                    var cantidadProducto = $('#cantProd' + idInput).val();
                    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                    var subtotalProducto = cantidadProducto * precioProd;
                    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
                    if (controlStock == 0) {
                        if (cantidadProducto > stock) {
                            $("#errorStock" + idInput).css("display", "block");
                        } else {
                            $("#errorStock" + idInput).css("display", "none");
                            document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
                            totalCompra();
                        }
                    } else {
                        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
                        totalCompra();
                    }
                }

                //                    if (!acepto_menor) {
                //                        precioProd = dato['producto'][0]['precioVenta'];
                //                    }
                //                    //console.log(precioProd);

            } else {}
        })
        .fail(function(data) {});
}

function calculoPresupuesto(idInput, stock) {
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    if (cantidadProducto > stock) {
        $("#errorStock" + idInput).css("display", "block");
    } else {
        $("#errorStock" + idInput).css("display", "none");
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalPresupuesto();
    }
}

function calculoAbonoEditar(idInput, stock, cantidadAnterior, controlStock) {
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    if (controlStock == 0) {
        if ((cantidadProducto - cantidadAnterior) > stock) {
            $("#errorStock" + idInput).css("display", "block");
        } else {
            $("#errorStock" + idInput).css("display", "none");
            document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
            totalAbonoEditar();
        }
    } else {
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalAbonoEditar();
    }
}

function calculoPresupuestoDetalle(idInput, stock, cantidadAnterior) {

    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    

    if ((cantidadProducto - cantidadAnterior) > stock) {
        $("#errorStock" + idInput).css("display", "block");
    } else {
        $("#errorStock" + idInput).css("display", "none");
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalPresupuestoDetalle();
    }
}

function calculoCompraEditar(idInput, stock, cantidadAnterior, controlStock) {
    //    //console.log(idInput);
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    

    if (controlStock == 0) {
        if ((cantidadProducto - cantidadAnterior) > stock) {
            $("#errorStock" + idInput).css("display", "block");
        } else {
            $("#errorStock" + idInput).css("display", "none");
            document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
            totalCompraEditar();
        }
    } else {
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalCompraEditar();
    }
}

function totalDetalleNotaCredito() {

    var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaCredito').DataTable();
    //Totales
    var info = tableListadoDetalleNotaCredito.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Credito no definida');
    } else {
        //console.log('Tabla Detalle Nota Credito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaCredito.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formNuevaNotaCredito').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formNuevaNotaCredito').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formNuevaNotaCredito').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaCreditoProveedor() {

    var tableListadoDetalleNotaCreditoProveedor = $('#listadoDetalleNotaCreditoProveedor').DataTable();
    //Totales
    var info = tableListadoDetalleNotaCreditoProveedor.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Credito no definida');
    } else {
        //console.log('Tabla Detalle Nota Credito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaCreditoProveedor.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formNuevaNotaCreditoProveedor').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formNuevaNotaCreditoProveedor').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formNuevaNotaCreditoProveedor').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaCreditoModificarProveedor() {

    var tableListadoDetalleNotaCreditoModificarProveedor = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
    //Totales
    var info = tableListadoDetalleNotaCreditoModificarProveedor.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Credito no definida');
    } else {
        //console.log('Tabla Detalle Nota Credito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaCreditoModificarProveedor.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formModificarNotaCreditoProveedor').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formModificarNotaCreditoProveedor').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formModificarNotaCreditoProveedor').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaDebitoModificar() {

    var tableListadoDetalleNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificar').DataTable();
    //Totales
    var info = tableListadoDetalleNotaDebitoModificar.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Debito no definida');
    } else {
        //console.log('Tabla Detalle Nota Debito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaDebitoModificar.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formModificarNotaDebito').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formModificarNotaDebito').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formModificarNotaDebito').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaCreditoModificar() {

    var tableListadoDetalleNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificar').DataTable();
    //Totales
    var info = tableListadoDetalleNotaCreditoModificar.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Debito no definida');
    } else {
        //console.log('Tabla Detalle Nota Debito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaCreditoModificar.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formModificarNotaCredito').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formModificarNotaCredito').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formModificarNotaCredito').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaDebito() {

    var tableListadoDetalleNotaDebito = $('#listadoDetalleNotaDebito').DataTable();
    //Totales
    var info = tableListadoDetalleNotaDebito.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Debito no definida');
    } else {
        //console.log('Tabla Detalle Nota Debito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaDebito.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formNuevaNotaDebito').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formNuevaNotaDebito').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formNuevaNotaDebito').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaDebitoProveedor() {

    var tableListadoDetalleNotaDebitoProveedor = $('#listadoDetalleNotaDebitoProveedor').DataTable();
    //Totales
    var info = tableListadoDetalleNotaDebitoProveedor.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Debito no definida');
    } else {
        //console.log('Tabla Detalle Nota Debito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaDebitoProveedor.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formNuevaNotaDebitoProveedor').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formNuevaNotaDebitoProveedor').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formNuevaNotaDebitoProveedor').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalDetalleNotaDebitoModificarProveedor() {

    var tableListadoDetalleNotaDebitoModificarProveedor = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
    //Totales
    var info = tableListadoDetalleNotaDebitoModificarProveedor.page.info();
    if (info == null) {
        //console.log('Tabla Detalle Nota Debito no definida');
    } else {
        //console.log('Tabla Detalle Nota Debito definida');
        var count = info.recordsTotal;
        var tabla = tableListadoDetalleNotaDebitoModificarProveedor.data();
        var total = 0;
        var totalNoGravado = 0;
        var totalIva = 0;
        var descTotal = 0;
        for (var i = 0; i < count; i++) {
            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

            var descProd = $('#descProd' + tabla[i][0]).val();
            var descProd = parseFloat(descProd) / parseFloat(100);
            var precioProd = $('#precioProd' + tabla[i][0]).val();
            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
            //             //console.log("descProd: "+descProd);
            //             //console.log("precioProd: "+precioProd);
            //             //console.log("cantidadProducto: "+cantidadProducto);

            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
            var subtotalProducto = cantidadProducto * precioProd;
            //            //console.log("subtotalProducto1: "+subtotalProducto);

            if (descProd != 0) {
                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                //console.log("subtotalProducto2: " + subtotalProducto);
            }

            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
            total = parseFloat(total) + parseFloat(subtotalProducto);
            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
            totalIva = parseFloat(totalIva) + parseFloat(iva);
        }
        document.getElementById('importeNoGravado_formModificarNotaDebitoProveedor').value = parseFloat(totalNoGravado).toFixed(2);
        document.getElementById('totalVenta_formModificarNotaDebitoProveedor').value = parseFloat(total).toFixed(2);
        document.getElementById('descEfectuado_formModificarNotaDebitoProveedor').value = parseFloat(descTotal).toFixed(2);
    }
}

function totalVenta() {
    var idCliente = $('#selectCliente').val();
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    var tableListadoVenta = $('#listadoVenta').DataTable();
                    //Totales
                    var info = tableListadoVenta.page.info();
                    if (info == null) {
                        //console.log('Tabla VENTAS no definida');
                    } else {
                        //console.log('Tabla VENTAS definida');
                        var count = info.recordsTotal;
                        var tabla = tableListadoVenta.data();
                        var total = 0;
                        var totalNoGravado = 0;
                        var totalIva = 0;
                        var descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //                          var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //                          var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //                              //console.log("descProd: "+descProd);
                            //                              //console.log("precioProd: "+precioProd);
                            //                              //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //                              //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            var totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = total * (dato['descuento'] / 100);
                        document.getElementById('descuentoCliente').value = parseFloat(descuentoCliente).toFixed(2);
                        var descuentoTotal = descuentoCliente + descTotal;
                        document.getElementById('descuentoTotal').value = parseFloat(descuentoTotal).toFixed(2);
                        //--- Totales ---//
                        document.getElementById('importeNoGravado').value = parseFloat(totalNoGravado - descuentoCliente).toFixed(2);
                        document.getElementById('totalVenta').value = parseFloat(total).toFixed(2);
                    }

                }
            });
    }
}

function totalVentaDescuentoCliente() {
    var descEfectuado = $('#descEfectuado').val();
    var descProveedor = $('#descuentoCliente').val();
    var totalCompra = $('#totalVenta').val();
    document.getElementById('descuentoTotal').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalVentaEditarDescuentoCliente() {
    var descEfectuado = $('#descEfectuado').val();
    var descProveedor = $('#descuentoCliente').val();
    var totalCompra = $('#totalVenta').val();
    document.getElementById('descuentoTotal').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalVentaEditar() {
    var idCliente = $('#selectCliente').val();
    //console.log("idCliente " + idCliente)
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    tableListadoVentaEditar = $('#listadoVentaEditar').DataTable();
                    var info = tableListadoVentaEditar.page.info();
                    if (info == null) {
                        //console.log('Tabla VENTAS Detalle no definida');
                    } else {
                        //console.log('Tabla VENTAS Detalle definida');
                        var count = info.recordsTotal;
                        var tabla = tableListadoVentaEditar.data();
                        var total = 0;
                        var totalNoGravado = 0;
                        var totalIva = 0;
                        var descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //                          var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //                          var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //                              //console.log("descProd: "+descProd);
                            //                              //console.log("precioProd: "+precioProd);
                            //                              //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //                              //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = $('#descuentoCliente').val();
                        var descuentoTotal = parseFloat(descuentoCliente) + descTotal;
                        document.getElementById('descuentoTotal').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado').value = (parseFloat(totalNoGravado) - parseFloat(descuentoCliente)).toFixed(2);
                        document.getElementById('totalVenta').value = parseFloat(total).toFixed(2);
                        document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2);
                    }
                }
            });
    }
}

function totalCompra() {
    var idProveedor = $('#selectProveedor').val();
    //console.log("idProveedor " + idProveedor)
    if (idProveedor) {
        $.ajax({
                url: URL + 'compras/get_proveedor/' + idProveedor,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    var info = tableListadoCompra.page.info();
                    if (info == null) {
                        //console.log('Tabla Compras no definida');
                    } else {
                        //console.log('Tabla Compras definida');
                        var count = info.recordsTotal;
                        var tabla = tableListadoCompra.data();
                        var total = 0;
                        var totalNoGravado = 0;
                        var totalIva = 0;
                        var descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //                              var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //                              var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //                              //console.log("descProd: "+descProd);
                            //                              //console.log("precioProd: "+precioProd);
                            //                              //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //                              //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        document.getElementById('importeNoGravado').value = parseFloat(totalNoGravado).toFixed(2);
                        document.getElementById('totalCompra').value = parseFloat(total).toFixed(2);
                        document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2);

                        //--- Descuentos ---//
                        document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2);
                        var descuentoProveedor = total * (dato['descuento'] / 100);
                        document.getElementById('descuentoProveedor').value = parseFloat(descuentoProveedor).toFixed(2);
                        var descuentoTotal = descuentoProveedor + descTotal;
                        document.getElementById('descuentoTotal').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado').value = parseFloat(totalNoGravado - descuentoProveedor).toFixed(2);

                    }
                }
            });
    }
}

function totalCompraDescuentoProveedor() {
    var descEfectuado = $('#descEfectuado').val();
    var descProveedor = $('#descuentoProveedor').val();
    var totalCompra = $('#totalCompra').val();
    document.getElementById('descuentoTotal').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalCompraEditarDescuentoProveedor() {
    var descEfectuado = $('#descEfectuado_formModificarCompra').val();
    var descProveedor = $('#descuentoProveedor_formModificarCompra').val();
    var totalCompra = $('#totalCompra_formModificarCompra').val();
    document.getElementById('descuentoTotal_formModificarCompra').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado_formModificarCompra').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalCompraEditar() {
    var idProveedor = $('#selectProveedor_formModificarCompra').val();
    if (idProveedor) {
        $.ajax({
                url: URL + 'compras/get_proveedor/' + idProveedor,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    tableListadoCompraEditar = $('#listadoCompra_formModificarCompra').DataTable();
                    //Totales
                    var info = tableListadoCompraEditar.page.info();
                    if (info == null) {
                        //console.log('Tabla Compras editar no definida');
                    } else {
                        //console.log('Tabla Compras editar definida');
                        var count = info.recordsTotal;
                        var tabla = tableListadoCompraEditar.data();
                        total = 0;
                        totalNoGravado = 0;
                        totalIva = 0;
                        descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //                              var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //                              var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //                              //console.log("descProd: "+descProd);
                            //                              //console.log("precioProd: "+precioProd);
                            //                              //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //                              //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }

                        //--- Descuentos ---//
                        document.getElementById('descEfectuado_formModificarCompra').value = parseFloat(descTotal).toFixed(2);
                        var descuentoProveedor = $('#descuentoProveedor_formModificarCompra').val();
                        var descuentoTotal = parseFloat(descuentoProveedor) + descTotal;
                        document.getElementById('descuentoTotal_formModificarCompra').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado_formModificarCompra').value = (parseFloat(totalNoGravado) - parseFloat(descuentoProveedor)).toFixed(2);
                        document.getElementById('totalCompra_formModificarCompra').value = parseFloat(total).toFixed(2);

                    }
                }
            });
    }

}

function totalCompraVer() {
    var idProveedor = $('#selectProveedor_formModificarCompra').val();
    if (idProveedor) {
        $.ajax({
                url: URL + 'compras/get_proveedor/' + idProveedor,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    tableListadoCompraEditar = $('#listadoCompraVer').DataTable();
                    //Totales
                    var info = tableListadoCompraEditar.page.info();
                    if (info == null) {
                        //console.log('Tabla Compras editar no definida');
                    } else {
                        //console.log('Tabla Compras editar definida');
                        var count = info.recordsTotal;
                        var tabla = tableListadoCompraEditar.data();
                        total = 0;
                        totalNoGravado = 0;
                        totalIva = 0;
                        descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //                              var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //                              var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //                              //console.log("descProd: "+descProd);
                            //                              //console.log("precioProd: "+precioProd);
                            //                              //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //                              //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var total = parseFloat(total) + parseFloat(subtotalProducto) + (iva);;
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            //total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado_formModificarCompra').value = parseFloat(descTotal).toFixed(2);
                        var descuentoProveedor = $('#descuentoProveedor_formModificarCompra').val();
                        var descuentoTotal = parseFloat(descuentoProveedor) + descTotal;
                        document.getElementById('descuentoTotal_formModificarCompra').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado_formModificarCompra').value = (parseFloat(totalNoGravado) - parseFloat(descuentoProveedor)).toFixed(2);
                        //document.getElementById('totalCompra_formModificarCompra').value = parseFloat(total).toFixed(2);

                    }
                }
            });
    }

}

function totalPresupuesto() {
    var idCliente = $('#selectCliente_formNuevoPresupuesto').val();
    //console.log("idCliente " + idCliente)
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    var info = $('#listadoPresupuesto_formNuevoPresupuesto').DataTable().page.info();
                    if (info == null) {
                        //console.log('Tabla Presupuesto no definida');
                    } else {
                        //console.log('Tabla Presupuesto definida');
                        var count = info.recordsTotal;
                        var tabla = $('#listadoPresupuesto_formNuevoPresupuesto').DataTable().data();
                        var total = 0;
                        var totalNoGravado = 0;
                        var totalIva = 0;
                        var descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //             //console.log("descProd: "+descProd);
                            //             //console.log("precioProd: "+precioProd);
                            //             //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //            //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado_formNuevoPresupuesto').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = total * (dato['descuento'] / 100);
                        document.getElementById('descuentoCliente_formNuevoPresupuesto').value = parseFloat(descuentoCliente).toFixed(2);
                        var descuentoTotal = descuentoCliente + descTotal;
                        document.getElementById('descuentoTotal_formNuevoPresupuesto').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado_formNuevoPresupuesto').value = parseFloat(totalNoGravado - descuentoCliente).toFixed(2);
                        document.getElementById('totalVenta_formNuevoPresupuesto').value = parseFloat(total).toFixed(2);
                        document.getElementById('descEfectuado_formNuevoPresupuesto').value = parseFloat(descTotal).toFixed(2);
                    }

                }
            });
    }
}

function totalAbonoEditar() {
    var idCliente = $('#selectCliente_formEditarAbono').val();
    //console.log("idCliente " + idCliente)
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    var info = $('#listadoAbonoEditar').DataTable().page.info();
                    if (info == null) {
                        //console.log('Tabla ABONO EDITAR no definida');
                    } else {
                        //console.log('Tabla ABONO EDITAR definida');
                        var count = info.recordsTotal;
                        var tabla = $('#listadoAbonoEditar').DataTable().data();
                        var total = 0;
                        var totalNoGravado = 0;
                        var totalIva = 0;
                        var descTotal = 0;
                        var subtotalProducto = 0;
                        var subtotalProductoNoGravado = 0;
                        var iva = 0;
                        for (var i = 0; i < count; i++) {
                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //console.log("descProd: " + descProd);
                            //console.log("precioProd: " + precioProd);
                            //console.log("cantidadProducto: " + cantidadProducto);
                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado_formEditarAbono').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = $('#descuentoCliente_formEditarAbono').val();
                        var descuentoTotal = parseFloat(descuentoCliente) + descTotal;
                        document.getElementById('descuentoTotal_formEditarAbono').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado_formEditarAbono').value = (parseFloat(totalNoGravado) - parseFloat(descuentoCliente)).toFixed(2);
                        document.getElementById('totalVenta_formEditarAbono').value = parseFloat(total).toFixed(2);
                        document.getElementById('descEfectuado_formEditarAbono').value = parseFloat(descTotal).toFixed(2);
                    }
                }
            });
    }
}

function totalAbonoVer() {
    var idCliente = $('#selectCliente_formEditarAbono').val();
    //console.log("idCliente " + idCliente)
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    var info = $('#listadoAbonoVer').DataTable().page.info();
                    if (info == null) {
                        //console.log('Tabla ABONO EDITAR no definida');
                    } else {
                        //console.log('Tabla ABONO EDITAR definida');
                        var count = info.recordsTotal;
                        var tabla = $('#listadoAbonoVer').DataTable().data();
                        var total = 0;
                        var totalNoGravado = 0;
                        var totalIva = 0;
                        var descTotal = 0;
                        var subtotalProducto = 0;
                        var subtotalProductoNoGravado = 0;
                        var iva = 0;
                        for (var i = 0; i < count; i++) {
                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //console.log("descProd: " + descProd);
                            //console.log("precioProd: " + precioProd);
                            //console.log("cantidadProducto: " + cantidadProducto);
                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado_formEditarAbono').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = $('#descuentoCliente_formEditarAbono').val();
                        var descuentoTotal = parseFloat(descuentoCliente) + descTotal;
                        document.getElementById('descuentoTotal_formEditarAbono').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado_formEditarAbono').value = (parseFloat(totalNoGravado) - parseFloat(descuentoCliente)).toFixed(2);
                        document.getElementById('totalVenta_formEditarAbono').value = parseFloat(total).toFixed(2);
                        document.getElementById('descEfectuado_formEditarAbono').value = parseFloat(descTotal).toFixed(2);
                    }
                }
            });
    }
}

function totalAbonoDescuentoCliente() {
    var descEfectuado = $('#descEfectuado').val();
    var descProveedor = $('#descuentoCliente').val();
    var totalCompra = $('#totalVenta').val();
    document.getElementById('descuentoTotal').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalAbonoEditarDescuentoCliente() {
    var descEfectuado = $('#descEfectuado_formEditarAbono').val();
    var descProveedor = $('#descuentoCliente_formEditarAbono').val();
    var totalCompra = $('#totalVenta_formEditarAbono').val();
    document.getElementById('descuentoTotal_formEditarAbono').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado_formEditarAbono').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalPresupuestoDetalle() {
    var idCliente = $('#selectCliente_formModificarPresupuesto').val();
    //console.log("idCliente " + idCliente)
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    var info = $('#listadoPresupuesto_formModificarPresupuesto').DataTable().page.info();
                    if (info == null) {
                        //console.log('Tabla Presupuesto no definida');
                    } else {
                        //console.log('Tabla Presupuesto definida');
                        var count = info.recordsTotal;
                        var tabla = $('#listadoPresupuesto_formModificarPresupuesto').DataTable().data();
                        total = 0;
                        totalNoGravado = 0;
                        totalIva = 0;
                        descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //                              var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //                              var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //                              //console.log("descProd: "+descProd);
                            //                              //console.log("precioProd: "+precioProd);
                            //                              //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //                              //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado_formModificarPresupuesto').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = $('#descuentoCliente_formModificarPresupuesto').val();
                        var descuentoTotal = parseFloat(descuentoCliente) + descTotal;
                        document.getElementById('descuentoTotal_formModificarPresupuesto').value = parseFloat(descuentoTotal).toFixed(2);
                        document.getElementById('importeNoGravado_formModificarPresupuesto').value = (parseFloat(totalNoGravado) - parseFloat(descuentoCliente)).toFixed(2);
                        document.getElementById('totalVenta_formModificarPresupuesto').value = parseFloat(total).toFixed(2);
                        document.getElementById('descEfectuado_formModificarPresupuesto').value = parseFloat(descTotal).toFixed(2);
                    }
                }
            });
    }
}

function totalPresupuestoDescuentoCliente() {
    var descEfectuado = $('#descEfectuado_formNuevoPresupuesto').val();
    var descProveedor = $('#descuentoCliente_formNuevoPresupuesto').val();
    var totalCompra = $('#totalVenta_formNuevoPresupuesto').val();
    document.getElementById('descuentoTotal_formNuevoPresupuesto').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado_formNuevoPresupuesto').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function totalPresupuestoEditarDescuentoCliente() {
    var descEfectuado = $('#descEfectuado_formModificarPresupuesto').val();
    var descProveedor = $('#descuentoCliente_formModificarPresupuesto').val();
    var totalCompra = $('#totalVenta_formModificarPresupuesto').val();
    document.getElementById('descuentoTotal_formModificarPresupuesto').value = (parseFloat(descEfectuado) + parseFloat(descProveedor)).toFixed(2);
    document.getElementById('importeNoGravado_formModificarPresupuesto').value = (parseFloat(totalCompra) - (parseFloat(descEfectuado) + parseFloat(descProveedor))).toFixed(2);
}

function llenado_tabla_presupuesto_editar(idGenPresupuesto) {
    if (idGenPresupuesto) {
        setTimeout(function() {
            tableListadoPresupuesto_formModificarPresupuesto = $('#listadoPresupuesto_formModificarPresupuesto').DataTable();
            $("#listadoPresupuesto_formModificarPresupuesto").dataTable().fnDestroy();
            $('#listadoPresupuesto_formModificarPresupuesto').DataTable({
                "sAjaxSource": URL + "presupuesto/listar_presupuesto_detalle_table/" + idGenPresupuesto,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        totalPresupuestoDetalle();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
            });
        }, 1000);
    } else {
        //console.log("No hay id");
    }

}

function llenado_tabla_abono_editar(idGenAbono) {
    //console.log("entre al llenado");
    //console.log(idGenAbono);
    if (idGenAbono) {
        setTimeout(function() {
            tableListadoAbonoEditar = $('#listadoAbonoEditar').DataTable();
            $("#listadoAbonoEditar").dataTable().fnDestroy();
            $('#listadoAbonoEditar').DataTable({
                "sAjaxSource": URL + "abonos/listar_abonos_detalle_table/" + idGenAbono,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        totalAbonoEditar();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
            });
        }, 1000);
    } else {
        //console.log("No hay id");
    }

}

function llenado_tabla_abono_ver(idGenAbono) {
    if (idGenAbono) {
        setTimeout(function() {
            tableListadoAbonoVer = $('#listadoAbonoVer').DataTable();
            $("#listadoAbonoVer").dataTable().fnDestroy();
            $('#listadoAbonoVer').DataTable({
                "sAjaxSource": URL + "abonos/listar_abonos_ver_table/" + idGenAbono,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        totalAbonoVer();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
            });
        }, 1000);
    } else {
        //console.log("No hay id");
    }

}

function llenado_tabla_venta_editar(idGenIngreso) {
    //console.log("entre al llenado");
    //console.log(idGenIngreso);
    if (idGenIngreso) {
        $.ajax({
                url: URL + 'configuracion_sistema/get_empresa/',
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                empresa = dato['empresa'];
                var columnasDefecto;
                if (empresa[0]['stock'] == 0) {
                    columnasDefecto = {
                        "targets": [0],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                } else {
                    columnasDefecto = {
                        "targets": [0, 4],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                }
                setTimeout(function() {
                    tableListadoVentaEditar = $('#listadoVentaEditar').DataTable();
                    $("#listadoVentaEditar").dataTable().fnDestroy();
                    $('#listadoVentaEditar').DataTable({
                        "sAjaxSource": URL + "ventas/listar_venta_detalle_table/" + idGenIngreso,
                        "bSort": true,
                        "rowId": 'staffId',
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Todos"]
                        ],
                        "initComplete": function() {
                            setTimeout(function() {
                                totalVentaEditar();
                            }, 850);
                        },
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        },
                        "aoColumns": [
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' }
                        ],
                        "columnDefs": [
                            columnasDefecto
                        ]
                    });
                }, 1850)
            })
            .fail(function(data) {});
    } else {
        //console.log("No hay id");
    }
}

function llenado_tabla_compra_editar(idGenEgreso) {
    //console.log("entre al llenado");
    //console.log(idGenEgreso);
    if (idGenEgreso) {
        $.ajax({
                url: URL + 'configuracion_sistema/get_empresa/',
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                empresa = dato['empresa'];
                var columnasDefecto;
                if (empresa[0]['stock'] == 0) {
                    columnasDefecto = {
                        "targets": [0],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                } else {
                    columnasDefecto = {
                        "targets": [0, 4],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                }
                setTimeout(function() {
                    tableListadoCompra = $('#listadoCompra_formModificarCompra').DataTable();
                    $("#listadoCompra_formModificarCompra").dataTable().fnDestroy();
                    $('#listadoCompra_formModificarCompra').DataTable({
                        "sAjaxSource": URL + "compras/listar_egreso_detalle_table/" + idGenEgreso,
                        "bSort": true,
                        "rowId": 'staffId',
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Todos"]
                        ],
                        "initComplete": function() {
                            setTimeout(function() {
                                totalCompraEditar();
                            }, 850);
                        },
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        },
                        "aoColumns": [
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'center' }
                        ],
                        "columnDefs": [
                            columnasDefecto
                        ]
                    });
                }, 1850)
            })
            .fail(function(data) {});
    } else {
        //console.log("No hay id");
    }

}

function llenado_tabla_compra_ver(idGenEgreso) {
    if (idGenEgreso) {
        $.ajax({
                url: URL + 'configuracion_sistema/get_empresa/',
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                empresa = dato['empresa'];
                var columnasDefecto;
                if (empresa[0]['stock'] == 0) {
                    columnasDefecto = {
                        "targets": [0],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                } else {
                    columnasDefecto = {
                        "targets": [0, 4],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                }
                setTimeout(function() {
                    tableListadoCompra = $('#listadoCompraVer').DataTable();
                    $("#listadoCompraVer").dataTable().fnDestroy();
                    $('#listadoCompraVer').DataTable({
                        "sAjaxSource": URL + "compras/listar_egreso_ver_table/" + idGenEgreso,
                        "bSort": true,
                        "rowId": 'staffId',
                        "lengthMenu": [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Todos"]
                        ],
                        "initComplete": function() {
                            setTimeout(function() {
                                totalCompraVer();
                            }, 850);
                        },
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                        },
                        "aoColumns": [
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'center' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' },
                            { 'sClass': 'right' }
                        ],
                        "columnDefs": [
                            columnasDefecto
                        ]
                    });
                }, 1850)
            })
            .fail(function(data) {});
    } else {
        //console.log("No hay id");
    }

}

//--- VALIDAR IMAGEN ---//
function ValidarImagen(obj) {
    var uploadFile = obj.files[0];
    if (!window.FileReader) {
        alert('El navegador no soporta la lectura de archivos');
        return;
    }

    if (!(/\.(jpg|jpeg|png|gif)$/i).test(uploadFile.name)) {
        $("#errorFileFormato").css("display", "block");
        return false;
    } else {
        $("#errorFileFormato").css("display", "none");
        return true;
    }
}

//--- AGREGAR/MODIFICAR GENERAL ---//
$(document).ready(function() {
    $('#btnGral').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        document.getElementById("formDatos").submit();
    });
});
//--- RESET FORM CLIENTE ---//
function resetFormCliente() {
    document.getElementById("formDatosCliente").reset();
    document.getElementById('inputIdGenCliente_formCliente').value = null;
    $('#selectProvincia_formCliente').val(0).trigger('change');
    $('#selectLocalidad_formCliente').select2('data', { id: '0', text: 'Seleccione' });
    $('#selectCatVentas_formCliente').val(0).trigger('change');
    $('#selectTipoDoc_formCliente').val(0).trigger('change');
    $('#selectCondIva_formCliente').val(0).trigger('change');
    $('#selectCompTipo_formCliente').val(0).trigger('change');
    $('#selectProvinciaFac_formCliente').val(0).trigger('change');
    $('#selectLocalidadFac_formCliente').select2('data', { id: '0', text: 'Seleccione' });
}

//--- MODIFICAR CLIENTE ---//
$(function() {
    $("#listadoClientes").on("click", "a.edit_cliente", function(e) {
        e.preventDefault();
        var idGenCliente = $(this).data('id');
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'clientes/get_info_cliente/',
                type: 'POST',
                cache: false,
                data: {
                    id: idGenCliente
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    document.getElementById("formDatosCliente").reset();
                    document.getElementById('inputIdGenCliente_formCliente').value = null;

                    document.getElementById('inputIdGenCliente_formCliente').value = dato['cliente'][0]['idGenCliente'];

                    $('#selectProvincia_formCliente').val(0).trigger('change');
                    $('#selectLocalidad_formCliente').select2('data', { id: '0', text: 'Seleccione' });
                    $('#selectCatVentas_formCliente').val(0).trigger('change');
                    $('#selectTipoDoc_formCliente').val(0).trigger('change');
                    $('#selectCondIva_formCliente').val(0).trigger('change');
                    $('#selectCompTipo_formCliente').val(0).trigger('change');
                    $('#selectProvinciaFac_formCliente').val(0).trigger('change');
                    $('#selectLocalidadFac_formCliente').select2('data', { id: '0', text: 'Seleccione' });
                    $("#modal-nuevo-cliente").modal("show");
                    $("#optionSelects").css("display", "none");
                    $("#errorInputCliente_formCliente").css("display", "none");
                    $("#errorInputApellido_formCliente").css("display", "none");
                    $("#errorInputNombre_formCliente").css("display", "none");
                    $("#errorSelectProvincia_formCliente").css("display", "none");
                    $("#errorSelectLocalidad_formCliente").css("display", "none");
                    //--- CARGO DATOS ---//
                    $('#selectProvincia_formCliente').val(dato['cliente'][0]['idProvincia']).trigger('change');
                    $('#selectProvinciaFac_formCliente').val(dato['cliente'][0]['idProvinciaFacturacion']).trigger('change');
                    $('#selectCatVentas_formCliente').val(dato['cliente'][0]['idCategoriaVentas']).trigger('change');
                    $('#selectTipoDoc_formCliente').val(dato['cliente'][0]['idTipoDoc']).trigger('change');
                    $('#selectCondIva_formCliente').val(dato['cliente'][0]['idCondIva']).trigger('change');
                    $('#selectCompTipo_formCliente').val(dato['cliente'][0]['idComprobante']).trigger('change');
                    document.getElementById('inputCliente_formCliente').value = dato['cliente'][0]['nombEmpresa'];
                    document.getElementById('inputApodoML_formCliente').value = dato['cliente'][0]['apodoMl'];
                    document.getElementById('inputApellido_formCliente').value = dato['cliente'][0]['apellido'];
                    document.getElementById('inputNombre_formCliente').value = dato['cliente'][0]['nombre'];
                    document.getElementById('inputNumTel_formCliente').value = dato['cliente'][0]['tel'];
                    document.getElementById('inputNumCel_formCliente').value = dato['cliente'][0]['cel'];
                    document.getElementById('inputCorreo_formCliente').value = dato['cliente'][0]['email'];
                    document.getElementById('inputWeb_formCliente').value = dato['cliente'][0]['pagWeb'];
                    document.getElementById('inputCodPostal_formCliente').value = dato['cliente'][0]['cp'];
                    document.getElementById('inputDomicilio_formCliente').value = dato['cliente'][0]['domicilio'];
                    document.getElementById('inputNumDir_formCliente').value = dato['cliente'][0]['numero'];
                    document.getElementById('inputPiso_formCliente').value = dato['cliente'][0]['piso'];
                    document.getElementById('inputDpto_formCliente').value = dato['cliente'][0]['dpto'];
                    document.getElementById('inputNota_formCliente').value = dato['cliente'][0]['nota'];
                    document.getElementById('inputDtoGeneral_formCliente').value = dato['cliente'][0]['dtoGeneral'];
                    document.getElementById('inputNotaCliente_formCliente').value = dato['cliente'][0]['notaCliente'];
                    document.getElementById('inputRazonSocial_formCliente').value = dato['cliente'][0]['razonSocial'];
                    document.getElementById('inputNumTelFac_formCliente').value = dato['cliente'][0]['telFacturacion'];
                    document.getElementById('inputNumCelFac_formCliente').value = dato['cliente'][0]['celFacturacion'];
                    document.getElementById('inputNumDoc_formCliente').value = dato['cliente'][0]['cuit'];
                    document.getElementById('inputDomicilioFiscal_formCliente').value = dato['cliente'][0]['domicilioFacturacion'];
                    document.getElementById('selectCondIva_formCliente').value = dato['cliente'][0]['idCondIva'];
                    document.getElementById('inputCodPostalFac_formCliente').value = dato['cliente'][0]['cpFacturacion'];
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#modal-exitoso").modal("hide");
                $("#popUpError").modal("show");
            });
    })
})

//--- AGREGAR CLIENTE ---//
$(document).ready(function() {
    $('#btnAddCliente').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var inputIdGenCliente = $('#inputIdGenCliente_formCliente').val();
        var inputCliente = $('#inputCliente_formCliente').val();
        var inputApodoML = $('#inputApodoML_formCliente').val();
        var inputApellido = $('#inputApellido_formCliente').val();
        var inputNombre = $('#inputNombre_formCliente').val();
        var inputNumTel = $('#inputNumTel_formCliente').val();
        var inputNumCel = $('#inputNumCel_formCliente').val();
        var inputCorreo = $('#inputCorreo_formCliente').val();
        var inputWeb = $('#inputWeb_formCliente').val();
        var selectProvincia = $('#selectProvincia_formCliente').val();
        var selectLocalidad = $('#selectLocalidad_formCliente').val();
        var inputCodPostal = $('#inputCodPostal_formCliente').val();
        var inputDomicilio = $('#inputDomicilio_formCliente').val();
        var inputNumDir = $('#inputNumDir_formCliente').val();
        var inputPiso = $('#inputPiso_formCliente').val();
        var inputDpto = $('#inputDpto_formCliente').val();
        var inputNota = $('#inputNota_formCliente').val();
        var selectCatVentas = $('#selectCatVentas_formCliente').val();
        var inputDtoGeneral = $('#inputDtoGeneral_formCliente').val();
        var inputNotaCliente = $('#inputNotaCliente_formCliente').val();
        var inputRazonSocial = $('#inputRazonSocial_formCliente').val();
        var inputNumTelFac = $('#inputNumTelFac_formCliente').val();
        var inputNumCelFac = $('#inputNumCelFac_formCliente').val();
        var selectTipoDoc = $('#selectTipoDoc_formCliente').val();
        var inputNumDoc = $('#inputNumDoc_formCliente').val();
        var inputDomicilioFiscal = $('#inputDomicilioFiscal_formCliente').val();
        var selectCondIva = $('#selectCondIva_formCliente').val();
        var selectCompTipo = $('#selectCompTipo_formCliente').val();
        var selectProvinciaFac = $('#selectProvinciaFac_formCliente').val();
        var selectLocalidadFac = $('#selectLocalidadFac_formCliente').val();
        var inputCodPostalFac = $('#inputCodPostalFac_formCliente').val();
        var val1, val2, val3, val4, val5, val6, val7, val8, val9, val10;
        var val11, val12, val13, val14, val15, val16, val17, val18, val19, val20;
        var val21, val22, val23,
            val24, val25, val26, val27, val28, val29, val30;
        var PostCliente;
        //inputIdGenCliente
        if (inputIdGenCliente != null && inputIdGenCliente.length != 0) {
            PostCliente = 'clientes/update_cliente/';
        } else {
            PostCliente = 'clientes/set_cliente/';
        }

        //inputCliente
        if (inputCliente == null || inputCliente.length == 0 || /^\s+$/.test(inputCliente)) {
            $("#errorInputCliente_formCliente").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputCliente_formCliente").css("display", "none");
            val1 = true;
        }

        //        //inputApodoML
        //        if (inputApodoML == null || inputApodoML.length == 0 || /^\s+$/.test(inputApodoML)) {
        //            $("#errorInputApodoML_formCliente").css("display", "block");
        //            val2 = false;
        //        } else {
        //            $("#errorInputApodoML_formCliente").css("display", "none");
        //            val2 = true;
        //        }

        //inputNombre
        if (inputNombre == null || inputNombre.length == 0 || /^\s+$/.test(inputNombre)) {
            $("#errorInputNombre_formCliente").css("display", "block");
            val3 = false;
        } else {
            $("#errorInputNombre_formCliente").css("display", "none");
            val3 = true;
        }

        //        //inputNumTel
        //        if (inputNumTel == null || inputNumTel.length == 0 || isNaN(inputNumTel)) {
        //            $("#errorInputNumTel_formCliente").css("display", "block");
        //            val4 = false;
        //        } else {
        //            $("#errorInputNumTel_formCliente").css("display", "none");
        //            val4 = true;
        //        }
        //
        //        //inputNumCel
        //        if (inputNumCel == null || inputNumCel.length == 0 || isNaN(inputNumCel)) {
        //            $("#errorInputNumCel_formCliente").css("display", "block");
        //            val5 = false;
        //        } else {
        //            $("#errorInputNumCel_formCliente").css("display", "none");
        //            val5 = true;
        //        }

        //        //inputCorreo
        //        if (inputCorreo == null || inputCorreo.length == 0 || !(/\S+@\S+\.\S+/.test(inputCorreo))) {
        //            $("#errorInputCorreo_formCliente").css("display", "block");
        //            val6 = false;
        //        } else {
        //            $("#errorInputCorreo_formCliente").css("display", "none");
        //            val6 = true;
        //        }
        //
        //        //inputWeb
        //        if (inputWeb == null || inputWeb.length == 0 || /^\s+$/.test(inputWeb)) {
        //            $("#errorInputWeb_formCliente").css("display", "block");
        //            val7 = false;
        //        } else {
        //            $("#errorInputWeb_formCliente").css("display", "none");
        //            val7 = true;
        //        }
        //
        //selectProvincia
        if (selectProvincia == null || selectProvincia.length == 0 || selectProvincia == 0) {
            $("#errorSelectProvincia_formCliente").css("display", "block");
            val8 = false;
        } else {
            $("#errorSelectProvincia_formCliente").css("display", "none");
            val8 = true;
        }

        //selectLocalidad
        if (selectLocalidad == null || selectLocalidad.length == 0) {
            $("#errorSelectLocalidad_formCliente").css("display", "block");
            val9 = false;
        } else {
            $("#errorSelectLocalidad_formCliente").css("display", "none");
            val9 = true;
        }
        //
        //        //inputCodPostal
        //        if (inputCodPostal == null || inputCodPostal.length == 0 || /^\s+$/.test(inputCodPostal)) {
        //            $("#errorInputCodPostal_formCliente").css("display", "block");
        //            val10 = false;
        //        } else {
        //            $("#errorInputCodPostal_formCliente").css("display", "none");
        //            val10 = true;
        //        }
        //
        //        //inputDomicilio
        //        if (inputDomicilio == null || inputDomicilio.length == 0 || /^\s+$/.test(inputDomicilio)) {
        //            $("#errorInputDomicilio_formCliente").css("display", "block");
        //            val11 = false;
        //        } else {
        //            $("#errorInputDomicilio_formCliente").css("display", "none");
        //            val11 = true;
        //        }
        //
        //        //inputNumDir
        //        if (inputNumDir == null || inputNumDir.length == 0 || /^\s+$/.test(inputNumDir)) {
        //            $("#errorInputNumDir_formCliente").css("display", "block");
        //            val12 = false;
        //        } else {
        //            $("#errorInputNumDir_formCliente").css("display", "none");
        //            val12 = true;
        //        }
        //
        //        //inputPiso
        //        if (inputPiso == null || inputPiso.length == 0 || /^\s+$/.test(inputPiso)) {
        //            $("#errorInputPiso_formCliente").css("display", "block");
        //            val13 = false;
        //        } else {
        //            $("#errorInputPiso_formCliente").css("display", "none");
        //            val13 = true;
        //        }

        //        //inputDpto
        //        if (inputDpto == null || inputDpto.length == 0 || /^\s+$/.test(inputDpto)) {
        //            $("#errorInputDpto_formCliente").css("display", "block");
        //            val14 = false;
        //        } else {
        //            $("#errorInputDpto_formCliente").css("display", "none");
        //            val14 = true;
        //        }
        //
        //        //inputNota
        //        if (inputNota == null || inputNota.length == 0 || /^\s+$/.test(inputNota)) {
        //            $("#errorInputNota_formCliente").css("display", "block");
        //            val15 = false;
        //        } else {
        //            $("#errorInputNota_formCliente").css("display", "none");
        //            val15 = true;
        //        }
        //
        //        //selectCatVentas
        //        if (selectCatVentas == null || selectCatVentas.length == 0) {
        //            $("#errorSelectCatVentas_formCliente").css("display", "block");
        //            val16 = false;
        //        } else {
        //            $("#errorSelectCatVentas_formCliente").css("display", "none");
        //            val16 = true;
        //        }
        //
        //        //inputDtoGeneral
        //        if (inputDtoGeneral == null || inputDtoGeneral.length == 0 || /^\s+$/.test(inputDtoGeneral)) {
        //            $("#errorInputDtoGeneral_formCliente").css("display", "block");
        //            val17 = false;
        //        } else {
        //            $("#errorInputDtoGeneral_formCliente").css("display", "none");
        //            val17 = true;
        //        }
        //
        //        //inputNotaCliente
        //        if (inputNotaCliente == null || inputNotaCliente.length == 0 || /^\s+$/.test(inputNotaCliente)) {
        //            $("#errorInputNotaCliente_formCliente").css("display", "block");
        //            val18 = false;
        //        } else {
        //            $("#errorInputNotaCliente_formCliente").css("display", "none");
        //            val18 = true;
        //        }
        //
        //        //inputRazonSocial
        //        if (inputRazonSocial == null || inputRazonSocial.length == 0 || /^\s+$/.test(inputRazonSocial)) {
        //            $("#errorInputRazonSocial_formCliente").css("display", "block");
        //            val19 = false;
        //        } else {
        //            $("#errorInputRazonSocial_formCliente").css("display", "none");
        //            val19 = true;
        //        }
        //
        //        //inputNumTelFac
        //        if (inputNumTelFac == null || inputNumTelFac.length == 0 || isNaN(inputNumTelFac)) {
        //            $("#errorInputNumTelFac_formCliente").css("display", "block");
        //            val20 = false;
        //        } else {
        //            $("#errorInputNumTelFac_formCliente").css("display", "none");
        //            val20 = true;
        //        }
        //
        //        //inputNumCelFac
        //        if (inputNumCelFac == null || inputNumCelFac.length == 0 || isNaN(inputNumCelFac)) {
        //            $("#errorInputNumCelFac_formCliente").css("display", "block");
        //            val21 = false;
        //        } else {
        //            $("#errorInputNumCelFac_formCliente").css("display", "none");
        //            val21 = true;
        //        }
        //
        //        //selectTipoDoc
        //        if (selectTipoDoc == null || selectTipoDoc.length == 0) {
        //            $("#errorSelectTipoDoc_formCliente").css("display", "block");
        //            val22 = false;
        //        } else {
        //            $("#errorSelectTipoDoc_formCliente").css("display", "none");
        //            val22 = true;
        //        }
        //
        //        //inputNumDoc
        //        if (inputNumDoc == null || inputNumDoc.length == 0 || /^\s+$/.test(inputNumDoc)) {
        //            $("#errorInputNumDoc_formCliente").css("display", "block");
        //            val23 = false;
        //        } else {
        //            $("#errorInputNumDoc_formCliente").css("display", "none");
        //            val23 = true;
        //        }
        //
        //        //inputDomicilioFiscal
        //        if (inputDomicilioFiscal == null || inputDomicilioFiscal.length == 0 || /^\s+$/.test(inputDomicilioFiscal)) {
        //            $("#errorInputDomicilioFiscal_formCliente").css("display", "block");
        //            val24 = false;
        //        } else {
        //            $("#errorInputDomicilioFiscal_formCliente").css("display", "none");
        //            val24 = true;
        //        }
        //
        //        //selectCondIva
        //        if (selectCondIva == null || selectCondIva.length == 0) {
        //            $("#errorSelectCondIva_formCliente").css("display", "block");
        //            val25 = false;
        //        } else {
        //            $("#errorSelectCondIva_formCliente").css("display", "none");
        //            val25 = true;
        //        }
        //
        //        //selectCompTipo
        //        if (selectCompTipo == null || selectCompTipo.length == 0) {
        //            $("#errorSelectCompTipo_formCliente").css("display", "block");
        //            val26 = false;
        //        } else {
        //            $("#errorSelectCompTipo_formCliente").css("display", "none");
        //            val26 = true;
        //        }
        //
        //        //selectProvinciaFac
        //        if (selectProvinciaFac == null || selectProvinciaFac.length == 0) {
        //            $("#errorSelectProvinciaFac_formCliente").css("display", "block");
        //            val27 = false;
        //        } else {
        //            $("#errorSelectProvinciaFac_formCliente").css("display", "none");
        //            val27 = true;
        //        }
        //
        //        //selectLocalidadFac
        //        if (selectLocalidadFac == null || selectLocalidadFac.length == 0) {
        //            $("#errorSelectLocalidadFac_formCliente").css("display", "block");
        //            val28 = false;
        //        } else {
        //            $("#errorSelectLocalidadFac_formCliente").css("display", "none");
        //            val28 = true;
        //        }
        //
        //        //inputCodPostalFac
        //        if (inputCodPostalFac == null || inputCodPostalFac.length == 0 || /^\s+$/.test(inputCodPostalFac)) {
        //            $("#errorInputCodPostalFac_formCliente").css("display", "block");
        //            val29 = false;
        //        } else {
        //            $("#errorInputCodPostalFac_formCliente").css("display", "none");
        //            val29 = true;
        //        }

        //inputApellido
        if (inputApellido == null || inputApellido.length == 0 || /^\s+$/.test(inputApellido)) {
            $("#errorInputApellido_formCliente").css("display", "block");
            val30 = false;
        } else {
            $("#errorInputApellido_formCliente").css("display", "none");
            val30 = true;
        }

        //--- Validaciones de DNI y CUIT o CUIL ---//

        var longitud = inputNumDoc.length;

        if (selectTipoDoc == 6 || selectTipoDoc == 7) {
            if (longitud > 9 && longitud < 12) {
                if (inputNumDoc.length != 11) {
                    return false;
                }

                var acumulado = 0;
                var digitos = inputNumDoc.split("");
                var digito = digitos.pop();

                for (var i = 0; i < digitos.length; i++) {
                    acumulado += digitos[9 - i] * (2 + (i % 6));
                }

                var verif = 11 - (acumulado % 11);
                if (verif == 11) {
                    verif = 0;
                } else if (verif == 10) {
                    verif = 9;
                }

                if (digito == verif) {
                    $("#errorInputNumDoc_formCliente").css("display", "none");
                    val23 = true;
                } else {
                    $("#errorInputNumDoc_formCliente").css("display", "block");
                    val23 = false;
                }
            } else {
                $("#errorInputNumDoc_formCliente").css("display", "block");
                val23 = false;
            }
        } else if (selectTipoDoc == 8) {
            if (longitud > 6 && longitud < 9) {
                $("#errorInputNumDoc_formCliente").css("display", "none");
                val23 = true;
            } else {
                $("#errorInputNumDoc_formCliente").css("display", "block");
                val23 = false;
            }
        } else if (parseInt(selectTipoDoc) != 6 && parseInt(selectTipoDoc) != 7 && parseInt(selectTipoDoc) != 8) {
            val23 = true;
            $("#errorInputNumDoc_formCliente").css("display", "none");
        }



        //        if (
        //                val1 && val2  && val3 && val4 && val5 && val6 && val7 && val8 && val9 && val10 &&
        //                val11 && val12 && val13 && val14 && val15 && val16 && val17 && val18 && val19 && val20 &&
        //                val21 && val22 && val23 && val24 && val25 && val26 && val27 && val28 && val29 && val30
        //                ) {
        // //console.log(inputIdGenCliente);
        if (
            val1 && val3 && val8 && val9 && val30 && val23
        ) {
            var formData = new FormData($("#formDatosCliente")[0]);
            $.ajax({
                    url: URL + PostCliente,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-nuevo-cliente").modal("hide");
                        document.getElementById("formDatosCliente").reset();
                        document.getElementById('inputIdGenCliente_formCliente').value = null;
                        $('#selectProvincia_formCliente').val(0).trigger('change');
                        $('#selectLocalidad_formCliente').select2('data', { id: '0', text: 'Seleccione' });
                        $('#selectCatVentas_formCliente').val(0).trigger('change');
                        $('#selectTipoDoc_formCliente').val(0).trigger('change');
                        $('#selectCondIva_formCliente').val(0).trigger('change');
                        $('#selectCompTipo_formCliente').val(0).trigger('change');
                        $('#selectProvinciaFac_formCliente').val(0).trigger('change');
                        $('#selectLocalidadFac_formCliente').select2('data', { id: '0', text: 'Seleccione' });
                        ////console.log(inputIdGenCliente);

                        //--- AGREGO FILA ---//
                        var table = $('#listadoClientes').DataTable();
                        if (inputIdGenCliente != null && inputIdGenCliente.length != 0) {
                            $("#listadoClientes").dataTable().fnDeleteRow("#" + inputIdGenCliente);
                        }

                        var row = table.row.add([
                            dato['cliente'][0]['idCliente'],
                            dato['cliente'][0]['nombEmpresa'],
                            dato['cliente'][0]['nombre'],
                            dato['cliente'][0]['apellido'],
                            dato['cliente'][0]['email'],
                            dato['cliente'][0]['tel'],
                            dato['cliente'][0]['cel'],
                            dato['cliente'][0]['localidad'],
                            dato['cliente'][0]['provincia'],
                            '<a href="#modal-delete" class="tip delete_cliente" role="button" data-id="' + dato['cliente'][0]['idCliente'] + '" data-idGen="' + dato['cliente'][0]['idGenCliente'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;&nbsp;&nbsp;' +
                            '<a href="#" class="tip edit_cliente" data-id="' + dato['cliente'][0]['idGenCliente'] + '" data-original-title="Editar"><i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['cliente'][0]['idGenCliente']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(8).nodes().to$().addClass('text-center');
                        table.row(row).column(9).nodes().to$().addClass('text-center');
                        swal(
                            'Cliente',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#modal-nuevo-cliente").modal("hide");
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        }
    });
});
//--- BORRAR CLIENTE ---//
$(function() {
    $("#listadoClientes").on("click", "a.delete_cliente", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

        var id = $(this).data('id');
        var idGen = $(this).data('idgen');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'clientes/eliminar_cliente/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        idGen: idGen
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-delete").modal("hide");
                        $("#listadoClientes").dataTable().fnDeleteRow("#" + idGen);
                        swal(
                            'Cliente',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- BORRAR INGRESO ---//
$(function() {
    $("#listadoIngresos").on("click", "a.deleteIngreso", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'ventas/eliminar_venta/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                //console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#listadoIngresos").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Venta',
                            'Se borro la venta exitosamente',
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        swal(
                            'Venta',
                            'No se pudo borrar con exito, vuelva a intentarlo',
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
    $("#listadoEgresos").on("click", "a.deleteEgreso", function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        swal({
            type: 'question',
            text: '¿ Estás seguro que quieres eliminar la compra ?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(URL + 'compras/eliminar_compra/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                $("#modal-cargando").modal("hide");
                $("#listadoEgresos").dataTable().fnDeleteRow("#" + id);
                swal(
                    'Compra',
                    'Se borro la compra exitosamente',
                    'success'
                )
            }
        })
    });
    $("#listadoGastos").on("click", "a.deleteGasto", function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        swal({
            type: 'question',
            text: '¿ Estás seguro que quieres eliminar el gasto ?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(URL + 'gastos/eliminar_gasto/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                $("#modal-cargando").modal("hide");
                $("#listadoGastos").dataTable().fnDeleteRow("#" + id);
                swal(
                    'Gasto',
                    'Se borro el gasto exitosamente',
                    'success'
                )
            }
        })
    });
    $("#listadoAbonos").on("click", "a.deleteAbono", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'abonos/eliminar_abono/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                //console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#listadoAbonos").dataTable().fnDeleteRow("#" + id);
                        $("#eliminacion-exitosa").modal("show");
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
    /* $("#listadoIngresos").on("click", "a.agregarCobro", function(e) {
        e.preventDefault();
        var idGenIngreso = $(this).data('id');
        //console.log(idGenIngreso)

        if (idGenIngreso) {
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'ventas/get_monto_adeudado_by_idGenIngreso/',
                    type: 'POST',
                    cache: false,
                    data: {
                        idGenIngreso: idGenIngreso
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        document.getElementById('montoCobro').value = dato['adeudado'];
                        document.getElementById('montoAdeudado').value = dato['adeudado'];
                        document.getElementById('idGenIngresoCobro').value = idGenIngreso;
                        $('#selectSaldoAFavor').val(1).trigger('change');
                        if (parseFloat(dato['aFavor']) > 0) {
                            document.getElementById('saldoAFavor').value = dato['aFavor'];
                        } else {
                            document.getElementById('saldoAFavor').value = 0;
                        }
                        //--- Ocultamos los mensajes de error ---//
                        $("#errormontoCobro").css("display", "none");
                        $("#errorselectMedioCobro").css("display", "none");
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#popUpError").modal("show");
        }
    }); */
    $("#listadoGastos").on("click", "a.agregarCobroGasto", function(e) {
        e.preventDefault();
        var idGenGasto = $(this).data('id');

        if (idGenGasto) {
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'gastos/get_monto_adeudado/',
                    type: 'POST',
                    cache: false,
                    data: {
                        idGenGasto: idGenGasto
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        document.getElementById('montoCobro_formAgregarCobroGasto').value = dato['gasto_adeudado'];
                        document.getElementById('montoAdeudado_formAgregarCobroGasto').value = dato['gasto_adeudado'];
                        document.getElementById('idGenGasto').value = idGenGasto;
                        //--- Ocultamos los mensajes de error ---//
                        $("#errormontoCobro_formAgregarCobroGasto").css("display", "none");
                        $("#errorselectMedioCobro_formAgregarCobroGasto").css("display", "none");
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#popUpError").modal("show");
        }
    });
    $("#listadoEgresos").on("click", "a.agregarPago", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        document.getElementById('montoPagar').value = "";
        document.getElementById('montoAdeudadoPagar').value = "";
        $('#selectMedioPago').val(0).trigger('change');

        if (id) {
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'compras/get_monto_adeudado_by_idGenEgreso/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        document.getElementById('montoPagar').value = dato['adeudado'];
                        document.getElementById('montoAdeudadoPagar').value = dato['adeudado'];
                        document.getElementById('idGenEgresoPagar').value = id;
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#popUpError").modal("show");
        }
    });
});

function pausarAbono(idGenAbono) {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'abonos/pausar_abono/',
            type: 'POST',
            cache: false,
            data: {
                idGenAbono: idGenAbono
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var element = document.getElementById("btn" + idGenAbono);
                element.classList.remove("btn-success");
                element.classList.remove("btn-danger");
                element.classList.add("btn-info");
                element.innerText = "Pausado";
                $("#activar" + idGenAbono).css("display", "block");
                $("#pausar" + idGenAbono).css("display", "none");
                $("#terminar" + idGenAbono).css("display", "block");

                swal(
                    'Abono',
                    dato['msg'],
                    'success'
                )

            } else {
                $("#modal-cargando").modal("hide");

                swal(
                    'Abono',
                    dato['msg'],
                    'error'
                )

            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#eliminacion-exitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

function activarAbono(idGenAbono) {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'abonos/activar_abono/',
            type: 'POST',
            cache: false,
            data: {
                idGenAbono: idGenAbono
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var element = document.getElementById("btn" + idGenAbono);
                element.classList.remove("btn-info");
                element.classList.remove("btn-danger");
                element.classList.add("btn-success");
                element.innerText = "Activo";
                $("#activar" + idGenAbono).css("display", "none");
                $("#pausar" + idGenAbono).css("display", "block");
                $("#terminar" + idGenAbono).css("display", "block");

                swal(
                    'Abono',
                    dato['msg'],
                    'success'
                )

            } else {
                $("#modal-cargando").modal("hide");

                swal(
                    'Abono',
                    dato['msg'],
                    'error'
                )

            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#eliminacion-exitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

function terminarAbono(idGenAbono) {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'abonos/terminar_abono/',
            type: 'POST',
            cache: false,
            data: {
                idGenAbono: idGenAbono
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var element = document.getElementById("btn" + idGenAbono);
                element.classList.remove("btn-info");
                element.classList.remove("btn-success");
                element.classList.add("btn-danger");
                element.innerText = "Terminado";
                $("#activar" + idGenAbono).css("display", "block");
                $("#pausar" + idGenAbono).css("display", "none");
                $("#terminar" + idGenAbono).css("display", "none");

                swal(
                    'Abono',
                    dato['msg'],
                    'success'
                )

            } else {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");

                swal(
                    'Abono',
                    dato['msg'],
                    'error'
                )

            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#eliminacion-exitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- RESET FORM PROVEEDOR ---//
function resetFormProveedor() {
    document.getElementById("formDatosProveedor").reset();
    document.getElementById('inputIdGenProveedor_formProveedor').value = null;
    document.getElementById('inputCBU_formProveedor').value = null;
    $('#selectProvincia_formProveedor').val(0).trigger('change');
    $('#selectMedioPago_formProveedor').val(0).trigger('change');
    $('#selectLocalidad_formProveedor').select2('data', { id: '0', text: 'Seleccione' });
    $('#selectCatCompras_formProveedor').val(0).trigger('change');
    $('#selectTipoDoc_formProveedor').val(0).trigger('change');
    $('#selectCondIva_formProveedor').val(0).trigger('change');
    $('#selectCompTipo_formProveedor').val(0).trigger('change');
    $('#selectProvinciaFac_formProveedor').val(0).trigger('change');
    $('#selectLocalidadFac_formProveedor').select2('data', { id: '0', text: 'Seleccione' });
    $("#errorInputProveedor_formProveedor").css("display", "none");
    $("#errorInputApellido_formProveedor").css("display", "none");
    $("#errorInputNombre_formProveedor").css("display", "none");
    $("#errorSelectProvincia_formProveedor").css("display", "none");
    $("#errorSelectLocalidad_formProveedor").css("display", "none");
    $("#errorSelectMedioPago_formProveedor").css("display", "none");
    $("#errorInputCBU_formProveedor").css("display", "none");
}

//--- MODIFICAR PROVEEDOR ---//
$(function() {
    $("#listadoProveedores").on("click", "a.edit_proveedor", function(e) {
        resetFormProveedor();
        e.preventDefault();
        var idGenProveedor = $(this).data('id');
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'proveedores/get_info_proveedor/',
                type: 'POST',
                cache: false,
                data: {
                    id: idGenProveedor
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    document.getElementById("formDatosProveedor").reset();
                    document.getElementById('inputIdGenProveedor_formProveedor').value = null;
                    $('#selectProvincia_formProveedor').val(0).trigger('change');
                    $('#selectLocalidad_formProveedor').select2('data', { id: '0', text: 'Seleccione' });
                    $('#selectCatCompras_formProveedor').val(0).trigger('change');
                    $('#selectTipoDoc_formProveedor').val(0).trigger('change');
                    $('#selectCondIva_formProveedor').val(0).trigger('change');
                    $('#selectCompTipo_formProveedor').val(0).trigger('change');
                    $('#selectProvinciaFac_formProveedor').val(0).trigger('change');
                    $('#selectLocalidadFac_formProveedor').select2('data', { id: '0', text: 'Seleccione' });
                    $("#modal-nuevo-proveedor").modal("show");
                    //--- CARGO DATOS ---//
                    $('#selectProvincia_formProveedor').val(dato['proveedor'][0]['idProvincia']).trigger('change');
                    $('#selectCatCompras_formProveedor').val(dato['proveedor'][0]['idCategoriaCompras']).trigger('change');
                    $('#selectTipoDoc_formProveedor').val(dato['proveedor'][0]['idTipoDoc']).trigger('change');
                    $('#selectCondIva_formProveedor').val(dato['proveedor'][0]['idCondIva']).trigger('change');
                    $('#selectCompTipo_formProveedor').val(dato['proveedor'][0]['idComprobante']).trigger('change');
                    $('#selectProvinciaFac_formProveedor').val(dato['proveedor'][0]['idProvinciaFacturacion']).trigger('change');
                    $('#selectMedioPago_formProveedor').val(dato['proveedor'][0]['idMedioPago']).trigger('change');
                    document.getElementById('inputIdGenProveedor_formProveedor').value = dato['proveedor'][0]['idGenProveedor'];
                    document.getElementById('inputProveedor_formProveedor').value = dato['proveedor'][0]['nombEmpresa'];
                    document.getElementById('inputApellido_formProveedor').value = dato['proveedor'][0]['apellido'];
                    document.getElementById('inputNombre_formProveedor').value = dato['proveedor'][0]['nombre'];
                    document.getElementById('inputNumTel_formProveedor').value = dato['proveedor'][0]['tel'];
                    document.getElementById('inputNumCel_formProveedor').value = dato['proveedor'][0]['cel'];
                    document.getElementById('inputCorreo_formProveedor').value = dato['proveedor'][0]['email'];
                    document.getElementById('inputWeb_formProveedor').value = dato['proveedor'][0]['pagWeb'];
                    document.getElementById('inputCodPostal_formProveedor').value = dato['proveedor'][0]['cp'];
                    document.getElementById('inputDomicilio_formProveedor').value = dato['proveedor'][0]['domicilio'];
                    document.getElementById('inputNumDir_formProveedor').value = dato['proveedor'][0]['numero'];
                    document.getElementById('inputPiso_formProveedor').value = dato['proveedor'][0]['piso'];
                    document.getElementById('inputDpto_formProveedor').value = dato['proveedor'][0]['dpto'];
                    document.getElementById('inputNota_formProveedor').value = dato['proveedor'][0]['nota'];
                    document.getElementById('inputDtoGeneral_formProveedor').value = dato['proveedor'][0]['dtoGeneral'];
                    document.getElementById('inputNotaInterna_formProveedor').value = dato['proveedor'][0]['notaInterna'];
                    document.getElementById('inputRazonSocial_formProveedor').value = dato['proveedor'][0]['razonSocial'];
                    document.getElementById('inputNumTelFac_formProveedor').value = dato['proveedor'][0]['telFacturacion'];
                    document.getElementById('inputNumCelFac_formProveedor').value = dato['proveedor'][0]['celFacturacion'];
                    document.getElementById('inputNumDoc_formProveedor').value = dato['proveedor'][0]['cuit'];
                    document.getElementById('inputDomicilioFiscal_formProveedor').value = dato['proveedor'][0]['domicilioFacturacion'];
                    document.getElementById('inputCodPostalFac_formProveedor').value = dato['proveedor'][0]['cpFacturacion'];
                    document.getElementById('inputCBU_formProveedor').value = dato['proveedor'][0]['cbu'];
                    setTimeout(function() {
                        $('#selectLocalidad_formProveedor').val(dato['proveedor'][0]['idLocalidad']).trigger('change');
                        $('#selectLocalidadFac_formProveedor').val(dato['proveedor'][0]['idLocalidadFacturacion']).trigger('change');
                    }, 850);
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("hide");
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#modal-exitoso").modal("hide");
                $("#popUpError").modal("hide");
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            });
    });
})

//--- AGREGAR PROVEEDOR ---//
$(document).ready(function() {
    $('#btnAddProveedor').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var inputIdGenProveedor = $('#inputIdGenProveedor_formProveedor').val();
        var inputProveedor = $('#inputProveedor_formProveedor').val();
        var inputApellido = $('#inputApellido_formProveedor').val();
        var inputNombre = $('#inputNombre_formProveedor').val();
        var inputNumTel = $('#inputNumTel_formProveedor').val();
        var inputNumCel = $('#inputNumCel_formProveedor').val();
        var inputCorreo = $('#inputCorreo_formProveedor').val();
        var inputWeb = $('#inputWeb_formProveedor').val();
        var selectProvincia = $('#selectProvincia_formProveedor').val();
        var selectLocalidad = $('#selectLocalidad_formProveedor').val();
        var inputCodPostal = $('#inputCodPostal_formProveedor').val();
        var inputDomicilio = $('#inputDomicilio_formProveedor').val();
        var inputNumDir = $('#inputNumDir_formProveedor').val();
        var inputPiso = $('#inputPiso_formProveedor').val();
        var inputDpto = $('#inputDpto_formProveedor').val();
        var inputNota = $('#inputNota_formProveedor').val();
        var selectCatCompras = $('#selectCatCompras_formProveedor').val();
        var inputDtoGeneral = $('#inputDtoGeneral_formProveedor').val();
        var inputNotaInterna = $('#inputNotaInterna_formProveedor').val();
        var inputRazonSocial = $('#inputRazonSocial_formProveedor').val();
        var inputNumTelFac = $('#inputNumTelFac_formProveedor').val();
        var inputNumCelFac = $('#inputNumCelFac_formProveedor').val();
        var selectTipoDoc = $('#selectTipoDoc_formProveedor').val();
        var inputNumDoc = $('#inputNumDoc_formProveedor').val();
        var inputDomicilioFiscal = $('#inputDomicilioFiscal_formProveedor').val();
        var selectCondIva = $('#selectCondIva_formProveedor').val();
        var selectCompTipo = $('#selectCompTipo_formProveedor').val();
        var selectProvinciaFac = $('#selectProvinciaFac_formProveedor').val();
        var selectLocalidadFac = $('#selectLocalidadFac_formProveedor').val();
        var inputCodPostalFac = $('#inputCodPostalFac_formProveedor').val();
        var selectMedioPago = $('#selectMedioPago_formProveedor').val();
        var inputCBU = $('#inputCBU_formProveedor').val();
        var val1, val2, val3, val4, val5, val6, val7, val8, val9, val10;
        var val11, val12, val13, val14, val15, val16, val17, val18, val19, val20;
        var val21, val22, val23, val24, val25, val26, val27, val28, val29, val30, val31, val32;
        var PostProveedor;
        //inputIdGenProveedor
        if (inputIdGenProveedor != null && inputIdGenProveedor.length != 0) {
            PostProveedor = 'proveedores/update_proveedor/';
        } else {
            PostProveedor = 'proveedores/set_proveedor/';
        }

        //inputProveedor
        if (inputProveedor == null || inputProveedor.length == 0 || /^\s+$/.test(inputProveedor)) {
            $("#errorInputProveedor_formProveedor").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputProveedor_formProveedor").css("display", "none");
            val1 = true;
        }

        //inputNombre
        if (inputNombre == null || inputNombre.length == 0 || /^\s+$/.test(inputNombre)) {
            $("#errorInputNombre_formProveedor").css("display", "block");
            val3 = false;
        } else {
            $("#errorInputNombre_formProveedor").css("display", "none");
            val3 = true;
        }

        //        //inputNumTel
        //        if (inputNumTel == null || inputNumTel.length == 0 || isNaN(inputNumTel)) {
        //            $("#errorInputNumTel_formProveedor").css("display", "block");
        //            val4 = false;
        //        } else {
        //            $("#errorInputNumTel_formProveedor").css("display", "none");
        //            val4 = true;
        //        }
        //
        //        //inputNumCel
        //        if (inputNumCel == null || inputNumCel.length == 0 || isNaN(inputNumCel)) {
        //            $("#errorInputNumCel_formProveedor").css("display", "block");
        //            val5 = false;
        //        } else {
        //            $("#errorInputNumCel_formProveedor").css("display", "none");
        //            val5 = true;
        //        }
        //
        //        //inputCorreo
        //        if (inputCorreo == null || inputCorreo.length == 0 || !(/\S+@\S+\.\S+/.test(inputCorreo))) {
        //            $("#errorInputCorreo_formProveedor").css("display", "block");
        //            val6 = false;
        //        } else {
        //            $("#errorInputCorreo_formProveedor").css("display", "none");
        //            val6 = true;
        //        }
        //
        //        //inputWeb
        //        if (inputWeb == null || inputWeb.length == 0 || /^\s+$/.test(inputWeb)) {
        //            $("#errorInputWeb_formProveedor").css("display", "block");
        //            val7 = false;
        //        } else {
        //            $("#errorInputWeb_formProveedor").css("display", "none");
        //            val7 = true;
        //        }
        //
        //selectProvincia
        if (selectProvincia == null || selectProvincia.length == 0 || selectProvincia == 0) {
            $("#errorSelectProvincia_formProveedor").css("display", "block");
            val8 = false;
        } else {
            $("#errorSelectProvincia_formProveedor").css("display", "none");
            val8 = true;
        }

        //selectLocalidad
        if (selectLocalidad == null || selectLocalidad.length == 0) {
            $("#errorSelectLocalidad_formProveedor").css("display", "block");
            val9 = false;
        } else {
            $("#errorSelectLocalidad_formProveedor").css("display", "none");
            val9 = true;
        }
        //
        //        //inputCodPostal
        //        if (inputCodPostal == null || inputCodPostal.length == 0 || /^\s+$/.test(inputCodPostal)) {
        //            $("#errorInputCodPostal_formProveedor").css("display", "block");
        //            val10 = false;
        //        } else {
        //            $("#errorInputCodPostal_formProveedor").css("display", "none");
        //            val10 = true;
        //        }
        //
        //        //inputDomicilio
        //        if (inputDomicilio == null || inputDomicilio.length == 0 || /^\s+$/.test(inputDomicilio)) {
        //            $("#errorInputDomicilio_formProveedor").css("display", "block");
        //            val11 = false;
        //        } else {
        //            $("#errorInputDomicilio_formProveedor").css("display", "none");
        //            val11 = true;
        //        }
        //
        //        //inputNumDir
        //        if (inputNumDir == null || inputNumDir.length == 0 || /^\s+$/.test(inputNumDir)) {
        //            $("#errorInputNumDir_formProveedor").css("display", "block");
        //            val12 = false;
        //        } else {
        //            $("#errorInputNumDir_formProveedor").css("display", "none");
        //            val12 = true;
        //        }
        //
        //        //inputPiso
        //        if (inputPiso == null || inputPiso.length == 0 || /^\s+$/.test(inputPiso)) {
        //            $("#errorInputPiso_formProveedor").css("display", "block");
        //            val13 = false;
        //        } else {
        //            $("#errorInputPiso_formProveedor").css("display", "none");
        //            val13 = true;
        //        }
        //
        //        //inputDpto
        //        if (inputDpto == null || inputDpto.length == 0 || /^\s+$/.test(inputDpto)) {
        //            $("#errorInputDpto_formProveedor").css("display", "block");
        //            val14 = false;
        //        } else {
        //            $("#errorInputDpto_formProveedor").css("display", "none");
        //            val14 = true;
        //        }
        //
        //        //inputNota
        //        if (inputNota == null || inputNota.length == 0 || /^\s+$/.test(inputNota)) {
        //            $("#errorInputNota_formProveedor").css("display", "block");
        //            val15 = false;
        //        } else {
        //            $("#errorInputNota_formProveedor").css("display", "none");
        //            val15 = true;
        //        }
        //
        //        //selectCatCompras
        //        if (selectCatCompras == null || selectCatCompras.length == 0) {
        //            $("#errorSelectCatCompras_formProveedor").css("display", "block");
        //            val16 = false;
        //        } else {
        //            $("#errorSelectCatCompras_formProveedor").css("display", "none");
        //            val16 = true;
        //        }
        //
        //        //inputDtoGeneral
        //        if (inputDtoGeneral == null || inputDtoGeneral.length == 0 || /^\s+$/.test(inputDtoGeneral)) {
        //            $("#errorInputDtoGeneral_formProveedor").css("display", "block");
        //            val17 = false;
        //        } else {
        //            $("#errorInputDtoGeneral_formProveedor").css("display", "none");
        //            val17 = true;
        //        }
        //
        //        //inputNotaInterna
        //        if (inputNotaInterna == null || inputNotaInterna.length == 0 || /^\s+$/.test(inputNotaInterna)) {
        //            $("#errorInputNotaInterna_formProveedor").css("display", "block");
        //            val18 = false;
        //        } else {
        //            $("#errorInputNotaInterna_formProveedor").css("display", "none");
        //            val18 = true;
        //        }
        //
        //        //inputRazonSocial
        //        if (inputRazonSocial == null || inputRazonSocial.length == 0 || /^\s+$/.test(inputRazonSocial)) {
        //            $("#errorInputRazonSocial_formProveedor").css("display", "block");
        //            val19 = false;
        //        } else {
        //            $("#errorInputRazonSocial_formProveedor").css("display", "none");
        //            val19 = true;
        //        }
        //
        //        //inputNumTelFac
        //        if (inputNumTelFac == null || inputNumTelFac.length == 0 || isNaN(inputNumTelFac)) {
        //            $("#errorInputNumTelFac_formProveedor").css("display", "block");
        //            val20 = false;
        //        } else {
        //            $("#errorInputNumTelFac_formProveedor").css("display", "none");
        //            val20 = true;
        //        }
        //
        //        //inputNumCelFac
        //        if (inputNumCelFac == null || inputNumCelFac.length == 0 || isNaN(inputNumCelFac)) {
        //            $("#errorInputNumCelFac_formProveedor").css("display", "block");
        //            val21 = false;
        //        } else {
        //            $("#errorInputNumCelFac_formProveedor").css("display", "none");
        //            val21 = true;
        //        }
        //
        //        //selectTipoDoc
        //        if (selectTipoDoc == null || selectTipoDoc.length == 0) {
        //            $("#errorSelectTipoDoc_formProveedor").css("display", "block");
        //            val22 = false;
        //        } else {
        //            $("#errorSelectTipoDoc_formProveedor").css("display", "none");
        //            val22 = true;
        //        }
        //
        //        //inputNumDoc
        //        if (inputNumDoc == null || inputNumDoc.length == 0 || /^\s+$/.test(inputNumDoc)) {
        //            $("#errorInputNumDoc_formProveedor").css("display", "block");
        //            val23 = false;
        //        } else {
        //            $("#errorInputNumDoc_formProveedor").css("display", "none");
        //            val23 = true;
        //        }
        //
        //        //inputDomicilioFiscal
        //        if (inputDomicilioFiscal == null || inputDomicilioFiscal.length == 0 || /^\s+$/.test(inputDomicilioFiscal)) {
        //            $("#errorInputDomicilioFiscal_formProveedor").css("display", "block");
        //            val24 = false;
        //        } else {
        //            $("#errorInputDomicilioFiscal_formProveedor").css("display", "none");
        //            val24 = true;
        //        }
        //
        //        //selectCondIva
        //        if (selectCondIva == null || selectCondIva.length == 0) {
        //            $("#errorSelectCondIva_formProveedor").css("display", "block");
        //            val25 = false;
        //        } else {
        //            $("#errorSelectCondIva_formProveedor").css("display", "none");
        //            val25 = true;
        //        }
        //
        //        //selectCompTipo
        //        if (selectCompTipo == null || selectCompTipo.length == 0) {
        //            $("#errorSelectCompTipo_formProveedor").css("display", "block");
        //            val26 = false;
        //        } else {
        //            $("#errorSelectCompTipo_formProveedor").css("display", "none");
        //            val26 = true;
        //        }
        //
        //        //selectProvinciaFac
        //        if (selectProvinciaFac == null || selectProvinciaFac.length == 0) {
        //            $("#errorSelectProvinciaFac_formProveedor").css("display", "block");
        //            val27 = false;
        //        } else {
        //            $("#errorSelectProvinciaFac_formProveedor").css("display", "none");
        //            val27 = true;
        //        }
        //
        //        //selectLocalidadFac
        //        if (selectLocalidadFac == null || selectLocalidadFac.length == 0) {
        //            $("#errorSelectLocalidadFac_formProveedor").css("display", "block");
        //            val28 = false;
        //        } else {
        //            $("#errorSelectLocalidadFac_formProveedor").css("display", "none");
        //            val28 = true;
        //        }
        //
        //        //inputCodPostalFac
        //        if (inputCodPostalFac == null || inputCodPostalFac.length == 0 || /^\s+$/.test(inputCodPostalFac)) {
        //            $("#errorInputCodPostalFac_formProveedor").css("display", "block");
        //            val29 = false;
        //        } else {
        //            $("#errorInputCodPostalFac_formProveedor").css("display", "none");
        //            val29 = true;
        //        }

        //inputApellido
        if (inputApellido == null || inputApellido.length == 0 || /^\s+$/.test(inputApellido)) {
            $("#errorInputApellido_formProveedor").css("display", "block");
            val30 = false;
        } else {
            $("#errorInputApellido_formProveedor").css("display", "none");
            val30 = true;
        }

        //Medio de Pago y CBU
        val32 = true;
        if (selectMedioPago == 0) {
            $("#errorSelectMedioPago_formProveedor").css("display", "block");
            val31 = false;
        } else {
            if (selectMedioPago == 2) {
                if (inputCBU.length == 22) {
                    $("#errorInputCBU_formProveedor").css("display", "none");
                    val32 = true;
                } else {
                    $("#errorInputCBU_formProveedor").css("display", "block");
                    val32 = false;
                }
                $("#errorSelectMedioPago_formProveedor").css("display", "none");
                val31 = true;
            } else {
                $("#errorSelectMedioPago_formProveedor").css("display", "none");
                val31 = true;
            }
        }

        //        if (
        //                val1 && val3 && val4 && val5 && val6 && val7 && val8 && val9 && val10 &&
        //                val11 && val12 && val13 && val14 && val15 && val16 && val17 && val18 && val19 && val20 &&
        //                val21 && val22 && val23 && val24 && val25 && val26 && val27 && val28 && val29 && val30
        //                ) {

        var longitud = inputNumDoc.length;

        if (selectTipoDoc == 6 || selectTipoDoc == 7) {
            if (longitud > 9 && longitud < 12) {
                if (inputNumDoc.length != 11) {
                    return false;
                }

                var acumulado = 0;
                var digitos = inputNumDoc.split("");
                var digito = digitos.pop();

                for (var i = 0; i < digitos.length; i++) {
                    acumulado += digitos[9 - i] * (2 + (i % 6));
                }

                var verif = 11 - (acumulado % 11);
                if (verif == 11) {
                    verif = 0;
                } else if (verif == 10) {
                    verif = 9;
                }

                if (digito == verif) {
                    $("#errorInputNumDoc_formProveedor").css("display", "none");
                    val23 = true;
                } else {
                    $("#errorInputNumDoc_formProveedor").css("display", "block");
                    val23 = false;
                }
            } else {
                $("#errorInputNumDoc_formProveedor").css("display", "block");
                val23 = false;
            }
        }

        if (selectTipoDoc == 8) {
            if (longitud > 6 && longitud < 9) {
                $("#errorInputNumDoc_formProveedor").css("display", "none");
                val23 = true;
            } else {
                $("#errorInputNumDoc_formProveedor").css("display", "block");
                val23 = false;
                $("#errorInputNumDoc_formProveedor").css("display", "none");
            }
        } else if (parseInt(selectTipoDoc) != 6 && parseInt(selectTipoDoc) != 7 && parseInt(selectTipoDoc) != 8) {
            val23 = true;
        }

        if (
            val1 && val3 && val30 && val8 && val9 && val31 && val32 && val23
        ) {
            var formData = new FormData($("#formDatosProveedor")[0]);
            $.ajax({
                    url: URL + PostProveedor,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-nuevo-proveedor").modal("hide");
                        document.getElementById("formDatosProveedor").reset();
                        document.getElementById('inputIdGenProveedor_formProveedor').value = null;
                        $('#selectProvincia_formProveedor').val(0).trigger('change');
                        $('#selectLocalidad_formProveedor').select2('data', { id: '0', text: 'Seleccione' });
                        $('#selectCatCompras_formProveedor').val(0).trigger('change');
                        $('#selectTipoDoc_formProveedor').val(0).trigger('change');
                        $('#selectCondIva_formProveedor').val(0).trigger('change');
                        $('#selectCompTipo_formProveedor').val(0).trigger('change');
                        $('#selectProvinciaFac_formProveedor').val(0).trigger('change');
                        $('#selectLocalidadFac_formProveedor').select2('data', { id: '0', text: 'Seleccione' });
                        //--- AGREGO FILA ---//
                        var table = $('#listadoProveedores').DataTable();

                        if (inputIdGenProveedor != null && inputIdGenProveedor.length != 0) {
                            $("#listadoProveedores").dataTable().fnDeleteRow("#" + inputIdGenProveedor);
                        }

                        var row = table.row.add([
                            dato['proveedor'][0]['idProveedor'],
                            dato['proveedor'][0]['nombre'],
                            dato['proveedor'][0]['apellido'],
                            dato['proveedor'][0]['email'],
                            dato['proveedor'][0]['tel'],
                            dato['proveedor'][0]['cel'],
                            dato['proveedor'][0]['provincia'],
                            dato['proveedor'][0]['localidad'],
                            '<a href="#modal-delete" class="tip delete_proveedor" role="button" data-id="' + dato['proveedor'][0]['idGenProveedor'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;&nbsp;&nbsp;' +
                            '<a href="#" class="tip edit_proveedor" data-id="' + dato['proveedor'][0]['idGenProveedor'] + '" data-original-title="Editar"><i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['proveedor'][0]['idGenProveedor']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(8).nodes().to$().addClass('text-center');
                        swal(
                            'Proveedor',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#modal-nuevo-proveedor").modal("hide");
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        }
    });
});
//--- BORRAR PROVEEDOR ---//
$(function() {
    $("#listadoProveedores").on("click", "a.delete_proveedor", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'proveedores/eliminar_proveedor/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoProveedores").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Proveedor',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- RESET FORM PRODUCTO ---//
function resetFormProducto() {
    document.getElementById("formDatosProducto").reset();
    document.getElementById('inputIdGenProducto_formProducto').value = null;
    $('#selectProveedor_formProducto').val(0).trigger('change');
    $('#selectEstado_formProducto').val(1).trigger('change');
    $('#selectIvaVenta_formProducto').val(0).trigger('change');
    $('#selectControlStock_formProducto').val(0).trigger('change');
    $('#selectIvaCompra_formProducto').val(0).trigger('change');
    $("#infoPorcentajeDescuento_formProducto").css("display", "none");

    $("#errorInputNombre_formProducto").css("display", "none");
    $("#errorInputCodigo_formProducto").css("display", "none");
    $("#errorSelectProveedor_formProducto").css("display", "none");
    $("#errorInputStock_formProducto").css("display", "none");
    $("#errorInputDescripcion_formProducto").css("display", "none");
    $("#errorInputPrecioVenta_formProducto").css("display", "none");
    $("#errorInputPrecioCompra_formProducto").css("display", "none");
    $("#errorSelectIvaCompra_formProducto").css("display", "none");
    $("#errorSelectIvaVenta_formProducto").css("display", "none");
}

//--- MODIFICAR PRODUCTO ---//
$(function() {
    $("#listadoProductos").on("click", "a.edit_producto", function(e) {
        e.preventDefault();
        var idGenProducto = $(this).data('id');
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'productos/get_info_producto/',
                type: 'POST',
                cache: false,
                data: {
                    id: idGenProducto
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    document.getElementById("formDatosProducto").reset();
                    document.getElementById('inputIdGenProducto_formProducto').value = null;
                    $('#selectProveedor_formProducto').val(0).trigger('change');
                    $('#selectEstado_formProducto').val(0).trigger('change');
                    $('#selectIvaVenta_formProducto').val(0).trigger('change');
                    $('#selectIvaCompra_formProducto').val(0).trigger('change');
                    $('#selectControlStock_formProducto').val("select").trigger('change');
                    $('#selectProductoEcommerce_formDatosProducto').val(dato['producto'][0]['ecommerce']).trigger('change');
                    $("#modal-nuevo-producto").modal("show");
                    //--- CARGO DATOS ---//
                    $('#selectProveedor_formProducto').val(dato['producto'][0]['idProveedor']).trigger('change');
                    $('#selectEstado_formProducto').val(dato['producto'][0]['activo']).trigger('change');
                    $('#selectIvaVenta_formProducto').val(dato['producto'][0]['idIvaVta']).trigger('change');
                    $('#selectIvaCompra_formProducto').val(dato['producto'][0]['idIvaCompra']).trigger('change');
                    $('#selectControlStock_formProducto').val(dato['producto'][0]['controlStock']).trigger('change');
                    document.getElementById('inputIdGenProducto_formProducto').value = dato['producto'][0]['idGenProducto'];
                    document.getElementById('inputNombre_formProducto').value = dato['producto'][0]['nombre'];
                    document.getElementById('inputCodigo_formProducto').value = dato['producto'][0]['codigo'];
                    document.getElementById('inputStock_formProducto').value = dato['producto'][0]['stock'];
                    document.getElementById('inputDescripcion_formProducto').value = dato['producto'][0]['descripcion'];
                    document.getElementById('inputPrecioVenta_formProducto').value = dato['producto'][0]['precioVenta'];
                    document.getElementById('inputPrecioCompra_formProducto').value = dato['producto'][0]['precioCompra'];
                    document.getElementById('inputPorcentajeDescuento_formProducto').value = dato['producto'][0]['porcentajeDescuento'];
                    porcentajeDescuentoProducto();
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#modal-exitoso").modal("hide");
                $("#popUpError").modal("show");
            });
    })
})

//--- AGREGAR PRODUCTO ---//
$(document).ready(function() {
    $('#btnAddProducto').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var inputIdGenProducto = $('#inputIdGenProducto_formProducto').val();
        var inputNombre = $('#inputNombre_formProducto').val();
        var inputCodigo = $('#inputCodigo_formProducto').val();
        var selectProveedor = $('#selectProveedor_formProducto').val();
        var inputStock = $('#inputStock_formProducto').val();
        var inputDescripcion = $('#inputDescripcion_formProducto').val();
        var selectEstado = $('#selectEstado_formProducto').val();
        var inputPrecioVenta = $('#inputPrecioVenta_formProducto').val();
        var selectIvaVenta = $('#selectIvaVenta_formProducto').val();
        var inputPrecioCompra = $('#inputPrecioCompra_formProducto').val();
        var selectIvaCompra = $('#selectIvaCompra_formProducto').val();
        var selectControlStock = $('#selectControlStock_formProducto').val();
        var val1, val2, val3, val4, val5, val6, val7, val8, val9, val10, val11;
        var PostProducto;
        //inputIdGenProducto
        if (inputIdGenProducto != null && inputIdGenProducto.length != 0) {
            var PostProducto = 'productos/update_producto/';
        } else {
            var PostProducto = 'productos/set_producto/';
        }

        //inputNombre
        if (inputNombre == null || inputNombre.length == 0 || /^\s+$/.test(inputNombre)) {
            $("#errorInputNombre_formProducto").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputNombre_formProducto").css("display", "none");
            val1 = true;
        }

        //inputCodigo
        if (inputCodigo == null || inputCodigo.length == 0 || /^\s+$/.test(inputCodigo)) {
            $("#errorInputCodigo_formProducto").css("display", "block");
            val2 = false;
        } else {
            $("#errorInputCodigo_formProducto").css("display", "none");
            val2 = true;
        }

        //selectProveedor
        if (selectProveedor == 0) {
            $("#errorSelectProveedor_formProducto").css("display", "block");
            val3 = false;
        } else {
            $("#errorSelectProveedor_formProducto").css("display", "none");
            val3 = true;
        }

        //inputStock
        if (inputStock == null || inputStock.length == 0 || isNaN(inputStock)) {
            $("#errorInputStock_formProducto").css("display", "block");
            val4 = false;
        } else {
            $("#errorInputStock_formProducto").css("display", "none");
            val4 = true;
        }

        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0 || /^\s+$/.test(inputDescripcion)) {
            $("#errorInputDescripcion_formProducto").css("display", "block");
            val5 = false;
        } else {
            $("#errorInputDescripcion_formProducto").css("display", "none");
            val5 = true;
        }

        //selectEstado
        if (selectEstado == 0) {
            $("#errorSelectEstado_formProducto").css("display", "block");
            val6 = false;
        } else {
            $("#errorSelectEstado_formProducto").css("display", "none");
            val6 = true;
        }

        //inputPrecioVenta
        if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || isNaN(inputPrecioVenta)) {
            $("#errorInputPrecioVenta_formProducto").css("display", "block");
            val7 = false;
        } else {
            $("#errorInputPrecioVenta_formProducto").css("display", "none");
            val7 = true;
        }

        //selectIvaVenta
        if (selectIvaVenta == 0) {
            $("#errorSelectIvaVenta_formProducto").css("display", "block");
            val8 = false;
        } else {
            $("#errorSelectIvaVenta_formProducto").css("display", "none");
            val8 = true;
        }

        //inputPrecioCompra
        if (inputPrecioCompra == null || inputPrecioCompra.length == 0 || isNaN(inputPrecioCompra)) {
            $("#errorInputPrecioCompra_formProducto").css("display", "block");
            val9 = false;
        } else {
            $("#errorInputPrecioCompra_formProducto").css("display", "none");
            val9 = true;
        }

        //selectIvaCompra
        if (selectIvaCompra == 0) {
            $("#errorSelectIvaCompra_formProducto").css("display", "block");
            val10 = false;
        } else {
            $("#errorSelectIvaCompra_formProducto").css("display", "none");
            val10 = true;
        }

        //control de stock
        if (selectControlStock == "select") {
            $("#errorSelectControlStock_formProducto").css("display", "block");
            val11 = false;
        } else {
            $("#errorSelectControlStock_formProducto").css("display", "none");
            val11 = true;
        }

        if (
            val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9 && val10 && val11
        ) {
            var formData = new FormData($("#formDatosProducto")[0]);
            $.ajax({
                    url: URL + PostProducto,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#modal-nuevo-producto").modal("hide");

                        swal(
                            'Producto',
                            dato['msg'],
                            'success'
                        )

                        document.getElementById("formDatosProducto").reset();
                        document.getElementById('inputIdGenProducto_formProducto').value = null;
                        $('#selectProveedor_formProducto').val(0).trigger('change');
                        $('#selectEstado_formProducto').val(0).trigger('change');
                        $('#selectIvaVenta_formProducto').val(0).trigger('change');
                        $('#selectIvaCompra_formProducto').val(0).trigger('change');
                        //--- AGREGO FILA ---//
                        var table = $('#listadoProductos').DataTable();
                        if (inputIdGenProducto != null && inputIdGenProducto.length != 0) {
                            $("#listadoProductos").dataTable().fnDeleteRow("#" + inputIdGenProducto);
                        }

                        var row = table.row.add([
                            dato['producto'][0]['idProducto'],
                            dato['producto'][0]['nombre'],
                            dato['producto'][0]['stock'],
                            dato['producto'][0]['precioCompra'],
                            dato['producto'][0]['precioVenta'],
                            dato['producto'][0]['descIvaVentas'],
                            dato['producto'][0]['descIvaCompras'],
                            ' - ',
                            dato['producto'][0]['nombEmpresa'],
                            '<a href="#modal-delete" class="tip delete_producto" role="button" data-id="' + dato['producto'][0]['idGenProducto'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;&nbsp;&nbsp;' +
                            '<a href="#" class="tip edit_producto" data-id="' + dato['producto'][0]['idGenProducto'] + '" data-original-title="Editar"><i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['producto'][0]['idGenProducto']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                        table.row(row).column(2).nodes().to$().addClass('text-right');
                        table.row(row).column(3).nodes().to$().addClass('text-right');
                        table.row(row).column(4).nodes().to$().addClass('text-right');
                        table.row(row).column(5).nodes().to$().addClass('text-right');
                        table.row(row).column(6).nodes().to$().addClass('text-right');
                        table.row(row).column(7).nodes().to$().addClass('text-right');
                        table.row(row).column(8).nodes().to$().addClass('text-center');
                        table.row(row).column(9).nodes().to$().addClass('text-center');
                        //--- Agregar nuevo producto en el select de productos de compras ---//
                        //--- Declaracion de variables ---//
                        var select = document.getElementById("selectProductosCompras");
                        var new_option = document.createElement("option");
                        //--- Se genera la opcion del select ---//
                        new_option.value = dato['producto'][0]['idProducto'];
                        new_option.text = "(" + dato['producto'][0]['codigo'] + ") " + dato['producto'][0]['nombre'];
                        //--- Se añade las opciones al select ---//
                        select.appendChild(new_option);

                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Producto',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        }
    });
});
//--- AGREGAR / Modificar Categorias ventas ---//
$(document).ready(function() {
    $('#btnAddCategoriaVentas').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputId_formCatVentas').val();
        var inputDescripcion = $('#inputDescripcion_formCatVentas').val();
        var PostProducto, val1;
        if (id == null || id.length == 0) {
            id = 0;
            var PostProducto = 'ventas/add_categorias_ventas/';
        } else {
            var PostProducto = 'ventas/update_categorias_ventas/';
        }

        var formData = new FormData($("#formDatosCategoriaVentas")[0]);
        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcion_formCategoriaVentas").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcion_formCategoriaVentas").css("display", "none");
            val1 = true;
        }

        if (val1) {
            $.ajax({
                    url: URL + PostProducto,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-nueva-categoria-ventas").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'success'
                        )

                        document.getElementById("inputDescripcion_formCatVentas").value = "";
                        document.getElementById("inputId_formCatVentas").value = "";
                        var table = $('#listadoCatVentas').DataTable();
                        if (PostProducto == 'ventas/update_categorias_ventas/') {
                            if (id != null && id.length != 0) {
                                $("#listadoCatVentas").dataTable().fnDeleteRow("#" + id);
                            }
                        }

                        var row = table.row.add([
                            dato['inputDescripcion'],
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_ventas" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-nueva-categoria-ventas" role="button" data-toggle="modal" class="tip update_categorias_ventas" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar">' +
                            '<i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            swal(
                'Categoría Venta',
                'Debe completar los campos obligatorios',
                'error'
            )
        }
    });
});
$(function() {
    $("#listadoCatVentas").on("click", "a.update_categorias_ventas", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        $("#errorInputDescripcion_formCategoriaVentas").css("display", "none");
        document.getElementById("inputId_formCatVentas").value = id;
        document.getElementById("inputDescripcion_formCatVentas").value = descripcion;
    });
});
//--- BORRAR Categorias Venta ---//
$(function() {
    $("#listadoCatVentas").on("click", "a.delete_categorias_ventas", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        

        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'ventas/eliminar_categoria_ventas/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoCatVentas").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Categoría',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- AGREGAR Categorias detalle de ventas ---//
$(document).ready(function() {
    $('#btnAddCategoriaDetVentas').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputId_formCatVentas').val();
        var inputDescripcion = $('#inputDescripcion_formCatVentas').val();
        var val2 = true;
        var inputSubcategoria0 = $('#inputSubcategoria_formCatVentas0').val();
        if (inputSubcategoria0 == "") {
            $("#errorInputSubcategoria_formCategoriaVentas0").css("display", "block");
            val2 = false;
        } else {
            $("#errorInputSubcategoria_formCategoriaVentas0").css("display", "none");
        }

        for (var i = 0; i < 26; i++) {
            var arr = document.getElementsByClassName('inputSubcategoria_formCatVentas' + i);
            for (var j = 1; j < arr.length; j++) {
                //console.log(arr[1].value);
                if (arr[1].value == "") {
                    $(".field_wrapper #errorInputSubcategoria_formCategoriaVentas" + i).css("display", "block");
                    val2 = false;
                } else {
                    $(".field_wrapper #errorInputSubcategoria_formCategoriaVentas" + i).css("display", "none");
                }
            }
        }

        var val1;
        var formData = new FormData($("#formDatosCategoriaVentas")[0]);
        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcion_formCategoriaDetalleVentas").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcion_formCategoriaDetalleVentas").css("display", "none");
            val1 = true;
        }

        if (val1 && val2) {
            $.ajax({
                    url: URL + 'ventas/add_categorias_ventas/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-nueva-categoria-detalle-ventas").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        document.getElementById("inputDescripcion_formCatVentas").value = "";
                        document.getElementById("inputId_formCatVentas").value = "";
                        var table = $('#listadoCatDetCategoriaVentas').DataTable();
                        var row = table.row.add([
                            dato['inputDescripcion'],
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_ventas_detalle" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-nueva-categoria-detalle-ventas" data-toggle="modal" class="tip update_categorias_ventas_detalle" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar">' +
                            '<i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
});

//--- MODIFICAR Categorias detalle de ventas ---//
$(document).ready(function() {
    $('#btnModificarCategoriaDetVentas').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputIdModificar_formCatVentas').val();
        var inputDescripcion = $('#inputDescripcionModificar_formCatVentas').val();
        var inputSubcategoria0 = $('#inputSubcategoria_formCatModificarVentas0').val();
        var val1, val2 = true;
        var formData = new FormData($("#formDatosCategoriaVentasModificar")[0]);
        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcionModificar_formCategoriaVentas").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcionModificar_formCategoriaVentas").css("display", "none");
            val1 = true;
        }
        if (inputSubcategoria0 == "") {
            $("#errorInputSubcategoria_formModificarCatVentas0").css("display", "block");
            val2 = false;
        } else {
            $("#errorInputSubcategoria_formModificarCatVentas0").css("display", "none");
            val2 = true
        }

        for (var i = 0; i < 26; i++) {
            var arr = document.getElementsByClassName('inputSubcategoria_formCatModificarVentas' + i);
            for (var j = 1; j < arr.length; j++) {
                if (arr[0].value == "") {
                    $(".field_wrapper_modificarCatVenta #errorInputSubcategoria_formModificarCatVentas" + i).css("display", "block");
                    val2 = false;
                } else {
                    $(".field_wrapper_modificarCatVenta #errorInputSubcategoria_formModificarCatVentas" + i).css("display", "none");
                    val2 = true
                }
            }
        }

        if (true) {
            $.ajax({
                    url: URL + 'ventas/update_categorias_ventas/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    ////console.log(dato);
                    if (dato['valid']) {
                        $("#modal-modificar-categoria-detalle-ventas").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'success'
                        )
                        document.getElementById("inputDescripcionModificar_formCatVentas").value = "";
                        document.getElementById("inputIdModificar_formCatVentas").value = "";
                        var table = $('#listadoCatDetCategoriaVentas').DataTable();
                        $("#listadoCatDetCategoriaVentas").dataTable().fnDeleteRow("#" + id);
                        var row = table.row.add([
                            dato['inputDescripcion'],
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_ventas_detalle" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-modificar-categoria-detalle-ventas" data-toggle="modal" class="tip update_categorias_ventas_detalle" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar">' +
                            '<i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
});
$(function() {
    $("#listadoCatDetCategoriaVentas").on("click", "a.update_categorias_ventas_detalle", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');

        $("#errorInputDescripcionModificar_formCategoriaVentas").css("display", "none");
        document.getElementById("inputIdModificar_formCatVentas").value = id;
        document.getElementById("inputDescripcion_formCatVentas").value = descripcion;
    });
});
//--- BORRAR Categorias detalle Ventas ---//
$(function() {
    $("#listadoCatDetCategoriaVentas").on("click", "a.delete_categorias_ventas_detalle", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        
        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'ventas/eliminar_categoria_ventas/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoCatDetCategoriaVentas").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Categoría Venta',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- AGREGAR / Modificar subcategoria ventas ---//
$(document).ready(function() {
    $('#btnAddSubcategoriaVentas').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputId_formSubCatVentas').val();
        var inputDescripcion = $('#inputDescripcion_formSubCatVentas').val();
        var selectCategoriaDetalle = $('#selectCategoriaDetalle_formSubCatVentas option:selected').text();
        var PostProducto, val1, val2;
        var formData = new FormData($("#formDatosSubcategoriaVentas")[0]);
        if (id == null || id.length == 0) {
            id = 0;
            var PostProducto = 'ventas/add_subcategorias_ventas/';
        } else {
            var PostProducto = 'ventas/update_subcategorias_ventas/';
        }

        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcion_formSubcategoriaVentas").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcion_formSubcategoriaVentas").css("display", "none");
            val1 = true;
        }

        //selectCategoriaDetalle
        if (selectCategoriaDetalle == 'Seleccione') {
            $("#errorSelectSubcategoria_formSubCatVentas").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectSubcategoria_formSubCatVentas").css("display", "none");
            val2 = true;
        }

        if (val1 && val2) {
            $.ajax({
                    url: URL + PostProducto,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-nueva-subcategoria-ventas").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Subcategoría ventas',
                            dato['msg'],
                            'success'
                        )
                        document.getElementById("inputDescripcion_formSubCatVentas").value = "";
                        document.getElementById("inputId_formSubCatVentas").value = "";
                        //console.log(dato);
                        var table = $('#listadoSubcategoriasVentas').DataTable();
                        //console.log(table);
                        if (PostProducto == 'ventas/update_subcategorias_ventas/') {
                            if (id != null && id.length != 0) {
                                $("#listadoSubcategoriasVentas").dataTable().fnDeleteRow("#" + id);
                            }
                        }

                        var row = table.row.add([
                            dato['inputDescripcion'],
                            selectCategoriaDetalle,
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_subcategorias_ventas" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-nueva-subcategoria-ventas" data-toggle="modal" class="tip update_subcategorias_ventas" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar">' +
                            '<i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                        table.row(row).column(2).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Subcategoría',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
});
$(function() {
    $("#listadoSubcategoriasVentas").on("click", "a.update_subcategorias_ventas", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        var categoria = $(this).data('categoria');
        $("#errorSelectSubcategoria_formSubCatVentas").css("display", "none");
        $("#errorInputDescripcion_formSubcategoriaVentas").css("display", "none");
        document.getElementById("inputId_formSubCatVentas").value = id;
        document.getElementById("inputDescripcion_formSubCatVentas").value = descripcion;
        $('#selectCategoriaDetalle_formSubCatVentas').val(categoria).trigger('change');
    });
});
//--- BORRAR Subcategoria Venta ---//
$(function() {
    $("#listadoSubcategoriasVentas").on("click", "a.delete_subcategorias_ventas", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        
        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'ventas/eliminar_subcategorias_ventas/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoSubcategoriasVentas").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Subcategoría venta',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        swal(
                            'Subcategoría Venta',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- AGREGAR / Modificar Categorias de compras ---//
$(document).ready(function() {
    $('#btnAddCategoriaCompras').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputId_formCatCompras').val();
        var inputDescripcion = $('#inputDescripcion_formCatCompras').val();
        var PostProducto, val1;
        var formData = new FormData($("#formDatosCategoriaCompras")[0]);
        if (id == null || id.length == 0) {
            id = 0;
            var PostProducto = 'compras/add_categorias_compras/';
        } else {
            var PostProducto = 'compras/update_categorias_compras/';
        }

        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcion_formCategoriaCompras").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcion_formCategoriaCompras").css("display", "none");
            val1 = true;
        }

        if (val1) {
            $.ajax({
                    url: URL + PostProducto,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-nueva-categoria-compras").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Categoría Compra',
                            dato['msg'],
                            'success'
                        )
                        document.getElementById("inputDescripcion_formCatCompras").value = "";
                        document.getElementById("inputId_formCatCompras").value = "";
                        var table = $('#listadoCategoriasCompras').DataTable();
                        if (PostProducto == 'compras/update_categorias_compras/') {
                            if (id != null && id.length != 0) {
                                $("#listadoCategoriasCompras").dataTable().fnDeleteRow("#" + id);
                            }
                        }

                        var row = table.row.add([
                            dato['inputDescripcion'],
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_compras" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-nueva-categoria-compras" data-toggle="modal" class="tip update_categorias_compras" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar">' +
                            '<i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Categoría Compra',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
});
$(function() {
    $("#listadoCategoriasCompras").on("click", "a.update_categorias_compras", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        $("#errorInputDescripcion_formCategoriaCompras").css("display", "none");
        document.getElementById("inputId_formCatCompras").value = id;
        document.getElementById("inputDescripcion_formCatCompras").value = descripcion;
    });
});
//--- BORRAR Categorias Compras ---//
$(function() {
    $("#listadoCategoriasCompras").on("click", "a.delete_categorias_compras", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        

        var id = $(this).data('id');
        //        //console.log(id);

        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'compras/eliminar_categorias_compras/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoCategoriasCompras").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Categoría Compra',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        swal(
                            'Categoría Compra',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- AGREGAR Categorias de gastos ---//
$(document).ready(function() {
    $('#btnAddCategoriaGastos').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputId_formCatGastos').val();
        var inputDescripcion = $('#inputDescripcion_formCatGastos').val();
        var val2 = true;
        var inputSubcategoria0 = $('#inputSubcategoria_formCatGastos0').val();

        if (inputSubcategoria0 == "") {
            $("#errorInputSubcategoria_formCatGastos0").css("display", "block");
            val2 = false;
        } else {
            $("#errorInputSubcategoria_formCatGastos0").css("display", "none");
        }

        for (var i = 0; i < 26; i++) {
            var arr = document.getElementsByClassName('inputSubcategoria_formCatGastos' + i);
            for (var j = 1; j < arr.length; j++) {
                ////console.log(arr[0].value);
                ////console.log('hola');
                if (arr[0].value == "") {
                    $(".field_wrapper #errorInputSubcategoria_formCatGastos" + i).css("display", "block");
                    val2 = false;
                } else {
                    $(".field_wrapper #errorInputSubcategoria_formCatGastos" + i).css("display", "none");
                }
            }
        }

        var val1;
        var formData = new FormData($("#formDatosCategoriaGastos")[0]);
        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcion_formCategoriaGastos").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcion_formCategoriaGastos").css("display", "none");
            val1 = true;
        }

        if (val1 && val2) {
            $.ajax({
                    url: URL + 'gastos/add_categorias_gastos/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    ////console.log(dato);
                    if (dato['valid']) {
                        $("#modal-nueva-categoria-gastos").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Categoría Gasto',
                            dato['msg'],
                            'success'
                        )
                        document.getElementById("inputDescripcion_formCatGastos").value = "";
                        document.getElementById("inputId_formCatGastos").value = "";
                        var table = $('#listadoCategoriasGastos').DataTable();
                        var row = table.row.add([
                            dato['inputDescripcion'],
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_gastos" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-modificar-categoria-gastos" role="button" data-toggle="modal" class="tip update_categorias_gastos" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = dato['msg'];
                        $("#popUpErrorMsg").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    swal(
                        'Categoría Gasto',
                        dato['msg'],
                        'error'
                    )
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
    $('#btnUpdateCategoriaGastos').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputIdModificar_formCatGastos').val();
        var inputDescripcion = $('#inputDescripcionModificar_formCatGastos').val();
        var inputSubcategoria0 = $('#inputSubcategoria_formCatGastos0').val();
        var val1, val2 = true;

        var formData = new FormData($("#formDatosCategoriaGastosModificar")[0]);

        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcionModificar_formCategoriaGastos").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcionModificar_formCategoriaGastos").css("display", "none");
            val1 = true;
        }

        if (inputSubcategoria0 == "") {
            $("#inputSubcategoria_formModificarCatGastos0").css("display", "block");
            val2 = false;
        } else {
            $("#inputSubcategoria_formModificarCatGastos0").css("display", "none");
            val2 = true
        }

        for (var i = 0; i < 26; i++) {
            var arr = document.getElementsByClassName('inputSubcategoria_formModificarCatGastos' + i);
            for (var j = 1; j < arr.length; j++) {
                if (arr[0].value == "") {
                    $(".field_wrapper_modificar #errorInputSubcategoria_formModificarCatGastos0" + i).css("display", "block");
                    val2 = false;
                } else {
                    $(".field_wrapper_modificar #errorInputSubcategoria_formModificarCatGastos0" + i).css("display", "none");
                    val2 = true
                }
            }
        }

        if (true) {
            $.ajax({
                    url: URL + 'gastos/update_categorias_gastos/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //////console.log(dato);
                    if (dato['valid']) {
                        $("#modal-modificar-categoria-gastos").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");

                        swal(
                            'Categoría Gasto',
                            dato['msg'],
                            'success'
                        )

                        document.getElementById("inputDescripcion_formCatGastos").value = "";
                        document.getElementById("inputId_formCatGastos").value = "";

                        $('#listadoCategoriasGastos').dataTable().fnDeleteRow("#" + id);

                        var table = $('#listadoCategoriasGastos').DataTable();

                        var row = table.row.add([
                            inputDescripcion,
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_gastos" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-modificar-categoria-gastos" role="button" data-toggle="modal" class="tip update_categorias_gastos" data-id="' + dato['id'] + '" data-descripcion="' + dato['inputDescripcion'] + '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = dato['msg'];
                        $("#popUpErrorMsg").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    swal(
                        'Categoría Gasto',
                        dato['msg'],
                        'error'
                    )
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
});
$(function() {
    $("#listadoCategoriasGastos").on("click", "a.update_categorias_gastos", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        $("#errorInputDescripcionModificar_formCategoriaGastos").css("display", "none");
        //        ////console.log(id);
        //        ////console.log(descripcion);
        document.getElementById("inputIdModificar_formCatGastos").value = id;
        document.getElementById("inputDescripcionModificar_formCatGastos").value = descripcion;
    });
});
//--- BORRAR Categorias gastos ---//
$(function() {
    $("#listadoCategoriasGastos").on("click", "a.delete_categorias_gastos", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        
        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'gastos/eliminar_categorias_gastos/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                        ////console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoCategoriasGastos").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Categoría Gasto',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        swal(
                            'Categoría Gasto',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- AGREGAR / Modificar subcategoria GASTOS ---//
$(document).ready(function() {
    $('#btnAddSubcategoriaGastos').on('click', function(event) {
        $("#modal-cargando").modal("show");
        event.preventDefault();
        var id = $('#inputId_formSubCatGastos').val();
        var inputDescripcion = $('#inputDescripcion_formSubCatGastos').val();
        var selectCategoria = $('#selectCategoriaDetalle_formSubCatGastos option:selected').text();
        var PostProducto, val1, val2;
        var formData = new FormData($("#formDatosSubcategoriaGastos")[0]);
        if (id == null || id.length == 0) {
            id = 0;
            var PostProducto = 'gastos/add_subcategorias_gastos/';
        } else {
            var PostProducto = 'gastos/update_subcategorias_gastos/';
        }

        //inputDescripcion
        if (inputDescripcion == null || inputDescripcion.length == 0) {
            $("#errorInputDescripcion_formSubcategoriaGastos").css("display", "block");
            val1 = false;
        } else {
            $("#errorInputDescripcion_formSubcategoriaGastos").css("display", "none");
            val1 = true;
        }

        //selectCategoriaDetalle
        if (selectCategoria == 'Seleccione') {
            $("#errorSelectCategoriaDetalle_formSubCatGastos").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectCategoriaDetalle_formSubCatGastos").css("display", "none");
            val2 = true;
        }

        if (val1 && val2) {
            $.ajax({
                    url: URL + PostProducto,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                    ////console.log(dato);

                    if (dato['valid']) {
                        $("#modal-nueva-subcategoria-gastos").modal("hide");
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        swal(
                            'Subcategoría Gasto',
                            dato['msg'],
                            'success'
                        )
                        document.getElementById("inputDescripcion_formSubCatGastos").value = "";
                        document.getElementById("inputId_formSubCatGastos").value = "";
                        var table = $('#listadoSubcategoriasGastos').DataTable();
                        if (PostProducto == 'gastos/update_subcategorias_gastos/') {
                            if (id != null && id.length != 0) {
                                $("#listadoSubcategoriasGastos").dataTable().fnDeleteRow("#" + id);
                            }
                        }

                        var row = table.row.add([
                            dato['inputDescripcion'],
                            selectCategoria,
                            '<a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_subcategorias_gastos" data-id="' + dato['id'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-nueva-subcategoria-gastos" data-toggle="modal" class="tip update_subcategorias_gastos" data-id="' + dato['id'] + '" data-categoria="' + dato['selectCategoria'] + '"  data-descripcion="' + dato['inputDescripcion '] + '" data-toggle="modal " data-original-title="Editar ">' +
                            '<i class="icon-pencil3"></i></a>',
                        ]).draw(false);
                        row.nodes().to$().attr('id', dato['id']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                        table.row(row).column(2).nodes().to$().addClass('text-center');
                    } else {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Subcategoría Gasto',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-exitoso").modal("hide");
                    $("#popUpError").modal("show");
                });
        } else {
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = 'Debe completar los campos obligatorios';
            $("#popUpErrorMsg").modal("show");
        }
    });
});
$(function() {
    $("#listadoSubcategoriasGastos").on("click", "a.update_subcategorias_gastos", function(e) {
        e.preventDefault();
        //        $(".update_subcategorias_gastos").unbind();
        var id = $(this).data('id');
        var descripcion = $(this).data('descripcion');
        var idVentaDetalle = $(this).data('categoria');
        $("#errorInputDescripcion_formSubcategoriaGastos").css("display", "none");
        $("#errorSelectCategoriaDetalle_formSubCatGastos").css("display", "none");
        document.getElementById("inputId_formSubCatGastos").value = id;
        document.getElementById("inputDescripcion_formSubCatGastos").value = descripcion;
        $('#selectCategoriaDetalle_formSubCatGastos').val(idVentaDetalle).trigger('change');
    });
});
//--- BORRAR Subcategoria GASTOS ---//
$(function() {
    $("#listadoSubcategoriasGastos").on("click", "a.delete_subcategorias_gastos", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        

        var id = $(this).data('id');
        //        ////console.log(id);

        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'gastos/eliminar_subcategorias_gastos/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoSubcategoriasGastos").dataTable().fnDeleteRow("#" + id);
                        swal(
                            'Subcategoría Gasto',
                            dato['msg'],
                            'success'
                        )
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        swal(
                            'Subcategoría Gasto',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});

function vaciadoCategoriasVentas() {
    $("#formDatosCategoriaVentas").trigger("reset");
    $('#selectCategoriaDetalle_formSubCatVentas').val('0').trigger('change');
    $("#errorInputDescripcion_formCategoriaVentas").css("display", "none");
}

function vaciadoCategoriasDetalleVentas() {
    $(".field_wrapper").html("");
    $('#modal-nueva-categoria-detalle-ventas').modal("show");
    $("#formDatosCategoriaDetalleVentas").trigger("reset");
    $('#selectCategoriaDetalle_formSubCatVentas').val('0').trigger('change');
    $("#errorInputDescripcion_formCategoriaDetalleVentas").css("display", "none");
    $("#errorInputSubcategoria_formCategoriaVentas0").css("display", "none");
}

function vaciadoSubcategoriasVentas() {
    $("#formDatosSubcategoriaVentas").trigger("reset");
    $('#selectCategoriaDetalle_formSubCatVentas').val('0').trigger('change');
    $("#errorSelectSubcategoria_formSubCatVentas").css("display", "none");
    $("#errorInputDescripcion_formSubcategoriaVentas").css("display", "none");
}

function vaciadoCategoriasCompras() {
    $("#formDatosCategoriaCompras").trigger("reset");
    $('#selectCategoriaDetalle_formSubCatVentas').val('0').trigger('change');
    $("#errorInputDescripcion_formCategoriaCompras").css("display", "none");
}

function vaciadoCategoriasGastos() {
    $(".field_wrapper").html("");
    $('#modal-nueva-categoria-gastos').modal("show");
    $("#formDatosCategoriaGastos").trigger("reset");
    $('#selectCategoriaDetalle_formSubCatVentas').val('0').trigger('change');
    $("#errorInputSubcategoria_formCatGastos0").css("display", "none");
    $("#errorInputDescripcion_formCategoriaGastos").css("display", "none");
}

function vaciadoSubcategoriasGastos() {
    $("#formDatosSubcategoriaGastos").trigger("reset");
    $('#selectCategoriaDetalle_formSubCatGastos').val('0').trigger('change');
    $("#errorInputDescripcion_formSubcategoriaGastos").css("display", "none");
    $("#errorSelectCategoriaDetalle_formSubCatGastos").css("display", "none");
}

function vaciadoGastosAgregar() {
    $("#formAgregarGasto").trigger("reset");
    $('#selectTipoFactura').val('0').trigger('change');
    $('#selectCatGastoGeneral').val('0').trigger('change');
    $('#selectCatGasto').val('0').trigger('change');
    $('#selectSubCatGasto').select2('data', { id: '0', text: 'Seleccionar subcategoria gasto' });
    $('#selectMedioPago2').val('0').trigger('change');
    //    document.getElementById("fileGasto").innerHTML = '';
    $("#errorselectTipoFactura").css("display", "none");
    $("#errorselectCatGastoGeneral").css("display", "none");
    $("#errorselectCatGasto").css("display", "none");
    $("#errorselectSubCatGasto").css("display", "none");
    $("#errorselectMedioPago_formAgregarGasto").css("display", "none");
    $("#errormontoGasto").css("display", "none");
    $("#errorinputFechaVtoGasto").css("display", "none");
    $('#modal-agregar-gasto').modal("show");
}

function llenadoGastosModificar(idGenGasto, ver_modificar) {
    if (idGenGasto) {
        $("#formModifcarGasto").trigger("reset");
        $('#selectTipoFactura_modificarGasto').val('0').trigger('change');
        $('#selectCatGasto_modificarGasto').val('0').trigger('change');
        $('#selectSubCatGasto_modificarGasto').select2('data', { id: '0', text: 'Seleccionar subcategoria gasto' });
        $('#selectMedioPago_modificarGasto').val('0').trigger('change');
        $("#errorselectTipoFactura_modificarGasto").css("display", "none");
        $("#errorselectCatGasto_modificarGasto").css("display", "none");
        $("#errorselectSubCatGasto_modificarGasto").css("display", "none");
        $("#errorselectMedioPago_modificarGasto").css("display", "none");
        $("#errormontoGasto_modificarGasto").css("display", "none");
        $("#errorinputFechaVtoGasto_modificarGasto").css("display", "none");
        //--- Llenado del modal ---//
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'gastos/get_gasto_idGenGasto/',
                type: 'POST',
                cache: false,
                data: {
                    idGenGasto: idGenGasto
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                ////console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    //--- seleccion de options ---//
                    $('#selectTipoFactura_modificarGasto').val(dato['gasto'][0]['idTipoFactura']).trigger('change');
                    $('#selectCatGasto_modificarGasto').val(dato['gasto'][0]['idCategoria']).trigger('change');
                    $('#selectMedioPago_modificarGasto').val(dato['gasto'][0]['idMedioPago']).trigger('change');
                    setTimeout(function() {
                        if (dato['gasto'][0]['nombreImg'] != 0) {
                            $("#iframeGasto").css("display", "block");
                            //--- Imagen ---//
                            document.getElementById("iframeGasto").src = URL + 'uploads/gastos/' + dato['gasto'][0]['nombreImg'].slice(0, -4) + '/' + dato['gasto'][0]['nombreImg'];
                        } else {
                            $("#iframeGasto").css("display", "none");
                        }
                        $('#selectSubCatGasto_modificarGasto').val(dato['gasto'][0]['idSubCategoria']).trigger('change');
                    }, 1000);
                    //--- Llenado de inputs ---//
                    $("#inputFechaGasto_modificarGasto").val(dato['gasto'][0]['fechaGasto']);
                    $("#inputFechaVtoGasto_modificarGasto").val(dato['gasto'][0]['fechaVtoGasto']);
                    $("#montoGasto_modificarGasto").val(dato['gasto'][0]['montoGasto']);
                    $("#idModificarGasto").val(dato['gasto'][0]['idGenGasto']);
                    document.getElementById("descripcionGasto_modificarGasto").innerHTML = dato['gasto'][0]['descripcionGasto'];

                    //--- Colocar campos bloqueados o no, el titulo al modal, visibilidad del input de imagen y visibilidad del boton guardar ---//
                    if (parseInt(ver_modificar) == 1) {
                        /* ver */
                        $("#descripcionGasto_modificarGasto").attr('disabled', 'disabled');
                        $("#selectTipoFactura_modificarGasto").attr('disabled', 'disabled');
                        $("#selectCatGasto_modificarGasto").attr('disabled', 'disabled');
                        $("#selectMedioPago_modificarGasto").attr('disabled', 'disabled');
                        $("#selectSubCatGasto_modificarGasto").attr('disabled', 'disabled');
                        $("#inputFechaGasto_modificarGasto").attr('disabled', 'disabled');
                        $("#inputFechaVtoGasto_modificarGasto").attr('disabled', 'disabled');
                        $("#montoGasto_modificarGasto").attr('disabled', 'disabled');
                        //--- Titulo del modal ---//
                        document.getElementById("titulo_fromMOdificarGasto").innerHTML = "Ver gasto";
                        //--- Visibilidad del boton ---//
                        $("#visiblebtnModificarGasto").css("display", "none");
                        $("#visibleRelenoModificarGasto").css("display", "block");
                        //--- visibilidad del input imagen ---//
                        $("#visiblefileGasto").css("display", "none");

                    } else if (parseInt(ver_modificar) == 2) {
                        /* Modificar */
                        $("#descripcionGasto_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#selectTipoFactura_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#selectCatGasto_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#selectMedioPago_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#selectSubCatGasto_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#inputFechaGasto_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#inputFechaVtoGasto_modificarGasto").removeAttr('disabled', 'disabled');
                        $("#montoGasto_modificarGasto").removeAttr('disabled', 'disabled');
                        //--- Titulo del modal ---//
                        document.getElementById("titulo_fromMOdificarGasto").innerHTML = "Modificar gasto";
                        //--- Visibilidad del boton ---//
                        $("#visiblebtnModificarGasto").css("display", "block");
                        $("#visibleRelenoModificarGasto").css("display", "none");
                        //--- visibilidad del input imagen ---//
                        $("#visiblefileGasto").css("display", "block");

                    }

                    $('#modal-modificar-gasto').modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    document.getElementById("msgError").innerHTML = "El gasto correspondiente no se obtuvo de forma correcta";
                    $("#popUpErrorMsg").modal("show");
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");
            });
    } else {
        document.getElementById("msgError").innerHTML = "idGenGasto no se obtuvo de forma correcta";
        $("#popUpErrorMsg").modal("show");
    }
}

//--- BORRAR PROVEEDOR ---//
$(function() {
    $("#listadoProductos").on("click", "a.delete_producto", function(e) {
        e.preventDefault();
        $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks        

        var id = $(this).data('id');
        $('.button-delete-si').click(function(e) {
            e.preventDefault();
            $("#modal-delete").modal("hide");
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'productos/eliminar_producto/',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    ////console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("hide");
                        $("#listadoProductos").dataTable().fnDeleteRow("#" + id);
                        $("#eliminacion-exitosa").modal("show");
                    } else {
                        $("#modal-cargando").modal("hide");
                        $("#eliminacion-exitosa").modal("hide");
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function(data) {
                    $("#modal-cargando").modal("hide");
                    $("#eliminacion-exitosa").modal("hide");
                    $("#popUpError").modal("show");
                });
        });
    });
});
//--- CONTAR CARACTERES ---//
(function($) {
    $.fn.limitar = function(options) {
        defaults = {
            limite: 200,
            id_counter: false,
            clase_alert: false
        }
        var options = $.extend(defaults, options);
        return this.each(function() {
            var caracteres = options.limite;
            if (options.id_counter != false) {
                $("#" + options.id_counter).html("Te quedan <strong>" + caracteres + "</strong> caracteres.");
            }
            $(this).keyup(function() {
                if ($(this).val().length > caracteres) {
                    $(this).val($(this).val().substr(0, caracteres));
                }
                if (options.id_counter != false) {
                    var quedan = caracteres - $(this).val().length;
                    $("#" + options.id_counter).html("Te quedan <strong>" + quedan + "</strong> caracteres");
                    if (quedan <= 10) {
                        $("#" + options.id_counter).addClass(options.clase_alert);
                    } else {
                        $("#" + options.id_counter).removeClass(options.clase_alert);
                    }
                }
            });
        });
    };
})(jQuery);
$(document).ready(function() {
    $("#descripcionBreve").limitar({
        limite: 140,
        id_counter: "counter",
        clase_alert: "alert"
    });
});

//--- Categoria Detalle Venta ---//
$(document).ready(function() {
    var x = 0; // Iniciamos el contador a 1
    var maxField = 25; // Numero maximo de campos
    var addButton = $('.add_categoria_venta_detalle'); // Selector del boton de Insertar
    var wrapper = $('.field_wrapper'); // Contenedor de campos
    //var fieldHTML = '<div class="form-group"><label class="col-sm-2 control-label"><span>Direccion:'+x+'</span></label><div class="col-sm-10"><input type="text" name="direccion[]" id="direccion" class="form-control" ><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="icon-remove"></a><div id="errorDireccion" class="btn-danger" style="display: none">*Ingrese una direccion v&aacute;lida.</div></div></div>'; //New input field html 
    //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 

    $(addButton).click(function() { // Una vez que se haga clic en el boton
        if (x < maxField) { //Comprobamos el maximo
            x++; //Increment field counter

            var fieldHTML = '<div id="delete_wrapper_' + x + '">' +
                '<div class="field_wrapper" class="col-md-6">' +
                '<div class="col-md-10">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" for="inputSubcategoria_formCatVentas' + x + '">' +
                '<a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">' +
                '<i class="fas fa-question-circle"></i>' +
                '</a>' +
                '<span style="color: red;"> * </span>' +
                'Subcategoría' +
                '</label>' +
                '<input name="inputSubcategoria_formCatVentas' + x + '" id="inputSubcategoria_formCatVentas' + x + '" data-minlength="2" maxlength="25" type="text" class="form-control inputSubcategoria_formCatVentas' + x + '">' +
                '<div id="errorInputSubcategoria_formCategoriaVentas' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                '* Debe completar el campo' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2" style="padding:0px;">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                '<a onclick="borrar_categoria_venta_detalle(' + x + ')" class="remove_categoria_venta" title="Remove field"><i class="icon-remove"></i></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(wrapper).append(fieldHTML); // Añadimos el HTML
        }
    });
});

//--- Categoria Gasto ---//
$(document).ready(function() {
    var x = 0; // Iniciamos el contador a 1
    var maxField = 25; // Numero maximo de campos
    var addButton = $('.add_categoria_gasto'); // Selector del boton de Insertar
    var wrapper = $('.field_wrapper'); // Contenedor de campos
    //var fieldHTML = '<div class="form-group"><label class="col-sm-2 control-label"><span>Direccion:'+x+'</span></label><div class="col-sm-10"><input type="text" name="direccion[]" id="direccion" class="form-control" ><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="icon-remove"></a><div id="errorDireccion" class="btn-danger" style="display: none">*Ingrese una direccion v&aacute;lida.</div></div></div>'; //New input field html 
    //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 

    $(addButton).click(function() { // Una vez que se haga clic en el boton
        if (x < maxField) { //Comprobamos el maximo
            x++; //Increment field counter

            var fieldHTML = '<div id="delete_wrapper_' + x + '">' +
                '<div class="field_wrapper" class="col-md-6">' +
                '<div class="col-md-10">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" for="inputSubcategoria_formCatGastos' + x + '">' +
                '<a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">' +
                '<i class="fas fa-question-circle"></i>' +
                '</a>' +
                '<span style="color: red;"> * </span>' +
                'Subcategoría' +
                '</label>' +
                '<input name="inputSubcategoria_formCatGastos' + x + '" id="inputSubcategoria_formCatGastos' + x + '" data-minlength="2" maxlength="25" type="text" class="form-control inputSubcategoria_formCatGastos' + x + '">' +
                '<div id="errorInputSubcategoria_formCatGastos' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                '* Debe completar el campo' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2" style="padding:0px;">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                '<a onclick="borrar_categoria_gasto(' + x + ')" class="remove_categoria_gasto" title="Remove field"><i class="icon-remove"></i></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(wrapper).append(fieldHTML); // Añadimos el HTML
        }
    });
});

//--- Categoria Gasto Modificar ---//
$(document).ready(function() {
    // Iniciamos el contador a 1
    var maxField = 25; // Numero maximo de campos
    var addButton = $('.add_categoria_gasto_modificar'); // Selector del boton de Insertar
    var wrapper = $('.field_wrapper_modificar'); // Contenedor de campos
    //var fieldHTML = '<div class="form-group"><label class="col-sm-2 control-label"><span>Direccion:'+x+'</span></label><div class="col-sm-10"><input type="text" name="direccion[]" id="direccion" class="form-control" ><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="icon-remove"></a><div id="errorDireccion" class="btn-danger" style="display: none">*Ingrese una direccion v&aacute;lida.</div></div></div>'; //New input field html 
    //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 

    $(addButton).click(function() { // Una vez que se haga clic en el boton
        var x = parseInt($('#ultima_subcategoriagasto').val());
        if (x < maxField) { //Comprobamos el maximo
            x++; //Increment field counter

            var fieldHTML = '<div id="delete_wrapper_' + x + '">' +
                '<div class="field_wrapper" class="col-md-6">' +
                '<div class="col-md-10">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" for="inputSubcategoria_formModificarCatGastos' + x + '">' +
                '<a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">' +
                '<i class="fas fa-question-circle"></i>' +
                '</a>' +
                '<span style="color: red;"> * </span>' +
                'Subcategoría' +
                '</label>' +
                '<input name="inputSubcategoria_formModificarCatGastos' + x + '" id="inputSubcategoria_formModificarCatGastos' + x + '" data-minlength="2" maxlength="25" type="text" class="form-control inputSubcategoria_formCatGastos' + x + '">' +
                '<input name="idSubcategoria_formModificarCatGastos' + x + '" id="idSubcategoria_formModificarCatGastos' + x + '" type="hidden">' +
                '<div id="errorInputSubcategoria_formModificarCatGastos' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                '* Debe completar el campo' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2" style="padding:0px;">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                '<a onclick="borrar_categoria_gasto_modificar(' + x + ')" class="remove_categoria_gasto" title="Remove field"><i class="icon-remove"></i></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(wrapper).append(fieldHTML); // Añadimos el HTML
            document.getElementById('ultima_subcategoriagasto').value = x;
        }
    });
});

//--- Categoria Gasto Modificar ---//
$(document).ready(function() {
    // Iniciamos el contador a 1
    var maxField = 25; // Numero maximo de campos
    var addButton = $('.add_categoria_venta_modificar'); // Selector del boton de Insertar
    var wrapper = $('.field_wrapper_modificarCatVenta'); // Contenedor de campos
    //var fieldHTML = '<div class="form-group"><label class="col-sm-2 control-label"><span>Direccion:'+x+'</span></label><div class="col-sm-10"><input type="text" name="direccion[]" id="direccion" class="form-control" ><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="icon-remove"></a><div id="errorDireccion" class="btn-danger" style="display: none">*Ingrese una direccion v&aacute;lida.</div></div></div>'; //New input field html 
    //var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 

    $(addButton).click(function() { // Una vez que se haga clic en el boton
        var x = parseInt($('#ultima_subcategoriaventa').val());
        if (x < maxField) { //Comprobamos el maximo
            x++; //Increment field counter

            var fieldHTML = '<div id="delete_wrapper_' + x + '">' +
                '<div class="field_wrapper" class="col-md-6">' +
                '<div class="col-md-10">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" for="inputSubcategoria_formCatModificarVentas' + x + '">' +
                '<a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">' +
                '<i class="fas fa-question-circle"></i>' +
                '</a>' +
                '<span style="color: red;"> * </span>' +
                'Subcategoría' +
                '</label>' +
                '<input name="inputSubcategoria_formCatModificarVentas' + x + '" id="inputSubcategoria_formCatModificarVentas' + x + '" data-minlength="2" maxlength="25" type="text" class="form-control inputSubcategoria_formCatGastos' + x + '">' +
                '<input name="idSubcategoria_formCatModificarVentas' + x + '" id="idSubcategoria_formCatModificarVentas' + x + '" type="hidden">' +
                '<div id="errorInputSubcategoria_formCatModificarVentas' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                '* Debe completar el campo' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2" style="padding:0px;">' +
                '<div class="form-group label-floating has-feedback">' +
                '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                '<a onclick="borrar_categoria_gasto_modificar(' + x + ')" class="remove_categoria_gasto" title="Remove field"><i class="icon-remove"></i></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(wrapper).append(fieldHTML); // Añadimos el HTML
            document.getElementById('ultima_subcategoriaventa').value = x;
        }
    });
});

function borrar_categoria_venta_detalle(x) {
    var id = x;
    $('#delete_wrapper_' + id).remove(); //Eliminamos el div
}

function borrar_categoria_gasto(x) {
    var id = x;
    $('#delete_wrapper_' + id).remove(); //Eliminamos el div
}

function borrar_categoria_gasto_modificar(x) {
    var id = x;
    $('#delete_wrapper_' + id).remove(); //Eliminamos el div
}

function llenadoModalEditarGasto(idCategoriaGasto) {

    $.ajax({
            url: URL + 'gastos/get_categoria_subcategoria_gasto/',
            type: 'POST',
            data: { idCategoriaGasto: idCategoriaGasto }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                document.getElementById('inputIdModificar_formCatGastos').value = idCategoriaGasto;
                document.getElementById('inputDescripcionModificar_formCatGastos').value = dato['categoria_gasto'][0]['descripcion'];
                var wrapper = $('.field_wrapper_modificar');
                wrapper.empty();
                var x = 0;
                dato['subcategorias_gasto'].forEach(function(element) {
                    if (x == 0) {
                        document.getElementById('inputSubcategoria_formModificarCatGastos0').value = element['descripcion'];
                        document.getElementById('idSubcategoria_formModificarCatGastos0').value = element['idSubCatGasto'];
                    } else {
                        //console.log("GOLA");
                        var fieldHTML = '<div id="delete_wrapper_' + x + '">' +
                            '<div class="field_wrapper" class="col-md-6">' +
                            '<div class="col-md-10">' +
                            '<div class="form-group label-floating has-feedback">' +
                            '<label class="control-label" for="inputSubcategoria_formModificarCatGastos' + x + '">' +
                            '<a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">' +
                            '<i class="fas fa-question-circle"></i>' +
                            '</a>' +
                            '<span style="color: red;"> * </span>' +
                            'Subcategoría' +
                            '</label>' +
                            '<input name="inputSubcategoria_formModificarCatGastos' + x + '" id="inputSubcategoria_formModificarCatGastos' + x + '" data-minlength="2" maxlength="25" type="text" class="form-control inputSubcategoria_formCatGastos' + x + '" value="' + element['descripcion'] + '">' +
                            '<input name="idSubcategoria_formModificarCatGastos' + x + '" id="idSubcategoria_formModificarCatGastos' + x + '" type="hidden" value="' + element['idSubCatGasto'] + '">' +
                            '<div id="errorInputSubcategoria_formModificarCatGastos' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                            '* Debe completar el campo' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-2" style="padding:0px;">' +
                            '<div class="form-group label-floating has-feedback">' +
                            '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                            '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                            '<a onclick="borrar_categoria_gasto(' + x + ')" class="remove_categoria_gasto" title="Remove field"><i class="icon-remove"></i></i></a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $(wrapper).append(fieldHTML);
                    }
                    x += 1;
                });
                document.getElementById('ultima_subcategoriagasto').value = x;
            } else {
                $("#modal-cargando").modal("hide");

            }
        })
        .fail(function(data) {});

    $("#modal-modificar-categoria-gastos").modal("show");
}

function llenadoModalEditarCategoriaVenta(idCategoriaVenta) {

    $.ajax({
            url: URL + 'ventas/get_categoria_subcategoria_venta/',
            type: 'POST',
            data: { idCategoriaVenta: idCategoriaVenta }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                document.getElementById('inputIdModificar_formCatVentas').value = idCategoriaVenta;
                document.getElementById('inputDescripcionModificar_formCatVentas').value = dato['categoria_venta'][0]['descripcion'];
                var wrapper = $('.field_wrapper_modificarCatVenta');
                wrapper.empty();
                var x = 0;
                dato['subcategorias_venta'].forEach(function(element) {
                    if (x == 0) {
                        document.getElementById('inputSubcategoria_formCatModificarVentas0').value = element['descripcion'];
                        document.getElementById('idSubcategoria_formCatModificarVentas0').value = element['idSubcategoriaVenta'];
                    } else {
                        var fieldHTML = '<div id="delete_wrapper_' + x + '">' +
                            '<div class="field_wrapper" class="col-md-6">' +
                            '<div class="col-md-10">' +
                            '<div class="form-group label-floating has-feedback">' +
                            '<label class="control-label" for="inputSubcategoria_formCatModificarVentas' + x + '">' +
                            '<a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">' +
                            '<i class="fas fa-question-circle"></i>' +
                            '</a>' +
                            '<span style="color: red;"> * </span>' +
                            'Subcategoría' +
                            '</label>' +
                            '<input name="inputSubcategoria_formCatModificarVentas' + x + '" id="inputSubcategoria_formCatModificarVentas' + x + '" data-minlength="2" maxlength="25" type="text" class="form-control inputSubcategoria_formCatModificarVentas' + x + '" value="' + element['descripcion'] + '">' +
                            '<input name="idSubcategoria_formCatModificarVentas' + x + '" id="idSubcategoria_formCatModificarVentas' + x + '" type="hidden" value="' + element['idSubcategoriaVenta'] + '">' +
                            '<div id="errorInputSubcategoria_formModificarCatVentas' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                            '* Debe completar el campo' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-2" style="padding:0px;">' +
                            '<div class="form-group label-floating has-feedback">' +
                            '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                            '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                            '<a onclick="borrar_categoria_gasto(' + x + ')" class="remove_categoria_gasto" title="Remove field"><i class="icon-remove"></i></i></a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $(wrapper).append(fieldHTML);
                    }
                    x++;
                });
                document.getElementById('ultima_subcategoriaventa').value = x;
            } else {
                $("#modal-cargando").modal("hide");

            }
        })
        .fail(function(data) {});

    $("#modal-modificar-categoria-detalle-ventas").modal("show");
}

//--- Movimientos Tesoreria ---//
function filtroMovimientosTesoreria() {
    $("#modal-cargando").modal("show");
    var fechaDesde = $('#fechaDesdeMovTesoreria').val();
    var fechaHasta = $('#fechaHastaMovTesoreria').val();
    document.getElementById("boxFechaDesde").innerHTML = fechaDesde;
    document.getElementById("boxFechaHasta").innerHTML = fechaHasta;
    $.ajax({
            url: URL + 'tesoreria/get_movimientos_by_fecha/',
            type: 'POST',
            data: { fechaDesde: fechaDesde, fechaHasta: fechaHasta }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {

                $("#modal-cargando").modal("hide");
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}
//--- Movimientos Caja ---//
function filtroMovimientosCaja() {
    $("#modal-cargando").modal("show");
    var selectMedioCajaFiltro = $('#selectMedioCajaFiltro').val();
    var fechaDesde = $('#fechaDesdeMovCaja').val();
    var fechaHasta = $('#fechaHastaMovCaja').val();
    var val1, val2, val3;
    //    document.getElementById("boxFechaDesde").innerHTML = fechaDesde;
    //    document.getElementById("boxFechaHasta").innerHTML = fechaHasta;

    if (selectMedioCajaFiltro == 0) {
        $("#errorselectMedioCajaFiltro").css("display", "block");
        val1 = false;
    } else {
        $("#errorselectMedioCajaFiltro").css("display", "none");
        val1 = true;
    }
    if (fechaDesde == 0 || fechaDesde.length == 0 || fechaDesde == ' ' || fechaDesde == '') {
        $("#errorfechaDesdeMovCaja").css("display", "block");
        val2 = false;
    } else {
        $("#errorfechaDesdeMovCaja").css("display", "none");
        val2 = true;
    }
    if (fechaHasta == 0 || fechaHasta.length == 0 || fechaHasta == ' ' || fechaHasta == '') {
        $("#errorfechaHastaMovCaja").css("display", "block");
        val3 = false;
    } else {
        $("#errorfechaHastaMovCaja").css("display", "none");
        val3 = true;
    }
    if (val1 && val2 && val3) {

        tableListadoMovimientosCaja.clear();
        tableListadoMovimientosCaja.draw();
        tableListadoMovimientosCaja.destroy();
        tableListadoMovimientosCaja = $('#listadoMovimientosCaja').DataTable({
            "paging": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
        $.ajax({
                url: URL + 'tesoreria/get_movimientos_caja_by_fecha/',
                type: 'POST',
                data: { fechaDesde: fechaDesde, fechaHasta: fechaHasta, selectMedioCajaFiltro: selectMedioCajaFiltro }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    if (dato['movimientosCaja'].length != 0) {
                        document.getElementById("boxFechaDesde").innerHTML = fechaDesde;
                        document.getElementById("boxFechaHasta").innerHTML = fechaHasta;
                        document.getElementById("boxSaldo").innerHTML = "$" + number_format(dato['saldo'], 2);
                        document.getElementById("boxResultados").innerHTML = dato['resultados'];
                        dato['movimientosCaja'].forEach(function(element) {
                            var ingreso = "$" + number_format(element['ingreso'], 2);
                            var egreso = "$" + number_format(element['egreso'], 2);
                            var row = tableListadoMovimientosCaja.row.add([
                                ingreso,
                                egreso,
                                element['fechaAlta'],
                            ]).draw(true);
                            row.nodes().to$().attr('id', element['IdIngEgr']);
                        });
                        $("#modal-cargando").modal("hide");
                    } else {
                        $("#modal-cargando").modal("hide");
                        document.getElementById("msgError").innerHTML = "No hay movimientos";
                        $("#popUpErrorMsg").modal("show");
                    }
                } else {
                    $("#modal-cargando").modal("hide");
                    document.getElementById("msgError").innerHTML = dato['msg'];
                    $("#modal-exitoso").modal("hide");
                    $("#popUpErrorMsg").modal("show");
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#modal-exitoso").modal("hide");
                $("#popUpError").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
    }
}


function resetFormUsuario() {
    $("#modal-cargando").modal("hide");
    document.getElementById("form-agregar-usuario").reset();
    //--- Vaciado de campos ---//
    document.getElementById('nombrePersona').value = "";
    document.getElementById('apellidoPersona').value = "";
    document.getElementById('telefonoPersona').value = "";
    document.getElementById('emailPersona').value = "";
    document.getElementById('nombreUsuarioPersona').value = "";
    document.getElementById('passwordPersona').value = "";
    //--- Quitar Errores ---//
    $("#errorNombrePersona").css("display", "none");
    $("#errorApellidoPersona").css("display", "none");
    $("#errorTelefonoPersona").css("display", "none");
    $("#errorEmailPersona").css("display", "none");
    $("#errorUsuarioPersona").css("display", "none");
    $("#errorPass").css("display", "none");
    $("#errorNivelPersona").css("display", "none");
    //--- Sacar selecciones ---//
    $('#selectProvincia').val(0).trigger('change');
    $('#selectLocalidad').val(0).trigger('change');
    $('#selectNivelUsuarioAgregar').val(0).trigger('change');
    $('#selectMenuUsuarioAdminAgregar').val(0).trigger('change');
}

function resetFormMenuAdmin() {
    //--- Vaciado de campos ---//
    document.getElementById('posicionMenuAdminAgregar').value = "";
    document.getElementById('subItemAgregar').value = "";
    document.getElementById('nombreMenuAdminAgregar').value = "";
    document.getElementById('nombreIconoAgregar').value = "";
    document.getElementById('nombreLinkAgregar').value = "";
    //--- Quitar Errores ---//
    $("#errorPosicionMenuAdmin").css("display", "none");
    $("#errorTipoInterna").css("display", "none");
    $("#errorSubItemAdd").css("display", "none");
    $("#errorNombreMenuAdmin").css("display", "none");
    $("#errorIcono").css("display", "none");
    $("#errorLink").css("display", "none");
    //--- Sacar selecciones ---//
    $('#selectTipoInternaAgregar').val(0).trigger('change');
    $('#selectNivelMenuAdminAgregar').val(0).trigger('change');
}

// --------------- MENU -------------------
$(document).ready(function() {
    $("#listadoMenuAdmin").on("click", "a.deleteMenuAdmin", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var dataString = 'id=' + id;
        $(".button-delete-si").unbind();
        $('.button-delete-si').click(function(e) {

            $("#modal-cargando").modal("show");
            $("#modal-delete").modal("show");
            $.ajax({
                type: "POST",
                url: URL + "menu_admin/eliminar_menu_admin",
                data: dataString,
                success: function(data) {
                    data = JSON.parse(data)

                    if (data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-delete").modal("hide");
                        swal(
                            'Menú',
                            data['msg'],
                            'success'
                        )

                        idMenu = data['id'];
                        if (idMenu != null && idMenu.length != 0) {
                            $("#listadoMenuAdmin").dataTable().fnDeleteRow("#" + idMenu);
                        }
                    } else {
                        $("#modal-delete").modal("hide");
                        swal(
                            'Menú',
                            data['msg'],
                            'error'
                        )
                    }
                },
                error: function() {
                    $("#popUpError").modal("show");
                }
            });
        });
    });
    $("#agregarMenuAdmin").click(function(e) {
        e.preventDefault();
        $("#modal-add-menuAdmin").modal("show");
    });
    //agregar menu btn
    $('#agregarMenuAdminBTN').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var val3;
        var val4;
        var val5;
        var val6;
        var val7;
        var val8;
        var nombre = $('#nombreMenuAdminAgregar').val();
        var posicion = $('#posicionMenuAdminAgregar').val();
        var icono = $('#nombreIconoAgregar').val();
        var link = $('#nombreLinkAgregar').val();
        var nivel = $('#selectNivelMenuAdminAgregar').val();
        var color = $('#colorAgregar').val();
        var tipoInterna = $('#selectTipoInternaAgregar').val();
        var subItem = $('#subItemAgregar').val();
        var arrayNivel = JSON.stringify(nivel);
        //console.log(arrayNivel);
        if (nombre == null || nombre.length == 0 || nombre == '') {
            $("#errorNombreMenuAdmin").css("display", "block");
            val1 = false;
        } else {
            $("#errorNombreMenuAdmin").css("display", "none");
            val1 = true;
        }
        if (posicion == null || posicion.length == 0 || posicion == '') {
            $("#errorPosicionMenuAdmin").css("display", "block");
            val2 = false;
        } else {
            $("#errorPosicionMenuAdmin").css("display", "none");
            val2 = true;
        }
        if (icono == null || icono.length == 0 || icono == '') {
            $("#errorIcono").css("display", "block");
            val3 = false;
        } else {
            $("#errorIcono").css("display", "none");
            val3 = true;
        }

        if (link == null || link.length == 0 || link == '') {
            $("#errorLink").css("display", "block");
            val4 = false;
        } else {
            $("#errorLink").css("display", "none");
            val4 = true;
        }

        if (nivel == null || nivel.length == 0 || nivel == '') {
            $("#errorNivel").css("display", "block");
            val5 = false;
        } else {
            $("#errorNivel").css("display", "none");
            val5 = true;
        }

        if (color == null || color.length == 0 || color == '') {
            $("#errorColor").css("display", "block");
            val6 = false;
        } else {
            $("#errorColor").css("display", "none");
            val6 = true;
        }

        if (tipoInterna == null || tipoInterna.length == 0 || tipoInterna == '') {
            $("#errorTipoInterna").css("display", "block");
            val7 = false;
        } else {
            $("#errorTipoInterna").css("display", "none");
            val7 = true;
        }

        if (subItem == null || subItem.length == 0 || subItem == '') {
            $("#errorSubItemAdd").css("display", "block");
            val8 = false;
        } else {
            $("#errorSubItemAdd").css("display", "none");
            val8 = true;
        }


        if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8) {

            $("#modal-cargando").modal("show");
            var formData = new FormData($("#form-add-menuAdmin")[0]);
            $.ajax({
                    url: URL + 'menu_admin/add_menu_admin_post/',
                    type: 'POST',
                    data: {
                        nombre: nombre,
                        posicion: posicion,
                        icono: icono,
                        link: link,
                        nivel: arrayNivel,
                        color: color,
                        tipoInterna: tipoInterna,
                        subItem: subItem
                    },
                    //                    necesario para subir archivos via ajax
                    cache: false,
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //                        //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-add-menuAdmin").modal("hide");
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Menú',
                            dato['msg'],
                            'success'
                        )

                        //--- AGREGO FILA ---//
                        var table = $('#listadoMenuAdmin').DataTable();

                        var options = "";
                        dato['menuNivel'][dato['menuNivel'].length - 1].forEach(element => options += '<option value="' + element['idNivel'] + '">' + element['nombreNivel'] + '</option>');

                        var selectNivelMenu = '<select class="select-full" style="text-transform:uppercase;width: 100%;">' +
                            options +
                            '</select>';

                        var acciones = '<a href="#" class="tip modificarMenuAdmin" data-id="' + dato['menuAdmin'][dato['menuAdmin'].length - 1]['idMenu'] + '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-delete" class="tip deleteMenuAdmin" role="button" data-id="' + dato['menuAdmin'][dato['menuAdmin'].length - 1]['idMenu'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>';

                        var row = table.row.add([
                            dato['menuAdmin'][dato['menuAdmin'].length - 1]['posicion'],
                            dato['menuAdmin'][dato['menuAdmin'].length - 1]['nombre'],
                            "Nivel " + dato['menuAdmin'][dato['menuAdmin'].length - 1]['idTipoInterna'],
                            dato['menuAdmin'][dato['menuAdmin'].length - 1]['idSubItem'],
                            selectNivelMenu,
                            acciones,
                        ]).draw(false);

                        row.nodes().to$().attr('id', dato['menuAdmin'][dato['menuAdmin'].length - 1]['idMenu']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                        table.row(row).column(2).nodes().to$().addClass('text-center');
                        table.row(row).column(3).nodes().to$().addClass('text-center');
                        table.row(row).column(4).nodes().to$().addClass('text-center');
                        table.row(row).column(5).nodes().to$().addClass('text-center');

                    } else {
                        swal(
                            'Menú',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
    //-- Search Multiselectvpara modificar --//
    $(function() {
        $('#selectNivelMenuAdminModificar').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder: 'Buscar nivel...'
        });
    });
    //-- Search Multiselect para agregar --//
    $(function() {
        $('#selectNivelMenuAdminAgregar').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder: 'Buscar nivel...'
        });
    });
    //-- Search Multiselect para modificar --//
    $(function() {
        $('#selectMenuUsuarioAdmin').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder: 'Buscar nivel...'
        });
    });
    //-- Search Multiselect para agregar --//
    $(function() {
        $('#selectMenuUsuarioAdminAgregar').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder: 'Buscar nivel...'
        });
    });
    //modificar menu admin
    $("#listadoMenuAdmin").on("click", "a.modificarMenuAdmin", function(e) {

        $("#modal-cargando").modal("show");
        var idMenuAdmin = $(this).data('id');
        //console.log(idMenuAdmin);
        var dataString = 'id=' + idMenuAdmin;
        //console.log(dataString);
        $("#form-modificar-menuAdmin").trigger('reset');
        document.getElementById("idMenuModificar").value = idMenuAdmin;
        $.ajax({
                url: URL + 'menu_admin/get_menuAdmin_byId/',
                type: 'POST',
                data: dataString

            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log('este es el dato: ');
                //console.log(dato);
                if (dato['valid']) {

                    var nivelesSeleccionados = [];
                    for (var i = 0; i < dato['menuAdminNivelUsuario'].length; i++) {
                        nivelesSeleccionados.push(dato['menuAdminNivelUsuario'][i]['idNivel']);
                    }


                    $("#selectTipoInternaModificar").val(dato['menuAdminModificar'][0]['idTipoInterna']).trigger('change');
                    $('#selectNivelMenuAdminModificar').multiselect('select', nivelesSeleccionados);
                    document.getElementById("colorMenuAdminModificar").value = dato['menuAdminModificar'][0]['color'];
                    document.getElementById("linkMenuAdminModificar").value = dato['menuAdminModificar'][0]['link'];
                    document.getElementById("iconoMenuAdminModificar").value = dato['menuAdminModificar'][0]['icono'];
                    document.getElementById("posicionMenuModificar").value = dato['menuAdminModificar'][0]['posicion'];
                    document.getElementById("nombreMenuAdminModificar").value = dato['menuAdminModificar'][0]['nombre'];
                    document.getElementById("idNivelGen").value = dato['menuAdminModificar'][0]['idNivelGen'];
                    document.getElementById("subItemModificar").value = dato['menuAdminModificar'][0]['idSubItem'];
                    $("#modal-cargando").modal("hide");
                    $("#modal-editar-menuAdmin").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }
            })
            .fail(function() {
                $("#modal-cargando").modal("hide");
                $("#popUpError").modal("show");
            });
    });
    $('#modificarMenuAdminBTN').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var val3;
        var val4;
        var val5;
        var val6;
        var val7;
        var val8;
        var val9;
        var val10;
        var nivel = $('#selectNivelMenuAdminModificar').val();
        var nombre = $('#nombreMenuAdminModificar').val();
        var color = $('#colorMenuAdminModificar').val();
        var link = $('#linkMenuAdminModificar').val();
        var posicion = $('#posicionMenuModificar').val();
        var icono = $('#iconoMenuAdminModificar').val();
        var idMenuAdmin = $('#idMenuModificar').val();
        var idNivelGen = $('#idNivelGen').val();
        var tipoInterna = $('#selectTipoInternaModificar').val();
        var subItem = $('#subItemModificar').val();
        var arrayNivel = JSON.stringify(nivel);
        if (idMenuAdmin == 0) {
            $("#errorId").css("display", "block");
            val1 = false;
        } else {
            $("#errorId").css("display", "none");
            val1 = true;
        }
        if (nivel == null || nivel.length == 0 || nivel == '') {
            $("#errorNivel").css("display", "block");
            val2 = false;
        } else {
            $("#errorNivel").css("display", "none");
            val2 = true;
        }
        if (nombre == null || nombre.length == 0 || nombre == '') {
            $("#errorNombreMenuUsuario").css("display", "block");
            val3 = false;
        } else {
            $("#errorNombreMenuUsuario").css("display", "none");
            val3 = true;
        }

        if (color == null || color.length == 0 || color == '') {
            $("#errorColor").css("display", "block");
            val4 = false;
        } else {
            $("#errorColor").css("display", "none");
            val4 = true;
        }

        if (link == null || link.length == 0 || link == '') {
            $("#errorLinkMenuAdmin").css("display", "block");
            val5 = false;
        } else {
            $("#errorLinkMenuAdmin").css("display", "none");
            val5 = true;
        }

        if (posicion == null || posicion.length == 0 || posicion == '') {
            $("#errorPosicionMenuAdminModificar").css("display", "block");
            val6 = false;
        } else {
            $("#errorPosicionMenuAdminModificar").css("display", "none");
            val6 = true;
        }

        if (icono == null || icono.length == 0 || icono == '') {
            $("#errorIconoMenuAdmin").css("display", "block");
            val7 = false;
        } else {
            $("#errorIconoMenuAdmin").css("display", "none");
            val7 = true;
        }

        if (idNivelGen == null || idNivelGen.length == 0 || idNivelGen == '') {
            $("#errorId").css("display", "block");
            val8 = false;
        } else {
            $("#errorId").css("display", "none");
            val8 = true;
        }

        if (tipoInterna == null || tipoInterna.length == 0 || tipoInterna == '') {
            $("#errorTipoInterna").css("display", "block");
            val9 = false;
        } else {
            $("#errorTipoInterna").css("display", "none");
            val9 = true;
        }

        if (subItem == null || subItem.length == 0 || subItem == '') {
            $("#errorSubItemMod").css("display", "block");
            val10 = false;
        } else {
            $("#errorSubItemMod").css("display", "none");
            val10 = true;
        }


        if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9 && val10) {

            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'menu_admin/modificar_menuAdmin_post',
                    type: 'POST',
                    data: {
                        idMenuAdmin: idMenuAdmin,
                        nivel: arrayNivel,
                        nombre: nombre,
                        color: color,
                        link: link,
                        posicion: posicion,
                        icono: icono,
                        idNivelGen: idNivelGen,
                        tipoInterna: tipoInterna,
                        subItem: subItem
                    },
                    cache: false

                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        $("#modal-editar-menuAdmin").modal("hide");
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Menú',
                            dato['msg'],
                            'success'
                        )

                        //--- modificacion de registro en el datatable ---//
                        idMenuModificar = $('#idMenuModificar').val();
                        if (idMenuModificar != null && idMenuModificar.length != 0) {
                            $("#listadoMenuAdmin").dataTable().fnDeleteRow("#" + idMenuModificar);
                        }

                        var table = $('#listadoMenuAdmin').DataTable();

                        var options = "";
                        dato['menuNivel'][dato['menuNivel'].length - 1].forEach(element => options += '<option value="' + element['idNivel'] + '">' + element['nombreNivel'] + '</option>');

                        var selectNivelMenu = '<select class="select-full" style="text-transform:uppercase;width: 100%;">' +
                            options +
                            '</select>';

                        var acciones = '<a href="#" class="tip modificarMenuAdmin" data-id="' + dato['menuAdmin'][0]['idMenu'] + '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>' +
                            '&nbsp;' +
                            '<a href="#modal-delete" class="tip deleteMenuAdmin" role="button" data-id="' + dato['menuAdmin'][0]['idMenu'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>';

                        var row = table.row.add([
                            dato['menuAdmin'][0]['posicion'],
                            dato['menuAdmin'][0]['nombre'],
                            "Nivel " + dato['menuAdmin'][0]['idTipoInterna'],
                            dato['menuAdmin'][0]['idSubItem'],
                            selectNivelMenu,
                            acciones,
                        ]).draw(false);

                        row.nodes().to$().attr('id', dato['menuAdmin'][0]['idMenu']);
                        table.row(row).column(0).nodes().to$().addClass('text-center');
                        table.row(row).column(1).nodes().to$().addClass('text-center');
                        table.row(row).column(2).nodes().to$().addClass('text-center');
                        table.row(row).column(3).nodes().to$().addClass('text-center');
                        table.row(row).column(4).nodes().to$().addClass('text-center');
                        table.row(row).column(5).nodes().to$().addClass('text-center');

                    } else {
                        $("#modal-cargando").modal("show");
                        $("#modal-editar-menuAdmin").modal("hide");
                        swal(
                            'Menú',
                            dato['msg'],
                            'error'
                        )
                    }
                })
                .fail(function() {
                    $("#modal-cargando").modal("show");
                    $("#modal-editar-menuAdmin").modal("hide");
                    $("#popUpError").modal("show");
                });
        }
    });
    //------------Usuarios ----------------//

    //listar usuarios
    $("#listadoUsuarios").on("click", "a.deleteUsuario", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var dataString = 'id=' + id;
        //console.log(dataString);
        $('.button-delete-si').click(function(e) {
            $("#modal-cargando").modal("show");
            $.ajax({
                type: "POST",
                url: URL + "usuarios/eliminar_usuario",
                data: dataString,
                success: function(data) {
                    data = JSON.parse(data)

                    if (data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-delete").modal("hide");
                        swal(
                            'Usuario',
                            data['msg'],
                            'success'
                        )

                        $("#listadoUsuarios").dataTable().fnDeleteRow("#" + data['id']);

                    } else {
                        swal(
                            'Usuario',
                            data['msg'],
                            'error'
                        )
                    }
                },
                error: function() {
                    $("#popUpError").modal("show");
                }
            });
        });
    });
    //agregar usuario
    $('#agregarUsuario').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var val3;
        var val4;
        var val5;
        var val6;
        var val7;
        var val8;
        var val9;
        var val10;
        var nombrePersona = $('#nombrePersona').val();
        var apellido = $('#apellidoPersona').val();
        var telefono = $('#telefonoPersona').val();
        var email = $('#emailPersona').val();
        var provincia = $('#selectProvincia').val();
        var localidad = $('#selectLocalidad').val();
        var perfil = document.getElementById("fileUserAgregar");
        var nombreUsuario = $('#nombreUsuarioPersona').val();
        var password = $('#passwordPersona').val();
        var nivel = $('#selectNivelUsuarioAgregar').val();
        var menu = $('#selectMenuUsuarioAdminAgregar').val();

        var arrayNivel = menu;
        var arrayNivelNew = [];
        if (arrayNivel) {
            var count = arrayNivel.length;
            for (var i = 0; i < count; i++) {

                if (arrayNivel[i] != 'multiselect-all') {
                    arrayNivelNew.push(arrayNivel[i]);
                }
            }
        } else {

        }

        arrayNivelNew = JSON.stringify(arrayNivelNew);
        if (nombrePersona == null || nombrePersona.length == 0 || nombrePersona == '') {
            $("#errorNombrePersona").css("display", "block");
            val1 = false;
        } else {
            $("#errorNombrePersona").css("display", "none");
            val1 = true;
        }
        if (apellido == null || apellido.length == 0 || apellido == '') {
            $("#errorApellidoPersona").css("display", "block");
            val2 = false;
        } else {
            $("#errorApellidoPersona").css("display", "none");
            val2 = true;
        }
        if (provincia == null || provincia.length == 0 || provincia == '') {
            $("#errorProvincia").css("display", "block");
            val3 = false;
        } else {
            $("#errorProvincia").css("display", "none");
            val3 = true;
        }

        if (email == null || email.length == 0 || email == '' || !(/\S+@\S+\.\S+/.test(email))) {
            $("#errorEmailPersona").css("display", "block");
            val4 = false;
        } else {
            $("#errorEmailPersona").css("display", "none");
            val4 = true;
        }

        if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
            $("#errorTelefonoPersona").css("display", "block");
            val5 = false;
        } else {
            $("#errorTelefonoPersona").css("display", "none");
            val5 = true;
        }

        if (localidad == null || localidad.length == 0 || localidad == '') {
            $("#errorLocalidad").css("display", "block");
            val6 = false;
        } else {
            $("#errorLocalidad").css("display", "none");
            val6 = true;
        }

        if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
            $("#errorUsuarioPersona").css("display", "block");
            val8 = false;
        } else {
            $("#errorUsuarioPersona").css("display", "none");
            val8 = true;
        }

        if (password == null || password.length == 0 || password == '') {
            $("#errorPass").css("display", "block");
            val7 = false;
        } else {
            $("#errorPass").css("display", "none");
            val7 = true;
        }

        if (nivel == null || nivel.length == 0 || nivel == '' || !arrayNivel) {
            $("#errorNivelPersona").css("display", "block");
            val9 = false;
        } else {
            $("#errorNivelPersona").css("display", "none");
            val9 = true;
        }


        //        if (menu == null || menu.length == 0 || menu == '') {
        //            $("#errorMenu").css("display", "block");
        //            val10 = false;
        //        } else {
        //            $("#errorMenu").css("display", "none");
        //            val10 = true;
        //        }

        if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9) {
            //        if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9 && val10) {
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'usuarios/add_usuario_post/',
                    type: 'POST',
                    data: {
                        nombrePersona: nombrePersona,
                        apellido: apellido,
                        telefono: telefono,
                        email: email,
                        provincia: provincia,
                        localidad: localidad,
                        nombreUsuario: nombreUsuario,
                        password: password,
                        nivel: nivel,
                        menu: arrayNivelNew
                    }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    document.getElementById("idUsuarioAgregar").value = dato['idUsuario'];
                    //console.log(dato);
                    if (dato['valid']) {
                        var formData = new FormData($("#form-agregar-usuario")[0]);
                        $.ajax({
                                url: URL + 'usuarios/add_usuario_perfil_post',
                                type: 'POST',
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false

                            })
                            .done(function(data) {
                                var datos = JSON.parse(data);
                                if (datos['valid']) {
                                    $("#modal-cargando").modal("hide");
                                    $("#modal-add-usuario").modal("hide");
                                    swal(
                                        'Usuario',
                                        dato['msg'],
                                        'success'
                                    )

                                    //--- AGREGO FILA ---//
                                    var table = $('#listadoUsuarios').DataTable();

                                    var acciones = '<a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>' +
                                        '&nbsp;' +
                                        '<a href="#modal-delete" class="tip deleteUsuario" role="button" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>';

                                    var row = table.row.add([
                                        dato['usuario'][0]['idUsuario'],
                                        dato['usuario'][0]['apellido'] + ", " + dato['usuario'][0]['nombreCompleto'],
                                        dato['usuario'][0]['usuario'],
                                        dato['usuario'][0]['email'],
                                        dato['usuario'][0]['nivel'],
                                        acciones,
                                    ]).draw(false);

                                    row.nodes().to$().attr('id', dato['usuario'][0]['idUsuario']);
                                    table.row(row).column(0).nodes().to$().addClass('text-center');
                                    table.row(row).column(1).nodes().to$().addClass('text-center');
                                    table.row(row).column(2).nodes().to$().addClass('text-center');
                                    table.row(row).column(3).nodes().to$().addClass('text-center');
                                    table.row(row).column(4).nodes().to$().addClass('text-center');
                                    table.row(row).column(5).nodes().to$().addClass('text-center');

                                } else {
                                    swal(
                                        'Usuario',
                                        dato['msg'],
                                        'error'
                                    )
                                }
                            })
                            .fail(function() {
                                $("#popUpError").modal("show");
                            });
                    }
                })
        }
    });
    //cargar los datos del usuario en el model
    $("#listadoUsuarios").on("click", "a.modificarUsuario", function(e) {
        var idUsuario = $(this).data('id');
        //console.log(idUsuario);
        //console.log('paso por aca y no tengo id');
        var dataString = 'id=' + idUsuario;
        $.ajax({
                url: URL + 'usuarios/get_usuario_byId/',
                type: 'POST',
                data: dataString
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-editar-usuario").modal("show");
                    document.getElementById("idUsuarioModificar").value = dato['usuario'][0]['idUsuario'];
                    if (dato['usuario'][0]['imgPerfil'] != "") {
                        document.getElementById("imgPerfilModificar").src = URL + 'uploads/perfil/' + dato['nombreImagenPerfil'][0] + '/' + dato['usuario'][0]['imgPerfil'];
                    } else {
                        document.getElementById("imgPerfilModificar").src = URL + "assets/images/main-team-member-img-3-100x100.jpg";
                    }
                    document.getElementById("nombreImgModificar2").value = dato['usuario'][0]['imgPerfil'];
                    document.getElementById("nombreImgModificar").value = '.' + dato['nombreImagenPerfil'][1];
                    document.getElementById("nombrePersonaModificar").value = dato['usuario'][0]['nombreCompleto'];
                    document.getElementById("apellidoUsuarioModificar").value = dato['usuario'][0]['apellido'];
                    document.getElementById("telefonoUsuarioModificar").value = dato['usuario'][0]['telefono'];
                    document.getElementById("emailUsuarioModificar").value = dato['usuario'][0]['email'];
                    $('#selectProvinciaUsuarioModificar').val(dato['usuario'][0]['idProvincia']).trigger('change');
                    $('#selectLocalidadUsuarioModificar').val(dato['usuario'][0]['idLocalidad']).trigger('change');
                    $('#selectNivelUsuarioModificar').val(dato['usuario'][0]['idNivel']).trigger('change');
                    document.getElementById("usuarioModificar").value = dato['usuario'][0]['usuario'];
                    document.getElementById("passwordUsuarioModificar").value = dato['usuario'][0]['password'];
                } else {
                    $("#popUpError").modal("show");
                }
            })
            .fail(function() {
                $("#popUpError").modal("show");
            });
    });
    $('#modificarUsuarioBTN').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var val3;
        var val4;
        var val5;
        var val6;
        var val7;
        var val8;
        var val9;
        var val10;
        var val11;
        var id = $('#idUsuarioModificar').val();
        var nombrePersona = $('#nombrePersonaModificar').val();
        var apellido = $('#apellidoUsuarioModificar').val();
        var telefono = $('#telefonoUsuarioModificar').val();
        var email = $('#emailUsuarioModificar').val();
        var provincia = $('#selectProvinciaUsuarioModificar').val();
        var localidad = $('#selectLocalidadUsuarioModificar').val();
        var nombreUsuario = $('#usuarioModificar').val();
        var password = $('#passwordUsuarioModificar').val();
        var nivel = $('#selectNivelUsuarioModificar').val();
        var nombreImgModificar = $('#nombreImgModificar').val();
        var perfil = document.getElementById("imgPerfilModificar");
        var menu = $('#selectMenuUsuarioAdmin').val();
        var arrayNivel = menu;
        var arrayNivelNew = [];
        if (arrayNivel) {
            var count = arrayNivel.length;
            for (var i = 0; i < count; i++) {

                if (arrayNivel[i] != 'multiselect-all') {
                    arrayNivelNew.push(arrayNivel[i]);
                }
            }
        }

        arrayNivelNew = JSON.stringify(arrayNivelNew);
        //        //console.log('menu= ' + menu);
        //        //console.log('id=' + id);
        //        //console.log('nombre=' + nombrePersona);
        //        //console.log(apellido);
        //        //console.log(telefono);
        //        //console.log(email);
        //        //console.log(provincia);
        //        //console.log(localidad);
        //        //console.log(nombreUsuario);
        //        //console.log(password);
        //        //console.log(nivel);
        //        //console.log('perfil=' + perfil);


        if (nombrePersona == null || nombrePersona.length == 0 || nombrePersona == '') {
            $("#errorNombrePersona").css("display", "block");
            val1 = false;
        } else {
            $("#errorCerrorNombrePersonaliente").css("display", "none");
            val1 = true;
        }
        if (apellido == null || apellido.length == 0 || apellido == '') {
            $("#errorApellido").css("display", "block");
            val2 = false;
        } else {
            $("#errorApellido").css("display", "none");
            val2 = true;
        }
        if (telefono == null || telefono.length == 0 || telefono == '') {
            $("#errorWeb").css("display", "block");
            val3 = false;
        } else {
            $("#errorWeb").css("display", "none");
            val3 = true;
        }

        if (email == null || email.length == 0 || email == '' || !(/\S+@\S+\.\S+/.test(email))) {
            $("#errorEmail").css("display", "block");
            val4 = false;
        } else {
            $("#errorEmail").css("display", "none");
            val4 = true;
        }

        if (provincia == 0) {
            $("#errorProvincia").css("display", "block");
            val5 = false;
        } else {
            $("#errorProvincia").css("display", "none");
            val5 = true;
        }

        if (localidad == 0) {
            $("#errorLocalidad").css("display", "block");
            val7 = false;
        } else {
            $("#errorLocalidad").css("display", "none");
            val7 = true;
        }



        if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
            $("#errorNombreUsuario").css("display", "block");
            val8 = false;
        } else {
            $("#errorNombreUsuario").css("display", "none");
            val8 = true;
        }

        if (password == null || password.length == 0 || password == '') {
            $("#errorPassword").css("display", "block");
            val9 = false;
        } else {
            $("#errorPassword").css("display", "none");
            val9 = true;
        }

        if (nivel == 0 || nivel.length == 0 || !nivel) {
            $("#errorNivel").css("display", "block");
            val10 = false;
        } else {
            $("#errorNombreUsuario").css("display", "none");
            val10 = true;
        }

        if (menu == 0) {
            $("#errorMenu").css("display", "block");
            val11 = false;
        } else {
            $("#errorMenu").css("display", "none");
            val11 = true;
        }


        if (true) {



            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'usuarios/modificar_usuario_post',
                    type: 'POST',
                    data: {
                        id: id,
                        nombrePersona: nombrePersona,
                        apellido: apellido,
                        telefono: telefono,
                        email: email,
                        provincia: provincia,
                        localidad: localidad,
                        nombreUsuario: nombreUsuario,
                        password: password,
                        nivel: nivel,
                        nombreImgModificar: nombreImgModificar,
                        menu: arrayNivelNew
                    },
                    cache: false

                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    if (dato['valid']) {
                        var formData = new FormData($("#form-modificar-usuario")[0]);
                        $.ajax({
                                url: URL + 'usuarios/modificar_usuario_perfil_post',
                                type: 'POST',
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false

                            })
                            .done(function(data) {
                                var datos = JSON.parse(data);
                                if (datos['valid']) {
                                    $("#modal-cargando").modal("hide");
                                    $("#modal-editar-usuario").modal("hide");
                                    swal(
                                        'Usuario',
                                        dato['msg'],
                                        'success'
                                    )

                                    //--- AGREGO FILA ---//
                                    var table = $('#listadoUsuarios').DataTable();

                                    var idUsuarioModificar = $('#idUsuarioModificar').val();
                                    if (idUsuarioModificar != null && idUsuarioModificar.length != 0) {
                                        $("#listadoUsuarios").dataTable().fnDeleteRow("#" + idUsuarioModificar);
                                    }

                                    var acciones = '<a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>' +
                                        '&nbsp;' +
                                        '<a href="#modal-delete" class="tip deleteUsuario" role="button" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>';

                                    var row = table.row.add([
                                        dato['usuario'][0]['idUsuario'],
                                        dato['usuario'][0]['apellido'] + ", " + dato['usuario'][0]['nombreCompleto'],
                                        dato['usuario'][0]['usuario'],
                                        dato['usuario'][0]['email'],
                                        dato['usuario'][0]['nivel'],
                                        acciones,
                                    ]).draw(false);

                                    row.nodes().to$().attr('id', idUsuarioModificar);
                                    table.row(row).column(0).nodes().to$().addClass('text-center');
                                    table.row(row).column(1).nodes().to$().addClass('text-center');
                                    table.row(row).column(2).nodes().to$().addClass('text-center');
                                    table.row(row).column(3).nodes().to$().addClass('text-center');
                                    table.row(row).column(4).nodes().to$().addClass('text-center');
                                    table.row(row).column(5).nodes().to$().addClass('text-center');

                                } else {
                                    swal(
                                        'Usuario',
                                        dato['msg'],
                                        'error'
                                    )
                                }
                            })
                            .fail(function() {
                                $("#popUpError").modal("show");
                            });
                    }
                })
                .fail(function() {
                    $("#popUpError").modal("show");
                });
        }
    });
    //------------ NIVELES ----------------
    //listar NIVELES
    $("#listadoNiveles").on("click", "a.deleteNivel", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        var dataString = 'id=' + id;
        $('.button-delete-si').click(function(e) {
            $("#modal-cargando").modal("show");
            $.ajax({
                type: "POST",
                url: URL + "niveles/eliminar_nivel",
                data: dataString,
                success: function(data) {
                    data = JSON.parse(data)

                    if (data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-delete").modal("hide");
                        $("#modal-exitoso").modal("show");
                        setTimeout(function() {
                            location.href = URL + '/listar_niveles';
                        }, 1000);
                    } else {
                        $("#modal-delete").modal("hide");
                        $("#popUpError").modal("show");
                    }
                },
                error: function() {
                    $("#popUpError").modal("show");
                }
            });
        });
    });
    //agregar nivel
    $("#listadoNiveles").on("click", "a.agregarNivel", function(e) {

        var nivel = $(this).data('id');
        //console.log(nivel);
        var dataString = 'nombre=' + nivel;
        //console.log(dataString);
        $("#modal-modificar-nivel").modal("show");
    });
    $('#agregarNivel').click(function(e) {
        e.preventDefault();
        var val1;
        var nombre = $('#nombreNivelAgregar').val();
        if (nombre == null || nombre.length == 0 || nombre == ' ' || nombre == '') {
            $("#errorNombreNivel").css("display", "block");
            val1 = false;
        } else {
            $("#errorNombreNivel").css("display", "none");
            val1 = true;
        }



        if (val1) {
            var formData = new FormData($("#form-add-nivel")[0]);
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'niveles/add_nivel_post/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#form-modificar-nivel").modal("hide");
                        $("#modal-exitoso").modal("show");
                        setTimeout(function() {
                            location.href = URL + 'niveles/listar_niveles/';
                        }, 2000);
                    } else {
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function() {
                    $("#popUpError").modal("show");
                });
        }
    });
    //modificar nivel

    $("#listadoNiveles").on("click", "a.modificarNivel", function(e) {
        var idNivel = $(this).data('id');
        //console.log(idNivel);
        var nivel = $(this).data('nombre');
        //console.log(nivel);
        var dataString = 'id=' + idNivel;
        //console.log(dataString);
        $("#modal-modificar-nivel").modal("show");
        document.getElementById("nombreNivelModificar").value = nivel;
        document.getElementById("idNivelModificar").value = idNivel;
    });
    $('#modificarNivel').click(function(e) {
        e.preventDefault();
        var val1;
        var val2;
        var nombre = $('#nombreNivelModificar').val();
        var id = $('#idNivelModificar').val();
        if (nombre == null || nombre.length == 0 || nombre == ' ' || nombre == '') {
            $("#errorNombreNivel").css("display", "block");
            val1 = false;
        } else {
            $("#errorNombreNivel").css("display", "none");
            val1 = true;
        }

        if (id == null || id.length == 0 || id == ' ' || id == '') {
            $("#errorIdNivel").css("display", "block");
            val2 = false;
        } else {
            $("#errorIdNivel").css("display", "none");
            val2 = true;
        }



        if (val1 && val2) {
            var formData = new FormData($("#form-modificar-nivel")[0]);
            $("#modal-cargando").modal("show");
            $.ajax({
                    url: URL + 'niveles/modificar_niveles_post/',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        $("#form-modificar-nivel").modal("hide");
                        $("#modal-exitoso").modal("show");
                        setTimeout(function() {
                            location.href = URL + 'niveles/listar_niveles/';
                        }, 2000);
                    } else {
                        $("#popUpError").modal("show");
                    }
                })
                .fail(function() {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- NIVEL/MENU---//
//Modificar
$(document).ready(function() {
    $("#selectNivelUsuarioModificar").change(function() {
        $("#selectNivelUsuarioModificar option:selected").each(function() {
            idNivel = $('#selectNivelUsuarioModificar').val();
            $.post(URL + 'admin/busca_menuAdmin', {
                idNivel: idNivel
            }, function(data) {
                //                //console.log('aca');
                var dato = JSON.parse(data)
                    //                //console.log(dato);
                    //                //console.log(dato[0]);
                document.getElementById("selectMenuUsuarioAdmin").value = "";
                //                //console.log(dato[0].length);
                var options = [];
                for (var i = 0; i < dato.length; i++) {
                    if (dato[i]) {
                        options.push({
                            label: dato[i][0]['nombre'],
                            value: dato[i][0]['idMenu']
                        });
                    }
                }

                $("#selectMenuUsuarioAdmin").multiselect('dataprovider', options);
            });
        });
    })
});
//Agregar
$(document).ready(function() {
    $("#selectNivelUsuarioAgregar").change(function() {
        $("#selectNivelUsuarioAgregar option:selected").each(function() {
            idNivel = $('#selectNivelUsuarioAgregar').val();
            $.post(URL + 'admin/busca_menuAdmin', {
                idNivel: idNivel
            }, function(data) {
                //                //console.log('aca');
                var dato = JSON.parse(data)
                    //console.log(dato);
                    //                //console.log(dato[0]);
                document.getElementById("selectMenuUsuarioAdminAgregar").value = "";
                //                //console.log(dato[0].length);
                var options = [];
                for (var i = 0; i < dato.length; i++) {
                    if (dato[i]) {
                        options.push({
                            label: dato[i][0]['nombre'],
                            value: dato[i][0]['idMenu']
                        });
                    }
                }

                $("#selectMenuUsuarioAdminAgregar").multiselect('dataprovider', options);
            });
        });
    })
});
$(document).ready(function() {
    //Agregar producto presupuesto
    $("#selectProductos_formNuevoPresupuesto").change(function() {
        $("#selectProductos_formNuevoPresupuesto option:selected").each(function() {

            var idProducto = $('#selectProductos_formNuevoPresupuesto').val();
            var idCliente = $('#selectCliente_formNuevoPresupuesto').val();
            if (idCliente != 0) {
                //console.log(idProducto);
                if (idProducto == "addProdNew") {
                    addProductoNewPresupuesto();
                } else {
                    $("#modal-cargando").modal("show");
                    $.ajax({
                            url: URL + 'productos/get_producto/',
                            type: 'POST',
                            data: { idProducto: idProducto }
                        })
                        .done(function(data) {
                            var dato = JSON.parse(data);
                            //console.log(dato);
                            if (dato['valid']) {
                                if (dato['producto'][0]['stock'] > 0) {

                                    //--- AGREGO FILA ---//
                                    $("#errorStockProducto_formNuevoPresupuesto").css("display", "none");
                                    listadoPresupuesto = $('#listadoPresupuesto_formNuevoPresupuesto').DataTable();
                                    var iva_tipos_option;
                                    if (dato['iva_tipos']) {
                                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                        }
                                    }

                                    var info = listadoPresupuesto.page.info();
                                    var count = info.recordsTotal;
                                    var tabla = listadoPresupuesto.data();
                                    var p = 0;
                                    for (var i = 0; i < count; i++) {
                                        if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                            p++;
                                        }
                                    }

                                    if (p == 0) {
                                        var row = listadoPresupuesto.row.add([
                                            dato['producto'][0]['idProducto'],
                                            dato['producto'][0]['codigo'],
                                            dato['producto'][0]['nombre'],
                                            '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoPresupuesto(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + 1 + ')" class="form-control">' +
                                            '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                            'Stock: ' + dato['producto'][0]['stock'] +
                                            '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                            dato['producto'][0]['stock'],
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">%</span>' +
                                            '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoPresupuesto(' + dato['producto'][0]['idProducto'] + ')" class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                            '</div>',
                                            '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoPresupuesto(' + dato['producto'][0]['idProducto'] + ')" required>' +
                                            '<option value="0">IVA</option>' +
                                            iva_tipos_option +
                                            '</select>',
                                            '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaPresupuesto(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                                            '&nbsp;',
                                        ]).draw(false);
                                        row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                        listadoPresupuesto.row(row).column(0).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(1).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(2).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(3).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(4).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(5).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(6).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(7).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(8).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(9).nodes().to$().addClass('text-center');
                                        calculoPresupuesto(dato['producto'][0]['idProducto']);
                                    } else {
                                        $("#modal-cargando").modal("hide");
                                        document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                        $("#popUpErrorMsg").modal("show");
                                    }
                                    $("#modal-cargando").modal("hide");
                                } else {
                                    //console.log('Sin Stock');
                                    $("#modal-cargando").modal("hide");
                                    $("#errorStockProducto_formNuevoPresupuesto").css("display", "block");
                                }
                            } else {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            }
                        })
                        .fail(function(data) {
                            $("#modal-cargando").modal("hide");
                            $("#modal-exitoso").modal("hide");
                            $("#popUpError").modal("show");
                        });
                }
            } else {
                swal(
                    'Error',
                    "Debe primero seleccionar un cliente",
                    'error'
                )
            }
        });
    })
})

function guardar_presupuesto() {

    //console.log("Presupuesto");
    var val1, val2, val3, val7 = true,
        val8, val9, val10;
    var selectCliente = $('#selectCliente_formNuevoPresupuesto').val();
    var inputFechaEmision = $('#inputFechaEmision_formNuevoPresupuesto').val();
    var inputFechaCobro = $('#inputFechaCobroPresupuesto_formNuevoPresupuesto').val();
    //    var selectTipoFact = $('#selectTipoFact_formNuevoPresupuesto').val();
    var selectCategoriaVenta = $('#selectCategoriaPresupuesto_formNuevoPresupuesto').val();
    var selectSubCategoriaVenta = $('#selectSubCategoriaPresupuesto_formNuevoPresupuesto').val();
    var notaCliente = $('#notaCliente_formNuevoPresupuesto').val();
    var notaInterna = $('#notaInterna_formNuevoPresupuesto').val();
    var fechaVigencia = $('#inputFechaVigencia_formNuevoPresupuesto').val();
    listadoPresupuesto = $('#listadoPresupuesto_formNuevoPresupuesto').DataTable();
    var total = $('#totalVenta_formNuevoPresupuesto').val();
    var descCliente = $('#descuentoCliente_formNuevoPresupuesto').val();
    var descTotal = $('#descEfectuado_formNuevoPresupuesto').val();
    var totalNoGravado = $('#importeNoGravado_formNuevoPresupuesto').val();
    var totalIva = 0;
    if (selectCliente == 0) {
        $("#errorselectCliente_formNuevoPresupuesto").css("display", "block");
        val1 = false;
    } else {
        $("#errorselectCliente_formNuevoPresupuesto").css("display", "none");
        val1 = true;
    }

    //    if (selectTipoFact == 0) {
    //        $("#errorselectTipoFact_formNuevoPresupuesto").css("display", "block");
    //        val2 = false;
    //    } else {
    //        $("#errorselectTipoFact_formNuevoPresupuesto").css("display", "none");
    //        val2 = true;
    //    }

    if (selectSubCategoriaVenta == 0) {
        $("#errorselectSubCategoriaPresupuesto_formNuevoPresupuesto").css("display", "block");
        val8 = false;
    } else {
        $("#errorselectSubCategoriaPresupuesto_formNuevoPresupuesto").css("display", "none");
        val8 = true;
    }

    if (selectCategoriaVenta == 0) {
        $("#errorselectCategoriaPresupuesto_formNuevoPresupuesto").css("display", "block");
        val3 = false;
    } else {
        $("#errorselectCategoriaPresupuesto_formNuevoPresupuesto").css("display", "none");
        val3 = true;
    }

    var info = listadoPresupuesto.page.info();
    var count = info.recordsTotal;
    if (count == 0) {
        document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
        $("#popUpErrorMsg").modal("show");
        val7 = false;
    } else {
        val7 = true;
    }

    if (fechaVigencia == "") {
        $("#errorinputFechaVigencia_formNuevoPresupuesto").css("display", "block");
        val7 = false;
    } else {
        $("#errorinputFechaVigencia_formNuevoPresupuesto").css("display", "none");
        val7 = true;
    }

    if (val1 && val3 && val7 && val8) {
        $("#modal-cargando").modal("show").css('z-index', '9999');
        var datosFacturacion = {
            "selectCliente": selectCliente,
            "inputFechaEmision": inputFechaEmision,
            "fechaVigencia": fechaVigencia,
            "inputFechaCobro": inputFechaCobro,
            //            "selectTipoFact": selectTipoFact,
            "selectCategoriaVenta": selectCategoriaVenta,
            "notaCliente": notaCliente,
            "notaInterna": notaInterna,
            "totalNoGravado": totalNoGravado,
            "total": total,
            "descTotal": descTotal,
            "descCliente": descCliente,
            "totalIva": totalIva,
            "selectSubCategoriaVenta": selectSubCategoriaVenta
        };
        var datosVenta = [];
        var info = listadoPresupuesto.page.info();
        var count = info.recordsTotal;
        var tabla = listadoPresupuesto.data();
        var totalVenta = 0;
        var k = 0;
        for (var i = 0; i < count; i++) {
            var e = document.getElementById('selectIva' + tabla[i][0]);
            var valueIvaSelect = e.options[e.selectedIndex].text;
            var idInputSubTotal = "subTotalProd" + tabla[i][0];
            var valorInputSubTotal = $('#' + idInputSubTotal).val();
            totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
            if (parseInt($('#cantProd' + tabla[i][0]).val()) <= parseInt(tabla[i][4]) && $('#altaProd' + tabla[i][0]).val() == 1) {
                datosVenta.push({
                    "idProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "stock": tabla[i][4],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "ivaText": valueIvaSelect
                });
            } else {
                k++;
                //console.log(k);
            }
        }
        //console.log("k" + k);
        if (k == 0) {
            //console.log(datosFacturacion);
            $.ajax({
                    url: URL + 'presupuesto/set_presupuesto/',
                    type: 'POST',
                    data: { datosVenta: datosVenta, datosFacturacion: datosFacturacion }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Presupuesto',
                            dato['msg'],
                            'success'
                        )
                        setTimeout(function() {
                            generarPdfDetallePresupuesto(dato['idGenPresupuesto'], 1);
                        }, 850);
                    } else {
                        swal(
                            'Presupuesto',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        } else {
            k = 0
            $("#modal-cargando").modal("hide");
            document.getElementById("msgError").innerHTML = "Controle, hay productos que superan el stock O todavia no guardo el nuevo producto.";
            $("#popUpErrorMsg").modal("show");
            //console.log("Hay productos sin stock");
        }
    }
}

//--- Delete presupuesto ---//
$(document).ready(function() {
    $("#listadoPresupuesto").on("click", "a.delete_presupuesto", function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        swal({
            type: 'question',
            text: '¿ Estás seguro que quieres eliminar el presupuesto ?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                return fetch(URL + 'presupuesto/eliminar_presupuesto/' + id)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                $("#modal-cargando").modal("hide");
                $("#listadoPresupuesto").dataTable().fnDeleteRow("#" + id);
                swal(
                    'Presupuesto',
                    'Se borro el presupuesto exitosamente',
                    'success'
                )
            }
        })
    });
});
//--- Actualizar presupuesto ---//
$(document).ready(function() {
    $("#listadoPresupuesto").on("click", "a.update_presupuesto", function(e) {
        //console.log('entro vo');
        var idGenPresupuesto = $(this).data('id');
        location.href = URL + 'presupuesto/modificar_presupuesto/' + idGenPresupuesto;
    })
});
$(document).ready(function() {
    //Agregar producto presupuesto modificar
    $("#selectProductos_formModificarPresupuesto").change(function() {
        $("#selectProductos_formModificarPresupuesto option:selected").each(function() {

            var idProducto = $('#selectProductos_formModificarPresupuesto').val();
            var idCliente = $('#selectCliente_formModificarPresupuesto').val();
            if (idCliente != 0) {
                //console.log(idProducto);
                if (idProducto == "addProdNew") {
                    addProductoNewPresupuesto_editar();
                } else {
                    $("#modal-cargando").modal("show");
                    $.ajax({
                            url: URL + 'productos/get_producto/',
                            type: 'POST',
                            data: { idProducto: idProducto }
                        })
                        .done(function(data) {
                            var dato = JSON.parse(data);
                            //console.log(dato);
                            if (dato['valid']) {
                                if (dato['producto'][0]['stock'] > 0) {

                                    //--- AGREGO FILA ---//
                                    $("#errorStockProducto_formModificarPresupuesto").css("display", "none");
                                    listadoPresupuesto = $('#listadoPresupuesto_formModificarPresupuesto').DataTable();
                                    var iva_tipos_option;
                                    if (dato['iva_tipos']) {
                                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                        }
                                    }

                                    var info = listadoPresupuesto.page.info();
                                    var count = info.recordsTotal;
                                    var tabla = listadoPresupuesto.data();
                                    var p = 0;
                                    for (var i = 0; i < count; i++) {
                                        if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                            p++;
                                        }
                                    }

                                    if (p == 0) {
                                        var row = listadoPresupuesto.row.add([
                                            dato['producto'][0]['idProducto'],
                                            dato['producto'][0]['codigo'],
                                            dato['producto'][0]['nombre'],
                                            '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['producto'][0]['stock'] + ')" class="form-control">' +
                                            '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                            'Stock: ' + dato['producto'][0]['stock'] +
                                            '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                            dato['producto'][0]['stock'],
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">%</span>' +
                                            '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ')" class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                            '</div>',
                                            '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ')" required>' +
                                            '<option value="0">IVA</option>' +
                                            iva_tipos_option +
                                            '</select>',
                                            '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaPresupuestoDetalle(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                                            '&nbsp;',
                                        ]).draw(false);
                                        row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                        listadoPresupuesto.row(row).column(0).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(1).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(2).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(3).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(4).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(5).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(6).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(7).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(8).nodes().to$().addClass('text-center');
                                        listadoPresupuesto.row(row).column(9).nodes().to$().addClass('text-center');
                                        calculoPresupuestoDetalle(dato['producto'][0]['idProducto']);
                                    } else {
                                        $("#modal-cargando").modal("hide");
                                        document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                        $("#popUpErrorMsg").modal("show");
                                    }
                                    $("#modal-cargando").modal("hide");
                                } else {
                                    //console.log('Sin Stock');
                                    $("#modal-cargando").modal("hide");
                                    $("#errorStockProducto_formNuevoPresupuesto").css("display", "block");
                                }
                            } else {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            }
                        })
                        .fail(function(data) {
                            $("#modal-cargando").modal("hide");
                            $("#modal-exitoso").modal("hide");
                            $("#popUpError").modal("show");
                        });
                }
            } else {
                swal(
                    'Error',
                    "Debe primero seleccionar un cliente",
                    'error'
                )
            }
        });
    })
})

function guardar_presupuesto_editar() {

    //console.log("Presupuesto Editar");
    var val1, val2, val3, val7 = true,
        val8, val9, val10;
    var selectCliente = $('#selectCliente_formModificarPresupuesto').val();
    var inputFechaEmision = $('#inputFechaEmision_formModificarPresupuesto').val();
    var inputFechaCobro = $('#inputFechaCobroPresupuesto_formModificarPresupuesto').val();
    //    var selectTipoFact = $('#selectTipoFact_formModificarPresupuesto').val();ssssssssssssssssssssssss
    var selectCategoriaPresupuesto = $('#selectCategoriaPresupuesto_formModificarPresupuesto').val();
    var selectSubCategoriaPresupuesto = $('#selectSubCategoriaPresupuesto_formModificarPresupuesto').val();
    var notaCliente = $('#notaCliente_formModificarPresupuesto').val();
    var notaInterna = $('#notaInterna_formModificarPresupuesto').val();
    var idGenPresupuesto = $('#idGenPresupuesto').val();
    var fechaVigencia = $('#inputFechaVigencia_formModificarPresupuesto').val();
    listadoPresupuesto = $('#listadoPresupuesto_formModificarPresupuesto').DataTable();
    var total = $('#totalVenta_formModificarPresupuesto').val();
    var descCliente = $('#descuentoCliente_formModificarPresupuesto').val();
    var descTotal = $('#descEfectuado_formModificarPresupuesto').val();
    var totalNoGravado = $('#importeNoGravado_formModificarPresupuesto').val();
    var totalIva = 0;
    if (selectCliente == 0) {
        $("#errorselectCliente_formModificarPresupuesto").css("display", "block");
        val1 = false;
    } else {
        $("#errorselectCliente_formModificarPresupuesto").css("display", "none");
        val1 = true;
    }

    //    if (selectCategoriaVentaDetalle == 0) {
    //        $("#errorselectCategoriaPresupuestoDetalle_formModificarPresupuesto").css("display", "block");
    //        val9 = false;
    //    } else {
    //        $("#errorselectCategoriaPresupuestoDetalle_formModificarPresupuesto").css("display", "none");
    //        val9 = true;
    //    }
    //
    //    if (selectSubCategoriaPresuouesto == 0) {
    //        $("#errorselectSubCategoriaPresupuesto_formNuevoPresupuesto").css("display", "block");
    //        val8 = false;
    //    } else {
    //        $("#errorselectSubCategoriaPresupuesto_formModificarPresupuesto").css("display", "none");
    //        val8 = true;
    //    }

    if (selectCategoriaPresupuesto == 0) {
        $("#errorselectCategoriaPresupuesto_formModificarPresupuesto").css("display", "block");
        val3 = false;
    } else {
        $("#errorselectCategoriaPresupuesto_formModificarPresupuesto").css("display", "none");
        val3 = true;
    }

    var info = listadoPresupuesto.page.info();
    var count = info.recordsTotal;
    if (count == 0) {
        document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
        $("#popUpErrorMsg").modal("show");
        val7 = false;
    } else {
        val7 = true;
    }

    if (fechaVigencia == "") {
        $("#errorinputFechaVigencia_formModificarPresupuesto").css("display", "block");
        val10 = false;
    } else {
        $("#errorinputFechaVigencia_formModificarPresupuesto").css("display", "none");
        val10 = true;
    }

    if (val1 && val3 && val7 && val10) {
        $("#modal-cargando").modal("show").css('z-index', '9999');
        var datosFacturacion = {
            "selectCliente": selectCliente,
            "inputFechaEmision": inputFechaEmision,
            "inputFechaCobro": inputFechaCobro,
            "fechaVigencia": fechaVigencia,
            "selectCategoriaVenta": selectCategoriaPresupuesto,
            "notaCliente": notaCliente,
            "notaInterna": notaInterna,
            "totalNoGravado": totalNoGravado,
            "total": total,
            "descTotal": descTotal,
            "descCliente": descCliente,
            "totalIva": totalIva,
            "selectSubCategoriaVenta": selectSubCategoriaPresupuesto
        };
        var datosVenta = [];
        var info = listadoPresupuesto.page.info();
        var count = info.recordsTotal;
        var tabla = listadoPresupuesto.data();
        var totalVenta = 0;
        var k = 0;
        for (var i = 0; i < count; i++) {
            var e = document.getElementById('selectIva' + tabla[i][0]);
            var valueIvaSelect = e.options[e.selectedIndex].text;
            datosVenta.push({
                "idProducto": tabla[i][0],
                "codigo": tabla[i][1],
                "stock": tabla[i][4],
                "cantidad": $('#cantProd' + tabla[i][0]).val(),
                "precio": $('#precioProd' + tabla[i][0]).val(),
                "descuento": $('#descProd' + tabla[i][0]).val(),
                "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                "iva": $('#selectIva' + tabla[i][0]).val(),
                "ivaText": valueIvaSelect
            });
        }

        //console.log(datosFacturacion);
        //console.log(datosVenta);
        //console.log(k);
        $.ajax({
                url: URL + 'presupuesto/update_presupuesto/',
                type: 'POST',
                data: { datosVenta: datosVenta, datosFacturacion: datosFacturacion, idGenPresupuesto: idGenPresupuesto }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {

                    //console.log("Entro al valid del update exitoso");
                    //console.log(dato['idGenPresupuesto']);
                    $("#modal-cargando").modal("hide");
                    swal(
                        'Presupuesto',
                        dato['msg'],
                        'success'
                    )
                    setTimeout(function() {
                        generarPdfDetallePresupuesto(dato['idGenPresupuesto'], 1);
                    }, 850);
                } else {
                    swal(
                        'Presupuesto',
                        dato['msg'],
                        'error'
                    )
                }

            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    }
}

$(document).ready(function() {
    //Agregar producto presupuesto
    $("#selectProductos_formEditarAbono").change(function() {
        $("#selectProductos_formEditarAbono option:selected").each(function() {
            var idCliente = $('#selectCliente').val();
            if (idCliente != 0) {
                var idProducto = $('#selectProductos_formEditarAbono').val();
                //console.log(idProducto);
                if (idProducto == "addProdNew") {
                    addProductoNewAbonoEditar();
                } else {
                    $("#modal-cargando").modal("show");
                    $.ajax({
                            url: URL + 'productos/get_producto/',
                            type: 'POST',
                            data: { idProducto: idProducto }
                        })
                        .done(function(data) {
                            var dato = JSON.parse(data);
                            //console.log(dato);
                            if (dato['valid']) {
                                if (dato['producto'][0]['stock'] > 0) {

                                    //--- AGREGO FILA ---//
                                    $("#errorStockProducto_formEditarAbono").css("display", "none");
                                    listadoAbonoEditar = $('#listadoAbonoEditar').DataTable();
                                    var iva_tipos_option;
                                    if (dato['iva_tipos']) {
                                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                        }
                                    }

                                    var info = listadoAbonoEditar.page.info();
                                    var count = info.recordsTotal;
                                    var tabla = listadoAbonoEditar.data();
                                    var p = 0;
                                    for (var i = 0; i < count; i++) {
                                        if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                            p++;
                                        }
                                    }

                                    if (p == 0) {
                                        var row = listadoAbonoEditar.row.add([
                                            dato['producto'][0]['idProducto'],
                                            dato['producto'][0]['codigo'],
                                            dato['producto'][0]['nombre'],
                                            '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoAbonoEditar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                            '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                            'Stock: ' + dato['producto'][0]['stock'] +
                                            '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                            dato['producto'][0]['stock'],
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">%</span>' +
                                            '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoAbonoEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                            '</div>',
                                            '<div class="input-group">' +
                                            '<span class="input-group-addon">$</span>' +
                                            '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                            '</div>',
                                            '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoAbonoEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                            '<option value="0">IVA</option>' +
                                            iva_tipos_option +
                                            '</select>',
                                            '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaAbonoEditar(' + dato['producto'][0]['idProducto'] + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')"></i>' +
                                            '&nbsp;',
                                        ]).draw(false);
                                        row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                        listadoAbonoEditar.row(row).column(0).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(1).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(2).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(3).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(4).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(5).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(6).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(7).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(8).nodes().to$().addClass('text-center');
                                        listadoAbonoEditar.row(row).column(9).nodes().to$().addClass('text-center');
                                        calculoAbonoEditar(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                                    } else {
                                        $("#modal-cargando").modal("hide");
                                        document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                        $("#popUpErrorMsg").modal("show");
                                    }
                                    $("#modal-cargando").modal("hide");
                                } else {
                                    //console.log('Sin Stock');
                                    $("#modal-cargando").modal("hide");
                                    $("#errorStockProducto_formEditarAbono").css("display", "block");
                                }
                            } else {
                                $("#modal-cargando").modal("hide");
                                $("#modal-exitoso").modal("hide");
                                $("#popUpError").modal("show");
                            }
                        })
                        .fail(function(data) {
                            $("#modal-cargando").modal("hide");
                            $("#modal-exitoso").modal("hide");
                            $("#popUpError").modal("show");
                        });
                }
            } else {
                swal(
                    'Error',
                    "Debe primero seleccionar un cliente",
                    'error'
                )
            }
        });
    })
})

//--- Procesamiento de datos y estructurados en un pdf mostrado en un swal ---//
function generarPdfDetalleVenta(idGenIngreso) {
    $.ajax({
            url: URL + 'ventas/generaPDFDetalleFactura/' + idGenIngreso,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            $("#operacionExitosa").modal("hide");
            var dato = JSON.parse(data);
            if (dato['valid']) {
                swal({
                    title: "Detalle de Venta",
                    text: "Venta",
                    width: "800px",
                    html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/ventas/' + idGenIngreso + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                    showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#operacionExitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- Procesamiento de datos y estructurados en un pdf mostrado en un swal ---//
function generarPdfDetalleEgreso(idGenEgreso) {
    $.ajax({
            url: URL + 'compras/generaPDFDetalleEgreso/' + idGenEgreso,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            $("#operacionExitosa").modal("hide");
            var dato = JSON.parse(data);
            if (dato['valid']) {
                swal({
                    title: "Detalle de Compra",
                    text: "Compra",
                    width: "800px",
                    html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/compras/' + idGenEgreso + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                    showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#operacionExitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}

//--- Mostrar comprobantes de pagos ---//
function verComprobantesPagos(idGenIngreso) {
    $("#cargando_comprobantes_pagos").css("display", "block");
    $("#tbodyComprobantesPagos").html("");
    $.ajax({
        url: URL + 'ventas/get_comprobantes_pagos',
        type: 'POST',
        data: { idGenIngreso: idGenIngreso }
    }).done(function(data) {
        $("#modal-cargando").modal("hide");
        var dato = JSON.parse(data);
        if (dato['valid']) {
            $("#modal-comprobantes-pagos").modal("show");
            $("#cargando_comprobantes_pagos").css("display", "none");
            //console.log(dato['array_final']);
            dato['array_final'].forEach(function(element) {
                $("#tbodyComprobantesPagos").append(
                    '<tr>' +
                    '<td class="text-center">' + element["fecha_cobro"] + '</td>' +
                    '<td class="text-center">' + element["debito"] + '</td>' +
                    '<td class="text-center">' + element["credito"] + '</td>' +
                    '<td class="text-center">' + element["total"] + '</td>' +
                    '<td class="text-center">' + element["saldo"] + '</td>' +
                    '<td class="text-center"><a target="_blank" href="../uploads/comprobantes/cobro/' + element['idGenIngreso'] + '/' + element['idGenComprobante'] + '.pdf">' +
                    element['numeroPtoVta'] + '-' + element['idCuentaCorriente'] +
                    '</a></td>'
                );
            });
        } else {
            document.getElementById("msgError").innerHTML = dato['msg'];
            $("#popUpErrorMsg").modal("show");
        }
    }).fail(function(data) {
        $("#modal-cargando").modal("hide");
        $("#popUpError").modal("show");
    });
}

//--- Procesamiento de datos y estructurados en un pdf mostrado en un swal ---//
function generarPdfDetallePresupuesto(idGenPresupuesto, redireccion) {
    $.ajax({
            url: URL + 'presupuesto/generaPDFDetallePresupuesto/' + idGenPresupuesto,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            $("#operacionExitosa").modal("hide");
            var dato = JSON.parse(data);
            //console.log("Estos son los datos del generador de pdf");
            //console.log(dato);
            if (dato['valid']) {
                swal({
                    title: "Detalle de Presupuesto",
                    text: "Prespuesto",
                    width: "800px",
                    html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/presupuestos/' + idGenPresupuesto + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                }).then((result) => {
                    if (result.value && redireccion == 1) {
                        setTimeout(function() {
                            location.href = URL + 'presupuesto/listar_presupuesto';
                        }, 1000);
                    }
                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#operacionExitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}


function llenado_tabla_venta_abono(idGenAbono) {
    if (idGenAbono) {
        setTimeout(function() {
            tableListadoIngresos = $('#listadoIngresos_abono').DataTable();
            $("#listadoIngresos_abono").dataTable().fnDestroy();
            $('#listadoIngresos_abono').DataTable({
                "sAjaxSource": URL + "abonos/listar_ventas_abono_table/" + idGenAbono,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }, 1000);
    } else {
        //console.log("No hay id");
    }
}

//--- Informe Ventas ---///
$(document).ready(function() {
    var table = $('#listadoIngresosInforme').DataTable();
    $('#max-date-listado-ventas-informe').change(function() {
        var fechaDesde = 0;
        var fechaHasta = 0;
        var urlajax = false;
        fechaDesde = $('#min-date-listado-ventas-informe').val();
        fechaHasta = $('#max-date-listado-ventas-informe').val();
        if ((fechaDesde == 0 && fechaHasta == 0) || (!fechaHasta)) {
            urlajax = URL + 'ventas/listar_ventas_informe_table/';
        } else if (fechaDesde && fechaHasta) {
            urlajax = URL + 'ventas/listar_ventas_informe_table_filtro/' + fechaDesde + '/' + fechaHasta;
        }
        if (urlajax) {
            tableListadoIngresosInforme = $('#listadoIngresosInforme').DataTable();
            $("#listadoIngresosInforme").dataTable().fnDestroy();
            $('#listadoIngresosInforme').DataTable({
                "sAjaxSource": urlajax,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }
    });
});

function setFechaInicio_informeVenta() {
    var fechaDesde;
    fechaDesde = $('#min-date-listado-ventas-informe').val();
    document.getElementById("fechaI_informeVenta").value = fechaDesde;
}

function setFechaFin_informeVenta() {
    var fechaHasta;
    fechaHasta = $('#max-date-listado-ventas-informe').val();
    document.getElementById("fechaF_informeVenta").value = fechaHasta;
}

function exportar_informe_ventas_excel() {
    var fechaDesde, fechaHasta;
    var exportar = true;
    fechaDesde = $('#min-date-listado-ventas-informe').val();
    fechaHasta = $('#max-date-listado-ventas-informe').val();
    if (!fechaDesde) {
        fechaDesde = 0;
    }
    if (!fechaHasta) {
        fechaHasta = 0;
    }
    if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
        document.getElementById("min-date-listado-ventas-informe").innerHTML = "";
        exportar = false;
    }
    if (exportar) {
        $.ajax({
            url: URL + 'ventas/exportar_to_excel_ventas/' + fechaDesde + '/' + fechaHasta,
            type: 'POST',
            cache: false,
        })
    } else {
        swal(
            'Error',
            "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
            'error'
        )
    }
}

$(document).ready(function() {
    $('#exportInformeVenta').click(function(e) {
        e.preventDefault();
        var fechaDesde, fechaHasta;
        var exportar = true;
        fechaDesde = $('#min-date-listado-ventas-informe').val();
        fechaHasta = $('#max-date-listado-ventas-informe').val();
        if (!fechaDesde) {
            fechaDesde = 0;
        }
        if (!fechaHasta) {
            fechaHasta = 0;
        }
        if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
            document.getElementById("min-date-listado-ventas-informe").innerHTML = "";
            exportar = false;
        }
        if (exportar) {
            document.getElementById("formExportInformeVenta").submit();
        } else {
            swal(
                'Error',
                "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
                'error'
            )
        }


    });
});
//--- Fin Informe Ventas ---//

//--- Informe Egresos ---///
$(document).ready(function() {
    var table = $('#listadoEgresosInforme').DataTable();
    $('#max-date-listado-egresos-informe').change(function() {
        var fechaDesde = 0;
        var fechaHasta = 0;
        var urlajax = false;
        fechaDesde = $('#min-date-listado-egresos-informe').val();
        fechaHasta = $('#max-date-listado-egresos-informe').val();
        if ((fechaDesde == 0 && fechaHasta == 0) || (!fechaHasta)) {
            urlajax = URL + 'compras/listar_compras_informe_table/';
        } else if (fechaDesde && fechaHasta) {
            urlajax = URL + 'compras/listar_egresos_informe_table_filtro/' + fechaDesde + '/' + fechaHasta;
        }
        if (urlajax) {
            tableListadoEgresosInforme = $('#listadoEgresosInforme').DataTable();
            $("#listadoEgresosInforme").dataTable().fnDestroy();
            $('#listadoEgresosInforme').DataTable({
                "sAjaxSource": urlajax,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }
    });
});

function setFechaInicio_informeEgreso() {
    var fechaDesde;
    fechaDesde = $('#min-date-listado-egresos-informe').val();
    document.getElementById("fechaI_informeEgreso").value = fechaDesde;
}

function setFechaFin_informeEgreso() {
    var fechaHasta;
    fechaHasta = $('#max-date-listado-egresos-informe').val();
    document.getElementById("fechaF_informeEgreso").value = fechaHasta;
}

function exportar_informe_egresos_excel() {
    var fechaDesde, fechaHasta;
    var exportar = true;
    fechaDesde = $('#min-date-listado-egresos-informe').val();
    fechaHasta = $('#max-date-listado-egresos-informe').val();
    if (!fechaDesde) {
        fechaDesde = 0;
    }
    if (!fechaHasta) {
        fechaHasta = 0;
    }
    if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
        document.getElementById("min-date-listado-egresos-informe").innerHTML = "";
        exportar = false;
    }
    if (exportar) {
        $.ajax({
            url: URL + 'compras/exportar_to_excel_egresos/' + fechaDesde + '/' + fechaHasta,
            type: 'POST',
            cache: false,
        })
    } else {
        swal(
            'Error',
            "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
            'error'
        )
    }
}

$(document).ready(function() {
    $('#exportInformeEgreso').click(function(e) {
        e.preventDefault();
        var fechaDesde, fechaHasta;
        var exportar = true;
        fechaDesde = $('#min-date-listado-egresos-informe').val();
        fechaHasta = $('#max-date-listado-egresos-informe').val();
        if (!fechaDesde) {
            fechaDesde = 0;
        }
        if (!fechaHasta) {
            fechaHasta = 0;
        }
        if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
            document.getElementById("min-date-listado-egresos-informe").innerHTML = "";
            exportar = false;
        }
        if (exportar) {
            document.getElementById("formExportInformeEgreso").submit();
        } else {
            swal(
                'Error',
                "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
                'error'
            )
        }


    });
});
//--- Fin Informe Egresos ---//

//--- Informe Gastos ---///
$(document).ready(function() {
    var table = $('#listadoGastosInforme').DataTable();
    $('#max-date-listado-gastos-informe').change(function() {
        var fechaDesde = 0;
        var fechaHasta = 0;
        var urlajax = false;
        fechaDesde = $('#min-date-listado-gastos-informe').val();
        fechaHasta = $('#max-date-listado-gastos-informe').val();
        if ((fechaDesde == 0 && fechaHasta == 0) || (!fechaHasta)) {
            urlajax = URL + 'gastos/listar_gastos_informe_table/';
        } else if (fechaDesde && fechaHasta) {
            urlajax = URL + 'gastos/listar_gastos_informe_table_filtro/' + fechaDesde + '/' + fechaHasta;
        }
        if (urlajax) {
            tableListadoGastosInforme = $('#listadoGastosInforme').DataTable();
            $("#listadoGastosInforme").dataTable().fnDestroy();
            $('#listadoGastosInforme').DataTable({
                "sAjaxSource": urlajax,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
            });
        }
    });
});

function setFechaInicio_informeGastos() {
    var fechaDesde;
    fechaDesde = $('#min-date-listado-gastos-informe').val();
    document.getElementById("fechaI_informeGasto").value = fechaDesde;
}

function setFechaFin_informeGastos() {
    var fechaHasta;
    fechaHasta = $('#max-date-listado-gastos-informe').val();
    document.getElementById("fechaF_informeGasto").value = fechaHasta;
}

function exportar_informe_gastos_excel() {
    var fechaDesde, fechaHasta;
    var exportar = true;
    fechaDesde = $('#min-date-listado-gastos-informe').val();
    fechaHasta = $('#max-date-listado-gastos-informe').val();
    if (!fechaDesde) {
        fechaDesde = 0;
    }
    if (!fechaHasta) {
        fechaHasta = 0;
    }
    if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
        document.getElementById("min-date-listado-gastos-informe").innerHTML = "";
        exportar = false;
    }
    if (exportar) {
        $.ajax({
            url: URL + 'gastos/exportar_to_excel_gastos/' + fechaDesde + '/' + fechaHasta,
            type: 'POST',
            cache: false,
        })
    } else {
        swal(
            'Error',
            "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
            'error'
        )
    }
}

$(document).ready(function() {
    $('#exportInformeGasto').click(function(e) {
        e.preventDefault();
        var fechaDesde, fechaHasta;
        var exportar = true;
        fechaDesde = $('#min-date-listado-gastos-informe').val();
        fechaHasta = $('#max-date-listado-gastos-informe').val();
        if (!fechaDesde) {
            fechaDesde = 0;
        }
        if (!fechaHasta) {
            fechaHasta = 0;
        }
        if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
            document.getElementById("min-date-listado-gastos-informe").innerHTML = "";
            exportar = false;
        }
        if (exportar) {
            document.getElementById("formExportInformeGasto").submit();
        } else {
            swal(
                'Error',
                "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
                'error'
            )
        }


    });
});
//--- Fin Informe Gastos ---//

//--- Informe Abonos ---///
$(document).ready(function() {
    var table = $('#listadoAbonosInforme').DataTable();
    $('#max-date-listado-abonos-informe').change(function() {
        var fechaDesde = 0;
        var fechaHasta = 0;
        var urlajax = false;
        fechaDesde = $('#min-date-listado-abonos-informe').val();
        fechaHasta = $('#max-date-listado-abonos-informe').val();
        if ((fechaDesde == 0 && fechaHasta == 0) || (!fechaHasta)) {
            urlajax = URL + 'abonos/listar_abonos_informe_table/';
        } else if (fechaDesde && fechaHasta) {
            urlajax = URL + 'abonos/listar_abonos_informe_table_filtro/' + fechaDesde + '/' + fechaHasta;
        }
        if (urlajax) {
            tableListadoAbonosInforme = $('#listadoAbonosInforme').DataTable();
            $("#listadoAbonosInforme").dataTable().fnDestroy();
            $('#listadoAbonosInforme').DataTable({
                "sAjaxSource": urlajax,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }
    });
});

function setFechaInicio_informeAbonos() {
    var fechaDesde;
    fechaDesde = $('#min-date-listado-abonos-informe').val();
    document.getElementById("fechaI_informeAbono").value = fechaDesde;
}

function setFechaFin_informeAbonos() {
    var fechaHasta;
    fechaHasta = $('#max-date-listado-abonos-informe').val();
    document.getElementById("fechaF_informeAbono").value = fechaHasta;
}

function exportar_informe_abonos_excel() {
    var fechaDesde, fechaHasta;
    var exportar = true;
    fechaDesde = $('#min-date-listado-abonos-informe').val();
    fechaHasta = $('#max-date-listado-abonos-informe').val();
    if (!fechaDesde) {
        fechaDesde = 0;
    }
    if (!fechaHasta) {
        fechaHasta = 0;
    }
    if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
        document.getElementById("min-date-listado-abonos-informe").innerHTML = "";
        exportar = false;
    }
    if (exportar) {
        $.ajax({
            url: URL + 'aabonos/exportar_to_excel_abonos/' + fechaDesde + '/' + fechaHasta,
            type: 'POST',
            cache: false,
        })
    } else {
        swal(
            'Error',
            "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
            'error'
        )
    }
}

$(document).ready(function() {
    $('#exportInformeAbono').click(function(e) {
        e.preventDefault();
        var fechaDesde, fechaHasta;
        var exportar = true;
        fechaDesde = $('#min-date-listado-abonos-informe').val();
        fechaHasta = $('#max-date-listado-abonos-informe').val();
        if (!fechaDesde) {
            fechaDesde = 0;
        }
        if (!fechaHasta) {
            fechaHasta = 0;
        }
        if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
            document.getElementById("min-date-listado-abonos-informe").innerHTML = "";
            exportar = false;
        }
        if (exportar) {
            document.getElementById("formExportInformeAbono").submit();
        } else {
            swal(
                'Error',
                "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
                'error'
            )
        }


    });
});
//--- Fin Informe Abonos ---//

//--- Con el change hacer aparecer el input del cbu en los proveedores si selecciona transferencia bancaria ---//
$(document).ready(function() {
    $("#selectMedioPago_formProveedor").change(function() {
        var medioPago = $('#selectMedioPago_formProveedor').val();
        if (medioPago == 2) {
            $("#CBU_proveedor").css("display", "block");
        } else {
            $("#CBU_proveedor").css("display", "none");
        }
    });
});
//--- FIN ---//

//--- Funcion de totales para el informe de las cuentas corrientes ---//
function totales_informe_cte_proveedores(fechaDesde, fechaHasta, idProveedor) {
    //console.log(fechaDesde);
    //console.log(fechaHasta);
    //console.log(idProveedor);
    if (fechaHasta == '') {
        fechaHasta = 0;
    }
    if (fechaDesde == '') {
        fechaDesde = 0;
    }
    $.ajax({
            url: URL + 'informes/totales_cte_proveedores/' + fechaDesde + '/' + fechaHasta + '/' + idProveedor,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                document.getElementById("totalCompradoProveedores").innerHTML = "$ " + number_format(dato["totalComprado"], 2);
                document.getElementById("totalPagadoProveedores").innerHTML = "$ " + number_format(dato["totalPagado"], 2);
                document.getElementById("totalAPagarProveedores").innerHTML = "$ " + number_format(dato["totalAPagar"], 2);
            } else {
                document.getElementById("totalCompradoProveedores").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalPagadoProveedores").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalAPagarProveedores").innerHTML = "$ " + number_format(0, 2);
            }
        })
}

function totales_informe_cte_proveedores_totales() {
    $.ajax({
            url: URL + 'informes/totales_cte_proveedores_total/',
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                document.getElementById("totalCompradoProveedores").innerHTML = "$ " + number_format(dato["totalComprado"], 2);
                document.getElementById("totalPagadoProveedores").innerHTML = "$ " + number_format(dato["totalPagado"], 2);
                document.getElementById("totalAPagarProveedores").innerHTML = "$ " + number_format(dato["totalAPagar"], 2);
            } else {
                document.getElementById("totalCompradoProveedores").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalPagadoProveedores").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalAPagarProveedores").innerHTML = "$ " + number_format(0, 2);
            }
        })
}
//--- FIN ---//

//--- Metodo para el filtrado del listado de las cte de proveedores de los proveedores ---//
$(document).ready(function() {
    $("#selectProveedorCte").change(function() {
        var fechaDesde = $('#min-date-listado-cte-proveedores-informe').val();
        var fechaHasta = $('#max-dat\n\
\n\
\n\
\n\
e-listado-cte-proveedores-informe').val();
        var idProveedor = $('#selectProveedorCte').val();
        if (idProveedor == "") {
            idProveedor = 0;
            urlAjax = URL + "informes/listar_cte_proveedores_table";
        } else {
            urlAjax = URL + "informes/listar_cte_proveedores_table_filtro/" + idProveedor;
        }
        //console.log('idProveedores' + idProveedor);
        //console.log('fechaDesde' + fechaDesde);
        //console.log('fechaHasta' + fechaHasta);
        tableListadoCtaCteProveedor = $('#listadoCtaCteProveedor').DataTable();
        $("#listadoCtaCteProveedor").dataTable().fnDestroy();
        $('#listadoCtaCteProveedor').DataTable({
            "sAjaxSource": urlAjax,
            "bSort": true,
            "paging": true,
            "aaSorting": [0, 'asc'],
            "initComplete": function() {
                setTimeout(function() {
                    totales_informe_cte_proveedores(fechaDesde, fechaHasta, idProveedor);
                }, 100);
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "aoColumns": [
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' }
            ],
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false,
                className: "hide_column",
            }]
        })
    });
});
//--- FIN ---//

//--- Funcion de totales para el informe de las cuentas corrientes de los clientes ---//
function totales_informe_cte_clientes(idCliente, fechaDesde, fechaHasta) {
    //console.log(idCliente);
    //console.log(fechaDesde);
    //console.log(fechaHasta);
    if (fechaDesde == '') {
        fechaDesde = 0;
    }
    if (fechaHasta == '') {
        fechaHasta = 0;
    }
    $.ajax({
            url: URL + 'informes/totales_cte_clientes/' + idCliente + '/' + fechaDesde + '/' + fechaHasta,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                document.getElementById("totalVenta").innerHTML = "$ " + number_format(dato["totalVenta"], 2);
                document.getElementById("totalCobrado").innerHTML = "$ " + number_format(dato["totalCobrado"], 2);
                document.getElementById("totalAdeudado").innerHTML = "$ " + number_format(dato["totalACobrar"], 2);
            } else {
                document.getElementById("totalVenta").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalCobrado").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalAdeudado").innerHTML = "$ " + number_format(0, 2);
            }
        })
}

function totales_cte_clientes_total() {
    $.ajax({
            url: URL + 'informes/totales_cte_clientes_total/',
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                document.getElementById("totalVenta").innerHTML = "$ " + number_format(dato["totalVenta"], 2);
                document.getElementById("totalCobrado").innerHTML = "$ " + number_format(dato["totalCobrado"], 2);
                document.getElementById("totalAdeudado").innerHTML = "$ " + number_format(dato["totalACobrar"], 2);
            } else {
                document.getElementById("totalVenta").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalCobrado").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalAdeudado").innerHTML = "$ " + number_format(0, 2);
            }
        })
}
//--- FIN ---//

//--- Metodo para el filtrado del listado de las cte de clientes ---//
$(document).ready(function() {
    $("#selectClienteCte").change(function() {

        var idCliente = $('#selectClienteCte').val();
        var fechaDesde = $('#min-date-listado-cte-clientes-informe').val();
        var fechaHasta = $('#max-date-listado-cte-clientes-informe').val();
        var urlAjax;
        if (idCliente == '') {
            idCliente = 0;
        }
        //console.log(idCliente);
        //console.log(fechaDesde);
        //console.log(fechaHasta);
        if (idCliente == 0 && fechaDesde == '' && fechaHasta == '') {
            idCliente = 0;
            urlAjax = URL + "informes/listar_cte_clientes_table";
        } else if (idCliente != 0 && fechaDesde == '' && fechaHasta == '') {
            urlAjax = URL + "informes/listar_cte_clientes_table_filtro/" + idCliente;
        } else if (fechaDesde != '' && fechaHasta != '') {
            urlAjax = URL + "informes/listar_cte_clientes_table_filtro_date/" + fechaDesde + '/' + fechaHasta + '/' + idCliente;
        }
        tableListadoCtaCte = $('#listadoCtaCte').DataTable();
        $("#listadoCtaCte").dataTable().fnDestroy();
        $('#listadoCtaCte').DataTable({
            "sAjaxSource": urlAjax,
            "bSort": true,
            "paging": true,
            "aaSorting": [0, 'asc'],
            "initComplete": function() {
                setTimeout(function() {
                    totales_informe_cte_clientes(idCliente, fechaDesde, fechaHasta);
                }, 100);
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "aoColumns": [
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' }
            ],
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false,
                className: "hide_column",
            }]
        })
    });
});
//--- FIN ---//

//--- Informe Cte Clientes ---///
$(document).ready(function() {
    var table = $('#listadoCtaCte').DataTable();
    $('#max-date-listado-cte-clientes-informe').change(function() {
        var fechaDesde = $('#min-date-listado-cte-clientes-informe').val();
        var fechaHasta = $('#max-date-listado-cte-clientes-informe').val();
        var selectClienteCte = $('#selectClienteCte').val();;
        var urlajax = false;
        if (selectClienteCte == '') {
            selectClienteCte = 0;
        }

        if (selectClienteCte == 0 && fechaDesde == '' && fechaHasta == '') {
            //            //console.log("Entre 1");
            selectClienteCte = 0;
            urlajax = URL + "informes/listar_cte_clientes_table";
        } else if (selectClienteCte != 0 && fechaDesde == '' && fechaHasta == '') {
            //            //console.log("Entre 2");
            urlajax = URL + "informes/listar_cte_clientes_table_filtro/" + selectClienteCte;
        } else if (fechaDesde != '' && fechaHasta != '') {
            //            //console.log("Entre 3");
            urlajax = URL + "informes/listar_cte_clientes_table_filtro_date/" + fechaDesde + '/' + fechaHasta + '/' + selectClienteCte;
        }

        if (urlajax) {
            tableListadoCteClientesInforme = $('#listadoCtaCte').DataTable();
            $("#listadoCtaCte").dataTable().fnDestroy();
            $('#listadoCtaCte').DataTable({
                "sAjaxSource": urlajax,
                "bSort": true,
                "paging": true,
                "aaSorting": [0, 'asc'],
                "initComplete": function() {
                    setTimeout(function() {
                        totales_informe_cte_clientes(selectClienteCte, fechaDesde, fechaHasta);
                    }, 100);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column",
                }]
            })
        }
    });
});

function totales_cte_clientes_date(desde, hasta) {
    //console.log(desde);
    //console.log(hasta);
    $.ajax({
            url: URL + 'informes/totales_cte_clientes_date/' + desde + "/" + hasta,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                document.getElementById("totalVenta").innerHTML = "$ " + number_format(dato["totalVenta"], 2);
                document.getElementById("totalCobrado").innerHTML = "$ " + number_format(dato["totalCobrado"], 2);
                document.getElementById("totalAdeudado").innerHTML = "$ " + number_format(dato["totalACobrar"], 2);
            } else {
                document.getElementById("totalVenta").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalCobrado").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalAdeudado").innerHTML = "$ " + number_format(0, 2);
            }
        })
}

function setFechaInicio_informeCteClientes() {
    var fechaDesde;
    fechaDesde = $('#min-date-listado-cte-clientes-informe').val();
    document.getElementById("fechaI_informeCteClientes").value = fechaDesde;
}

function setFechaFin_informeCteClientes() {
    var fechaHasta;
    fechaHasta = $('#max-date-listado-cte-clientes-informe').val();
    document.getElementById("fechaF_informeCteClientes").value = fechaHasta;
}

function setIdCliente_informeCteClientes() {
    var idCliente;
    idCliente = $('#selectClienteCte').val();
    document.getElementById("selectClienteCte_informeCteClientes").value = idCliente;
}

function exportar_informe_cte_clientes_excel() {
    var fechaDesde, fechaHasta, selectClienteCte;
    var exportar = true;
    fechaDesde = $('#min-date-listado-cte-clientes-informe').val();
    fechaHasta = $('#max-date-listado-cte-clientes-informe').val();
    selectClienteCte = $('#selectClienteCte').val();
    if (!fechaDesde) {
        fechaDesde = 0;
    }
    if (!fechaHasta) {
        fechaHasta = 0;
    }
    if (selectClienteCte == "") {
        selectClienteCte = 0;
    }
    if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
        document.getElementById("min-date-listado-cte-clientes-informe").innerHTML = "";
        exportar = false;
    }
    if (exportar) {
        $.ajax({
            url: URL + 'informes/exportar_to_excel_cte_clientes/' + fechaDesde + '/' + fechaHasta + '/' + selectClienteCte,
            type: 'POST',
            cache: false,
        })
    } else {
        swal(
            'Error',
            "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
            'error'
        )
    }
}

$(document).ready(function() {
    $('#exportInformeCteClientes').click(function(e) {
        e.preventDefault();
        var fechaDesde, fechaHasta;
        var exportar = true;
        fechaDesde = $('#min-date-listado-cte-clientes-informe').val();
        fechaHasta = $('#max-date-listado-cte-clientes-informe').val();
        if (!fechaDesde) {
            fechaDesde = 0;
        }
        if (!fechaHasta) {
            fechaHasta = 0;
        }
        if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
            document.getElementById("min-date-listado-cte-clientes-informe").innerHTML = "";
            exportar = false;
        }
        if (exportar) {
            document.getElementById("formExportInformeCteClientes").submit();
        } else {
            swal(
                'Error',
                "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
                'error'
            )
        }


    });
});
//--- Fin Informe cte clientes ---//

//--- Informe Cte Proveedores ---///
$(document).ready(function() {
    var table = $('#listadoCtaCteProveedor').DataTable();
    $('#max-date-listado-cte-proveedores-informe').change(function() {
        var fechaDesde = $('#min-date-listado-cte-proveedores-informe').val();
        var fechaHasta = $('#max-date-listado-cte-proveedores-informe').val();
        var selectProveedorCte = $('#selectProveedorCte').val();
        var urlajax = false;
        if (selectProveedorCte == '') {
            selectProveedorCte = 0;
        }

        if (selectProveedorCte == 0 && fechaDesde == '' && fechaHasta == '') {
            urlajax = URL + 'informes/listar_cte_proveedores_table/';
        } else if (selectProveedorCte != 0 && fechaDesde == '' && fechaHasta == '') {
            urlajax = URL + "informes/listar_cte_proveedores_table_filtro/" + selectProveedorCte;
        } else if (fechaDesde != '' && fechaHasta != '') {
            urlajax = URL + 'informes/listar_cte_proveedores_table_filtro_date/' + fechaDesde + '/' + fechaHasta + '/' + selectProveedorCte;
        }
        //        if (fechaDesde == '') {
        //            fechaDesde = 0;
        //        }
        //        if (fechaHasta == '') {
        //            fechaHasta = 0;
        //        }

        if (urlajax) {
            tableListadoCteProveedorInforme = $('#listadoCtaCteProveedor').DataTable();
            $("#listadoCtaCteProveedor").dataTable().fnDestroy();
            $('#listadoCtaCteProveedor').DataTable({
                "sAjaxSource": urlajax,
                "bSort": true,
                "paging": true,
                "aaSorting": [0, 'asc'],
                "initComplete": function() {
                    setTimeout(function() {
                        totales_informe_cte_proveedores(fechaDesde, fechaHasta, selectProveedorCte);
                    }, 100);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column",
                }]
            })
        }
    });
});

function totales_cte_proveedores_date(desde, hasta) {
    //console.log(desde);
    //console.log(hasta);
    $.ajax({
            url: URL + 'informes/totales_cte_proveedores_date/' + desde + "/" + hasta,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                document.getElementById("totalCompradoProveedores").innerHTML = "$ " + number_format(dato["totalComprado"], 2);
                document.getElementById("totalPagadoProveedores").innerHTML = "$ " + number_format(dato["totalPagado"], 2);
                document.getElementById("totalAPagarProveedores").innerHTML = "$ " + number_format(dato["totalAPagar"], 2);
            } else {
                document.getElementById("totalCompradoProveedores").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalPagadoProveedores").innerHTML = "$ " + number_format(0, 2);
                document.getElementById("totalAPagarProveedores").innerHTML = "$ " + number_format(0, 2);
            }
        })
}

function setFechaInicio_informeCteProveedores() {
    var fechaDesde;
    fechaDesde = $('#min-date-listado-cte-proveedores-informe').val();
    document.getElementById("fechaI_informeCteProveedores").value = fechaDesde;
}

function setFechaFin_informeCteProveedores() {
    var fechaHasta;
    fechaHasta = $('#max-date-listado-cte-proveedores-informe').val();
    document.getElementById("fechaF_informeCteProveedores").value = fechaHasta;
}

function setIdCliente_informeCteProveedores() {
    var idProveedor;
    idProveedor = $('#selectProveedorCte').val();
    document.getElementById("selectProveedorCte_informeCteProveedores").value = idProveedor;
}

function exportar_informe_cte_proveedores_excel() {
    var fechaDesde, fechaHasta, selectProveedorCte;
    var exportar = true;
    fechaDesde = $('#min-date-listado-cte-proveedores-informe').val();
    fechaHasta = $('#max-date-listado-cte-proveedores-informe').val();
    selectProveedorCte = $('#selectProveedorCte').val();
    if (!fechaDesde) {
        fechaDesde = 0;
    }
    if (!fechaHasta) {
        fechaHasta = 0;
    }
    if (selectProveedorCte == "") {
        selectProveedorCte = 0;
    }
    if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
        document.getElementById("min-date-listado-cte-proveedores-informe").innerHTML = "";
        exportar = false;
    }
    if (exportar) {
        $.ajax({
            url: URL + 'informes/exportar_to_excel_cte_proveedores/' + fechaDesde + '/' + fechaHasta + '/' + selectProveedorCte,
            type: 'POST',
            cache: false,
        })
    } else {
        swal(
            'Error',
            "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
            'error'
        )
    }
}

$(document).ready(function() {
    $('#exportInformeCteProveedores').click(function(e) {
        e.preventDefault();
        var fechaDesde, fechaHasta;
        var exportar = true;
        fechaDesde = $('#min-date-listado-cte-proveedores-informe').val();
        fechaHasta = $('#max-date-listado-cte-proveedores-informe').val();
        if (!fechaDesde) {
            fechaDesde = 0;
        }
        if (!fechaHasta) {
            fechaHasta = 0;
        }
        if ((fechaDesde && !fechaHasta) || (!fechaDesde && fechaHasta)) {
            document.getElementById("min-date-listado-cte-proveedores-informe").innerHTML = "";
            exportar = false;
        }
        if (exportar) {
            document.getElementById("formExportInformeCteProveedores").submit();
        } else {
            swal(
                'Error',
                "Corrobore que se haya colocado correctamente ambas fechas por las que se desea filtrar o no colocar ninguna.",
                'error'
            )
        }


    });
});
//--- Fin Informe cte Proveedores ---//

//--- Inicio de marcar notificaciones de gastos y egresos como leidas --//
function marcar_leida_notificacion_egreso(idGenEgreso, fechaRegistroNotificacion) {
    //    //console.log("idGenEgreso: " + idGenEgreso);
    $.ajax({
            url: URL + 'compras/update_notificacion_leida/',
            type: 'POST',
            cache: false,
            data: {
                idGenEgreso: idGenEgreso,
                fechaRegistroNotificacion: fechaRegistroNotificacion
            },
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                swal({
                    title: "Notificacion de egreso leida",
                    text: "Notificacion Leida",
                    type: "info",
                    width: "400px",
                    //                        showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        });
}

function marcar_leida_notificacion_gasto(idGenGasto, fechaRegistroNotificacion) {
    //    //console.log("idGenGasto: " + idGenGasto);
    $.ajax({
            url: URL + 'gastos/update_notificacion_leida/',
            type: 'POST',
            cache: false,
            data: {
                idGenGasto: idGenGasto,
                fechaRegistroNotificacion: fechaRegistroNotificacion
            },
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            //console.log("HOLIZS");
            if (dato['valid']) {
                swal({
                    title: "Notificacion de gasto leida",
                    text: "Notificacion Leida",
                    type: "info",
                    width: "400px",
                    //                        showCancelButton: false,
                    confirmButtonText: 'Cerrar',
                })
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        });
}
//--- Fin de marcar notificaciones de gastos y egresos como leidas --//

//--- Cambios de estados de presupuestos ---//

function cambiar_estado_presupuesto_pendiente(idGenPresupuesto) {
    ////console.log(idGenPresupuesto);
    swal({
        type: 'question',
        text: '¿ Estás seguro que quieres cambiar el estado del presupuesto a Pendiente ?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(URL + "presupuesto/pendiente_presupuesto/" + idGenPresupuesto)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            var element = document.getElementById("btn" + idGenPresupuesto);
            //--- anterior estado ---//
            element.classList.remove("btn-success");
            element.classList.remove("btn-danger");
            element.classList.remove("btn-info");
            //--- nuevo estado ---//
            element.classList.add("btn-warning");
            element.innerText = "Pendiente";
            //--- cambios de estados visibles ---//
            $("#pendiente" + idGenPresupuesto).css("display", "none");
            $("#enviar" + idGenPresupuesto).css("display", "block");
            $("#rechazar" + idGenPresupuesto).css("display", "block");
            $("#aceptado" + idGenPresupuesto).css("display", "block");
            swal(
                'Presupuesto',
                'El presupuesto fue cambiado a pendiente con exito',
                'success'
            )
        }
    })
}

function cambiar_estado_presupuesto_enviado(idGenPresupuesto) {
    ////console.log(idGenPresupuesto);
    swal({
        type: 'question',
        text: '¿ Estás seguro que quieres cambiar el estado del presupuesto a Enviado ?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(URL + "presupuesto/enviar_presupuesto/" + idGenPresupuesto)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            var element = document.getElementById("btn" + idGenPresupuesto);
            //--- anterior estado ---//
            element.classList.remove("btn-success");
            element.classList.remove("btn-danger");
            element.classList.remove("btn-warning");
            //--- nuevo estado ---//
            element.classList.add("btn-info");
            element.innerText = "Enviado";
            //--- cambios de estados visibles ---//
            $("#pendiente" + idGenPresupuesto).css("display", "block");
            $("#enviar" + idGenPresupuesto).css("display", "none");
            $("#rechazar" + idGenPresupuesto).css("display", "block");
            $("#aceptado" + idGenPresupuesto).css("display", "block");
            swal(
                'Presupuesto',
                'El presupuesto fue cambiado a enviado con exito',
                'success'
            )
        }
    })
}

function cambiar_estado_presupuesto_rechazado(idGenPresupuesto) {
    ////console.log(idGenPresupuesto);
    swal({
        type: 'question',
        text: '¿ Estás seguro que quieres cambiar el estado del presupuesto a Rechazado ?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(URL + "presupuesto/rechazar_presupuesto/" + idGenPresupuesto)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            var element = document.getElementById("btn" + idGenPresupuesto);
            //--- anterior estado ---//
            element.classList.remove("btn-success");
            element.classList.remove("btn-info");
            element.classList.remove("btn-warning");
            //--- nuevo estado ---//
            element.classList.add("btn-danger");
            element.innerText = "Rechazado";
            //--- cambios de estados visibles ---//
            $("#pendiente" + idGenPresupuesto).css("display", "block");
            $("#enviar" + idGenPresupuesto).css("display", "block");
            $("#rechazar" + idGenPresupuesto).css("display", "none");
            $("#aceptado" + idGenPresupuesto).css("display", "block");
            swal(
                'Presupuesto',
                "El presupuesto fue cambiado a rechazado con exito",
                'success'
            )
        }
    })
}

function cambiar_estado_presupuesto_aceptado(idGenPresupuesto) {
    ////console.log(idGenPresupuesto);
    swal({
        type: 'question',
        text: '¿ Estás seguro que quieres cambiar el estado del presupuesto a Aceptado ?',
        showCancelButton: true,
        confirmButtonText: 'Si',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(URL + "presupuesto/aceptar_presupuesto/" + idGenPresupuesto)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            var element = document.getElementById("btn" + idGenPresupuesto);
            //--- anterior estado ---//
            element.classList.remove("btn-danger");
            element.classList.remove("btn-info");
            element.classList.remove("btn-warning");
            //--- nuevo estado ---//
            element.classList.add("btn-success");
            element.innerText = "Aceptado";
            //--- cambios de estados visibles ---//
            $("#pendiente" + idGenPresupuesto).css("display", "block");
            $("#enviar" + idGenPresupuesto).css("display", "block");
            $("#rechazar" + idGenPresupuesto).css("display", "block");
            $("#aceptado" + idGenPresupuesto).css("display", "none");
            swal(
                'Presupuesto',
                "El presupuesto fue cambiado a aceptado con exito",
                'success'
            )
        }
    })
}


//--- Fin Cambios de estados de presupuestos ---//

//--- Crear una venta a partir de una presupuesto ---//
function agregar_venta_presupuesto(idGenPresupuesto) {
    //--- validamos si se contiene un presupuesto ---//
    if (idGenPresupuesto) {
        //--- URL a la que se redireccionara ---//
        var url_redireccion = URL + 'ventas/agregar_venta_presupuesto/' + idGenPresupuesto;
        setTimeout(function() {
            location.href = url_redireccion;
        }, 850);
    } else {

        swal(
            'Error',
            "No se obtuvo el id del presupuesto, vuelva a intentarlo",
            'error'
        )
    }
}


function llenado_tabla_venta_presupuesto(idGenPresupuesto) {
    //    //console.log("entre al llenado");
    //console.log(idGenPresupuesto);
    if (idGenPresupuesto) {
        setTimeout(function() {
            tableListadoVentaPresupuesto = $('#listadoVentaPresupuesto').DataTable();
            $("#listadoVentaPresupuesto").dataTable().fnDestroy();
            $('#listadoVentaPresupuesto').DataTable({
                "sAjaxSource": URL + "ventas/listar_venta_presupuesto_table/" + idGenPresupuesto,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        totalVentaPresupuesto();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0, 10],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column",
                }]
            });
        }, 1000);
    } else {
        //console.log("No hay id");
    }

}

function totalVentaPresupuesto() {
    var idCliente = $('#selectCliente').val();
    if (idCliente) {
        $.ajax({
                url: URL + 'ventas/get_cliente/' + idCliente,
                type: 'POST',
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    //Totales
                    tableListadoVentaPresupuesto = $('#listadoVentaPresupuesto').DataTable();
                    var info = tableListadoVentaPresupuesto.page.info();
                    if (info == null) {
                        //console.log('Tabla VENTAS PRESUPUESTO no definida');
                    } else {
                        //console.log('Tabla VENTAS PRESUPUESTO definida');
                        var count = info.recordsTotal;
                        var tabla = tableListadoVentaPresupuesto.data();
                        total = 0;
                        totalNoGravado = 0;
                        totalIva = 0;
                        descTotal = 0;
                        for (var i = 0; i < count; i++) {
                            //        var idInputSubTotal = "subTotalProd"+tabla[i][0];
                            //        var valorInputSubTotal= $('#'+idInputSubTotal).val();

                            var descProd = $('#descProd' + tabla[i][0]).val();
                            var descProd = parseFloat(descProd) / parseFloat(100);
                            var precioProd = $('#precioProd' + tabla[i][0]).val();
                            var cantidadProducto = $('#cantProd' + tabla[i][0]).val();
                            //             //console.log("descProd: "+descProd);
                            //             //console.log("precioProd: "+precioProd);
                            //             //console.log("cantidadProducto: "+cantidadProducto);

                            //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
                            var subtotalProducto = cantidadProducto * precioProd;
                            //            //console.log("subtotalProducto1: "+subtotalProducto);

                            if (descProd != 0) {
                                descTotal = parseFloat(descTotal) + parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseFloat(subtotalProducto) * (descProd)));
                                //                //console.log("subtotalProducto2: " + subtotalProducto);
                            }

                            var ivaProducto = $('#selectIva' + tabla[i][0]).val();
                            var iva = parseFloat(subtotalProducto) * parseFloat(ivaProducto);
                            var subtotalProductoNoGravado = parseFloat(subtotalProducto);
                            var subtotalProducto = parseFloat(subtotalProducto) + parseFloat(iva);
                            total = parseFloat(total) + parseFloat(subtotalProducto);
                            totalNoGravado = parseFloat(totalNoGravado) + parseFloat(subtotalProductoNoGravado);
                            totalIva = parseFloat(totalIva) + parseFloat(iva);
                        }
                        //--- Descuentos ---//
                        document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2);
                        var descuentoCliente = total * (dato['descuento'] / 100);
                        document.getElementById('descuentoCliente').value = parseFloat(descuentoCliente).toFixed(2);
                        var descuentoTotal = descuentoCliente + descTotal;
                        document.getElementById('descuentoTotal').value = parseFloat(descuentoTotal).toFixed(2);
                        //--- Totales ---//
                        document.getElementById('importeNoGravado').value = parseFloat(totalNoGravado - descuentoCliente).toFixed(2);
                        document.getElementById('totalVenta').value = parseFloat(total).toFixed(2);
                        /*
                                document.getElementById('importeNoGravado').value = parseFloat(totalNoGravado).toFixed(2);
                                document.getElementById('totalVenta').value = parseFloat(total).toFixed(2);
                                document.getElementById('descEfectuado').value = parseFloat(descTotal).toFixed(2); */
                        //        //console.log("Total Venta: "+total);
                        //        //console.log(tableListadoVenta.data());
                    }
                }
            });
    }
}

function deleteRowListaVentaPresupuesto(id) {
    tableListadoVentaPresupuesto = $('#listadoVentaPresupuesto').DataTable();
    tableListadoVentaPresupuesto.row('#' + id).remove().draw();
    totalVentaPresupuesto();
}

function calculoVentaPresupuesto(idInput, stock, cantidadAnterior) {
    var descProd = $('#descProd' + idInput).val();
    var descProd = parseFloat(descProd) / parseFloat(100);
    var precioProd = $('#precioProd' + idInput).val();
    var cantidadProducto = $('#cantProd' + idInput).val();
    //Siempre lo debo calcular asi porque sino me toma valores que no corresponden del subtotal
    var subtotalProducto = cantidadProducto * precioProd;
    var subtotalProducto = parseFloat(subtotalProducto) - parseFloat((parseInt(subtotalProducto) * (descProd)));
    //    var ivaProducto = $('#selectIva'+idInput).val();
    //    var iva = parseFloat(subtotalProducto)*parseFloat(ivaProducto);    

    if ((cantidadProducto - cantidadAnterior) > stock) {
        $("#errorStock" + idInput).css("display", "block");
        //console.log("Entrar");
    } else {
        $("#errorStock" + idInput).css("display", "none");
        document.getElementById('subTotalProd' + idInput).value = subtotalProducto;
        totalVentaPresupuesto();
    }
}

$(document).ready(function() {
    //Agregar producto
    $("#selectProductos_venta_presupuesto").change(function() {
        $("#selectProductos_venta_presupuesto option:selected").each(function() {
            var idProducto = $('#selectProductos_venta_presupuesto').val();
            if (idProducto == "addProdNew_venta_presupuesto") {
                addProductoNewVentaPresupuesto();
            } else if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        //                //console.log(dato);

                        if (dato['valid']) {
                            if (dato['producto'][0]['stock'] > 0) {
                                //--- AGREGO FILA ---//
                                $("#errorStockProducto").css("display", "none");
                                var iva_tipos_option;
                                if (dato['iva_tipos']) {
                                    for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                        iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                    }
                                }

                                tableListadoPresupuesto = $('#listadoVentaPresupuesto').DataTable();
                                var info = tableListadoPresupuesto.page.info();
                                var count = info.recordsTotal;
                                var tabla = tableListadoPresupuesto.data();
                                var p = 0;
                                for (var i = 0; i < count; i++) {
                                    if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                        p++;
                                    }
                                }

                                idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                                if (p == 0) {
                                    var row = tableListadoPresupuesto.row.add([
                                        dato['producto'][0]['idProducto'],
                                        dato['producto'][0]['codigo'],
                                        dato['producto'][0]['nombre'],
                                        '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVentaPresupuesto(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['producto'][0]['stock'] + ')" class="form-control">' +
                                        '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                        'Stock: ' + dato['producto'][0]['stock'] +
                                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                        dato['producto'][0]['stock'],
                                        '<div class="input-group">' +
                                        '<span class="input-group-addon">$</span>' +
                                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                        '</div>',
                                        '<div class="input-group">' +
                                        '<span class="input-group-addon">%</span>' +
                                        '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVentaPresupuesto(' + idProducto + ')" class="form-control">' +
                                        '</div>',
                                        '<div class="input-group">' +
                                        '<span class="input-group-addon">$</span>' +
                                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                        '</div>',
                                        '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVentaPresupuesto(' + idProducto + ')" required>' +
                                        '<option value="0">IVA</option>' +
                                        iva_tipos_option +
                                        '</select>',
                                        '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVentaPresupuesto(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                                        '&nbsp;',
                                        dato['producto'][0]['idProducto'],
                                    ]).draw(false);
                                    row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                    tableListadoPresupuesto.row(row).column(0).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(1).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(2).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(3).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(4).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(5).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(6).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(7).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(8).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(9).nodes().to$().addClass('text-center');
                                    tableListadoPresupuesto.row(row).column(10).nodes().to$().addClass('text-center');
                                    calculoVentaPresupuesto(dato['producto'][0]['idProducto']);
                                } else {
                                    $("#modal-cargando").modal("hide");
                                    document.getElementById("msgError").innerHTML = "El producto ya se encuentra inluido en la lista.";
                                    $("#popUpErrorMsg").modal("show");
                                }
                                $("#modal-cargando").modal("hide");
                            } else {
                                //console.log('Sin Stock');
                                $("#modal-cargando").modal("hide");
                                $("#errorStockProducto").css("display", "block");
                            }
                        } else {
                            $("#modal-cargando").modal("hide");
                            $("#modal-exitoso").modal("hide");
                            $("#popUpError").modal("show");
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    })
});
//--- Agregar producto nuevo - no esta en la bd Venta---//
function addProductoNewVentaPresupuesto() {
    $("#modal-cargando").modal("show");
    $.ajax({
            url: URL + 'productos/get_idGenProducto/',
            type: 'POST',
            data: { idProducto: 0 }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //                //console.log(dato);

            if (dato['valid']) {
                $("#modal-cargando").modal("hide");
                var idGenProd = "'" + dato['idGenProducto'] + "'";
                tableListadoVentaPresupuesto = $('#listadoVentaPresupuesto').DataTable();
                var row = tableListadoVentaPresupuesto.row.add([
                    dato['idGenProducto'],
                    '<input type="text" value="' + dato['idGenProducto'] + '" id="codProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    '<input type="text" placeholder="Descripcion" id="nombProd' + dato['idGenProducto'] + '" class="form-control">' +
                    '<div id="errorNombProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>',
                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['idGenProducto'] + '" readonly class="form-control"><input type="hidden" value="0" id="altaProd' + dato['idGenProducto'] + '" readonly class="form-control">',
                    1,
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="precioProd' + dato['idGenProducto'] + '" onkeyup="calculoVentaPresupuesto(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '<div id="errorPrecioProd' + dato['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                    'Campo obligatorio' +
                    '</div>' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">%</span>' +
                    '<input type="text" value="' + 0 + '" readonly id="descProd' + dato['idGenProducto'] + '" onkeyup="calculoVentaPresupuesto(' + idGenProd + ',' + 1 + ',' + 0 + ')" class="form-control">' +
                    '</div>',
                    '<div class="input-group">' +
                    '<span class="input-group-addon">$</span>' +
                    '<input type="text" value="' + 0 + '" id="subTotalProd' + dato['idGenProducto'] + '" readonly class="form-control">' +
                    '</div>',
                    '<select id="selectIva' + dato['idGenProducto'] + '" disabled class="select-full" onchange="calculoVenta(' + idGenProd + ',' + 1 + ',' + 0 + ')" required>' +
                    '<option value="0">IVA</option>' +
                    '</select>',
                    '<i class="fas fa-save" id="idAgregarP' + dato['idGenProducto'] + '" style="dispaly: block;font-size: 1.6em;padding-right: 5px;" onclick="saveProductoTemporalPresupuesto(' + idGenProd + ')"></i>' +
                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVentaPresupuesto(' + idGenProd + ')"></i>' +
                    '&nbsp;',
                    dato['idGenProducto'],
                ]).draw(false);
                row.nodes().to$().attr('id', dato['idGenProducto']);
                tableListadoVentaPresupuesto.row(row).column(0).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(1).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(2).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(3).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(4).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(5).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(6).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(7).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(8).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(9).nodes().to$().addClass('text-center');
                tableListadoVentaPresupuesto.row(row).column(10).nodes().to$().addClass('text-center');
            } else {
                $("#modal-cargando").modal("hide");
                document.getElementById("msgError").innerHTML = dato['msg'];
                $("#modal-exitoso").modal("hide");
                $("#popUpErrorMsg").modal("show");
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#modal-exitoso").modal("hide");
            $("#popUpError").modal("show");
        });
}

function saveProductoTemporalPresupuesto(id) {
    $("#modal-cargando").modal("show");
    tableListadoVentaPresupuesto = $('#listadoVentaPresupuesto').DataTable();
    row = tableListadoVentaPresupuesto.row("#" + id).data();
    var idGenProducto = row[0];
    var inputCodigo = $('#codProd' + row[0]).val();
    var inputNombre = $('#nombProd' + row[0]).val();
    var inputPrecioVenta = $('#precioProd' + row[0]).val();
    var subTotalProd = $('#subTotalProd' + row[0]).val();
    var descProd = $('#descProd' + row[0]).val();
    if (inputNombre == null || inputNombre.length == 0 || inputNombre == ' ' || inputNombre == '') {
        $("#errorNombProd" + id).css("display", "block");
        val1 = false;
    } else {
        $("#errorNombProd" + id).css("display", "none");
        val1 = true;
    }
    if (inputPrecioVenta == null || inputPrecioVenta.length == 0 || inputPrecioVenta == 0 || inputPrecioVenta == ' ' || inputPrecioVenta == '' || isNaN(inputPrecioVenta)) {
        $("#errorPrecioProd" + id).css("display", "block");
        val2 = false;
    } else {
        $("#errorPrecioProd" + id).css("display", "none");
        val2 = true;
    }
    //    //console.log("val1: "+val1);
    //    //console.log("val2: "+val2);


    if (val1 && val2) {
        $.ajax({
                url: URL + 'productos/set_producto_temporal/',
                type: 'POST',
                data: { idGenProducto: idGenProducto, inputCodigo: inputCodigo, inputNombre: inputNombre, inputPrecioVenta: inputPrecioVenta }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-cargando").modal("hide");
                    var iva_tipos_option;
                    if (dato['iva_tipos']) {
                        for (var i = 0; i < dato['iva_tipos'].length; i++) {
                            iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                        }
                    }
                    idGenProducto = "'" + dato['producto'][0]['idGenProducto'] + "'";
                    //                $("#idAgregarP"+id).css("display", "none");
                    row[0] = dato['producto'][0]['idProducto'];
                    row[2] = inputNombre;
                    row[3] = '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" readonly onkeyup="calculoVentaPresupuesto(' + idGenProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['producto'][0]['stock'] + ')" class="form-control">' +
                        '<div id="errorStock' + dato['producto'][0]['idGenProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                        'Stock: ' + dato['producto'][0]['stock'] +
                        '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">';
                    row[5] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                        '</div>';
                    row[6] = '<div class="input-group">' +
                        '<span class="input-group-addon">%</span>' +
                        '<input type="text" value="' + descProd + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoVentaPresupuesto(' + dato['producto'][0]['idProducto'] + ')" class="form-control">' +
                        '</div>';
                    row[7] = '<div class="input-group">' +
                        '<span class="input-group-addon">$</span>' +
                        '<input type="text" value="' + subTotalProd + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                        '</div>';
                    row[8] = '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoVentaPresupuesto(' + dato['producto'][0]['idProducto'] + ')" required>' +
                        '<option value="0">IVA</option>' +
                        iva_tipos_option +
                        '</select>';
                    row[9] = '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaVentaPresupuesto(' + dato['producto'][0]['idProducto'] + ')"></i>' +
                        '&nbsp;';
                    row[10] = dato['producto'][0]['idProducto'];
                    tableListadoVentaPresupuesto.row("#" + id).data(row);
                    tableListadoVentaPresupuesto.row("#" + id).nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                    //                document.getElementById("altaProd"+id).value = "1";
                    $("#operacionExitosa").modal("show");
                    totalVentaPresupuesto();
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }

            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                var dato = JSON.parse(data);
                document.getElementById("msgError").innerHTML = "adsdfasdf";
                $("#popUpErrorMsg").modal("show");
            });
    } else {
        $("#modal-cargando").modal("hide");
        document.getElementById("msgError").innerHTML = "Debe ingresar una descripción correcta y un monto con digitos numericos mayor a 0";
        $("#popUpErrorMsg").modal("show");
    }
}

//--- Fin crear una venta a partir de una presupuesto ---//

//--- Enviar presupuesto ---//

function enviarPresupuesto(idGenPresupuesto) {
    $.ajax({
            url: URL + 'presupuesto/generaPDFDetallePresupuesto/' + idGenPresupuesto,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                var email = "";
                if (dato['presupuesto'][0]['email'] != "") {
                    email = dato['presupuesto'][0]['email'];
                }

                swal({
                    title: 'Enviar Presupuesto',
                    html: '' +
                        '<div class="row col-md-12" style="width:700px">' +
                        '<div class="col-md-6">' +
                        '<input id="email_enviar" type="text" class="swal2-input" placeholder="Ingrese el email destino" value="' + email + '">' +
                        '<input id="asunto" type="text" class="swal2-input" placeholder="Asunto del mensaje">' +
                        '<textarea id="cuerpo" type="text" class="swal2-input" placeholder="Cuerpo del mensaje" style="height: 100px;" rows="10"></textarea>' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<iframe width="100%" style="border:0px" height="300px" name="iframeGasto" id="iframeGasto" src="' + URL + 'uploads/comprobantes/presupuestos/' + idGenPresupuesto + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>' +
                        '</div>' +
                        '</div>',
                    text: 'Modal with a custom image.',
                    width: '700px',
                    showCancelButton: true,
                    confirmButtonText: 'Enviar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        var email = $('#email_enviar').val();
                        var asunto = $('#asunto').val();
                        var cuerpo = $('#cuerpo').val();
                        var url_pdf = URL + 'uploads/comprobantes/presupuestos/' + idGenPresupuesto + '/' + dato['nombrePdf'];
                        var nombreArchivo = dato['nombrePdf'];
                        return fetch(URL + "presupuesto/enviar_email_presupuesto/", {
                                method: 'POST',
                                body: { email: email, asunto: asunto, cuerpo: cuerpo, url_pdf: url_pdf, nombreArchivo: nombreArchivo }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText)
                                }
                                return response.json()
                            })
                            .catch(error => {
                                swal.showValidationMessage(
                                    `Request failed: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                })
            } else {
                swal(
                    'Error',
                    "Se produjo un error al obtener los datos del presupuesto, vuelva a intentarlo.",
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            var dato = JSON.parse(data);
            document.getElementById("msgError").innerHTML = "adsdfasdf";
            $("#popUpErrorMsg").modal("show");
        });
}

//--- Fin Enviar presupuesto ---//

//--- Aumetar Stock ---//

function aumentarStock() {
    $.ajax({
            url: URL + 'productos/get_productos/',
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            ////console.log(dato);
            if (dato['valid']) {
                var opciones = "";
                for (var producto in dato['productos']) {
                    opciones += '<option value="' + dato['productos'][producto]['idGenProducto'] + '">' + dato['productos'][producto]['nombre'] + '</option>'
                }
                swal({
                    title: 'Aumentar Stock',
                    html: '' +
                        '<div class="row col-md-12" style="width:700px">' +
                        '<div class="col-md-6">' +
                        '<input id="fecha_aumentar" type="date" class="swal2-input" value="' + dato['hoy'] + '">' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<input id="cantidad_aumentar" type="number" class="swal2-input" placeholder="Cantidad" min="1" onkeyup="numeroMinimoAumentar()" value="' + '">' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<select class="swal2-input search select-full" id="productos_aumentar" >' +
                        '<option value="0">Seleccione un producto</option>' +
                        opciones +
                        '</select>' +
                        '</div>' +
                        '<div class="row col-md-12" style="width:700px">' +
                        '<textarea id="descripcion_aumentar" type="text" class="swal2-input" placeholder="Cuerpo del mensaje" style="height: 100px;width:95%;" rows="10"></textarea>' +
                        '</div>' +
                        '</div>',
                    width: '700px',
                    showCancelButton: true,
                    confirmButtonText: 'Aumentar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        var fecha_aumentar = $('#fecha_aumentar').val();
                        var cantidad_aumentar = $('#cantidad_aumentar').val();
                        var productos_aumentar = $('#productos_aumentar').val();
                        var descripcion_aumentar = $('#descripcion_aumentar').val();
                        $.ajax({
                                url: URL + "productos/control_stock/",
                                type: 'POST',
                                cache: false,
                                data: { fecha: fecha_aumentar, cantidad: cantidad_aumentar, productos: productos_aumentar, descripcion: descripcion_aumentar, aumentar_disminuir: 1 }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                ////console.log(dato);
                                if (dato['valid']) {

                                    var tableListadoProductos = $('#listadoProductos').DataTable();

                                    $("#listadoProductos").dataTable().fnDeleteRow("#" + dato['producto'][0]['idGenProducto']);

                                    if (dato['idUsuario'] != 28 && dato['idUsuario'] != 29) {
                                        var opciones = '<a href="#modal-delete" class="tip delete_producto" role="button" data-id="' + dato['producto'][0]['idGenProducto'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                                            '&nbsp;' +
                                            '<a href="#" class="tip edit_producto" data-id="' + dato['producto'][0]['idGenProducto'] + '" onclick="resetFormProducto()" data-original-title="Editar"><i class="icon-pencil3"></i></a>';
                                    } else {
                                        var opciones = '<a href="#" class="tip edit_producto" data-id="' + dato['producto'][0]['idGenProducto'] + '" onclick="resetFormProducto()" data-original-title="Editar"><i class="icon-pencil3"></i></a>';
                                    }

                                    var row = tableListadoProductos.row.add([
                                        dato['producto'][0]['idProducto'],
                                        dato['producto'][0]['nombre'],
                                        dato['producto'][0]['stock'],
                                        "$" + number_format(dato['producto'][0]['precioCompra'], 2, ",", "."),
                                        "$" + number_format(dato['producto'][0]['precioVenta'], 2, ",", "."),
                                        dato['producto'][0]['descIvaVentas'],
                                        dato['producto'][0]['descIvaCompras'],
                                        '-',
                                        dato['producto'][0]['nombEmpresa'],
                                        opciones
                                    ]).draw(false);
                                    row.nodes().to$().attr('id', dato['producto'][0]['idGenProducto']);
                                    tableListadoProductos.row(row).column(0).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(1).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(2).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(3).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(4).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(5).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(6).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(7).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(8).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(9).nodes().to$().addClass('text-center');

                                    swal(
                                        'Exito',
                                        'Se registro con exito',
                                        'success'
                                    )
                                } else {
                                    swal(
                                        'Error',
                                        "Se produjo un error al registrar esta operación, vuelva a intentarlo.",
                                        'error'
                                    )
                                }
                            })
                            .fail(function(data) {
                                //console.log(data);
                            });
                    },
                    allowOutsideClick: () => !swal.isLoading()
                })
            } else {
                swal(
                    'Error',
                    "Se produjo un error al obtener los datos de los productos, vuelva a intentarlo.",
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            swal(
                'Error',
                "Se produjo un error al obtener los datos de los productos, vuelva a intentarlo.",
                'error'
            )
        });
}

function numeroMinimoAumentar() {
    var cantidad = $('#cantidad_aumentar').val();
    if (cantidad <= 0 && cantidad != "") {
        cantidad.innerHTML = "";
        swal(
            'Valor a ingresar',
            "Se debe ingresar un valor mayor a 0",
            'info'
        )
    }
}

//--- Fin Aumentar Stock ---//

//--- Disminuir Stock ---//

function disminuirStock() {
    $.ajax({
            url: URL + 'productos/get_productos/',
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            ////console.log(dato);
            if (dato['valid']) {
                var opciones = "";
                for (var producto in dato['productos']) {
                    opciones += '<option value="' + dato['productos'][producto]['idGenProducto'] + '">' + dato['productos'][producto]['nombre'] + '</option>'
                }
                swal({
                    title: 'Disminuir Stock',
                    html: '' +
                        '<div class="row col-md-12" style="width:700px">' +
                        '<div class="col-md-6">' +
                        '<input id="fecha_disminuir" type="date" class="swal2-input" value="' + dato['hoy'] + '">' +
                        '</div>' +
                        '<div class="col-md-6" style="width: max-content;">' +
                        '<input id="cantidad_disminuir" type="number" class="swal2-input" placeholder="Cantidad" onkeyup="numeroMinimoDisminuir()" min="1" value="' + '">' +
                        '</div>' +
                        '<div class="col-md-12">' +
                        '<select class="swal2-input" id="productos_disminuir" >' +
                        '<option value="0">Seleccione un producto</option>' +
                        opciones +
                        '</select>' +
                        '</div>' +
                        '<div class="row col-md-12" style="width:700px">' +
                        '<textarea id="descripcion_disminuir" type="text" class="swal2-input" placeholder="Cuerpo del mensaje" style="height: 100px;width:95%;" rows="10"></textarea>' +
                        '</div>' +
                        '</div>',
                    width: '700px',
                    showCancelButton: true,
                    confirmButtonText: 'Disminuir',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        var fecha_disminuir = $('#fecha_disminuir').val();
                        var cantidad_disminuir = $('#cantidad_disminuir').val();
                        var productos_disminuir = $('#productos_disminuir').val();
                        var descripcion_disminuir = $('#descripcion_disminuir').val();
                        $.ajax({
                                url: URL + "productos/control_stock/",
                                type: 'POST',
                                cache: false,
                                data: { fecha: fecha_disminuir, cantidad: cantidad_disminuir, productos: productos_disminuir, descripcion: descripcion_disminuir, aumentar_disminuir: 2 }
                            })
                            .done(function(data) {
                                var dato = JSON.parse(data);
                                ////console.log(dato);
                                if (dato['valid']) {

                                    var tableListadoProductos = $('#listadoProductos').DataTable();

                                    $("#listadoProductos").dataTable().fnDeleteRow("#" + dato['producto'][0]['idGenProducto']);

                                    if (dato['idUsuario'] != 28 && dato['idUsuario'] != 29) {
                                        var opciones = '<a href="#modal-delete" class="tip delete_producto" role="button" data-id="' + dato['producto'][0]['idGenProducto'] + '" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>' +
                                            '&nbsp;' +
                                            '<a href="#" class="tip edit_producto" data-id="' + dato['producto'][0]['idGenProducto'] + '" onclick="resetFormProducto()" data-original-title="Editar"><i class="icon-pencil3"></i></a>';
                                    } else {
                                        var opciones = '<a href="#" class="tip edit_producto" data-id="' + dato['producto'][0]['idGenProducto'] + '" onclick="resetFormProducto()" data-original-title="Editar"><i class="icon-pencil3"></i></a>';
                                    }

                                    var row = tableListadoProductos.row.add([
                                        dato['producto'][0]['idProducto'],
                                        dato['producto'][0]['nombre'],
                                        dato['producto'][0]['stock'],
                                        "$" + number_format(dato['producto'][0]['precioCompra'], 2, ",", "."),
                                        "$" + number_format(dato['producto'][0]['precioVenta'], 2, ",", "."),
                                        dato['producto'][0]['descIvaVentas'],
                                        dato['producto'][0]['descIvaCompras'],
                                        '-',
                                        dato['producto'][0]['nombEmpresa'],
                                        opciones
                                    ]).draw(false);
                                    row.nodes().to$().attr('id', dato['producto'][0]['idGenProducto']);
                                    tableListadoProductos.row(row).column(0).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(1).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(2).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(3).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(4).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(5).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(6).nodes().to$().addClass('text-right');
                                    tableListadoProductos.row(row).column(7).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(8).nodes().to$().addClass('text-center');
                                    tableListadoProductos.row(row).column(9).nodes().to$().addClass('text-center');
                                    modal - nuevo - producto

                                    swal(
                                        'Exito',
                                        'Se registro con exito',
                                        'success'
                                    )
                                } else {
                                    swal(
                                        'Error',
                                        "Se produjo un error al registrar esta operación, vuelva a intentarlo.",
                                        'error'
                                    )
                                }
                            })
                            .fail(function(data) {
                                //console.log(data);
                            });
                    },
                    allowOutsideClick: () => !swal.isLoading()
                })
            } else {
                swal(
                    'Error',
                    "Se produjo un error al obtener los datos de los productos, vuelva a intentarlo.",
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            swal(
                'Error',
                "Se produjo un error al obtener los datos de los productos, vuelva a intentarlo.",
                'error'
            )
        });
}

function numeroMinimoDisminuir() {
    var cantidad = $('#cantidad_disminuir').val();
    if (cantidad <= 0 && cantidad != "") {
        cantidad.innerHTML = "";
        swal(
            'Valor a ingresar',
            "Se debe ingresar un valor mayor a 0",
            'info'
        )
    }
}

//--- Fin Disminuir Stock ---//
//
//$(document).ready(function () {
//    $("#productos_aumentar").change(function () {
//        var idGenProducto = $('#productos_aumentar').val();
//        //console.log('idGenProducto:' + idGenProducto);
//        $.ajax({
//            url: URL + 'productos/get_producto_by_idGenProducto/',
//            type: 'POST',
//            cache: false,
//            data: { idGenProducto: idGenProducto }
//        })
//                .done(function (data) {
//                    var dato = JSON.parse(data);
//                    //console.log(dato);
//
//                    if (dato['valid']) {
//                        document.getElementById("cantidad_aumentar").value = dato['producto'][0]["stock"];
//                    } else {
//                        swal(
//                                'Error',
//                                "Se produjo un error al obtener los datos de los productos, vuelva a intentarlo.",
//                                'error'
//                                )
//                    }
//                })
//                .fail(function (data) {
//                    $("#modal-cargando").modal("hide");
//                    swal(
//                            'Error',
//                            "Se produjo un error al obtener los datos de los productos, vuelva a intentarlo.",
//                            'error'
//                            )
//                });
//
//    })
//});

//--- Abrir el modal para registrar un nuevo producto ---//
function open_new_product() {
    $("#modal-nuevo-producto").modal("show");
}
//--- Fin Abrir el modal para registrar un nuevo producto ---//

//--- Turnos de cajas ---//
function abrirTurno(idUsuario) {
    swal({
        title: 'Monto de inicio',
        html: 'Ingresar el monto con el que iniciara este empleado para abrir su turno<br><div class="row col-md-12"><input type="number" id="montoInicial" class="form-control swal2-input" value="0" ></div>',
        showCancelButton: true,
        confirmButtonText: 'Abrir',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            var montoInicial = $('#montoInicial').val();
            montoInicial = parseFloat(montoInicial);
            if (montoInicial >= 0) {
                //console.log(montoInicial);
                $.ajax({
                        url: URL + "finanzas/abrir_turno/",
                        type: 'POST',
                        cache: false,
                        data: { montoInicial: montoInicial, idUsuario: idUsuario }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        //console.log(dato);
                        if (dato['valid']) {
                            var element = document.getElementById("btn" + dato['idUsuario']);
                            //--- anterior estado ---//
                            element.classList.remove("btn-danger");
                            //--- nuevo estado ---//
                            element.classList.add("btn-success");
                            element.innerText = "Turno Abierto";
                            //--- cambios de estados visibles ---//
                            $("#turnoAbierto" + dato['idUsuario']).css("display", "none");
                            $("#turnoCerrado" + dato['idUsuario']).css("display", "block");
                            $("#deposito" + dato['idUsuario']).css("display", "block");
                            //--- Agregado de li ---//
                            var idGenArqueoCajas = "'" + dato['idGenArqueoCajas'] + "'";
                            var datoId = dato['idUsuario'];
                            var li = document.getElementById("turnoCerrado" + dato['idUsuario']);
                            li.innerHTML = '<a onclick="cerrarTurno(' + datoId + ', ' + idGenArqueoCajas + ')"><i class="fas fa-user-times" style="font-size:1.4em;"></i> Cerrar Turno</a>';
                            var li = document.getElementById("deposito" + dato['idUsuario']);
                            li.innerHTML = '<a onclick="depositar(' + datoId + ', ' + idGenArqueoCajas + ')"><i class="far fa-money-bill-alt" style="font-size:1.4em;"></i> Depósito</a>';
                            setTimeout(function() {
                                swal(
                                    'Exito',
                                    'Se inicion el turno correctamente',
                                    'success'
                                )
                            }, 850);
                        } else {
                            setTimeout(function() {
                                swal(
                                    'Error',
                                    dato['msg'],
                                    'error'
                                )
                            }, 850);
                        }
                    })
                    .fail(function(data) {
                        //console.log(data);
                    });
            } else {
                setTimeout(function() {
                    swal(
                        'Error',
                        "Debe ingresar un valor mayor o igual a 0 para poder abrir el turno",
                        'error'
                    )
                }, 850);
            }
        },
        allowOutsideClick: () => !swal.isLoading()
    })
}

function cerrarTurno(idUsuario, idGenArqueoCajas) {
    swal({
        title: 'Monto de cierre',
        html: 'Ingresar el monto con el que cerro el empleado al finalizar su turno<br><div class="row col-md-12"><input type="number" id="montoFinal" class="form-control swal2-input" value="0" ></div>',
        showCancelButton: true,
        confirmButtonText: 'Cerrar',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            var montoFinal = $('#montoFinal').val();
            montoFinal = parseFloat(montoFinal);
            if (montoFinal > 0) {
                //console.log(montoFinal);
                $.ajax({
                        url: URL + "finanzas/cerrar_turno/",
                        type: 'POST',
                        cache: false,
                        data: { montoFinal: montoFinal, idUsuario: idUsuario, idGenArqueoCajas: idGenArqueoCajas }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        //console.log(dato);
                        if (dato['valid']) {
                            var element = document.getElementById("btn" + dato['idUsuario']);
                            //--- anterior estado ---//
                            element.classList.remove("btn-success");
                            //--- nuevo estado ---//
                            element.classList.add("btn-danger");
                            element.innerText = "Turno Cerrado";
                            //--- cambios de estados visibles ---//
                            $("#turnoAbierto" + dato['idUsuario']).css("display", "block");
                            $("#turnoCerrado" + dato['idUsuario']).css("display", "none");
                            $("#deposito" + dato['idUsuario']).css("display", "none");
                            setTimeout(function() {
                                if (dato['montoFinal'] == dato['montoEsperado']) {
                                    swal(
                                        'Exito',
                                        'Se cerro el turno correctamente',
                                        'success'
                                    )
                                }
                                if (dato['montoFinal'] > dato['montoEsperado']) {
                                    swal(
                                        'Monto sobrante',
                                        'Se cerro el turno correctamente pero se detecto un sobrante de $' + (dato['montoFinal'] - dato['montoEsperado']),
                                        'warning'
                                    )
                                }
                                if (dato['montoFinal'] < dato['montoEsperado']) {
                                    swal({
                                        title: 'Monto faltante',
                                        html: 'Ingresar el motivo por el faltante de dinero<br><div class="row col-md-12"><input type="text" id="motivo" class="form-control swal2-input" value="" ></div>',
                                        showCancelButton: true,
                                        confirmButtonText: 'Comentar',
                                        showLoaderOnConfirm: true,
                                        preConfirm: (login) => {
                                            var motivo = $('#motivo').val();
                                            if (motivo != "") {
                                                //console.log(motivo);
                                                $.ajax({
                                                        url: URL + "finanzas/motivo_faltante/",
                                                        type: 'POST',
                                                        cache: false,
                                                        data: { motivo: motivo, idGenArqueoCajas: dato['idGenArqueoCajas'] }
                                                    })
                                                    .done(function(data) {
                                                        var dato = JSON.parse(data);
                                                        //console.log(dato);
                                                        if (dato['valid']) {
                                                            setTimeout(function() {
                                                                swal(
                                                                    'Exito',
                                                                    'Se registro un motivo al faltante',
                                                                    'success'
                                                                )
                                                            }, 850);
                                                        } else {
                                                            setTimeout(function() {
                                                                swal(
                                                                    'Error',
                                                                    dato['msg'],
                                                                    'error'
                                                                )
                                                            }, 850);
                                                        }
                                                    })
                                                    .fail(function(data) {
                                                        //console.log(data);
                                                    });
                                            } else {
                                                setTimeout(function() {
                                                    swal(
                                                        'Error',
                                                        "Debe ingresar un motivo",
                                                        'error'
                                                    )
                                                }, 850);
                                            }
                                        },
                                        allowOutsideClick: () => !swal.isLoading()
                                    })
                                }
                            }, 850);
                        } else {
                            setTimeout(function() {
                                swal(
                                    'Error',
                                    dato['msg'],
                                    'error'
                                )
                            }, 850);
                        }
                    })
                    .fail(function(data) {
                        //console.log(data);
                    });
            } else {
                setTimeout(function() {
                    swal(
                        'Error',
                        "Debe ingresar un valor mayor a 0 para poder cerrar el turno",
                        'error'
                    )
                }, 850);
            }
        },
        allowOutsideClick: () => !swal.isLoading()
    })
}

function depositar(idUsuario) {
    swal({
        title: 'Monto a depositar',
        html: 'Ingresar el monto a depositar<br><div class="row col-md-12"><input type="number" id="deposito" class="form-control swal2-input" value="0" ></div>',
        showCancelButton: true,
        confirmButtonText: 'Depositar',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            var deposito = $('#deposito').val();
            deposito = parseFloat(deposito);
            if (deposito > 0) {
                //console.log(deposito);
                $.ajax({
                        url: URL + "finanzas/depositar/",
                        type: 'POST',
                        cache: false,
                        data: { idUsuario: idUsuario, deposito: deposito }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        //console.log(dato);
                        if (dato['valid']) {
                            swal(
                                'Deposito Exitoso',
                                dato['msg'],
                                'success'
                            )
                        } else {
                            setTimeout(function() {
                                swal(
                                    'Error',
                                    dato['msg'],
                                    'error'
                                )
                            }, 850);
                        }
                    })
                    .fail(function(data) {
                        //console.log(data);
                    });
            } else {
                setTimeout(function() {
                    swal(
                        'Error',
                        "Debe ingresar un valor mayor a 0 para poder cerrar el turno",
                        'error'
                    )
                }, 850);
            }
        },
        allowOutsideClick: () => !swal.isLoading()
    })
}

//--- Fin Turnos de cajas ---//

//--- Inicio Cerrar cajas ---//

function cerrarCaja(idCaja, valorApertura, valorCaja) {
    //console.log("cerrar caja");
    if (valorApertura != valorCaja) {
        $.ajax({
                url: URL + "finanzas/cerrar_caja/",
                type: 'POST',
                cache: false,
                data: { idCaja: idCaja, valorApertura: valorApertura, valorCaja: valorCaja }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )
                } else {
                    setTimeout(function() {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }, 850);
                }
            })
            .fail(function(data) {
                //console.log(data);
            });
    } else {
        swal(
            'Error',
            "La caja aun no a sido abierta",
            'error'
        )
    }
}

//--- Fin Cerrar cajas ---//

//--- Inicio Detalle Arqueo ---//

$(document).ready(function() {
    //--- tabla correspondiente ---//
    var table = $('#listadoArqueoCajas').DataTable();
    //--- Funcion para despleagar o contraer el detalle de la fila ---//
    $('#listadoArqueoCajas tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row

            data = row.data();
            $.ajax({
                    url: URL + "finanzas/detalle_arqueo/",
                    type: 'POST',
                    cache: false,
                    data: { id: data['DT_RowId'] }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        row.child(detalle_arqueo(dato)).show();
                    } else {
                        return "False";
                    }
                })
                .fail(function(data) {
                    return "False";
                });
            tr.addClass('shown');
        }
    });
});

function detalle_arqueo(dato) {
    //--- data es la informacion del datatable que viene de arriba y procedemos a armar un table con el detalle ---//

    var margen = parseFloat(dato['arqueo_cajas'][0]['montoFinal']) - parseFloat(dato['arqueo_cajas'][0]['montoEsperado']);
    //console.log(margen);
    if (margen < 0) {
        margen = "$-" + number_format(margen, 2, ",", ".");
    } else {
        margen = "$" + number_format(margen, 2, ",", ".");
    }
    var deposito = "";
    var deposito_total = 0;
    if (dato['depositos']) {
        for (var i = 0; i < dato['depositos'].length; i++) {
            deposito += '<tr>' +
                '<td>Depósito</td>' +
                '<td>' + dato['depositos'][i]['fechaAlta'] + '</td>' +
                '<td>' + dato['depositos'][i]['deposito'] + '</td>' +
                '<td>' + dato['arqueo_cajas_fecha'][0]['usuario'] + '</td>' +
                '</tr>';
            deposito_total += parseFloat(dato['depositos'][i]['deposito']);
        }
    }

    return '<div class="input-group">' +
        '<div class="input-group">' +
        '<span class="input-group-text">Efectivo esperado:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(dato['arqueo_cajas'][0]['montoEsperado'], 2, ",", ".") + '</span>' +
        '<span class="input-group-text">Efectivo real:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(dato['arqueo_cajas'][0]['montoFinal'], 2, ",", ".") + '</span>' +
        '<span class="input-group-text">Margen:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + margen + '</span>' +
        '</div>' +
        '<div class="input-group">' +
        '<span class="input-group-text">Pagos en efectivo:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(dato['arqueo_cajas'][0]['pagosEfectivo'], 2, ",", ".") + '</span>' +
        '<span class="input-group-text">Pagos con tarjeta:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(0, 2, ",", ".") + '</span>' +
        '<span class="input-group-text">Ingresos:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(0, 2, ",", ".") + '</span>' +
        '</div>' +
        '<div class="input-group">' +
        '<span class="input-group-text">Gastos:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(0, 2, ",", ".") + '</span>' +
        '<span class="input-group-text">Depósito:</span>' +
        '<span class="input-group-text" style="margin: 10px;">' + "$" + number_format(deposito_total, 2, ",", ".") + '</span>' +
        '</div>' +
        '</div>' +
        '<br>' +
        '<br>' +
        '<table cellpadding="5" cellspacing="0" border="0" style="padding-right:50px;" class="table table-striped table-bordered">' +
        '<tr>' +
        '<th class="text-center">Tipo de Transacción</td>' +
        '<th class="text-center">Fecha y Hora</td>' +
        '<th class="text-center">Monto</td>' +
        '<th class="text-center">Empleado</td>' +
        '</tr>' +
        '<tr>' +
        '<td>Inicio del Turno</td>' +
        '<td>' + dato['arqueo_cajas_fecha'][0]['fechaInicioTurno'] + '</td>' +
        '<td>' + dato['arqueo_cajas_fecha'][0]['montoInicial'] + '</td>' +
        '<td>' + dato['arqueo_cajas_fecha'][0]['usuario'] + '</td>' +
        '</tr>' +
        '<tr>' +
        deposito +
        '<td>Fin del Turno</td>' +
        '<td>' + dato['arqueo_cajas_fecha'][0]['fechaFinTurno'] + '</td>' +
        '<td>' + dato['arqueo_cajas_fecha'][0]['montoFinal'] + '</td>' +
        '<td>' + dato['arqueo_cajas_fecha'][0]['usuario'] + '</td>' +
        '</tr>' +
        '</table>' +
        '<br>' +
        '<br>';
}

//--- Fin Detalle Arqueo ---//

//--- Filtro Arqueo Caja ---//

function filtro_arqueo_caja_by_fecha() {
    var table = $('#listadoArqueoCajas').DataTable();
    var fechaFiltro = $('#fecha-arqueo-cajas').val();
    //console.log(fechaFiltro);
    var urlajax = false;
    if (fechaFiltro == '') {
        urlajax = URL + "finanzas/listar_arqueo_cajas_table";
    } else if (fechaFiltro != '') {
        urlajax = URL + "finanzas/listar_arqueo_cajas_table_by_fecha/" + fechaFiltro;
        $.ajax({
                url: URL + "finanzas/arqueo_cajas_fecha/" + fechaFiltro,
                type: 'POST',
                cache: false,
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                //console.log("TERMINAR");
                document.getElementById("valorCierre").innerHTML = "Cierre de caja del fecha seleccionada es:  " + "$" + number_format(dato['ultimo_movimiento_cajas'], 2, ",", ".");
                document.getElementById("valorApertura").innerHTML = "La caja en la fecha seleccionada abrio con  " + "$" + number_format(dato['primer_movimiento_cajas'], 2, ",", ".");
            })
            .fail(function(data) {
                //console.log(data);
            });
    }
    if (urlajax) {
        listadoArqueoCajas = $('#listadoArqueoCajas').DataTable();
        $("#listadoArqueoCajas").dataTable().fnDestroy();
        $('#listadoArqueoCajas').DataTable({
            "sAjaxSource": urlajax,
            "bSort": true,
            "paging": true,
            "aaSorting": [0, 'asc'],
            "initComplete": function() {
                setTimeout(function() {
                    var table = $('#listadoArqueoCajas').DataTable();
                    var info = table.page.info();
                    var count = info.recordsTotal;
                    if (count == 0) {
                        swal({
                            title: 'No hubo arqueos',
                            html: 'En este dia seleccionado no fue abierta la caja.',
                            showCancelButton: true,
                            allowOutsideClick: () => !swal.isLoading()
                        })
                        document.getElementById("valorCierre").innerHTML = "Cierre de caja del fecha seleccionada es:  " + "$" + number_format(0, 2, ",", ".");
                        document.getElementById("valorApertura").innerHTML = "La caja en la fecha seleccionada abrio con  " + "$" + number_format(0, 2, ",", ".");
                    }
                }, 100);
            },
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "aoColumns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '<div style="text-align: center;"><i class="fas fa-plus-circle"></i></div>',
                },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' },
                { 'sClass': 'center' }
            ]
        });
    }
}

//--- Fin Filtro Arqueo Caja ---//


//--- Inicio de las configuraciones del sistema ---//
$(document).ready(function() {
    if ($('#selectProvincia_formConfiguracionSistema').val() != null) {
        var idProvincia = $('#selectProvincia_formConfiguracionSistema').val();
        $.post(URL + 'localidad/buscaLocalidad', {
            idProvincia: idProvincia
        }, function(data) {
            document.getElementById("selectLocalidad_formConfiguracionSistema").value = "";
            $("#selectLocalidad_formConfiguracionSistema").html(data);
            $("#modal-cargando").modal("hide");

            //--- El id de la localidad esta cargado en la vista por lo que obtenemos ese id y procedemos a seleccionarla ---//
            var idLocalidad = $('#localidad_formConfiguracionSistema').val();
            $('#selectLocalidad_formConfiguracionSistema').val(idLocalidad).trigger('change');
        });
    }
});

function formato_cuit_config_sistema() {
    var facturaElectronica = $('#selectFacturaElectronica_formConfiguracionSistema').val();

    if (facturaElectronica == 0) {
        var cuit = $('#inputCuit_formConfiguracionSistema').val();
        var longitud = cuit.length;

        if (longitud > 9 && longitud < 12) {
            if (cuit.length != 11) {
                return false;
            }

            var acumulado = 0;
            var digitos = cuit.split("");
            var digito = digitos.pop();

            for (var i = 0; i < digitos.length; i++) {
                acumulado += digitos[9 - i] * (2 + (i % 6));
            }

            var verif = 11 - (acumulado % 11);
            if (verif == 11) {
                verif = 0;
            } else if (verif == 10) {
                verif = 9;
            }

            if (digito == verif) {
                $("#errorInputCuit_formConfiguracionSistema").css("display", "none");
            } else {
                $("#errorInputCuit_formConfiguracionSistema").css("display", "block");
            }
        } else {
            $("#errorInputCuit_formConfiguracionSistema").css("display", "block");
        }
    } else {
        $("#errorInputCuit_formConfiguracionSistema").css("display", "none");
    }
}

function facturaElectronicaCampos() {
    var facturaElectronica = $('#selectFacturaElectronica_formConfiguracionSistema').val();
    if (facturaElectronica != 0) {
        $("#inputCuit_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#inputIibb_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#selectTipoAnteAfip_formConfiguracionSistema").attr('disabled', 'disabled');
        $("#inputPuntoVenta_formConfiguracionSistema").attr('disabled', 'disabled');
    } else {
        $("#inputCuit_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#inputIibb_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#selectTipoAnteAfip_formConfiguracionSistema").removeAttr('disabled', 'disabled');
        $("#inputPuntoVenta_formConfiguracionSistema").removeAttr('disabled', 'disabled');

        $("#errorInputPuntoVenta_formConfiguracionSistema").css("display", "none");
        $("#errorInputIibb_formConfiguracionSistema").css("display", "none");
        $("#errorSelectTipoAnteAfip_formConfiguracionSistema").css("display", "none");
        $("#errorInputCuit_formConfiguracionSistema").css("display", "none");

    }

}

function configuracion_sistema() {

    //--- Obtencion de datos ---//
    var id = $('#id_formConfiguracionSistema').val();
    var razonSocial = $('#inputRazonSocial_formConfiguracionSistema').val();
    var tipoAnteAfip = $('#selectTipoAnteAfip_formConfiguracionSistema').val();
    var cuit = $('#inputCuit_formConfiguracionSistema').val();
    var iibb = $('#inputIibb_formConfiguracionSistema').val();
    var puntoVenta = $('#inputPuntoVenta_formConfiguracionSistema').val();
    var facturaElectronica = $('#selectFacturaElectronica_formConfiguracionSistema').val();
    var condicionFacturacion = $('#selectCondicionFacturacion_formConfiguracionSistema').val();
    var selectCaja = $('#selectCaja_formConfiguracionSistema').val();
    //--- formData ---//
    var formData = new FormData($("#formConfiguracionSistema")[0]);
    //--- Validaciones ---//
    var val1, val2,
        val3 = true,
        val4 = true,
        val5 = true,
        val6 = true,
        val7 = true;
    if (razonSocial == null || razonSocial.length == 0 || razonSocial == ' ' || razonSocial == '') {
        $("#errorInputRazonSocial_formConfiguracionSistema").css("display", "block");
        val1 = false;
    } else {
        $("#errorInputRazonSocial_formConfiguracionSistema").css("display", "none");
        val1 = true;
    }
    if (facturaElectronica == 0) {
        if (puntoVenta == null || puntoVenta.length == 0 || puntoVenta == 0) {
            $("#errorInputPuntoVenta_formConfiguracionSistema").css("display", "block");
            val3 = false;
        } else {
            $("#errorInputPuntoVenta_formConfiguracionSistema").css("display", "none");
            val3 = true;
        }
        if (iibb == null || iibb.length == 0 || iibb == 0) {
            $("#errorInputIibb_formConfiguracionSistema").css("display", "block");
            val5 = false;
        } else {
            $("#errorInputIibb_formConfiguracionSistema").css("display", "none");
            val5 = true;
        }
        if (tipoAnteAfip == 0) {
            $("#errorSelectTipoAnteAfip_formConfiguracionSistema").css("display", "block");
            val7 = false;
        } else {
            $("#errorSelectTipoAnteAfip_formConfiguracionSistema").css("display", "none");
            val7 = true;
        }
    } else {
        $("#errorInputPuntoVenta_formConfiguracionSistema").css("display", "none");
        val3 = true;
        $("#errorInputIibb_formConfiguracionSistema").css("display", "none");
        val5 = true;
        $("#errorSelectTipoAnteAfip_formConfiguracionSistema").css("display", "none");
        val7 = true;
    }

    if (condicionFacturacion == 0) {
        $("#errorSelectCondicionFacturacion_formConfiguracionSistema").css("display", "block");
        val4 = false;
    } else {
        $("#errorSelectCondicionFacturacion_formConfiguracionSistema").css("display", "none");
        val4 = true;
    }

    //--- Si el id no existe quiere decir que es la primera vez que va a realizar la configuracion inicial y deberia estar la seleccion de la caja ---//
    if (id == 0) {
        if (selectCaja == 0) {
            $("#errorSelectCaja_formConfiguracionSistema").css("display", "block");
            val6 = false;
        } else {
            $("#errorSelectCaja_formConfiguracionSistema").css("display", "none");
            val6 = true;
        }
    }

    if (facturaElectronica == 0) {
        var longitud = cuit.length;

        if (longitud > 9 && longitud < 12) {
            if (cuit.length != 11) {
                return false;
            }

            var acumulado = 0;
            var digitos = cuit.split("");
            var digito = digitos.pop();

            for (var i = 0; i < digitos.length; i++) {
                acumulado += digitos[9 - i] * (2 + (i % 6));
            }

            var verif = 11 - (acumulado % 11);
            if (verif == 11) {
                verif = 0;
            } else if (verif == 10) {
                verif = 9;
            }

            if (digito == verif) {
                $("#errorInputCuit_formConfiguracionSistema").css("display", "none");
                val2 = true;
            } else {
                $("#errorInputCuit_formConfiguracionSistema").css("display", "block");
                val2 = false;
            }
        } else {
            $("#errorInputCuit_formConfiguracionSistema").css("display", "block");
            val2 = false;
        }
    } else {
        $("#errorInputCuit_formConfiguracionSistema").css("display", "none");
        val2 = true;
    }

    //--- Validacion de datos correctos ---//
    if (val1 && val2 && val3 && val4 && val5 && val6 && val7) {
        //--- Ajax ---//
        $.ajax({
                url: URL + "configuracion_sistema/configuracion_sistemas/",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                if (dato['valid']) {
                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                //console.log(data);
            });
    }
}

//--- Fin de las configuraciones del sistema ---//

//--- Inicio Descuento de estoy a efectuar una cobranza ---//
$(document).ready(function() {
    $("#selectSaldoAFavor").change(function() {
        var saldoAFavor = $('#selectSaldoAFavor').val();
        if (saldoAFavor == 0) {
            var aFavor = $('#saldoAFavor').val();
            var montoAdeudado = $('#montoAdeudado').val();
            if (aFavor == 0) {
                //--- Div oculto ya que no posee saldo a favor ---//
                $("#saldoAFavorDiv").css("display", "none");
                document.getElementById("saldoAFavor").disabled = true;
                document.getElementById("montoCobro").disabled = false;
                document.getElementById("montoCobro").innerHTML = montoAdeudado;
            } else {
                //--- Div para utilizar el monto a favor si lo desea ---//
                $("#saldoAFavorDiv").css("display", "block");
                //--- Verificamos si el monto a favor es mayor o igual al monto adeudado para que obligue a usar ese dinero antes de pedir dinero y sino que pida la diferencia restante entre la deuda y la plata a favor ---//
                if (aFavor <= montoAdeudado) {
                    document.getElementById("saldoAFavor").disabled = false;
                    document.getElementById("montoCobro").disabled = true;
                    document.getElementById("montoCobro").innerHTML = 0;
                } else {
                    document.getElementById("saldoAFavor").disabled = false;
                    document.getElementById("montoCobro").disabled = false;
                    var diferencia = montoAdeudado - aFavor;
                    document.getElementById("montoCobro").innerHTML = diferencia;
                }
            }
        } else if (saldoAFavor == 1) {
            //--- Div oculto ya que no posee saldo a favor ---//
            $("#saldoAFavorDiv").css("display", "none");
            document.getElementById("saldoAFavor").disabled = true;
            document.getElementById("montoCobro").disabled = false;
        }
    });
});

function validarDiferencia() {
    var montoAdeudado = $('#montoAdeudado').val();
    var montoCobro = $('#montoCobro').val();
    var aFavor = $('#saldoAFavor').val();
    if (montoCobro <= (montoAdeudado - aFavor)) {
        document.getElementById("montoCobro").innerHTML = montoCobro;
    } else {
        swal(
            'INFO',
            "Ingresar un valor menor, ya que no debe superar a la diferencia entre el monto adeudado y el monto a favor",
            'warning'
        )
    }

}

function validarDiferenciaGasto() {
    var montoAdeudado = $('#montoAdeudado_formAgregarCobroGasto').val();
    var montoCobro = $('#montoCobro_formAgregarCobroGasto').val();
    if (montoCobro <= montoAdeudado) {
        document.getElementById("montoCobro").innerHTML = montoCobro;
    } else {
        swal(
            'INFO',
            "Ingresar un valor menor, ya que no debe superar la diferencia del monto adeudado",
            'warning'
        )
    }

}

function validarMontoAPagar() {
    //console.log("hola");
}
//--- Fin Descuento de estoy a efectuar una cobranza ---//

//--- Inicio agregar nota de debito ---//
$(document).ready(function() {
    $("#selectProductos_formNuevaNotaDebito").change(function() {
        $("#selectProductos_formNuevaNotaDebito option:selected").each(function() {
            var idProducto = $('#selectProductos_formNuevaNotaDebito').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formNuevaNotaDebito").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaDebito = $('#listadoDetalleNotaDebito').DataTable();
                            var info = tableListadoDetalleNotaDebito.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaDebito.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaDebito.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebito(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebito(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaDebito(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaDebito(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaDebito.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebito.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaDebito(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    $('#btnGuardarNotaDebito').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectCliente = $('#selectCliente_formNuevaNotaDebito').val();
        var inputFechaEmision = $('#inputFechaEmision_formNuevaNotaDebito').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formNuevaNotaDebito').val();
        var selectTipoNota = $('#selectTipoNota_formNuevaNotaDebito').val();
        var selectVenta = $('#selectVentas_formNuevaNotaDebito').val();
        var notaCliente = $('#notaCliente_formNuevaNotaDebito').val();
        var notaInterna = $('#notaInterna_formNuevaNotaDebito').val();
        var importeNoGravado = $('#importeNoGravado_formNuevaNotaDebito').val();
        var descuentoEfectuado = $('#descEfectuado_formNuevaNotaDebito').val();
        var totalVenta = $('#totalVenta_formNuevaNotaDebito').val();
        var idGenIngreso = $('#idGenIngreso').val();

        if (selectCliente == 0) {
            $("#errorselectCliente_formNuevaNotaDebito").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente_formNuevaNotaDebito").css("display", "none");
            val1 = true;
        }
        if (selectVenta == 0) {
            $("#errorSelectVentas_formNuevaNotaDebito").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectVentas_formNuevaNotaDebito").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaDebito = $('#listadoDetalleNotaDebito').DataTable();
        var info = tableListadoDetalleNotaDebito.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaDebito = {
                "selectCliente": selectCliente,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectVenta": selectVenta,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var datosDetalleNotaDebito = [];
            var info = tableListadoDetalleNotaDebito.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaDebito.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaDebito.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito/set_nota_debito/',
                    type: 'POST',
                    data: { datosDetalleNotaDebito: datosDetalleNotaDebito, datosNotaDebito: datosNotaDebito }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )
                        setTimeout(function() {
                            if (idGenIngreso != "") {
                                location.href = URL + 'notas_credito_debito/nota_credito_debito_venta/' + idGenIngreso;
                            } else {
                                location.href = URL + 'notas_credito_debito/listar_nota_debito';
                            }
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin agregar nota de debito ---//

//--- Inicio agregar nota de credito ---//
$(document).ready(function() {
    $("#selectProductos_formNuevaNotaCredito").change(function() {
        $("#selectProductos_formNuevaNotaCredito option:selected").each(function() {
            var idProducto = $('#selectProductos_formNuevaNotaCredito').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formNuevaNotaCredito").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaCredito').DataTable();
                            var info = tableListadoDetalleNotaCredito.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaCredito.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaCredito.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCredito(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCredito(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaCredito(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaCredito(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaCredito.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCredito.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaCredito(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                $("#modal-cargando").modal("hide");
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    $('#btnGuardarNotaCredito').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectCliente = $('#selectCliente_formNuevaNotaCredito').val();
        var inputFechaEmision = $('#inputFechaEmision_formNuevaNotaCredito').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formNuevaNotaCredito').val();
        var selectTipoNota = $('#selectTipoNota_formNuevaNotaCredito').val();
        var selectVenta = $('#selectVentas_formNuevaNotaCredito').val();
        var notaCliente = $('#notaCliente_formNuevaNotaCredito').val();
        var notaInterna = $('#notaInterna_formNuevaNotaCredito').val();
        var importeNoGravado = $('#importeNoGravado_formNuevaNotaCredito').val();
        var descuentoEfectuado = $('#descEfectuado_formNuevaNotaCredito').val();
        var totalVenta = $('#totalVenta_formNuevaNotaCredito').val();
        var idGenIngreso = $('#idGenIngreso').val();
        if (selectCliente == 0) {
            $("#errorselectCliente_formNuevaNotaCredito").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente_formNuevaNotaCredito").css("display", "none");
            val1 = true;
        }
        if (selectVenta == 0) {
            $("#errorSelectVentas_formNuevaNotaCredito").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectVentas_formNuevaNotaCredito").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaCredito').DataTable();
        var info = tableListadoDetalleNotaCredito.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaCredito = {
                "selectCliente": selectCliente,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectVenta": selectVenta,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var datosDetalleNotaCredito = [];
            var info = tableListadoDetalleNotaCredito.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaCredito.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaCredito.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito/set_nota_credito/',
                    type: 'POST',
                    data: { datosDetalleNotaCredito: datosDetalleNotaCredito, datosNotaCredito: datosNotaCredito }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )
                        setTimeout(function() {
                            if (idGenIngreso != "") {
                                location.href = URL + 'notas_credito_debito/nota_credito_debito_venta/' + idGenIngreso;
                            } else {
                                location.href = URL + 'notas_credito_debito/listar_nota_credito';
                            }
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin agregar nota de debito ---//

//--- Inicio modificar nota de debito ---//

function llenado_tabla_nota_debito_editar(idNotaDebito) {
    //console.log("idNotaDebito " + idNotaDebito);
    if (idNotaDebito) {

        setTimeout(function() {
            var tableListadoDetalleNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificar').DataTable();
            $("#listadoDetalleNotaDebitoModificar").dataTable().fnDestroy();
            $('#listadoDetalleNotaDebitoModificar').dataTable({
                "sAjaxSource": URL + "notas_credito_debito/listar_nota_debito_table_by_idNotaDebito/" + idNotaDebito,
                "paging": true,
                "initComplete": function() {
                    setTimeout(function() {
                        totalDetalleNotaDebitoModificar();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0, 9],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column"
                }]
            });
        }, 850);
    } else {
        //console.log("No hay id");
    }
}


$(document).ready(function() {

    //--- agregar productos al detalle de la nota de credito

    $("#selectProductos_formModificarNotaDebito").change(function() {
        $("#selectProductos_formModificarNotaDebito option:selected").each(function() {
            var idProducto = $('#selectProductos_formModificarNotaDebito').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formModificarNotaDebito").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificar').DataTable();
                            var info = tableListadoDetalleNotaDebitoModificar.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaDebitoModificar.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaDebitoModificar.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebitoModificar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebitoModificar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaDebitoModificar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaDebitoModificar(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaDebitoModificar.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaDebitoModificar(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    //--- Modificar la nota de debito ---//

    $('#btnModificarNotaDebito').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectCliente = $('#selectCliente_formModificarNotaDebito').val();
        var inputFechaEmision = $('#inputFechaEmision_formModificarNotaDebito').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formModificarNotaDebito').val();
        var selectTipoNota = $('#selectTipoNota_formModificarNotaDebito').val();
        var selectVenta = $('#selectVentas_formModificarNotaDebito').val();
        var notaCliente = $('#notaCliente_formModificarNotaDebito').val();
        var notaInterna = $('#notaInterna_formModificarNotaDebito').val();
        var importeNoGravado = $('#importeNoGravado_formModificarNotaDebito').val();
        var descuentoEfectuado = $('#descEfectuado_formModificarNotaDebito').val();
        var totalVenta = $('#totalVenta_formModificarNotaDebito').val();
        var idNotaDebito = $('#idNotaDebito_formModificarNotaDebito').val();
        if (selectCliente == 0) {
            $("#errorselectCliente_formModificarNotaDebito").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente_formModificarNotaDebito").css("display", "none");
            val1 = true;
        }
        if (selectVenta == 0) {
            $("#errorSelectVentas_formModificarNotaDebito").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectVentas_formModificarNotaDebito").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaDebitoModificar').DataTable();
        var info = tableListadoDetalleNotaCredito.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }


        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaDebito = {
                "selectCliente": selectCliente,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectVenta": selectVenta,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var tableListadoDetalleNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificar').DataTable();
            var datosDetalleNotaDebito = [];
            var info = tableListadoDetalleNotaDebitoModificar.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaDebitoModificar.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaDebito.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito/update_nota_debito/',
                    type: 'POST',
                    data: { datosDetalleNotaDebito: datosDetalleNotaDebito, datosNotaDebito: datosNotaDebito, idNotaDebito: idNotaDebito }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )

                        setTimeout(function() {
                            location.href = URL + 'notas_credito_debito/listar_nota_debito';
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin modificar nota de debito ---//

//--- Inicio eliminar nota de debito ---//
function deleteNotaDebito(idNotaDebito) {
    //e.preventDefault();
    $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

    $('.button-delete-si').click(function(e) {
        e.preventDefault();
        $("#modal-delete").modal("hide");
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'notas_credito_debito/delete_nota_debito/',
                type: 'POST',
                cache: false,
                data: {
                    idNotaDebito: idNotaDebito
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )

                    $('#listadoNotaDebito').dataTable().fnDeleteRow("#" + idNotaDebito);
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");
            });
    })
}
//--- Fin eliminar nota de debito ---//

//--- Inicio Cambio de estado de la nota de debito a abonado ---//
function abonar(idNotaDebito) {
    $.ajax({
            url: URL + 'notas_credito_debito/abonar_nota_debito/',
            type: 'POST',
            cache: false,
            data: {
                idNotaDebito: idNotaDebito
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {

                swal(
                    'Exito',
                    dato['msg'],
                    'success'
                )

                //--- cambio del color y mensaje del boton
                var element = document.getElementById("btn" + idNotaDebito);
                //--- anterior estado ---//
                element.classList.remove("btn-danger");
                //--- nuevo estado ---//
                element.classList.add("btn-success");
                element.innerText = "Abonado";
                //--- cambios de estados visibles ---//
                $("#verNotaDebito" + idNotaDebito).css("display", "block");
                $("#editarNotaDebito" + idNotaDebito).css("display", "none");
                $("#eliminarNotaDebito" + idNotaDebito).css("display", "none");
                $("#abonarNotaDebito" + idNotaDebito).css("display", "none");
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#eliminacion-exitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}
//--- Fin Cambio de estado de la nota de debito a abonado ---//

//--- Inicio modificar nota de credito ---//
function llenado_tabla_nota_credito_editar(idNotaCredito) {
    //console.log("idNotaCredito " + idNotaCredito);
    if (idNotaCredito) {

        setTimeout(function() {
            var tableListadoDetalleNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificar').DataTable();
            $("#listadoDetalleNotaCreditoModificar").dataTable().fnDestroy();
            $('#listadoDetalleNotaCreditoModificar').dataTable({
                "sAjaxSource": URL + "notas_credito_debito/listar_nota_credito_table_by_idNotaCredito/" + idNotaCredito,
                "paging": true,
                "initComplete": function() {
                    setTimeout(function() {
                        totalDetalleNotaCreditoModificar();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0, 9],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column"
                }]
            });
        }, 850);
    } else {
        //console.log("No hay id");
    }
}


$(document).ready(function() {

    //--- agregar productos al detalle de la nota de credito ---//
    $("#selectProductos_formModificarNotaCredito").change(function() {
        $("#selectProductos_formModificarNotaCredito option:selected").each(function() {
            var idProducto = $('#selectProductos_formModificarNotaCredito').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formModificarNotaCredito").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificar').DataTable();
                            var info = tableListadoDetalleNotaCreditoModificar.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaCreditoModificar.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaCreditoModificar.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCreditoModificar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCreditoModificar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaCreditoModificar(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaCreditoModificar(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaCreditoModificar.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaCreditoModificar(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    //--- Modificar la nota de credito ---//
    $('#btnModificarNotaCredito').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectCliente = $('#selectCliente_formModificarNotaCredito').val();
        var inputFechaEmision = $('#inputFechaEmision_formModificarNotaCredito').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formModificarNotaCredito').val();
        var selectTipoNota = $('#selectTipoNota_formModificarNotaCredito').val();
        var selectVenta = $('#selectVentas_formModificarNotaCredito').val();
        var notaCliente = $('#notaCliente_formModificarNotaCredito').val();
        var notaInterna = $('#notaInterna_formModificarNotaCredito').val();
        var importeNoGravado = $('#importeNoGravado_formModificarNotaCredito').val();
        var descuentoEfectuado = $('#descEfectuado_formModificarNotaCredito').val();
        var totalVenta = $('#totalVenta_formModificarNotaCredito').val();
        var idNotaCredito = $('#idNotaCredito_formModificarNotaCredito').val();
        if (selectCliente == 0) {
            $("#errorselectCliente_formModificarNotaCredito").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectCliente_formModificarNotaCredito").css("display", "none");
            val1 = true;
        }
        if (selectVenta == 0) {
            $("#errorSelectVentas_formModificarNotaCredito").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectVentas_formModificarNotaCredito").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaCreditoModificar').DataTable();
        var info = tableListadoDetalleNotaCredito.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaCredito = {
                "selectCliente": selectCliente,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectVenta": selectVenta,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var tableListadoDetalleNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificar').DataTable();
            var datosDetalleNotaCredito = [];
            var info = tableListadoDetalleNotaCreditoModificar.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaCreditoModificar.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaCredito.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito/update_nota_credito/',
                    type: 'POST',
                    data: { datosDetalleNotaCredito: datosDetalleNotaCredito, datosNotaCredito: datosNotaCredito, idNotaCredito: idNotaCredito }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )

                        setTimeout(function() {
                            location.href = URL + 'notas_credito_debito/listar_nota_credito';
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin modificar nota de debito ---//

//--- Inicio eliminar nota de debito ---//
function deleteNotaCredito(idNotaCredito) {
    //e.preventDefault();
    $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

    $('.button-delete-si').click(function(e) {
        e.preventDefault();
        $("#modal-delete").modal("hide");
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'notas_credito_debito/delete_nota_credito/',
                type: 'POST',
                cache: false,
                data: {
                    idNotaCredito: idNotaCredito
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )

                    $('#listadoNotaCredito').dataTable().fnDeleteRow("#" + idNotaCredito);
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");
            });
    })
}
//--- Fin eliminar nota de credito ---//

//--- Inicio ver nota de debito ---//
function ver_nota_debito(idNota) {
    $.ajax({
            url: URL + 'notas_credito_debito/generar_pdf_nota_debito/',
            type: 'POST',
            cache: false,
            data: {
                idNota: idNota
            }
        })
        .done(function(data) {
            swal({
                title: "Nota Débito",
                width: "1200px",
                html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/notasdebito/notaDebito' + idNota + '.pdf #zoom=100&view=fitH"></iframe>',
                showCancelButton: false,
                confirmButtonText: 'Cerrar',
            })
        });
}
//--- Fin ver nota de debito ---//

//--- Inicio ver nota de credito ---//
function ver_nota_credito(idNota) {
    ////console.log(idNota);
    $.ajax({
            url: URL + 'notas_credito_debito/generar_pdf_nota_credito/',
            type: 'POST',
            cache: false,
            data: {
                idNota: idNota
            }
        })
        .done(function(data) {
            swal({
                title: "Nota Crédito",
                width: "1200px",
                html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/notascredito/notaCredito' + idNota + '.pdf #zoom=100&view=fitH"></iframe>',
                showCancelButton: false,
                confirmButtonText: 'Cerrar',
            })
        });
}
//--- Fin ver nota de credito ---//


//--- Inicio agregar nota de debito ---//
$(document).ready(function() {
    $("#selectProductos_formNuevaNotaDebitoProveedor").change(function() {
        $("#selectProductos_formNuevaNotaDebitoProveedor option:selected").each(function() {
            var idProducto = $('#selectProductos_formNuevaNotaDebitoProveedor').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formNuevaNotaDebito").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaDebitoProveedor = $('#listadoDetalleNotaDebitoProveedor').DataTable();
                            var info = tableListadoDetalleNotaDebitoProveedor.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaDebitoProveedor.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaDebitoProveedor.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebitoProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebitoProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaDebitoProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaDebitoProveedor(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoProveedor.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaDebitoProveedor(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    $('#btnGuardarNotaDebitoProveedor').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectProveedor = $('#selectProveedor_formNuevaNotaDebitoProveedor').val();
        var inputFechaEmision = $('#inputFechaEmision_formNuevaNotaDebitoProveedor').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formNuevaNotaDebitoProveedor').val();
        var selectTipoNota = $('#selectTipoNota_formNuevaNotaDebitoProveedor').val();
        var selectCompra = $('#selectCompras_formNuevaNotaDebitoProveedor').val();
        var notaCliente = $('#notaCliente_formNuevaNotaDebitoProveedor').val();
        var notaInterna = $('#notaInterna_formNuevaNotaDebitoProveedor').val();
        var importeNoGravado = $('#importeNoGravado_formNuevaNotaDebitoProveedor').val();
        var descuentoEfectuado = $('#descEfectuado_formNuevaNotaDebitoProveedor').val();
        var totalVenta = $('#totalVenta_formNuevaNotaDebitoProveedor').val();
        if (selectProveedor == 0) {
            $("#errorselectProveedor_formNuevaNotaDebitoProveedor").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectProveedor_formNuevaNotaDebitoProveedor").css("display", "none");
            val1 = true;
        }
        if (selectCompra == 0) {
            $("#errorSelectCompras_formNuevaNotaDebitoProveedor").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectCompras_formNuevaNotaDebitoProveedor").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaDebitoProveedor = $('#listadoDetalleNotaDebitoProveedor').DataTable();
        var info = tableListadoDetalleNotaDebitoProveedor.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaDebitoProveedor = {
                "selectProveedor": selectProveedor,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectCompra": selectCompra,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var datosDetalleNotaDebitoProveedor = [];
            var info = tableListadoDetalleNotaDebitoProveedor.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaDebitoProveedor.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaDebitoProveedor.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito_proveedor/set_nota_debito_proveedor/',
                    type: 'POST',
                    data: { datosDetalleNotaDebitoProveedor: datosDetalleNotaDebitoProveedor, datosNotaDebitoProveedor: datosNotaDebitoProveedor }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )
                        setTimeout(function() {
                            location.href = URL + 'notas_credito_debito_proveedor/listar_nota_debito_proveedor';
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin agregar nota de debito ---//

//--- Inicio agregar nota de credito ---//
$(document).ready(function() {
    $("#selectProductos_formNuevaNotaCreditoProveedor").change(function() {
        $("#selectProductos_formNuevaNotaCreditoProveedor option:selected").each(function() {
            var idProducto = $('#selectProductos_formNuevaNotaCreditoProveedor').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formNuevaNotaCredito").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaCreditoProveedor = $('#listadoDetalleNotaCreditoProveedor').DataTable();
                            var info = tableListadoDetalleNotaCreditoProveedor.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaCreditoProveedor.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaCreditoProveedor.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCreditoProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCreditoProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaCreditoProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaCreditoProveedor(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoProveedor.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaCreditoProveedor(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                $("#modal-cargando").modal("hide");
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    $('#btnGuardarNotaCreditoProveedor').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectProveedor = $('#selectProveedor_formNuevaNotaCreditoProveedor').val();
        var inputFechaEmision = $('#inputFechaEmision_formNuevaNotaCreditoProveedor').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formNuevaNotaCreditoProveedor').val();
        var selectTipoNota = $('#selectTipoNota_formNuevaNotaCreditoProveedor').val();
        var selectCompra = $('#selectCompras_formNuevaNotaCreditoProveedor').val();
        var notaCliente = $('#notaCliente_formNuevaNotaCreditoProveedor').val();
        var notaInterna = $('#notaInterna_formNuevaNotaCreditoProveedor').val();
        var importeNoGravado = $('#importeNoGravado_formNuevaNotaCreditoProveedor').val();
        var descuentoEfectuado = $('#descEfectuado_formNuevaNotaCreditoProveedor').val();
        var totalVenta = $('#totalVenta_formNuevaNotaCreditoProveedor').val();
        if (selectProveedor == 0) {
            $("#errorselectProveedor_formNuevaNotaCreditoProveedor").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectProveedor_formNuevaNotaCreditoProveedor").css("display", "none");
            val1 = true;
        }
        if (selectCompra == 0) {
            $("#errorSelectCompras_formNuevaNotaCreditoProveedor").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectCompras_formNuevaNotaCreditoProveedor").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaCreditoProveedor = $('#listadoDetalleNotaCreditoProveedor').DataTable();
        var info = tableListadoDetalleNotaCreditoProveedor.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaCreditoProveedor = {
                "selectProveedor": selectProveedor,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectCompra": selectCompra,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var datosDetalleNotaCreditoProveedor = [];
            var info = tableListadoDetalleNotaCreditoProveedor.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaCreditoProveedor.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaCreditoProveedor.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito_proveedor/set_nota_credito_proveedor/',
                    type: 'POST',
                    data: { datosDetalleNotaCreditoProveedor: datosDetalleNotaCreditoProveedor, datosNotaCreditoProveedor: datosNotaCreditoProveedor }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )
                        setTimeout(function() {
                            location.href = URL + 'notas_credito_debito_proveedor/listar_nota_credito_proveedor';
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin agregar nota de debito ---//

//--- Inicio modificar nota de debito ---//

function llenado_tabla_nota_debito_proveedor_editar(idNotaDebito) {
    //console.log("idNotaDebito " + idNotaDebito);
    if (idNotaDebito) {

        setTimeout(function() {
            var tableListadoDetalleNotaDebitoModificarProveedor = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
            $("#listadoDetalleNotaDebitoModificarProveedor").dataTable().fnDestroy();
            $('#listadoDetalleNotaDebitoModificarProveedor').dataTable({
                "sAjaxSource": URL + "notas_credito_debito_proveedor/listar_nota_debito_proveedor_table_by_idNotaDebito/" + idNotaDebito,
                "paging": true,
                "initComplete": function() {
                    setTimeout(function() {
                        totalDetalleNotaDebitoModificarProveedor();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0, 9],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column"
                }]
            });
        }, 850);
    } else {
        //console.log("No hay id");
    }
}

$(document).ready(function() {

    //--- agregar productos al detalle de la nota de credito

    $("#selectProductos_formModificarNotaDebitoProveedor").change(function() {
        $("#selectProductos_formModificarNotaDebitoProveedor option:selected").each(function() {
            var idProducto = $('#selectProductos_formModificarNotaDebitoProveedor').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formModificarNotaDebitoProveedor").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
                            var info = tableListadoDetalleNotaDebitoModificar.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaDebitoModificar.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaDebitoModificar.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebitoModificarProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaDebitoModificarProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaDebitoModificarProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaDebitoModificarProveedor(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaDebitoModificar.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaDebitoModificar.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaDebitoModificarProveedor(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    //--- Modificar la nota de debito ---//

    $('#btnModificarNotaDebitoProveedor').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectProveedor = $('#selectProveedor_formModificarNotaDebitoProveedor').val();
        var inputFechaEmision = $('#inputFechaEmision_formModificarNotaDebitoProveedor').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formModificarNotaDebitoProveedor').val();
        var selectTipoNota = $('#selectTipoNota_formModificarNotaDebitoProveedor').val();
        var selectCompra = $('#selectCompras_formModificarNotaDebitoProveedor').val();
        var notaCliente = $('#notaCliente_formModificarNotaDebitoProveedor').val();
        var notaInterna = $('#notaInterna_formModificarNotaDebitoProveedor').val();
        var importeNoGravado = $('#importeNoGravado_formModificarNotaDebitoProveedor').val();
        var descuentoEfectuado = $('#descEfectuado_formModificarNotaDebitoProveedor').val();
        var totalVenta = $('#totalVenta_formModificarNotaDebitoProveedor').val();
        var idNotaDebito = $('#idNotaDebito_formModificarNotaDebitoProveedor').val();
        if (selectProveedor == 0) {
            $("#errorselectProveedor_formModificarNotaDebitoProveedor").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectProveedor_formModificarNotaDebitoProveedor").css("display", "none");
            val1 = true;
        }
        if (selectCompra == 0) {
            $("#errorSelectCompras_formModificarNotaDebito").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectCompras_formModificarNotaDebito").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
        var info = tableListadoDetalleNotaCredito.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }


        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaDebitoProveedor = {
                "selectProveedor": selectProveedor,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectCompra": selectCompra,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var tableListadoDetalleNotaDebitoModificar = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
            var datosDetalleNotaDebitoProveedor = [];
            var info = tableListadoDetalleNotaDebitoModificar.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaDebitoModificar.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaDebitoProveedor.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito_proveedor/update_nota_debito_proveedor/',
                    type: 'POST',
                    data: { datosDetalleNotaDebitoProveedor: datosDetalleNotaDebitoProveedor, datosNotaDebitoProveedor: datosNotaDebitoProveedor, idNotaDebito: idNotaDebito }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )

                        setTimeout(function() {
                            location.href = URL + 'notas_credito_debito_proveedor/listar_nota_debito_proveedor';
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin modificar nota de debito ---//

//--- Inicio eliminar nota de debito ---//
function deleteNotaDebitoProveedor(idNotaDebito) {
    //e.preventDefault();
    $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

    $('.button-delete-si').click(function(e) {
        e.preventDefault();
        $("#modal-delete").modal("hide");
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'notas_credito_debito_proveedor/delete_nota_debito_proveedor/',
                type: 'POST',
                cache: false,
                data: {
                    idNotaDebito: idNotaDebito
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )

                    $('#listadoNotaDebitoProveedor').dataTable().fnDeleteRow("#" + idNotaDebito);
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");
            });
    })
}
//--- Fin eliminar nota de debito ---//

//--- Inicio Cambio de estado de la nota de debito a abonado ---//
function abonarProveedor(idNotaDebito) {
    $.ajax({
            url: URL + 'notas_credito_debito_proveedor/abonar_nota_debito_proveedor/',
            type: 'POST',
            cache: false,
            data: {
                idNotaDebito: idNotaDebito
            }
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {

                swal(
                    'Exito',
                    dato['msg'],
                    'success'
                )

                //--- cambio del color y mensaje del boton
                var element = document.getElementById("btn" + idNotaDebito);
                //--- anterior estado ---//
                element.classList.remove("btn-danger");
                //--- nuevo estado ---//
                element.classList.add("btn-success");
                element.innerText = "Abonado";
                //--- cambios de estados visibles ---//
                $("#verNotaDebitoProveedor" + idNotaDebito).css("display", "block");
                $("#editarNotaDebitoProveedor" + idNotaDebito).css("display", "none");
                $("#eliminarNotaDebitoProveedor" + idNotaDebito).css("display", "none");
                $("#abonarNotaDebitoProveedor" + idNotaDebito).css("display", "none");
            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
            $("#eliminacion-exitosa").modal("hide");
            $("#popUpError").modal("show");
        });
}
//--- Fin Cambio de estado de la nota de debito a abonado ---//

//--- Inicio modificar nota de credito ---//
function llenado_tabla_nota_credito_proveedor_editar(idNotaCredito) {
    //console.log("idNotaCredito " + idNotaCredito);
    if (idNotaCredito) {

        setTimeout(function() {
            var tableListadoDetalleNotaCreditoModificarProveedor = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
            $("#listadoDetalleNotaCreditoModificarProveedor").dataTable().fnDestroy();
            $('#listadoDetalleNotaCreditoModificarProveedor').dataTable({
                "sAjaxSource": URL + "notas_credito_debito_proveedor/listar_nota_credito_proveedor_table_by_idNotaCredito/" + idNotaCredito,
                "paging": true,
                "initComplete": function() {
                    setTimeout(function() {
                        totalDetalleNotaCreditoModificarProveedor();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0, 9],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column"
                }]
            });
        }, 850);
    } else {
        //console.log("No hay id");
    }
}

$(document).ready(function() {

    //--- agregar productos al detalle de la nota de credito ---//
    $("#selectProductos_formModificarNotaCreditoProveedor").change(function() {
        $("#selectProductos_formModificarNotaCreditoProveedor option:selected").each(function() {
            var idProducto = $('#selectProductos_formModificarNotaCreditoProveedor').val();
            if (idProducto != 0) {
                $("#modal-cargando").modal("show");
                $.ajax({
                        url: URL + 'productos/get_producto/',
                        type: 'POST',
                        data: { idProducto: idProducto }
                    })
                    .done(function(data) {
                        var dato = JSON.parse(data);
                        if (dato['valid']) {
                            //--- AGREGO FILA ---//
                            $("#errorStockProducto_formModificarNotaCreditoProveedor").css("display", "none");
                            var iva_tipos_option;
                            if (dato['iva_tipos']) {
                                for (var i = 0; i < dato['iva_tipos'].length; i++) {
                                    iva_tipos_option = iva_tipos_option + '<option value="' + dato['iva_tipos'][i]['valorIva'] + '">' + dato['iva_tipos'][i]['descripcion'] + '</option>';
                                }
                            }

                            var tableListadoDetalleNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
                            var info = tableListadoDetalleNotaCreditoModificar.page.info();
                            var count = info.recordsTotal;
                            var tabla = tableListadoDetalleNotaCreditoModificar.data();
                            var p = 0;
                            for (var i = 0; i < count; i++) {
                                if (dato['producto'][0]['idProducto'] == tabla[i][0]) {
                                    p++;
                                }
                            }

                            idProducto = "'" + dato['producto'][0]['idProducto'] + "'";
                            if (p == 0) {
                                var row = tableListadoDetalleNotaCreditoModificar.row.add([
                                    dato['producto'][0]['idProducto'],
                                    dato['producto'][0]['codigo'],
                                    dato['producto'][0]['nombre'],
                                    '<input type="text" value="' + 1 + '" id="cantProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCreditoModificarProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '<div id="errorStock' + dato['producto'][0]['idProducto'] + '" class="btn-danger erroBoxs" style="display: none">' +
                                    'Stock: ' + dato['producto'][0]['stock'] +
                                    '</div>' + '<input type="hidden" value="1" id="altaProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="precioProd' + dato['producto'][0]['idProducto'] + '" disabled class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">%</span>' +
                                    '<input type="text" value="' + 0 + '" id="descProd' + dato['producto'][0]['idProducto'] + '" onkeyup="calculoDetalleNotaCreditoModificarProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" class="form-control">' +
                                    '</div>',
                                    '<div class="input-group">' +
                                    '<span class="input-group-addon">$</span>' +
                                    '<input type="text" value="' + dato['producto'][0]['precioVenta'] + '" id="subTotalProd' + dato['producto'][0]['idProducto'] + '" readonly class="form-control">' +
                                    '</div>',
                                    '<select id="selectIva' + dato['producto'][0]['idProducto'] + '" class="select-full" onchange="calculoDetalleNotaCreditoModificarProveedor(' + idProducto + ',' + dato['producto'][0]['stock'] + ',' + dato['empresa'][0]['stock'] + ')" required>' +
                                    '<option value="0">IVA</option>' +
                                    iva_tipos_option +
                                    '</select>',
                                    '<i class="fas fa-trash-alt" style="font-size: 1.6em;padding-right: 5px;" onclick="deleteRowListaNotaCreditoModificarProveedor(' + idProducto + ')"></i>' +
                                    '&nbsp;',
                                    dato['producto'][0]['idProducto'],
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['producto'][0]['idProducto']);
                                tableListadoDetalleNotaCreditoModificar.row(row).column(0).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(1).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(2).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(3).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(4).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(5).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(6).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(7).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(8).nodes().to$().addClass('text-center');
                                tableListadoDetalleNotaCreditoModificar.row(row).column(9).nodes().to$().addClass('text-center');
                                calculoDetalleNotaCreditoModificarProveedor(dato['producto'][0]['idProducto'], dato['producto'][0]['stock'], dato['empresa'][0]['stock']);
                            } else {
                                swal(
                                    'Error',
                                    "El producto ya se encuentra inluido en la lista.",
                                    'error'
                                )
                            }
                            $("#modal-cargando").modal("hide");
                        } else {
                            swal(
                                'Error',
                                dato['msg'],
                                'error'
                            )
                        }
                    })
                    .fail(function(data) {
                        $("#modal-cargando").modal("hide");
                        $("#modal-exitoso").modal("hide");
                        $("#popUpError").modal("show");
                    });
            }
        });
    });
    //--- Modificar la nota de credito ---//
    $('#btnModificarNotaCreditoProveedor').click(function(e) {
        e.preventDefault();
        var val1, val2, val3;
        var selectProveedor = $('#selectProveedor_formModificarNotaCreditoProveedor').val();
        var inputFechaEmision = $('#inputFechaEmision_formModificarNotaCreditoProveedor').val();
        var inputFechaVencimiento = $('#inputFechaVencimiento_formModificarNotaCreditoProveedor').val();
        var selectTipoNota = $('#selectTipoNota_formModificarNotaCreditoProveedor').val();
        var selectCompra = $('#selectCompras_formModificarNotaCreditoProveedor').val();
        var notaCliente = $('#notaCliente_formModificarNotaCreditoProveedor').val();
        var notaInterna = $('#notaInterna_formModificarNotaCreditoProveedor').val();
        var importeNoGravado = $('#importeNoGravado_formModificarNotaCreditoProveedor').val();
        var descuentoEfectuado = $('#descEfectuado_formModificarNotaCreditoProveedor').val();
        var totalVenta = $('#totalVenta_formModificarNotaCreditoProveedor').val();
        var idNotaCredito = $('#idNotaCredito_formModificarNotaCreditoProveedor').val();
        if (selectProveedor == 0) {
            $("#errorselectProveedor_formModificarNotaCreditoProveedor").css("display", "block");
            val1 = false;
        } else {
            $("#errorselectProveedor_formModificarNotaCreditoProveedor").css("display", "none");
            val1 = true;
        }
        if (selectCompra == 0) {
            $("#errorSelectCompras_formModificarNotaCreditoProveedor").css("display", "block");
            val2 = false;
        } else {
            $("#errorSelectCompras_formModificarNotaCreditoProveedor").css("display", "none");
            val2 = true;
        }

        var tableListadoDetalleNotaCredito = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
        var info = tableListadoDetalleNotaCredito.page.info();
        var count = info.recordsTotal;
        if (count == 0) {
            document.getElementById("msgError").innerHTML = "Debe seleccionar al menos un producto.";
            $("#popUpErrorMsg").modal("show");
            val3 = false;
        } else {
            val3 = true;
        }

        if (val1 && val2 && val3) {
            $("#modal-cargando").modal("show");
            var datosNotaCreditoProveedor = {
                "selectProveedor": selectProveedor,
                "inputFechaEmision": inputFechaEmision,
                "inputFechaVencimiento": inputFechaVencimiento,
                "selectTipoNota": selectTipoNota,
                "selectCompra": selectCompra,
                "notaCliente": notaCliente,
                "notaInterna": notaInterna,
                "importeNoGravado": importeNoGravado,
                "totalVenta": totalVenta,
                "descuentoEfectuado": descuentoEfectuado
            };
            var tableListadoDetalleNotaCreditoModificar = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
            var datosDetalleNotaCreditoProveedor = [];
            var info = tableListadoDetalleNotaCreditoModificar.page.info();
            var count = info.recordsTotal;
            var tabla = tableListadoDetalleNotaCreditoModificar.data();
            var totalVenta = 0;
            var k = 0;
            for (var i = 0; i < count; i++) {
                var idInputSubTotal = "subTotalProd" + tabla[i][0];
                var valorInputSubTotal = $('#' + idInputSubTotal).val();
                totalVenta = parseInt(totalVenta) + parseInt(valorInputSubTotal);
                var e = document.getElementById('selectIva' + tabla[i][0]);
                var valueIvaSelect = e.options[e.selectedIndex].text;
                datosDetalleNotaCreditoProveedor.push({
                    "idGenProducto": tabla[i][0],
                    "codigo": tabla[i][1],
                    "cantidad": $('#cantProd' + tabla[i][0]).val(),
                    "precio": $('#precioProd' + tabla[i][0]).val(),
                    "descuento": $('#descProd' + tabla[i][0]).val(),
                    "subtotalProd": $('#subTotalProd' + tabla[i][0]).val(),
                    "iva": $('#selectIva' + tabla[i][0]).val(),
                    "idProducto": tabla[i][9],
                    "ivaText": valueIvaSelect
                });
            }

            $.ajax({
                    url: URL + 'notas_credito_debito_proveedor/update_nota_credito_proveedor/',
                    type: 'POST',
                    data: { datosDetalleNotaCreditoProveedor: datosDetalleNotaCreditoProveedor, datosNotaCreditoProveedor: datosNotaCreditoProveedor, idNotaCredito: idNotaCredito }
                })
                .done(function(data) {
                    var dato = JSON.parse(data);
                    //console.log(dato);
                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                            'Exito',
                            dato['msg'],
                            'success'
                        )

                        setTimeout(function() {
                            location.href = URL + 'notas_credito_debito_proveedor/listar_nota_credito_proveedor';
                        }, 1000);
                    } else {
                        swal(
                            'Error',
                            dato['msg'],
                            'error'
                        )
                    }

                })
                .fail(function(data) {
                    $("#popUpError").modal("show");
                });
        }
    });
});
//--- Fin modificar nota de debito ---//

//--- Inicio eliminar nota de debito ---//
function deleteNotaCreditoProveedor(idNotaCredito) {
    //e.preventDefault();
    $(".button-delete-si").unbind(); // Borro cache del evento para que no repita la funcio x cant. de clicks

    $('.button-delete-si').click(function(e) {
        e.preventDefault();
        $("#modal-delete").modal("hide");
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'notas_credito_debito_proveedor/delete_nota_credito_proveedor/',
                type: 'POST',
                cache: false,
                data: {
                    idNotaCredito: idNotaCredito
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("hide");
                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )

                    $('#listadoNotaCreditoProveedor').dataTable().fnDeleteRow("#" + idNotaCredito);
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#eliminacion-exitosa").modal("hide");
                $("#popUpError").modal("show");
            });
    })
}
//--- Fin eliminar nota de credito ---//

//--- Inicio ver nota de debito ---//
function ver_nota_debito_proveedor(idNota) {
    $.ajax({
            url: URL + 'notas_credito_debito_proveedor/generar_pdf_nota_debito_proveedor/',
            type: 'POST',
            cache: false,
            data: {
                idNota: idNota
            }
        })
        .done(function(data) {
            swal({
                title: "Nota Débito",
                width: "1200px",
                html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/notasdebito_proveedor/notaDebito' + idNota + '.pdf #zoom=100&view=fitH"></iframe>',
                showCancelButton: false,
                confirmButtonText: 'Cerrar',
            })
        });
}
//--- Fin ver nota de debito ---//

//--- Inicio ver nota de credito ---//
function ver_nota_credito_proveedor(idNota) {
    //console.log(idNota);
    $.ajax({
            url: URL + 'notas_credito_debito_proveedor/generar_pdf_nota_credito_proveedor/',
            type: 'POST',
            cache: false,
            data: {
                idNota: idNota
            }
        })
        .done(function(data) {
            swal({
                title: "Nota Crédito",
                width: "1200px",
                html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/notascredito_proveedor/notaCredito' + idNota + '.pdf #zoom=100&view=fitH"></iframe>',
                showCancelButton: false,
                confirmButtonText: 'Cerrar',
            })
        });
}
//--- Fin ver nota de credito ---//

//--- Inicio Filtro de fecha para el libro de iva ventas ---//

function calculoTotalIvaVenta() {

    var fechaIncio = $('#min-date-listado-libro-iva-ventas').val();
    var fechaFin = $('#max-date-listado-libro-iva-ventas').val();
    $.ajax({
            url: URL + 'libros/calculoTotalIvaVenta/' + fechaIncio + "/" + fechaFin,
            type: 'POST',
            cache: false
        })
        .done(function(data) {

            var dato = JSON.parse(data);
            if (dato['valid']) {
                if (dato['conRango'] == 1) {
                    document.getElementById("textoTotalIvaVentas").innerHTML = "Total IVA Venta.";
                } else {
                    document.getElementById("textoTotalIvaVentas").innerHTML = "Total IVA Venta desde " + fechaIncio + " hasta " + fechaFin;
                }
                document.getElementById("totalIVAVentas").innerHTML = dato['total'];
            }

        });
}

function aplicarFiltrolibroIVAVentas() {

    var fechaIncio = $('#min-date-listado-libro-iva-ventas').val();
    var fechaFin = $('#max-date-listado-libro-iva-ventas').val();
    if (fechaIncio != "" && fechaFin != "") {
        setTimeout(function() {
            tableListadoLibroIVAVentas = $('#listadoLibroIVAVentas').DataTable();
            $("#listadoLibroIVAVentas").dataTable().fnDestroy();
            $('#listadoLibroIVAVentas').DataTable({
                "sAjaxSource": URL + "libros/listar_libro_iva_ventas_rango_fechas_table/" + fechaIncio + "/" + fechaFin,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        calculoTotalIvaVenta();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }, 10);
    } else if (fechaIncio == "" && fechaFin == "") {
        //console.log("Un campo de las fechas no fue completado");
        setTimeout(function() {
            tableListadoLibroIVAVentas = $('#listadoLibroIVAVentas').DataTable();
            $("#listadoLibroIVAVentas").dataTable().fnDestroy();
            $('#listadoLibroIVAVentas').DataTable({
                "sAjaxSource": URL + "libros/listar_libro_iva_ventas_table/",
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        calculoTotalIvaVenta();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }, 10);
    }
}

//--- Fin Filtro de fecha para el libro de iva ventas ---//

//--- Inicio Filtro de fecha para el libro de iva compras ---//

function calculoTotalIvaCompra() {

    var fechaIncio = $('#min-date-listado-libro-iva-compra').val();
    var fechaFin = $('#max-date-listado-libro-iva-compra').val();
    $.ajax({
            url: URL + 'libros/calculoTotalIvaCompra/' + fechaIncio + "/" + fechaFin,
            type: 'POST',
            cache: false
        })
        .done(function(data) {

            var dato = JSON.parse(data);
            if (dato['valid']) {
                if (dato['conRango'] == 1) {
                    document.getElementById("textoTotalIvaCompras").innerHTML = "Total IVA Compra.";
                } else {
                    document.getElementById("textoTotalIvaCompras").innerHTML = "Total IVA Compra desde " + fechaIncio + " hasta " + fechaFin;
                }
                document.getElementById("totalIVACompras").innerHTML = dato['total'];
            }

        });
}

function aplicarFiltrolibroIVACompras() {

    var fechaIncio = $('#min-date-listado-libro-iva-compra').val();
    var fechaFin = $('#max-date-listado-libro-iva-compra').val();
    if (fechaIncio != "" && fechaFin != "") {
        setTimeout(function() {
            tableListadoLibroIVACompras = $('#listadoLibroIVACompras').DataTable();
            $("#listadoLibroIVACompras").dataTable().fnDestroy();
            $('#listadoLibroIVACompras').DataTable({
                "sAjaxSource": URL + "libros/listar_libro_iva_compras_rango_fecha_table/" + fechaIncio + "/" + fechaFin,
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        calculoTotalIvaCompra();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }, 10);
    } else if (fechaIncio == "" && fechaFin == "") {
        //console.log("Un campo de las fechas no fue completado");
        setTimeout(function() {
            tableListadoLibroIVACompras = $('#listadoLibroIVACompras').DataTable();
            $("#listadoLibroIVACompras").dataTable().fnDestroy();
            $('#listadoLibroIVACompras').DataTable({
                "sAjaxSource": URL + "libros/listar_libro_iva_compras_table/",
                "bSort": true,
                "rowId": 'staffId',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "initComplete": function() {
                    setTimeout(function() {
                        calculoTotalIvaCompra();
                    }, 850);
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'right' },
                    { 'sClass': 'center' }
                ],
            });
        }, 10);
    }
}

//--- Fin Filtro de fecha para el libro de iva compras ---//

//--- Inicio del agregado o quitado de mas input imagen en las condiguraciones del e-commerce ---//
$(document).ready(function() {
    var maxField = 5; // Numero maximo de campos
    var addButton = $('.add_imagen_banner_formConfiguracionEcommerce'); // Selector del boton de Insertar
    var wrapper = $('.field_wrapper_configuracionEcommercer'); // Contenedor de campos

    $(addButton).click(function() { // Una vez que se haga clic en el boton
        $.ajax({
                url: URL + 'configuracion_ecommerce/count_img_configuracion_ecommerce/',
                type: 'POST',
                cache: false,
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {

                    var x = dato['count']; // Iniciamos el contador a 1
                    if (x < maxField) { //Comprobamos el maximo                             x++; //Increment field counter

                        var fieldHTML = '<div id="delete_wrapper_configuracionEcommerce_' + x + '">' +
                            '<div class="field_wrapper" class="col-md-12">' +
                            '<img src="" alt="" style="  display:block; margin-right: auto; margin-right: auto;"  width="350" height="100" id="imgconfiguracionecommerce' + x + '">' +
                            '<br>' +
                            '<div class="form-group label-floating has-feedback"> ' +
                            '<div class="col-md-10" style="padding:0px;">' +
                            '<label class="control-label" for="imagenBanner"> Imagen para el Banner</label>' +
                            '<input type="file" name="fileImagenBanner_formConfiguracionEcommerce' + x + '" id="fileImagen_formConfiguracionEcommerce' + x + '" class="styled" onchange="cargar_img_config_banner(' + x + ',' + 1 + ')">' +
                            '<div id="errorFile_formConfiguracionEcommerce' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                            '* Ingrese una imagen.' +
                            '</div>' +
                            '<div id="errorFileFormato_formConfiguracionEcommerce' + x + '" class="btn-danger erroBoxs" style="display: none">' +
                            '* Ingrese una imagen con formato JPG, JPEG, PNG O GIF.' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-2" style="padding:0px;">' +
                            '<div class="form-group label-floating has-feedback">' +
                            '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                            '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                            '<a onclick="borrar_imagen_banner_configuracionEcommerce(' + x + ')" class="remove_imagen_banner_configuracionEcommerce" title="Remove field"><i class="icon-remove"></i></i></a>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                        $(wrapper).append(fieldHTML); // Añadimos el HTML
                    } else {
                        swal(
                            'Error',
                            "Usted a llegado a la carga maxima de imagenes para el banner",
                            'error'
                        )
                    }

                }
            });
    });
});

function borrar_imagen_banner_configuracionEcommerce(x) {
    var id = x;
    $('#delete_wrapper_configuracionEcommerce_' + id).remove(); //Eliminamos el div
    cargar_img_config_banner(id, 3);
}

//--- Inicio del agregado o quitado de mas input imagen en las condiguraciones del e-commerce ---//

function cargar_img_config_banner(id, operacion) {
    setTimeout(function() {

        var formData = new FormData($("#formConfiguracionEcommerce")[0]);
        //console.log("HOLA");
        $.ajax({
                url: URL + 'configuracion_ecommerce/obtener_nombre_imagen/' + id + "/" + operacion,
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    $("#imgconfiguracionecommerce" + id).attr("src", URL + "uploads/ecommerce/banner/" + dato['nombreImg']);
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            });
    }, 800);
}


//--- Inicio del agregado de las configuraciones ecommerce ---//
function configuracion_ecommerce() {

    var formData = new FormData($("#formConfiguracionEcommerce")[0]);
    if (formData) {
        $.ajax({
                url: URL + 'configuracion_ecommerce/guardar_configuracion_ecommerce/',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {

                    swal(
                        'Exito',
                        dato['msg'],
                        'success'
                    )

                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                swal(
                    'Error',
                    'Vuelva a intentarlo',
                    'error'
                )
            });
    } else {
        swal(
            'Error',
            'No se pudo obtener el formulario correctamente, vuelva a intentarlo',
            'error'
        )
    }
}
//--- Fin del agregado de las configuraciones ecommerce ---// 

//--- Agregamos un nuevo costo de envio ---//
$(document).ready(function() {
    var x = $('#idEnvioCosto_configuracionEcommerce').val(); // Iniciamos el contador a 1
    var maxField = 100; // Numero maximo de campos
    var addButton = $('.add_costo_cadeteria_formConfiguracionEcommerce'); // Selector del boton de Insertar
    var wrapper = $('.field_wrapper_costo_cadeteria_configuracionEcommercer'); // Contenedor de campos

    $(addButton).click(function() { // Una vez que se haga clic en el boton
        //console.log(x);
        var tarifa = $('#inputTarifaCadeteria_formConfiguracionEcommerce' + x + '').val();
        var cantCuadras = $('#inputCantidadCuadras_formConfiguracionEcommerce' + x + '').val();
        //console.log(x);
        //console.log(cantCuadras);
        //console.log(tarifa);
        if (tarifa != 0 || cantCuadras != 0) {
            x++; //Increment field counter
            if (x < maxField) {
                var fieldHTML = '' +
                    '<div id="delete_wrapper_configuracionEcommerce_' + x + '">' +
                    '<div class="field_wrapper" class="col-md-12">' +
                    '<div class="col-md-5">' +
                    '<div class="form-group label-floating has-feedback">' +
                    '<label class="control-label" for="inputTarifaCadeteria">Tarifa Cadeteria</label>' +
                    '<input name="inputTarifaCadeteria_formConfiguracionEcommerce' + x + '" id="inputTarifaCadeteria_formConfiguracionEcommerce' + x + '" type="text" class="form-control" placeholder="0" value="0">' +
                    '<div id="errorInputTarifaCadeteria_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">' +
                    '* Debe completar el campo' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                    '<div class="form-group label-floating has-feedback">' +
                    '<label class="control-label" for="inputCantidadCuadras">Cantidad de cuadras</label>' +
                    '<input name="inputCantidadCuadras_formConfiguracionEcommerce' + x + '" id="inputCantidadCuadras_formConfiguracionEcommerce' + x + '" type="text" class="form-control" placeholder="0" value="0">' +
                    '<div id="errorInputTarifaCadeteria_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">' +
                    '* Debe completar el campo' +
                    '</div>  ' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-2" style="padding:0px;">' +
                    '<div class="form-group label-floating has-feedback">' +
                    '<label class="control-label" style="text-align:center;width:100%;">Borrar</label>' +
                    '<div style="display:block;width:100%;text-align:center;padding-top:8px;">' +
                    '<a onclick="borrar_costo_cadeteria_configuracionEcommerce(' + x + ')" class="remove_costo_cadeteria_configuracionEcommerce" title="Remove field"><i class="icon-remove"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $(wrapper).append(fieldHTML); // Añadimos el HTML
            } else {
                swal(
                    'Información',
                    "Llego a su maximo de tarifas a ingresar",
                    'info'
                )
            }
        } else {
            swal(
                'Información',
                "Contiene un registro esperando ser completado, verifiquelo antes de agregar otro nuevo",
                'info'
            )
        }
    });
});
//--- Fin Agregamos un nuevo costo de envio ---//

//--- Borramos un costo de cadeteria en las configuraciones del ecommerce ---//
function borrar_costo_cadeteria_configuracionEcommerce(id) {
    $.ajax({
            url: URL + 'configuracion_ecommerce/delete_envio_costo/',
            type: 'POST',
            data: { id: id },
            cache: false
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            //console.log(dato);
            if (dato['valid']) {
                $('#delete_wrapper_configuracionEcommerce_' + id).remove(); //Eliminamos el div

                swal(
                    'Exito',
                    dato['msg'],
                    'success'
                )

            } else {
                swal(
                    'Error',
                    dato['msg'],
                    'error'
                )
            }
        })
        .fail(function(data) {
            swal(
                'Error',
                'Vuelva a intentarlo',
                'error'
            )
        });
}
//--- Fin Borramos un costo de cadeteria en las configuraciones del ecommerce ---//

//--- Funciones para mostrar mensajes y bloqueos en las tarifas ---//

function mensajeTarifaInternacional() {
    var select = $('#selectTarifaInternacional_formConfiguracionEcommerce').val();
    var tarifa = $('#inputTarifaInternacional_formConfiguracionEcommerce').val();
    //console.log(select);
    if (select == 0) {
        if (tarifa == 0) {
            $("#infoTarifaInternacional_formConfiguracionEcommerce").css("display", "block");
        } else {
            $("#infoTarifaInternacional_formConfiguracionEcommerce").css("display", "none");
        }
        document.getElementById("inputTarifaInternacional_formConfiguracionEcommerce").disabled = false;
    } else if (select == 1) {
        $("#infoTarifaInternacional_formConfiguracionEcommerce").css("display", "none");
        document.getElementById("inputTarifaInternacional_formConfiguracionEcommerce").disabled = true;
    }
}

function mensajeTarifaNacional() {
    var select = $('#selectTarifaNacional_formConfiguracionEcommerce').val();
    var tarifa = $('#inputTarifaNacional_formConfiguracionEcommerce').val();
    //console.log(select);
    if (select == 0) {
        if (tarifa == 0) {
            $("#infoTarifaNacional_formConfiguracionEcommerce").css("display", "block");
        } else {
            $("#infoTarifaNacional_formConfiguracionEcommerce").css("display", "none");
        }
        document.getElementById("inputTarifaNacional_formConfiguracionEcommerce").disabled = false;
    } else if (select == 1) {
        $("#infoTarifaNacional_formConfiguracionEcommerce").css("display", "none");
        document.getElementById("inputTarifaNacional_formConfiguracionEcommerce").disabled = true;
    }
}

function mensajeTarifaMercadoEnvio() {
    var select = $('#selectTarifaMercadoEnvio_formConfiguracionEcommerce').val();
    var tarifa = $('#inputTarifaMercadoEnvio_formConfiguracionEcommerce').val();
    //console.log(select);
    if (select == 0) {
        if (tarifa == 0) {
            $("#infoTarifaMercadoEnvio_formConfiguracionEcommerce").css("display", "block");
        } else {
            $("#infoTarifaMercadoEnvio_formConfiguracionEcommerce").css("display", "none");
        }
        document.getElementById("inputTarifaMercadoEnvio_formConfiguracionEcommerce").disabled = false;
    } else if (select == 1) {
        $("#infoTarifaMercadoEnvio_formConfiguracionEcommerce").css("display", "none");
        document.getElementById("inputTarifaMercadoEnvio_formConfiguracionEcommerce").disabled = true;
    }
}

//--- Fin Funciones para mostrar mensajes y bloqueos en las tarifas ---//

//--- Mensaje y calculo del descuento al precio del producto ---//

function porcentajeDescuentoProducto() {
    var precioVenta = $('#inputPrecioVenta_formProducto').val();
    var porcentaje = $('#inputPorcentajeDescuento_formProducto').val();
    if (precioVenta > 0 && porcentaje > 0) {
        var descuento = precioVenta - (precioVenta * (porcentaje / 100));
        document.getElementById("valorTotalDescuento").innerHTML = "$" + number_format(descuento, 2, ",", ".");
        $("#infoPorcentajeDescuento_formProducto").css("display", "block");
    } else {
        $("#infoPorcentajeDescuento_formProducto").css("display", "none");
    }
}

//--- Fin Mensaje y calculo del descuento al precio del producto ---//

//--- Enviar Detalle Venta ---//
function enviarDetalleVenta(idGenIngreso) {
    $.ajax({
            url: URL + 'ventas/generaPDFDetalleFactura/' + idGenIngreso,
            type: 'POST',
            cache: false,
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            ////console.log(dato);
            if (dato['valid']) {
                var email = "";
                if (dato['ingreso'][0]['email'] != "") {
                    email = dato['ingreso'][0]['email'];
                }

                swal({
                    title: 'Enviar Detalle de Venta',
                    html: '' +
                        '<div class="row col-md-12" style="width:700px">' +
                        '<div class="col-md-6">' +
                        '<input id="email_enviar" type="text" class="swal2-input" placeholder="Ingrese el email destino" value="' + email + '">' +
                        '<input id="asunto" type="text" class="swal2-input" placeholder="Asunto del mensaje">' +
                        '<textarea id="cuerpo" type="text" class="swal2-input" placeholder="Cuerpo del mensaje" style="height: 100px;" rows="10"></textarea>' +
                        '</div>' +
                        '<div class="col-md-6">' +
                        '<iframe width="100%" style="border:0px" height="300px" name="iframeGasto" id="iframeGasto" src="' + URL + 'uploads/comprobantes/ventas/' + idGenIngreso + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>' +
                        '</div>' +
                        '</div>',
                    text: 'Modal with a custom image.',
                    width: '700px',
                    showCancelButton: true,
                    confirmButtonText: 'Enviar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        var email = $('#email_enviar').val();
                        var asunto = $('#asunto').val();
                        var cuerpo = $('#cuerpo').val();
                        var url_pdf = URL + 'uploads/comprobantes/ventas/' + idGenIngreso + '/' + dato['nombrePdf'];
                        var nombreArchivo = dato['nombrePdf'];
                        return fetch(URL + "ventas/enviar_email_detalle_venta/", {
                                method: 'POST',
                                body: { email: email, asunto: asunto, cuerpo: cuerpo, url_pdf: url_pdf, nombreArchivo: nombreArchivo }
                            })
                            .then(response => {
                                swal(
                                    'Venta',
                                    'El detalle de la venta fue enviado con exito',
                                    'success'
                                )
                            })
                            .catch(error => {
                                swal(
                                    'Venta',
                                    'No se envio el detalle de la venta de forma exitosa, vuelva a intentarlo',
                                    'error'
                                )
                            })
                    },
                    allowOutsideClick: () => !swal.isLoading()
                })
            } else {
                swal(
                    'Error',
                    "Se produjo un error al obtener los datos del presupuesto, vuelva a intentarlo.",
                    'error'
                )
            }
        })
        .fail(function(data) {
            $("#modal-cargando").modal("hide");
        });
}

//--- Fin Enviar presupuesto ---//

//--- Inicio del llenado de las cta cte de proveedores modal ---//
function llenado_tabla_cta_cte_proveedores(idProveedor) {
    if (idProveedor) {
        $("#modal-cargando").modal("show");
        tableListadoCtaCteProveedor = $('#cteCtaProveedores').DataTable();
        $("#cteCtaProveedores").dataTable().fnDestroy();
        $('#cteCtaProveedores').DataTable({
            "sAjaxSource": URL + "compras/listar_cte_cta_proveedores_table/" + idProveedor,
            "bSort": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "aoColumns": [
                { 'sClass': 'center' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'center' },
                { 'sClass': 'center' }
            ]
        });
        setTimeout(function() {
            $("#modal-cta-cte-proveedores").modal("show");
            $("#modal-cargando").modal("hide");
        }, 400);
    } else {
        //console.log("No hay id");
    }

}
//--- Fin del llenado de las cta cte de proveedores modal ---//

//--- Inicio del llenado de las cta cte de proveedores modal ---//
function llenado_tabla_cta_cte_clientes(idCliente) {
    if (idCliente) {
        $("#modal-cargando").modal("show");
        tableListadoCtaCteCliente = $('#cteCtaClientes').DataTable();
        $("#cteCtaClientes").dataTable().fnDestroy();
        $('#cteCtaClientes').DataTable({
            "sAjaxSource": URL + "compras/listar_cte_cta_clientes_table/" + idCliente,
            "bSort": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
            "aoColumns": [
                { 'sClass': 'center' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'right' },
                { 'sClass': 'center' },
                { 'sClass': 'center' }
            ]
        });
        setTimeout(function() {
            $("#modal-cta-cte-clientes").modal("show");
            $("#modal-cargando").modal("hide");
        }, 400);
    } else {
        //console.log("No hay id");
    }

}
//--- Fin del llenado de las cta cte de proveedores modal ---//

function llenado_apertura_agregarCobro(idGenIngreso, operacion) {
    //console.log(idGenIngreso)

    if (idGenIngreso) {
        $("#modal-cargando").modal("show");
        $.ajax({
                url: URL + 'ventas/get_monto_adeudado_by_idGenIngreso/',
                type: 'POST',
                cache: false,
                data: {
                    idGenIngreso: idGenIngreso
                }
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                // //console.log(dato);
                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    document.getElementById('montoCobro').value = dato['adeudado'];
                    document.getElementById('montoAdeudado').value = dato['adeudado'];
                    document.getElementById('idGenIngresoCobro').value = idGenIngreso;
                    $('#selectSaldoAFavor').val(1).trigger('change');
                    if (parseFloat(dato['aFavor']) > 0) {
                        document.getElementById('saldoAFavor').value = dato['aFavor'];
                    } else {
                        document.getElementById('saldoAFavor').value = 0;
                    }
                    //--- Ocultamos los mensajes de error ---//
                    $("#errormontoCobro").css("display", "none");
                    $("#errorselectMedioCobro").css("display", "none");

                    //--- botones de agregar con diferentes funcionalidades el 2 es para la vista de crear NCND y el 1 es para ventas ---//
                    if (operacion == 2) {
                        $("#2agregarCobro").css("display", "block");
                        $("#1agregarCobro").css("display", "none");
                    } else if (operacion == 1) {
                        $("#2agregarCobro").css("display", "none");
                        $("#1agregarCobro").css("display", "block");
                    }

                    $("#modal-agregar-cobro").modal("show");
                } else {
                    $("#modal-cargando").modal("hide");
                    $("#popUpError").modal("show");
                }
            })
            .fail(function(data) {
                $("#modal-cargando").modal("hide");
                $("#popUpError").modal("show");
            });
    } else {
        $("#popUpError").modal("show");
    }
}

function agregarCobroNCND() {
    var val1, val2, val3, val4 = true;
    var idGenIngresoCobro = $('#idGenIngresoCobro').val();
    var montoAdeudado = parseFloat($('#montoAdeudado').val());
    var montoCobro = parseFloat($('#montoCobro').val());
    var saldoAFavor = parseFloat($('#saldoAFavor').val());
    var selectMedioCobro = $('#selectMedioCobro').val();
    var selectSaldoAFavor = $('#selectSaldoAFavor').val();

    if (idGenIngresoCobro == null || idGenIngresoCobro.length == 0 || idGenIngresoCobro == ' ' || idGenIngresoCobro == '') {
        val1 = false;
    } else {
        val1 = true;
    }
    if ((montoCobro == 0 && saldoAFavor > 0 && selectSaldoAFavor == 0) || (montoCobro > 0 && (montoCobro <= (montoAdeudado - saldoAFavor)) && selectSaldoAFavor == 0) || (montoCobro > 0 && selectSaldoAFavor == 1)) {
        $("#errormontoCobro").css("display", "none");
        val2 = true;
    } else {
        $("#errormontoCobro").css("display", "block");
        val2 = false;
    }
    if (selectMedioCobro == 0) {
        $("#errorselectMedioCobro").css("display", "block");
        val3 = false;
    } else {
        $("#errorselectMedioCobro").css("display", "none");
        val3 = true;
    }

    //--- si es 1 no quiere incluir el dinero a favor, entonces lo convertimos en 0 por el motivo de que si tiene monto a favor no se validara correctamente la siguiente verificacion ---//
    if (selectSaldoAFavor == 1) {
        saldoAFavor = 0;
    }

    if (val1 && val2 && val3) {
        $("#modal-cargando").modal("show");
        var formData = new FormData($("#formAgregarCobro")[0]);
        $.ajax({
                url: URL + 'ventas/set_cobro/',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(data) {
                var dato = JSON.parse(data);

                if (dato['valid']) {
                    $("#modal-cargando").modal("hide");
                    $("#modal-agregar-cobro").modal("hide");
                    var idGenIngreso = dato['idGenIngreso'];
                    $.ajax({
                            url: URL + 'ventas/generaPDFcupon/' + dato['idGenIngreso'],
                            type: 'POST',
                            cache: false,
                        })
                        .done(function(data) {
                            var dato = JSON.parse(data);

                            if (dato['valid']) {
                                //--- eliminado y agregado del resgistro ---//
                                var table = $('#listadoCobranzas').DataTable();
                                //$("#listadoCobranzas").dataTable().fnDeleteRow("#" + dato['idCuentaCorriente']);

                                if (dato['cuenta_corriente'][0]['idMedioCobro'] > 0) {

                                    cuenta = dato['cuenta_corriente'][0]['cuenta'];
                                    numeroPtoVta = dato['cuenta_corriente'][0]['numeroPtoVta'];
                                    idCuentaCorriente = dato['cuenta_corriente'][0]['idCuentaCorriente'];
                                    idGenComprobante = dato['cuenta_corriente'][0]['idGenComprobante'];

                                } else {

                                    numeroPtoVta = "- |";
                                    idCuentaCorriente = '-';
                                    cuenta = "-";

                                }

                                if (dato['cuenta_corriente'][0]['idGenComprobante']) {
                                    opcionComprobante = '<a target="_blank" href="' + URL + '/uploads/comprobantes/cobro/' + dato['ingreso'][0]['idGenIngreso'] + '/' + idGenComprobante + '.pdf">' + numeroPtoVta + '-' + idCuentaCorriente + '</a>';
                                } else {
                                    opcionComprobante = "-";
                                }


                                var row = table.row.add([
                                    dato['cuenta_corriente'][0]['fechaCobro'],
                                    dato['cuenta_corriente'][0]['cuenta'],
                                    dato['cuenta_corriente'][0]['descripcion'],
                                    "$" + number_format(dato['cuenta_corriente'][0]['credito'], 2, ",", "."),
                                    opcionComprobante,
                                ]).draw(false);
                                row.nodes().to$().attr('id', dato['cuenta_corriente'][0]['idCuentaCorriente']);
                                table.row(row).column(0).nodes().to$().addClass('text-center');
                                table.row(row).column(1).nodes().to$().addClass('text-center');
                                table.row(row).column(2).nodes().to$().addClass('text-center');
                                table.row(row).column(3).nodes().to$().addClass('text-center');
                                table.row(row).column(4).nodes().to$().addClass('text-center');

                                swal({
                                    title: "Comprobante",
                                    text: "Transaccion",
                                    //type: "info",
                                    width: "800px",
                                    html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/comprobantes/cobro/' + dato['ingreso'][0]['idGenIngreso'] + '/' + dato['nombrePdf'] + '#zoom=100&view=fitH"></iframe>',
                                    showCancelButton: false,
                                    confirmButtonText: 'Cerrar',
                                })

                            } else {

                                swal(
                                    'Error',
                                    dato['msg'],
                                    'error'
                                )

                            }
                        })
                        .fail(function(data) {
                            $("#operacionExitosa").modal("hide");
                            $("#popUpError").modal("show");
                        });
                } else {
                    swal(
                        'Error',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                $("#popUpError").modal("show");
            });
    }
}

function abrir_nc(idGenIngreso) {
    location.href = URL + 'notas_credito_debito/agregar_nota_credito_crear_ncnd/' + idGenIngreso;
}

function abrir_nd(idGenIngreso) {
    location.href = URL + 'notas_credito_debito/agregar_nota_debito_crear_ncnd/' + idGenIngreso;
}

function checkMontoAsegurado() {
    if ($('#incluitMontoAsegurado').prop('checked')) {
        $("#montoAsegurado_formNuevoRemito").removeAttr('disabled', 'disabled');
    } else {
        $("#montoAsegurado_formNuevoRemito").attr('disabled', 'disabled');
    }
}
$(document).ready(function() {
    $("#selectTransportista_formNuevoRemito").change(function() {
        $("#selectTransportista_formNuevoRemito option:selected").each(function() {
            var idTransportista = $('#selectTransportista_formNuevoRemito').val();
            if (idTransportista != 0) {
                if (idTransportista == "add_transportista") {
                    swal({
                        title: "Transportista",
                        width: "500px",
                        input: "text",
                        inputAttributes: {
                            id: "inputNombreTransportista",
                            autocomplete: "off",
                            placeholder: "Nombre del transportista",
                            value: ""
                        },
                        confirmButtonText: 'Registrar',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        preConfirm: (login) => {
                            var nombreTransportista = $('#inputNombreTransportista').val();
                            $.ajax({
                                    url: URL + 'remitos/agregar_transportista/',
                                    type: 'POST',
                                    cache: false,
                                    data: { nombreTransportista: nombreTransportista },
                                })
                                .done(function(data) {
                                    var dato = JSON.parse(data);

                                    if (dato['valid']) {

                                        //--- Obtenemos el select y inicializamos un nuevo option ---//
                                        var select = document.getElementById("selectTransportista_formNuevoRemito");
                                        var new_option = document.createElement("option");
                                        //--- Valores para el nuevo option ---//
                                        new_option.value = dato['datos_transportista'][0]['idTransportista'];
                                        new_option.text = dato['datos_transportista'][0]['nombre'];
                                        //--- Se añade las opciones al select ---//
                                        select.appendChild(new_option);

                                        swal(
                                            'Transportista',
                                            dato['msg'],
                                            'success'
                                        )
                                    } else {
                                        swal(
                                            'Transportista',
                                            dato['msg'],
                                            'error'
                                        )
                                    }
                                })
                                .fail(function(data) {
                                    $("#operacionExitosa").modal("hide");
                                    swal(
                                        'Transportista',
                                        "Error al agregar un nuevo transportista",
                                        'error'
                                    )
                                });

                        },
                    })
                }
            }
        });
    });
});

function llenado_tabla_remito(idGenIngreso) {
    if (idGenIngreso) {
        setTimeout(function() {
            tableListadoDetalleRemito = $('#listadoDetalleRemito').DataTable();
            $("#listadoDetalleRemito").dataTable().fnDestroy();
            $('#listadoDetalleRemito').DataTable({
                "sAjaxSource": URL + "remitos/listar_remito_table/" + idGenIngreso,
                "bSort": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column",
                }]
            });
        }, 700);
    } else {
        //console.log("No hay id");
    }

}

function deleteRowListaRemito(id) {
    tableListadoDetalleRemito = $('#listadoDetalleRemito').DataTable();
    tableListadoDetalleRemito.row('#' + id).remove().draw();
}

function deleteRowListaRemitoModificar(id) {
    tableListadoDetalleRemito_modificar = $('#listadoDetalleRemito_modificar').DataTable();
    tableListadoDetalleRemito_modificar.row('#' + id).remove().draw();
}

function guardar_remito() {

    var montoAsegurado = 0;

    //--- Obtencion de datos ---//
    var cliente = $('#inputCliente_formNuevoRemito').val();
    var domicilio = $('#inputDomicilioEntrega_formNuevoRemito').val();
    var fechaEmision = $('#inputFechaEmision_formNuevoRemito').val();
    var notaCliente = $('#inputNotaCliente_formNuevoRemito').val();
    var idGenIngreso = $('#idGenIngreso_formNuevoRemito').val();
    var cantidadBultos = $('#cantidadBultos_formNuevoRemito').val();

    var detalle = [];
    var tableListadoDetalleRemito = $('#listadoDetalleRemito').DataTable();
    var info = tableListadoDetalleRemito.page.info();
    var count = info.recordsTotal;
    var tabla = tableListadoDetalleRemito.data();

    for (var i = 0; i < count; i++) {
        //console.log(tabla);
        detalle.push({
            "idProducto": $('#selectProductos_formNuevoRemito' + tabla[i][0]).val(),
            "observacion": $('#observacion_formNuevoRemito' + tabla[i][0]).val(),
            "cantidad": $('#cantidad_formNuevoRemito' + tabla[i][0]).val()
        });
    }

    //--- formData ---//
    var formData = new FormData($("#formNuevoRemito")[0]);
    formData.append("detalle", JSON.stringify(detalle));
    formData.append("cliente", JSON.stringify(cliente));
    formData.append("domicilio", JSON.stringify(domicilio));
    formData.append("fechaEmision", JSON.stringify(fechaEmision));
    formData.append("notaCliente", JSON.stringify(notaCliente));
    formData.append("idGenIngreso", JSON.stringify(idGenIngreso));
    formData.append("cantidadBultos", JSON.stringify(cantidadBultos));

    //--- Validaciones ---//
    var val1, val2, val3;

    if (cliente == "") {
        $("#errorinputCliente_formNuevoRemito").css("display", "block");
        val1 = false;
    } else {
        $("#errorinputCliente_formNuevoRemito").css("display", "none");
        val1 = true;
    }

    if (domicilio == "") {
        $("#errorinputDomicilioEntrega_formNuevoRemito").css("display", "block");
        val2 = false;
    } else {
        $("#errorinputDomicilioEntrega_formNuevoRemito").css("display", "none");
        val2 = true;
    }

    if ($('#incluitMontoAsegurado').prop('checked')) {
        montoAsegurado = $('#montoAsegurado_formNuevoRemito').val();
    }
    formData.append("montoAsegurado", montoAsegurado);

    //--- Validacion de datos correctos ---//
    if (val1 && val2) {
        //--- Ajax ---//
        $.ajax({
                url: URL + "remitos/guardar_remito/",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    ver_remito(idGenIngreso, dato['idGenRemito']);
                } else {
                    swal(
                        'Remito',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                //console.log(data);
            });
    }
}

function llenado_tabla_remito_modificar(idGenIngreso) {
    if (idGenIngreso) {
        setTimeout(function() {
            tableListadoDetalleRemito_modificar = $('#listadoDetalleRemito_modificar').DataTable();
            $("#listadoDetalleRemito_modificar").dataTable().fnDestroy();
            $('#listadoDetalleRemito_modificar').DataTable({
                "sAjaxSource": URL + "remitos/listar_remito_modicar_table/" + idGenIngreso,
                "bSort": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                "aoColumns": [
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' },
                    { 'sClass': 'center' }
                ],
                "columnDefs": [{
                    "targets": [0],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column",
                }]
            });
        }, 700);
    } else {
        //console.log("No hay id");
    }

}

function checkMontoAseguradoModificar() {
    if ($('#incluitMontoAsegurado_formModificarRemito').prop('checked')) {
        $("#montoAsegurado_formModificarRemito").removeAttr('disabled', 'disabled');
    } else {
        $("#montoAsegurado_formModificarRemito").attr('disabled', 'disabled');
    }
}

function modificar_remito() {

    var montoAsegurado = 0;

    //--- Obtencion de datos ---//
    var redirec = $('#redireccion_formModificarRemito').val();
    var cliente = $('#inputCliente_formModificarRemito').val();
    var domicilio = $('#inputDomicilioEntrega_formModificarRemito').val();
    var fechaEmision = $('#inputFechaEmision_formModificarRemito').val();
    var notaCliente = $('#inputNotaCliente_formModificarRemito').val();
    var idGenIngreso = $('#idGenIngreso_formModificarRemito').val();
    var idGenRemito = $('#idGenRemito_formModificarRemito').val();
    var cantidadBultos = $('#cantidadBultos_formModificarRemito').val();

    var detalle = [];
    var tableListadoDetalleRemitoModificar = $('#listadoDetalleRemito_modificar').DataTable();
    var info = tableListadoDetalleRemitoModificar.page.info();
    var count = info.recordsTotal;
    var tabla = tableListadoDetalleRemitoModificar.data();

    for (var i = 0; i < count; i++) {
        //console.log(tabla);
        detalle.push({
            "idProducto": $('#selectProductos_formModificarRemito' + tabla[i][0]).val(),
            "observacion": $('#observacion_formModificarRemito' + tabla[i][0]).val(),
            "cantidad": $('#cantidad_formModificarRemito' + tabla[i][0]).val()
        });
    }

    //--- formData ---//
    var formData = new FormData($("#formModificarRemito")[0]);
    formData.append("detalle", JSON.stringify(detalle));
    formData.append("cliente", JSON.stringify(cliente));
    formData.append("domicilio", JSON.stringify(domicilio));
    formData.append("fechaEmision", JSON.stringify(fechaEmision));
    formData.append("notaCliente", JSON.stringify(notaCliente));
    formData.append("idGenIngreso", JSON.stringify(idGenIngreso));
    formData.append("idGenRemito", JSON.stringify(idGenRemito));
    formData.append("cantidadBultos", JSON.stringify(cantidadBultos));

    //--- Validaciones ---//
    var val1, val2, val3;

    if (cliente == "") {
        $("#errorinputCliente_formModificarRemito").css("display", "block");
        val1 = false;
    } else {
        $("#errorinputCliente_formModificarRemito").css("display", "none");
        val1 = true;
    }

    if (domicilio == "") {
        $("#errorinputDomicilioEntrega_formModificarRemito").css("display", "block");
        val2 = false;
    } else {
        $("#errorinputDomicilioEntrega_formModificarRemito").css("display", "none");
        val2 = true;
    }

    if ($('#incluitMontoAsegurado_formModificarRemito').prop('checked')) {
        montoAsegurado = $('#montoAsegurado_formModificarRemito').val();
    }

    formData.append("montoAsegurado", montoAsegurado);

    //--- Validacion de datos correctos ---//
    if (val1 && val2) {
        //--- Ajax ---//
        $.ajax({
                url: URL + "remitos/update_remito/",
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: formData
            })
            .done(function(data) {
                var dato = JSON.parse(data);
                //console.log(dato);
                if (dato['valid']) {
                    ver_remito(idGenIngreso, idGenRemito);
                } else {
                    swal(
                        'Remito',
                        dato['msg'],
                        'error'
                    )
                }
            })
            .fail(function(data) {
                //console.log(data);
            });
    }
}

function ver_remito(idGenIngreso, idGenRemito) {
    $.ajax({
            url: URL + 'remitos/generar_pdf_remito/',
            type: 'POST',
            cache: false,
            data: {
                idGenIngreso: idGenIngreso,
                idGenRemito: idGenRemito
            }
        })
        .done(function(data) {
            swal({
                title: "Remito",
                width: "1200px",
                html: '<iframe width="100%" height="400px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' + URL + 'uploads/remitos/' + idGenRemito + '.pdf #zoom=100&view=fitH"></iframe>',
                showCancelButton: false,
                confirmButtonText: 'Cerrar',
                allowOutsideClick: false,
                preConfirm: (login) => {
                    //--- Obtenemos la url anterior
                    var prevUrl = document.referrer;
                    //--- Obtenemos la url actual ---//
                    var URLactual = window.location;
                    //--- Comparamos la url anterior con la actual y que no redireccione si esta sobre el detalle ---//
                    if (prevUrl.indexOf(window.location.host) !== -1 && "//" + URLactual.host + URLactual.pathname != URL + "notas_credito_debito/nota_credito_debito_venta/" + idGenIngreso) {
                        // Ir a la página anterior
                        window.history.back();
                    }
                }
            })
        });
}

//--- Validar cuit y dni ---//

function validar_cuit_dni_cliente() {
    var tipoDoc = $('#selectTipoDoc_formCliente').val();
    var cuit = $('#inputNumDoc_formCliente').val();
    var longitud = cuit.length;

    if (tipoDoc == 6 || tipoDoc == 7) {
        if (longitud > 9 && longitud < 12) {
            if (cuit.length != 11) {
                return false;
            }

            var acumulado = 0;
            var digitos = cuit.split("");
            var digito = digitos.pop();

            for (var i = 0; i < digitos.length; i++) {
                acumulado += digitos[9 - i] * (2 + (i % 6));
            }

            var verif = 11 - (acumulado % 11);
            if (verif == 11) {
                verif = 0;
            } else if (verif == 10) {
                verif = 9;
            }

            if (digito == verif) {
                $("#errorInputNumDoc_formCliente").css("display", "none");
            } else {
                $("#errorInputNumDoc_formCliente").css("display", "block");
            }
        } else {
            $("#errorInputNumDoc_formCliente").css("display", "block");
        }
    }

    if (tipoDoc == 8) {
        if (longitud > 6 && longitud < 9) {
            $("#errorInputNumDoc_formCliente").css("display", "none");
        } else {
            $("#errorInputNumDoc_formCliente").css("display", "block");
        }
    }

    if (tipoDoc != 6 && tipoDoc != 7 && tipoDoc != 8) {
        $("#errorInputNumDoc_formCliente").css("display", "none");
    }
}

function validar_cuit_dni_proveedor() {
    var tipoDoc = $('#selectTipoDoc_formProveedor').val();
    var cuit = $('#inputNumDoc_formProveedor').val();
    var longitud = cuit.length;

    if (tipoDoc == 6 || tipoDoc == 7) {
        if (longitud > 9 && longitud < 12) {
            if (cuit.length != 11) {
                return false;
            }

            var acumulado = 0;
            var digitos = cuit.split("");
            var digito = digitos.pop();

            for (var i = 0; i < digitos.length; i++) {
                acumulado += digitos[9 - i] * (2 + (i % 6));
            }

            var verif = 11 - (acumulado % 11);
            if (verif == 11) {
                verif = 0;
            } else if (verif == 10) {
                verif = 9;
            }

            if (digito == verif) {
                $("#errorInputNumDoc_formProveedor").css("display", "none");
            } else {
                $("#errorInputNumDoc_formProveedor").css("display", "block");
            }
        } else {
            $("#errorInputNumDoc_formProveedor").css("display", "none");
        }
    }

    if (tipoDoc == 8) {
        if (longitud > 6 && longitud < 9) {
            $("#errorInputNumDoc_formProveedor").css("display", "none");
        } else {
            $("#errorInputNumDoc_formProveedor").css("display", "block");
        }
    }

    if (tipoDoc != 6 && tipoDoc != 7 && tipoDoc != 8) {
        $("#errorInputNumDoc_formCliente").css("display", "none");
    }
}

//--- Fin de validar cuit y dni ---//

function abrirMenuPrincipal() {
    location.href = URL + 'dashboard';
}
$(function() {

    /* # Data tables
     ================================================== */


    //===== Setting Datatable defaults =====//

    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        pagingType: 'full_numbers',
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '>', 'previous': '<' }
        }
    });



    //===== Default datatable =====//

    $('.datatable table').dataTable({
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar: ",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });

    //===== Datatable Creadas =====//

    window.onload = function() {
        tableListadoIngresos = $('#listadoIngresos').DataTable();
        $("#listadoIngresos").dataTable().fnDestroy();
        $('#listadoIngresos').DataTable({
            "sAjaxSource": URL + "ventas/listar_ventas_table",
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

        tableListadoIngresosInforme = $('#listadoIngresosInforme').DataTable();
        $("#listadoIngresosInforme").dataTable().fnDestroy();
        $('#listadoIngresosInforme').DataTable({
            "sAjaxSource": URL + "ventas/listar_ventas_informe_table",
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

        tableListadoPresupuesto = $('#listadoPresupuesto').DataTable();
        $("#listadoPresupuesto").dataTable().fnDestroy();
        $('#listadoPresupuesto').DataTable({
            "sAjaxSource": URL + "presupuesto/listar_presupuesto_table",
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
                { 'sClass': 'center' }
            ],
        });
    }

    tableListadoAbono = $('#listadoAbonos').DataTable();
    $("#listadoAbonos").dataTable().fnDestroy();
    $('#listadoAbonos').dataTable({
        "sAjaxSource": URL + "abonos/listar_abonos_table",
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
    tableListadoAbonoInforme = $('#listadoAbonosInforme').DataTable();
    $("#listadoAbonosInforme").dataTable().fnDestroy();
    $('#listadoAbonosInforme').dataTable({
        "sAjaxSource": URL + "abonos/listar_abonos_informe_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'right' },
            { 'sClass': 'right' },
            { 'sClass': 'right' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ],
    });

    tableListadoVentaEditar = $('#listadoVentaEditar').DataTable();
    $("#listadoVentaEditar").dataTable().fnDestroy();
    $('#listadoVentaEditar').dataTable({
        "paging": true,
        "aaSorting": [0, 'asc'],
        "initComplete": function() {
            setTimeout(function() {
                totalAbonoEditar();
            }, 500);
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
            "targets": [0],
            "visible": false,
            "searchable": false,
            className: "hide_column",
        }]
    });

    tableListadoPresupuesto_formModificarPresupuesto = $('#listadoPresupuesto_formModificarPresupuesto').DataTable();
    $("#listadoPresupuesto_formModificarPresupuesto").dataTable().fnDestroy();
    $('#listadoPresupuesto_formModificarPresupuesto').dataTable({
        "paging": true,
        "aaSorting": [0, 'asc'],
        "initComplete": function() {
            setTimeout(function() {
                totalPresupuestoDetalle();
            }, 500);
        },
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });

    tableListadoGastos = $('#listadoGastos').DataTable();
    $("#listadoGastos").dataTable().fnDestroy();
    $('#listadoGastos').dataTable({
        "sAjaxSource": URL + "gastos/listar_gastos_table",
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
            { 'sClass': 'right' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ],
    });
    tableListadoGastos = $('#listadoGastosInforme').DataTable();
    $("#listadoGastosInforme").dataTable().fnDestroy();
    $('#listadoGastosInforme').dataTable({
        "sAjaxSource": URL + "gastos/listar_gastos_informe_table",
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
            { 'sClass': 'right' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ],
    });

    tableListadoLibroIVACompras = $('#listadoLibroIVACompras').DataTable();
    $("#listadoLibroIVACompras").dataTable().fnDestroy();
    $('#listadoLibroIVACompras').dataTable({
        "sAjaxSource": URL + "libros/listar_libro_iva_compras_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'right' },
            { 'sClass': 'right' },
            { 'sClass': 'right' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoLibroIVAVentas = $('#listadoLibroIVAVentas').DataTable();
    $("#listadoLibroIVAVentas").dataTable().fnDestroy();
    $('#listadoLibroIVAVentas').dataTable({
        "sAjaxSource": URL + "libros/listar_libro_iva_ventas_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'right' },
            { 'sClass': 'right' },
            { 'sClass': 'right' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoClientes = $('#listadoClientes').DataTable();
    $("#listadoClientes").dataTable().fnDestroy();
    $('#listadoClientes').dataTable({
        "sAjaxSource": URL + "clientes/listar_clientes_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoProveedores = $('#listadoProveedores').DataTable();
    $("#listadoProveedores").dataTable().fnDestroy();
    $('#listadoProveedores').dataTable({
        "sAjaxSource": URL + "proveedores/listar_proveedores_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoMenuAdmin = $('#listadoMenuAdmin').DataTable();
    $("#listadoMenuAdmin").dataTable().fnDestroy();
    $('#listadoMenuAdmin').dataTable({
        "sAjaxSource": URL + "menu_admin/listar_menu_admin_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoUsuarios = $('#listadoUsuarios').DataTable();
    $("#listadoUsuarios").dataTable().fnDestroy();
    $('#listadoUsuarios').dataTable({
        "sAjaxSource": URL + "usuarios/listar_usuarios_table",
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
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ]
    });

    //--- Obtenemos las configuraciones del sistema para poder verificar si quiere o no controlar el stock ---//
    $.ajax({
            url: URL + 'configuracion_sistema/get_empresa/',
            type: 'POST',
        })
        .done(function(data) {
            var dato = JSON.parse(data);
            var empresa = dato['empresa'];


            if (empresa) {
                //--- Definimos las columnas que van a ser ocultas en la inicializacion de cada una ---//
                var columnasDefecto;
                var columnasDefecto2;
                var columnasDefecto3;
                if (empresa[0]['stock'] == 0) {
                    columnasDefecto = {
                        "targets": [0],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                    columnasDefecto2 = {
                        "targets": [0, 10],
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
                    columnasDefecto2 = {
                        "targets": [0, 4, 10],
                        "visible": false,
                        "searchable": false,
                        className: "hide_column",
                    }
                }
                columnasDefecto3 = {
                    "targets": [0, 9],
                    "visible": false,
                    "searchable": false,
                    className: "hide_column",
                }

                //--- Definimos las tablas ---//
                setTimeout(function() {
                    tableListadoCompra = $('#listadoCompra').DataTable();
                    $("#listadoCompra").dataTable().fnDestroy();
                    $('#listadoCompra').dataTable({
                        "paging": true,
                        "initComplete": totalCompra(),
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
                            { 'sClass': 'right' }
                        ],
                        "columnDefs": [
                            columnasDefecto
                        ]
                    });

                    tableListadoAbonoEditar = $('#listadoAbonoEditar').DataTable();
                    $("#listadoAbonoEditar").dataTable().fnDestroy();
                    $('#listadoAbonoEditar').dataTable({
                        "paging": true,
                        "aaSorting": [0, 'asc'],
                        "initComplete": function() {
                            setTimeout(function() {
                                totalAbonoEditar();
                            }, 500);
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

                    tableListadoVenta = $('#listadoVenta').DataTable();
                    $("#listadoVenta").dataTable().fnDestroy();
                    $('#listadoVenta').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalVenta();
                            }, 500);
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
                        "columnDefs": [
                            columnasDefecto2
                        ]
                    });

                    tableListadoDetalleNotaDebito = $('#listadoDetalleNotaDebito').DataTable();
                    $("#listadoDetalleNotaDebito").dataTable().fnDestroy();
                    $('#listadoDetalleNotaDebito').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalDetalleNotaDebito();
                            }, 500);
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
                            columnasDefecto3
                        ]
                    });

                    tableListadoDetalleNotaCredito = $('#listadoDetalleNotaCredito').DataTable();
                    $("#listadoDetalleNotaCredito").dataTable().fnDestroy();
                    $('#listadoDetalleNotaCredito').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalDetalleNotaCredito();
                            }, 500);
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
                            columnasDefecto3
                        ]
                    });

                    tableListadoDetalleNotaDebitoProveedor = $('#listadoDetalleNotaDebitoProveedor').DataTable();
                    $("#listadoDetalleNotaDebitoProveedor").dataTable().fnDestroy();
                    $('#listadoDetalleNotaDebitoProveedor').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalDetalleNotaDebitoProveedor();
                            }, 500);
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
                            columnasDefecto3
                        ]
                    });

                    tableListadoDetalleNotaDebitoModificarProveedor = $('#listadoDetalleNotaDebitoModificarProveedor').DataTable();
                    $("#listadoDetalleNotaDebitoModificarProveedor").dataTable().fnDestroy();
                    $('#listadoDetalleNotaDebitoModificarProveedor').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalDetalleNotaDebitoModificarProveedor();
                            }, 500);
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
                            columnasDefecto3
                        ]
                    });

                    tableListadoDetalleNotaCreditoModificarProveedor = $('#listadoDetalleNotaCreditoModificarProveedor').DataTable();
                    $("#listadoDetalleNotaCreditoModificarProveedor").dataTable().fnDestroy();
                    $('#listadoDetalleNotaCreditoModificarProveedor').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalDetalleNotaCreditoModificarProveedor();
                            }, 500);
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
                            columnasDefecto3
                        ]
                    });

                    tableListadoDetalleNotaCreditoProveedor = $('#listadoDetalleNotaCreditoProveedor').DataTable();
                    $("#listadoDetalleNotaCreditoProveedor").dataTable().fnDestroy();
                    $('#listadoDetalleNotaCreditoProveedor').dataTable({
                        "paging": true,
                        "initComplete": function() {
                            setTimeout(function() {
                                totalDetalleNotaCreditoProveedor();
                            }, 500);
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
                            columnasDefecto3
                        ]
                    });


                }, 1500);
            } else {
                var URLactual = window.location;
                if (URLactual['pathname'] != "/pyme/configuracion_sistema/listar_configuracion_sistema") {
                    swal({
                        type: 'warning',
                        title: 'Configuración Inicial',
                        text: 'Redirijase a las configuraciones iniciales para poder operar con el sistema',
                        confirmButtonText: 'Ir',
                        showLoaderOnConfirm: true,
                        preConfirm: (login) => {
                            setTimeout(function() {
                                location.href = URL + 'configuracion_sistema/listar_configuracion_sistema';
                            }, 400);
                        },
                        allowOutsideClick: false,
                    })
                }
            }
        });

    tableListadoEgresos = $('#listadoEgresos').DataTable();
    $("#listadoEgresos").dataTable().fnDestroy();
    $('#listadoEgresos').dataTable({
        "sAjaxSource": URL + "compras/listar_compras_table",
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
    tableListadoEgresosInforme = $('#listadoEgresosInforme').DataTable();
    $("#listadoEgresosInforme").dataTable().fnDestroy();
    $('#listadoEgresosInforme').dataTable({
        "sAjaxSource": URL + "compras/listar_compras_informe_table",
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

    $("#listadoProductos").dataTable().fnDestroy();
    $('#listadoProductos').dataTable({
        "order": [
            [5, "desc"]
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });

    tableListadoCtaCteProveedor = $('#listadoCtaCteProveedor').DataTable();
    $("#listadoCtaCteProveedor").dataTable().fnDestroy();
    $('#listadoCtaCteProveedor').dataTable({
        "sAjaxSource": URL + "informes/listar_cte_proveedores_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
        "initComplete": function() {
            setTimeout(function() {
                totales_informe_cte_proveedores_totales();
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
    });

    var idCliente = 0;
    tableListadoCtaCte = $('#listadoCtaCte').DataTable();
    $("#listadoCtaCte").dataTable().fnDestroy();
    $('#listadoCtaCte').dataTable({
        "sAjaxSource": URL + "informes/listar_cte_clientes_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
        "initComplete": function() {
            setTimeout(function() {
                totales_cte_clientes_total();
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
    });
    tableListadoTurnosCajas = $('#listadoTurnosCajas').DataTable();
    $("#listadoTurnosCajas").dataTable().fnDestroy();
    $('#listadoTurnosCajas').dataTable({
        "sAjaxSource": URL + "finanzas/listar_turnos_cajas_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
        //        "initComplete": function () {
        //            setTimeout(function () {
        //                totales_cte_clientes_total();
        //            }, 100);
        //        },
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

    tableListadoNotaCredito = $('#listadoNotaCredito').DataTable();
    $("#listadoNotaCredito").dataTable().fnDestroy();
    $('#listadoNotaCredito').dataTable({
        "sAjaxSource": URL + "notas_credito_debito/listar_nota_credito_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
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
            "targets": [0],
            "visible": false,
            "searchable": false,
            className: "hide_column",
        }]
    });

    tableListadoNotaDebito = $('#listadoNotaDebito').DataTable();
    $("#listadoNotaDebito").dataTable().fnDestroy();
    $('#listadoNotaDebito').dataTable({
        "sAjaxSource": URL + "notas_credito_debito/listar_nota_debito_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
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
            "targets": [0],
            "visible": false,
            "searchable": false,
            className: "hide_column",
        }]
    });

    tableListadoNotaCreditoProveedor = $('#listadoNotaCreditoProveedor').DataTable();
    $("#listadoNotaCreditoProveedor").dataTable().fnDestroy();
    $('#listadoNotaCreditoProveedor').dataTable({
        "sAjaxSource": URL + "notas_credito_debito_proveedor/listar_nota_credito_proveedor_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
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
            "targets": [0],
            "visible": false,
            "searchable": false,
            className: "hide_column",
        }]
    });

    tableListadoNotaDebitoProveedor = $('#listadoNotaDebitoProveedor').DataTable();
    $("#listadoNotaDebitoProveedor").dataTable().fnDestroy();
    $('#listadoNotaDebitoProveedor').dataTable({
        "sAjaxSource": URL + "notas_credito_debito_proveedor/listar_nota_debito_proveedor_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
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
            "targets": [0],
            "visible": false,
            "searchable": false,
            className: "hide_column",
        }]
    });

    tableListadoArqueoCajas = $('#listadoArqueoCajas').DataTable();
    $("#listadoArqueoCajas").dataTable().fnDestroy();
    $('#listadoArqueoCajas').dataTable({
        "sAjaxSource": URL + "finanzas/listar_arqueo_cajas_table",
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
                        title: 'Día sin abrir',
                        html: 'En este dia aun no se encuentra abierta la caja, por favor dirigirse a abrir la caja por medio del boton ir.',
                        showCancelButton: true,
                        confirmButtonText: 'IR',
                        showLoaderOnConfirm: true,
                        preConfirm: (login) => {
                            setTimeout(function() {
                                window.location.href = URL + "finanzas/listar_turnos_cajas";
                            }, 500);
                        },
                        allowOutsideClick: () => !swal.isLoading()
                    })
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

    tableListadoImportarXlsCliente = $('#listadoImportarXlsCliente').DataTable();
    $("#listadoImportarXlsCliente").dataTable().fnDestroy();
    $('#listadoImportarXlsCliente').dataTable({
        paging: true,
        "bSort": true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
    tableListadoImportarXlsProductos = $('#listadoImportarXlsProductos').DataTable();
    $("#listadoImportarXlsProductos").dataTable().fnDestroy();
    $('#listadoImportarXlsProductos').dataTable({
        paging: true,
        "bSort": true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });
    tableListadoImportarXlsProveedores = $('#listadoImportarXlsProveedores').DataTable();
    $("#listadoImportarXlsProveedores").dataTable().fnDestroy();
    $('#listadoImportarXlsProveedores').dataTable({
        paging: true,
        "bSort": true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });

    //===== Custom sort columns =====//

    tableListadoHistorial = $('#listadoHistorial').DataTable();
    $("#listadoHistorial").dataTable().fnDestroy();
    $('#listadoHistorial').dataTable({
        "sAjaxSource": URL + "historial/listar_operaciones_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "aoColumns": [
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoMovimientosInventario = $('#listadoMovimientosInventario').DataTable();
    $("#listadoMovimientosInventario").dataTable().fnDestroy();
    $('#listadoMovimientosInventario').dataTable({
        "sAjaxSource": URL + "movimientos_inventario/listar_movimientos_inventario_table",
        "bSort": true,
        "paging": true,
        "aaSorting": [0, 'asc'],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "aoColumns": [
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' },
            { 'sClass': 'center' }
        ]
    });

    tableListadoMovimientosCaja = $('#listadoMovimientosCaja').DataTable();
    tableListadoMovimientosCaja.destroy();
    tableListadoMovimientosCaja = $('#listadoMovimientosCaja').DataTable({
        paging: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
    });

    tableListadoRemitos = $('#listadoRemitos').DataTable();
    tableListadoRemitos.destroy();
    tableListadoRemitos = $('#listadoRemitos').DataTable({
        "paging": true,
        "language": {
            url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columnDefs": [{
            "targets": [0],
            "visible": false,
            "searchable": false,
            className: "hide_column",
        }]
    });

    //===== Custom sort columns =====//

    $('.datatable-pager table').dataTable({
        pagingType: 'simple',
        language: {
            paginate: { 'next': 'Next →', 'previous': '← Previous' }
        }
    });

    //===== Custom sort columns =====//

    $('.datatable-custom-sort table').dataTable({
        columnDefs: [{
            orderable: false,
            targets: [0, 2]
        }],
        order: [
            [1, 'asc']
        ]
    });


    //===== Tasks datatable =====//
    $('.datatable-invoices table').dataTable({
        columnDefs: [{
            orderable: false,
            targets: [1, 6]
        }],
        order: [
            [0, 'desc']
        ]

    });



    //===== Saving state =====//

    $('.datatable-tasks table').dataTable({});




    //===== Saving state =====//

    $('.datatable-ajax-source table').dataTable({
        ajax: 'media/datatable_ajax_source.txt'
    });




    //===== Datatable with selectable rows =====//

    $('.datatable-state-saving table').dataTable({
        stateSave: true
    });




    //===== Datatable with tools =====//

    $('.datatable-selectable table').dataTable({
        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
        tableTools: {
            sRowSelect: 'multi',
            aButtons: [{
                sExtends: 'collection',
                sButtonText: 'Tools <span class="caret"></span>',
                sButtonClass: 'btn btn-primary',
                aButtons: ['select_all', 'select_none']
            }]
        }
    });


    //===== Datatable with tools =====//

    $('.datatable-tools table').dataTable({
        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>',
        tableTools: {
            sRowSelect: "single",
            sSwfPath: "media/swf/copy_csv_xls_pdf.swf",
            aButtons: [{
                    sExtends: 'copy',
                    sButtonText: 'Copy',
                    sButtonClass: 'btn btn-default'
                },
                {
                    sExtends: 'print',
                    sButtonText: 'Print',
                    sButtonClass: 'btn btn-default'
                },
                {
                    sExtends: 'collection',
                    sButtonText: 'Save <span class="caret"></span>',
                    sButtonClass: 'btn btn-primary',
                    aButtons: ['csv', 'xls', 'pdf']
                }
            ]
        }
    });


    //===== Datatable with custom column filtering =====//

    // Setup - add a text input to each footer cell
    $('.datatable-add-row table tfoot th').each(function() {
        var title = $('.datatable-add-row table thead th').eq($(this).index()).text();
        $(this).html('<input type="text" class="form-control" placeholder="Filter ' + title + '" />');
    });

    // DataTable
    var table = $('.datatable-add-row table').DataTable();

    // Apply the filter
    $(".datatable-add-row table tfoot input").on('keyup change', function() {
        table
            .column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();

    });


    $('.dataTables_filter input[type=search]').attr('placeholder', 'Escribe para filtrar...');



    /* # Select2 dropdowns 
     ================================================== */


    //===== Datatable select =====//

    $(".dataTables_length select").select2({
        minimumResultsForSearch: "-1"
    });



    //===== Default select =====//

    $(".select").select2({
        minimumResultsForSearch: "-1",
        width: 200
    });



    //===== Liquid select =====//

    $(".select-liquid").select2({
        minimumResultsForSearch: "-1",
        width: "off"
    });


    //===== Full width select =====//

    $(".select-full").select2({
        width: "100%"
    });



    //===== Select with filter input =====//

    $(".select-search").select2({
        width: 200
    });



    //===== Multiple select =====//

    $(".select-multiple").select2({
        width: "100%"
    });



    //===== Loading data select =====//

    $("#loading-data").select2({
        placeholder: "Enter at least 1 character",
        allowClear: true,
        minimumInputLength: 1,
        query: function(query) {
            var data = { results: [] },
                i, j, s;
            for (i = 1; i < 5; i++) {
                s = "";
                for (j = 0; j < i; j++) {
                    s = s + query.term;
                }
                data.results.push({ id: query.term + i, text: s });
            }
            query.callback(data);
        }
    });


    //===== Select with maximum =====//

    $(".maximum-select").select2({
        maximumSelectionSize: 3,
        width: "100%"
    });


    //===== Allow clear results select =====//

    $(".clear-results").select2({
        placeholder: "Select a State",
        allowClear: true,
        width: 200
    });


    //===== Select with minimum =====//

    $(".minimum-select").select2({
        minimumInputLength: 2,
        width: 200
    });


    //===== Multiple select with minimum =====//

    $(".minimum-multiple-select").select2({
        minimumInputLength: 2,
        width: "100%"
    });


    //===== Disabled select =====//

    $(".select-disabled").select2(
        "enable", false
    );





    /* # Form Validation
     ================================================== */

    /*$(".validate").validate({
     errorPlacement: function(error, element) {
     if (element.parent().parent().attr("class") == "checker" || element.parent().parent().attr("class") == "choice" ) {
     error.appendTo( element.parent().parent().parent().parent().parent() );
     } 
     else if (element.parent().parent().attr("class") == "checkbox" || element.parent().parent().attr("class") == "radio" ) {
     error.appendTo( element.parent().parent().parent() );
     } 
     else {
     error.insertAfter(element);
     }
     },
     rules: {
     minimum_characters: {
     required: true,
     minlength: 3
     },
     maximum_characters: {
     required: true,
     maxlength: 6
     },
     minimum_number: {
     required: true,
     min: 3
     },
     maximum_number: {
     required: true,
     max: 6
     },
     holahola: {
     required: true,
     range: [0, 10]
     },
     email_field: {
     required: true,
     email: true
     },
     url_field: {
     required: true,
     url: true
     },
     date_field: {
     required: true,
     date: true
     },
     digits_only: {
     required: true,
     digits: true
     },
     enter_password: {
     required: true,
     minlength: 5
     },
     repeat_password: {
     required: true,
     minlength: 5,
     equalTo: "#enter_password"
     },
     custom_message: "required",
     group_styled: {
     required: true,
     minlength: 2
     },
     group_unstyled: {
     required: true,
     minlength: 2
     },
     agree: "required"
     },
     messages: {
     custom_message: {
     required: "Bazinga! This message is editable",
     },
     agree: "Please accept our policy"
     },
     success: function(label) {
     label.text('Success!').addClass('valid');
     }
     });*/




    /* # Bootstrap Multiselects
     ================================================== */


    //===== Default multiselect =====//

    $('.multi-select').multiselect({
        buttonClass: 'btn btn-default',
        onChange: function(element, checked) {
            $.uniform.update();
        }
    });


    //===== Multiselect with colored button =====//

    $('.multi-select-color').multiselect({
        buttonClass: 'btn btn-info',
        onChange: function(element, checked) {
            $.uniform.update();
        }
    });


    //===== Multiselect with "Select All" option =====//

    $('.multi-select-all').multiselect({
        buttonClass: 'btn btn-default',
        includeSelectAllOption: true,
        onChange: function(element, checked) {
            $.uniform.update();
        }
    });


    //===== onChange function =====//

    $('.multi-select-onchange').multiselect({
        buttonClass: 'btn btn-default',
        onChange: function(element, checked) {
            $.uniform.update();
            $.jGrowl('Change event invoked!', { header: 'Update', position: 'center', life: 1500 });
        }
    });


    //===== Right aligned multiselect dropdown =====//

    $('.multi-select-right').multiselect({
        buttonClass: 'btn btn-default',
        dropRight: true,
        onChange: function(element, checked) {
            $.uniform.update();
        }
    });


    //===== Search field select =====//

    $('.multi-select-search').multiselect({
        buttonClass: 'btn btn-link btn-lg btn-icon',
        dropRight: true,
        buttonText: function(options) {
            if (options.length == 0) {
                return '<b class="caret"></b>';
            } else {
                return ' <b class="caret"></b>';
            }
        },
        onChange: function(element, checked) {
            $.uniform.update();
        }
    });




    /* # jQuery UI Components
     ================================================== */


    //===== jQuery UI Autocomplete =====//

    var availableTags = [
        "ActionScript",
        "AppleScript",
        "Asp",
        "BASIC",
        "C",
        "C++",
        "Clojure",
        "COBOL",
        "ColdFusion",
        "Erlang",
        "Fortran",
        "Groovy",
        "Haskell",
        "Java",
        "JavaScript",
        "Lisp",
        "Perl",
        "PHP",
        "Python",
        "Ruby",
        "Scala",
        "Scheme"
    ];
    $(".autocomplete").autocomplete({
        source: availableTags
    });



    //===== Jquery UI sliders =====//

    $("#default-slider").slider();

    $("#increments-slider").slider({
        value: 100,
        min: 0,
        max: 500,
        step: 50,
        slide: function(event, ui) {
            $("#donation-amount").val("$" + ui.value);
        }
    });
    $("#donation-amount").val("$" + $("#increments-slider").slider("value"));

    $("#range-slider, #range-slider1").slider({
        range: true,
        min: 0,
        max: 500,
        values: [75, 300],
        slide: function(event, ui) {
            $("#price-amount, #price-amount1").val("$" + ui.values[0] + " - $" + ui.values[1]);
        }
    });
    $("#price-amount, #price-amount1").val("$" + $("#range-slider, #range-slider1").slider("values", 0) +
        " - $" + $("#range-slider, #range-slider1").slider("values", 1));

    $("#slider-range-min, #slider-range-min1").slider({
        range: "min",
        value: 37,
        min: 1,
        max: 700,
        slide: function(event, ui) {
            $("#min-amount, #min-amount1").val("$" + ui.value);
        }
    });
    $("#min-amount, #min-amount1").val("$" + $("#slider-range-min, #slider-range-min1").slider("value"));

    $("#slider-range-max, #slider-range-max1").slider({
        range: "max",
        min: 1,
        max: 10,
        value: 2,
        slide: function(event, ui) {
            $("#max-amount, #max-amount1").val(ui.value);
        }
    });
    $("#max-amount, #max-amount1").val($("#slider-range-max, #slider-range-max1").slider("value"));



    //===== Spinner options =====//

    $("#spinner-default").spinner();

    $("#spinner-decimal").spinner({
        step: 0.01,
        numberFormat: "n"
    });

    $("#culture").change(function() {
        var current = $("#spinner-decimal").spinner("value");
        Globalize.culture($(this).val());
        $("#spinner-decimal").spinner("value", current);
    });

    $("#currency").change(function() {
        $("#spinner-currency").spinner("option", "culture", $(this).val());
    });

    $("#spinner-currency").spinner({
        min: 5,
        max: 2500,
        step: 25,
        start: 1000,
        numberFormat: "C"
    });

    $("#spinner-overflow").spinner({
        spin: function(event, ui) {
            if (ui.value > 10) {
                $(this).spinner("value", -10);
                return false;
            } else if (ui.value < -10) {
                $(this).spinner("value", 10);
                return false;
            }
        }
    });

    $.widget("ui.timespinner", $.ui.spinner, {
        options: {
            // seconds
            step: 60 * 1000,
            // hours
            page: 60
        },

        _parse: function(value) {
            if (typeof value === "string") {
                // already a timestamp
                if (Number(value) == value) {
                    return Number(value);
                }
                return +Globalize.parseDate(value);
            }
            return value;
        },

        _format: function(value) {
            return Globalize.format(new Date(value), "t");
        }
    });

    $("#spinner-time").timespinner();
    $("#culture-time").change(function() {
        var current = $("#spinner-time").timespinner("value");
        Globalize.culture($(this).val());
        $("#spinner-time").timespinner("value", current);
    });



    //===== jQuery UI Datepicker =====//

    $(".datepicker").datepicker({
        showOtherMonths: true
    });

    $(".datepicker-inline").datepicker({ showOtherMonths: true });

    $(".datepicker-multiple").datepicker({
        showOtherMonths: true,
        numberOfMonths: 3
    });

    $(".datepicker-trigger").datepicker({
        showOn: "button",
        buttonImage: "images/interface/datepicker_trigger.png",
        buttonImageOnly: true,
        showOtherMonths: true
    });

    $(".from-date").datepicker({
        defaultDate: "+1w",
        numberOfMonths: 3,
        showOtherMonths: true,
        onClose: function(selectedDate) {
            $(".to-date").datepicker("option", "minDate", selectedDate);
        }
    });
    $(".to-date").datepicker({
        defaultDate: "+1w",
        numberOfMonths: 3,
        showOtherMonths: true,
        onClose: function(selectedDate) {
            $(".from-date").datepicker("option", "maxDate", selectedDate);
        }
    });

    $(".datepicker-restricted").datepicker({ minDate: -20, maxDate: "+1M +10D", showOtherMonths: true });





    /* # Bootstrap Plugins
     ================================================== */


    //===== Tooltip =====//

    $('.tip').tooltip();


    //===== Popover =====//

    $("[data-toggle=popover]").popover().click(function(e) {
        e.preventDefault()
    });


    //===== Loading button =====//

    $('.btn-loading').click(function() {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function() {
            btn.button('reset')
        }, 3000)
    });


    //===== Add fadeIn animation to dropdown =====//

    $('.dropdown, .btn-group').on('show.bs.dropdown', function(e) {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100);
    });


    //===== Add fadeOut animation to dropdown =====//

    $('.dropdown, .btn-group').on('hide.bs.dropdown', function(e) {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
    });


    //===== Prevent dropdown from closing on click =====//

    $('.popup').click(function(e) {
        e.stopPropagation();
    });





    /* # Form Related Plugins
     ================================================== */


    //===== Pluploader (multiple file uploader) =====//

    $(".multiple-uploader").pluploadQueue({
        runtimes: 'html5, html4',
        url: '../upload.php',
        chunk_size: '1mb',
        unique_names: true,
        filters: {
            max_file_size: '10mb',
            mime_types: [
                { title: "Image files", extensions: "jpg,gif,png" },
                { title: "Zip files", extensions: "zip" }
            ]
        },
        resize: { width: 320, height: 240, quality: 90 }
    });


    //===== WYSIWYG editor =====//

    $('.editor').wysihtml5({
        stylesheets: "css/wysihtml5/wysiwyg-color.css"
    });


    //===== Elastic textarea =====//

    $('.elastic').autosize();


    //===== Dual select boxes =====//

    $.configureBoxes();


    //===== Input limiter =====//

    $('.limited').inputlimiter({
        limit: 100,
        boxId: 'limit-text',
        boxAttach: false
    });


    //===== Tags Input =====//	

    $('.tags').tagsInput({ width: '100%' });
    $('.tags-autocomplete').tagsInput({
        width: '100%',
        autocomplete_url: 'tags_autocomplete.html'
    });


    //===== Form elements styling =====//

    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice', selectAutoWidth: false });




    /* # Interface Related Plugins
     ================================================== */


    //===== Sparkline charts =====//

    $('.bar-danger').sparkline(
        'html', { type: 'bar', barColor: '#D65C4F', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false" }
    );
    $('.bar-success').sparkline(
        'html', { type: 'bar', barColor: '#65B688', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false" }
    );

    $('.bar-primary').sparkline(
        'html', { type: 'bar', barColor: '#32434D', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false" }
    );
    $('.bar-warning').sparkline(
        'html', { type: 'bar', barColor: '#EE8366', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false" }
    );
    $('.bar-info').sparkline(
        'html', { type: 'bar', barColor: '#3CA2BB', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false" }
    );
    $('.bar-default').sparkline(
        'html', { type: 'bar', barColor: '#ffffff', height: '35px', barWidth: "5px", barSpacing: "2px", zeroAxis: "false" }
    );

    /* Activate hidden Sparkline on tab show */
    $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
        $.sparkline_display_visible();
    });

    /* Activate hidden Sparkline */
    $('.collapse').on('shown.bs.collapse', function() {
        $.sparkline_display_visible();
    });


    //===== Fancy box (lightbox plugin) =====//

    $(".lightbox").fancybox({
        padding: 1
    });


    //===== DateRangePicker plugin =====// 

    $('#reportrange').daterangepicker({
            startDate: moment().subtract('days', 29),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2014',
            dateLimit: { days: 60 },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                'Last 7 Days': [moment().subtract('days', 6), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
            },
            opens: 'right',
            buttonClasses: ['btn'],
            applyClass: 'btn-small btn-info btn-block',
            cancelClass: 'btn-small btn-default btn-block',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        },
        function(start, end) {
            $.jGrowl('Date range has been changed', { header: 'Update', position: 'center', life: 1500 });
            $('#reportrange .date-range').html(start.format('<i>D</i> <b><i>MMM</i> <i>YYYY</i></b>') + '<em> - </em>' + end.format('<i>D</i> <b><i>MMM</i> <i>YYYY</i></b>'));
        }
    );

    /* Custom date display layout */
    $('#reportrange .date-range').html(moment().subtract('days', 29).format('<i>D</i> <b><i>MMM</i> <i>YYYY</i></b>') + '<em> - </em>' + moment().format('<i>D</i> <b><i>MMM</i> <i>YYYY</i></b>'));
    $('#reportrange').on('show', function(ev, picker) {
        $('.range').addClass('range-shown');
    });

    $('#reportrange').on('hide', function(ev, picker) {
        $('.range').removeClass('range-shown');
    });


    //===== Bootstrap switches =====// 

    $('.switch').bootstrapSwitch();


    //===== Fullcalendar =====//

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var calendar = $('.fullcalendar').fullCalendar({
        header: {
            right: 'prev,next,today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
                calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true // make the event "stick"
                );
            }
            calendar.fullCalendar('unselect');
        },
        editable: true,
        events: [{
                title: 'All Day Event',
                start: new Date(y, m, 1)
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2)
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d - 3, 16, 0),
                allDay: false
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false
            },
            {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false
            },
            {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            },
            {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                allDay: false
            }
        ]
    });

    /* Render hidden calendar on tab show */
    $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
        $('.fullcalendar').fullCalendar('render');
    });


    //===== Code prettifier =====//

    window.prettyPrint && prettyPrint();


    //===== Time pickers =====//

    $('#defaultValueExample, #time').timepicker({ 'scrollDefaultNow': true });

    $('#durationExample').timepicker({
        'minTime': '2:00pm',
        'maxTime': '11:30pm',
        'showDuration': true
    });

    $('#onselectExample').timepicker();
    $('#onselectExample').on('changeTime', function() {
        $('#onselectTarget').text($(this).val());
    });

    $('#timeformatExample1, #timeformatExample3').timepicker({ 'timeFormat': 'H:i:s' });
    $('#timeformatExample2, #timeformatExample4').timepicker({ 'timeFormat': 'h:i A' });


    //===== Color picker =====//

    $('.color-picker').colorpicker();

    $('.color-picker-hex').colorpicker({
        format: 'hex'
    });

    /* Change navbar background color */
    var topStyle = $('.navbar-inverse')[0].style;
    $('.change-navbar-color').colorpicker().on('changeColor', function(ev) {
        topStyle.background = ev.color.toHex();
    });


    //===== jGrowl notifications defaults =====//

    $.jGrowl.defaults.closer = false;
    $.jGrowl.defaults.easing = 'easeInOutCirc';





    /* # Default Layout Options
     ================================================== */


    //===== Wrapping content inside .page-content =====//

    $('.page-content').wrapInner('<div class="page-content-inner"></div>');



    //===== Applying offcanvas class =====//

    $(document).on('click', '.offcanvas', function() {
        $('body').toggleClass('offcanvas-active');
    });



    //===== Default navigation =====//

    $('.navigation').find('li.active').parents('li').addClass('active');
    $('.navigation').find('li').not('.active').has('ul').children('ul').addClass('hidden-ul');
    $('.navigation').find('li').has('ul').children('a').parent('li').addClass('has-ul');


    $(document).on('click', '.sidebar-toggle', function(e) {
        e.preventDefault();

        $('body').toggleClass('sidebar-narrow');

        if ($('body').hasClass('sidebar-narrow')) {
            $('.navigation').children('li').children('ul').css('display', '');

            $('.sidebar-content').hide().delay().queue(function() {
                $(this).show().addClass('animated fadeIn').clearQueue();
            });
        } else {
            $('.navigation').children('li').children('ul').css('display', 'none');
            $('.navigation').children('li.active').children('ul').css('display', 'block');

            $('.sidebar-content').hide().delay().queue(function() {
                $(this).show().addClass('animated fadeIn').clearQueue();
            });
        }
    });


    $('.navigation').find('li').has('ul').children('a').on('click', function(e) {
        e.preventDefault();

        if ($('body').hasClass('sidebar-narrow')) {
            $(this).parent('li > ul li').not('.disabled').toggleClass('active').children('ul').slideToggle(250);
            $(this).parent('li > ul li').not('.disabled').siblings().removeClass('active').children('ul').slideUp(250);
        } else {
            $(this).parent('li').not('.disabled').toggleClass('active').children('ul').slideToggle(250);
            $(this).parent('li').not('.disabled').siblings().removeClass('active').children('ul').slideUp(250);
        }
    });



    //===== Panel Options (collapsing, closing) =====//

    /* Collapsing */
    $('[data-panel=collapse]').click(function(e) {
        e.preventDefault();
        var $target = $(this).parent().parent().next('div');
        if ($target.is(':visible')) {
            $(this).children('i').removeClass('icon-arrow-up9');
            $(this).children('i').addClass('icon-arrow-down9');
        } else {
            $(this).children('i').removeClass('icon-arrow-down9');
            $(this).children('i').addClass('icon-arrow-up9');
        }
        $target.slideToggle(200);
    });

    /* Closing */
    $('[data-panel=close]').click(function(e) {
        e.preventDefault();
        var $panelContent = $(this).parent().parent().parent();
        $panelContent.slideUp(200).remove(200);
    });



    //===== Showing spinner animation demo =====//

    $('.run-first').click(function() {
        $('body').append('<div class="overlay"><div class="opacity"></div><i class="icon-spinner2 spin"></i></div>');
        $('.overlay').fadeIn(150);
        window.setTimeout(function() {
            $('.overlay').fadeOut(150, function() {
                $(this).remove();
            });
        }, 5000);
    });

    $('.run-second').click(function() {
        $('body').append('<div class="overlay"><div class="opacity"></div><i class="icon-spinner3 spin"></i></div>');
        $('.overlay').fadeIn(150);
        window.setTimeout(function() {
            $('.overlay').fadeOut(150, function() {
                $(this).remove();
            });
        }, 5000);
    });

    $('.run-third').click(function() {
        $('body').append('<div class="overlay"><div class="opacity"></div><i class="icon-spinner7 spin"></i></div>');
        $('.overlay').fadeIn(150);
        window.setTimeout(function() {
            $('.overlay').fadeOut(150, function() {
                $(this).remove();
            });
        }, 5000);
    });



    //===== Disabling main navigation links =====//

    $('.navigation .disabled a, .navbar-nav > .disabled > a').click(function(e) {
        e.preventDefault();
    });



    //===== Toggling active class in accordion groups =====//

    $('.panel-trigger').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
    });


});
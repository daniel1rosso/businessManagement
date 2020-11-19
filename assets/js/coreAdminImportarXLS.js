function generarID_longitud(longitud) {
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
    var contraseña = "";
    for (i = 0; i < longitud; i++)
        contraseña += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    return contraseña;
}

function show_importar_clientes() {
    $("#errorfileXLSClientes").css("display", "none");
    document.getElementById("fileXLSClientes").value = "";
    $("#modal-importar-clientes").modal("show");
}

function enviarXLSClientes() {
    $("#modal-importar-clientes").modal("hide");
    var file = document.getElementById("fileXLSClientes");

    var formData = new FormData($("#formImportarClientes")[0]);
    var val1;

    if (file.files.length == 0) {
        $("#errorfileXLSClientes").css("display", "block");
        var val1 = false;
    } else {
        $("#errorfileXLSClientes").css("display", "none");
        var val1 = true;
    }

    if (val1) {
        $("#modal-cargando").modal("show");
        $.ajax({
            url: URL + 'importarxls/insert_file_clientes',
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false
        })
                .done(function (data) {
                    var dato = JSON.parse(data);
                    console.log(dato);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                                'Importar Cliente',
                                dato['msg'],
                                'success'
                                )

                        var table = $('#listadoImportarXlsCliente').DataTable();
                        table.clear();

                        for (var i = 2; i <= dato['longitud'] + 1; i++) {

                            var row = table.row.add([
                                dato['inserdata'][i]['A'],
                                dato['inserdata'][i]['B'],
                                dato['inserdata'][i]['C'],
                                dato['inserdata'][i]['D'],
                                dato['inserdata'][i]['E'],
                                dato['inserdata'][i]['F'],
                                dato['inserdata'][i]['G']
                            ]).draw(false);

                            row.nodes().to$().attr('id', i);
                            table.row(row).column(0).nodes().to$().addClass('text-center');
                            table.row(row).column(1).nodes().to$().addClass('text-center');
                            table.row(row).column(2).nodes().to$().addClass('text-center');
                            table.row(row).column(3).nodes().to$().addClass('text-center');
                            table.row(row).column(4).nodes().to$().addClass('text-center');
                            table.row(row).column(5).nodes().to$().addClass('text-center');
                            table.row(row).column(6).nodes().to$().addClass('text-center');

                        }

                        document.getElementById("importadoXls_clientes").value = 1;

                    } else {
                        $("#modal-importar-clientes").modal("hide");
                        $("#modal-cargando").modal("hide");
                        swal(
                                'Importar Cliente',
                                dato['msg'],
                                'error'
                                )
                    }

                })
                .fail(function (data) {
                    swal.close();
                    $("#popUpError").modal("show");
                });
    } else {
        $("#modal-importar-clientes").modal("hide");
        $("#modal-cargando").modal("hide");
        swal(
                'Importar Cliente',
                'No se encontro un archivo para cargar sus datos',
                'error'
                )
    }
}

function insert_datos_clientes() {

    //-- select de referecias --//
    var columna01_clientes = $('#columna01_clientes').val();
    var columna02_clientes = $('#columna02_clientes').val();
    var columna03_clientes = $('#columna03_clientes').val();
    var columna04_clientes = $('#columna04_clientes').val();
    var columna05_clientes = $('#columna05_clientes').val();
    var columna06_clientes = $('#columna06_clientes').val();
    var columna07_clientes = $('#columna07_clientes').val();
    var importadoXls_clientes = $('#importadoXls_clientes').val();

    //-- datatable --//
    var table = $('#listadoImportarXlsCliente').DataTable();

    //-- datos de la tabla --//
    datos = table.rows().data();

    var datos_clientes = [];
    var datos_clientes_datalle_facturacion = [];
    var datos_clientes_datalle_ventas = [];

    var idGenCliente = 0;

    if (importadoXls_clientes == 1) {
        if (columna01_clientes == 0 && columna02_clientes == 0 && columna03_clientes == 0 && columna04_clientes == 0 && columna05_clientes == 0 && columna06_clientes == 0 && columna07_clientes == 0) {
            $("#modal-cargando").modal("hide");
            swal(
                    'Error',
                    'Debe seleccionar la referecia de cada columna',
                    'error'
                    )
        } else {
            $("#modal-cargando").modal("show");

            for (var i = 0; i < datos['length']; i++) {
                var datos_clientes_back = {};
                var datos_clientes_datalle_facturacion_back = {};
                var datos_clientes_datalle_ventas_back = {};

                idGenCliente = generarID_longitud(15);

                for (var j = 0; j < 8; j++) {
                    if (j == 7) {
                        datos_clientes_back["idGenCliente"] = idGenCliente;
                    }
                    if (j == 0 && columna01_clientes != 0) {
                        console.log(i);
                        datos_clientes_back[columna01_clientes] = datos[i][j];
                    }
                    if (j == 1 && columna02_clientes != 0) {
                        datos_clientes_back[columna02_clientes] = datos[i][j];
                    }
                    if (j == 2 && columna03_clientes != 0) {
                        datos_clientes_back[columna03_clientes] = datos[i][j];
                    }
                    if (j == 3 && columna04_clientes != 0) {
                        datos_clientes_back[columna04_clientes] = datos[i][j];
                    }
                    if (j == 4 && columna05_clientes != 0) {
                        datos_clientes_back[columna05_clientes] = datos[i][j];
                    }
                    if (j == 5 && columna06_clientes != 0) {
                        datos_clientes_back[columna06_clientes] = datos[i][j];
                    }
                    if (j == 6 && columna07_clientes != 0) {
                        datos_clientes_back[columna07_clientes] = datos[i][j];
                    }
                }

                datos_clientes.push(datos_clientes_back);

                for (var h = 0; h < 1; h++) {
                    if (h == 0) {
                        datos_clientes_datalle_facturacion_back["idGenCliente"] = idGenCliente;
                    }
                }

                datos_clientes_datalle_facturacion.push(datos_clientes_datalle_facturacion_back);

                for (var k = 0; k < 1; k++) {
                    if (k == 0) {
                        datos_clientes_datalle_ventas_back["idGenCliente"] = idGenCliente;
                    }
                }

                datos_clientes_datalle_ventas.push(datos_clientes_datalle_ventas_back);

            }

            $.ajax({
                url: URL + 'importarxls/insert_datos_file_clientes',
                type: 'POST',
                dataType: 'json',
                data: {datos_clientes: JSON.stringify(datos_clientes), datos_clientes_datalle_facturacion: JSON.stringify(datos_clientes_datalle_facturacion), datos_clientes_datalle_ventas: JSON.stringify(datos_clientes_datalle_ventas)}
            })
                    .done(function (data) {
                        var dato = JSON.parse(JSON.stringify(data));

                        if (dato['valid']) {
                            $("#modal-cargando").modal("hide");
                            swal(
                                    'Importar Clientes',
                                    dato['msg'],
                                    'success'
                                    )
                            setTimeout(function () {
                                location.href = URL + 'importarxls/clientes';
                            }, 1500);
                        } else {
                            $("#modal-cargando").modal("hide");
                            swal(
                                    'Importar Clientes',
                                    dato['msg'],
                                    'error'
                                    )

                        }

                    })
                    .fail(function (data) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("show");
                    });
        }

    } else {
        $("#modal-cargando").modal("hide");
        swal(
                'Error',
                'Debe importar datos a la tabla',
                'error'
                )

    }

}

function show_importar_proveedores() {
    $("#errorfileXLSProveedores").css("display", "none");
    document.getElementById("fileXLSProveedores").value = "";
    $("#modal-importar-proveedores").modal("show");
}

function enviarXLSProveedores() {
    $("#modal-importar-proveedores").modal("hide");
    var file = document.getElementById("fileXLSProveedores");

    console.log(file);
    var formData = new FormData($("#formImportarProveedores")[0]);
    var val1;

    if (file.files.length == 0) {
        $("#errorfileXLSProveedores").css("display", "block");
        var val1 = false;
    } else {
        $("#errorfileXLSProveedores").css("display", "none");
        var val1 = true;
    }

    if (val1) {
        $("#modal-cargando").modal("show");
        $.ajax({
            url: URL + 'importarxls/insert_file_proveedores',
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false
        })
                .done(function (data) {
                    var dato = JSON.parse(data);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                                'Importar Proveedores',
                                dato['msg'],
                                'success'
                                )

                        var table = $('#listadoImportarXlsProveedores').DataTable();
                        table.clear();

                        for (var i = 2; i <= dato['longitud'] + 1; i++) {

                            var row = table.row.add([
                                dato['inserdata'][i]['A'],
                                dato['inserdata'][i]['B'],
                                dato['inserdata'][i]['C'],
                                dato['inserdata'][i]['D'],
                                dato['inserdata'][i]['E'],
                                dato['inserdata'][i]['F'],
                                dato['inserdata'][i]['G']
                            ]).draw(false);

                            row.nodes().to$().attr('id', i);
                            table.row(row).column(0).nodes().to$().addClass('text-center');
                            table.row(row).column(1).nodes().to$().addClass('text-center');
                            table.row(row).column(2).nodes().to$().addClass('text-center');
                            table.row(row).column(3).nodes().to$().addClass('text-center');
                            table.row(row).column(4).nodes().to$().addClass('text-center');
                            table.row(row).column(5).nodes().to$().addClass('text-center');
                            table.row(row).column(6).nodes().to$().addClass('text-center');


                        }

                        document.getElementById("importadoXls_proveedores").value = 1;

                    } else {
                        $("#modal-importar-proveedores").modal("hide");
                        $("#modal-cargando").modal("hide");
                        swal(
                                'Importar Proveedores',
                                dato['msg'],
                                'error'
                                )
                    }

                })
                .fail(function (data) {
                    swal.close();
                    $("#popUpError").modal("show");
                });
    }
    swal(
            'Importar Proveedores',
            'No se encontro un archivo para cargar sus datos',
            'error'
            )
}

function insert_datos_proveedores() {

    //-- select de referecias --//
    var columna01_proveedores = $('#columna01_proveedores').val();
    var columna02_proveedores = $('#columna02_proveedores').val();
    var columna03_proveedores = $('#columna03_proveedores').val();
    var columna04_proveedores = $('#columna04_proveedores').val();
    var columna05_proveedores = $('#columna05_proveedores').val();
    var columna06_proveedores = $('#columna06_proveedores').val();
    var columna07_proveedores = $('#columna07_proveedores').val();
    var importadoXls_proveedores = $('#importadoXls_proveedores').val();

    //-- datatable --//
    var table = $('#listadoImportarXlsProveedores').DataTable();

    //-- datos de la tabla --//
    datos = table.rows().data();

    var datos_proveedores = [];
    var datos_proveedores_datalle_facturacion = [];
    var datos_proveedores_datalle_compras = [];

    var idGenProveedor = 0;

    if (importadoXls_proveedores == 1) {
        if (columna01_proveedores == 0 && columna02_proveedores == 0 && columna03_proveedores == 0 && columna04_proveedores == 0 && columna05_proveedores == 0 && columna06_proveedores == 0 && columna07_proveedores == 0) {
            $("#modal-cargando").modal("hide");
            swal(
                    'Error',
                    'Debe seleccionar la referecia de cada columna',
                    'error'
                    )
        } else {
            $("#modal-cargando").modal("show");

            for (var i = 0; i < datos['length']; i++) {
                var datos_proveedores_back = {};
                var datos_proveedores_datalle_facturacion_back = {};
                var datos_proveedores_datalle_compras_back = {};

                idGenProveedor = generarID_longitud(15);

                for (var j = 0; j < 8; j++) {
                    if (j == 7) {
                        datos_proveedores_back["idGenProveedor"] = idGenProveedor;
                    }
                    if (j == 0 && columna01_proveedores != 0) {
                        datos_proveedores_back[columna01_proveedores] = datos[i][j];
                    }
                    if (j == 1 && columna02_proveedores != 0) {
                        datos_proveedores_back[columna02_proveedores] = datos[i][j];
                    }
                    if (j == 2 && columna03_proveedores != 0) {
                        datos_proveedores_back[columna03_proveedores] = datos[i][j];
                    }
                    if (j == 3 && columna04_proveedores != 0) {
                        datos_proveedores_back[columna04_proveedores] = datos[i][j];
                    }
                    if (j == 4 && columna05_proveedores != 0) {
                        datos_proveedores_back[columna05_proveedores] = datos[i][j];
                    }
                    if (j == 5 && columna06_proveedores != 0) {
                        datos_proveedores_back[columna06_proveedores] = datos[i][j];
                    }
                    if (j == 6 && columna07_proveedores != 0) {
                        datos_proveedores_back[columna07_proveedores] = datos[i][j];
                    }
                }

                datos_proveedores.push(datos_proveedores_back);

                for (var h = 0; h < 1; h++) {
                    if (h == 0) {
                        datos_proveedores_datalle_facturacion_back["idGenProveedor"] = idGenProveedor;
                    }
                }

                datos_proveedores_datalle_facturacion.push(datos_proveedores_datalle_facturacion_back);

                for (var k = 0; k < 1; k++) {
                    if (k == 0) {
                        datos_proveedores_datalle_compras_back["idGenProveedor"] = idGenProveedor;
                    }
                }

                datos_proveedores_datalle_compras.push(datos_proveedores_datalle_compras_back);

            }

            $.ajax({
                url: URL + 'importarxls/insert_datos_file_proveedores',
                type: 'POST',
                dataType: 'json',
                data: {datos_proveedores: JSON.stringify(datos_proveedores), datos_proveedores_datalle_facturacion: JSON.stringify(datos_proveedores_datalle_facturacion), datos_proveedores_datalle_compras: JSON.stringify(datos_proveedores_datalle_compras)}
            })
                    .done(function (data) {
                        var dato = JSON.parse(JSON.stringify(data));

                        if (dato['valid']) {
                            $("#modal-cargando").modal("hide");
                            swal(
                                    'Importar Proveedores',
                                    dato['msg'],
                                    'success'
                                    )
                            setTimeout(function () {
                                location.href = URL + 'importarxls/proveedores';
                            }, 1500);
                        } else {
                            $("#modal-cargando").modal("hide");
                            swal(
                                    'Importar Proveedores',
                                    dato['msg'],
                                    'error'
                                    )

                        }

                    })
                    .fail(function (data) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("show");
                    });
        }

    } else {
        $("#modal-cargando").modal("hide");
        swal(
                'Error',
                'Debe importar datos a la tabla',
                'error'
                )

    }

}

function show_importar_productos() {
    $("#errorfileXLSProductos").css("display", "none");
    document.getElementById("fileXLSProductos").value = "";
    $("#modal-importar-productos").modal("show");
}

function enviarXLSProductos() {
    $("#modal-importar-productos").modal("hide");
    var file = document.getElementById("fileXLSProductos");

    var formData = new FormData($("#formImportarProductos")[0]);
    var val1;

    if (file.files.length == 0) {
        $("#errorfileXLSProductos").css("display", "block");
        var val1 = false;
    } else {
        $("#errorfileXLSProductos").css("display", "none");
        var val1 = true;
    }

    if (val1) {
        $("#modal-cargando").modal("show");
        $.ajax({
            url: URL + 'importarxls/insert_file_productos',
            type: 'POST',
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false
        })
                .done(function (data) {
                    var dato = JSON.parse(data);

                    if (dato['valid']) {
                        $("#modal-cargando").modal("hide");
                        swal(
                                'Importar Productos',
                                dato['msg'],
                                'success'
                                )

                        var table = $('#listadoImportarXlsProductos').DataTable();
                        table.clear();

                        for (var i = 2; i <= dato['longitud'] + 1; i++) {

                            var row = table.row.add([
                                dato['inserdata'][i]['A'],
                                dato['inserdata'][i]['B'],
                                dato['inserdata'][i]['C'],
                                dato['inserdata'][i]['D'],
                                dato['inserdata'][i]['E'],
                                dato['inserdata'][i]['F'],
                                dato['inserdata'][i]['G']
                            ]).draw(false);

                            row.nodes().to$().attr('id', i);
                            table.row(row).column(0).nodes().to$().addClass('text-center');
                            table.row(row).column(1).nodes().to$().addClass('text-center');
                            table.row(row).column(2).nodes().to$().addClass('text-center');
                            table.row(row).column(3).nodes().to$().addClass('text-center');
                            table.row(row).column(4).nodes().to$().addClass('text-center');
                            table.row(row).column(5).nodes().to$().addClass('text-center');


                        }

                        document.getElementById("importadoXls_productos").value = 1;

                    } else {
                        $("#modal-importar-productos").modal("hide");
                        $("#modal-cargando").modal("hide");
                        swal(
                                'Importar Productos',
                                dato['msg'],
                                'error'
                                )
                    }

                })
                .fail(function (data) {
                    swal.close();
                    $("#popUpError").modal("show");
                });
    }
    swal(
            'Importar Productos',
            'No se encontro un archivo para cargar sus datos',
            'error'
            )
}

function insert_datos_productos() {

    //-- select de referecias --//
    var columna01_productos = $('#columna01_productos').val();
    var columna02_productos = $('#columna02_productos').val();
    var columna03_productos = $('#columna03_productos').val();
    var columna04_productos = $('#columna04_productos').val();
    var columna05_productos = $('#columna05_productos').val();
    var columna06_productos = $('#columna06_productos').val();
    var importadoXls_productos = $('#importadoXls_productos').val();

    //-- datatable --//
    var table = $('#listadoImportarXlsProductos').DataTable();

    //-- datos de la tabla --//
    datos = table.rows().data();

    var datos_productos = [];

    var idGenProductos = 0;

    if (importadoXls_productos == 1) {
        if (columna01_productos == 0 && columna02_productos == 0 && columna03_productos == 0 && columna04_productos == 0 && columna05_productos == 0 && columna06_productos == 0) {
            $("#modal-cargando").modal("hide");
            swal(
                    'Error',
                    'Debe seleccionar la referecia de cada columna',
                    'error'
                    )
        } else {
            $("#modal-cargando").modal("show");

            for (var i = 0; i < datos['length']; i++) {
                var datos_productos_back = {};

                idGenProductos = generarID_longitud(15);

                for (var j = 0; j < 7; j++) {
                    if (j == 6) {
                        datos_productos_back["idGenProducto"] = idGenProductos;
                    }
                    if (j == 0 && columna01_productos != 0) {
                        datos_productos_back[columna01_productos] = datos[i][j];
                    }
                    if (j == 1 && columna02_productos != 0) {
                        datos_productos_back[columna02_productos] = datos[i][j];
                    }
                    if (j == 2 && columna03_productos != 0) {
                        datos_productos_back[columna03_productos] = datos[i][j];
                    }
                    if (j == 3 && columna04_productos != 0) {
                        datos_productos_back[columna04_productos] = datos[i][j];
                    }
                    if (j == 4 && columna05_productos != 0) {
                        datos_productos_back[columna05_productos] = datos[i][j];
                    }
                    if (j == 5 && columna06_productos != 0) {
                        datos_productos_back[columna06_productos] = datos[i][j];
                    }

                }

                datos_productos.push(datos_productos_back);

            }

            $.ajax({
                url: URL + 'importarxls/insert_datos_file_productos',
                type: 'POST',
                dataType: 'json',
                data: {datos_productos: JSON.stringify(datos_productos)}
            })
                    .done(function (data) {
                        var dato = JSON.parse(JSON.stringify(data));

                        if (dato['valid']) {
                            $("#modal-cargando").modal("hide");
                            swal(
                                    'Importar Productos',
                                    dato['msg'],
                                    'success'
                                    )
                            setTimeout(function () {
                                location.href = URL + 'importarxls/productos';
                            }, 1500);
                        } else {
                            $("#modal-cargando").modal("hide");
                            swal(
                                    'Importar Productos',
                                    dato['msg'],
                                    'error'
                                    )

                        }

                    })
                    .fail(function (data) {
                        $("#modal-cargando").modal("hide");
                        $("#popUpError").modal("show");
                    });
        }

    } else {
        $("#modal-cargando").modal("hide");
        swal(
                'Error',
                'Debe importar datos a la tabla',
                'error'
                )

    }

}
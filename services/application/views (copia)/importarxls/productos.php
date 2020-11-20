<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Importar Productos<small>Listar</small></h3>
            </div>
        </div>

        <!---->

        <?php if (isset($successModif)) : ?>
            <div class="callout callout-success fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5>¡Bien!</h5>
                <p>Se modificó los productos con éxito.</p>
            </div>
        <?php endif; ?>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Importar Productos</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->

        <div class="form-actions text-right">

            <a onclick="show_importar_productos()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Importar Productos
            </a>

            <a onclick="insert_datos_productos()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Insertar Datos
            </a>

        </div>

        <!---->
        <input type="hidden" name="importadoXls_productos" id="importadoXls_productos" value="0">

        <div class="tab-content">
            <div class="tab-pane active fade in" id="productos">

                <!-- Striped and bordered datatable inside panel -->
                <div class="panel panel-default">
                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                    <div class="datatable">
                        <table class="table table-striped table-bordered" id="listadoImportarXlsProductos">
                            <thead>
                                <tr>
                                    <th>
                                        <select id="columna01_productos" name="columna01_productos">
                                            <option value="0">Elegir</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="codigo">Código</option>
                                            <option value="stock">Stock</option>
                                            <option value="precioCompra">Costo</option>
                                            <option value="precioVenta">Precio de Venta</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select id="columna02_productos" name="columna02_productos">
                                            <option value="0">Elegir</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="codigo">Código</option>
                                            <option value="stock">Stock</option>
                                            <option value="precioCompra">Costo</option>
                                            <option value="precioVenta">Precio de Venta</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select id="columna03_productos" name="columna03_productos">
                                            <option value="0">Elegir</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="codigo">Código</option>
                                            <option value="stock">Stock</option>
                                            <option value="precioCompra">Costo</option>
                                            <option value="precioVenta">Precio de Venta</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select id="columna04_productos" name="columna04_productos">
                                            <option value="0">Elegir</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="codigo">Código</option>
                                            <option value="stock">Stock</option>
                                            <option value="precioCompra">Costo</option>
                                            <option value="precioVenta">Precio de Venta</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select id="columna05_productos" name="columna05_productos">
                                            <option value="0">Elegir</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="codigo">Código</option>
                                            <option value="stock">Stock</option>
                                            <option value="precioCompra">Costo</option>
                                            <option value="precioVenta">Precio de Venta</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select id="columna06_productos" name="columna06_productos">
                                            <option value="0">Elegir</option>
                                            <option value="nombre">Nombre</option>
                                            <option value="codigo">Código</option>
                                            <option value="stock">Stock</option>
                                            <option value="precioCompra">Costo</option>
                                            <option value="precioVenta">Precio de Venta</option>
                                            <option value="descripcion">Descripción</option>
                                        </select>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tBodyCtaCte"></tbody>
                        </table>
                    </div>
                </div>

            </div>            
        </div>
    </div>
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Importar Proveedores<small>Listar</small></h3>
            </div>
        </div>

        <!---->

        <?php if (isset($successModif)) : ?>
            <div class="callout callout-success fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5>¡Bien!</h5>
                <p>Se modificó el movimiento con éxito.</p>
            </div>
        <?php endif; ?>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Importar Proveedores</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>
        
        <!---->
        
        <div class="form-actions text-right">
            
            <a onclick="show_importar_proveedores()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Importar Proveedores
            </a>
            
            <a onclick="insert_datos_proveedores()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Insertar Datos
            </a>
            
        </div>
        
        <!---->
        <input type="hidden" name="importadoXls_proveedores" id="importadoXls_proveedores" value="0">
       
            <div class="tab-content">
                <div class="tab-pane active fade in" id="movimientos">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoImportarXlsProveedores">
                                <thead>
                                    <tr>
                                        <th>
                                            <select id="columna01_proveedores" name="columna01_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna02_proveedores" name="columna02_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna03_proveedores" name="columna03_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna04_proveedores" name="columna04_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna05_proveedores" name="columna05_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna06_proveedores" name="columna06_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna07_proveedores" name="columna07_proveedores">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Proveedor</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                                <option value="domicilio">Domicilio</option>
                                                <option value="cp">Código Postal</option>
                                                <option value="nota">Nota</option>
                                                <!--<option value="cuit">CUIT</option>-->
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
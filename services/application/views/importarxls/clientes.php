<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Importar Clientes<small>Listar</small></h3>
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
                <li class="active">Importar Clientes</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>
        
        <!---->
        
        <div class="form-actions text-right">
            
            <a onclick="show_importar_clientes()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Importar Clientes
            </a>
            
            <a onclick="insert_datos_clientes()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Insertar Datos
            </a>
            
        </div>
        
        <!---->
        <input type="hidden" name="importadoXls_clientes" id="importadoXls_clientes" value="0">
       
            <div class="tab-content">
                <div class="tab-pane active fade in" id="movimientos">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoImportarXlsCliente">
                                <thead>
                                    <tr>
                                        <th>
                                            <select id="columna01_clientes" name="columna01_clientes">
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna02_clientes" name="columna02_clientes" >
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna03_clientes" name="columna03_clientes" >
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna04_clientes" name="columna04_clientes" >
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna05_clientes" name="columna05_clientes" >
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna06_clientes" name="columna06_clientes" >
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
                                            </select>
                                        </th>
                                        <th>
                                            <select id="columna07_clientes" name="columna07_clientes" >
                                                <option value="0">Elegir</option>
                                                <option value="nombEmpresa">Cliente</option>
                                                <option value="nombre">Nombre</option>
                                                <option value="apellido">Apellido</option>
                                                <option value="tel">Teléfono</option>
                                                <option value="cel">Celular</option>
                                                <option value="email">Email</option>
                                                <option value="pagWeb">Página Web</option>
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
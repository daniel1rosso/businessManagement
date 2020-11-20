<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Ventas<small>Listar</small></h3>
            </div>
        </div>

        <!---->

        <?php if (isset($successModif)) : ?>
            <div class="callout callout-success fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5>¡Bien!</h5>
                <p>Se modificó el proveedor con éxito.</p>
            </div>
        <?php endif; ?>

        <!---->

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Ventas</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!----> 
        <div class="form-actions text-right">
            <form  id="formExportInformeVenta" action="../ventas/exportar_to_excel_ventas" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="fechaI_informeVenta" id="fechaI_informeVenta">
                <input type="hidden" name="fechaF_informeVenta" id="fechaF_informeVenta">
                
                <button id="exportInformeVenta" value="Exportar ventas" class="btn btn-primary"><i class="fas fa-file-export"></i>Exportar ventas</button>
            </form>
        </div>
        <!---->

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Ventas
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="proveedores">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="container" style="padding-top:15px;width:100%;">
                            <div class="col-md-1 pull-left" style="padding-top: 5px;width: 42px;font-weight: 600;">
                                Fecha:
                            </div>
                            <div class="col-md-4 pull-left">
                                <div class="input-group input-daterange">
                                    <div class="input-group-addon">Desde</div>
                                    <input type="text" id="min-date-listado-ventas-informe" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="setFechaInicio_informeVenta()" autocomplete="off">
                                    <div class="input-group-addon">Hasta</div>
                                    <input type="text" id="max-date-listado-ventas-informe" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="setFechaFin_informeVenta()" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="datatable table-responsive">
                            <table class="table table-striped table-bordered" id="listadoIngresosInforme">
                                <thead>
                                    <tr>
                                        <th class="text-center">Estado</th>
                                        <th>Emisi&oacute;n</th>
                                        <th>Vencimiento</th>
                                        <th>Cliente</th>
                                        <th>Categoria</th>
                                        <th>Subtotal S/D</th>
                                        <th>Descuento</th>
                                        <th>Subtotal C/D</th>
                                        <th>Total</th>
                                        <th>A Cobrar</th>
                                        <th>Cobrado</th>
                                        <th>Vendedor</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>            
            </div>
        </div>

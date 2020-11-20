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
        
        <?php if(isset($successModif)) : ?>
        <div class="callout callout-success fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h5>¡Bien!</h5>
                <p>Se modificó el proveedor con éxito.</p>
        </div>
        <?php endif; ?>
        
        <!---->
        
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li><a href="<?=$url?>abonos/listar_abonos">Abonos</a></li>
                <li class="active">Ventas</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Ventas
                    </a>
                </li>	  	                 
            </ul>
            <script> idGenAbono = "<?= $idGenAbono ?>"; console.log(idGenAbono); llenado_tabla_venta_abono(idGenAbono);</script>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="proveedores">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable table-responsive">
                            <table class="table table-striped table-bordered" id="listadoIngresos_abono">
                                <thead>
                                    <tr>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Desde</th>
                                        <th class="text-center">Emisi&oacute;n</th>
                                        <th class="text-center">Vencimiento</th>
                                        <th class="text-center">Cliente</th>
                                        <th class="text-center">Categoria</th>
                                        <th class="text-center">Subtotal S/D</th>
                                        <th class="text-center">Descuento</th>
                                        <th class="text-center">Subtotal C/D</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">A Cobrar</th>
                                        <th class="text-center">Cobrado</th>
                                        <th class="text-center">Vendedor</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>

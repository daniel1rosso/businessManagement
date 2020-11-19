<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Compras<small>Listar</small></h3>
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
                <li class="active">Compras</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->
        
        <div class="form-actions text-right">
            <a href="<?=$url?>compras/agregar_compra" class="btn btn-primary">
                <i class="icon-plus"></i>
                Agregar Compra
            </a>
        </div>
        
        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Compras
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="proveedores">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoEgresos">
                                <thead>
                                    <tr>
                                        <th class="text-center">Estado</th>
                                        <th>Emisi&oacute;n</th>
                                        <th>Vencimiento</th>
                                        <th>Proveedor</th>
                                        <th>Subtotal S/D</th>
                                        <th>Descuento</th>
                                        <th>Subtotal C/D</th>
                                        <th>Total</th>
                                        <th>A Pagar</th>
                                        <th>Pagado</th>
                                        <th>Usuario</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>

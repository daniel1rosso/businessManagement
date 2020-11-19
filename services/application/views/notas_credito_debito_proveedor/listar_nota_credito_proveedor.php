<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Nota Crédito<small>Listar</small></h3>
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
                <li>Egresos</li>
                <li class="active">Nota Crédito</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>
        
        <!---->
        
        <div class="form-actions text-right">
            <a href="<?=$url?>notas_credito_debito_proveedor/agregar_nota_credito_proveedor" class="btn btn-primary">
                <i class="icon-plus"></i>
                Agregar Nueva Nota Crédito
            </a>
        </div>
        
        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-wallet" style="font-size:1.4em;"></i>
                        Nota Crédito
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="notacrediro">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoNotaCreditoProveedor">
                                <thead>
                                    <tr>
                                        <th class="text-center">idNota</th>
                                        <th class="text-center">Acciones</th>
                                        <th class="text-center">Emisi&oacute;n</th>
                                        <th class="text-center">Vencimiento</th>
                                        <th class="text-center">Proveedor</th>
                                        <th class="text-center">Tipo Nota</th>
                                        <th class="text-center">Subtotal S/D</th>
                                        <th class="text-center">Subtotal C/D</th>
                                        <th class="text-center">Total</th>
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
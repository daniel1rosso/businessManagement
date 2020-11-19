<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Movimientos Inventario<small>Listar</small></h3>
                </div>
        </div>
        
        <!---->
        
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li class="active">Movimientos Inventario</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#operaciones" data-toggle="tab">
                        <i class="fas fa-boxes" style="font-size:1.4em;"></i> 
                        Movimientos
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="operaciones">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoMovimientosInventario">
                                <thead>
                                    <tr>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Operaci&oacute;n</th>
                                        <th class="text-center">Cantidad</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Fecha y Hora</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>
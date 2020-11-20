<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Arqueo Cajas<small>Listar</small></h3>
            </div>
        </div>

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Finanzas</li>
                <li class="active">Arqueo Cajas</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#modal-nueva-categoria-gastos" data-toggle="tab">
                        <i class="fas fa-file-signature" style="font-size:1.4em;"></i>
                        Arqueo Cajas
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="arqueoCajas">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div id="div-superior-listado-arqueo" style="background: #339AF0; opacity: 0.8; color: white; padding: 5px; padding-bottom: 0.2px; margin-top: 10px;"><h6><span id="valorCierre">Saldo actual de la caja:    <?= (($saldoActualCaja == 0) ? "$" . number_format($valorApertura, 2, ",", ".") : "$" . number_format($saldoActualCaja, 2, ",", ".")); ?></span> <button class="btn btn-danger" style="padding: 3px;font-size: 0.8em;float: right;width: 10%;" onclick="cerrarCaja(1, <?=$valorApertura?>, <?=$saldoActualCaja?>)">Cerrar caja</button> </h6>   </div>
                        <div class="container" style="padding-top:15px;width:100%;">
                            <div class="col-md-4 pull-left">
                                <div class="input-group input-daterange">
                                    <div class="input-group-addon">Fecha</div>
                                    <input type="text" id="fecha-arqueo-cajas" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="filtro_arqueo_caja_by_fecha()" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoArqueoCajas">
                                <thead>
                                    <tr>
                                        <th class="text-center">id</th>
                                        <th class="text-center">Inicio del Turno</th>
                                        <th class="text-center">Cierre del Turno</th>
                                        <th class="text-center">Usuario</th>
                                        <th class="text-center">Efectivo de inicio</th>
                                        <th class="text-center">Efectivo de cierre</th>
                                        <th class="text-center">Efectivo esperado</th>
                                        <th class="text-center">Pagos Efectivo</th>
                                        <th class="text-center">Margen</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id="div-inferior-listado-arqueo" style="background: #339AF0; opacity: 0.8; color: white; padding: 5px; padding-bottom: 0.2px; margin-bottom: 10px;"><h6><span id="valorApertura"><?php if ($apertura == 0) { echo "Saldo actual de la caja: $" . number_format($valorApertura, 2, ",", "."); } else { echo "Apertura de caja: $" . number_format($valorApertura, 2, ",", "."); } ?></span></h6></div>
                    </div>

                </div>            
            </div>
        </div>
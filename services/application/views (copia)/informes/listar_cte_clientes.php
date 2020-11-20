<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Cuenta Corriente Clientes<small>Listar</small></h3>
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

        <!---->

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Informes</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <select data-placeholder="Selecciona Cliente" name="selectClienteCte" id="selectClienteCte" class="select-full" tabindex="2" onchange="setIdCliente_informeCteClientes()">
                    <option selected="selected" value="">Seleccione Cliente</option>
                    <?php
                    if (isset($clientes)):
                        foreach ($clientes as $key => $value) :
                            echo '<option value="' . $value['idCliente'] . '">' . $value['nombEmpresa'] . '</option>';
                        endforeach;
                    endif;
                    ?>
                </select>   
                <span class="label label-block label-primary text-left">Cliente</span>
            </div>
            <div class="col-sm-6">
            </div>
            <div class="col-sm-3">
                <div class="form-actions text-right">
                    <form  id="formExportInformeCteClientes" action="../informes/exportar_to_excel_cte_clientes" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="fechaI_informeCteClientes" id="fechaI_informeCteClientes">
                        <input type="hidden" name="fechaF_informeCteClientes" id="fechaF_informeCteClientes">
                        <input type="hidden" name="selectClienteCte_informeCteClientes" id="selectClienteCte_informeCteClientes">

                        <button id="exportInformeCteClientes" value="Exportar Cte Clientes" class="btn btn-primary"><i class="fas fa-file-export"></i>Exportar Cte Clientes</button>
                    </form>
                </div>
            </div>

        </div>                

        <br><br>

        <!---->

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#movimientos" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Movimientos
                    </a>
                </li>	  	                 
            </ul>
            <!---->
            <?php if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29): ?>         
                <ul class="page-stats list-justified">
                    <li class="bg-primary text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                Total venta
                            </span>
                            <h2><div id="totalVenta">$<?= number_format(0, 2, ',', '.') ?></div></h2>
                        </div>
                    </li>
                    <li class="bg-success text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                Cobrado   
                            </span>
                            <h2><div id="totalCobrado">$<?= number_format(0, 2, ',', '.') ?></div></h2>
                        </div>
                    </li>
                    <li class="bg-danger text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                A cobrar
                            </span>
                            <h2><div id="totalAdeudado">$<?= number_format(0, 2, ',', '.') ?></div></h2>
                        </div>
                    </li>
                </ul>        
            <?php endif;
            ?>          
            <!---->            
            <div class="tab-content">
                <div class="tab-pane active fade in" id="movimientos">

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
                                    <input type="text" id="min-date-listado-cte-clientes-informe" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="setFechaInicio_informeCteClientes()" autocomplete="off">
                                    <div class="input-group-addon">Hasta</div>
                                    <input type="text" id="max-date-listado-cte-clientes-informe" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" onblur="setFechaFin_informeCteClientes()" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoCtaCte">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Emisi&oacute;n</th>
                                        <th>Cliente</th>
                                        <th>Debito</th>
                                        <th>Credito</th>
                                        <th>Total Venta</th>
                                        <th>Saldo</th>
                                        <th>N° de Comprobante</th>
                                        <th>Medio de Cobro</th>
                                        <th>Descripci&oacute;n</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                </div>            
            </div>
        </div>

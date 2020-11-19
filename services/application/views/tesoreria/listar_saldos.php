<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-title">
                <h3>Saldos Tesoreria<small>Listar</small></h3>
            </div>
        </div>

        <!---->

        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?= $url ?>dashboard">Home</a></li>
                <li class="active">Saldos Tesoreria</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->

        <div class="form-actions text-right">
            <a href="#modal-movimiento-cuentas" data-toggle="modal" class="btn btn-primary" onclick="resetFormMovimientoCuentas()">
                <i class="icon-plus"></i>
                Movimiento entre Cuentas
            </a>
            <a href="<?=$url?>tesoreria/listar_cuentas" data-toggle="modal" class="btn btn-info">
                <i class="icon-wrench"></i>
                Config. Cuentas
            </a>
        </div>

        <!---->

        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#saldos" data-toggle="tab">
                        <i class="fas fa-hand-holding-usd" style="font-size:1.4em;"></i> 
                        Saldos
                    </a>
                </li>	  	                 
<!--                <li>
                    <a href="#movimientos" data-toggle="tab">
                        <i class="fas fa-funnel-dollar" style="font-size:1.4em;"></i> 
                        Movimientos
                    </a>
                </li>	  	                 -->
                <li>
                    <a href="#movimientosListado" data-toggle="tab">
                        <i class="fas fa-funnel-dollar" style="font-size:1.4em;"></i> 
                        Movimientos Listado
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="saldos">
                    <div class="row">
                        <?php 
                        if($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29):?>                           
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h6 class="panel-title">
                                        A Cobrar
                                    </h6>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">                                    
                                            <div class="panel panel-default">
                                                <div class="table-responsive">
                                                    <table class="table tableBoxsTesoreria">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 75%;text-align:left;">
                                                                    Saldo Cta Cte Clientes
                                                                </td>
                                                                <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                    $<?=number_format($cobrarCtaCteClientes, 2, ',', '.')?>
                                                                </td>
                                                            </tr>                                                            
                                                            <?php 
                                                                if(isset($aCobrar)):
                                                                    foreach ($aCobrar as $key => $value) :
                                                                        echo'
                                                                            <tr>
                                                                                <td style="width: 75%;text-align:left;">
                                                                                    '.$value['descripcion'].'
                                                                                </td>
                                                                                <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                                    $'.number_format($value['totalCuenta'], 2, ',', '.').'
                                                                                </td>
                                                                            </tr>
                                                                        ';
                                                                    endforeach;
                                                                endif;
                                                            ?> 
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>    
                                <div class="panel-footer">
                                    <h6 class="panel-title">
                                        Total A Cobrar
                                    </h6>
                                    <span id="totalesFooterTesoreria" class="badge">
                                        <?='$'.number_format($totalAcobrar, 2, ', ', ' . ')?>
                                    </span>
                                </div>                                 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    <h6 class="panel-title">
                                        A Pagar
                                    </h6>
                                </div> 
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">                                    
                                            <div class="panel panel-default">
                                                <div class="table-responsive">
                                                    <table class="table tableBoxsTesoreria">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 75%;text-align:left;">
                                                                    Saldo Cta Cte Proveedores
                                                                </td>
                                                                <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                    $<?=number_format($cobrarCtaCteProveedores, 2, ',', '.')?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: 75%;text-align:left;">
                                                                    Gastos Pendientes
                                                                </td>
                                                                <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                    $<?=number_format($cobrarGastos, 2, ',', '.')?>
                                                                </td>
                                                            </tr>
                                                            <?php 
                                                                if(isset($aPagar)):
                                                                    foreach ($aPagar as $key => $value) :
                                                                        echo'
                                                                        <tr>
                                                                            <td style="width: 75%;text-align:left;">
                                                                                '.$value['descripcion'].'
                                                                            </td>
                                                                            <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                                $'.number_format($value['totalCuenta'], 2, ',', '.').'
                                                                            </td>
                                                                        </tr>';
                                                                    endforeach;
                                                                endif;
                                                            ?>          
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>   
                                <div class="panel-footer">
                                    <h6 class="panel-title">
                                        Total A Pagar
                                    </h6>
                                    <span id="totalesFooterTesoreria" class="badge">
                                        <?='$'.number_format($totalApagar, 2, ', ', ' . ')?>
                                    </span>                                    
                                </div>                                
                            </div>
                        </div>
                        <?php endif;
                        ?>                           
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h6 class="panel-title">
                                        Disponible
                                    </h6>
                                    <span id="totalesFooterTesoreria" class="badge">
                                        Total: <?='$'.number_format($totalDisponible, 2, ', ', ' . ')?>
                                    </span>                                       
                                </div>  
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">                                    
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">
                                                        Cajas
                                                    </h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table tableBoxsTesoreria">
                                                        <tbody>
                                                            <?php 
                                                                if(isset($disponibleCajas)):
                                                                    foreach ($disponibleCajas as $key => $value) :
                                                                        echo'
                                                                            <tr>
                                                                                <td style="width: 75%;text-align:left;">
                                                                                    '.$value['descripcion'].'
                                                                                </td>
                                                                                <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                                    $'.number_format($value['totalCuenta'], 2, ',', '.').'
                                                                                </td>
                                                                            </tr>';
                                                                    endforeach;
                                                                endif;
                                                            ?>    
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="panel-footer">
                                                    <h6 class="panel-title">
                                                        Total Cajas
                                                    </h6>
                                                    <span id="totalesFooterTesoreria" class="badge">
                                                        <?='$'.number_format($totalDisponibleCajas, 2, ', ', ' . ')?>
                                                    </span>                                                    
                                                </div>                                                 
                                            </div>   
                                        </div>
                                        <?php 
                                        if($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29):?>                                             
                                        <div class="col-md-6">                                    
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h6 class="panel-title">
                                                        Bancos
                                                    </h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table tableBoxsTesoreria">
                                                        <tbody>
                                                            <?php 
                                                                if(isset($disponibleBancos)):
                                                                    foreach ($disponibleBancos as $key => $value) :
                                                                        echo'
                                                                            <tr>
                                                                                <td style="width: 75%;text-align:left;">
                                                                                    '.$value['descripcion'].'
                                                                                </td>
                                                                                <td style="width: 25%;text-align:right;font-weight:bold;">
                                                                                    $'.number_format($value['totalCuenta'], 2, ',', '.').'
                                                                                </td>
                                                                            </tr>';
                                                                    endforeach;
                                                                endif;
                                                            ?>    
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="panel-footer">
                                                    <h6 class="panel-title">
                                                        Total Bancos
                                                    </h6>
                                                    <span id="totalesFooterTesoreria" class="badge">
                                                        <?='$'.number_format($totalDisponibleBancos, 2, ', ', ' . ')?>
                                                    </span>                                                    
                                                </div>                                                 
                                            </div>   
                                        </div>
                                        <?php endif;
                                        ?>                                           
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>            

<!--                <div class="tab-pane" id="movimientos">
                    <div style="padding-bottom:10px;">
                        <div class="alert alert-info fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="icon-info"></i>
                            Conoce todos tus Movimientos de Dinero agrupados por cuentas de Tesorería! En este informe se contempla lo siguiente:
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <h7>Cobros</h7>
                                    <ul style="margin-top:5px;">
                                        <li>Todos los cobros realizados sobre tus Ventas.</li>
                                        <li>Todos los ingresos registrados en el módulo de "Otros Ingresos".</li>
                                    </ul>
                                </div>                        
                                <div class="col-md-6">
                                    <h7>Pagos</h7>
                                    <ul style="margin-top:5px;">
                                        <li>Todos los pagos realizados sobre tus Compras.</li>
                                        <li>Todos los pagos realizados al registrar Gastos. (Gastos con estado Pendiente NO contemplados).</li>
                                    </ul>
                                </div>                        
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                Fechas
                            </h6>                                       
                        </div>  
                        <div class="panel-body">      
                            <div class="row">
                                <div class="col-sm-3">
                                    <input type="text" id="fechaDesdeMovTesoreria" class="form-control" placeholder="Fecha Desde" onchange="filtroMovimientosTesoreria();" readonly>
                                    <span class="label label-block label-info text-left">Fecha Desde</span>
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="fechaHastaMovTesoreria" class="form-control" placeholder="Fecha Hasta" onchange="filtroMovimientosTesoreria();" readonly>
                                    <span class="label label-block label-info text-left" >Fecha Hasta</span>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <ul class="page-stats list-justified">
                        <li class="bg-info text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Desde
                                </span>
                                <h2>
                                    <div id="boxFechaDesde">
                                    </div>                                
                                </h2>
                            </div>
                        </li>
                        <li class="bg-info text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Hasta   
                                </span>
                                <h2>
                                    <div id="boxFechaHasta">
                                    </div>
                                </h2>
                            </div>
                        </li>
                        <li class="bg-success text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Total Cobros
                                </span>
                                <h2>
                                
                                </h2>
                            </div>
                        </li>
                        <li class="bg-danger text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Total Pagos
                                </span>
                                <h2>
                                
                                </h2>
                            </div>
                        </li>
                        <li class="bg-primary text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Resultados
                                </span>
                                <h2>
                                
                                </h2>
                            </div>
                        </li>
                    </ul>   
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                Cobros
                            </h6>                                       
                        </div>  
                        <div class="panel-body">                
                            <div class="panel panel-default" style="margin-bottom: 15px;">            
                                <div class="panel-heading">
                                    <h6 class="panel-title panel-trigger">
                                        <a data-toggle="collapse" href="#credenciales_comercio" class="collapsed">
                                            Cobros
                                        </a>
                                    </h6>
                                </div>
                                <div class="panel-collapse collapse" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
                                            <div class="form-group">

                                            </div>                
                                        </div>
                                    </div>                
                                </div>
                                <div class="panel-footer">
                                    <h6 class="panel-title">
                                        Total Cobros
                                    </h6>
                                    <span id="totalesFooterTesoreria" class="badge">
                                        $0.0
                                    </span>                                                    
                                </div>                                   
                            </div>    
                        </div>
                    </div>
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                Pagos
                            </h6>                                       
                        </div>  
                        <div class="panel-body">                
                            <div class="panel panel-default" style="margin-bottom: 15px;">            
                                <div class="panel-heading">
                                    <h6 class="panel-title panel-trigger">
                                        <a data-toggle="collapse" href="#credenciales_comercio" class="collapsed">
                                            Pagos
                                        </a>
                                    </h6>
                                </div>
                                <div class="panel-collapse collapse" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="col-sm-12" style="padding-left: 0px;padding-right: 0px;">
                                            <div class="form-group">

                                            </div>                
                                        </div>
                                    </div>                
                                </div>
                                <div class="panel-footer">
                                    <h6 class="panel-title">
                                        Total Pagos
                                    </h6>
                                    <span id="totalesFooterTesoreria" class="badge">
                                        $0.0
                                    </span>                                                    
                                </div>                                 
                            </div>    
                        </div>
                    </div>
                </div>            -->
                <div class="tab-pane" id="movimientosListado">
                    <div style="padding-bottom:10px;">
                        <div class="alert alert-info fade in">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="icon-info"></i>
                            Conoce todos tus Movimientos de Dinero agrupados por cuentas de Tesorería! En este informe se contempla lo siguiente:
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <h7>Cobros</h7>
                                    <ul style="margin-top:5px;">
                                        <li>Todos los cobros realizados sobre tus Ventas.</li>
                                        <li>Todos los ingresos registrados en el módulo de "Otros Ingresos".</li>
                                    </ul>
                                </div>                        
                                <div class="col-md-6">
                                    <h7>Pagos</h7>
                                    <ul style="margin-top:5px;">
                                        <li>Todos los pagos realizados sobre tus Compras.</li>
                                        <li>Todos los pagos realizados al registrar Gastos. (Gastos con estado Pendiente NO contemplados).</li>
                                    </ul>
                                </div>                        
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h6 class="panel-title">
                                Fechas
                            </h6>                                       
                        </div>  
     
                        <div class="panel-body">      
                            <div class="row">
                                <div class="col-sm-3">
                                    <select name="selectMedioCajaFiltro" id="selectMedioCajaFiltro" onchange="filtroMovimientosCaja();" class="select-full" required>
                                        <option value="0">Seleccionar medio de pago</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                if($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29):                                                
                                                    echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                else:
                                                    if ( $tesoreriaCuenta[$i]['idCuenta'] == 1 ):                                                        
                                                        echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endif;                                                
                                            endfor;
                                        endif;
                                        ?>                                         
                                    </select>    
                                    <div id="errorselectMedioCajaFiltro" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una caja
                                    </div>                                     
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="fechaDesdeMovCaja" name="fechaDesdeMovCaja"class="form-control" placeholder="Fecha Desde" onchange="filtroMovimientosCaja();" readonly>
                                    <div id="errorfechaDesdeMovCaja" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una fecha
                                    </div> 
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" id="fechaHastaMovCaja" name="fechaHastaMovCaja"class="form-control" placeholder="Fecha Hasta" onchange="filtroMovimientosCaja();" readonly>
                                    <div id="errorfechaHastaMovCaja" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una fecha
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>                    
                    <ul class="page-stats list-justified">
                        <li class="bg-info text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Desde
                                </span>
                                <h2>
                                    <div id="boxFechaDesde">
                                    </div>                                
                                </h2>
                            </div>
                        </li>
                        <li class="bg-info text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Hasta   
                                </span>
                                <h2>
                                    <div id="boxFechaHasta">
                                    </div>
                                </h2>
                            </div>
                        </li>
                        <li class="bg-primary text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Saldo
                                </span>
                                <h2>
                                    <div id="boxSaldo">
                                    </div>                                
                                </h2>
                            </div>
                        </li>
                        <li class="bg-warning text-center">
                            <div class="page-stats-showcase" style="float:none;">
                                <span>
                                    Resultados
                                </span>
                                <h2>
                                    <div id="boxResultados">
                                    </div>                                
                                </h2>
                            </div>
                        </li>
                    </ul>   
                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable table-responsive">
                            <table class="table table-striped table-bordered" id="listadoMovimientosCaja">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ingreso</th>
                                        <th class="text-center">Egreso</th>
                                        <th class="text-center">Fehcha Alta</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
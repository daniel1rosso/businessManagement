<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Nota Débito / Nota Crédito<small>Listar</small></h3>
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
        
        <div class="breadcrumb-line" style="margin-bottom: 10px;">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li ><a href="<?=$url?>ventas/listar_ventas">Ingresos</a></li>
                <li class="active">Nota Débito / Nota Crédito</li>
            </ul>
        </div>
        
        <!---->
        
        <div class="form-actions text-right">
            <a href="<?= base_url() ?>remitos/agregar_remito/<?= $idGenIngreso ?>" class="btn btn-primary">
                <i class="icon-plus"></i>
                Crear Remito
            </a>
        </div>
        
        <!---->
        
        <?php if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29): ?>         
                <ul class="page-stats list-justified">
                    <li class="bg-primary text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                Total venta
                            </span>
                            <h2><div id="totalVenta">$<?= (($total) ? number_format($total, 2, ',', '.') : number_format(0, 2, ',', '.')) ?></div></h2>
                        </div>
                    </li>
                    <li class="bg-info text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                NC
                            </span>
                            <h2><div id="totalCobrado">$<?= (($nc) ? number_format($nc, 2, ',', '.'): number_format(0, 2, ',', '.')) ?></div></h2>
                        </div>
                    </li>
                    <li class="bg-warning text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                ND 
                            </span>
                            <h2><div id="totalCobrado">$<?= (($nd) ? number_format($nd, 2, ',', '.'): number_format(0, 2, ',', '.')) ?></div></h2>
                        </div>
                    </li>
                    <li class="bg-success text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                Cobrado   
                            </span>
                            <h2><div id="totalCobrado">$<?= (($cobrado) ? number_format($cobrado, 2, ',', '.'): number_format(0, 2, ',', '.')) ?></div></h2>
                        </div>
                    </li>
                    <li class="bg-danger text-center">
                        <div class="page-stats-showcase" style="float:none;">
                            <span>
                                A cobrar
                            </span>
                            <h2><div id="totalAdeudado">$<?= (($aCobrar) ? number_format($aCobrar, 2, ',', '.') : number_format(0, 2, ',', '.')) ?></div></h2>
                        </div>
                    </li>
                </ul>        
            <?php endif;?>   
            
        <!---->

        <div class="tabbable page-tabs" style="margin-bottom: 10px;">
            <ul class="nav nav-tabs" style="margin-bottom: 5px;">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-wallet" style="font-size:1.4em;"></i>
                        Cobranzas
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="cobranzas">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default" style="margin-bottom: 10px;">
                        <div class="form-actions text-right" style="margin-top: 8px; margin-right: 10px;">
                            <a class="btn btn-primary" onclick="llenado_apertura_agregarCobro('<?= $idGenIngreso ?>', 2)">
                                <i class="icon-plus"></i>
                                Agregar cobranza
                            </a>
                            <!-- <a href="#" class="btn btn-primary">
                                <i class="fas fa-file-download"></i>
                                Comprobante general
                            </a> -->
                        </div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoCobranzas">
                                <thead>
                                    <tr>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Medio de cobro</th>
                                        <th class="text-center">Nota</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Comprobante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     if (!empty($estadoCuenta)):
                                        foreach ($estadoCuenta as $key => $value) :
                                            $valor = ((floatval($value['credito']) != 0) ? floatval($value['credito']) : floatval($value['debito']));
                                            if ($key != 0) : ?>
                                                <tr id="<?= $value['idCuentaCorriente'] ?>">
                                                    <td class="text-center"><?= $value['fechaCobro'] ?></td>
                                                    <td class="text-center"><?= $value['cuenta'] ?></td>
                                                    <td class="text-center"><?= $value['nota'] ?></td>
                                                    <td class="text-right"><?= '$'. number_format($valor, 2, ",", ".") ?></td>
                                                    <td class="text-center"><?php
                                                    if ($value['idMedioCobro'] > 0) {
                                                        $caja = $this->app_model->get_caja_by_idCuenta($value['idMedioCobro']);
                                                        $cuenta = $caja[0]['descripcion'];
                                    
                                                        $puntoVenta = $this->app_model->get_punto_by_idPtoVenta($caja[0]['idPtoVenta']);
                                                        $numeroPtoVta = $puntoVenta[0]['numeroPtoVta'];
                                    
                                                        $idCuentaCorriente = $value['idCuentaCorriente'];
                                                        $idGenComprobante = $value['idGenComprobante'];
                                                    } else {
                                                        $numeroPtoVta = "- |";
                                                        $idCuentaCorriente = '-';
                                                        $cuenta = "-";
                                                    }
                                    
                                                    if (!empty($value['idGenComprobante'])):
                                                        $opcionComprobante = '<a target="_blank" href="' . base_url() . '/uploads/comprobantes/cobro/' . $value['idGenIngreso'] . '/' . $idGenComprobante . '.pdf">' .
                                                                $numeroPtoVta . '-' . $idCuentaCorriente .
                                                                '</a>';
                                                    else:
                                                        $opcionComprobante = "-";
                                                    endif;
                                                    echo $opcionComprobante;
                                                    ?></td>
                                                </tr>
                                            <?php
                                            endif;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>

        <!-- <iframe width="100%" height="450px" style="border: 1px solid #DCDCDC;border-radius: 3px;" src="' #zoom=100&view=fitH"></iframe> -->

        <div class="form-actions text-right">
            <a onclick="enviarDetalleVenta(<?= $idGenIngresoComillas ?>)" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
                Enviar Detalle
            </a>
            <a onclick="generarPdfDetalleVenta(<?= $idGenIngresoComillas ?>)" class="btn btn-primary">
                <i class="icon-binoculars"></i>
                Ver Detalle
            </a>

            <a href="<?= base_url() ?>ventas/editar_venta/<?= $idIngreso ?>" class="btn btn-primary">
                <i class="fas fa-edit"></i>
                Editar Venta
            </a>
        </div>

        <?php if ($remitos || $remitos_sin_transportistas): ?>       
        <?php $idGenIngresoText = "'" . $idGenIngreso . "'" ?>      
        <div class="tabbable page-tabs" style="margin-bottom: 10px;">
            <ul class="nav nav-tabs" style="margin-bottom: 5px;">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-file-invoice" style="font-size:1.4em;"></i>
                        Remitos
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="notadebitocredito">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default" style="margin-bottom: 10px;">
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoRemitos">
                                <thead>
                                    <tr>
                                        <th class="text-center">id</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Transportista</th>
                                        <th class="text-center">Nota</th>
                                        <th class="text-center">Total Bultos</th>
                                        <th class="text-center">Comprobante</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if ($remitos) :
                                        foreach ($remitos as $key => $value) : ?>
                                        <?php $idGenRemito = "'" . $value['idGenRemito'] . "'" ?>
                                            <tr id="<?= $value['idRemito'] ?>">
                                                <td class="text-center"><?= $value['idRemito'] ?></td>
                                                <td class="text-center"><?= $value['fechaAlta'] ?></td>
                                                <td class="text-center"><?= $value['transportista'] ?></td>
                                                <td class="text-center"><?= $value['notaCliente'] ?></td>
                                                <td class="text-center"><?= $value['cantidadBultos'] ?></td>
                                                <td class="text-center"><a onclick="ver_remito(<?= $idGenIngresoText ?>, <?= $idGenRemito ?>)"><i style="font-size: 1.5em;" class="fas fa-eye"></i></a></td>
                                                <td class="text-center"><a href="<?= base_url() ?>remitos/modificar_remito/<?= $value['idGenRemito'] ?>"  class="tip modificarRemito" data-idGen="<?= $value['idGenRemito'] ?>" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                <?php
                                    if ($remitos_sin_transportistas) :
                                        foreach ($remitos_sin_transportistas as $key => $value) : ?>
                                            <?php $idGenRemito = "'" . $value['idGenRemito'] . "'" ?>
                                            <tr id="<?= $value['idRemito'] ?>">
                                                <td class="text-center"><?= $value['idRemito'] ?></td>
                                                <td class="text-center"><?= $value['fechaAlta'] ?></td>
                                                <td class="text-center">-</td>
                                                <td class="text-center"><?= $value['notaCliente'] ?></td>
                                                <td class="text-center"><?= $value['cantidadBultos'] ?></td>
                                                <td class="text-center"><a onclick="ver_remito(<?= $idGenIngresoText ?>, <?= $idGenRemito ?> )"><i style="font-size: 1.5em;" class="fas fa-eye"></i></a></td>
                                                <td class="text-center"><a href="<?= base_url() ?>remitos/modificar_remito/<?= $value['idGenRemito'] ?>" class="tip modificarRemito" data-idGen="<?= $value['idGenRemito'] ?>" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a></td>
                                            </tr>
                                        <?php
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
        <?php endif; ?>

        <div class="tabbable page-tabs" style="margin-bottom: 10px;">
            <ul class="nav nav-tabs" style="margin-bottom: 5px;">
                <li class="active">
                    <a href="#proveedores" data-toggle="tab">
                        <i class="fas fa-wallet" style="font-size:1.4em;"></i>
                        Notas de Créditos y Débitos
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="notadebitocredito">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default" style="margin-bottom: 10px;">
                        <div class="form-actions text-right" style=" margin-top: 8px; margin-right: 10px;">
                            <a onclick="abrir_nc('<?= $idGenIngreso ?>')" class="btn btn-primary">
                                <i class="icon-plus"></i>
                                Agregar NC
                            </a>
                            <a onclick="abrir_nd('<?= $idGenIngreso ?>')" class="btn btn-primary">
                                <i class="icon-plus"></i>
                                Agregar ND
                            </a>
                        </div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoNotaDebitoDebito">
                                <thead>
                                    <tr>
                                        <th class="text-center">NC/ND</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Comprobante</th>
                                        <th class="text-center">Numero</th>
                                        <th class="text-center">Descripcion</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (!empty($notas_debito)):
                                        foreach ($notas_debito as $key => $value) : ?>
                                            <tr id="<?= $value['idNotaDebito'] ?>">
                                                <td class="text-center">ND</td>
                                                <td class="text-center"><?= $value['fechaEmision'] ?></td>
                                                <td class="text-center"><?php
                                                $opcionComprobante = '<a onclick="ver_nota_debito(' . $value['idNotaDebito'] . ')"' .
                                                                        '<i style="font-size: 1.5em;" class="fas fa-eye"></i>' .
                                                                     '</a>';
                                                echo $opcionComprobante;
                                                ?></td>
                                                <td class="text-center"><?= $value['idNotaDebito'] ?></td>
                                                <td class="text-center"><?php
                                                    $nota = $value['notaCliente'];
                                                    if (!$nota) {
                                                        $nota = "-";
                                                    }
                                                    echo $nota;
                                                    ?></td>
                                                <td class="text-right"><?= '$'. number_format(floatval($value['total']), 2, ",", ".") ?></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                    if (!empty($notas_credito)):
                                            foreach ($notas_credito as $key => $value) : ?>
                                                <tr id="<?= $value['idNotaCredito'] ?>">
                                                    <td class="text-center">NC</td>
                                                    <td class="text-center"><?= $value['fechaEmision'] ?></td>
                                                    <td class="text-center"><?php
                                                    $opcionComprobante = '<a onclick="ver_nota_credito(' . $value['idNotaCredito'] . ')"' .
                                                                            '<i style="font-size: 1.5em;" class="fas fa-eye"></i>' .
                                                                         '</a>';
                                                    echo $opcionComprobante;
                                                    ?></td>
                                                    <td class="text-center"><?= $value['idNotaCredito'] ?></td>
                                                    <td class="text-center"><?php
                                                    $nota = $value['notaCliente'];
                                                    if (!$nota) {
                                                        $nota = "-";
                                                    }
                                                    echo $nota;
                                                    ?></td>
                                                    <td class="text-right"><?= '$'. number_format(floatval($value['total']), 2, ",", ".") ?></td>
                                                </tr>
                                            <?php
                                            endforeach;
                                        endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>
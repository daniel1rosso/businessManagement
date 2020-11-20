<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Nota Débito <small>Modificar</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>notas_credito_debito/listar_nota_debito">Notas Débito</a></li>
            <li class="active">Moficar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Modificar Nota Débito</h6></div>
        <div class="panel-body">        
            <form id="formModificarNotaDebito" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS CLIENTE.
                            </small>
                        </h3>
                    </div>
                    
                    <input type="hidden" id="idNotaDebito_formModificarNotaDebito" value="<?= $nota_debito[0]['idNotaDebito'] ?>" class="form-control">

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCliente_formModificarNotaDebito"><span style="color: red;"> * </span>Cliente</label>
                                    <select name="selectCliente_formModificarNotaDebito" id="selectCliente_formModificarNotaDebito" class="select-full" required>
                                        <option value="0">Seleccionar Cliente</option>
                                        <?php
                                        if (isset($clientes)) :
                                            for ($i = 0; $i < count($clientes); $i++) :
                                                if ($nota_debito[0]['idCliente'] == $clientes[$i]['idCliente']) :
                                                    echo '<option selected="selected" value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                else:
                                                    echo '<option value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCliente_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductos_formModificarNotaDebito">Productos</label>
                                        <select name="selectProductos_formModificarNotaDebito" id="selectProductos_formModificarNotaDebito" class="select-full" required>
                                            <option value="0">Seleccionar producto</option>
                                            <?php
                                            if (isset($productos)) :
                                                for ($i = 0; $i < count($productos); $i++) :
                                                    echo '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorStockProducto_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                            * Sin Stock
                                        </div>   
                                    </div>                                            
                                </div>   
                            </div>    
                        </div>                            

                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaEmision_formModificarNotaDebito">Emision</label>
                                        <input type="text" id="inputFechaEmision_formModificarNotaDebito" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $nota_debito[0]['fechaEmision'] ?>">

                                        <div id="errorinputFechaEmision_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaVencimiento_formModificarNotaDebito">Fecha Vto</label>
                                        <input type="text" id="inputFechaVencimiento_formModificarNotaDebito" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $nota_debito[0]['fechaVencimiento'] ?>">

                                        <div id="errorinputFechaVencimiento_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoNota_formModificarNotaDebito">Tipo</label>
                                        <select name="selectTipoNota_formModificarNotaDebito" id="selectTipoNota_formModificarNotaDebito" class="select-full" required>
                                            <option value="0">Seleccionar tipo</option>
                                            <?php
                                            if (isset($notas_tipos)) :
                                                for ($i = 0; $i < count($notas_tipos); $i++) :
                                                    if ($nota_debito[0]['idTipoNota'] == $notas_tipos[$i]['idTipoNota']) :
                                                        echo '<option selected="selected" value="' . $notas_tipos[$i]['idTipoNota'] . '">' . $notas_tipos[$i]['descripcion'] . '</option>';
                                                    else:
                                                        echo '<option value="' . $notas_tipos[$i]['idTipoNota'] . '">' . $notas_tipos[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoNota_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                       
                                </div>
                            </div>
                        </div>  

                        <div class="col-md-6">

                            <div class="form-group label-floating has-feedback"> 
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectVentas_formModificarNotaDebito"><span style="color: red;"> * </span>Ventas</label>
                                    <select name="selectVentas_formModificarNotaDebito" id="selectVentas_formModificarNotaDebito" class="select-full" required>
                                        <option value="0">Seleccionar una venta</option>
                                        <?php
                                        if (isset($ingresos)) :
                                            for ($i = 0; $i < count($ingresos); $i++) :
                                                if ($nota_debito[0]['idGenIngreso'] == $ingresos[$i]['idGenIngreso']) :
                                                    echo '<option selected="selected" value="' . $ingresos[$i]['idGenIngreso'] . '">' . $ingresos[$i]['idIngreso'] . " - " . $ingresos[$i]['nombEmpresa'] . " - $" . number_format($ingresos[$i]['total'], 2, ",", ".") . '</option>';
                                                else:
                                                    echo '<option value="' . $ingresos[$i]['idGenIngreso'] . '">' . $ingresos[$i]['idIngreso'] . " - " . $ingresos[$i]['nombEmpresa'] . " - $" . number_format($ingresos[$i]['total'], 2, ",", ".") . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select> 

                                    <div id="errorSelectVentas_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div> 
                            </div>                                     

                        </div>
                    </div>
                </div>                                 

                <div id="paso-2">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-shopping-cart" aria-hidden="true"></i>
                                DETALLE Nota Débito.
                            </small>
                        </h3>
                    </div> 
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#notadebito" data-toggle="tab">
                                    <i class="fas fa-shopping-bag" style="font-size:1.4em;"></i> 
                                    Nota Débito
                                </a>
                            </li>	  
                        </ul>

                        <script>
                            $idNotaDebito = "<?= $nota_debito[0]['idNotaDebito'] ?>";
                            llenado_tabla_nota_debito_editar($idNotaDebito);
                        </script>

                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="detalleNotaDebito">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoDetalleNotaDebitoModificar">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-lg-1">idGenProducto</th>
                                                    <th class="text-center col-lg-1">Codigo</th>
                                                    <th class="text-center col-lg-2">Producto</th>
                                                    <th class="text-center col-lg-1">Cantidad</th>                                     
                                                    <th class="text-center col-lg-2">Precio</th>
                                                    <th class="text-center col-lg-2">Descuento</th>
                                                    <th class="text-center col-lg-2">Subtotal</th>
                                                    <th class="text-center col-lg-1">IVA</th>                                        
                                                    <th class="text-center col-lg-1">Acciones</th>
                                                    <th class="text-center col-lg-1">idProducto</th>                                        
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
                </div>
                &nbsp;
                &nbsp;
                &nbsp;

                <div class="row">
                    <div class="col-md-12" style="padding:0px;">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Notas</h6></div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaCliente_formModificarNotaDebito" class="form-control" placeholder="Nota para el cliente" value="<?= $nota_debito[0]['notaCliente'] ?>"></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna_formModificarNotaDebito" class="form-control" placeholder="Nota interna" value="<?= $nota_debito[0]['notaInterna'] ?>"></textarea>
                                            </div>
                                        </div>                                            
                                    </div>                                            
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cogs"></i> Opciones y c&aacute;lculos</h6></div>
                                <div class="panel-body">
                                    <div class="row">              
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" disabled for="importeNoGravado">Importe neto no Gravado</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="importeNoGravado_formModificarNotaDebito" disabled class="form-control" >
                                            </div>

                                            <div id="errorimporteNoGravado_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                        <div class="boxIVA">

                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descEfectuado">Descuento efectuado</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="descEfectuado_formModificarNotaDebito" disabled class="form-control" >
                                            </div>

                                            <div id="errordescEfectuado_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                        <div class="boxIVA">

                                        </div>    
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="totalVenta">Total venta</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="totalVenta_formModificarNotaDebito" disabled class="form-control" >
                                            </div>
                                            <div id="errortotalVenta_formModificarNotaDebito" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 
                                    </div>   
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>

                <div style="margin-top:15px;">
                    <span id="btnModificarNotaDebito" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>          
            </form>
        </div>
    </div>
<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Nota Crédito <small>Modificar</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>notas_credito_debito_proveedor/listar_nota_credito_proveedor">Notas Crédito</a></li>
            <li class="active">Moficar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Modificar Nota Crédito</h6></div>
        <div class="panel-body">        
            <form id="formModificarNotaCreditoProveedor" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS CLIENTE.
                            </small>
                        </h3>
                    </div>
                    
                    <input type="hidden" id="idNotaCredito_formModificarNotaCreditoProveedor" value="<?= $nota_credito[0]['idNotaCredito'] ?>" class="form-control">

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCliente_formModificarNotaCreditoProveedor"><span style="color: red;"> * </span>Proveedores</label>
                                    <select name="selectProveedor_formModificarNotaCreditoProveedor" id="selectProveedor_formModificarNotaCreditoProveedor" class="select-full" required>
                                        <option value="0">Seleccionar Proveedor</option>
                                        <?php
                                        if (isset($proveedores)) :
                                            for ($i = 0; $i < count($proveedores); $i++) :
                                                if ($nota_credito[0]['idProveedor'] == $proveedores[$i]['idProveedor']) :
                                                    echo '<option selected="selected" value="' . $proveedores[$i]['idProveedor'] . '">' . $proveedores[$i]['nombEmpresa'] . '</option>';
                                                else:
                                                    echo '<option value="' . $proveedores[$i]['idProveedor'] . '">' . $proveedores[$i]['nombEmpresa'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectProveedor_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductos_formModificarNotaCredito">Productos</label>
                                        <select name="selectProductos_formModificarNotaCreditoProveedor" id="selectProductos_formModificarNotaCreditoProveedor" class="select-full" required>
                                            <option value="0">Seleccionar producto</option>
                                            <?php
                                            if (isset($productos)) :
                                                for ($i = 0; $i < count($productos); $i++) :
                                                    echo '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorStockProducto_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
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
                                        <label class="control-label" for="inputFechaEmision_formModificarNotaCreditoProveedor">Emision</label>
                                        <input type="text" id="inputFechaEmision_formModificarNotaCreditoProveedor" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $nota_credito[0]['fechaEmision'] ?>">

                                        <div id="errorinputFechaEmision_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaVencimiento_formModificarNotaCreditoProveedor">Fecha Vto</label>
                                        <input type="text" id="inputFechaVencimiento_formModificarNotaCreditoProveedor" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $nota_credito[0]['fechaVencimiento'] ?>">

                                        <div id="errorinputFechaVencimiento_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoNota_formModificarNotaCreditoProveedor">Tipo</label>
                                        <select name="selectTipoNota_formModificarNotaCreditoProveedor" id="selectTipoNota_formModificarNotaCreditoProveedor" class="select-full" required>
                                            <option value="0">Seleccionar tipo</option>
                                            <?php
                                            if (isset($notas_tipos)) :
                                                for ($i = 0; $i < count($notas_tipos); $i++) :
                                                    if ($nota_credito[0]['idTipoNota'] == $notas_tipos[$i]['idTipoNota']) :
                                                        echo '<option selected="selected" value="' . $notas_tipos[$i]['idTipoNota'] . '">' . $notas_tipos[$i]['descripcion'] . '</option>';
                                                    else:
                                                        echo '<option value="' . $notas_tipos[$i]['idTipoNota'] . '">' . $notas_tipos[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoNota_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                       
                                </div>
                            </div>
                        </div>  

                        <div class="col-md-6">

                            <div class="form-group label-floating has-feedback"> 
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectCompras_formModificarNotaCreditoProveedor"><span style="color: red;"> * </span>Egresos</label>
                                    <select name="selectCompras_formModificarNotaCreditoProveedor" id="selectCompras_formModificarNotaCreditoProveedor" class="select-full" required>
                                        <option value="0">Seleccionar una compra</option>
                                        <?php
                                        if (isset($egresos)) :
                                            for ($i = 0; $i < count($egresos); $i++) :
                                                if ($nota_credito[0]['idGenEgreso'] == $egresos[$i]['idGenEgreso']) :
                                                    echo '<option selected="selected" value="' . $egresos[$i]['idGenEgreso'] . '">' . $egresos[$i]['idEgreso'] . " - " . $egresos[$i]['nombEmpresa'] . " - $" . number_format($egresos[$i]['total'], 2, ",", ".") . '</option>';
                                                else:
                                                    echo '<option value="' . $egresos[$i]['idGenEgreso'] . '">' . $egresos[$i]['idEgreso'] . " - " . $egresos[$i]['nombEmpresa'] . " - $" . number_format($egresos[$i]['total'], 2, ",", ".") . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select> 

                                    <div id="errorSelectCompras_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
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
                                DETALLE Nota Crédito.
                            </small>
                        </h3>
                    </div> 
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#notacredito" data-toggle="tab">
                                    <i class="fas fa-shopping-bag" style="font-size:1.4em;"></i> 
                                    Nota Crédito
                                </a>
                            </li>	  
                        </ul>

                        <script>
                            $idNotaCredito = "<?= $nota_credito[0]['idNotaCredito'] ?>";
                            llenado_tabla_nota_credito_proveedor_editar($idNotaCredito);
                        </script>

                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="detalleNotaCredito">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoDetalleNotaCreditoModificarProveedor">
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
                                                <textarea rows="5" cols="5" id="notaCliente_formModificarNotaCreditoProveedor" class="form-control" placeholder="Nota para el cliente" value="<?= $nota_credito[0]['notaCliente'] ?>"></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna_formModificarNotaCreditoProveedor" class="form-control" placeholder="Nota interna" value="<?= $nota_credito[0]['notaInterna'] ?>"></textarea>
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
                                                <input type="text" id="importeNoGravado_formModificarNotaCreditoProveedor" disabled class="form-control" >
                                            </div>

                                            <div id="errorimporteNoGravado_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
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
                                                <input type="text" id="descEfectuado_formModificarNotaCreditoProveedor" disabled class="form-control" >
                                            </div>

                                            <div id="errordescEfectuado_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
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
                                                <input type="text" id="totalVenta_formModificarNotaCreditoProveedor" disabled class="form-control" >
                                            </div>
                                            <div id="errortotalVenta_formModificarNotaCreditoProveedor" class="btn-danger erroBoxs" style="display: none">
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
                    <span id="btnModificarNotaCreditoProveedor" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>          
            </form>
        </div>
    </div>
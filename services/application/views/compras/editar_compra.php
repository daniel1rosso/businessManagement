<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Compras <small>Modificar</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>compras/listar_compras">Compras</a></li>
            <li class="active">Modificar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->
    
    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Modificar compra</h6></div>
        <div class="panel-body">        
            <form id="formModificarCompra" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS PROVEEDOR.
                            </small>
                        </h3>
                    </div>           
                    
                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectProveedor_formModificarCompra"><span style="color: red;"> * </span>Proveedor</label>
                                    <select name="selectProveedor_formModificarCompra" id="selectProveedor_formModificarCompra" class="select-full" required>
                                        <option value="0">Seleccionar Proveedor</option>
                                        <?php
                                        if (isset($proveedores)) :
                                            for ($i = 0; $i < count($proveedores); $i++) :
                                                if ($proveedores[$i]['idProveedor'] == $egreso[0]['idProveedor']):
                                                    echo '<option selected value="' . $proveedores[$i]['idProveedor'] . '">' . $proveedores[$i]['nombEmpresa'] . '</option>';
                                                else:
                                                    echo '<option value="' . $proveedores[$i]['idProveedor'] . '">' . $proveedores[$i]['nombEmpresa'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>        
                                    </select>                                               

                                    <div id="errorselectProveedor_formModificarCompra" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <input type="hidden" id="idGenEgreso" value="<?= $idGenEgreso ?>" class="form-control">
                            
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCategoriaCompra_formModificarCompra"><span style="color: red;"> * </span>Categor&iacute;a</label>
                                    <select name="selectCategoriaCompra_formModificarCompra" id="selectCategoriaCompra_formModificarCompra" class="select-full" required>
                                        <option value="0">Seleccionar Categor&iacute;a</option>
                                        <?php
                                        if (isset($categoriasCompras)) :
                                            for ($i = 0; $i < count($categoriasCompras); $i++) :
                                                if ($categoriasCompras[$i]['idCategoriaCompras'] == $egreso[0]['idCategoriaGasto']):
                                                    echo '<option selected value="' . $categoriasCompras[$i]['idCategoriaCompras'] . '">' . $categoriasCompras[$i]['descripcion'] . '</option>';
                                                else:
                                                    echo '<option value="' . $categoriasCompras[$i]['idCategoriaCompras'] . '">' . $categoriasCompras[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCategoriaCompra_formModificarCompra" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>       
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductosCompras_formModificarCompra">Productos</label>
                                        <select name="selectProductosCompras_formModificarCompra" id="selectProductosCompras_formModificarCompra" class="select-full" required>
                                            <option value="0">Seleccionar producto</option>
                                            <option value="addProductoNewCompra_formModificarCompra">Agregar Producto</option>                                            
                                            <?php
                                            if (isset($productos)) :
                                                for ($i = 0; $i < count($productos); $i++) :
                                                    echo '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorSelectProvincia" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                        <div id="errorStockProducto_formModificarCompra" class="btn-danger erroBoxs" style="display: none">
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
                                        <label class="control-label" for="inputFechaEmisionCompra_formModificarCompra">Emision</label>
                                        <input type="text" id="inputFechaEmisionCompra_formModificarCompra" name="inputFechaEmisionCompra_formModificarCompra" value="<?= ($egreso[0]['fechaEmision']) ? $egreso[0]['fechaEmision'] : "0000-00-00" ?> " class="form-control date-range-filter" data-date-format="yyyy-mm-dd">

                                        <div id="errorinputFechaEmisionCompra" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaPagoCompra_formModificarCompra"><span style="color: red;"> * </span>Fecha Vto del cobro</label>
                                        <input type="text" id="inputFechaPagoCompra_formModificarCompra" name="inputFechaPagoCompra_formModificarCompra" value="<?= $egreso[0]['fechaVtoPago'] ?> " class="form-control date-range-filter" data-date-format="yyyy-mm-dd">

                                        <div id="errorinputFechaPagoCompra_formModificarCompra" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoFact_formModificarCompra"><span style="color: red;"> * </span>Tipo</label>
                                        <select name="selectTipoFactCompra_formModificarCompra" id="selectTipoFactCompra_formModificarCompra" class="select-full" required>
                                            <option value="0">Seleccionar tipo</option>
                                            <?php
                                            if (isset($facturaTipos)) :
                                                for ($i = 0; $i < count($facturaTipos); $i++) :
                                                    if ($facturaTipos[$i]['idTipoFactura'] == $egreso[0]['tipoFactura']):
                                                        echo '<option selected value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                                    else:
                                                        echo '<option value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoFactCompra_formModificarCompra" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                       
                                </div>
                            </div>              

                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="selectRazonSocial">Razon Social</label>
                                        <select name="selectRazonSocial" id="selectRazonSocial" class="select-full" required>
                                            <option value="0">Seleccionar Razon Social</option>
                                            <?php
                                            if (isset($razonSocial)) :
                                                for ($i = 0; $i < count($razonSocial); $i++) :
                                                    if ($razonSocial[$i]['idRazonSocial'] == $egreso[0]['idRazonSocial']):
                                                        echo '<option selected value="' . $razonSocial[$i]['idRazonSocial'] . '">' . $razonSocial[$i]['nombre'] . '</option>';
                                                    else:
                                                        echo '<option value="' . $razonSocial[$i]['idRazonSocial'] . '">' . $razonSocial[$i]['nombre'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select> 

                                        <div id="errorinputRazonSocial" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div> 
                                </div>                                            
                            </div>
                        </div>                                                          
                    </div>
                </div>                        
                <script>
                idGenCompra = "<?= $idGenEgreso ?>";
                llenado_tabla_compra_editar(idGenCompra);</script>
                <div id="paso-2">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-shopping-cart" aria-hidden="true"></i>
                                DETALLE COMPRA.
                            </small>
                        </h3>
                    </div> 
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#compra" data-toggle="tab">
                                    <i class="fas fa-shopping-bag" style="font-size:1.4em;"></i> 
                                    Compra
                                </a>
                            </li>	  
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="compra">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoCompra_formModificarCompra">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-lg-1">Id</th>
                                                    <th class="text-center col-lg-1">Codigo</th>
                                                    <th class="text-center col-lg-2">Producto</th>
                                                    <th class="text-center col-lg-1">Cantidad</th>                                        
                                                    <th class="text-center col-lg-1">Stock</th>                                        
                                                    <th class="text-center col-lg-2">Precio</th>
                                                    <th class="text-center col-lg-2">Descuento</th>
                                                    <th class="text-center col-lg-2">Subtotal</th>
                                                    <th class="text-center col-lg-1">IVA</th>                                        
                                                    <th class="text-center col-lg-1">Acciones</th>
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
                                                <textarea rows="5" cols="5" id="notaCliente_formModificarCompra" class="form-control" placeholder="Nota para el proveedor"><?php if (!empty($egreso[0]['notaInterna'])) {
                                    echo $egreso[0]['notaInterna'];
                                } ?></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna_formModificarCompra" class="form-control" placeholder="Nota interna"><?php if (!empty($egreso[0]['notaInterna'])) {
                                    echo $egreso[0]['notaInterna'];
                                } ?></textarea>
                                            </div>
                                        </div>                                            
                                    </div>                                            
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cogs"></i> Descuentos</h6></div>
                                <div class="panel-body">
                                    <div class="row">                            

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descEfectuado">Descuento efectuado</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="descEfectuado_formModificarCompra" disabled class="form-control" >
                                            </div>

                                            <div id="errordescEfectuado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>    

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoProveedor">Descuento Proveedor</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoProveedor_formModificarCompra" class="form-control" onkeyup="totalCompraEditarDescuentoProveedor()" value="<?= $egreso[0]['descuentoProveedor'] ?>">
                                            </div>
                                            <div id="errorDescuentoProveedor" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Total</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoTotal_formModificarCompra" disabled class="form-control" >
                                            </div>
                                            <div id="errorDescuentoTotal" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 
                                    </div>   
                                </div>   
                            </div>
                        </div>
                        &nbsp;
                        &nbsp;
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cogs"></i> Opciones y c&aacute;lculos</h6></div>
                                <div class="panel-body">
                                    <div class="row">                            
                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" disabled for="importeNoGravado">Importe neto no Gravado</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="importeNoGravado_formModificarCompra" disabled class="form-control" >
                                            </div>

                                            <div id="errorimporteNoGravado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                        <div class="boxIVA">

                                        </div>
                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="totalVenta">Total Compra</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="totalCompra_formModificarCompra" disabled class="form-control" >
                                            </div>
                                            <div id="errortotalVenta" class="btn-danger erroBoxs" style="display: none">
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
                    <span id="btnEditarCompra" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>          
            </form>
        </div>
    </div>
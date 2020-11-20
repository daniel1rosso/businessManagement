<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Venta <small>Nuevo</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>ventas/listar_ventas">Ventas</a></li>
            <li class="active">Editar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Editar venta</h6></div>
        <div class="panel-body">        
            <form id="formEditarVenta" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS CLIENTE.
                            </small>
                        </h3>
                    </div>             

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCliente"><span style="color: red;"> * </span>Cliente</label>
                                    <select name="selectCliente" id="selectCliente" class="select-full" required>
                                        <option value="0">Seleccionar Cliente</option>
                                        <?php
                                        if (isset($clientes)) :
                                            for ($i = 0; $i < count($clientes); $i++) :
                                                if ($clientes[$i]['idCliente'] == $ingreso[0]['idCliente']):
                                                    echo '<option selected value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                else:
                                                    echo '<option value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCliente" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCategoriaVenta"><span style="color: red;"> * </span>Categor&iacute;a</label>
                                    <select name="selectCategoriaVenta" id="selectCategoriaVenta" class="select-full" required>
                                        <option value="0">Seleccionar Categor&iacute;a</option>
                                        <?php
                                        if (isset($categoriasVentas)) :
                                            for ($i = 0; $i < count($categoriasVentas); $i++) :
                                                if ($categoriasVentas[$i]['idCategoriaVentas'] == $ingreso[0]['idCategoria']):
                                                    echo '<option selected value="' . $categoriasVentas[$i]['idCategoriaVentas'] . '">' . $categoriasVentas[$i]['descripcion'] . '</option>';
                                                else:
                                                    echo '<option value="' . $categoriasVentas[$i]['idCategoriaVentas'] . '">' . $categoriasVentas[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCategoriaVenta" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                               
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectSubCategoriaVenta"><span style="color: red;"> * </span>Subcategor&iacute;a</label>
                                    <select name="selectSubCategoriaVenta" id="selectSubCategoriaVenta" class="select-full" required>
                                        <option value="0">Seleccionar Subcategor&iacute;a</option>
                                        <?php
                                        if (isset($subcategoriasVentasDetalle)) :
                                            for ($i = 0; $i < count($subcategoriasVentasDetalle); $i++) :
//                                                    echo '<option value="'.$categoriasVentasDetalle[$i]['IdCategoriaVentaDetalle'].'">'.$categoriasVentasDetalle[$i]['descripcion'].'</option>';
                                                if ($subcategoriasVentasDetalle[$i]['idSubcategoriaVenta'] == $ingreso[0]['idSubcategoriaVenta']):
                                                    echo '<option selected value="' . $subcategoriasVentasDetalle[$i]['idSubcategoriaVenta'] . '">' . $subcategoriasVentasDetalle[$i]['descripcion'] . '</option>';
                                                else:
                                                    echo '<option value="' . $subcategoriasVentasDetalle[$i]['idSubcategoriaVenta'] . '">' . $subcategoriasVentasDetalle[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>        
                                    </select>                                               

                                    <div id="errorselectSubCategoriaVenta" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                               

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductos">Productos</label>
                                        <select name="selectProductos_editarVenta" id="selectProductos_editarVenta" class="select-full" required>
                                            <option value="0">Seleccionar producto</option>
                                            <option value="addProdNew_formEditarVenta">Agregar Producto</option>
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
                                        <div id="errorStockProducto" class="btn-danger erroBoxs" style="display: none">
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
                                        <label class="control-label" for="inputFechaEmision">Emision</label>
                                        <input type="text" id="inputFechaEmision" value="<?= $ingreso[0]['fechaEmision'] ?>"class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off">

                                        <div id="errorinputFechaEmision" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaCobro">Fecha Vto del cobro</label>
                                        <input type="text" id="inputFechaCobro" value="<?= $ingreso[0]['fechaVtoCobro'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off">

                                        <div id="errorinputFechaCobro" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoFact"><span style="color: red;"> * </span>Tipo</label>
                                        <select name="selectTipoFact" id="selectTipoFact" class="select-full" required>
                                            <option value="0">Seleccionar tipo</option>
                                            <?php
                                            if (isset($facturaTipos)) :
                                                for ($i = 0; $i < count($facturaTipos); $i++) :
                                                    if ($facturaTipos[$i]['idTipoFactura'] == $ingreso[0]['tipoFactura']):
                                                        echo '<option selected value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                                    else:
                                                        echo '<option value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoFact" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                       
                                </div>
                            </div>              
                            <?php
                            if ($ingreso[0]['idCategoria'] == 1):
                                $css = "display: block";
                            else:
                                $css = "display: none";
                            endif;
                            ?>
                            <input type="hidden" id="idGenIngreso" value="<?= $ingreso[0]['idGenIngreso'] ?>" class="form-control">
<!--                            <div id="boxAbono" style="<?= $css ?>">
                        <div class="col-md-12" style="padding:0px;">
                            <div class="col-md-4">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputFechaInicioAbono">Fecha inicio abono</label>
                                    <input type="text" id="inputFechaInicioAbono" value="<?= $ingreso[0]['fechaInicioAbono'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd">

                                    <div id="errorinputFechaInicioAbono" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                        
                            </div>   
                            <div class="col-md-4">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputDuracion">Duraci&oacute;n</label>
                                    <input type="text" id="inputDuracion" value="<?= $ingreso[0]['duracionAbono'] ?>" class="form-control" placeholder="Cantidad de meses">

                                    <div id="errorinputDuracion" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                        
                            </div>   
                            <div class="col-md-4">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectModalidadAbono">Modalidad</label>
                                    <select name="selectModalidadAbono" id="selectModalidadAbono" class="select-full" required>
                                        <option value="0">Seleccionar modalidad</option>
                            <?php
                            if (isset($modalidadesAbono) && isset($ingreso[0]['idModalidadAbono'])) :
                                for ($i = 0; $i < count($modalidadesAbono); $i++) :
                                    if ($modalidadesAbono[$i]['idAbonoModalidad'] == $ingreso[0]['idModalidadAbono']):
                                        echo '<option selected value="' . $modalidadesAbono[$i]['idAbonoModalidad'] . '">' . $modalidadesAbono[$i]['descripcion'] . '</option>';
                                    else:
                                        echo '<option value="' . $modalidadesAbono[$i]['idAbonoModalidad'] . '">' . $modalidadesAbono[$i]['descripcion'] . '</option>';
                                    endif;
                                endfor;
                            endif;
                            ?>         
                                    </select>   

                                    <div id="errorselectModalidadAbono" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                        
                            </div>   
                        </div>
                    </div>   -->

                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="selectRazonSocial">Razon Social</label>
                                        <select name="selectRazonSocial" id="selectRazonSocial" class="select-full" required>
                                            <option value="0">Seleccionar Razon Social</option>
                                            <?php
                                            if (isset($razonSocial)) :
                                                for ($i = 0; $i < count($razonSocial); $i++) :
                                                    if ($razonSocial[$i]['idRazonSocial'] == $ingreso[0]['idRazonSocial']):
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

                                <?php if ($empresa[0]['idConceptoFactura'] == 2 || $empresa[0]['idConceptoFactura'] == 3): ?>
                                    <input type="hidden" name="idConceptoFactura_update" id="idConceptoFactura_update" value="<?= $empresa[0]['idConceptoFactura'] ?>">
                                    <div class="col-md-6" style="padding: initial; padding-right: 10px;">                                
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="inputFechaInicioServicio_update"><span style="color: red;"> * </span>Fecha Inicio Servicio</label>
                                            <input type="text" id="inputFechaInicioServicio_update" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $ingreso[0]['fechaInicioServicio'] ?>">

                                            <div id="errorinputFechaInicioServicio_update" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6" style="padding: initial; padding-left: 10px;">                                
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="inputFechaFinServicio_update"><span style="color: red;"> * </span>Fecha Fin Servicio</label>
                                            <input type="text" id="inputFechaFinServicio_update" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off"  value="<?= $ingreso[0]['fechaFinServicio'] ?>">

                                            <div id="errorinputFechaFinServicio_update" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>                                                          
                        <div class="col-md-12" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectProductos">Cobrado</label>
                                    <?php
                                    if ($ingreso[0]['saldado'] == 1):
                                        echo '<input checked type="checkbox" id="cobrado"class="styled">';
                                    else:
                                        echo '<input type="checkbox" id="cobrado"class="styled">';
                                    endif;
                                    ?>
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
                                DETALLE VENTA.
                            </small>
                        </h3>
                    </div> 
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#venta" data-toggle="tab">
                                    <i class="fas fa-shopping-bag" style="font-size:1.4em;"></i> 
                                    Venta
                                </a>
                            </li>	  
                        </ul>
                        <script>
                            idGenIngreso = "<?= $idGenIngreso ?>";
                            llenado_tabla_venta_editar(idGenIngreso);</script>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="venta">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoVentaEditar">
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
                                            <tbody></tbody>
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
                                                <textarea rows="5" cols="5" id="notaCliente"class="form-control" placeholder="Nota para el cliente"><?php
                                                    if (!empty($ingreso[0]['notaCliente'])) {
                                                        echo $ingreso[0]['notaCliente'];
                                                    } else {
                                                        echo "Nota para el cliente";
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna" class="form-control" placeholder="Nota interna"><?php
                                                    if (!empty($ingreso[0]['notaInterna'])) {
                                                        echo $ingreso[0]['notaInterna'];
                                                    } else {
                                                        echo "Nota interna";
                                                    }
                                                    ?></textarea>
                                            </div>
                                        </div>                                            
                                    </div>                                            
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="porcentajeDescuento" value="<?= $cliente_detalle_ventas[0]['dtoGeneral'] ?>" class="form-control">
                        
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title"><i class="icon-cogs"></i> Opciones y c&aacute;lculos</h6></div>
                                <div class="panel-body">
                                    <div class="row">                            

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descEfectuado">Descuento Efectuado</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="descEfectuado" disabled class="form-control" >
                                            </div>

                                            <div id="errordescEfectuado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>   

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Cliente</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="descuentoCliente" class="form-control" onkeyup="totalVentaEditarDescuentoCliente()"  value="<?= number_format($ingreso[0]['descuentoCliente'], 2, ",", ".") ?>">
                                            </div>
                                            <div id="errorDescuentoCliente" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoTotal">Descuento Total</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="descuentoTotal" disabled class="form-control" >
                                            </div>
                                            <div id="errorDescuentoCliente" class="btn-danger erroBoxs" style="display: none">
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
                                                <input type="text" id="importeNoGravado" disabled class="form-control" >
                                            </div>

                                            <div id="errorimporteNoGravado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                        <div class="boxIVA">

                                        </div>

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="totalVenta">Total venta</label>
                                            <div class="col-sm-9">
                                                <input type="text" id="totalVenta" disabled class="form-control" >
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
                    <span id="btnEditarVenta" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>          
            </form>
        </div>
    </div>



<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Abono <small>Ver</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>abonos/listar_abonos">Abonos</a></li>
            <li class="active">Ver</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-binoculars"></i> Ver abono</h6></div>
        <div class="panel-body">        
            <form id="formEditarAbono" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS CLIENTE.
                            </small>
                        </h3>
                    </div>

                    <input type="hidden" id="idGenAbono" value="<?= $abono[0]['idGenAbono'] ?>" class="form-control">

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCliente"><span style="color: red;"> * </span>Cliente</label>
                                    <select name="selectCliente_formEditarAbono" id="selectCliente_formEditarAbono" class="select-full" required disabled>
                                        <?php
                                        if (isset($clientes)) :
                                            for ($i = 0; $i < count($clientes); $i++) :
                                                if ($clientes[$i]['idCliente'] == $abono[0]['idCliente']):
                                                    echo '<option selected value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCliente_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCategoriaVenta_formEditarAbono"><span style="color: red;"> * </span>Categor&iacute;a</label>
                                    <select name="selectCategoriaVenta_formEditarAbono" id="selectCategoriaVenta_formEditarAbono" class="select-full" required disabled>
                                        <?php
                                        if (isset($categoriasVentas)) :
                                            for ($i = 0; $i < count($categoriasVentas); $i++) :
                                                if ($categoriasVentas[$i]['idCategoriaVentas'] == $abono[$i]['idCategoria']):
                                                    echo '<option selected value="' . $categoriasVentas[$i]['idCategoriaVentas'] . '">' . $categoriasVentas[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCategoriaVenta_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>
                                </div>
                            </div>                               
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectSubCategoriaVenta"><span style="color: red;"> * </span>Subcategor&iacute;a</label>
                                    <select name="selectSubCategoriaVenta_formEditarAbono" id="selectSubCategoriaVenta_formEditarAbono" class="select-full" required disabled>
                                        <?php
                                        if (isset($subcategoriasVentasDetalle)) :
                                            for ($i = 0; $i < count($subcategoriasVentasDetalle); $i++) :
                                                if ($subcategoriasVentasDetalle[$i]['idSubcategoriaVenta'] == $abono[0]['idSubcategoriaVenta']):
                                                    echo '<option selected value="' . $subcategoriasVentasDetalle[$i]['idSubcategoriaVenta'] . '">' . $subcategoriasVentasDetalle[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>  
                                    </select>                                               

                                    <div id="errorselectSubCategoriaVenta_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                               

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductos">Productos</label>
                                        <select name="selectProductos_formEditarAbono" id="selectProductos_formEditarAbono" class="select-full" required disabled>
                                            <option selected="selected" value="0">Seleccionar producto</option>    
                                        </select>                                               

                                        <div id="errorSelectProvincia_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                        <div id="errorStockProducto_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
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
                                        <input type="text" id="inputFechaEmision_formEditarAbono" value="<?= $abono[0]['fechaEmision'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" disabled>

                                        <div id="errorinputFechaEmision_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaCobro">Fecha Vto del cobro</label>
                                        <input type="text" id="inputFechaCobro_formEditarAbono" value="<?= $abono[0]['fechaVtoCobro'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" disabled>

                                        <div id="errorinputFechaCobro_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoFact"><span style="color: red;"> * </span>Tipo</label>
                                        <select name="selectTipoFact_formEditarAbono" id="selectTipoFact_formEditarAbono" class="select-full" required disabled>
                                            <?php
                                            if (isset($facturaTipos)) :
                                                for ($i = 0; $i < count($facturaTipos); $i++) :
                                                    if ($facturaTipos[$i]['idTipoFactura'] == $abono[0]['tipoFactura']) :
                                                        echo '<option selected value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoFact_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                       
                                </div>
                            </div>

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaInicioAbono">Fecha inicio abono</label>
                                        <input type="text" id="inputFechaInicioAbono_formEditarAbono" value="<?= $abono[0]['fechaInicioAbono'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" disabled>

                                        <div id="errorinputFechaInicioAbono_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>   
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaFinAbono">Fecha finalizacion abono</label>
                                        <input type="text" id="inputFechaFinAbono_formEditarAbono" value="<?= $abono[0]['fechaFinalizacion'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" disabled>

                                        <div id="errorinputFechaFinAbono_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="selectModalidadAbono"><span style="color: red;"> * </span>Modalidad</label>
                                        <select name="selectModalidadAbono_formEditarAbono" id="selectModalidadAbono_formEditarAbono" class="select-full" required disabled>
                                            <?php
                                            if (isset($modalidadesAbono)) :
                                                for ($i = 0; $i < count($modalidadesAbono); $i++) :
                                                    if ($modalidadesAbono[$i]['idAbonoModalidad'] == $abono[0]['idAbonoModalidad']) :
                                                        echo '<option selected value="' . $modalidadesAbono[$i]['idAbonoModalidad'] . '">' . $modalidadesAbono[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>
                                        </select>   

                                        <div id="errorselectModalidadAbono_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaPrimeraVenta"><span style="color: red;"> * </span>Crear la primera venta</label>
                                        <input type="text" id="inputFechaPrimeraVenta_formEditarAbono" value="<?= $abono[0]['fechaPrimerVenta'] ?>" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" disabled>

                                        <div id="errorinputFechaPrimeraVenta_formEditarAbono" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>   

                            </div>
                            <div class="col-md-12" style="padding:0px;">
                                <?php if ($empresa[0]['idConceptoFactura'] == 2 || $empresa[0]['idConceptoFactura'] == 3): ?>
                                    <input type="hidden" name="idConceptoFactura_update" id="idConceptoFactura_update" value="<?= $empresa[0]['idConceptoFactura'] ?>">
                                    <div class="col-md-6">                                
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="inputFechaInicioServicio_abonoupdate"><span style="color: red;"> * </span>Fecha Inicio Servicio</label>
                                            <input type="text" id="inputFechaInicioServicio_abonoupdate" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off" value="<?= $abono[0]['fechaInicioServicio'] ?>" disabled>

                                            <div id="errorinputFechaInicioServicio_abonoupdate" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6">                                
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="inputFechaFinServicio_abonoupdate"><span style="color: red;"> * </span>Fecha Fin Servicio</label>
                                            <input type="text" id="inputFechaFinServicio_abonoupdate" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off"  value="<?= $abono[0]['fechaFinServicio'] ?>" disabled>

                                            <div id="errorinputFechaFinServicio_abonoupdate" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>                                                          
                    </div>
                </div>                        

                <div id="paso-2">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-shopping-cart" aria-hidden="true"></i>
                                DETALLE ABONO.
                            </small>
                        </h3>
                    </div> 
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#venta" data-toggle="tab">
                                    <i class="fas fa-shopping-bag" style="font-size:1.4em;"></i> 
                                    Abono
                                </a>
                            </li>	  
                        </ul>
                        <script>
                            idGenAbono = "<?= $idGenAbono ?>";
                            llenado_tabla_abono_ver(idGenAbono);</script>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="verabono">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoAbonoVer">
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
                                                <textarea rows="5" cols="5" id="notaCliente_formEditarAbono" class="form-control" placeholder="Nota para el cliente" disabled><?php if (!empty($abono[0]['notaCliente'])) {
                                    echo $abono[0]['notaCliente'];
                                } ?></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna_formEditarAbono" class="form-control" placeholder="Nota interna" disabled><?php if (!empty($abono[0]['notaInterna'])) {
                                    echo $abono[0]['notaInterna'];
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
                                                <input type="text" id="descEfectuado_formEditarAbono" disabled class="form-control" disabled >
                                            </div>

                                            <div id="errordescEfectuado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>    

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Cliente</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoCliente_formEditarAbono" class="form-control" value="<?= $abono[0]['descuentoCliente'] ?>" onkeyup="totalAbonoEditarDescuentoCliente()" disabled>
                                            </div>
                                            <div id="errorDescuentoCliente" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 
                                        
                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Total</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoTotal_formEditarAbono" disabled class="form-control" disabled >
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
                                                <input type="text" id="importeNoGravado_formEditarAbono" disabled class="form-control" disabled >
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
                                                <input type="text" id="totalVenta_formEditarAbono" disabled class="form-control" disabled >
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
         
            </form>
        </div>
    </div>
<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Presupuesto <small>Modificar</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>presupuesto/listar_presupuesto">Presupuesto</a></li>
            <li class="active">Modificar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Modificar presupuesto</h6></div>
        <div class="panel-body">        
            <form id="formModificarPresupuesto" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS CLIENTE.
                            </small>
                        </h3>
                    </div>             

                    <input type="hidden" id="idGenPresupuesto" value="<?= $presupuesto[0]['idGenPresupuesto'] ?>" class="form-control">

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectCliente"><span style="color: red;"> * </span>Cliente</label>
                                    <select name="selectCliente_formModificarPresupuesto" id="selectCliente_formModificarPresupuesto" class="select-full" required>
                                        <option value="0">Seleccionar Cliente</option>
                                        <?php
                                        if (isset($clientes)) :
                                            for ($i = 0; $i < count($clientes); $i++) :
                                                if ($clientes[$i]['idCliente'] == $presupuesto[0]['idCliente']):
                                                    echo '<option selected value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                else:
                                                    echo '<option value="' . $clientes[$i]['idCliente'] . '">' . $clientes[$i]['nombEmpresa'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCliente_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCategoriaPresupuesto_formModificarPresupuesto"><span style="color: red;"> * </span>Categor&iacute;a</label>
                                    <select name="selectCategoriaPresupuesto_formModificarPresupuesto" id="selectCategoriaPresupuesto_formModificarPresupuesto" class="select-full" required>
                                        <option value="0">Seleccionar Categor&iacute;a</option>
                                        <?php
                                        if (isset($categoriasPresupuesto)) :
                                            for ($i = 0; $i < count($categoriasPresupuesto); $i++) :
                                                if ($categoriasPresupuesto[$i]['idCategoriaVentas'] == $presupuesto[0]['idCategoria']):
                                                    echo '<option selected value="' . $categoriasPresupuesto[$i]['idCategoriaVentas'] . '">' . $categoriasPresupuesto[$i]['descripcion'] . '</option>';
                                                else:
                                                    echo '<option value="' . $categoriasPresupuesto[$i]['idCategoriaVentas'] . '">' . $categoriasPresupuesto[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCategoriaPresupuesto_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                              
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectSubCategoriaPresupuesto_formModificarPresupuesto"><span style="color: red;"> * </span>Subcategoria Presupuesto</label>
                                    <select name="selectSubCategoriaPresupuesto_formModificarPresupuesto" id="selectSubCategoriaPresupuesto_formModificarPresupuesto" class="select-full" required>
                                        <option value="0">Seleccionar Subcategoria Presupuesto</option>
                                        <?php
                                        if (isset($subCategorias)) :

//                                            for ($i = 0; $i < count($subCategorias); $i++) :
                                            foreach ($subCategorias as $value) {


                                                if ($value['idSubcategoriaPresupuesto'] == $presupuesto[0]['idSubcategoriaPresupuesto']):
                                                    echo '<option selected value="' . $value['idSubcategoriaPresupuesto'] . '">' . $value['descripcion'] . '</option>';
                                                else:
                                                    echo '<option value="' . $value['idSubcategoriaPresupuesto'] . '">' . $value['descripcion'] . '</option>';
                                                endif;
                                            }
//                                            endfor;
                                        endif;
                                        ?>
                                    </select>                                               

                                    <div id="errorselectSubCategoriaPresupuesto_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                               

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductos">Productos</label>
                                        <select name="selectProductos_formModificarPresupuesto" id="selectProductos_formModificarPresupuesto" class="select-full" required>
                                            <option value="0">Seleccionar producto</option>
                                            <option value="addProdNew">Agregar Producto</option>
                                            <?php
                                            if (isset($productos)) :
                                                for ($i = 0; $i < count($productos); $i++) :
                                                    if ($productos[$i]['idProducto'] == $presupuesto[0]['idProducto']):
                                                        echo '<option selected value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                                                    else:
                                                        echo '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorSelectProvincia_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                        <div id="errorStockProducto_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
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
                                        <input type="text" id="inputFechaEmision_formModificarPresupuesto" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" value="<?= $presupuesto[0]['fechaEmision'] ?>" autocomplete="off">

                                        <div id="errorinputFechaEmision_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaCobroPresupuesto_formModificarPresupuesto">Fecha Vto del presupuesto</label>
                                        <input type="text" id="inputFechaCobroPresupuesto_formModificarPresupuesto" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" value="<?= $presupuesto[0]['fechaVtoPresupuesto'] ?>" autocomplete="off">

                                        <div id="errorinputFechaCobroPresupuesto_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>                                
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaVigencia_formModificarPresupuesto"><span style="color: red;"> * </span>Fecha de Vigencia</label>
                                        <input type="text" id="inputFechaVigencia_formModificarPresupuesto" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" value="<?= $presupuesto[0]['fechaVigencia'] ?>" autocomplete="off">

                                        <div id="errorinputFechaVigencia_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <!--                                <div class="col-md-4">                                
                                                                    <div class="form-group label-floating has-feedback"> 
                                                                        <label class="control-label" for="selectTipoFact">Tipo</label>
                                                                        <select name="selectTipoFact_formNuevoPresupuesto" id="selectTipoFact_formModificarPresupuesto" class="select-full" required>
                                                                            <option value="0">Seleccionar tipo</option>
                                <?php
                                if (isset($facturaTipos)) :
                                    for ($i = 0; $i < count($facturaTipos); $i++) :
                                        if ($facturaTipos[$i]['idTipoFactura'] == $presupuesto[0]['tipoFactura']):
                                            echo '<option selected value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                        else:
                                            echo '<option value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                        endif;
                                    endfor;
                                endif;
                                ?>         
                                                                        </select>                                               
                                
                                                                        <div id="errorselectTipoFact_formModificarPresupuesto" class="btn-danger erroBoxs" style="display: none">
                                                                            * Debe seleccionar una opci&oacute;n
                                                                        </div>   
                                                                    </div>                                       
                                                                </div>-->
                            </div>              

                            <!--                            <div id="boxAbono" style="display: none">
                                                            <div class="col-md-12" style="padding:0px;">
                                                                <div class="col-md-4">                                
                                                                    <div class="form-group label-floating has-feedback">     
                                                                        <label class="control-label" for="inputFechaInicioAbono">Fecha inicio abono</label>
                                                                        <input type="text" id="inputFechaInicioAbono" class="form-control date-range-filter" data-date-format="yyyy-mm-dd">
                            
                                                                        <div id="errorinputFechaInicioAbono" class="btn-danger erroBoxs" style="display: none">
                                                                            * Debe completar el campo
                                                                        </div>   
                                                                    </div>                                        
                                                                </div>   
                                                                <div class="col-md-4">                                
                                                                    <div class="form-group label-floating has-feedback">     
                                                                        <label class="control-label" for="inputDuracion">Duraci&oacute;n</label>
                                                                        <input type="text" id="inputDuracion" class="form-control" placeholder="Cantidad de meses">
                            
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
                            if (isset($modalidadesAbono)) :
                                for ($i = 0; $i < count($modalidadesAbono); $i++) :
                                    echo '<option value="' . $modalidadesAbono[$i]['idAbonoModalidad'] . '">' . $modalidadesAbono[$i]['descripcion'] . '</option>';
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

                            <!--                            <div  style="display:none;">
                                                            <div class="col-md-6" style="padding:0px;">
                                                                <div class="col-md-12">                              
                                                                    <div class="form-group label-floating has-feedback"> 
                                                                        <label class="control-label" for="checkCobrado_formModificarPresupuesto">Cobrado</label>
                                                                        <input type="checkbox" id="cobrado"class="styled">
                                                                    </div>                                            
                                                                </div>   
                                                            </div>                              
                                                        </div>                              -->
                        </div>                                                          
                    </div>
                </div>                        

                <div id="paso-2">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-shopping-cart" aria-hidden="true"></i>
                                DETALLE Presupuesto.
                            </small>
                        </h3>
                    </div> 
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#presupuesto" data-toggle="tab">
                                    <i class="fas fa-shopping-bag" style="font-size:1.4em;"></i> 
                                    Presupuesto
                                </a>
                            </li>	  
                        </ul>

                        <script>
                            idGenPresupuesto = "<?= $presupuesto[0]['idGenPresupuesto'] ?>";
                            llenado_tabla_presupuesto_editar(idGenPresupuesto);</script>

                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="presupuesto">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoPresupuesto_formModificarPresupuesto">
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
                                                <textarea rows="5" cols="5" id="notaCliente_formModificarPresupuesto" class="form-control" placeholder="Nota para el cliente"><?= $presupuesto[0]['notaCliente'] ?></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna_formModificarPresupuesto" class="form-control" placeholder="Nota interna"><?= $presupuesto[0]['notaInterna'] ?></textarea>
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
                                                <input type="text" id="descEfectuado_formModificarPresupuesto" disabled class="form-control" >
                                            </div>

                                            <div id="errordescEfectuado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>    

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Cliente</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoCliente_formModificarPresupuesto" class="form-control" onkeyup="totalPresupuestoEditarDescuentoCliente()" value="<?= $presupuesto[0]['descuentoCliente']?>" >
                                            </div>
                                            <div id="errorDescuentoCliente" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Total</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoTotal_formModificarPresupuesto" disabled class="form-control" >
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
                                                <input type="text" id="importeNoGravado_formModificarPresupuesto" disabled class="form-control" >
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
                                                <input type="text" id="totalVenta_formModificarPresupuesto" disabled class="form-control" >
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
        </div>
    </div>

    <div style="margin-top:15px;">
        <span id="btnGuardarPresupuesto_formModificarPresupuesto" onclick="guardar_presupuesto_editar()" class="btn btn-primary btn-raised btn-block">
            <i class="fa fa-floppy-o" aria-hidden="true"></i>
            Guardar
        </span>
    </div>          
</form>
</div>
</div>



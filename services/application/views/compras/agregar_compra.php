<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Compras <small>Nuevo</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>compras/listar_compras">Compras</a></li>
            <li class="active">Agregar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Agregar compra</h6></div>
        <div class="panel-body">        
            <form id="formNuevaCompra" role="form" action="#" method="POST" enctype="multipart/form-data">
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
                                    <label class="control-label" for="selectProveedor"><span style="color: red;"> * </span>Proveedor</label>
                                    <select name="selectProveedor" id="selectProveedor" class="select-full" required>
                                        <option value="0">Seleccionar Proveedor</option>
                                        <?php
                                        if (isset($proveedores)) :
                                            for ($i = 0; $i < count($proveedores); $i++) :
                                                echo '<option value="' . $proveedores[$i]['idProveedor'] . '">' . $proveedores[$i]['nombEmpresa'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectProveedor" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>    
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectCategoriaCompra"><span style="color: red;"> * </span>Categor&iacute;a</label>
                                    <select name="selectCategoriaCompra" id="selectCategoriaCompra" class="select-full" required>
                                        <option value="0">Seleccionar Categor&iacute;a</option>
                                        <?php
                                        if (isset($categoriasCompras)) :
                                            for ($i = 0; $i < count($categoriasCompras); $i++) :
                                                echo '<option value="' . $categoriasCompras[$i]['idCategoriaCompras'] . '">' . $categoriasCompras[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorselectCategoriaCompra" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>   
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProductosCompras">Productos</label>
                                        <div class="input-group">
                                            <select name="selectProductosCompras" id="selectProductosCompras" class="select-full" required>
                                                <option value="0">Seleccionar producto</option>
                                                <!--<option value="addProductoNewCompra">Agregar Producto</option>-->                                            
                                                <?php
                                                if (isset($productos)) :
                                                    for ($i = 0; $i < count($productos); $i++) :
                                                        echo '<option value="' . $productos[$i]['idProducto'] . '">(' . $productos[$i]['codigo'] . ") - " . $productos[$i]['nombre'] . '</option>';
                                                    endfor;
                                                endif;
                                                ?>         
                                            </select>
                                            <span class="input-group-addon btn-primary" onclick="open_new_product()"><i class="fas fa-plus" style="color:white"></i></span>
                                        </div>

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
                                        <label class="control-label" for="inputFechaEmisionCompra">Emision</label>
                                        <input type="text" id="inputFechaEmisionCompra" name="inputFechaEmisionCompra"class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off">

                                        <div id="errorinputFechaEmisionCompra" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaPagoCompra"><span style="color: red;"> * </span>Fecha Vto del cobro</label>
                                        <input type="text" id="inputFechaPagoCompra" name="inputFechaPagoCompra" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off">

                                        <div id="errorinputFechaPagoCompra" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-4">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoFact"><span style="color: red;"> * </span>Tipo</label>
                                        <select name="selectTipoFactCompra" id="selectTipoFactCompra" class="select-full" required>
                                            <option value="0">Seleccionar tipo</option>
                                            <?php
                                            if (isset($facturaTipos)) :
                                                for ($i = 0; $i < count($facturaTipos); $i++) :
                                                    echo '<option value="' . $facturaTipos[$i]['idTipoFactura'] . '">' . $facturaTipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoFactCompra" class="btn-danger erroBoxs" style="display: none">
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
                                                    echo '<option value="' . $razonSocial[$i]['idRazonSocial'] . '">' . $razonSocial[$i]['nombre'] . '</option>';
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
                                        <table class="table table-striped table-bordered" id="listadoCompra">
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
                                                <textarea rows="5" cols="5" id="notaCliente" class="form-control" placeholder="Nota para el proveedor"></textarea>
                                            </div>
                                        </div>
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nota: </label>
                                            <div class="col-sm-10">
                                                <textarea rows="5" cols="5" id="notaInterna" class="form-control" placeholder="Nota interna"></textarea>
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
                                                <input type="text" id="descEfectuado" disabled class="form-control" >
                                            </div>

                                            <div id="errordescEfectuado" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>    

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoProveedor">Descuento Proveedor</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoProveedor" class="form-control" onkeyup="totalCompraDescuentoProveedor()">
                                            </div>
                                            <div id="errorDescuentoProveedor" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 

                                        <div class="col-md-12 form-group label-floating has-feedback">     
                                            <label class="col-sm-3 control-label" for="descuentoCliente">Descuento Total</label>
                                            <div class="col-sm-9">
                                                <input type="number" id="descuentoTotal" disabled class="form-control" >
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
                                                <input type="text" id="importeNoGravado" disabled class="form-control" >
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
                                                <input type="text" id="totalCompra" disabled class="form-control" >
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
                    <span id="btnGuardarCompra" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>          
            </form>
        </div>
    </div>



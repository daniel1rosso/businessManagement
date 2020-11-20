<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Remito <small>Nuevo</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li><a href="<?= $url ?>ventas/listar_ventas">Ingreso</a></li>
            <li class="active">Remito</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Agregar Remito</h6></div>
        <div class="panel-body">        
            <form id="formNuevoRemito" role="form" action="#" method="POST" enctype="multipart/form-data">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                DATOS REMITO.
                            </small>
                        </h3>
                    </div>      
                    <div class="row">
                        <div class="col-md-5" style="padding:0px;">
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="inputCliente_formNuevoRemito"><span style="color: red;"> * </span>Cliente</label>
                                    <input type="text" id="inputCliente_formNuevoRemito" class="form-control" autocomplete="off" placeholder="Nombre del Cliente" value="<?= (($ingreso) ? $ingreso[0]['nombEmpresa'] : "") ?> ">

                                    <div id="errorinputCliente_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>                    

                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="inputDomicilioEntrega_formNuevoRemito"><span style="color: red;"> * </span>Domicilio de entrega</label>
                                        <input type="text" id="inputDomicilioEntrega_formNuevoRemito" class="form-control" autocomplete="off" placeholder="Domicilio de entrega" value="<?= (($direccion) ? $direccion : "") ?>">                                             

                                        <div id="errorinputDomicilioEntrega_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                            * Sin Stock
                                        </div>   
                                    </div>                                            
                                </div>   
                            </div>    
                        </div>                            

                        <div class="col-md-7" style="padding:0px;">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-6">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputFechaEmision_formNuevoRemito">Emision</label>
                                        <input type="text" id="inputFechaEmision_formNuevoRemito" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" autocomplete="off"  placeholder="YYYY-MM-DD" value="<?= (($hoy) ? $hoy : "") ?>">

                                        <div id="errorinputFechaEmision_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                
                                <div class="col-md-6">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectTipoRemito_formNuevoRemito">Tipo</label>
                                        <select name="selectTipoRemito_formNuevoRemito" id="selectTipoRemito_formNuevoRemito" class="select-full" required>
                                            <option value="0">Seleccionar tipo</option>
                                            <?php
                                            if (isset($tipos_remito)) :
                                                for ($i = 0; $i < count($tipos_remito); $i++) :
                                                        echo '<option value="' . $tipos_remito[$i]['idTipoRemito'] . '">' . $tipos_remito[$i]['nombre'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorselectTipoRemito_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                       
                                </div>
                            </div>
                        </div>  

                        <div class="col-md-7">
                            <div class="col-md-4" style="padding: 0px;">
                                <div class="form-group label-floating has-feedback"> 
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="selectTransportista_formNuevoRemito">Transportista</label>
                                        <select name="selectTransportista_formNuevoRemito" id="selectTransportista_formNuevoRemito" class="select-full" required>
                                            <option value="0">Seleccionar un transportista</option>
                                            <option value="add_transportista">Agregar un transportista</option>
                                            <?php
                                            if (isset($transportistas)) :
                                                for ($i = 0; $i < count($transportistas); $i++) :
                                                        echo '<option value="' . $transportistas[$i]['idTransportista'] . '">' . $transportistas[$i]['nombre'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>         
                                        </select> 

                                        <div id="errorSelectTransportista_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div> 
                                </div>                                     

                            </div>
                            <div class="col-md-8">                          
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="inputNotaCliente_formNuevoRemito">Nota para el cliente</label>
                                    <input type="text" id="inputNotaCliente_formNuevoRemito" class="form-control" autocomplete="off" placeholder="Nota para el cliente">

                                    <div id="errorinputNotaCliente_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div> 
                        </div>
                    </div>
                </div>                                 

                <script> idGenIngreso = <?= "'" . $ingreso[0]['idGenIngreso'] . "'"?>; llenado_tabla_remito( idGenIngreso ); </script>

                <div id="paso-2">
                    <div class="tabbable page-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#notadebito" data-toggle="tab">
                                    <i class="fas fa-file-invoice" style="font-size:1.4em;"></i> 
                                    Detalle Remito
                                </a>
                            </li>	  
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="detalleRemito">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                                    <div class="datatable">
                                        <table class="table table-striped table-bordered" id="listadoDetalleRemito">
                                            <thead>
                                                <tr>
                                                    <th class="text-center col-lg-2">idDetalle</th>
                                                    <th class="text-center col-lg-2">Productos</th>
                                                    <th class="text-center col-lg-2">Observaciones</th>
                                                    <th class="text-center col-lg-1">Cantidades</th>
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

                <div class="row">
                    <div class="col-md-12" style="padding:0px;">

                        <div class="col-md-6"></div>

                        <div class="col-md-6" style="margin-top: 15px;">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">      
                                        <div class="form-group label-floating has-feedback">     
                                            <div class="col-sm-1"></div>
                                            <label class="col-sm-3 control-label" for="cantidadBultos">Cantidad de bultos</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="cantidadBultos_formNuevoRemito" class="form-control" value="1" >
                                            </div>

                                            <div id="errorcantidadBultos_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>                                        
                                        <div class="boxIVA">

                                        </div>    
                                        &nbsp;
                                        &nbsp;
                                        <div class="form-group label-floating has-feedback">   
                                            <div class="col-sm-1">
                                                <label><input type="checkbox" id="incluitMontoAsegurado" onclick="checkMontoAsegurado()"></label>  
                                            </div> 
                                            <label class="col-sm-3 control-label" for="montoAsegurado">Monto asegurado</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="montoAsegurado_formNuevoRemito" disabled class="form-control" placeholder="0,00" value="<?= (($ingreso[0]['total']) ? $ingreso[0]['total'] : "") ?>">
                                            </div>
                                            <div id="errormontoAgurado_formNuevoRemito" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div> 
                                    </div>   
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="idGenIngreso_formNuevoRemito" id="idGenIngreso_formNuevoRemito" class="form-control" value="<?= $ingreso[0]['idGenIngreso'] ?>">

                <div style="margin-top:15px;">
                    <span id="btnGuardarRemito" onclick="guardar_remito()" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>          
            </form>
        </div>
    </div>
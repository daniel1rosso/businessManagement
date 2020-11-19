<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Proveedores <small>Modificar</small></h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?=$url?>dashboard">Home</a></li>
            <li><a href="<?=$url?>proveedores/listar_proveedores">Proveedores</a></li>
            <li class="active">Modificar</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Callout -->
    <?php if(isset($success)) : ?>
    <div class="callout callout-success fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <h5>¡Bien!</h5>
        <p>Se modifico el proveedor con éxito.</p>
    </div>
    <?php endif; ?>
    <!-- /callout -->  
    
    <!-- Basic inputs -->
    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title"><i class="icon-pencil3"></i> Modificar Proveedor</h6></div>
        <div class="panel-body">        
            <form id="formDatosProveedor" role="form" action="<?=$url?>proveedores/modificar/<?=$proveedor['id']?>" method="POST" enctype="multipart/form-data">
                
                <div id="paso-2" style="padding-bottom:15px;">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                TARJETA.
                            </small>
                        </h3>
                    </div>             
                    
                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-4">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumTarjeta">Numero Tarjeta</label>
                                    <input value="<?= (isset($proveedor['rfidCode'])) ? $proveedor['rfidCode'] : ''; ?>" name="inputNumTarjeta" id="inputNumTarjeta" data-minlength="2" maxlength="25" type="text" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                        
                            </div>

                            <div class="col-md-4">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputCodigo">Codigo / Numero Proveedor</label>
                                    <input value="<?= (isset($proveedor['codigo'])) ? $proveedor['codigo'] : ''; ?>" name="inputCodigo" id="inputCodigo" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>     
                            
                            <div class="col-md-4">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputPuntos">Puntos Proveedor</label>
                                    <input value="<?= (isset($proveedor['puntosProveedor'])) ? $proveedor['puntosProveedor'] : ''; ?>" name="inputPuntos" id="inputPuntos" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>                              
                        </div>

                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-6">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputDenominacion">Denominacion</label>
                                    <input value="<?= (isset($proveedor['denominacion'])) ? $proveedor['denominacion'] : ''; ?>" name="inputDenominacion" id="inputDenominacion" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>  
                            
                            <div class="col-md-6">      
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectEstado">Estado Tarjeta</label>
                                    <select name="selectEstadoTarjeta" id="selectEstadoTarjeta" class="form-control" style="text-transform:uppercase;"> 
                                        <?php 
                                            if($proveedor['tarjetaHabilitado'] == 0):
                                                echo '<option selected="selected" value="0">Deshabilitada</option>';
                                                echo '<option value="1">Habilitada</option>';
                                            else :
                                                echo '<option selected="selected" value="1">Habilitada</option>';
                                                echo '<option value="0">Deshabilitada</option>';
                                            endif; 
                                          ?>                                                    
                                    </select>

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                  
                            </div>                                
                        </div>                                    
                    </div>    
                    
                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-6">                                
                                <div id="boxFechaNacAdhesion" class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputFechaEmision">Fecha Emision</label>
                                    <div class='input-group date' >
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" value="<?php echo (isset($proveedor['fechaEmision'])) ? $proveedor['fechaEmision'] : ''; ?>" name="inputFechaEmision" id="inputFechaEmision" data-minlength="10" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" readonly>
                                    </div>

                                    <div class="help-block with-errors"></div>
                                    <span id="iconBoxFechaNacAdhesion" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                         
                            </div>
                            
                            <div class="col-md-6">                                
                                <div id="boxFechaNacAdhesion" class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputFechaVencimiento">Fecha Vencimiento</label>
                                    <div class='input-group date' >
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" value="<?php echo (isset($proveedor['fechaVencimiento'])) ? $proveedor['fechaVencimiento'] : ''; ?>" name="inputFechaVencimiento" id="inputFechaVencimiento" data-minlength="10" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" readonly>
                                    </div>

                                    <div class="help-block with-errors"></div>
                                    <span id="iconBoxFechaNacAdhesion" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                         
                            </div>                            
                        </div>
                        
                        <div class="col-md-6" style="padding:0px;">                          
                            <div class="col-md-6">      
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectEstadoCupon">Cupon Rojo</label>
                                    <select name="selectEstadoCupon" id="selectEstadoCupon" class="form-control" style="text-transform:uppercase;"> 
                                        <?php 
                                            if($proveedor['habilitadoCuponRojo'] == 0):
                                                echo '<option selected="selected" value="0">Deshabilitado</option>';
                                                echo '<option value="1">Habilitado</option>';
                                            else :
                                                echo '<option selected="selected" value="1">Habilitado</option>';
                                                echo '<option value="0">Deshabilitado</option>';
                                            endif; 
                                          ?>                                                     
                                    </select>

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                  
                            </div>    
                            
                            <div class="col-md-6">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputMontoMax">Monto Maximo</label>
                                    <input value="<?php echo (isset($proveedor['montoMax'])) ? $proveedor['montoMax'] : ''; ?>" name="inputMontoMax" id="inputMontoMax" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>                              
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            
                        </div>
                        <div class="col-md-6" style="padding:0px;">                          
                            <div class="col-md-6">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputmontoConInteres">Monto con interes</label>
                                    <input value="<?php echo (isset($proveedor['montoConInteres'])) ? $proveedor['montoConInteres'] : ''; ?>" name="inputmontoConInteres" id="inputmontoConInteres" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>                              
                            <div class="col-md-6">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputmontoSinInteres">Monto sin interes</label>
                                    <input value="<?php echo (isset($proveedor['montoSinInteres'])) ? $proveedor['montoSinInteres'] : ''; ?>" name="inputmontoSinInteres" id="inputmontoSinInteres" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>                              
                        </div>
                    </div>
                    
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fa fa-user-circle-o" aria-hidden="true"></i>
                                DATOS PERSONALES.
                            </small>
                        </h3>
                    </div>                            

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-6">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputApellido">Apellido</label>
                                    <input value="<?php echo (isset($proveedor['apellido'])) ? $proveedor['apellido'] : ''; ?>" name="inputApellido" id="inputApellido" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                        
                            </div>

                            <div class="col-md-6">           
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNombre">Nombre</label>
                                    <input value="<?php echo (isset($proveedor['nombre'])) ? $proveedor['nombre'] : ''; ?>" name="inputNombre" id="inputNombre" data-minlength="2" maxlength="25" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>       
                        </div>

                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-6">   
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputDNI">DNI</label>
                                    <input value="<?php echo (isset($proveedor['dni'])) ? $proveedor['dni'] : ''; ?>" name="inputDNI" id="inputDNI" data-minlength="7" maxlength="8" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                      
                            </div>

                            <div class="col-md-6">      
                                <div id="boxFechaNacAdhesion" class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputFechaNac">Fecha de Nacimiento</label>
                                    <div class='input-group date' >
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" value="<?php echo (isset($proveedor['fechaNac'])) ? $proveedor['fechaNac'] : ''; ?>" name="inputFechaNac" id="inputFechaNac" data-minlength="10" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" readonly>
                                    </div>

                                    <div class="help-block with-errors"></div>
                                    <span id="iconBoxFechaNacAdhesion" class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>  
                        </div>                                     
                    </div>

                    <div class="row">
                        <div class="col-md-6">    
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectSexo">Sexo</label>
                                <select name="selectSexo" id="selectSexo" class="form-control" style="text-transform:uppercase;"> 
                                    <?php 
                                    if($proveedor['idSexo'] == 0):
                                        echo '<option>Seleccione</option>';
                                    endif;

                                    foreach ($sexo as $key => $value) :
                                        if($proveedor['idSexo'] == $value['idSexo']):
                                            echo '<option selected="selected" value="'.$value['idSexo'].'">'.$value['tipo'].'</option>';
                                        else :
                                            echo '<option value="'.$value['idSexo'].'">'.$value['tipo'].'</option>';
                                        endif;
                                     endforeach;
                                    ?>            
                                </select>

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>                                    
                        </div>                                     

                        <div class="col-md-6">  
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectEstadoCivil">Estado Civil</label>
                                <select name="selectEstadoCivil" id="selectEstadoCivil" class="form-control" style="text-transform:uppercase;"> 
                                    <?php 
                                    if($proveedor['idEstado'] == 0):
                                        echo '<option>Seleccione</option>';
                                    endif;

                                    foreach ($estado_civil as $key => $value) :
                                        if($proveedor['idEstado'] == $value['idCivil']):
                                            echo '<option selected="selected" value="'.$value['idCivil'].'">'.$value['estado'].'</option>';
                                        else :
                                            echo '<option value="'.$value['idCivil'].'">'.$value['estado'].'</option>';
                                        endif;
                                     endforeach;
                                    ?> 
                                </select>

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>                                      
                        </div>           
                    </div>   

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">                                           
                            <div class="col-md-4">       
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectProvincia">Provincia</label>
                                    <select name="selectProvincia" id="selectProvincia" class="form-control" style="text-transform:uppercase;">
                                        <?php 
                                        if($proveedor['idProvincia'] == 0):
                                            echo '<option>Seleccione</option>';
                                        endif;

                                        foreach ($provincias as $key => $value) :
                                            if($proveedor['idProvincia'] == $value['idProvincia']):
                                                echo '<option selected="selected" value="'.$value['idProvincia'].'">'.$value['provincia'].'</option>';
                                            else :
                                                echo '<option value="'.$value['idProvincia'].'">'.$value['provincia'].'</option>';
                                            endif;
                                        endforeach;
                                        ?>                                                                                
                                    </select>                                            

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                            
                            </div>    

                            <div class="col-md-4"> 
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectLocalidad">Localidad</label>
                                    <select name="selectLocalidad" id="selectLocalidad" class="form-control" style="text-transform:uppercase;"> 
                                        <?php 
                                        if($proveedor['idLocalidad'] == 0):
                                            echo '<option>Seleccione</option>';
                                        endif;

                                        foreach ($localidades as $key => $value) :
                                            if($proveedor['idLocalidad'] == $value['idLocalidad']):
                                                echo '<option selected="selected" value="'.$value['idLocalidad'].'">'.$value['localidad'].'</option>';
                                            else :
                                                echo '<option value="'.$value['idLocalidad'].'">'.$value['localidad'].'</option>';
                                            endif;
                                         endforeach;
                                        ?>                                          
                                    </select>

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>        
                            </div>  

                            <div class="col-md-4">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputCodPostal">C&oacute;digo Postal</label>
                                    <input value="<?php echo (isset($proveedor['codPostal'])) ? $proveedor['codPostal'] : ''; ?>" name="inputCodPostal" id="inputCodPostal" data-minlength="1" maxlength="25" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>  
                        </div>

                        <div class="col-md-6" style="padding:0px;">  
                            <div class="col-md-5">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputDomicilio">Domicilio</label>
                                    <input value="<?php echo (isset($proveedor['domicilio'])) ? $proveedor['domicilio'] : ''; ?>" name="inputDomicilio" id="inputDomicilio" data-minlength="3" maxlength="50" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>    

                            <div class="col-md-3">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumDir">N&uacute;mero</label>
                                    <input value="<?php echo (isset($proveedor['numero'])) ? $proveedor['numero'] : ''; ?>" name="inputNumDir" id="inputNumDir" data-minlength="1" maxlength="10" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>  

                            <div class="col-md-2">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumDir">Piso</label>
                                    <input value="<?php echo (isset($proveedor['piso'])) ? $proveedor['piso'] : ''; ?>" name="inputPiso" id="inputPiso" data-minlength="1" maxlength="5" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>                                          

                            <div class="col-md-2">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputDpto">Dpto</label>
                                    <input value="<?php echo (isset($proveedor['dpto'])) ? $proveedor['dpto'] : ''; ?>" name="inputDpto" id="inputDpto" data-minlength="1" maxlength="5" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>                                          
                        </div>   
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">  
                            <div class="col-md-6">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputCorreo">Correo Electr&oacute;nico</label>
                                    <input value="<?php echo (isset($proveedor['email'])) ? $proveedor['email'] : ''; ?>" name="inputCorreo" id="inputCorreo" maxlength="150" type="email" class="form-control" style="/*text-transform:uppercase;*/">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>    

                            <div class="col-md-6">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumTel">N&uacute;mero de Tel&eacute;fono</label>
                                    <input value="<?php echo (isset($proveedor['numTel'])) ? $proveedor['numTel'] : ''; ?>" name="inputNumTel" id="inputNumTel" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>  
                        </div>     

                        <div class="col-md-6" style="padding:0px;">  
                            <div class="col-md-6">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumTel2">N&uacute;mero de Tel&eacute;fono Alternativo</label>
                                    <input value="<?php echo (isset($proveedor['numTel2'])) ? $proveedor['numTel2'] : ''; ?>" name="inputNumTel2" id="inputNumTel2" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" class="form-control">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                                         
                            </div>         

                            <div class="col-md-6">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputProfesion">Profesi&oacute;n o Actividad</label>
                                    <input value="<?php echo (isset($proveedor['profesion'])) ? $proveedor['profesion'] : ''; ?>" name="inputProfesion" id="inputProfesion" data-minlength="4" maxlength="350" type="text" class="form-control" style="text-transform:uppercase;">

                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>                               
                            </div>
                        </div>                            
                    </div>      
                </div>                        

                <div id="paso-3">
                    <div id="boxCabeceraForm">
                        <h3>
                            <small>
                                <i style="color:#333333;" class="fa fa-file-image-o" aria-hidden="true"></i>
                                DOCUMENTACION PERSONAL.
                            </small>
                        </h3>
                    </div>                             

                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="fotoDni">Foto DNI</label>
                                <input type="file" name="file0" id="file0" class="inputfile inputfile-6 form-control" accept="image/x-png,image/gif,image/jpeg,application/pdf" capture="camera">

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                                <?php 
                                    foreach ($imagenes as $key => $value) :
                                        if($value['tipo'] == 1):
                                            $idProveedorImg = $value['idProveedor'];
                                            $nombreImg = $value['nombre'];

                                            echo '
                                                <a class="btn btn-info btn-block run-first" href="'.$url.'uploads/proveedores/'.$idProveedorImg.'/'.$nombreImg.'" target="_blank">
                                                    <i class="fa fa-paperclip"></i>
                                                    Abrir archivo adjunto
                                                </a> 
                                            ';
                                        endif;
                                     endforeach; 
                                 ?>                                    
                            </div>    
                        </div>    

                        <div class="col-md-6">  
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="fotoProveedor">Foto Proveedor/Carnet</label>
                                <input type="file" name="file1" id="file1" class="inputfile inputfile-6 form-control" accept="image/x-png,image/gif,image/jpeg,application/pdf" capture="camera">

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                                <?php 
                                    foreach ($imagenes as $key => $value) :
                                        if($value['tipo'] == 2):
                                            $idProveedorImg = $value['idProveedor'];
                                            $nombreImg = $value['nombre'];

                                            echo '
                                                <a class="btn btn-info btn-block run-first" href="'.$url.'uploads/proveedores/'.$idProveedorImg.'/'.$nombreImg.'" target="_blank">
                                                    <i class="fa fa-paperclip"></i>
                                                    Abrir archivo adjunto
                                                </a> 
                                            ';
                                        endif;
                                     endforeach; 
                                 ?>                                      
                            </div>                                         
                        </div>              
                    </div>

                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="fotoDomicilio">Foto Constancia de domicilio</label>
                                <input type="file" name="file2" id="file2" class="inputfile inputfile-6 form-control" accept="image/x-png,image/gif,image/jpeg,application/pdf" capture="camera">

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>

                                <?php 
                                    foreach ($imagenes as $key => $value) :
                                        if($value['tipo'] == 6):
                                            $idProveedorImg = $value['idProveedor'];
                                            $nombreImg = $value['nombre'];

                                            echo '
                                                <a class="btn btn-info btn-block run-first" href="'.$url.'uploads/proveedores/'.$idProveedorImg.'/'.$nombreImg.'" target="_blank">
                                                    <i class="fa fa-paperclip"></i>
                                                    Abrir archivo adjunto
                                                </a> 
                                            ';
                                        endif;
                                     endforeach; 
                                 ?>                                       
                            </div>                                         
                        </div>                                           
                    </div>
                </div>

                <div id="paso-4" class="">
                    <div class="row">                      
                        <div class="col-md-6">      
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectHabilitado">Estado Proveedor</label>
                                <select name="selectHabilitado" id="selectHabilitado" class="form-control" style="text-transform:uppercase;"> 
                                <?php 
                                    if($proveedor['habilitado'] == 0):
                                        echo '<option selected="selected" value="0">Deshabilitado</option>';
                                        echo '<option value="1">Habilitado</option>';
                                    else :
                                        echo '<option selected="selected" value="1">Habilitado</option>';
                                        echo '<option value="0">Deshabilitado</option>';
                                    endif; 
                                  ?>                                                     
                                </select>

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>                                  
                        </div>                            
                        <div class="col-md-6">      
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectEstado">Categoria</label>
                                <select name="selectEstadoProveedor" id="selectEstadoProveedor" class="form-control" style="text-transform:uppercase;"> 
                                    <?php foreach ($estado_proveedor as $key => $value) :
                                        if($proveedor['estado_proveedor'] == $value['idEstadoProveedor']):
                                            echo '<option selected="selected" value="'.$value['idEstadoProveedor'].'">'.$value['descripcion'].'</option>';
                                        else :
                                            echo '<option value="'.$value['idEstadoProveedor'].'">'.$value['descripcion'].'</option>';
                                        endif;
                                     endforeach; ?>                                                    
                                </select>

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>                                  
                        </div>  
                        <div class="col-md-6">      
                                                                  
                        </div>                                        
                    </div>
                </div>
                <div id="paso-4" class="">
                    <div class="row">                      
                        <div class="col-md-6">      
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="inputGarante">Garante</label>
                                <input value="<?php echo (isset($proveedor['garante'])) ? $proveedor['garante'] : ''; ?>" name="inputGarante" id="inputGarante" data-minlength="4" maxlength="250" type="text" class="form-control" style="text-transform:uppercase;">

                                <div class="help-block with-errors"></div>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>                                  
                        </div>                            
                        <div class="col-md-6">      
                            <label class="control-label" for="inputCodigoGarante">Codigo garante</label>
                            <input value="<?php echo (isset($proveedor['codigoGarante'])) ? $proveedor['codigoGarante'] : ''; ?>" name="inputCodigoGarante" id="inputCodigoGarante" data-minlength="1" maxlength="50" type="text" class="form-control" style="text-transform:uppercase;">

                            <div class="help-block with-errors"></div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>                                 
                        </div>  
                                       
                    </div>
                </div>

                <div>
                    <span id="btnAdmProveedor" class="btn btn-primary btn-raised btn-block">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>                
                
            </form>
        </div>
    </div>


            
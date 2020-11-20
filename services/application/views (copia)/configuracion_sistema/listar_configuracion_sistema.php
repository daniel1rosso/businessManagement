<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Configuración del Sistema</h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li class="active">Configuración del Sistema</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <form id="formConfiguracionSistema" role="form" action="#" method="POST" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-cog fa-lg fa-spin"></i> Configuración básica</h6></div>
            <div class="panel-body">        
                <div id="paso-1" style="padding-bottom:15px;">

                    <div class="row">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNombre">Nombre</label>
                                    <input name="inputNombre_formConfiguracionSistema" id="inputNombre_formConfiguracionSistema" type="text" class="form-control" value="<?= ($empresa) ? $empresa[0]["nombre"] : "" ?>">

                                    <div id="errorInputNombreEmpesa_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                        
                            </div>  
                            <div class="col-md-12">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputCorreo">Correo Electr&oacute;nico</label>
                                    <input name="inputCorreo_formConfiguracionSistema" id="inputCorreo_formConfiguracionSistema" maxlength="150" type="email" class="form-control" required value="<?=  ($empresa) ? $empresa[0]["email"] : "" ?>">

                                    <div id="errorInputCorreo_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                         
                            </div>
                            <div class="col-md-12">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputDomicilio">Domicilio</label>
                                    <input name="inputDomicilio_formConfiguracionSistema" id="inputDomicilio_formConfiguracionSistema" data-minlength="3" maxlength="50" type="text" class="form-control" required  value="<?=  ($empresa) ? $empresa[0]["direccion"] : "" ?>">

                                    <div id="errorInputDomicilio_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                         
                            </div> 
                            <div class="col-md-12" style="padding-right: 0px;">  
                                <div class="form-group label-floating has-feedback"> 
                                    <div id="boxCabeceraForm">
                                        <h3>
                                            <small>
                                                <i style="color:#333333;" class="fas fa-image" aria-hidden="true"></i>
                                                LOGO EMPRESA PARA DOCUMENTACIÓN.
                                            </small>
                                        </h3>
                                    </div>   
                                    <div class="col-md-12">  
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="imagen">Logo</label>
                                            <input type="file" name="fileImagen_formConfiguracionSistema" id="fileImagen_formConfiguracionSistema" class="styled">								
                                            <div id="errorFile_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                                * Ingrese una imagen.
                                            </div>                                          
                                            <div id="errorFileFormato_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                                * Ingrese una imagen con formato JPG, JPEG, PNG O GIF.
                                            </div>                                 
                                        </div>    
                                    </div> 
                                </div> 
                            </div>
                            <?PHP if ($empresa) : ?>
                                <?PHP if ($empresa[0]["logo"] != "") : ?>
                                    <div class="col-md-12" style="text-align: center;">  
                                        <img src="<?= base_url() ?>uploads/logo/<?=   $empresa[0]["logo"] ?>" style="max-width: 50%;">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>  

                        <div class="col-md-6" style="padding:0px;"> 
                            <div class="col-md-6">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumTel">N&uacute;mero de Tel&eacute;fono</label>
                                    <input name="inputNumTel_formConfiguracionSistema" id="inputNumTel_formConfiguracionSistema" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                event.returnValue = false;" class="form-control" required value="<?=  ($empresa) ? $empresa[0]["tel"] : "" ?>">

                                    <div id="errorInputNumTel_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                         
                            </div>                       

                            <div class="col-md-6">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNumCel">N&uacute;mero de Celular</label>
                                    <input name="inputNumCel_formConfiguracionSistema" id="inputNumCel_formConfiguracionSistema" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                event.returnValue = false;" class="form-control" required value="<?=  ($empresa) ? $empresa[0]["cel"] : "" ?>">

                                    <div id="errorInputNumCel_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>                                         
                            </div>
                            <div class="col-md-12">                              
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectPais">País</label>
                                    <select name="selectPais_formConfiguracionSistema" id="selectPais_formConfiguracionSistema" class="select-full" required>
                                        <option value="0">Seleccione</option>
                                        <?php
                                        if (isset($empresa)) :
                                            if (isset($paises)) :
                                                for ($i = 0; $i < count($paises); $i++) :
                                                    if ($paises[$i]['id'] == $empresa[0]["idPais"]) :
                                                        echo '<option selected="selected" value="' . $paises[$i]['id'] . '">' . $paises[$i]['nombre'] . '</option>';
                                                    else :
                                                        echo '<option value="' . $paises[$i]['id'] . '">' . $paises[$i]['nombre'] . '</option>';
                                                    endif;
                                                endfor;
                                            endif;
                                        endif;
                                        ?>         
                                    </select>                                               

                                    <div id="errorSelectPais_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>                                            
                            </div>    
                            <div id="paisArgentina" style="display: block;"> 
                                <div class="col-md-6">                              
                                    <div class="form-group label-floating has-feedback"> 
                                        <label class="control-label" for="selectProvincia">Provincia</label>
                                        <select name="selectProvincia_formConfiguracionSistema" id="selectProvincia_formConfiguracionSistema" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($empresa)) :
                                                if (isset($provincias)) :
                                                    for ($i = 0; $i < count($provincias); $i++) :
                                                        if ($provincias[$i]['idProvincia'] == $empresa[0]["idProvincia"]) :
                                                            echo '<option selected="selected" value="' . $provincias[$i]['idProvincia'] . '">' . $provincias[$i]['provincia'] . '</option>';
                                                        else :
                                                            echo '<option value="' . $provincias[$i]['idProvincia'] . '">' . $provincias[$i]['provincia'] . '</option>';
                                                        endif;
                                                    endfor;
                                                endif;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorSelectProvincia_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                            
                                </div>    

                                <input type="hidden" id="localidad_formConfiguracionSistema" value="<?= ($empresa) ? $empresa[0]["idLocalidad"] : "" ?>" class="form-control">
                                <input type="hidden" id="id_formConfiguracionSistema" name="id_formConfiguracionSistema" class="form-control" value="<?= ($empresa) ? $empresa[0]["idEmpresa"] : "" ?>" >

                                <div class="col-md-6"> 
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="selectLocalidad">Localidad</label>
                                        <select name="selectLocalidad_formConfiguracionSistema" id="selectLocalidad_formConfiguracionSistema" class="select-full" required> 
                                            <option value="0">Seleccione</option>
                                        </select>

                                        <div id="errorSelectLocalidad_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>    
                                    </div>        
                                </div>
                            </div>
                            <div class="col-md-12" id="paisNoArgentina" style="display: block;">
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputLocalidad">Localidad</label>
                                    <input name="inputLocalidad_formConfiguracionSistema" id="inputLocalidad_formConfiguracionSistema" type="text" class="form-control" required value="<?= ($empresa) ? $empresa[0]["localidadTxt"] : "" ?>">

                                    <div id="errorInputLocalidad_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>
                            </div>
                            <?php if (!$empresa) { ?>
                                <div class="col-md-12"> 
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="selectCaja"><span style="color: red;"> * </span>Caja</label>
                                        <select name="selectCaja_formConfiguracionSistema" id="selectCaja_formConfiguracionSistema" class="select-full" required> 
                                            <option value="0">Seleccione un caja</option>
                                            <?php
                                            for ($i = 0; $i < count($tesoreria_cuentas); $i++) :
                                                echo '<option value="' . $tesoreria_cuentas[$i]['idGenCuenta'] . '">' . $tesoreria_cuentas[$i]['descripcion'] . '</option>';
                                            endfor;
                                            ?>  
                                        </select>

                                        <div id="errorSelectCaja_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>    
                                    </div>        
                                </div>
                            <?php } ?>
                        </div>  


                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-city"></i> Configuración del negocio</h6></div>
            <div class="panel-body">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div class="col-md-12">                                
                        <div class="form-group label-floating has-feedback">     
                            <label class="control-label" for="inputStock">Nombre de la Empresa</label>
                            <input name="inputNombreEmpesa_formConfiguracionSistema" id="inputNombreEmpesa_formConfiguracionSistema" type="text" class="form-control" value="<?= ($empresa) ? $empresa[0]["nombreSistema"] : "" ?>">

                            <div id="errorInputNombreEmpesa_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                * Debe completar el campo
                            </div>   
                        </div>                                        
                    </div>    
                    <div class="col-md-6">
                        <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">                                
                            <div class="form-group label-floating has-feedback"> 
                                <label class="control-label" for="selectTipoMoneda">Tipo Moneda</label>
                                <select name="selectTipoMoneda_formConfiguracionSistema" id="selectTipoMoneda_formConfiguracionSistema" class="select-full" required>
                                    <option value="0">Seleccione un tipo</option>
                                    <?php
                                    if (isset($empresa)) :
                                        if (isset($tipo_moneda)) :
                                            for ($i = 0; $i < count($tipo_moneda); $i++) :
                                                if ($tipo_moneda[$i]['idTipoMoneda'] == $empresa[0]['idTipoMoneda']) :
                                                    echo '<option selected="selected" value="' . $tipo_moneda[$i]['idTipoMoneda'] . '">' . $tipo_moneda[$i]['descripcion'] . '</option>';
                                                else :
                                                    echo '<option value="' . $tipo_moneda[$i]['idTipoMoneda'] . '">' . $tipo_moneda[$i]['descripcion'] . '</option>';
                                                endif;
                                            endfor;
                                        endif;
                                    endif;
                                    ?>         
                                </select>                                               

                                <div id="errorSelectTipoMoneda_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                    * Debe seleccionar una opci&oacute;n
                                </div>   
                            </div>  
                        </div>  
                        <div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
                            <div id="boxCabeceraForm">
                                <h3>
                                    <small>
                                        <i style="color:#333333;" class="fas fa-dolly" aria-hidden="true"></i>
                                        STOCK
                                    </small>
                                </h3>
                            </div>         
                            <div class="col-md-12" style="padding-right: 0px;">                                
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectStock">Control de Stock</label>
                                    <select name="selectStock_formConfiguracionSistema" id="selectStock_formConfiguracionSistema" class="select-full" required>
                                        <?php if ($empresa[0]["stock"] == 0): ?>
                                            <option selected="selected" value="0">Si</option>
                                            <option value="1">No</option>
                                        <?php elseif ($empresa[0]["stock"] == 1): ?>
                                            <option value="0">Si</option>
                                            <option selected="selected" value="1">No</option>
                                        <?php endif; ?>
                                    </select>                                               

                                    <div id="errorSelectStock_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6"> 
                        <div class="col-md-12" style="padding-right: 0px;">                                
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="inputInicioActividad">                                                  
                                    Inicio Actividad
                                </label>
                                <input name="inputInicioActividad_formConfiguracionSistema" id="inputInicioActividad_formConfiguracionSistema" data-minlength="2" maxlength="25" type="text" class="form-control" autocomplete="off"  value="<?= ($empresa) ? $empresa[0]["inicioActividad"] : "" ?>">

                                <div id="errorInputInicioActividad_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                    * Debe completar el campo
                                </div>   
                            </div>                                        
                        </div>
                        <div class="col-md-12" style="padding-right: 0px;">
                            <div id="boxCabeceraForm">
                                <h3>
                                    <small>
                                        <i style="color:#333333;" class="fas fa-hand-holding-usd" aria-hidden="true"></i>
                                        ARQUEO
                                    </small>
                                </h3>
                            </div> 
                            <div class="col-md-12" style="padding-right: 0px; padding-right: 0px;">                                
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="selectArqueo">Control de Arqueo</label>
                                    <select name="selectArqueo_formConfiguracionSistema" id="selectArqueo_formConfiguracionSistema" class="select-full" required>
                                        <?php if ($empresa[0]["arqueo"] == 0): ?>
                                            <option selected="selected" value="0">Si</option>
                                            <option value="1">No</option>
                                        <?php elseif ($empresa[0]["arqueo"] == 1): ?>
                                            <option value="0">Si</option>
                                            <option selected="selected" value="1">No</option>
                                        <?php endif; ?>
                                    </select>                                               

                                    <div id="errorSelectArqueo_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>   
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-file-contract"></i> Configuración Legal</h6></div>
            <div class="panel-body">
                <div id="paso-1" style="padding-bottom:15px;">
                <div id="boxCabeceraForm">
                        <div class="col-md-6" style="padding-right: 0px;">                                
                            <div class="form-group label-floating has-feedback"> 
                                <label class="control-label" for="selectFacturaElectronica">Factura Electronica</label>
                                <select name="selectFacturaElectronica_formConfiguracionSistema" id="selectFacturaElectronica_formConfiguracionSistema" class="select-full" required onchange="facturaElectronicaCampos()">
                                    <?php if ($empresa[0]["facturaElectronica"] == 0): ?>
                                        <option selected="selected" value="0">Si</option>
                                        <option value="1">No</option>
                                    <?php elseif ($empresa[0]["facturaElectronica"] == 1): ?>
                                        <option value="0">Si</option>
                                        <option selected="selected" value="1">No</option>
                                    <?php endif; ?>
                                </select>                                               

                                <div id="errorSelectFacturaElectronica_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                    * Debe seleccionar una opci&oacute;n
                                </div>   
                            </div>  
                        </div>

                        <div id="datosFacturacionElectronica">
                            <div class="col-md-12">  
                                <div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <span style="color: red;"> * </span>
                                        <label class="control-label" for="inputCuit">                                                  
                                            Cuit
                                        </label>
                                        <input name="inputCuit_formConfiguracionSistema" id="inputCuit_formConfiguracionSistema" data-minlength="9" maxlength="13" type="number" class="form-control" value="<?= ($empresa) ? $empresa[0]["cuit"] : "" ?>" onkeyup="formato_cuit_config_sistema()" placeholder="0">

                                        <div id="errorInputCuit_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                
                                <div class="col-md-6" style="padding-right: 0px;">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <span style="color: red;"> * </span>
                                        <label class="control-label" for="inputIibb">                                                  
                                            Iibb
                                        </label>
                                        <input name="inputIibb_formConfiguracionSistema" id="inputIibb_formConfiguracionSistema" type="text" class="form-control"  value="<?= ($empresa) ? $empresa[0]["iibb"] : ""?>" placeholder="0">

                                        <div id="errorInputIibb_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                            </div>

                            <div class="col-md-12">                                
                                <div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <span style="color: red;"> * </span>
                                        <label class="control-label" for="selectTipoAnteAfip">Tipo Ante AFIP</label>
                                        <select name="selectTipoAnteAfip_formConfiguracionSistema" id="selectTipoAnteAfip_formConfiguracionSistema" class="select-full" required>
                                            <option value="0">Seleccione un tipo</option>
                                            <?php
                                            if (isset($empresa)) :
                                                if (isset($iva_condiciones)) :
                                                    for ($i = 0; $i < count($iva_condiciones); $i++) :
                                                        if ($iva_condiciones[$i]['idCondicionIva'] == $empresa[0]["idTipoAnteAfip"]) :
                                                            echo '<option selected="selected" value="' . $iva_condiciones[$i]['idCondicionIva'] . '">' . $iva_condiciones[$i]['descripcion'] . '</option>';
                                                        else :
                                                            echo '<option value="' . $iva_condiciones[$i]['idCondicionIva'] . '">' . $iva_condiciones[$i]['descripcion'] . '</option>';
                                                        endif;
                                                    endfor;
                                                endif;
                                            endif;
                                            ?>         
                                        </select>                                               

                                        <div id="errorSelectTipoAnteAfip_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-6" style="padding-right: 0px;">                                
                                    <div class="form-group label-floating has-feedback">   
                                        <span style="color: red;"> * </span>
                                        <label class="control-label" for="inputPuntoVenta">                                                  
                                            Punto Venta
                                        </label>
                                        <input name="inputPuntoVenta_formConfiguracionSistema" id="inputPuntoVenta_formConfiguracionSistema" data-minlength="2" maxlength="25" type="number" class="form-control" value="<?= ($empresa) ? $empresa[0]["puntoVta"] : "" ?>">

                                        <div id="errorInputPuntoVenta_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12" style="padding: inherit;">                                
                                    <div class="form-group label-floating has-feedback"> 
                                        <span style="color: red;"> * </span>
                                        <label class="control-label" for="inputRazonSocial">                                                  
                                            Razon Social
                                        </label>
                                        <input name="inputRazonSocial_formConfiguracionSistema" id="inputRazonSocial_formConfiguracionSistema" data-minlength="2" maxlength="25" type="text" class="form-control" value="<?= ($empresa) ? $empresa[0]["razonSocial"] : "" ?>">

                                        <div id="errorInputRazonSocial_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>   
                                    </div>                                        
                                </div>
                                <div class="col-md-12" style="padding: inherit;">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputToken_formConfiguracionSistema">                                                  
                                            Token
                                        </label>
                                        <input name="inputToken_formConfiguracionSistema" id="inputToken_formConfiguracionSistema" data-minlength="2" maxlength="25" type="text" class="form-control" value="<?= ($empresa) ? $empresa[0]["token"] : "" ?>">

                                        <div id="errorInputToken_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>  
                                    </div>                                        
                                </div>
                                <div class="col-md-12" style="padding: inherit; text-align: center;">
                                    <div style="margin-top:15px;padding-top: 10px;">
                                        <a href="#">Solicitar ayuda del soporte para obtener esta información</a>
                                    </div>  
                                </div>
                            </div>
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12" style="padding-right: 0px;">                                
                                    <div class="form-group label-floating has-feedback">    
                                        <span style="color: red;"> * </span>
                                        <label class="control-label" for="selectCondicionFacturacion">Condición de facturación</label>
                                        <select name="selectCondicionFacturacion_formConfiguracionSistema" id="selectCondicionFacturacion_formConfiguracionSistema" class="select-full" required>
                                            <option value="0">Seleccione la condición</option>
                                            <?php
                                            if (isset($empresa)) :
                                                if (isset($condicion_facturacion)) :
                                                    for ($i = 0; $i < count($condicion_facturacion); $i++) :
                                                        if ($condicion_facturacion[$i]['idCondicionFacturacion'] == $empresa[0]['idConceptoFactura']) :
                                                            echo '<option selected="selected" value="' . $condicion_facturacion[$i]['idCondicionFacturacion'] . '">' . $condicion_facturacion[$i]['descripcion'] . '</option>';
                                                        else:
                                                            echo '<option value="' . $condicion_facturacion[$i]['idCondicionFacturacion'] . '">' . $condicion_facturacion[$i]['descripcion'] . '</option>';
                                                        endif;
                                                    endfor;
                                                endif;
                                            endif;
                                            ?>  
                                        </select>                                               

                                        <div id="errorSelectCondicionFacturacion_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>  
                                    </div>                                        
                                </div>  
                                <div class="col-md-12" style="padding-right: 0px;">                                
                                    <div class="form-group label-floating has-feedback">     
                                        <label class="control-label" for="inputCertificado">                                                  
                                            Certificado
                                        </label>
                                        <input name="inputCertificado_formConfiguracionSistema" id="inputCertificado_formConfiguracionSistema" data-minlength="2" maxlength="25" type="text" class="form-control" value="<?= ($empresa) ? $empresa[0]["certificado"] : "" ?>">

                                        <div id="errorInputCertificado_formConfiguracionSistema" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>  
                                    </div>                                        
                                </div>
                                <div class="col-md-12" style="padding-right: 0px;">
                                    <div style="margin-top:15px;">
                                        <span id="btnValidarDatos" class="btn btn-primary btn-raised btn-block">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            Validar información
                                        </span>
                                    </div>  
                                </div>
                            </div>   
                        </div>             
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="padding: inherit;">
                <div style="margin-top:15px;padding-bottom: 75px;">
                    <span id="btnValidarDatos" class="btn btn-primary btn-raised btn-block" onclick="configuracion_sistema()">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>  
            </div>
        </div>

        <script> mostrarCampoLocalidad(); facturaElectronicaCampos(); mostrarCamposFacturacionSegunFacturacion();</script>

    </form>
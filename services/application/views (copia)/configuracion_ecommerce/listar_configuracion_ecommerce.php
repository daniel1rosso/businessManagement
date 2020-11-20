<!-- Page content -->
<div class="page-content">

    <!-- Page header -->
    <div class="page-header">
        <div class="page-title">
            <h3>Configuración del Ecommerce</h3>
        </div>
    </div>
    <!-- /page header -->

    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?= $url ?>dashboard">Home</a></li>
            <li class="active">Configuración del E-Commerce</li>
        </ul>

        <div class="visible-xs breadcrumb-toggle">
            <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
        </div>
    </div>
    <!-- /breadcrumbs line -->

    <!-- Basic inputs -->
    <form id="formConfiguracionEcommerce" role="form" action="#" method="POST" enctype="multipart/form-data">
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-dumpster fa-lg" style="writing-mode: vertical-rl;"></i> Configuración Principal</h6></div>
            <div class="panel-body">        
                <div id="paso-1" style="padding-bottom:15px;">

                    <div class="row col-md-12">
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputTitulo">T&iacute;tulo</label>
                                    <input name="inputTitulo_formConfiguracionEcommerce" id="inputTitulo_formConfiguracionEcommerce" type="text" class="form-control" placeholder="Título" value="<?= $configuracion_ecommerce[0]['titulo'] ?>">

                                    <div id="errorTitulo_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>
                            </div>  
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputFacebook"><i class="fab fa-facebook"></i> Facebook</label>
                                    <input name="inputFecebook_formConfiguracionEcommerce" id="inputFecebook_formConfiguracionEcommerce" type="text" class="form-control" placeholder="URL de Facebook" value="<?= $configuracion_ecommerce[0]['facebook'] ?>">

                                    <div id="errorFacebook_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>
                            </div>  
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputTwitter"><i class="fab fa-twitter"></i> Twitter</label>
                                    <input name="inputTwitter_formConfiguracionEcommerce" id="inputTwitter_formConfiguracionEcommerce" type="text" class="form-control" placeholder="URL de Twitter" value="<?= $configuracion_ecommerce[0]['twitter'] ?>">

                                    <div id="errorTwitter_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>
                            </div>
                            <div class="col-md-12">  
                                <div class="form-group label-floating has-feedback">                               
                                    <label class="control-label" for="inputColorTexto"> Color del Texto</label>
                                    <div class="input-group color color-picker-hex" data-color="<?= $configuracion_ecommerce[0]['colorTexto'] ?>" data-color-format="hex">
                                        <input name="inputColorTexto_formConfiguracionEcommerce" id="inputColorTexto_formConfiguracionEcommerce" type="text" class="color-picker-hex form-control" readonly="readonly" value="<?= $configuracion_ecommerce[0]['colorTexto'] ?>">
                                        <span class="input-group-addon"><i style="background-color: <?= $configuracion_ecommerce[0]['colorTexto'] ?>"></i></span>
                                    </div>
                                </div>
                            </div>
                            <?PHP
                            if ($configuracion_ecommerce_imagen != "" || $configuracion_ecommerce_imagen) {
                                foreach ($configuracion_ecommerce_imagen as $key => $value) {
                                    if ($value['nombre'] != "") {
                                        ?>
                                        <div id="delete_wrapper_configuracionEcommerce_<?= $key ?>">
                                            <div class="col-md-12">  
                                                <img src="<?= base_url() . 'uploads/ecommerce/banner/' . $value['nombre'] ?>" alt="<?= $value['nombre'] ?>" style="  display:block; margin-left: auto; margin-right: auto;"  width="350" height="100" id="imgconfiguracionecommerce<?= $key ?>">
                                                <br>
                                                <div class="form-group label-floating has-feedback">     
                                                    <div class="col-md-10" style="padding:0px;"> 
                                                        <label class="control-label" for="imagenBanner"> Imagen para el Banner</label>
                                                        <input type="file" name="fileImagenBanner_formConfiguracionEcommerce<?= $key ?>" id="fileImagen_formConfiguracionEcommerce<?= $key ?>" class="styled" onchange="cargar_img_config_banner(<?= $key ?>, 2)">								
                                                        <div id="errorFile_formConfiguracionEcommerce<?= $key ?>" class="btn-danger erroBoxs" style="display: none">
                                                            * Ingrese una imagen.
                                                        </div>                                          
                                                        <div id="errorFileFormato_formConfiguracionEcommerce<?= $key ?>" class="btn-danger erroBoxs" style="display: none">
                                                            * Ingrese una imagen con formato JPG, JPEG, PNG O GIF.
                                                        </div>
                                                    </div>
                                                    <?PHP if ($key == 0) { ?>
                                                        <div class="col-md-2" style="padding:0px;"> 
                                                            <div class="form-group label-floating has-feedback">
                                                                <label class="control-label" style="text-align:center;width:100%;">Más Imagen</label>
                                                                <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                                                    <a href="javascript:void(0);" class="add_imagen_banner_formConfiguracionEcommerce" title="Agregar Imagen"><i class="icon-plus"></i></a>   
                                                                </div>
                                                            </div>
                                                        </div>  
                                                    <?PHP } else { ?>
                                                        <div class="col-md-2" style="padding:0px;">
                                                            <div class="form-group label-floating has-feedback">
                                                                <label class="control-label" style="text-align:center;width:100%;">Borrar</label>
                                                                <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                                                    <a onclick="borrar_imagen_banner_configuracionEcommerce(<?= $key ?>)" class="remove_imagen_banner_configuracionEcommerce" title="Remove field"><i class="icon-remove"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?PHP } ?>
                                                </div>
                                            </div> 
                                        </div> 
                                    <?PHP } ?>
                                <?PHP } ?>
                            <?PHP } ?>
                            <div class="col-md-12">  
                                <div class="field_wrapper_configuracionEcommercer">
                                    <!-- JS -->
                                </div>
                            </div>  
                        </div>  
                        <!--Divisor de derecha e izquierda-->
                        <div class="col-md-6" style="padding:0px;">
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="inputNombreEmpresa">Nombre de la Empresa</label>
                                    <input name="inputNombreEmpesa_formConfiguracionEcommerce" id="inputNombreEmpesa_formConfiguracionEcommerce" type="text" class="form-control" placeholder="Nombre de la Empresa" value="<?= $configuracion_ecommerce[0]['nombreEmpresa'] ?>">

                                    <div id="errorInputNombreEmpesa_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>
                            </div> 
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp</label>
                                    <input name="inputWhatsApp_formConfiguracionEcommerce" id="inputWhatsApp_formConfiguracionEcommerce" type="tel" class="form-control" placeholder="Numero de WhatsApp" value="<?= $configuracion_ecommerce[0]['whatsapp'] ?>">

                                    <div id="errorWhatsApp_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>   
                                </div>
                            </div> 
                            <div class="col-md-12">   
                                <div class="form-group label-floating has-feedback">                              
                                    <label class="control-label" for="inputColorEnlacePrincipal"> Color Enlace Principal</label>
                                    <div class="input-group color color-picker-hex" data-color="<?= $configuracion_ecommerce[0]['colorEnlacePrincipal'] ?>" data-color-format="hex">
                                        <input name="inputColorEnlacePrincipal_formConfiguracionEcommerce" id="inputColorEnlacePrincipal_formConfiguracionEcommerce" type="text" class="color-picker-hex form-control" readonly="readonly" value="<?= $configuracion_ecommerce[0]['colorEnlacePrincipal'] ?>">
                                        <span class="input-group-addon"><i style="background-color: <?= $configuracion_ecommerce[0]['colorEnlacePrincipal'] ?>"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">                                
                                <div class="form-group label-floating has-feedback"> 
                                    <label class="control-label" for="inputColorSecundario"> Color Secundario</label>
                                    <div class="input-group color color-picker-hex" data-color="<?= $configuracion_ecommerce[0]['colorSecundario'] ?>" data-color-format="hex">
                                        <input name="inputColorSecundario_formConfiguracionEcommerce" id="inputColorSecundario_formConfiguracionEcommerce" type="text" class="color-picker-hex form-control" readonly="readonly" value="<?= $configuracion_ecommerce[0]['colorSecundario'] ?>">
                                        <span class="input-group-addon"><i style="<?= $configuracion_ecommerce[0]['colorSecundario'] ?>"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">  
                                <div class="form-group label-floating has-feedback">     
                                    <img src="<?= base_url() . 'uploads/ecommerce/logo/' . $configuracion_ecommerce[0]['logo'] ?>" alt="<?= $configuracion_ecommerce[0]['logo'] ?>" style="  display:block; margin-left: auto; margin-right: auto;">
                                    <br>
                                    <label class="control-label" for="logo"> Logo</label>
                                    <input type="file" name="fileImagen_formConfiguracionEcommerce" id="fileImagen_formConfiguracionEcommerce" class="styled">								
                                    <div id="errorFile_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Ingrese una imagen.
                                    </div>                                          
                                    <div id="errorFileFormato_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                        * Ingrese una imagen con formato JPG, JPEG, PNG O GIF.
                                    </div>                                 
                                </div>    
                            </div>
                            <div class="col-md-12">  
                                <div class="form-group label-floating has-feedback">     
                                    <label class="control-label" for="selectProductoEcommerce">Agregar nuevos productos al E-Commerce</label>
                                    <select name="selectProductoEcommerce_formConfiguracionEcommerce" id="selectProductoEcommerce_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;"> 
                                        <?php
                                        if ($configuracion_ecommerce[0]['ecommerce'] == 0):
                                            echo '<option selected="selected" value="0">Si</option>';
                                            echo '<option value="1">No</option>';
                                        else :
                                            echo '<option value="0">Si</option>';
                                            echo '<option selected="selected" value="1">No</option>';
                                        endif;
                                        ?>                                                     
                                    </select>
                                </div>    
                            </div>
                        </div>  
                    </div>  
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-paper-plane fa-lg" style="writing-mode: vertical-rl;"></i> Env&iacute;os</h6></div>
            <div class="panel-body">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div class="col-md-12">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-plane" aria-hidden="true"></i>
                                    Envíos Internacionales
                                </small>
                            </h3>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectTarifaInternacional">Registro del envíos Internacionales</label>
                                <select name="selectTarifaInternacional_formConfiguracionEcommerce" id="selectTarifaInternacional_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;" onchange="mensajeTarifaInternacional()"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['envioInternacional'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="inputTarifaInternacional">Tarifa Internacional</label>
                                <input name="inputTarifaInternacional_formConfiguracionEcommerce" id="inputTarifaInternacional_formConfiguracionEcommerce" type="text" class="form-control" placeholder="0" value="<?= $configuracion_ecommerce[0]['tarifaInternacional'] ?>"  <?PHP if ($configuracion_ecommerce[0]['tarifaInternacional'] <= 0 && $configuracion_ecommerce[0]['envioInternacional'] == 1) { ?> disabled="disabled" <?PHP } ?> onkeyup="mensajeTarifaInternacional()">

                                <div id="infoTarifaInternacional_formConfiguracionEcommerce" class="btn-info erroBoxs" style="display: none">
                                    * Si el valor de la tarifa es cero se mostrara como Envío Gratis
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-truck" aria-hidden="true"></i>
                                    Envíos Nacionales
                                </small>
                            </h3>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectTarifaNacional">Registro del envíos Nacionales</label>
                                <select name="selectTarifaNacional_formConfiguracionEcommerce" id="selectTarifaNacional_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;" onchange="mensajeTarifaNacional()"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['envioNacional'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="inputTarifaNacional">Tarifa Nacional</label>
                                <input name="inputTarifaNacional_formConfiguracionEcommerce" id="inputTarifaNacional_formConfiguracionEcommerce" type="text" class="form-control" placeholder="0" value="<?= $configuracion_ecommerce[0]['tarifaNacional'] ?>" <?PHP if ($configuracion_ecommerce[0]['tarifaNacional'] <= 0 && $configuracion_ecommerce[0]['envioNacional'] == 1) { ?> disabled="disabled" <?PHP } ?> onkeyup="mensajeTarifaNacional()">

                                <div id="infoTarifaNacional_formConfiguracionEcommerce" class="btn-info erroBoxs" style="display: none">
                                    * Si el valor de la tarifa es cero se mostrara como Envío Gratis
                                </div>  
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-dolly-flatbed" aria-hidden="true"></i>
                                    Mercado Envíos
                                </small>
                            </h3>
                        </div> 
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectTarifaMercadoEnvio">Registro del envíos por Mercado Envío</label>
                                <select name="selectTarifaMercadoEnvio_formConfiguracionEcommerce" id="selectTarifaMercadoEnvio_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;" onchange="mensajeTarifaMercadoEnvio()"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['envioMercadoEnvio'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="inputTarifaCadeteria">Tarifa Mercado Envío</label>
                                <input name="inputTarifaMercadoEnvio_formConfiguracionEcommerce" id="inputTarifaMercadoEnvio_formConfiguracionEcommerce" type="text" class="form-control" placeholder="0" value="<?= $configuracion_ecommerce[0]['tarifaMercadoEnvio'] ?>" <?PHP if ($configuracion_ecommerce[0]['tarifaMercadoEnvio'] <= 0 && $configuracion_ecommerce[0]['envioMercadoEnvio'] == 1) { ?> disabled="disabled" <?PHP } ?> onkeyup="mensajeTarifaMercadoEnvio()">

                                <div id="infoTarifaMercadoEnvio_formConfiguracionEcommerce" class="btn-info erroBoxs" style="display: none">
                                    * Si el valor de la tarifa es cero se mostrara como Envío Gratis
                                </div>    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-motorcycle" aria-hidden="true"></i>
                                    Envíos Cadetería
                                </small>
                            </h3>
                        </div> 
                        <div class="col-md-3">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectTarifaCadeteria">Registro del envíos por Cadetería</label>
                                <select name="selectTarifaCadeteria_formConfiguracionEcommerce" id="selectTarifaCadeteria_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['envioCadeteria'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                        </div>
                    </div>

                    <div class="col-md-12">
                        <?PHP if ($envios_costos) { ?>
                            <?PHP foreach ($envios_costos as $key => $value) { ?>
                                <div id="delete_wrapper_configuracionEcommerce_<?= $value['idEnvioCosto'] ?>">
                                    <input id="idEnvioCosto_configuracionEcommerce" name="idEnvioCosto_configuracionEcommerce" type="hidden" value="<?= $id ?>">
                                    <div class="col-md-5">
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="inputTarifaCadeteria">Tarifa Cadeteria</label>
                                            <input name="inputTarifaCadeteria_formConfiguracionEcommerce<?= $value['idEnvioCosto'] ?>" id="inputTarifaCadeteria_formConfiguracionEcommerce<?= $value['idEnvioCosto'] ?>" type="text" class="form-control" placeholder="0" value="<?= $value['costo'] ?>">

                                            <div id="errorInputTarifaCadeteria_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group label-floating has-feedback">     
                                            <label class="control-label" for="inputCantidadCuadras">Cantidad de cuadras</label>
                                            <input name="inputCantidadCuadras_formConfiguracionEcommerce<?= $value['idEnvioCosto'] ?>" id="inputCantidadCuadras_formConfiguracionEcommerce<?= $value['idEnvioCosto'] ?>" type="text" class="form-control" placeholder="0" value="<?= $value['cantidad'] ?>">

                                            <div id="errorInputTarifaCadeteria_formConfiguracionEcommerce" class="btn-danger erroBoxs" style="display: none">
                                                * Debe completar el campo
                                            </div>   
                                        </div>
                                    </div>
                                    <?PHP if ($key == 0) { ?>
                                        <div class="col-md-2" style="padding:0px;"> 
                                            <div class="form-group label-floating has-feedback">
                                                <label class="control-label" style="text-align:center;width:100%;">Agregar costo</label>
                                                <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                                    <a href="javascript:void(0);" class="add_costo_cadeteria_formConfiguracionEcommerce" title="Agregar costo"><i class="icon-plus"></i></a>   
                                                </div>
                                            </div>
                                        </div>
                                    <?PHP } else { ?>
                                        <div class="col-md-2" style="padding:0px;">
                                            <div class="form-group label-floating has-feedback">
                                                <label class="control-label" style="text-align:center;width:100%;">Borrar</label>
                                                <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                                    <a onclick="borrar_costo_cadeteria_configuracionEcommerce(<?= $value['idEnvioCosto'] ?>)" class="remove_costo_cadeteria_configuracionEcommerce" title="Remove field"><i class="icon-remove"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?PHP } ?>
                                </div>
                            <?PHP } ?>
                        <?PHP } ?>
                    </div>

                    <div class="col-md-12">  
                        <div class="field_wrapper_costo_cadeteria_configuracionEcommercer">
                            <!-- JS -->
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title"><i class="fas fa-money-check-alt" style="writing-mode: vertical-rl;"></i> Formas de pagos</h6></div>
            <div class="panel-body">
                <div id="paso-1" style="padding-bottom:15px;">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectPagosEfectivo">Pagos en efectivo</label>
                                <select name="selectPagosEfectivo_formConfiguracionEcommerce" id="selectPagosEfectivo_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['pagosEfectivo'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectPagosEfectivoContraEntrega">Pagos en efectivo contra entrega</label>
                                <select name="selectPagosEfectivoContraEntrega_formConfiguracionEcommerce" id="selectPagosEfectivoContraEntrega_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['pagosEfecCEntrega'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating has-feedback">     
                                <label class="control-label" for="selectPagosMercadoPago">Pagos por Mercado Pago</label>
                                <select name="selectPagosMercadoPago_formConfiguracionEcommerce" id="selectPagosMercadoPago_formConfiguracionEcommerce" class="form-control" style="text-transform:uppercase;"> 
                                    <?php
                                    if ($configuracion_ecommerce[0]['pagosMercadoPago'] == 0):
                                        echo '<option selected="selected" value="0">Si</option>';
                                        echo '<option value="1">No</option>';
                                    else :
                                        echo '<option value="0">Si</option>';
                                        echo '<option selected="selected" value="1">No</option>';
                                    endif;
                                    ?>                                                     
                                </select>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding: inherit;">
                <div style="margin-top:15px;padding-bottom: 75px;">
                    <span id="btnValidarDatos" class="btn btn-primary btn-raised btn-block" onclick="configuracion_ecommerce()">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Guardar
                    </span>
                </div>  
            </div>
        </div>
        <!--</div>-->
    </form>
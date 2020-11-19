<!-- Modal Cargando -->
<div id="modal-cargando" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Aguarde</h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    <div class="alert alert-info fade in" style="text-align:center;width:95%;margin:0px auto;border:1px solid #3A87AD;padding-bottom:30px;">
                        <i id="rotate" style="position: absolute;font-size: 1.5em;" class="fa fa-cog fa-spin fa-1x fa-fw margin-bottom"></i>
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div id="modal-delete" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-remove4"></i>Eliminar</h4>
            </div>

            <div class="modal-body with-padding">
                <p>¿Esta seguro que desea eliminar este registro?</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary button-delete-si"> Si</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Exitoso -->
<div id="modal-exitoso" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Registro actualizado
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning button-ok-modal" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Exitoso -->
<div id="modal-exitoso-insercion" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Inserción correcta
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning button-ok-modal" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Exitoso -->
<div id="operacionExitosa" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Registro actualizado
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning button-ok-modal" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Eliminacion Exitosa -->
<div id="eliminacion-exitosa" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Registro eliminado
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--- Modal Exitoso para añadir mensaje --->
<div id="popUpExitoMsg" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-check"></span>
                    Exito
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p id="msgExito"></p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--- Modal Error --->
<div id="popUpErrorMsg" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-times"></span>
                    Error
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>Disculpe, ocurri&oacute; un error:</p>
                <p id="msgError"></p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--- Modal Error --->
<div id="popUpError" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">
                    <span class="fa fa-times"></span>
                    Error
                </h4>
            </div>

            <div class="modal-body with-padding">
                <p>
                    Disculpe, ocurri&oacute; un error al procesar su solicitud intentelo nuevamente.
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Agregar MenuAdmin -->

<div id="modal-add-menuAdmin" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fas fa-dollar-sign"></i>Agregar MenuAdmin</h4>
            </div>
            <!-- Form inside modal -->
            <form id="form-add-menuAdmin" name="form-add-menuAdmin" class="validate" novalidate="novalidate" action="#" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Posición:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" min="0" max="100" name="posicionMenuAdminAgregar" id="posicionMenuAdminAgregar" class="form-control">
                                <div id="errorPosicionMenuAdmin" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Tipo interna:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectTipoInternaAgregar" id="selectTipoInternaAgregar" class="select-full" required>
                                    <option value="0">Seleccionar Tipo Interna:</option>
                                    <?php
                                    if (isset($tipoInterna)) :
                                        for ($i = 0; $i < count($tipoInterna); $i++) :
                                            echo '<option value="' . $tipoInterna[$i]['idTipoInterna'] . '">' . $tipoInterna[$i]['nombre'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorTipoInterna" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Sub item:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" min="0" name="subItemAgregar" id="subItemAgregar" class="form-control">
                                <div id="errorSubItemAdd" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un subitem v&aacute;lido
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nombre:</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="nombreMenuAdminAgregar" id="nombreMenuAdminAgregar" class="form-control">
                            <div id="errorNombreMenuAdmin" class="btn-danger erroBoxs" style="display: none">
                                * Ingrese un nombre v&aacute;lido
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;

                <!--Icono-->
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Icono:</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="nombreIconoAgregar" id="nombreIconoAgregar" class="form-control">
                            <div id="errorIcono" class="btn-danger erroBoxs" style="display: none">
                                * Ingrese un icono v&aacute;lido
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <!--Link-->
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Link:</span> </label>
                        <div class="col-sm-10">
                            <input type="text" name="nombreLinkAgregar" id="nombreLinkAgregar" class="form-control">
                            <div id="errorLink" class="btn-danger erroBoxs" style="display: none">
                                * Ingrese un link v&aacute;lido
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <!--Color-->
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span>Color:</span> </label>
                        <div class="col-sm-10">
                            <input type="color" style="width: 50px;" name="colorAgregar" id="colorAgregar" class="form-control">
                            <div id="errorColor" class="btn-danger erroBoxs" style="display: none">
                                * Ingrese un color v&aacute;lido
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp;
                <!--Nivel-->
                <div class="modal-body with-padding">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nivel:</span> </label>
                        <div class="col-sm-10">
                            <select name="selectNivelMenuAdminAgregar" id="selectNivelMenuAdminAgregar" multiple="multiple" tabindex="2" style="text-transform:uppercase;width: 100%;">
                                <?php
                                foreach ($nivel as $key => $value) :
                                    echo '<option value="' . $value['idNivel'] . '">' . $value['nivel'] . '</option>';
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                &nbsp;

                <div class="modal-footer">

                    <div class="form-actions text-right">

                        <span id="agregarMenuAdminBTN" class="btn btn-primary">Agregar</span>
                        &nbsp;
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

<div id="modal-editar-menuAdmin" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fas fa-dollar-sign"></i>Editar MenuAdmin</h4>
            </div>

            <!-- Form inside modal -->
            <form id="form-modificar-menuAdmin" name="form-modificar-menuAdmin" class="validate" novalidate="novalidate" action="#" role="form" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-plus"></i>Modificar Menu</h6>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Posición:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" name="posicionMenuModificar" id="posicionMenuModificar" class="form-control">
                                <div id="errorPosicionMenuAdminModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una posición v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Tipo Interna:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectTipoInternaModificar" id="selectTipoInternaModificar" class="select-full" required value="<?php echo (isset($tipoInterna[0]['idTipoInterna'])) ? $tipoInterna[0]['idTipoInterna'] : ''; ?>">
                                    <option value="0">Seleccionar tipo interna</option>
                                    <?php
                                    foreach ($tipoInterna as $key => $value) :
                                        if ($menuAdmin['idTipoInterna'] == $value['idTipoInterna']) :
                                            echo '<option selected="selected" value="' . $value['idTipoInterna'] . '">' . $value['nombre'] . '</option>';
                                        else :
                                            echo '<option value="' . $value['idTipoInterna'] . '">' . $value['nombre'] . '</option>';
                                        endif;
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Sub Items:</span></label>
                            <div class="col-sm-10">
                                <input type="number" min="0" name="subItemModificar" id="subItemModificar" class="form-control">
                                <div id="errorSubItemMod" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un sub item v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nombre:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="nombreMenuAdminModificar" id="nombreMenuAdminModificar" class="form-control">
                                <input type="hidden" name="idMenuModificar" id="idMenuModificar">
                                <input type="hidden" name="idNivelGen" id="idNivelGen">
                                <div id="errorNombreMenuUsuario" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Icono:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="iconoMenuAdminModificar" id="iconoMenuAdminModificar" class="form-control">

                                <div id="errorIconoMenuAdmin" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre de icono v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Link:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="linkMenuAdminModificar" id="linkMenuAdminModificar" class="form-control">

                                <div id="errorLinkMenuAdmin" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un link v&aacute;lido
                                </div>
                            </div>
                        </div>

                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span>Color:</span> </label>
                            <div class="col-sm-10">

                                <input type="color" style="width: 50px;" name="colorMenuAdminModificar" id="colorMenuAdminModificar" class="form-control">

                                <div id="errorColor" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un color v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nivel:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectNivelMenuAdminModificar" id="selectNivelMenuAdminModificar" multiple="multiple" tabindex="2" style="text-transform:uppercase;width: 100%;">
                                    <?php
                                    foreach ($nivel as $key => $value) :
                                        echo '<option value="' . $value['idNivel'] . '">' . $value['nivel'] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        &nbsp;
                    </div>
                    <div class="modal-footer">

                        <div class="form-actions text-right">
                            <span id="modificarMenuAdminBTN" class="btn btn-primary">Modificar</span>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal Editar Usuarios -->

<div id="modal-editar-usuario" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fas fa-dollar-sign"></i>Editar Usuario</h4>
            </div>

            <!-- Form inside modal -->
            <form id="form-modificar-usuario" name="form-modificar-usuario" class="validate" novalidate="novalidate" action="#" role="form" method="post" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-plus"></i>Modificar Usuario</h6>
                    </div>
                    <div class="panel-body">

                        <div class="form-group">

                            <label class="col-sm-2 control-label"><span>Perfil:</span></label>
                            <div class="col-sm-10">
                                <input type="hidden" name="nombreImgModificar" id="nombreImgModificar">
                                <input type="hidden" name="nombreImgModificar2" id="nombreImgModificar2">
                                <input type="file" name="fileUserModificar" id="fileUserModificar" class="form-control styled">

                                <?php
                                echo '<img id="imgPerfilModificar" name="imgPerfilModificar" class="rounded-circle" height="80" width="80">';
                                ?>

                                <div id="errorPerfil" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una imagen v&aacute;lido
                                </div>
                            </div>

                        </div>
                        &nbsp;

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nombre:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="nombrePersonaModificar" id="nombrePersonaModificar" class="form-control">
                                <input type="hidden" name="idUsuarioModificar" id="idUsuarioModificar">
                                <div id="errorNombreUsuario" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Apellido:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="apellidoUsuarioModificar" id="apellidoUsuarioModificar" class="form-control">

                                <div id="errorApellido" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Teléfono:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="telefonoUsuarioModificar" id="telefonoUsuarioModificar" class="form-control">

                                <div id="errorTelefono" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Email:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="emailUsuarioModificar" id="emailUsuarioModificar" class="form-control">

                                <div id="errorEmail" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>

                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;">*</span>Provincia:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectProvinciaUsuarioModificar" id="selectProvinciaUsuarioModificar" class="select-full" required value="<?php echo (isset($provincia[0]['idProvincia'])) ? $provincia[0]['idProvincia'] : ''; ?>">
                                    <option value="0">Seleccionar Provincia</option>

                                    <?php
                                    foreach ($provincia as $key => $value) :

                                        echo '<option value="' . $value['idProvincia'] . '">' . $value['provincia'] . '</option>';

                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        &nbsp;

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;">*</span>Localidad:</span> </label>
                            <div class="col-sm-10">

                                <select name="selectLocalidadUsuarioModificar" id="selectLocalidadUsuarioModificar" class="select-full" required value="<?php echo (isset($provincia[0]['idProvincia'])) ? $provincia[0]['idProvincia'] : ''; ?>">
                                    <option value="0">Seleccionar Provincia</option>

                                    <?php
                                    foreach ($localidad as $key => $value) :
                                        if ($localidad['idLocalidad'] == $value['idLocalidad']) :
                                            echo '<option selected="selected" value="' . $value['idLocalidad'] . '">' . $value['localidad'] . '</option>';
                                        else :
                                            echo '<option value="' . $value['idLocalidad'] . '">' . $value['localidad'] . '</option>';
                                        endif;
                                    endforeach;
                                    ?>
                                </select>

                                <div id="errorLocalidad" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Usuario:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="usuarioModificar" id="usuarioModificar" class="form-control">

                                <div id="errorUsuario" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;">*</span>Contraseña:</span> </label>
                            <div class="col-sm-10">

                                <input type="password" name="passwordUsuarioModificar" id="passwordUsuarioModificar" class="form-control">

                                <div id="errorPassword" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>

                        &nbsp;

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nivel:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectNivelUsuarioModificar" id="selectNivelUsuarioModificar" class="select-full" required value="<?php echo (isset($nivel[0]['idNivel'])) ? $nivel[0]['idNivel'] : ''; ?>">
                                    <?php
                                    foreach ($nivel as $key => $value) :

                                        echo '<option value="' . $value['idNivel'] . '">' . $value['nivel'] . '</option>';

                                    endforeach;
                                    ?>
                                </select>
                                <div id="errorNivel" class="btn-danger erroBoxs" style="display: none">
                                    * Seleccione un nivel v&aacute;lido
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Menu:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectMenuUsuarioAdmin" id="selectMenuUsuarioAdmin" multiple="multiple" tabindex="2" style="text-transform:uppercase;width: 100%;">

                                </select>
                            </div>
                        </div>
                        &nbsp;
                    </div>
                    <div class="modal-footer">

                        <div class="form-actions text-right">
                            <span id="modificarUsuarioBTN" class="btn btn-primary">Modificar</span>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal Agregar Usuario -->

<div id="modal-add-usuario" class="modal fade in" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fas fa-dollar-sign"></i>Agregar Usuario</h4>
            </div>
            <!-- Form inside modal -->
            <!-- Form components -->
            <form id="form-agregar-usuario" class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">
                <!-- Basic inputs -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><i class="icon-plus"></i>Agregar Usuario</h6>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" name="idUsuarioAgregar" id="idUsuarioAgregar" class="form-control">

                        <!--Perfil-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Perfil:</label>
                            <div class="col-sm-10">
                                <input type="file" name="fileUserAgregar" id="fileUserAgregar" class="styled">
                                <div id="errorAvatar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una imagen.
                                </div>
                                <div id="errorPerfil" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una imagen con formato JPG, JPEG, PNG O GIF.
                                </div>
                            </div>
                        </div>

                        <!-- Nombre Persona  -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nombre:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="nombrePersona" id="nombrePersona" class="form-control">
                                <div id="errorNombrePersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--apellido-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Apellido:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="apellidoPersona" id="apellidoPersona" class="form-control">
                                <div id="errorApellidoPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un apellido v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Telefono-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Teléfono:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" name="telefonoPersona" id="telefonoPersona" class="form-control">
                                <div id="errorTelefonoPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un número de teléfono v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Email-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Email:</span> </label>
                            <div class="col-sm-10">
                                <input type="email" name="emailPersona" id="emailPersona" class="form-control">
                                <div id="errorEmailPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una dirección de correo v&aacute;lida
                                </div>
                            </div>
                        </div>

                        <!--Provincia-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblProvincia"><span style="color: red;">*</span>Provincia</label>
                            <div class="col-sm-10">
                                <select name="selectProvincia" id="selectProvincia" class="select-full" required>
                                    <option value="0">Seleccionar Provincia</option>
                                    <?php
                                    if (isset($provincia)) :
                                        for ($i = 0; $i < count($provincia); $i++) :
                                            echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['provincia'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!--Localidad-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblLocalidad"><span style="color: red;">*</span>Localidad</label>
                            <div class="col-sm-10">
                                <select name="selectLocalidad" id="selectLocalidad" class="select-full" required>
                                    <option value="0">Seleccionar Localidad</option>
                                    <?php
                                    if (isset($localidad)) :
                                        for ($i = 0; $i < count($localidad); $i++) :
                                            echo '<option value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['localidad'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!--Nombre Usuario-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Usuario:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="nombreUsuarioPersona" id="nombreUsuarioPersona" class="form-control">
                                <div id="errorUsuarioPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un usuario v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--password-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;">*</span>Contraseña:</span> </label>
                            <div class="col-sm-10">
                                <input type="password" name="passwordPersona" id="passwordPersona" class="form-control">
                                <div id="errorPass" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una contraseña v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Nivel-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblNivel"><span style="color: red;"> * </span>Nivel</label>
                            <div class="col-sm-10">
                                <select name="selectNivelUsuarioAgregar" id="selectNivelUsuarioAgregar" class="select-full" required>
                                    <option value="0">Seleccionar Nivel</option>
                                    <?php
                                    if (isset($nivel)) :
                                        for ($i = 0; $i < count($nivel); $i++) :
                                            echo '<option value="' . $nivel[$i]['idNivel'] . '">' . $nivel[$i]['nivel'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorNivelPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Debe seleccionar una opci&oacute;n
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Menu:</span> </label>
                            <div class="col-sm-10">
                                <select name="selectMenuUsuarioAdminAgregar" id="selectMenuUsuarioAdminAgregar" multiple="multiple" tabindex="2" style="text-transform:uppercase;width: 100%;">

                                </select>
                            </div>
                        </div>
                        <div id="errorMenu" class="btn-danger erroBoxs" style="display: none">
                            * Debe seleccionar una opci&oacute;n
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="form-actions text-right">
                        <span id="agregarUsuario" class="btn btn-primary">Agregar Usuario</span>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </form>
        </div>



    </div>
</div>
<!-- Modal Editar Categoria-->
<div id="modal-editar-categoria" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Categoria - Editar</h4>
            </div>

            <!-- Form inside modal -->
            <form id="form-edit-categoria" name="form-edit-categoria" class="validate" novalidate="novalidate" action="#" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Editar datos categoria</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="idCategoria" id="idCategoria" readonly>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span>Descripcion:</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="descripcionCategoria" id="descripcionCategoria" class="form-control">
                                    <div id="errordescripcionCategoria" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="editarCategoria" class="btn btn-primary">Editar</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Agregar Categoria-->
<div id="modal-agregar-categoria" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Categoria - Agregar</h4>
            </div>
            <!-- Form inside modal -->
            <form id="form-agregar-categoria" name="form-edit-categoria" class="validate" novalidate="novalidate" action="#" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Agregar categoria</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span>Descripcion:</span> </label>
                                <div class="col-sm-10">
                                    <input type="text" name="descripcionCategoriaAgregar" id="descripcionCategoriaAgregar" class="form-control">
                                    <div id="errordescripcionCategoriaAgregar" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <!--
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span>Tags:</span> </label>
                                        <div class="col-sm-10">
                                            <div id="boxTags"class="col-sm-10 field_wrapper">

                                            </div>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><span>Agregar otro tag</span> </label>
                                        <div class="col-sm-10">
                                            <a href="javascript:void(0);" class="add_button" title="Agregar tag"><i class="icon-plus"></i></a>                          
                                        </div>                                
                                </div>                                          
                            -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="agregarCategoria" class="btn btn-primary">Agregar</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Agregar Cobro-->
<div id="modal-agregar-cobro" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Cobro</h4>
            </div>
            <!-- Form inside modal -->
            <form id="formAgregarCobro" name="formAgregarCobro" class="validate" novalidate="novalidate" action="#" role="form" method="post">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Agregar cobro</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="montoAdeudado" id="montoAdeudado" class="form-control">
                            <input type="hidden" name="idGenIngresoCobro" id="idGenIngresoCobro" class="form-control">
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaCobroCobrar">Fecha cobro</label>
                                    <input type="text" id="inputFechaCobroCobrar" name="inputFechaCobroCobrar" class="form-control date-range-filter" data-date-format="yyyy-mm-dd">

                                    <div id="errorinputFechaCobroCobrar" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class=" control-label"><span><span style="color: red;"> * </span>Monto:</span> </label>
                                    <input type="number" name="montoCobro" id="montoCobro" class="form-control" onblur="validarDiferencia()">
                                    <div id="errormontoCobro" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" id="saldoAFavorDiv">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectMedioCobro">Incluir saldo a favor</label>
                                        <select name="selectSaldoAFavor" id="selectSaldoAFavor" class="select-full" required>
                                            <option value="0">Si</option>
                                            <option selected="selected" value="1">No</option>
                                        </select>

                                        <div id="errorselectSaldoAFavor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class=" control-label"><span>Saldo a favor:</span> </label>
                                        <input type="text" name="saldoAFavor" id="saldoAFavor" class="form-control" disabled>
                                        <div id="errorSaldoAFavor" class="btn-danger erroBoxs" style="display: none">
                                            *Ingrese una descripcion v&aacute;lida
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectMedioCobro"><span style="color: red;"> * </span>Medio de cobro</label>
                                    <select name="selectMedioCobro" id="selectMedioCobro" class="select-full" required>
                                        <option value="0">Seleccionar medio de cobro</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectMedioCobro" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><span>Descripcion:</span> </label>
                                    <textarea id="descripcionCobro" name="descripcionCobro" class="form-control"></textarea>
                                    <div id="errordescripcionCobro" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer col-md-12">
                    <div id="1agregarCobro" class="col-md-10">
                        <a id="btnAgregarCobro" class="btn btn-primary">Agregar</a>
                    </div>
                    <div id="2agregarCobro" class="col-md-10">
                        <a onclick="agregarCobroNCND()" class="btn btn-primary">Agregar</a>
                    </div>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Agregar Cobro-->
<div id="modal-agregar-cobro-gasto" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Cobro del gasto</h4>
            </div>
            <!-- Form inside modal -->
            <form id="formAgregarCobroGasto" name="formAgregarCobroGasto" class="validate" novalidate="novalidate" action="#" role="form" method="post">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Agregar cobro del gasto</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="montoAdeudado_formAgregarCobroGasto" id="montoAdeudado_formAgregarCobroGasto" class="form-control">
                            <input type="hidden" name="idGenGasto" id="idGenGasto" class="form-control">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class=" control-label"><span><span style="color: red;"> * </span>Monto:</span> </label>
                                    <input type="number" name="montoCobro_formAgregarCobroGasto" id="montoCobro_formAgregarCobroGasto" class="form-control" onblur="validarDiferenciaGasto()">
                                    <div id="errormontoCobro_formAgregarCobroGasto" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectMedioCobro"><span style="color: red;"> * </span>Medio de cobro</label>
                                    <select name="selectMedioCobro_formAgregarCobroGasto" id="selectMedioCobro_formAgregarCobroGasto" class="select-full" required>
                                        <option value="0">Seleccionar medio de cobro</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectMedioCobro_formAgregarCobroGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><span>Descripcion:</span> </label>
                                    <textarea id="descripcionCobro" name="descripcionCobro" class="form-control"></textarea>
                                    <div id="errordescripcionCobro" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnAgregarCobroGasto" class="btn btn-primary">Agregar</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Movimientos entre cuentas-->
<div id="modal-movimiento-cuentas" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Cobro</h4>
            </div>
            <!-- Form inside modal -->
            <form id="formMovimientoCuentas" name="formMovimientoCuentas" class="validate" novalidate="novalidate" action="#" role="form" method="post">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Movimiento entre cuentas</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaCobroCobrar">Fecha Movimiento</label>
                                    <input type="text" id="inputFechaMovimiento" name="inputFechaMovimiento" class="form-control date-range-filter" data-date-format="yyyy-mm-dd">

                                    <div id="errorinputFechaMovimiento" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class=" control-label"><span><span style="color: red;"> * </span>Monto:</span> </label>
                                    <input type="number" name="montoMovimiento" id="montoMovimiento" class="form-control">
                                    <div id="errormontoMovimiento" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese un monto v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectCuentaSalida"><span style="color: red;"> * </span>Caja Salida</label>
                                    <select name="selectCuentaSalida" id="selectCuentaSalida" class="select-full" required>
                                        <option value="0">Seleccionar cuenta salida</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectCuentaSalida" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectCuentaEntrada"><span style="color: red;"> * </span>Caja entrada</label>
                                    <select name="selectCuentaEntrada" id="selectCuentaEntrada" class="select-full" required>
                                        <option value="0">Seleccionar cuenta entrada</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectCuentaEntrada" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><span>Descripcion:</span> </label>
                                    <textarea id="descripcionMovimiento" name="descripcionMovimiento" class="form-control"></textarea>
                                    <div id="errordescripcionMovimiento" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnAgregarMovimiento" class="btn btn-primary">Agregar</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal Agregar Pago-->
<div id="modal-agregar-pago" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Cobro</h4>
            </div>
            <!-- Form inside modal -->
            <form id="formAgregarPago" name="formAgregarPago" class="validate" novalidate="novalidate" action="#" role="form" method="post">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Agregar cobro</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" name="montoAdeudadoPagar" id="montoAdeudadoPagar" class="form-control">
                            <input type="hidden" name="idGenEgresoPagar" id="idGenEgresoPagar" class="form-control">
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaPago">Fecha cobro</label>
                                    <input type="text" id="inputFechaPago" name="inputFechaPago" class="form-control date-range-filter" data-date-format="yyyy-mm-dd">

                                    <div id="errorinputFechaPago" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class=" control-label"><span>Monto:</span> </label>
                                    <input type="text" name="montoPagar" id="montoPagar" class="form-control" onkeyup="validarMontoAPagar()">
                                    <div id="errormontoPagar" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectMedioPago">Medio de cobro</label>
                                    <select name="selectMedioPago" id="selectMedioPago" class="select-full" required>
                                        <option value="0">Seleccionar medio de pago</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) :
                                                    echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                else :
                                                    if ($tesoreriaCuenta[$i]['idCuenta'] == 1 || $tesoreriaCuenta[$i]['idCuenta'] == 3 || $tesoreriaCuenta[$i]['idCuenta'] == 4 || $tesoreriaCuenta[$i]['idCuenta'] == 7 || $tesoreriaCuenta[$i]['idCuenta'] == 10) :
                                                        echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endif;
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectMedioPago" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><span>Descripcion:</span> </label>
                                    <textarea id="descripcionPago" name="descripcionPago" class="form-control"></textarea>
                                    <div id="errordescripcionPago" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnAgregarPago" class="btn btn-primary">Agregar</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Modal Agregar gasto-->
<div id="modal-agregar-gasto" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Gasto</h4>
            </div>
            <!-- Form inside modal -->
            <form id="formAgregarGasto" name="formAgregarGasto" class="validate" novalidate="novalidate" action="#" role="form" method="post">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr">Agregar gasto</h6>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaGasto">Fecha Gasto</label>
                                    <input type="text" id="inputFechaGasto" name="inputFechaGasto" class="form-control date-range-filter" placeholder="YYYY-MM-DD" autocomplete="off">

                                    <div id="errorinputFechaGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaPagoCompra"><span style="color: red;"> * </span>Fecha Vto del gasto</label>
                                    <input type="text" id="inputFechaVtoGasto" name="inputFechaVtoGasto" class="form-control date-range-filter" placeholder="YYYY-MM-DD" autocomplete="off">

                                    <div id="errorinputFechaVtoGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class=" control-label"><span><span style="color: red;"> * </span>Monto:</span> </label>
                                    <input type="number" name="montoGasto" id="montoGasto" class="form-control">
                                    <div id="errormontoGasto" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="text-align: center; margin-top: 5%;">
                                <div class="form-group">
                                    <input type="checkbox" name="pagado_agregarGasto" id="pagado_agregarGasto" value="1"> <label for="cbox2">Pagado</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectTipoFactura"><span style="color: red;"> * </span>Tipo Factura</label>
                                    <select name="selectTipoFactura" id="selectTipoFactura" class="select-full" required>
                                        <option value="0">Seleccionar tipo factura</option>
                                        <?php
                                        if (isset($tiposFacturas)) :
                                            for ($i = 0; $i < count($tiposFacturas); $i++) :
                                                echo '<option value="' . $tiposFacturas[$i]['idTipoFactura'] . '">' . $tiposFacturas[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectTipoFactura" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">

                                    <label class="control-label" for="selectCatGastoGeneral"><span style="color: red;"> * </span>Categor&iacute;a </label>
                                    <select name="selectCatGasto" id="selectCatGasto" class="select-full" required>
                                        <option value="0">Seleccionar categor&iacute;a</option>
                                        <?php
                                        if (isset($categorias)) :
                                            for ($i = 0; $i < count($categorias); $i++) :
                                                echo '<option value="' . $categorias[$i]['idCategoriaGasto'] . '">' . $categorias[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectCatGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectSubCatGasto"><span style="color: red;"> * </span>Subcategor&iacute;a</label>
                                    <select name="selectSubCatGasto" id="selectSubCatGasto" class="select-full" required>
                                        <option value="0">Seleccionar subcategor&iacute;a</option>

                                    </select>

                                    <div id="errorselectSubCatGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectMedioPago"><span style="color: red;"> * </span>Medio de pago</label>
                                    <select name="selectMedioPago" id="selectMedioPago2" class="select-full" required>
                                        <option value="0">Seleccionar medio de pago</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) :
                                                    echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                else :
                                                    if ($tesoreriaCuenta[$i]['idCuenta'] == 1 || $tesoreriaCuenta[$i]['idCuenta'] == 3 || $tesoreriaCuenta[$i]['idCuenta'] == 4 || $tesoreriaCuenta[$i]['idCuenta'] == 7 || $tesoreriaCuenta[$i]['idCuenta'] == 10) :
                                                        echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endif;
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectMedioPago_formAgregarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><span>Descripcion:</span> </label>
                                    <textarea id="descripcionGasto" name="descripcionGasto" class="form-control"></textarea>
                                    <div id="errordescripcionGasto" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="imagen">Imagen</label>
                                    <input type="file" name="fileGasto" id="fileGasto" class="styled">
                                    <div id="errorfileGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Ingrese una imagen.
                                    </div>
                                    <div id="errorfileGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Ingrese un archivo valido.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnAgregarGasto" class="btn btn-primary">Agregar</a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Modificar gasto-->
<div id="modal-modificar-gasto" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-user"></i> Gasto</h4>
            </div>
            <!-- Form inside modal -->
            <form id="formModificarGasto" name="formModificarGasto" class="validate" novalidate="novalidate" action="#" role="form" method="post">
                <div class="modal-body with-padding">
                    <div class="block-inner text-danger">
                        <h6 class="heading-hr"><div id="titulo_fromMOdificarGasto"></div></h6>
                    </div>
                    <div class="form-group">

                        <input name="idModificarGasto" id="idModificarGasto" type="hidden">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaGasto_modificarGasto">Fecha Gasto</label>
                                    <input type="text" id="inputFechaGasto_modificarGasto" name="inputFechaGasto_modificarGasto" class="form-control date-range-filter" placeholder="YYYY-MM-DD" autocomplete="off">

                                    <div id="errorinputFechaGasto_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputFechaPagoCompra"><span style="color: red;"> * </span>Fecha Vto del gasto</label>
                                    <input type="text" id="inputFechaVtoGasto_modificarGasto" name="inputFechaVtoGasto_modificarGasto" class="form-control date-range-filter" placeholder="YYYY-MM-DD" autocomplete="off">

                                    <div id="errorinputFechaVtoGasto_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class=" control-label"><span><span style="color: red;"> * </span>Monto:</span> </label>
                                    <input type="any" name="montoGasto_modificarGasto" id="montoGasto_modificarGasto" class="form-control">
                                    <div id="errormontoGasto_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectTipoFactura_modificarGasto"><span style="color: red;"> * </span>Tipo Factura</label>
                                    <select name="selectTipoFactura_modificarGasto" id="selectTipoFactura_modificarGasto" class="select-full" required>
                                        <option value="0">Seleccionar tipo factura</option>
                                        <?php
                                        if (isset($tiposFacturas)) :
                                            for ($i = 0; $i < count($tiposFacturas); $i++) :
                                                echo '<option value="' . $tiposFacturas[$i]['idTipoFactura'] . '">' . $tiposFacturas[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectTipoFactura_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">

                                    <label class="control-label" for="selectCatGasto_modificarGasto"><span style="color: red;"> * </span>Categor&iacute;a gasto</label>
                                    <select name="selectCatGasto_modificarGasto" id="selectCatGasto_modificarGasto" class="select-full" required>
                                        <option value="0">Seleccionar categoria gasto</option>
                                        <?php
                                        if (isset($gastosCategorias)) :
                                            for ($i = 0; $i < count($gastosCategorias); $i++) :
                                                echo '<option value="' . $gastosCategorias[$i]['idCategoriaGasto'] . '">' . $gastosCategorias[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectCatGasto_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectSubCatGasto_modificarGasto"><span style="color: red;"> * </span>Subcategoria gasto</label>
                                    <select name="selectSubCatGasto_modificarGasto" id="selectSubCatGasto_modificarGasto" class="select-full" required>
                                        <option value="0">Seleccionar subcategoria gasto</option>

                                    </select>

                                    <div id="errorselectSubCatGasto_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectMedioPago_modificarGasto"><span style="color: red;"> * </span>Medio de pago</label>
                                    <select name="selectMedioPago_modificarGasto" id="selectMedioPago_modificarGasto" class="select-full" required>
                                        <option value="0">Seleccionar medio de pago</option>
                                        <?php
                                        if (isset($tesoreriaCuenta)) :
                                            for ($i = 0; $i < count($tesoreriaCuenta); $i++) :
                                                if ($userdata['idUsuario'] != 28 && $userdata['idUsuario'] != 29) :
                                                    echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                else :
                                                    if ($tesoreriaCuenta[$i]['idCuenta'] == 1 || $tesoreriaCuenta[$i]['idCuenta'] == 3 || $tesoreriaCuenta[$i]['idCuenta'] == 4 || $tesoreriaCuenta[$i]['idCuenta'] == 7 || $tesoreriaCuenta[$i]['idCuenta'] == 10) :
                                                        echo '<option value="' . $tesoreriaCuenta[$i]['idCuenta'] . '">' . $tesoreriaCuenta[$i]['descripcion'] . '</option>';
                                                    endif;
                                                endif;
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorselectMedioPago_modificarGasto" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label"><span>Descripcion:</span> </label>
                                    <textarea id="descripcionGasto_modificarGasto" name="descripcionGasto_modificarGasto" class="form-control"></textarea>
                                    <div id="errordescripcionGasto" class="btn-danger erroBoxs" style="display: none">
                                        *Ingrese una descripcion v&aacute;lida
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="imagen">Imagen</label>
                                    <div id="visiblefileGasto">
                                        <input type="file" name="fileGasto" id="fileGasto" value="" class="styled">
                                        <div id="errorfileGasto" class="btn-danger erroBoxs" style="display: none">
                                            * Ingrese una imagen.
                                        </div>
                                        <div id="errorfileGasto" class="btn-danger erroBoxs" style="display: none">
                                            * Ingrese un archivo valido.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <iframe width="100%" height="300px" name="iframeGasto" id="iframeGasto"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer col-md-12">
                    <div class="col-md-8"></div>
                    <div id="visibleRelenoModificarGasto" class="col-md-2"></div>
                    <div id="visiblebtnModificarGasto" class="col-md-2 btn btn-primary" style="margin-right: 1px; display: block; width: auto;">Modificar</a></div>
                    <button type="button" class="btn btn-warning col-md-2" data-dismiss="modal" style="margin: 0px;">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Cuenta Tesoreria -->
<div id="modal-cuenta-tesoreria" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i> Cuenta</h4>
            </div>

            <div class="panel-body">
                <form id="formCuentaTesoreria" role="form">
                    <input name="inputIdCuenta" id="inputIdCuenta_formCuentasTesoreria" type="hidden">

                    <div class="row">
                        <div class="col-md-12" style="padding:0px;">
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputNombCuenta"><span style="color: red;"> * </span>Cuenta</label>
                                    <input name="inputNombCuenta" id="nombCuenta_formCuentasTesoreria" data-minlength="2" maxlength="25" type="text" class="form-control">

                                    <div id="errorInputNombCuenta_formCuentasTesoreria" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="padding:0px;">
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectTipoCuenta"><span style="color: red;"> * </span>Tipo Cuenta</label>
                                    <select name="selectTipoCuenta" id="selectTipoCuenta_formCuentasTesoreria" class="select-full" required>
                                        <option value="0">Seleccione</option>
                                        <?php
                                        if (isset($tipo_cuentas_tesoreria)) :
                                            for ($i = 0; $i < count($tipo_cuentas_tesoreria); $i++) :
                                                echo '<option value="' . $tipo_cuentas_tesoreria[$i]['idTipoCuenta'] . '">' . $tipo_cuentas_tesoreria[$i]['descripcion'] . '</option>';
                                            endfor;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorSelectTipoCuenta_formCuentasTesoreria" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <a id="nuevaCuentaTesoreria" class="btn btn-primary">Agregar</a>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cliente -->
<div id="modal-nuevo-cliente" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:70%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Cliente</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosCliente" role="form">
                    <input name="inputIdGenCliente_formCliente" id="inputIdGenCliente_formCliente" type="hidden">

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
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCliente"><span style="color: red;"> * </span>Cliente</label>
                                        <input name="inputCliente" id="inputCliente_formCliente" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputCliente_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputApodoML">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Apodo de Mercado Libre">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            Apodo ML
                                        </label>
                                        <input name="inputApodoML" id="inputApodoML_formCliente" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputApodoML_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputApellido"><span style="color: red;"> * </span>Apellido</label>
                                        <input name="inputApellido" id="inputApellido_formCliente" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputApellido_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNombre"><span style="color: red;"> * </span>Nombre</label>
                                        <input name="inputNombre" id="inputNombre_formCliente" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputNombre_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumTel">N&uacute;mero de Tel&eacute;fono</label>
                                        <input name="inputNumTel" id="inputNumTel_formCliente" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumTel_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumCel">N&uacute;mero de Celular</label>
                                        <input name="inputNumCel" id="inputNumCel_formCliente" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumCel_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCorreo">Correo Electr&oacute;nico</label>
                                        <input name="inputCorreo" id="inputCorreo_formCliente" maxlength="150" type="email" class="form-control" required>

                                        <div id="errorInputCorreo_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputWeb">P&aacute;gina Web</label>
                                        <input name="inputWeb" id="inputWeb_formCliente" maxlength="150" type="text" class="form-control" required>

                                        <div id="errorInputWeb_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectProvincia"><span style="color: red;"> * </span>Provincia</label>
                                        <select name="selectProvincia_formCliente" id="selectProvincia_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($provincias)) :
                                                for ($i = 0; $i < count($provincias); $i++) :
                                                    echo '<option value="' . $provincias[$i]['idProvincia'] . '">' . $provincias[$i]['provincia'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectProvincia_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectLocalidad"><span style="color: red;"> * </span>Localidad</label>
                                        <select name="selectLocalidad_formCliente" id="selectLocalidad_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                        </select>

                                        <div id="errorSelectLocalidad_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCodPostal">C&oacute;digo Postal</label>
                                        <input name="inputCodPostal" id="inputCodPostal_formCliente" data-minlength="3" maxlength="25" type="number" class="form-control" required>

                                        <div id="errorInputCodPostal_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-5">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDomicilio">Domicilio</label>
                                        <input name="inputDomicilio" id="inputDomicilio_formCliente" data-minlength="3" maxlength="50" type="text" class="form-control" required>

                                        <div id="errorInputDomicilio_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumDir">N&uacute;mero</label>
                                        <input name="inputNumDir" id="inputNumDir_formCliente" data-minlength="1" maxlength="10" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumDir_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumDir">Piso</label>
                                        <input name="inputPiso" id="inputPiso_formCliente" data-minlength="1" maxlength="5" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control">

                                        <div id="errorInputPiso_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDpto">Dpto</label>
                                        <input name="inputDpto" id="inputDpto_formCliente" data-minlength="1" maxlength="5" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control">

                                        <div id="errorInputDpto_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNota">Nota</label>
                                        <input name="inputNota" id="inputNota_formCliente" type="text" class="form-control">

                                        <div id="errorInputNota_formCliente" class="btn-danger erroBoxs" style="display: none">
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
                                    <a href="#" data-placement="top" class="tip" data-original-title="Los datos seleccionados aquí aparecerán por defecto en una nueva venta al elegir este cliente.">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    VENTAS.
                                </small>
                            </h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectCatVentas">Categor&iacute;a Ventas</label>
                                        <select name="selectCatVentas" id="selectCatVentas_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($categorias_ventas)) :
                                                for ($i = 0; $i < count($categorias_ventas); $i++) :
                                                    echo '<option value="' . $categorias_ventas[$i]['idCategoriaVentas'] . '">' . $categorias_ventas[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectCatVentas_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&o&oacute;n
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDtoGeneral">Descuento General</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input name="inputDtoGeneral" id="inputDtoGeneral_formCliente" type="number" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                        event.returnValue = false;">
                                        </div>

                                        <div id="errorInputDtoGeneral_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNotaCliente">Nota para el Cliente</label>
                                        <input name="inputNotaCliente" id="inputNotaCliente_formCliente" data-minlength="2" type="text" class="form-control">

                                        <div id="errorInputNotaCliente_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="paso-3">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-money-check-alt" aria-hidden="true"></i>
                                    <a href="#" data-placement="top" class="tip" data-original-title="Todos los comprobantes emitidos a este cliente vendrán por defecto con estos datos de Facturación.">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    DATOS FACTURACI&Oacute;N.
                                </small>
                            </h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputRazonSocial">Raz&oacute;n Social</label>
                                        <input name="inputRazonSocial" id="inputRazonSocial_formCliente" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputRazonSocial_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumTelFac">N&uacute;mero de Tel&eacute;fono</label>
                                        <input name="inputNumTelFac" id="inputNumTelFac_formCliente" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumTelFac_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumCelFac">N&uacute;mero de Celular</label>
                                        <input name="inputNumCelFac" id="inputNumCelFac_formCliente" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumCelFac_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectTipoDoc">Tipo Documento</label>
                                        <select name="selectTipoDoc" id="selectTipoDoc_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($documentos_tipos)) :
                                                for ($i = 0; $i < count($documentos_tipos); $i++) :
                                                    echo '<option value="' . $documentos_tipos[$i]['idTipoDocumento'] . '">' . $documentos_tipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectTipoDoc_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumDoc">Documento</label>
                                        <input name="inputNumDoc" id="inputNumDoc_formCliente" data-minlength="10" maxlength="15" type="number" class="form-control" onkeyup="validar_cuit_dni_cliente()" required>

                                        <div id="errorInputNumDoc_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDomicilioFiscal">Domicilio Fiscal</label>
                                        <input name="inputDomicilioFiscal" id="inputDomicilioFiscal_formCliente" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDomicilioFiscal_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectCondIva">Conci&oacute;n de IVA</label>
                                        <select name="selectCondIva" id="selectCondIva_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($iva_condiciones)) :
                                                for ($i = 0; $i < count($iva_condiciones); $i++) :
                                                    echo '<option value="' . $iva_condiciones[$i]['idCondicionIva'] . '">' . $iva_condiciones[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectCondIva_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectCompTipo">Comprobante por Defecto</label>
                                        <select name="selectCompTipo" id="selectCompTipo_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($comprobantes_tipos)) :
                                                for ($i = 0; $i < count($comprobantes_tipos); $i++) :
                                                    echo '<option value="' . $comprobantes_tipos[$i]['idTipoComprobante'] . '">' . $comprobantes_tipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectCompTipo_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectProvinciaFac">Provincia</label>
                                        <select name="selectProvinciaFac" id="selectProvinciaFac_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($provincias)) :
                                                for ($i = 0; $i < count($provincias); $i++) :
                                                    echo '<option value="' . $provincias[$i]['idProvincia'] . '">' . $provincias[$i]['provincia'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectProvinciaFac_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectLocalidadFac">Localidad</label>
                                        <select name="selectLocalidadFac" id="selectLocalidadFac_formCliente" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                        </select>

                                        <div id="errorSelectLocalidadFac_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCodPostalFac">C&oacute;digo Postal</label>
                                        <input name="inputCodPostalFac" id="inputCodPostalFac_formCliente" data-minlength="3" maxlength="25" type="number" class="form-control" required>

                                        <div id="errorInputCodPostalFac_formCliente" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button id="btnAddCliente" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Proveedor -->
<div id="modal-nuevo-proveedor" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:70%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Proveedor</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosProveedor" role="form">
                    <input name="inputIdGenProveedor_formProveedor" id="inputIdGenProveedor_formProveedor" type="hidden">

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
                                        <label class="control-label" for="inputProveedor"><span style="color: red;"> * </span>Proveedor</label>
                                        <input name="inputProveedor" id="inputProveedor_formProveedor" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputProveedor_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputApellido"><span style="color: red;"> * </span>Apellido</label>
                                        <input name="inputApellido" id="inputApellido_formProveedor" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputApellido_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNombre"><span style="color: red;"> * </span>Nombre</label>
                                        <input name="inputNombre" id="inputNombre_formProveedor" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputNombre_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumTel">N&uacute;mero de Tel&eacute;fono</label>
                                        <input name="inputNumTel" id="inputNumTel_formProveedor" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumTel_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumCel">N&uacute;mero de Celular</label>
                                        <input name="inputNumCel" id="inputNumCel_formProveedor" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumCel_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCorreo">Correo Electr&oacute;nico</label>
                                        <input name="inputCorreo" id="inputCorreo_formProveedor" maxlength="150" type="email" class="form-control" required>

                                        <div id="errorInputCorreo_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputWeb">P&aacute;gina Web</label>
                                        <input name="inputWeb" id="inputWeb_formProveedor" maxlength="150" type="text" class="form-control" required>

                                        <div id="errorInputWeb_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectProvincia"><span style="color: red;"> * </span>Provincia</label>
                                        <select name="selectProvincia" id="selectProvincia_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($provincias)) :
                                                for ($i = 0; $i < count($provincias); $i++) :
                                                    echo '<option value="' . $provincias[$i]['idProvincia'] . '">' . $provincias[$i]['provincia'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectProvincia_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectLocalidad"><span style="color: red;"> * </span>Localidad</label>
                                        <select name="selectLocalidad" id="selectLocalidad_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                        </select>

                                        <div id="errorSelectLocalidad_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCodPostal">C&oacute;digo Postal</label>
                                        <input name="inputCodPostal" id="inputCodPostal_formProveedor" data-minlength="3" maxlength="25" type="number" class="form-control" required>

                                        <div id="errorInputCodPostal_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-5">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDomicilio">Domicilio</label>
                                        <input name="inputDomicilio" id="inputDomicilio_formProveedor" data-minlength="3" maxlength="50" type="text" class="form-control" required>

                                        <div id="errorInputDomicilio_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumDir">N&uacute;mero</label>
                                        <input name="inputNumDir" id="inputNumDir_formProveedor" data-minlength="1" maxlength="10" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumDir_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumDir">Piso</label>
                                        <input name="inputPiso" id="inputPiso_formProveedor" data-minlength="1" maxlength="5" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control">

                                        <div id="errorInputPiso_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDpto">Dpto</label>
                                        <input name="inputDpto" id="inputDpto_formProveedor" data-minlength="1" maxlength="5" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control">

                                        <div id="errorInputDpto_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNota">Nota</label>
                                        <input name="inputNota" id="inputNota_formProveedor" type="text" class="form-control">

                                        <div id="errorInputNota_formProveedor" class="btn-danger erroBoxs" style="display: none">
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
                                    <a href="#" data-placement="top" class="tip" data-original-title="Los datos seleccionados aquí aparecerán por defecto en una nueva compra al elegir este cliente.">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    COMPRAS.
                                </small>
                            </h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectCatCompras">Categor&iacute;a Compras</label>
                                        <select name="selectCatCompras_formProveedor" id="selectCatCompras_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($categorias_compras)) :
                                                for ($i = 0; $i < count($categorias_compras); $i++) :
                                                    echo '<option value="' . $categorias_compras[$i]['idCategoriaCompras'] . '">' . $categorias_compras[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectCatCompras_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&o&oacute;n
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDtoGeneral">Descuento General</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input name="inputDtoGeneral" id="inputDtoGeneral_formProveedor" type="number" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                        event.returnValue = false;">
                                        </div>

                                        <div id="errorInputDtoGeneral_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNotaInterna">Nota Interna</label>
                                        <input name="inputNotaInterna" id="inputNotaInterna_formProveedor" type="text" class="form-control">

                                        <div id="errorInputNotaInterna_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="paso-3">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-money-check-alt" aria-hidden="true"></i>
                                    <a href="#" data-placement="top" class="tip" data-original-title="Todos los comprobantes emitidos a este cliente vendrán por defecto con estos datos de Facturación.">
                                        <i class="fas fa-question-circle"></i>
                                    </a>
                                    DATOS FACTURACI&Oacute;N.
                                </small>
                            </h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputRazonSocial">Raz&oacute;n Social</label>
                                        <input name="inputRazonSocial" id="inputRazonSocial_formProveedor" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputRazonSocial_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumTelFac">N&uacute;mero de Tel&eacute;fono</label>
                                        <input name="inputNumTelFac" id="inputNumTelFac_formProveedor" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumTelFac_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumCelFac">N&uacute;mero de Celular</label>
                                        <input name="inputNumCelFac" id="inputNumCelFac_formProveedor" data-minlength="10" maxlength="15" type="text" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;" class="form-control" required>

                                        <div id="errorInputNumCelFac_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectTipoDoc">Tipo Documento</label>
                                        <select name="selectTipoDoc" id="selectTipoDoc_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($documentos_tipos)) :
                                                for ($i = 0; $i < count($documentos_tipos); $i++) :
                                                    echo '<option value="' . $documentos_tipos[$i]['idTipoDocumento'] . '">' . $documentos_tipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectTipoDoc_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNumDoc">Documento</label>
                                        <input name="inputNumDoc" id="inputNumDoc_formProveedor" data-minlength="10" maxlength="15" type="number" class="form-control" onkeyup="validar_cuit_dni_proveedor()" required>

                                        <div id="errorInputNumDoc_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDomicilioFiscal">Domicilio Fiscal</label>
                                        <input name="inputDomicilioFiscal" id="inputDomicilioFiscal_formProveedor" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDomicilioFiscal_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectCondIva">Conci&oacute;n de IVA</label>
                                        <select name="selectCondIva" id="selectCondIva_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($iva_condiciones)) :
                                                for ($i = 0; $i < count($iva_condiciones); $i++) :
                                                    echo '<option value="' . $iva_condiciones[$i]['idCondicionIva'] . '">' . $iva_condiciones[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectCondIva_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectCompTipo">Comprobante por Defecto</label>
                                        <select name="selectCompTipo" id="selectCompTipo_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($comprobantes_tipos)) :
                                                for ($i = 0; $i < count($comprobantes_tipos); $i++) :
                                                    echo '<option value="' . $comprobantes_tipos[$i]['idTipoComprobante'] . '">' . $comprobantes_tipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectCompTipo_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectProvinciaFac">Provincia</label>
                                        <select name="selectProvinciaFac" id="selectProvinciaFac_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($provincias)) :
                                                for ($i = 0; $i < count($provincias); $i++) :
                                                    echo '<option value="' . $provincias[$i]['idProvincia'] . '">' . $provincias[$i]['provincia'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectProvinciaFac_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectLocalidadFac">Localidad</label>
                                        <select name="selectLocalidadFac_formProveedor" id="selectLocalidadFac_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                        </select>

                                        <div id="errorSelectLocalidadFac_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCodPostalFac">C&oacute;digo Postal</label>
                                        <input name="inputCodPostalFac" id="inputCodPostalFac_formProveedor" data-minlength="3" maxlength="25" type="number" class="form-control" required>

                                        <div id="errorInputCodPostalFac_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-6">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectMedioPago"><span style="color: red;"> * </span>Medio de pago</label>
                                        <select name="selectMedioPago_formProveedor" id="selectMedioPago_formProveedor" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($mediosPagos)) :
                                                for ($i = 0; $i < count($mediosPagos); $i++) :
                                                    echo '<option value="' . $mediosPagos[$i]['idMedioPago'] . '">' . $mediosPagos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectMedioPago_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" id="CBU_proveedor" style="display: none">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCBU"><span style="color: red;"> * </span>CBU</label>
                                        <input name="inputCBU_formProveedor" id="inputCBU_formProveedor" data-minlength="22" maxlength="22" type="number" class="form-control">

                                        <div id="errorInputCBU_formProveedor" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button id="btnAddProveedor" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Categorias Compras -->
<div id="modal-nueva-categoria-compras" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Categoría de compra</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosCategoriaCompras" role="form">
                    <input name="inputId_formCatCompras" id="inputId_formCatCompras" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion_formCatCompras">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcion_formCatCompras" id="inputDescripcion_formCatCompras" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcion_formCategoriaCompras" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnAddCategoriaCompras" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Categorias Gastos -->
<div id="modal-nueva-categoria-gastos" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Categoría de gasto</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosCategoriaGastos" role="form">
                    <input name="inputId_formCatGastos" id="inputId_formCatGastos" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion_formCatGastos">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcion_formCatGastos" id="inputDescripcion_formCatGastos" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcion_formCategoriaGastos" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputDescripcion_formCatGastos0">
                                        <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                            <i class="fas fa-question-circle"></i>
                                        </a>
                                        <span style="color: red;"> * </span>
                                        Subcategoría
                                    </label>
                                    <input name="inputSubcategoria_formCatGastos0" id="inputSubcategoria_formCatGastos0" data-minlength="2" maxlength="25" type="text" class="form-control">

                                    <div id="errorInputSubcategoria_formCatGastos0" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2" style="padding:0px;">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" style="text-align:center;width:100%;">Agregar Más</label>
                                    <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                        <a href="javascript:void(0);" class="add_categoria_gasto" title="Agregar categoria"><i class="icon-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="field_wrapper">
                                <!-- JS -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnAddCategoriaGastos" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Categorias Gastos -->
<div id="modal-modificar-categoria-gastos" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Categoría de gasto</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosCategoriaGastosModificar" role="form">
                    <input name="inputIdModificar_formCatGastos" id="inputIdModificar_formCatGastos" type="hidden">
                    <input name="ultima_subcategoriagasto" id="ultima_subcategoriagasto" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcionModificar_formCatGastos">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcionModificar_formCatGastos" id="inputDescripcionModificar_formCatGastos" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcionModificar_formCategoriaGastos" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="padding-left: 5%;">
                                <div class="col-md-10">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion_formCatGastos0">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Subcategoría
                                        </label>
                                        <input name="inputSubcategoria_formModificarCatGastos0" id="inputSubcategoria_formModificarCatGastos0" data-minlength="2" maxlength="25" type="text" class="form-control">
                                        <input name="idSubcategoria_formModificarCatGastos0" id="idSubcategoria_formModificarCatGastos0" type="hidden">

                                        <div id="errorInputSubcategoria_formModificarCatGastos0" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2" style="padding:0px;">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" style="text-align:center;width:100%;">Agregar Más</label>
                                        <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                            <a href="javascript:void(0);" class="add_categoria_gasto_modificar" title="Agregar categoria"><i class="icon-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="field_wrapper_modificar">
                                    <!-- JS -->
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnUpdateCategoriaGastos" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Subcategorias Gastos -->
<div id="modal-nueva-subcategoria-gastos" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Subcategoría de gasto</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosSubcategoriaGastos" role="form">
                    <input name="inputId_formSubCatGastos" id="inputId_formSubCatGastos" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion_formSubCatGastos">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcion_formSubCatGastos" id="inputDescripcion_formSubCatGastos" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcion_formSubcategoriaGastos" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputCategoriaDetalle_formSubCatVentas"><span style="color: red;"> * </span>Categoría Detalle</label>
                                    <select name="selectCategoriaDetalle_formSubCatGastos" id="selectCategoriaDetalle_formSubCatGastos" class="select-full" required>
                                        <option value="0">Seleccione</option>
                                        <?php
                                        if (isset($categorias_gastos)) :
                                            foreach ($categorias_gastos as $key => $value) :
                                                if ($subcategorias_gastos[$key]['idCategoriaGasto'] == $value['idCategoriaGasto']) :
                                                    echo '<option selected="selected" value="' . $value['idCategoriaGasto'] . '">' . $value['descripcion'] . '</option>';
                                                else :
                                                    echo '<option value="' . $value['idCategoriaGasto'] . '">' . $value['descripcion'] . '</option>';
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorSelectCategoriaDetalle_formSubCatGastos" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnAddSubcategoriaGastos" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Subcategorias Ventas -->
<div id="modal-nueva-subcategoria-ventas" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Subcategoría de venta</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosSubcategoriaVentas" role="form">
                    <input name="inputId_formSubCatVentas" id="inputId_formSubCatVentas" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion_formSubCatVentas">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcion_formSubCatVentas" id="inputDescripcion_formSubCatVentas" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcion_formSubcategoriaVentas" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="selectCategoriaDetalle_formSubCatVentas"><span style="color: red;"> * </span>Categoría Detalle</label>
                                    <select name="selectCategoriaDetalle_formSubCatVentas" id="selectCategoriaDetalle_formSubCatVentas" class="select-full" required>
                                        <option value="0">Seleccione</option>
                                        <?php
                                        if (isset($categorias_ventas_detalle)) :
                                            foreach ($categorias_ventas_detalle as $key => $value) :
                                                if ($subcategorias_ventas['idVentaDetalle'] == $value['idCategoriaVentas']) :
                                                    echo '<option selected="selected" value="' . $value['idCategoriaVentas'] . '" data-descripcion="' . $value['descripcion'] . '">' . $value['descripcion'] . '</option>';
                                                else :
                                                    echo '<option value="' . $value['idCategoriaVentas'] . '">' . $value['descripcion'] . '</option>';
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>

                                    <div id="errorSelectSubcategoria_formSubCatVentas" class="btn-danger erroBoxs" style="display: none">
                                        * Debe seleccionar una opci&oacute;n
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnAddSubcategoriaVentas" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Categoria Detalle Ventas -->
<div id="modal-nueva-categoria-detalle-ventas" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Categoría de venta</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosCategoriaVentas" role="form">
                    <input name="inputId_formCatVentas" id="inputId_formCatVentas" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion_formCatDetVentas">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcion_formCatVentas" id="inputDescripcion_formCatVentas" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcion_formCategoriaVentas" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" for="inputDescripcion_formCatVentas1">
                                        <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                            <i class="fas fa-question-circle"></i>
                                        </a>
                                        <span style="color: red;"> * </span>
                                        Subcategoría
                                    </label>
                                    <input name="inputSubcategoria_formCatVentas0" id="inputSubcategoria_formCatVentas0" data-minlength="2" maxlength="25" type="text" class="form-control">

                                    <div id="errorInputSubcategoria_formCategoriaVentas0" class="btn-danger erroBoxs" style="display: none">
                                        * Debe completar el campo
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="padding:0px;">
                                <div class="form-group label-floating has-feedback">
                                    <label class="control-label" style="text-align:center;width:100%;">Agregar Más</label>
                                    <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                        <a href="javascript:void(0);" class="add_categoria_venta_detalle" title="Agregar categoria"><i class="icon-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="field_wrapper">
                                <!-- JS -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnAddCategoriaDetVentas" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Categoria Detalle Ventas -->
<div id="modal-modificar-categoria-detalle-ventas" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:50%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Categoría de venta</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosCategoriaVentasModificar" role="form">
                    <input name="inputIdModificar_formCatVentas" id="inputIdModificar_formCatVentas" type="hidden">
                    <input name="ultima_subcategoriaventa" id="ultima_subcategoriaventa" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div class="row">
                            <div class="col-md-12" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcionModificar_formCatVentas">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Descripción
                                        </label>
                                        <input name="inputDescripcionModificar_formCatVentas" id="inputDescripcionModificar_formCatVentas" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputDescripcionModificar_formCategoriaVentas" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="padding-left: 5%;">
                                <div class="col-md-10">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputSubcategoria_formCatModificarVentas0">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en la descripcion.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Subcategoría
                                        </label>
                                        <input name="inputSubcategoria_formCatModificarVentas0" id="inputSubcategoria_formCatModificarVentas0" data-minlength="2" maxlength="25" type="text" class="form-control">
                                        <input name="idSubcategoria_formCatModificarVentas0" id="idSubcategoria_formCatModificarVentas0" type="hidden">

                                        <div id="errorInputSubcategoria_formModificarCatVentas0" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2" style="padding:0px;">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" style="text-align:center;width:100%;">Agregar Más</label>
                                        <div style="display:block;width:100%;text-align:center;padding-top:8px;">
                                            <a href="javascript:void(0);" class="add_categoria_venta_modificar" title="Agregar categoria"><i class="icon-plus"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="field_wrapper_modificarCatVenta">
                                    <!-- JS -->
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnModificarCategoriaDetVentas" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Producto -->
<div id="modal-nuevo-producto" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="z-index: 1010;background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog" style="min-width:70%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="icon-pencil3"></i>Producto</h4>
            </div>

            <div class="panel-body">
                <form id="formDatosProducto" role="form">
                    <input name="inputIdGenProducto" id="inputIdGenProducto_formProducto" type="hidden">

                    <div id="paso-1" style="padding-bottom:15px;">
                        <div id="boxCabeceraForm">
                            <h3>
                                <small>
                                    <i style="color:#333333;" class="fas fa-id-card" aria-hidden="true"></i>
                                    DATOS PRODUCTO.
                                </small>
                            </h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputNombre">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Se sugiere cargar en el Nombre todas las características del producto, por ejemplo: talle y color, para luego identificarlos rápidamente cuando los buscamos.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Nombre
                                        </label>
                                        <input name="inputNombre" id="inputNombre_formProducto" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputNombre_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputCodigo"><span style="color: red;"> * </span>C&oacute;digo</label>
                                        <input name="inputCodigo" id="inputCodigo_formProducto" data-minlength="2" maxlength="25" type="text" class="form-control">

                                        <div id="errorInputCodigo_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectTipoProducto">Tipo de Producto</label>
                                        <select name="selectTipoProducto" id="selectTipoProducto_formProducto" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            /* if(isset($tipoProducto)) :
                                              for ($i=0;$i<count($tipoProducto);$i++) :
                                              echo '<option value="'.$provincias[$i]['idTipoProducto'].'">'.$tipoProducto[$i]['descripcion'].'</option>';
                                              endfor;
                                              endif; */
                                            ?>
                                        </select>

                                        <div id="errorSelectTipoProducto_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectProveedor"><span style="color: red;"> * </span>Proveedor</label>
                                        <select name="selectProveedor" id="selectProveedor_formProducto" class="select-full" required>
                                            <option value="0">Seleccione un proveedor</option>
                                            <?php
                                            if (isset($proveedores)) :
                                                for ($i = 0; $i < count($proveedores); $i++) :
                                                    echo '<option value="' . $proveedores[$i]['idProveedor'] . '">' . $proveedores[$i]['nombre'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectProveedor_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="imagen">Imagen</label>
                                        <input type="file" name="file" id="fileImagen_formProducto" class="styled">
                                        <div id="errorFile_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Ingrese una imagen.
                                        </div>
                                        <div id="errorFileFormato_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Ingrese una imagen con formato JPG, JPEG, PNG O GIF.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputStock"><span style="color: red;"> * </span>Stock</label>
                                        <input name="inputStock" id="inputStock_formProducto" type="number" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                    event.returnValue = false;">

                                        <div id="errorInputStock_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputDescripcion"><span style="color: red;"> * </span>Descripcion</label>
                                        <textarea class="form-control" cols="40" id="inputDescripcion_formProducto" name="inputDescripcion" rows="3"></textarea>

                                        <div id="errorInputDescripcion_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectEstado">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Al seleccionar el estado 'Inactivo' el producto no aparecerá en la base de datos. Para acceder a los productos inactivos debes utilizar los filtros.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            Estado
                                        </label>
                                        <select name="selectEstado" id="selectEstado_formProducto" class="select-full" required>
                                            <option selected="selected" value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>

                                        <div id="errorSelectEstado_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectControlStock">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Al elegir la opcion 'NO' este producto no controlara el stock dentro de su inventario.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            Control de stock
                                        </label>
                                        <select name="selectControlStock_formProducto" id="selectControlStock_formProducto" class="select-full" required>
                                            <option selected="selected" value="select">Seleccionar una opcion de control de stock</option>
                                            <option value="0">Si</option>
                                            <option value="1">No</option>
                                        </select>

                                        <div id="errorSelectControlStock_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar alguna de las opciones correctas.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectProductoEcommerce">Agregar producto al E-Commerce</label>
                                        <select name="selectProductoEcommerce_formDatosProducto" id="selectProductoEcommerce_formDatosProducto" class="form-control" style="text-transform:uppercase;">
                                            <?php
                                            if ($configuracion_ecommerce[0]['ecommerce'] == 0) :
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

                    <div id="paso-2">
                        <div class="row">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <h3>
                                        <small>
                                            <i style="color:#333333;" class="fas fa-shopping-cart" aria-hidden="true"></i>
                                            VENTAS.
                                        </small>
                                    </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectShowVentas">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Al seleccionar esta opción el producto aparacerá como opción al momento de realizar una venta o una compra. En caso contrario no aparecerá en el buscador de productos de ventas o compras.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            Mostrar en Ventas
                                        </label>
                                        <select name="selectShowVentas" id="selectShowVentas_formProducto" class="select-full" required>
                                            <option selected="selected" value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>

                                        <div id="errorSelectShowVentas_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputPrecioVenta">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Este precio vendrá por defecto al elegir este producto en una nueva venta.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Precio Venta
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input name="inputPrecioVenta" id="inputPrecioVenta_formProducto" type="number" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                        event.returnValue = false;">
                                        </div>

                                        <div id="errorInputPrecioVenta_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputPorcentajeDescuento">
                                            Porcentaje de Descuento
                                        </label>
                                        <div class="input-group">
                                            <input name="inputPorcentajeDescuento_formProducto" id="inputPorcentajeDescuento_formProducto" type="number" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                event.returnValue = false;" onkeyup="porcentajeDescuentoProducto();">
                                            <span class="input-group-addon">%</span>
                                        </div>

                                        <div id="infoPorcentajeDescuento_formProducto" class="btn-info erroBoxs" style="display: none">
                                            * El precio con el descuento aplicado: <span id="valorTotalDescuento"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectListaPreciosVentas">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Con esta función podrás crear distintas listas de precios para todos tus productos.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            Lista de Precios
                                        </label>
                                        <select name="selectListaPreciosVentas" id="selectListaPreciosVentas_formProducto" class="select-full" required>
                                            <option selected="selected" value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>

                                        <div id="errorSelectListaPreciosVentas_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" style="padding:0px;">
                                <div class="col-md-12">
                                    <h3>
                                        <small>
                                            <i style="color:#333333;" class="fas fa-cart-plus" aria-hidden="true"></i>
                                            COMPRAS.
                                        </small>
                                    </h3>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectShowVentas">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Al seleccionar esta opción el producto aparacerá como opción al momento de realizar una venta o una compra. En caso contrario no aparecerá en el buscador de productos de ventas o compras.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            Mostrar en Compras
                                        </label>
                                        <select name="selectShowCompras" id="selectShowCompras_formProducto" class="select-full" required>
                                            <option selected="selected" value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>

                                        <div id="errorSelectShowCompras_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="inputPrecioCompra">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Este costo vendrá por defecto al elegir este producto en una nueva compra.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            Costo
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">$</span>
                                            <input name="inputPrecioCompra" id="inputPrecioCompra_formProducto" type="number" class="form-control" onKeypress="if (event.keyCode < 45 || event.keyCode > 57)
                                                        event.returnValue = false;">
                                        </div>

                                        <div id="errorInputPrecioCompra_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe completar el campo
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectIvaCompra">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Es el IVA que se aplicará a la hora de comprar este producto/servicio.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            IVA Compra por Defecto
                                        </label>
                                        <select name="selectIvaCompra" id="selectIvaCompra_formProducto" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($iva_tipos)) :
                                                for ($i = 0; $i < count($iva_tipos); $i++) :
                                                    echo '<option value="' . $iva_tipos[$i]['idIva'] . '">' . $iva_tipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectIvaCompra_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group label-floating has-feedback">
                                        <label class="control-label" for="selectIvaVenta">
                                            <a href="#" data-placement="top" class="tip" data-original-title="Es el IVA que se aplicará a la hora de vender este producto/servicio.">
                                                <i class="fas fa-question-circle"></i>
                                            </a>
                                            <span style="color: red;"> * </span>
                                            IVA Venta por Defecto
                                        </label>
                                        <select name="selectIvaVenta" id="selectIvaVenta_formProducto" class="select-full" required>
                                            <option value="0">Seleccione</option>
                                            <?php
                                            if (isset($iva_tipos)) :
                                                for ($i = 0; $i < count($iva_tipos); $i++) :
                                                    echo '<option value="' . $iva_tipos[$i]['idIva'] . '">' . $iva_tipos[$i]['descripcion'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>

                                        <div id="errorSelectIvaVenta_formProducto" class="btn-danger erroBoxs" style="display: none">
                                            * Debe seleccionar una opci&oacute;n
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button id="btnAddProducto" class="btn btn-primary btn-raised">Guardar</button>
                <button class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de comprobantes de pagos -->
<div id="modal-comprobantes-pagos" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 700px;margin: 0px auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Comprobantes de pagos</h4>
            </div>


            <div class="modal-body" style="padding: 10px; max-height: 500px; min-height: auto; overflow: auto;">
                <table id="tableComprobantesPagos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Cobro</th>
                            <th class="text-center">Debito</th>
                            <th class="text-center">Credito</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">N° Comprobante</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyComprobantesPagos">

                    </tbody>
                </table>
            </div>

            <div id="cargando_comprobantes_pagos" style="display:none;" class="modal-body with-padding">
                <p>
                    <div class="alert alert-info fade in" style="text-align:center;width:95%;margin:0px auto;border:1px solid #3A87AD;padding-bottom:30px;">
                        <i id="rotate" style="position: absolute;font-size: 1.5em;" class="fa fa-cog fa-spin fa-1x fa-fw margin-bottom"></i>
                    </div>
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de cte cte de proveedores -->
<div id="modal-cta-cte-proveedores" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 700px;margin: 0px auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Cte cta de proveedores</h4>
            </div>

            <div class="modal-body" style="padding: 10px; max-height: 500px; min-height: auto; overflow: auto;">
                <table id="cteCtaProveedores" name="cteCtaProveedores" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Emisión</th>
                            <th class="text-center">A Pagar</th>
                            <th class="text-center">Pague</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">N° Comprobante</th>
                            <th class="text-center">Medio de Pago</th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de cte cte de clientes -->
<div id="modal-cta-cte-clientes" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="width: 700px;margin: 0px auto;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> Cte cta de cliente</h4>
            </div>

            <div class="modal-body" style="padding: 10px; max-height: 500px; min-height: auto; overflow: auto;">
                <table id="cteCtaClientes" name="cteCtaClientes" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Emisión</th>
                            <th class="text-center">A Pagar</th>
                            <th class="text-center">Pague</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">N° Comprobante</th>
                            <th class="text-center">Medio de Pago</th>
                        </tr>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
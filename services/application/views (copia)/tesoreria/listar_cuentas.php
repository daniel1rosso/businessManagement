<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Cuentas Tesoreria<small>Listar</small></h3>
                </div>
        </div>
        
        <!---->
        
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li class="active">Cuentas Tesoreria</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->
        
        <div class="form-actions text-right">
            <a href="#modal-cuenta-tesoreria" onclick="resetFormCuentaTesoreria()" data-toggle="modal" class="btn btn-primary">
                <i class="icon-plus"></i>
                Agregar Cuenta
            </a>
        </div>
        
        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#cuentas" data-toggle="tab">
                        <i class="fas fa-funnel-dollar" style="font-size:1.4em;"></i> 
                        Cuentas
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="cuentas">

                    <!-- Striped and bordered datatable inside panel -->
                    <?php if(isset($tipo_cuenta)) : ?>
                        <?php foreach ($tipo_cuenta as $key => $value) : ?>
                                <div class="panel panel-default" style="margin-bottom: 17px;">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">
                                        <!-- <i class="icon-paragraph-justify"></i> -->
                                            <?=$value['descripcion']?>
                                        </h6>
                                    </div>
                                    <div class="panel-body">
                                        <div class="datatable">
                                            <table class="table table-striped table-bordered" id="<?=$value['idTipoCuenta']?>">
                                                <thead>
                                                    <tr>
                                                        <th class="text-left col-lg-11">Descripcion</th>
                                                        <th class="text-center col-lg-1">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($value['cuentas'])) : ?>
                                                        <?php foreach ($value['cuentas'] as $keyCuenta => $valueCuenta) : ?>
                                                            <tr id="<?=$valueCuenta['idGenCuenta']?>">
                                                                <td class="text-left">
                                                                    <?=$valueCuenta['descripcionCuenta']?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <a href="#modal-delete" data-toggle="modal" role="button" onclick="deleteCuentaTesoreria('<?=$valueCuenta['idGenCuenta']?>','<?=$value['idTipoCuenta']?>')" class="tip">
                                                                        <i class="icon-remove4"></i>
                                                                    </a>                                                                            
                                                                    &nbsp;
                                                                    <a href="#modal-cuenta-tesoreria" data-toggle="modal" role="button" onclick="resetFormCuentaTesoreria();editarCuentaTesoreria('<?=$valueCuenta['idGenCuenta']?>','<?=$value['idTipoCuenta']?>')" class="tip">
                                                                        <i class="icon-pencil3"></i>
                                                                    </a>                                                                            
                                                                </td>
                                                            </tr>				                        
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>    
                                    </div>    
                                </div>
                        <?php endforeach; ?>
                    <?php endif; ?>                        
                    
                </div>            
            </div>
        </div>
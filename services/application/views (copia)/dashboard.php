<!-- Page content -->
<div class="page-content">

    <div class="page-header">
        <div class="page-title">
            <h3>Menu Principal <small>Bienvenid@ <?=$user['nombreCompleto']?></small></h3>
        </div>
    </div>
    
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="<?=$url?>dashboard">Home</a></li>
            <li class="active">Dashboard</li>
        </ul>
    </div>
    
    <!-- Estados del Dia -->
    <div id="msjDia">
        <?=$saludoDia?>		  
    </div>	    

    <!-- Info blocks -->
    <div class="row">
        <div class="col-md-12 info-buttons block">
            <a href="<?=$url?>clientes/listar_clientes" class="col-sm-3">
                <i class="fas fa-user-tie"></i> 
                <span>Total Clientes</span> 
                <strong class="label label-info"><?=$totClientes?></strong>
            </a>
            <a href="<?=$url?>proveedores/listar_proveedores" class="col-sm-3">
                <i class="fas fa-truck-loading"></i> 
                <span>Total Proveedores</span> 
                <strong class="label label-warning"><?=$totProveedores?></strong>
            </a>
            <a href="<?=$url?>productos/listar_productos" class="col-sm-3">
                <i class="fas fa-boxes"></i> 
                <span>Total Productos</span> 
                <strong class="label label-primary"><?=$totProductos?></strong>
            </a>
            <a href="<?=$url?>usuarios/listar_usuarios" class="col-sm-3">
                <i class="fas fa-users"></i> 
                <span>Total Usuarios</span> 
                <strong class="label label-success"><?=$totUsuarios?></strong>
            </a>      
        </div>
    </div>  
    <!-- /info blocks -->

    <div class="row">
        <div class="col-md-4">
            <!-- Ultimos Productos -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="fas fa-boxes"></i> &Uacute;ltimos Productos</h6>
                </div>
                <ul class="message-list">
                    <?php if(isset($ultimosProductos)) : $i=0; ?>
                        <?php foreach ($ultimosProductos as $key => $value) : ?>
                            <?php if($i<4): ?>
                                <li>
                                    <div class="clearfix">
                                        <div class="chat-member">
                                            <a href="#">
                                                <?php 
                                                    if (file_exists('uploads/productos/'.$value['idGenProducto'].'/thumbs/'.$value['nombreImg'])) { 
                                                        echo '<img width="46.5px" height="40px" src="'.$url.'uploads/productos/'.$value['idGenProducto'].'/thumbs/'.$value['nombreImg'].'">';
                                                    }else{
                                                        echo '<img width="46.5px" height="40px" src="http://placehold.it/300">';
                                                    }
                                                ?>     
                                            </a>
                                            <h6>
                                                <?=$value['nombre']?>
                                                <small>
                                                    &nbsp; /&nbsp; 
                                                    <i class="icon-time" style="color:#FFF;font-size:1.0em;"></i>
                                                    <?=$value['fechaAlta']?>
                                                </small>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; $i=$i+1;?> 
                        <?php endforeach; ?>
                    <?php endif; ?>                            
                </ul>
            </div>
        </div>        
      
        <div class="col-md-4">
            <!-- Ultimos Productos -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="fas fa-history"></i> Historial Operaciones</h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Tipo</th>
                                <th class="text-center">Operaci&oacute;n</th>
                            </tr>
                        </thead>        
                        <tbody>
                            <?php if(!empty($historialOperaciones)) : $i=0; ?>
                                <?php foreach ($historialOperaciones as $key => $value) : ?>
                                    <?php if($i<6): ?>
                                        <tr>
                                            <td class="text-center"><?=$value['nombreCompleto']?></td>
                                            <td class="text-center"><?=$value['descripcionTipo']?></td>
                                            <td class="text-center"><?=$value['descripcionOperacion']?></td>
                                        </tr>
                                    <?php endif; $i=$i+1;?> 
                                <?php endforeach; ?>
                            <?php endif; ?>    
                        </tbody>
                    </table>
                </div>                                            
            </div>
        </div>             
        
        <div class="col-md-4">
            <!-- Ultimos Usuarios Conectados -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="fa fa-user"></i> &Uacute;ltimos Usuarios Conectados</h6>
                </div>
                <ul class="message-list">
                    <?php if(!empty($ultimosUsuarios)) : $i=0; ?>
                        <?php foreach ($ultimosUsuarios as $key => $value) : ?>
                            <?php if($i<4): ?>
                                <li>
                                    <div class="clearfix">
                                        <div class="chat-member">
                                            <a href="#">
                                                <?php 
                                                    if (file_exists('uploads/usuarios/thumbs/'.$value['miniatura'])) { 
                                                        echo '<img src="'.$url.'uploads/usuarios/thumbs/'.$value['miniatura'].'">';
                                                    }else{
                                                        echo '<img width="46.5px" height="40px" src="http://placehold.it/300">';
                                                    }
                                                ?>     
                                            </a>
                                            <h6>
                                                <?=$value['usuarioLog']?><span class="status status-info"></span> 
                                                <small>
                                                    &nbsp; /&nbsp; 
                                                    <i class="icon-time" style="color:#FFF;font-size:1.0em;"></i>
                                                    <?=$value['fechaIngresoLog']?>
                                                </small>
                                            </h6>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; $i=$i+1;?> 
                        <?php endforeach; ?>
                    <?php endif; ?>                            
                </ul>
            </div>
        </div>        
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <!-- Notificaciones de Telepathic Soft -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="fa fa-wrench"></i> Soporte y Mantenimiento</h6>
                </div>
                <ul  class="message-list">
                    <li class="media" style="margin-top:0px;">
                        <!--
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/300" alt="">
                            </a>
                        -->
                        <div class="media-body">
                            <div class="clearfix">
                                <a href="#" class="media-heading">Damian Marrone</a>
                                <span class="media-notice">Marzo 06, 2018 / 8:30 am</span>
                            </div>
                            Actualización sobre el funcionamiento del backend y frontend. Ver 1.8.0
                        </div>
                        <div class="media-body">
                            <div class="clearfix">
                                <a href="#" class="media-heading">Damian Marrone</a>
                                <span class="media-notice">Marzo 05, 2018 / 10:58 am</span>
                            </div>
                            Actualización sobre el funcionamiento del backend y frontend. Ver 1.7.5
                        </div>                        
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="col-md-6">
            <!-- Contacto Soporte Tecnico -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title"><i class="fa fa-ticket"></i> Contactenos</h6>
                </div>
                <form action="#" class="block validate" role="form">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nombre Completo: <span class="mandatory">*</span></label>
                                    <input type="text" name="name" placeholder="Nombre Completo" class="form-control required">
                                </div>

                                <div class="col-md-6">
                                    <label>Correo Electronico: <span class="mandatory">*</span></label>
                                    <input type="text" name="email_field" placeholder="Correo Electronico" class="form-control required">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Seleccione Departamento:</label>
                                    <select data-placeholder="Seleccione Departamento" class="select-full" tabindex="2">
                                        <option value=""></option> 
                                        <option value="Support">Soporte (online)</option> 
                                        <option value="Sles">Ventas</option> 
                                        <option value="Information">Informacion</option> 
                                        <option value="Administration">Administracion Web</option> 
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Mensaje: <span class="mandatory">*</span></label>
                            <textarea rows="5" cols="5" name="message" placeholder="Escriba su mensaje..." class="elastic form-control required"></textarea>
                        </div>

                        <div class="text-right">
                            <input type="reset" value="Cancelar" class="btn btn-danger">
                            <input type="submit" value="Enviar Mensaje" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


		
			
		
			

			
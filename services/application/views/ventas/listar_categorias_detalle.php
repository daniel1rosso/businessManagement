<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Categorías de venta<small>Listar</small></h3>
                </div>
        </div>
        
        
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li class="active">Ventas</li>
                <li class="active">Categorías de venta</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->
        
        <div class="form-actions text-right">
            <a href="#!" class="btn btn-primary" onclick="vaciadoCategoriasDetalleVentas()">
                <i class="icon-plus"></i>
                Agregar categoría de venta
            </a>
        </div>
      
        
        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#modal-nueva-categoria-detalle-ventas" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Categorías de venta
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="gastos">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoCatDetCategoriaVentas">
                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($categorias_ventas)) : ?>
                                        <?php foreach ($categorias_ventas as $key => $value) : ?>
                                            <tr id="<?=$value['idCategoriaVentas']?>">
                                                <td class="text-center"><?=$value['descripcion']?></td>
                                                <td class="text-center">
                                                    <a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_ventas_detalle" data-id="<?=$value['idCategoriaVentas']?>" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>
                                                    &nbsp;
                                                    <a role="button" data-toggle="modal" class="tip update_categorias_ventas_detalle" onclick="llenadoModalEditarCategoriaVenta(<?=$value['idCategoriaVentas']?>)" data-original-title="Editar"><i class="icon-pencil3"></i></a>
                                                </td>
                                            </tr>				                        
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>            
            </div>
        </div>
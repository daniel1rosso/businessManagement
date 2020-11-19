<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Page header -->
        <div class="page-header">
                <div class="page-title">
                        <h3>Categorías de compra<small>Listar</small></h3>
                </div>
        </div>
        
        
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="<?=$url?>dashboard">Home</a></li>
                <li class="active">Compras</li>
                <li class="active">Categorías de compra</li>
            </ul>

            <div class="visible-xs breadcrumb-toggle">
                <a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a>
            </div>
        </div>

        <!---->
        
        <div class="form-actions text-right">
            <a href="#modal-nueva-categoria-compras"  data-toggle="modal"class="btn btn-primary" onclick="vaciadoCategoriasCompras()">
                <i class="icon-plus"></i>
                Agregar Categoría de compra
            </a>
        </div>
      
        
        <!---->
        
        <div class="tabbable page-tabs">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#modal-nueva-categoria-compras" data-toggle="tab">
                        <i class="fas fa-truck-loading" style="font-size:1.4em;"></i> 
                        Categorías de compra
                    </a>
                </li>	  	                 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active fade in" id="CategoriasCompras">

                    <!-- Striped and bordered datatable inside panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><h6 class="panel-title"><i class="icon-paragraph-justify"></i> Listado</h6></div>
                        <div class="datatable">
                            <table class="table table-striped table-bordered" id="listadoCategoriasCompras">
                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($categorias_compras)) : ?>
                                        <?php foreach ($categorias_compras as $key => $value) : ?>
                                            <tr id="<?=$value['idCategoriaCompras']?>">
                                                <td class="text-center"><?=$value['descripcion']?></td>
                                                <td class="text-center">
                                                    <a href="#modal-delete" role="button" data-toggle="modal" class="tip delete_categorias_compras" data-id="<?=$value['idCategoriaCompras']?>" data-toggle="modal" data-original-title="Eliminar"><i class="icon-remove4"></i></a>
                                                    &nbsp;
                                                    <a href="#modal-nueva-categoria-compras" role="button" data-toggle="modal" class="tip update_categorias_compras" data-id="<?=$value['idCategoriaCompras']?>" data-descripcion="<?=$value['descripcion']?>" data-toggle="modal" data-original-title="Editar"><i class="icon-pencil3"></i></a>
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